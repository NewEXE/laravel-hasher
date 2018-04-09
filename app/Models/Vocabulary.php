<?php

namespace App\Models;

/**
 * Class Vocabulary
 * @package App\Models
 */
class Vocabulary extends BaseModel
{
    /**
     * @var string Database table name
     */
    protected $table = 'vocabulary';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function hashes()
    {
        return $this->hasMany(UserHash::class);
    }
}
