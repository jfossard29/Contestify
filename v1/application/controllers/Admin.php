<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');

 }

 public function concours()
 {
   if(!isset($_SESSION['role']) || $_SESSION['role']!="A" ){
      // Redirige l'utilisateur vers la page de connexion
      redirect(base_url()."index.php/connexion/connecter");
  }
    $data['concours'] = $this->db_model->get_jury_concours($_SESSION['username']);
    $this->load->view('templates/haut_back');
    $this->load->view('page_admin_concours',$data);
    $this->load->view('templates/bas_back');
 }

 public function comptes()
 {
   if(!isset($_SESSION['role']) || $_SESSION['role']!="A" ){
      // Redirige l'utilisateur vers la page de connexion
      redirect(base_url()."index.php/connexion/connecter");
  }
    $data['jury'] = $this->db_model->get_all_compte($_SESSION['username']);
    $this->load->view('templates/haut_back');
    $this->load->view('page_admin_comptes',$data);
    $this->load->view('templates/bas_back');
 }

 public function creer() {
   if(!isset($_SESSION['role']) || $_SESSION['role']!="A" ){
      // Redirige l'utilisateur vers la page de connexion
      redirect(base_url()."index.php/connexion/connecter");
  }
    $this->load->helper('form');
    $this->load->library('form_validation');  
    $this->form_validation->set_rules('nom', 'nom', 'required', array('required' => 'Champs de saisie Nom vide !'));
    $this->form_validation->set_rules('prenom', 'prenom', 'required', array('required' => 'Champs de saisie Prénom vide !'));
    $this->form_validation->set_rules('discipline', 'discipline', 'required', array('required' => 'Champs de saisie Discipline vide !'));
    $this->form_validation->set_rules('mdp', 'mdp', 'required', array('required' => "Remplissez le mot de passe"));
    $this->form_validation->set_rules('mdpconfirm', 'mdpconfirm', 'required|matches[mdp]', array('required' => "Confirmez le mot de passe", 'matches' => 'Confirmation du mot de passe erronée, veuillez réessayer !'));
    if ($this->form_validation->run() == FALSE)
    {
      
      $this->load->view('templates/haut_back');
      $this->load->view('page_admin_creer');
      $this->load->view('templates/bas_back');
    }
    else
    {
      $query=$this->db_model->set_compte(); 
      redirect("admin/comptes");
      } 
      
    }
}
 ?>