-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2018 at 09:27 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trayek`
--

-- --------------------------------------------------------

--
-- Table structure for table `kapal`
--

CREATE TABLE IF NOT EXISTS `kapal` (
  `id_kapal` int(11) NOT NULL,
  `namakapal` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `koordinatkapal`
--

CREATE TABLE IF NOT EXISTS `koordinatkapal` (
  `id_koordinatkapal` int(11) NOT NULL,
  `kapal_id` int(11) DEFAULT NULL,
  `latitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  `longtitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `koordinatrute`
--

CREATE TABLE IF NOT EXISTS `koordinatrute` (
  `id_koordinatrute` int(11) NOT NULL,
  `rute_id` int(11) DEFAULT NULL,
  `latitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  `longtitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE IF NOT EXISTS `rute` (
  `id_rute` int(11) NOT NULL,
  `namarute` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(512) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kapal`
--
ALTER TABLE `kapal`
  ADD PRIMARY KEY (`id_kapal`);

--
-- Indexes for table `koordinatkapal`
--
ALTER TABLE `koordinatkapal`
  ADD PRIMARY KEY (`id_koordinatkapal`),
  ADD KEY `kapal_id` (`kapal_id`);

--
-- Indexes for table `koordinatrute`
--
ALTER TABLE `koordinatrute`
  ADD PRIMARY KEY (`id_koordinatrute`),
  ADD KEY `rute_id` (`rute_id`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`id_rute`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kapal`
--
ALTER TABLE `kapal`
  MODIFY `id_kapal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `koordinatkapal`
--
ALTER TABLE `koordinatkapal`
  MODIFY `id_koordinatkapal` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `koordinatrute`
--
ALTER TABLE `koordinatrute`
  MODIFY `id_koordinatrute` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `koordinatkapal`
--
ALTER TABLE `koordinatkapal`
  ADD CONSTRAINT `koordinatkapal_ibfk_1` FOREIGN KEY (`kapal_id`) REFERENCES `kapal` (`id_kapal`);

--
-- Constraints for table `koordinatrute`
--
ALTER TABLE `koordinatrute`
  ADD CONSTRAINT `koordinatrute_ibfk_1` FOREIGN KEY (`rute_id`) REFERENCES `rute` (`id_rute`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
