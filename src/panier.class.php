<?php 
    class panier {
        private $DB;

        public function __construct($DB){
            if(!isset($_SESSION)){
                session_start(); 
            }
            if(!isset($_SESSION['panier'])){
                $_SESSION['panier'] = array();
            }
            $this->DB = $DB;
        }

        public function total(){
            $total = 0;
            $ids = array_keys($_SESSION['panier']);
            if(empty($ids)){
                $rep = array();
            }
            else{
                $rep = $this->DB->query('SELECT id_produit, prix FROM produit WHERE id_produit IN('.implode(',', $ids).')');
            }
            
            foreach ($rep as $sum){
                $total += $sum->prix;
            }
            return $total;
                        
        }

        public function add($produit_id){
            $_SESSION['panier'][$produit_id] = 1;
        }

        public function del($produit_id){
            unset($_SESSION['panier'][$produit_id]);
        }

        public function count(){
            return array_sum($_SESSION['panier']);
        }
    }
    
?> 