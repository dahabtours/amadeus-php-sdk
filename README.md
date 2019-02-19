# Amadeus PHP SDK

A simple API wrapper for integrating the Amadeus Self service APIs provided by dahabtours GmbH.
Currently all resources of the "AIR" section are covered.
mandatory parameters will be checked. 
See the documentation for more information on the parameters.
https://developers.amadeus.com/self-service

## Function names

See the official documentation for more information.

'flightInspiration'
'lowFares'
'flightDate'
'mostSearched'
'mostSearchedByDestination'
'mostTraveled'
'mostBooked'
'busiestPeriod'
'checkinLinks'
'nearestAirports'
'locations'
'airlines'


## Example

```
$amadeus_api = new AmadeusDahabtours\SelfServiceApiClient({CLIENT_ID}, {CLIENT_SECRET});

$amadeus_results = $amadeus_api->lowFares([
    'origin'        => 'FRA',
    'destination'   => 'CAI',
    'departureDate' => '2019-07-15',
]);
```

## License

MIT license

## Contribute

Feel free to submit pull requests, e.g. enhance the resource array by functions from the "Hotel" section (you mainly need to provide a function name as key, the resource url and parameters).
