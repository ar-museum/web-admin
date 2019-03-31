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

Route::get('/', function () {
    return view('welcome');
});

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