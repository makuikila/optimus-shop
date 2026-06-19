<?php
class panier {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Add product to session cart
    public function addPanier($id_produit) {
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }
        if (!in_array($id_produit, $_SESSION['panier'])) {
            $_SESSION['panier'][] = $id_produit;
        }
    }

    // Get cart contents from session
    public function getPanier() {
        return isset($_SESSION['panier']) ? $_SESSION['panier'] : [];
    }

    // Remove product from cart
    public function removePanier($id_produit) {
        if (isset($_SESSION['panier'])) {
            $key = array_search($id_produit, $_SESSION['panier']);
            if ($key !== false) {
                unset($_SESSION['panier'][$key]);
                $_SESSION['panier'] = array_values($_SESSION['panier']);
            }
        }
    }

    // Clear cart
    public function clearPanier() {
        unset($_SESSION['panier']);
    }
}
?>
