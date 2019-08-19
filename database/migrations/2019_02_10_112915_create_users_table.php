<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('name')->unique();
            $table->boolean('is_active')->default(false);
            $table->string('role');
            $table->rememberToken()->nullable()->unique();
            $table->string('api_token')->nullable()->unique();
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
        Schema::dropIfExists('users');
    }
}
