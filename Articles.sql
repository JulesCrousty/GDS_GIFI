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
-- Structure de la table `Articles`
--

CREATE TABLE `Articles` (
  `Article` varchar(100) NOT NULL,
  `Marque` varchar(100) DEFAULT NULL,
  `Type de matériel` varchar(100) DEFAULT NULL,
  `Type Client` varchar(100) DEFAULT NULL,
  `EAN` varchar(50) DEFAULT NULL,
  `P/N` varchar(50) DEFAULT NULL,
  `Processeur` varchar(100) DEFAULT NULL,
  `RAM` varchar(50) DEFAULT NULL,
  `Date fin de service` date DEFAULT NULL,
  `Nb de stock` int DEFAULT NULL,
  `Nb de stock Mat Fonctionnel` int DEFAULT NULL,
  `Nb de stock Mat prêt à lemploi` int DEFAULT NULL,
  `Alerte stock` int DEFAULT NULL,
  `Parametre Limite des stocks a etablir` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Articles`
--

INSERT INTO `Articles` (`Article`, `Marque`, `Type de matériel`, `Type Client`, `EAN`, `P/N`, `Processeur`, `RAM`, `Date fin de service`, `Nb de stock`, `Nb de stock Mat Fonctionnel`, `Nb de stock Mat prêt à lemploi`, `Alerte stock`, `Parametre Limite des stocks a etablir`) VALUES
('15G2', 'LENOVO', 'Ordinateur portable 15\"', 'Centrale GIFI', NULL, NULL, NULL, NULL, NULL, 4, 1, 3, NULL, NULL),
('L15 (Gen 1)', 'LENOVO', 'Ordinateur portable 15\"', 'Centrale GIFI', NULL, '20U3004GFR', 'I5', '8 Go', '2026-12-20', 8, 0, 8, NULL, NULL),
('L15 (Gen 2)', 'LENOVO', 'Ordinateur portable 15\"', 'Centrale GIFI', NULL, NULL, 'I5', '8 Go', NULL, 2, 0, 2, NULL, NULL),
('L580', 'LENOVO', 'Ordinateur portable 15\"', 'Centrale GIFI', NULL, '20LW000VFR', 'I5', '8 Go', '2024-09-06', 2, 0, 0, NULL, NULL),
('L580 16Go', 'LENOVO', 'Ordinateur portable 15\"', 'Centrale GIFI', NULL, NULL, 'I5', '16 Go', NULL, 2, 0, 2, NULL, NULL),
('X13', 'LENOVO', 'Ordinateur portable 13\"', 'Centrale GIFI', NULL, NULL, NULL, NULL, NULL, 1, 0, 1, NULL, NULL),
('X280', 'LENOVO', 'Ordinateur portable 13\"', 'Centrale GIFI', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`Article`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
