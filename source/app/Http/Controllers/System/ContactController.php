<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 3/5/2018
 * Time: 4:38 PM
 */

namespace App\Http\Controllers\System;


use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        return view('system.contact.index');
    }
}