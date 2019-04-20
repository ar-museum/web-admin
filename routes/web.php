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
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', [
    'middleware' => ['auth'],
    'as'         => 'dashboard',
    'uses'       => 'Web\DashboardController@index',
]);

Route::get('/report', [
    'as'         => 'report',
    'uses'       => function() {
        return File::get(public_path() . '/report/index.html');
    },
]);

Route::group([
                 'namespace' => 'Auth',
             ], function () {
    Route::get('/autentificare', [
        'as'   => 'login',
        'uses' => 'LoginController@showLoginForm',
    ]);

    Route::post('/autentificare', [
        'as'   => 'login',
        'uses' => 'LoginController@login',
    ]);

    Route::get('/iesire', [
        'as'         => 'logout',
        'middleware' => ['auth'],
        'uses'       => 'LoginController@logout',
    ]);

    Route::get('/profil', [
        'as'         => 'profile',
        'middleware' => ['auth'],
        'uses'       => 'AuthController@profile',
    ]);

    Route::get('/setari', [
        'as'         => 'settings_view',
        'middleware' => ['auth'],
        'uses'       => 'AuthController@viewSettings',
    ]);

    Route::post('/setari', [
        'as'         => 'settings',
        'middleware' => ['auth'],
        'uses'       => 'AuthController@updateSettings',
    ]);

    Route::post('/setari/schimba-parola', [
        'as'         => 'settings_password',
        'middleware' => ['auth'],
        'uses'       => 'AuthController@settingsPassword',
    ]);

    Route::post('/parola', [
        'as'   => 'reset_pass',
        'uses' => 'ForgotPasswordController@sendResetLinkEmail',
    ]);

    Route::get('/schimba-parola/{code}', [
        'as'   => 'change_pass',
        'uses' => 'ResetPasswordController@showResetForm',
    ]);

    Route::post('/schimba-parola/{token}', [
        'as'   => 'reset_pass',
        'uses' => 'ResetPasswordController@reset',
    ]);

    Route::get('/exhibit', array(
        'as'   => 'exhibit',
        'uses' => 'ExhibitController@index'
    ));

    Route::post('/exhibit/store/{var}', array(
        'as' => 'store-exhibit',
        'uses' => 'ExhibitController@store'
    ));

    Route::get('/exhibit/edit/{var}', array(
        'as' => 'edit-exhibit',
        'uses' => 'ExhibitController@edit'
    ));

    Route::delete('exhibit/delete/{var}',array(
        'as' => 'delete-exhibit',
        'uses' => 'ExhibitController@destroy'
    ));

    Route::get('/author', array(
        'as'   => 'author',
        'uses' => 'AuthorController@index'
    ));

    Route::post('/author/store/{var}', array(
        'as' => 'store-author',
        'uses' => 'AuthorController@store'
    ));

    Route::get('/author/edit/{var}', array(
        'as' => 'edit-author',
        'uses' => 'AuthorController@edit'
    ));

    Route::delete('author/destroy/{var}',array(
        'as' => 'delete-author',
        'uses' => 'AuthorController@destroy'
    ));

    Route::get('/museum', array(
        'as' => 'museum',
        'uses' => 'MuseumController@index'
    ));

    Route::post('museum/store/{var}', array(
        'as' => 'store-museum',
        'uses' => 'MuseumController@store'
    ));

});