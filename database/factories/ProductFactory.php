<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName(),
        'price' => $faker->randomElement([10000, 1500, 2000, 3000])
    ];
});
