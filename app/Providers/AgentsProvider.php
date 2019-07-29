<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AgentsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('App\Agents\Interfaces\CrowdDetailInterface', 'App\Agents\Eloquents\CrowdDetailEloquent');
        $this->app->bind('App\Agents\Interfaces\CrowdInterface', 'App\Agents\Eloquents\CrowdEloquent');
        $this->app->bind('App\Agents\Interfaces\DotaPonyInterface', 'App\Agents\Eloquents\DotaPonyEloquent');
        $this->app->bind('App\Agents\Interfaces\GalleryInterface', 'App\Agents\Eloquents\GalleryEloquent');
        $this->app->bind('App\Agents\Interfaces\GamePonyInterface', 'App\Agents\Eloquents\GamePonyEloquent');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}