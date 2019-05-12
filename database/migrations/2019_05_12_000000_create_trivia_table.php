<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriviaTable extends Migration{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('trivia', function (Blueprint $table) {
            $table->increments('trivia_id');
            $table->string('json_name');
            $table->unsignedInteger('museum_id');
            $table->timestamps();

            $table->foreign('museum_id')
                ->references('museum_id')->on('museum')
                ->onDelete('cascade');
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trivia');
    }
}