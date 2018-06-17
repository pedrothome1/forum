<?php

use Faker\Generator as Faker;

$factory->define(\App\Thread::class, function (Faker $faker) {
    $title = $faker->unique()->sentence;

    return [
        'title' => $title,
        'slug' => mb_strtolower($title, 'UTF-8'),
        'body' => $faker->text(800),
        'user_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(\App\Category::class)->create()->id;
        }
    ];
});
