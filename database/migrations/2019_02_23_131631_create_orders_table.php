<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->string('sku');
            $table->integer('quantity')->default(0);
            $table->float('price')->default(0.00);
            $table->uuid('cashier');
            $table->uuid('booking');
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
        Schema::dropIfExists('orders');
    }
}
