<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dragndrop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dragndrop', function (Blueprint $table) {
            $table->increments('dragndrop_id');
            $table->unsignedInteger('museum_id');
            $table->string('path');
            $table->foreign('museum_id')
                ->references('museum_id')->on('museum')
                ->onDelete('cascade');

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
        Schema::dropIfExists('dragndrop');
    }
}
