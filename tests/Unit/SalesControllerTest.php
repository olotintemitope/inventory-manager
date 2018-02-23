<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Model\User;
use App\Model\Item;
use App\Model\Business;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SalesControllerTest extends TestCase
{
    public function testThatCreateSalesWithoutBusinessFailed()
    {
        $business = factory(Business::class)->create();
        $item = factory(Item::class)->create(['business_id' => $business->id]);
        $user = factory(User::class)->create(['password' => 'password']);

        $salesPayload = [
            [
                'item_id' => $item->id,
                'price' => 50,
                'quantity' => 5,
                'customer_name' => 'Customer 2'
            ]
        ];

        $response = $this->json('POST', '/v1/sales', $salesPayload, $this->headers($user));

        $response->assertStatus(500);
    }

	public function testCreateSales()
    {
        $business = factory(Business::class)->create();
        $item = factory(Item::class)->create(['business_id' => $business->id]);
        $user = factory(User::class)->create(['password' => 'password']);

        $salesPayload = [
            [
                'business_id' => $business->id,
                'item_id' => $item->id,
                'price' => 10,
                'quantity' => 2,
                'customer_name' => 'Customer 2'
            ]
        ];

        $response = $this->json('POST', '/v1/sales', $salesPayload, $this->headers($user));

        $response->assertStatus(201);
	}

	public function testGetSales()
	{
        $business = factory(Business::class)->create();
        $item = factory(Item::class)->create(['business_id' => $business->id]);
		$user = factory(User::class)->create(['password' => 'password']);

        $response = $this->json('GET', '/v1/businesses/'.$business->id.'/sales', [], $this->headers($user));

        $response->assertJsonStructure([
             'data' => [
                '*' => [
                    'id', 'price', 'quantity', 'total_vat', 'total_quantity', 'total_amount',
                    'total_base_amount', 'customer_name', 'item'
                ]
             ]
         ]);
	}
}
