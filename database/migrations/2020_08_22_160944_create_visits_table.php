<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            //wizyta nalezy do jakiegos usera
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('research_id')->unsigned();
            //wizyta nalezy do jakiegos badanie (ma dane badanie)
            $table->foreign('research_id')->references('research_id')->on('research')->onDelete('cascade');

            //numer badania
            $table->bigInteger('research_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
