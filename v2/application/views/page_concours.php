<body class="landing-page sidebar-collapse">

  <div class="page-header" data-parallax="true" style="background-image: url('<?php echo base_url();?>style/Front_office/assets/img/daniel-olahh.jpg');">
    <div class="filter"></div>
    <div class="container">
      <div class="motto text-center">
        <h1>Concours</h1>
        <h3>Découvrez vos terrains de jeux</h3>
        <br />
      </div>
    </div>
  </div>
  
  <div class="typography-line">
  <?php
    if ($concours!=NULL){
      echo "<h1>Liste des concours :</h1>";
  ?>
          </div>
          <div class="main">
      <!-- TABLE DE CONCOURS -->
  <div class="container">  

    <table class="table table-bordered">
    <thead>
    <tr>
    <th>Organisateur</th>
    <th>Titre</th>
    <th>Date de début</th>
    <th>Date de fin</th>
    <th>Catégories</th>
    <th>phase du concours</th>
    <th>Membres du jury</th>
    </tr>
    </thead>
    <tbody>

    <?php
// Boucle de parcours de toutes les lignes du résultat obtenu
foreach($concours as $co){
// Affichage d’une ligne de tableau pour un pseudo non encore traité
    if (!isset($traite[$co["ccr_id"]])){
    $ccr_id=$co["ccr_id"];
    $traitecat= "";
    echo "<tr>";
    echo "<td><b>".$co["organisateur"]."</b></td>";
    echo "<td><a href=''><b>".$co["ccr_titre"]."</b></a></td>";
    echo "<td><b>".$co["ccr_date"]."</b></td>";
    echo "<td><b>".$co["ccr_dtefinaliste"]."</b></td>";
    echo "<td><b>";
    if ($co['cat_nom']!="") {
      foreach($concours as $categories){
          $cat_nom=$categories["cat_nom"];
          echo "<ul>";
          if( ($ccr_id==$categories["ccr_id"]) AND (strcmp($traitecat,$categories["cat_nom"])!=0) ){
              echo "<li>".$categories["cat_nom"]."</li>";
              $traitecat= $categories["cat_nom"];
          }
          echo "</ul>";
      }
    } else {
      echo "<ul>";
      echo "<li>Aucune catégorie</li>";
      echo "</ul>";
    }
    echo "</b></td>";
    echo "<td><b>".$co["phase_concours"];
    if($co["phase_concours"]=="terminée") {
      echo "<hr>";
      echo "<a><span class='label label-danger'>".'Palmarès'."</span></a>";
      echo "<a href='".base_url()."index.php/candidature/affichercandidature/".$co["ccr_id"]."'><span class='label label-warning'>".'Galerie'."</span></a>";
    }
    else if ($co["phase_concours"]=="Inscription") {
      echo "<hr>";
      echo "<a><span class='label label-success'>".'Candidater'."</span></a>";
    } 
    else if ($co["phase_concours"]=="selection" ||$co["phase_concours"]=="finale") {
      echo "<hr>";
      echo "<a href='".base_url()."index.php/candidature/affichercandidature/".$co["ccr_id"]."'><span class='label label-warning'>".'Galerie'."</span></a>";
    }
    echo "</b></td>";

    echo "<td><b>";
    if ($co["jury"]!="") {
      $toutjury=explode("; ",$co["jury"]);
      
      foreach($toutjury as $jury) {
          echo "<ul>";
          echo "<li><a href=''><b>".$jury."</b></a></li>";
          echo "</ul>";

      }
    } else {
      echo "<ul>";
      echo "<li>Aucun membre du jury</li>";
      echo "</ul>";
    }
    echo "</b></td>";
    $traite[$co["ccr_id"]]=1;
    echo "</tr>";
    }
}
}
else {
  echo "<h1>Aucun concours pour l'instant !</h1>";
}
?>
 </tbody>
</table>
</div>
