<?php

namespace App\Providers;

use App\Models\FamilyName;
use App\Models\PurchaseRequest;
use App\Models\SubGroup;
use App\Observers\FamilyNameObserver;
use App\Observers\PurchaseRequestObserver;
use App\Observers\SubGroupObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        PurchaseRequest::observe(PurchaseRequestObserver::class);
        SubGroup::observe(SubGroupObserver::class);
        FamilyName::observe(FamilyNameObserver::class);
    }
}
