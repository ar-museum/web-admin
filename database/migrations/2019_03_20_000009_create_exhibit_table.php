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
        Schema::create('exhibits', function (Blueprint $table) {
            $table->increments('exhibit_id');
            $table->unsignedInteger('exposition_id');
            $table->unsignedInteger('author_id');
            $table->unsignedInteger('staff_id');
            $table->unsignedInteger('photo_id');
            $table->unsignedInteger('audio_id');
            $table->unsignedInteger('video_id');

            $table->string('title')->unique();
            $table->string('short_description', 500);
            $table->string('description', 2000);
            $table->integer('start_year');
            $table->integer('end_year');
            $table->string('size', 50);
            $table->string('location', 50);

            $table->foreign('author_id')
                ->references('author_id')->on('authors')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('exposition_id')
                ->references('exposition_id')->on('expositions')
                ->onDelete('cascade');

            $table->foreign('staff_id')
                ->references('staff_id')->on('staff')
                ->onDelete('cascade');

            $table->foreign('photo_id')
                ->references('photo_id')->on('photo')
                ->onDelete('cascade');

            $table->foreign('audio_id')
                ->references('audio_id')->on('audio')
                ->onDelete('cascade');

            $table->foreign('video_id')
                ->references('video_id')->on('video')
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
        Schema::dropIfExists('exhibits');
    }
}