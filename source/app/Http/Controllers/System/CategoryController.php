<?php

namespace App\Http\Controllers\System;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($type = 'store') {
        if ($type != Category::TYPE_HELP && $type != Category::TYPE_NEWS && $type != Category::TYPE_STORE) {
            $type = Category::TYPE_STORE;
        }
        return view('system.category.index', [
            'typeCategory' => $type
        ]);
    }
}
