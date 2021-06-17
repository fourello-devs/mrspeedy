<?php


namespace FourelloDevs\MrSpeedy\Models;

use Illuminate\Support\Collection;

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

    /**
     * Get All Bank Cards
     *
     * @return array|Collection|mixed
     */
    public static function get()
    {
        $res = mrspeedy()->makeRequest(FALSE, 'bank-cards', []);

        if ($res->ok()) {
            $cards = $res->json('bank_cards');
            if (empty($cards) === FALSE) {
                $result = collect();
                foreach ($cards as $card) {
                    $result->add(new BankCard($card));
                }
                return $result;
            }
        }

        return $res->json();
    }
}
