<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateCashTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('cash_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->uuid('drawer');
            $table->uuid('booking')->nullable();
            $table->text('description')->nullable();
            $table->float('amount')->nullable();
            $table->float('cash');
            $table->float('change')->default(0.00);
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
        Schema::dropIfExists('cash_transactions');
    }
}
