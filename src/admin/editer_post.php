<?php 
session_start();
require '../bd.class.php';
$DB = new BD();
    if($_SESSION['online']){
    $nom = strip_tags(htmlspecialchars($_POST['nom']));
    $prenom = strip_tags(htmlspecialchars($_POST['prenom']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $num = strip_tags(htmlspecialchars($_POST['num']));  
    $bio = strip_tags(htmlspecialchars($_POST['bio']));
    $mot_passe = strip_tags(htmlspecialchars($_POST['mot_passe']));

        $profil = $nom. '_' .$prenom. '_' . $_FILES['profil']['name'] ;
        $chemin = '../img/profil/' . $profil;
        move_uploaded_file($_FILES['profil']['tmp_name'], $chemin);

        $rep1 = $DB->connectBD()->query("SELECT * FROM users");
            while($donnee = $rep1->fetch()){
                if($donnee['email'] != $_SESSION['online']){
                    $mot_passe = $donnee['mot_passe'];
                    $id = $donnee['id'];
                    $update = $DB->connectBD()->prepare('INSERT INTO users (nom_users, prenom_users, email, bio, mot_passe, photo_users, num_bancaire, status)
                    VALUES(:nom_users, :prenom_users, :email, :bio, :mot_passe, :photo_users, :num_bancaire, :status)');
                    $update->execute(array(
                                'nom_users' => $nom,
                                'prenom_users' => $prenom,
                                'email' => $email,
                                'bio' => $bio,
                                'mot_passe' => $mot_passe,
                                'photo_users' => $profil,
                                'num_bancaire' => $num,
                                'status' => 0
                            ));
                            
                }
            
                ?>
                    <script type="text/javascript"> 
                        alert("Votre profil été modifier.");
                        location.href='javascript:history.back()';
                    </script>
                <?php
            }  
       
            } 
    else{
        
        header('Location: ../index.html');
    }
?>