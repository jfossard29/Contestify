<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Connexion extends CI_Controller {

 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');

 }
 
 public function connecter()
{
 $this->load->helper('form');
 $this->load->library('form_validation');
 $this->form_validation->set_rules('pseudo', 'pseudo', 'required', array('required'=>'Le champ Pseudo est requis !'));
 $this->form_validation->set_rules('mdp', 'mdp', 'required', array('required'=>'Le champ Mot de passe est requis !'));

 if ($this->form_validation->run() == FALSE)
 {
 $this->load->view('templates/haut');
 $this->load->view('templates/menu_visiteur');
 $this->load->view('page_connexion');
 $this->load->view('templates/bas');
 }
 else
 {
 $username = $this->input->post('pseudo');
 $password = $this->input->post('mdp');
 $query=$this->db_model->connect_compte($username,$password); 
   if($query && $query->pfl_etat!='F')
   {
      $session_data = array('username' => $username,
                            'role'     => $query->pfl_statut);
      $this->session->set_userdata($session_data);
      redirect("back/afficher");
   }
   else
   {
    $this->load->view('templates/haut');
    $this->load->view('templates/menu_visiteur');
    $this->load->view('page_connexion');
    $this->load->view('templates/bas');
   }
 }
}

}
?>


