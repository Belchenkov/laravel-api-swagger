<?php

use App\Containers\Order\Models\OrderItem;
use Faker\Generator as Faker;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'product_title' => $faker->text(30),
        'price' => $faker->numberBetween(10, 100),
        'quantity' => $faker->numberBetween(1, 5)
    ];
});
