<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use App\Events\NewFollowerEvent;

class FollowsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function store(User $user)
    {
        $followResult = auth()->user()->following()->toggle($user->profile);

        // 追蹤者有追蹤才通知，取消追蹤不通知
        if(!empty($followResult['attached'])){

            // $user = 被追蹤的人
            $user = User::where('id',$followResult['attached'][0])->first();

            // $follower = 追蹤的人(登入者)
            $follower = auth()->user();

            event(new NewFollowerEvent($follower, $user));
        }

        return $followResult;
    }
}
