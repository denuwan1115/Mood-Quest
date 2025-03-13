-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 12, 2025 at 06:12 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moodquest`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE IF NOT EXISTS `scores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `playerID` varchar(100) NOT NULL,
  `score` int NOT NULL,
  `datentime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `playerID`, `score`, `datentime`) VALUES
(94, 'fjanta.hustler@gmail.com', 0, '2025-02-05 08:40:57'),
(93, 'fjanta.hustler@gmail.com', 0, '2025-02-05 08:40:52'),
(92, 'fjanta.hustler@gmail.com', 0, '2025-02-05 08:40:47'),
(91, 'fjanta.hustler@gmail.com', 0, '2024-11-18 14:00:29'),
(90, 'fjanta.hustler@gmail.com', 0, '2024-11-18 14:00:25'),
(89, 'fjanta.hustler@gmail.com', 0, '2024-11-18 14:00:21'),
(88, 's@gmail.com', 0, '2024-11-16 16:09:22'),
(87, 'fjanta.hustler@gmail.com', 30, '2024-11-16 09:10:38'),
(95, 'fjanta.hustler@gmail.com', 0, '2025-03-11 13:56:38'),
(96, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:12:09'),
(97, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:27:31'),
(98, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:27:36'),
(99, 'fjanta.hustler@gmail.com', 10, '2025-03-11 16:32:25'),
(100, 'fjanta.hustler@gmail.com', 20, '2025-03-11 16:35:47'),
(101, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:37:21'),
(102, 'fjanta.hustler@gmail.com', 10, '2025-03-11 16:39:25'),
(103, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:40:50'),
(104, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:41:20'),
(105, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:44:32'),
(106, 'fjanta.hustler@gmail.com', 0, '2025-03-11 16:47:25'),
(107, 'fjanta.hustler@gmail.com', 10, '2025-03-11 16:47:51'),
(108, 'fjanta.hustler@gmail.com', 10, '2025-03-11 22:08:00'),
(109, 'fjanta.hustler@gmail.com', 0, '2025-03-11 22:19:50'),
(110, 'fjanta.hustler@gmail.com', 0, '2025-03-11 22:20:53'),
(111, 'fjanta.hustler@gmail.com', 0, '2025-03-11 22:21:06'),
(112, 'fjanta.hustler@gmail.com', 10, '2025-03-11 22:21:27'),
(113, 'fjanta.hustler@gmail.com', 0, '2025-03-11 22:36:45'),
(114, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:37:11'),
(115, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:37:14'),
(116, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:38:14'),
(117, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:40:55'),
(118, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:44:06'),
(119, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:44:14'),
(120, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:44:43'),
(121, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:46:56'),
(122, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:47:02'),
(123, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:47:09'),
(124, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:47:13'),
(125, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:47:19'),
(126, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:47:26'),
(127, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:47:38'),
(128, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:47:54'),
(129, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:48:05'),
(130, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:48:12'),
(131, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:50:05'),
(132, 'fjanta.hustler@gmail.com', 0, '2025-03-12 05:50:15'),
(133, 'fjanta.hustler@gmail.com', 10, '2025-03-12 05:50:49'),
(134, 'fjanta.hustler@gmail.com', 0, '2025-03-12 06:03:57'),
(135, 'fjanta.hustler@gmail.com', 0, '2025-03-12 06:04:04'),
(136, 'fjanta.hustler@gmail.com', 0, '2025-03-12 06:05:29'),
(137, 'fjanta.hustler@gmail.com', 0, '2025-03-12 06:05:32'),
(138, 'fjanta.hustler@gmail.com', 0, '2025-03-12 06:05:37'),
(139, 'fjanta.hustler@gmail.com', 0, '2025-03-12 06:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fullName`, `email`, `age`, `password`) VALUES
('Gayan', 'fjanta.hustler@gmail.com', 24, '$2y$10$CYw7FzJm394ohWj3cum5DejdOf3UbxGGe/bWHmg1pN76goiM9Yjba'),
('asda', 's@gmail.com', 34, '$2y$10$MG6ni59EM3P0qn.k2DI/Sey9Q.juEiN6tjrSAx7jh07dyOgHt7/oW'),
('Kottawa Gamage Gayan Sachintha', 'fanbbbbta.hustler@gmail.com', 20, '$2y$10$FMWl8M0QxhuSWpG.oEUn7OC2fARr2hDW11LnBPkzsd4eoQPcfHreW'),
('Kottawa Gamage Gayan Sachintha', 'fanbbfgdfgbbta.hustler@gmail.com', 20, '$2y$10$MuTKmruKWGj/CJfF8rJQ4OlkLWrSU1XBSLxFH5pUsHyTTKV34rcIa');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
