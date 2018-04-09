<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHash extends Model
{
    protected $fillable = [
        'id',
        'hash_algorithm_key',
        'hash',
        'user_id',
        'word_id',
        'hash_algorithm_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo(Vocabulary::class, 'word_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function algorithm()
    {
        return $this->belongsTo(HashAlgorithm::class);
    }
}
