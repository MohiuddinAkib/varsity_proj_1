<?php

use App\Http\Livewire\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HostAdminCreate;
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
    ->name("organiztion.create");

Route::get("/organization-create", OrganizationCreate::class)
    ->middleware(["auth", "role:host_admin"])
    ->name("organiztion.create");

require __DIR__ . "/auth.php";



