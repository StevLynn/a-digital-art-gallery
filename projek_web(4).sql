-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 06, 2024 at 08:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `profile_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `email`, `phone`, `address`, `profile_image`) VALUES
(1, 'Stevelin Friska', 'Stevelin', '123455', '', 0, '', ''),
(2, 'Alif Saputra', 'saputraisansyah_alif', 'alifsaputra', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_lukisan` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment_text` text NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_lukisan`, `username`, `comment_text`, `timestamp`) VALUES
(1, 2, 'ade', 'ADE', '0000-00-00 00:00:00'),
(2, 2, 'putri', 'ade', '2024-07-06 06:57:17'),
(3, 2, 'putri', 'coba', '2024-07-06 07:18:29'),
(4, 2, 'putri', 'ade', '2024-07-06 07:37:00'),
(5, 2, 'putri', 'apa', '2024-07-06 07:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `data_user`
--

CREATE TABLE `data_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_user`
--

INSERT INTO `data_user` (`id`, `username`, `email`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `password`, `description`, `instagram`, `twitter`, `youtube`, `profile_image`) VALUES
(1, 'johndoe', 'johndoe@example.com', 'John Doe', 'Male', 'New York', '1990-01-01', '$2y$10$5.HNCMxRd5X4oEd2XQTJnuo7DKPYQ6Z6dA0DgpFbslWqgAcbY5m1S', 'Digital artist and designer', 'https://instagram.com/johndoe', 'https://twitter.com/johndoe', 'https://youtube.com/johndoe', ''),
(2, 'jeri', 'tes@gmail.com', 'jeri', 'Laki-laki', 'pinrang', '2024-05-29', '$2y$10$1pdEJ5dXcvUbLhb.ylRzdey/TvSrjnnFD3t3EAKpar/3wer9m2ieO', 'tes', 'alif', 'alif', 'alif', ''),
(3, 'Lani', 'stevelinfriska29@gmail.com', 'Stevelin Friska', 'Perempuan', 'Parepare', '2004-09-02', '$2y$10$5fwagBEaNm504Wv/8xVEve4PLXMQfytjm6j9J19yP9p/4uXTGU0P2', NULL, NULL, NULL, NULL, NULL),
(4, 'Stevey', 'evlyy@gmail.com', 'Evelly', 'Perempuan', 'London', '2002-02-02', '$2y$10$ly45EE8ldgmS6Ej10lvEkuklNsav5aaquEQ6h4HiX7xs.eaSnhaKe', 'Lin maniss', 'https://www.instagram.com/stvlnfrsk__', '', '', ''),
(5, 'Lilin', 'adeputri@gmail.com', 'Lalilini', 'Perempuan', 'Australia', '2004-12-02', '$2y$10$6ofkHq0xgEvtDXKcjrnsIe/lwOMKQiqM/f5QelEGtg3tWVMu7Ow.u', NULL, NULL, NULL, NULL, NULL),
(6, 'putri', 'adeputribustan01@gmail.com', 'adeputri', 'Perempuan', 'jakarta', '2024-07-04', '$2y$10$M06z3F9sXPvz2IPOzrWZbedrD62T/VXGOZRyQv9FYt75hnmLSWjkW', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `edit_profil_admin`
--

CREATE TABLE `edit_profil_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `edit_profil_admin`
--

INSERT INTO `edit_profil_admin` (`id`, `username`, `nama`, `email`, `phone`, `address`, `password`, `profile_image`) VALUES
(1, 'Ade', '', 'adeputribustan@gmail.com', '089897786789', ' kapten h lanca', 'Adheputry16', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `lukisan_id` int(100) NOT NULL,
  `user_favorite_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `follower_id`, `following_id`) VALUES
(12, 4, 1),
(10, 4, 3),
(11, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `lukisan`
--

CREATE TABLE `lukisan` (
  `id_lukisan` int(10) NOT NULL,
  `title_lukisan` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `media` varchar(100) NOT NULL,
  `tahun_pembuatan` varchar(50) NOT NULL,
  `ukuran` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lukisan`
--

INSERT INTO `lukisan` (`id_lukisan`, `title_lukisan`, `deskripsi`, `media`, `tahun_pembuatan`, `ukuran`, `gambar`, `username`, `status`, `likes`) VALUES
(2, 'bobiboy', 'bobobii', 'foto', '2022-01-01', '5cm x 5cm', 'lukisan/WhatsApp Image 2024-06-20 at 00.56.22.jpeg', 'Lani', 'success', 6),
(5, 'kittiy', 'kucing tanpa warna', 'foto', '2020-02-01', '5cm x 5cm', 'lukisan/Cuplikan layar 2024-06-23 185602.png', 'Lani', 'failed', 0),
(6, 'bobibi', 'boboiboyy', 'foto', '2020-02-02', '5cm x 5cm', 'lukisan/WhatsApp Image 2024-06-20 at 00.58.01.jpeg', 'Lani', 'success', 1),
(7, 'meong', 'kucing bukan?', 'foto', '2019-10-01', '5cm x 5cm', 'lukisan/Cuplikan layar 2024-06-23 185805.png', 'Stevey', 'success', 1),
(8, 'bibibibi', 'apa jelah', 'foto', '2023-12-10', '5cm x 5cm', 'lukisan/WhatsApp Image 2024-06-20 at 00.51.32.jpeg', 'Stevey', 'success', 0),
(9, 'koala', '2 ekor koala', 'foto', '2022-10-02', '5cm x 6cm', 'lukisan/koala.jpg', 'Stevey', 'failed', 0),
(10, 'burung lucu', 'seekor nurung', 'foto', '2022-02-02', '5cm x 6cm', 'lukisan/kookabura.jpg', 'Stevey', 'success', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lukisan` (`id_lukisan`);

--
-- Indexes for table `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `edit_profil_admin`
--
ALTER TABLE `edit_profil_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lukisan_id` (`lukisan_id`),
  ADD KEY `user_favorite_id` (`user_favorite_id`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_follow` (`follower_id`,`following_id`),
  ADD KEY `fk_following` (`following_id`);

--
-- Indexes for table `lukisan`
--
ALTER TABLE `lukisan`
  ADD PRIMARY KEY (`id_lukisan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `edit_profil_admin`
--
ALTER TABLE `edit_profil_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lukisan`
--
ALTER TABLE `lukisan`
  MODIFY `id_lukisan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_lukisan`) REFERENCES `lukisan` (`id_lukisan`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`lukisan_id`) REFERENCES `lukisan` (`id_lukisan`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`user_favorite_id`) REFERENCES `data_user` (`id`);

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_follower` FOREIGN KEY (`follower_id`) REFERENCES `data_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_following` FOREIGN KEY (`following_id`) REFERENCES `data_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
