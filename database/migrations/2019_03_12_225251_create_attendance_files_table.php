<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendanceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_files', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('code');
            $table->string('name')->unique();
            $table->string('filepath')->nullable();
            $table->dateTime('from');
            $table->dateTime('to');
            $table->text('contents')->nullable(); //???
            $table->integer('rows')->default(0);
            $table->integer('processed')->default(0);
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
        Schema::dropIfExists('attendance_files');
    }
}
