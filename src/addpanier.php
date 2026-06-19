<?php 
require 'bd.class.php';
require 'panier.class.php';
$DB = new BD();
$panier = new panier($DB);
$json = array('error' => true);
if(isset($_GET['id'])){
    $produit_id = $DB->query("SELECT id_produit FROM produit where id_produit=:id", array('id' =>$_GET['id']));
   if(empty($produit_id)){
        $json['message']= "Ce produit n'existe pas";
    }
    
    $panier->add($produit_id[0]->id_produit);
  
   ?>
    <script type="text/javascript"> 
            location.href='javascript:history.back()';
    </script>
<?php
}
else{
    echo("vous n'avez pas selectionner le produit");
}

?>