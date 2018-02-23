<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserControllerTest extends TestCase
{
	public function testCreateUser()
    {
        $user = factory(User::class)->create(['password' => 'password']);

        $userPayload = [
        	'firstname' => 'edited firstname', 'lastname' => 'edited lastname',
        	'gender' => 'female', 'email' => 'mynewpasword@gmail.com', 'password' => 'passcode'
        ];

        $response = $this->json('POST', '/v1/users', $userPayload, $this->headers($user));

        $response->assertStatus(201);
	}

	public function testUpdateUser()
    {
        $user = factory(User::class)->create(['password' => 'password']);

        $userPayload = [
        	'firstname' => 'edited firstname', 'lastname' => 'edited lastname',
        	'gender' => 'female', 'email' => 'mynewpasword@gmail.com', 'password' => 'passcode'
        ];

        $response = $this->json('PUT', '/v1/users/'.$user->id, $userPayload, $this->headers($user));

        $response->assertStatus(204);
	}

	public function testGetUsers()
	{
		$user = factory(User::class)->create(['password' => 'password']);

        $response = $this->json('GET', '/v1/users', [], $this->headers($user));

        $response->assertJsonStructure([
             'data' => [
                '*' => [
                    'id', 'firstname', 'lastname', 'gender', 'email'
                ]
             ]
         ]);
	}

	public function testGetUserById()
	{
		$userPayload = [
        	'firstname' => 'firstuser1', 'lastname' => 'lastname1',
        	'gender' => 'female', 'email' => 'mynewpasword@gmail.com', 'password' => 'passcode'
        ];

		$user = factory(User::class)->create($userPayload);

        $response = $this->json('GET', '/v1/users/'.$user->id, [], $this->headers($user));

        $response->assertJsonStructure([
            'data' => [
            	'id', 'firstname', 'lastname', 'gender', 'email'
		    ]
		]);
	}
}
