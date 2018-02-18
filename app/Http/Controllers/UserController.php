<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use App\Http\Requests\UserRequest;
use App\Http\Repositories\UserRepository;

class UserController extends Controller
{
	use Helpers;

    public function store(UserRequest $request, UserRepository $userRepository)
    {
    	if ($userRepository->create($request->all())) {
    		return $this->response->created();
    	}

    	return $this->response->errorBadRequest();
    }
}
