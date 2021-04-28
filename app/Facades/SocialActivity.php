<?php


namespace App\Facades;


use App\Contract\ISocialActivityService;
use Illuminate\Support\Facades\Facade;

class SocialActivity extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ISocialActivityService::class;
    }
}
