<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\Item;
use App\Model\User;
use App\Model\Business;
use App\Model\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemControllerTest extends TestCase
{
	use DatabaseMigrations;

    public function testThatCreateItemWithoutUserFailed()
    {
        $business = factory(Business::class)->create();
        $category = factory(Category::class)->create();

        $user = factory(User::class)->create(['password' => 'password']);

        $itemPayload = [
            'business_id' => $business->id,
            'category_id' => $category->id,
            'name' => 'Mango',
            //'description' => 'This is a mango product',
            'logo_url' => 'required',
            'price' => 500,
            'quantity' => 2
        ];

        $response = $this->json('POST', '/v1/items', $itemPayload, $this->headers($user));

        $response->assertStatus(500);
    }

	public function testCreateItem()
    {
        $business = factory(Business::class)->create();
        $category = factory(Category::class)->create();

        $user = factory(User::class)->create(['password' => 'password']);

        $itemPayload = [
            'business_id' => $business->id,
            'category_id' => $category->id,
            'name' => 'Mango',
            'description' => 'This is a mango product',
            'logo_url' => 'required',
            'price' => 1000,
            'quantity' => 1
        ];

        $response = $this->json('POST', '/v1/items', $itemPayload, $this->headers($user));

        $response->assertStatus(201);
	}

	public function testUpdateItem()
    {
        $business = factory(Business::class)->create();
        $category = factory(Category::class)->create();
        $item = factory(Item::class)->create();

        $user = factory(User::class)->create(['password' => 'password']);

        $itemPayload = [
            'business_id' => $business->id,
            'category_id' => $category->id,
            'name' => 'Mango',
            'quantity' => 2,
        ];

        $response = $this->json('PUT', '/v1/items/1', $itemPayload, $this->headers($user));

        $response->assertStatus(204);
	}

	public function testGetItems()
	{
		$user = factory(User::class)->create(['password' => 'password']);
        $business = factory(Business::class)->create();
        $category = factory(Category::class)->create();
        $item = factory(Item::class)->create([
            'business_id' => $business->id,
            'category_id' => $category->id,
        ]);

        $response = $this->json('GET', '/v1/items', [], $this->headers($user));

        $response->assertJsonStructure([
             'data' => [
                '*' => [
                    'id', 'name', 'description', 'logo_url', 'price', 'quantity'
                ]
             ]
         ]);
	}

	public function testGetItemById()
	{
		$user = factory(User::class)->create(['password' => 'password']);
        $business = factory(Business::class)->create();
        $category = factory(Category::class)->create();
        $item = factory(Item::class)->create([
            'business_id' => $business->id,
            'category_id' => $category->id,
        ]);

        $response = $this->json('GET', '/v1/items/'.$item->id, [], $this->headers($user));

        $response->assertJsonStructure([
            'data' => [
            	'id', 'name', 'description', 'logo_url', 'price', 'quantity'
		    ]
		]);
	}
}
