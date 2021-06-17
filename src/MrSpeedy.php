<?php

namespace FourelloDevs\MrSpeedy;

use FourelloDevs\MrSpeedy\Models\BankCard;
use FourelloDevs\MrSpeedy\Models\BaseModel;
use FourelloDevs\MrSpeedy\Models\Client;
use FourelloDevs\MrSpeedy\Models\Courier;
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

    /***** API METHODS *****/

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
