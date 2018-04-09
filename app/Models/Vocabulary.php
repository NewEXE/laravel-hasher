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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function similar()
    {
        return $this->hasMany(Vocabulary::class, 'id', 'id')
            ->where('word', 'like', '%' . $this->word . '%');
            //->where('word', 'not like', $this->word);
    }
}
