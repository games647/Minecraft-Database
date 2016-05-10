<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('skins', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->uuid("profileId");
            $table->string("profileName", 16);

            $table->string("skinUrl");
            $table->string("capeUrl")->nullable();

            $table->boolean("slimModel")->default(0);

            $table->binary("signature");

            //mysql doesn't save milliseconds
            $table->bigInteger("timestamp");

            $table->timestamps();

            $table->index("profileId");
            $table->index("profileName");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('skins');
    }
}
