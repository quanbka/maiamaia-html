<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function doctor($slug) {
        if($slug) {
            return view('frontend.doctor.' . $slug);
        }
    }
}
