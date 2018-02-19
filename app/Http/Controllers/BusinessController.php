<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\BusinessRequest;
use App\Transformers\BusinessTransformer;
use App\Http\Requests\UpdateBusinessRequest;
use App\Http\Repositories\BusinessRepository;

class BusinessController extends Controller
{
    public $businessRepository;

	use Helpers;

	public function __construct(UserRepository $businessRepository) 
	{
		$this->businessRepository = $BusinessRepository;
	}
}
