<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request) {
        $service = $request->get('service');
        return view('frontend.register.register', compact(['service']));
    }

    public function send(Request $request) {
        $dichVu = \App\Models\Blog::find($request->get('id'));
        // \Debugbar::info($dichVu);
        $request->session()->flash('status', 'Task was successful!');
        \App\Register::create($request->all());
        return view('frontend.register.register', compact(['dichVu']));
    }
}
