<?php 
session_start();
require 'bd.class.php';
require 'panier.class.php';
$DB = new BD();
$panier = new panier($DB);
if(isset($_GET['del'])){
    $panier->del($_GET['del']);
}
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
    <link rel="stylesheet" href="css/panier.css" />
    <title></title>
</head>
<body>
<section class="fond col-md-12 col-sm-12 col-xs-12">
        <li class="limg"><img src="img/f2.jpg" /></li>
        <section class="ombre col-md-12 col-sm-12 col-xs-12">
            <div>
                <h1><span>Panier</span></h1>
                <p>consultez les produits qui se trouvent dans votre panier</p>
            </div>
        </section>
    </section>
    <section class="affmobile col-md-12 col-sm-12 col-xs-12">
    <section class="contenu col-md-12 col-sm-12 col-xs-12">
    <div class="division">
        <p class="tete">Num</p>
        <p class="tete">Produit</p>
        <p class="tete">Nom</p>
        <p class="tete">Categorie</p>
        <p class="tete">Prix</p>
        <p class="tete">Retirer</p>
    <?php 
    if(isset($_GET['status'])){
        $statut = $_GET['status'];
        if($statut = 'success' && $_SESSION['panier']){
            $ids = array_keys($_SESSION['panier']);
            $inpanier = implode(',', $ids);
            $acheteur = $_SESSION['online'];
            $reference = $_GET['reference'];
            $methode = $_GET['Method'];
            $total = $panier->total();
            $quant = $panier->count();
            

            $okay =  $DB->connectBD()->query("SELECT * FROM users inner join produit on users.id = produit.id_users and id_produit IN(".implode(',', $ids).")");

            $num = 0;
            $totvend = array();
            while($ans = $okay->fetch()){
                if($ans['email'] != $_SESSION['online']){
                    //données de l'auteur
                    $id = $ans['id'];
                    array_push($totvend, $id);
                }
               
            }
                $vendeurs = implode(',', $totvend);

                //on enregistre la preuve du paiement
                $req = $DB->connectBD()->prepare("INSERT INTO livre(reference, methode_paye, acheteur, vendeurs, produits, quant_pro, total)
                    VALUES(:reference, :methode_paye, :acheteur, :vendeurs, :produits, :quant_pro, :total)");
                $req->execute(array(
                    'reference' => $reference,
                    'methode_paye' => $methode,
                    'acheteur' => $acheteur , 
                    'vendeurs' => $vendeurs,
                    'produits' => $inpanier,
                    'quant_pro' => $quant,
                    'total' => $total
                ));

                //on modifie l'etat du produit, now c'est vendu
                $rep = $DB->connectBD()->query("SELECT * FROM produit WHERE id_produit IN(".implode(',', $ids).")");
                while ($id2 = $rep->fetch()){
                    $id_produit = $id2['id_produit'];
                    foreach ($ids as $id2['id_produit']){
                        $update = $DB->connectBD()->prepare('UPDATE produit SET etat = :etat where id_produit = :id_produit');
                        $update->execute(array(
                            'etat' => 'vendu',
                            'id_produit' => $id_produit
                        ));
                        break;
                    }
                   
                }       
            }
            unset($_SESSION['panier']);
            ?>
                <script type="text/javascript"> 
                    alert("le paiement a reussi")
                        location.href='panier.php';
                </script>
                <?php
        }
        else{
            if($_SESSION['panier']){

                $ids = array_keys($_SESSION['panier']);
                if(empty($ids)){
                    $rep = array();
                }
                else{
                    $rep = $DB->connectBD()->query("SELECT * FROM produit WHERE id_produit IN(".implode(',', $ids).")");
                }
                $num = 1;
                while ($id2 = $rep->fetch()){
                    $identifiant = $id2['id_produit'];
                    foreach ($_SESSION['panier'] as $id2['id_produit']){
                        
                        ?>
                                <p><?php echo $num ?></p>
                                <p><img src="img/produits/<?php echo $id2['photo'] ?>" alt=""></p>
                                <p><?php echo $id2['nom'] ?></p>
                                <p><?php echo $id2['categorie'] ?></p>
                                <p><?php echo $id2['prix'] ?>$</p>
                                <p id="suka"><a href='panier.php?del=<?php echo $identifiant ?>'>
                                    <i class='fa fa-trash'></i>
                                </a></p>
                                <?php
                        break;
                    }
                    $num++;
                }?>
                <p class="total">Total</p>
                <p class="pied"></p>
                <p class="pied"></p>
                <p class="pied"></p>
                <p class="total"><?php echo $panier->total(); ?>$</p>
                <p class="pied"></p>
    
                <form  action= "https://api-testbed.maxicashapp.com/PayEntryPost" method="POST">
                    <input type="hidden" name="PayType" value="MaxiCash">
                    <input type="hidden" name="Amount" value="<?php echo $panier->total(); ?>00">
                    <input type="hidden" name="Currency" value="MaxiDollar">
                    <input type="hidden" name="Telephone" value="+243972062655}">
                    <input type="hidden" name="Email" value="geedookanda06@gmail.com">
                
                    <input type="hidden" name="MerchantID" value="d3d98108348643d19afad9beadce9b6e">
                    <input type="hidden" name="MerchantPassword" value="f868c8c5dc3740bcb2286c1924d81e65">
                    <input type="hidden" name="Language" value="Fr">
                    <input type="hidden" name="Reference" value="paiement des produits dans optimus shop">
                    <input type="hidden" name="accepturl" value="http://localhost/Optimus%20shop/panier.php">
                    <input type="hidden" name="cancelurl" value="http://localhost/Optimus%20shop/panier.php">
                    <input type="hidden" name="declineurl" value="http://localhost/Optimus%20shop/panier.php">
                    <input type="hidden" name="notifyurl" value="http://localhost/Optimus%20shop/panier.php">
                    <button class="valider" type="submit"><i class="fa fa-check-square-o "></i> Valider</button>
                </form>
                </div><?php
            }else{
               echo('</div><h3>le panier est vide, choisissez les produits en cliquant <a href="home.php">ici</a></h3>');
            }
        }
                ?>
                        
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