<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Roles;
use Faker\Generator as Faker;

$factory->define(Roles::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Admin', 'Member'])
    ];
});
