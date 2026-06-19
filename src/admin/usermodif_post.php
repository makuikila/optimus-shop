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
        $status = strip_tags(htmlspecialchars($_POST['satus']));
        $mot_passe = strip_tags(htmlspecialchars($_POST['mot_passe']));
        $decision = strip_tags(htmlspecialchars($_POST['decision']));  
        $modifpro = strip_tags(htmlspecialchars($_POST['modif'])); 
    
        if($decision = 'modifier'){
            $profil = $nom. '_' .$prenom. '_' . $_FILES['profil']['name'] ;
            $chemin = '../img/profil/' . $profil;
            move_uploaded_file($_FILES['profil']['tmp_name'], $chemin);
    
            $rep1 = $DB->connectBD()->query("SELECT * FROM users");
                while($donnee = $rep1->fetch()){
                    if($donnee['email'] == $_SESSION['online']){
                        $mot_passe = $donnee['mot_passe'];
                        $id = $donnee['id'];
                        $update = $DB->connectBD()->prepare('UPDATE users SET nom_users = :nom_users, prenom_users = :prenom_users, email = :email, bio = :bio, 
                        mot_passe = :mot_passe, photo_users = :photo_users, num_bancaire = :num_bancaire, status = :status where id = :id');
                        $update->execute(array(
                                    'nom_users' => $nom,
                                    'prenom_users' => $prenom,
                                    'email' => $email,
                                    'bio' => $bio,
                                    'mot_passe' => $mot_passe,
                                    'photo_users' => $profil,
                                    'num_bancaire' => $num,
                                    'status' => $status,
                                    'id' => $modifpro
                                ));
                                
                    }   
        }
        ?>
            <script type="text/javascript"> 
                alert("l'abonnée a été modifier.");
                location.href='javascript:history.back()';
            </script>
        <?php
    }  
    elseif($decision == 'supprimer'){
        
        $rep1 = $DB->connectBD()->query("SELECT * FROM users");
        while($donnee = $rep1->fetch()){
            $update = $DB->connectBD()->prepare('DELETE from users where id = :id');
            $update->execute(array(
                        'id' => $modifpro
                    ));         
        }
        ?>
            <script type="text/javascript"> 
                alert("Un produit a été supprimer.");
                location.href='javascript:history.back()';
            </script>
        <?php
    }   
           
    }   
    else{
        
        header('Location: ../index.html');
    }
?>