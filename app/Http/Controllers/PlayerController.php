<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlayerController extends Controller {

    public function index() {
        $players = Player::whereNotNull('uuid')->paginate(5);
        return view('player.index', ['players' => $players]);
    }

    public function addPlayer(Request $request) {
        $rules = array(
            'name' => array('required', 'regex:' . Player::VALID_USERNAME),
            'g-recaptcha-response' => 'required|recaptcha',
        );

        $name = $request->input("name");

        $validator = validator()->make($request->input(), $rules);
        if ($validator->passes()) {
            logger("Adding player", ["name" => $name]);

            $exists = Player::where("name", '=', $name)->exists();
            if ($exists) {
                return view("player.add")->with(["name" => $name])->withErrors(['Player already exists']);
            } else {
                \Artisan::call("app:uuid", ["playerName" => $name]);

                logger()->info("Added player: " . $name . " : ");
                return redirect()->action("PlayerController@getPlayerByUsername", [$name]);
            }
        } else {
            return view("player.add")->with(["name" => $name])->withErrors($validator);
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
