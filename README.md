# Veezi-API-Wrapper
A basic PHP wrapper for the [Veezi API](http://api.us.veezi.com/Help). 

**THIS IS STILL IN DEVELOPEMENT AND CAN CHANGE**

While being asked to look into the Veezi API,  to enable a website to display its relevant film data onto the site, so not to duplicate work etc. I would need to do a bit of work to manipulate the current data returned, to be used on a website, so not being able to find any current PHP code for use with the Veezi API, thought be nice to build this and thne make it available to Veezi as well as others. 

##Official Documentation
Offical documentation on the Veezi API can be found [Veezi API](http://api.us.veezi.com/Help)

##Code Examples
Included within the repo is an examples folder, here you can find a few working examples of the various options.

###Films
***Get and list all films***

```php
//-- get the autoload page
require_once __DIR__ . '../../vendor/autoload.php';

//-- load in a some settings/configuration file.
require_once __DIR__ . '/config.php';

use VeeziAPI\VeeziAPIWrapper as VeeziAPI;
$Veezi = new VeeziAPI(VEEZI_API_TOKEN);

//--get a list of all films
$films = $Veezi->films();
//--loop throught the result and list by film title
foreach ($films as $film) {
    echo '<a href="film.php?filmid=' . $film->getId() . '">' . $film->getTitle() . '</a>';
}
```
***Film Listing Visual EG ***
![Veezi Film Dates/Times listings](/Examples/screenshots/Veezi-screenshot-FilmListings.png)

***Get a particular film and its details***

```php
//-- get the autoload page
require_once __DIR__ . '../../vendor/autoload.php';

//-- load in a some settings/configuration file.
require_once __DIR__ . '/config.php';

use VeeziAPI\VeeziAPIWrapper as VeeziAPI;
$Veezi = new VeeziAPI(VEEZI_API_TOKEN);

//--get a selected film
$film = $Veezi->selectedFilm($film_id);

//-- film title
$film_title = $film->getTitle();

//-- film synopsis
$film_synopsis = $film->getSynopsis();

//--film people Actor, Director, Producer
$film_people = $film->getPeople();
```

There are also other options available to a film instance, some more below.
- `$film->getGenre()`
- `$film->getFormat()`
- `$film->getLanguage()`
- `$film->getDatesAndTimes()`
- `$film->getRoles()`

There are also some that are returned as Arrays and other objects, take the `$film->getStartDate()`, what is returned is a [Carbon](https://github.com/briannesbitt/Carbon) instance, so it can be converted using any of the methods available through Carbon,

```php
//-- set date as a readable date
$film->getStartDate()->format('l jS \\of F Y');
```
**EG: Sort people in their roles. (Actor/Director/Producer)**

```php
//-- return a list of roles and the people for each role 
$roles = $film->getRoles();

<div class="row">
    <div class="col-md-4">
        <h4>Actors</h4>
        <?php
            echo '<ul class="list-unstyled">';
                foreach ($roles['actors'] as $actors) { echo '<li>' . $actors . '</li>';}
            echo '</ul>';
        ?>
    </div>
    <div class="col-md-4">
        <h4>Directors</h4>
        <?php
            echo '<ul class="list-unstyled">';
                foreach ($roles['directors'] as $directors) { echo '<li>' . $directors . '</li>';}
            echo '</ul>';
        ?>
    </div>
    <div class="col-md-4">
        <h4>Producers</h4>
        <?php
            echo '<ul class="list-unstyled">';
                foreach ($roles['producers'] as $producers) { echo '<li>' . $producers . '</li>';}
            echo '</ul>';
        ?>
        </div>
    </div>
</div>
```

The output woudl be somethig like:

Actors | Directors | Producers
------------ | ------------- | -------------
Actor Name | Directors Name | Producers Name

***Adding A list of dates and Times***

You can also get a list of dates and times for the selected film to display as clickable links to book tickets.  Visual ref below and the code to follow.
![Veezi Film Dates/Times listings](/Examples/screenshots/Veezi-screenshot-DateAndTimes.png)

```php
//-- Get the films dates and times
$film_start_dates = $film->getDatesAndTimes();

//-- Out put the Dates and times
foreach ($film_start_dates as $date => $times) {
    echo '<h5>' . $date . '</h5>';
    echo '<div>';
    foreach ($times as $time) {
        echo '<button type="button">' . $time . '</button>';
    }
    echo '</div>';
}


##Installation

 mmm! let me think this one through at the moment as its simple but does rely on a couple of libraries for assistance. TBC

##To Do
As this is currently on going I have a list of to do's below:

- [x] Build the Film Classes
- [ ] Build the Cinema classe(s)
- [ ] Build the Screen classe(s)
- [x] Add examples 
- [ ] Create booking links for films
- [ x] Create film dates for each film
- [ ] More in-depth read me file or wiki 

### License

The Veezi-API-Wrapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

