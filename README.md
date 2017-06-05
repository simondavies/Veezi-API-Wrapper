# Veezi-API-Wrapper
A basic PHP wrapper for the [Veezi API](http://api.us.veezi.com/Help). 

**THIS IS STILL IN DEVELOPEMENT AND CAN CHANGE**

While being asked to look into the Veezi API,  to enable a website to display its relevant film data onto the site, so not to duplicate work etc. I would need to do a bit of work to manipulate the current data returned, to be used on a website, so not being able to find any current PHP code for use with the Veezi API, thought be nice to build this and thne make it available to Veezi as well as others. 

## Official Documentation
Offical documentation on the Veezi API can be found [Veezi API](http://api.us.veezi.com/Help)

- [Requirements](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#requiremnents)
- [Installation](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#installation)
- [Examples](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#code-examples)
- [To Do's](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#to-do)
- [License](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#license)

## Code Examples
Included within the repo is an examples folder, here you can find a few working examples of the various options.

- [Film Listing](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#film-listings)
- [Selected Film](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#selected-film)
- [FIlm Roles/People](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#film-roles)
- [Film Dates/Times & Ticket Links](https://github.com/simondavies/Veezi-API-Wrapper/tree/develop#film-datestimes--ticket-links)


### Film Listings

Get and display a list of films
![Veezi Film Dates/Times listings](/Examples/screenshots/Veezi-screenshot-FilmListings.png)

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

### Selected Film 

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
### Selected Film Poster
Currently it is __NOT__ possible to gain access to the actual poster.  As the posters are currently stored within the protected area of their severs, and in order gain access via a URL you will need to be signed in to the Veezi system.

So adding the url to the posters will fail for now. Veezi are looking into switchign this, so that they can also be referenced.  in the mean time, in order to display posters, you will need to work on your own version/method.

If you need any ideas or solutions please feel free to contact me, on how i get around this.

### Film Roles 
Sort people and prepare a list of roles. (Actor/Director/Producer)

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

The output would be somethig like:

Actors | Directors | Producers
------------ | ------------- | -------------
Actor Name | Directors Name | Producers Name


### Film Dates/Times & Ticket Links 

List the selected films Dates and times, with booking links on the times.

You can also get a list of dates and times for the selected film to display as clickable links to book tickets.

![Veezi Film Dates/Times listings](/Examples/screenshots/Veezi-screenshot-DateAndTimes.png)

```php
//-- Get the films dates and times
$film_start_dates = $film->getDatesAndTimes();

//-- Out put the Dates and times
foreach ($film_start_dates as $date => $times) {
    echo '<h5>' . $date . '</h5>';
    echo '<div class="btn-group" role="group" aria-label="">';
    foreach ($times as $time) {
        echo '<a class="btn btn-info" 
                 href="' . $time['link'] . '?siteToken=' . VEEZI_SITE_TOKEN . '" 
                 target="_blank">' . $time['time'] . '</a>';
    }
    echo '</div>';
}
```

## Requiremnents

- PHP >= 5.4.0 
- [Veezi](http://www.veezi.com/) Active Account
- Veezi API Token
- [guzzlehttp/guzzle](https://github.com/guzzle/guzzle)
- [nesbot/Carbon](https://github.com/briannesbitt/Carbon)


## Installation

The recommended way to install this repo is through [Composer](http://getcomposer.org/)

#### Install Through Composer

If your using thsi as the initial project then you can install via:

```
composer create-project simondavies/veezi-api-wrapper
```
Else to include within in a current project run

```
composer.phar require simondavies/veezi-api-wrapper
```

#### Install Via Github/Without Composer

**Via SSH**
```
git clone git@github.com:simondavies/Veezi-API-Wrapper.git target-directory
```
**Via HTTPS**
```
git clone https://github.com/simondavies/Veezi-API-Wrapper.git target-directory
```

#### Set Up

Once the project has been downloaded we need to continue the initial set up.

```
cd target-directory
composer update
```

Add a config file.
```
cd App
cp config.example.php config.php
```

Update the following details with your Veezi API and Site Tokens.

```
define('VEEZI_API_TOKEN', '?????????');
define('VEEZI_SITE_TOKEN', '??????????');
```

Once thats been done, you can check that all is OK by visiting the Examples folder within a Browser.

***Please view the other required repos' install guidelines, if not installing from composer.***


## To Do
As this is currently on going I have a list of to do's below:

- [x] Build the Film Classes
- [ ] Build the Cinema classe(s)
- [ ] Build the Screen classe(s)
- [x] Add examples 
- [x] Create booking links for films
- [x] Create film dates for each film
- [ ] More in-depth read me file or wiki 

### License

The Veezi-API-Wrapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

