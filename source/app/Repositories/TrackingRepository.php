<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/18/18
 * Time: 11:16 AM
 */


namespace App\Repositories;

use App\Models\Tracking;

class TrackingRepository extends BaseRepository
{

    const MODEL = Tracking::class;

    public function query($filter = [])
    {
        $query = parent::query($filter);
        $tableName = call_user_func(static::MODEL . '::getTableName');
        if (array_key_exists('custom_id', $filter) && $filter['custom_id']) {
            $query->where($tableName . '.custom_id', '=', $filter['custom_id']);
        }
        if (array_key_exists('user_id', $filter) && $filter['user_id']) {
            $query->where($tableName . '.user_id', '=', $filter['user_id']);
        }
        return $query;
    }

    public function findByCustomId($customId)
    {
        return $this->query([
            'custom_id' => $customId
        ])->first();
    }
}