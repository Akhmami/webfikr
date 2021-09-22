<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\Paymented;
use App\Events\PsbEvent;
use App\Listeners\CreatePaymentHistory;
use App\Listeners\CreateVA;
use App\Listeners\SendPaymentNotification;
use App\Listeners\DatabasePaymentNotification;
use App\Listeners\SendPsbPaymentNotification;
use App\Observers\BillerObserver;
use App\Models\Biller;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Paymented::class => [
            CreatePaymentHistory::class,
            SendPaymentNotification::class,
            DatabasePaymentNotification::class,
        ],
        PsbEvent::class => [
            CreateVA::class,
            SendPsbPaymentNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Biller::observe(BillerObserver::class);
    }
}
