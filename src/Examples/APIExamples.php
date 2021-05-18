<?php

namespace FourelloDevs\MrSpeedy\Examples;

use FourelloDevs\MrSpeedy\Models\BaseModel;
use FourelloDevs\MrSpeedy\Models\Client;
use FourelloDevs\MrSpeedy\Models\Courier;
use FourelloDevs\MrSpeedy\Models\Order;
use FourelloDevs\MrSpeedy\Models\Point;
use FourelloDevs\MrSpeedy\Models\ContactPerson;


/**
 * Class APIExamples
 */
class APIExamples
{
    /**
     * Order price calculation
     *
     * @throws \JsonException
     */

    public function calculateOrderPriceTest(): ?Order
    {
        $order = new Order;
        $order->matter = "Documents";

        $point1 = new Point;
        $point1->address = "Ultramega, General T. De Leon, Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";

        $contact1 = new ContactPerson;
        $contact1->name = 'James Carlo Luchavez';
        $contact1->phone = '09061886959';

        $point1->contact_person = $contact1;

        $point2 = new Point;
        $point2->address = "Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";

        $contact2 = new ContactPerson;
        $contact2->name = 'Denys Don';
        $contact2->phone = '09061886959';

        $point2->contact_person = $contact2;

        $order->points = [$point1, $point2];

        return mrspeedy()->calculateOrderPrice($order);
    }

    /**
     * Placing an order
     **/

    public function placeOrderTest()
    {
        $order = new Order;
        $order->matter = "Documents";

        $point1 = new Point;
        $point1->address = "Ultramega, General T. De Leon, Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";

        $contact1 = new ContactPerson;
        $contact1->name = 'James Carlo Luchavez';
        $contact1->phone = '09061886959';

        $point1->contact_person = $contact1;

        $point2 = new Point;
        $point2->address = "Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";

        $contact2 = new ContactPerson;
        $contact2->name = 'Denys Don';
        $contact2->phone = '09061886959';

        $point2->contact_person = $contact2;

        $order->points = [$point1, $point2];

        return mrspeedy()->placeOrder($order);
    }

    /**
     * Order editing
     **/

    public function editOrderTest()
    {
        $order = new Order;
        $order->order_id = 97361;

        $point1 = new Point;
        $point1->address = "Ultramega, General T. De Leon, Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";

        $contact1 = new ContactPerson;
        $contact1->name = 'James Luchavez';
        $contact1->phone = '09061886959';

        $point1->contact_person = $contact1;

        $point2 = new Point;
        $point2->address = "Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";

        $contact2 = new ContactPerson;
        $contact2->name = 'Denys Dela Cruz';
        $contact2->phone = '09061886959';

        $point2->contact_person = $contact2;

        $order->points = [$point1, $point2];

        return mrspeedy()->editOrder($order);
    }

    /**
     * Canceling an order
     **/

    public function cancelOrderTest()
    {
//        return mrspeedy()->cancelOrder(97361);
        return mrspeedy()->cancelOrder(97360);
    }

    /**
     * List of orders
     **/

    public function getOrdersTest(): array
    {
//        return mrspeedy()->getOrders([97360]);
        return mrspeedy()->getOrders();
    }

    /**
     * Courier info and courier location
     **/

    public function getCourierTest(): ?Courier
    {
        return mrspeedy()->getCourier(97362);
    }

    /**
     * Client profile info
     **/

    public function getClientTest(): ?Client
    {
        return mrspeedy()->getClient();
    }

    /**
     * Available bank cards
     **/

    public function getBankCardsTest(): array
    {
        return mrspeedy()->getBankCards();
    }

    /**
     * Create draft deliveries
     **/

    public function createDraftDeliveryTest()
    {

    }

    /**
     * Edit draft deliveries
     **/

    public function editDraftDeliveryTest()
    {

    }

    /**
     * Delete draft deliveries
     **/

    public function deleteDraftDeliveriesTest()
    {

    }

    /**
     * List of deliveries
     **/

    public function getDeliveriesTest()
    {

    }

    /**
     * Make routes from deliveries
     **/

    public function makeRoutesFromDeliveriesTest()
    {

    }
}
