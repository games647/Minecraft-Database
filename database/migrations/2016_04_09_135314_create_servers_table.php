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
            $table->string('motd')->nullable();
            $table->string('version')->nullable();
            $table->boolean('online')->nullable();
            //if the onlinemode check failed
            $table->boolean('onlinemode')->nullable()->default(null);

            $table->smallInteger('players')->nullable()->unsigned;
            $table->smallInteger('maxplayers')->nullable()->unsigned;

            $table->smallInteger('ping')->nullable()->unsigned;

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
