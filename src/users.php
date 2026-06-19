<?php 
session_start();
require 'bd.class.php';
require 'panier.class.php';
$DB = new BD();
$panier = new panier($DB);
    if($_SESSION['online']){
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/users.css" />
    <title></title>
</head>
<body>
<section class="fond col-md-12 col-sm-12 col-xs-12">
        <li class="limg"><img src="img/f1.jpg" /></li>
        <section class="ombre col-md-12 col-sm-12 col-xs-12">
            <div class="porto col-md-6 col-sm-6 col-xs-6">
            <section class="affmobile col-md-12 col-sm-12 col-xs-12">
    <section class="main col-md-12 col-sm-12 col-xs-12 ">
    <div class="profil">
        <?php
        $user_id = $_GET['user'];
$rep1 = $DB->connectBD()->query("SELECT * FROM users");
        while($donnee1 = $rep1->fetch()){
            $id = $donnee1['id'];
           if($id == $user_id){
                $photo = $donnee1['photo_users'];
                $nom = $donnee1['nom_users'];
                $prenom = $donnee1['prenom_users'];
                $email = $donnee1['email'];
                if($photo != null){
                    ?> <img src="img/profil/<?php echo $photo ?>"> 
                    <div>
                        <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                        <p><?php echo $email ?></p>
                    </div><?php
                } else{
                    ?> <img src="img/profil/defaut.jpg" ><h3>
                    <div>
                        <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                        <p><?php echo $email ?></p>
                    </div><?php
                }
                ?>  
        </div>
        <div class="gestProduit">
        <?php 
        $rep1 = $DB->connectBD()->query("SELECT * FROM users");
        $rep = $DB->connectBD()->query("SELECT * FROM produit");
        $livre = $DB->connectBD()->query("SELECT * FROM livre");
        while($donnee1 = $rep1->fetch()){
            $id = $donnee1['id'];
            $email = $donnee1['email'];
            if($donnee1['email'] != $_SESSION['online']){
            if($id == $user_id ){
                while($acheteur = $livre->fetch()){
                    $count_pro_acheter = 0;
                    if($email == $acheteur['acheteur']){
                        $count_pro_acheter = $acheteur['quant_pro'];
                    }
                } 
                while($donnee = $rep->fetch()){
                    if($donnee['id_users'] == $id){
                        $count_pro_en_vente = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'en vente' and id_users = $id")->fetchcolumn();
                        $count_pro_vendu = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'vendu' and id_users = $id")->fetchcolumn();
                        ?>
                        <a><strong> <?php echo $count_pro_en_vente ?></strong> produit(s) en vente</a>
                        <a><strong> <?php echo $count_pro_vendu?></strong>produit(s) vendu(s) </a>
                        <a><strong> <?php echo $count_pro_acheter ?></strong>produit(s) acheter</a>
            <?php 
                        break;   
                    }  
                }
                    //break;         
                
            } 

        }
    }
}
} 
                    ?>
        </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h1><span>Autre abonné</span></h1>
                <p>Decouvrez les informations sur un autre utilisateur</p>
            </div>
        </section>
    </section>
        <div class="contenu col-md-12 col-sm-12 col-xs-12">
        
            <div class="prod col-md-6 col-sm-6 col-xs-6">
                <h3 class="titre">Ses produit(s) en vente</h3>
              <div class="colo col-md-12 col-sm-12 col-xs-12">
              <?php

                $rep1 = $DB->connectBD()->query("SELECT * FROM users");
                $rep = $DB->connectBD()->query("SELECT * FROM produit where etat = 'en vente' order by id_produit desc");
                        while($donnee1 = $rep1->fetch()){
                            $user_id = $_GET['user'];
                            $id = $donnee1['id'];
                                if($id == $user_id){
                                    while($donnee = $rep->fetch()){
                                        if($donnee['id_users'] == $id){
                                            //données sur le produit
                                            $photoproduit = $donnee['photo'];
                                            ?> <a class="col-md-4 col-sm-4 col-xs-4" href="userprod.php?id=<?php echo $donnee['id_produit'] ?>&user=<?php echo $user_id ?>">
                                            <img src="img/produits/<?php echo $photoproduit ?> " ></a> <?php
                                    }
                                } 
                            }
                        }
                ?>
              </div>  
            
            </div>
            <div class=" stat col-md-6 col-sm-6 col-xs-6">
                <h3 class="titre">Autres abonnés</h3>
                <?php
                $verif =  $DB->connectBD()->query("SELECT * FROM users where status = 0 order by id desc");
                
            while($ans = $verif->fetch()){
                $id = $ans['id'];
                if($ans['email'] != $_SESSION['online'] && $id != $user_id){
                //données de l'auteur
                $photo = $ans['photo_users'];
                $nom = $ans['nom_users'];
                $prenom = $ans['prenom_users'];
                $email = $ans['email'];                

                //verication du photo de profil de l'auteur
                if($photo != null or $photo != ''){
                    ?> 
                    <div class="profil1">
                    <a href="users.php?user=<?php echo $id ?>">
                        <img src="img/profil/<?php echo $photo ?>"> 
                        <div>
                            <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                        </div>
                        </a> 
                    </div><?php
                } else{
                    ?>
                        <div class="profil1">
                        <a href="users.php?user=<?php echo $id ?>">
                            <img src="img/profil/defaut.jpg" >
                            <div>
                                <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                                </div>  
                        </a> 
                    </div><?php
                }
               
            }
        }
            
                    ?>
        
            </div>
           
        </div>
    </section>
    <?php require 'footer.php'; ?>
    </section>
</body>
</html>
<?php
}      
    else{
        
        header('Location: index.html');
    }
?>