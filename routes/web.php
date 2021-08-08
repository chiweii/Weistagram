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

// RouteServiceProvider 有定義 user 參數只接受數字

*/
Auth::routes();

Route::middleware('auth')->group(function () {

    //貼文
    Route::get('/', 'PostController@index');
    Route::get('/p/create','PostController@create')->name('post.create');
    Route::post('/p','PostController@store');
    Route::get('/p/{post}','PostController@show');

    //個人檔案
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('{user}', 'ProfilesController@index')->name('show');
        Route::get('{user}/edit','ProfilesController@edit')->name('edit');
        Route::patch('{user}', 'ProfilesController@update')->name('update');
    });

    //追蹤
    Route::post('follow/{user}', 'FollowsController@store');
});
