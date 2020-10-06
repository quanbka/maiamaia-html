<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/19/18
 * Time: 10:08 AM
 */

namespace App\Http\Controllers\System;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/system/order/index');
    }
}
