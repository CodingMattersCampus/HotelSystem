<?php

use Illuminate\Database\Seeder;
use App\Models\Booking\Booking;
use App\Models\Taxi\Taxi;
use App\Models\Taxi\TaxiBooking;


class DummyTaxiBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \factory(Taxi::class, 5)
        	->create()
        	->each(function($taxi){
        		//create booking with taxis
        		\factory(Booking::class, 5)
        			->create()
        			//tag each booking to one taxibooking
        			->each(function($booking) use ($taxi){
        				\factory(TaxiBooking::class)
        					->create([
        						'booking' => $booking->code,
        						'taxi' 	  => $taxi->plate
        					]);
        			});
        	});
    }
}
