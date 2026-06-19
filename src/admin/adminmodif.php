<?php 
session_start();
require '../bd.class.php';
$DB = new BD();
    if($_SESSION['online']){
        ?>
<!DOCTYPE h
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="editer.css" />

    <title>OPTIMUS Shop/login</title>
    <style>
        .decision{
            grid-template-columns: 40% 5% 30% 5% 20%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top : 10px;
        }
        .decision div{
            width: 100%;
        }
        .decision select{
            width: 100%;
            height: 35px;
            border-radius: 5px;
            border: 1px solid rgb(160, 160, 160);
            margin-bottom: 10px;
        }
    </style>
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
            <nav>Modifier un profil</nav>
        </header>
        <div class="contenu">
        <form action="adminmodif_post.php" method="post" enctype="multipart/form-data">
            <fieldset>
            <nav>**tous les champs sont pertinents**</nav>
                <div class="decision">
                <div>
                    <label for="modif">Abonnées</label>
                    <select name="modif" id="">
                    <?php 
                    $rep1 = $DB->connectBD()->query("SELECT * FROM users WHERE status = 1  order by id  desc");
                    while($donnee = $rep1->fetch()){
                        if($donnee['email'] != $_SESSION['online']){
                            echo('<option value="'.$donnee['id'].'">'.
                            strtoupper($donnee['nom_users']).' '.strtoupper($donnee['prenom_users']).
                            '</option>');
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
                <div>
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="1">Admin</option>
                        <option value="0">Abonnée</option>
                    </select>
                </div>
                </div>
                <div id="dispa1">
                    <input type="text" name="nom" id="prenom" placeholder="Son nom">
                    <input type="text" name="prenom" id="prenom" placeholder="Son prenom">
                    <input type="email" name="email" id="prenom" placeholder="Son email">
                    <input type="text" name="num" id="prenom" placeholder="Son numero bancaire">
                    <input type="text" name="mot_passe" id="" placeholder="Son Mot de passe">
                    <label for="">Bio</label>
                    <textarea name="bio" id="" rows="2">Son bio</textarea>
                    <label for="">Photo de profil</label>
                    <input type="file" name='profil' id="">
                </div>
           
                <button type="submit" name="editer">Editer</button>
            </fieldset>
        </form>
        </div>
    </section>
    <script src="../bootstrap/jquery/jquery-3.3.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
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
        
        header('Location: ../index.html');
    }
?>