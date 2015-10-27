<?php
namespace VeeziAPI\Repositories\Film;

/**
 * Person class
 *
 *  create a person instance for each people within the film data
 *
 * @package    VeeziAPI\Repositories\Film\Person
 * @author     Simon Davies <simondavies@live.co.uk>
 * @copyright 2015
 * @version 0.1
 * 
 */
class Person 
{
    /**
     * @var Array 
     */
    private $person;
    /**
     * main class constructor method
     * @param Array $people
     * @param String $film_id
     */
    function __construct($people, $film_id){
        self::setUpPerson($people, $film_id);
    }
    /**
     * @return String return the requested persons id
     */
    public function getId(){
        return $this->person['id'];
    }
    /**
     * @return String return the requested persons film id
     */
    public function getFilmId(){
        return $this->person['id'];
    }
   /**
     * @return String return the requested persons first name
     */
    public function getFirstName(){
        return $this->person['name']['first'];
    }
    /**
     * @return String return the requested persons last name
     */
    public function getLastName(){
        return $this->person['name']['last'];
    }
    /**
     * @return String return the requested persons full name
     */
    public function getName(){
        return $this->person['name']['first'] . ' ' . $this->person['name']['last'];
    }
    /**
     * @return String return the requested persons role
     */
    public function getRole(){
        return $this->person['role'];
    }
    /**
     * set up a readable format
     * @param Array $people
     * @param String $film_id
     */
    private function setUpPerson($people, $film_id){
        $this->person = [
            'id' => $people->Id,
            'filmid' => $film_id,
            'name' => [
                    'first' => $people->FirstName,
                    'last' => $people->LastName
                ],
            'role' => $people->Role
        ];
    }

}

