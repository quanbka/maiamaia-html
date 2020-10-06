<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 3/16/2018
 * Time: 3:57 PM
 */

namespace App\Http\Controllers\Service;


use Illuminate\Support\Facades\App;

class CronService extends BaseService
{
    public function cronUpdateStatusAllDeals () {
        //unreliable
        App::make('dealService')->query([
            'update_status_unreliable' => 1
        ])->update([
            'status' => 'unreliable'
        ]);

        //future
        App::make('dealService')->query([
            'update_status_future' => 1
        ])->update([
            'status' => 'future'
        ]);

        //enable
        App::make('dealService')->query([
            'update_status_active' => 1
        ])->update([
            'status' => 'enable'
        ]);

        return $this->response([]);
    }
}