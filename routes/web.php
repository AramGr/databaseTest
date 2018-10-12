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

Route::get('/', ['uses'=>'IndexController@show']);

Route::group(['prefix'=>'/catalog'], function() {

    Route::get('/create', ['uses'=>'CatalogController@create']);
    Route::get('/', ['uses'=>'CatalogController@show']);
    Route::get('/category/{name}', ['uses'=>'CatalogController@categoryShow']);
    Route::post('/search', ['uses'=>'CatalogController@searchShow'])->name('search');

});

