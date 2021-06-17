<?php


namespace FourelloDevs\MrSpeedy\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class Order
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class Order extends BaseModel
{
    /**
     * Type of Order
     *
     * @var string
     */
    public $type;

    /**
     * Full order ID.
     * @var int
     */
    public $order_id;

    /**
     * Order name (short order ID).
     * @var string
     */
    public $order_name;

    /**
     * Order creation date and time.
     * @var string
     */
    public $created_datetime;

    /**
     * Order completion date and time.
     * @var string|null
     */
    public $finish_datetime;

    /**
     * Order status.
     * @var string|null
     */
    public $status;

    /**
     * Order status description.
     * @var string
     */
    public $status_description;

    /**
     * Delivery contents. Maximum length is 5,000 characters.
     * Try to make this description useful for the courier. For example, putting a category from your catalog here is better than only a concrete model number. If the item is fragile or oversized, please mention it here.
     * Default value: null.
     * @var string|null
     */
    public $matter;

    /**
     * Vehicle type.
     * Default value: 8 (Motorbike).
     * @var int
     */
    public $vehicle_type_id;

    /**
     * Total weight in kilograms.
     * Default value: 0.
     * @var int
     */
    public $total_weight_kg;

    /**
     * Insured amount.
     * Default value: "0.00".
     * @var string
     */
    public $insurance_amount;

    /**
     * Insurance fee.
     * @var string
     */
    public $insurance_fee_amount;

    /**
     * Whether to send SMS notifications to the client.
     * Default value: false.
     * @var bool
     */
    public $is_client_notification_enabled;

    /**
     * Whether to send SMS notifications to recipients on addresses.
     * Default value: false.
     * @var bool
     */
    public $is_contact_person_notification_enabled;

    /**
     * Automatically optimize route (addresses will be arranged in the optimal order).
     * Default value: false.
     * @var bool
     */
    public $is_route_optimizer_enabled;

    /**
     * Number of necessary loaders to move the delivered goods, including the driver. Maximum is 11.
     * Default value: 0.
     * @var int
     */
    public $loaders_count;

    /**
     * List of addresses (points) for the courier to visit. Maximum is 99 points.
     * Default value: [].
     * @var Point[]
     */
    public $points;

    /**
     * Details of the money transfer for backpayment. A credit card number or other payment system information. Maximum length is 300 characters.
     * Default value: null.
     * @var string|null
     */
    public $backpayment_details;

    /**
     * Backpayment amount.
     * @var string
     */
    public $backpayment_amount;

    /**
     * URL of backpayment photo (receipt or other payment verification).
     * @var string|null
     */
    public $backpayment_photo_url;

    /**
     * Payment method (if different from default).
     * Default value: null.
     * @var string|null
     */
    public $payment_method;

    /**
     * Order price.
     * @var string
     */
    public $payment_amount;

    /**
     * Delivery fee.
     * Part of order price (payment_amount).
     * @var string
     */
    public $delivery_fee_amount;

    /**
     * Intercity Delivery fee.
     * @example "0.00"
     *
     * @var string
     */
    public $intercity_delivery_fee_amount;

    /**
     * Large weight fee.
     * Part of order price (payment_amount).
     * @var string
     */
    public $weight_fee_amount;

    /**
     * Loading / heavy lifting fee.
     * Part of order price (payment_amount).
     * @var string
     */
    public $loading_fee_amount;

    /**
     * Money handling fee: backpayment transfer, buyout operations.
     * Part of order price (payment_amount).
     * @var string
     */
    public $money_transfer_fee_amount;

    /**
     * Extra fee for suburban parts of the courier's route.
     * Part of order price (payment_amount).
     * @var string
     */
    public $suburban_delivery_fee_amount;

    /**
     * Extra fee for overnight parts of the courier's route.
     * Part of order price (payment_amount).
     * @var string
     */
    public $overnight_fee_amount;

    /**
     * Discount amount.
     * Part of order price (payment_amount).
     * @var string
     */
    public $discount_amount;

    /**
     * Extra fee for issuing a cashier's check.
     * Part of order price (payment_amount).
     * @var string
     */
    public $cod_fee_amount;

    /**
     * URL of itinerary document.
     * @var string
     */
    public $itinerary_document_url;

    /**
     * URL of waybill document.
     * @var string
     */
    public $waybill_document_url;

    /**
     * Courier parameters.
     * @var Courier
     */
    public $courier;

    /**
     * Is motobox required.
     * Default value: false.
     * @var bool
     */
    public $is_motobox_required;

    /**
     * Bank card ID (required for bank_card payment method).
     * Default value: null.
     * @var int|null
     */
    public $bank_card_id;

    // SETTERS

    /**
     * @param array|Point[] $points
     */
    public function setPoints(array $points)
    {
        if (empty($points) === FALSE) {
            if ($points[0] instanceof Point) {
                $this->points = $points;
            }
            else {
                foreach ($points as $point) {
                    $this->points[] = new Point($point);
                }
            }
        }
    }

    /**
     * @param array|Courier $courier
     */
    public function setCourier($courier): void
    {
        $this->courier = is_array($courier) ? new Courier($courier) : $courier;
    }

    /**
     * @return array|Courier|mixed
     */
    public function getCourier()
    {
        $data['order_id'] = $this->order_id;

        $res = mrspeedy()->makeRequest(FALSE, 'courier', $data);

        if ($res->ok() && is_request_or_array_filled($res->json(), 'courier')) {
            $this->courier = $this->courier ? $this->courier->parse($res, 'courier') : new Courier($res, 'courier');
            return $this->courier;
        }

        return $res->json();

    }

    /***** METHODS *****/

    /**
     * Find Order
     *
     * @param string $order_id
     * @return array|Order|mixed
     */
    public static function find(string $order_id)
    {
        $result = static::get(Arr::wrap($order_id));
        return $result instanceof Collection ? $result->first() : $result;
    }

    /**
     * Get Orders
     *
     * @param array $order_id
     * @param string|null $status
     * @param int $offset
     * @param int $count
     * @return array|Collection|mixed
     */
    public static function get(array $order_id, string $status = null, int $offset = 0, int $count = 10)
    {
        $data = array_filter_recursive(get_defined_vars());

        $res = mrspeedy()->makeRequest(FALSE, 'orders', $data);

        if ($res->ok()) {
            $orders = $res->json('orders');
            if (empty($orders) === FALSE) {
                $result = collect();
                foreach ($orders as $order){
                    $result->add(new Order($order));
                }
                return $result;
            }
        }

        return $res->json();
    }

    /**
     * Get All Orders
     *
     * @return array|Collection|mixed
     */
    public static function all(string $status = null)
    {
        return static::get([], $status);
    }

    /**
     * Order Price Calculation
     *
     * @return $this|array|mixed
     */
    public function calculate()
    {
        try {
            $data = json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        }
        catch (\JsonException $exception) {
            return $exception->getMessage();
        }

        $res = mrspeedy()->makeRequest(TRUE, 'calculate-order', $data);

        if ($res->ok() && is_request_or_array_filled($res->json(), 'warnings') === FALSE) {
            $this->parse($res, 'order');
            return $this;
        }

        return $res->json();
    }

    /**
     * Place Order
     *
     * @return $this|array|mixed
     */
    public function execute()
    {
        try {
            $data = json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        }
        catch (\JsonException $exception) {
            return $exception->getMessage();
        }

        $res = mrspeedy()->makeRequest(TRUE, 'create-order', $data);

        if ($res->ok()) {
            $this->parse($res, 'order');
            return $this;
        }

        return $res->json();
    }

    /**
     * Update Order
     *
     * @return $this|array|mixed
     */
    public function update()
    {
        try {
            $data = json_decode(json_encode($this, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);
        }
        catch (\JsonException $exception) {
            return $exception->getMessage();
        }

        // Remove unrelated to Order creation

        $forget_list = [
            'order_name',
            'created_datetime',
            'status',
            'status_description',
            'insurance_fee_amount',
            'backpayment_amount',
            'payment_amount',
            'delivery_fee_amount',
            'intercity_delivery_fee_amount',
            'weight_fee_amount',
            'loading_fee_amount',
            'money_transfer_fee_amount',
            'suburban_delivery_fee_amount',
            'overnight_fee_amount',
            'discount_amount',
            'cod_fee_amount',
        ];

        $num_points = count(Arr::get($data, 'points', []));

        for ($i = 0; $i < $num_points; $i++){
            $forget_list[] = 'points.' . $i . '.tracking_url';
        }

        Arr::forget($data, $forget_list);

        // Proceed to Update

        $res = mrspeedy()->makeRequest(TRUE, 'edit-order', $data);

        if ($res->ok()) {
            $this->parse($res, 'order');
            return $this;
        }

        return $res->json();
    }

    /**
     * Cancel Order
     *
     * @return $this|array|mixed
     */
    public function cancel()
    {
        $data['order_id'] = $this->order_id;

        $res = mrspeedy()->makeRequest(TRUE, 'cancel-order', $data);

        if ($res->ok()) {
            $this->parse($res, 'order');
            return $this;
        }

        return $res->json();
    }
}
