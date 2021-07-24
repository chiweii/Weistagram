<?php

namespace App\Listeners;

use App\Events\NewFollowerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewFollowerMail;

use Mail;
class NewFollowerNotification
{
    public $queue = 'listeners';
    public $delay = 60;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewFollowerEvent  $event
     * @return void
     */
    public function handle(NewFollowerEvent $event)
    {
        // 寄信通知被追蹤的人
        Mail::to($event->user->email)->send(new NewFollowerMail($event->follower, $event->user));
    }
}
