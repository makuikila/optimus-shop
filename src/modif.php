<?php 
session_start();
require 'bd.class.php';
require 'panier.class.php';
$DB = new BD();
$panier = new panier($DB);
    if($_SESSION['online']){
        ?>
<!DOCTYPE h
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/addproduit.css" />

    <title>OPTIMUS Shop/login</title>
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
            <div class="second col-md-6 col-sm-6 col-xs-6">
            <form class="editer" action="modif_post.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <nav>**Tous les champs sont obligatoires**</nav>
                    <div class="decision">
                        <div>
                            <label for="modifpro">Produit à modifier/retirer</label>
                            <select name="modifpro" id="">
                            <?php 
                                $rep = $DB->connectBD()->query("SELECT *, date_format(date_ajout, 'publier le %d/%m/%Y à %Hh') as date_pro FROM produit WHERE etat ='en vente'  order by id_produit  desc");
                                while($donnee = $rep->fetch()){
                                    if($donnee['email'] == $_SESSION['online']){
                                        echo('<option value="'.$donnee['id_produit'].'">'.strtoupper($donnee['nom']).' '.strtoupper($donnee['prix']).'$ 
                                        ('.$donnee['date_pro'].')</option>');
                                    }
                                }
                                ?>
                                </select>
                        </div>
                        <div>
                            <label for="decision">Decision</label>
                            <select name="decision" id="decision">
                                <option value="modifier">Modifier</option>
                                <option value="supprimer">Supprimer</option>
                            </select>
                        </div>
                    </div>
                    <div id="dispa1">
                        <div class="decision">
                            <input type="text" name="nom" id="tri" placeholder="Nom du produit" >
                            <input type="decimal" name="prix" id="tri" placeholder="Prix du produit" >
                        </div>
                        <label for="">Categorie</label>
                        <select name="categorie" id="cat">
                            <option value="itech">Itech</option>
                            <option value="mode">Mode</option>
                        </select>
                        <label for="">Description</label>
                        <textarea name="description" id="" rows="2" ></textarea>
                        <label for="">Photo du produit</label>
                        <input type="file" name='produit' id="" placeholder="" >
                    </div>
                   
            
                    <button type="submit" name="">Ajouter</button>
            </fieldset>
        </form>
        </div>
                </div>
        </section>
    </section>
        
    </section>
    <?php require 'footer.php'; ?>
    
    <script src="bootstrap/jquery/jquery-3.3.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
	<script>
        $(document).ready(function () {
        //declaration de variables
        var $decision = $('#decision'),
            $dispa1 = $('#dispa1');
          
            if ($decision.val() == 'supprimer') {
                    $dispa1.fadeOut(1);
                }
            else if ($decision.val() == 'modifier') {
                $dispa1.fadeIn('slow'); 
            }

            $decision.change(function () {
                if ($(this).val() == 'supprimer') {
                    $dispa1.fadeOut('slow'); 
                }
                else if ($(this).val() == 'modifier') {
                    $dispa1.fadeIn('slow'); 
                }
            });
        });
    </script>
</body>
</html>
<?php
}      
    else{
        
        header('Location: index.html');
    }
?>