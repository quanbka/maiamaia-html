<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index($slug) {
        $category = Category::where('slug', '=', $slug)->with('posts')->first();
        if ($category){
            $posts = ($category->posts()->orderBy('order', 'desc')->paginate(12));
            return view('frontend.category.index', compact([
                'category',
                'posts'
            ]));
        }
        else {
            abort(404);
        }

    }

    public function benhLyDaLieu () {
        $category = Category::where('slug', '=', 'benh-ly-da-lieu')->with('posts')->first();
        if ($category){
            $posts = \App\Models\Blog::where('category_id', '>', 169)
            ->where('category_id', '<', 191)
            ->orderBy('order', 'desc')->paginate(12);
            return view('frontend.category.index', compact([
                'category',
                'posts'
            ]));
        }
        else {
            abort(404);
        }
    }

    public function thamMyCongNgheCao () {
        $category = Category::where('slug', '=', 'tham-my-cong-nghe-cao')->with('posts')->first();
        if ($category){
            $posts = \App\Models\Blog::where('category_id', '<', 207)
            ->where('category_id', '>', 190)
            ->orderBy('order', 'desc')->paginate(12);
            return view('frontend.category.index', compact([
                'category',
                'posts'
            ]));
        }
        else {
            abort(404);
        }
    }

}
