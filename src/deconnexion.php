<?php
session_start();
require 'session.class.php';
$connexion = new CONNEXION();
    $connexion->logout();
?>
    <script type="text/javascript"> 
        alert("Vous vous etes deconnecter");
            location.href='index.html';
    </script>
              