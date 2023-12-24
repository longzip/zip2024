<?php

namespace LoLong\NhanVien\Facades;

use Illuminate\Support\Facades\Facade;

class NhanVien extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'nhanvien';
    }
}
