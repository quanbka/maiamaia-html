<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/10/18
 * Time: 3:03 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
