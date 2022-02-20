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
// use Illuminate\Support\Facades\URL;
// use Illuminate\Http\Response;
// use App\User;
use App\Events\MyEvent;
Auth::routes();

// Route::get('/home', 'ProfilesController@index')->name('home');

// //測試 middleware 傳參數
// Route::get('/middleware_test', 'TestController@test')->middleware('testt:editor');

// //測試 cookie 傳參數
// Route::get('/cookie_test', 'TestController@test')->name('nothing');

// //測試 response 各種應用
// Route::get('/response_test', 'TestController@response');

// Route::get('/url_test', 'TestController@url');
// Route::get('/event',function(){
//     event(new App\Events\FollowingNewPost('how are you!'));
// });

Route::middleware('auth')->group(function () {

    Route::get('/event',function(){
        event(new MyEvent('hello world'));
    });
    Route::get('listen',function(){
        return view('listenbroadcast');
    });
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

    //追蹤人
    Route::post('follow/{user}', 'FollowsController@store');
});


// 限定訪客只能存取頁面10次，有登入的可以60次 時間為1分鐘
// Route::middleware('throttle:10|60,1')->group(function () {
// });


// any wrong route to this
// Route::fallback(function () {
//     return redirect('/login');
// });
