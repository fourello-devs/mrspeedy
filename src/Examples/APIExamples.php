<?php

namespace FourelloDevs\MrSpeedy\Examples;

use FourelloDevs\MrSpeedy\Models\BankCard;
use FourelloDevs\MrSpeedy\Models\Client;
use FourelloDevs\MrSpeedy\Models\Order;
use FourelloDevs\MrSpeedy\Models\OrderStatus;
use FourelloDevs\MrSpeedy\Models\Point;
use FourelloDevs\MrSpeedy\Models\ContactPerson;
use Illuminate\Support\Collection;


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

    public function calculateOrderPriceTest()
    {
        $order = new Order;
        $order->matter = "Documents";

        $point1 = new Point;
        $point1->address = "Ultramega, General T. De Leon, Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";
        $point1->latitude = '14.6880119';
        $point1->longitude = '121.0004288';

        $contact1 = new ContactPerson;
        $contact1->name = 'James Carlo Luchavez';
        $contact1->phone = '09061886959';

        $point1->contact_person = $contact1;

        $point2 = new Point;
        $point2->address = "Demitillo, 2nd District, Valenzuela, Third District, Metro Manila, 1442, Philippines";
        $point2->latitude = '14.6894522';
        $point2->longitude = '120.9973454';

        $contact2 = new ContactPerson;
        $contact2->name = 'Denys Don';
        $contact2->phone = '09061886959';

        $point2->contact_person = $contact2;

        $order->points = [$point1, $point2];

        return $order->calculate();
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

        return $order->execute();
    }

    /**
     * Order editing
     **/

    public function editOrderTest(string $id)
    {
        $order = Order::find($id);

        if ($order instanceof Order === FALSE) {
            return $order;
        }

        $order->matter = 'Flowers';

        return $order->update();
    }

    /**
     * Canceling an order
     **/

    public function cancelOrderTest()
    {
        $orders = Order::all(OrderStatus::AVAILABLE);
        if ($orders instanceof Collection) {
            return $orders->first()->cancel();
        }
    }

    /**
     * List of orders
     **/

    public function getOrdersTest()
    {
//        return Order::find(103129);
        return Order::all();
    }

    /**
     * Courier info and courier location
     **/

    public function getCourierTest()
    {
        return Order::find(97387)->getCourier();
    }

    /**
     * Client profile info
     **/

    public function getClientTest()
    {
        return Client::get();
    }

    /**
     * Available bank cards
     **/

    public function getBankCardsTest(): array
    {
        return BankCard::get();
    }
}
