<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoyalwatcher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('royalwatcher', function (Blueprint $table) {
            $table->bigIncrements('rid');
            $table->string('royalwatcher')->unique();
            $table->string('password');
            $table->dateTime('created_time');
            $table->dateTime('login_time')->nullable();
            $table->dateTime('modified_time')->nullable();
            $table->integer('status')->default(1);
            $table->integer('role')->default(2);
            $table->integer('loginnum');
            $table->string('ip')->nullable();
            $table->string('ip_region')->nullable();
            $table->string('ip_city')->nullable();
            $table->string('ip_isp')->nullable();
            $table->string('os')->nullable();
            $table->string('browser')->nullable();
            $table->string('phoneinfo')->nullable();
            $table->integer('recycle')->default(1);
            $table->string('avatar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('royalwatcher');
    }
}
