<?php

namespace App\Http\Controllers;

use App\Model\User;
use App\Model\Business;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\BusinessRequest;
use App\Transformers\BusinessTransformer;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\UpdateBusinessRequest;
use App\Http\Repositories\BusinessRepository;
use Dingo\Api\Exception\StoreResourceFailedException;

class BusinessController extends Controller
{
    public $businessRepository;
    public $userRepository;

	use Helpers;

	public function __construct(
		BusinessRepository $businessRepository, 
		UserRepository $userRepository
	) 
	{
		$this->businessRepository = $businessRepository;
		$this->userRepository = $userRepository;
	}

	public function store(BusinessRequest $request)
    {
    	$requestBody = $request->all();
    	$userId = $requestBody['user_id'];

    	$user = $this->userRepository->findById($userId);
    	$business = $this->businessRepository
    		->findWhere('name', $requestBody['name'])
    		->first();

    	if (!$user instanceof User) {
    		throw new StoreResourceFailedException('Could not create new user. User does not exist');
    	}

    	if ($business instanceof Business) {
    		throw new StoreResourceFailedException('Could not create new business. Business already exist');
    	}

    	if ($this->businessRepository->create($request->all())) {
    		return $this->response->created();
    	}

    	return $this->response->errorBadRequest();
    }

    public function getAll()
    {
    	$businesses = $this->businessRepository
    		->findAll();

    	return $this->response->collection($users, new BusinessTransformer);
    }

}
