<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionStore extends BaseModel
{
  protected $table = 'collection_n_store';
  public $timestamp = false;
  protected $fillable = ['collection_id', 'store_id', 'updated_at', 'created_at'];
}
