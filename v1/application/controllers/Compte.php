<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Compte extends CI_Controller {

 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');
 }

 public function creer()
 {
 $this->load->helper('form');
 $this->load->library('form_validation');
 $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
 $this->form_validation->set_rules('mdp', 'mdp', 'required');
 if ($this->form_validation->run() == FALSE)
 {// Le formulaire est invalide
 $this->load->view('templates/haut');
 $this->load->view('compte_creer');
 $this->load->view('templates/bas');
 }
 else
 {// Le formulaire est valide
 $this->db_model->set_compte();
 $data['le_compte']=$this->input->post('pseudo');
 $data['titre']="Nouveau nombre de comptes : ";
 //appel de la fonction créée dans le précédent tutoriel :
 $data['nb']=$this->db_model->get_nb_compte();
 $this->load->view('templates/haut');
 $this->load->view('compte_succes',$data);
 $this->load->view('templates/bas');
 }
}

public function connecter()
{
 $this->load->helper('form');
 $this->load->library('form_validation');
 $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
 $this->form_validation->set_rules('mdp', 'mdp', 'required');

 if ($this->form_validation->run() == FALSE)
 {
 $this->load->view('templates/haut');
 $this->load->view('compte_connecter');
 $this->load->view('templates/bas');
 }
 else
 {
 $username = $this->input->post('pseudo');
 $password = $this->input->post('mdp');
 if($this->db_model->connect_compte($username,$password))
 {
 $session_data = array('username' => $username );
 $this->session->set_userdata($session_data);
 $this->load->view('templates/haut');
 $this->load->view('compte_menu');
 $this->load->view('templates/bas');
 }
 else
 {
 $this->load->view('templates/haut');
 $this->load->view('compte_connecter');
 $this->load->view('templates/bas');
 }
 }
}
}
?>