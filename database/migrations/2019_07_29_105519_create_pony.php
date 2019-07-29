<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePony extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pony', function (Blueprint $table) {
            $table->bigIncrements('ponyid');
            $table->string('ponyname');
            $table->string('nickname');
            $table->text('intro')->nullable();
            $table->string('avatar')->default('/Public/images/default_avatar.jpg');
            $table->string('password');
            $table->string('last_login_ip')->nullable();
            $table->dateTime('last_login_time')->nullable();
            $table->dateTime('created_time');
            $table->dateTime('modified_time')->nullable();
            $table->integer('recycle')->default(0);
            $table->string('last_login_mobile')->nullable();
            $table->string('last_ip_country')->nullable();
            $table->string('last_ip_region')->nullable();
            $table->string('last_ip_city')->nullable();
            $table->string('last_ip_isp')->nullable();
            $table->string('last_login_os')->nullable();
            $table->string('last_login_phone_info')->nullable();
            $table->string('last_login_browser')->nullable();
            $table->integer('login_num')->default(0);
            $table->integer('fav')->default(0);
            $table->integer('status')->default(1);
            $table->string('type')->default('celestia');
            $table->string('ip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pony');
    }
}
