<?php

namespace App\Providers;

use App\Http\Controllers\Service\DealService;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CollectionRepository;
use App\Repositories\ContactRepository;
use App\Repositories\DealRepository;
use App\Repositories\Network\LinkGeneratorRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\RedisRepository;
use App\Repositories\SettingRepository;
use App\Repositories\StoreRepository;
use App\Repositories\TrackingRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('redisService', function () {
            return new RedisRepository();
        });
        $this->app->singleton('linkGeneratorService', function () {
            return new LinkGeneratorRepository();
        });
        $this->app->singleton('settingService', function () {
            return new SettingRepository();
        });
        $this->app->singleton('paymentService', function () {
            return new PaymentRepository();
        });
        $this->app->singleton('storeService', function () {
            return new StoreRepository();
        });
        $this->app->singleton('dealService', function () {
            return new DealRepository();
        });
        $this->app->singleton('trackingService', function () {
            return new TrackingRepository();
        });
        $this->app->singleton('articleService', function () {
            return new ArticleRepository();
        });
        $this->app->singleton('categoryService', function () {
            return new CategoryRepository();
        });
        $this->app->singleton('collectionService', function(){
            return new CollectionRepository();
        });
        $this->app->singleton('contactService', function(){
            return new ContactRepository();
        });
    }
}
