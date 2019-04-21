<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', [
    'middleware' => ['auth'],
    'as' => 'dashboard',
    'uses' => 'Web\DashboardController@index',
]);

Route::get('/report', [
    'as' => 'report',
    'uses' => function () {
        return File::get(public_path() . '/report/index.html');
    },
]);

Route::get('/exposition', array(
    'middleware' => ['auth'],
    'as' => 'exposition',
    'uses' => 'Web\ExpositionController@index',
));
Route::post('/exposition/add', array(
    'middleware' => ['auth'],
    'uses' => 'Web\ExpositionController@store',
));
Route::post('/exposition/editare/{id}', array(
    'middleware' => ['auth'],
    'as' => 'editare_expozitie',
    'uses' => 'Web\ExpositionController@update',
));
Route::get('/exposition/{id}/sterge', array(
    'uses' => 'Web\ExpositionController@delete'
));

Route::group([
    'namespace' => 'Auth',
], function () {
    Route::get('/autentificare', [
        'as' => 'login',
        'uses' => 'LoginController@showLoginForm',
    ]);

    Route::post('/autentificare', [
        'as' => 'login',
        'uses' => 'LoginController@login',
    ]);

    Route::get('/iesire', [
        'as' => 'logout',
        'middleware' => ['auth'],
        'uses' => 'LoginController@logout',
    ]);

    Route::get('/profil', [
        'as' => 'profile',
        'middleware' => ['auth'],
        'uses' => 'AuthController@profile',
    ]);

    Route::get('/setari', [
        'as' => 'settings_view',
        'middleware' => ['auth'],
        'uses' => 'AuthController@viewSettings',
    ]);

    Route::post('/setari', [
        'as' => 'settings',
        'middleware' => ['auth'],
        'uses' => 'AuthController@updateSettings',
    ]);

    Route::post('/setari/schimba-parola', [
        'as' => 'settings_password',
        'middleware' => ['auth'],
        'uses' => 'AuthController@settingsPassword',
    ]);

    Route::post('/parola', [
        'as' => 'reset_pass',
        'uses' => 'ForgotPasswordController@sendResetLinkEmail',
    ]);

    Route::get('/schimba-parola/{code}', [
        'as' => 'change_pass',
        'uses' => 'ResetPasswordController@showResetForm',
    ]);

    Route::post('/schimba-parola/{token}', [
        'as' => 'reset_pass',
        'uses' => 'ResetPasswordController@reset',
    ]);

});

Route::get('/author', array(
    'as' => 'author',
    'uses' => 'Web\AuthorController@index'
));

Route::get('/create', 'Web\AuthorController@create');
Route::post('/author-store', 'Web\AuthorController@store');

Route::delete('author/delete/{var}', array(
    'as' => 'delete-author',
    'uses' => 'Web\AuthorController@destroy'
));

Route::get('/exhibit', [
    'as' => 'exhibit',
    'uses' => 'Web\ExhibitController@index'
]);

Route::get('/create', 'Web\ExhibitController@create');
Route::post('/exhibit-store', 'Web\ExhibitController@store');

Route::delete('exhibit/delete/{var}', array(
    'as' => 'delete-exhibit',
    'uses' => 'Web\ExhibitController@destroy'
));

Route::get('/museum', 'Web\MuseumController@index');
Route::post('museum/store', 'Web\MuseumController@store');

Route::get('/media', array(
    'as' => 'media',
    'uses' => 'Web\MediaController@index'
));

Route::get('/create','Web\MediaController@create');
Route::post('/store_photo','Web\MediaController@store_photo');
Route::post('/store_audio','Web\MediaController@store_audio');
Route::post('/store_video','Web\MediaController@store_video');

Route::get('media/delete/{var}', array(
    'as' => 'delete-media',
    'uses' => 'Web\MediaController@destroy'
));
Route::get('/exposition/search', 'Web\ExpositionController@search');