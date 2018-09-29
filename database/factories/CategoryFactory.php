<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'deep'               => 1,
        'name'               => $faker->name,
        'slug'               => str_slug($faker->name, '-'),
        'description'        => $faker->paragraph,
        'status_id'          => 1,
        'configuration_id'   => 1
    ];
});