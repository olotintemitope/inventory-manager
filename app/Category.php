<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'name', 'description'
    ];

    public function business()
    {
    	return $this->belongsTo('App\Model\Business');
    }

    public function items()
    {
    	return $this->hasMany('App\Model\Business');
    }
}
