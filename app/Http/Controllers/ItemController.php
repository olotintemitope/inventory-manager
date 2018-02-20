<?php

namespace App\Http\Controllers;

use App\Model\Item;
use App\Model\Business;
use App\Model\Category;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\ItemRequest;
use App\Transformers\ItemTransformer;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Repositories\ItemRepository;
use App\Http\Repositories\CategoryRepository;
use App\Http\Repositories\BusinessRepository;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ItemController extends Controller
{
    public $businessRepository;
    public $userRepository;
    public $categoryRepository;

	use Helpers;

	public function __construct(
		BusinessRepository $businessRepository, 
		ItemRepository $itemRepository,
		CategoryRepository $categoryRepository
	) 
	{
		$this->businessRepository = $businessRepository;
		$this->itemRepository = $itemRepository;
		$this->categoryRepository = $categoryRepository;
	}

	public function store(ItemRequest $request)
    {
    	$requestBody = $request->all();

    	$business = $this->businessRepository
    		->findById($requestBody['business_id']);
    	if (!$business instanceof Business) {
    		throw new StoreResourceFailedException('Business not found');
    	}

    	$item = $this->itemRepository
    		->findBy('name', $requestBody['name'], [
    			'business_id' => $business->id,
    		])->first();
    	if ($item instanceof Item) {
    		throw new StoreResourceFailedException('Could not create new Item. Item already exist');
    	}

    	$category = $this->categoryRepository
    		->findById($requestBody['category_id']);
    	if (!$category instanceof Category) {
    		throw new StoreResourceFailedException('Category not found');
    	}

    	if ($this->categoryRepository->create($request->all())) {
    		return $this->response->created();
    	}

    	return $this->response->errorBadRequest();
    }

    public function getAll()
    {
    	$items = $this->itemRepository
    		->findAll();

    	return $this->response->collection($items, new ItemTransformer);
    }

    public function getItem($id)
    {
    	$item = $this->itemRepository->findById($id);

    	return $this->response->item($item, new ItemTransformer);
    }

    public function updateItem(UpdateItemRequest $request, $id)
    {
        $requestBody = $request->all();

        $businessId = $requestBody['business_id'];
        $categoryId = $requestBody['category_id'];

        $item = $this->itemRepository->findById($id);
    	if (!$item instanceof Item) {
    		throw new NotFoundHttpException('Item not found');
    	}

    	$business = $this->businessRepository->findById($businessId);
    	if (!$business instanceof Business) {
    		throw new NotFoundHttpException('business not found');
    	}

    	$category = $this->categoryRepository->findById($categoryId);
    	if (!$category instanceof Category) {
    		throw new NotFoundHttpException('Category not found');
    	}

    	if ($category->business->id !== $business->id) {
    		throw new UpdateResourceFailedException("Business with this id is not authorized to update this item");
    	}
    	// don't update all the fields but only update the available ones
    	$item = $this->persistItem($request, $item);
    	if ($item) {
    		$item->save();
  
    		return $this->response->noContent();
    	}

    	return $this->response->errorBadRequest();
    }

    public function persistItem($request, $item)
    {
    	// don't update all the fields but only update the available ones
 		if (array_key_exists('description', $request->all())) {
    		$item->description = $request->all()['description'];
    	}

    	if (array_key_exists('logo_url', $request->all())) {
    		$item->logo_url = $request->all()['logo_url'];
    	}

    	if (array_key_exists('price', $request->all())) {
    		$item->price = $request->all()['price'];
    	}

    	if (array_key_exists('quantity', $request->all())) {
    		$item->quantity = $request->all()['quantity'];
    	}

    	if (array_key_exists('vat', $request->all())) {
    		$item->vat = $request->all()['vat'];
    	}

    	$item->name = $request->all()['name'];
		$item->business_id = $request->all()['business_id'];
		$item->category_id = $request->all()['category_id'];

    	return $item;
    }
}
