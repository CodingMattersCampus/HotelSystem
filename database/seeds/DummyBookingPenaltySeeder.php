<?php

use Illuminate\Database\Seeder;
use App\Models\Booking\Booking;
use App\Models\User\Employee;
use App\Models\Penalty\Penalty;
use App\Models\Booking\BookingPenalty;


class DummyBookingPenaltySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $cashier = Employee::whereUsername('cashier')->first();
        $penalties = Penalty::all();
        factory(Booking::class, 6)->create()
	        ->each(function($booking) use ($cashier,$penalties){
	        	\factory(BookingPenalty::class)->create([
	        		'booking' => $booking->code,
					'penalty' => $penalties->random()->code,
					'cashier' => $cashier->code,
	        	]);
	        });
    }
}
