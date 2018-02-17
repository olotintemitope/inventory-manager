<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'business_id'
    ];

    public function business()
    {
    	return $this->hasMany('App\Model\Business');
    }

    public function user()
    {
    	return $this->hasMany('App\Model\User');
    }
}
