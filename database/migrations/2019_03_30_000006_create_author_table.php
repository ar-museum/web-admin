<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author', function (Blueprint $table) {
            $table->increments('author_id');
            $table->string('full_name')->unique();
            $table->integer('born_year');
            $table->integer('died_year');
            $table->string('location');
            $table->unsignedInteger('photo_id');
            $table->foreign('photo_id')
                ->references('photo_id')->on('photo')
                ->onDelete('cascade');
            $table->unsignedInteger('staff_id');
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
        Schema::dropIfExists('author');
    }
}
