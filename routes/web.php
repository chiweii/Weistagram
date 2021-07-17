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

// Route::get('/', '[email protected]');

Auth::routes();

Route::get('/home', 'ProfilesController@index')->name('home');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');

Route::get('/p/create','PostController@create')->name('post.create');
// Route::get('/p/{profile}')
