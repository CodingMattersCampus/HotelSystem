<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateRoomRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('room_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('room')->unique();
            $table->float('ST')->default(350.00); // 3 hours
            $table->float('HD')->default(650.00); // 12 hours
            $table->float('WD')->default(950.00); // 24 hours
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
        Schema::dropIfExists('room_rates');
    }
}
