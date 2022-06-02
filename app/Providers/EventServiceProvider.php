<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\Paymented;
use App\Events\Registered;
use App\Listeners\CreatePaymentHistory;
use App\Listeners\CreateVirtualAccount;
use App\Listeners\SendRegistrationNotification;
use App\Listeners\SendPaymentNotification;
use App\Listeners\DatabasePaymentNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            CreateVirtualAccount::class,
            SendRegistrationNotification::class,
        ],
        Paymented::class => [
            CreatePaymentHistory::class,
            SendPaymentNotification::class,
            // DatabasePaymentNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        #
    }
}
