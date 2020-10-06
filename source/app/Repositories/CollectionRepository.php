<?php
namespace App\Repositories;

use App\Models\Collection;

class CollectionRepository extends BaseRepository{

    const MODEL = Collection::class;

    public function query($filter = []){
      $query = parent::query($filter);
      $tableName = Collection::getTableName(). ".";
      return $query;
    }
}
