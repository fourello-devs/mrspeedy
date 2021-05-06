<?php

namespace FourelloDevs\MrSpeedy;

use FourelloDevs\MrSpeedy\Models\BankCard;
use FourelloDevs\MrSpeedy\Models\Client;
use FourelloDevs\MrSpeedy\Models\Order;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Class MrSpeedy
 * @package FourelloDevs\MrSpeedy
 *
 * @author James Carlo S. Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-04
 */
class MrSpeedy
{
    /**
     * MrSpeedy API Token
     * @var string
     */
    public $apiToken;

    /**
     * MrSpeedy Callback Token
     * @var string
     */
    public $callbackToken;

    /**
     * MrSpeedy Callback URL
     * @var string
     */
    public $callbackUrl;

    /**
     * MrSpeedy Environment
     * @var string
     */
    public $environment;

    /**
     * MrSpeedy Production URL
     */
    public const PRODUCTION_URL = 'https://robot.mrspeedy.ph/api/business/1.1';

    /**
     * MrSpeedy Test URL
     */
    public const TEST_URL = 'https://robotapitest.mrspeedy.ph/api/business/1.1';

    /**
     * MrSpeedy constructor.
     */
    public function __construct()
    {
        $this->apiToken = config('mr-speedy.api.token');
        $this->callbackToken = config('mr-speedy.callback.token');
        $this->callbackUrl = config('mr-speedy.callback.url');
        $this->environment = config('mr-speedy.environment', 'TEST');
    }

    // Getters

    /**
     * Get API Token
     * @return string
     */
    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    /**
     * Get Callback Token
     * @return string
     */
    public function getCallbackToken(): string
    {
        return $this->callbackToken;
    }

    /**
     * Get Callback URL
     * @return string
     */
    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    /**
     * Get URL for HTTP Requests
     * @return string
     */
    public function getBaseUrl(): string
    {
        if (strtoupper($this->environment) === 'PRODUCTION') {
            return self::PRODUCTION_URL;
        }

        return self::TEST_URL;
    }

    /**
     * Get environment type
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    // Setters

    /**
     * Set API Token
     * @param string $apiToken
     */
    public function setApiToken(string $apiToken): void
    {
        $this->apiToken = $apiToken;
    }

    /**
     * Set Callback Token
     * @param string $callbackToken
     */
    public function setCallbackToken(string $callbackToken): void
    {
        $this->callbackToken = $callbackToken;
    }

    /**
     * Set Callback URL
     * @param string $callbackUrl
     */
    public function setCallbackUrl(string $callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * Set environment type
     * @param string $environment
     */
    public function setEnvironment(string $environment): void
    {
        $this->environment = $environment;
    }

    // API METHODS

    /**
     * @param Order $order
     * @return Order|null
     * @throws \JsonException
     */

    public function calculateOrderPrice(Order $order): ?Order
    {
        $result = null;

        $data = json_decode(json_encode($order, JSON_THROW_ON_ERROR), true, 512, JSON_THROW_ON_ERROR);

        $res = $this->makeRequest(TRUE, 'calculate-order', $data);

        if ($res->ok()) {
            $result = new Order($res, 'order');
        }

        return $result;
    }

    /**
     * Placing an order
     *
     * @throws \JsonException
     */

    public function placeOrder(Order $order): void
    {

    }

    /**
     * Order editing
     *
     * @throws \JsonException
     */

    public function editOrder()
    {

    }

    /**
     * Canceling an order
     *
     * @throws \JsonException
     */

    public function cancelOrder()
    {

    }


    /**
     * List of orders
     *
     * @param int|array|null $order_id
     * @param string|null $status
     * @param int|null $offset
     * @param int|null $count
     * @return Order[]
     */

    public function getOrders($order_id = NULL, string $status = NULL, ?int $offset = 0, ?int $count = 10): array
    {
        $result = [];

        $data = get_defined_vars();

        $res = $this->makeRequest(FALSE, 'orders', $data);

        if ($res->ok()) {
            $orders = $res->json('bank_cards');
            if (empty($orders) === FALSE) {
                foreach ($orders as $order){
                    $result[] = new Order($order);
                }
            }
        }

        return $result;
    }

    /**
     * Courier info and courier location
     *
     */

    public function getCourier()
    {

    }

    /**
     * Client profile info
     *
     * @return Client|null
     */

    public function getClient(): ?Client
    {
        $result = null;

        $res = $this->makeRequest(FALSE, 'client', []);

        if ($res->ok()) {
            $result = new Client($res, 'client');
        }

        return $result;
    }

    /**
     * Available bank cards
     *
     * @return BankCard[]
     */

    public function getBankCards(): array
    {
        $result = [];

        $res = $this->makeRequest(FALSE, 'bank-cards', []);

        if ($res->ok()) {
            $cards = $res->json('bank_cards');
            if (empty($cards) === FALSE) {
                foreach ($cards as $card){
                    $result[] = new BankCard($card);
                }
            }
        }

        return $result;
    }

    /**
     * Create draft deliveries
     *
     */

    public function createDraftDelivery()
    {

    }

    /**
     * Edit draft deliveries
     *
     */

    public function editDraftDelivery()
    {

    }

    /**
     * Delete draft deliveries
     *
     */

    public function deleteDraftDeliveries()
    {

    }

    /**
     * List of deliveries
     *
     */

    public function getDeliveries()
    {

    }

    /**
     * Make routes from deliveries
     *
     */

    public function makeRoutesFromDeliveries()
    {

    }

    // OTHER METHODS

    /**
     * @param bool $is_post_method
     * @param string $append_url
     * @param array $data
     * @return PromiseInterface|Response
     */
    public function makeRequest(bool $is_post_method = FALSE, string $append_url = '', array $data = [])
    {
        // Prepare URL

        $url = $this->getBaseUrl();

        if(empty(trim($append_url)) === FALSE) {
            $url .= '/' . $append_url;
        }

        // Prepare Data

        $data = array_filter_recursive($data);

        $response = Http::withHeaders(['X-DV-Auth-Token' => $this->getApiToken()])->bodyFormat('json');
        if ($is_post_method) {
            $response = $response->post($url, $data);
        }
        else {
            $response = $response->get($url, $data);
        }
        return $response;
    }
}
