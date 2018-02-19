<?php

namespace Tests;

use App\Model\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
	 * Return request headers needed to interact with the API.
	 *
	 * @return Array array of headers.
	 */
	protected function headers($user = null)
	{
	    $headers = ['Accept' => 'application/json'];

	    if (!is_null($user)) {
	        $token = JWTAuth::fromUser($user);
	        JWTAuth::setToken($token);
	        $headers['Authorization'] = 'Bearer '.$token;
	    }

	    return $headers;
	}

	public function testAuthenticateUser()
    {
        $user = factory(User::class)->create(['password' => 'password']);

        $response = $this->json('POST', '/v1/authenticate', ['email' => $user->email, 'password' => 'password']);

        $response->assertJsonStructure(['token']);
	}
}
