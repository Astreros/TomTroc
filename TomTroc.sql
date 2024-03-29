-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 mars 2024 à 13:24
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tom_troc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `Id_books` int(11) NOT NULL,
  `title` varchar(144) DEFAULT NULL,
  `author` varchar(32) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(2083) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL,
  `Id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`Id_books`, `title`, `author`, `description`, `image`, `available`, `creation_date`, `Id_users`) VALUES
(7, 'Esther', 'Alabaster', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/922f7d911d69633167d3700d8c0b3049.jpg', 1, '2024-02-22 06:31:08', 13),
(8, 'The Kinfolk Table', 'Nathan Williams', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis.\r\nVestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet.\r\nDonec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/books6606ae3aa74935.63061054.jpg', 1, '2024-02-22 06:34:21', 1),
(10, 'Wabi Sabi', 'Beth Kempton', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/2eba025f87376ad891749e6498f08159.jpg', 1, '2024-02-22 06:35:38', 14),
(11, 'Milk & honey', 'Rupi Kaur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/c2127b8e1bd993e0723f9cc276843351.jpg', 1, '2024-02-22 06:37:21', 15),
(12, 'Delight!', 'Justin Rossow', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/591aff1925779a945c9648ac61cda4d7.jpg', 0, '2024-02-22 06:38:20', 16),
(13, 'Milwaukee Mission', 'Elder Cooper Low', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/4f0a8f949ffc36f695d46fb1f5d7bf03.jpg', 1, '2024-02-22 06:39:15', 17),
(14, 'Minimalist Graphics', 'Julia Schonlau', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/0ee4a9630b344abb3078e4eff3186ea9.jpg', 1, '2024-02-22 06:40:07', 18),
(15, 'Hygge', 'Meik Wiking', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/da6cc3ce9ee4e8b5a9cac4e2e53a83ab.jpg', 1, '2024-02-22 06:41:17', 15),
(16, 'Innovation', 'Matt Ridley', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/0f1d67edb58b69cafaa38ea39005a1bc.jpg', 1, '2024-02-22 06:42:06', 19),
(17, 'Psalms', 'Alabaster', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/a109a46b5e0cf148e97698df6975a77f.jpg', 1, '2024-02-22 06:43:18', 20),
(18, 'Thinking, Fast & Slow', 'Daniel Kahneman', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/95a0e2fa468aa564a38f3a0273db72a9.jpg', 0, '2024-02-22 06:44:05', 21),
(19, 'A Book Full Of Hope', 'Rupi Kaur', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/abdfd0766947b1f1b4967977aa83e0fc.jpg', 1, '2024-02-22 06:45:05', 22),
(20, 'The Subtle Art Of Not Giving A Fuck', 'Mark Manson', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/1aa60bc03195e31d1c17e47ebf15fad9.jpg', 1, '2024-02-22 06:46:01', 23),
(21, 'Narnia', 'C.S Lewis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/1a3465192002e9a286b118265266fabb.jpg', 0, '2024-02-22 06:47:24', 24),
(22, 'Company Of One', 'Paul Jarvis', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/0728daaf9086e83746455168bdcedff6.jpg', 1, '2024-02-22 06:48:04', 25),
(23, 'The Two Towers', 'J.R.R Tolkien', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras nisi mi, porttitor nec urna ut, fermentum vestibulum metus. Aenean iaculis porttitor elit eget mollis. Vestibulum in molestie erat. Suspendisse mollis est augue, ac dignissim enim faucibus sit amet. Donec tincidunt orci sed placerat luctus. Vivamus luctus ex ut leo euismod hendrerit. Suspendisse potenti. Phasellus id tellus bibendum nulla accumsan egestas.', './images/books/dd86e7575ed179b0e0c5ab27b9d151c1.jpg', 1, '2024-02-22 06:49:22', 26),
(31, 'L\'Histoire sans fin', 'Michael Ende', 'L\'Histoire sans fin est un roman allemand de fantasy de Michael Ende publié en 1979. Le roman raconte l\'histoire d\'un jeune garçon qui vole un livre intitulé L\'Histoire sans fin, dans une librairie. Au fur et à mesure qu\'il avance dans la lecture du livre, il se retrouve lui-même faisant partie de la quête dont le but est de sauver le monde et les habitants du Pays Fantastique. ', './images/books/books65f1fce975c7a6.64362313.jpg', 1, '2024-03-13 20:22:17', 27);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `Id_messages` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `creation_date` datetime DEFAULT NULL,
  `Id_sender` int(11) NOT NULL,
  `Id_recipient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`Id_messages`, `content`, `is_read`, `creation_date`, `Id_sender`, `Id_recipient`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius aliquam est, eget cursus dolor scelerisque at. Pellentesque habitant morbi tristique senectus ', 0, '2024-03-13 20:10:08', 1, 18),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius aliquam est, eget cursus dolor scelerisque at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam ut ipsum sed elit placerat iaculis. Donec nec ligula blandit, rhoncus risus porttitor', 0, '2024-03-13 20:10:08', 18, 1),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius aliquam est, eget cursus dolor scelerisque at.', 0, '2024-03-13 20:11:40', 18, 1),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius aliquam est, eget cursus dolor scelerisque at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam ut ipsum sed elit placerat iaculis.', 0, '2024-03-13 20:11:40', 14, 1),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius aliquam est, eget cursus dolor scelerisque at. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nam ut ipsum sed elit placerat iaculis. Donec nec ligula blandit, rhoncus risus porttitor, interdum quam. Morbi eleifend sapien leo. Nunc vulputate efficitur commodo. Fusce vehicula, lorem in suscipit erat curae. ', 0, '2024-03-13 20:13:12', 1, 13),
