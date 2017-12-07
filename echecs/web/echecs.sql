-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 05 Décembre 2017 à 15:47
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `echecs`
--

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `g_id` int(11) NOT NULL,
  `g_user1_fk` int(11) NOT NULL,
  `g_user2_fk` int(11) NOT NULL,
  `g_tour` int(11) DEFAULT NULL,
  `g_currentPlayer` int(1) DEFAULT NULL,
  `g_firstPlayer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `game`
--

INSERT INTO `game` (`g_id`, `g_user1_fk`, `g_user2_fk`, `g_tour`, `g_currentPlayer`, `g_firstPlayer`) VALUES
(4, 4, 5, 2, 4, 4),
(17, 1, 4, 2, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `p_id` int(11) NOT NULL,
  `p_user_fk` int(11) DEFAULT NULL,
  `p_game_fk` int(11) DEFAULT NULL,
  `p_type` varchar(25) DEFAULT NULL,
  `p_X` int(11) DEFAULT NULL,
  `p_Y` int(11) DEFAULT NULL,
  `p_YDepart` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `piece`
--

INSERT INTO `piece` (`p_id`, `p_user_fk`, `p_game_fk`, `p_type`, `p_X`, `p_Y`, `p_YDepart`) VALUES
(49, 4, 4, 'roi', 3, 0, 0),
(50, 4, 4, 'reine', 4, 0, 0),
(51, 4, 4, 'pion', 0, 1, 0),
(52, 4, 4, 'pion', 1, 0, 0),
(53, 4, 4, 'pion', 6, 0, 0),
(54, 4, 4, 'pion', 7, 0, 0),
(55, 4, 4, 'cavalier', 2, 0, 0),
(56, 4, 4, 'cavalier', 5, 0, 0),
(57, 5, 4, 'roi', 3, 6, 7),
(58, 5, 4, 'reine', 4, 7, 7),
(59, 5, 4, 'pion', 0, 7, 7),
(60, 5, 4, 'pion', 1, 7, 7),
(61, 5, 4, 'pion', 6, 7, 7),
(62, 5, 4, 'pion', 7, 7, 7),
(63, 5, 4, 'cavalier', 2, 7, 7),
(64, 5, 4, 'cavalier', 5, 7, 7),
(258, 1, 17, 'reine', 4, 0, 0),
(259, 1, 17, 'pion', 0, 0, 0),
(260, 1, 17, 'pion', 1, 0, 0),
(261, 1, 17, 'pion', 6, 0, 0),
(262, 1, 17, 'pion', 7, 1, 0),
(263, 1, 17, 'cavalier', 2, 0, 0),
(264, 1, 17, 'cavalier', 5, 0, 0),
(265, 4, 17, 'roi', 3, 7, 7),
(266, 4, 17, 'reine', 4, 1, 7),
(267, 4, 17, 'pion', 0, 7, 7),
(268, 4, 17, 'pion', 1, 7, 7),
(269, 4, 17, 'pion', 6, 7, 7),
(270, 4, 17, 'pion', 7, 7, 7),
(271, 4, 17, 'cavalier', 2, 7, 7),
(272, 4, 17, 'cavalier', 5, 7, 7);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `u_id` int(11) NOT NULL,
  `u_pseudo` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`u_id`, `u_pseudo`) VALUES
(1, 'Arnaud'),
(5, 'Ernest'),
(4, 'Julie'),
(3, 'reerter'),
(2, 'Ronan'),
(6, 'Zozo-7');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`g_id`),
  ADD KEY `g_user1Id_fk` (`g_user1_fk`),
  ADD KEY `g_user2Id_fk` (`g_user2_fk`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `u_id` (`p_user_fk`),
  ADD KEY `FK_Piece_g_id` (`p_game_fk`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_pseudo` (`u_pseudo`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `game`
--
ALTER TABLE `game`
  ADD CONSTRAINT `game_ibfk_1` FOREIGN KEY (`g_user1_fk`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `game_ibfk_2` FOREIGN KEY (`g_user2_fk`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `piece`
--
ALTER TABLE `piece`
  ADD CONSTRAINT `FK_Piece_g_id` FOREIGN KEY (`p_game_fk`) REFERENCES `game` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `piece_ibfk_1` FOREIGN KEY (`p_user_fk`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
