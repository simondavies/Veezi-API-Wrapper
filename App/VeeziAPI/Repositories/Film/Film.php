<?php
namespace VeeziAPI\Repositories\Film;

use Carbon\Carbon;
use VeeziAPI\Repositories\Film\Dates as Date;
use VeeziAPI\Repositories\Film\Person;
use VeeziAPI\Services\APIRequest;

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
class Film extends APIRequest
{
    /**
     * @var Object hold film details
     */
    private $film;

    function __construct($film) {
        parent::__construct();
        self::setUpFilmData($film);
    }
    /**
     * @return Integer the ID of the current film
     */
    public function getId(){
        return (string) $this->film['id'];
    }
    /**
     * @return String the title of the current film
     */
    public function getTitle(){
        return $this->film['title'];
    }
    /**
     * @return String the title of the current film
     */
    public function getPoster(){
        return $this->film['poster'];
    }
    /**
     * @return String the synopsis of the current film
     */
    public function getSynopsis(){
        return $this->film['synopsis'];
    }
    /**
     * @return String the current start date of the current film
     */
    public function getStartDate(){
        return $this->film['start_date'];
    }
    /**
     * @return Array the overall dates and times available
     */
    public function getDates(){
        return $this->film['dates'];
    }
    /**
     * @return Array Return the readble date/time details
     */
    public function getDatesAndTimes(){
        $datetime = [];
        foreach ($this->film['dates'] as $index => $date) {
            $readable_date = $date->getStartDate()->format('l jS \of F Y');
            $datetime[$readable_date][$index]['link'] = $date->getTimeLink();
            $datetime[$readable_date][$index]['time'] = $date->getStartDate()->format('H:i');
        }
        return $datetime;
    }
    /**
     * @return String the genre of the current film limited to one
     */
    public function getGenre(){
        return $this->film['genre'];
    }
    /**
     * @return String the current film distributor
     */
    public function getDistributor(){
        return $this->film['distributor'];
    }
    /**
     * @return Array the rate and reason of the current film
     */
    public function getRating(){
        return $this->film['rating'];
    }
    /**
     * @return Integer the length of the current film in minutes
     */
    public function getDuration(){
        return (int) $this->film['duration'];
    }
    /**
     * @return String The type of film 2D, 3D see  api details for more information
     */
    public function getFormat(){
        return $this->film['format'];
    }
    /**
     * @return Boolean If the current film is restricted to adults only
     */
    public function getRestricted(){
        return $this->film['restricted'];
    }
    /**
     * @return Array the laguage setting of the current film: Audio
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
     * @return Array return a list of roles and the people within
     */
    public function getRoles(){
        return self::sortPeopleIntoRoles();
    }
    /**
     * @return String the status of the current film: Active, Inactive, Deleted
     */
    public function getStatus(){
        return $this->film['status'];
    }
    /**
     * @param Array set up the film data as a bit more readable
     */
    private function setUpFilmData($film){
        $this->film = [
            'id' => $film->Id,
            'title' => $film->Title,
            'poster' => null,
            'synopsis' => $film->Synopsis,
            'start_date' => new Carbon($film->OpeningDate),
            'dates' => self::getFilmDates($film->Id),
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
    /**
     * sort out the people into their roles
     * @param Array $people
     * @return Array
     */
    private function sortPeopleIntoRoles() {
        $actors = [];
        $directors = [];
        $producers = [];
        foreach (self::getPeople() as $person) {
            if ($person->getRole() === 'Actor') {$actors[] = $person->getName();}
            if ($person->getRole() === 'Director') {$directors[] = $person->getName();}
            if ($person->getRole() === 'Producer') {$producers[] = $person->getName();}
        }
        return [
            'actors' => $actors,
            'directors' => $directors,
            'producers' => $producers,
        ];
    }
    /**
     * get the actual dates for the selcted film
     * @param  string $film_id
     * @return Array
     */
    private function getFilmDates($film_id){
        $selected_dates = [];
        foreach (parent::request('session') as $date) {
            if($date->FilmId === $film_id && $date->Status === 'Open'){
                $selected_dates[] = new DatesAndTimes($date);
            }
        }
        return $selected_dates;
    }

}
