<?php

namespace NoiThatZip\Lostable\Facades;

use Illuminate\Support\Facades\Facade;

class Lostable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lostable';
    }
}
