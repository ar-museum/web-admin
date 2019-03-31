<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('exhibit', function (Blueprint $table) {
            $table->unsignedInteger('exposition_id');
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('staff_id');
            $table->increments('exhibit_id');
            $table->string('title')->unique();
            $table->string('short_description', 500);
            $table->string('description', 2000);
            $table->integer('start_year');
            $table->integer('end_year');
            $table->foreign('author_id')
                ->references('author_id')->on('author')
                ->onDelete('cascade');
            $table->string('size', 50);
            $table->foreign('exposition_id')
                ->references('exposition_id')->on('expositions')
                ->onDelete('cascade');
            $table->string('location', 50);
            $table->foreign('staff_id')
                ->references('staff_id')->on('staff')
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
        //
        Schema::dropIfExists('exhibit');
    }
}