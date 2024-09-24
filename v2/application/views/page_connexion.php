<div class="page-header" style="background-image: url('<?php echo base_url();?>style/Front_office/assets/img/login-image.jpg');">
    <div class="filter"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 ml-auto mr-auto">
          <div class="card card-register">
            <h3 class="title mx-auto">Bienvenue</h3>
            <?php 
            if(isset($connexion)) {
              echo "<p>Identifiants erronés ou inexistants !";
            }
                  echo validation_errors(); ?>
            <?php echo form_open('connexion/connecter'); ?>
              <label>Login</label>
              <input type="text" class="form-control" placeholder="Login" name="pseudo">
              <label>Mot de passe</label>
              <input type="password" class="form-control" placeholder="Mot de passe" name="mdp">
              <input class="btn btn-danger btn-block btn-round" type="submit" value="Connexion"/>
          </div>
        </div>
      </div>
    </div>
   