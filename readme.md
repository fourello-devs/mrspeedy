# MrSpeedy

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require fourello-devs/mr-speedy
```

## Usage

### Setup Environment Variables

```dotenv
MR_SPEEDY_API_TOKEN=
MR_SPEEDY_CALLBACK_TOKEN=
MR_SPEEDY_CALLBACK_URL=
# PRODUCTION or blank
MR_SPEEDY_ENVIRONMENT=PRODUCTION
```

### Available Options

To utilize this package, you can use either of these:
- **MrSpeedy** Facade
- **mrspeedy()** Helper Function

### Demonstration

- #### Order price calculation

```php
use FourelloDevs\MrSpeedy\Models\Order;
use FourelloDevs\MrSpeedy\Models\Point;
use FourelloDevs\MrSpeedy\Models\ContactPerson;

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

    return $order->calculate();
}

```

- #### List of orders

```php
use FourelloDevs\MrSpeedy\Models\Order;

public function getOrdersTest()
{
    return Order::all();
}
```

- #### Client profile info

```php

use FourelloDevs\MrSpeedy\Models\Client;

public function getClientTest()
{
    return Client::get();
}
```

- #### Available bank cards

```php
use FourelloDevs\MrSpeedy\Models\BankCard;

public function getBankCardsTest(): array
{
    return BankCard::get();
}
```

#### NOTE: Other API Methods will be added soon.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email carlo.luchavez@fourello.com instead of using the issue tracker.

## Credits

- [James Carlo Luchavez][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/fourello-devs/mr-speedy.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/fourello-devs/mr-speedy.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/fourello-devs/mr-speedy/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/fourello-devs/mr-speedy
[link-downloads]: https://packagist.org/packages/fourello-devs/mr-speedy
[link-travis]: https://travis-ci.org/fourello-devs/mr-speedy
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/fourello-devs
[link-contributors]: ../../contributors
