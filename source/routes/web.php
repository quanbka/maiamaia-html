<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route for admin

Auth::routes();

Route::get('system', 'System\IndexController@index')->name('system-index');
Route::get('system/user', 'System\IndexController@user')->name('system-user');
Route::get('system/category/{type}', 'System\CategoryController@index')->name('system-category');
Route::get('system/store', 'System\StoreController@index')->name('system-store');
Route::get('system/deal', 'System\DealController@index')->name('system-deal');
Route::get('system/setting', 'System\SettingController@index')->name('system-setting');
Route::get('system/frontend-config', 'System\SettingController@frontendConfig')->name('frontend-config');
Route::get('system/article', 'System\ArticleController@index')->name('system-article');
Route::get('system/article-beauty', 'System\ArticleBeautyController@index')->name('system-article-beauty');
Route::any('system/news/dialog', 'System\ArticleController@tinymceImageDialog');
Route::any('system/news/upload', 'System\ArticleController@tinymceImageUpload');
Route::get('system/collection', 'System\CollectionController@index')->name('system-collection');
Route::get('system/contact', 'System\ContactController@index')->name('system-contact');

Route::group(['namespace' => 'System'], function () {
    Route::get('system/order', 'OrderController@index')->name('system::order::index');
    Route::get('system/banner', 'BannerController@index')->name('system-banner');
});
Route::get('system/payment/history', 'System\PaymentController@history')->name('system-payment-history');
Route::get('system/payment/checkout', 'System\PaymentController@checkout')->name('system-payment-checkout');


// Route for frontend

Route::get('/', 'Frontend\IndexController@index');
// Route::get('/gioi-thieu', 'Frontend\IndexController@about')->name('gioi-thieu');

Route::get('/tong-quan', 'Frontend\IndexController@serviceGeneral');

Route::get('/dich-vu', 'Frontend\IndexController@service');
Route::get('/tim-kiem', 'Frontend\IndexController@search');
Route::get('/dich-vu/{slug}', 'Frontend\ServiceController@detail');
Route::get('/benh-ly-da-lieu', 'Frontend\CategoryController@benhLyDaLieu');
Route::get('/tham-my-cong-nghe-cao', 'Frontend\CategoryController@thamMyCongNgheCao');

Route::get('/bac-sy/{slug}', 'Frontend\DoctorController@doctor');

Route::get('/dang-ky-kham', 'Frontend\RegisterController@register')->name('dang-ky-kham');
Route::post('/dang-ky-kham', 'Frontend\RegisterController@send')->name('dang-ky-kham');

Route::get("/gioi-thieu-phong-kham", "Frontend\ServiceController@detail");
Route::get("/su-menh-tam-nhin", "Frontend\ServiceController@detail");
Route::get("/co-so-vat-chat", "Frontend\ServiceController@detail");

Route::get('/{slug}', 'Frontend\CategoryController@index');
