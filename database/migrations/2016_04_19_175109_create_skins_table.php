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

            $table->uuid("profile_id");

            //due name changes the profile name could be different while we want to keep this database entry
            $table->string("profile_name", 16);

            $table->string("skin_url");
            $table->string("cape_url")->nullable();

            $table->boolean("slim_model")->default(0);

            $table->binary("signature");

            //mysql doesn't save milliseconds
            $table->bigInteger("timestamp");

            $table->timestamps();

            $table->index("profile_id");
            $table->index("profile_name");
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
