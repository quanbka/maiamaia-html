<?php

namespace App\Http\Controllers\Service;

use App\Repositories\CategoryRepository as EloquentCategoryService;
use Illuminate\Http\Request;

class CategoryService extends BaseService {

    private $categoryService;
    private $columns = [
        'logo_url', 'name', 'category_id',
        'description', 'meta_title', 'meta_description', 'cash_back_rate',
        'slug', 'meta_keywords', 'status', 'config',
        'origin_url', 'affiliate_url', 'creator_id', 'modifier_id', 'type', 'order'
    ];

    public function __construct(EloquentCategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request) {
        $filter = $this->buildFilter($request);
        $filter['orders'] = [
            'order' => 'asc'
        ];
        $data = $this->categoryService->getData($filter);
        $paginator = $this->categoryService->paginator($filter);
        return $this->response([
                    'data' => $data,
                    'paginator' => $paginator
        ]);
    }

    public function allStoreCategories() {
        return \App\Models\Category::where('type', '=', 'store')->get();
    }

    public function store(Request $request) {
        $this->validate($request, $this->validateRules());
        $attributes = $request->only($this->columns);
        $attributes["creator_id"] = $request->user()->id;
        $attributes["modifier_id"] = $request->user()->id;
        $now = date("Y-m-d H:i:s");
        $attributes["created_at"] = $now;
        $attributes["updated_at"] = $now;
        $orderObj = $this->categoryService->query()->create($attributes);
        return $this->response([
                    'data' => $orderObj
        ]);
    }

    public function show($id) {
        $orderObj = $this->categoryService->query()->findOrFail($id);
        return $this->response([
                    'data' => $orderObj
        ]);
    }

    public function update($id, Request $request) {
        $validateColumns = $this->validateRules();
        $validateColumns['slug'] = ['required',
            \Illuminate\Validation\Rule::unique('categories')->where(function ($query) use ($id, $request) {
                        return $query->where('id', '<>', $id)->where('type', '<>', $request->input('type', ''));
                    })
        ];
        $this->validate($request, $validateColumns);
        $attributes = $request->only($this->columns);
        $attributes["modifier_id"] = $request->user()->id;
        $attributes["updated_at"] = date("Y-m-d H:i:s");
        $orderObj = $this->categoryService->query()->findOrFail($id);
        $orderObj->update($attributes);
        return $this->response([
                    'data' => $orderObj
        ]);
    }

    public function destroy($id) {
        $orderObj = $this->categoryService->query()->findOrFail($id);
        $orderObj->delete();
        return $this->response([
                    'id' => $id
        ]);
    }

    private function validateRules() {
        return [
            'name' => 'required',
            'status' => 'required',
            'slug' => 'required',
        ];
    }

    protected function buildFilter($request) {
        $retVal = parent::buildFilter($request);
        return array_merge($retVal, $request->all());
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
                    'order' => $item['order']
                ];
                $this->categoryService->query([
                    'id' => $item['id']
                ])->update($dataUpdate);
            }
        }
        return $this->response([]);
    }

}
