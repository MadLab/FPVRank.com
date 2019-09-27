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
            $table->bigIncrements('resultId');
            $table->bigInteger('eventId');
            $table->unsignedBigInteger('pilotId');
            $table->bigInteger('position');
            $table->string('notes')->nullable();
            $table->timestamps();

            $table->foreign('eventId')->references('eventId')->on('events');
            $table->foreign('pilotId')->references('pilotId')->on('pilots');
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
