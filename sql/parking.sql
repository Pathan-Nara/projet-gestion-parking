-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 20 juin 2025 à 21:12
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `parking`
--

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `evaluation_id` int NOT NULL AUTO_INCREMENT,
  `note` int NOT NULL,
  `user_id` int NOT NULL,
  `parking_id` int NOT NULL,
  PRIMARY KEY (`evaluation_id`),
  KEY `eval_user_id` (`user_id`),
  KEY `eval_parking_id` (`parking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parkingtable`
--

DROP TABLE IF EXISTS `parkingtable`;
CREATE TABLE IF NOT EXISTS `parkingtable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `nb_places_voiture` int NOT NULL,
  `nb_places_velo` int NOT NULL,
  `nb_places_moto` int NOT NULL,
  `nb_places_camion` int NOT NULL,
  `lieu` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL,
  `note` float NOT NULL,
  `horaires` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parking_id` int NOT NULL,
  `type_place` enum('voiture','moto','velo','camion') NOT NULL,
  `reserved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_place_parking` (`parking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=165067 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `place_id` int NOT NULL,
  `user_id` int NOT NULL,
  `voiture_id` int NOT NULL,
  `arrive` int NOT NULL,
  `depart` int NOT NULL,
  `status` enum('en cours','annulée','terminée','') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prix` int NOT NULL,
  `archived` tinyint NOT NULL,
  `is_paid` tinyint NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `fk_reservation_place_id` (`place_id`),
  KEY `fk_reservation_voiture_id` (`voiture_id`),
  KEY `reservation_user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

DROP TABLE IF EXISTS `tarifs`;
CREATE TABLE IF NOT EXISTS `tarifs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `parking_id` int NOT NULL,
  `prix_par_heure` smallint NOT NULL,
  `prix_par_jour` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tarifs_parking_id` (`parking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` char(255) NOT NULL,
  `prenom` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `password` longtext NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_premium` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `is_admin`, `is_premium`) VALUES
(32, 'admin', 'admin', 'admin@admin.com', '$2y$10$/nR.mGPemA0BrhQXXi0nk.tUINog83.7FqquXCp4BeJcf3wpnxHH2', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
CREATE TABLE IF NOT EXISTS `voiture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `imatriculation` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `marque` text NOT NULL,
  `type` text NOT NULL,
  `motorisation` text NOT NULL,
  `model` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `voiture_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `eval_parking_id` FOREIGN KEY (`parking_id`) REFERENCES `parkingtable` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `eval_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `place`
--
ALTER TABLE `place`
  ADD CONSTRAINT `fk_place_parking` FOREIGN KEY (`parking_id`) REFERENCES `parkingtable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_reservation_place_id` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_voiture_id` FOREIGN KEY (`voiture_id`) REFERENCES `voiture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `tarifs`
--
ALTER TABLE `tarifs`
  ADD CONSTRAINT `fk_tarifs_parking_id` FOREIGN KEY (`parking_id`) REFERENCES `parkingtable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `voiture_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
