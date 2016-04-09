<?php

use Illuminate\Database\Seeder;

class ServerTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        App\Server::create([
            'address' => "example.minecraft.com",
            'motd' => "§6■ ■ ■ §4§lE§a§lxample |-| §4§lEconomy §6■ ■ ■ \n "
            . "§a§lPlots §6■ §b§lmcMMO §6■ §c§lRedstone §6■ §c§lPvP §6■ §e§lMinigames",
            'version' => "Spigot 1.9",
            'online' => 1,
            'onlinemode' => 1,
            'players' => 1000,
            'maxplayers' => 1024,
        ])->save();

        App\Server::create([
            'address' => "example2.minecraft.com",
            'motd' => "§4Offline",
            'version' => "Bungeecord 1.9",
            'online' => 0,
            'onlinemode' => 0,
            'players' => 0,
            'maxplayers' => 1024,
        ])->save();
    }
}
