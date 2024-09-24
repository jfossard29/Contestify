<body class="landing-page sidebar-collapse">

  <div class="page-header" data-parallax="true" style="background-image: url('<?php echo base_url();?>style/Front_office/assets/img/daniel-olahh.jpg');">
    <div class="filter"></div>
    <div class="container">
      <div class="motto text-center">
        <h1>Candidatures</h1>
        <h3>Vous êtes curieux ?</h3>
        <br />
      </div>
    </div>
  </div>
  
  <div class="typography-line">
  <?php
    if ($candidature!=NULL){
      echo "<h1>Liste des candidatures :</h1>";
  ?>
          </div>
          <div class="main">
  <div class="container">  

    <table class="table table-bordered">
    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Catégorie</th>
                    </tr>
                </thead>
                <tbody>

    <?php
// Boucle de parcours de toutes les lignes du résultat obtenu
foreach($candidature as $co){
    echo "<td><b>".$co["cdt_nom"]."</b></td>";
    echo "<td><b>".$co["cdt_prenom"]."</b></td>";
    echo "<td><b>".$co["cdt_mail"]."</b></td>";
    echo "<td><b>".$co["cat_nom"]."</b></td>";
    echo "</tr>";
    }
}
else {
  echo "<h1>Aucune candidature pour l'instant !</h1>";
}
?>
 </tbody>
</table>
</div>
