<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku')->unique();
            $table->string('name');
            $table->integer('brand_id')->default(0);
            $table->integer('stocks')->default(0);
            $table->float('price')->default(0.00);
            $table->float('cost')->default(0.00);
            $table->boolean('orderable')->default(false);
            $table->boolean('consumable')->default(false);
            $table->integer('min_threshold')->default(10);
            $table->integer('max_threshold')->default(5);
            $table->float('profit_margin')->default(0.00);
            $table->integer('set_quantity')->default(0);
            $table->string('set_sku')->nullable();
            $table->string('set_type')->nullable(); //set can be bag/pack/box
            $table->string('for')->default('warehouse'); //same sa RoomType. pero for warehouse/storage/parking
            $table->boolean('has_initial_stocks')->default(true);
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
        Schema::dropIfExists('products');
    }
}
