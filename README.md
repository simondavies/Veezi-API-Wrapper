# Veezi-API-Wrapper
A basic wrapper for the [Veezi Film API](http://api.us.veezi.com/Help). Its designed to help users get the data returned from the api and utilise on their websites, in a much easier format.

##Official Documentation
Offical documentation on the Veezi API can be found [Veezi API](http://api.us.veezi.com/Help)

##Code Examples
Included within the repo is an examples folder, here you can find a few working examples of the various options.

Below is an example on how to get a list of all films assigned to that Site (Cinema).

```php
use VeeziAPI\VeeziAPIWrapper as VeeziAPI;
$Veezi = new VeeziAPI(VEEZI_API_TOKEN);
//--get a list of all films
$films = $Veezi->films();
//--loop throught the result and list by film title
foreach ($films as $film) {
    echo '<p>' . $film->getTitle(); . '</p>';
    }
```

Getting a particular film.

```php
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

//-- to order the people into the roles 
$roles = createRolesListing($film->getPeople());

echo '<ul>';
    foreach ($roles['actors'] as $actors) { echo '<li>' . $actors . '</li>';}
echo '</ul>';
```
There are also other options availbe to a film instance.
- `$film->getGenre()`
- `$film->getFormat()`
- `$film->getLanguage()`
- `$film->getStartDate()`

There are also some that are returned as Arrays and other objects, take the `$film->getStartDate()`, what is returned is a Carbon instance (https://github.com/briannesbitt/Carbon), so it can be converted using any of the methods availabele through Carbon,

```php
//-- set date as a readable date
$film->getStartDate()->format('l jS \\of F Y');
```

##Motivation
I was ask to look into using the Veezi API  and to see what would be possible to build an accompanying website.  In looking at the results and the basics of it, I noticed that I would have to refactor the callbacks inorder to use for website usage, so when searching around I could not find a php wrapper for this API, and thought best to look at doing one where not only would help me but also others.

 ##Installation

 mmm! let me think this one through at the moment as its simple but does rely on a couple of libraries for assitance. TBC

##To Do
As this is currently on going I have a list of todo's below:

- [x] Build the Film Classes
- [ ] Build the Cinema classes
- [ ] Build the Screen classes
- [ ] Build the Sessions classes
- [ ] Build the Web Sessions classes
- [x] Add examples 
- [ ] More in-depth read me file or wiki 

 Add more functionality to the films area such as:
- [ ] Create booking links for films
- [ ] Create film dates for each film

### License

The Veezi-API-Wrapper is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
