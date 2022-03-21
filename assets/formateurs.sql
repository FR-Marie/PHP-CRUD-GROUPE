-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 21 mars 2022 à 14:57
-- Version du serveur : 8.0.27
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
-- Structure de la table `formateurs`
--

DROP TABLE IF EXISTS `formateurs`;
CREATE TABLE IF NOT EXISTS `formateurs` (
  `id_formateur` int NOT NULL AUTO_INCREMENT,
  `nom_formateur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `prenom_formateur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `adresse_formateur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `avatar_formateur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `date_naissance_formateur` datetime NOT NULL,
  `telephone_formateur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email_formateur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `age_formateur` int NOT NULL,
  `matiere_formateur` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_formateur`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `formateurs`
--

INSERT INTO `formateurs` (`id_formateur`, `nom_formateur`, `prenom_formateur`, `adresse_formateur`, `avatar_formateur`, `date_naissance_formateur`, `telephone_formateur`, `email_formateur`, `age_formateur`, `matiere_formateur`) VALUES
(1, 'MICHEL', 'Michael', '32, rue des Berges, 38000 GRENOBLE', 'assets/michaelM.png', '2022-03-21 12:48:47', '0606060606', 'm.michel-leformateurquidechire@gmail.com', 37, 'Développeur web'),
(2, 'BELLON', 'Laurent', '32, rue des Berges, 38000 GRENOBLE', 'assets/laurentB2.png', '2022-03-21 12:48:47', '0606060606', 'laurent-bellon@email.com', 37, 'Développeur web'),
(3, 'SCHUELLER', 'Benoît', '32, rue des Berges, 38000 GRENOBLE', 'assets/benoitS.png', '2022-03-21 12:59:50', '0606060606', 'benoit-schueller@email.com', 40, 'Directeur départemental ONLINE FORMAPRO'),
(4, 'PALERMO', 'Céline', '32, rue des Berges, 38000 GRENOBLE', 'assets/celineP.png', '2022-03-21 12:59:50', '0606060606', 'céline-palermo@email.com', 37, 'Conseillère insertion');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
