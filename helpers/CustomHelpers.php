<?php

/**
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021/05/04
 */

use FourelloDevs\MrSpeedy\MrSpeedy;

if (! function_exists('mrspeedy')) {
    /**
     * @return MrSpeedy
     */
    function mrspeedy(): MrSpeedy
    {
        return resolve('mr-speedy');
    }
}
