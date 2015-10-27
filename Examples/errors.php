<?php include_once 'inc/header.inc.php'; ?>
     
    <div class="container">
        <h1>Veezi API Wrapper</h1>
        <div class="page-header">
            <h3>Ouch! Seems there was an issue</h3>
            <p>Please see an explination of that error below...</p>
        </div>
        <div class="alert alert-danger" role="alert">
        <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])){ ?>
             <?=$_SESSION['errors']; ?>
        <?php }  else {?>
                Oh! seems there is nothing to report, so how did you get here, HOW!
        <?php } ?>
        </div>
        <hr />
        
        <a href="index.php">&lang;  Examples</a>
    </div>

    <?php // clear the session errors now
        session_destroy();
    ?>

    <?php include_once 'inc/footer.inc.php'; ?>
