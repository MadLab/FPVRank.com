<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlickoValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('glicko_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rating');
            $table->string('rd');
            $table->string('volatility');
            $table->string('mu')->nullable();
            $table->string('phi')->nullable();
            $table->string('sigma')->nullable();
            $table->string('systemconstant');
            $table->string('pi2');
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
        Schema::dropIfExists('glicko_values');
    }
}
