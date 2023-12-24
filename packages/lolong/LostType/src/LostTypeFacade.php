<?php

namespace Lolong\LostType;

use Illuminate\Support\Facades\Facade;

class LostTypeFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lost-type';
    }
}