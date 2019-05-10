<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuseumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museum', function (Blueprint $table) {

            $table->increments('museum_id')->unique();
            $table->string('name');
            $table->string('address');
            $table->float('longitude');
            $table->float('latitude');
            $table->time('monday_opening_hour');
            $table->time('monday_closing_hour');
            $table->time('tuesday_opening_hour');
            $table->time('tuesday_closing_hour');
            $table->time('wednesday_opening_hour');
            $table->time('wednesday_closing_hour');
            $table->time('thursday_opening_hour');
            $table->time('thursday_closing_hour');
            $table->time('friday_opening_hour');
            $table->time('friday_closing_hour');
            $table->time('saturday_opening_hour');
            $table->time('saturday_closing_hour');
            $table->time('sunday_opening_hour');
            $table->time('sunday_closing_hour');
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
        Schema::dropIfExists('museum');
    }
}
