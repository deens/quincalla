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

$factory->define(Quincalla\Entities\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'role'           => $faker->randomElement(['admin', 'customer', 'guest']),
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active'         => $faker->randomElement([true, false]),
    ];
});

$factory->define(Quincalla\Entities\Product::class, function ($faker) {
    return [
        'name'          => $faker->unique()->sentence(3),
        'slug'          => $faker->unique()->slug,
        'description'   => $faker->text,
        'image'         => $faker->unique()->md5().'.png',
        'price'         => $faker->randomFloat(2, 100, 199),
        'compare_price' => $faker->randomFloat(2, 10, 99),
        'vendor'        => $faker->randomElement(['Apple', 'Nike', 'Levis']),
        'type'          => $faker->randomElement(['Cell Phone', 'Pants', 'Shoes']),
        'published'     => $faker->randomElement([true, false]),
    ];
});

$factory->define(Quincalla\Entities\Tag::class, function ($faker) {
    return [
        'name' => $faker->unique()->word(),
    ];
});
