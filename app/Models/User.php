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

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $geoData = GeoData::get();

        $this->ip = $geoData->query;
        $this->user_agent = request()->server('HTTP_USER_AGENT');
        $this->country = $geoData->country;
    }

}
