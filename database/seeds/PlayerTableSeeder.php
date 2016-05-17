<?php

use Illuminate\Database\Seeder;

class PlayerTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Player::create([
            "uuid" => "069a79f444e94726a5befca90e38aaf5",
            "name" => "Notch"
        ])->save();

        App\Player::create([
            "uuid" => "61699b2ed3274a019f1e0ea8c3f06bc6",
            "name" => "Dinnerbone"
        ])->save();

        //this account really exists
        /* @var $changed App\Player */
        $changed = App\Player::create([
            "uuid" => "173d39fd987a4a629673b1a08c1d6dcf",
            "name" => "Invalid"
        ]);

        $changed->save();

        //first name
        App\NameHistory::create([
            "name" => "Anthraaax",
            "player_id" => $changed->id
        ])->save();

        App\NameHistory::create([
            "name" => "Invalid",
            "player_id" => $changed->id,
            "changedToAt" => 1423046970000
        ])->save();
    }
}
