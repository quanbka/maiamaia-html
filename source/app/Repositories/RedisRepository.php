<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/17/2018
 * Time: 9:41 AM
 */

namespace App\Repositories;
use Illuminate\Support\Facades\Redis;

class RedisRepository extends BaseRepository
{
    protected static $redisConnections = [];
    public $key_param = 'cache::parameter::';
    const DEAFULT_DB = 2;

    public static function redis($db = self::DEAFULT_DB) {
        if (!self::$redisConnections) {
            self::$redisConnections = Redis::connection();
        }
        self::$redisConnections->select($db);
        return self::$redisConnections;
    }

    public function cacheParams($name, $value) {
        $key = $this->key_param . $name;
        $this->_setValue($key, $value, 1800);
    }

    public function clearCacheParams() {
        $keyPattern = $this->key_param . '*';
        $results = self::redis(self::DEAFULT_DB)->keys($keyPattern);
        if (!empty($results)) {
            foreach ($results as $result) {
                self::redis(self::DEAFULT_DB)->del($result);
            }
        }
    }

    private function _setValue($key, $val, $expire = 600) {
        self::redis(self::DEAFULT_DB)->set($key, $val);
        self::redis(self::DEAFULT_DB)->expire($key, $expire);
    }
}