<?php 
session_start();
require '../bd.class.php';
$DB = new BD();
if($_SESSION['online']){

    // connexion a mes tables
    $rep1 = $DB->connectBD()->query("SELECT * FROM users");
    $rep = $DB->connectBD()->query("SELECT * FROM produit");
    $livre = $DB->connectBD()->query("SELECT *,date_format(date_paye, 'le %d/%m/%Y') as date_pro FROM livre");    
    
    while($acheteur = $livre->fetch()){
        
        //j'ai recupère les données de la table livre
        $id_livre = $acheteur['id'];
        $achat = $acheteur['acheteur'];
        $date = $acheteur['date_pro'];
        $methode = $acheteur['methode_paye'];

        //j'ai convertie de données de produits et vendeurs les string en array
        $produits_vendus = explode(',', $acheteur['produits']);
        $vendeur = explode(',', $acheteur['vendeurs']);

        //j'initialise deux nouveux array
        $abonne = array();
        $produit_stock = array();

        while($donnee1 = $rep1->fetch()){
            //j'insers des new valeurs dans l'array
            $id = $donnee1['id'];
            array_push($abonne, $id);
        }
        while($donnee = $rep->fetch()){
            //j'insers des new valeurs dans l'array
            $id = $donnee['id_produit'];
            array_push($produit_stock, $id);
        }
        //je comparer les deux tableau pour deceler des valeurs communes
        $commun_users = array_diff_assoc($vendeur, $abonne);
        $commun_pro = array_diff_assoc($produits_vendus, $produit_stock);

        //j'ai recupère toutes les données des tables users et produit en parsant avec une condition pour recuperer que les produit en communs
        $okay =  $DB->connectBD()->query("SELECT * FROM users inner join produit 
        on users.id = produit.id_users and id_produit IN(".implode(',', $commun_pro).")");
        
        while($ans = $okay->fetch()){
            if($ans['email'] != $_SESSION['online']){

                //données de l'auteur
                $photo = $ans['photo_users'];
                $nom = $ans['nom_users'];
                $prenom = $ans['prenom_users'];
                $email = $ans['email'];
                $num_banque = $ans['num_bancaire'];
                $id = $ans['id'];
                $solde_ini = $ans['solde'];

                //données sur le produit
                $photoproduit = $ans['photo'];
                $nomproduit = $ans['nom'];
                $prix = $ans['prix'];
                $description = $ans['description'];
                $categorie = $ans['categorie'];
                $id_prodiuit = $ans['id_produit']; 
               
                //j'ai calcul les benefices
                $benefice = ($prix * 1.33)/100;
                $prix_vente = $prix - $benefice; 
                $solde_fin = $solde_ini + $prix_vente;
                $transfert = $acheteur['transfert'];
                
                if($transfert == null){

                    //j'ai stock nos benefices dans une table
                    $req = $DB->connectBD()->prepare("INSERT INTO benefice (nom, prenom, email, benefice)
                    VALUES(:nom, :prenom, :email, :benefice)");
                    $rep = $req->execute(array(
                        'nom'  =>  $nom,
                        'prenom' => $prenom,
                        'email'  => $email,
                        'benefice' => $benefice
                    ));   
                    
                    //j'ai met a jour la table livre pour signaler qu'on a deja pris les benefices de cette transaction
                    $update = $DB->connectBD()->prepare('UPDATE livre SET transfert = :transfert where id = :id');
                    $update->execute(array(
                                'transfert' => 'success',
                                'id' => $id_livre
                            ));

                    //j'ai met a jour la table users en donnant a chacun son solde
                    $update2 = $DB->connectBD()->prepare('UPDATE users SET solde = :solde where id = :id');
                    $update2->execute(array(
                        'solde' => $solde_fin,
                        'id' => $id
                    ));

                    // on notifie au vendeur la vente de ses produits via email
                    $me = 'info@optimuscorp.com';
                    $to = $email;                    
                    $email_subject = "Paiement des produits sur la plateforme Optimus shop";
                    $email_body = "les dertail de la transaction. <br><br>"
                                ."Date : $date<br>
                                 Email : $to <br>
                                 Prix de vente : $prix $<br>
                                 Prix d'achat : $prix_vente $<br>
                                 Taxe : $benefice $ <br>
                                 Methode de paiement : $methode<br>
                                 Acheteur : $achat <br>
                                 transaction ID : 0000 $id_livre<br>";

                    $headers = "From : $me <br>";
                    $headers .= "Reply-To : $email";
                    
                    mail($to, $email_subject, $email_body, $headers);
                }
                ?>
                    <script type="text/javascript"> 
                        alert("Le transfert a reussi");
                        location.href='index.html';
                    </script>
                <?php
                
            }
            
        }
    }
    ?>
                   <script type="text/javascript"> 
                        alert("le transfert a été deja fait");
                        location.href='index.html';
                    </script>
                <?php
    
}      
else{
    
    header('Location: ../index.html');
}
?>