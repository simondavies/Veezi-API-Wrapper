<?php
namespace VeeziAPI\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class APIRequest 
{

        const API_BASE_URI = 'https://api.us.veezi.com';

        const API_VERSION = 'v1';
         /**
          * GuzzleHttp\Client Hold the Guzzle client instance
          */
         private $client;
         /**
          * @var array set the headers to be sent with the guzze request
          */
         private $headers;

        function __construct()
        {
                $this->headers  = [
                      'headers' => ['VeeziAccessToken' => VEEZI_API_TOKEN],
                      'Accept' => 'application/json',
                      'Content-Type' => 'application/json',
                      'verify' => false
                  ];
                $this->client = new Client(['base_uri' => self::API_BASE_URI]);
        }
         /**
          * send the request to the API nad return the result as an array
          * @param  String $action the query to action
          * @return  String
          */
         protected function request($action){
               try {
                     $response = $this->client->request('GET', self::buildURI($action), $this->headers);
                     return json_decode($response->getBody()->getContents());
               } catch (RequestException $e) {
                     logErrors($e->getMessage());
               }
         }
         /**
          * build the requested uri paramters
          * @param  String $action the uri param
          * @return String  
          */
         private function buildURI($action){
            return self::API_VERSION . '/' . $action;
         }
}