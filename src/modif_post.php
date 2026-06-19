<?php 
session_start();
require 'bd.class.php';
$DB = new BD();
    if($_SESSION['online']){
    $nom = strip_tags(htmlspecialchars($_POST['nom']));
    $prix = strip_tags(htmlspecialchars($_POST['prix']));
    $categorie = strip_tags(htmlspecialchars($_POST['categorie']));
    $description = strip_tags(htmlspecialchars($_POST['description']));  
    $decision = strip_tags(htmlspecialchars($_POST['decision']));  
    $modifpro = strip_tags(htmlspecialchars($_POST['modifpro']));  
 
    if($decision == 'modifier'){
        $nom_produit = str_replace(' ', '-',$nom); //on remplace les espaces par des tirets
        $produit = $nom_produit. '_' .$prix. '$_' .$categorie. '_' .time() . '_' . $_FILES['produit']['name'] ;
        $chemin = 'img/produits/' . $produit;
        move_uploaded_file($_FILES['produit']['tmp_name'], $chemin);

        $rep1 = $DB->connectBD()->query("SELECT * FROM produit");
        while($donnee = $rep1->fetch()){
            $update = $DB->connectBD()->prepare('UPDATE produit SET nom = :nom, prix = :prix, categorie = :categorie, description = :description, photo = :photo,
                where id_produit = :id_produit');
            $update->execute(array(
                'nom' => $nom,
                'prix' => $prix,
                'categorie' => $categorie,
                'description' => $description,
                'photo' => $produit,
                'id_produit' => $modifpro
            ));    
        }
        ?>
            <script type="text/javascript"> 
                alert("Un produit a été modifier.");
                location.href='profil.php';
            </script>
        <?php
    }  
    elseif($decision == 'supprimer'){
        
        $rep1 = $DB->connectBD()->query("SELECT * FROM produit");
        while($donnee = $rep1->fetch()){
            $update = $DB->connectBD()->prepare('DELETE from produit where id_produit = :id_produit');
            $update->execute(array(
                        'id_produit' => $modifpro
                    ));         
        }
        ?>
            <script type="text/javascript"> 
                alert("Un produit a été supprimer.");
                location.href='profil.php';
            </script>
        <?php
    }   
           
    }   
    else{
        
        header('Location: index.html');
    }
?>