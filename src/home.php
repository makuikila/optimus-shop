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
    <link rel="stylesheet" href="css/home.css" />
    <title></title>
</head>
<body>
    <section class="fond col-md-12 col-sm-12 col-xs-12">
        <li class="limg"><img src="img/f3.jpg" /></li>
        <section class="ombre col-md-12 col-sm-12 col-xs-12">
            <div>
                <h1><span>Acceuil</span></h1>
                <p>Decouvrez tous les produits misent en ligne</p>
            </div>
        </section>
    </section>
    <section class="affmobile col-md-12 col-sm-12 col-xs-12">
    <section class="contenu col-md-12 col-sm-12 col-xs-12">
    
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 class="titre">les nouveaux produits</h3>
            <div class="article col-md-12 col-sm-12 col-xs-12">
                <?php
$verif1 =  $DB->connectBD()->query("SELECT *,date_format(date_ajout, 'poster le %d/%m/%Y à %Hh') as date_pro FROM users inner join produit on users.id = produit.id_users where produit.etat = 'en vente' order by produit.id_produit desc limit 0,4");

    while($ans1 = $verif1->fetch()){
        if($ans1['email'] != $_SESSION['online']){
        //données de l'auteur
        $photo = $ans1['photo_users'];
        $nom = $ans1['nom_users'];
        $prenom = $ans1['prenom_users'];
        $email = $ans1['email'];
        $id = $ans1['id'];

        //données sur le produit
        $photoproduit = $ans1['photo'];
        $nomproduit = $ans1['nom'];
        $prix = $ans1['prix'];
        $description = $ans1['description'];
        $categorie = $ans1['categorie'];
        $id_prodiuit = $ans1['id_produit'];
        

        //verication du photo de profil de l'auteur
        if($photo != null or $photo != ''){
            ?> 
            <section class="sec col-lg-3 col-md-4 col-sm-4 col-xs-4">
            <div class="profil">
            <a href="users.php?user=<?php echo $id ?>">
                <img src="img/profil/<?php echo $photo ?>"> 
                <div>
                    <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                    <p><?php echo $ans1['date_pro'] ?></p>
                </div>
                </a> 
            </div><?php
        } else{
            ?> <section class="sec col-lg-3 col-md-4 col-sm-4 col-xs-4">
                <div class="profil">
                <a href="users.php?user=<?php echo $id ?>">
                    <img src="img/profil/defaut.jpg" >
                    <div>
                        <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                        <p><?php echo $ans1['date_pro'] ?></p>
                    </div>  
                </a> 
            </div><?php
        }
    ?>
    <div class="produit">
    <div class="detailProduit">
    
        <div class="link">
            <h4><?php echo $categorie ?></h4>
            <a class= "addpanier"  href="addpanier.php?id=<?php echo $id_prodiuit ?>"><i class="fa fa-cart-plus"></i></a>
        </div>
        <a href="userprod.php?id=<?php echo $id_prodiuit ?>&user=<?php echo $id ?>">
                                            <img src="img/produits/<?php echo $photoproduit ?> " ></a>
    </div>

    <div class="nomProduit ">
        <div class="nom">
            <p><?php echo $nomproduit ?></p>
            <p id="prix"><?php echo $prix ?>.00$</p>
        </div>
        <div class="desc">
        <strong>description</strong> <br> <?php echo $description ?>
        </div>
    </div>                
    </div>
    </section>
    <?php
    }
}
?>
        </div> 
        </div>  
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 class="titre">Les produits Itech</h3>
            <div class="article col-md-12 col-sm-12 col-xs-12">
                <?php
