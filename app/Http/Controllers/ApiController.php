<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

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
        $totalServers = App\Server::count();
        $onlineServers = \App\Server::whereOnline(true)->count();

        $serverPlayers = App\Server::whereOnline(true)->sum('players');
        $totalServerPlayers = App\Server::whereOnline(true)->sum('maxplayers');

        $onlineModeServer = App\Server::whereOnline(true)->whereOnlinemode(1)->count();
        $offlineModeServer = App\Server::whereOnline(true)->whereOnlinemode(0)->count();
        $unkownModeServer = App\Server::whereOnline(true)->whereOnlinemode(NULL)->count();

        //todo: server geo
        //server software stats
        //server version stats

        $avgPing = App\Server::whereOnline(true)->avg('ping');

        $players = App\Player::count();
        $skins = App\Skin::count();
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
