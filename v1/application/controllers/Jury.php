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
   if(!isset($_SESSION['role']) || $_SESSION['role']!="J" ){
      // Redirige l'utilisateur vers la page de connexion
      redirect(base_url()."index.php/connexion/connecter");
  }
    $data['concours'] = $this->db_model->get_jury_concours($_SESSION['username']);
    $this->load->view('templates/haut_back');
    $this->load->view('page_jury_concours',$data);
    $this->load->view('templates/bas_back');
 }

}
 ?>