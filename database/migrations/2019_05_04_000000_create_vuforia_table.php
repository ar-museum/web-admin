<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVuforiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vuforia', function(Blueprint $table) {
            $table->increments('vuforia_id');

            $table->unsignedInteger('museum_id');

            $table->string('version', 5);

            $table->unsignedInteger('file_id');
            $table->foreign('file_id')
                  ->references('file_id')->on('vuforia_files')
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
        Schema::dropIfExists('vuforia');
    }
}