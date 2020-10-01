<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilots', function (Blueprint $table) {
            $table->bigIncrements('pilotId');
            $table->string('multigpId')->nullable()->unique();
            $table->string('name');
            $table->string('username');
            $table->string('country')->nullable();
            $table->string('imagePath')->nullable();
            $table->boolean('imageLocal')->default(1); //to know if image is stored throught json or this site
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
        Schema::dropIfExists('pilots');
    }
}
