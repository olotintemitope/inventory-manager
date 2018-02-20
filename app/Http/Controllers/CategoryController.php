<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\CategoryRequest;
use App\Transformers\CategoryTransformer;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    public $categoryRepository;

    use Helpers;

	public function __construct(CategoryRepository $categoryRepository) 
	{
		$this->categoryRepository = $categoryRepository;
	}

    public function store(CategoryRequest $request)
    {
    	if ($this->categoryRepository->create($request->all())) {
    		return $this->response->created();
    	}

    	return $this->response->errorBadRequest();
    }

    public function getAll()
    {
    	$categories = $this->categoryRepository
    		->findAll();

    	return $this->response->collection($categories, new CategoryTransformer);
    }

    public function getCategory($id)
    {
    	$category = $this->categoryRepository->findById($id);

    	return $this->response->item($category, new CategoryTransformer);
    }

    public function updateCategory(CategoryRequest $request, $id)
    {
    	if ($this->categoryRepository->update($request->all(), $id)) {
    		return $this->response->noContent();
    	}

    	return $this->response->errorBadRequest();
    }
}
