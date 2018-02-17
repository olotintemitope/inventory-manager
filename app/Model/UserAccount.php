<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    public function business()
    {
    	return $this->hasMany('App\Model\Business');
    }

    public function user()
    {
    	return $this->hasMany('App\Model\User');
    }
}
