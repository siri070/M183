-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 13. Jun 2019 um 14:13
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
(1, 'test1', 'afadjsfaksdjfaskjdfökjasdföka', 2),
(2, '123123', '123123123123', 3),
(3, 'adsfasdf', 'asdfasdf', 7),
(4, 'Hallo Vithu', 'vithuuu', 11),
(9, '12333', '12333', 2),
(10, '123', '123', 2),
(11, 'asdfasdf', 'asdf', 2);

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
(2, 'lb3', 'lb3@iet-gibb.ch', '$2y$10$Z3RaT.fWM20iZfsuwXicZeBGF1rnWJVQtuIkMryY6eRd4TPtvUY06'),
(3, 'lb2', 'lb2@ddfa.ch', '$2y$10$5J7Hg3NdZxpwVltytJ9LCOEAjmgnh3FCxOzhvGYHKZ7h5ywknWyui'),
(4, 'irisBu', 'irisbur@hotmail.com', '$2y$10$FhhnwRdDHIek.Db1Zcu6POgZ9kyuLgrsiKZeLbnvXEsqkHRYpdBMC'),
(5, 'were', 'were@were.ch', '$2y$10$rHkDS38glgxPXrIEYaCJsOkhKAroSqnxQJntFnYUdN1uP3OS32Bga'),
(6, 'were1', 'were1@were.ch', '$2y$10$9SVP6HhU65/Auy7tSrZ5POO1jii9Brjk7Ko8aBKJg6stNHDBmUBKO'),
(7, 'test1', 'test1@1.ch', '$2y$10$u/n7YqS3N1eGB1nG6QHHVODECqkCxsfA0ZRXfw3U2I1EZ8vEqQRs.'),
(8, 'test12', 'test12@1.ch', '$2y$10$9kDWKWB9jx2pm56/stgTpuQR7ri7jwPPVjNt/t8tohVr1453AIK1i'),
(9, 'test123', 'test132@1.ch', '$2y$10$uP1ntUBS8JLTMLyZSwAcuO6Cjpt/xv/m05T7bOoZfcUKe34KssSga'),
(10, 'asdfasdf', 'asdf@ads.ch', '$2y$10$gbSB4QH6FJDgpCDPxKE/GuZKcZe5CLdWbewnNgX0BibVZ7Ez/JF.S'),
(11, 'vithu', 'vithu@vithu.ch', '$2y$10$xPrmE17jTKkpau4K08ADAuvZpQLWA8Ot6OzAfNhxo5zWDN7R.Cs6.');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user` (`uid`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
