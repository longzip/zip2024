<?php

namespace Lolong\Contact;

use Illuminate\Support\Facades\Facade;

class ContactFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'contact';
    }
}