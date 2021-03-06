<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mail;
use App\Mail\RegisterMail;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username','email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot(){
        //啟用 boot 方法
        parent::boot();

        // 如果使用model 的status 是 created user的話 則進入這個function 執行動作
        static::created(function ($user){

            $user->profile()->create([
                'title' => $user->username,
            ]);

            Mail::to($user->email)->send(new RegisterMail());
        });
    }

    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
    }

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function following(){
        return $this->belongsToMany(Profile::class);
    }
}
