<?php

use Faker\Generator as Faker;

//use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'Test User',                      // $faker->name,
        'email' => $faker->unique()->safeEmail,     //'user@test.com',
        'password' => Hash::make('test123'),        // secret
        'phone_number' => '12345678',
        'remember_token' => str_random(10),
    ];
});
