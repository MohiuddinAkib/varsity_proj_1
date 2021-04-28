<?php


namespace App\Facades;


use App\Contract\IOrganizationService;
use Illuminate\Support\Facades\Facade;

class Organization extends Facade
{
    protected static function getFacadeAccessor()
    {
        return IOrganizationService::class;
    }
}
