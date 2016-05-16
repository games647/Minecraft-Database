<?php

namespace App\Http\Controllers;

use App\Server;
use App\Skin;
use App\Player;
use \App\PluginUsage;
use Illuminate\Support\Facades\View;

class ApiController extends Controller {

    public function serverIndex() {
        return Server::paginate();
    }

    public function playerIndex() {
        return Player::paginate();
    }

    public function getServer($address) {
        return Server::whereAddress($address)->firstOrFail();
    }

    public function getIcon($address) {
        return redirect('/img/favicons/' . $address . ".png");
    }

    public function getPlayerByUUID($uuid) {
        return Player::whereUuid($uuid)->firstOrFail();
    }

    public function getPlayerByName($name) {
        $players = Player::whereName($name)->get();
        if (count($players) == 0) {
            return response('', 404);
        }

        return $players;
    }

    public function getSkinByUUID($uuid) {
        $skin = Skin::whereProfileId($uuid)->firstOrFail();
        return [
            'timestamp' => $skin->timestamp,
            'profileId' => $skin->profile_id,
            'profileName' => $skin->profile_name,
            'skinUrl' => $skin->skin_url,
            'slimMode' => $skin->slim_model,
            'capeUrl' => $skin->cape_url,
            'signature' => base64_encode($skin->signature)
        ];
    }

    public function getSkinByName($name) {
        $skin = Skin::whereProfileName($name)->firstOrFail();
        return [
            'timestamp' => $skin->timestamp,
            'profileId' => $skin->profile_id,
            'profileName' => $skin->profile_name,
            'skinUrl' => $skin->skin_url,
            'slimMode' => $skin->slim_model,
            'capeUrl' => $skin->cape_url,
            'signature' => base64_encode($skin->signature)
        ];
    }

    public function getPlugins() {

    }

    public function getPluginInfo($plugin) {

    }

    public function getPluginUsage($pluginName) {
        return PluginUsage::wherePlugin($pluginName)->count();
    }

    public function stats() {
        $totalServers = Server::count();
        $onlineServers = Server::whereOnline(true)->count();

        $serverPlayers = Server::whereOnline(true)->sum('players');
        $totalServerPlayers = Server::whereOnline(true)->sum('maxplayers');

        $onlineModeServer = Server::whereOnline(true)->whereOnlinemode(1)->count();
        $offlineModeServer = Server::whereOnline(true)->whereOnlinemode(0)->count();
        $unkownModeServer = Server::whereOnline(true)->whereOnlinemode(NULL)->count();

        //todo: server geo
        //server software stats
        //server version stats

        $avgPing = Server::whereOnline(true)->avg('ping');

        $players = Player::count();
        $skins = Skin::count();
        return response()->json(
                        [
                            'totalServers' => $totalServers,
                            'onlineServers' => $onlineServers,
                            'serverPlayers' => $serverPlayers,
                            'totalServerPlayers' => $totalServerPlayers,
                            'onlineModeServer' => $onlineModeServer,
                            'offlineModeServer' => $offlineModeServer,
                            'unkownModeServer' => $unkownModeServer,
                            'avgPing' => $avgPing,
                            'players' => $players,
                            'skins' => $skins
        ]);
    }
}
