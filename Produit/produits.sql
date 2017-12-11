-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 08 Décembre 2017 à 16:30
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `produits`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `c_id` int(11) NOT NULL,
  `c_user_fk` int(11) DEFAULT NULL,
  `c_produit_fk` int(11) DEFAULT NULL,
  `c_prix` float NOT NULL,
  `c_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`c_id`, `c_user_fk`, `c_produit_fk`, `c_prix`, `c_date`) VALUES
(47, 1, 2, 20, '0000-00-00'),
(48, 1, 1, 360, '0000-00-00');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `p_id` int(11) NOT NULL,
  `p_nom` varchar(25) DEFAULT NULL,
  `p_prix` int(11) DEFAULT NULL,
  `p_poids` int(11) DEFAULT NULL,
  `p_largeur` float DEFAULT NULL,
  `p_hauteur` float DEFAULT NULL,
  `p_profondeur` float DEFAULT NULL,
  `p_installable` tinyint(1) DEFAULT NULL,
  `p_occasion` tinyint(1) DEFAULT NULL,
  `p_sold` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`p_id`, `p_nom`, `p_prix`, `p_poids`, `p_largeur`, `p_hauteur`, `p_profondeur`, `p_installable`, `p_occasion`, `p_sold`) VALUES
(1, 'Machine à Laver', 300, 40, 60, 80, 40, 1, 0, 1),
(2, 'Lampe de chevet', 20, 1, 10, 25, 10, 0, 1, 1),
(3, 'Frigo', 470, 80, 60, 180, 80, 1, 1, 0),
(4, 'table', 80, 9, 200, 70, 100, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `s_id` int(11) NOT NULL,
  `s_nom` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`s_id`, `s_nom`) VALUES
(1, 'livraison'),
(2, 'installation'),
(3, 'papier cadeau'),
(4, 'extension de garantie');

-- --------------------------------------------------------

--
-- Structure de la table `tarif`
--

CREATE TABLE `tarif` (
  `t_id` int(11) NOT NULL,
  `t_commande_fk` int(11) NOT NULL,
  `t_service_fk` int(11) NOT NULL,
  `t_montant` int(11) NOT NULL,
  `t_annees` int(11) NOT NULL,
  `t_message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tarif`
--

INSERT INTO `tarif` (`t_id`, `t_commande_fk`, `t_service_fk`, `t_montant`, `t_annees`, `t_message`) VALUES
(15, 47, 3, 0, 0, '0'),
(16, 48, 3, 0, 0, 'Bon anniversaire'),
(17, 48, 4, 60, 2, '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_mail` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_adresseLivraison` varchar(25) DEFAULT NULL,
  `u_nom` varchar(25) DEFAULT NULL,
  `u_prenom` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`u_id`, `u_mail`, `u_password`, `u_adresseLivraison`, `u_nom`, `u_prenom`) VALUES
(1, 'arnaud.ruffault@hotmail.fr', 'password', 'adresse de livraison', 'ruffault', 'arnaud');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `FK_commande_u_id` (`c_user_fk`),
  ADD KEY `FK_commande_p_id` (`c_produit_fk`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`s_id`);

--
-- Index pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `t_commande_fk` (`t_commande_fk`),
  ADD KEY `t_service_fk` (`t_service_fk`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `mail` (`u_mail`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_commande_p_id` FOREIGN KEY (`c_produit_fk`) REFERENCES `produit` (`p_id`),
  ADD CONSTRAINT `FK_commande_u_id` FOREIGN KEY (`c_user_fk`) REFERENCES `user` (`u_id`);

--
-- Contraintes pour la table `tarif`
--
ALTER TABLE `tarif`
  ADD CONSTRAINT `tarif_ibfk_1` FOREIGN KEY (`t_commande_fk`) REFERENCES `commande` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tarif_ibfk_2` FOREIGN KEY (`t_service_fk`) REFERENCES `service` (`s_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
