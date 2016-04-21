<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNameHistoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('name_histories', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('player_id')->unsigned();
            $table->foreign("player_id")->references('id')->on('players')->onDelete('cascade');

            $table->string("name", 16);
            $table->bigInteger("changedToAt");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('name_histories');
    }
}
