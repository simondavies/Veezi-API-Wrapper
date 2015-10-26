<?php
require_once __DIR__ . '../../App/start.php';

if(isset($_GET['filmid']) && !empty($_GET['filmid'])) {

    $film_id = $_GET['filmid'];
    /**
     * Get the requested film data
     */
    $film = $Veezi->selectedFilm($film_id);

}

?>
    <?php include_once 'inc/header.inc.php'; ?>
     
    <div class="container">
        <div class="page-header">
            <h3><?=$film->getTitle(); ?></h3>
            <p class="text-muted"><?= $film->getGenre(); ?> / <?= $film->getRating()['rate']; ?>  - <?= $film->getRating()['reason']; ?></p>
        </div>
        <p class="lead"><?= $film->getSynopsis(); ?></p>
        <button type="button" class="btn btn-primary">Book Now</button>
        <hr />
        <h4>Cast</h4>
        <ul class="list-unstyled">
            <?php
                foreach ($film->getPeople() as $people) {
                   echo '<li>' . $people->getName() . ' <small class="text-muted">(' .  $people->getRole() . ')</small></li>';
                }
            ?>
        </ul>
        <br /><hr />
        <a href="films.php">< Back To Listings</a>

    </div>

    <?php include_once 'inc/footer.inc.php'; ?>
