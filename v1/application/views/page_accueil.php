<body class="landing-page sidebar-collapse">

  <div class="page-header" data-parallax="true" style="background-image: url('<?php echo base_url();?>style/Front_office/assets/img/daniel-olahh.jpg');">
    <div class="filter"></div>
    <div class="container">
      <div class="motto text-center">
        <h1>Contestify</h1>
        <h3>Faites nous découvrir votre monde</h3>
        <br />
      </div>
    </div>
  </div>
  <div class="typography-line">
  <?php if($actualites!=NULL) {
    echo "<h1>Actualités du moment :</h1>";
    ?>
          </div>
  <div class="main">
      <!-- TABLE D ACTUALITE -->
  <div class="container">        
    <table class="table">
      <thead>
        <tr>
          <th>Publieur</th>
          <th>Titre</th>
          <th>date</th>
        </tr>
      </thead>
    <tbody>
      
    <?php foreach($actualites as $act){
            echo "<tr>";
            echo "<td>".$act["cpti_pseudo"]."</td>";
            echo "<td>".$act["act_titre"]."</td>";
            echo "<td>".$act["act_date"]."</td>";
            echo "</tr>";
    }
  } else {
    echo "<h1>Aucune actualité pour le moment !</h1>";
  }?>
    </tbody>
  </table>
  </div>
    <div class="section text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="title">Vous venez d'arriver ?</h2>
            <h5 class="description">Nous travaillons avec plusieurs organismes de concours d'écritures en ligne afin de vous offrir un accès rapide, 
            						une découverte intuitive et une inscription simple aux différents concours. Les différents gagnants verront leurs
            						travaux (sous demande) affichés afin de donner une certaine visibilité.</h5>
            <br>
          </div>
        </div>
        <br/>
        <br/>
        <div class="row">
          <div class="col-md-3">
            <div class="info">
              <div class="icon icon-danger">
                <i class="nc-icon nc-hat-3"></i>
              </div>
              <div class="description">
                <h4 class="info-title">Profils</h4>
                <p class="description">Renseignez-vous sur les juges grâce à leur profils</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info">
              <div class="icon icon-danger">
                <i class="nc-icon nc-bulb-63"></i>
              </div>
              <div class="description">
                <h4 class="info-title">Authentique</h4>
                <p>Nous tâchons de vous proposer une manière authentique de participer aux concours</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info">
              <div class="icon icon-danger">
                <i class="nc-icon nc-bell-55"></i>
              </div>
              <div class="description">
                <h4 class="info-title">Écoute</h4>
                <p>Pour chaque nouveau concours et actualités, nous le vous ferons savoir !</p>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="info">
              <div class="icon icon-danger">
                <i class="nc-icon nc-sun-fog-29"></i>
              </div>
              <div class="description">
                <h4 class="info-title">Joli design</h4>
                <p>Nous nous efforçons de vous proposer une navigation agréable et intuitive</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="section section-dark text-center">
      <div class="container">
        
        <h2  class="title">êtes vous partant ?</h2>
        <div class="row">
          
          <div class="col-md-4">
            <div class="card card-profile card-plain">
              <a href="<?php echo base_url();?>">
            <div class="info">
              <div class="icon icon-danger">
                <i class="nc-icon nc-layout-11"></i>
              </div>
            </div>
              <div class="card-body">
                  <div class="author">
                  <h4 class="card-title"> Actualités</h4>
                  </div>
                <p class="card-description text-center">
                  Découvrez les actualités du moment, restez à la page !
                </p>
              </div>
            </a>
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-profile card-plain">
              <a href="<?php echo base_url();?>index.php/concours/afficher" >
            <div class="info">
              <div class="icon icon-danger">
                <i class="nc-icon nc-book-bookmark"></i>
              </div>
              </div>
              <div class="card-body">
                  <div class="author">
                  <h4 class="card-title"> Concours</h4>
                  </div>
                <p class="card-description text-center">
                  Renseignez-vous sur les concours passés, présents et à venir... 
                </p>
              </div>
            </a>
              
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-profile card-plain">
            <a href="<?php echo base_url();?>index.php/candidature/visualiser">
            <div class="info">
            
            <div class="icon icon-danger">
                <i class="nc-icon nc-circle-10"></i>
              </div>
              </div>
  
              <div class="card-body">
                
                  <div class="author">
                  <h4 class="card-title"> Candidat</h4>
                  </div>
                <p class="card-description text-center">
                  Vous êtes déjà inscrit à un concours ? Vérifiez votre candidature en cliquant ici !
                </p>
              </div>
              </a>
              
            </div>
          </div>
        </div>
      </div>
    </div>
