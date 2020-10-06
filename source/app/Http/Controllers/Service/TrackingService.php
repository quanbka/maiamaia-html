<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/18/18
 * Time: 11:54 AM
 */


namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Repositories\TrackingRepository as EloquenTrackingService;
use Illuminate\Support\Facades\DB;

class TrackingService extends BaseService
{
    private $trackingService;
    private $columns =  [
        'user_id', 'store_id', 'deal_id', 'custom_id',
        'cash_back_rate', 'refer_url', 'user_agent'
    ];

    public function __construct(EloquenTrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function index(Request $request)
    {
        $filter = $this->buildFilter($request);
        $data = $this->trackingService->getData($filter);
        $paginator = $this->trackingService->paginator($filter);
        return $this->response([
            'data' => $data,
            'paginator' => $paginator
        ]);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->validateRules());
        $attributes = $request->only($this->columns);
        if($attributes['refer_url']) {
            $urlInfo = parse_url($attributes['refer_url']);
            $attributes['refer_domain'] = isset($urlInfo['host']) ? $urlInfo['host'] : '';
        }
        $orderObj = $this->trackingService->query()->create($attributes);
        return $this->response([
            'data' => $orderObj
        ]);
    }

    public function show($id)
    {
        $orderObj = $this->trackingService->query()->findOrFail($id);
        return $this->response([
            'data' => $orderObj
        ]);
    }


    public function update($id, Request $request)
    {
        $validateColumns = $this->validateRules();
        $this->validate($request, $validateColumns);
        $attributes = $request->only($this->columns);
        $trackingObj = $this->trackingService->query()->findOrFail($id);
        $trackingObj->update($attributes);
        return $this->response([
            'data' => $trackingObj
        ]);
    }

    public function destroy($id, Request $request)
    {
        $orderObj = $this->trackingService->query()->findOrFail($id);
        $orderObj->delete();
        return $this->response([
            'id' => $id
        ]);
    }

    private function validateRules()
    {
        return [
            'store_id' => 'required',
            'user_id' => 'required',
            'deal_id' => 'required'
        ];
    }


}
