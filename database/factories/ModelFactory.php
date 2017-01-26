<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Post;
use App\User;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'admin' => 1,
        'password' => $password ?: $password = bcrypt('t'),
        'remember_token' => str_random(10),
        'api_token' => str_random(60),
    ];
});


$factory->define(Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'body' => $faker->paragraph(3),
        'user_id' => User::all()->random()->id,
        'image' => $faker->imageUrl(200, 200),
        'active' => $faker->boolean()
    ];
});