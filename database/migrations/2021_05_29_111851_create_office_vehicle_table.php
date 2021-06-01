<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_vehicle', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('deposit', $precision = 8, $scale = 2);
            $table->unsignedDecimal('cost', $precision = 8, $scale = 2);
            $table->unsignedBigInteger('office_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
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
        Schema::dropIfExists('office_vehicle');
    }
}
