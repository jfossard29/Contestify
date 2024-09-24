<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Candidatures</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>index.php/back/afficher">Contestify</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url();?>index.php/admin/concours">Concours</a></li>
                            <li class="breadcrumb-item active">Candidatures</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Prenez action sur les candidatures du concours que vous venez de selectionner.
                            </div>
                        </div>
<?php
if ($candidature!=NULL){
  ?>
   <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Table candidature
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Mail</th>
                        <th>Catégorie</th>
                        <th>Etat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

    <?php
// Boucle de parcours de toutes les lignes du résultat obtenu
foreach($candidature as $co){
    echo "<td>".$co["cdt_nom"]."</td>";
    echo "<td>".$co["cdt_prenom"]."</td>";
    echo "<td>".$co["cdt_mail"]."</td>";
    echo "<td>".$co["cat_nom"]."</td>";
    echo "<td>".$co["cdt_etat"]."</td>";
    echo "<td>";
         echo "<a class='btn btn-secondary btn-block btn-round'>Visualiser</a>";
         if($_SESSION['role']=='A') {
         echo "<a class='btn btn-danger btn-block btn-round' href='".base_url()."index.php/admin/supprimercandidature/".$ccr."/".$co["cdt_id"]."'>Supprimer</a>";
         }
    echo "</td>";
    echo "</tr>";
    }
}
else {
  echo "<h1>Aucune candidature pour l'instant !</h1>";
}
?>
</tbody>
</table>
<?php
if(isset($suppression)) {
    ?>                      <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card bg-success text-white mb-4">
                                        <div class="card-body">Candidature supprimée avec succès</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between"></div>
                                    </div>
                                </div>
                            </div>
    <?php
}
?>
</div>
</div>