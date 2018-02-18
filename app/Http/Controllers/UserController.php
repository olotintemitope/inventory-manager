<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Repositories\UserRepository;

class UserController extends Controller
{
    public function show(UserRepository $userRepository)
    {
    	return $userRepository->findAll();
    }
}
