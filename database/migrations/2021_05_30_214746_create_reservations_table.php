<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('personnel_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->unsignedBigInteger('pick_up_office_id')->nullable();
            $table->unsignedBigInteger('drop_off_office_id')->nullable();
            $table->timestamp('reservation_pick_up_datetime')->nullable();
            $table->timestamp('reservation_drop_off_datetime')->nullable();
            $table->unsignedTinyInteger('days')->nullable();
            $table->timestamp('pick_up_datetime')->nullable();
            $table->timestamp('drop_off_datetime')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
