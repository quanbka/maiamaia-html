<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $registers = \App\Register::orderBy('id', 'desc')->get();
        
        return view('system.index.index', compact('registers'));
    }

    public function user() {
        return view('system.user.index');
    }
}
