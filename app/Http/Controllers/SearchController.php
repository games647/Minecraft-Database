<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function search(Request $request) {
        $search = $request->input('search');
        if (!$search) {
            return view('search.result');
        }

        $rules = array(
            'search' => array('required', 'alpha_num'),
        );

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->passes()) {
            $search = strtolower($request->input('search'));

            $servers = Server::where('address', 'LIKE', "%" . $search . "%")->get();

            return view('search.result', [
                'keyword' => $request->all,
                'servers' => $servers,
            ]);
        } else {
            return view('search.result')->withErrors($validator);
        }
    }
}
