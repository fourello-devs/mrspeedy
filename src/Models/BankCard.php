<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class BankCard
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class BankCard extends BaseModel
{
    /**
     * Bank card ID.
     * @var integer
     */
    public $bank_card_id;

    /**
     * Masked bank card number.
     * @var string|null
     */
    public $bank_card_number_mask;

    /**
     * Expiration date.
     * @var string|null
     */
    public $expiration_date;

    /**
     * Card type.
     * @var string|null
     */
    public $card_type;
}
