<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFav extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fav', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ponyid');
            $table->string('ponyname');
            $table->string('ip');
            $table->dateTime('fav_time');
            $table->dateTime('defav_time')->nullable();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fav');
    }
}
