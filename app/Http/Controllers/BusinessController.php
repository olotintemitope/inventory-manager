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
use Dingo\Api\Exception\UpdateResourceFailedException;
// use Dingo\Api\Exception\UpdateResourceFailedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    	return $this->response->collection($businesses, new BusinessTransformer);
    }

    public function getBusiness($id)
    {
    	$business = $this->businessRepository->findById($id);

    	return $this->response->item($business, new BusinessTransformer);
    }

    public function updateBusiness(UpdateBusinessRequest $request, $userId, $id)
    {
    	$user = $this->userRepository->findById($userId);
    	$currentUser = null;

    	if ($user instanceof User) {
    		$currentUser->id;
    	} else {
    		throw new UpdateResourceFailedException("User with this id is not found");
    	}

    	$business = $this->businessRepository->findById($id);

    	if (!$business instanceof Business) {
    		throw new NotFoundHttpException('business not found');
    	}

    	$businessOwner = $business->user->id;

    	if ($currentUser !== $businessOwner) {
    		throw new UpdateResourceFailedException("User with this id is not authorized to update this business");
    	}

    	if ($this->userRepository->update($request->all(), $id)) {
    		return $this->response->noContent();
    	}

    	return $this->response->errorBadRequest();
    }
}
