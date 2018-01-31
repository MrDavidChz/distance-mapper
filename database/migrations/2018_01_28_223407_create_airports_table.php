<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Name',50);
            $table->string('City',50);
            $table->string('Country',50);
            $table->string('IATA');
            $table->string('ICAO');
            $table->double('Latitude');
            $table->double('Longitude');
            $table->string('Altitude');
            $table->string('Timezone');
            $table->string('DST');
            $table->string('Tz');
            $table->string('Type');
            $table->string('Source');
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
        Schema::dropIfExists('airports');
    }
}
