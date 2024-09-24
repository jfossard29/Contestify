<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Profil</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>index.php/back/afficher">Contestify</a></li>
                            <li class="breadcrumb-item active">Profil</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Ici, vous avez accès à vos informations diffusées sur le site, ainsi que vos identifiants. Vous pouvez modifier le mot de passe.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fas fa-user fa-fw"></i>
                                        Informations
                                    </div>
                                    <div class="card-body">
                                        <ul>
                                            <li class="">Pseudo : <?php echo $_SESSION['username'] ?></li>
                                            <li class="">Nom : <?php echo $information->pfl_nom ?></li>
                                            <li class="">Prenom : <?php echo $information->pfl_prenom ?></li>
                                            <li class="">Mail : <?php echo $information->pfl_mail ?></li>
                                            <?php if ($_SESSION['role']=="J") { ?>
                                            <li class="">Discipline : <?php echo $information->pfl_discipline; ?></li>
                                            <li class="">Blibliographie : <?php echo $information->pfl_blio; ?></li>
                                            <li class="">URL du site : <a href="<?php echo $information->pfl_URL; ?>"><?php echo $information->pfl_URL; ?></a></li>
                                            <?php } ?>
                                        </ul>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Action
                                    </div>
                                    <div class="card-body">
                                    <?php if($_SESSION['username']=='organisateur') {
                                    echo "<a>Vous ne pouvez pas modifier ce profil</a>";
                                    } else {
                                        echo "<a href='".base_url()."index.php/back/modifier'>Modifier le profil ?</a>";
                                    }
                                    ?>    
                                    </div>
                                </div>
                                <?php
                                if($confirmation && $confirmation =="success") {
                                ?>
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Compte modifié avec succès</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between"></div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            
                        </div>
                    </div>
                </main>
            </div>