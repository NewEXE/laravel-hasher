<?php

namespace App\Models;

use App\Services\GeoData;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->geoData = GeoData::get();

        $this->ip = $this->geoData->query;
        $this->user_agent = request()->server('HTTP_USER_AGENT');
        $this->country = $this->geoData->country;
    }

    /**
     * @param array $options
     * @return bool|void
     */
    public function saveIfNotExists(array $options = [])
    {
        $existingUser = User::where('ip', $this->ip)->first();
        if ($existingUser)
        {
            return;
        }

        return $this->save($options);
    }

}
