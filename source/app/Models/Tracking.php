<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/18/18
 * Time: 11:31 AM
 */

namespace App\Models;
class Tracking extends BaseModel
{


    protected $table = 'tracking';
    protected $fillable = [
        'user_id', 'store_id', 'deal_id', 'custom_id',
        'cash_back_rate', 'refer_url',  'refer_domain', 'user_agent'
    ];

    public function store()
    {
        return $this->belongsTo('App\Models\Store', 'store_id', 'id');
    }
}
