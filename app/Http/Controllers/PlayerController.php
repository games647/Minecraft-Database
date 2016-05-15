<?php

namespace App\Http\Controllers;

use App\Console\Commands\Ping;
use App\Player;
use Illuminate\Http\Request;
use App\Server;
use App\Http\Controllers\Controller;

class PlayerController extends Controller {

    //http://regexr.com/3d8n1
    const PLAYER_REGEX = "\w{2,16}";

    public function index() {
        $players = Player::whereNotNull('uuid')->paginate(5);
        return view('player.index', ['players' => $players]);
    }

    public function addPlayer(Request $request) {

        // TODO Validator

        $name = $request->input("name");
        $uuid = Ping::constructOfflinePlayerUuid($name);
        logger("Adding player", ["name" => $name, "uuid" => $uuid]);

            $exists = Player::where("uuid", '=', $uuid)->exists();
            if ($exists) {
                return view("player.add")->with(["uuid" => $uuid, "name" => $name])->withErrors(['Player already exists']);
            } else {
                $player = new Player();
                $player->uuid = $uuid;
                $player->name = $name;
                $player->save();

                logger()->info("Added player: " . $name . " : " . $uuid);

                return redirect()->action("PlayerController@getPlayerByUUID", [$uuid]);
            }
    }

    public function getAdd($name = "") {
        return view('player.add', ['name' => $name]);
    }

    public function getPlayerByUUID($uuid) {
        /* @var $player Player */
        $player = Player::where("uuid", '=', $uuid)->first();

        if ($player) {
            return view("player.player", ['player' => $player]);
        } else {
            return response()->view("player.notFound", ['uuid' => $uuid], 404);
        }
    }

    public function getPlayerByUsername($username) {
        /* @var $player Player */
        $player = Player::where("name", '=', $username)->first();

        if ($player) {
            return view("player.player", ['player' => $player]);
        } else {
            return response()->view("player.notFound", ['name' => $username], 404);
        }
    }
/*
    public function showPlayer($uuid) {
        if (is_numeric($id)) {
            $server = Server::find($id);
        } else if (preg_match(self::SERVER_REGEX, $id)) {
            /* @var $server Server */ /*
            $server = Server::where("address", '=', $id)->withTrashed()->first();
        } else {
            abort(400, "Invalid search");
        }

        if ($server) {
            return view("server", ['server' => $server]);
        } else {
            return response()->view("notFound", ['address' => $id], 404);
        }
    }
 */

    public function redirectPage(Request $request) {
        $page = $request->input('page');

        $suffix = "";
        if ($page && (int) $page) {
            $suffix = "?page=$page";
        }

        return redirect(url('/player/' . $suffix));
    }
}
