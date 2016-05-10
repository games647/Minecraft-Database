<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Server;
use App\Http\Controllers\Controller;

class ServerController extends Controller {

    //http://regexr.com/3d8n1
    const SERVER_REGEX = "/^(([a-zA-Z0-9]|[a-zA-Z0-9][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z0-9]|[A-Za-z0-9][A-Za-z0-9\-]*[A-Za-z0-9])$/";

    public function index() {
        $servers = Server::where('online', true)->whereNotNull('motd')->orderBy("players", "desc")->paginate(5);
        return view('index', ['servers' => $servers]);
    }

    public function addServer(Request $request) {
        $rules = array(
            'address' => array('required', 'Between:4,32', 'regex:' . self::SERVER_REGEX),
            'g-recaptcha-response' => 'required|recaptcha',
        );

        if (env('APP_DEBUG')) {
            $debugRules = array(
                'address' => array('required', 'Between:4,32', 'regex:' . self::SERVER_REGEX),
                    //disable the captcha in order to hide the api keys and still be able to test the functionality of this
                    //website
//            'g-recaptcha-response' => 'required|recaptcha',
            );

            $validator = validator()->make($request->input(), $debugRules);
        } else {
            $validator = validator()-make($request->input(), $rules);
        }


        $address = $request->input("address");
        logger("Adding server", ["ip" => $request->ip(), "server" => $address]);

        if ($validator->passes()) {
            $exists = Server::where("address", '=', $address)->withTrashed()->exists();
            if ($exists) {
                return view("add")->with(["address" => $address])->withErrors(['Server already exists']);
            } else {
                $server = new Server();
                $server->address = $address;
                $server->save();

                logger()->info("Added server: " . $address);

                \Artisan::call("app:ping", ["address" => $address]);

                return redirect()->action("ServerController@showServer", [$address]);
            }
        } else {
            logger()->error("FAILED ", ["FAILS" => $validator->failed()]);

            return view("add")->with(["address" => $address])->withErrors($validator);
        }
    }

    public function getAdd($address = "") {
        return view('add', ['address' => $address]);
    }

    public function showServer($id) {
        if (is_numeric($id)) {
            $server = Server::find($id);
        } else if (preg_match(self::SERVER_REGEX, $id)) {
            /* @var $server Server */
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

    public function redirectPage(Request $request) {
        $page = $request->input('page');

        $suffix = "";
        if ($page && (int) $page) {
            $suffix = "?page=$page";
        }

        return redirect(url('/server/' . $suffix));
    }
}
