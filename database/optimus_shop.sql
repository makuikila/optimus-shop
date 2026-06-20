-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 07 juil. 2021 à 02:04
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `optimus_shop`
--

-- --------------------------------------------------------

--
-- Structure de la table `benefice`
--

DROP TABLE IF EXISTS `benefice`;
CREATE TABLE IF NOT EXISTS `benefice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paye` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(60) NOT NULL,
  `prenom` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `benefice` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `benefice`
--

INSERT INTO `benefice` (`id`, `date_paye`, `nom`, `prenom`, `email`, `benefice`) VALUES
(1, '2021-07-05 03:06:12', 'kanda', 'myoja', 'myoja@amazone.com', 1.6625),
(2, '2021-07-05 03:06:12', 'barandenge', 'rebecca', 'barandenge@yahoo.com', 0.3325),
(3, '2021-07-05 03:06:12', 'nzumba', 'christelle', 'nzumba@microsoft.com', 0.399),
(4, '2021-07-05 03:06:17', 'nzumba', 'christelle', 'nzumba@microsoft.com', 5.985),
(5, '2021-07-05 03:06:17', 'ndjadi', 'moise', 'ndjadi@gmail.com', 1.33);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_paye` datetime DEFAULT CURRENT_TIMESTAMP,
  `reference` text,
  `methode_paye` text,
  `acheteur` varchar(60) DEFAULT NULL,
  `vendeurs` varchar(255) DEFAULT NULL,
  `produits` varchar(255) DEFAULT NULL,
  `quant_pro` int(5) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `transfert` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `date_paye`, `reference`, `methode_paye`, `acheteur`, `vendeurs`, `produits`, `quant_pro`, `total`, `transfert`) VALUES
(1, '2021-06-29 01:44:38', 'paiement des produits dans optimus shop', 'CC', 'kanda@gmail.com', '6,4,5', '40,39,6', 3, 180, 'success'),
(2, '2021-07-04 12:46:42', 'paiement des produits dans optimus shop', 'CC', 'kasongo@icloud.com', '1,5,2', '37,35,25', 3, 700, 'success');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `date_ajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom` varchar(25) NOT NULL,
  `prix` int(11) NOT NULL,
  `categorie` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(500) NOT NULL,
  `id_users` int(11) NOT NULL,
  `etat` varchar(15) NOT NULL DEFAULT 'en vente',
  PRIMARY KEY (`id_produit`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `date_ajout`, `nom`, `prix`, `categorie`, `description`, `photo`, `id_users`, `etat`) VALUES
(18, '2021-09-16 01:49:27', 'iphone 8', 150, 'itech', 'iphone version 8 de la compagnie Appel sortie en 2018', 'iphone-8_150$_itech_1631749767_pexels-jess-bailey-designs-788946.jpg', 6, 'en vente'),
(11, '2021-09-09 16:45:24', 'Sika', 20, 'mode', 'chaussure de la marque congolaise SIKA, en noire avec une pointure de 45(Eu)', 'Sika_20$_mode_1631198724_hair-shoes-black-3709384__340.jpg', 5, 'en vente'),
(10, '2021-09-09 16:39:29', 'sac a main', 10, 'mode', 'sac a main du catalogue de Victoria secret collection 2007 en cuire chocolat', 'sac-a-main_10$_mode_1631198369_pexels-ge-yonk-1152077.jpg', 4, 'en vente'),
(9, '2021-09-09 16:32:04', 'nike', 25, 'mode', 'basket de la maison d\'edition Nike en rouge, avec la pointure de 43 (Eu)', 'Nike_25$_mode_1631198045_pexels-zain-ali-1027130', 3, 'en vente'),
(8, '2021-09-09 16:19:17', 'nike', 20, 'mode', 'timberlake de la maison d\'edition Nike en noir et black, avec la pointure de 43 (Eu)', 'Nike_20$_mode_1631197157_pexels-ray-piedra-1478442', 2, 'en vente'),
(6, '2021-09-09 12:48:32', 'sac a main et le manteau', 125, 'mode', 'sac a main et le manteau de la maison DOCHE GAVANA l\'edition 2017, vente en duo', 'sac-a-main-et-le-manteau_125$_mode_1631184512_yellow-and-black-leather-cross-body-bag-2002717.jpg', 6, 'vendu'),
(7, '2021-09-09 13:49:24', 'crepe', 15, 'mode', 'crepe simple en bleu avec une pointure de 39 (Eu)', 'crepe_15$_mode_1631188164_pexels-web-donut-19090.jpg', 1, 'en vente'),
(4, '2021-09-09 12:42:09', 'sac de sport', 20, 'mode', 'sac de sport tout terain pour vous accompagner dans vos aventures dans la nature', 'sac-de-sport_20$_mode_1631184129_pexels-matheus-bertelli-2905238.jpg', 4, 'en vente'),
(5, '2021-09-09 12:44:30', 'sika', 15, 'mode', 'chaussure de la marque congolaise SIKA, noire cemelle blanche avec une pointure de 42(Eu)', 'sika_15$_mode_1631184270_the-barbers-shoes-black-white-3709383_960_720.jpg', 5, 'en vente'),
(2, '2021-09-09 12:29:10', 'nike', 25, 'mode', 'basket de la maison d\'edition Nike', 'Nike_25$_mode_1631183350_pexels-melvin-buezo-2529148.jpg', 2, 'en vente'),
(3, '2021-09-09 12:36:37', 'soulier', 100, 'mode', 'soulier chocolat en peau de crocodile avec une pointure de 45(Eu)', 'soulier_100$_mode_1631183797_pexels-oluwaseun-duncan-186035.jpg', 3, 'en vente'),
(1, '2021-09-09 12:26:40', 'sac a main', 56, 'mode', 'sac a main du catalogue de Victoria secret edition 2019', 'sac-a-main_55.99$_mode_1631183200_pexels-dom-j-45981.jpg', 1, 'en vente'),
(19, '2021-09-16 01:51:22', 'mac pc', 520, 'itech', 'ordinateur publier par Apple avec 1T d\'espace memoire et 8 giga de ram sortie en 2015', 'mac-pc_520$_itech_1631749882_pexels-dzenina-lukac-930530.jpg', 1, 'en vente'),
(20, '2021-09-16 01:52:25', 'colier en or', 69, 'mode', 'colier en or brut de guchy edition 2015', 'colier-en-or_69$_mode_1631749945_pexels-castorly-stock-3641059.jpg', 2, 'en vente'),
(21, '2021-09-16 01:54:23', 'samsung S8', 100, 'itech', 'telephne (smartpohne) android version 9 samsung S8 avec 64 giga d\'espace memoire', 'samsung-S8_100$_itech_1631750063_pexels-pixabay-265658.jpg', 3, 'en vente'),
(22, '2021-09-16 01:55:41', 'colier en cristale', 15, 'mode', 'colier en cristale de doche gabana edition 2014', 'colier-en-cristale_15$_mode_1631750141_pexels-noelle-otto-906056.jpg', 4, 'en vente'),
(23, '2021-09-16 01:57:33', 'samsung S6', 90, 'itech', 'smartphone android samsung avec 32 giga d\'espace memoire', 'samsung-S6_90$_itech_1631750253_pexels-mohi-syed-47261.jpg', 5, 'en vente'),
(24, '2021-09-16 01:59:16', 'mac pc', 600, 'itech', 'ordinateur mac avec 1.5T d&quot;espace memoire et 12 giga de ram de la compagnie Apple', 'mac-pc_600$_itech_1631750356_pexels-fauxels-3184455.jpg', 6, 'en vente'),
(25, '2021-09-16 02:01:21', 'samsung dark', 150, 'itech', 'samsung dark avec une memoire de128giga et 16mpx de capture, sortie en 2020 par Samsung', 'samsung-dark_150$_itech_1631750481_pexels-noah-erickson-404280.jpg', 1, 'vendu'),
(26, '2021-09-16 02:03:01', 'bracelet en cuivre', 25, 'mode', 'bracelet en cuivre edition 2016 collection A5 de Victoria secret', 'bracelet-en-cuivre_25$_mode_1631750581_pexels-pixabay-266621.jpg', 2, 'en vente'),
(41, '2021-07-05 01:29:33', 'G.B.O.T', 1500, 'itech', 'un robot d\'aide menanger', 'G.B.O.T_1500$_itech_1625444973_pexels-alex-knight-2599244.jpg', 5, 'en vente'),
(28, '2021-09-16 02:06:46', 'colier en diamant', 612, 'mode', 'colier en diamant collectiobn privé de la reine victoria chaché depuis le 17 ème siecle', 'colier-en-diamant_612$_mode_1631750806_pexels-engin-akyurt-1458867.jpg', 4, 'en vente'),
(29, '2021-09-16 02:08:52', 'mac red', 358, 'itech', 'mac avec 250 de giga en memoire 4 giga de ram sortie en 2010 par Apple', 'mac-red_358$_itech_1631750932_pexels-designecologist-1779487 (1).jpg', 5, 'en vente'),
(30, '2021-09-16 02:10:33', 'iphone x', 200, 'itech', 'iphone x avec 128 giga en memoire et 4 giga de ram sortie en 2021 par Apple', 'iphone-x_200$_itech_1631751033_pexels-maksim-goncharenok-4348791.jpg', 6, 'en vente'),
(31, '2021-09-16 02:12:10', 'nokia T26', 120, 'itech', 'techno T26 avec 32 giga de memoire et 3 giga de ram sortie en 2020 par Techno', 'nokia-T26_120$_itech_1631751130_pexels-lisa-1092644.jpg', 1, 'en vente'),
(32, '2021-09-16 02:14:42', 'samsung A8+', 170, 'itech', 'samsung A8+ avec 128 giga de memoire et 4 de giga de ram sortie en 2019 pas Samsung', 'samsung-A8+_170$_itech_1631751282_pexels-omar-markhieh-1447254.jpg', 2, 'en vente'),
(33, '2021-09-16 02:16:40', 'iphone 8+', 220, 'itech', 'iphone 8+ avec 64 giga d\'espace 3 giga de ram avec duo core sortie en 2018 par Apple', 'iphone-8+_220$_itech_1631751400_pexels-math-249324.jpg', 3, 'en vente'),
(34, '2021-09-16 02:18:49', 'mac blue dark', 560, 'itech', 'ordinateur mac avec 350 giga d\'espace memoire et 6 giga de ram soritie en 2014 par Apple', 'mac-blue-dark_560$_itech_1631751529_pexels-designecologist-1999463.jpg', 4, 'en vente'),
(35, '2021-09-16 02:20:48', 'mac bureau', 450, 'itech', 'pc mac avec 500 giga d\'espace et 4 giga de ram par Apple', 'mac-bureau_450$_itech_1631751648_pexels-pixabay-38568.jpg', 5, 'vendu'),
(36, '2021-09-16 02:22:41', 'ip phone', 54, 'itech', 'ip phone poue la gestion des appels interne et externe de la boite via voip', 'ip-phone_54$_itech_1631751761_pbx-ip-sur-site-ou-heberge-lequel-vous-convient-le-mieux-377x220.jpg', 6, 'en vente'),
(37, '2021-09-16 02:24:28', 'itel SS6', 100, 'itech', 'itel SS6 avec 16 giga de memoire et 2 giga de ram sortie en 2017 par itel', 'itel-SS6_100$_itech_1631751868_pexels-tracy-le-blanc-607812.jpg', 2, 'vendu'),
(38, '2021-09-16 02:25:51', 'itel SS5', 90, 'itech', 'itel SS5 avec 16 giga de memoire 2 guga de ram sortie en 2015 par Itel', 'itel-SS5_90$_itech_1631751951_pexels-pixabay-163065.jpg', 3, 'en vente'),
(39, '2021-09-16 02:28:46', 'van chocolat', 25, 'mode', 'chaussure de la maison d\'edition vans en couleur chocolat avec une pointure de 40 (Eu)', 'van-chocolat_25$_mode_1631752126_pexels-mnz-1598508.jpg', 4, 'vendu'),
(40, '2021-09-16 02:30:30', 'vans noir', 30, 'mode', 'vans couleur semelle haute en blanc de la maison d\'edition 2016', 'vans-noir_30$_mode_1631752230_shoes-4973964__340.jpg', 5, 'vendu'),
(42, '2021-07-05 01:31:45', 'basket blache', 30, 'mode', 'chaussure relax mixte de la couleur blanche', 'basket-blache_30$_mode_1625445105_pexels-aman-jakhar-2048548.jpg', 4, 'en vente'),
(43, '2021-07-05 01:34:47', 'casque de RV', 350, 'itech', 'casque de réalité virtuelle qui vous ouvre les portes du vaste et merveiller monde virtuel', 'casque-de-RV_350$_itech_1625445287_pexels-andrea-piacquadio-834949.jpg', 3, 'en vente'),
(44, '2021-07-05 01:38:18', 'camera', 590, 'itech', 'une caméra haute définition qui vous permettra d\'avoir des bonnes prises', 'camera_590$_itech_1625445497_pexels-bruno-massao-2873486.jpg', 2, 'en vente'),
(45, '2021-07-05 01:56:57', 'talon blanc', 50, 'itech', 'chaussure pour femme de la maison victoria secret 2015', 'talon-blanc_50$_itech_1625446617_pexels-elegance-nairobi-3389419.jpg', 1, 'en vente'),
(46, '2021-07-05 01:58:09', 'nike chioco', 29, 'mode', 'chaussure pour homme de la maison Nike 2013', 'nike-chioco_29$_mode_1625446688_pexels-erik-mclean-4061385.jpg', 6, 'en vente'),
(47, '2021-07-05 01:59:58', 'mac XP', 450, 'itech', 'ordinateur mac avec 500Go de memoire, 8 de RAM, Duo 2.45Hz', 'mac-XP_450$_itech_1625446798_pexels-george-morina-4910951.jpg', 5, 'en vente'),
(48, '2021-07-05 02:01:32', 'drone SX4', 400, 'itech', 'drone de la 4 eme génération pour usage professionnel ', 'drone-SX4_400$_itech_1625446891_pexels-inmortal-producciones-336232.jpg', 4, 'en vente'),
(49, '2021-07-05 02:02:52', 'nike', 35, 'mode', 'chaussure pour homme de la maison Nike', 'nike_35$_mode_1625446972_pexels-melvin-buezo-2529147.jpg', 3, 'en vente'),
(50, '2021-07-05 02:04:06', 'nike doré', 50, 'mode', 'chaussure de luxe pour homme de la maison Nike', 'nike-dore_50$_mode_1625447046_pexels-ray-piedra-1537671.jpg', 2, 'en vente'),
(51, '2021-07-05 02:12:47', 'talon jaune', 69, 'mode', 'chaussure pour femme du catalogue de 2016 de victoria secret', 'talon-jaune_69$_mode_1625447566_pexels-scott-webb-137603.jpg', 1, 'en vente'),
(52, '2021-07-05 02:15:06', 'iwacth', 100, 'itech', 'montre intelligente  avec une mémoire interne qui vous permet de stocker votre musique et vous donne aussi la météo', 'iwacth_100$_itech_1625447705_pexels-pixabay-267394.jpg', 6, 'en vente'),
(53, '2021-07-05 02:16:42', 'camera de surveillance', 260, 'itech', 'camera de surveillance qui garantie vos intérêts ', 'camera-de-surveillance_260$_itech_1625447802_pexels-scott-webb-430208.jpg', 5, 'en vente'),
(54, '2021-07-05 02:21:05', 'nitendo', 60, 'itech', 'jeux  video avec deux manette en 3D', 'nitendo_60$_itech_1625448064_pexels-stas-knop-1462725.jpg', 4, 'en vente'),
(55, '2021-07-05 02:23:33', 'parinage', 350, 'mode', 'chaussure blanche pour le patinage artistique', 'parinage_350$_mode_1625448213_pexels-thomas-laukat-914996.jpg', 3, 'en vente'),
(56, '2021-07-05 02:24:38', 'nike jaune', 20, 'mode', 'chaussure pour homme de la maison nike', 'nike-jaune_20$_mode_1625448278_pexels-melvin-buezo-2529157.jpg', 2, 'en vente'),
(57, '2021-07-05 02:26:08', 'drone SX6', 700, 'itech', 'drone livreur pour faciliter vos livraison avec vos proches', 'drone-SX6_700$_itech_1625448368_pexels-pok-rie-724921.jpg', 1, 'en vente');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_inscrip` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nom_users` varchar(60) DEFAULT NULL,
  `prenom_users` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `bio` text,
  `mot_passe` varchar(20) DEFAULT NULL,
  `photo_users` varchar(100) DEFAULT NULL,
  `num_bancaire` varchar(25) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `solde` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `date_inscrip`, `nom_users`, `prenom_users`, `email`, `bio`, `mot_passe`, `photo_users`, `num_bancaire`, `status`, `solde`) VALUES
(1, '2021-09-09 16:25:57', 'kanda', 'geedoo', 'kanda@gmail.com', 'je suis faché', '123456789', 'kanda_geedoo_IMG-20191129-WA0000.jpg', '78965412357852', 0, NULL),
(2, '2021-09-09 16:28:26', 'ndjadi', 'moise', 'ndjadi@gmail.com', 'je suis franc', '123456789', 'ndjadi_moise_IMG-20190416-WA0004.jpg', '256987453158', 0, 98.67),
(3, '2021-09-12 00:35:52', 'kasongo', 'benoit', 'kasongo@icloud.com', NULL, '123456789', NULL, NULL, 0, NULL),
(4, '2021-09-16 02:38:35', 'barandenge', 'rebecca', 'barandenge@yahoo.com', 'je suis akeelah ', '123456789', 'barandenge_rebecca_GBWA-20190331114414.jpg', '78879542132139', 0, 24.6675),
(5, '2021-09-16 02:43:37', 'nzumba', 'christelle', 'nzumba@microsoft.com', 'je suis le camera women', '123456789', 'nzumba_christelle_GBWA-20190424154453.jpg', '213546879546213', 0, 473.616),
(6, '2021-09-16 02:45:28', 'kanda', 'myoja', 'myoja@amazone.com', 'je suis la chinoise', '123456789', 'kanda_myoja_GBWA-20190420153808.jpg', '75321469587564128', 0, 123.338),
(7, '2021-07-06 02:50:02', 'alikani', 'divina', 'alikane@optimuscorp.com', 'je suis la gerante', '123456789', 'alikani_divina_peacock-1246843__340.jpg', '123578965478', 1, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
