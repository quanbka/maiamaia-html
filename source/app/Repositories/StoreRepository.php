<?php

/**
 * User: Lap Dam
 * Date: 18/11/18
 * Time: 11:38 AM
 */

namespace App\Repositories;

use App\Models\Store;
use App\Models\UserNStore;

class StoreRepository extends BaseRepository {

    const MODEL = Store::class;

    public function query($filter = []) {
        $query = parent::query($filter);
        $tableName = Store::getTableName() . '.';
        if (array_key_exists("category_id", $filter)) {
            $query->where($tableName . 'category_id', '=', $filter['category_id']);
        }
        if (array_key_exists("slug", $filter)) {
            $query->where($tableName . 'slug', '=', $filter['slug']);
        }
        if (array_key_exists("creator_id", $filter)) {
            $query->where($tableName . 'creator_id', '=', $filter['creator_id']);
        }
        if (array_key_exists("modifier_id", $filter)) {
            $query->where($tableName . 'modifier_id', '=', $filter['modifier_id']);
        }
        if (array_key_exists("name", $filter)) {
            $query->where($tableName . 'name', 'LIKE', '%' . $filter['name'] . '%');
        }
        if (array_key_exists("meta_title", $filter)) {
            $query->where($tableName . 'meta_title', 'LIKE', '%' . $filter['meta_title'] . '%');
        }
        if (array_key_exists("meta_description", $filter)) {
            $query->where($tableName . 'meta_description', 'LIKE', '%' . $filter['meta_description'] . '%');
        }
        if (array_key_exists("meta_keywords", $filter)) {
            $query->where($tableName . 'meta_keywords', 'LIKE', '%' . $filter['meta_keywords'] . '%');
        }
        if (array_key_exists("status", $filter)) {
            $query->where($tableName . 'status', '=', $filter['status']);
        }
        if (array_key_exists("description", $filter)) {
            $query->where($tableName . 'description', '=', $filter['description']);
        }
        if (array_key_exists("cash_back_rate_from", $filter)) {
            $query->where($tableName . 'cash_back_rate', '>=', $filter['cash_back_rate_from']);
        }
        if (array_key_exists("cash_back_rate_to", $filter)) {
            $query->where($tableName . 'cash_back_rate', '<=', $filter['cash_back_rate_to']);
        }
        if (array_key_exists("statuses", $filter)) {
            $query->whereIn($tableName . 'status', $filter['statuses']);
        }
        if (array_key_exists("with_user", $filter)) {
            $query->leftJoin('users as creator', 'creator.id', '=', $tableName . 'creator_id');
            $query->select($tableName . '*');
            $query->leftJoin('users as modifier', 'modifier.id', '=', $tableName . 'modifier_id');
            $query->addSelect('creator.name as created_by');
            $query->addSelect('modifier.name as updated_by');
        }
        if (array_key_exists("with_favorite", $filter)) {
            $query->leftJoin('users_n_stores as uns', 'uns.store_id', '=', $tableName . 'id');
            if (array_key_exists("user_id", $filter)) {
                $query->where('uns.user_id', '=', $filter['user_id']);
            }
            if (array_key_exists("store_id", $filter)) {
                $query->where('uns.store_id', '=', $filter['store_id']);
            }
            if (array_key_exists("favorite", $filter)) {
                $query->where('uns.user_id', '=', $filter['favorite']);
            }
            $query->select($tableName . '*');
            $query->addSelect('uns.user_id');
        }
        return $query;
    }

    public function favoriteQuery($filter = []) {
        $query = call_user_func(UserNStore::class . '::query');
        $tableName = UserNStore::getTableName() . '.';
        if (array_key_exists("store_id", $filter)) {
            $query->where($tableName . 'store_id', '=', $filter['store_id']);
        }
        if (array_key_exists("user_id", $filter)) {
            $query->where($tableName . 'user_id', '=', $filter['user_id']);
        }
        return $query;
    }

}
