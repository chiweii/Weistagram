<?php

namespace App\Listeners;

use App\Events\NewFollowerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\NewFollowerMail;

use Mail;
class NewFollowerNotification implements ShouldQueue
{
    // public $connection = 'database'; //任務連接的名稱
    public $queue = 'NewFollower'; //任務發送到隊列的名稱
    public $delay = 10; //任務延遲處理的時間
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

    /**
    * handle failed
    *
    * @param  \App\Events\OrderShipped  $event
    * @param  \Exception  $exception
    * @return void
    */
    public function failed(NewFollowerEvent $event, $exception)
    {
        dd($event,$exception);
    }
}
