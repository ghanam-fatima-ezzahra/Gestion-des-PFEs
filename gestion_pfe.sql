-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 20 avr. 2025 à 23:51
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_pfe`
--

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(255) NOT NULL,
  `chef_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `chef_id`) VALUES
(1, 'Systèmes de communications', NULL),
(2, 'Mathématiques,Informatique et Réseaux', NULL),
(3, 'Eléctronique,Micro ondes et Optique', NULL),
(6, 'Economie,Gestion,langues et Communications', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `enseignants`
--

CREATE TABLE `enseignants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(50) NOT NULL,
  `prenom` char(50) NOT NULL,
  `email` char(100) NOT NULL,
  `dept_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `enseignants`
--

INSERT INTO `enseignants` (`id`, `nom`, `prenom`, `email`, `dept_id`) VALUES
(1, 'Elmansouri', 'Mohamed', 'Elmansouri@inpt.ac.ma', 1),
(2, 'Tribark', 'Abdlwahd', 'Tribark@inpt.ac.ma', 3),
(3, 'Dahchour', 'Mohamed', 'Dahchour@inpt.ac.ma', 2),
(6, 'Chefnaji', 'Houda', 'Chefnaji@inpt.ac.ma', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

CREATE TABLE `etudiants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` char(20) NOT NULL,
  `promotion` int(11) DEFAULT NULL,
  `nom` char(50) NOT NULL,
  `prenom` char(50) NOT NULL,
  `tel` char(50) DEFAULT NULL,
  `email` char(100) NOT NULL,
  `fil_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`id`, `matricule`, `promotion`, `nom`, `prenom`, `tel`, `email`, `fil_id`) VALUES
(2, '2023-SESNUM-002', 2023, 'Bouzidi', 'Sara', '0645678901', 'Bouzidi@inpt.ac.ma', 2),
(3, '2023-SMART-ICT-003', 2023, 'El Amrani', 'Nada', '0622030588', 'ElAmrani@inpt.ac.ma', 3),
(6, '2023-ICCN-004', 2023, 'Alaoui', 'Amine', '0679880122', 'Alaoui@inpt.ac.ma', 8);

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

CREATE TABLE `filieres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` char(255) NOT NULL,
  `dept_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coord_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`id`, `nom`, `dept_id`, `coord_id`) VALUES
(1, 'DATA', 2, 3),
(2, 'SESNUM', 3, 2),
(3, 'SMART-ICT', 1, 1),
(8, 'ICCN', 2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `messages_contact`
--

CREATE TABLE `messages_contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages_contact`
--

INSERT INTO `messages_contact` (`id`, `nom`, `email`, `sujet`, `message`, `date_envoi`) VALUES
(3, ' Alaoui Amine', 'Alaoui@inpt.ac.ma', 'PFE', 'j\\\' ai des problemes concernant la modification de mon PFE.', '2025-04-20 20:06:51');

-- --------------------------------------------------------

--
-- Structure de la table `pfes`
--

CREATE TABLE `pfes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `etudiant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `titre` char(255) NOT NULL,
  `resume` mediumtext DEFAULT NULL,
  `organisme` char(200) NOT NULL,
  `encadrant_ex` char(100) NOT NULL,
  `email_ex` varchar(100) DEFAULT NULL,
  `encadrant_in_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rapport` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `pfes`
--

INSERT INTO `pfes` (`id`, `etudiant_id`, `titre`, `resume`, `organisme`, `encadrant_ex`, `email_ex`, `encadrant_in_id`, `rapport`) VALUES
(1, 3, 'Développement d\'un système IoT', 'Création d\'un système IoT pour la gestion intelligente.', 'Orange Maroc', 'Dr. El Mansouri', 'elmansouri@inpt.ac.ma', 1, 'rapport_iot.pdf'),
(3, 2, 'Sécurité des systèmes embarqués', '       Étude et sécurisation des systèmes embarqués en milieu industriel.', 'STMicroelectronics', 'Dr.Tribark', 'Tribark@inpt.ac.ma', 2, 'rapport_embarque.pdf'),
(5, 6, 'Optimisation des performances d\'un réseau de communication IoT à faible latence pour des applications critiques.', 'Dans ce projet, l\'objectif est d\'analyser et d\'optimiser un réseau de communication IoT (Internet des Objets) afin de réduire la latence et d\'améliorer la fiabilité des échanges de données.  ', 'INWI', 'Dr.Chefnaji', 'Chefnaji@inpt.ac.ma', 6, 'rapport_1.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `role` char(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`role`) VALUES
('Administrateur'),
('Enseignant'),
('Etudiant'),
('Visiteur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` char(50) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `user_id`) VALUES
(1, 'Elmansouri@inpt.ac.ma', 'ens123', 'Enseignant', 1),
(2, 'Tribark@inpt.ac.ma', 'ens123', 'Enseignant', 2),
(5, 'Bouzidi@inpt.ac.ma', 'etud123', 'Etudiant', 2),
(6, 'ElAmrani@inpt.ac.ma', 'etud123', 'Etudiant', 3),
(7, 'bouyahouda78@gmail.com', '$2y$10$98fM.vRM.AqQoPnH8nFtsO3JHQV2rCBnskmNym77XQzHxSuNet.ty', 'Visiteur', NULL),
(10, 'admin@inpt.ma', 'admin123', 'Administrateur', NULL),
(14, 'Chefnaji@inpt.ac.ma', 'ens', 'Enseignant', 6),
(16, 'Alaoui@inpt.ac.ma', '123', 'Etudiant', 6);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chef_id` (`chef_id`);

--
-- Index pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_dept` (`dept_id`);

--
-- Index pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matricule` (`matricule`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fil_id` (`fil_id`);

--
-- Index pour la table `filieres`
--
ALTER TABLE `filieres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coord_id` (`coord_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Index pour la table `messages_contact`
--
ALTER TABLE `messages_contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pfes`
--
ALTER TABLE `pfes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `encadrant_in_id` (`encadrant_in_id`),
  ADD KEY `etudiant_id` (`etudiant_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `etudiants`
--
ALTER TABLE `etudiants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `filieres`
--
ALTER TABLE `filieres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `messages_contact`
--
ALTER TABLE `messages_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `pfes`
--
ALTER TABLE `pfes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_ibfk_1` FOREIGN KEY (`chef_id`) REFERENCES `enseignants` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `enseignants`
--
ALTER TABLE `enseignants`
  ADD CONSTRAINT `fk_dept` FOREIGN KEY (`dept_id`) REFERENCES `departements` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `etudiants`
--
ALTER TABLE `etudiants`
  ADD CONSTRAINT `etudiants_ibfk_1` FOREIGN KEY (`fil_id`) REFERENCES `filieres` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `filieres`
--
ALTER TABLE `filieres`
  ADD CONSTRAINT `filieres_ibfk_1` FOREIGN KEY (`coord_id`) REFERENCES `enseignants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `filieres_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `departements` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `pfes`
--
ALTER TABLE `pfes`
  ADD CONSTRAINT `pfes_ibfk_1` FOREIGN KEY (`encadrant_in_id`) REFERENCES `enseignants` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pfes_ibfk_2` FOREIGN KEY (`etudiant_id`) REFERENCES `etudiants` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`role`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `enseignants` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
