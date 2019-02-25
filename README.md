# Amadeus PHP SDK

A simple API wrapper for integrating the Amadeus Self service APIs provided by dahabtours GmbH.
Currently all resources of the "AIR" section are covered.
mandatory parameters will be checked.
See the documentation for more information on the parameters.
https://developers.amadeus.com/self-service

## Function names

See the official documentation for more information.

* flightInspiration
* lowFares
* flightDate
* mostSearched
* mostSearchedByDestination
* mostTraveled
* mostBooked
* busiestPeriod
* checkinLinks
* nearestAirports
* locations
* airlines
* hotelOffers
* hotelOfferByHotel
* hotelOffer


## Example

```php
require('AmadeusClient.php');
$amadeus_api = new AmadeusDahabtours\SelfServiceApiClient({API_KEY},{API_SECRET});

// Flight Low-fare Search 
$amadeus_results = $amadeus_api->lowFares([
    'origin'        => 'FRA',
    'destination'   => 'CAI',
    'departureDate' => '2019-07-15'
]);

// Hotel Search
$hotel_search = $amadeus_api->hotelOffers([
    'cityCode'        => 'LON'
]);
```

## License

MIT license

## Contribute

Feel free to contribute by Pull Requests.
