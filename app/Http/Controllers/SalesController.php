<?php

namespace App\Http\Controllers;

use Validator;
use App\Model\Item;
use App\Model\Business;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Repositories\ItemRepository;
use App\Http\Repositories\SalesRepository;
use App\Http\Repositories\BusinessRepository;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SalesController extends Controller
{
	use Helpers;

	public $businessRepository;
    public $itemRepository;
    public $salesRepository;

    public function __construct(
    	BusinessRepository $businessRepository, 
		ItemRepository $itemRepository,
		SalesRepository $salesRepository)
    {
    	$this->businessRepository = $businessRepository;
		$this->itemRepository = $itemRepository;
		$this->salesRepository = $salesRepository;
    }

    public function store(Request $request)
    {
    	$items = $request->all();

    	foreach ($items as $itemData) {
    		$valid = $this->validateRequest($itemData);
    		if (!$valid) {
    			$business = $this->businessRepository
    				->findById($itemData['business_id']);
		    	if (!$business instanceof Business) {
		    		throw new StoreResourceFailedException('Business not found');
		    	}

		    	$item = $this->itemRepository
		    		->findBy('id', $itemData['item_id'], [
		    			'business_id' => $business->id,
		    		])->first();
		    	if (!$item instanceof Item) {
		    		throw new StoreResourceFailedException('This Item does not belong to the supplied business');
		    	}

		    	$sales = $this->salesRepository->create($itemData);

		    	if ($sales) {
		    		$sales = $this->updateItem($sales, $item, $itemData);
		    		$sales->save();
		    	}
    		}
    	}

    	return $this->response->created();
    }

    public function updateItem($sales, $item, $itemData)
    {
    	$totalQuantity = $itemData['quantity'];
    	$totalAmount = (int)($item->price * $totalQuantity);
    	$totalVat = (((int)($item->vat) / 100) * $totalAmount);
    	$totalBaseAmount = $totalAmount + $totalVat;

    	$sales->total_vat = $totalVat;
    	$sales->total_amount = $totalAmount;
    	$sales->total_quantity = $totalQuantity;
    	$sales->total_base_amount = $totalBaseAmount;

    	return $sales;
    }

    public function validateRequest($request)
    {
    	$validator = Validator::make($request, [
    		'business_id' => 'required',
            'item_id' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'customer_name' => 'required'
    	]);

    	return $validator->fails();
    }
}
