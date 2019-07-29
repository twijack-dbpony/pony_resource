<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamePony extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_pony', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyinteger('sex');
            $table->tinyinteger('race');
            $table->string('name');
            $table->string('thumb');
            $table->string('desc');
            $table->tinyInteger('own')->default(1);
            $table->tinyInteger('price_type')->default(1);
            $table->string('price')->nullable();
            $table->decimal('star',10,1);
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
        Schema::dropIfExists('game_pony');
    }
}
