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

Route::get('/exhibit', [
    'as' => 'get_all_exhibits',
    'uses' => 'Api\ExhibitController@index',
]);

Route::get('/exhibit/{id}', [
    'as' => 'get_exhibit',
    'uses' => 'Api\ExhibitController@getData',
]);

Route::get('/exh/rels', [
    'as' => 'get_all_exhibit_relationships',
    'uses' => 'Api\ExhibitController@indexWithRelationships',
]);

Route::get('/exh/rels/{id}', [
    'as' => 'get_exhibit_relationships',
    'uses' => 'Api\ExhibitController@getDataWithRelationships',
]);


Route::get('/exposition', [
    'as' => 'get_all_expositions',
    'uses' => 'Api\ExpositionController@index',
]);

Route::get('/exposition/{id}', [
    'as' => 'get_exposition',
    'uses' => 'Api\ExpositionController@getData',
]);

Route::get('/expo/rels', [
    'as' => 'get_all_expositions_relationships',
    'uses' => 'Api\ExpositionController@indexWithRelationships',
]);

Route::get('/expo/rels/{id}', [
    'as' => 'get_expositions_relationships',
    'uses' => 'Api\ExpositionController@getDataWithRelationships',
]);

Route::get('/tag', [
    'as' => 'get_all_tags',
    'uses' => 'Api\TagController@index',
]);

Route::get('/tag/{id}', [
    'as' => 'get_tag',
    'uses' => 'Api\TagController@getData',
]);

Route::get('/tg/rels', [
    'as' => 'get_all_tag_relationships',
    'uses' => 'Api\TagController@indexWithRelationships',
]);

Route::get('/tg/rels/{id}', [
    'as' => 'get_tag_relationships',
    'uses' => 'Api\TagController@getDataWithRelationships',
]);

Route::get('/category', [
    'as' => 'get_all_category',
    'uses' => 'Api\CategoryController@index',
]);

Route::get('/category/{id}', [
    'as' => 'get_category',
    'uses' => 'Api\CategoryController@getData',
]);

Route::get('/cat/rels', [
   'as' => 'get_all_category_relationships',
   'uses' => 'Api\CategoryController@indexWithRelationships',
]);

Route::get('/cat/rels/{id}', [
    'as' => 'get_category_relationships',
    'uses' => 'Api\CategoryController@getDataWithRelationships',
]);

Route::get('/museum', [
    'as' => 'get_all_museums',
    'uses' => 'Api\MuseumController@index',
]);

Route::get('/museum/{id}', [
    'as' => 'get_museum',
    'uses' => 'Api\MuseumController@getData',
]);

Route::get('/mus/rels', [
    'as' => 'get_all_museums_relationships',
    'uses' => 'Api\MuseumController@indexWithRelationships',
]);

Route::get('/mus/rels/{id}', [
    'as' => 'get_museums_relationships',
    'uses' => 'Api\MuseumController@getDataWithRelationships',
]);