<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->uuid('room');
            $table->dateTime('checkin');
            $table->dateTime('timeout');
            $table->dateTime('checkout')->nullable();
            $table->uuid('checkin_by');
            $table->uuid('checkout_by')->nullable();
            $table->boolean('has_checked_out')->default('false');
            $table->float('rate');
            $table->float('orders')->default(0.00);
            $table->float('penalties')->default(0.00);
            $table->float('taxi_referral_fee')->default(0.00);
            $table->float('transfers')->default(0.00);
            $table->float('extends')->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('bookings');
    }
}
