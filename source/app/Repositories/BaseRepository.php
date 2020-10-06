<?php

/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/17/18
 * Time: 10:41 AM
 */

namespace App\Repositories;

class BaseRepository {


    public function getData($filter = []) {
        $query = $this->query($filter);
        if ($filter['page_size'] != 0) {
            $query->forPage($filter['page_id'], $filter['page_size']);
        }
        return $query->get($filter['columns']);
    }

    public function getCount($filter = []) {
        return $this->query($filter)->count();
    }

    public function paginator($filter = []) {
        $count = $this->getCount($filter);
        $pageSize = $filter['page_size'];
        $pageId = $filter['page_id'];
        $pageCount = ceil($count / $pageSize);
        $hasNext = true;
        if ($pageId == $pageCount) {
            $hasNext = false;
        }
        $paginator = [
            'has_next' => $hasNext,
            'total_count' => $count,
            'page_count' => $pageCount,
            'limit' => (int) $pageSize,
            'off_set' => ($pageId - 1) * $pageSize,
        ];
        return $paginator;
    }
    
    public function query($filter = []) {
        $query = call_user_func(static::MODEL . '::query');
        $tableName = call_user_func(static::MODEL . '::getTableName');;
        if (array_key_exists('create_from', $filter) && $filter['create_from']) {
            $query->where($tableName . '.created_at', '>=', $filter['create_from']);
        }
        if (array_key_exists('create_to', $filter) && $filter['create_to']) {
            $query->where($tableName . '.created_at', '<=', $filter['create_to']);
        }
        if (array_key_exists('update_from', $filter) && $filter['update_from']) {
            $query->where($tableName . '.update_at', '>=', $filter['update_from']);
        }
        if (array_key_exists('update_to', $filter) && $filter['update_to']) {
            $query->where($tableName . '.update_at', '<=', $filter['update_to']);
        }
        if (array_key_exists('id', $filter) && $filter['id']) {
            $query->where($tableName . '.id', '=', $filter['id']);
        }
        if (array_key_exists('ids', $filter)) {
            if (!$filter['ids']) {
                $filter['ids'] = [-1];
            }
            $query->whereIn($tableName . '.id', $filter['ids']);
        }

        if (array_key_exists("orders", $filter)) {
            foreach ($filter["orders"] as $key => $value) {
                $column = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $key));
                $query->orderBy($tableName . '.' . $column, $value == "desc" ? "desc" : "asc" );
            }
        }
        return $query;
    }

}
