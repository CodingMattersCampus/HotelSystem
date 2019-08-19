<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateTaxisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('taxis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plate')->unique();
            $table->string('driver')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->default('white');
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
        Schema::dropIfExists('taxis');
    }
}
