<?php

namespace App\Transformers;

use App\Model\Category;
use League\Fractal\TransformerAbstract;
use App\Transformers\ItemWithoutCategoryTransformer;

class CategoryTransformer extends TransformerAbstract
{
	/**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'business',
        'items'
    ];

    public function transform(Category $category)
    {
        return [
            'id' => (int) $category->id,
            'name' => ucfirst($category->name),
            'description'  => ucfirst($category->description),
        ];
    }

    public function includeBusiness(Category $category)
    {
    	$business = $category->business;

        return $this->item($business, new BusinessTransformer);
    }

    public function includeItems(Category $category)
    {
        $items = $category->items;

        return $this->collection($items, new ItemWithoutCategoryTransformer);
    }
}