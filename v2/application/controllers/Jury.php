<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Jury extends CI_Controller {

 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');

 }

 public function concours()
 {
  if(!isset($_SESSION['role'])){
    // Redirige l'utilisateur vers la page de connexion
    redirect(base_url()."index.php/connexion/connecter");
  } else if ($_SESSION['role']!="J") {
      redirect(base_url()."index.php/back/afficher");
  }
    $data['concours'] = $this->db_model->get_jury_concours($_SESSION['username']);
    $this->load->view('templates/haut_back');
    $this->load->view('page_jury_concours',$data);
    $this->load->view('templates/bas_back');
 }

 public function affichercandidature($ccr) {
  if(!isset($_SESSION['role'])){
    // Redirige l'utilisateur vers la page de connexion
    redirect(base_url()."index.php/connexion/connecter");
} else if ($_SESSION['role']!="J") {
    redirect(base_url()."index.php/back/afficher");
}
  $data['ccr']=$ccr;
  $data['candidature'] = $this->db_model->get_all_candidat($ccr);
  $this->load->view('templates/haut_back');
  $this->load->view('page_back_candidature',$data);
  $this->load->view('templates/bas_back');
}


}
 ?>