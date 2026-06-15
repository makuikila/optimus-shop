<?php 
session_start();
require 'bd.class.php';
$DB = new BD();
    if($_SESSION['online']){
    if(!empty('submit')){
        $nom = strip_tags(htmlspecialchars($_POST['nom']));
    $prix = strip_tags(htmlspecialchars($_POST['prix']));
    $categorie = strip_tags(htmlspecialchars($_POST['categorie']));
    $description = strip_tags(htmlspecialchars($_POST['description']));  
 
    $nom_produit = str_replace(' ', '-',$nom); //on remplace les espaces par des tirets
    $produit = $nom_produit. '_' .$prix. '$_' .$categorie. '_' .time() . '_' . $_FILES['produit']['name'] ;
    $chemin = 'img/produits/' . $produit;
    move_uploaded_file($_FILES['produit']['tmp_name'], $chemin);

    $rep1 = $DB->connectBD()->query("SELECT * FROM users");
        while($donnee = $rep1->fetch()){
            if($donnee['email'] == $_SESSION['online']){
            $id_users = $donnee['id'];
            $req = $DB->connectBD()->prepare('INSERT INTO produit (nom, prix, categorie, description, photo, id_users)
            VALUES(:nom, :prix, :categorie, :description, :photo, :id_users)');
            $rep = $req->execute(array(
                        'nom' => $nom,
                        'prix' => $prix,
                        'categorie' => $categorie,
                        'description' => $description,
                        'photo' => $produit,
                        'id_users' => $id_users
                    ));
                    
           ?>
                <script type="text/javascript"> 
                    alert("Un produit a été mis en ligne.");
                    location.href='addproduit.php';
                </script>
            <?php
            } 
        }
    }
    }      
    else{
        
        header('Location: index.html');
    }
?>