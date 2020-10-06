<?php

namespace App\Models;

class Category extends BaseModel
{
    const STATUS_ENABLE = 'enable';
    const STATUS_DISABLE = 'disable';
    const TYPE_STORE = 'store';
    const TYPE_NEWS = 'news';
    const TYPE_HELP = 'help';
    protected $table = 'categories';
    protected $fillable = [
        'name','description', 'meta_title', 'meta_description',
        'slug', 'meta_keywords', 'status', 'config','creator_id','modifier_id', 'type', 'order'
    ];

    public function link() {
        return route('category', ['slug' => $this->slug ]);
    }

    public function posts() {
        return $this->hasMany('App\Models\Blog');
    }
}
