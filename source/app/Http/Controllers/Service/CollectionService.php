<?php

namespace App\Http\Controllers\Service;

use App\Repositories\CollectionRepository as EloquentCollectionService;
use App\Repositories\CollectionStoreRepository as EloquentCollectionStoreService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionService extends BaseService
{
    private $collectionService;
    private $collectionStoreService;
    private $columns = ['name', 'description', 'meta_description', 'meta_keywords',
      'show_store', 'show_deal', 'status', 'created_at', 'updated_at', 'slug'];

    public function __construct(EloquentCollectionService $collectionService, EloquentCollectionStoreService $collectionStoreService){
      $this->collectionService = $collectionService;
      $this->collectionStoreService = $collectionStoreService;
    }

    public function index(Request $request){
        $filter = $this->buildFilter($request);
        $data = $this->collectionService->getData($filter);
        $paginator = $this->collectionService->paginator($filter);
        return $this->response([
                      'data' => $data,
                      'paginator' => $paginator
        ]);
    }

    public function all(){

    }

    public function store(Request $request){
      $validateColumns = $this->validateRules();
      $attributes = $request->only($this->columns);
      $now = date("Y-m-d H:i:s");
      $attributes["created_at"] = $now;
      $attributes["updated_at"] = $now;
      $collectionObj = $this->collectionService->query()->create($attributes);
      $store_ids = $request->get('store_id');
      foreach($store_ids as $id){
          $this->collectionStoreService->query()->create(['store_id' => $id, 'collection_id' => $collectionObj->id]);
      }
      return $this->response([
        'data' => $collectionObj
      ]);
    }

    public function show($id){
      $collectionObj = $this->collectionService->query()->findOrFail($id);
      $collectionObj->storesObj = $this->collectionStoreService->query(['collection_id' => $id])->get();
      $response['data'] = $collectionObj;
      return $this->response($response);
    }

    public function update($id, Request $request){
          $validateColumns = $this->validateRules();
          $attributes = $request->only($this->columns);
          $collectionObj = $this->collectionService->query()->findOrFail($id);
          $collectionObj->update($attributes);
          $deleteFilter['delete_collection'] = $collectionObj->id;
          $this->collectionStoreService->query($deleteFilter)->delete();
          $store_ids = $request->get('store_id');
          foreach($store_ids as $id){
              $this->collectionStoreService->query()->create(['store_id' => $id, 'collection_id' => $collectionObj->id]);
          }
          return $this->response([
                  'data' => $collectionObj
          ]);
    }

    public function destroy($id){
      $collectionObj = $this->collectionService->query()->findOrFail($id);
      $collectionObj->delete();
      $deleteFilter['delete_collection'] = $id;
      $this->collectionStoreService->query($deleteFilter)->delete();
      return $this->response([
                  'id' => $id
      ]);
    }

    protected function buildFilter($request){
      $retVal = parent::buildFilter($request);
      return array_merge($retVal, $request->all());
    }

    private function validateRules() {
        return [
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'slug' => 'required',
        ];
    }
}
