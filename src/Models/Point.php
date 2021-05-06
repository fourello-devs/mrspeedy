<?php


namespace FourelloDevs\MrSpeedy\Models;

/**
 * Class Point
 * @package FourelloDevs\MrSpeedy\Models
 *
 * @author James Carlo Luchavez <carlo.luchavez@fourello.com>
 * @since 2021-05-07
 */
class Point extends BaseModel
{
    /**
     * Point ID.
     * @var int
     */
    public $point_id;

    /**
     * Unique delivery ID (except first point).
     * Default value: null.
     * @var int|null
     */
    public $delivery_id;

    /**
     * Street address. Maximum length is 350 characters.
     * We use Google Maps API to geocode addresses.
     * Default value: null.
     * @var string|null
     */
    public $address;

    /**
     * Contact person on the address.
     * @var ContactPerson
     */
    public $contact_person;

    /**
     * Your eshop's order ID. It will be sent in notifications instead of our delivery order ID. Maximum length is 32 characters.
     * Default value: null.
     * @var string|null
     */
    public $client_order_id;

    /**
     * Latitude of the location.
     * Default value: null.
     * @var string|null
     */
    public $latitude;

    /**
     * Longitude of the location.
     * Default value: null.
     * @var string|null
     */
    public $longitude;

    /**
     * How early the courier may arrive at the address.
     * Default value: null.
     * @var string|null
     */
    public $required_start_datetime;

    /**
     * How late the courier may arrive at the address.
     * Default value: null.
     * @var string|null
     */
    public $required_finish_datetime;

    /**
     * Estimated courier arrival time, upper bound.
     * @var string|null
     */
    public $arrival_start_datetime;

    /**
     * Estimated courier arrival time, lower bound.
     * @var string|null
     */
    public $arrival_finish_datetime;

    /**
     * Actual courier arrival time.
     * @var string|null
     */
    public $courier_visit_datetime;

    /**
     * Backpayment sum to receive from the contact person at the address.
     * Default value: "0.00".
     * @var string
     */
    public $taking_amount;

    /**
     * Buyout sum the courier pays to the contact person at the address.
     * Default value: "0.00".
     * @var
     */
    public $buyout_amount;

    /**
     * Additional information for the courier: office or appartment number, company name, whether any documents are required to enter the building.
     * @var string|null
     */
    public $note;

    /**
     * Money will be paid to the courier at the address.
     * Default value: false.
     * @var bool
     */
    public $is_order_payment_here;

    /**
     * Building number.
     * Default value: null.
     * @var string|null
     */
    public $building_number;

    /**
     * Entrance number.
     * Default value: null.
     * @var string|null
     */
    public $entrance_number;

    /**
     * Intercom code.
     * Default value: null.
     * @var string|null
     */
    public $intercom_code;

    /**
     * Floor number.
     * Default value: null.
     * @var string|null
     */
    public $floor_number;

    /**
     * Apartment/office number.
     * Default value: null.
     * @var string|null
     */
    public $apartment_number;

    /**
     * Instruction to courier how to get to recipient at the address.
     * Default value: null.
     * @var string|null
     */
    public $invisible_mile_navigation_instructions;

    /**
     * Whether to issue a cashier's check to the recipient at the point.
     * Default value: false.
     * @var bool
     */
    public $is_cod_cash_voucher_required;

    /**
     * List of packages at the point.
     * Default value: [].
     * @var Package[]
     */
    public $packages;

    /**
     * Place photo when closing a point at the address.
     * @var string|null
     */
    public $place_photo_url;

    /**
     * Recipients signature photo when closing a point at the address.
     * @var string|null
     */
    public $sign_photo_url;

    /**
     * Checkin information when closing a point at the address.
     * @var Checkin
     */
    public $checkin;

    /**
     * Recipient's tracking link.
     * @var string|null
     */
    public $tracking_url;

    // SETTERS

    /**
     * @param array|ContactPerson $array
     */

    public function setContactPerson($array)
    {
        $this->contact_person = is_array($array) ? new ContactPerson($array) : $array;
    }

    /**
     * @param array|Package[] $packages
     */
    public function setPackages(array $packages): void
    {
        if (empty($packages) === FALSE) {
            if ($packages[0] instanceof Package) {
                $this->packages = $packages;
            }
            else {
                foreach ($packages as $package) {
                    $this->packages[] = new Package($package);
                }
            }
        }
    }

    /**
     * @param array|Checkin $checkin
     */
    public function setCheckin($checkin): void
    {
        $this->checkin = is_array($checkin) ? new Checkin($checkin) : $checkin;
    }
}
