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

use Faker\Provider\Internet;

$factory->define(App\Models\Staff::class, function (Faker\Generator $faker) {
    static $password;
    Internet::$freeEmailDomain = array('museum.lc');

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->freeEmail,
        'password' => $password ?: $password = bcrypt('parola'),
        'remember_token' => str_random(10),
    ];
});
