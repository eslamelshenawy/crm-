-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 29, 2018 at 08:17 PM
-- Server version: 5.7.23-0ubuntu0.18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `addresse_crmlive`
--

-- --------------------------------------------------------

--
-- Table structure for table `prodeventstatuses`
--

CREATE TABLE `prodeventstatuses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prot_event_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `accept` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodeventstatuses`
--

INSERT INTO `prodeventstatuses` (`id`, `user_id`, `prot_event_id`, `group_id`, `accept`, `created_at`, `updated_at`) VALUES
(100, 11, 114, 5, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(101, 12, 114, 5, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(102, 13, 114, 5, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(103, 14, 114, 5, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(104, 15, 114, 5, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(105, 16, 114, 5, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(106, 17, 114, 6, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(107, 18, 114, 6, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(108, 19, 114, 6, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(109, 20, 114, 6, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(110, 21, 114, 6, 0, '2018-08-28 15:10:32', '2018-08-28 15:10:32'),
(111, 38, 115, 2, 0, '2018-08-29 15:49:30', '2018-08-29 15:49:30'),
(112, 38, 115, 3, 0, '2018-08-29 15:49:30', '2018-08-29 15:49:30'),
(113, 38, 115, 4, 0, '2018-08-29 15:49:30', '2018-08-29 15:49:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prodeventstatuses`
--
ALTER TABLE `prodeventstatuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prodeventstatuses`
--
ALTER TABLE `prodeventstatuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
