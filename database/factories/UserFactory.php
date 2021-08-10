<?php

use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    return [
        'firstname' => $this->faker->firstname,
        'lastname' => $this->faker->lastname,
        'email' => $this->faker->unique()->safeEmail,
        'password' => Hash::make('password'),
        'role_id' => \App\Models\Role::inRandomOrder()->first()->id
    ];
});

