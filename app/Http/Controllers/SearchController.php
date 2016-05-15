<?php

namespace App\Http\Controllers;

use App\Player;
use App\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{

    public function searchServer(Request $request)
    {
        $search = $request->input('search');
        if (!$search) {
            return view('server.searchresult');
        }

        $rules = array(
            'search' => array('required', 'alpha_num'),
        );

        $validator = validator()->make($request->all(), $rules);
        if ($validator->passes()) {
            $search = strtolower($request->input('search'));

            $servers = Server::where('address', 'LIKE', "%" . $search . "%")->get();

            return view('server.searchresult', [
                'keyword' => $search,
                'servers' => $servers,
            ]);
        } else {
            return view('server.searchresult')->withErrors($validator);
        }
    }


    public function searchPlayer(Request $request)
    {

        $search = $request->input('search');
        if (!$search) {
            return view('player.searchresult');
        }

/*
        $uuid_rules = array(
            'search' => array('regex:' . self::UUID_REGEX),
        );
*/
        $validator_uuid = \Validator::make(Input::all(),
            array('search' => array('regex:/[0-9a-f]/')
            )
        );


        //$validator_uuid = validator()->make($request->all(), $uuid_rules);

        if ($validator_uuid->passes()) {
            $search = strtolower($request->input('search'));

            $players = Player::where('uuid', 'LIKE', "%" . $search . "%")->get();

            return view('player.searchresult', [
                'keyword' => $search,
                'players' => $players,
            ]);
        } else {
/*
            $player_rules = array(
                'search' => array('regex:' . self::PLAYER_REGEX),
            );


            $validator_name = validator()->make($request->all(), $player_rules);
*/
            $validator_name = \Validator::make(Input::all(),
                array('search' => array('regex:/\w{2,16}/')
                )
            );
            if ($validator_name->passes()) {
                $search = strtolower($request->input('search'));

                $players = Player::where('name', 'LIKE', "%" . $search . "%")->get();

                return view('player.searchresult', [
                    'keyword' => $search,
                    'players' => $players,
                ]);
            } else {
                //return view('player.searchresult')->withErrors($validator_name);
            }
        }
    }
}
