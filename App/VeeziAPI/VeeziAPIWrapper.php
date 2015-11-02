<?php
namespace VeeziAPI;

use VeeziAPI\Services\APIRequest;
use VeeziAPI\Repositories\Film\FilmListing;
use VeeziAPI\Repositories\Film\Film;
use VeeziAPI\Repositories\Film\Dates as Date;

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

         function __construct() {
              parent::__construct();
          }
         /**
          * get all the films 
          * @return Array - VeeziAPI\Repositories\Film\FilmListing
          */
         public function films(){
               $films = [];
               try {
                  $all_films = parent::request('film');
                  foreach($all_films as $index => $film) {
                      $films[] = new FilmListing($film);
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
                  $selected_film = new Film(parent::request('film/' . $film_id));
                  return $selected_film;
               }
               return fasle;
         }
}