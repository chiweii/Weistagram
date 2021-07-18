<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use App\Post;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id',$users)->with('user')->latest()->paginate(5);

        return view('posts.index',compact('posts'));
        // dd($posts);

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
            return redirect()->route('profile.show',['user'=>auth()->user()->id]);
        }else{
            return redirect()->back()->withInput();
        }
    }

    public function show(\App\Post $post){

        $follows = auth()->user()->following->contains(auth()->user()->id);

        return view('posts.show',compact('post','follows'));
    }
}
