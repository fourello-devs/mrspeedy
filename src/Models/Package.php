<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class Package
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class Package extends BaseModel
{
    /**
     * Vendor code. Maximum length is 255 characters.
     * Default value: null.
     * @var string|null
     */
    public $ware_code;

    /**
     * Description. Maximum length is 1000 characters.
     * Default value: null.
     * @var string|null
     */
    public $description;

    /**
     * Amount.
     * Default value: 0.
     * @var int
     */
    public $items_count;

    /**
     * Price per item.
     * Default value: "0.00".
     * @var string
     */
    public $item_payment_amount;
}
