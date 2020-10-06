<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/17/2018
 * Time: 9:54 AM
 */

namespace App\Repositories;
use App\Models\Setting;
use Illuminate\Support\Facades\App;

class SettingRepository extends BaseRepository
{
    public function create($data) {
        $retval = 0;
        try {
            $existedParam = $this->getByKey($data["key"]);
            if ($existedParam == null) {
                $retval = Setting::create([
                    'key' => $data['key'],
                    'value' => array_key_exists('value', $data) ? $data['value'] : '',
                    'title' => array_key_exists('title', $data) ? $data['title'] : '',
                    'description' => array_key_exists('description', $data) ? $data['description'] : '',
                ]);
                $redisService = App::make('redisService');
                $redisService->clearCacheParams();
            }
        } catch (\Exception $e) {
        }
        return $retval;
    }

    /**
     * Update param
     * @param array|stdClass|Model $data
     * @return Number of affected entity
     */
    public function update($data) {
        $retval = 0;
        try {
            if (isset($data['id'])){
                $setting = Setting::find($data['id']);
            } elseif (isset($data['key'])) {
                $setting = Setting::where('key', '=', $data['key'])->first();
            } else {
                return $retval;
            }
            if (isset($data['key'])) {
                $setting->key = $data['key'] ? $data['key'] : '';
            }
            if (isset($data['value'])) {
                $setting->value = $data['value'] ? $data['value'] : '';
            }
            if (isset($data['title'])) {
                $setting->title = $data['title'] ? $data['title'] : '';
            }
            if (isset($data['description'])) {
                $setting->description = $data['description'] ? $data['description'] : '';
            }
            $setting->save();
            $retval = $setting;
            $redisService = App::make('redisService');
            $redisService->clearCacheParams();
        } catch (\Exception $ex) {

        }
        return $retval;
    }

    /**
     * create or update param with key-value
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function add($key, $value) {
        $retval = FALSE;
        $result = 0;
        $existedParam = $this->getByKey($key);
        if ($existedParam == null) {
            $param = array();
            $param["key"] = $key;
            $param["value"] = $value;
            $result = $this->create($param);
        } else {
            $existedParam = (array) $existedParam;
            $existedParam["value"] = $value;
            $result = $this->update( $existedParam);
        }
        if ($result) {
            $retval = TRUE;
        }
        $redisService = App::make('redisService');
        $redisService->clearCacheParams();
        return $retval;
    }

    public function delete($key) {
        $retval = 0;
        if (Setting::where('key', $key)->delete()) {
            $retval = true;
        }
        $redisService = App::make('redisService');
        $redisService->clearCacheParams();
        return $retval;
    }

    /**
     * Get Param by key
     * @param string $key
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getByKey($key) {
        $redisService = App::make('redisService');
        $redis = $redisService->redis();
        $keyRedis = $redisService->key_param . $key;
        $result = new \stdClass();
        $result->value = $redis->get($keyRedis);
        if (!$result->value) {
            $result = Setting::select(['value'])->where("key", "=", $key)->first();
            if(!$result || !$result->value){
                $result = new \stdClass();
                $result->value = 'empty';
            }
            $redisService->cacheParams($key, $result->value);
        }
        if( isset($result->value) && $result->value == 'empty'){
            $result = '';
        }
        return $result;
    }

    /**
     * Get value as string
     * @param string $key
     * @return string
     */
    public function value($key, $default = null) {
        $retval = $default;
        $param = $this->getByKey($key);
        if (isset($param->value) && $param->value) {
            $retval = $param->value;
        }
        return $retval;
    }

    /**
     * Get Value as json array
     * @param string $key
     * @return array
     */
    public function valueJson($key, $default = null,$toArray = true) {
        $retval = $default;
        $param = $this->getByKey($key);
        if (isset($param->value) && $param->value) {
            $retval = json_decode($param->value, $toArray);
        }
        return $retval;
    }

    /**
     * Get Value as array from value string (a,b,c...)
     * @param string $key
     * @return array
     */
    public function valueList($key) {
        $retval = array();
        $param = $this->getByKey($key);
        if (isset($param->value) && $param->value) {
            $retval = explode(",", $param->value);
        }
        return $retval == FALSE ? array() : $retval;
    }
}
