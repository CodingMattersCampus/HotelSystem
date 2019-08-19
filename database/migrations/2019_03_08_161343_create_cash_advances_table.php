<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashAdvancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_advances', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->uuid('drawer');
            $table->uuid('employee');
            $table->float('amount')->nullable();
            $table->text('reason');
            $table->uuid('cashier')->nullable();
            $table->boolean('given')->default(false);
            $table->string('approval')->default('pending');
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
        Schema::dropIfExists('cash_advances');
    }
}
