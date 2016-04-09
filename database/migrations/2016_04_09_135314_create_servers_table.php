<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id')->unsigned;

            $table->string('address');
            $table->string('motd');
            $table->string('version');
            $table->boolean('online');
            //if the onlinemode check failed
            $table->boolean('onlinemode')->nullable()->default(null);

            $table->smallInteger('players')->unsigned;
            $table->smallInteger('maxplayers')->unsigned;

            $table->smallInteger('ping')->unsigned;

            $table->unique("address");

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('servers');
    }
}
