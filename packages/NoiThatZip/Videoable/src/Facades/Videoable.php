<?php

namespace NoiThatZip\Videoable\Facades;

use Illuminate\Support\Facades\Facade;

class Videoable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'videoable';
    }
}
