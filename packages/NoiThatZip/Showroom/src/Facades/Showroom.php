<?php

namespace NoiThatZip\Showroom\Facades;

use Illuminate\Support\Facades\Facade;

class Showroom extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'showroom';
    }
}
