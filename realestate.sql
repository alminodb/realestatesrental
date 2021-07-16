-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2021 at 05:34 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

CREATE TABLE `estates` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `title` char(64) COLLATE utf8mb4_croatian_ci NOT NULL,
  `price` double NOT NULL,
  `about` longtext COLLATE utf8mb4_croatian_ci NOT NULL,
  `location` varchar(64) COLLATE utf8mb4_croatian_ci NOT NULL,
  `image` varchar(64) COLLATE utf8mb4_croatian_ci NOT NULL,
  `days` int(11) NOT NULL,
  `rented` tinyint(1) NOT NULL,
  `rented_by` varchar(64) COLLATE utf8mb4_croatian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `type`, `title`, `price`, `about`, `location`, `image`, `days`, `rented`, `rented_by`) VALUES
(7, 1, 'Dvospratna kuca', 180, 'Kuca u periferiji Mostara. Struja, grijanje, klima, rostilj, bazen. Kuca posjeduje veliki balkon sa kojeg se vidi cijeli grad kao na dlanu.', 'Mostar', '60cb49cc56f2a8.14015039.jpg', 0, 0, ''),
(8, 1, 'Vila', 820, 'Vila sa bazenom, garazama, rostiljem, basket terenom, tenis terenom, sigurnosne kamere. Veliko dvoriste, asvaltiran prilaz kuci.', 'Sarajevo', '60cb5d67bb8f84.82714091.jpg', 21, 1, 'almin'),
(10, 2, 'Penthouse', 200, 'Penthouse u zapadnom dijelu grada. Jacuzzi, klima, internet, bazen. Prelijep pogled.', 'Banja Luka', '60cb6918326049.03627901.jpg', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(24) COLLATE utf8mb4_croatian_ci NOT NULL,
  `lastName` varchar(24) COLLATE utf8mb4_croatian_ci NOT NULL,
  `username` varchar(24) COLLATE utf8mb4_croatian_ci NOT NULL,
  `password` varchar(24) COLLATE utf8mb4_croatian_ci NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_croatian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastName`, `username`, `password`, `admin`) VALUES
(14, 'Almin', 'Odobasic', 'almin', 'almin', 0),
(15, 'Test', 'test', 'test', 'test', 0),
(16, 'Admin', 'Admin', 'admin', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estates`
--
ALTER TABLE `estates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
