<body class="landing-page sidebar-collapse">

  <div class="page-header" data-parallax="true" style="background-image: url('<?php echo base_url();?>style/Front_office/assets/img/daniel-olahh.jpg');">
    <div class="filter"></div>
    <div class="container">
      <div class="motto text-center">
        <h1>Candidature</h1>
        <h3>Êtes vous partant pour raconter une histoire ?</h3>
        <br />
      </div>
    </div>
  </div>
    
<div class="section section-dark text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-8 ml-auto mr-auto">
            <h2 class="text-center">Accédez à votre candidature</h2>
            <?php echo validation_errors(); ?>
            <?php echo form_open('candidature/visualiser'); ?>
              <div class="row">
                <div class="col-md-6">
                  <label><b>Code d'inscription</b></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="nc-icon nc-single-02"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" name="codeinscription" placeholder="...">
                  </div>
                </div>
                <div class="col-md-6"> 
                  <label><b>Code d'identification</b></label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="nc-icon nc-paper"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control" name="codeidentification" placeholder="...">
                  </div>
               </div> 
                
              </div>
              
              <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                  <br>
                  <button class="btn btn-danger btn-lg btn-fill">Visionner</button>
                </div>
              </div>
      
          </div>
        </div>
      </div>