<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->string('name')->unique();
            $table->string('type')->default('garage');
            $table->integer('blankets')->default(1);
            $table->integer('bedsheets')->default(1);
            $table->integer('pillows')->default(2);
            $table->integer('towels')->default(2);
            $table->string('status')->default('available');
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
        Schema::dropIfExists('rooms');
    }
}
