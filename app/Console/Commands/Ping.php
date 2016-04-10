<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

class Ping extends Command {

    const DEFAULT_MINECRAFT_PORT = 25565;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:ping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ping all server instances from the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->info("Pinging server instances");

        $servers = \App\Server::simplePaginate(25);
        /* @var $server \App\Server */
        foreach ($servers as $server) {
            $this->info("Pinging server: " . $server->address);
            try {
                $ping = new MinecraftPing($server->address);
                $result = $ping->Query();

                $this->parsePingData($server, $result);
            } catch (MinecraftPingException $exception) {
                $this->error($server->address . " " . $exception->getMessage());

                //Reset the these data online if the server was online before
                if ($server->online) {
                    $server->online = 0;
                    $server->players = 0;
                    $server->save();
                }
            } finally {
                if (isset($ping)) {
                    $ping->Close();
                }
            }
        }
    }

    /**
     * Contains the following data:
     * version - name (contains the Server name -> Spigot, Sponge, BungeeCord...) - protocol
     * players - max - online - sample (uuid, name)
     * motd
     * favicon
     *
     * @param \App\Server $server
     * @param array $data
     */
    function parsePingData($server, $data) {
        $motd = $data['description'];
        if (!is_array($motd)) {
            $server->motd = $motd;
        }

        $server->version = $data['version']['name'];
        $server->players = $data['players']['online'];
        $server->maxplayers = $data['players']['max'];

        //bungeecord doesn't send this as default
        if (isset($data['players']['sample'])) {
            $first = collect($data['players']['sample'])->first();
            $playername = $first['name'];
            $uuid = $first['id'];
            //by testing if the players have not a offline uuid we assume they have a
            //online/paid Mojang UUID which means it's a onlinemode server
            $server->onlinemode = $this->isPremium($playername, $uuid);
        }

        $server->online = true;
        //the minecraft ping packets from existing libraries doesn't seem to be fast enough
        $server->ping = self::pingDomain($server->address);
        if (isset($data['favicon'])) {
            $this->saveIcon($server->address, $data['favicon']);
        }

        $server->save();
    }

    function isPremium($playername, $uuid) {
        return $this->constructOfflinePlayerUuid($playername) != $uuid;
    }

    /**
     * Generates a offline-mode player UUID.
     *
     * @param $username string
     * @return string
     */
    function constructOfflinePlayerUuid($username) {
        //extracted from the java code:
        //new GameProfile(UUID.nameUUIDFromBytes(("OfflinePlayer:" + name).getBytes(Charsets.UTF_8)), name));
        $data = hex2bin(md5("OfflinePlayer:" . $username));
        //set the version to 3 -> Name based md5 hash
        $data[6] = chr(ord($data[6]) & 0x0f | 0x30);
        //IETF variant
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return $this->createJavaUuid(bin2hex($data));
    }

    function createJavaUuid($striped) {
        //example: 069a79f4-44e9-4726-a5be-fca90e38aaf5
        $components = array(
            substr($striped, 0, 8),
            substr($striped, 8, 4),
            substr($striped, 12, 4),
            substr($striped, 16, 4),
            substr($striped, 20),
        );

        return implode('-', $components);
    }

    function pingDomain($domain) {
        //https://stackoverflow.com/questions/9841635/how-to-ping-a-server-port-with-php
        $starttime = microtime(true);
        $file = fsockopen($domain, self::DEFAULT_MINECRAFT_PORT, $errno, $errstr, 2);
        $stoptime = microtime(true);
        $status = 0;

        if (!$file)
            $status = -1;  // Site is down
        else {
            fclose($file);
            $status = ($stoptime - $starttime) * 1000;
            $status = floor($status);
        }

        return $status;
    }

    function saveIcon($hostname, $favicon) {
        $data = $favicon;
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);

        $path = public_path() . "/img/favicons/$hostname.png";
        //check if it's still the same folder
        if (\File::dirname($path) == public_path() . "/img/favicons"
                && (!file_exists($path) || md5_file($path) !== md5($data))) {
            //strip invalid path characters
            file_put_contents($path, $data);
        }
    }

//    /**
//     * needs enabled-qurey=true
//     *
//     * Contains the following data:
//     * hostname	'A Minecraft Server'	MOTD for the current server
//     * gametype	'SMP'	hardcoded to SMP
//     * game_id	'MINECRAFT'	hardcoded to MINECRAFT
//     * version	'1.2.5'	Server version
//     * plugins	'CraftBukkit on Bukkit 1.2.5-R4.0:
//     * map	'world'	Name of the current map
//     * numplayers	'1'	Number of online players. The string could be parsed to a number.
//     * maxplayers	'20'	Max number of players on the server. The string could be parsed to a number
//     * hostport	'25565'	Server port. The string could be parsed to a number
//     * hostip
//     *
//     * @param \App\Server $server
//     * @param array $data
//     */
//    public function parseQueryData($server, $data) {
//
//    }
}
