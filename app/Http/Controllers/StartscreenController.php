<?php

namespace App\Http\Controllers;

use App\Server;
use Illuminate\Http\Request;

class StartscreenController extends Controller {

    public function index() {
        return view('startscreen.index');
    }
}
