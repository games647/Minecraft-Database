<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Server;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use OpenGraph;
use Twitter;

class ServerController extends Controller {

    //http://regexr.com/3d8n1

    public function index() {
        $servers = Server::where('online', true)->orderBy("players", "desc")->paginate(5);
        return view('index', ['servers' => $servers]);


        OpenGraph::addImage("favicon.ico"); // add image url
        OpenGraph::setTitle("Minecraft-Database"); // define title
        OpenGraph::setDescription("Database for Minecraft Servers");  // define description
        OpenGraph::setUrl(url("/")); // define url
        OpenGraph::setSiteName("Minecraft-Database");
        OpenGraph::generate();


        Twitter::setType("summary"); // type of twitter card tag
        Twitter::setTitle("Minecraft-Database");
        Twitter::setDescription("Database for Minecraft Servers"); // description of twitter card tag
        Twitter::setUrl(url('/')); // url of twitter card tag
        Twitter::addImage("favicon.ico"); // add image url
        Twitter::generate();
    }

    public function addServer(Request $request) {
        $rules = array(
            'address' => array('required', 'Between:4,32', 'regex:' . Server::SERVER_REGEX),
            'g-recaptcha-response' => 'required|recaptcha',
        );

        if (env('APP_DEBUG')) {
            $debugRules = array(
                'address' => array('required', 'Between:4,32', 'regex:' . Server::SERVER_REGEX),
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
                return view("add")->with(["address" => $address])->withErrors(['Server already exists']);
            } else {
                $server = new Server();
                $server->address = $address;
                $server->save();

                \LOG::info("Added server: " . $address);
                \Artisan::call("app:ping", ["address" => $address]);

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
        } else if (preg_match(Server::SERVER_REGEX, $id)) {
            /* @var $server Server */
            $server = Server::where("address", '=', $id)->first();
        } else {
            abort(400, "Invalid search");
        }

        if ($server) {

            OpenGraph::addImage("/img/favicons/" .  $server->address . ".png"); // add image url
            OpenGraph::setTitle($server->address . " Minecraft-Database"); // define title
            OpenGraph::setDescription($server->getPlainMotd());  // define description
            OpenGraph::setUrl(url("/server/" . $server->address)); // define url
            OpenGraph::setSiteName($server->address . " Minecraft-Database");


            return view("server", ['server' => $server]);
        } else {
            return response()->view("notFound", ['address' => $id], 404);
        }
    }
}
