<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_reservations', function (Blueprint $table) {
            $table->id();
            $table->string('reserver', 64);
            $table->integer('area')->unsigned();
            $table->integer('number_of_rooms')->unsigned();
            $table->integer('number_of_bath_rooms')->unsigned();
            $table->integer('has_internet')->unsigned();
            $table->integer('has_parking')->unsigned();
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
        Schema::dropIfExists('house_reservations');
    }
}
