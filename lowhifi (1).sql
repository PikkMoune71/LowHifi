-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 12 Mars 2021 à 14:01
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lowhifi`
--

-- --------------------------------------------------------

--
-- Structure de la table `acheter`
--

CREATE TABLE `acheter` (
  `NumProd` varchar(6) NOT NULL,
  `NumAppro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `NumAppro` int(11) NOT NULL,
  `DateAppro` date DEFAULT NULL,
  `NumProd` varchar(6) DEFAULT NULL,
  `QteAch` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `approvisionnement`
--

INSERT INTO `approvisionnement` (`NumAppro`, `DateAppro`, `NumProd`, `QteAch`) VALUES
(1, '2021-02-27', 'TV001', '10'),
(2, '2021-03-06', 'CH102', '10');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `NumCat` varchar(4) NOT NULL,
  `LibCat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`NumCat`, `LibCat`) VALUES
('AMP0', 'Ampli home Cinéma'),
('CH0', 'Chaine Hifi - Mini'),
('CH1', 'Chaine Hifi - Composée'),
('DVD0', 'Lecteur DVD'),
('TV0', 'Téléviseurs LCD'),
('TV1', 'Téléviseurs Plasma');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `NumCli` int(11) NOT NULL,
  `NomCli` varchar(50) NOT NULL,
  `PrenomCli` varchar(50) NOT NULL,
  `MailCli` varchar(100) NOT NULL,
  `MdpCli` varchar(500) NOT NULL,
  `AdrCli` varchar(50) NOT NULL,
  `CPCLi` varchar(6) NOT NULL,
  `VilleCli` varchar(50) NOT NULL,
  `TelCli` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`NumCli`, `NomCli`, `PrenomCli`, `MailCli`, `MdpCli`, `AdrCli`, `CPCLi`, `VilleCli`, `TelCli`) VALUES
(1, 'Picard', 'Antoine', 'antoinepicard385@gmail.com', '$2y$12$HSZu1NmM6pw6ORRuihsFvu5jXAFYmZrJq8ptptB5T2iWZUGzz5QFW', 'rue des nanÃ§ats', '71640', 'Mellecey', '0615457847'),
(2, 'Admin', 'Admin', 'admin@gmail.com', '$2y$12$fVnUhgA0fwqfYwXxFkfVveWKsLbUbAMcvYQHvblkQJtZs4xn3f/3y', 'admin', '71640', 'Mellecey', '0615457847');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `NumCom` int(11) NOT NULL,
  `NumCli` int(5) DEFAULT NULL,
  `Statut` varchar(30) NOT NULL DEFAULT 'Non reglee'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`NumCom`, `NumCli`, `Statut`) VALUES
(294, 2, 'Non reglee'),
(295, 2, 'Non reglee'),
(296, 2, 'Non reglee'),
(297, 2, 'Non reglee'),
(298, 2, 'Non reglee'),
(299, 2, 'Non reglee'),
(300, 2, 'Non reglee'),
(301, 2, 'Non reglee'),
(302, 2, 'Non reglee'),
(303, 2, 'Non reglee'),
(304, 2, 'Non reglee'),
(305, 2, 'Non reglee'),
(306, 2, 'Non reglee'),
(307, 2, 'Non reglee'),
(308, 2, 'Non reglee'),
(309, 2, 'Non reglee'),
(310, 2, 'Non reglee'),
(311, 2, 'Non reglee'),
(312, 2, 'Non reglee'),
(313, 2, 'Non reglee'),
(314, 2, 'Non reglee'),
(315, 2, 'Non reglee'),
(316, 2, 'Non reglee'),
(317, 2, 'Non reglee'),
(318, 2, 'Non reglee'),
(319, 2, 'Non reglee'),
(320, 2, 'Non reglee'),
(321, 2, 'Non reglee'),
(322, 2, 'Non reglee'),
(323, 2, 'Non reglee'),
(324, 2, 'Non reglee'),
(325, 2, 'Non reglee'),
(326, 2, 'Non reglee'),
(327, 2, 'Non reglee'),
(328, 2, 'Non reglee'),
(329, 2, 'Non reglee'),
(330, 2, 'Non reglee'),
(331, 2, 'Non reglee'),
(332, 2, 'Non reglee'),
(333, 2, 'Non reglee'),
(334, 2, 'Non reglee'),
(335, 2, 'Non reglee'),
(336, 2, 'Non reglee'),
(337, 2, 'Non reglee'),
(338, 2, 'Non reglee'),
(339, 2, 'Non reglee'),
(340, 2, 'Non reglee'),
(341, 2, 'Non reglee'),
(342, 2, 'Non reglee'),
(343, 2, 'Non reglee'),
(344, 2, 'Non reglee'),
(345, 2, 'Non reglee'),
(346, 2, 'Non reglee'),
(347, 2, 'Non reglee'),
(348, 2, 'Non reglee'),
(349, 2, 'Non reglee'),
(350, 2, 'Non reglee'),
(351, 2, 'Non reglee'),
(352, 2, 'Non reglee'),
(353, 2, 'Non reglee'),
(354, 2, 'Non reglee'),
(355, 2, 'Non reglee'),
(356, 2, 'Non reglee'),
(357, 2, 'Non reglee'),
(358, 2, 'Non reglee'),
(359, 2, 'Non reglee'),
(360, 2, 'Non reglee'),
(361, 2, 'Non reglee'),
(362, 2, 'Non reglee'),
(363, 2, 'Non reglee'),
(364, 2, 'Non reglee'),
(365, 2, 'Non reglee'),
(366, 2, 'Non reglee'),
(367, 2, 'Non reglee'),
(368, 2, 'Non reglee'),
(369, 2, 'Non reglee'),
(370, 2, 'Non reglee'),
(371, 2, 'Non reglee'),
(372, 2, 'Non reglee'),
(373, 2, 'Non reglee'),
(374, 2, 'Non reglee'),
(375, 2, 'Non reglee'),
(376, 2, 'Non reglee'),
(377, 2, 'Non reglee'),
(378, 2, 'Non reglee'),
(379, 2, 'Non reglee'),
(380, 2, 'Non reglee'),
(381, 2, 'Non reglee'),
(382, 2, 'Non reglee'),
(383, 2, 'Non reglee'),
(384, 2, 'Non reglee'),
(385, 2, 'Non reglee'),
(386, 2, 'Non reglee'),
(387, 2, 'Non reglee'),
(388, 2, 'Non reglee'),
(389, 2, 'Non reglee'),
(390, 2, 'Non reglee'),
(391, 2, 'Non reglee'),
(392, 2, 'Non reglee'),
(393, 2, 'Non reglee'),
(394, 2, 'Non reglee'),
(395, 2, 'Non reglee'),
(396, 2, 'Non reglee'),
(397, 2, 'Non reglee'),
(398, 2, 'Non reglee'),
(399, 2, 'Non reglee'),
(400, 2, 'Non reglee'),
(401, 2, 'Non reglee'),
(402, 2, 'Non reglee'),
(403, 2, 'Non reglee'),
(404, 2, 'Non reglee'),
(405, 2, 'Non reglee'),
(406, 2, 'Non reglee'),
(407, 2, 'Non reglee'),
(408, 2, 'Non reglee'),
(409, 2, 'Non reglee'),
(410, 2, 'Non reglee'),
(411, 2, 'Non reglee'),
(412, 2, 'Non reglee'),
(413, 2, 'Non reglee'),
(414, 2, 'Non reglee'),
(415, 2, 'Non reglee'),
(416, 2, 'Non reglee'),
(417, 2, 'Non reglee'),
(418, 2, 'Non reglee'),
(419, 2, 'Non reglee'),
(420, 2, 'Non reglee'),
(421, 2, 'Non reglee'),
(422, 2, 'Non reglee'),
(423, 2, 'Non reglee'),
(424, 2, 'Non reglee'),
(425, 2, 'Non reglee'),
(426, 2, 'Non reglee'),
(427, 2, 'Non reglee'),
(428, 2, 'Non reglee'),
(429, 2, 'Non reglee'),
(430, 2, 'Non reglee'),
(431, 2, 'Non reglee'),
(432, 2, 'Non reglee'),
(433, 2, 'Non reglee'),
(434, 2, 'Non reglee'),
(435, 2, 'Non reglee'),
(436, 2, 'Non reglee'),
(437, 2, 'Non reglee'),
(438, 2, 'Non reglee'),
(439, 2, 'Non reglee'),
(440, 2, 'Non reglee'),
(441, 2, 'Non reglee'),
(442, 2, 'Non reglee'),
(443, 2, 'Non reglee'),
(444, 2, 'Non reglee'),
(445, 2, 'Non reglee'),
(446, 2, 'Non reglee'),
(447, 2, 'Non reglee'),
(448, 2, 'Non reglee'),
(449, 2, 'Non reglee'),
(450, 2, 'Non reglee'),
(451, 2, 'Non reglee'),
(452, 2, 'Non reglee'),
(453, 2, 'Non reglee'),
(454, 2, 'Non reglee'),
(455, 2, 'Non reglee'),
(456, 2, 'Non reglee'),
(457, 2, 'Non reglee'),
(458, 2, 'Non reglee'),
(459, 2, 'Non reglee'),
(460, 2, 'Non reglee'),
(461, 2, 'Non reglee'),
(462, 2, 'Non reglee'),
(463, 2, 'Non reglee'),
(464, 2, 'Non reglee'),
(465, 2, 'Non reglee'),
(466, 2, 'Non reglee'),
(467, 2, 'Non reglee'),
(468, 2, 'Non reglee'),
(469, 2, 'Non reglee'),
(470, 2, 'Non reglee'),
(471, 2, 'Non reglee'),
(472, 2, 'Non reglee'),
(473, 2, 'Non reglee'),
(474, 2, 'Non reglee'),
(475, 2, 'Non reglee'),
(476, 2, 'Non reglee'),
(477, 2, 'Non reglee'),
(478, 2, 'Non reglee'),
(479, 2, 'Payee'),
(480, 2, 'Payee');

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

CREATE TABLE `composer` (
  `NumCom` int(11) NOT NULL,
  `NumProd` varchar(6) NOT NULL,
  `QteCom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `composer`
