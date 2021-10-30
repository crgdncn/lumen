<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Http\Helpers\ResponseHelper renderSuccess($httpResponseCode)
 * @method static \App\Http\Helpers\ResponseHelper renderError($message, $httpResponseCode)
 */
class ResponseHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Http\Helpers\ResponseHelper::class;
    }

}
