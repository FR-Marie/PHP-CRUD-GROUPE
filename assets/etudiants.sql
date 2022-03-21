-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 mars 2022 à 13:58
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecole_assiamarie`
--

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id_etudiant` int(11) NOT NULL AUTO_INCREMENT,
  `nom_etudiant` varchar(255) NOT NULL,
  `prenom_etudiant` varchar(255) NOT NULL,
  `adresse_etudiant` varchar(255) NOT NULL,
  `avatar_etudiant` varchar(255) NOT NULL,
  `date_naissance_etudiant` datetime NOT NULL,
  `telephone_etudiant` varchar(255) NOT NULL,
  `email_etudiant` varchar(255) NOT NULL,
  `age_etudiant` int(11) NOT NULL,
  `formation_etudiant` varchar(255) NOT NULL,
  PRIMARY KEY (`id_etudiant`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id_etudiant`, `nom_etudiant`, `prenom_etudiant`, `adresse_etudiant`, `avatar_etudiant`, `date_naissance_etudiant`, `telephone_etudiant`, `email_etudiant`, `age_etudiant`, `formation_etudiant`) VALUES
(1, 'MOUNIER', 'Sylvain', '32 rue de berges 38000 GRENOBLE', '', '2022-03-21 13:49:09', '0658473298', 's.mounier@gmail.com', 40, 'développeur web et application'),
(2, 'BAHLOUL', 'Saida', '32 rue de berges 38000 GRENOBLE', '', '2022-03-21 13:49:09', '0639281745', 's.bahloul@gmail.com', 38, 'développeur web et application'),
(3, 'CALANDRI', 'Marine', '32 rue de berges 38000 GRENOBLE', '', '2022-03-21 13:49:09', '061236987452', 'm.calandri@gmail.com', 37, 'développeur web et application');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
