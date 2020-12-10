-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 déc. 2020 à 09:39
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reservationsalles`
--

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `debut` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `titre`, `description`, `debut`, `fin`, `id_utilisateur`) VALUES
(6, 'Rdv', 'rdv', '2020-12-03 09:00:00', '2020-12-03 11:00:00', 1),
(12, 'RDv', 'toto', '2020-12-04 11:00:00', '2020-12-04 13:00:00', 1),
(14, 'pipi', 'pipi', '2020-12-05 14:00:00', '2020-12-05 16:00:00', 3),
(15, 'toto', 'toto', '2020-12-04 17:00:00', '2020-12-04 19:00:00', 3),
(16, 'ruben', 'ruben', '2020-12-02 08:00:00', '2020-12-02 11:00:00', 7),
(17, 'test', 'test', '2020-12-08 09:00:00', '2020-12-08 11:00:00', 1),
(22, 'pipi', 'pipi', '2020-12-09 12:00:00', '2020-12-09 14:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'caca', '$2y$10$xlBTzxQ7RWoV1WMnDzyGn.xBLs6ZRKaEPosqO57.se9DQkfqcRNhW'),
(2, 'popo', '$2y$10$UDukmsGJVj8dSMV3jpe6Eu07GnKyvSNkONYHeREqtsVTtXY1eCqwS'),
(3, 'pipi', '$2y$10$5VMKvvgOK6PhsdKUPmNwlubXVrCeqEQhBTkymbxMkYBHVG4cBPL2a'),
(4, 'zizi', '$2y$10$oVUDFN/bqXlXeMCQCKVDSOCZludNRmGAXkzVB3YjoJornnM/1KYLO'),
(5, 'zeze', '$2y$10$LLf0ZN8EvDC4ZBWqz5lN9Of7oNjtg5UijS.66sFUefnr.6X.Qu3pK'),
(6, 'ruben', '$2y$10$dazQ6Nzhe7cmme9RHyYj2OENgvquPUnKWSNCA7a2Ns5GIPsLh7s.C'),
(7, 'rub', '$2y$10$mCsNQxDwrAWzb7SNvvwVfOwog5sGlEiqnK3AZWcz3d/bMFxow5O/i'),
(8, 'lolo', '$2y$10$Z2XJi4hz0Xmpaeut3uE6NOdNTj1t4yGaao/HowGKBrITE25whXUZ2'),
(9, 'remy', '$2y$10$gB.uNjbnKCow3r609rc6s.gg.CrWsKlsEI3s9GCGgssr6VT.hWWaq'),
(10, 'adrienleboss', '$2y$10$L6gLbftXY0E7GHpyJvphaOMw.FY.fmbZX3XsW/lHlQ4G3nfri9q8u');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
