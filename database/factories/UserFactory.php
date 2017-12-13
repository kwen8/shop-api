<?php

use Faker\Generator as Faker;

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

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
		'created_at' => now(),
		'updated_at' => now(),
		'phone' => $faker->phoneNumber,
		'gender' => $faker->randomElement([0,1,2]),
		'idCardNum' => $faker->creditCardNumber,
		'province' => $faker->country,
		'city' => $faker->city,
		'area' => $faker->address,
		'address' => $faker->address,
		'status' => 0,
		'idCardFront' => $faker->imageUrl(),
		'idCardBack' => $faker->imageUrl()
    ];
});
