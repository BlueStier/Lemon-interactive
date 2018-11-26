<?php
class Inscrits_model extends CI_Model {

        /*constructeur charge la classe permettant l'interrogation de la base de données
          et la classe de cryptage*/
        public function __construct()
        {
                $this->load->database();
                $this->load->library('encryption');
                
        }

        public function create($nom,$prenom,$date_naissance,$email,$sexe,$pays,$region,$metier)
        {
                //création du tableau de données
                $array = [
                        'nom' => $this->encryption->encrypt($nom),
                        'prenom' => $this->encryption->encrypt($prenom),
                        'date_de_naissance' => $date_naissance,
                        'email' => $this->encryption->encrypt($email),
                        'sexe' => $this->encryption->encrypt($sexe),
                        'pays' => $this->encryption->encrypt($pays),
                        'region' => $this->encryption->encrypt($region),
                        'metier' => $this->encryption->encrypt($metier),
                ];

                //set le NOW() MySQL pour qu'il soit échappé et qu'il passe dans la fonction de Codeigniter       
                $this->db->set('date_inscription','NOW()',false);

                //insertion en base de données
                $this->db->insert('inscrits',$array);
        }

        //fonction de récupération des inscrits dans la base de données
        public function get_inscrits($id = false, $date = false)
        {
                if($id === FALSE){
                        /*extrait toutes les infos de la bdd en rendant lea dates en français*/
                        $this->db->query("SET lc_time_names = 'fr_FR'");
                        $this->db->select('date_format(date_de_naissance,"%W %d %M %Y") as date_de_naissance,date_format(date_inscription,"%W %d %M %Y") as date_inscription
                                          ,nom,prenom,sexe,email,metier,pays,id,region');
                        $array = $this->db->get('inscrits')->result_array();
                        //décrypt les infos
                        $taille_de_array = sizeof($array);
                        for($h = 0; $h < $taille_de_array; $h++){
                            $array[$h]['nom'] = $this->encryption->decrypt($array[$h]['nom']);
                            $array[$h]['prenom'] = $this->encryption->decrypt($array[$h]['prenom']);
                            $array[$h]['sexe'] = $this->encryption->decrypt($array[$h]['sexe']);
                            $array[$h]['email'] = $this->encryption->decrypt($array[$h]['email']);
                            $array[$h]['metier'] = $this->encryption->decrypt($array[$h]['metier']);
                            $array[$h]['pays'] = $this->encryption->decrypt($array[$h]['pays']);
                            $array[$h]['region'] = $this->encryption->decrypt($array[$h]['region']);
                        }
                        return $array;        
                }else{ 
                        if($date === FALSE){                       
                        /*extrait toutes les infos de la bdd en rendant lea dates en français concernant l'id 
                        passé en paramètre*/
                        $this->db->query("SET lc_time_names = 'fr_FR'");
                        $this->db->select('date_format(date_de_naissance,"%W %d %M %Y") as date_de_naissance,date_format(date_inscription,"%W %d %M %Y") as date_inscription
                                          ,nom,prenom,sexe,email,metier,pays,region,id');
                        $array = $this->db->get_where('inscrits', array('id' => $id))->row_array();
                        //décrypt les infos                       
                        $array['nom'] = $this->encryption->decrypt($array['nom']);
                        $array['prenom'] = $this->encryption->decrypt($array['prenom']);
                        $array['sexe'] = $this->encryption->decrypt($array['sexe']);
                        $array['email'] = $this->encryption->decrypt($array['email']);
                        $array['metier'] = $this->encryption->decrypt($array['metier']);
                        $array['pays'] = $this->encryption->decrypt($array['pays']);
                        $array['region'] = $this->encryption->decrypt($array['region']);
                        return $array;
                        }else{
                        /*extrait toutes les infos de la bdd en rendant lea dates en français concernant l'id 
                        passé en paramètre*/                        
                        $array = $this->db->get_where('inscrits', array('id' => $id))->row_array();
                        //décrypt les infos                       
                        $array['nom'] = $this->encryption->decrypt($array['nom']);
                        $array['prenom'] = $this->encryption->decrypt($array['prenom']);
                        $array['sexe'] = $this->encryption->decrypt($array['sexe']);
                        $array['email'] = $this->encryption->decrypt($array['email']);
                        $array['metier'] = $this->encryption->decrypt($array['metier']);
                        $array['pays'] = $this->encryption->decrypt($array['pays']);
                        $array['region'] = $this->encryption->decrypt($array['region']);
                        return $array;
                        }
                }
        }

        //fonction d'extraction des pays
        public function get_pays()
        {
                $this->db->select('pays');
                /*la fonction DISTINCT de MySQL n'est pas utilisable car le cryptage retourne des valeurs 
                différentes alors on effectue le tri*/
                $array = $this->db->get('inscrits')->result_array();
                //1 on décrypte les infos
                $taille_de_array = sizeof($array);
                for($g = 0; $g < $taille_de_array; $g++){
                        $array[$g]['pays'] = $this->encryption->decrypt($array[$g]['pays']);      
                }
                //2 on fait le tri
                $array_de_retour = [];
                for($z = 0; $z < $taille_de_array; $z++){
                        if(! in_array($array[$z]['pays'],$array_de_retour)){
                                $array_de_retour[] = $array[$z]['pays'];   
                        }       
                }               
                return $array_de_retour;
        }

        //fonction de suppression d'un inscrit
        public function delete_inscrits($id){
                $this->db->delete('inscrits',array('id' => $id));
        }

        //fonction de mise à jour d'un inscrit
        public function update($id,$nom,$prenom,$date_naissance,$email,$sexe,$pays,$region,$metier){
            //extraction des données de la bdd en fonction de l'id
            $array = $this->db->get_where('inscrits', array('id' => $id))->row_array();
            //on modifie les données
            $array['nom'] = $this->encryption->encrypt($nom);
            $array['prenom'] = $this->encryption->encrypt($prenom);
            $array['date_de_naissance'] = $date_naissance;
            $array['email'] = $this->encryption->encrypt($email);
            $array['sexe'] = $this->encryption->encrypt($sexe);
            $array['pays'] = $this->encryption->encrypt($pays);
            $array['region'] = $this->encryption->encrypt($region);
            $array['metier'] = $this->encryption->encrypt($metier);
            
            $this->db->replace('inscrits',$array);
        }
}