<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\UserRequest;
use App\Transformers\UserTransformer;
use App\Http\Requests\UpdateUserRequest;
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

    public function getUser($id)
    {
    	$user = $this->userRepository->findById($id);

    	return $this->response->item($user, new UserTransformer);
    }

    public function updateUser(UpdateUserRequest $request, $id)
    {
    	if ($this->userRepository->update($request->all(), $id)) {
    		return $this->response->noContent();
    	}

    	return $this->response->errorBadRequest();
    }
}
