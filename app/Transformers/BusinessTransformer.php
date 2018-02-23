<?php

namespace App\Transformers;

use App\Model\Business;
use League\Fractal\TransformerAbstract;

class BusinessTransformer extends TransformerAbstract
{
    public function transform(Business $business)
    {
        return [
            'id' => $business->id,
            'name' => $business->name,
            'country' => $business->country,
            'state' => $business->state,
            'timezone' => $business->timezone,
            'currency' => $business->currency
        ];
    }
}