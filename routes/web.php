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
Route::get('/', [
    'middleware' => ['auth'],
    'as'         => 'dashboard',
    'uses'       => 'Web\DashboardController@index',
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

    Route::any('/setari', [
        'as'         => 'settings',
        'middleware' => ['auth'],
        'uses'       => 'AuthController@settings',
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
});