<?php
/**
 * Created by LapDam
 */

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function view;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index () {
        return view('system.banner.index',[]);
    }
    

}