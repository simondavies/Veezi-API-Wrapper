<?php
namespace VeeziAPI\Repositories\Film;

use Carbon\Carbon;

/**
 * Dates class
 *
 *  create the film dates section
 *
 * @package    VeeziAPI\Repositories\Film\Dates
 * @author     Simon Davies <simondavies@live.co.uk>
 * @copyright 2015
 * @version 0.1
 * 
 */
class Dates{
    
    private $date;

    function __construct($date){
        self::setReadableDates($date);
    }
    
    public function getDateId(){
        return (int) $this->date['id'];
    }

    public function getFilmId(){
        return (string) $this->date['film_id'];
    }

    public function getPackageId(){
        return (string) $this->date['package_id'];
    }

    public function getType(){
        return (string) $this->date['type'];
    }

    public function getStatus(){
        return (string) $this->date['status'];
    }

    public function getStartDate(){
        return $this->date['start'];
    }
    public function getEndDate(){
        return $this->date['end'];
    }
    public function getFeatureStartDate(){
        return $this->date['feature_start'];
    }
    public function getFeatureEndDate(){
        return $this->date['feature_end'];
    }
    private function setReadableDates($date){
        //-- if the sale method is not available on line then no need to include it
        if(in_array('WWW', $date->SalesVia)){
           $this->date =  [
                'id' => $date->Id,
                'film_id' => $date->FilmId,
                'package_id' => $date->FilmPackageId,
                'type' => $date->ShowType,
                'status' => $date->Status,
                'start' => new Carbon($date->PreShowStartTime),
                'feature_start' => new Carbon($date->FeatureStartTime),
                'feature_end' => new Carbon($date->FeatureEndTime),
                'end' => new Carbon($date->CleanupEndTime),
            ];
        }//-- end if
    }

}
