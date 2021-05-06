<?php

namespace FourelloDevs\MrSpeedy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MrSpeedy
 * @package FourelloDevs\MrSpeedy\Facades
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class MrSpeedy extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'mr-speedy';
    }
}
