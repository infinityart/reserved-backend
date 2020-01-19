<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Appointment', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('HairdresserID');
            $table->unsignedInteger('ClientID');
            $table->dateTime('ScheduledAt');

            $table->foreign('HairdresserID')
                ->references('ID')->on('Hairdresser')
                ->onDelete('cascade');

            $table->foreign('ClientID')
                ->references('ID')->on('Client')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Appointment');
    }
}
