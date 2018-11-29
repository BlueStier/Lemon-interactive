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
    public function index($data = false)    
	{   
        //passe en paramètre les données de l'admin si on a une session d'ouverte
        $data['admin'] = $this->session->userdata('pseudo');
        $data['photo'] = $this->session->userdata('photo');         
        $this->load->view('admin/index',$data);
    }
    
    public function view($nb, $id = false, $data = false)
    {   
        /**Vérifie si l'utilisateur est loggée  et s'il l'ai si la dernière utilisation ne dépasse pas le quart
         * d'heure. Si c'est le cas redirection à la page de log
        */
        $time = $this->session->userdata('__ci_last_regenerate')+900;
        $délai = FALSE;
        if($time < time()){
            $this->session->set_userdata('logged_in',FALSE);
        }
        if($this->session->userdata('pseudo') == '' || $this->session->userdata('logged_in') == FALSE){
            $this->session->set_userdata('logged_in',FALSE);
            header('Location:'.base_url().'admin/');
        }else{
            //maj dernière utilisation et envoie dans le tableau $data des infos de l'admin 
            $this->session->set_userdata('__ci_last_regenerate',time());
            $data['admin'] = $this->session->userdata('pseudo');
            $data['id'] = $this->session->userdata('id');
            $data['email'] = $this->session->userdata('email');
            $data['photo'] = $this->session->userdata('photo');
        switch($nb){
        case 0 :
        /*on charge le model inscrits et on utilise la fonction get_inscrits() pour récupérer
        toutes les infos de la base de données concernant les inscrits, on utilise la fonction get_pays pour avoir
        la liste de tous les pays sans doublons et on passe le n° du cas au left_menu pour le javascript et l'affichage*/        
        $data['inscrits_item'] = $this->Inscrits_model->get_inscrits();
        $data['pays_item'] = $this->Inscrits_model->get_pays();
        $data['nb'] = 0;    
        $this->load->view('admin/elements_fixes/header',$data);
        $this->load->view('admin/elements_fixes/left_menu',$data);
        $this->load->view('admin/tous_les_inscrits',$data);
        $this->load->view('admin/elements_fixes/footer');
        break;
        case 1 :
        /*charge la page permettant d'inscrire un utilisateur*/
        $this->load->model('Liste_model');
        $data['country'] = $this->Liste_model->get_contry();
        /*Si on doit créer un inscrit*/
        $data['create'] = TRUE;
        $data['nb'] = 1; 
        $this->load->view('admin/elements_fixes/header',$data);
        $this->load->view('admin/elements_fixes/left_menu',$data);
        $this->load->view('admin/inscrits_create_or_update',$data);
        $this->load->view('admin/elements_fixes/footer');
        break;
        case 2 :
        /*charge la page permettant la mise à jour d'un inscrit*/          
        $data['inscrit'] = $this->Inscrits_model->get_inscrits($id,TRUE);
        $this->load->model('Liste_model');
        $data['country'] = $this->Liste_model->get_contry();
        $data['metier'] = $this->Liste_model->get_job();
        /*Si on doit modifier un inscrit*/
        $data['create'] = FALSE;
        $data['nb'] = -1; 
        $this->load->view('admin/elements_fixes/header',$data);
        $this->load->view('admin/elements_fixes/left_menu',$data);
        $this->load->view('admin/inscrits_create_or_update',$data);
        $this->load->view('admin/elements_fixes/footer');
        break;
        case 3 :
        //voir tous les admin sauf BlueStier et l'admin en cour
        $data['nb'] = 2;
        $this->load->model('Admin_model');
        $data['admin_item'] = $this->Admin_model->get_admin();    
        $this->load->view('admin/elements_fixes/header',$data);
        $this->load->view('admin/elements_fixes/left_menu',$data);
        $this->load->view('admin/tous_les_admins',$data);
        $this->load->view('admin/elements_fixes/footer');
        break;
        case 4 :
        /*charge la page permettant d'inscrire un administrateur*/        
        /*Si on doit créer un admin*/
        $data['create'] = TRUE;
        $data['nb'] = 3; 
        $this->load->view('admin/elements_fixes/header',$data);
        $this->load->view('admin/elements_fixes/left_menu',$data);
        $this->load->view('admin/admin_create_or_update',$data);
        $this->load->view('admin/elements_fixes/footer');
        break;
        case 5 :
        /*charge la page permettant d'inscrire un administrateur*/        
        /*Si on doit créer un admin*/
        $data['create'] = FALSE;
        $data['nb'] = -1;
        $this->load->model('Admin_model');
        $data['admin_to_update'] = $this->Admin_model->get_admin($id); 
        $this->load->view('admin/elements_fixes/header',$data);
        $this->load->view('admin/elements_fixes/left_menu',$data);
        $this->load->view('admin/admin_create_or_update',$data);
        $this->load->view('admin/elements_fixes/footer');
        break;
        default:
        Admin::index();
        break;
        }
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
            $this->Send_mail_model->send($nom,$prenom,$date_naissance,$email,$sexe,$pays,$metier);
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

     /*fonction controlant l'enregistrement d'un iadministrateur*/
     public function create_admin(){
         //défini les paramètres obligatoires
        $this->form_validation->set_rules('pseudo', 'pseudo', 'required');
        $this->form_validation->set_rules('mdp', 'mot de passe', 'required');
        $this->form_validation->set_rules('conf_mdp', 'Confirmation du mot de passe', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');

        if($this->form_validation->run()===false){
            //si les critères ne sont pas ok on renvoit à la page de création avec info champ manquant
            Admin::view(4);
        }else{
            //on charge la classe de sécurité pour utiliser la fonction xss_clean()
            $this->load->helper('security_helper');            
            $pseudo = $this->security->xss_clean($this->input->post('pseudo'));

            //on vérifie si le pseudo est déjà en bdd
            $this->load->model('Admin_model'); 
            $exist = $this->Admin_model->verify_admin($pseudo);
            //Si oui redirection vers la page de création et info déjà existant
            if($exist){
            $data['error'] = array('error'=>'Ce pseudo est déjà utiliser veuillez en choisir un autre');
            Admin::view(4,false,$data);    
            }else{
                //le pseudo n'existe pas on continu le parsing avec le mot de passe
                $mdp = $this->security->xss_clean($this->input->post('mdp'));
                $conf_mdp = $this->security->xss_clean($this->input->post('conf_mdp'));
                //on vérifie que le mot de passe et sa confirmation sont identique
                //si ce n'est pas le cas redirection
                if($mdp != $conf_mdp){
                    $data['error'] = array('error'=>'Le mot de passe et sa confirmation sont diffférents');
                    Admin::view(4,false,$data);
                }else{
                    //mot de passe et confirmation identique on continu en vérifiant si l'admin aura une photo de profil
                    $pas_de_photo = $this->input->post('pas_de_photo');
                    if($pas_de_photo){
                        //pas de photo choisie
                        $chemin_vers_la_photo = 'assets/admin/image/slider-bg.jpg';
                    }else{
                        //une photo est choisie
                        //récupère et copie la photo choisie, définie les caractéristique de celle-ci et le chemin d'upload
                        $config['upload_path']= "./assets/admin/image";
                        $config['allowed_types'] = 'gif|jpg|png|jpeg';
                        $config ['max_size'] = 10000000 ;
                        $config ['max_width'] = 10000 ;
                        $config ['max_height'] = 10000 ;
                        $config ['overwrite'] = true;

                        //charge la librairie d'upload
                        $this->load->library('upload', $config);
                        //on tente l'upload 
                        if(! $this->upload->do_upload('photo'))
                        {
                            //si upload hs retour vers la page de création de page avec info sur l'echec du transfert
                                $data['error'] = array('error'=> $this->upload->display_errors());
                                Admin::view(4,false,$data);
                        }else{
                            //upload ok on continu
                            $info_sur_upload = array('upload_data'=>$this->upload->data());
                            $chemin_vers_la_photo = '/assets/admin/image/'.$info_sur_upload['upload_data']['orig_name'];
                            
                        }
                    }
                    //a ce stade il ne manque plus que l'adresse mail*/
                    $email = $this->security->xss_clean($this->input->post('email'));
                            
                    /*toutes les infos pour la création d'un admin sont récupérées on appel la fonction
                    create_admin() du model admin*/ 
                    $this->Admin_model->create($pseudo,$mdp,$chemin_vers_la_photo,$email);
                    //et redirection final
                    Admin::view(3); 
                }
            }
        }
     }

     //fonction permettant la connexion
     public function connect(){
        //si une session est en cour
        if($this->session->userdata('pseudo')!== NULL){
            //on définie les critères obligatoires
            $this->form_validation->set_rules('pwd', 'Mot de passe', 'required');

            if($this->form_validation->run()==FALSE)
         {
            //si le champs n'est pas rempli redirige vers l'index
            Admin::index();
             
         } else {
             /** sinon on récupère les infos */
            $id = $this->session->userdata('id');
            $this->load->model('Admin_model');
            $admin = $this->Admin_model->get_admin($id);
            $mdp = $this->input->post('pwd');
            $verify = $this->Admin_model->verify($admin['pseudo'],$mdp,TRUE);         
         if($verify){
             //vérif ok on envoi vers le back-office           
            Admin::view(0);
         } else {
             //verif hs retour login           
            $data['error'] = ['error' => 'Mot de passe incorrect'];         
            Admin::index($data);
         }
         }   
        }else{
         //pas de session en cour on définie les critères obligatoires       
         $this->form_validation->set_rules('pseudo', 'Pseudo ', 'required');
         $this->form_validation->set_rules('pwd', 'Mot de passe', 'required');                
 
         if($this->form_validation->run()==FALSE)
         {
            //si les champs ne sont pas remplis redirige vers l'index
            Admin::index();
             
         } else {
         $pseudo = $this->input->post('pseudo');          
         $mdp = $this->input->post('pwd');
            /**On charge le model admin et on effectue la vérification */
         $this->load->model('Admin_model');
         $verify = $this->Admin_model->verify($pseudo,$mdp,FALSE);         
         if($verify){
             //on est bon c'est vérifier on entre dans le back-office           
             Admin::view(0);
         } else { 
            // c'est pas bon retour à la case départ           
         $data['error'] = ['error' => 'Pseudo ou mot de passe incorrect'];         
         Admin::index($data);
         }
        }
    }
    }

       //fonction de déconnexion
       public function destroy(){
        $this->session->sess_destroy();
        header('Location:'.base_url().'admin');
    }

        //fonction de mise en veille
        public function dodo(){
            $this->session->set_userdata('logged_in',FALSE);
            header('Location:'.base_url().'admin');
        }

        //fonction de suppression d'un admin
        public function delete_admin(){
            $id = $this->input->post('id');
            $this->load->model('Admin_model');
            $this->Admin_model->delete($id);
            Admin::view(3);
        }
}