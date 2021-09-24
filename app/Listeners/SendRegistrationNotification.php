<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Libraries\WA;
use App\Mail\SendMailPsb;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRegistrationNotification
{
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = User::find($event->user['user_id']);
        Mail::to($event->user['email'])->send(new SendMailPsb($user));
        // Send WA Notification
        $wa = new WA($user);
        $wa->notifyPsbRegistration($event->user);
    }
}
