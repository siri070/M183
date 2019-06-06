-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Jun 2019 um 15:19
-- Server-Version: 10.1.34-MariaDB
-- PHP-Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `modul183`
--
CREATE DATABASE IF NOT EXISTS `modul183` DEFAULT CHARACTER SET utf32 COLLATE utf32_german2_ci;
USE `modul183`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blog`
--

DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf32_german2_ci NOT NULL,
  `text` varchar(500) COLLATE utf32_german2_ci NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_german2_ci;

--
-- Daten für Tabelle `blog`
--

INSERT INTO `blog` (`id`, `title`, `text`, `uid`) VALUES
(1, 'test1', 'afadjsfaksdjfaskjdfökjasdföka', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nickname` varchar(50) COLLATE utf32_german2_ci NOT NULL,
  `mailAdresse` varchar(50) COLLATE utf32_german2_ci NOT NULL,
  `passwort` varchar(200) COLLATE utf32_german2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_german2_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `nickname`, `mailAdresse`, `passwort`) VALUES
(1, 'iris', 'iris.bu@hotmail.com', '$2y$10$/NyqmHYJgugJ1GUdsELaCOd5W1eG/LjFt9c.9WjXGKHDscyhEFgPe'),
(2, 'lb3', 'lb3@iet-gibb.ch', '$2y$10$Z3RaT.fWM20iZfsuwXicZeBGF1rnWJVQtuIkMryY6eRd4TPtvUY06');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `FK_user` (`uid`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
