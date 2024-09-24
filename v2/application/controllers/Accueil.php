<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accueil extends CI_Controller {
 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');
 }
 public function afficher()
 {
 $data['actualites'] = $this->db_model->get_all_actualite();
 $this->load->view('templates/haut');
 $this->load->view('templates/menu_visiteur');
 $this->load->view('page_accueil',$data);
 $this->load->view('templates/bas');

 }
}
?>