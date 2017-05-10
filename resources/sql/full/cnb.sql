/*
 Navicat Premium Data Transfer

 Source Server         : localhost Piscine
 Source Server Type    : MySQL
 Source Server Version : 50542
 Source Host           : localhost
 Source Database       : cnb

 Target Server Type    : MySQL
 Target Server Version : 50542
 File Encoding         : utf-8

 Date: 05/10/2017 15:14:03 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `cour`
-- ----------------------------
DROP TABLE IF EXISTS `cour`;
CREATE TABLE `cour` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `idHoraireCour` int(255) NOT NULL,
  `user` int(255) NOT NULL,
  `idLigne` int(11) NOT NULL,
  `droitImage` tinyint(1) NOT NULL,
  `paiement` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cour_horaire` (`idHoraireCour`),
  KEY `cour_ligne` (`idLigne`),
  KEY `cour_user` (`user`) USING BTREE,
  CONSTRAINT `cour_cour_horaire` FOREIGN KEY (`idHoraireCour`) REFERENCES `cour_horaire` (`id`),
  CONSTRAINT `cour_ligne_eau` FOREIGN KEY (`idLigne`) REFERENCES `ligne_eau` (`id`),
  CONSTRAINT `cour_user` FOREIGN KEY (`user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `cour_horaire`
-- ----------------------------
DROP TABLE IF EXISTS `cour_horaire`;
CREATE TABLE `cour_horaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTypeCour` int(11) NOT NULL,
  `dateDeDebut` date NOT NULL,
  `dateDeFin` date NOT NULL,
  `heureDeDebut` time NOT NULL,
  `heureDeFin` time NOT NULL,
  `nombreParticipants` int(255) NOT NULL DEFAULT '0',
  `prof1` int(255) NOT NULL,
  `prof2` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `type_cour` (`idTypeCour`),
  KEY `prof1` (`prof1`),
  KEY `prof2` (`prof2`),
  CONSTRAINT `cour_prof1` FOREIGN KEY (`prof1`) REFERENCES `user` (`id`),
  CONSTRAINT `cour_prof2` FOREIGN KEY (`prof2`) REFERENCES `user` (`id`),
  CONSTRAINT `cour_type` FOREIGN KEY (`idTypeCour`) REFERENCES `cour_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `cour_type`
-- ----------------------------
DROP TABLE IF EXISTS `cour_type`;
CREATE TABLE `cour_type` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `ligne_eau`
-- ----------------------------
DROP TABLE IF EXISTS `ligne_eau`;
CREATE TABLE `ligne_eau` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `seance`
-- ----------------------------
DROP TABLE IF EXISTS `seance`;
CREATE TABLE `seance` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `idCour` int(255) NOT NULL,
  `presence` tinyint(1) NOT NULL,
  `motifAbsence` varchar(255) NOT NULL DEFAULT 'pas de motif',
  `numeroSemaine` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seance_cour` (`idCour`),
  KEY `seance_numeroSemaine` (`numeroSemaine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `statut`
-- ----------------------------
DROP TABLE IF EXISTS `statut`;
CREATE TABLE `statut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statut` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `login` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `dateDeNaissance` date NOT NULL,
  `statut` int(8) NOT NULL,
  `dateDeCretificatMedical` date NOT NULL,
  `dateDeCreation` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateDeModification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `statut` (`statut`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user_adresse`
-- ----------------------------
DROP TABLE IF EXISTS `user_adresse`;
CREATE TABLE `user_adresse` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user` int(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `complement` varchar(255) NOT NULL,
  `codePostal` int(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user` (`user`),
  CONSTRAINT `user_adresse` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user_mail`
-- ----------------------------
DROP TABLE IF EXISTS `user_mail`;
CREATE TABLE `user_mail` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `principal` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user` (`user`),
  CONSTRAINT `user_mail` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user_phone`
-- ----------------------------
DROP TABLE IF EXISTS `user_phone`;
CREATE TABLE `user_phone` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user` int(255) NOT NULL,
  `phone` int(255) NOT NULL,
  `type` int(11) NOT NULL,
  `representaitLegal` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `user` (`user`),
  CONSTRAINT `user_phone` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

SET FOREIGN_KEY_CHECKS = 1;
