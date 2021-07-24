<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;

use App\User;
use Image;
class ProfilesController extends Controller
{
    // public function __construct(){

    // }
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $postCount = Cache::remember(
            'count.posts.'.$user->id,
            now()->addSeconds(30),
            function() use ($user){
                return $user->posts->count();
        });

        $followersCount = $user->profile->followers->count();
        $followingCount = $user->following->count();

        return view('profiles.index',compact('user', 'follows','postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user->profile);

        return view('profiles.edit',compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update',$user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if(request()->hasFile('image')){
            $imagePath = request('image')->store('profileimage','public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            auth()->user()->profile->update(array_merge(
                $data,['image' => $imagePath]
            ));
        }else{
            auth()->user()->profile->update($data);
        }

        return redirect()->route('profile.show',['user'=>$user->id]);
        // dd($data);
    }
}
