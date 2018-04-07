<?php
/**
 * Created by PhpStorm.
 * User: newexe
 * Date: 07.04.18
 * Time: 19:59
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class HMACHasher extends Facade
{
    protected static function getFacadeAccessor() { return 'hmac_hasher'; }
}