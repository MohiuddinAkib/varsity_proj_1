<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\SeminarCreate;
use App\Http\Livewire\SeminarList;
use App\Http\Livewire\SocialActivityCreate;
use App\Http\Livewire\SocialActivityList;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HostAdminCreate;
use App\Http\Livewire\LocalAdminList;
use App\Http\Livewire\LocalAdminCreate;
use App\Http\Livewire\OrganizationList;
use App\Http\Livewire\OrganizationCreate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", function () {
    return view("welcome");
});


Route::get("/dashboard", Dashboard::class)
    ->middleware(["auth"])
    ->name("dashboard");

Route::get("/host-admin-create", HostAdminCreate::class)
    ->middleware(["auth", "role:super_admin"])
    ->name("host_admin.create");

Route::get("/organization", OrganizationList::class)
    ->middleware(["auth", "role:host_admin|super_admin"])
    ->name("organization.create");

Route::get("/organization-create", OrganizationCreate::class)
    ->middleware(["auth", "role:host_admin"])
    ->name("organization.create");

Route::get("/local-admin", LocalAdminList::class)
    ->middleware(["auth", "role:host_admin"])
    ->name("local_admin.index");

Route::get("/local-admin-create", LocalAdminCreate::class)
    ->middleware(["auth", "role:host_admin", "shoud_have_organization_before_local_admin_create"])
    ->name("local_admin.create");

Route::get("/social-activity", SocialActivityList::class)
    ->middleware(["auth", "role:local_admin|host_admin"])
    ->name("social_activity.index");

Route::get("/social-activity-create", SocialActivityCreate::class)
    ->middleware(["auth", "role:local_admin"])
    ->name("social_activity.create");

Route::get("/seminar", SeminarList::class)
    ->middleware(["auth", "role:local_admin|host_admin"])
    ->name("seminar.index");

Route::get("/seminar-create", SeminarCreate::class)
    ->middleware(["auth", "role:local_admin"])
    ->name("seminar.create");

require __DIR__ . "/auth.php";



