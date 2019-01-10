<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Blog::class, function (Faker $faker) {

   $id = rand(3,45);
    return [
        'title' => $faker->sentence,
        'description' => $faker->jobTitle,
        'published_date' => $faker->date('y-m-d'),
        'user_id' => $id,
    ];
});

$factory->define(App\Message::class, function (Faker $faker) {
    do{
        $from = rand(1,15);
        $to = rand(1,15);
    }
    while($from == $to);
    return [
        'from' => $from,
        'to' => $to,
        'message' => $faker->sentence,
    ];
});
