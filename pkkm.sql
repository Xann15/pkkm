-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2023 at 10:11 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `history_id` int(8) NOT NULL,
  `iuran` varchar(50) DEFAULT NULL,
  `username` varchar(25) NOT NULL,
  `saldo` int(255) DEFAULT NULL,
  `periode` int(75) DEFAULT NULL,
  `total_pembayaran` int(255) NOT NULL,
  `tgl` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `no_pelanggan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `history_id`, `iuran`, `username`, `saldo`, `periode`, `total_pembayaran`, `tgl`, `no_pelanggan`) VALUES
(40, 1, 'trash', 'panji', 50000, 2, 40000, '2023-01-21 01:06:16', 2147483647),
(42, 1, 'trash', 'panji', 10000000, 3, 60000, '2023-01-21 01:46:54', 22332),
(43, 1, 'security', 'panji', 9940000, 2, 40000, '2023-01-21 01:47:29', 132);

-- --------------------------------------------------------

--
-- Table structure for table `pageview`
--

CREATE TABLE `pageview` (
  `id` int(11) NOT NULL,
  `page` text NOT NULL,
  `userip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pageview`
--

INSERT INTO `pageview` (`id`, `page`, `userip`) VALUES
(0, 'home', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `totalview`
--

CREATE TABLE `totalview` (
  `id` int(11) NOT NULL,
  `page` text NOT NULL,
  `totalvisit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `totalview`
--

INSERT INTO `totalview` (`id`, `page`, `totalvisit`) VALUES
(0, 'home', '19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(8) NOT NULL,
  `role` varchar(25) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `seluler` int(75) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `saldo` int(255) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role`, `username`, `seluler`, `email`, `password`, `alamat`, `saldo`) VALUES
(1, 'admin', 'panji', 8127798, '123@123', '$2y$10$hwB468SmwKe32aXXW1BFsekeppRadvxjIvYGAUJdNPiVHL/SwxOhe', NULL, 9900000),
(3, 'user', 'xann', NULL, 'xannism@whoareyou', '$2y$10$ccEJ1dm8YzgQPqz1ddLx/esUuShd80jECwITYv2m.DwEiV.WHAqlW', NULL, 50000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `pageview`
--
ALTER TABLE `pageview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `totalview`
--
ALTER TABLE `totalview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`history_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
