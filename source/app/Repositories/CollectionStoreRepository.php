<?php
namespace App\Repositories;

use App\Models\CollectionStore;

class CollectionStoreRepository extends BaseRepository{

    const MODEL = CollectionStore::class;

    public function query($filter = []){
      $query = parent::query($filter);
      $tableName = CollectionStore::getTableName(). ".";
      $select = [$tableName.'*'];
      if(array_key_exists('collection_id', $filter)){
        $query->join('stores as s', 's.id', '=', $tableName.'store_id');
        $query->where($tableName.'collection_id', '=', $filter['collection_id']);
        array_push($select, 's.name as s_name');
      }
      if(array_key_exists('delete_collection', $filter)){
        $query->where($tableName.'collection_id', '=', $filter['delete_collection']);
      }
      $query->select($select);
      return $query;
    }
}
