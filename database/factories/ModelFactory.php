<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\User::class, function (Faker\Generator $faker) {

    return [
        'firstname' => $faker->name,
        'lastname' => $faker->name,
        'gender' => $faker->randomElement($array = ['male', 'female']),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
    ];
});

$factory->define(App\Model\Business::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'user_id' => 1,
        'country' => $faker->country,
        'state' => $faker->state,
        'currency' => 'NGN',
        'timezone' => 'Africa/Lagos',
    ];
});

$factory->define(App\Model\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'business_id' => 1,
    ];
});

$factory->define(App\Model\Item::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'category_id' => 1,
        'business_id' => 1,
        'logo_url' => $faker->url,
        'price' => 20,
        'quantity' => 2,
        'vat' => 2,
    ];
});

$factory->define(App\Model\Sale::class, function (Faker\Generator $faker) {

    return [
        'item_id' => 1,
        'business_id' => 1,
        'price' => 20,
        'quantity' => 2,
        'total_quantity' => 2,
        'total_vat' => 2,
        'total_amount' => 40,
        'total_base_amount' => 42,
        'customer_name' => $faker->name,
    ];
});
