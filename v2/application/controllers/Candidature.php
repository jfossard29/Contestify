<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Candidature extends CI_Controller {
 public function __construct()
 {
 parent::__construct();
 $this->load->model('db_model');
 }

 public function visualiser()
 {  
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('codeinscription', 'codeinscription', 'required' , array('required'=>'Remplissez tous les champs du
    formulaire !'));
    $this->form_validation->set_rules('codeidentification', 'codeidentification', 'required' , array('required'=>'Remplissez tous les champs du
    formulaire !'));

    if ($this->form_validation->run() == FALSE)
    {
    $this->load->view('templates/haut');
    $this->load->view('templates/menu_visiteur');
    $this->load->view('candidat_visualiser');
    $this->load->view('templates/bas');
    }
    else
    {
    $codeinscription = $this->input->post('codeinscription');
    $codeidentification = $this->input->post('codeidentification');
        if($data['candidature'] = $this->db_model->get_candidat($codeinscription,$codeidentification))
        {
            $this->load->view('templates/haut');
            $this->load->view('templates/menu_visiteur');
            $this->load->view('page_candidature',$data);
            $this->load->view('templates/bas');
        } else {
            $data['erreur'] = true;
            $this->load->view('templates/haut');
            $this->load->view('templates/menu_visiteur');
            $this->load->view('candidat_visualiser',$data);
            $this->load->view('templates/bas');
        }
    }

 }

 public function supprimer($codeinscription,$codeidentification) 
 {
    $query=$this->db_model->supprimer_candidat($codeinscription,$codeidentification); 
    $this->load->view('templates/haut');
    $this->load->view('templates/menu_visiteur');
    $this->load->view('page_supprimer');
    $this->load->view('templates/bas');
 }

 public function affichercandidature($ccr) {
    $data['candidature'] = $this->db_model->get_all_candidat($ccr);
    $this->load->view('templates/haut');
    $this->load->view('templates/menu_visiteur');
    $this->load->view('page_liste_candidat',$data);
    $this->load->view('templates/bas');
  }
}
?>