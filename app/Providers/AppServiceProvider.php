<?php

namespace App\Providers;

use App\Contract\IUserService;
use App\Contract\ISeminarService;
use App\Contract\IOrganizationService;
use App\Contract\ISocialActivityService;

use App\Services\UserService;
use App\Services\SeminarService;
use App\Services\OrganizationService;
use App\Services\SocialActivityService;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(ISeminarService::class, SeminarService::class);
        $this->app->bind(IOrganizationService::class, OrganizationService::class);
        $this->app->bind(ISocialActivityService::class, SocialActivityService::class);
    }
}
