<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/17/2018
 * Time: 3:14 PM
 */

namespace App\Http\Controllers\System;


class SettingController
{
    public function index () {
        return view('system.setting.index');
    }

    public function frontendConfig() {
        return view('system.setting.frontend-config');
    }
}
