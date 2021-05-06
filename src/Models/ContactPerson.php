<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class ContactPerson
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class ContactPerson extends BaseModel
{
    /**
     * Phone number of the person at the address.
     * Default value: null.
     * @var string|null
     */
    public $phone;

    /**
     * Name of the person on the address. Maximum length is 350 characters.
     * Default value: null.
     * @var string|null
     */
    public $name;
}
