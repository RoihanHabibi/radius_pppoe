-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2024 at 09:31 AM
-- Server version: 8.0.40-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `radius`
--

-- --------------------------------------------------------

--
-- Table structure for table `radcheck`
--

CREATE TABLE `radcheck` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `attribute` varchar(64) NOT NULL DEFAULT '',
  `op` char(2) NOT NULL DEFAULT '==',
  `value` varchar(253) NOT NULL DEFAULT '',
  `status` int NOT NULL DEFAULT '1' COMMENT '1 = active\r\n0 = disabled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `radcheck`
--

INSERT INTO `radcheck` (`id`, `username`, `attribute`, `op`, `value`, `status`) VALUES
(2, 'roihan', 'Cleartext-Password', ':=', '123radius', 0),
(3, 'tes', 'Cleartext-Password', ':=', '0102030405', 0),
(4, 'pingaja', 'Cleartext-Password', ':=', '223344', 1),
(39, 'baru', 'Cleartext-Password', ':=', 'baru123', 1),
(40, 'testes', 'Cleartext-Password', ':=', 'setset', 1),
(41, 'barubuat', 'Cleartext-Password', ':=', 'buatbaru', 1),
(42, 'tes6', 'Cleartext-Password', ':=', '6tes', 1),
(43, '7tes', 'Cleartext-Password', ':=', 'tes7', 1),
(45, 'tes7', 'Cleartext-Password', ':=', '7tes', 1),
(46, 'roihan12', 'Cleartext-Password', ':=', 'roi123', 1),
(47, 'habibiroihan', 'Cleartext-Password', ':=', 'habib123', 1),
(48, 'buatbaru', 'Cleartext-Password', ':=', '12345', 1),
(49, 'admin00', 'Cleartext-Password', ':=', 'admin12', 1),
(50, 'radius123', 'Cleartext-Password', ':=', 'radius1234567890', 1),
(52, 'tes111111', 'Cleartext-Password', ':=', '12345678910', 1),
(53, '19baru', 'Cleartext-Password', ':=', 'baru19', 1),
(54, 'enabel', 'Cleartext-Password', ':=', 'enabel1', 1),
(55, 'tambahkan', 'Cleartext-Password', ':=', 'pengguna', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `radcheck`
--
ALTER TABLE `radcheck`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`(32));

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `radcheck`
--
ALTER TABLE `radcheck`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
