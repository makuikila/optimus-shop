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
    <link rel="stylesheet" href="css/search.css" />
    <title></title>
</head>
<body>
<section class="fond col-md-12 col-sm-12 col-xs-12">
        <li class="limg"><img src="img/f3.jpg" /></li>
        <section class="ombre col-md-12 col-sm-12 col-xs-12">
            <div>
                <h1><span>Recherche</span></h1>
                <p>Recherchez un produit de votre choix ou un autre abonné</p>
            </div>
        </section>
    </section>
    <section class="affmobile col-md-12 col-sm-12 col-xs-12">
        <section class="contenu col-md-12 col-sm-12 col-xs-12">

        <?php
        $connect = $_SESSION['online'];
        if (!empty($_POST['search'])) {
            /*$verif = $DB->connectBD()->query("SELECT * FROM users");
            while($auth = $verif->fetch()){

            }*/
            ?>
            <div class="personne col-md-12 col-sm-12 col-xs-12">
                <?php
                $sql = 'SELECT * FROM users';
                $recherche = $_POST['search'];
                $s = explode(" ", $recherche);
                $i=0; 
               
                foreach($s as $mot){
                    if (strlen($mot)>1){
                        if($i == 0){
                            $sql.=" WHERE ";
                        }
                        $sql.=" nom_users LIKE '%$mot%' or prenom_users LIKE '%$mot%' ";
                        $i++;
                          $sqlcount = $DB->connectBD()->query("SELECT count(*) FROM users WHERE nom_users LIKE '%$mot%' or prenom_users LIKE '%$mot%' ")->fetchColumn();
                                        
                            $rep1 = $DB->connectBD()->query($sql);
                            $rep = $DB->connectBD()->query("SELECT * FROM produit");
                            while($donnee1 = $rep1->fetch()){
                                $id = $donnee1['id'];
                                if($donnee1['email'] != $_SESSION['online']){
                                while($donnee = $rep->fetch()){
                                    if($donnee['id_users'] == $id){
                                        $photo = $donnee1['photo_users'];
                                        $nom = $donnee1['nom_users'];
                                        $prenom = $donnee1['prenom_users'];
                                        $email = $donnee1['email'];
                                        $count_pro_en_vente = $DB->connectBD()->query("SELECT COUNT(*) FROM produit where etat = 'en vente' and id_users = $id")->fetchcolumn();
                                        ?>
                                        
                                            <div id="aaa"><?php
                                            //verication du photo de profil de l'auteur
                                                if($photo != null or $photo != ''){
                                                    ?> 
                                                        <a href="users.php?user=<?php echo $id ?>">
                                                        <img src="img/profil/<?php echo $photo ?>"> </a> 
                                                        <?php
                                                } else{
                                                    ?>      <a href="users.php?user=<?php echo $id ?>">
                                                            <img src="img/profil/defaut.jpg" ></a> 
                                                            <?php
                                                }?>
                                                    <h4><?php echo strtoupper($nom) ?></h4>
                                                    <h4><?php echo strtoupper($prenom) ?> </h4>
                                                    <h4><?php echo $email ?></h4>
                                                    
                                                <h5><?php echo $count_pro_en_vente ?> Produit(s) en vente </h5>
                                            </div>
                                        
                                        <?php
                                      break;
                                    }
                                }   
                                
                            }                 
                        }  
                       
                    } 
                } 
                ?>
                </div></div>
                <div class="mode col-md-12 col-sm-12 col-xs-12">
                <?php
                $sql = 'SELECT * FROM produit';
                $recherche = $_POST['search'];
                $s = explode(" ", $recherche);
                $i=0; 
               
                foreach($s as $mot){
                    if (strlen($mot)>1){
                        if($i == 0){
                            $sql.=" WHERE ";
                        }
                        $sql.="description LIKE '%$mot%' and categorie = 'mode' and etat = 'en vente'";
                        $i++;              
                            $rep = $DB->connectBD()->query($sql);
                            $rep1 = $DB->connectBD()->query("SELECT * FROM users");
                            
                            while($donnee1 = $rep1->fetch()){
                                if($donnee1['email'] != $_SESSION['online']){
                                    while($donnee = $rep->fetch()){
                                        $id = $donnee['id_produit'];
                                        $photo = $donnee['photo'];
                                        ?>
                                            <a  href="userprod.php?id=<?php echo $id ?>&user=<?php echo $mot ?>"><img src="img/produits/<?php echo $photo ?>" alt=""></a>
                                        <?php                                   
                                    }   
                                }     
                            }   
                        }                
                    } 
                 
                    ?>
                    </div>
                    <div class="mode col-md-12 col-sm-12 col-xs-12">
                <?php
                $sql = 'SELECT * FROM produit';
                $recherche = $_POST['search'];
                $s = explode(" ", $recherche);
                $i=0; 
               
                foreach($s as $mot){
                    if (strlen($mot)>1){
                        if($i == 0){
                            $sql.=" WHERE ";
                        }
                        $sql.="etat = 'en vente' and description LIKE '%$mot%' and categorie = 'itech' ";
                        $i++;              
                            $rep = $DB->connectBD()->query($sql);
                            $rep1 = $DB->connectBD()->query("SELECT * FROM users");
                            while($donnee1 = $rep1->fetch()){
                                if($donnee1['email'] != $_SESSION['online']){
                                    while($donnee = $rep->fetch()){
                                        $id = $donnee['id_produit'];
                                        $photo = $donnee['photo'];
                                       
                                        ?>
                                            <a  href="users.php?id=<?php echo $id ?>&user=<?php echo $mot ?>"><img src="img/produits/<?php echo $photo ?>" alt=""></a>
                                        <?php
                                                                          
                                    }   
                                }     
                            }   
                                                
                        } 
                    } 
                } 
                    ?>
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