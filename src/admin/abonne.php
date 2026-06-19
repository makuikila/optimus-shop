<?php 
session_start();
require '../bd.class.php';
$DB = new BD();
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
    <link rel="stylesheet" href="../css/detail.css" />
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
            <a href="javascript:history.back()"><i class="fa fa-reply "></i></a> 
            <nav>Les abonnés</nav>
        </header>
        <section class="contenu">
            <p>Photo</p>
            <p>noms</p>
            <p>stat produit</p>
            <p>solde</p>
        <?php 
        $rep1 = $DB->connectBD()->query("SELECT * FROM users where status = 0 order by id desc");
        while($donnee1 = $rep1->fetch()){
            $id = $donnee1['id'];
            $count_pro_en_vente = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'en vente' and id_users = $id")->fetchcolumn();
            $count_pro_vendu = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'vendu' and id_users = $id")->fetchcolumn();
            ?>
            <p>
                <img src="../img/profil/<?php 
                if($donnee1['photo_users'] != null or $donnee1['photo_users'] != ''){ 
                    echo  $donnee1['photo_users'];  
                } else{ 
                    echo'../profil/defaut.jpg';
                }?>">
            </p>
            <p><?php echo strtoupper($donnee1['nom_users']) .' '.strtoupper( $donnee1['prenom_users']).'<br>'. $donnee1['email']; ?></p>
            <p><?php echo $count_pro_en_vente .' En vente(s) <br>'.$count_pro_vendu.' Vendu(s)' ?></p>
            <p><?php echo $donnee1['solde'].' $'; ?></p>
            <?php
            }
                    ?>
                
        </section>  
        <div class="links">
            <a href="usermodif.php"><i class="fa fa-user-times"></i></a>
             <a href="adduser.php"><i class="fa fa-user-plus"></i></a>
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