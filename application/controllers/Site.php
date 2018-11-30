<?php

class Site extends CI_Controller
{

    // Controlleur principal du site
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form', 'url');
        $this->load->library('form_validation', 'session');
    }

    // index() permmet de diriger vers la page d'acceuil à l'entrée du site
    public function index($message = false)
    {
        // si un message est présent on le met dans le tableau $data
        if ($message != false) {
            $data['message'] = $message;
            $this->load->view('site/elements_fixes/header');
            $this->load->view('site/index', $data);
            $this->load->view('site/elements_fixes/footer');
        } else {
            $this->load->view('site/elements_fixes/header');
            $this->load->view('site/index');
            $this->load->view('site/elements_fixes/footer');
        }
    }

    // view() gère les redirection en fonction de la page choisie
    public function view($id, $message = false)
    {
        switch ($id) {
            case 1:
                // page d'inscription
                // charge le model contenant la liste des pays et on le passe dans le tableau data
                $this->load->model('Liste_model');
                $data['country'] = $this->Liste_model->get_contry();
                $data['metier'] = $this->Liste_model->get_job();
                $this->load->view('site/elements_fixes/header');
                $this->load->view('site/inscription', $data);
                $this->load->view('site/elements_fixes/footer');
                break;
            case 2:
                $this->load->view('site/elements_fixes/header');
                $this->load->view('site/loic_roussel');
                $this->load->view('site/elements_fixes/footer');
                break;
            default:
                // si défault on renvoi à la page d'acceuil
                header('Location:' . base_url());
                break;
        }
    }

    // enregistrer permet d'envoyer en base de données les infos et d'envoyer les mails de confirmations
    public function enregistrer()
    {
        // défini les paramètres obligatoires
        $this->form_validation->set_rules('nom', 'votre nom', 'required');
        $this->form_validation->set_rules('prenom', 'votre prénom', 'required');
        $this->form_validation->set_rules('date_de_naissance', 'votre date de naissance', 'required');
        $this->form_validation->set_rules('email', 'votre email', 'required');
        $this->form_validation->set_rules('sexe', 'votre sexe', 'required');
        $this->form_validation->set_rules('pays', 'votre pays', 'required');
        $this->form_validation->set_rules('metier', 'votre metier', 'required');
        
        if ($this->form_validation->run() === false) {
            // si les critères ne sont pas ok on renvoit à la page d'inxcription avec info champ manquant
            Site::view(1);
        } else {
            // on charge la classe de sécurité pour utiliser la fonction xss_clean()
            $this->load->helper('security_helper');
            $nom = $this->security->xss_clean($this->input->post('nom'));
            $prenom = $this->security->xss_clean($this->input->post('prenom'));
            $date_naissance = $this->input->post('date_de_naissance');
            $email = $this->security->xss_clean($this->input->post('email'));
            $sexe = $this->input->post('sexe');
            $pays = $this->input->post('pays');
            $region = $this->security->xss_clean($this->input->post('region'));
            $metier = $this->input->post('metier');
            // on charge le model Inscrits et on appel la fonction de create()
            $this->load->model('Inscrits_model');
            $this->Inscrits_model->create($nom, $prenom, $date_naissance, $email, $sexe, $pays, $region, $metier);
            // On charge le model Send_mail et on appel la fonction send()
            $this->load->model('Send_mail_model');
            /* $this->Send_mail_model->send($nom,$prenom,$date_naissance,$email,$sexe,$pays,$metier); */
            // on renvoie le visiteur sur la page d'acceuil avec un petit message de confirmation d'inscription
            $message = 'Bravo !!! Vous êtes inscrits !! Vous recevrez un mail de confirmation dans quelques instants.';
            Site::index($message);
        }
    }
}