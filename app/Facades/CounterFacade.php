<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the CounterContract
 * @method static int increment(string $keys, array $tags = null)
 */
class CounterFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'App\Contracts\CounterContract';
    }
}