(8, 'Ceci est un message test', 0, '2024-03-14 03:52:11', 1, 18),
(9, 'Ceci est un message test.', 0, '2024-03-14 03:52:56', 18, 1),
(10, 'Nouveau message test. 2024... *-/²&amp;&quot;&#039;(-è_ç_à))=$*ù!:;,,', 0, '2024-03-14 04:03:45', 1, 18),
(12, 'Test', 0, '2024-03-14 04:18:35', 1, 18),
(13, 'Ceci est une message test depuis le détail d&#039;un livre ', 0, '2024-03-15 22:20:19', 1, 17),
(14, 'Test 2', 0, '2024-03-16 10:28:44', 1, 18),
(15, 'Message test depuis livre', 0, '2024-03-16 10:33:34', 1, 20),
(16, 'Test', 0, '2024-03-22 08:04:57', 1, 20),
(17, 'Test', 0, '2024-03-29 12:47:16', 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Id_users` int(11) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `email` varchar(320) DEFAULT NULL,
  `password` varchar(72) DEFAULT NULL,
  `image` varchar(2083) DEFAULT NULL,
  `creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Id_users`, `username`, `email`, `password`, `image`, `creation_date`) VALUES
(1, 'Nathalire', 'nathalie@mail.com', '$2y$10$SeLVqYRMyoZIhLBRbZm2n.ZxL1mAN8nBhgz/5iAgpyavEIYQI.Hnq', './images/users/users6606a970ca9da9.44530793.jpg', '2024-02-15 17:11:08'),
(13, 'CamilleClubLit', 'camille@mail.com', '$2y$10$Qu2bRotoDE655ohsdujCDe7/F9MtLY.6ja4y.6zBNQ5ymgrcqa3rO', './images/users/marcos-paulo-prado-JcqAduMJI-E-unsplash.jpg', '2024-02-22 06:19:06'),
(14, 'Alexlecture', 'alex@mail.com', '$2y$10$pGMqb5MKOHSshlcwr6/VOu6CbinVPDYJqgTS9oTJjW3v/fPsLxzm6', './images/users/881fce26b8c1ef13143f6640479db593.jpg', '2024-02-22 06:19:38'),
(15, 'Hugo', 'hugo@mail.com', '$2y$10$WdNKQpUrGm7akzQnw5BCjudYlxKv1A/.MeTa.zMOvj5RAsR03/bie', './images/users/eugene-lagunov-sM_vkq6AKCc-unsplash.jpg', '2024-02-22 06:20:57'),
(16, 'Juju1432', 'juju@mail.com', '$2y$10$V2k1Ts5lalxSMGgo7BXtKO4z3pLJ4Jnz84AiaxXc9RvgDM6MgmfqW', './images/users/sincerely-media-rHDtPxVtMmI-unsplash.jpg', '2024-02-22 06:21:35'),
(17, 'Christiane75014', 'christiane@mail.com', '$2y$10$URCk2Uj2L7b3Vq2hvHpiAe6kkHSI6QMe2NSx04Ze7PgeyfKHC8Jgy', './images/users/vidisha-negi-gxkj436Mwxk-unsplash.jpg', '2024-02-22 06:22:12'),
(18, 'Hamzalecture', 'hamza@mail.com', '$2y$10$UhvlqXaGaYuByKOJfhDs/.KbB5JQddXcPY6rZoiPsgz.hjM.xaSL.', './images/users/adam-winger-aCajfuNQAN4-unsplash.jpg', '2024-02-22 06:22:50'),
(19, 'LouAndBen50', 'louandben@mail.com', '$2y$10$BG9CqgVg2oFMPgeoJmzcsOkGIAzElzvnRWDdp3I1.qfqYh.YKSvk2', NULL, '2024-02-22 06:23:29'),
(20, 'Lolobzh', 'lolo@mail.com', '$2y$10$k542fbMWUE/JwKm.5w9rnONDPouJuQPpXG9Q4PJ8l8/R6EIm9wSU.', './images/users/zoe-6A2SnXPE_lQ-unsplash.jpg', '2024-02-22 06:23:51'),
(21, 'Sas634', 'sas@mail.com', '$2y$10$0YmLHnAyMbxVFJDiOf73oO9jrfCdh8O8UHG.aN/qITflvp1mgRiT.', NULL, '2024-02-22 06:24:15'),
(22, 'ML95', 'ml95@mail.com', '$2y$10$1.QqNHZhfKdzU5Yui9x6WuhsDdzGNurobfngCc3Or9hPVRYLOO7sy', NULL, '2024-02-22 06:24:43'),
(23, 'Verogo33', 'verogo@mail.com', '$2y$10$VTGFRJMvxn3Ba7uXcsZWDudKQTy2GOHhGSFr4uUpSb7ytBuGsEkye', NULL, '2024-02-22 06:25:11'),
(24, 'AnnikaBrahms', 'annika@mail.com', '$2y$10$gOzXSIRE1GpAdG.INRBcuem6F.DGUwNpDBoLUo/2bgjs30OyaZjDC', './images/users/marga-santoso-Ydp6wLnrCs8-unsplash.jpg', '2024-02-22 06:25:38'),
(25, 'Victoirefabr912', 'victoire@mail.com', '$2y$10$dz9.GqA2kn2FaPiFiMnE2OwgPxo33AsZY3e72T5tRURYiJry09OE6', NULL, '2024-02-22 06:26:00'),
(26, 'Lotrfanclub67', 'lotrfanclub67@mail.com', '$2y$10$HPiAGeYWQJQhC0ON93vVi.9bW6pdX7TU7TDjS.PyN27AL3LHA.Bta', NULL, '2024-02-22 06:26:36'),
(27, 'PseudoTest1', 'pseudoTest1@mail.com', '$2y$10$G4iCTRhTfVFyj3RsqHxE/Ok8ZiFX2xDsnFUX4Q5B9BDXVLprqlLzS', NULL, '2024-03-13 20:17:22');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`Id_books`),
  ADD KEY `Id_users` (`Id_users`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`Id_messages`),
  ADD KEY `Id_sender` (`Id_sender`),
  ADD KEY `Id_recipient` (`Id_recipient`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id_users`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `Id_books` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `Id_messages` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `Id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`Id_users`) REFERENCES `users` (`Id_users`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`Id_sender`) REFERENCES `users` (`Id_users`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`Id_recipient`) REFERENCES `users` (`Id_users`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
