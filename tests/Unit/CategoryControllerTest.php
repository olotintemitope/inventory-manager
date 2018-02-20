<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\User;
use App\Model\Category;
use App\Model\Business;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryControllerTest extends TestCase
{
	use DatabaseMigrations;

	public function testCreateCategory()
    {
        $user = factory(User::class)->create(['password' => 'password']);

        $catPayload = [
        	'business_id' => 1, 'name' => 'edited compnay',
        	'description' => 'This is just a description',
        ];

        $response = $this->json('POST', '/v1/categories', $catPayload, $this->headers($user));

        $response->assertStatus(201);
	}

	public function testUpdateCategory()
    {
        $user = factory(User::class)->create(['password' => 'password']);

        $category = factory(Category::class)->create();

        $catPayload = [
            'business_id' => 1, 'name' => 'edited company 2',
            'description' => 'This is just a description 2',
        ];

        $response = $this->json('PUT', '/v1/categories/'.$category->id, $catPayload, $this->headers($user));

        $response->assertStatus(204);
	}

	public function testGetCategories()
	{
		$user = factory(User::class)->create(['password' => 'password']);

        $response = $this->json('GET', '/v1/categories', [], $this->headers($user));

        $response->assertJsonStructure([
             'data' => [
                '*' => [
                    'id', 'name', 'description'
                ]
             ]
         ]);
	}

	public function testGetCategoryById()
	{
        $user = factory(User::class)->create(['password' => 'password']);
        
        $business = factory(Business::class)->create();

        $category = factory(Category::class)->create(['business_id' => $business->id]);

		$catPayload = [
            'business_id' => 1, 'name' => 'edited company 2',
            'description' => 'This is just a description 2',
        ];

        $response = $this->json('GET', '/v1/categories/'.$category->id, [], $this->headers($user));

        $response->assertJsonStructure([
            'data' => [
            	'id', 'name', 'description'
		    ]
		]);
	}
}
