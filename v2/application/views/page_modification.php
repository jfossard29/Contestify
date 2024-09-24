
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
                                Modifiez votre profil. Le mot de passe est obligatoire, changeant ou non.
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
                                        <?php 
                                        echo validation_errors(); 
                                        echo form_open('back/modifier');
                                        if($_SESSION['role']=='J') {
                                          ?>
                                        <label>Pseudo :</label>
                                        <input type="text" class="form-control" name="pseudoafficher" value="<?php echo $information->cpti_pseudo ?>" disabled >
                                        <input type="text" class="form-control" name="pseudo" value="<?php echo $information->cpti_pseudo ?>" hidden >
                                        <label>Nom :</label>
                                        <input type="text" class="form-control" name="nom" value="<?php echo $information->pfl_nom ?>" disabled>
                                        <label>Prenom :</label>
                                        <input type="text" class="form-control" name="prenom" value="<?php echo $information->pfl_prenom ?>" disabled>
                                        <label>Mail :</label>
                                        <input type="email" class="form-control" name="mail" value="<?php echo $information->pfl_mail ?>" disabled>
                                        <label>Discipline :</label>
                                        <input type="text" class="form-control" name="discipline" value="<?php echo $information->pfl_discipline ?>" disabled>
                                        <label>Blibliographie :</label>
                                        <input type="text" class="form-control" name="blio" value="<?php echo $information->pfl_blio ?>" disabled>
                                        <label>URL :</label>
                                        <input type="url" class="form-control" name="url" value="<?php echo $information->pfl_URL?>" disabled>
                                        <label>Nouveau mot de passe :</label>
                                        <input type="password" class="form-control" placeholder="Mot de passe" name="mdp">
                                        <label>Confirmez le mot de passe :</label>
                                        <input type="password" class="form-control" placeholder="Confirmer Mot de passe" name="mdpconfirm">
                                        <?php
                                        } else {
                                            ?>
                                            <label>Nom :</label>
                                            <input type="text" class="form-control" name="nom" value="<?php echo $information->pfl_nom ?>" disabled>
                                            <label>Prenom :</label>
                                            <input type="text" class="form-control" name="prenom" value="<?php echo $information->pfl_prenom ?>" disabled>
                                            <label>Nouveau mot de passe :</label>
                                            <input type="password" class="form-control" placeholder="Mot de passe" name="mdp">
                                            <label>Confirmez le mot de passe :</label>
                                            <input type="password" class="form-control" placeholder="Confirmer Mot de passe" name="mdpconfirm">
                                            <?php
                                        }
                                        ?>
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
                                    <input class="btn btn-success btn-block btn-round" type="submit" value="Modifier"/>
                                        <a class="btn btn-danger btn-block btn-round" href="<?php echo base_url();?>index.php/back/profil">Retour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>