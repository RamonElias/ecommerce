<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
  return [
    'category_id' => rand(1, 10),
    'description' => $faker->sentence(1),
    'description' => $faker->sentence(7),
    'quantity' => rand(1, 100),
    'price' => rand(100, 100000),
    'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF)),
  ];
});


