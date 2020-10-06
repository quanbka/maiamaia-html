<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 2/28/2018
 * Time: 11:18 AM
 */

namespace App\Models;


class Contact extends BaseModel
{
    protected $table = 'contacts';
    protected $fillable = [
        'name', 'email', 'detail', 'is_solved'
    ];
}