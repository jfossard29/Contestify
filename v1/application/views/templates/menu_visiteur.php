

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="300">
    <div class="container">
      <div class="navbar-translate">
      <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?php echo base_url();?>" class="nav-link"><i class="nc-icon nc-layout-11"></i> Actualités</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>index.php/concours/afficher" class="nav-link"><i class="nc-icon nc-book-bookmark"></i> Concours</a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url();?>index.php/candidature/visualiser" class="nav-link"><i class="nc-icon nc-circle-10"></i> Suivi de candidature</a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <a class="btn btn-outline-danger btn-round" href="<?php echo base_url();?>index.php/connexion/connecter">Connexion</a>
      
      </div>
    </div>
  </nav>
  <!-- End Navbar -->

  