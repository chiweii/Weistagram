<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Test
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $user)
    {
        // input['name'] ?? 'Sally'
        // $name = $request->input('name', 'Sally');
        // dd($request->input('products.*.name'));
        // dd($request->query('546'));
        // dd($request->query());

        // 如果想要判斷一個值在請求中是否存在，並且不為空，需要使用 filled
        // if ($request->filled('name')) {
        //     //
        // }

        // dd($user);
        // dd($role1);
        if(Auth::check()){
            return $next($request);
        }else{
            // dd($role1,$role2);
            return $next($request);
        }
    }
}
