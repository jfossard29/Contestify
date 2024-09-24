<?php
class Db_model extends CI_Model {
 public function __construct()
 {
 $this->load->database();
  
 }
 

 //----- COMPTE -----


 public function get_all_compte() //lister tout les comptes 
 {
    $query = $this->db->query("SELECT cpti_pseudo,pfl_nom,pfl_prenom,pfl_mail,pfl_statut,pfl_etat 
    FROM tab_profil_pfl;");
    return $query->result_array();
 }

 public function verif_information_compte($pseudo,$mail) //lister tout les comptes 
 {
    $query = $this->db->query("SELECT verifierinformationexistant('".$pseudo."','".$mail."') AS verif");
    return $query->row();
 }

 public function get_nb_compte() //avoir le nombre de comptes présents dans la table des comptes
 {
    $query = $this->db->query("SELECT count(*) AS nb FROM tab_compteorg_cpto;");
    return $query->row();
 }
 public function set_compte() //insérer un nouveau compte dans la table depuis le menu Admin
 {
   $mdp= $this->input->post('mdp');
   $pseudo = $this->input->post('pseudo');
   $nom= $this->input->post('nom');
   $prenom = $this->input->post('prenom');
   $discipline = $this->input->post('discipline');
   $mail = $this->input->post('mail');
   $blio = $this->input->post('blio');
   $url = $this->input->post('url');
   $statut = $this->input->post('statut');
    
   $salt = "OnRajouteDuSelPourAllongerleMDP123djvfhjdk";  
   $password = hash('sha256', $salt.$mdp);
   $creer= $this->db->query("INSERT INTO tab_compteinfo_cpti VALUES ('".addslashes($pseudo)."','".$password."');");
   $query= $this->db->query("INSERT INTO tab_profil_pfl VALUES (NULL,'".addslashes($pseudo)."','".addslashes($nom)."','".addslashes($prenom)."','".$mail."','".$discipline."','".addslashes($blio)."','".$url."','".$statut."','A');");
   if($statut=='A') {
      $creerOrg = $this->db->query("INSERT INTO tab_compteorg_cpto VALUES ('".$pseudo."');");
   }
   return ($query);
 }

 public function set_password($pseudo) //modifier le compte
 {
    $salt = "OnRajouteDuSelPourAllongerleMDP123djvfhjdk";  
    $mdp=$this->input->post('mdp');
    $password = hash('sha256', $salt.$mdp);
    $req="UPDATE tab_compteinfo_cpti SET cpti_password='".$password."' WHERE cpti_pseudo='".$pseudo."');";
    $query = $this->db->query($req);
   return ($query);
 }

 public function connect_compte($username, $password) //se connecter
 {
   $salt = "OnRajouteDuSelPourAllongerleMDP123djvfhjdk";  
   $mdp = hash('sha256', $salt.$password);
   $query =$this->db->query("SELECT pfl_etat,pfl_statut,cpti_pseudo,cpti_password
   FROM tab_compteinfo_cpti
   JOIN tab_profil_pfl USING (cpti_pseudo)
   WHERE cpti_pseudo='".$username."'
   AND cpti_password='".$mdp."';");
   if($query->num_rows() > 0)
   {
      return $query->row();
   }
   else
   {
      return null;
   }
 }
 public function modif_compte($data) { //modification des informations du jury, adapté pour la V1.1
   $salt = "OnRajouteDuSelPourAllongerleMDP123djvfhjdk";
   /*$query =$this->db->query("UPDATE `tab_profil_pfl` 
   SET `pfl_nom`='".$data["nom"]."',
   `pfl_prenom`='".$data["prenom"]."',
   `pfl_mail`='".$data["mail"]."',
   `pfl_discipline`='".$data["discipline"]."',
   `pfl_blio`='".addslashes($data["blio"])."',
   `pfl_URL`='".$data["url"]."'
   WHERE cpti_pseudo='".$data["pseudo"]."';");*/

   $verif= $this->db_model->get_password($data["pseudo"]);
   $password = hash('sha256', $salt.$data["mdp"]);
   if($verif != $password) { //On verifie si le password nouveau est différent de l'ancien, sinon on ne fait rien
      $query = $this->db->query("UPDATE `tab_compteinfo_cpti` 
      SET `cpti_password`='".$password."'
      WHERE `cpti_pseudo`='".$data["pseudo"]."';");
      return ($query);
   } else {
      return false;
   }
    
 }

 public function get_password($pseudo) { //modification des informations du jury
   $query = $this->db->query("SELECT cpti_password FROM tab_compteinfo_cpti WHERE cpti_pseudo='".$pseudo."';");

   return $query;
 }
 public function get_compte($pseudo) //récupérer un compte en particulier
 {
   $query = $this->db->query("SELECT cpti_pseudo, pfl_nom, pfl_prenom,pfl_mail,pfl_discipline,pfl_blio,pfl_URL FROM tab_profil_pfl WHERE cpti_pseudo = '".$pseudo."';");
   return $query->row();
 }


//----- ACTUALITE -----


 public function get_actualite($numero) //afficher une actualité désirée
 {
    $query = $this->db->query("SELECT act_titre, act_texte FROM tab_actualite_act WHERE
    act_id=".$numero.";");
    return $query->row();
 }

 public function get_all_actualite() //lister toutes les actualités, par ordre décroissante, avec une limite de 5
 {
    $query = $this->db->query("SELECT cpti_pseudo, act_titre, act_date FROM tab_actualite_act ORDER BY act_date DESC LIMIT 5;");
    return $query->result_array();
 }


 //----- CONCOURS -----


 public function get_all_concours() //lister tout les concours
 {
    $query = $this->db->query("SELECT ccr_id,tab_concours_ccr.cpti_pseudo AS organisateur, ccr_titre, ccr_date, ccr_dtefinaliste, cat_nom,nomphaseconcours(tab_concours_ccr.ccr_id) AS phase_concours,donnerjury(ccr_id) AS jury
    FROM tab_concours_ccr 
    LEFT JOIN tab_ccrcategorie_ccc USING (ccr_id) 
    LEFT JOIN tab_ccrjury_ccj USING (ccr_id) 
    LEFT JOIN tab_profil_pfl USING (pfl_id)
    ORDER BY ccr_date DESC;");
    return $query->result_array();
 }

 public function get_jury_concours($pseudo) //lister tout les concours dont la personne est jury
 {
    $query = $this->db->query("SELECT ccr_id, ccr_titre, ccr_date, ccr_dtefinaliste, cat_nom , nomphaseconcours(tab_concours_ccr.ccr_id) AS phase_concours
    FROM tab_concours_ccr 
    LEFT JOIN tab_ccrcategorie_ccc USING (ccr_id) 
    LEFT JOIN tab_ccrjury_ccj USING (ccr_id) 
    LEFT JOIN tab_profil_pfl USING (pfl_id)
 	 WHERE tab_profil_pfl.cpti_pseudo='".$pseudo."'
    ORDER BY ccr_date DESC;");
    return $query->result_array();
 }


 //----- CANDIDAT -----

 
 public function get_candidat($codeinscription,$codeidentification) //afficher la candidature désirée
 {
    $query = $this->db->query("SELECT cdt_id,cdt_nom,cdt_prenom,cdt_mail,EtatCandidat(cdt_id) AS Etat,ccr_concours,cdt_blio,doc_chemin,cat_nom,cdt_codeinscription,cdt_codeidentification
                              FROM tab_candidature_cdt LEFT JOIN tab_document_doc USING (cdt_id) 
                              WHERE cdt_codeinscription='".$codeinscription."' 
                              AND cdt_codeidentification='".$codeidentification."';");
    return $query->result_array();
 }

 public function supprimer_candidat($codeinscription,$codeidentification) { //supprimer candidat côté visiteur
   $id = $this->db->query("SELECT donneridcandidat('".$codeinscription."','".$codeidentification."') AS id;"); //j'utilise la fonction MariaDB pour récupérer un ID d'un candidat
   $id = $id->row();
   $id = $id->id;
   $verifdocument = $this->db->query("SELECT count(*) FROM tab_document_doc JOIN tab_candidature_cdt USING (cdt_id) WHERE cdt_id =".$id); //je vérifie s'il n'a pas de documents
   if($verifdocument->num_rows() > 0) //si oui, je supprime les documents en premier
   {
      $dossier_documents = FCPATH . "documents/";
      $liste_documents = glob($dossier_documents . '*');
      foreach($liste_documents as $document){
         $nom_fichier = $dossier_documents . basename($document);

         if(preg_match("/$codeinscription/", $nom_fichier)){
            unlink($document);
         }
      }
      $this->db->query("DELETE FROM `tab_document_doc` WHERE cdt_id =".$id);
   }
   $this->db->query("DELETE FROM `tab_candidature_cdt` WHERE cdt_id =".$id); //et je supprime lsa candidature
   return true;
 }

 public function get_all_candidat($ccr) //lister toutes les candidatures d'un coucours. "Galerie", utilisé par l'Admin
 {
    $query = $this->db->query("SELECT cdt_id,cat_nom,cdt_nom,cdt_prenom,cdt_mail,EtatCandidat(cdt_id) AS cdt_etat
    FROM `tab_candidature_cdt` 
    WHERE ccr_id=".$ccr." ORDER BY cat_nom ASC");
    return $query->result_array();
 }

 
 public function supprimer_candidat_admin($id) { //supprimer candidat côté Admin, on a déjà l'id de la candidature
   $codeinscription = $this->db->query("SELECT donnercodeinscription(".$id.") AS cdt_codeinscription;");
   $codeinscription = $codeinscription->row();
   $codeinscription = $codeinscription->cdt_codeinscription; //je me dois de récupérer ainsi la requête, sinon erreur

   $verifdocument = $this->db->query("SELECT count(*) FROM tab_document_doc 
                              JOIN tab_candidature_cdt USING (cdt_id) 
                              WHERE cdt_id =".$id); //je vérifie s'il n'a pas de documents

   if($verifdocument->num_rows() > 0) //si oui, je supprime les documents en premier
   {
      $dossier_documents = FCPATH . "documents/";
      $liste_documents = glob($dossier_documents . '*'); //je cherche tout fichier contenu dans le dossier
      foreach($liste_documents as $document){ //pour chaque fichier...
          $nom_fichier = $dossier_documents . basename($document); //je met le chemin entier
          
          if(preg_match("/$codeinscription/", $nom_fichier)){ //je regarde si, dans le nom du fichier, il y'a le code du candidat
              unlink($document); //si oui, je supprime
          }
      }
      $this->db->query("DELETE FROM `tab_document_doc` WHERE cdt_id =".$id);
   }
   $this->db->query("DELETE FROM `tab_candidature_cdt` WHERE cdt_id =".$id); //et je supprime lsa candidature
   return true;
 }
}