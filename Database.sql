CREATE DATABASE IF NOT EXISTS `gamestars`
USE `gamestars`;

CREATE TABLE IF NOT EXISTS `games` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` longtext DEFAULT NULL,
  `Thumbnail` longtext DEFAULT NULL,
  `Stars` double DEFAULT NULL,
  `Platforms` longtext DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `games` (`ID`, `Title`, `Thumbnail`, `Stars`, `Platforms`) VALUES
	(1, 'Grand Theft Auto V', 'https://i.imgur.com/yrRK9Na.png', 4.5, '{"Windows", "PS3", "PS4", "Xbox-360", "Xbox-One"}'),
	(2, 'Ride 4', 'https://i.imgur.com/LeGP4wY.png', 4, '{"Windows", "PS3", "PS4", "PS5", "Xbox-Series-SIX", "Xbox One"}'),
	(3, 'Assassin\'s Creed IV: Black Flag', 'https://i.imgur.com/IvwecHO.png', 5, '{"Windows", "PS3", "PS4", "Wii U", "Xbox-360", "Xbox-One", "Nintendo-Switch"}'),
	(4, 'Call Off Duty: WWII', 'https://i.imgur.com/tbUDSrg.jpg', 3, '{"Windows", "PS4", "Xbox-One"}'),
	(5, 'Minecraft', 'https://i.imgur.com/ccyzJBW.png', 5, '{"Windows", "PS3", "PS4", "PS5", "Xbox-360", "Xbox-One", "Nintendo-Switch", "Mobile"}'),
	(7, 'Red Dead Redemption 2', 'https://i.imgur.com/bIz98KP.png', 5, '{"Windows", "PS4", "Xbox-One"}'),
	(8, 'Counter-Strike: Global Offensive', 'https://i.imgur.com/fvwu6Uv.png', 3, '{"Windows", "PS3", "Xbox-360"}'),
	(9, 'Rainbow Six Siege', 'https://i.imgur.com/wiOvJ5B.png', 4, '{"Windows", "PS4", "Xbox-One"}'),
	(10, 'Cyberpunk 2077', 'https://i.imgur.com/8qYUmlU.png', 1.5, '{"Windows", "PS4", "PS5", "Xbox-Series-SIX", "Xbox-One"}');

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;