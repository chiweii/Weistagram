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



// Route::get('/', '[email protected]');

Auth::routes();

Route::get('/home', 'ProfilesController@index')->name('home');

Route::get('/', 'PostController@index');
Route::get('/p/create','PostController@create')->name('post.create');
Route::post('/p','PostController@store');
Route::get('/p/{post}','PostController@show');

// 限定訪客只能存取頁面10次，有登入的可以60次 時間為1分鐘
// Route::middleware('throttle:10|60,1')->group(function () {
// });

//個人檔案路由
Route::prefix('/profile')->name('profile.')->group(function () {
    Route::get('{user}', 'ProfilesController@index')->name('show');
    Route::get('{user}/edit','ProfilesController@edit')->name('edit');
    Route::patch('{user}', 'ProfilesController@update')->name('update');
});

Route::post('follow/{user}', 'FollowsController@store');

// any wrong route to this
Route::fallback(function () {
    return redirect('/login');
});
