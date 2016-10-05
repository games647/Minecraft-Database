<?php

namespace App\Http\Controllers;

use App\Player;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;

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

        if (env('APP_DEBUG')) {
            $debugRules = array(
                'name' => array('required', 'regex:' . Player::VALID_USERNAME),
                //disable the captcha in order to hide the api keys and still be able to test the functionality of this
                //website
//            'g-recaptcha-response' => 'required|recaptcha',
            );

            $validator = validator()->make($request->input(), $debugRules);
        } else {
            $validator = validator()->make($request->input(), $rules);
        }

        if ($validator->passes()) {

            $exists = Player::where("name", '=', $name)->exists();
            if ($exists) {
                return view("player.add")->with(["name" => $name])->withErrors(['Player already exists']);
            } else {
                \Artisan::call("app:uuid", ["playerName" => $name]);
                logger()->info("Added player: " . $name . " : ");


                $uuid = Player::where("name", '=', $name)->value("uuid");
                logger()->info("Name: "  . $name . " UUID: " . $uuid);
                \Artisan::call("app:skin", ["uuid" => $uuid]);

                logger()->info("Skin Downloaded: Player:" . $name . " UUID: " . $uuid);
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

        // /home/breuxi/Minecraft-Database/public/

        if (is_file(public_path("/img/skin/$player->uuid.png")) && is_file(public_path("/img/skin/raw/$player->uuid.png"))) {
            $skin_image_size = $this->getFileSize(public_path("/img/skin/$player->uuid.png"));
            $skin_raw_size = $this->getFileSize(public_path("/img/skin/raw/$player->uuid.png"));
        } else {
            $skin_image_size = null;
            $skin_raw_size = null;
        }


        $skin_sizes = array($skin_image_size, $skin_raw_size);

        if ($player) {
            return view("player.player", ['player' => $player, 'skinsize' => $skin_sizes, 'root' => $_SERVER['DOCUMENT_ROOT']]);
        } else {
            return response()->view("player.notFound", ['uuid' => $uuid], 404);
        }
    }

    public function getPlayerByUsername($username) {
        /* @var $player Player */
        $player = Player::where("name", '=', $username)->first();

        if (is_file(public_path("/img/skin/$player->uuid.png")) && is_file(public_path("/img/skin/raw/$player->uuid.png"))) {
            $skin_image_size = $this->getFileSize(public_path("/img/skin/$player->uuid.png"));
            $skin_raw_size = $this->getFileSize(public_path("/img/skin/raw/$player->uuid.png"));
        } else {
            $skin_image_size = null;
            $skin_raw_size = null;
        }


        $skin_sizes = array($skin_image_size, $skin_raw_size);


        if ($player) {
            return view("player.player", ['player' => $player, 'skinsize' => $skin_sizes]);
        } else {
            return response()->view("player.notFound", ['name' => $username], 404);
        }
    }


    public function getFileSize($skinURL) {
        $bytes = File::size($skinURL);

        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' Bytes';
        } elseif ($bytes == 1) {
            return '1 Byte';
        } else {
            return '0 Bytes';
        }
    }
}
