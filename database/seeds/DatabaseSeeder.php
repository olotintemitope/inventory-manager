<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BusinessessTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ItemTableSeeder::class);
        $this->call(SalesTableSeeder::class);
    }
}
