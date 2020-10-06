<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 3/5/2018
 * Time: 2:31 PM
 */

namespace App\Http\Controllers\Service;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContactService extends BaseService
{
    public function index(Request $request) {
        $filter = $this->buildFilter($request);
        $filter['orders'] = [
            'id' => 'desc'
        ];
        $data = App::make('contactService')->getData($filter);
        $paginator = App::make('contactService')->paginator($filter);
        return $this->response([
            'data' => $data,
            'paginator' => $paginator
        ]);
    }

    protected function buildFilter($request) {
        $retVal = parent::buildFilter($request);
        return array_merge($retVal, $request->all());
    }
}