<?php
if($_SESSION['statut']!= 'A'){
    redirect(base_url()."index.php/connexion/connecter");
    }
    ?>
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Comptes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="<?php echo base_url();?>index.php/back/afficher">Contestify</a></li>
                            <li class="breadcrumb-item active"><a href="<?php echo base_url();?>index.php/admin/comptes">Comptes</a></li>
                            <li class="breadcrumb-item active">Création</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                Vous êtes sur le point de créer un nouveau compte.
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
                                        <?php echo validation_errors(); ?>
                                        <?php echo form_open('admin/creer'); ?>
                                        <label>Pseudo :</label>
                                        <input type="text" class="form-control" name="pseudo" placeholder="Pseudo">
                                        <label>Nom :</label>
                                        <input type="text" class="form-control" name="nom" placeholder="Nom">
                                        <label>Prenom :</label>
                                        <input type="text" class="form-control" name="prenom" placeholder="Prénom">
                                        <label>Mail :</label>
                                        <input type="email" class="form-control" name="mail" placeholder="Adresse mail">
                                        <label>Discipline :</label>
                                        <input type="text" class="form-control" name="discipline" placeholder="Discipline">
                                        <label>Blibliographie :</label>
                                        <input type="text" class="form-control" name="blio" placeholder="Blibliographie">
                                        <label>URL :</label>
                                        <input type="url" class="form-control" name="url" placeholder="URL site internet">
                                        <label>Mot de passe :</label>
                                        <input type="password" class="form-control" placeholder="Mot de passe" name="mdp">
                                        <label>Confirmez mot de passe :</label>
                                        <input type="password" class="form-control" placeholder="Confirmer Mot de passe" name="mdpconfirm">
                                        <label>Statut du compte</label>
                                        <select class="form-control" name="statut" id="statut">
                                            <option value="J">Jury</option>
                                            <option value="A">Administrateur</option>
                                        </select>
                                        

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
                                    <input class="btn btn-success btn-block btn-round" type="submit" value="Créer"/>
                                        <a class="btn btn-danger btn-block btn-round" href="<?php echo base_url();?>index.php/connexion/back">Retour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>