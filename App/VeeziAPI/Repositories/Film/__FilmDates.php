<?php
namespace VeeziAPI\Repositories\Film;

use VeeziAPI\Repositories\Film\Dates as Date;
use VeeziAPI\Services\APIRequest;

/**
 * FilmDates class
 *
 *  create the film dates section
 *
 * @package    VeeziAPI\Repositories\Film\FilmDates
 * @author     Simon Davies <simondavies@live.co.uk>
 * @copyright 2015
 * @version 0.1
 * 
 */
class FilmDates extends APIRequest{
    
    private $film_id;

    private $selected_dates;

    function __construct($film_id){
        parent::__construct();
        $this->film_id  = $film_id;
        self::setUpSelectedFilmDates();
    }

    public function getDatesTimes(){
        return $this->selected_dates;
    }

    private function setUpSelectedFilmDates(){
        foreach (parent::request('session') as $date) {
            if($date->FilmId === $this->film_id){
                $this->selected_dates[] = new Date($date);
            }
        }
    }

}
