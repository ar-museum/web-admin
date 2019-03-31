<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Exposition extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('expositions', function (Blueprint $table) {
            $table->increments('exposition_id');
            $table->string('title');
            $table->string('description');
            $table->unsignedInteger('staff_id');
            $table->foreign('staff_id')
                  ->references('staff_id')->on('staff')
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
        //
        Schema::dropIfExists('expositions');
    }
}
