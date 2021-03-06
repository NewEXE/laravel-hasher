<?php

namespace App\Models;

use App\Services\GeoData;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'ip', 'user_agent', 'country',
    ];

    /**
     * @var object
     */
    private $geoData;

    /**
     * @param array $options
     * @return User
     */
    public function saveIfNotExists(array $options = [])
    {
        $this->geoData = GeoData::get();

        $this->ip = $this->geoData->query;
        $this->user_agent = request()->server('HTTP_USER_AGENT');
        $this->country = $this->geoData->country;

        $existingUser = User::where('ip', $this->ip)->first();
        if ($existingUser)
        {
            return $existingUser;
        }
        else
        {
            $this->save($options);
            return $this;
        }
    }

    public function hashes()
    {
        return $this->hasMany(UserHash::class);
    }

}
