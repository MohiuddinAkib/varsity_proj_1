<?php

namespace App\Providers;

use App\Models\Organization;
use App\Models\SocialActivity;
use App\Policies\OrganizationPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\SocialActivityPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Organization::class => OrganizationPolicy::class,
        SocialActivity::class => SocialActivityPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("create-host-admin", [UserPolicy::class, "createHostAdmin"]);
        Gate::define("create-local-admin", [UserPolicy::class, "createLocalAdmin"]);
        Gate::define("delete-local-admin", [UserPolicy::class, "deleteLocalAdmin"]);
    }
}
