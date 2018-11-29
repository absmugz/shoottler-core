<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123456'), // secret
        'remember_token' => str_random(10),
    ];
});
