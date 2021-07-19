<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\Paymented;
use App\Listeners\CreatePaymentHistory;
use App\Listeners\SendWAPaymentNotification;
use App\Listeners\SendEmailPaymentNotification;
use App\Listeners\SendSMSPaymentNotification;
use App\Listeners\DatabasePaymentNotification;
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
            SendWAPaymentNotification::class,
            SendEmailPaymentNotification::class,
            SendSMSPaymentNotification::class,
            DatabasePaymentNotification::class,
        ],
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
