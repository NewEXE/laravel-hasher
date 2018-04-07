<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HashAlgorithm extends Model
{
    /**
     * @return string Model's table name
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}
