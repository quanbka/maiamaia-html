<?php
/**
 * User: Lap Dam
 * Date: 18/11/18
 * Time: 11:38 AM
 */


namespace App\Repositories;
use App\Models\Category;

class CategoryRepository extends BaseRepository {

    const MODEL = Category::class;

    public function query($filter = [])
    {
        $query = parent::query($filter);
         $tableName = Category::getTableName().'.';
        if (array_key_exists("creator_id", $filter)) {
            $query->where($tableName . 'creator_id', '=', $filter['creator_id']);
        }
        if (array_key_exists("modifier_id", $filter)) {
            $query->where($tableName . 'modifier_id', '=', $filter['modifier_id']);
        }
        if (array_key_exists("name", $filter)) {
            $query->where($tableName . 'name', 'LIKE', '%'.$filter['name'].'%');
        }
        if (array_key_exists("meta_title", $filter)) {
            $query->where($tableName . 'meta_title', 'LIKE', '%' . $filter['meta_title'] . '%');
        }
        if (array_key_exists("meta_description", $filter)) {
            $query->where($tableName . 'meta_description', 'LIKE', '%'.$filter['meta_description'].'%');
        }
        if (array_key_exists("meta_keywords", $filter)) {
            $query->where($tableName . 'meta_keywords', 'LIKE', '%'.$filter['meta_keywords'].'%');
        }
        if (array_key_exists("status", $filter)) {
            $query->where($tableName . 'status', '=', $filter['status']);
        }
        if (array_key_exists("type", $filter)) {
            $query->where($tableName . 'type', '=', $filter['type']);
        }
        if (array_key_exists("description", $filter)) {
            $query->where($tableName . 'description','LIKE', '%'.$filter['description'].'%');
        }
        if (array_key_exists("statuses", $filter)) {
            $query->whereIn($tableName . 'status',$filter['statuses']);
        }
        if (array_key_exists("types", $filter)) {
            $query->whereIn($tableName . 'type', $filter['types']);
        }
        if (array_key_exists("slug", $filter)) {
            $query->where($tableName . 'slug', '=', $filter['slug']);
        }
        if (array_key_exists("with_user", $filter)) {
             $query->leftJoin('users as creator', 'creator.id', '=', $tableName . 'creator_id');
             $query->select($tableName . '*');
             $query->leftJoin('users as modifier', 'modifier.id', '=', $tableName . 'modifier_id');
             $query->addSelect('creator.name as created_by');
             $query->addSelect('modifier.name as updated_by');
        }
        return $query;
    }
}
