<?php

namespace nolin\laratools\Facades;

use Illuminate\Support\Facades\Facade;

class Laratools extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laratools';
    }
}
