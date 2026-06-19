-- ============================================================================
-- seed_demo.sql — données fictives utilisées pour tester/illustrer le
-- correctif d'affichage des images (voir README, section "Known Issue & Fix").
-- À charger après schema.sql si vous voulez reproduire les captures avant/après.
-- ============================================================================

USE optimus_shop;

INSERT INTO users (nom_users, prenom_users, email, bio, mot_passe, photo_users, status, solde)
VALUES
('Demo','Vendeur','vendeur@demo.cd','Compte vendeur de demonstration','demo1234', NULL, 0, 0),
('Acheteur','Demo','acheteur@demo.cd','Compte acheteur de demonstration','demo1234', NULL, 0, 0);

-- Remplacez "produitN.jpg" par vos vraies photos une fois img/produits/ restauré.
INSERT INTO produit (nom, prix, categorie, description, photo, id_users, etat) VALUES
('Casque audio', 45, 'Audio', 'Casque sans fil, autonomie 20h, reduction de bruit active.', 'produit1.jpg', 1, 'en vente'),
('Sac a dos', 30, 'Mode', 'Sac a dos resistant a l eau avec compartiment laptop 15 pouces.', 'produit2.jpg', 1, 'en vente'),
('Clavier mecanique', 60, 'Tech', 'Clavier mecanique retroeclaire, switches rouges.', 'produit3.jpg', 1, 'en vente'),
('Montre connectee', 80, 'Tech', 'Montre connectee, suivi cardio et notifications.', 'produit4.jpg', 1, 'en vente');
