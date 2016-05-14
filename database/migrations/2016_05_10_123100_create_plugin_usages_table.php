<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginUsagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('plugin_usages', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('server_id')->unsigned();
            $table->foreign("server_id")->references('id')->on('servers')->onDelete('cascade');

            $table->string('plugin');
            $table->string('version');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('plugin_usages');
    }
}
