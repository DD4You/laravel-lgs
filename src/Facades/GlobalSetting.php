<?php

namespace DD4You\Lgs\Facades;

use Illuminate\Support\Facades\Facade;

class GlobalSetting extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'g_settings';
    }
}
