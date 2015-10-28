<?php
namespace VeeziAPI;

use VeeziAPI\Services\APIRequest;
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
class VeeziAPIWrapper extends APIRequest {

         function __construct($api_token) {
              parent::__construct($api_token);
          }
         /**
          * get all the films 
          * @return Array/VeeziAPI\Repositories\Film\Film
          */
         public function films(){
               $films = [];
               try {
                  $all_films = parent::request('film');
                  foreach($all_films as $index => $film) {
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
                  return new Film(parent::request('film/' . $film_id));
               }
               return fasle;
         }
}