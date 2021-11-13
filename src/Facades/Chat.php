<?php

namespace Pruteanu\InterChat\Facades;

use Illuminate\Support\Facades\Facade;

class Chat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'chat';
    }
}
