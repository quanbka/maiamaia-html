<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function detail($slug = false) {
        if ($slug == false) {
            $currentUrl =  url()->current();
            $slug = explode("/", $currentUrl)[3];
            switch ($slug) {
                case 'gioi-thieu-phong-kham':
                    $slug = "gioi-thieu-ve-phong-kham";
                    break;
                case 'su-menh-tam-nhin':
                    $slug = "su-menh-tam-nhin-cua-maia-maia";
                    break;
                case 'co-so-vat-chat':
                    $slug = "co-so-vat-chat-thiet-bi-hien-dai";
                    break;

                default:
                    // code...
                    break;
            }
        }
        $blog = \App\Models\Blog::where('slug', '=', $slug)->first();
        $relatedBlogs = \App\Models\Blog::where('category_id', '=', $blog->category_id)->take(10)->get();

        if ($blog){
            if ($blog->type == Blog::TYPE_ADVANCE) {
                return view('frontend.service.detail-advance', compact('blog'));
            }
            return view('frontend.service.detail', compact('blog', 'relatedBlogs'));
        }
        else {
            abort(404);
        }
    }
}
