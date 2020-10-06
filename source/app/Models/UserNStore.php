<?php

namespace App\Models;

class UserNStore extends BaseModel {

    protected $table = 'users_n_stores';
    protected $fillable = [
        'user_id', 'store_id'
    ];
    public $timestamps = false;

}
