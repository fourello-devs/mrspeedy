<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class Client
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class Client extends BaseModel
{
    /**
     * Full name.
     * @var string|null
     */
    public $name;

    /**
     * Phone.
     * @var string|null
     */
    public $phone;

    /**
     * Email.
     * @var string|null
     */
    public $email;

    /**
     * Legal type.
     * @var string
     */
    public $legal_type;

    /**
     * Allowed payment methods.
     * @var array|null
     */
    public $allowed_payment_methods;

    /**
     * Get Client
     *
     * @return array|mixed|static
     */
    public static function get()
    {
        $res = mrspeedy()->makeRequest(FALSE, 'client', []);

        if ($res->ok()) {
            return new static($res, 'client');
        }

        return $res->json();
    }
}
