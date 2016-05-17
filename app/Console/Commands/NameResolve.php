<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \App\Player;

class NameResolve extends Command {

    const UUID_URL = "https://api.mojang.com/users/profiles/minecraft/<username>";
    const UUID_TIME_URL = "https://api.mojang.com/users/profiles/minecraft/<username>?at=<timestamp>";
    const MULTIPLE_UUID_URL = "https://api.mojang.com/profiles/minecraft";

    protected $signature = 'app:uuid {playerName}';

    protected $description = 'Get the UUID from a playername';

    public function handle() {
        $this->info("Getting UUID");

        $name = $this->argument("playerName");
        $this->downloadUUID($name);
    }

    function downloadUUID($name) {
        $url = str_replace("<username>", $name, self::UUID_URL);

        $request = curl_init();
        curl_setopt($request, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($request, CURLOPT_URL, $url);
        try {
            $response = curl_exec($request);

            $curl_info = curl_getinfo($request);
            if ($curl_info['http_code'] !== 200) {
                $this->error("Return code: " . $curl_info['http_code']);
                return;
            }

            $data = json_decode($response, true);
            $player = new Player();
            $player->uuid = $data['id'];
            $player->name = $data['name'];

            $player->save();
            $this->info("Resolved " . $player);
        } catch (Exception $ex) {
            $this->error($ex);
        } finally {
            curl_close($request);
        }
    }
}
