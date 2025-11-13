-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : jeu. 13 nov. 2025 à 18:08
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `appdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Stock`
--

CREATE TABLE `Stock` (
  `S/N` varchar(50) NOT NULL,
  `Article` varchar(100) DEFAULT NULL,
  `Attribution` varchar(100) DEFAULT NULL,
  `NEUF/OCCASION` varchar(20) DEFAULT NULL,
  `Etat` varchar(50) DEFAULT NULL,
  `Garantie` varchar(50) DEFAULT NULL,
  `Date Inventaire` date DEFAULT NULL,
  `Date test appareil` date DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `Sortie stock` varchar(50) DEFAULT NULL,
  `Entrée stock` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Stock`
--

INSERT INTO `Stock` (`S/N`, `Article`, `Attribution`, `NEUF/OCCASION`, `Etat`, `Garantie`, `Date Inventaire`, `Date test appareil`, `Notes`, `Sortie stock`, `Entrée stock`) VALUES
('1s20LW000VFRPF16WMMH', 'X13', 'Non attribué', NULL, 'PRET A L EMPLOI', 'OUI', NULL, NULL, NULL, NULL, NULL),
('1s20LW000VFRPF1MD98D', 'L580 16Go', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20LW000VFRPF1PPH56', 'L580', 'Non attribué', 'OCCASION', 'DEEE', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20LXS00R00PF1F2LBC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1s20LXS00R00PF1F2W8X', 'L580 16Go', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20Q7000YFRPF1WQDK6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('1s20Q8S01R00PF1WV84M', 'L580', 'Non attribué', 'OCCASION', 'DEEE', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20U3004GFRPF31H4GB', 'L15 (Gen 1)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20U3004GFRPF33SFH6', 'L15 (Gen 1)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20U3004GFRPF33SFHW', 'L15 (Gen 1)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20U3004GFRPF37YEFN', 'L15 (Gen 1)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20U3004GFRPF38EFLX', 'L15 (Gen 1)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20U3004GFRPF38TPL5', 'L15 (Gen 1)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20U4S12U00PF2YK5LL', 'L15 (Gen 1)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('1s20X300GRFRPF3HLAQ8', 'L15 (Gen 2)', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('MP1YKM9W', '15G2', 'Non attribué', 'OCCASION', 'FONCTIONNEL', NULL, NULL, NULL, NULL, NULL, NULL),
('MP1YKNAX', '15G2', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('MP1YKP06', '15G2', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('MP1YKRLR', '15G2', 'Non attribué', 'OCCASION', 'PRET A L EMPLOI', NULL, NULL, NULL, NULL, NULL, NULL),
('PF2ZEMNG', 'L15 (Gen 1)', 'Non attribué', 'NEUF', 'PRET A L EMPLOI', 'NON', NULL, NULL, NULL, NULL, NULL),
('PF3HLAEB', 'L15 (Gen 2)', 'Non attribué', 'NEUF', 'PRET A L EMPLOI', 'OUI', NULL, NULL, NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Stock`
--
ALTER TABLE `Stock`
  ADD PRIMARY KEY (`S/N`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
