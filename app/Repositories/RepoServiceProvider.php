<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('App\Repositories\Airport\IAirportRepository', 'App\Repositories\Airport\EloquentAirportRepository');
    }
}
