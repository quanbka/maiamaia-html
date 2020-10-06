<?php

namespace App\Models;

class Store extends BaseModel {

    const STATUS_ENABLE = 'enable';
    const STATUS_DISABLE = 'disable';
    protected $table = 'stores';
    protected $fillable = [
        'logo_url', 'name', 'category_id',
        'description', 'meta_title', 'meta_description', 'cash_back_rate',
        'slug', 'meta_keywords', 'status', 'config',
        'origin_url', 'affiliate_url', 'creator_id', 'modifier_id','old_cash_back_rate'
    ];

    public static function boot() {
        static::saving(function ($model) {
            $affiliateLink = $model->affiliate_url;
            $originLink = $model->origin_url;
            $model->affiliate_url = \App::make("linkGeneratorService")->buildAffilidateUrl(["originUrl" => $originLink, "storeId" => !empty($model->id)?$model->id:-1]);
            if (empty($originLink)) {
                $model->origin_url = $affiliateLink;
            }
        });
    }

    public function link() {
        return route('listByStore', ['slug' => $this->slug ]);
    }

}
