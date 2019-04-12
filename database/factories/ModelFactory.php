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

use App\Models\Media;
use Faker\Generator;
use Faker\Provider\Internet;

$factory->define(App\Models\Staff::class, function (Faker\Generator $faker) {
    /*static $password;
    Internet::$freeEmailDomain = array('museum.lc');

    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->freeEmail,
        'password'       => $password ?: $password = bcrypt('parola'),
        'remember_token' => str_random(10),
    ];*/
    return [
        'first_name'     => 'Gigel',
        'last_name'      => 'Popescu',
        'email'          => 'gigel@museum.lc',
        'password'       => bcrypt('parola'),
        'photo_id'       => 1,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Media::class, function (Faker\Generator $faker, $params) {
    return [
        'path' => $params['path'],
    ];
});

$factory->define(App\Models\Photo::class, function (Faker\Generator $faker) {
    return [
        'photo_id' => function () {
            return factory(App\Models\Media::class)->create(['path' => '/resources/Media/Photo/photo1.jpg'])->media_id;
        },
        'width'    => $faker->randomNumber($nbDigits = 3),
        'height'   => $faker->randomNumber($nbDigits = 2),
    ];
});

$factory->define(App\Models\Audio::class, function (Faker\Generator $faker) {
    return [
        'audio_id' => function () {
            return factory(App\Models\Media::class)->create(['path' => '/resources/Media/Audio/audio1.mp3'])->media_id;
        },
        'length'   => $faker->randomFloat(2, 1, 5),
    ];
});

$factory->define(App\Models\Video::class, function (Faker\Generator $faker) {
    return [
        'video_id' => function () {
            return factory(App\Models\Media::class)->create(['path' => '/resources/Media/Video/video1.mp4'])->media_id;
        },
        'length'   => $faker->randomFloat(2, 1, 5),
    ];
});

$factory->define(App\Models\Exposition::class, function (Faker\Generator $faker) {
    return [
        'title'       => 'Carti Mihai Eminescu',
        'description' => 'Cea mai veche carte',
        'museum_id'   => 1,
        'staff_id'    => 1,
        'photo_id'    => 1,
    ];
});

$factory->define(App\Models\Author::class, function (Faker\Generator $faker) {
    return [
        'full_name' => 'Mihai Eminescu',
        'born_year' => '1850',
        'died_year' => '1889',
        'location'  => 'Ipotesti',
        'photo_id'  => 1,
        'staff_id'  => 1,
    ];
});

$factory->define(App\Models\Exhibit::class, function (Faker\Generator $faker) {
    return [
        'title'             => 'Floare albastra',
        'short_description' => 'So deep!',
        'description'       => 'Cea mai splendida poezie ever!',
        'start_year'        => '1873',
        'end_year'          => '2019',
        'size'              => '20x30cm',
        'location'          => 'Iasi',
        'author_id'         => 1,
        'exposition_id'     => 1,
        'staff_id'          => 1,
        'audio_id'          => 2,
        'photo_id'          => 1,
        'video_id'          => 3,
    ];
});


$factory->define(App\Models\Museum::class, function (Faker\Generator $faker) {
    return [
        'museum_id'    => 1,
        'name'         => 'Mihai Eminescu Museum',
        'address'      => 'Copou Iasi',
        'opening_hour' => '08:00:00',
        'closing_hour' => '21:00:00',
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->words[0],
        'staff_id' => 1,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->words[0],
        'staff_id' => 1,
    ];
});

$factory->define(App\Models\ExhibitTag::class, function (Faker\Generator $faker) {
    return [
        'exhibit_id' => 1,
        'tag_id'     => function () {
            return factory(App\Models\Tag::class)->create()->tag_id;
        },
    ];
});

$factory->define(App\Models\ExhibitCategory::class, function (Faker\Generator $faker) {
    return [
        'exhibit_id'  => 1,
        'category_id' => function () {
            return factory(App\Models\Category::class)->create()->category_id;
        },
    ];
});