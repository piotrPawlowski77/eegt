<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('research_id')->unsigned();
            //badanie ma okreslone godziny
            $table->foreign('research_id')->references('research_id')->on('research')->onDelete('cascade');
            //godzina badania nalezy do okreslonego usera
            //(i tutaj wartosc w tej kolumnie bedzie id usera ktory jesta aktualnie zalogowany z requestu)
            //(default wartosc 0 oznacza ze na ta godzine nie zapisal sie zaden user)
            $table->bigInteger('user_id')->default(0);
            $table->string('hour');
            $table->boolean('availability')->default(true);

            //10-09-2020 update. godzina nalezy do konkretnej wizyty wiec musze miec research code tez tutaj
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
        Schema::dropIfExists('research_hours');
    }
}
