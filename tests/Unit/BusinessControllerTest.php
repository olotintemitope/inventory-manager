<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\User;
use App\Model\Business;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BusinessControllerTest extends TestCase
{
	use DatabaseMigrations;

    public function testThatCreateBusinessWithoutUserFailed()
    {
        $business = factory(Business::class)->create();
        $user = factory(User::class)->create(['password' => 'password']);

        $businessPayload = [
            'name' => 'Employer', 'country' => 'Nigeria', 'state' => 'Lagos', 
            'timezone' => 'Africa/Lagos', 'currency' => 'NGN'
        ];

        $response = $this->json('POST', '/v1/businesses', $businessPayload, $this->headers($user));

        $response->assertStatus(500);
    }

	public function testCreateBusiness()
    {
        $business = factory(Business::class)->create();
        $user = factory(User::class)->create(['password' => 'password']);

        $businessPayload = [
        	'user_id' => 1, 'name' => 'Employer', 'country' => 'Nigeria', 'state' => 'Lagos', 
            'timezone' => 'Africa/Lagos', 'currency' => 'NGN'
        ];

        $response = $this->json('POST', '/v1/businesses', $businessPayload, $this->headers($user));

        $response->assertStatus(201);
	}

	public function testUpdateBusiness()
    {
        $user = factory(User::class)->create(['password' => 'password']);
        $business = factory(Business::class)->create();

        $businessPayload = [
            'name' => 'Employer', 'country' => 'Nigeria', 'state' => 'Lagos', 
            'timezone' => 'Africa/Lagos', 'currency' => 'NGN'
        ];

        $response = $this->json('PUT', '/v1/users/1/businesses/1', $businessPayload, $this->headers($user));

        $response->assertStatus(204);
	}

	public function testGetBusinesses()
	{
		$user = factory(User::class)->create(['password' => 'password']);

        $response = $this->json('GET', '/v1/businesses', [], $this->headers($user));

        $response->assertJsonStructure([
             'data' => [
                '*' => [
                    'id', 'name', 'country', 'state', 'timezone', 'currency'
                ]
             ]
         ]);
	}

	public function testGetBusinessById()
	{
		$user = factory(User::class)->create(['password' => 'password']);
        $business = factory(Business::class)->create();

        $response = $this->json('GET', '/v1/businesses/'.$business->id, [], $this->headers($user));

        $response->assertJsonStructure([
            'data' => [
            	'id', 'name', 'country', 'state', 'timezone', 'currency'
		    ]
		]);
	}
}
