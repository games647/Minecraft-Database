<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NameResolve extends Command {

    const UUID_URL = "https://api.mojang.com/users/profiles/minecraft/<username>?at=<timestamp>";
    const MULTIPLE_UUID_URL = "https://api.mojang.com/profiles/minecraft";

    protected $signature = 'app:uuid {playerName}';

    protected $description = 'Get the UUID from a playername';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        //
    }
}
