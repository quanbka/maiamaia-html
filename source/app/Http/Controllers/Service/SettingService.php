<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/17/2018
 * Time: 4:11 PM
 */

namespace App\Http\Controllers\Service;


use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SettingService extends Controller
{
    public function find(Request $request) {
        $result = [
            'status' => 'fail',
            'message' => 'fail'
        ];
        try {
            $query = Setting::where('id' , '>' ,0)->orderBy('id', 'desc');
            $this->buildQuery($query, $request);
            $data = $query->get();
            $result = [
                'status' => 'successful',
                'data' => $data
            ];
        } catch (\Exception $ex) {
            $result['message'] = $ex->getMessage();
        }

        return response()->json($result);
    }

    private function buildQuery($query, $request) {
        if($request->has('key')){
            $query->where('key', 'LIKE', '%' . $request['key'] . '%');
        }
    }

    public function update (Request $request) {
        $result = [
            'status' => 'fail',
            'message' => 'fail'
        ];
        try {
            $data = App::make("settingService")->update($request);
            $result = [
                'status' => 'successful',
                'data' => $data
            ];
        } catch (\Exception $ex) {
            $result['message'] = $ex->getMessage();
        }
        return response()->json($result);
    }

    public function create (Request $request) {
        $result = [
            'status' => 'fail',
            'message' => 'fail'
        ];
        try {
            $data = App::make("settingService")->create($request['param']);
            if ($data === 0) {
                $result = [
                    'status' => 'fail',
                    'message' => 'Dupliacate key of param!'
                ];
            } else {
                $result = [
                    'status' => 'successful',
                    'data' => $data
                ];
            }

        } catch (\Exception $ex) {
            $result['message'] = $ex->getMessage();
        }
        return response()->json($result);
    }

    public function delete (Request $request) {
        $result = [
            'status' => 'fail',
            'message' => 'fail'
        ];
        try {
            $data = App::make("settingService")->delete($request['key']);
            $result = [
                'status' => 'successful',
                'data' => $data
            ];
        } catch (\Exception $ex) {
            $result['message'] = $ex->getMessage();
        }
        return response()->json($result);
    }
}