
-- Base de données : `capteur`
-- ---- -- ------- - ---------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Création de la base

CREATE DATABASE IF NOT EXISTS `capteur`;
USE `capteur`;


-- Procédures

DELIMITER $$

CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listAllCarbon` ()  NO SQL
SELECT `Name`, `value`, `time`, `rssi`, `lat`, `lon`
FROM `data`
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
WHERE `measures`.idName = 2
ORDER BY `measures`.idMeasure
DESC$$

CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listAllOzonne` ()  NO SQL
SELECT `Name`, `value`, `time`, `rssi`, `lat`, `lon`
FROM `data`
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
WHERE `measures`.idName = 1
ORDER BY `measures`.idMeasure
DESC$$

CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listAllParticules` ()  NO SQL
SELECT `Name`, `value`, `time`, `rssi`, `lat`, `lon`
FROM `data`
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
WHERE `measures`.idName = 3
ORDER BY `measures`.idMeasure
DESC$$

CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listDataByCaptor` ()  NO SQL
SELECT `id`, `Name`, `value`, `rssi`, `lat`, `lon`, `time`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
WHERE 1
ORDER BY `measures`.idMeasure
DESC$$

DELIMITER ;


-- Structure des tables

CREATE TABLE `captors` (
  `idCaptor` int(11) NOT NULL COMMENT '[int(11)]',
  `id` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[char(128)]',
  `registerTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '[timestamp]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `captors` (`idCaptor`, `id`, `registerTime`) VALUES
(1, '80e1675869172200', '2020-03-30 13:46:32'),
(2, '8670b5b28f9d30b1', '2020-03-30 13:47:53'),
(3, 'c3f29743a21e6429', '2020-03-30 13:47:59');

-- --------------------------------------------------------

CREATE TABLE `data` (
  `idData` int(11) NOT NULL COMMENT '[int(11)]',
  `idCaptor` int(11) NOT NULL COMMENT '[int(11)]',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rssi` decimal(11,0) NOT NULL COMMENT '[dec(11,0)]',
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  `idMeasure` int(11) NOT NULL COMMENT '[int(11)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `data` (`idData`, `idCaptor`, `time`, `rssi`, `lat`, `lon`, `idMeasure`) VALUES
(1, 1, '2020-04-01 13:39:26', '-102', 43.5885, 1.42365, 1),
(2, 1, '2020-04-01 15:38:53', '-101', 43.5885, 1.42365, 2),
(3, 1, '2020-04-02 16:39:10', '-96', 43.5885, 1.42365, 3),
(4, 1, '2020-04-02 18:39:17', '-98', 43.5885, 1.42365, 4),
(5, 2, '2020-04-05 18:40:48', '-88', 43.6036, 1.40698, 5),
(6, 2, '2020-04-05 19:00:47', '-85', 43.6036, 1.40698, 6),
(7, 3, '2020-04-05 20:08:46', '-88', 43.5931, 1.45144, 7),
(8, 3, '2020-04-05 20:45:49', '-88', 43.5931, 1.45144, 8),
(9, 3, '2020-04-05 21:08:53', '-88', 43.5931, 1.45144, 9);

-- --------------------------------------------------------

CREATE TABLE `measures` (
  `idMeasure` int(11) NOT NULL COMMENT '[int(11)]',
  `idName` int(11) NOT NULL COMMENT '[int(11)]',
  `value` int(11) NOT NULL COMMENT '[int(11)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `measures` (`idMeasure`, `idName`, `value`) VALUES
(1, 2, 41568),
(2, 2, 41500),
(3, 2, 41530),
(4, 2, 41744),
(5, 1, 68),
(6, 1, 80),
(7, 3, 62),
(8, 3, 56),
(9, 3, 57);

-- --------------------------------------------------------

CREATE TABLE `measuresName` (
  `idName` int(11) NOT NULL COMMENT '[int(11)]',
  `Name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[char(64)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `measuresName` (`idName`, `Name`) VALUES
(2, 'CO2'),
(1, 'Ozonne'),
(3, 'Particules Fines');

-- --------------------------------------------------------

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `nichandle` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastConnect` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lastAddr` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Index des tables exportées

ALTER TABLE `captors`
  ADD PRIMARY KEY (`idCaptor`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `data`
  ADD PRIMARY KEY (`idData`),
  ADD KEY `FK_CAPTOR` (`idCaptor`),
  ADD KEY `FK_MEASURE` (`idMeasure`);

ALTER TABLE `measures`
  ADD PRIMARY KEY (`idMeasure`),
  ADD KEY `FK_NAME` (`idName`),
  ADD KEY `idName` (`idName`);

ALTER TABLE `measuresName`
  ADD PRIMARY KEY (`idName`),
  ADD UNIQUE KEY `Name` (`Name`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `nichandle` (`nichandle`);


-- AUTO_INCREMENT des tables

ALTER TABLE `captors`
  MODIFY `idCaptor` int(11) NOT NULL AUTO_INCREMENT COMMENT '[int(11)]', AUTO_INCREMENT=4;

ALTER TABLE `data`
  MODIFY `idData` int(11) NOT NULL AUTO_INCREMENT COMMENT '[int(11)]', AUTO_INCREMENT=10;

ALTER TABLE `measures`
  MODIFY `idMeasure` int(11) NOT NULL AUTO_INCREMENT COMMENT '[int(11)]', AUTO_INCREMENT=10;

ALTER TABLE `measuresName`
  MODIFY `idName` int(11) NOT NULL AUTO_INCREMENT COMMENT '[int(11)]', AUTO_INCREMENT=4;

ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;


-- Contraintes des tables exportées

ALTER TABLE `data`
  ADD CONSTRAINT `FK_CAPTOR` FOREIGN KEY (`idCaptor`) REFERENCES `captors` (`idCaptor`),
  ADD CONSTRAINT `FK_MEASURE` FOREIGN KEY (`idMeasure`) REFERENCES `measures` (`idMeasure`);

ALTER TABLE `measures`
  ADD CONSTRAINT `FK_NAME` FOREIGN KEY (`idName`) REFERENCES `measuresName` (`idName`);


-- END
