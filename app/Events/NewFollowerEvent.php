<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewFollowerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $follower, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($follower, $user)
    {
        $this->follower = $follower; //追蹤者
        $this->user = $user; //被追蹤者
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }
}
