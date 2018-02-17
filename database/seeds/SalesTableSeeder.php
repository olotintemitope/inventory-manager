<?php

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Sale::class, 5)
           ->create()
           ->each(function ($s) {
                $s->business()->save(factory(App\Model\Business::class)->make());
                $s->item()->save(factory(App\Model\Item::class)->make());
            });
    }
}
