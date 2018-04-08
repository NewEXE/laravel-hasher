<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 08.04.18
 * Time: 12:49
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Models
 */
class BaseModel extends Model
{
    /**
     * @return string Model's table name
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }
}