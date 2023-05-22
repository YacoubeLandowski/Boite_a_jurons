-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 05 mars 2023 à 17:46
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boite_a_jurons`
--

-- --------------------------------------------------------

--
-- Structure de la table `commettre`
--

CREATE TABLE `commettre` (
  `id_commettre` int(11) NOT NULL,
  `code_infraction` varchar(50) NOT NULL,
  `login_utilisateur` varchar(50) NOT NULL,
  `login_balance` varchar(50) NOT NULL,
  `date_infraction` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `infraction`
--

CREATE TABLE `infraction` (
  `code_infraction` varchar(50) NOT NULL,
  `categorie_infraction` varchar(50) NOT NULL,
  `tarif_infraction` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `infraction`
--

INSERT INTO `infraction` (`code_infraction`, `categorie_infraction`, `tarif_infraction`) VALUES
('code_1', 'retard', 0.1),
('code_2', 'petite insulte', 0.1),
('code_3', 'grosse insulte', 0.3),
('code_4', 'rot', 0.5),
('code_5', 'geste deplacé', 0.7);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_roles` int(11) NOT NULL,
  `type_roles` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_roles`, `type_roles`) VALUES
(1, 'admin'),
(2, 'normal');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `login_utilisateur` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT '../Users/photodefault/defaut.png',
  `id_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commettre`
--
ALTER TABLE `commettre`
  ADD PRIMARY KEY (`id_commettre`),
  ADD KEY `commettre_utilisateur0_FK` (`login_utilisateur`),
  ADD KEY `commettre_infraction` (`code_infraction`);

--
-- Index pour la table `infraction`
--
ALTER TABLE `infraction`
  ADD PRIMARY KEY (`code_infraction`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_roles`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`login_utilisateur`,`email`) USING BTREE,
  ADD KEY `utilisateur_Roles_FK` (`id_roles`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commettre`
--
ALTER TABLE `commettre`
  MODIFY `id_commettre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_roles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commettre`
--
ALTER TABLE `commettre`
  ADD CONSTRAINT `commettre_infraction` FOREIGN KEY (`code_infraction`) REFERENCES `infraction` (`code_infraction`),
  ADD CONSTRAINT `commettre_utilisateur` FOREIGN KEY (`login_utilisateur`) REFERENCES `utilisateur` (`login_utilisateur`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_Roles_FK` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id_roles`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
