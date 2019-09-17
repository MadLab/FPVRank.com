<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('eventId');
            $table->string('name');
            $table->dateTime('date');
            $table->string('classId');
            $table->string('location');
            $table->dateTime('dateRanked')->nullable();
            $table->string('imagePath');
            $table->boolean('imageLocal')->default(1); //to know if image is stored throught json or this site
            $table->timestamps();

            $table->foreign('classId')->references('classId')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
