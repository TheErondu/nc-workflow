<?php

namespace App\Providers;

use App\Events\EngineerAssignedEvent;
use App\Events\RecordCreatedEvent;
use App\Events\RecordUpdatedEvent;
use App\Events\TicketCreatedEvent;
use App\Events\TicketUpdatedEvent;
use App\Events\UserLoggedIn;
use App\Listeners\EngineerAssignedEventListener;
use App\Listeners\RecordCreatedEventListener;
use App\Listeners\RecordUpdatedEventListener;
use App\Listeners\TicketCreatedListener;
use App\Listeners\TicketUpdatedListener;
use App\Listeners\UserLoggedInListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

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
        'App\Events\SendMail' => [
            'App\Listeners\SendMailFired',
        ],
        UserLoggedIn::class => [
            UserLoggedInListener::class,
        ],
        RecordCreatedEvent::class => [
            RecordCreatedEventListener::class,
        ],
        RecordUpdatedEvent::class => [
            RecordUpdatedEventListener::class,
        ],
        TicketCreatedEvent::class => [
            TicketCreatedListener::class,
        ],
        TicketUpdatedEvent::class => [
            TicketUpdatedListener::class,
        ],

        EngineerAssignedEvent::class => [
            EngineerAssignedEventListener::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
