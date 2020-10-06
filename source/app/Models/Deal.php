<?php

namespace App\Models;

class Deal extends BaseModel {

    const STATUS_ENABLE = 'enable';
    const STATUS_DISABLE = 'disable';
    const IS_HOT_DEAL = 1;
    const TYPE_COUPON = 'coupon';
    const TYPE_CATEGORY = 'category';
    const TYPE_PROMO = 'promo';

    protected $table = 'deals';
    protected $fillable = [
        'store_id', 'type', 'title',
        'description', 'published_at', 'expired_at', 'cash_back_rate',
        'slug', 'image_url', 'status', 'config', 'sorder',
        'origin_url', 'affiliate_url', 'coupon_code', 'creator_id', 'modifier_id', 'is_hot_deal'
    ];

    public static function boot() {
        static::saving(function ($model) {
            $affiliateLink = $model->affiliate_url;
            $originLink = $model->origin_url;
            $model->affiliate_url = \App::make("linkGeneratorService")->buildAffilidateUrl(["originUrl" => $originLink, "storeId" => $model->store_id]);
            if (empty($originLink)) {
                $model->origin_url = $affiliateLink;
            }
        });
    }

    public function store() {
        return $this->belongsTo('App\Models\Store');
    }

}
