<?php

/**
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021/05/04
 */

use FourelloDevs\MrSpeedy\MrSpeedy;

if (! function_exists('array_filter_recursive')) {
    /**
     * @param array $arr
     * @return array
     */
    function array_filter_recursive(array $arr): array
    {
        $result = [];
        foreach ($arr as $key => $value) {
            if(is_array($value) && empty($value) === FALSE){
                $result[$key] = array_filter_recursive($value);
            }else if(empty($value) === FALSE) {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}

if (! function_exists('mrspeedy')) {
    /**
     * @return MrSpeedy
     */
    function mrspeedy(): MrSpeedy
    {
        return resolve('mr-speedy');
    }
}
