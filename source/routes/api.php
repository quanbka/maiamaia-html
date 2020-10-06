<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

 Route::get('/resources/{path}', [
     'as' => 'upload.get',
     'uses' => 'Service\FileService@get',
 ])->where('path', '(.*)');

Route::get('/search', 'Service\SearchService@search');
Route::get('/searchStore', 'Service\SearchService@searchStore');
Route::get('/searchDeal', 'Service\SearchService@searchDeal');
Route::get('/init', 'Service\ElasticSearchService@init');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });

//User
    Route::get('/user/find', 'Service\UserService@find');
    Route::post('/user/create', 'Service\UserService@create');
    Route::get('/user/{user}', 'Service\UserService@index');
    Route::put('/user/{user}', 'Service\UserService@update');
    Route::patch('/user/{user}', 'Service\UserService@update');
    Route::delete('/user/{user}', 'Service\UserService@delete');

//Setting
    Route::get('/setting/find', 'Service\SettingService@find');
    Route::post('/setting/update', 'Service\SettingService@update');
    Route::post('/setting/delete', 'Service\SettingService@delete');
    Route::post('/setting/create', 'Service\SettingService@create');



    Route::group(['namespace' => 'Service'], function () {
//deal
        Route::get('deal', [
            'as' => 'dealService.index',
            'uses' => 'DealService@index',
        ]);
        Route::post('deal', [
            'as' => 'dealService.store',
            'uses' => 'DealService@store',
        ]);
        Route::get('deal/{id}', [
            'as' => 'dealService.show',
            'uses' => 'DealService@show',
        ]);
        Route::put('deal/{id}', [
            'as' => 'dealService.update',
            'uses' => 'DealService@update',
        ]);
        Route::delete('deal/{id}', [
            'as' => 'dealService.destroy',
            'uses' => 'DealService@destroy',
        ]);
        Route::post('deal/update-multi-order', [
            'as' => 'dealService.update-multi-order',
            'uses' => 'DealService@updateMultiOrder',
        ]);
        //store
        Route::put('store/build-link', [
            'as' => 'storeService.buildLink',
            'uses' => 'StoreService@buildLink',
        ]);
        Route::get('store', [
            'as' => 'storeService.index',
            'uses' => 'StoreService@index',
        ]);
        Route::get('all-store', [
            'as' => 'storeService.all',
            'uses' => 'StoreService@all',
        ]);
        Route::post('store', [
            'as' => 'storeService.store',
            'uses' => 'StoreService@store',
        ]);
        Route::get('store/{id}', [
            'as' => 'storeService.show',
            'uses' => 'StoreService@show',
        ]);
        Route::put('store/{id}', [
            'as' => 'storeService.update',
            'uses' => 'StoreService@update',
        ]);
        Route::delete('store/{id}', [
            'as' => 'storeService.destroy',
            'uses' => 'StoreService@destroy',
        ]);
        Route::post('store/favorite', [
            'as' => 'storeService.storeFavorite',
            'uses' => 'StoreService@favoriteStore',
        ]);
        //category
        Route::get('category', [
            'as' => 'categoryService.index',
            'uses' => 'CategoryService@index',
        ]);
        Route::get('all-category', [
            'as' => 'categoryService.all',
            'uses' => 'CategoryService@allStoreCategories',
        ]);
        Route::post('category', [
            'as' => 'categoryService.store',
            'uses' => 'CategoryService@store',
        ]);
        Route::get('category/{id}', [
            'as' => 'categoryService.show',
            'uses' => 'CategoryService@show',
        ]);
        Route::put('category/{id}', [
            'as' => 'CategoryService.update',
            'uses' => 'CategoryService@update',
        ]);
        Route::delete('category/{id}', [
            'as' => 'categoryService.destroy',
            'uses' => 'CategoryService@destroy',
        ]);
        Route::post('category/update-multi-order', [
            'as' => 'categoryService.update-multi-order',
            'uses' => 'CategoryService@updateMultiOrder',
        ]);
        Route::get('order', [
            'as' => 'orderService.index',
            'uses' => 'OrderService@index',
        ]);
        Route::get('order/{id}', [
            'as' => 'orderService.show',
            'uses' => 'OrderService@show',
        ]);
        Route::put('order/{id}', [
            'as' => 'orderService.update',
            'uses' => 'OrderService@update',
        ]);
        Route::delete('order/{id}', [
            'as' => 'orderService.destroy',
            'uses' => 'OrderService@destroy',
        ]);

        Route::get('order/skimlink/cron', 'OrderService@cronReportSkimlink');
        Route::get('order/viglink/cron', 'OrderService@cronReportViglink');

        Route::post('upload/images', [
            'as' => 'upload.images',
            'uses' => 'FileService@images',
        ]);
        Route::post('upload/files', [
            'as' => 'upload.file',
            'uses' => 'FileService@files',
        ]);
        Route::post('upload/unlink', [
            'as' => 'upload.unlink',
            'uses' => 'FileService@unlink',
        ]);

        Route::get('tracking', [
            'as' => 'trackingService.index',
            'uses' => 'TrackingService@index',
        ]);
        Route::post('tracking', [
            'as' => 'trackingService.store',
            'uses' => 'TrackingService@store',
        ]);
        Route::get('tracking/{id}', [
            'as' => 'trackingService.show',
            'uses' => 'TrackingService@show',
        ]);
        Route::put('tracking/{id}', [
            'as' => 'trackingService.update',
            'uses' => 'TrackingService@update',
        ]);
        Route::delete('tracking/{id}', [
            'as' => 'trackingService.destroy',
            'uses' => 'TrackingService@destroy'
        ]);

        //Collection
        Route::get('collection', [
          'as' => 'collection.index',
          'uses' => 'CollectionService@index'
        ]);
        Route::post('collection', [
            'as' => 'collection.store',
            'uses' => 'CollectionService@store',
        ]);
        Route::get('collection/{id}', [
          'as' => 'collection.store.show',
          'uses' => 'CollectionService@show'
        ]);
        Route::put('collection/{id}',[
          'as' => 'collection.update',
          'uses' => 'CollectionService@update'
        ]);
        Route::delete('collection/{id}',[
          'as' => 'collection.delete',
          'uses' => 'CollectionService@destroy'
        ]);

        //contact
        Route::get('contact', [
            'as' => 'contactService.index',
            'uses' => 'ContactService@index',
        ]);
    });

