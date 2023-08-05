-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 08:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-cde`
--

-- --------------------------------------------------------

--
-- Table structure for table `guidelogin`
--

CREATE TABLE `guidelogin` (
  `id` int(11) NOT NULL,
  `guide_id` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `lastactivity` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token_hash` varchar(200) NOT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guidelogin`
--

INSERT INTO `guidelogin` (`id`, `guide_id`, `email_id`, `pwd`, `lastactivity`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(1, 'ga001', 'annadurai.aprof@gmail.com', '123456789', '2023-07-23 17:18:56', '', NULL),
(2, 'gf001', 'dhana.faculty@gmail.com', '12345678', '2023-07-23 18:57:55', '', NULL),
(3, 'gp001', 'vijay.prof@gmail.com', '12345678', '2023-07-24 07:13:24', '', NULL),
(4, 'gf002', 'iammohan812@gmail.com', '12345', '2023-07-26 02:39:07', 'NULL', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guidelogin`
--
ALTER TABLE `guidelogin`
  ADD PRIMARY KEY (`id`,`guide_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guidelogin`
--
ALTER TABLE `guidelogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
