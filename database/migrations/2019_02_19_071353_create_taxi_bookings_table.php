<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateTaxiBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('taxi_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code');
            $table->uuid('booking');
            $table->string('taxi');
            $table->float('referral_fee')->default(25.00);
            $table->timestamps();
            $table->unique(['booking', 'taxi'], 'taxi_booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('taxi_bookings');
    }
}