--

INSERT INTO `composer` (`NumCom`, `NumProd`, `QteCom`) VALUES
(477, 'CH001', '1'),
(478, 'CH001', '1'),
(421, 'CH002', '1'),
(422, 'CH002', '1'),
(423, 'CH002', '1'),
(435, 'CH101', '1'),
(445, 'CH101', '1'),
(454, 'CH101', '1'),
(455, 'CH101', '3'),
(467, 'CH101', '1'),
(469, 'CH101', '3'),
(435, 'CH102', '4'),
(464, 'CH102', '1'),
(465, 'CH102', '4'),
(311, 'DVD001', '5'),
(312, 'DVD001', '41'),
(411, 'DVD001', '1'),
(414, 'DVD001', '1'),
(415, 'DVD001', '1'),
(294, 'TV001', '1'),
(295, 'TV001', '1'),
(296, 'TV001', '1'),
(297, 'TV001', '1'),
(298, 'TV001', '1'),
(299, 'TV001', '1'),
(300, 'TV001', '1'),
(301, 'TV001', '1'),
(302, 'TV001', '1'),
(303, 'TV001', '1'),
(304, 'TV001', '1'),
(305, 'TV001', '1'),
(306, 'TV001', '1'),
(311, 'TV001', '5'),
(419, 'TV001', '1'),
(427, 'TV001', '1'),
(428, 'TV001', '1'),
(429, 'TV001', '1'),
(430, 'TV001', '1'),
(431, 'TV001', '1'),
(432, 'TV001', '1'),
(433, 'TV001', '1'),
(434, 'TV001', '1'),
(435, 'TV001', '1'),
(294, 'TV002', '1'),
(295, 'TV002', '1'),
(296, 'TV002', '1'),
(297, 'TV002', '1'),
(298, 'TV002', '1'),
(299, 'TV002', '1'),
(300, 'TV002', '1'),
(301, 'TV002', '1'),
(302, 'TV002', '1'),
(303, 'TV002', '1'),
(304, 'TV002', '1'),
(305, 'TV002', '1'),
(306, 'TV002', '1'),
(307, 'TV002', '3'),
(308, 'TV002', '3'),
(309, 'TV002', '3'),
(310, 'TV002', '3'),
(320, 'TV002', '1'),
(321, 'TV002', '1'),
(322, 'TV002', '1'),
(323, 'TV002', '1'),
(343, 'TV002', '1'),
(400, 'TV003', '1'),
(477, 'TV003', '1'),
(478, 'TV003', '2'),
(480, 'TV003', '1'),
(399, 'TV004', '1'),
(407, 'TV004', '1'),
(479, 'TV004', '1'),
(480, 'TV004', '1'),
(317, 'TV101', '1'),
(318, 'TV101', '4'),
(319, 'TV102', '5'),
(472, 'TV102', '1'),
(474, 'TV102', '3'),
(324, 'TV103', '1'),
(326, 'TV103', '1'),
(420, 'TV104', '1'),
(421, 'TV104', '1'),
(422, 'TV104', '1'),
(423, 'TV104', '1'),
(453, 'TV104', '2'),
(479, 'TV104', '1');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `NumFour` varchar(3) NOT NULL,
  `NomFour` varchar(50) DEFAULT NULL,
  `AdrFour` varchar(50) DEFAULT NULL,
  `CPFour` varchar(6) DEFAULT NULL,
  `VilleFour` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`NumFour`, `NomFour`, `AdrFour`, `CPFour`, `VilleFour`) VALUES
