<?php

namespace App\Http\Controllers\Service;

use App\Models\Deal;
use App\Repositories\DealRepository as EloquentDealService;
use Illuminate\Http\Request;

class DealService extends ElasticSearchService {

    private $dealService;
    private $columns = [
        'store_id', 'type', 'title',
        'description', 'published_at', 'expired_at', 'cash_back_rate',
        'slug', 'image_url', 'status', 'config', 'sorder',
        'origin_url', 'affiliate_url', 'coupon_code', 'is_hot_deal'
    ];

    public function __construct(EloquentDealService $dealService) {
        $this->dealService = $dealService;
    }

    public function index(Request $request) {
        $filter = $this->buildFilter($request);
        $data = $this->dealService->getData($filter);
        $paginator = $this->dealService->paginator($filter);
        return $this->response([
                    'data' => $data,
                    'paginator' => $paginator
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, $this->validateRules());
        $attributes = $request->only($this->columns);
        $attributes["creator_id"] = $request->user()->id;
        $attributes["modifier_id"] = $request->user()->id;
        $now = date("Y-m-d H:i:s");
        $attributes["created_at"] = $now;
        $attributes["updated_at"] = $now;
        if (!isset($attributes["is_hot_deal"])) {
            $attributes["is_hot_deal"] = 0;
        }
        $orderObj = $this->dealService->query()->create($attributes);
        $data = json_decode(json_encode($orderObj), true);
        $data['typeIndex'] = 'deals';
        $this->createOrUpdateDocument($data);

        return $this->response([
                    'data' => $orderObj
        ]);
    }

    public function show($id) {
        $orderObj = $this->dealService->query()->findOrFail($id);
        return $this->response([
                    'data' => $orderObj
        ]);
    }

    public function update($id, Request $request) {
        $validateColumns = $this->validateRules();
        $validateColumns['slug'] = ['required',
            \Illuminate\Validation\Rule::unique('deals')->where(function ($query) use ($id) {
                        return $query->where('id', '<>', $id);
                    })
        ];
        $this->validate($request, $validateColumns);
        $attributes = $request->only($this->columns);
        $attributes["modifier_id"] = $request->user()->id;
        $attributes["updated_at"] = date("Y-m-d H:i:s");
        $orderObj = $this->dealService->query()->findOrFail($id);
        $orderObj->update($attributes);
        $data = json_decode(json_encode($orderObj), true);
        $data['typeIndex'] = 'deals';
        $response = $this->createOrUpdateDocument($data);

        return $this->response([
                    'data' => $orderObj
        ]);
    }

    public function destroy($id) {
        $orderObj = $this->dealService->query()->findOrFail($id);
        $orderObj->delete();
        return $this->response([
                    'id' => $id
        ]);
    }

    private function validateRules() {
        return [
            'store_id' => 'required',
            'type' => 'required',
            'title' => 'required',
            'description' => 'required',
            'cash_back_rate' => 'required',
            'status' => 'required',
            'slug' => 'required|unique:deals',
            'origin_url' => 'required|url',
        ];
    }

    protected function buildFilter($request) {
        $retVal = parent::buildFilter($request);
        return array_merge($retVal, $request->all());
    }

    public function getHotDeal () {
        $listHotDeal = $this->dealService->query([
            'status' => Deal::STATUS_ENABLE,
            'is_hot_deal' => Deal::IS_HOT_DEAL
        ])->get();
        return $this->response([
            'data' => $listHotDeal
        ]);
    }

    public function getAllDeal () {
        $listAllDeal = $this->dealService->query([
            'status' => Deal::STATUS_ENABLE
        ])->get();
        return $this->response([
            'data' => $listAllDeal
        ]);
    }

    public function updateMultiOrder (Request $request) {
        if (!$request->input('items')) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Invalid data input!'
            ]);
        }
        $items = $request->input('items');
        if (count($items) > 0) {
            foreach ($items as $item) {
                $dataUpdate = [
                    'sorder' => $item['sorder']
                ];
                $this->dealService->query([
                    'id' => $item['id']
                ])->update($dataUpdate);
            }
        }
        return $this->response([]);
    }

}
