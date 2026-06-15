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
            <div>
                <h1><span>Detail</span></h1>
                <p>Decouvrez les details pour les differents produits</p>
            </div>
        </section>
        <div class=" col-md-12 col-sm-12 col-xs-12 ">
            <div class="produit col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
            <?php
                $choix = $_GET['id'];
                $user = $_GET['user']; $verif =  $DB->connectBD()->query("SELECT *,date_format(date_ajout, 'poster le %d/%m/%Y à %Hh') as date_pro 
                                            FROM users inner join produit on users.id = produit.id_users 
                                            WHERE produit.id_produit = $choix");
                         while($donnee1 = $verif->fetch()){
                            $id = $donnee1['id'];
                         
                              //données sur le produit
                                $photoproduit = $donnee1['photo'];
                                $nomproduit = $donnee1['nom'];
                                $prix = $donnee1['prix'];
                                $description = $donnee1['description'];
                                $categorie = $donnee1['categorie'];
                                $id_prodiuit = $donnee1['id_produit'];
                                ?>
                                 <div class="detailProduit col-md-6 col-sm-6 col-xs-6">
                                    <img src="img/produits/<?php echo $photoproduit ?>">
                                </div>
                
                                <div class="nomProduit col-md-6 col-sm-6 col-xs-6">
                                    <h3><strong>Nom : </strong><?php echo $nomproduit ?></h3>
                                    <h3><strong>Prix : </strong><?php echo $prix ?>.00$</h3>
                                    <h3><strong>Categorie : </strong><?php echo $categorie ?></h3>
                                    <h3><strong>Description : </strong></h3><h4> <?php echo $description ?></h4>
                                    <a class= "addpanier" href="addpanier.php?id=<?php echo $id_prodiuit ?>"><i class="fa fa-cart-plus"></i> Ajouter au panier</a>
                                </div>
                            <?php  
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