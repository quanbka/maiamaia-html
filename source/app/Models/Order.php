<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/11/18
 * Time: 11:48 AM
 */

namespace App\Models;
class Order extends BaseModel
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'store_id', 'deal_id', 'is_cash_back',
        'cash_back_rate', 'amount', 'cash_back_amount', 'order_number',
        'payment_id', 'info', 'custom_id'
    ];
}
