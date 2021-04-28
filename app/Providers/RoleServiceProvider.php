<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            DB::connection()->getPdo();
            if (DB::connection()->getDatabaseName() && Schema::hasTable("roles")) {
                if (Role::whereName("super_admin")->doesntExist())
                    Artisan::call("permission:create-role super_admin");
                if (Role::whereName("local_admin")->doesntExist())
                    Artisan::call("permission:create-role local_admin");
                if (Role::whereName("host_admin")->doesntExist())
                    Artisan::call("permission:create-role host_admin");
            }
        } catch (\Doctrine\DBAL\Driver\PDO\Exception $e) {

        }
    }
}
