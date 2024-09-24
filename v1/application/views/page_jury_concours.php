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
                                Prenez action sur le concours dont vous faites partie du jury.
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
                                                <th>titre</th>
                                                <th>Date de début</th>
                                                <th>Date de fin</th>
                                                <th>Catégories</th>
                                                <th>phase du concours</th>
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
                            if ($co["phase_concours"]=="selection" ||$co["phase_concours"]=="finale" || $co["phase_concours"]=="terminée") {
                                echo "<a class='btn btn-warning btn-block btn-round' href=''>Galerie</a>";
                            }
                            echo "</td>";
                            $traite[$co["ccr_id"]]=1;
                            echo "</tr>";
                            }
                        }
                        }
                        else {
                        echo "<h1>Aucun concours pour l'instant !</h1>";
                        }

                        ?>
                            </div>
                        </div>
                    </div>
                </main>
            </div>