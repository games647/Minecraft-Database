<?php

namespace App\Http\Controllers;

use App\Server;
use App\Skin;
use App\Player;

class ApiController extends Controller {

    public function index() {
        return App\Server::paginate();
    }

    public function getServer($address) {
        return App\Server::whereAddress($address)->firstOrFail();
    }

    public function getIcon($address) {
        return redirect('/img/favicons/' . $address . ".png");
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
