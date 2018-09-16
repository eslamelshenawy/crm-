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
-- Table structure for table `prodcastevents`
--

CREATE TABLE `prodcastevents` (
  `id` int(11) NOT NULL,
  `title_event_en` varchar(255) NOT NULL,
  `description_event_en` text NOT NULL,
  `date_event` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prodcastevents`
--

INSERT INTO `prodcastevents` (`id`, `title_event_en`, `description_event_en`, `date_event`, `created_at`, `updated_at`) VALUES
(115, 'hgfhfgh', 'fghfghfghfgh', '2018-08-08 17:30:00', '2018-08-29 15:49:30', '2018-08-29 15:49:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prodcastevents`
--
ALTER TABLE `prodcastevents`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prodcastevents`
--
ALTER TABLE `prodcastevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
