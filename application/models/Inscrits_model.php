<?php
class Inscrits_model extends CI_Model {

        //constructeur charge la classe permettant l'interrogation de la base de données
        public function __construct()
        {
                $this->load->database();
                
        }

        public function create($nom,$prenom,$date_naissance,$email,$sexe,$pays,$metier){
                //création du tableau de données
                $array = [
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'date_de_naissance' => $date_naissance,
                        'email' => $email,
                        'sexe' => $sexe,
                        'pays' => $pays,
                        'metier' => $metier,
                ];

                //set le NOW() MySQL pour qu'il soit échappé et qu'il passe dans la fonction de Codeigniter       
                $this->db->set('date_inscription','NOW()',false);

                //insertion en base de données
                $this->db->insert('inscrits',$array);
        }
}