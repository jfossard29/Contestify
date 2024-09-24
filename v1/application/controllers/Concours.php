<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Concours extends CI_Controller {
 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');
 }
 public function afficher()
 {
 $data['concours'] = $this->db_model->get_all_concours();
 $this->load->view('templates/haut');
 $this->load->view('templates/menu_visiteur');
 $this->load->view('page_concours',$data);
 $this->load->view('templates/bas');

 }
 /*public function lister($concours)
 {
 $data['concours'] = $this->db_model->get_all_concours();
 $this->load->view('templates/haut');
 $this->load->view('templates/menu_visiteur');
 $this->load->view('page_concours',$data);
 $this->load->view('templates/bas');

 }*/
}
?>