('FR1', 'Europ\'TV', '12 rue d\'Alsace', '21000', 'Dijon'),
('FR2', 'France Audio', '8 rue de Frankfort', '71100', 'Chalon sur Saône'),
('FR3', 'Music Playground', '7 place Roosevelt', '71000', 'Macon'),
('FR4', 'Sony', '5 rue des oiseaux', '75000', 'Paris');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `NumProd` varchar(6) NOT NULL,
  `NomProd` varchar(50) DEFAULT NULL,
  `PrixProd` double DEFAULT NULL,
  `QteProd` int(11) DEFAULT NULL,
  `SeuilReappro` int(11) DEFAULT NULL,
  `Caracteristiques` varchar(255) DEFAULT NULL,
  `Couleur` varchar(50) DEFAULT NULL,
  `Largeur` float DEFAULT NULL,
  `Longueur` float DEFAULT NULL,
  `Profondeur` float DEFAULT NULL,
  `Poids` float DEFAULT NULL,
  `NumCat` varchar(4) DEFAULT NULL,
  `NumFour` varchar(3) DEFAULT NULL,
  `Imgsrc` text,
  `Catalogue` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`NumProd`, `NomProd`, `PrixProd`, `QteProd`, `SeuilReappro`, `Caracteristiques`, `Couleur`, `Largeur`, `Longueur`, `Profondeur`, `Poids`, `NumCat`, `NumFour`, `Imgsrc`, `Catalogue`) VALUES
