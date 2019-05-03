<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', [
    'as' => 'museum_index',
    'uses' => 'Api\IndexController@index',
]);
Route::get('/author', [
    'as' => 'get_all_authors',
    'uses' => 'Api\AuthorController@index',
]);
Route::get('/author/{id}', [
    'as' => 'get_author',
    'uses' => 'Api\AuthorController@getData',
]);
Route::get('/author/{id}/photo', [
    'as' => 'get_author_photo',
    'uses' => 'Api\AuthorController@getPhoto',
]);
