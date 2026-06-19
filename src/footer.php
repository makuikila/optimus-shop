<footer>  
    <ul>
    <div class="logo">
        <p class=""><img src="img/optimus.png" /></p>
        <h1>OPTIMUS <p class="shop">Shop</p></h1>
    </div>
        <li><a href="home.php" >Acceuil</a></li>
        <li id="ligne" class="dropdown">
            <a data-toggle="dropdown" href="#">Categories<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="detail.php?details=M">Mode</a></li>
                <li><a href="detail.php?details=I">Itech</a></li>
            </ul>
        </li>
        <li><a href="panier.php" >Panier <?php if($panier->count() !=0){?><span><?php echo($panier->count()); ?></span><?php } ?><i class="fa fa-cart-plus"></i></a></li>
        <div class="search">
                <form action="search.php" method ="POST">
                    <input name="search" id="search" placeholder="   Recherche..."/>
                    <button type="submit" name="" class="fa fa-search">
                    </button>
                </form>
            </div>
        <li><?php 
            $rep1 = $DB->connectBD()->query("SELECT * FROM users");
            while($donnee1 = $rep1->fetch()){
                if($donnee1['email'] == $_SESSION['online']){
                    $photo = $donnee1['photo_users'];
                    if($photo != null){
                        ?> <a href="profil.php"><img style="width: 30px; height: 30px; border-radius: 50%;
                            border: 1px solid black; background-size: cover;" src="img/profil/<?php echo $photo ?>"> </a>
                        
                        <?php
                    } else{
                        ?> <a href="profil.php"><img style="width: 30px; height: 30px; border-radius: 50%;
                        border: 1px solid black; background-size: cover;" src="img/profil/defaut.jpg" ></a>
                        <?php
                    }
                }
            } 
    ?>  </li>
    </ul>
</footer>
<script src="bootstrap/jquery/jquery-3.3.1.min.js"></script>
