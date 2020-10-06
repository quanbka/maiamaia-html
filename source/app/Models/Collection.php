<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends BaseModel
{
    const SHOW = 'show';
    const HIDE = 'hide';
    protected $table = 'collection';
    protected $fillable = ['name', 'description', 'meta_title', 'meta_description', 'meta_keyword',
    'show_store', 'show_deal', 'slug', 'status', 'created_at', 'updated_at','store_id'];

    public function storeId(){
      return $this->hasMany('App\Models\CollectionStore');
    }
}
