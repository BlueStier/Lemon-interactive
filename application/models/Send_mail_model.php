<?php

class Send_mail_model extends CI_Model
{

    public function __construct()
    {
         $this->load->model('Admin_model'); 
    }

    public function send($nom, $prenom, $date_naissance, $email, $sexe, $pays, $metier)
    {
        // on retourne la date de naissance pour que ce soit au format français
        $expl = explode('-', $date_naissance);
        $rev = array_reverse($expl);
        $date_naissance = implode('-', $rev);
        
        // on récupère l'adresse mail de l'admin
        $mail_admin = $this->Admin_model->get_mail(); 
        
        // préparation du mail
        $message = "<h1>Bonjour " . $prenom . " " . $nom . "</h1><br><br><br> 
        Nous avons bien reçu enregistrer votre inscription.<br>
        <strong> Voilà les informations que vous nous avez transmises :</strong><br>
        Votre date de naissance : " . $date_naissance . "<br>
        Votre email : " . $email . "<br>";
        
        if ($sexe == 'homme') {
            $message .= "Vous êtes un " . $sexe . "<br>";
        } else {
            $message .= "Vous êtes une " . $sexe . "<br>";
        }
        
        $message .= "Vous résidez en " . $pays . "<br>Et votre métier est :" . $metier;
        
        // initialisation de la librairie
        $this->load->library('email');
        $config['protocols'] = array('mail','sendmail','smtp');
        $config['smtp_host'] = 'non du serveur';
        $config['smtp_port'] = 'port ex: 465';
        $config['smtp_user'] = 'votre_mail@mon_site.com';
        $config['smtp_pass'] = 'mot_de_passe';
        $config['crlf'] = '\r\n';
        $config['newline'] = '\r\n';
        $config['mailtype'] = 'html';
        
        $this->email->initialize($config);
        $this->email->from('votre_mail@mon_site.com', 'Votre Inscription');
        $this->email->to($email);
        $this->email->bcc($mail_admin);
        $this->email->subject("Confirmation d'inscrption");
        $this->email->message($message);
        $this->email->send();
    }
}
