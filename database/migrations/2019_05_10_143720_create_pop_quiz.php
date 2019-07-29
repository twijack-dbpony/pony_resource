<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopQuiz extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pop_quiz', function (Blueprint $table) {
            $table->increments('id');
            $table->text('quiz');
            $table->text('right')->nullable();
            $table->text('wrong')->nullable();
            $table->integer('size')->default(10);
            $table->string('subject')->default('all');
            $table->string('type')->default('all');
            $table->integer('status')->default(1);
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('pop_quiz');
    }
}
