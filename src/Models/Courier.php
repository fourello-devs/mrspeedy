<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class Courier
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class Courier extends BaseModel
{
    /**
     * Courier ID.
     * @var int
     */
    public $courier_id;

    /**
     * Surname of the courier.
     * @var string
     */
    public $surname;

    /**
     * Name of the courier.
     * @var string
     */
    public $name;

    /**
     * Middlename of the courier.
     * @var string
     */
    public $middlename;

    /**
     * Phone of the courier.
     * @var string
     */
    public $phone;

    /**
     * URL of the courier's photo.
     * @var string|null
     */
    public $photo_url;

    /**
     * Latitude of the location.
     * Only for active orders, if the courier is on the way.
     * @var string|null
     */
    public $latitude;

    /**
     * Longitude of the location.
     * Only for active orders, if the courier is on the way.
     * @var string|null
     */
    public $longitude;
}
