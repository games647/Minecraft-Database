<?php

namespace App\Http\Controllers;

use App\Console\Commands\Ping;
use App\Player;
use Illuminate\Http\Request;
use App\Server;
use App\Http\Controllers\Controller;

class PlayerController extends Controller {

    public function index() {
        $players = Player::whereNotNull('uuid')->paginate(5);
        return view('player.index', ['players' => $players]);
    }

    public function addPlayer(Request $request) {
        $rules = array(
            'address' => array('required', 'regex:' . Player::VALID_USERNAME),
            'g-recaptcha-response' => 'required|recaptcha',
        );

        $validator = validator()->make($request->input(), $rules);
        if ($validator->passes()) {
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
        } else {
            return view("player.add")->with(["uuid" => $uuid, "name" => $name])->withErrors($validator);
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
}
