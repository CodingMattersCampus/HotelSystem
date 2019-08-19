<?php

declare(strict_types = 1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

final class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('role');
            $table->date('birthdate')->nullable();
            $table->date('date_employed')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('emergency_contact_person')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('sss')->unique()->nullable();
            $table->string('philhealth')->unique()->nullable();
            $table->string('hdmf')->unique()->nullable();
            $table->string('tin')->unique()->nullable();
            $table->string('image_full_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->rememberToken();
            $table->unique(['first_name', 'middle_name', 'last_name'], 'employee_full_name');
            $table->unique(['first_name', 'middle_name', 'last_name', 'birthdate'], 'unique_employee_record');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('employees');
    }
}
