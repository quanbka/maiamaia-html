<?php

namespace App\Models;

class Payment extends BaseModel
{
    protected $table = 'payments';
    protected $fillable = [
        'amount', 'user_id', 'checkout_at', 'info',
    ];
}
