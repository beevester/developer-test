<?php

use App\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'display_name' => $faker->slug(3),
        'description' => $faker->sentence(6)
    ];
});
