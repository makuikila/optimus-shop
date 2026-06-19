<?php 
    class CONNEXION {
        
        public function login($email){
            $_SESSION['online'] = $email;
            return $_SESSION['online'];
        }

        public function logout(){
            unset($_SESSION['online']);
        }
    }
    
?> 