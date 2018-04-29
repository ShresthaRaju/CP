<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Discussion::class, function (Faker $faker) {
    $title=$faker->sentence(3);
    $slug=str_slug($title);
    return [
        'title'=>$title,
        'slug'=>$slug,
        'description'=>$faker->paragraph(),
        'channel_id'=>rand(1, 10),
        'user_id'=>rand(1, 2),
    ];
});
