<?php
require_once __DIR__ . '../../App/start.php';

/**
 * Get a list of all films
 */
$films = $Veezi->getFilms();

?>
    <?php include_once 'inc/header.inc.php'; ?>
     
    <div class="container">
        
        <h3>My Veezi Film Listing</h3>
        
        <div class="list-group">
            <?php //-- lists films
                foreach ($films as $film) {
                   echo '<a href="film.php?filmid=' . $film->getId() . '" class="list-group-item">' . $film->getTitle() . '<span class="badge">' . $film->getRating()['rate'] . '</span></a>';
                }
            ?>
        </div>

    </div>

    <?php include_once 'inc/footer.inc.php'; ?>
