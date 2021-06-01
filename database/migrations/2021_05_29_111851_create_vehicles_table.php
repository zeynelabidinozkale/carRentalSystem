<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->unsignedTinyInteger('seats')->nullable();
            $table->unsignedTinyInteger('bags')->nullable();
            $table->unsignedTinyInteger('doors')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedDecimal('deposit', $precision = 8, $scale = 2);
            $table->unsignedDecimal('cost', $precision = 8, $scale = 2);
            $table->unsignedBigInteger('vclass_id')->nullable();
            $table->unsignedBigInteger('fueltype_id')->nullable();
            $table->unsignedBigInteger('geartype_id')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
