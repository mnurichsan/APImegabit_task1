<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $postTitle = $faker->unique()->word();
    return [
        'title' => $postTitle,
        'slug' => Str::slug($postTitle),
        'description' => $faker->text,
        'id_user' => $faker->randomDigit
    ];
});
