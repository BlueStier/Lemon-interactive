<?php
class Send_mail_model extends CI_Model {

    public function send($nom,$prenom,$date_naissance,$email,$sexe,$pays,$metier){
        //préparation du mail
        $message = "<h1>Bonjour ".$prenom." ".$nom."</h1><br><br><br> 
        Nous avons bien reçu enregistrer votre inscription.<br>
        <strong> Voilà les informations que vous nous avez transmises :</strong><br>
        Votre date de naissance : ".$date_naissance."<br>
        Votre email : ".$email."<br>";

        if($sexe == 'homme'){
            $message .= "Vous êtes un ".$sexe."<br>";
        }else{
            $message .= "Vous êtes une ".$sexe."<br>";
        }

        $message .= "Vous résidez en ".$pays."<br>Et votre métier est :".$metier;

        //initialisation de la librairie
        $this->load->library('email');
        $config['protocol'] = '';
        $config['smtp_host'] = '';
        $config['smtp_port'] = '';
        $config['smtp_user'] = 'lroussel2703@gmail.com';
        $config['smtp_pass'] = 'Boubidou1';           
        $config['crlf'] = '\r\n';
        $config['newline'] = '\r\n';
        $config['mailtype'] = 'html';
        
        $this->email->initialize($config);
        $this->email->from('lroussel2703@gmail.com', 'Votre Inscription');
        $this->email->to($email);
        $this->email->subject("Confirmation d'inscrption");
        $this->email->message($message);
        $this->email->send();
    }
}
