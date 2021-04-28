<?php


namespace App\Facades;


use App\Contract\ISeminarService;
use Illuminate\Support\Facades\Facade;

class Seminar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ISeminarService::class;
    }
}
