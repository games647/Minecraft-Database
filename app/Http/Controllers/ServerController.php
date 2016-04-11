<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Server;
use App\Http\Controllers\Controller;

class ServerController extends Controller {

    //http://regexr.com/3bl8g
    const SERVER_REGEX = "/^((\w+\.)?\w+\.\w+|((2[0-5]{2}|1[0-9]{2}|[0-9]{1,2})\.){3}(2[0-5]{2}|1[0-9]{2}|[0-9]{1,2}))?$/";

    public function index() {
        $servers = Server::where('online', true)->orderBy("players", "desc")->paginate(5);
        return view('index', ['servers' => $servers]);
    }

    public function addServer(Request $request) {
        $rules = array(
            'address'  => 'required|active_url',
            'address'  => array('required', 'Between:4,32', 'regex:' . self::SERVER_REGEX),
            'g-recaptcha-response' => 'required|recaptcha',
        );

        if (env('APP_DEBUG')) {
            $debugRules = array(
                'address' => 'required|active_url',
                'address' => array('required', 'Between:4,32', 'regex:' . self::SERVER_REGEX),
              //disable the captcha in order to hide the api keys and still be able to test the functionality of this
              //website
//            'g-recaptcha-response' => 'required|recaptcha',
            );
            $validator = \Validator::make($request->input(), $debugRules);
        } else {
            $validator = \Validator::make($request->input(), $rules);
        }


        $address = $request->input("address");
        \Log::debug("Adding server", ["ip" => $request->ip(), "server" => $address]);

        if ($validator->passes()) {
            $exists = Server::where("address", '=', $address)->exists();
            if ($exists) {
//                return redirect()->back()->withInput($request->all())->withErrors(['msg', 'Server already ']);
                return view("add")->with(["address" => $address])->withErrors(['Server already exists']);
            } else {
                $server = new Server();
                $server->address = $address;
                $server->save();

                \LOG::info("Added server: " . $address);
                return \Redirect::action("ServerController@showServer", [$address]);
            }
        } else {
            \Log::error("FAILED ", ["FAILS" => $validator->failed()]);

            return view("add")->with(["address" => $address])->withErrors($validator);
        }
    }

    public function showServer($id) {
        if (is_numeric($id)) {
            $server = Server::find($id);
        } else if (preg_match(self::SERVER_REGEX, $id)) {
            /* @var $server Server */
            $server = Server::where("address", '=', $id)->first();
        } else {
            abort(404, "Invalid search");
        }

        if ($server) {
            return view("server", ['server' => $server]);
        } else {
            return view("notFound", ['address' => $id]);
        }
    }
}
