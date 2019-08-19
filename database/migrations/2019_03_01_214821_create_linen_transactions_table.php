<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinenTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linen_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('description')->default('item to laundry');
            $table->uuid('user')->nullable();
            $table->integer('in')->default(0);
            $table->integer('out')->default(0);
            $table->string('room')->nullable();
            $table->string('on')->default('stocks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linen_transactions');
    }
}
