<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class GioHang extends Facade 
{
    public static function getFacadeAccessor()
    {
        return 'giohang';
    }
}