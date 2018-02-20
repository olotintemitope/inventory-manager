<?php

namespace App\Transformers;

use App\Model\Item;
use League\Fractal\TransformerAbstract;
use App\Transformers\CategoryTransformer;

class ItemWithoutCategoryTransformer extends TransformerAbstract
{
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
}