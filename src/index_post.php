<?php
session_start();
require 'bd.class.php';
require 'session.class.php';
$DB = new BD();
$connexion = new CONNEXION();
if(!empty($_POST['email']) && !empty($_POST['mot_passe'])){
    
    $rep = $DB->connectBD()->query('SELECT * FROM users');

    $email = strip_tags(htmlspecialchars($_POST['email']));
    $mot_passe = strip_tags(htmlspecialchars($_POST['mot_passe']));

    while($email2  = $rep -> fetch()){
        if ($email == $email2['email']){
            if ($mot_passe == $email2['mot_passe']){
                $connexion->login($email);
                
                if($email2['status'] == 1){
                    ?>
                    <script type="text/javascript"> 
                        alert("Vous etes connecter.");
                    </script>
                <?php 
                    header('Location: admin/');
                }
                elseif($email2['status'] == 0){
                    ?>
                    <script type="text/javascript"> 
                        alert("Vous etes connecter.");
                    </script>
                <?php 
                    header('Location: home.php');
                }
                
            }
            else{
                ?>
                    <script type="text/javascript"> 
                        alert("Mot de passe incorrect, réessayez.")
                            location.href='javascript:history.back()';
                    </script>
                <?php  
               
            }
        }
        else{
           ?>
                <script type="text/javascript"> 
                    alert("Identifiant incorrect, réessayez.")
                        location.href='javascript:history.back()';
                </script>
            <?php
        }
    }
}
?>