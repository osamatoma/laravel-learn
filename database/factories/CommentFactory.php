<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'comment' => $faker->paragraph,
        'level'   => $faker->numberBetween(1, 3)
    ];
});
