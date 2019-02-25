<?php
/**
 * Amadeus Self-service API PHP SDK
 *
 * @author     Max Tobias Weber <tobias@dahabtours.de>
 */

namespace AmadeusDahabtours;

class SelfServiceApiClient{

  var $api_key;
  var $api_secret;
  var $api_token;
  var $env; // 'DEV' or 'PROD'

  // Describe all API resource in this array
  var $api_resources = [
    'flightInspiration' => [
      'url_path' => '/v1/shopping/flight-destinations',
      'required_parameters' => [
        'origin'
      ],
      'parameters' => [
        'departureDate',
        'oneWay',
        'duration',
        'nonStop',
        'maxPrice',
        'currency',
        'viewBy'
      ],
      'defaults' => [
      ],
    ],
    'lowFares' => [
      'url_path' => '/v1/shopping/flight-offers',
      'required_parameters' => [
        'origin',
        'destination',
        'departureDate'
      ],
      'parameters' => [
        'returnDate',
        'arrivalBy',
        'returnBy',
        'adults',
        'children',
        'infants',
        'seniors',
        'travelClass',
        'includeAirlines',
        'excludeAirlines',
        'nonStop',
        'currency',
        'maxPrice',
        'max'
      ],
      'defaults' => [
      ],
    ],
    'flightDate' => [
      'url_path' => '/v1/shopping/flight-dates',
      'required_parameters' => [
        'origin',
        'destination'
      ],
      'parameters' => [
        'departureDate',
        'oneWay',
        'duration',
        'nonStop',
        'maxPrice',
        'currency',
        'viewBy'
      ],
      'defaults' => [
      ],
    ],
    'mostSearched' => [
      'url_path' => '/v1/analytics/searched',
      'required_parameters' => [
        'originCityCode',
        'marketCountryCode',
        'searchPeriod'
      ],
      'parameters' => [
        'max',
        'fields',
        'page[limit]',
        'page[offset]'
      ],
      'defaults' => [
      ],
    ],
    'mostSearchedByDestination' => [
      'url_path' => '/v1/analytics/searched/by-destination',
      'required_parameters' => [
        'originCityCode',
        'destinationCityCode',
        'marketCountryCode',
        'searchPeriod'
      ],
      'parameters' => [
        'fields'
      ],
      'defaults' => [
      ],
    ],
    'mostTraveled' => [
      'url_path' => '/v1/analytics/air-traffic/traveled',
      'required_parameters' => [
        'originCityCode',
        'period'
      ],
      'parameters' => [
        'max',
        'fields',
        'page[limit]',
        'page[offset]',
        'sort'
      ],
      'defaults' => [
      ],
    ],
    'mostBooked' => [
      'url_path' => '/v1/analytics/air-traffic/booked',
      'required_parameters' => [
        'originCityCode',
        'period'
      ],
      'parameters' => [
        'max',
        'fields',
        'page[limit]',
        'page[offset]',
        'sort'
      ],
      'defaults' => [
      ],
    ],
    'busiestPeriod' => [
      'url_path' => '/v1/analytics/air-traffic/busiest-period',
      'required_parameters' => [
        'cityCode',
        'period'
      ],
      'parameters' => [
        'direction'
      ],
      'defaults' => [
      ],
    ],
    'checkinLinks' => [
      'url_path' => '/v2/reference-data/urls/checkin-links',
      'required_parameters' => [
        'airlineCode'
      ],
      'parameters' => [
        'language'
      ],
      'defaults' => [
      ],
    ],
    'nearestAirports' => [
      'url_path' => '/v1/reference-data/locations/airports',
      'required_parameters' => [
        'latitude',
        'longitude'
      ],
      'parameters' => [
        'radius',
        'page[limit]',
        'page[offset]',
        'sort'
      ],
      'defaults' => [
      ],
    ],
    'locations' => [
      'url_path' => '/v1/reference-data/locations',
      'required_parameters' => [
        'subType',
        'keyword'
      ],
      'parameters' => [
        'countryCode',
        'page[limit]',
        'page[offset]',
        'sort',
        'view'
      ],
      'defaults' => [
      ],
    ],
    'airlines' => [
      'url_path' => '/v1/reference-data/airlines',
      'required_parameters' => [
        'airlineCodes'
      ],
      'parameters' => [
      ],
      'defaults' => [
      ],
    ],
    'hotelOffers' => [
      'url_path' => '/v2/shopping/hotel-offers',
      'required_parameters' => [
      ],
      'parameters' => [
        'cityCode',
        'latitude',
        'longitude',
        'hotelIds',
        'checkInDate',
        'checkOutDate',
        'roomQuantity',
        'adults',
        'childAges',
        'radius',
        'radiusUnit',
        'hotelName',
        'chains',
        'rateCodes',
        'amenities',
        'ratings',
        'priceRange',
        'currency',
        'paymentPolicy',
        'boardType',
        'includeClosed',
        'bestRateOnly',
        'view',
        'sort',
        'page[limit]',
        'page[offset]',
        'lang'
      ],
      'defaults' => [
      ],
    ],
    'hotelOfferByHotel' => [
      'url_path' => '/v2/shopping/hotel-offers/by-hotel',
      'required_parameters' => [
        'hotelId'
      ],
      'parameters' => [
        'checkInDate',
        'checkOutDate',
        'adults',
        'childAges',
        'rateCodes',
        'roomQuantity',
        'currency',
        'paymentPolicy',
        'boardType',
        'view',
        'lang'
      ],
      'defaults' => [
      ],
    ],
    // Not sure how to pass the /v2/shopping/hotel-offers/{offerId} as a URL parameter...
    'hotelOffer' => [
      'url_path' => '/v2/shopping/hotel-offers',
      'required_parameters' => [

      ],
      'parameters' => [
        'lang'
      ],
      'defaults' => [
        'offerId'
      ],
    ],
  ];

