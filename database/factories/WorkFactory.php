<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Work::class, function (Faker $faker) {
    return [
        'title' => substr($faker->sentence(2), 0, -1),
        'subtitle' => substr($faker->sentence(2), 0, -1),
        'content' => $faker->paragraph,
        'image' => $faker->url,
    ];
});