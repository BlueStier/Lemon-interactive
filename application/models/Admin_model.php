<?php

class Admin_model extends CI_Model
{

    /*
     * constructeur charge la classe permettant l'interrogation de la base de données
     * et la classe de cryptage
     */
    public function __construct()
    {
        $this->load->database();
        $this->load->library('encryption');
    }

    // fonction de création d'un admin
    public function create($pseudo, $mdp, $chemin_vers_la_photo, $email)
    {
        // création du tableau de données
        $array = [
            'pseudo' => $this->encryption->encrypt($pseudo),
            'path_photo' => $this->encryption->encrypt($chemin_vers_la_photo),
            'email' => $this->encryption->encrypt($email),
            'password' => password_hash($mdp, PASSWORD_DEFAULT)
        ];
        
        // set le NOW() MySQL pour qu'il soit échappé et qu'il passe dans la fonction de Codeigniter
        $this->db->set('date_enregistrement', 'NOW()', false);
        
        // insertion en base de données
        $this->db->insert('admin', $array);
    }

    // fonction de vérification dans la bdd si un pseudo est utiliser
    public function verify_admin($pseudo)
    {
        // extrait les admins de la bdd
        $tous_admin = Admin_model::get_admin();
        // prépare l'interogation de notre tableau
        $verif = false;
        // interogation du tableau pour savoir si le pseudo est connu
        foreach ($tous_admin as $admin) :
            // si le pseudo est connu on met les infos de l'admin dans le tableau $result
            if ($admin['pseudo'] == $pseudo) {
                $verif = true;
            }
        endforeach
        ;
        return $verif;
    }

    // fonction d'extraction en bdd des admin
    public function get_admin($id = false)
    {
        if ($id === FALSE) {
            /* extrait toutes les infos de la bdd en rendant la date en français */
            $this->db->query("SET lc_time_names = 'fr_FR'");
            $this->db->select('date_format(date_enregistrement,"%W %d %M %Y") as date_enregistrement
                              ,pseudo,path_photo,email,password,id');
            $array = $this->db->get('admin')->result_array();
            // décrypt les infos
            $taille_de_array = sizeof($array);
            for ($h = 0; $h < $taille_de_array; $h ++) {
                $array[$h]['pseudo'] = $this->encryption->decrypt($array[$h]['pseudo']);
                $array[$h]['path_photo'] = $this->encryption->decrypt($array[$h]['path_photo']);
                $array[$h]['email'] = $this->encryption->decrypt($array[$h]['email']);
            }
            return $array;
        } else {
            /*
             * extrait toutes les infos de la bdd en rendant la date en français concernant l'id
             * passé en paramètre
             */
            $this->db->query("SET lc_time_names = 'fr_FR'");
            $this->db->select('date_format(date_enregistrement,"%W %d %M %Y") as date_enregistrement
                              ,pseudo,path_photo,email,password,id');
            $array = $this->db->get_where('admin', array(
                'id' => $id
            ))->row_array();
            // décrypt les infos
            $array['pseudo'] = $this->encryption->decrypt($array['pseudo']);
            $array['path_photo'] = $this->encryption->decrypt($array['path_photo']);
            $array['email'] = $this->encryption->decrypt($array['email']);
            return $array;
        }
    }

    // fonction de suppression d'un utilisateur
    public function delete($id)
    {
        $this->db->delete('admin', array(
            'id' => $id
        ));
    }

    // fonction de vérification et de création de session pour un admin
    public function verify($pseudo, $mdp, $bool)
    {
        // extrait les admins de la bdd
        $tous_admin = Admin_model::get_admin();
        // prépare l'interogation de notre tableau
        $result = [];
        $verif = true;
        // interogation du tableau pour savoir si le pseudo est connu
        foreach ($tous_admin as $admin) :
            // si le pseudo est connu on met les infos de l'admin dans le tableau $result
            if ($admin['pseudo'] == $pseudo) {
                $result = $admin;
                $verif = false;
            }
        endforeach
        ;
        if ($verif) {
            return false;
        } else {
            $hash = $result['password'];
            $mdp_verfification = password_verify($mdp, $hash);
            if ($mdp_verfification) {
                if ($bool) {
                    $this->session->set_userdata('__ci_last_regenerate', time());
                    $this->session->set_userdata('logged_in', TRUE);
                } else {
                    $dataUser = [
                        'pseudo' => $pseudo,
                        'logged_in' => TRUE,
                        'id' => $result['id'],
                        'photo' => $result['path_photo'],
                        'email' => $result['email']
                    ];
                    $this->session->set_userdata($dataUser);
                }
                return true;
            } else {
                return false;
            }
        }
    }
}