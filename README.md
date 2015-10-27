# Veezi-API-Wrapper
A basic PHP wrapper for the [Veezi API](http://api.us.veezi.com/Help). 

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
    echo '<p>' . $film->getTitle(); . '</p>';
    }
```

***Get a particular film***

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
$film->getTitle();

//-- film synopsis
$film->getSynopsis();

//--film people Actor, Director, Producer
$film->getPeople();
```

There are also other options available to a film instance, some more below.
- `$film->getGenre()`
- `$film->getFormat()`
- `$film->getLanguage()`
- `$film->getStartDate()`

I have created a helper file also include to save time of other tasks.

**EG: List the people with in their roles. (Actor/Director/Producer)**

```php
//-- to order the people into the roles 
$roles = createRolesListing($film->getPeople());

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
```

The output woudl be somethig like:

Actors | Directors | Producers
------------ | ------------- | -------------
Actor Name | Directors Name | Producers Name


There are also some that are returned as Arrays and other objects, take the `$film->getStartDate()`, what is returned is a [Carbon](https://github.com/briannesbitt/Carbon) instance, so it can be converted using any of the methods available through Carbon,

```php
//-- set date as a readable date
$film->getStartDate()->format('l jS \\of F Y');
```

##Installation

 mmm! let me think this one through at the moment as its simple but does rely on a couple of libraries for assistance. TBC

##To Do
As this is currently on going I have a list of to do's below:

- [x] Build the Film Classes
- [ ] Build the Cinema classes
- [ ] Build the Screen classes
- [ ] Build the Sessions classes
- [ ] Build the Web Sessions classes
- [x] Add examples 

Add more functionality to the films area such as:
- [ ] Create booking links for films
- [ ] Create film dates for each film

- [ ] More in-depth read me file or wiki 

### License

The Veezi-API-Wrapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

