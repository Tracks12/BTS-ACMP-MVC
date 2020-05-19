
-- Base de données : `capteur`
-- ---- -- ------- - ---------

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


-- Création de la base

CREATE DATABASE IF NOT EXISTS `capteur`;
USE `capteur`;


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
	`name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[char(64)]',
	`unit` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[char(16)]',
	`unitMin` int(8) NOT NULL COMMENT '[int(8)]',
	`unitMax` int(8) NOT NULL COMMENT '[int(8)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `measuresName` (`idName`, `name`, `unit`, `unitMin`, `unitMax`) VALUES
	(1, 'Ozone', 'ppb', 0, 200),
	(2, 'CO2', 'ppm', 0, 1000),
	(3, 'Particules Fines', 'µg/m³', 0, 200);

-- --------------------------------------------------------

CREATE TABLE `users` (
	`idUser` int(11) NOT NULL COMMENT '[int(11)]',
	`nichandle` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(32)]',
	`mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(255)]',
	`password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(64)]',
	`lastConnect` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '[timestamp]',
	`lastAddr` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '[varchar(16)]',
	`isAdmin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '[bool(1)]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`idUser`, `nichandle`, `mail`, `password`, `lastConnect`, `lastAddr`, `isAdmin`) VALUES
	(1, 'admin', '', 'LJEgnJ4=', '2020-05-09 03:38:14', '', 1);


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
	ADD UNIQUE KEY `nichandle` (`nichandle`),
	ADD UNIQUE KEY `mail` (`mail`);


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


DELIMITER $$

-- Procédures

-- GetLastAllData
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `GetLastAllData` ()  NO SQL
SELECT `id`, `name`, `unit`, CASE
		WHEN `name` = "CO2" THEN `value` / 100
		ELSE `value`
	END AS `value`, `unitMin`, `unitMax`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
WHERE `measures`.idMeasure IN (
	SELECT MAX(`measures`.idMeasure)
	FROM `measures`
	JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
	WHERE `measuresName`.idName = 1
	UNION
	SELECT MAX(`measures`.idMeasure)
	FROM `measures`
	JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
	WHERE `measuresName`.idName = 2
	UNION
	SELECT MAX(`measures`.idMeasure)
	FROM `measures`
	JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
	WHERE `measuresName`.idName = 3
)
ORDER BY `measures`.idMeasure
DESC$$

-- GetLastData
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `GetLastData` (IN `id` VARCHAR(64) CHARSET utf8)  NO SQL
SELECT `id`, `name`, `unit`, CASE
		WHEN `name` = "CO2" THEN `value` / 100
		ELSE `value`
	END AS `value`, `unitMin`, `unitMax`
FROM `measures`
JOIN `data` ON `measures`.`idMeasure` = `data`.`idMeasure`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
WHERE `captors`.`id` = id
ORDER BY `measures`.idMeasure
DESC
LIMIT 1$$

-- listAllCarbon
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listAllCarbon` ()  NO SQL
SELECT `id`, `name`, `unit`, `value` / 100 AS `value`, `time`, `rssi`, `lat`, `lon`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
WHERE `measures`.idName = 2
ORDER BY `measures`.idMeasure
DESC$$

-- listAllOzonne
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listAllOzonne` ()  NO SQL
SELECT `id`, `name`, `unit`, `value`, `time`, `rssi`, `lat`, `lon`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
WHERE `measures`.idName = 1
ORDER BY `measures`.idMeasure
DESC$$

-- listAllParticules
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listAllParticules` ()  NO SQL
SELECT `id`, `name`, `unit`, `value`, `time`, `rssi`, `lat`, `lon`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
WHERE `measures`.idName = 3
ORDER BY `measures`.idMeasure
DESC$$

-- listDataByCaptor
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listDataByCaptor` ()  NO SQL
SELECT `id`, `name`, `unit`, CASE
		WHEN `name` = "CO2" THEN `value` / 100
		ELSE `value`
	END AS `value`, `rssi`, `lat`, `lon`, `time`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
