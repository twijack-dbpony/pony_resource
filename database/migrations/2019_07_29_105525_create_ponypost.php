<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePonypost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponypost', function (Blueprint $table) {
            $table->bigIncrements('postid');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('original_img')->nullable();
            $table->string('water_img');
            $table->mediumtext('content');
            $table->integer('ponyid');
            $table->integer('status')->default(3);
            $table->integer('click')->default(0);
            $table->string('type');
            $table->dateTime('created_time');
            $table->dateTime('modified_time')->nullable();
            $table->integer('recycle')->default(0);
            $table->integer('fav')->default(0);
            $table->integer('comment')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ponypost');
    }
}
