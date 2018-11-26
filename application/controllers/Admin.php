<?php
class Admin extends CI_Controller {
//Controlleur principal du site
public function __construct()
    {
        parent::__construct();   
        $this->load->helper('url','form');       
        $this->load->library('form_validation','session');
        $this->load->model('Inscrits_model');       
    }
	public function index()
	{   
        $this->load->view('Admin/index');
    }
    
    public function view($nb, $id = false)
    {   
        switch($nb){
        case 0 :
        /*on charge le model inscrits et on utilise la fonction get_inscrits() pour récupérer
        toutes les infos de la base de données concernant les inscrits, on utilise la fonction get_pays pour avoir
        la liste de tous les pays sans doublons et on passe le n° du cas au left_menu pour le javascript et l'affichage*/        
        $data['inscrits_item'] = $this->Inscrits_model->get_inscrits();
        $data['pays_item'] = $this->Inscrits_model->get_pays();
        $data['nb'] = 0;    
        $this->load->view('Admin/elements_fixes/header');
        $this->load->view('Admin/elements_fixes/left_menu',$data);
        $this->load->view('Admin/tous_les_inscrits',$data);
        $this->load->view('Admin/elements_fixes/footer');
        break;
        case 1 :
        /*charge la page permettant d'inscrire un utilisateur*/
        $this->load->model('Liste_model');
        $data['country'] = $this->Liste_model->get_contry();
        /*Si on doit créer un inscrit*/
        $data['create'] = TRUE;
        $data['nb'] = 1; 
        $this->load->view('Admin/elements_fixes/header');
        $this->load->view('Admin/elements_fixes/left_menu',$data);
        $this->load->view('Admin/inscrits_create_or_update',$data);
        $this->load->view('Admin/elements_fixes/footer');
        break;
        case 2 :
        /*charge la page permettant la mise à jour d'un inscrit*/          
        $data['inscrit'] = $this->Inscrits_model->get_inscrits($id,TRUE);
        $this->load->model('Liste_model');
        $data['country'] = $this->Liste_model->get_contry();
        $data['metier'] = $this->Liste_model->get_job();
        /*Si on doit modifier un inscrit*/
        $data['create'] = FALSE;
        $data['nb'] = 2; 
        $this->load->view('Admin/elements_fixes/header');
        $this->load->view('Admin/elements_fixes/left_menu',$data);
        $this->load->view('Admin/inscrits_create_or_update',$data);
        $this->load->view('Admin/elements_fixes/footer');
        break;

        }
    }

    /*fonction pour supprimer un inscrit*/
    public function delete_inscrits(){
        //récupère l'id de l'inscrit à supprimer, transmet au model et redirection vers la page
        $id = $this->input->post('id_a_sup');
        $this->Inscrits_model->delete_inscrits($id);
        Admin::view(0);
    }

    /*fonction controlant l'enregistrement d'un inscrit depuis le back-office*/
    public function create(){
        //défini les paramètres obligatoires
        $this->form_validation->set_rules('nom', 'nom', 'required');
        $this->form_validation->set_rules('prenom', 'prénom', 'required');
        $this->form_validation->set_rules('date_de_naissance', ' date de naissance', 'required');
        $this->form_validation->set_rules('email', ' email', 'required');
        $this->form_validation->set_rules('sexe', ' sexe', 'required');
        $this->form_validation->set_rules('pays', ' pays', 'required');
        $this->form_validation->set_rules('metier', 'metier', 'required');

        
        if($this->form_validation->run()===false){
            //si les critères ne sont pas ok on renvoit à la page de creation avec info champ manquant
            Admin::view(1);
        }else{
            //on charge la classe de sécurité pour utiliser la fonction xss_clean()
            $this->load->helper('security_helper');            
            $nom = $this->security->xss_clean($this->input->post('nom'));            
            $prenom = $this->security->xss_clean($this->input->post('prenom'));
            $date_naissance = $this->input->post('date_de_naissance');           
            $email = $this->security->xss_clean($this->input->post('email'));
            $sexe = $this->input->post('sexe');
            $pays = $this->input->post('pays');
            $region = $this->security->xss_clean($this->input->post('region'));
            $metier = $this->input->post('metier');
            //on charge le model Inscrits et on appel la fonction de create()
            $this->load->model('Inscrits_model');
            $this->Inscrits_model->create($nom,$prenom,$date_naissance,$email,$sexe,$pays,$region,$metier);
            //On charge le model Send_mail et on appel la fonction send()
            $this->load->model('Send_mail_model');
            /*$this->Send_mail_model->send($nom,$prenom,$date_naissance,$email,$sexe,$pays,$metier);*/
            Admin::view(0);
        }
    
    }

    /*fonction de mise à jour d'un inscrit*/
    public function update($id){
        //défini les paramètres obligatoires
        $this->form_validation->set_rules('nom', 'nom', 'required');
        $this->form_validation->set_rules('prenom', 'prénom', 'required');
        $this->form_validation->set_rules('date_de_naissance', ' date de naissance', 'required');
        $this->form_validation->set_rules('email', ' email', 'required');
        $this->form_validation->set_rules('sexe', ' sexe', 'required');
        $this->form_validation->set_rules('pays', ' pays', 'required');
        $this->form_validation->set_rules('metier', 'metier', 'required');

        
        if($this->form_validation->run()===false){
            //si les critères ne sont pas ok on renvoit à la page de modif avec info champ manquant
            Admin::view(2,$id);
        }else{
            //on charge la classe de sécurité pour utiliser la fonction xss_clean()
            $this->load->helper('security_helper');            
            $nom = $this->security->xss_clean($this->input->post('nom'));            
            $prenom = $this->security->xss_clean($this->input->post('prenom'));
            $date_naissance = $this->input->post('date_de_naissance');           
            $email = $this->security->xss_clean($this->input->post('email'));
            $sexe = $this->input->post('sexe');
            $pays = $this->input->post('pays');
            $region = $this->security->xss_clean($this->input->post('region'));
            $metier = $this->input->post('metier');
            //on charge le model Inscrits et on appel la fonction de create()
            $this->load->model('Inscrits_model');
            //transmet l'id de l'inscrit à modifier au model et redirection et les paramètres
            $this->Inscrits_model->update($id,$nom,$prenom,$date_naissance,$email,$sexe,$pays,$region,$metier);
            Admin::view(0);
        }
        
    }
}