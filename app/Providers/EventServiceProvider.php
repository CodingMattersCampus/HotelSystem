<?php

declare(strict_types = 1);

namespace App\Providers;

use App\Events\Booking\BookedRoom;
use App\Listeners\Booking\BookingRecordCheckInTransaction;
use App\Listeners\Room\RoomCheckInTransaction;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

final class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        BookedRoom::class => [
            BookingRecordCheckInTransaction::class,
            RoomCheckInTransaction::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot() : void
    {
        parent::boot();

        //
    }
}
