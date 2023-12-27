-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 25 déc. 2023 à 00:43
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

-- --------------------------------------------------------

--
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sa`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheter`
--

CREATE TABLE `acheter` (
  `ID_EL` int(11) NOT NULL,
  `ID_OFFRE` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `annee_scolaire`
--

CREATE TABLE `annee_scolaire` (
  `ID_ANNEE` int(11) NOT NULL,
  `ANNEE` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `annee_scolaire`
--

INSERT INTO `annee_scolaire` (`ID_ANNEE`, `ANNEE`) VALUES
(4, '2026/2025');

-- --------------------------------------------------------

--
-- Structure de la table `appartienir`
--

CREATE TABLE `appartienir` (
  `ID_OFFRE` int(11) NOT NULL,
  `ID_MAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `duree`
--

CREATE TABLE `duree` (
  `ID_DUREE` int(11) NOT NULL,
  `DUREE` varchar(128) DEFAULT NULL,
  `nb_jour` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `duree`
--

INSERT INTO `duree` (`ID_DUREE`, `DUREE`, `nb_jour`) VALUES
(2, 'louka', 90);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `ID_EL` int(11) NOT NULL,
  `ID_NIVEAUX` int(11) NOT NULL,
  `ID_SEC` int(11) DEFAULT NULL,
  `ID_ANNEE` int(11) NOT NULL,
  `NOM__EL` char(32) DEFAULT NULL,
  `NUM_TELE_EL` char(32) DEFAULT NULL,
  `MAIL_EL` char(32) DEFAULT NULL,
  `MDP_EL` char(32) DEFAULT NULL,
  `REDUCTION_EL` double(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `ID_MAT` int(11) NOT NULL,
  `NOM_MAT` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`ID_MAT`, `NOM_MAT`) VALUES
(2, 'math'),
(4, 'louka'),
(6, 'physique'),
(7, 'louka');

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

CREATE TABLE `niveaux` (
  `ID_NIVEAUX` int(11) NOT NULL,
  `NIVEAUX` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`ID_NIVEAUX`, `NIVEAUX`) VALUES
(1, 'bac'),
(4, '3éme');

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `ID_OFFRE` int(11) NOT NULL,
  `ID_DUREE` int(11) NOT NULL,
  `NOM_OFFRE` char(32) DEFAULT NULL,
  `PRIX_OFFRE` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

CREATE TABLE `prof` (
  `ID_PRO` int(11) NOT NULL,
  `ID_MAT` int(11) NOT NULL,
  `NOM_PRO` char(32) DEFAULT NULL,
  `NUM_TELE_PRO` char(32) DEFAULT NULL,
  `MAIL_PRO` char(32) DEFAULT NULL,
  `PART_PRO` double(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `section`
--

CREATE TABLE `section` (
  `ID_SEC` int(11) NOT NULL,
  `NOM_SEC` char(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `section`
--

INSERT INTO `section` (`ID_SEC`, `NOM_SEC`) VALUES
(8, 'louka'),
(9, 'louka'),
(10, 'louka'),
(11, 'louka'),
(12, 'louka');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `acheter`
--
ALTER TABLE `acheter`
  ADD PRIMARY KEY (`ID_EL`,`ID_OFFRE`),
  ADD KEY `I_FK_ACHETER_ELEVE` (`ID_EL`),
  ADD KEY `I_FK_ACHETER_OFFRE` (`ID_OFFRE`);

--
-- Index pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  ADD PRIMARY KEY (`ID_ANNEE`);

--
-- Index pour la table `appartienir`
--
ALTER TABLE `appartienir`
  ADD PRIMARY KEY (`ID_OFFRE`,`ID_MAT`),
  ADD KEY `I_FK_APPARTIENIR_OFFRE` (`ID_OFFRE`),
  ADD KEY `I_FK_APPARTIENIR_MATIERE` (`ID_MAT`);

--
-- Index pour la table `duree`
--
ALTER TABLE `duree`
  ADD PRIMARY KEY (`ID_DUREE`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`ID_EL`),
  ADD KEY `I_FK_ELEVE_NIVEAUX` (`ID_NIVEAUX`),
  ADD KEY `I_FK_ELEVE_SECTION` (`ID_SEC`),
  ADD KEY `I_FK_ELEVE_ANNEE_SCOLAIRE` (`ID_ANNEE`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`ID_MAT`);

--
-- Index pour la table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`ID_NIVEAUX`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`ID_OFFRE`),
  ADD KEY `I_FK_OFFRE_DUREE` (`ID_DUREE`);

--
-- Index pour la table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`ID_PRO`),
  ADD KEY `I_FK_PROF_MATIERE` (`ID_MAT`);

--
-- Index pour la table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`ID_SEC`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `acheter`
--
ALTER TABLE `acheter`
  MODIFY `ID_EL` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `annee_scolaire`
--
ALTER TABLE `annee_scolaire`
  MODIFY `ID_ANNEE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `appartienir`
--
ALTER TABLE `appartienir`
  MODIFY `ID_OFFRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `duree`
--
ALTER TABLE `duree`
  MODIFY `ID_DUREE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `ID_EL` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `ID_MAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `ID_NIVEAUX` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `ID_OFFRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prof`
--
ALTER TABLE `prof`
  MODIFY `ID_PRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `section`
--
ALTER TABLE `section`
  MODIFY `ID_SEC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `acheter`
--
ALTER TABLE `acheter`
  ADD CONSTRAINT `FK_ACHETER_ELEVE` FOREIGN KEY (`ID_EL`) REFERENCES `eleve` (`ID_EL`),
  ADD CONSTRAINT `FK_ACHETER_OFFRE` FOREIGN KEY (`ID_OFFRE`) REFERENCES `offre` (`ID_OFFRE`);

--
-- Contraintes pour la table `appartienir`
--
ALTER TABLE `appartienir`
  ADD CONSTRAINT `FK_APPARTIENIR_MATIERE` FOREIGN KEY (`ID_MAT`) REFERENCES `matiere` (`ID_MAT`),
  ADD CONSTRAINT `FK_APPARTIENIR_OFFRE` FOREIGN KEY (`ID_OFFRE`) REFERENCES `offre` (`ID_OFFRE`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `FK_ELEVE_ANNEE_SCOLAIRE` FOREIGN KEY (`ID_ANNEE`) REFERENCES `annee_scolaire` (`ID_ANNEE`),
  ADD CONSTRAINT `FK_ELEVE_NIVEAUX` FOREIGN KEY (`ID_NIVEAUX`) REFERENCES `niveaux` (`ID_NIVEAUX`),
  ADD CONSTRAINT `FK_ELEVE_SECTION` FOREIGN KEY (`ID_SEC`) REFERENCES `section` (`ID_SEC`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `FK_OFFRE_DUREE` FOREIGN KEY (`ID_DUREE`) REFERENCES `duree` (`ID_DUREE`);

--
-- Contraintes pour la table `prof`
--
ALTER TABLE `prof`
  ADD CONSTRAINT `FK_PROF_MATIERE` FOREIGN KEY (`ID_MAT`) REFERENCES `matiere` (`ID_MAT`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
