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
    <link rel="stylesheet" href="css/profil.css" />
    <title></title>
</head>
<body>
<section class="fond col-md-12 col-sm-12 col-xs-12">
        <li class="limg"><img src="img/f4.jpg" /></li>
        <section class="ombre col-md-12 col-sm-12 col-xs-12">
            <div class="porto col-md-6 col-sm-6 col-xs-6">
            <section class="affmobile col-md-12 col-sm-12 col-xs-12">
    <section class="main col-md-12 col-sm-12 col-xs-12 ">
            <div class="profil">
                        <?php
                $rep1 = $DB->connectBD()->query("SELECT * FROM users");
                        while($donnee1 = $rep1->fetch()){
                        if($donnee1['email'] == $_SESSION['online']){
                                $photo = $donnee1['photo_users'];
                                $nom = $donnee1['nom_users'];
                                $prenom = $donnee1['prenom_users'];
                                $email = $donnee1['email'];
                                if($photo != null){
                                    ?> <div class="col-md-12 col-sm-12 col-xs-12">
                                        <img src="img/profil/<?php echo $photo ?>"> 
                                        <a href="editer.php"><i class="fa fa-paint-brush"></i></a>
                                    
                                        <h3 class="col-md-12 col-sm-12 col-xs-12"><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                                        <p class="col-md-12 col-sm-12 col-xs-12"><?php echo $email ?></p>
                                    </div><?php
                                } else{
                                    ?> <div class="col-md-12 col-sm-12 col-xs-12">
                                        <img src="img/profil/defaut.jpg" >
                                        <a href="editer.php"><i class="fa fa-paint-brush"></i></a>

                                        <h3 class="col-md-12 col-sm-12 col-xs-12"><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                                        <p class="col-md-12 col-sm-12 col-xs-12"><?php echo $email ?></p>
                                    </div><?php
                                }
                        }
                        } 
                ?>
        </div>
        <div class="gestProduit">
            <a href="addproduit.php" class="col-md-12 col-sm-12 col-xs-12">Ajouter un nouveau produit</a>
            <a href="modif.php" class="col-md-12 col-sm-12 col-xs-12">Modifier/retirer un produit</a>
            <a href="deconnexion.php" class="btn btn-danger"><i class="fa fa-power-off"></i> Deconnexion</a>
        </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h1><span>Profil</span></h1>
                <p>Tu peux gerer facilement ton profil, voir tes stat et autres</p>
            </div>
        </section>
    </section>
        <div class="contenu col-md-12 col-sm-12 col-xs-12">
        
            <div class="prod col-md-6 col-sm-6 col-xs-6">
                <h3>Mes produits</h3>
              <div class="colo col-md-12 col-sm-12 col-xs-12">
              <?php
                $rep1 = $DB->connectBD()->query("SELECT * FROM users");
                $rep = $DB->connectBD()->query("SELECT * FROM produit order by id_produit desc");
                        while($donnee1 = $rep1->fetch()){
                            if($donnee1['email'] == $_SESSION['online']){
                                $id = $donnee1['id'];
                                    while($donnee = $rep->fetch()){
                                        if($donnee['id_users'] == $id){
                                            //données sur le produit
                                            $photoproduit = $donnee['photo'];
                                            $id_prod = $donnee['id_produit'];
                                            ?>  <a class="col-md-4 col-sm-4 col-xs-4" href="myprod.php?id=<?php echo $id_prod ?>"><img src="img/produits/<?php echo $photoproduit ?> " > </a> <?php
                                    }
                                } 
                            }
                        }
                ?>
              </div>  
            
            </div>
            <div class=" stat col-md-6 col-sm-6 col-xs-6">
                <h3>Mes stats</h3>
            <?php 
        $rep1 = $DB->connectBD()->query("SELECT * FROM users");
        $rep = $DB->connectBD()->query("SELECT * FROM produit");
        $livre = $DB->connectBD()->query("SELECT * FROM livre");
        while($donnee1 = $rep1->fetch()){
            if($donnee1['email'] == $_SESSION['online']){
                $id = $donnee1['id'];
                $email = $donnee1['email'];
                while($donnee = $rep->fetch()){
                    if($donnee['id_users'] == $id){
                        $count_pro_acheter = 0;
                        $solde_acheter =  0;
                        $solde_vendu = 0;
                        $solde_produit = 0;
                        while($acheteur = $livre->fetch()){
                            if($email == $acheteur['acheteur']){
                                $count_pro_acheter += $acheteur['quant_pro'];
                                $solde_acheter +=  $acheteur['total'];
                            }                                             
                        }
                            
                        
                        $count_pro_en_vente = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'en vente' and id_users = $id")->fetchcolumn();
                        $count_pro_vendu = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'vendu' and id_users = $id")->fetchcolumn();
                        
                        $solde_vendu = $DB->connectBD()->query("SELECT sum(prix)  FROM produit where etat ='vendu' and id_users = $id")->fetchcolumn();
                        $solde_produit = $DB->connectBD()->query("SELECT sum(prix) FROM produit where etat ='en vente' and id_users = $id")->fetchcolumn();
                        ?>
                        <ul class="col-md-12 col-sm-12 col-xs-12">
                            <li><i class="fa fa-money"></i>Solde achaté
                                <strong><?php echo $solde_acheter ?>$</strong> 
                            </li>
                            <li><i class="fa fa-money"></i>Solde vendu
                               <strong><?php echo $solde_vendu ?>$</strong>
                           </li>
                            <li><i class="fa fa-money"></i>Solde en vente
                                <strong><?php echo $solde_produit ?>$</strong>
                            </li>
                            <li><i class="fa fa-check-square-o "></i>Produit vendu <strong><?php echo $count_pro_vendu ?></strong></li>
                            <li><i class="fa fa-bar-chart"></i>Produit en vente  <strong><?php echo $count_pro_en_vente ?></strong></li>
                            <li><i class="fa fa-pie-chart"></i>Produit achèté  <strong><?php echo $count_pro_acheter ?></strong></li>
                            
                        </ul>
        <?php 
                        break;
                        }
                    }
                    
                }
                
            }
            
                    ?>
            
        </section>
        
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