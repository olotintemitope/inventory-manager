<?php

namespace App\Transformers;

use App\Model\Item;
use League\Fractal\TransformerAbstract;
use App\Transformers\CategoryWithOutEagerLoadingTransformer;

class ItemTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'category',
    ];

    public function transform(Item $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name, 
            'description' => $item->description, 
            'logo_url' => $item->logo_url, 
            'price' => $item->price, 
            'quantity' => $item->quantity, 
            'vat' => $item->vat
        ];
    }

    public function includeCategory(Item $item)
    {
        $category = $item->category;

        return $this->item($category, new CategoryWithOutEagerLoadingTransformer);
    }
}