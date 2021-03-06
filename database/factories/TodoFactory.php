<?php

use App\Todo;
use Faker\Generator as Faker;

$factory->define(Todo::class, function (Faker $faker) {
    return [
        'text' => $faker->sentence(5),
        'done' => $faker->boolean
    ];
});
