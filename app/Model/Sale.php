<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'item_id', 'price', 'quantity', 'total_vat', 'total_quantity', 'total_amount', 'total_base_amount', 'customer_name'
    ];

    public function business()
    {
    	return $this->belongsTo('App\Model\Business');
    }

    public function item()
    {
    	return $this->belongsTo('App\Model\Item');
    }
}
