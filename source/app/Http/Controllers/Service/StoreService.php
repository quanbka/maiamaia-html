<?php

namespace App\Http\Controllers\Service;

use App\Models\Store;
use App\Repositories\DealRepository as EloquentDealService;
use App\Repositories\StoreRepository as EloquentStoreService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreService extends ElasticSearchService {

    private $storeService;
    private $dealService;
    private $columns = [
        'logo_url', 'name', 'category_id',
        'description', 'meta_title', 'meta_description', 'cash_back_rate',
        'slug', 'meta_keywords', 'status', 'config',
        'origin_url', 'affiliate_url', 'old_cash_back_rate'
    ];

    public function __construct(EloquentStoreService $storeService, EloquentDealService $dealService) {
        $this->storeService = $storeService;
        $this->dealService = $dealService;
    }

    public function index(Request $request) {
        $filter = $this->buildFilter($request);
        $data = $this->storeService->getData($filter);
        $paginator = $this->storeService->paginator($filter);
        return $this->response([
                    'data' => $data,
                    'paginator' => $paginator
        ]);
    }

    public function all() {
        return \App\Models\Store::all();
    }

    public function store(Request $request) {
        $this->validate($request, $this->validateRules());
        $attributes = $request->only($this->columns);
        $attributes["creator_id"] = $request->user()->id;
        $attributes["modifier_id"] = $request->user()->id;
        $now = date("Y-m-d H:i:s");
        $attributes["created_at"] = $now;
        $attributes["updated_at"] = $now;
        $attributes['old_cash_back_rate'] = "0.00";
        $obj = $this->storeService->query()->create($attributes);
        $data = json_decode(json_encode($obj), true);
        $data['typeIndex'] = 'stores';
        $this->createOrUpdateDocument($data);
        return $this->response([
                    'data' => $obj
        ]);
    }

    public function show($id) {
        $obj = $this->storeService->query()->findOrFail($id);
        return $this->response([
                    'data' => $obj
        ]);
    }

    public function update($id, Request $request) {
        $validateColumns = $this->validateRules();
        $validateColumns['slug'] = ['required',
            \Illuminate\Validation\Rule::unique('stores')->where(function ($query) use ($id) {
                        return $query->where('id', '<>', $id);
                    })
        ];
        $this->validate($request, $validateColumns);
        $attributes = $request->only($this->columns);
        $attributes["modifier_id"] = $request->user()->id;
        $attributes["updated_at"] = date("Y-m-d H:i:s");
        $obj = $this->storeService->query()->findOrFail($id);
        $obj->update($attributes);
        $data = json_decode(json_encode($obj), true);
        $data['typeIndex'] = 'stores';
        $this->createOrUpdateDocument($data);
        return $this->response([
                    'data' => $obj
        ]);
    }

    public function destroy($id) {
        $obj = $this->storeService->query()->findOrFail($id);
        $obj->delete();
        return $this->response([
                    'id' => $id
        ]);
    }

    private function validateRules() {
        return [
            'category_id' => 'required',
            'slug' => 'required|unique:stores',
            'name' => 'required',
            'origin_url' => 'required|url',
            'cash_back_rate' => 'required',
            'status' => 'required',
        ];
    }

    protected function buildFilter($request) {
        $retVal = parent::buildFilter($request);
        return array_merge($retVal, $request->all());
    }

    public function buildLink() {
        ini_set('memory_limit', '2048M');
        set_time_limit(0);
        $stores = $this->storeService->getData(['page_size' => 0, 'columns' => ['*']]);
        $storeCount = 0;
        $dealCount = 0;
        foreach ($stores as $store) {
            try {
                DB::beginTransaction();
                $store->save();
                DB::commit();
                $storeCount++;
            } catch (Exception $exc) {
                DB::rollBack();
                echo $exc->getTraceAsString();
            }
        }
        $deals = $this->dealService->getData(['page_size' => 0, 'columns' => ['*']]);
        foreach ($deals as $deal) {
            try {
                DB::beginTransaction();
                $deal->save();
                DB::commit();
                $dealCount++;
            } catch (Exception $exc) {
                DB::rollBack();
                echo $exc->getTraceAsString();
            }
        }

        return $this->response([
                    'data' => ['storeCount' => $storeCount, 'dealCount' => $dealCount]
        ]);
    }

    public function favoriteStore(Request $request) {
        $retVal = [
            'data' => "fail"
        ];
        $this->validate($request, [
            'store_id' => 'required',
        ]);
        $attributes = $request->only(['store_id']);
        $attributes['user_id'] = $request->user()->id;
        $stores = $this->storeService->favoriteQuery($attributes)->get();
        if (!empty($stores) && count($stores) == 1) {
            $stores[0]->delete();
            $retVal['data'] = "deleted";
        } else {
            $obj = $this->storeService->favoriteQuery()->create($attributes);
            $retVal['data'] = $obj;
        }
        return $this->response($retVal);
    }

    public function getAllStore () {
        $listAllStore = $this->storeService->query([
            'status' => Store::STATUS_ENABLE
        ])->get();
        return $this->response([
            'data' => $listAllStore
        ]);
    }

}
