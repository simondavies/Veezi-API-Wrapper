<?php
namespace VeeziAPI\Repositories\Film;

use Carbon\Carbon;
use VeeziAPI\Repositories\Film\Person;

/**
 * Film class
 *
 *  create a film instance for each film within the api
 *
 * @package    VeeziAPI\Repositories\Film
 * @author     Simon Davies <simondavies@live.co.uk>
 * @copyright 2015
 * @version 0.1
 * 
 */
class Film 
{
    /**
     * @var Object hold film details
     */
    private $film;

    function __construct($film) {
        self::setUpFilmData($film);
    }
    /**
     * the ID of the current film
     * @return Integer
     */
    public function getId(){
        return (int)$this->film['id'];
    }
    /**
     * the title of the current film
     * @return String
     */
    public function getTitle(){
        return $this->film['title'];
    }
    /**
     * the synopsis of the current film
     * @return String
     */
    public function getSynopsis(){
        return $this->film['synopsis'];
    }
    /**
     * the current start date of the current film
     * @return String
     */
    public function getStartDate(){
        return $this->film['start_date'];
    }
    /**
     * the genre of the current film limited to one
     * @return String
     */
    public function getGenre(){
        return $this->film['genre'];
    }
    /**
     * the current film distributor
     * @return String 
     */
    public function getDistributor(){
        return $this->film['distributor'];
    }
    /**
     * the rate and reason of the current film
     * @return Array 
     */
    public function getRating(){
        return $this->film['rating'];
    }
    /**
     * the length of the current film in minutes
     * @return Integer 
     */
    public function getDuration(){
        return (int) $this->film['duration'];
    }
    /**
     * The type of film 2D, 3D see  api details for more information
     * @return String 
     */
    public function getFormat(){
        return $this->film['format'];
    }
    /**
     * If the current film is restricted to adults only
     * @return Boolean 
     */
    public function getRestricted(){
        return $this->film['restricted'];
    }
    /**
     * the laguage setting of the current film: Audio
     * @return Array 
     */
    public function getLanguage(){
        return $this->film['language'];
    }
    /**
     * the people and roles of the current film: Actor, Director, Producer
     * @return VeeziAPI\Repositories\Film\Person
     */
    public function getPeople(){
        return $this->film['people'];
    }
    /**
     * the status of the current film: Active, Inactive, Deleted
     * @return String 
     */
    public function getStatus(){
        return $this->film['status'];
    }

    /**
     * set up the film data as a bit more readable
     * @param Array $film film data
     */
    private function setUpFilmData($film){
        $this->film = [
            'id' => $film->Id,
            'title' => $film->Title,
            'synopsis' => $film->Synopsis,
            'start_date' => new Carbon($film->OpeningDate),
            'genre' => $film->Genre,
            'distributor' => $film->Distributor,
            'rating' => [
                'rate' => $film->Rating,
                'reason' => $film->Content
                ],
            'duration' => gmdate("H:i", mktime(0,(int) $film->Duration)),
            'format' => $film->Format,
            'restricted' => (boolean) $film->IsRestricted,
            'language' => [
                'audio' => $film->AudioLanguage
                ],
            'people' => self::setPeople($film->People, $film->Id),
            'status' => $film->Status,
        ];
    }
    /**
     * set up the people for the current film
     * @param  Array $persons 
     * @return VeeziAPI\Repositories\Film\Person 
     */
    private function setPeople(array $persons, $filmid){
        $people = [];
        foreach ($persons as $person) {
            $people[] = new Person($person,  $filmid);
        }
        return $people;
    }
      
}
