<?php
require_once __DIR__ . '../../App/start.php';

/**
 * Get a list of all films
 */
$films = $Veezi->films();

?>
    <?php include_once 'inc/header.inc.php'; ?>
     
    <div class="container">
        
        <div class="page-header">
            <h3>My Veezi Film Listing</h3>
        </div>
        <p class="text-muted">Click on a film below for more details.</p>
        
        <div class="list-group">
            <?php //-- lists films
                foreach ($films as $film) {
                    echo '<a href="film.php?filmid=' . $film->getId() . '" class="list-group-item">' . 
                                '<h4 class="list-group-item-heading">'  . $film->getTitle() . '</h4>' .
                                '<p class="list-group-item-text ellipsis">'  .  $film->getSynopsis()  . '</p>' .
                            '</a>';
                }
            ?>
        </div>
        <hr />
        
        <a href="index.php">&lang;  Examples</a>

    </div>

    <?php include_once 'inc/footer.inc.php'; ?>
