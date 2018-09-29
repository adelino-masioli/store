<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $price = 10;
    return [
        'sku'              => str_random(4),
        'name'             => $faker->name,
        'slug'             => str_slug($faker->name, '-'),
        'description'      => $faker->paragraph,
        'meta_title'       => $faker->name,
        'meta_description' => $faker->name,
        'meta_keyword'     => $faker->name,
        'price'            => $price,
        'qty'              => 100,
        'configuration_id' => 1,
        'status_id'        => 1
    ];
});
