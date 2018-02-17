<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'category_id', 'name', 'description', 'logo_url', 'price', 'quantity', 'vat',
    ];

    public function business()
    {
    	return $this->belongsTo('App\Model\Business');
    }

    public function category()
    {
    	return $this->belongsTo('App\Model\Category');
    }
}
