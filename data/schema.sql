CREATE DATABASE IF NOT EXISTS `picturedb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `picturedb`;

CREATE TABLE `user` (
  `uid` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nickname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL
);

