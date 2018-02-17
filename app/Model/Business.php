<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'country', 'state', 'timezone', 'currency'
    ];

    public function user()
    {
    	return $this->hasOne('App\Model\User');
    }

    public function categories()
    {
    	return $this->hasMany('App\Model\Catgory');
    }

    public function items()
    {
    	return $this->hasMany('App\Model\Item');
    }

    public function sales()
    {
    	return $this->hasMany('App\Model\Sale');
    }
}
