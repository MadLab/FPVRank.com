<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');            
            $table->unsignedBigInteger('eventId');
            $table->unsignedBigInteger('pilotId');
            $table->string('position');
            $table->string('notes');
            $table->timestamps();

            $table->foreign('eventId')->references('id')->on('events');
            $table->foreign('pilotId')->references('id')->on('pilots');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
