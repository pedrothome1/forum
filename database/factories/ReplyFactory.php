<?php

use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'thread_id' => function () {
            return factory(App\Thread::class)->create()->id;
        },
        'body' => $faker->randomHtml()
    ];
});
