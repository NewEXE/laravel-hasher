<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HashAlgorithm extends Model
{
    /**
     * @var string Shared secret key used for generating the HMAC variant of the message digest
     */
    const HMAC_KEY = 'secretKey';
}
