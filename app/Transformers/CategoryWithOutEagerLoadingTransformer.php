<?php

namespace App\Transformers;

use App\Model\Category;
use League\Fractal\TransformerAbstract;

class CategoryWithOutEagerLoadingTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id' => (int) $category->id,
            'name' => ucfirst($category->name),
            'description'  => ucfirst($category->description),
        ];
    }
}