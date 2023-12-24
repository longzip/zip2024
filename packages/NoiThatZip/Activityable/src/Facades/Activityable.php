<?php

namespace NoiThatZip\Activityable\Facades;

use Illuminate\Support\Facades\Facade;

class Activityable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'activityable';
    }
}
