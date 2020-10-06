<?php
/**
 * User: Lap Dam
 * Date: 18/11/18
 * Time: 11:38 AM
 */


namespace App\Repositories;
use App\Models\Deal;

class DealRepository extends BaseRepository {

    const MODEL = Deal::class;

    public function query($filter = [])
    {
        $query = parent::query($filter);
         $tableName = Deal::getTableName().".";
        if (array_key_exists("store_id", $filter)) {
            $query->where($tableName . 'store_id', '=', $filter['store_id']);
        }
        if (array_key_exists("creator_id", $filter)) {
            $query->where($tableName . 'creator_id', '=', $filter['creator_id']);
        }
        if (array_key_exists("modifier_id", $filter)) {
            $query->where($tableName . 'modifier_id', '=', $filter['modifier_id']);
        }
        if (array_key_exists("title", $filter)) {
            $query->where($tableName . 'title', 'LIKE', '%'.$filter['title'].'%');
        }
        if (array_key_exists("type", $filter)) {
            $query->where($tableName . 'type', '=', $filter['type']);
        }
        if (array_key_exists("slug", $filter)) {
            $query->where($tableName . 'slug', '=', $filter['slug']);
        }
        if (array_key_exists("status", $filter)) {
            $query->where($tableName . 'status', '=', $filter['status']);
        }
        if (array_key_exists("description", $filter)) {
            $query->where($tableName . 'description','LIKE', '%'.$filter['description'].'%');
        }
        if (array_key_exists("sorder_from", $filter)) {
            $query->where($tableName . 'sorder', '>=', $filter['sorder_from']);
        }
        if (array_key_exists("sorder_to", $filter)) {
            $query->where($tableName . 'sorder', '<=', $filter['sorder_to']);
        }
        if (array_key_exists("publish_from", $filter)) {
            $query->where($tableName . 'published_at', '>=', $filter['publish_from']);
        }
        if (array_key_exists("publish_to", $filter)) {
            $query->where($tableName . 'published_at', '<=', $filter['publish_to']);
        }
        if (array_key_exists("expire_from", $filter)) {
            $query->where($tableName . 'expired_at', '>=', $filter['expire_from']);
        }
        if (array_key_exists("expire_to", $filter)) {
            $query->where($tableName . 'expired_at', '<=', $filter['expire_to']);
        }
        if (array_key_exists("cash_back_rate_from", $filter)) {
            $query->where($tableName . 'cash_back_rate', '>=', $filter['cash_back_rate_from']);
        }
        if (array_key_exists("cash_back_rate_to", $filter)) {
            $query->where($tableName . 'cash_back_rate', '<=', $filter['cash_back_rate_to']);
        }
        if (array_key_exists("statuses", $filter)) {
            $query->whereIn($tableName . 'status',$filter['statuses']);
        }
        if (array_key_exists("with_store", $filter)) {
            $query->join('stores as s', 's.id', '=', $tableName . 'store_id');
            $query->select($tableName . '*');
            $query->addSelect('s.name as store_name','s.slug as store_slug','s.logo_url as store_logo');
        }
        if(array_key_exists('store_ids', $filter)){
          $query->whereIn($tableName . 'store_id', $filter['store_ids']);
        }
        if(array_key_exists('is_hot_deal', $filter)){
          $query->where($tableName . 'is_hot_deal', $filter['is_hot_deal']);
        }
        if (array_key_exists("with_user", $filter)) {
             $query->leftJoin('users as creator', 'creator.id', '=', $tableName . 'creator_id');
             $query->select($tableName . '*');
             $query->leftJoin('users as modifier', 'modifier.id', '=', $tableName . 'modifier_id');
             $query->addSelect('creator.name as created_by');
             $query->addSelect('modifier.name as updated_by');
         }
        if (array_key_exists("update_status_unreliable", $filter)) {
            $query->whereIn($tableName . 'status', ['enable', 'future']);
            $query->whereNotNull($tableName . 'expired_at');
            $query->where($tableName . 'expired_at', '!=', '0000-00-00 00:00:00');
            $query->where($tableName . 'expired_at', '!=', '0000-00-00 00:00:00');
            $query->where($tableName . 'expired_at', '<', date('Y-m-d 00:00:00'));
        }
        if (array_key_exists("update_status_future", $filter)) {
            $query->where($tableName . 'status', '=', 'enable');
            $query->where($tableName . 'published_at', '>', date('Y-m-d 00:00:00'));
            $query->where(function($where) use ($tableName) {
                $where->whereNull($tableName. 'expired_at');
                $where->orWhere($tableName. 'expired_at', '=', '0000-00-00 00:00:00');
                $where->orWhere($tableName. 'expired_at', '>', date('Y-m-d 00:00:00'));
            });
        }
        if (array_key_exists("update_status_active", $filter)) {
            $query->where($tableName . 'status', '=', 'future');
            $query->where($tableName . 'published_at', '<=', date('Y-m-d 00:00:00'));
            $query->where(function($where) use ($tableName) {
                $where->whereNull($tableName. 'expired_at');
                $where->orWhere($tableName. 'expired_at', '=', '0000-00-00 00:00:00');
                $where->orWhere($tableName. 'expired_at', '>=', date('Y-m-d 00:00:00'));
            });
        }
        return $query;
    }
}
