<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 3/5/2018
 * Time: 2:38 PM
 */

namespace App\Repositories;


use App\Models\Contact;

class ContactRepository extends BaseRepository
{
    const MODEL = Contact::class;

    public function query($filter = [])
    {
        $query = parent::query($filter);
        $tableName = Contact::getTableName().'.';

        if (array_key_exists("name", $filter)) {
            $query->where($tableName . 'name', 'LIKE', '%'.$filter['name'].'%');
        }
        if (array_key_exists("email", $filter)) {
            $query->where($tableName . 'email', 'LIKE', '%' . $filter['email'] . '%');
        }

        return $query;
    }
}