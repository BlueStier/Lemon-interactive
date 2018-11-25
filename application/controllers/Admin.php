<?php
class Admin extends CI_Controller {
//Controlleur principal du site
public function __construct()
    {
        parent::__construct();   
        $this->load->helper('url','form');       
        $this->load->library('form_validation','session');       
    }
	public function index()
	{   
        $this->load->view('Admin/index');
    }
    
    public function view()
    {   
        /*on charge le model inscrits et on utilise la fonction get_inscrits() pour récupérer
        toutes les infos de la base de données concernant les inscrits, on utilise la fonction get_pays pour avoir
        la liste de tous les pays sans doublons et on récupère la taille du tableau reçu pour la passer au footer 
        ce nombre servira pour la fonction JQuery qui gère l'affichage des tables*/
        $this->load->model('Inscrits_model');
        $data['inscrits_item'] = $this->Inscrits_model->get_inscrits();
        $data['pays_item'] = $this->Inscrits_model->get_pays();
        $data['nb_pays_pour_les_tables'] = sizeof($data['pays_item']);
        $this->load->view('Admin/elements_fixes/header');
        $this->load->view('Admin/elements_fixes/left_menu');
        $this->load->view('Admin/tous_les_inscrits',$data);
        $this->load->view('Admin/elements_fixes/footer',$data);
    }
}