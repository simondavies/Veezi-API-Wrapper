<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Veezi API Wrapper</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-6">
          <ul class="nav navbar-nav">
            <li <?= (($menu_active === 'home')?'class="active"':'') ?>><a href="index.php">Home</a></li>
            <li <?= (($menu_active === 'films')?'class="active"':'') ?>><a href="films.php">Films</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
</nav>