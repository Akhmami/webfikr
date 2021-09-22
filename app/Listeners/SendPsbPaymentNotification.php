<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\PsbEvent;
use App\Libraries\WA;
use App\Mail\SendMailPsb;

class SendPsbPaymentNotification implements ShouldQueue
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
     * @param  PsbEvent  $event
     * @return void
     */
    public function handle(PsbEvent $event)
    {
        Mail::to($event->user['email'])->send(new SendMailPsb($event->user['user_id']));
        // Send WA Notification
        // $wa = new WA($event->user['user_id']);
        // $wa->notifyPsbRegistration($event->user);
    }
}
