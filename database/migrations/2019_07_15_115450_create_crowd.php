<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrowd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crowd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('modian_order_id');
            $table->string('name');
            $table->string('nickname');
            $table->integer('uid');
            $table->string('phone');
            $table->integer('level');
            $table->integer('number');
            $table->string('address');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('ps')->nullable();
            $table->integer('type');
            $table->decimal('bucks',10,2);
            $table->text('comment')->nullable();
            $table->datetime('paid_at');
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
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
        Schema::dropIfExists('crowd');
    }
}
