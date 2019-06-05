<?php
/**
 * Created by PhpStorm.
 * User: Wikonire
 * Date: 23.03.2018
 * Time: 13:53
 */

/*DROP DATABASE IF EXISTS bilderdb;
CREATE DATABASE bilderdb;
USE bilderdb;



	CREATE TABLE `galerie` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `GalerieName` varchar(50) NOT NULL,
 `FK_User` int(11) NOT NULL,
`is_Public` tinyint(1) NOT NULL DEFAULT 0,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

CREATE TABLE `bild` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `Pfad_BildGross` varchar(60) NOT NULL,
 `Pfad_BildKlein` varchar(60) NOT NULL,
 `FK_Galerie` int(11) NOT NULL,
 `Beschreibung` varchar(600) DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `Bild_Galerie_Constraint` (`FK_Galerie`),
 CONSTRAINT `Bild_Galerie_Constraint` FOREIGN KEY (`FK_Galerie`) REFERENCES `galerie` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



	CREATE TABLE `tag` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `tagText` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


	CREATE TABLE `tag_bild` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `FK_tagId` int(11) DEFAULT NULL,
 `FK_bildId` int(11) DEFAULT NULL,
 PRIMARY KEY (`id`),
 KEY `Tag_Constraint` (`FK_tagId`),
 KEY `Bild_Constraint` (`FK_bildId`),
 CONSTRAINT `Bild_Constraint` FOREIGN KEY (`FK_bildId`) REFERENCES `bild` (`id`),
 CONSTRAINT `Tag_Constraint` FOREIGN KEY (`FK_tagId`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `sessionID` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `sessionID` int(11) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	CREATE TABLE `user` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `nickname` varchar(30),
 `mailAdresse` varchar(40) NOT NULL,
 `passwort` varchar(255) NOT NULL,
 `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
`FK_sessionID` int(11) DEFAULT NULL,
`IsUserVisible` tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (`id`),
 UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;



	CREATE TABLE `galeriefreigegeben` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `FK_UserID` int(11) NOT NULL,
 `FK_GalerieID` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `GalerieFreigegeben_AnUser_Constraint` (`FK_UserID`),
 KEY `GalerieFreigegeben_Constraint` (`FK_GalerieID`),
 CONSTRAINT `GalerieFreigegeben_AnUser_Constraint` FOREIGN KEY (`FK_UserID`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `GalerieFreigegeben_Constraint` FOREIGN KEY (`FK_GalerieID`) REFERENCES `galerie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

//Dummy-Daten für Tag
/**
 *
 *
 Use bilderdb;
 INSERT INTO tag(tagText) VALUES('Pferd');
INSERT INTO tag(tagText) VALUES('Natur');
INSERT INTO tag(tagText) VALUES('Freunde');
INSERT INTO tag(tagText) VALUES('Strand');
INSERT INTO tag(tagText) VALUES('Tiere');
INSERT INTO tag(tagText) VALUES('Haustiere');
INSERT INTO tag(tagText) VALUES('kuschlig');
INSERT INTO tag(tagText) VALUES('to born to be wild');
INSERT INTO tag(tagText) VALUES('Landschaft');
INSERT INTO tag(tagText) VALUES('Makro');
INSERT INTO tag(tagText) VALUES('Fest');
INSERT INTO tag(tagText) VALUES('Liebe');
INSERT INTO tag(tagText) VALUES('Hunde');
INSERT INTO tag(tagText) VALUES('Katzen');
INSERT INTO tag(tagText) VALUES('Sonnenuntergang');
INSERT INTO tag(tagText) VALUES('Spiel');
INSERT INTO tag(tagText) VALUES('Spass');
INSERT INTO tag(tagText) VALUES('Ausflug');
INSERT INTO tag(tagText) VALUES('Reise');
INSERT INTO tag(tagText) VALUES('we will rock you!');
INSERT INTO tag(tagText) VALUES('Koflos');
INSERT INTO tag(tagText) VALUES('Prank');
INSERT INTO tag(tagText) VALUES('Familie');
INSERT INTO tag(tagText) VALUES('Tochter');
INSERT INTO tag(tagText) VALUES('Sohn');
INSERT INTO tag(tagText) VALUES('Ehemann');
INSERT INTO tag(tagText) VALUES('Ehefrau');
INSERT INTO tag(tagText) VALUES('Stark');
INSERT INTO tag(tagText) VALUES('Starker Tobak');
INSERT INTO tag(tagText) VALUES('Uuups...');
INSERT INTO tag(tagText) VALUES('Wie bitte?');
INSERT INTO tag(tagText) VALUES('Ich will nicht..!');
INSERT INTO tag(tagText) VALUES('Zitate');
INSERT INTO tag(tagText) VALUES('Sprüche');
INSERT INTO tag(tagText) VALUES('Wasser');
INSERT INTO tag(tagText) VALUES('Feuer');
INSERT INTO tag(tagText) VALUES('Schiff');
INSERT INTO tag(tagText) VALUES('Gemälde');
INSERT INTO tag(tagText) VALUES('Religion');
INSERT INTO tag(tagText) VALUES('Baum');
INSERT INTO tag(tagText) VALUES('Unfall');
INSERT INTO tag(tagText) VALUES('Arbeit');
INSERT INTO tag(tagText) VALUES('Party');
INSERT INTO tag(tagText) VALUES('Vergnügen');
INSERT INTO tag(tagText) VALUES('Recherche');
INSERT INTO tag(tagText) VALUES('Mathematik');
INSERT INTO tag(tagText) VALUES('Poesie');
INSERT INTO tag(tagText) VALUES('Exit');
INSERT INTO tag(tagText) VALUES('Zirkus');
INSERT INTO tag(tagText) VALUES('Früchte');
INSERT INTO tag(tagText) VALUES('Technologie');
INSERT INTO tag(tagText) VALUES('Forschung');
INSERT INTO tag(tagText) VALUES('Ornotologie');
INSERT INTO tag(tagText) VALUES('Yummy!');




DELETE FROM `galerie` WHERE `galerie`.`FK_User` = 17
 *
 */




