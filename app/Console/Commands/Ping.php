<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;
use \App\Server;
use \File;
use \Exception;

class Ping extends Command {

    protected $signature = 'app:ping {address?}';
    protected $description = 'Ping all server instances from the database';

    public function handle() {
        $this->info("Pinging server instances");

        $address = $this->argument("address");
        if ($address) {
            $this->info("Pinging server: " . $address);
            $server = Server::where("address", '=', $address)->first();
            if ($server) {
                $this->pingServer($server);
            } else {
                $this->error("Server not in the database");
            }

            return;
        }

        $servers = Server::orderBy("updated_at", "asc")->paginate(250);
        $bar = $this->output->createProgressBar($servers->count());

        /* @var $server \App\Server */
        foreach ($servers as $server) {
            $this->info("Pinging server: " . $server->address);
            $this->pingServer($server);

            $bar->advance();
        }

        $bar->finish();
        $this->output->writeln("");
    }

    function pingServer(Server $server) {
        $address = $server->address;
        $port = Server::DEFAULT_PORT;
        try {
            $this->Get_Minecraft_IP($address, $port);

            //the minecraft ping packets from existing libraries doesn't seem to be fast enough
            $server->ping = self::pingDomain($address, $port);

            $ping = new MinecraftPing($address, $port, 1);
            $result = $ping->Query();

            $this->parsePingData($server, $result);
            $server->save();
        } catch (Exception $exception) {
            $this->error($server->address . " " . $exception->getMessage());

            //Reset the these data online if the server was online before
            if ($server->online || is_null($server->online)) {
                $server->online = 0;
                $server->save();
            }
        } finally {
            if (isset($ping)) {
                $ping->Close();
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
     * @param Server $server
     * @param array $data
     */
    function parsePingData(Server $server, $data) {
        $motd = $data['description'];
        if (is_array($motd)) {
            $motd = \MinecraftJsonColors::convertToLegacy($motd);
        }

        $server->motd = $motd;
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
        if (isset($data['favicon'])) {
            $this->saveIcon($server->address, $data['favicon']);
        }
    }

    function isPremium($playername, $uuid) {
        return self::constructOfflinePlayerUuid($playername) != $uuid;
    }

    /**
     * Generates a offline-mode player UUID.
     *
     * @param $username string
     * @return string
     */
    public static function constructOfflinePlayerUuid($username) {
        //extracted from the java code:
        //new GameProfile(UUID.nameUUIDFromBytes(("OfflinePlayer:" + name).getBytes(Charsets.UTF_8)), name));
        $data = hex2bin(md5("OfflinePlayer:" . $username));
        //set the version to 3 -> Name based md5 hash
        $data[6] = chr(ord($data[6]) & 0x0f | 0x30);
        //IETF variant
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return self::createJavaUuid(bin2hex($data));
    }

    public static function createJavaUuid($striped) {
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

    function pingDomain($domain, $port) {
        //https://stackoverflow.com/questions/9841635/how-to-ping-a-server-port-with-php
        $starttime = microtime(true);
        $file = fsockopen($domain, $port, $errno, $errstr, 1);
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
        if (File::dirname($path) == public_path() . "/img/favicons"
                && (!file_exists($path) || md5_file($path) !== md5($data))) {
            //strip invalid path characters
            file_put_contents($path, $data);
        }
    }

    //extracted from https://github.com/xPaw/PHP-Minecraft-Query/issues/34
    function Get_Minecraft_IP(&$addr, &$port) {
        if (ip2long($addr) !== FALSE) {
            //server address is an ip
            return;
        }

        $port = Server::DEFAULT_PORT;

        $result = dns_get_record('_minecraft._tcp.' . $addr, DNS_SRV);
        if (count($result) > 0) {
            if (isset($result[0]['target'])) {
                $addr = $result[0]['target'];
            }

            if (isset($result[0]['port'])) {
                $port = $result[0]['port'];
            }

            $this->info("Found SRV-Record");
        }
    }
}
