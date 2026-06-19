<?php 
session_start();
require '../bd.class.php';
require '../panier.class.php';
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
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <title></title>
</head>
<body>
<section class=" affmobile col-md-12 col-sm-12 col-xs-12"> 
    <div class="col-md-4 col-sm-4 col-xs-4">
            <section class="aff col-md-12 col-sm-12 col-xl-12">
                <div class="logo col-md-12 col-sm-12 col-xs-12">
                    <p class=""><img src="../img/optimus.png" /></p>
                    <h1>OPTIMUS <span>Shop</span></h1>
                    <p class="para">Une plateforme de vente en ligne de type consommateurs vers
                        consommateurs qui vous permet non seulement d'acheter de bon produits
                        mais aussi de vendre ces proprès produits via le paiement VISA, MASTERCARD,
                        M-PESA, AIRTEL MONEY, ORANGE MONEY...</p>
                </div>
                <div class="profil col-md-12 col-sm-12 col-xs-12">
                    <h2>Votre profil</h2>
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
                                        <img src="../img/profil/<?php echo $photo ?>"> 
                                        
                                    
                                        <h3 class="col-md-12 col-sm-12 col-xs-12"><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                                        <p class="col-md-12 col-sm-12 col-xs-12"><?php echo $email ?></p>
                                    </div><?php
                                } else{
                                    ?> <div class="col-md-12 col-sm-12 col-xs-12">
                                        <img src="../img/profil/defaut.jpg" >
                                        

                                        <h3 class="col-md-12 col-sm-12 col-xs-12"><?php echo strtoupper($prenom.' '.$nom) ?></h3>
                                        <p class="col-md-12 col-sm-12 col-xs-12"><?php echo $email ?></p>
                                    </div><?php
                                }
                        }
                        } 
                ?>
                
        
    </ul>
                </div>
            </section>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-8">
        <header>
        <nav>Administration</nav>   
        <a href="../deconnexion.php"><i class="fa fa-power-off"></i>Deconnexion</a>            
    </header>
    <section class="contenu col-md-12 col-sm-12 col-xs-12">
    <?php 
        $livre = $DB->connectBD()->query("SELECT *, sum(total) as totalsum FROM livre");
        $benef = $DB->connectBD()->query("SELECT * FROM benefice");
        while($acheteur = $livre->fetch()){
            $solde_acheter = 0;
            $benefice = 0;
            while($totalbenef = $benef->fetch()){
                $benefice += $totalbenef['benefice'];
            }
            $count_pro_en_vente = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'en vente'")->fetchcolumn();
            $abonne = $DB->connectBD()->query("SELECT COUNT(*) FROM users where status = 0")->fetchcolumn();
            $admin = $DB->connectBD()->query("SELECT COUNT(*) FROM users where status = 1")->fetchcolumn();
            $count_pro_vendu = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'vendu'")->fetchcolumn();
            $solde_acheter = $acheteur['totalsum'];
            ?>
            <a href="abonne.php">
                <p class="vert-bleu">
                    <strong><?php echo $abonne ?></strong><br><br> /abonne
                </p>
            </a>
            <a href="envente.php"> 
                <p class="rouge">
                    <strong><?php echo $count_pro_en_vente ?></strong><br><br> /produit en vente
                </p>
            </a><br>
            <a href="vendu.php">
                <p class="rouge">
                    <strong><?php echo $count_pro_vendu ?></strong><br><br> /produit vendu
                </p>
            </a>
            
            
            <a href="admin.php">
                <p class="vert-bleu">
                    <strong><?php echo $admin ?></strong><br><br> /admin
                </p>
            </a><br>
            <a href="solde.php">
                <p class="vert-bleu">
                    <strong><?php echo $solde_acheter ?>$</strong><br><br> /solde
                </p>
            </a>
            <a href="benefice.php"> 
                <p class="rouge">
                    <strong><?php echo $benefice ?>$</strong><br><br> /benefice
                </p>
            </a>
<?php         break;
        }        
                          
        ?>
        <nav class="trans"><a href="paye.php">transferer</a> </nav>
             
    </section>
        </div>
    
    
    </section>
</body>
</html>
<?php
}      
    else{
        
        header('Location: ../index.html');
    }
?>