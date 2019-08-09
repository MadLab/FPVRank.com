<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->bigIncrements('rankingId');            
            $table->unsignedBigInteger('eventId');
            $table->unsignedBigInteger('pilotId');
            $table->unsignedBigInteger('classId');
            
            $table->decimal('rating', 50 ,14);            
            $table->decimal('mu', 50 ,14);
            $table->decimal('rd', 50 ,14);
            $table->decimal('sigma', 50 ,14);
            $table->decimal('phi', 50 ,14);
            $table->boolean('current')->default(1);
            
            $table->timestamps();
            $table->foreign('eventId')->references('eventId')->on('events');
            $table->foreign('pilotId')->references('pilotId')->on('pilots');
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
        Schema::dropIfExists('rankings');
    }
}
