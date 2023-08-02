-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 08:15 AM
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
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `guideid` varchar(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `phoneno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`guideid`, `name`, `designation`, `college`, `emailid`, `phoneno`) VALUES
('ga001', 'Annadurai A', 'Assistant Professor', 'Madras Institute of Technology, Chromepet', 'annadurai.aprof@gmail.com', '9574121368'),
('gf001', 'Dhanapal G', 'Faculty ', 'College of Engineering, Guindy', 'dhana.faculty@gmail.com', '9844121114'),
('gf002', 'Mohanraja A', 'Faculty ', 'College of Engineering, Guindy', 'iammohan812@gmail.com', '9940044141'),
('gp001', 'Vijay B', 'Professor', 'Center of Distance Education, Guindy', 'vijay.prof@gmail.com', '8759642315');

-- --------------------------------------------------------

--
-- Table structure for table `guidelogin`
--

CREATE TABLE `guidelogin` (
  `id` int(11) NOT NULL,
  `guide_id` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `lastactivity` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guidelogin`
--

INSERT INTO `guidelogin` (`id`, `guide_id`, `email_id`, `pwd`, `lastactivity`) VALUES
(1, 'ga001', 'annadurai.aprof@gmail.com', '123456789', '2023-07-23 17:18:56'),
(2, 'gf001', 'dhana.faculty@gmail.com', '12345678', '2023-07-23 18:57:55'),
(3, 'gp001', 'vijay.prof@gmail.com', '12345678', '2023-07-24 07:13:24'),
(4, 'gf002', 'iammohan812@gmail.com', '12345678', '2023-07-26 02:39:07');

-- --------------------------------------------------------

--
-- Table structure for table `guideselection`
--

CREATE TABLE `guideselection` (
  `id` int(11) NOT NULL,
  `regno` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `studycentre` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `specialization` varchar(50) NOT NULL,
  `gid` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `lastactivity` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guideselection`
--

INSERT INTO `guideselection` (`id`, `regno`, `name`, `phoneno`, `studycentre`, `course`, `specialization`, `gid`, `status`, `lastactivity`) VALUES
(19, '2022431001', 'Ajay A', '9842112553', 'College of Engineering, Guindy', 'MCA', '', 'gf002', 'Correction Pending', '2023-07-25 15:42:13'),
(43, '2022432001', 'Ajith R', '9852634147', 'Madras Institute of Technology, Chromepet', 'MCS', '', 'gf002', 'Correction Pending', '2023-07-28 05:20:15'),
(69, '2022421001', 'Arun D', '9840121212', 'Centre for Distance Education, Guindy', 'MBA', 'General Management', 'gf002', 'Pending', '2023-08-01 16:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `projectreg`
--

CREATE TABLE `projectreg` (
  `regno` varchar(11) NOT NULL,
  `title` text NOT NULL,
  `abstract` text NOT NULL,
  `objective` text NOT NULL,
  `scope` text NOT NULL,
  `programlang` text NOT NULL,
  `platform` text NOT NULL,
  `swapps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projectreg`
--

INSERT INTO `projectreg` (`regno`, `title`, `abstract`, `objective`, `scope`, `programlang`, `platform`, `swapps`) VALUES
('2022421001', 'Hello Project', 'I expect this revenue growth to carry through the next few years as Airbnb solidifies its market share. I expect this revenue growth to carry through the next few years as Airbnb solidifies its market', 'I expect this revenue growth to carry through the next few years as Airbnb solidifies its market share.', 'I expect this revenue growth to carry through the next few years as Airbnb solidifies its market share.', 'go lang, ubernets', 'vs code', 'Xampp'),
('2022421002', 'World full of war in India', 'PHP Redirect with Post Data\r\n\r\nHi,\r\n\r\nI am a newbie PHP programmer and trying to code a small blog.\r\n\r\nI will explain what I am trying to do.\r\n\r\npage1.php: Has a table of all posts in the blog\r\npage2.', 'PHP Redirect with Post Data\r\n\r\nHi,\r\n\r\nI am a newbie PHP programmer and trying to code a small blog.\r\n\r\nI will explain what I am trying to do.\r\n\r\npage1.php: Has a table of all posts in the blog\r\npage2.', 'asf asPHP Redirect with Post Data\r\n\r\nHi,\r\n\r\nI am a newbie PHP programmer and trying to code a small blog.\r\n\r\nI will explain what I am trying to do.\r\n\r\npage1.php: Has a table of all posts in the blog\r\n', ' asfd  sdf', 'a sdfsfd as asdf saf safdsadf asf as', 'asf '),
('2022431001', 'hello world', 'hi hello world! my world is to intro towards the iot for everyday life towards people who face problems to retify', 'hi hello world! and now on wards on goals to start preparing for my placement and want to get placed in 10lpa company in chennai', 'my world!', 'go lang', 'vs code', 'xampp lampp'),
('2022432001', 'hello world!', 'PHP Redirect with Post Data\r\n\r\nHi,\r\n\r\nI am a newbie PHP programmer and trying to code a small blog.\r\n\r\nI will explain what I am trying to do.\r\n\r\npage1.php: Has a table of all posts in the blog\r\npage2.', 'PHP Redirect with Post Data\r\n\r\nHi,\r\n\r\nI am a newbie PHP programmer and trying to code a small blog.\r\n\r\nI will explain what I am trying to do.\r\n\r\npage1.php: Has a table of all posts in the blog\r\npage2.', 'PHP Redirect with Post Data\r\n\r\nHi,\r\n\r\nI am a newbie PHP programmer and trying to code a small blog.\r\n\r\nI will explain what I am trying to do.\r\n\r\npage1.php: Has a table of all posts in the blog\r\npage2.', 'go lang', 'vs code', 'xampp lampp');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `regno` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `phoneno` varchar(10) NOT NULL,
  `studycentre` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `specialization` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`regno`, `name`, `emailid`, `phoneno`, `studycentre`, `course`, `specialization`) VALUES
('2022421001', 'Arun D', 'arun.mba@gmail.com', '9840121212', 'Centre for Distance Education, Guindy', 'MBA', 'General Management'),
('2022421002', 'mohan', 'mohanraj5153613@gmail.com', '8778716266', 'College of Engineering, Guindy', 'MBA', 'General Management'),
('2022431001', 'Ajay A', 'ajay.mca@gmail.com', '9842112553', 'College of Engineering, Guindy', 'MCA', ''),
('2022432001', 'Ajith R', 'ajith.mcs@gmail.com', '9852634147', 'Madras Institute of Technology, Chromepet', 'MCS', '');

-- --------------------------------------------------------

--
-- Table structure for table `studlogin`
--

CREATE TABLE `studlogin` (
  `id` int(11) NOT NULL,
  `regno` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `lastactivity` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token_hash` varchar(200) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studlogin`
--

INSERT INTO `studlogin` (`id`, `regno`, `email`, `pwd`, `lastactivity`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(17, '2022421001', 'arun.mba@gmail.com', '12345', '2023-07-04 17:43:09', NULL, NULL),
(18, '2022431001', 'ajay.mca@gmail.com', '12345678', '2023-07-04 18:25:51', NULL, NULL),
(19, '2022432001', 'ajith.mcs@gmail.com', '12345678', '2023-07-04 19:24:29', NULL, NULL),
(20, '2022421002', 'mohanraj5153613@gmail.com', '123', '2023-07-28 04:12:49', 'NULL', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`guideid`);

--
-- Indexes for table `guidelogin`
--
ALTER TABLE `guidelogin`
  ADD PRIMARY KEY (`id`,`guide_id`);

--
-- Indexes for table `guideselection`
--
ALTER TABLE `guideselection`
  ADD PRIMARY KEY (`id`,`regno`);

--
-- Indexes for table `projectreg`
--
ALTER TABLE `projectreg`
  ADD PRIMARY KEY (`regno`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`regno`);

--
-- Indexes for table `studlogin`
--
ALTER TABLE `studlogin`
  ADD PRIMARY KEY (`id`,`regno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guidelogin`
--
ALTER TABLE `guidelogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guideselection`
--
ALTER TABLE `guideselection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `studlogin`
--
ALTER TABLE `studlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
