<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\UserRequest;
use App\Transformers\UserTransformer;
use App\Http\Repositories\UserRepository;

class UserController extends Controller
{
	public $userRepository;

	use Helpers;

	public function __construct(UserRepository $userRepository) 
	{
		$this->userRepository = $userRepository;
	}

    public function store(UserRequest $request)
    {
    	if ($this->userRepository->create($request->all())) {
    		return $this->response->created();
    	}

    	return $this->response->errorBadRequest();
    }

    public function getAll()
    {
    	$users = $this->userRepository
    		->findAll();

    	return $this->response->collection($users, new UserTransformer);
    }

    public function getBusinesses($id)
    {
    	$businesses = $this->userRepository->findById($id);
    	if ($businesses->count() > 0) {
    	}
    }
}
