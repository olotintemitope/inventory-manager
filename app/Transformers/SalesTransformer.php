<?php

namespace App\Transformers;

use App\Model\Sales;
use Swap\Laravel\Facades\Swap;
use League\Fractal\TransformerAbstract;
use App\Transformers\BusinessTransformer;
use App\Transformers\ItemWithoutCategoryTransformer;

class SalesTransformer extends TransformerAbstract
{
    public $convertedCurrency;

    public function __construct($convertedCurrency)
    {
        $this->convertedCurrency = $convertedCurrency;
    }
	/**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'item'
    ];

    public function transform(Sales $sales)
    {
        $rate = 1;

        if (!is_null($this->convertedCurrency)) {
            $baseCurrency = $sales->business->currency;
            $rate = Swap::latest($this->convertedCurrency.'/'.$baseCurrency)->getValue();
        }
        
        return [
            'id' => (int) $sales->id,
            'price' => $sales->price, 
            'quantity' => $sales->quantity, 
            'total_vat' => $sales->total_vat, 
            'total_quantity' => $sales->total_quantity, 
            'total_amount' => $sales->total_amount * $rate, 
            'total_base_amount' => $sales->total_base_amount * $rate, 
            'customer_name' => $sales->customer_name
        ];
    }

    public function includeItem(Sales $sales)
    {
        $items = $sales->item;

        return $this->item($items, new ItemWithoutCategoryTransformer);
    }
}