WHERE 1
ORDER BY `measures`.idMeasure
DESC$$

-- listDataByOnceCaptor
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listDataByOnceCaptor` (IN `captor` VARCHAR(128) CHARSET utf8)  NO SQL
SELECT `id`, `name`, `unit`, CASE
		WHEN `name` = "CO2" THEN `value` / 100
		ELSE `value`
	END AS `value`, `rssi`, `lat`, `lon`, `time`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
WHERE `captors`.id = captor
ORDER BY `measures`.idMeasure
DESC$$

-- listLastDataByCaptor
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `listLastDataByCaptor` ()  NO SQL
SELECT `id`, `name`, `unit`, CASE
		WHEN `name` = "CO2" THEN `value` / 100
		ELSE `value`
	END AS `value`, `rssi`, `lat`, `lon`, `time`
FROM `data`
JOIN `captors` ON `captors`.idCaptor = `data`.idCaptor
JOIN `measures` ON `measures`.idMeasure = `data`.idMeasure
JOIN `measuresName` ON `measuresName`.idName = `measures`.idName
WHERE `measures`.idMeasure IN (
	SELECT MAX(`measures`.idMeasure)
	FROM `measures`
	JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
	WHERE `measuresName`.idName = 1
	UNION
	SELECT MAX(`measures`.idMeasure)
	FROM `measures`
	JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
	WHERE `measuresName`.idName = 2
	UNION
	SELECT MAX(`measures`.idMeasure)
	FROM `measures`
	JOIN `measuresName` ON `measures`.idName = `measuresName`.idName
	WHERE `measuresName`.idName = 3
)
ORDER BY `measures`.idMeasure
DESC$$

-- InsertNewUser
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `InsertNewUser` (IN `nichandle` VARCHAR(32) CHARSET utf8mb4, IN `mail` VARCHAR(255) CHARSET utf8mb4, IN `pass` VARCHAR(64) CHARSET utf8mb4, IN `admin` BOOLEAN)  NO SQL
	COMMENT 'Insert new user profile in users table'
INSERT INTO `users`(`nichandle`, `mail`, `password`, `lastAddr`, `isAdmin`) VALUES
	(nichandle, mail, ROT13(TO_BASE64(pass)), '', admin)$$

-- UpdatePasswordUser
CREATE DEFINER=`acmp`@`localhost` PROCEDURE `UpdatePasswordUser` (IN `id` INT(11), IN `pass` VARCHAR(64) CHARSET utf8mb4)  NO SQL
UPDATE `users`
SET `password`= ROT13(TO_BASE64(pass))
WHERE `idUser` = id$$


-- Fonctions

-- ROT13 Tranlator
CREATE DEFINER=`acmp`@`localhost` FUNCTION `ROT13` (`stringIn` VARCHAR(500) CHARSET utf8mb4) RETURNS VARCHAR(500) CHARSET utf8mb4 NO SQL
    COMMENT 'convert string to rot13'
BEGIN
	DECLARE v1 INT DEFAULT 1;
	DECLARE stringOut VARCHAR(200) DEFAULT '';
	DECLARE str VARCHAR(1) DEFAULT '';

	WHILE v1 <= LENGTH(stringIn) DO
		SET str = SUBSTR(stringIn,v1,1);
		CASE BINARY str
			WHEN 'A' THEN SET stringOut = CONCAT(stringOut, 'N');
			WHEN 'a' THEN SET stringOut = CONCAT(stringOut, 'n');
			WHEN 'B' THEN SET stringOut = CONCAT(stringOut, 'O');
			WHEN 'b' THEN SET stringOut = CONCAT(stringOut, 'o');
			WHEN 'C' THEN SET stringOut = CONCAT(stringOut, 'P');
			WHEN 'c' THEN SET stringOut = CONCAT(stringOut, 'p');
			WHEN 'D' THEN SET stringOut = CONCAT(stringOut, 'Q');
			WHEN 'd' THEN SET stringOut = CONCAT(stringOut, 'q');
			WHEN 'E' THEN SET stringOut = CONCAT(stringOut, 'R');
			WHEN 'e' THEN SET stringOut = CONCAT(stringOut, 'r');
			WHEN 'F' THEN SET stringOut = CONCAT(stringOut, 'S');
			WHEN 'f' THEN SET stringOut = CONCAT(stringOut, 's');
			WHEN 'G' THEN SET stringOut = CONCAT(stringOut, 'T');
			WHEN 'g' THEN SET stringOut = CONCAT(stringOut, 't');
			WHEN 'H' THEN SET stringOut = CONCAT(stringOut, 'U');
			WHEN 'h' THEN SET stringOut = CONCAT(stringOut, 'u');
			WHEN 'I' THEN SET stringOut = CONCAT(stringOut, 'V');
			WHEN 'i' THEN SET stringOut = CONCAT(stringOut, 'v');
			WHEN 'J' THEN SET stringOut = CONCAT(stringOut, 'W');
			WHEN 'j' THEN SET stringOut = CONCAT(stringOut, 'w');
			WHEN 'K' THEN SET stringOut = CONCAT(stringOut, 'X');
			WHEN 'k' THEN SET stringOut = CONCAT(stringOut, 'x');
			WHEN 'L' THEN SET stringOut = CONCAT(stringOut, 'Y');
			WHEN 'l' THEN SET stringOut = CONCAT(stringOut, 'y');
			WHEN 'M' THEN SET stringOut = CONCAT(stringOut, 'Z');
			WHEN 'm' THEN SET stringOut = CONCAT(stringOut, 'z');
			WHEN 'N' THEN SET stringOut = CONCAT(stringOut, 'A');
			WHEN 'n' THEN SET stringOut = CONCAT(stringOut, 'a');
			WHEN 'O' THEN SET stringOut = CONCAT(stringOut, 'B');
			WHEN 'o' THEN SET stringOut = CONCAT(stringOut, 'b');
			WHEN 'P' THEN SET stringOut = CONCAT(stringOut, 'C');
			WHEN 'p' THEN SET stringOut = CONCAT(stringOut, 'c');
			WHEN 'Q' THEN SET stringOut = CONCAT(stringOut, 'D');
			WHEN 'q' THEN SET stringOut = CONCAT(stringOut, 'd');
			WHEN 'R' THEN SET stringOut = CONCAT(stringOut, 'E');
			WHEN 'r' THEN SET stringOut = CONCAT(stringOut, 'e');
			WHEN 'S' THEN SET stringOut = CONCAT(stringOut, 'F');
			WHEN 's' THEN SET stringOut = CONCAT(stringOut, 'f');
			WHEN 'T' THEN SET stringOut = CONCAT(stringOut, 'G');
			WHEN 't' THEN SET stringOut = CONCAT(stringOut, 'g');
			WHEN 'U' THEN SET stringOut = CONCAT(stringOut, 'H');
			WHEN 'u' THEN SET stringOut = CONCAT(stringOut, 'h');
			WHEN 'V' THEN SET stringOut = CONCAT(stringOut, 'I');
			WHEN 'v' THEN SET stringOut = CONCAT(stringOut, 'i');
			WHEN 'W' THEN SET stringOut = CONCAT(stringOut, 'J');
			WHEN 'w' THEN SET stringOut = CONCAT(stringOut, 'j');
			WHEN 'X' THEN SET stringOut = CONCAT(stringOut, 'K');
			WHEN 'x' THEN SET stringOut = CONCAT(stringOut, 'k');
			WHEN 'Y' THEN SET stringOut = CONCAT(stringOut, 'L');
			WHEN 'y' THEN SET stringOut = CONCAT(stringOut, 'l');
			WHEN 'Z' THEN SET stringOut = CONCAT(stringOut, 'M');
			WHEN 'z' THEN SET stringOut = CONCAT(stringOut, 'm');
            WHEN str THEN SET stringOut = CONCAT(stringOut, str);
		END CASE;
		SET v1 = v1 + 1;
	END WHILE;

	RETURN stringOut;
END$$

DELIMITER ;


-- END
