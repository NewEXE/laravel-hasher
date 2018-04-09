<?php

namespace App\Models;
use App\Facades\HMACHasher;

/**
 * Class HashAlgorithm
 * @package App\Models
 */
class HashAlgorithm extends BaseModel
{
    public function scopeHmac($query)
    {
        return $query->where('name', 'like', HMACHasher::getRowsPrefix() . '%');
    }
}
