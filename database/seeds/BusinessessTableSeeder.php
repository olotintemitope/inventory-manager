<?php

use Illuminate\Database\Seeder;

class BusinessessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Business::class, 3)
           ->create()
           ->each(function ($b) {
                $b->user()->save(factory(App\Model\User::class)->make());
            });
    }
}
