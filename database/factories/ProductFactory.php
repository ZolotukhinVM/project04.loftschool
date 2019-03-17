<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => rand(1, 3),
        'name' => $faker->name,
        'price' => rand(10, 1000),
        'photo' => "example.jpg",
        'description' => $faker->text(500)
    ];
});
