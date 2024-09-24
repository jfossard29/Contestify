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
   if(!isset($_SESSION['role'])){
      // Redirige l'utilisateur vers la page de connexion
      redirect(base_url()."index.php/connexion/connecter");
  } else if ($_SESSION['role']!="A") {
      redirect(base_url()."index.php/back/afficher");
  }
    $data['concours'] = $this->db_model->get_all_concours();
    $this->load->view('templates/haut_back');
    $this->load->view('page_admin_concours',$data);
    $this->load->view('templates/bas_back');
 }

 public function comptes()
 {
      if(!isset($_SESSION['role'])){
      // Redirige l'utilisateur vers la page de connexion
      redirect(base_url()."index.php/connexion/connecter");
  } else if ($_SESSION['role']!="A") {
      redirect(base_url()."index.php/back/afficher");
  }
    $data['jury'] = $this->db_model->get_all_compte($_SESSION['username']);
    $this->load->view('templates/haut_back');
    $this->load->view('page_admin_comptes',$data);
    $this->load->view('templates/bas_back');
 }

 public function creer() {
  if(!isset($_SESSION['role'])){
    // Redirige l'utilisateur vers la page de connexion
    redirect(base_url()."index.php/connexion/connecter");
  } else if ($_SESSION['role']!="A") {
      redirect(base_url()."index.php/back/afficher");
  }
    $this->load->helper('form');
    $this->load->library('form_validation');  
    $this->form_validation->set_rules('nom', 'nom', 'required', array('required' => 'Champs de saisie Nom vide !'));
    $this->form_validation->set_rules('prenom', 'prenom', 'required', array('required' => 'Champs de saisie Prénom vide !'));
    //$this->form_validation->set_rules('discipline', 'discipline', 'required', array('required' => 'Champs de saisie Discipline vide !'));
    $this->form_validation->set_rules('mail', 'mail', 'required', array('required' => 'Champs de saisie Mail vide !'));
    $this->form_validation->set_rules('mdp', 'mdp', 'required', array('required' => "Remplissez le mot de passe"));
    $this->form_validation->set_rules('mdpconfirm', 'mdpconfirm', 'required|matches[mdp]', array('required' => "Confirmez le mot de passe", 'matches' => 'Confirmation du mot de passe erronée, veuillez réessayer !'));
    if ($this->form_validation->run() == FALSE)
    {
      $data['erreur'] = false;
      $this->load->view('templates/haut_back');
      $this->load->view('page_admin_creer',$data);
      $this->load->view('templates/bas_back');
    }
    else
    {
      $mail = $this->input->post('mail');
      $pseudo = $this->input->post('pseudo');
      $verif = $this->db_model->verif_information_compte($pseudo,$mail);

      if($verif->verif == "ok") {
        $query=$this->db_model->set_compte();
        $data['jury'] = $this->db_model->get_all_compte($_SESSION['username']);
        $data['confirmation'] = true;
        $this->load->view('templates/haut_back');
        $this->load->view('page_admin_comptes',$data);
        $this->load->view('templates/bas_back');
      } else {
        $data['erreur'] = $verif->verif;
        $this->load->view('templates/haut_back');
        $this->load->view('page_admin_creer',$data);
        $this->load->view('templates/bas_back');
      }
    } 

      
      
    }

    public function affichercandidature($ccr) {
      if(!isset($_SESSION['role'])){
        // Redirige l'utilisateur vers la page de connexion
        redirect(base_url()."index.php/connexion/connecter");
    } else if ($_SESSION['role']!="A") {
        redirect(base_url()."index.php/back/afficher");
    }
      $data['ccr']=$ccr;
      $data['candidature'] = $this->db_model->get_all_candidat($ccr);
      $this->load->view('templates/haut_back');
      $this->load->view('page_back_candidature',$data);
      $this->load->view('templates/bas_back');
    }

    public function supprimercandidature($ccr,$cdt) {
      if(!isset($_SESSION['role'])){
        // Redirige l'utilisateur vers la page de connexion
        redirect(base_url()."index.php/connexion/connecter");
    } else if ($_SESSION['role']!="A") {
        redirect(base_url()."index.php/back/afficher");
    }
    
    $query=$this->db_model->supprimer_candidat_admin($cdt); 
    $data['candidature'] = $this->db_model->get_all_candidat($ccr);
    $data['suppression'] = true;
    $data['ccr'] = $ccr;
    $this->load->view('templates/haut_back');
    $this->load->view('page_back_candidature',$data);
    $this->load->view('templates/bas_back');
    }
}
 ?>