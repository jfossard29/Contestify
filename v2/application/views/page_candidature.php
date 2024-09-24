<?php if ($candidature!=NULL) {
    foreach($candidature as $candidat)
    $prenom = $candidat["cdt_prenom"];
    $nom = $candidat["cdt_nom"];
    $etat = $candidat["Etat"];
    $mail = $candidat["cdt_mail"];
    $concours = $candidat["ccr_concours"];
    $blio = $candidat["cdt_blio"];
    $cat = $candidat["cat_nom"];
    $codeinsc = $candidat["cdt_codeinscription"];
    $codeid = $candidat["cdt_codeidentification"];
    } else {
      $prenom = "Erreur";
      $nom = "Candidat !";
      $etat = "";
      $mail = "";
      $concours = "";
      $blio = "";
      $cat = "";
      $codeinsc = "";
      $codeid = "";
    }?>
  <div class="page-header page-header-xs" data-parallax="true" style="background-image: url('<?php echo base_url();?>style/Front_office/assets/img/fabio-mangione.jpg');">
    <div class="filter"></div>
  </div>
  <div class="section profile-content">
    <div class="container">
      <div class="owner">

        <div class="name">
          <h4 class="title"><?php echo $prenom." ".$nom;?>
            <br />
          </h4>
          <h6 class="description">Votre biographie</h6>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 ml-auto mr-auto text-center">
          <p><?php echo $blio;?>
          <br />
        </div>
      </div>
      <br/>
      <div class="nav-tabs-navigation">
        <div class="nav-tabs-wrapper">
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#follows" role="tab">Inscription et documents</a>
            </li>
          </ul>
        </div>
      </div>
      <!-- Tab panes -->
      <div class="tab-content following">
        <div class="tab-pane active" id="follows" role="tabpanel">
          <div class="row">
            <div class="col-md-6 ml-auto mr-auto">
              <ul class="list-unstyled follows">
                <li>
                  <div class="row">
                    <div class="col-lg-2 col-md-4 col-4 ml-auto mr-auto">
                        <?php if ($etat == "Acceptée") {
                            echo "<img src='".base_url()."style/Front_office/assets/img/green.jpg' alt='Circle Image' class='img-circle img-no-padding img-responsive'>";
                        } else if ($etat == "Envoyée") {
                            echo "<img src='".base_url()."style/Front_office/assets/img/loop.png' alt='Circle Image' class='img-circle img-no-padding img-responsive'>";
                        } else {
                            echo "<img src='".base_url()."style/Front_office/assets/img/redcross.png' alt='Circle Image' class='img-circle img-no-padding img-responsive'>";
                        }
                        ?>
                    </div>
                    <div class="col-lg-7 col-md-4 col-4  ml-auto mr-auto">
                      <h6><?php echo $concours;?>
                        <br/>
                        <small><?php echo $etat.". Inscrit pour la catégorie ".$cat?></small>
                      </h6>
                    </div>
                    <div class="col-lg-7 col-md-4 col-4  ml-auto mr-auto">
                   <?php
                        foreach ($candidature as $doc) {
                          if($doc["doc_chemin"] != "") {
                            if(substr($doc["doc_chemin"],0,8)=='https://') {
                              echo "<h6> <a target='_blank' href='".$doc["doc_chemin"]."'><b>".$doc["doc_chemin"]."</b></a></h6>";
                            } else {
                              echo "<h6> <a target='_blank' href='".base_url()."documents/".$doc["doc_chemin"]."'><b>".$doc["doc_chemin"]."</b></a></h6>";
                            }
                          }
                        }
                      
                    ?>
                    </div>
                  </div>
                </li>
                <hr />
              </ul>
            </div>
          </div>
        </div>
      </div>
      <?php
      if ($candidature!=NULL) {
      echo "<a href='".base_url()."index.php/candidature/supprimer/".$codeinsc."/".$codeid."'><b>Supprimer la candidature</b></a></li>";
      }?>
    </div>
  </div>