<?php

namespace App\Providers;

use App\Helpers\HmacHasher;
use App\Repositories\Hasher\HmacHasherRepository;
use Illuminate\Support\ServiceProvider;

class HasherServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('hmac_hasher', function () {
            return new HmacHasher(new HmacHasherRepository());
        });
    }
}
