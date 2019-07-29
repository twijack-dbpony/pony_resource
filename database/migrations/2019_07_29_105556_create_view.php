<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('view', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ponyid');
            $table->string('ponyname');
            $table->integer('postid');
            $table->string('ip');
            $table->dateTime('view_time');
            $table->string('os');
            $table->string('browser');
            $table->string('ip_region');
            $table->string('ip_city');
            $table->string('ip_isp');
            $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('view');
    }
}