  /**
   * Constructor
   * set object variables and obtain api token
   *
   * @param string $api_key 
   * @param string $api_secret
   * @param string $env specify the environment, possible values: 'DEV', 'PROD'
   *
   * @return AmadeusApiClient
   */
  public function __construct($api_key, $api_secret, $env = 'DEV'){
    //$this->env = 'PROD';
    $this->env = $env;

    $this->api_key    = $api_key; //app: dahabtours
    $this->api_secret = $api_secret; //app: dahabtours

    if($this->env === 'PROD'){
      // production environment
      $this->api_url    = "https://api.amadeus.com";
    } else {
      // development/staging environment
      $this->api_url    = "https://test.api.amadeus.com";
    }

    $this->obtain_api_token();
  }

  /**
   * Execute API call using the given parameters
   *
   * @param string $url Url of the API resource
   * @param array $params Array of parameters to send with the call
   * @param boolean $oauth if true include the oauthv2 authentication header
   *
   * @return string API call response body
   */
  private function api_call($url, $params, $oauth = true){

    $getdata = http_build_query(
      $params
    );

    $ch = curl_init();


    if($oauth !== true){
      curl_setopt($ch, CURLOPT_URL, $url );

      curl_setopt($ch, CURLOPT_POST, true);

      curl_setopt($ch, CURLOPT_POSTFIELDS, $getdata);
    } else {

      curl_setopt($ch, CURLOPT_URL, $url . '?' . $getdata);

    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    //curl_setopt($ch, CURLOPT_VERBOSE, true);

    $headers = [
      'content-type: application/x-www-form-urlencoded', 
    ];

    if($oauth){
      if(!$this->api_token){
        return false;
      }

      $headers[] = "Authorization: Bearer ". $this->api_token;

    }

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $data = curl_exec($ch);

    //print_r(curl_getinfo($ch));

    curl_close($ch);

    return $data;
  }

  /**
   * Wildcard function to catch and handle all API calls specified in $this->api_resources
   *
   * @param string $resource_name 
   * @param array $args Key 0 being an array of parameters to send with the call
   *
   * @return array An array containing a success key, error messages and the api calls response
   */
  private function __call($resource_name, $args){
    $return_data = [
      'success' => false,
      'msgs'    => [],
    ];

    if(isset($this->api_resources[$resource_name])){

      if(isset($args[0]) && !empty($args[0])){
        $parameters = $args[0];
        $required_parameters = $this->api_resources[$resource_name]['required_parameters'];

        // check if all mandatory parameters are present
        for($i = count($required_parameters); $i >= 0; $i--){
          if(array_key_exists($required_parameters[$i], $parameters)){
            unset($required_parameters[$i]);
          }
        }
        array_merge($required_parameters);

        if(empty($required_parameters)){
          // good to go
          // let's make the call

          $parameters = array_merge($this->api_resources[$resource_name]['defaults'], $parameters);

          $return_data['response_text'] = $this->api_call($this->api_url . $this->api_resources[$resource_name]['url_path'], $parameters);

          if($return_data['response_text']){

            $return_data['success'] = true;
            $return_data['response'] = json_decode($return_data['response_text'], true);

          }

        } else {
          $return_data['msgs'][] = 'Required Parameter/s Missing. The following mandatory parameter/s must be provided: "' . implode('", "', $required_parameters) . '".';
        }

      } else {
        $return_data['msgs'][] = 'No parameters given. The following mandatory parameter/s must be provided: "' . implode('", "', $this->api_resources[$resource_name]['required_parameters']) . '".';
      }
    } else {
      $return_data['msgs'][] = 'Resource "' . $resource_name . '" not found.';
    }

    return $return_data;
  }

  /**
   * obtain an API token and save it to $this->api_token to use for authentication in future API calls
   *
   * @return string
   */
  private function obtain_api_token(){

    $response_text = $this->api_call($this->api_url . "/v1/security/oauth2/token", [
      'client_id'     => $this->api_key,
      'client_secret' => $this->api_secret,
      'grant_type'    => 'client_credentials',
    ], false);

  

    if($response_text){

      $response = json_decode($response_text);

      if(isset($response->state) && $response->state === 'approved'){
        $this->api_token = $response->access_token;
      }

    }

    return $response;
  }

}
