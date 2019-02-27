<!DOCTYPE html>
<html lang="en">
<body>
<?php
require('../../AmadeusClient.php');
$amadeus_api = new AmadeusDahabtours\SelfServiceApiClient({API_KEY},{API_SECRET});

print_r("<h2> Inspiration </h2>");
# Flight Inspiration Search
$flight_inspiration = $amadeus_api->flightInspiration([
    'origin'        => 'MAD'
]);
if($flight_inspiration['success'] != 1 || $flight_inspiration['http_code'] != 200){
    print_r($flight_inspiration);
}

print_r("<h2> Dates </h2>");
# Flight Cheapest Date Search
$flight_dates = $amadeus_api->flightDates([
    'origin'        => 'MAD',
    'destination'   => 'MUC'
]);
if($flight_dates['success'] != 1 || $flight_dates['http_code'] != 200){
    print_r($flight_dates);
}

print_r("<h2> LFS </h2>");
# Flight Low-fare Search
$flight_offers = $amadeus_api->lowFares([
    'origin'        => 'FRA',
    'destination'   => 'CAI',
    'departureDate' => '2019-07-15'
]);
if($flight_offers['success'] != 1 || $flight_offers['http_code'] != 200){
    print_r($flight_offers);
}

print_r("<h2> Check-in Links </h2>");
# Flight Check-in Links
$checkin_links = $amadeus_api->checkinLinks([
    'airlineCode' => 'BA'
]);
if($checkin_links['success'] != 1 || $checkin_links['http_code'] != 200){
    print_r($checkin_links);
}

print_r("<h2> Airline Code Lookup </h2>");
# Airline Code Lookup
$airlines = $amadeus_api->airlines([
    'airlineCodes' => 'BA'
]);
if($airlines['success'] != 1 || $airlines['http_code'] != 200){
    print_r($airlines);
}

print_r("<h2> Airport & City Search #1 </h2>");
# Airport & City Search (autocomplete)
# Find all the cities and airports starting by the keyword 'LON'
$locations = $amadeus_api->locations([
    'keyword'  => 'LON',
    'subType' =>'AIRPORT,CITY'
]);
if($locations ['success'] != 1 || $locations['http_code'] != 200){
    print_r($locations);
}

print_r("<h2> Airport & City Search #2 </h2>");
# Get a specific city or airport based on its id (here Airport of LHR)
$location = $amadeus_api->location([
    'locationId'  => 'ALHR'
]);
if($location['success'] != 1 || $location['http_code'] != 200){
    print_r($location);
}


print_r("<h2> Nearest Airports </h2>");
# Airport Nearest Relevant (for London)
$nearest_airports = $amadeus_api->nearestAirports([
    'longitude' => 0.1278,
    'latitude'  => 51.5074
]);
if($nearest_airports['success'] != 1 || $nearest_airports['http_code'] != 200){
    print_r($nearest_airports);
}

print_r("<h2> Most Searched </h2>");
# Flight Most Searched Destinations
# Get the most searched destinations from an origin
$most_searched = $amadeus_api->mostSearched([
    'originCityCode'    => 'MAD',
    'searchPeriod'      => '2017-08',
    'marketCountryCode' => 'ES'
]);
if($most_searched['success'] != 1 || $most_searched['http_code'] != 200){
    print_r($most_searched);
}


print_r("<h2> Most Searched By Destination </h2>");
# How many people in Spain searched for a trip from Madrid to New-York in August 2017?
$most_searched_by_destination = $amadeus_api->mostSearchedByDestination([
    'originCityCode'      => 'MAD',
    'destinationCityCode' => 'NYC',
    'searchPeriod'        => '2017-08',
    'marketCountryCode'   => 'ES'
]);
if($most_searched_by_destination['success'] != 1 || $most_searched_by_destination['http_code'] != 200){
    print_r($most_searched_by_destination);
}

print_r("<h2> Most Booked </h2>");
# Flight Most Booked Destinations
$most_booked = $amadeus_api->mostBooked([
    'originCityCode'    => 'MAD',
    'period'      => '2017-08'
]);
if($most_booked['success'] != 1 || $most_booked['http_code'] != 200){
    print_r($most_booked);
}

print_r("<h2> Most Traveled </h2>");
# Flight Most Traveled Destinations
$most_traveled = $amadeus_api->mostTraveled([
    'originCityCode'    => 'MAD',
    'period'      => '2017-08'
]);
if($most_traveled['success'] != 1 || $most_traveled['http_code'] != 200){
    print_r($most_traveled);
}

print_r("<h2> Busiest Period </h2>");
# Flight Busiest Period
$busiest_period = $amadeus_api->busiestPeriod([
    'cityCode'    => 'MAD',
    'period'      => '2017',
    'direction'      => 'ARRIVING'
]);
if($busiest_period['success'] != 1 || $busiest_period['http_code'] != 200){
    print_r($busiest_period);
}

print_r("<h2> Hotel Search #1 </h2>");
# Hotel Search API
# Get list of hotels by cityCode
$hotel_search = $amadeus_api->hotelOffers([
    'cityCode'        => 'LON'
]);
if($hotel_search['success'] != 1 || $hotel_search['http_code'] != 200){
    print_r($hotel_search);
}

print_r("<h2> Hotel Search #2 </h2>");
# Get list of offers for a specific hotel
$hotel_search_by_hotel = $amadeus_api->hotelOfferByHotel([
    'hotelId'        => 'IALONCHO'
]);
if($hotel_search_by_hotel['success'] != 1 || $hotel_search_by_hotel['http_code'] != 200){
    print_r($hotel_search_by_hotel);
}

print_r("<h2> Hotel Search #3 </h2>");
# Confirm the availability of a specific offer
$hotel_offer = $amadeus_api->hotelOffer([
    'offerId'        => '0AD7B8A70440C82E32EE1FB53AD80128AA9E952543BBA96F1EBE11624DB47A75'
]);
if($hotel_offer['success'] != 1 || $hotel_offer['http_code'] != 200){
    print_r($hotel_offer);
}
?>
</body>
</html>
