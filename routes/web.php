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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::patch('bookmarks/{id}', 'BookmarksController@partialUpdate');

    Route::resource('categories', 'CategoriesController');
});

// only home and viewing bookmarks should be accessible to logged in users
Route::get('/', 'DiscoverController@index');
Route::get('/discover', 'DiscoverController@index');
Route::resource('bookmarks', 'BookmarksController');
Route::get('users/{id}/bookmarks', 'UsersController@bookmarks');