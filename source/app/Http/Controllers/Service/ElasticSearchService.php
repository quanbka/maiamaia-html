<?php
namespace App\Http\Controllers\Service;

use Illuminate\Routing\Controller;
use Elasticsearch\ClientBuilder;
use Config;
// use App\Models\Keywords;
use App\Models\Store;
use App\Models\Deal;
// use App\Models\Searchs;
use Exception;

class ElasticSearchService extends BaseService {

    private static $client;


    public function __construct() {
        self::$client = ClientBuilder::create()->setHosts(Config::get('app.elasticSearch.hosts'))->build();
    }

    public static function client () {
        if (self::$client == null) {
            self::$client = ClientBuilder::create()->setHosts(Config::get('app.elasticSearch.hosts'))->build();
        }
        return self::$client;
    }

    public function searchDocumentKeyword($filter, $fields = array()){
        try {
            $params['index'] = Config::get('app.elasticSearch.index');
            $params['type'] = 'keywords';
            $params['body']['from'] = $filter['p'];
            $params['body']['size'] = $filter['s'];
            $params['body']['highlight'] = ['pre_tags' => ['<b>'], 'post_tags' => ['</b>']];
            $params['body']['highlight']['fields'] = ['*' => (object) []];
            $params['body']['highlight']['require_field_match'] = false;
            $params['body']['suggest']['my-suggestion'] = ['text' => $filter['k'], 'term' => ['field' => 'name', 'analyzer' => 'autocomplete', 'min_word_length' => 3]];

            if(isset($filter['columns'])){
                $params['body']['_source'] = $filter['columns'];
            }

            $params['body']['query']['bool']['must'][] = ['term' => ['status' => Keywords::STATUS_TYPE["active"]]];
            $params['body']['query']['bool']['must_not'][] = ['term' => ['type' => 1]];
            // $params['body']['query']['bool']['must_not'][] = ['term' => ['show_hide' => Keywords::HIDE]];

            /* Filter Type Coupon */
            if(!empty($filter['type'])){
                $listType = Keywords::COUPON_TYPE;
                unset($listType[array_search($filter['type'], $listType)]);
                $params['body']['query']['bool']['must_not'][] = ['terms' => ['filter' => array_values($listType)]];
            }

            /* Full Text Search Query + Store */
            if(!empty($filter['store'])){
                $params['body']['query']['bool']['must'][] = ['terms' => ['store_id' => $filter['store']]];
                $params['body']['query']['bool']['must'][]['bool']['should'][] = ['query_string' => ['query' => $filter['k'], 'fields' => $fields, 'use_dis_max' => true]];
                $params['body']['query']['bool']['must'][]['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'analyzer' => 'my_analyzer']];
                $params['body']['query']['bool']['must'][]['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'analyzer' => 'my_synonym_filter']];
                $params['body']['query']['bool']['must'][]['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'type' => 'phrase_prefix', 'minimum_should_match' => '100%']];
                $params['body']['query']['bool']['must'][]['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'operator' => 'and', 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
                $params['body']['query']['bool']['must'][]['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            }else{
                $params['body']['query']['bool']['should'][] = ['query_string' => ['query' => $filter['k'], 'fields' => $fields, 'use_dis_max' => true]];
                $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'analyzer' => 'my_analyzer']];
                $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'analyzer' => 'my_synonym_filter']];
                $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'type' => 'phrase_prefix', 'minimum_should_match' => '100%']];
                $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'operator' => 'and', 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
                $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['k'], 'fields' => $fields, 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            }

            $response = $this->client->search($params);

        } catch (Exception $e) {
            throw new Exception($e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}");
        }
        return $response;
    }

    public function searchDocumentStore($filter){
        try {
            $params['index'] = Config::get('app.elasticSearch.index');
            $params['type'] = 'stores';
            $params['body']['from'] = $filter['p'];
            $params['body']['size'] = $filter['s'];
            $params['body']['sort'] = ['slug.raw' => ['order' => 'asc']];
            if(isset($filter['columns'])){
                $params['body']['_source'] = $filter['columns'];
            }
            $fields = Config::get('app.elasticSearch.type.stores.searchFields');

            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['name'], 'fields' => $fields, 'type' => 'phrase_prefix', 'minimum_should_match' => '100%']];
            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['name'], 'fields' => $fields, 'operator' => 'and', 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['name'], 'fields' => $fields, 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            // if(isset($filter['whereIn']) && !empty($filter['whereIn'])){
            //     $params['body']['query']['constant_score']['filter']['terms'] = ['id' => array_values($filter['whereIn'])];
            // }


            $response = self::$client->search($params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}");
        }
        return $response;
    }

    public function searchDocumentDeal($filter){
        try {
            $params['index'] = Config::get('app.elasticSearch.index');
            $params['type'] = 'deals';
            $params['body']['from'] = $filter['p'];;
            $params['body']['size'] = $filter['s'];
            $params['body']['sort'] = ['slug.raw' => ['order' => 'asc']];
            if(isset($filter['columns'])){
                $params['body']['_source'] = $filter['columns'];
            }
            $fields = Config::get('app.elasticSearch.type.stores.searchFields');

            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['name'], 'fields' => $fields, 'type' => 'phrase_prefix', 'minimum_should_match' => '100%']];
            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['name'], 'fields' => $fields, 'operator' => 'and', 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $filter['name'], 'fields' => $fields, 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            // if(isset($filter['whereIn']) && !empty($filter['whereIn'])){
            //     $params['body']['query']['constant_score']['filter']['terms'] = ['id' => array_values($filter['whereIn'])];
            // }


            $response = self::$client->search($params);
        } catch (Exception $e) {
            throw new Exception($e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}");
        }
        return $response;
    }

    public function searchInputKeyword($name, $notin = null){
        try {
            $params['index'] = Config::get('app.elasticSearch.index');
            $params['type'] = 'searchs';
            $fields = Config::get('app.elasticSearch.type.searchs.searchFields');
            $params['body']['size'] = 8;
            $params['body']['highlight'] = ['pre_tags' => ['<b>'], 'post_tags' => ['</b>']];
            $params['body']['highlight']['fields'] = ['*' => (object) []];
            $params['body']['highlight']['require_field_match'] = false;
            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $name, 'fields' => $fields, 'type' => 'phrase_prefix', 'minimum_should_match' => '100%']];
            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $name, 'fields' => $fields, 'operator' => 'and', 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            $params['body']['query']['bool']['should'][] = ['multi_match' => ['query' => $name, 'fields' => $fields, 'minimum_should_match' => '100%', 'fuzziness' => 0.8]];
            if(!empty($notin)){
                $params['body']['query']['bool']['must_not'][] = ['term' => ['crc' => (string) $notin]];
            }
            $response = $this->client->search($params);
        }catch (Exception $e) {
            throw new Exception($e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}");
        }
        return $response;
    }

    // public function findCustomKeyword($size, $from, $keyword){
    //     try{
    //         $params['index'] = Config::get('app.elasticSearch.index');
    //         $params['type'] = 'keywords';
    //         $params['size'] = $size;
    //         $params['from'] = $from;
    //         $params['body']['highlight'] = ['pre_tags' => ['<b>'], 'post_tags' => ['</b>']];
    //         $params['body']['highlight']['fields'] = ['*' => (object) []];
    //         $params['body']['highlight']['require_field_match'] = false;
    //         $params['body']['query']['bool']['must'][] = [ 'simple_query_string' => ['fields' => ['keyword'], 'query' => $keyword] ];
    //         $params['body']['query']['bool']['must'][] = [ 'match' => ['type' => 1] ];
    //         // $params['body']['query']['bool']['must'][] = [ 'match' => ['show_hide' => Keywords::SHOW] ];
    //         $params['body']['query']['bool']['must'][] = ['term' => ['status' => Keywords::STATUS_TYPE["active"]]];
    //         $response = $this->client->search($params);

    //     } catch (Exception $e) {
    //         throw new Exception($e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}");
    //     }
    //     return $response;
    // }

    // public function findAdwordFromCustomKeyword($queryString, $crcKeyword){
    //     try{
    //         $params['index'] = Config::get('app.elasticSearch.index');
    //         $params['type'] = 'searchs';
    //         $params['body']['query']['bool']['must'][] = array(
    //             'simple_query_string' => ['fields' => ['name'], 'query' => $queryString, 'default_operator' => 'and', 'analyzer' => 'standard'],
    //         );
    //         $params['body']['query']['bool']['must'][] = array(
    //             'match' => ['crc' => $crcKeyword]
    //         );
    //         $response = $this->client->search($params);
    //         if(isset($response['hits']['hits']) && !empty($response['hits']['hits']))
    //             return true;
    //         else
    //             return false;

    //     } catch (Exception $e) {
    //         throw new Exception($e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}");
    //     }
    //     return $response;
    // }

    public function createOrUpdateSearchKeyword($data){
        try {
            if(isset($data['crc']) && !empty($data['crc'])){
                $searchs = Searchs::isExists((string) $data['crc']);
                if(!empty($searchs)){
                    $searchs->quantity = $searchs->quantity + 1;
                    $searchs->updated_at = date('Y-m-d H:i:s');
                    $searchs->save();
                }else{
                    $searchs = new Searchs;
                    $searchs->name = $data['name'];
                    $searchs->crc = (string) $data['crc'];
                    $searchs->quantity = 1;
                    $searchs->created_at = date('Y-m-d H:i:s');
                    $searchs->save();
                    $searchs->typeIndex = 'searchs';
                    $this->createOrUpdateDocument(json_decode(json_encode($searchs), true));
                    sleep(1);
                }
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
        return false;
    }

    private function buildDataDocument($filter){
        $params = array();
        if(array_key_exists('index', $filter)){
            $params['index'] = $filter['index'];
        }else{
            $params['index'] = Config::get('app.elasticSearch.index');
        }

        if(array_key_exists('typeIndex', $filter)){
            $params['type'] = $filter['typeIndex'];
        }else{
            $listType = array_keys(Config::get('app.elasticSearch.type'));
            $params['type'] = $listType[0];
        }
        if(array_key_exists('id', $filter)){
            $params['id'] = $filter['id'];
        }
        $fields = Config::get("app.elasticSearch.type.".$params['type'].".mappingFields");
        $fields = array_keys($fields);
        foreach($fields as $item){
            if(array_key_exists($item, $filter)){
                if($item == "type"){
                    switch($filter[$item]){
                        case "manual": $params['body'][$item] = 1; break;
                        case "search-engine": $params['body'][$item] = 3; break;
                        case "crawl": $params['body'][$item] = 2; break;
                        default: $params['body'][$item] = 4; break;
                    }
                }else{
                    $params['body'][$item] = $filter[$item];
                }
            }
        }

        return $params;
    }

    public function createOrUpdateDocument($filter){
        //Index a document
        try {
            $params = $this->buildDataDocument($filter);
            $response = self::client()->index($params);

        } catch (Exception $e) {
            $response = $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";

        }

        return $response;
    }

    public function getDocument($filter){
        //get a document
        try {
            $params = $this->buildDataDocument($filter);
            $response = $this->client->get($params);
        } catch (Exception $e) {
            $response = $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
        }
        return $response;
    }

    public function deleteDocument($filter){
        //Delete a document
        try {
            $params = $this->buildDataDocument($filter);
            unset($params['body']);
            $response = $this->client->delete($params);
        } catch (Exception $e) {
            $response = $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
        }
        return $response;
    }

    public function deleteIndex($filter){
        try {
            $params = $this->buildDataDocument($filter);
            $response = $this->client->indices()->delete($params);
        } catch (Exception $e) {
            $response = $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
        }
        return $response;
    }

    public function createIndex($filter){
        try {
            $params = $this->buildDataDocument($filter);
            $response = $this->client->indices()->create($params);
        } catch (Exception $e) {
            $response = $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
        }
        return $response;
    }

    public function init(){
        set_time_limit(0);
        ini_set("memory_limit", "-1");

        $this->config();
        /* Index data from MySQL */
        $pageSize = 10000;


        echo '<p>-------------------------------------- <b>Deal</b> ------------------------------------- </p>';

        $recordsCount = Deal::count();
        $totalPage = $this->recordsCountToPagesCount($recordsCount, $pageSize);
        $countDeal = 0;
        for($pageId=0; $pageId < $totalPage; $pageId++){
            $deals = Deal::forPage($pageId + 1, $pageSize)->get()->toArray();
            $itemDeals = array();
            foreach($deals as $value){
                $itemDeals['body'][] = [
                    'index' => [
                        '_index' => 'cash_back',
                        '_type' => 'deals',
                        '_id' => $value['id']
                    ]
                ];

                $itemDeals['body'][] = [
                    'id' => $value['id'],
                    'title' => $value['title'],
                    'slug' => $value['slug'],
                    'image_url' => $value['image_url'],
                    'cash_back_rate' => $value['cash_back_rate'],
                    'type' => $value['type'],
                    'expired_at' => $value['expired_at'],
                    'coupon_code' => $value['coupon_code']
                ];
            }

            try{
                $result = self::$client->bulk($itemDeals);
                if(!empty($result)){
                    $countDeal += sizeof($result['items']);
                }
            } catch (Exception $e) {
                echo $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
            }
        }

        echo '+ Index <b>'.$countDeal. '</b> Deals.';

        echo '<p>-------------------------------------- <b>STORES</b> ------------------------------------- </p>';

        $recordsCount = Store::count();
        $totalPage = $this->recordsCountToPagesCount($recordsCount, $pageSize);
        $countStore = 0;
        for($pageId=0; $pageId < $totalPage; $pageId++){
            $stores = Store::forPage($pageId + 1, $pageSize)->get()->toArray();
            $itemStores = array();
            foreach($stores as $value){
                $itemStores['body'][] = [
                    'index' => [
                        '_index' => 'cash_back',
                        '_type' => 'stores',
                        '_id' => $value['id']
                    ]
                ];

                $itemStores['body'][] = [
                    'id' => $value['id'],
                    'name' => $value['name'],
                    'slug' => $value['slug'],
                    'logo_url' => $value['logo_url'],
                    'cash_back_rate' => $value['cash_back_rate']
                ];
            }

            try{
                $result = self::$client->bulk($itemStores);
                if(!empty($result)){
                    $countStore += sizeof($result['items']);
                }
            } catch (Exception $e) {
                echo $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
            }
        }

        echo '+ Index <b>'.$countStore. '</b> Stores.';

       

        // echo '<p>-------------------------------------- <b>KEYWORDS</b> ------------------------------------- </p>';

        // $recordsCount = Keywords::count();
        // $totalPage = $this->recordsCountToPagesCount($recordsCount, $pageSize);
        // $countKeyword = 0;
        // for($pageId=0; $pageId < $totalPage; $pageId++){
        //     $keywords = Keywords::forPage($pageId + 1, $pageSize)->get()->toArray();
        //     $itemKeywords = array();
        //     foreach($keywords as $key => $value){
        //         $type = "";
        //         switch($value['type']){
        //             case "manual": $type = 1; break;
        //             case "crawl": $type = 2; break;
        //             case "search-engine": $type = 3; break;
        //             default: $type = 4; break;
        //         }
        //         $itemKeywords['body'][] = [
        //             'index' => [
        //                 '_index' => 'mse',
        //                 '_type' => 'keywords',
        //                 '_id' => $value['id']
        //             ]
        //         ];

        //         $itemKeywords['body'][] = [
        //             'keyword' => $value['keyword'],
        //             'name' => $value['name'],
        //             'meta_title' => $value['meta_title'],
        //             'meta_description' => $value['meta_description'],
        //             'meta_keyword' => $value['meta_keyword'],
        //             'url' => $value['url'],
        //             'image_url' => $value['image_url'],
        //             'type' => $type,
        //             'store_id' => $value['store_id'],
        //             'filter' => $value['filter'],
        //             'position' => (!empty($value['position'])) ? (int) $value['position'] : null,
        //             'relation' => (!empty($value['relation'])) ? $value['relation'] : '',
        //             'show_hide' => (!empty($value['show_hide'])) ? $value['show_hide'] : Keywords::SHOW,
        //             'status' => (!empty($value['status'])) ? $value['status'] : Keywords::STATUS_TYPE["active"]
        //         ];
        //     }

        //     try{
        //         $result = $this->client->bulk($itemKeywords);
        //         if(!empty($result)){
        //             $countKeyword += sizeof($result['items']);
        //         }
        //     } catch (Exception $e) {
        //         echo $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
        //     }
        // }

        // echo '+ Index <b>'.$countKeyword. '</b> Keywords.';

        // echo '<p>-------------------------------------- <b>SEARCHS</b> ------------------------------------- </p>';
        // $recordsCount = Searchs::count();
        // $totalPage = $this->recordsCountToPagesCount($recordsCount, $pageSize);
        // $countKeywordInput = 0;
        // for($pageId=0; $pageId < $totalPage; $pageId++){
        //     $searchs = Searchs::forPage($pageId + 1, $pageSize)->get()->toArray();
        //     $itemSearch = array();
        //     foreach($searchs as $key => $value){
        //         $itemSearch['body'][] = [
        //             'index' => [
        //                 '_index' => 'mse',
        //                 '_type' => 'searchs',
        //                 '_id' => $value['id']
        //             ]
        //         ];

        //         $itemSearch['body'][] = [
        //             'name' => $value['name'],
        //             'crc' => $value['crc']
        //         ];
        //     }

        //     try{
        //         $result = $this->client->bulk($itemSearch);
        //         if(!empty($result)){
        //             $countKeywordInput += sizeof($result['items']);
        //         }
        //     } catch (Exception $e) {
        //         echo $e->getMessage() . " Line: {$e->getLine()} File: {$e->getFile()}";
        //     }
        // }
        // echo '+ Index <b>'.$countKeywordInput. '</b> Search Keywords.';

        self::$client->indices()->refresh(array("index" => Config::get("app.elasticSearch.index")));
        return;
    }

    private function config(){
        //create index
        $params["index"] = Config::get("app.elasticSearch.index");
        if(self::$client->indices()->exists($params)){
            self::$client->indices()->delete($params);
        }

        $listType = array_keys(Config::get("app.elasticSearch.type"));
        //mapping
        foreach($listType as $item) {
            $params["body"]["mappings"][$item]["properties"] = Config::get("app.elasticSearch.type.".$item.".mappingFields");
        }

        //settings
        //ASCII Folding Token Filter
        $params["body"]["settings"]["analysis"]["analyzer"]["default"]["tokenizer"] = "standard";
        $params["body"]["settings"]["analysis"]["analyzer"]["default"]["filter"] = array("standard", "asciifolding", "lowercase");
        //quotes filter ve used the characters themselves: "‘=>'"
        $params["body"]["settings"]["analysis"]["char_filter"]["quotes"] = array(
            "type" => "mapping",
            "mappings" => ["\\u0091=>\\u0027", "\\u0092=>\\u0027", "\\u2018=>\\u0027", "\\u2019=>\\u0027", "\\u201B=>\\u0027"]
        );
        $params["body"]["settings"]["analysis"]["analyzer"]["quotes_analyzer"] = array("tokenizer" => "standard", "char_filter" => ["quotes"]);
        // search quotes
        $params["body"]["settings"]["analysis"]["analyzer"]["my_analyzer"] = array("tokenizer" => "my_tokenizer");
        $params["body"]["settings"]["analysis"]["tokenizer"]["my_tokenizer"] = array("type" => "pattern");
        //HTML Striptag
        $params["body"]["settings"]["analysis"]["analyzer"]["my_html_analyzer"] = array("tokenizer" => "keyword", "char_filter" => ["html_strip"]);
        //Allow symbol
        $params["body"]["settings"]["analysis"]["analyzer"]["my_ngram_analyzer"] = array("tokenizer" => "my_ngram_tokenizer");
        $params["body"]["settings"]["analysis"]["tokenizer"]["my_ngram_tokenizer"] = array(
            "type" => "nGram",
            "token_chars" => array("letter", "digit", "whitespace", "punctuation", "symbol")
        );
        //Synonyms
        $params["body"]["settings"]["analysis"]["filter"]["my_synonym_filter"] = array(
            "type" => "synonym",
            "synonyms" => Config::get('app.elasticSearch.synonyms')
        );
        $params["body"]["settings"]["analysis"]["analyzer"]["my_synonym_filter"] = array(
            "tokenizer" => "standard",
            "filter" => ["lowercase", "my_synonym_filter"]
        );
        //auto complete
        $params["body"]["settings"]["analysis"]["filter"]["autocompleteFilter"] = array(
            "max_shingle_size" => 5,
            "min_shingle_size" => 2,
            "type" => "shingle",
        );
        $params["body"]["settings"]["analysis"]["analyzer"]["autocomplete"] = array(
            "tokenizer" => "standard",
            "filter" => ["lowercase", "autocompleteFilter"],
            "char_filter" => ["html_strip"],
            "type" => "custom",
            "tokenizer" => "standard"
        );
        //search for a part of a word
        $params["body"]["settings"]["analysis"]["index_analyzer"]["my_index_analyzer"] = array(
            "type" => "custom",
            "tokenizer" => "standard",
            "filter" => array("asciifolding", "lowercase", "mynGram")
        );
        $params["body"]["settings"]["analysis"]["search_analyzer"]["my_search_analyzer"] = array(
            "type" => "custom",
            "tokenizer" => "standard",
            "filter" => array("asciifolding", "standard", "lowercase", "mynGram")
        );
         $params["body"]["settings"]["analysis"]["filter"]["mynGram"] = array(
            "type" => "nGram",
            "min_gram" => 2,
            "max_gram" => 50
        );

        self::$client->indices()->create($params);
        return;
    }
}
?>

