-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Mai 2018 à 17:38
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `name_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `name_categorie`) VALUES
(17, 'Jeu en ligne'),
(18, 'gamer');

-- --------------------------------------------------------

--
-- Structure de la table `panneau_index`
--

CREATE TABLE IF NOT EXISTS `panneau_index` (
  `id_produit_panneau` int(11) NOT NULL AUTO_INCREMENT,
  `nom_panneau` varchar(255) NOT NULL,
  `name_produit` varchar(255) NOT NULL,
  `nom_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_produit_panneau`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `panneau_index`
--

INSERT INTO `panneau_index` (`id_produit_panneau`, `nom_panneau`, `name_produit`, `nom_image`) VALUES
(6, 'promotions', 'bic', 'stylo_bic.jpg'),
(7, 'nouveau produit', 'gta', 'gta.jpg'),
(8, 'promotions', 'seroual loudia', 'seroual loudia.jpg'),
(9, 'promotions', 'telec', 'telec.jpg'),
(10, 'promotions', 'image_default', 'image_default.jpg'),
(11, 'promotions', 'cahier 96p', 'cahier_96p.jpg'),
(12, 'Produits 2019', 'Minecraft', 'Minecraft.jpg'),
(14, 'Produits 2019', 'fortnite', 'fortnite.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `name_produit` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `sous_categorie` varchar(255) NOT NULL,
  `price_buy` int(11) NOT NULL,
  `price_sell` int(11) NOT NULL,
  `description` text NOT NULL,
  `nom_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- Contenu de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `name_produit`, `categorie`, `sous_categorie`, `price_buy`, `price_sell`, `description`, `nom_image`) VALUES
(50, 'logo_default', '', '', 0, 0, 'inserer votre phrase de logo', 'logo_default.png'),
(51, 'image_default', '', '', 0, 0, 'inserer votre header', '12.jpg'),
(52, 'img_slider1', '', '', 0, 0, '', 'img_slider2.jpg'),
(53, 'img_slider3', '', '', 0, 0, '', 'img_slider3.jpg'),
(54, 'img_slider2', '', '', 0, 0, '', 'img_slider3.jpg'),
(55, 'produit1', 'gamer', 'Jeu en ligne', 3, 4, 'eeeeeeeeeeeeee', 'fortnite.jpg'),
(56, 'produit2', 'gamer', 'Jeu en ligne', 5, 6, 'fffffffffffffffffff', 'Minecraft.jpg'),
(57, 'produit3', 'gamer', 'Jeu en ligne', 3, 9, 'eeeeeeeeeeeee', 'gta.jpg'),
(63, 'c', 'gamer', 'Jeu en ligne', 3, 4, 'kkkkkkkkkkkkk', '12.jpg'),
(64, 'k', 'gamer', 'Jeu en ligne', 3, 9, 'pppppppppppp', 'im.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id_sous_cat` int(11) NOT NULL AUTO_INCREMENT,
  `name_cat` varchar(255) NOT NULL,
  `name_sous_cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_sous_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id_sous_cat`, `name_cat`, `name_sous_cat`) VALUES
(37, 'gamer', 'Jeu en ligne');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `validation` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id_user`, `username`, `email`, `telephone`, `password`, `rank`, `validation`) VALUES
(1, 'sidali', 'sidali@gmail.com', '0560093080', '123', 1, 0),
(2, 'samir', 'samir@gmail.com', '0550345678', '123', 0, 1),
(3, 'ourda', 'ourda@gmail.com', '024545656', '123', 0, 0),
(4, 'akila', 'akila@gmail.com', '3453453', '123', 0, 0),
(5, 'fateh', 'fateh@gmail.com', '02525252', '1234', 0, 1),
(6, 'krimou', 'k@gmail.com', '2222', '123', 0, 1),
(7, 'djamel', 'djamel@gm', '231', '123', 0, 1),
(8, 'kh', 'kh@g', '1234', '123', 0, 1),
(9, 'fares', 'fares@gmail.com', '2323', '123', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
