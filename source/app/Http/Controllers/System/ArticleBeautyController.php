<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 3/22/2018
 * Time: 10:26 PM
 */

namespace App\Http\Controllers\System;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

class ArticleBeautyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index () {
        $listCategoryArticle = App::make('categoryService')->query([
            'types' => ['news', 'help'],
            'status' => 'enable',
            'columns' => ['id', 'name']
        ])->get();
        return view('system.article-beauty.index',[
            'listCategory' => $listCategoryArticle
        ]);
    }
}