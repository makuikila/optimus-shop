<?php
session_start();
require 'bd.class.php';
require 'session.class.php';
$DB = new BD();
$connexion = new CONNEXION();
if(!empty($_POST['email']) && !empty($_POST['mot_passe']) && !empty($_POST['confirme']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
    
    if(isset($_POST['envoyer'])){
        //declaration de variebles
        $nom = strip_tags(htmlspecialchars($_POST['nom']));
        $prenom = strip_tags(htmlspecialchars($_POST['prenom']));
        $email = strip_tags(htmlspecialchars($_POST['email']));
        $mot_passe = strip_tags(htmlspecialchars($_POST['mot_passe']));  
        $confirme = strip_tags(htmlspecialchars($_POST['confirme']));    
        
        //verification si les champs ont bien été saisis
        if($mot_passe == $confirme){
           
            // Insertion des infomations du champ à l'aide d'une requête préparée
            $req = $DB->connectBD()->prepare("INSERT INTO users (nom_users, prenom_users, email, bio, mot_passe, photo_users, num_bancaire)
             VALUES(:nom_users, :prenom_users, :email, :bio, :mot_passe, :photo_users, :num_bancaire)");

            $rep = $req->execute(array(
                'nom_users'  =>  $nom,
                'prenom_users' => $prenom,
                'email'  => $email,
                'bio' => null,
                'mot_passe' => $mot_passe,    
                'photo_users' => null, 
                'num_bancaire' => null
            ));         
            $connexion->login($email);
            ?>
                <script type="text/javascript"> 
                    alert("L'inscription reussie, d'office vous etes automatiquement connecter");
                </script>
            <?php     
                header('Location: home.php');
        }                
        
        else{
            ?>
            <script type="text/javascript"> 
                alert("La confirmation de mot de passe est incorrecte, veillez réessayer.")
                    location.href='javascript:history.back()';
            </script>
        <?php       
        }
    }
}