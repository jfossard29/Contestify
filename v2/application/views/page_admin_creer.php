<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#statut').change(function(){
            if($(this).val() === 'A') { // si la valeur sélectionnée est 'Administrateur'
                $('#discipline_label, #discipline, #blio_label, #blio, #url_label, #url').hide(); // on cache les éléments correspondants
                $('#discipline, #blio, #url').val(''); // on vide les champs correspondants
            } else {
                $('#discipline_label, #discipline, #blio_label, #blio, #url_label, #url').show(); // sinon on affiche les éléments correspondants
            }
        });
    });
</script>

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
                                        <?php
                                    if ($erreur) {
                                        if ($erreur!="deux") {
                                            echo "le ".$erreur." est déjà utilisé";
                                        } elseif ($erreur=="deux") {
                                            echo "le pseudo ainsi que le mail sont déjà utilisés, veuillez changer.";
                                        } 
                                    }?>
                                    <?php echo validation_errors(); ?>
                                    <?php echo form_open('admin/creer');?>
                                        <label for="statut">Statut du compte</label>
                                        <select class="form-control" name="statut" id="statut">
                                            <option value="J">Jury</option>
                                            <option value="A">Administrateur</option>
                                        </select>
                                        <label for="pseudo">Pseudo :</label>
                                        <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" id="pseudo">
                                        <label for="nom">Nom :</label>
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" id="nom">
                                        <label for="prenom">Prenom :</label>
                                        <input type="text" class="form-control" name="prenom" placeholder="Prénom" id="prenom">
                                        <label for="mail">Mail :</label>
                                        <input type="text" class="form-control" name="mail" placeholder="Adresse mail" id="mail">
                                        <label for="discipline" id="discipline_label">Discipline :</label>
                                        <input type="text" class="form-control" name="discipline" id="discipline" placeholder="Discipline">
                                        <label for="blio" id="blio_label">Blibliographie :</label>
                                        <input type="text" class="form-control" name="blio" id="blio" placeholder="Blibliographie">
                                        <label for="url" id="url_label">URL :</label>
                                        <input type="text" class="form-control" name="url" id="url" placeholder="URL site internet">
                                        <label for="mdp">Mot de passe :</label>
                                        <input type="password" class="form-control" placeholder="Mot de passe" name="mdp" id="mdp">
                                        <label for="mdpconfirm">Confirmez mot de passe :</label>
                                        <input type="password" class="form-control" placeholder="Confirmer Mot de passe" name="mdpconfirm" id="mdpconfirm">

                                    
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
                                    </form>
                                        <a class="btn btn-danger btn-block btn-round" href="<?php echo base_url();?>index.php/admin/comptes">Retour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>