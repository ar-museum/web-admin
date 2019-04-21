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

$factory->define(App\Models\Staff::class, function (Faker\Generator $faker, $params) {
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
        'first_name' => $params['first_name'] ?? 'Gigel',
        'last_name' => $params['last_name'] ?? 'Popescu',
        'email' => $params['email'] ?? 'gigel@museum.lc',
        'password' => !empty($params['email']) ? bcrypt($params['email']) : bcrypt('parola'),
        'photo_id' => $params['photo_id'] ?? 1,
        'remember_token' => $params['remember_token'] ?? str_random(10),
    ];
});

$factory->define(App\Models\Media::class, function (Faker\Generator $faker, $params) {
    return [
        'path' => $params['path'],
    ];
});

$factory->define(App\Models\Photo::class, function (Faker\Generator $faker) {
    return [
        'photo_id' => $params['media_id'] ?? (function () {
                return factory(App\Models\Media::class)->create(['path' => 'uploads/photo/8a4a728eaa296a920c0674868254605b.jpg'])->media_id;
            }),
        'width' => $params['width'] ?? 1920,
        'height' => $params['width'] ?? 1080,
    ];
});

$factory->define(App\Models\Audio::class, function (Faker\Generator $faker) {
    return [
        'audio_id' => $params['media_id'] ?? (function () {
                return factory(App\Models\Media::class)->create(['path' => 'uploads/audio/HDj3GaW9eOrLIT0tV5zaOSAf8cVGMEH93U9vWlIe.mp3'])->media_id;
            }),
        'length' => $params['length'] ?? 1.25,
    ];
});

$factory->define(App\Models\Video::class, function (Faker\Generator $faker) {
    return [
        'video_id' => $params['media_id'] ?? (function () {
                return factory(App\Models\Media::class)->create(['path' => '/resources/uploads/Media/Video/video1.mp4'])->media_id;
            }),
        'length' => $params['length'] ?? 1.25,
    ];
});

$factory->define(App\Models\Exposition::class, function (Faker\Generator $faker, $params) {

    return [
        'title' => $params['title'] ?? 'Carti Mihai Eminescu',
        'description' => $params['description'] ?? 'Cea mai veche carte',
        'museum_id' => $params['museum_id'] ?? 1,
        'photo_id' => $params['photo_id'] ?? 1,
        'staff_id' => $params['staff_id'] ?? 1,
    ];
});

$factory->define(App\Models\Author::class, function (Faker\Generator $faker, $params) {
    return [
        'full_name' => $params['full_name'] ?? 'Mihai Eminescu',
        'born_year' => $paramas['born_year'] ?? '1850',
        'died_year' => $params['died_year'] ??  '1889',
        'location' => $params['location'] ??  'Ipotesti',
        'photo_id' => $params['photo_id'] ?? 1,
        'staff_id' =>$params['staff_id'] ??  1,
    ];
});

$factory->define(App\Models\Exhibit::class, function (Faker\Generator $faker, $params) {
    return [
        'title' => $params['title'] ?? str_random(10),
        'short_description' => $params['short_description'] ?? 'So deep!',
        'description' => $params['description'] ?? 'Cea mai splendida poezie ever!',
        'start_year' => $params['start_year'] ?? '1873',
        'end_year' => $params['end_year'] ?? '2019',
        'size' => $params['size'] ?? '20x30cm',
        'location' => $params['location'] ?? 'Iasi',
        'author_id' => $params['author_id'] ?? 1,
        'exposition_id' => $params['exposition_id'] ?? 1,
        'staff_id' => $params['staff_id'] ?? 1,
        'audio_id' => $params['audio_id'] ?? 2,
        'photo_id' => $params['photo_id'] ?? 1,
        'video_id' => $params['video_id'] ?? 3,
    ];
});


$factory->define(App\Models\Museum::class, function (Faker\Generator $faker, $params) {
    return [
        'name' =>$params['name'] ?? 'Muzeul Mihai Eminescu',
        'address' =>$params['address'] ?? 'Copou Iasi',
        'monday_opening_hour' =>$params['monday_opening_hour'] ?? '00:00:00',
        'monday_closing_hour' => $params['monday_closing_hour'] ??'00:00:00',
        'tuesday_opening_hour' =>$params['tuesday_opening_hour'] ?? '10:00:00',
        'tuesday_closing_hour' => $params['tuesday_closing_hour'] ??'17:00:00',
        'wednesday_opening_hour' =>$params['wednesday_opening_hour'] ?? '10:00:00',
        'wednesday_closing_hour' => $params['wednesday_closing_hour'] ??'17:00:00',
        'thursday_opening_hour' =>$params['thursday_opening_hour'] ?? '10:00:00',
        'thursday_closing_hour' => $params['thursday_closing_hour'] ??'17:00:00',
        'friday_opening_hour' =>$params['friday_opening_hour'] ?? '10:00:00',
        'friday_closing_hour' => $params['friday_closing_hour'] ??'17:00:00',
        'saturday_opening_hour' =>$params['saturday_opening_hour'] ?? '10:00:00',
        'saturday_closing_hour' => $params['saturday_closing_hour'] ??'17:00:00',
        'sunday_opening_hour' =>$params['sunday_opening_hour'] ?? '10:00:00',
        'sunday_closing_hour' => $params['sunday_closing_hour'] ??'17:00:00',
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words[0],
        'staff_id' => 1,
    ];
});

$factory->define(App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words[0],
        'staff_id' => 1,
    ];
});

$factory->define(App\Models\ExhibitTag::class, function (Faker\Generator $faker) {
    return [
        'exhibit_id' => 1,
        'tag_id' => function () {
            return factory(App\Models\Tag::class)->create()->tag_id;
        },
    ];
});

$factory->define(App\Models\ExhibitCategory::class, function (Faker\Generator $faker) {
    return [
        'exhibit_id' => 1,
        'category_id' => function () {
            return factory(App\Models\Category::class)->create()->category_id;
        },
    ];
});