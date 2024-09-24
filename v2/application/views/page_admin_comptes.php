<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Comptes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>index.php/back/afficher">Contestify</a></li>
                            <li class="breadcrumb-item active">Comptes</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Prenez action sur les comptes de Contestify
                            </div>
                        </div>
<?php
if ($jury!=NULL){
  ?>
   <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Table des jurys
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Pseudo</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse mail</th>
                        <th>Statut</th>
                        <th>Etat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
      
    <?php foreach($jury as $ju){
            echo "<tr>";
            echo "<td>".$ju["cpti_pseudo"]."</td>";
            echo "<td>".$ju["pfl_nom"]."</td>";
            echo "<td>".$ju["pfl_prenom"]."</td>";
            echo "<td>".$ju["pfl_mail"]."</td>";
            echo "<td>";
            if($ju["pfl_statut"]=="J") {
                echo "Jury";
            } else if ($ju["pfl_statut"]=="A") {
                echo "Administrateur";
            }
            echo "</td>";
            echo "<td>";
            if($ju["pfl_etat"]=="A") {
                echo "Actif";
            } else if ($ju["pfl_etat"]=="F") {
                echo "Desactivé";
            } else {
                echo "Principal";
            }
            echo "</td>";
            echo "<td>";
            if($ju["cpti_pseudo"]!=$_SESSION['username'] && $ju["pfl_statut"]!="P") {
            echo "<a class='btn btn-danger btn-block btn-round' href=''>Supprimer</a>";
            echo "<a class='btn btn-secondary btn-block btn-round' href=''>Desactiver</a>";
            echo "<a class='btn btn-warning btn-block btn-round' href=''>Modifier</a>";
            }
            echo "</td>";
            echo "</tr>";
    }

  } else {
    echo "<h1>Aucune actualité pour le moment !</h1>";
  }?>
    </tbody>
  </table>

  <div class="col-xl-3 col-md-6">
     <div class="card bg-primary text-white mb-4">
         <div class="card-body">Ajouter un compte</div>
         <div class="card-footer d-flex align-items-center justify-content-between">
            <a class="small text-white stretched-link" href="<?php echo base_url();?>index.php/admin/creer">Cliquez ici</a>
            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
         </div>
    </div>
  </div>
         <?php
         if(isset($confirmation)) {
            ?>
   <div class="col-xl-3 col-md-6">
      <div class="card bg-success text-white mb-4">
             <div class="card-body">Compte ajouté avec succès</div>
             <div class="card-footer d-flex align-items-center justify-content-between"></div>
      </div>
  </div>
            <?php
         }
         ?>
     
 
