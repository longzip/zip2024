<?php

namespace NoiThatZip\Taskable\Facades;

use Illuminate\Support\Facades\Facade;

class Taskable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'taskable';
    }
}
