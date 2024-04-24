-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 01:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom`
--

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `deskripsi_foto` text NOT NULL,
  `tanggal_unggah` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `deskripsi_foto`, `tanggal_unggah`, `lokasi_file`, `user_id`) VALUES
(1, 'Nahida Guide', 'Farming Guide, Material Ascend, Material Level Up, Talent Book, Weekly Boss Material, Prioritize Skills, and Weapon', '2024-04-21', 'Nahida.png', 1),
(2, 'Circle', 'Circle in Minecraft for build', '2024-04-21', 'soup.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `komentar_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` text NOT NULL,
  `tanggal_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentar_foto`
--

INSERT INTO `komentar_foto` (`komentar_id`, `foto_id`, `user_id`, `isi_komentar`, `tanggal_komentar`) VALUES
(1, 1, 1, 'Nahihi', '2024-04-21'),
(2, 1, 1, 'Test masuk', '2024-04-21'),
(3, 1, 2, 'Wih Nahida', '2024-04-21'),
(4, 2, 1, 'Test masuknank', '2024-04-21'),
(5, 1, 1, 'Test', '2024-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `like_foto`
--

CREATE TABLE `like_foto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_foto`
--

INSERT INTO `like_foto` (`like_id`, `foto_id`, `user_id`, `tanggal_like`) VALUES
(4, 1, 2, '2024-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(1, 'test1', '12345', 'test1@gmail.com', 'Akun Testing 1', 'Jalan Anggrek'),
(2, 'test2', '12345', 'test2@gmail.com', 'Akun Testing 2', 'Jalan Mawar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD PRIMARY KEY (`komentar_id`),
  ADD KEY `foto_id` (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `foto_id` (`foto_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `komentar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD CONSTRAINT `komentar_foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `komentar_foto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`);

--
-- Constraints for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD CONSTRAINT `like_foto_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `like_foto_ibfk_2` FOREIGN KEY (`foto_id`) REFERENCES `foto` (`foto_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