('AMP001', 'SONY STR DH520', 169, 15, 5, '7x100 Watts', 'Noir', 21, 31.2, 22.5, 7.4, 'AMP0', 'FR3', 'ampli.jpg', 1),
('CH001', 'SONY MHC-Ex 700', 149, 13, 10, '2x200 Watts + MP3', 'Noir', 21, 31.2, 37.5, 5.4, 'CH0', 'FR3', 'hifisony.jpg', 1),
('CH002', 'PHILIPS FWM210', 129, 8, 10, '2x70 Watts + MP3', 'Noir', 22, 31.3, 25.8, 4.4, 'CH0', 'FR3', 'hifiphilips.jpg', 1),
('CH101', 'NAD C515 C316 Alpha B1', 509, 0, 20, '2x40Watts + MP3', 'Gris', 43.5, 7.9, 28.5, 5.5, 'CH1', 'FR3', 'hificomposesamsung.jpg', 1),
('CH102', 'ONKYO A9155 DX7355 S604', 609, 5, 20, '2x65Watts + MP3', 'Npor', 43.5, 12.1, 34.5, 6.8, 'CH1', 'FR3', 'hificomposeonkio.jpg', 1),
('DVD001', 'BRANDT BDVD 1290', 19, 6, 10, 'DVD + DVD-RW', 'Noir', 22.5, 4.5, 22, 0.8, 'DVD0', 'FR2', 'dvdbrandt.jpg', 1),
('DVD002', 'PHILIPS DVP3850', 29, 38, 10, 'DVD + DVD-RW + MP3 + DivX', 'Noir', 36, 4.2, 20.9, 1.3, 'DVD0', 'FR1', 'dvdphilips.jpg', 1),
('TV001', 'BRANDT B1913HD', 145, 0, 5, 'Ecran 48 cm, 1366x768 pixels + TNT HD', 'Noir', 34.8, 46, 15.5, 4.9, 'TV0', 'FR2', 'brandt.jpg', 1),
('TV002', 'Grundig Vision 3', 210, 0, 5, 'Ecran 66 cm, 1366x768 pixels + TNT HD', 'Gris', 49, 66.5, 17.8, 9.5, 'TV0', 'FR1', 'grunding.jpg', 1),
('TV003', 'Philips 32PFL3017H', 275, 2, 4, 'Ecran 81cm, 1920x1080 pixels + TNT HD', 'Noir', 52.6, 77.7, 22.2, 10.3, 'TV0', 'FR2', 'philips1.jpg', 1),
('TV004', 'WINDSOR WD4212T', 339, 8, 5, 'Ecran 106 cm, 1920x1080 pixels + TNT HD', 'Noir', 68.5, 101.5, 22, 19, 'TV0', 'FR1', 'windsort.jpg', 1),
('TV101', 'SAMSUNG PS43E450', 369, 0, 5, 'Ecran 109cm, 1024x768 pixels + TNT HD', 'Noir', 67.5, 101.2, 26.2, 15.4, 'TV1', 'FR1', 'samsung.jpg', 1),
('TV102', 'LG 42PA4500', 369, 0, 5, 'Ecran 107 cm, 1366x768 pixels + TNT HD', 'Gris', 65.5, 98.3, 24.7, 20.4, 'TV1', 'FR2', 'lg.jpg', 1),
('TV103', 'SAMSUNG PS51E490/3D', 569, 0, 2, 'Ecran 129 cm, 1024x768 pixels + TNT HD', 'Noir', 76, 118.8, 26.2, 20.8, 'TV1', 'FR1', 'samsung1.jpg', 1),
('TV104', 'SAMSUNG PS59D530', 749, 4, 2, 'Ecran 150 cm, 1920x1080 pixels + TNT HD', 'Noir', 89.5, 137.2, 33, 35.8, 'TV1', 'FR1', 'samsung2.jpg', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acheter`
--
ALTER TABLE `acheter`
  ADD PRIMARY KEY (`NumProd`,`NumAppro`),
  ADD KEY `NumAppro` (`NumAppro`);

--
-- Index pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD PRIMARY KEY (`NumAppro`),
  ADD KEY `NumProd` (`NumProd`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`NumCat`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`NumCli`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`NumCom`),
  ADD KEY `NumCli` (`NumCli`);

--
-- Index pour la table `composer`
--
ALTER TABLE `composer`
  ADD PRIMARY KEY (`NumProd`,`NumCom`),
  ADD KEY `NumCom` (`NumCom`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`NumFour`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`NumProd`),
  ADD KEY `NumCat` (`NumCat`),
  ADD KEY `NumFour` (`NumFour`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  MODIFY `NumAppro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `NumCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `NumCom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=481;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `acheter`
--
ALTER TABLE `acheter`
  ADD CONSTRAINT `acheter_ibfk_2` FOREIGN KEY (`NumProd`) REFERENCES `produit` (`NumProd`),
  ADD CONSTRAINT `acheter_ibfk_3` FOREIGN KEY (`NumAppro`) REFERENCES `approvisionnement` (`NumAppro`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`NumCli`) REFERENCES `client` (`NumCli`);

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `composer_ibfk_2` FOREIGN KEY (`NumProd`) REFERENCES `produit` (`NumProd`),
  ADD CONSTRAINT `composer_ibfk_3` FOREIGN KEY (`NumCom`) REFERENCES `commande` (`NumCom`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`NumCat`) REFERENCES `categorie` (`NumCat`),
  ADD CONSTRAINT `produit_ibfk_2` FOREIGN KEY (`NumFour`) REFERENCES `fournisseur` (`NumFour`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
