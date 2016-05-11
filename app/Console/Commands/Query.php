<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use \xPaw\MinecraftQuery;
use \xPaw\MinecraftQueryException;
use \App\Server;
use \App\PluginUsage;

class Query extends Command {

    protected $signature = 'app:query {address?}';
    protected $description = 'Ping all server instances from the database';

    public function handle() {
        $this->info("Query server instances");

        $address = $this->argument("address");
        if ($address) {
            $this->info("Query server: " . $address);
            $server = Server::where("address", '=', $address)->first();
            if ($server) {
                $this->queryServer($server);
            } else {
                $this->error("Server not in the database");
            }

            return;
        }

        $servers = Server::whereOnline(true)->get();
        $bar = $this->output->createProgressBar($servers->count());

        /* @var $server \App\Server */
        foreach ($servers as $server) {
            $this->info("Query server: " . $server->address);
            $this->queryServer($server);
            $bar->advance();
        }

        $bar->finish();
        $this->output->writeln("");
    }

    function queryServer(Server $server, $port = 25565) {
        $address = $server->address;
        try {
            $serverId = $server->id;
            PluginUsage::whereServerId($serverId)->delete();

            $query = new MinecraftQuery();

            $query->Connect($address, $port, 1);

            $infoData = $query->GetInfo();
            $playerData = $query->GetPlayers();

            $this->parseQueryData($server, $infoData, $playerData);
            $server->save();
        } catch (MinecraftQueryException $queryException) {
            if ($port === 25565) {
                $this->queryServer($server, Server::DEFAULT_BUNGEE_QUERY_PORT);
            }
        } catch (\Exception $exception) {
            $this->error($exception);
            $this->error($server->address . " " . $exception->getMessage());
        }
    }

    /**
     * needs enabled-qurey=true
     *
     * Contains the following data:
     * HostName	'A Minecraft Server'	MOTD for the current server
     * GameType	'SMP'	hardcoded to SMP
     * GameName	'MINECRAFT'	hardcoded to MINECRAFT
     * Version	'1.2.5'	Server version
     * Plugins	'CraftBukkit on Bukkit 1.2.5-R4.0:
     * Map	'world'	Name of the current map
     * Players	'1'	Number of online players. The string could be parsed to a number.
     * MaxPlayers	'20'	Max number of players on the server. The string could be parsed to a number
     * HostPort	'25565'	Server port. The string could be parsed to a number
     * HostIp
     * RawPlugins
     * Software
     *
     * @param Server $server
     * @param array $infoData
     * @param array $playerData containing only the player names
     */
    function parseQueryData(Server $server, $infoData, $playerData) {
        //ignore everything because we already handle that in the ping part
        $plugins = $infoData['Plugins'];
        if (is_array($plugins) && !empty($plugins)) {
            foreach ($plugins as $plugin) {
                $pluginUsage = new PluginUsage();
                $pluginUsage->server_id = $server->id;

                $components = explode(' ', $plugin);
                $pluginName = $components[0];
                $version = implode(array_slice($components, 1));

                $pluginUsage->plugin = $pluginName;
                $pluginUsage->version = $version;
                $pluginUsage->save();
            }
        }
    }
}
