<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Post;
use App\User;

use App\Events\FollowingNewPost;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');

        //如果有追蹤者
        if(count($users) > 0){
            $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);
            return view('posts.index',compact('posts'));
        }else{

            $users = User::where('id','!=',auth()->user()->id)->inRandomOrder()->limit(5)->get();
            foreach ($users as $key => $user) {
                $users[$key]['follows'] = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
            }
            return view('follows.first_follow_index',compact('users'));
        }
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image'],
            'description' => 'required',
        ]);

        $imagePath = request('image')->store('postsimage','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        //透過user 的 posts relationship 去 create psot
        $status = auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
            'description' => $data['description'],
        ]);

        //建立成功，導到 profile 頁面
        if($status->wasRecentlyCreated){
            foreach (auth()->user()->profile->followers as $key => $user_data) {
                event(new FollowingNewPost($status,auth()->user(),$user_data));
            }

            return redirect()->route('profile.show',['user'=>auth()->user()->id]);
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function show(\App\Post $post){

        $follows = auth()->user()->following->contains($post->user->id);
        // dd($follows);
        return view('posts.show',compact('post','follows'));
    }
}