$verif2 =  $DB->connectBD()->query("SELECT *,date_format(date_ajout, 'poster le %d/%m/%Y à %Hh') as date_pro FROM users inner join produit on users.id = produit.id_users where produit.etat = 'en vente' and categorie='itech' order by produit.id_produit limit 0,11");

    while($ans2 = $verif2->fetch()){
        if($ans2['email'] != $_SESSION['online']){
        //données de l'auteur
        $photo = $ans2['photo_users'];
        $nom = $ans2['nom_users'];
        $prenom = $ans2['prenom_users'];
        $email = $ans2['email'];
        $id = $ans2['id'];

        //données sur le produit
        $photoproduit = $ans2['photo'];
        $nomproduit = $ans2['nom'];
        $prix = $ans2['prix'];
        $description = $ans2['description'];
        $categorie = $ans2['categorie'];
        $id_prodiuit = $ans2['id_produit'];
        

        //verication du photo de profil de l'auteur
        if($photo != null or $photo != ''){
            ?> 
            <section class="sec col-lg-3 col-md-4 col-sm-4 col-xs-4">
            <div class="profil">
            <a href="users.php?user=<?php echo $id ?>">
                <img src="img/profil/<?php echo $photo ?>"> 
                <div>
                    <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                    <p><?php echo $ans2['date_pro'] ?></p>
                </div>
                </a> 
            </div><?php
        } else{
            ?> <section class="sec col-lg-3 col-md-4 col-sm-4 col-xs-4">
                <div class="profil">
                <a href="users.php?user=<?php echo $id ?>">
                    <img src="img/profil/defaut.jpg" >
                    <div>
                        <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                        <p><?php echo $ans2['date_pro'] ?></p>
                    </div>  
                </a> 
            </div><?php
        }
    ?>
    <div class="produit">
    <div class="detailProduit">
    
        <div class="link">
            <h4><?php echo $categorie ?></h4>
            <a class= "addpanier"  href="addpanier.php?id=<?php echo $id_prodiuit ?>"><i class="fa fa-cart-plus"></i></a>
        </div>
        <a href="userprod.php?id=<?php echo $id_prodiuit ?>&user=<?php echo $id ?>">
                                            <img src="img/produits/<?php echo $photoproduit ?> " ></a>
    </div>

    <div class="nomProduit ">
        <div class="nom">
            <p><?php echo $nomproduit ?></p>
            <p id="prix"><?php echo $prix ?>.00$</p>
        </div>
        <div class="desc">
        <strong>description</strong> <br> <?php echo $description ?>
        </div>
    </div>                
    </div>
    </section>
    <?php
    }
}
?>
                
        </div>    
        </div>
        
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 class="titre">Les produits de Mode</h3>
            <div class="article col-md-12 col-sm-12 col-xs-12">
            <?php
                $verif =  $DB->connectBD()->query("SELECT *,date_format(date_ajout, 'poster le %d/%m/%Y à %Hh') as date_pro FROM users inner join produit on users.id = produit.id_users where produit.etat = 'en vente' and categorie='mode' order by produit.id_produit limit 0,11");

                    while($ans = $verif->fetch()){
                        if($ans['email'] != $_SESSION['online']){
                        //données de l'auteur
                        $photo = $ans['photo_users'];
                        $nom = $ans['nom_users'];
                        $prenom = $ans['prenom_users'];
                        $email = $ans['email'];
                        $id = $ans['id'];

                        //données sur le produit
                        $photoproduit = $ans['photo'];
                        $nomproduit = $ans['nom'];
                        $prix = $ans['prix'];
                        $description = $ans['description'];
                        $categorie = $ans['categorie'];
                        $id_prodiuit = $ans['id_produit'];
                        

                        //verication du photo de profil de l'auteur
                        if($photo != null or $photo != ''){
                            ?> 
                            <section class="sec  col-lg-3 col-md-4 col-sm-4 col-xs-4">
                            <div class="profil">
                            <a href="users.php?user=<?php echo $id ?>">
                                <img src="img/profil/<?php echo $photo ?>"> 
                                <div>
                                    <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                                    <p><?php echo $ans['date_pro'] ?></p>
                                </div>
                                </a> 
                            </div><?php
                        } else{
                            ?> <section class="sec col-lg-3 col-md-4 col-sm-4 col-xs-4">
                                <div class="profil">
                                <a href="users.php?user=<?php echo $id ?>">
                                    <img src="img/profil/defaut.jpg" >
                                    <div>
                                        <h3><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                                        <p><?php echo $ans['date_pro'] ?></p>
                                    </div>  
                                </a> 
                            </div><?php
                        }
                    ?>
                    <div class="produit">
                    <div class="detailProduit">
                    
                        <div class="link">
                            <h4><?php echo $categorie ?></h4>
                            <a class= "addpanier"  href="addpanier.php?id=<?php echo $id_prodiuit ?>"><i class="fa fa-cart-plus"></i></a>
                        </div>
                        <a href="userprod.php?id=<?php echo $id_prodiuit ?>&user=<?php echo $id ?>">
                                                            <img src="img/produits/<?php echo $photoproduit ?> " ></a>
                    </div>

                    <div class="nomProduit ">
                        <div class="nom">
                            <p><?php echo $nomproduit ?></p>
                            <p id="prix"><?php echo $prix ?>.00$</p>
                        </div>
                        <div class="desc">
                        <strong>description</strong> <br> <?php echo $description ?>
                        </div>
                    </div>                
                    </div>
                    </section>
                    <?php
                    }
                }
                ?>
            </div>                
        </div>   
    </section>
    <?php require 'footer.php'; ?>
    </section>
</body>
<script src="bootstrap/js/bootstrap.js"></script>
</html>
<?php
}      
    else{
        
        header('Location: index.html');
    }
?>