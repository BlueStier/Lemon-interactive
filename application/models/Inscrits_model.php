<?php
class Inscrits_model extends CI_Model {

        /*constructeur charge la classe permettant l'interrogation de la base de données
          et la classe de cryptage*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('encryption');
                
        }

        public function create($nom,$prenom,$date_naissance,$email,$sexe,$pays,$metier){
                //création du tableau de données
                $array = [
                        'nom' => $this->encryption->encrypt($nom),
                        'prenom' => $this->encryption->encrypt($prenom),
                        'date_de_naissance' => $date_naissance,
                        'email' => $this->encryption->encrypt($email),
                        'sexe' => $this->encryption->encrypt($sexe),
                        'pays' => $this->encryption->encrypt($pays),
                        'metier' => $this->encryption->encrypt($metier),
                ];

                //set le NOW() MySQL pour qu'il soit échappé et qu'il passe dans la fonction de Codeigniter       
                $this->db->set('date_inscription','NOW()',false);

                //insertion en base de données
                $this->db->insert('inscrits',$array);
        }

        public function get_inscrits($id = false){
                if($id === FALSE){
                        /*extrait toutes les infos de la bdd en rendant lea dates en français*/
                        $this->db->query("SET lc_time_names = 'fr_FR'");
                        $this->db->select('date_format(date_de_naissance,"%W %d %M %Y") as date_de_naissance,date_format(date_inscription,"%W %d %M %Y") as date_inscription
                                          ,nom,prenom,sexe,email,metier');
                        $array = $this->db->get('inscrits')->result_array();
                        //décrypt les infos
                        $taille_de_array = sizeof($array);
                        for($h = 0; $h < $taille_de_array; $h++){
                            $array[$h]['nom'] = $this->encryption->decrypt($array[$h]['nom']);
                            $array[$h]['prenom'] = $this->encryption->decrypt($array[$h]['prenom']);
                            $array[$h]['sexe'] = $this->encryption->decrypt($array[$h]['sexe']);
                            $array[$h]['email'] = $this->encryption->decrypt($array[$h]['email']);
                            $array[$h]['metier'] = $this->encryption->decrypt($array[$h]['metier']);
                        }
                        return $array;        
                }
        }
}