<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Concours</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>index.php/back/afficher">Contestify</a></li>
                            <li class="breadcrumb-item active">Concours</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Prenez action sur les concours listés.
                            </div>
                        </div>
<?php
if ($concours!=NULL){
  ?>
   <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Table concours
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
            <thead>
                <tr>
                <th>Organisateur</th>
                <th>Titre</th>
                <th>Date de début</th>
                <th>Date de fin</th>
                <th>Catégories</th>
                <th>phase du concours</th>
                <th>Membres du jury</th>
                <th>Visualisation</th>
                <th>Action</th>
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
    echo "<td>".$co["organisateur"]."</td>";
    echo "<td>".$co["ccr_titre"]."</td>";
    echo "<td>".$co["ccr_date"]."</td>";
    echo "<td>".$co["ccr_dtefinaliste"]."</td>";
    echo "<td>";
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
    echo "</td>";
    echo "<td>".$co["phase_concours"]."</td>";

    echo "<td>";
    if ($co["jury"]!="") {
      $toutjury=explode("; ",$co["jury"]);
      
      foreach($toutjury as $jury) {
          echo "<ul>";
          echo "<li>".$jury."</li>";
          echo "</ul>";

      }
    } else {
      echo "<ul>";
      echo "<li>Aucun membre du jury</li>";
      echo "</ul>";
    }
    echo "</td>";
    echo "<td>";
    if($co["phase_concours"]=="terminée") {
        echo "<a class='btn btn-info'>Palmarès</a>";
      }
      else if ($co["phase_concours"]=="selection" ||$co["phase_concours"]=="finale") {
        echo "<a class='btn btn-secondary' href='".base_url()."index.php/admin/affichercandidature/".$co["ccr_id"]."'>Galerie</a>";
      } else if ($co["phase_concours"]=="Inscription") {
        echo "<a class='btn btn-success' href='".base_url()."index.php/admin/affichercandidature/".$co["ccr_id"]."'>Inscriptions</a>";
      }
      echo "</td>";
      echo "<td>"."<a class='btn btn-warning'>Modifier</a>";
      echo "<td>"."<a class='btn btn-danger'>Supprimer</a>";
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
</div>