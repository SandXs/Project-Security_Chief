-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Gegenereerd op: 23 mei 2024 om 19:48
-- Serverversie: 5.7.39
-- PHP-versie: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secchief`
--
CREATE DATABASE IF NOT EXISTS `secchief` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `secchief`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(10) NOT NULL,
  `ticket_email` varchar(50) NOT NULL,
  `ticket_subject` varchar(50) NOT NULL,
  `ticket_type` int(2) NOT NULL,
  `ticket_content` text NOT NULL,
  `ticket_priority` int(1) NOT NULL,
  `ticket_response` text,
  `ticket_create_date` datetime DEFAULT NULL,
  `ticket_response_date` datetime DEFAULT NULL,
  `ticket_del` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_email`, `ticket_subject`, `ticket_type`, `ticket_content`, `ticket_priority`, `ticket_response`, `ticket_create_date`, `ticket_response_date`, `ticket_del`) VALUES
(35, 'archies559@gmail.com', 'dsdashjfbausbfja', 2, 'dsadn gjhbadyfbiy4yrawuyrbfeuwybfveabfs', 1, 'fsdagdsgasdgdsagsdagsag', '2023-11-28 11:26:10', NULL, 0),
(36, 'archies559@gmail.com', 'sfdags dhjbg', 2, 'dfsa ghjdsfsdaf', 0, NULL, '2023-11-28 11:28:55', NULL, 0),
(37, 'archies559@gmail.com', 'safdasgds', 2, 'dsagdsjfygjawygfyegwyfe', 2, NULL, '2023-11-29 10:30:42', NULL, 0),
(38, 'archies559@gmail.com', 'test', 2, 'AFdgasdgasgsdag', 0, NULL, '2023-11-29 02:54:16', NULL, 1),
(39, 'archies559@gmail.com', 'dsafasfdas', 1, 'ja oke', 2, NULL, '2023-12-05 08:33:32', NULL, 0),
(40, 'archies559@gmail.com', 'test', 1, 'Bedrijf: penis Naam: je mama je mama Inhoud: test', 0, NULL, '2024-03-20 08:56:58', NULL, 1),
(41, '', 'Test', 1, 'Testen is belangrijk', 2, NULL, '2024-05-23 06:57:40', NULL, 1),
(42, 'frankpeter@gmail.com', 'testen', 2, 'Bedrijf: 124tuinier Naam: frank peter Inhoud: test contact', 0, NULL, '2024-05-23 07:00:31', NULL, 0),
(43, '', 'sadsag', 1, 'fadsgdsgasger', 1, NULL, '2024-05-23 07:03:48', NULL, 1),
(44, '', 'sfadgdsga', 1, 'sgasdvcxivgdsiya', 0, NULL, '2024-05-23 07:04:57', NULL, 1),
(45, '', 'sfasbeguywe', 0, 'sfamsuyfgewuy', 1, NULL, '2024-05-23 07:05:56', NULL, 1),
(46, '', 'fdsag hjadsbfiew', 1, 'd askhfbhaf', 1, NULL, '2024-05-23 07:06:19', NULL, 1),
(47, '', 'test', 1, 'agteuifsiyabif', 1, NULL, '2024-05-23 07:12:07', NULL, 1),
(48, '', 'adsfa', 1, 'fsadgndsg ihew', 0, NULL, '2024-05-23 07:13:49', NULL, 1),
(49, 'test@gmail.com', 'fsuibaiusfbsf', 2, 'fds vajsd lfdsaf', 0, NULL, '2024-05-23 07:16:41', NULL, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `user_email` varchar(70) NOT NULL,
  `user_pass` varchar(70) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_company` varchar(50) NOT NULL,
  `user_is_admin` int(1) DEFAULT NULL,
  `user_del` int(1) DEFAULT NULL,
  `user_create_date` datetime DEFAULT NULL,
  `user_last_edited_date` datetime DEFAULT NULL,
  `user_is_new` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_pass`, `user_firstname`, `user_lastname`, `user_company`, `user_is_admin`, `user_del`, `user_create_date`, `user_last_edited_date`, `user_is_new`) VALUES
(4, 'archies559@gmail.com', '$2y$10$zfrhqTZim6FULyHoMul7ROvmXUCqzcBRfJkGOOKyjxskTXVCwD1cO', 'Archie', 'Sanders', 'Admin', 1, 0, '2023-12-05 11:45:50', '2023-12-06 03:02:47', 0),
(5, 'jackkartosh@gmail.com', '$2y$10$99jTSTpgTIWJfNT4ZQu/muSD/QBnhibJZhioMThDHNKWaO/FqNndq', 'Jack', 'Kartoush', 'Admin', 1, 0, '2023-12-06 12:26:16', NULL, 1),
(6, 'test@gmail.com', '$2y$10$dNVIKTWusiTRCwLdTS.11ud.T3W2XTizaq/TC.OPXvCvM9Oqb86pm', 'test', 'test', 'beterleren', 0, 0, '2024-05-23 07:08:40', '2024-05-23 07:11:53', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
