<?php


namespace FourelloDevs\MrSpeedy\Models;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class BaseModel
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
abstract class BaseModel implements \JsonSerializable
{
    /**
     * BaseModel constructor.
     * @param array|Response|null $array
     * @param string|null $key
     */
    public function __construct($array = NULL, ?string $key = NULL)
    {
        if(empty($array) === FALSE) {
            if($array instanceof Response) {
                $this->parse($array, $key);
            }
            elseif (is_array($array)) {
                $this->setFields($array);
            }
        }
    }

    /**
     * @param Response $response
     * @param string|null $key
     * @return BaseModel
     */
    public function parse(Response $response, ?string $key = NULL): BaseModel
    {
        if($response->ok()) {
            $array = $response->json($key);
            $array && $this->setFields($array);
        }
        return $this;
    }

    /**
     * @param array $array
     */
    protected function setFields(array $array): void
    {
        foreach (get_object_vars($this) as $key=>$value){
            if(Arr::has($array, $key)) {
                if(method_exists($this, $method = Str::camel('set' . $key))) {
                    $this->$method($array[$key]);
                }
                else {
                    $this->{$key} = $array[$key];
                }
            }
        }
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize(): array
    {
        return array_filter_recursive(get_object_vars($this));
    }
}
