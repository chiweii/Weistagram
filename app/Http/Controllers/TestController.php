<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\URL;

class TestController extends Controller
{
    public function test(Request $request){

        // $ref = $request->query('ref');

        // $cookie = Cookie::queue(Cookie::make('1213', 'dfgdfgdfh', 10));

        // dd($cookie);

        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $cookie = cookie('testt', '8888', 5);

        return response('Hello World')->cookie($cookie);
    }
    public function response(){
        // response(content,status)
        // return response('Hello World', 200)
        //               ->withHeaders([
        //             'Content-Type' => 'text/plain',
        //             'X-Header-One' => 'CCW',
        //             'X-Header-Two' => 'Good',
        //         ])->withCookie(cookie('name', 'value'));
        // return response()->json(User::all()->random(1));
        // return response()->file('storage/postsimage/9qU6wBBrCeNQ45YwvhBcOyCkIcdBxdCFv8c7kM7g.jpg');
        // return response()->download('storage/postsimage/9qU6wBBrCeNQ45YwvhBcOyCkIcdBxdCFv8c7kM7g.jpg');
        // return response()->streamDownload(function () {
        //     echo file_get_contents("https://github.com/chiweii/weistagram/blob/main/README.md");
        // }, 'laravel-readme.md');
    }
    public function url(){
        $url = action('ProfilesController@index',['user'=>1]);
        dd($url);
        return URL::signedRoute('home', ['user' => 1]);
    }
}
