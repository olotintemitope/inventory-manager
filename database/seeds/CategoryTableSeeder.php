<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Category::class, 3)
           ->create()
           ->each(function ($c) {
                $c->business()->save(factory(App\Model\Business::class)->make());
            });
    }
}
