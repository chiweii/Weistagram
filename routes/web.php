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



// Route::get('/', '[email protected]');

Auth::routes();

Route::get('/home', 'ProfilesController@index')->name('home');

Route::get('/', 'PostController@index');
Route::get('/p/create','PostController@create')->name('post.create');
Route::post('/p','PostController@store');
Route::get('/p/{post}','PostController@show');

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
Route::get('/profile/{user}/edit','ProfilesController@edit')->name('profile.edit');
Route::patch('profile/{user}', 'ProfilesController@update')->name('profile.update');

Route::post('follow/{user}', 'FollowsController@store');

