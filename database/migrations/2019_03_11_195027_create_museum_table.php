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
<<<<<<< HEAD:database/migrations/2019_03_31_195027_create_museum_table.php
            $table->increments('museum_id')->unique();
            $table->string('name');
=======
            $table->increments('museum_id');
            $table->string('name')->unique();
>>>>>>> 3e82024cdda2b841d97fc04e84d14e1a8f887532:database/migrations/2019_03_11_195027_create_museum_table.php
            $table->string('address');
            $table->time('opening_hour');
            $table->time('closing_hour');
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
