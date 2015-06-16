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

$factory->define(Quincalla\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Quincalla\Collection::class, function ($faker) {
    return [
        'name' => $faker->unique()->sentence(2),
        'slug' => $faker->unique()->slug,
    ];
});

$factory->define(Quincalla\Product::class, function ($faker) {
    return [
        'collection_id' => $faker->randomElement([1, 2, 3]),
        'name' => $faker->unique()->sentence(3),
        'slug' => $faker->unique()->slug,
        'description' => $faker->text,
        'picture' => $faker->unique()->md5() .'.png',
        'price' => $faker->randomFloat(2, 10, 200),
    ];
});
