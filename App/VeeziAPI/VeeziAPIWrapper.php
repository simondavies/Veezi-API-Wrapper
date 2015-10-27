<?php
namespace VeeziAPI;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use VeeziAPI\Repositories\Film\Film as Film;

/**
 * VeeziAPIWrapper class
 *
 *  The initial veezi api wrapper class
 *
 * @package    VeeziAPI
 * @author     Simon Davies <simondavies@live.co.uk>
 * @copyright 2015
 * @version 0.1
 * 
 */
class VeeziAPIWrapper {
         /**
         * @var String The uri of the inital api 
         */
         const API_BASE_URI = 'https://api.us.veezi.com';
         /**
         * @var String The current version of the API
         */
         const API_VERSION = 'v1';
         /**
         * @var String The screen api token
         */
         private $apiToken;
         /**
          * GuzzleHttp\Client Hold the Guzzle client instance
          */
         private $client;
         /**
          * @var array set the headers to be sent with the guzze request
          */
         private $headers;

         function __construct($apitoken) {
               $this->apiToken = ['VeeziAccessToken' => $apitoken];
               $this->headers  = self::setHeaders();
               $this->client = new Client(['base_uri' => self::API_BASE_URI]);
         }
         /**
          * get all the films 
          * @return Array/VeeziAPI\Repositories\Film\Film
          */
         public function films(){
               $films = [];
               try {
                  $allFilms = $this->request('film');
                  foreach($allFilms as $film) {
                     $films[] = new Film($film);
                  }
                  return $films;
               } catch (Exception $e){
                     logErrors($e->getMessage());
               }
         }
         /**
          * Get the selected film
          * @param  String $film_id 
          * @return VeeziAPI\Repositories\Film\Film
          */
         public function selectedFilm($film_id){
               //-- currently the film ID is a string so lets validate this
               if(is_string($film_id) && !empty($film_id)){
                  return new Film($this->request('film/' . $film_id));
               }
               return fasle;
         }
         /**
          * send the request to the API nad return the result as an array
          * @param  String $action the query to action
          * @return  String
          */
         private function request($action){
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
         /**
          * [setHeaders description]
          * @param [type] $apikey [description]
          */
          private function setHeaders(){
             return [
                  'headers' => $this->apiToken,
                  'Accept' => 'application/json',
                  'Content-Type' => 'application/json',
              ];
          }
}