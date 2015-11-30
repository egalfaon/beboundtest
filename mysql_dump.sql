-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Gazda: localhost
-- Timp de generare: Noi 30, 2015 at 04:16 PM
-- Versiune server: 5.1.73
-- Versiune PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Baza de date: `bebound`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `bets`
--

CREATE TABLE IF NOT EXISTS `bets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `localteam_score` tinyint(2) NOT NULL,
  `visitorteam_score` tinyint(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `result` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `match_user_unique_constrain` (`match_id`,`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `bets`
--

INSERT INTO `bets` (`id`, `match_id`, `localteam_score`, `visitorteam_score`, `user_id`, `result`) VALUES
(1, 10, 0, 1, 2, 3),
(2, 1, 7, 7, 2, NULL),
(3, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `match_date` varchar(7) NOT NULL,
  `match_formatted_date` date NOT NULL,
  `match_bet_close_time` datetime NOT NULL,
  `match_time` time NOT NULL,
  `match_status` varchar(10) NOT NULL,
  `match_localteam_name` varchar(40) NOT NULL,
  `match_visitorteam_name` varchar(40) NOT NULL,
  `match_localteam_score` varchar(3) NOT NULL,
  `match_visitorteam_score` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Salvarea datelor din tabel `matches`
--

INSERT INTO `matches` (`id`, `match_id`, `match_date`, `match_formatted_date`, `match_bet_close_time`, `match_time`, `match_status`, `match_localteam_name`, `match_visitorteam_name`, `match_localteam_score`, `match_visitorteam_score`) VALUES
(1, 2150844, 'Dec 05', '2015-12-05', '2015-12-05 09:45:00', '12:45:00', '12:45', 'Stoke City', 'Manchester City', '?', '?'),
(2, 2150845, 'Dec 05', '2015-12-05', '2015-12-05 12:00:00', '15:00:00', '15:00', 'Arsenal', 'Sunderland', '?', '?'),
(3, 2150846, 'Dec 05', '2015-12-05', '2015-12-05 12:00:00', '15:00:00', '15:00', 'Manchester United', 'West Ham', '?', '?'),
(4, 2150847, 'Dec 05', '2015-12-05', '2015-12-05 12:00:00', '15:00:00', '15:00', 'Southampton', 'Aston Villa', '?', '?'),
(5, 2150848, 'Dec 05', '2015-12-05', '2015-12-05 12:00:00', '15:00:00', '15:00', 'Swansea', 'Leicester', '?', '?'),
(6, 2150849, 'Dec 05', '2015-12-05', '2015-12-05 12:00:00', '15:00:00', '15:00', 'Watford', 'Norwich', '?', '?'),
(7, 2150850, 'Dec 05', '2015-12-05', '2015-12-05 12:00:00', '15:00:00', '15:00', 'West Brom', 'Tottenham', '?', '?'),
(8, 2150851, 'Dec 05', '2015-12-05', '2015-12-05 02:30:00', '17:30:00', '17:30', 'Chelsea', 'Bournemouth', '?', '?'),
(9, 2151189, 'Dec 06', '2015-12-06', '2015-12-06 01:00:00', '16:00:00', '16:00', 'Newcastle Utd', 'Liverpool', '?', '?'),
(10, 2146967, 'Nov 23', '2015-11-23', '2015-11-23 05:00:00', '20:00:00', 'FT', 'Crystal Palace', 'Sunderland', '0', '1'),
(11, 2147777, 'Nov 28', '2015-11-28', '2015-11-28 12:00:00', '15:00:00', 'FT', 'Aston Villa', 'Watford', '2', '3'),
(12, 2147778, 'Nov 28', '2015-11-28', '2015-11-28 12:00:00', '15:00:00', 'FT', 'Bournemouth', 'Everton', '3', '3'),
(13, 2147779, 'Nov 28', '2015-11-28', '2015-11-28 12:00:00', '15:00:00', 'FT', 'Crystal Palace', 'Newcastle Utd', '5', '1'),
(14, 2147780, 'Nov 28', '2015-11-28', '2015-11-28 12:00:00', '15:00:00', 'FT', 'Manchester City', 'Southampton', '3', '1'),
(15, 2147781, 'Nov 28', '2015-11-28', '2015-11-28 12:00:00', '15:00:00', 'FT', 'Sunderland', 'Stoke City', '2', '0'),
(16, 2147782, 'Nov 28', '2015-11-28', '2015-11-28 02:30:00', '17:30:00', 'FT', 'Leicester', 'Manchester United', '1', '1'),
(17, 2147783, 'Nov 29', '2015-11-29', '2015-11-29 09:00:00', '12:00:00', 'FT', 'Tottenham', 'Chelsea', '0', '0'),
(18, 2148518, 'Nov 29', '2015-11-29', '2015-11-29 11:05:00', '14:05:00', 'FT', 'West Ham', 'West Brom', '1', '1'),
(19, 2148519, 'Nov 29', '2015-11-29', '2015-11-29 01:15:00', '16:15:00', 'FT', 'Liverpool', 'Swansea', '1', '0'),
(20, 2148520, 'Nov 29', '2015-11-29', '2015-11-29 01:15:00', '16:15:00', 'FT', 'Norwich', 'Arsenal', '1', '1'),
(21, 2151488, 'Dec 07', '2015-12-07', '2015-12-07 05:00:00', '20:00:00', '20:00', 'Everton', 'Crystal Palace', '?', '?');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `matchevents`
--

CREATE TABLE IF NOT EXISTS `matchevents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `event_minute` int(4) NOT NULL,
  `event_team` varchar(20) NOT NULL,
  `event_player` varchar(20) NOT NULL,
  `event_result` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Salvarea datelor din tabel `matchevents`
--

INSERT INTO `matchevents` (`id`, `event_id`, `match_id`, `event_type`, `event_minute`, `event_team`, `event_player`, `event_result`) VALUES
(1, 21469671, 10, 'yellowcard', 53, 'visitorteam', 'B. Jones', ''),
(2, 21469672, 10, 'yellowcard', 57, 'visitorteam', 'J. Defoe', ''),
(3, 21469673, 10, 'yellowcard', 66, 'localteam', 'S. Dann', ''),
(4, 21469674, 10, 'yellowcard', 67, 'visitorteam', 'Y. M''Vila', ''),
(5, 21469675, 10, 'goal', 80, 'visitorteam', 'J. Defoe', '[0 - 1]'),
(6, 21477771, 11, 'goal', 17, 'visitorteam', 'O. Ighalo', '[0 - 1]'),
(7, 21477772, 11, 'yellowcard', 40, 'visitorteam', 'B. Watson', ''),
(8, 21477773, 11, 'goal', 41, 'localteam', 'M. Richards', '[1 - 1]'),
(9, 21477774, 11, 'goal', 69, 'visitorteam', 'A. Hutton (o.g.)', '[1 - 2]'),
(10, 21477775, 11, 'yellowcard', 74, 'visitorteam', 'E. Capoue', ''),
(11, 21477776, 11, 'goal', 85, 'visitorteam', 'T. Deeney', '[1 - 3]'),
(12, 21477777, 11, 'yellowcard', 86, 'visitorteam', 'T. Deeney', ''),
(13, 21477778, 11, 'yellowcard', 88, 'localteam', 'C. Clark', ''),
(14, 21477779, 11, 'goal', 89, 'localteam', 'J. Ayew', '[2 - 3]'),
(15, 214777710, 11, 'yellowcard', 90, 'visitorteam', 'N. Ake', ''),
(16, 214777711, 11, 'yellowcard', 90, 'localteam', 'C. Sanchez', ''),
(17, 21477781, 12, 'goal', 25, 'visitorteam', 'R. Mori', '[0 - 1]'),
(18, 21477782, 12, 'goal', 36, 'visitorteam', 'R. Lukaku', '[0 - 2]'),
(19, 21477783, 12, 'goal', 79, 'localteam', 'A. Smith', '[1 - 2]'),
(20, 21477784, 12, 'yellowcard', 82, 'localteam', 'D. Gosling', ''),
(21, 21477785, 12, 'goal', 87, 'localteam', 'J. Stanislas', '[2 - 2]'),
(22, 21477786, 12, 'goal', 90, 'visitorteam', 'R. Barkley', '[2 - 3]'),
(23, 21477787, 12, 'goal', 90, 'localteam', 'J. Stanislas', '[3 - 3]'),
(24, 21477791, 13, 'goal', 10, 'visitorteam', 'P. Cisse', '[0 - 1]'),
(25, 21477792, 13, 'goal', 14, 'localteam', 'J. McArthur', '[1 - 1]'),
(26, 21477793, 13, 'goal', 17, 'localteam', 'Y. Bolasie', '[2 - 1]'),
(27, 21477794, 13, 'yellowcard', 38, 'localteam', 'W. Zaha', ''),
(28, 21477795, 13, 'goal', 41, 'localteam', 'W. Zaha', '[3 - 1]'),
(29, 21477796, 13, 'goal', 47, 'localteam', 'Y. Bolasie', '[4 - 1]'),
(30, 21477797, 13, 'yellowcard', 81, 'visitorteam', 'C. Mbemba', ''),
(31, 21477798, 13, 'goal', 90, 'localteam', 'J. McArthur', '[5 - 1]'),
(32, 21477801, 14, 'goal', 9, 'localteam', 'K. de Bruyne', '[1 - 0]'),
(33, 21477802, 14, 'goal', 20, 'localteam', 'F. Delph', '[2 - 0]'),
(34, 21477803, 14, 'goal', 49, 'visitorteam', 'S. Long', '[2 - 1]'),
(35, 21477804, 14, 'yellowcard', 55, 'visitorteam', 'J. Ward-Prowse', ''),
(36, 21477805, 14, 'yellowcard', 56, 'localteam', 'M. Demichelis', ''),
(37, 21477806, 14, 'goal', 69, 'localteam', 'A. Kolarov', '[3 - 1]'),
(38, 21477807, 14, 'yellowcard', 90, 'localteam', 'A. Kolarov', ''),
(39, 21477811, 15, 'yellowcard', 33, 'visitorteam', 'C. Adam', ''),
(40, 21477812, 15, 'yellowcard', 42, 'visitorteam', 'R. Shawcross', ''),
(41, 21477813, 15, 'yellowred', 47, 'visitorteam', 'R. Shawcross', ''),
(42, 21477814, 15, 'yellowcard', 81, 'visitorteam', 'E. Pieters', ''),
(43, 21477815, 15, 'goal', 82, 'localteam', 'P. van Aanholt', '[1 - 0]'),
(44, 21477816, 15, 'goal', 84, 'localteam', 'D. Watmore', '[2 - 0]'),
(45, 21477821, 16, 'yellowcard', 14, 'visitorteam', 'A. Young', ''),
(46, 21477822, 16, 'goal', 24, 'localteam', 'J. Vardy', '[1 - 0]'),
(47, 21477823, 16, 'goal', 45, 'visitorteam', 'B. Schweinsteiger', '[1 - 1]'),
(48, 21477831, 17, 'yellowcard', 32, 'localteam', 'D. Rose', ''),
(49, 21477832, 17, 'yellowcard', 40, 'localteam', 'H. Kane', ''),
(50, 21477833, 17, 'yellowcard', 45, 'localteam', 'K. Walker', ''),
(51, 21477834, 17, 'yellowcard', 53, 'localteam', 'J. Vertonghen', ''),
(52, 21477835, 17, 'yellowcard', 60, 'visitorteam', 'N. Matic', ''),
(53, 21477836, 17, 'yellowcard', 90, 'visitorteam', 'C. Azpilicueta', ''),
(54, 21485181, 18, 'goal', 17, 'localteam', 'M. Zarate', '[1 - 0]'),
(55, 21485182, 18, 'yellowcard', 17, 'visitorteam', 'J. Olsson', ''),
(56, 21485183, 18, 'goal', 50, 'visitorteam', 'W. Reid (o.g.)', '[1 - 1]'),
(57, 21485184, 18, 'yellowcard', 81, 'visitorteam', 'C. Yacob', ''),
(58, 21485191, 19, 'yellowcard', 25, 'localteam', 'J. Milner', ''),
(59, 21485192, 19, 'goal', 62, 'localteam', 'J. Milner (pen.)', '[1 - 0]'),
(60, 21485193, 19, 'yellowcard', 65, 'localteam', 'M. Skrtel', ''),
(61, 21485194, 19, 'yellowcard', 70, 'visitorteam', 'K. Bartley', ''),
(62, 21485195, 19, 'yellowcard', 90, 'localteam', 'S. Mignolet', ''),
(63, 21485201, 20, 'goal', 30, 'visitorteam', 'M. Ozil', '[0 - 1]'),
(64, 21485202, 20, 'goal', 43, 'localteam', 'L. Grabban', '[1 - 1]'),
(65, 21485203, 20, 'yellowcard', 54, 'visitorteam', 'S. Cazorla', ''),
(66, 21485204, 20, 'yellowcard', 57, 'localteam', 'G. O''Neil', '');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `last_update` datetime NOT NULL,
  `next_update` datetime NOT NULL,
  `time_interval` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Salvarea datelor din tabel `settings`
--

INSERT INTO `settings` (`id`, `last_update`, `next_update`, `time_interval`) VALUES
(1, '2015-11-30 16:15:20', '2015-11-30 16:15:30', 10);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `pass`) VALUES
(1, 'demo1@demo.com', 'Demo One', 'a722c63db8ec8625af6cf71cb8c2d939'),
(2, 'demo2@demo.com', 'Demo Two', 'c1572d05424d0ecb2a65ec6a82aeacbf');
