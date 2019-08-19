<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateProductTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('store')->nullable();
            $table->string('sku');
            $table->text('description');
            $table->uuid('user');
            $table->integer('in')->default(0);
            $table->integer('out')->default(0);
            $table->integer('remaining')->default(0);
            $table->string('invoice')->nullable();
            $table->float('price')->default(0.00);
            $table->float('cost')->default(0.00);
            $table->timestamps();
            $table->string('storage')->default('warehouse');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('product_transactions');
    }
}
