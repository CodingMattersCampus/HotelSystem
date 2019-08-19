<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateDrawersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('drawers', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->float('balance')->default(0);
            $table->uuid('cashier');
            $table->dateTime('start_shift');
            $table->dateTime('end_shift')->nullable();
            $table->boolean('remitted')->default(false);
            $table->boolean('logged_out')->default(false);
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
        Schema::dropIfExists('drawers');
    }
}
