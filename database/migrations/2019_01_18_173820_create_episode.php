<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode',function (Blueprint $table){
            $table->increments('id');
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->string('name',255);
            $table->string('source',255);
            $table->integer('click')->default(0);
            $table->text('desc')->nullable();
            $table->string('season',255);
            $table->string('episode',255);
            $table->integer('status')->default(1);
            $table->softDeletes();
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
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
    }
}
