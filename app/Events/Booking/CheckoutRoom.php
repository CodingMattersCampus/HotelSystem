<?php

declare(strict_types = 1);

namespace App\Events\Booking;

use App\Models\Booking\Booking;
use App\Models\Room\Room;
use App\Models\User\Employee;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

final class CheckoutRoom
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $booking;
    protected $room;
    protected $employee;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, Room $room, Employee $employee)
    {
        $this->booking  = $booking;
        $this->room     = $room;
        $this->employee = $employee;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
