<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Back extends CI_Controller {

 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');

 }

public function profil() 
{
  if(!isset($_SESSION['role'])){
    // Redirige l'utilisateur vers la page de connexion
    redirect(base_url()."index.php/connexion/connecter");
}
    $data['information'] = $this->db_model->get_compte($_SESSION['username']);
    $data['confirmation'] = null;
    $this->load->view('templates/haut_back');
    $this->load->view('page_information',$data);
    $this->load->view('templates/bas_back');
 
}

public function afficher() 
{
  if(!isset($_SESSION['role'])){
    // Redirige l'utilisateur vers la page de connexion
    redirect(base_url()."index.php/connexion/connecter");
}
    $this->load->view('templates/haut_back');
    $this->load->view('page_back');
    $this->load->view('templates/bas_back');
 
}

public function modifier() { //formulaire de modification du profil. Adapté pour répondre à l'unique besoin de la V1.1
  if(!isset($_SESSION['role'])){
    // Redirige l'utilisateur vers la page de connexion
    redirect(base_url()."index.php/connexion/connecter");
  }
    $this->load->helper('form');
    $this->load->library('form_validation');  
    //$this->form_validation->set_rules('nom', 'nom', 'required', array('required' => 'Champs de saisie vides !'));
    //$this->form_validation->set_rules('prenom', 'prenom', 'required', array('required' => 'Champs de saisie vides !'));
    //$this->form_validation->set_rules('discipline', 'discipline', 'required', array('required' => 'Champs de saisie vides !'));
    //$this->form_validation->set_rules('blio', 'blio', 'required', array('required' => 'Champs de saisie vides !'));
    //$this->form_validation->set_rules('url', 'url', 'required', array('required' => 'Champs de saisie vides !'));
    $this->form_validation->set_rules('mdp', 'mdp', 'required', array('required' => "Remplissez le mot de passe"));
    $this->form_validation->set_rules('mdpconfirm', 'mdpconfirm', 'required|matches[mdp]', array('required' => "Confirmez le mot de passe", 'matches' => 'Confirmation du mot de passe erronée, veuillez réessayer !'));
    $data['information'] = $this->db_model->get_compte($_SESSION['username']);
    if ($this->form_validation->run() == FALSE)
    {
      
      $this->load->view('templates/haut_back');
      $this->load->view('page_modification',$data);
      $this->load->view('templates/bas_back');
    }
    else
    {
      $envoi['mdp'] = $this->input->post('mdp');
      $envoi['pseudo'] = $this->input->post('pseudo');
      //$envoi['nom'] = $this->input->post('nom');
      //$envoi['prenom'] = $this->input->post('prenom');
      //$envoi['discipline'] = $this->input->post('discipline');
      //$envoi['mail'] = $this->input->post('mail');
      //$envoi['blio'] = $this->input->post('blio');
      //$envoi['url'] = $this->input->post('url');
      $query=$this->db_model->modif_compte($envoi); 
      $modif['information']=$this->db_model->get_compte($_SESSION['username']); 
      $modif['confirmation']="success";
      $this->load->view('templates/haut_back');
      $this->load->view('page_information',$modif);
      $this->load->view('templates/bas_back');
      } 
      
    }
    public function deconnexion()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
?>
