<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChosenTreatmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ChosenTreatment', function (Blueprint $table) {
            $table->unsignedInteger('TreatmentID');
            $table->unsignedInteger('AppointmentID');
            $table->primary(['TreatmentID', 'AppointmentID']);

            $table->foreign('TreatmentID')
                ->references('ID')->on('Treatment')
                ->onDelete('cascade');

            $table->foreign('AppointmentID')
                ->references('ID')->on('Appointment')
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
        Schema::dropIfExists('ChosenTreatment');
    }
}
