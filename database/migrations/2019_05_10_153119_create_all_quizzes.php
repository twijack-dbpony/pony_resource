<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllQuizzes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_quizzes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qid');
            $table->integer('type');
            $table->integer('subject');
            $table->text('question');
            $table->text('choices');
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
        Schema::dropIfExists('all_quizzes');
    }
}
