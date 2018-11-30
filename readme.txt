README :
//**Projet réalisé par Loïc Roussel alias BlueSier 

https://www.bluestier.fr
**//
Pour utiliser ce projet vous devez l'importer sur votre serveur 
Importer la base de données.

Vous devez enregistrer le code de votre clef api google dans :
application/views/site/elements_fixes/footer.php
 ligne 52 <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=votre_clef_api"></script>

Vous devez également renseigner les données de connexions au serveur mail
dans application/models/Send_mail_model.php
ligne 43
       $config['smtp_host'] = 'non du serveur';
        $config['smtp_port'] = 'port ex: 465';
        $config['smtp_user'] = 'votre_mail@mon_site.com';
        $config['smtp_pass'] = 'mot_de_passe';
