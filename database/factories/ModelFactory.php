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

use App\Models\Staff;
use Faker\Generator;
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


$factory->define(App\Models\Exposition::class, function (Faker\Generator $faker) {
    static $password;
    Internet::$freeEmailDomain = array('museum.lc');

    return [

            'title' => 'Carti Mihai Eminescu',
            'description' => 'Cea mai veche carte',
            'museum_id' => 1,
            'staff_id' => 1,
    ];
});

$factory->define(App\Models\Exhibit::class, function (Faker\Generator $faker){
    return [
        'title' => 'Floare albastra',
        'short_description' => 'So deep!',
        'description' => 'Cea mai splendida poezie ever!',
        'start_year' => '1873',
        'end_year' => '2019',
        'size' => '20x30cm',
        'location' => 'Iasi',
        'author_id' => 1,
        'exposition_id' => 1,
        'staff_id' => 1
    ];
});