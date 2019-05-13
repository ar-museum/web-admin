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
        Schema::create('authors', function (Blueprint $table) {
            $table->increments('author_id');
            $table->string('full_name');
            $table->text('description', 32000)->nullable();
            $table->integer('born_year')->nullable();
            $table->integer('died_year')->nullable();
            $table->string('location')->nullable();
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
        Schema::dropIfExists('authors');
    }
}
