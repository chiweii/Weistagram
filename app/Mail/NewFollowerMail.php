<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewFollowerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $follower, $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($follower,$user)
    {
        $this->follower = $follower; //追蹤者
        $this->user = $user; //被追蹤者
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newfollower-email')->with([
            'follower_data' => $this->follower,
            'user_data' => $this->user,
        ]);
    }
}
