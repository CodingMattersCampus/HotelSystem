<?php

declare(strict_types = 1);

namespace App\Models\Booking;

use App\Models\Inventory\Product;
use App\Models\Penalty\Penalty;
use App\Models\Room\Room;
use App\Models\Taxi\Taxi;
use App\Models\Discount\SeniorCitizen;
use App\Models\Taxi\TaxiBooking;
use App\Models\User\Employee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class Booking extends Model
{
    protected $guarded = [];

    public function code() : string
    {
        return $this->code;
    }

    public function getRouteKeyName()
    {
        return "code";
    }

    public function transaction() : string
    {
        return $this->created_at->format('Ymd') . str_pad((string)$this->id, 4, "0", STR_PAD_LEFT);
    }

    public function room() : string
    {
        return Room::getNameByCode($this->room);
    }

    public function checkInDateTime() : string
    {
        return (new Carbon($this->checkin))->toDayDateTimeString();
    }

    public function checkOutDateTime() : string
    {
        return is_null($this->checkout) ? "" : (new Carbon($this->checkout))->toDayDateTimeString();
    }

    public function rate()
    {
        return $this->rate + $this->transfers;
    }

    public function totalOrders()
    {
        return $this->orders;
    }

    public function totalPenalties()
    {
        return $this->penalties;
    }

    public function checkedInBy() : string
    {
        return Employee::whereCode($this->checkin_by)->first()->fullname ?? "";
    }

    public function checkedOutBy() : string
    {
        return Employee::whereCode($this->checkout_by)->first()->fullname ?? "";
    }

    public function taxiReferral() : string
    {
        return $this->taxi_referral_fee;
    }

    public function taxi() : string
    {
        return optional(TaxiBooking::where(['booking' => $this->code()])->first())->taxi ?? "";
    }

    public function addOrders(Collection $orders)
    {
        if ($orders->count() > 0) {
            $this->update([
                'orders' => $this->totalOrders() + $orders->sum('amount'),
            ]);

            $orders->each(function ($item, $key) {
                $quantity = (int) $item['quantity'];
                $cashier = Auth::guard('booking')->user()->code;

                Order::firstOrCreate([
                    'code'          => Uuid::uuid4()->toString(),
                    'sku'           => $item['sku'],
                    'quantity'      => $quantity,
                    'price'         => $item['price'],
                    'cashier'       => $cashier,
                    'booking'       => $this->code,
                    'created_at'    => $this->created_at,
                ]);

                $product = Product::whereSku($item['sku'])->first();
                $product->deductFromStocks($quantity);

                Product\ProductTransaction::firstOrCreate([
//                    'uuid'          => Uuid::uuid4()->toString(),
                    'sku'           => $product->sku,
                    'description'   => "purchased from booking {$this->transaction()}",
                    'user'          => $cashier,
                    'in'            => 0,
                    'out'           => $quantity,
                    'remaining'     => $product->stocks,
                ]);
            });
        }
    }

    public function withPenalties(Collection $penalties)
    {
        if ($penalties->count() > 0) {
            $this->update([
                'penalties' => $penalties->sum('rate'),
            ]);

            $penalties->each(function ($item, $key) {
                $penalty = Penalty::find($item['id']);
                BookingPenalty::firstOrCreate([
                    'code'      => Uuid::uuid4()->toString(),
                    'cashier'   => Auth::guard('booking')->user()->code,
                    'booking'   => $this->code,
                    'penalty'   => $penalty->code,
                    'rate'      => $penalty->rate,
                ]);
            });
        }
    }

    public function withTaxi(string $plate = null, string $driver = null)
    {
        if (! is_null($plate)) {
            $plate = str_slug($plate, '');
            Taxi::firstOrCreate([
                'plate'     => $plate,
                'driver'    => $driver,
            ]);

            $fee = TaxiBooking::create([
                'code' => Uuid::uuid4()->toString(),
                'booking' => $this->code,
                'taxi' => $plate,
                'referral_fee' => Taxi::REFERRAL_FEE,
            ]);

            self::update([
                'taxi_referral_fee'  => $fee->referral_fee,
            ]);
        }
    }

    public function getNetSalesAttribute()
    {
        return ($this->rate() + $this->totalOrders() + $this->totalPenalties() + $this->extends) - $this->taxiReferral();
    }

    public function extendBook(int $hours = 0, float $fee = 0.00) : void
    {
        //Error siya diri. dili siya ma add ug tarong. -_-
        $this->timeout = Carbon::parse($this->timeout)->addHours($hours);
        $this->extends += $fee;
        $this->save();
    }

    public function changeRoom(Room $room, int $hours = 0, float $fee = 0.00) : void
    {
        $this->room = $room->code;
        $this->timeout = Carbon::parse($this->checkin)->addHours($hours);
        $this->transfers += $fee;
        $this->save();
    }

    public function scDiscount(
        string $sd_id = null,
        string $first_name = null,
        string $middle_name = null,
        string $last_name = null
    ) : void {

        SeniorCitizen::create([
            'booking'     => $this->code,
            'first_name'  => $first_name,
            'middle_name' => $middle_name,
            'last_name'   => $last_name,
            'sc_id'       => $sd_id
        ]);
    }
}
