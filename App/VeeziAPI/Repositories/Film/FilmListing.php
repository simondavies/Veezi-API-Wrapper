<?php
namespace VeeziAPI\Repositories\Film;

/**
 * FilmListing class
 *
 *  create a film instance for each film within the api
 *
 * @package    VeeziAPI\Repositories\Film\FilmListing
 * @author     Simon Davies <simondavies@live.co.uk>
 * @copyright 2015
 * @version 0.1
 * 
 */
class FilmListing
{
    /**
     * @var Object hold film details
     */
    private $film;

    function __construct($film) {
        self::setUpFilmListData($film);
    }
    /**
     * the ID of the current film
     * @return Integer
     */
    public function getId(){
        return (string) $this->film['id'];
    }
    /**
     * the title of the current film
     * @return String
     */
    public function getTitle(){
        return $this->film['title'];
    }
    /**
     * the title of the current film
     * @return String
     */
    public function getPoster(){
        return $this->film['poster'];
    }
    /**
     * the genre of the current film limited to one
     * @return String
     */
    public function getGenre(){
        return $this->film['genre'];
    }
    /**
     * the rate and reason of the current film
     * @return Array 
     */
    public function getRating(){
        return $this->film['rating'];
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
    private function setUpFilmListData($film){
        $this->film = [
            'id' => $film->Id,
            'title' => $film->Title,
            'poster' => null,
            'genre' => $film->Genre,
            'rating' => [
                'rate' => $film->Rating,
                'reason' => $film->Content
                ],
            'status' => $film->Status,
        ];
    }   
}