//Payment
    Route::get('/payment/find-histories', 'Service\PaymentService@findHistories');
    Route::post('/payment/store', 'Service\PaymentService@store');
    Route::put('/payment/update/{id}', 'Service\PaymentService@update');
    Route::delete('/payment/delete/{id}', 'Service\PaymentService@destroy');
    Route::get('/payment/get-list-user-checkout', 'Service\PaymentService@getListUserCheckOut');
    Route::post('/payment/get-list-order-by-payment-id', 'Service\PaymentService@getListOrderByPaymentId');
    Route::post('/payment/get-list-order-by-list-id', 'Service\PaymentService@getListOrderByListId');
    Route::post('/payment/checkout-user', 'Service\PaymentService@checkoutUser');
    Route::post('/payment/checkout-all-user', 'Service\PaymentService@checkoutAllUser');
    Route::get('/setting/find', 'Service\SettingService@find');
    Route::post('/setting/update', 'Service\SettingService@update');
    Route::post('/setting/delete', 'Service\SettingService@delete');
    Route::post('/setting/create', 'Service\SettingService@create');

//Article
    Route::get('/article/index', 'Service\ArticleService@index');
    Route::post('/article/create', 'Service\ArticleService@create');
    Route::post('/article/update', 'Service\ArticleService@update');
    Route::post('/article/update-multi-order', 'Service\ArticleService@updateMultiOrder');
    Route::post('/article/delete', 'Service\ArticleService@delete');

//Cron
    Route::get('/cron/cron-update-status-all-deals', 'Service\CronService@cronUpdateStatusAllDeals');

});

Route::middleware(['auth:api'])->group(function () {
    Route::post('/search-store', 'Service\SearchService@searchStore');
    Route::post('/get-hot-deal', 'Service\DealService@getHotDeal');
    Route::post('/get-list-order-pending', 'Service\OrderService@getListOrderPending');
    Route::post('/get-all-store', 'Service\StoreService@getAllStore');
    Route::post('/get-all-deal', 'Service\DealService@getAllDeal');
    Route::post('/get-user-info', 'Service\UserService@getUserInfo');
});
