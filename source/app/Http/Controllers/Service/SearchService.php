<?php

namespace App\Http\Controllers\Service;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchService extends ElasticSearchService {

    public function search(Request $request){
        $data = [];
        $offset = $request->has('offset') ? $request->input('offset') : 0;
        if($request->has('key')){
            $keyWord = $request->input('key');
            $sizeStore = $request->has('size_store') ? $request->input('size_store') : 10;
            $stores = $this->searchDocumentStore(array(
                'p' => $offset,
                's' => $sizeStore,
                'k' => '*',
                'name' => $keyWord
            ));
            $data['stores'] = $stores['hits']['hits'];
            $data['total_store'] = $stores['hits']['total'];
        }

        if($request->has('key')){
            $keyWord = $request->input('key');
            $sizeDeal = $request->has('size_deal') ? $request->input('size_deal') : 10;
            $deals = $this->searchDocumentDeal(array(
                'p' => $offset,
                's' => $sizeDeal,
                'k' => '*',
                'name' => $keyWord
            ));
            $data['deals'] = $deals['hits']['hits'];
            $data['total_deal'] = $deals['hits']['total'];
        }
        

        return $this->response([
            'status' => 'successful',
            'data' => $data
        ]);

    }


    public function searchStore(Request $request){
        $data = [];
        $offset = $request->has('offset') ? $request->input('offset') : 0;
        if($request->has('key')){
            $keyWord = $request->input('key');
            $sizeStore = $request->has('size') ? $request->input('size') : 20;
            $stores = $this->searchDocumentStore(array(
                'p' => $offset,
                's' => $sizeStore,
                'k' => '*',
                'name' => $keyWord
            ));
            $data = $stores['hits']['hits'];
        }

        return $this->response([
            'status' => 'successful',
            'data' => $data
        ]);
    }

    public function searchDeal(Request $request){
        $data = [];
        $offset = $request->has('offset') ? $request->input('offset') : 0;
        if($request->has('key')){
            $keyWord = $request->input('key');
            $sizeStore = $request->has('size') ? $request->input('size') : 20;
            $deals = $this->searchDocumentDeal(array(
                'p' => $offset,
                's' => $sizeStore,
                'k' => '*',
                'name' => $keyWord
            ));
            $data = $deals['hits']['hits'];
        }

        return $this->response([
            'status' => 'successful',
            'data' => $data
        ]);
    }

}
