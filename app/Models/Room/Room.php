<?php

declare(strict_types = 1);

namespace App\Models\Room;

use App\Models\Booking\Booking;
use App\Models\Inventory\Linen;
use App\Models\Inventory\Linen\LinenTransaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

final class Room extends Model
{
    protected $guarded = [];

    public function getRouteKeyName() : string
    {
        return 'code';
    }

    public static function getNameByCode(string $code) : string
    {
        return optional(self::whereCode($code)->first())->name;
    }

    public function getStatus() : string
    {
        return $this->status;
    }

    public function getRates() : array
    {
        $rates = RoomRate::whereRoom($this->code)->first();
        return $rates->toArray();
    }

    public function rates()
    {
        //usabon ra nako later.
        return $this->hasMany(RoomRate::class, 'room', 'code');
    }

    public function getBookedRoomRate() : float
    {
        $booking = Booking::where('room', $this->code)->where('has_checked_out', false)->first();
        return (float) $booking->rate + (float) $booking->transfers;
    }

    public function getTimeRemaining() : string
    {
        $booking = Booking::where('room', $this->code)->where('has_checked_out', false)->first();
        $timeout = new Carbon($booking->timeout, 'Asia/Manila');
        return $timeout->diffForHumans(Carbon::now('Asia/Manila'), true, true, 2);
    }

    /**
     * @param string $status enum 'available' | 'occupied' | 'cleaning' | 'maintenance'
     * @throws InvalidRoomStatus
     */
    public function updateStatusTo(string $status) : void
    {
        $this->status = strtolower($status);
        $this->save();

        RoomTransaction::firstOrCreate([
            'code'      => Uuid::uuid4()->toString(),
            'room'      => $this->code,
            'status'    => $this->status,
        ]);
    }

    public function addLinen(string $slug, int $count = 0)
    {
        $linen = Linen::whereSlug($slug)->first();
        if (! $linen || $count <= 0) {
            return; //if no linen or count is less
        }

        LinenTransaction::create([
            'slug'          => $linen->slug,
            'description'   => 'Transfer linens to room',
            'out'           => $count,
            'on'            => 'stocks',
        ]);

        $linen->addRoomsCount($count);

        LinenTransaction::create([
            'slug'          => $linen->slug,
            'description'   => 'Room inventory on booking',
            'in'            => $count,
            'room'          => $this->name,
            'on'            => 'rooms',
        ]);
    }

    public function toLaundryLinens() : void
    {
        $linens = Linen::all();

        $linens->each(function (Linen $linen) {
            $last = LinenTransaction::where('slug', $linen->slug)
                ->where('room', $this->name)
                ->where('out', 0)->latest()->first();

            if (! $last) {
                return ;
            }

            LinenTransaction::create([
                'slug'        => $linen->slug,
                'description' => 'Transfer to laundry linens',
                'out'         => $last->in,
                'room'        => $this->name,
                'on'          => 'rooms',
            ]);

            $linen->toLaundry($last->in);

            LinenTransaction::create([
                'slug'        => $linen->slug,
                'description' => 'Washing linens',
                'in'          => $last->in,
                'on'          => 'laundry',
            ]);
        });
    }

    public function getTimeOut() : string
    {
        $booking = Booking::where('room', $this->code)->where('has_checked_out', false)->first();
        return $booking->timeout;
    }
}
