<?php

namespace App\Http\Controllers;


use App\Server;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $rules = array(
            'search' => array('required', 'regex:' . Server::SERVER_REGEX),
        );

        $validator = \Validator::make($request->all(), $rules);


        $search = strtolower($request ->input("search"));


        $servers = Server::where('address', 'LIKE', "%" . $search . "%")->get();

        return view('search.result', [
            'keyword' => $search,
            'servers' => $servers,
        ]);

    }
}
