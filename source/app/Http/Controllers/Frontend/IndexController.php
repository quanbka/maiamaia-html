<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index() {
        $blogs = \App\Models\Blog::orderBy('order', 'desc')->take(6)->get();
        $whyChooseUsCategory = \App\Models\Category::where('slug', '=', 'why-us')->first();
        $whyChooseUsBlogs = $whyChooseUsCategory->posts()->orderBy('order', 'desc')->get();

        return view('frontend.index.index', compact([
            'blogs', 'whyChooseUsBlogs'
        ]));
    }

    public function search (Request $request) {
        $posts = \App\Models\Blog::where('title', 'like', "%" . $request->input('q') . "%" )->orderBy('order', 'desc')->paginate(12);
        return view('frontend.search.index', compact([
            'posts'
        ]));


    }

    public function about() {
        return view('frontend.index.about');
    }

    public function service() {
        return view('frontend.service.index');
    }

    public function serviceGeneral() {
        return view('frontend.service.general');
    }
}
