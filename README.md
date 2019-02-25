# Amadeus PHP SDK

A simple API wrapper for integrating the Amadeus Self service APIs provided by dahabtours GmbH.
All resources of the "AIR" section are covered.
mandatory parameters will be checked.
See the documentation for more information on the parameters.
https://developers.amadeus.com/self-service

## Function names

See the official documentation for more information.

* flightInspiration
* lowFares
* flightDates
* mostSearched
* mostSearchedByDestination
* mostTraveled
* mostBooked
* busiestPeriod
* checkinLinks
* nearestAirports
* locations
* location
* airlines
* hotelOffers
* hotelOfferByHotel
* hotelOffer


## Examples

```php
require('AmadeusClient.php');
$amadeus_api = new AmadeusDahabtours\SelfServiceApiClient({API_KEY},{API_SECRET});

# Flight Inspiration Search
$flight_inspiration = $amadeus_api->flightInspiration([
    'origin'        => 'MAD'
]);

# Flight Cheapest Date Search
$flight_dates = $amadeus_api->flightDates([
    'origin'        => 'MAD',
    'destination'   => 'MUC'
]);

# Flight Low-fare Search
$flight_offers = $amadeus_api->lowFares([
    'origin'        => 'FRA',
    'destination'   => 'CAI',
    'departureDate' => '2019-07-15'
]);

# Flight Check-in Links
$checkin_links = $amadeus_api->checkinLinks([
    'airlineCode' => 'BA'
]);

# Airline Code Lookup
$airlines = $amadeus_api->airlines([
    'airlineCodes' => 'BA'
]);

# Airport & City Search (autocomplete)
# Find all the cities and airports starting by the keyword 'LON'
$locations = $amadeus_api->locations([
    'keyword'  => 'LON',
    'subType' =>'AIRPORT,CITY'
]);

# Get a specific city or airport based on its id (here Airport of LHR)
$location = $amadeus_api->location([
    'locationId'  => 'ALHR'
]);

# Airport Nearest Relevant (for London)
$nearest_airports = $amadeus_api->nearestAirports([
    'longitude' => 0.1278,
    'latitude'  => 51.5074
]);

# Flight Most Searched Destinations
# Get the most searched destinations from an origin
$most_searched = $amadeus_api->mostSearched([
    'originCityCode'    => 'MAD',
    'searchPeriod'      => '2017-08',
    'marketCountryCode' => 'ES'
]);

# How many people in Spain searched for a trip from Madrid to New-York in August 2017?
$most_searched_by_destination = $amadeus_api->mostSearchedByDestination([
    'originCityCode'      => 'MAD',
    'destinationCityCode' => 'NYC',
    'searchPeriod'        => '2017-08',
    'marketCountryCode'   => 'ES'
]);

# Flight Most Booked Destinations
$most_booked = $amadeus_api->mostBooked([
    'originCityCode'    => 'MAD',
    'period'      => '2017-08'
]);

# Flight Most Traveled Destinations
$most_traveled = $amadeus_api->mostTraveled([
    'originCityCode'    => 'MAD',
    'period'      => '2017-08'
]);

# Flight Busiest Period
$busiest_period = $amadeus_api->busiestPeriod([
    'cityCode'    => 'MAD',
    'period'      => '2017',
    'direction'      => 'ARRIVING'
]);

# Hotel Search API
# Get list of hotels by cityCode
$hotel_search = $amadeus_api->hotelOffers([
    'cityCode'        => 'LON'
]);

# Get list of offers for a specific hotel
$hotel_search_by_hotel = $amadeus_api->hotelOfferByHotel([
    'hotelId'        => 'IALONCHO'
]);

# Confirm the availability of a specific offer
$hotel_offer = $amadeus_api->hotelOffer([
    'offerId'        => 'D5BEE9D0D08B6678C2F5FAD910DC110BCDA187D21D4FCE68ED423426D0A246BB'
]);
```

## License

MIT license

## Contribute

Feel free to contribute by Pull Requests.
