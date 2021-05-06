<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class Checkin
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class Checkin extends BaseModel
{
    /**
     * Full name of the recipient who met the courier.
     * @var string|null
     */
    public $recipient_full_name;

    /**
     * Position of the recipient who met the courier.
     * @var string|null
     */
    public $recipient_position;
}
