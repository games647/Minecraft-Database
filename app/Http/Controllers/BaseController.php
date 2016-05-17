<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class BaseController extends Controller {

    public function imprint() {
        return view('imprint');
    }

    public function privacy() {
        return view('privacy');
    }

    public function tos() {
        return view('tos');
    }

    public function git() {
        return "This project is open source. So why don't you just visit: https://github.com/games647/Minecraft-Database";
    }

    public function index() {
        return view('startscreen');
    }
}
