<?php

namespace App\Models;


class Blog extends BaseModel
{
    const TYPE_NORMAL = 'normal';
    const TYPE_ADVANCE = 'advance';
    protected $table = 'blogs';
    protected $fillable = [
        'slug', 'description', 'title',
        'meta_title', 'meta_description', 'meta_keywords', 'content',
        'creator_id', 'modifier_id', 'status', 'category_id', 'icon', 'order', 'type', 'image'
    ];
}
