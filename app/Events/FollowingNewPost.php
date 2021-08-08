<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FollowingNewPost implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post_data; //追蹤對象發出新文章
    public $user_data; //追蹤對象資料
    public $following_user_data;

    public function __construct($post_data, $user_data, $following_user_data)    {
        $this->post_data = $post_data;
        $this->user_data = $user_data;
        $this->following_user_data = $following_user_data;
    }

    public function broadcastOn(){
        return new Channel('followingnewpost'.$this->following_user_data->id);
    }

    public function broadcastAs()
    {
        //命名推播的事件
        return 'following-new-post';

    }
}
