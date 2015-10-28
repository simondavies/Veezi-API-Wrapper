<?php
require_once __DIR__ . '../../App/start.php';

if(isset($_GET['filmid']) && !empty($_GET['filmid'])) {

    $film_id = $_GET['filmid'];
    /**
     * Get the requested film data
     */
    $film = $Veezi->selectedFilm($film_id);
    /**
     * sort out the peoples into their roles
     */
    $roles = createRolesListing($film->getPeople());
} else {
    header('Location: films.php');
    exit;
}

//--- the menu active page
$menu_active = 'films';
?>
    <?php include_once 'inc/header.inc.php'; ?>
    <?php include_once 'inc/menu.inc.php'; ?>

    <div class="container">
        <!-- Film Header -->
        <div class="row">
            <div class="col-md-10">
                    <h3><?=$film->getTitle(); ?></h3>
                    <p class="text-muted"><?= $film->getGenre(); ?> / <?= $film->getRating()['reason']; ?><br /><?= $film->getStartDate()->format('l jS \\of F Y');?></p>
            </div>
            <!-- Rating -->
            <div class="col-md-2">
                <img src="imgs/certs/<?= $film->getRating()['rate']; ?>.png" 
                        alt="Rating Cert: <?= $film->getRating()['rate']; ?>" 
                        titile="Rating Cert: <?= $film->getRating()['rate']; ?>" width="80" />
            </div>
        </div>
        <!-- end of Film Header -->
        <hr /><br />
        <!-- Film Image/details -->
        <div class="row">
            <div class="col-md-4">
                <img src="http://placehold.it/250x366" alt="<?=$film->getTitle(); ?>" title="<?=$film->getTitle(); ?>" />
            </div>
            <div class="col-md-8">
                <p class="lead"><?= $film->getSynopsis(); ?></p>
                <button type="button" class="btn btn-primary">Book Now</button>
            </div>
        </div>
        <!-- end of Film Image/details -->

        <hr />
        <!-- people listing -->
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
        <!-- end of people listing -->

        <br /><hr />
        
        <a href="films.php">&lang;  Films</a>

    </div>

    <?php include_once 'inc/footer.inc.php'; ?>
