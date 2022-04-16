<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reserver', 64);
            $table->string('type', 64);
            $table->string('model', 64);
            $table->string('color', 64);
            $table->boolean('reservation')->default(false);
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
        Schema::dropIfExists('car_reservations');
    }
}
