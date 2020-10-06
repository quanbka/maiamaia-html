<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/31/2018
 * Time: 3:22 PM
 */

namespace App\Repositories;


use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends BaseRepository
{
    const MODEL = Blog::class;
    public function query($filter = [])
    {
        $columns = ['blogs.id', 'blogs.slug', 'blogs.title', 'blogs.description', 'blogs.order',
            'blogs.meta_title', 'blogs.meta_description', 'blogs.meta_keywords', 'blogs.image',
            'blogs.status', 'blogs.creator_id', 'blogs.modifier_id', 'blogs.content', 'blogs.icon',
            'blogs.category_id', 'Category.name as category_name', 'Modifier.name as modifier_name',
            'Creator.name as creator_name', 'Category.type as category_type'];
        $query = parent::query($filter);
        $query->leftJoin('categories as Category', 'blogs.category_id', '=', 'Category.id');
        $query->leftJoin('users as Creator', 'blogs.creator_id', '=', 'Creator.id');
        $query->leftJoin('users as Modifier', 'blogs.modifier_id', '=', 'Modifier.id');

        if (array_key_exists('category_id', $filter) && $filter['category_id']) {
            $query->where('blogs.category_id', '=', $filter['category_id']);
        }
        if (array_key_exists('type', $filter) && $filter['type']) {
            $query->where('Category.type', '=', $filter['type']);
        }
        if (array_key_exists('status', $filter) && $filter['status']) {
            $query->where('blogs.status', '=', $filter['status']);
        }
        if (array_key_exists('type_article', $filter) && $filter['type_article']) {
            $query->where('blogs.type', '=', $filter['type_article']);
        }
        if (array_key_exists('searchArticle', $filter) && $filter['searchArticle']) {
            $query->where('blogs.title', 'like', '%' . $filter['searchArticle'] . '%');
        }
        if (array_key_exists('slug', $filter) && $filter['slug']) {
            $query->where('blogs.slug', '=', $filter['slug']);
        }
        $query->select($columns);
        if (!array_key_exists('is_update', $filter)) {
            $query->addSelect([DB::raw('IF(`blogs`.`order` IS NOT NULL, `blogs`.`order`, 1000000) as `sortOrder`')]);
            $query->orderBy('sortOrder', 'asc');
        }
        return $query;
    }

    public function baseQuery($filter = [])
    {
        $query = parent::query($filter);

        return $query;
    }



    public function checkSlug($slug, $id = 0) {
        $query= DB::table('blogs')->where('slug', '=', $slug);
        if ($id) {
            $query->where('id', '!=', $id);
        }
        $data = $query->first();
        $retval = true;
        if ($data) {
            $retval = false;
        }
        return $retval;
    }
}