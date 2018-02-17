<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Item::class, 5)
           ->create()
           ->each(function ($i) {
                $i->business()->save(factory(App\Model\Business::class)->make());
                $i->category()->save(factory(App\Model\Category::class)->make());
            });
    }
}
