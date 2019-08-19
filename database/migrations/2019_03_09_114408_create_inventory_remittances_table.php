<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateInventoryRemittancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('inventory_remittances', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->uuid('drawer');
            $table->uuid('cashier');
            $table->string('sku');
            $table->integer('remitted')->default(0);
            $table->integer('remaining');
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
        Schema::dropIfExists('inventory_summaries');
    }
}
