<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/10/18
 * Time: 1:49 PM
 */


namespace App\Http\Controllers;

use DateTime;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    const STATUS_SUCCESSFUL = "successful";
    const STATUS_FAIL = "fail";

    protected function getDefaultStatus()
    {
        $result = array();
        $result["status"] = self::STATUS_FAIL;
        $result["message"] = 'Error!';
        return $result;
    }

    protected function getSuccessStatus($data = [])
    {
        $result = array();
        $result["status"] = self::STATUS_SUCCESSFUL;
        if ($data) {
            $result["data"] = $data;
        }
        return $result;
    }

    protected function response($data)
    {
        $data['status'] = self::STATUS_SUCCESSFUL;
        return response()->json($data);
    }

    protected function stringToDateOrNull($dateString)
    {
        if ($dateString == null || strlen($dateString) == 0) {
            return null;
        }
        $retVal = DateTime::createFromFormat("d/m/Y", $dateString);
        $retVal->setTime(0, 0, 0);
        return $retVal;
    }

    protected function getAction($request)
    {
        return $request->route()[1]['uses'];
    }

    protected function buildFilter($request)
    {
        $filter = [
            'page_size' => 40,
            'page_id' => 1,
            'columns' => ['*']
        ];
        if ($request->has('page_size')) {
            $filter['page_size'] = $request->input('page_size');
        }
        if ($request->has('page_id') && $request->input('page_id') > 0) {
            $filter['page_id'] = $request->input('page_id');
        }
        return $filter;
    }
    
    

    protected function getFromDateTimeFilter($dateTime, $format = "d/m/Y") {
        $retval = FALSE;
        if (is_object($dateTime)) {
            $retval = clone $dateTime;
        }
        if ($dateTime == NULL || $dateTime == "") {
            $dateTime = "1/1/1900";
        }
        if (is_string($dateTime)) {
            $retval = DateTime::createFromFormat($format, $dateTime);
        }
        if ($retval !== FALSE) {
            $retval = $retval->setTime("00", "00", "00");
        }
        return $retval;
    }

}

