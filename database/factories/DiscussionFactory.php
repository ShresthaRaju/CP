<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Discussion::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(),
        'description'=>$faker->paragraph(),
        'channel_id'=>1,
        'user_id'=>13
    ];
});
