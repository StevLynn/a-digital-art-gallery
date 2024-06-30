-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Jun 2024 pada 22.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `admin`
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
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `email`, `phone`, `address`, `profile_image`) VALUES
(1, 'Stevelin Friska', 'Stevelin', '123455', '', 0, '', ''),
(2, 'Alif Saputra', 'saputraisansyah_alif', 'alifsaputra', '', 0, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_lukisan` int(11) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `comment_text` text DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_user`
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
-- Dumping data untuk tabel `data_user`
--

INSERT INTO `data_user` (`id`, `username`, `email`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `password`, `description`, `instagram`, `twitter`, `youtube`, `profile_image`) VALUES
(1, 'johndoe', 'johndoe@example.com', 'John Doe', 'Male', 'New York', '1990-01-01', '$2y$10$5.HNCMxRd5X4oEd2XQTJnuo7DKPYQ6Z6dA0DgpFbslWqgAcbY5m1S', 'Digital artist and designer', 'https://instagram.com/johndoe', 'https://twitter.com/johndoe', 'https://youtube.com/johndoe', ''),
(2, 'jeri', 'tes@gmail.com', 'jeri', 'Laki-laki', 'pinrang', '2024-05-29', '$2y$10$1pdEJ5dXcvUbLhb.ylRzdey/TvSrjnnFD3t3EAKpar/3wer9m2ieO', 'tes', 'alif', 'alif', 'alif', ''),
(3, 'Lani', 'stevelinfriska29@gmail.com', 'Stevelin Friska', 'Perempuan', 'Parepare', '2004-09-02', '$2y$10$5fwagBEaNm504Wv/8xVEve4PLXMQfytjm6j9J19yP9p/4uXTGU0P2', NULL, NULL, NULL, NULL, NULL),
(4, 'Stevey', 'evlyy@gmail.com', 'Evelly', 'Perempuan', 'London', '2002-02-02', '$2y$10$ly45EE8ldgmS6Ej10lvEkuklNsav5aaquEQ6h4HiX7xs.eaSnhaKe', 'Lin maniss', 'https://www.instagram.com/stvlnfrsk__', '', '', ''),
(5, 'Lilin', 'adeputri@gmail.com', 'Lalilini', 'Perempuan', 'Australia', '2004-12-02', '$2y$10$6ofkHq0xgEvtDXKcjrnsIe/lwOMKQiqM/f5QelEGtg3tWVMu7Ow.u', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `edit_profil_admin`
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
-- Dumping data untuk tabel `edit_profil_admin`
--

INSERT INTO `edit_profil_admin` (`id`, `username`, `nama`, `email`, `phone`, `address`, `password`, `profile_image`) VALUES
(1, 'Ade', '', 'adeputribustan@gmail.com', '089897786789', ' kapten h lanca', 'Adheputry16', 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorite`
--

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL,
  `lukisan_id` int(100) NOT NULL,
  `user_favorite_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `follow`
--

CREATE TABLE `follow` (
  `id` int(11) NOT NULL,
  `follower_id` bigint(20) UNSIGNED NOT NULL,
  `following_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `follow`
--

INSERT INTO `follow` (`id`, `follower_id`, `following_id`) VALUES
(12, 4, 1),
(10, 4, 3),
(11, 4, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lukisan`
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
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lukisan`
--

INSERT INTO `lukisan` (`id_lukisan`, `title_lukisan`, `deskripsi`, `media`, `tahun_pembuatan`, `ukuran`, `gambar`, `username`, `status`) VALUES
(2, 'bobiboy', 'bobobii', 'foto', '2022-01-01', '5cm x 5cm', 'lukisan/WhatsApp Image 2024-06-20 at 00.56.22.jpeg', 'Lani', 'success'),
(5, 'kittiy', 'kucing tanpa warna', 'foto', '2020-02-01', '5cm x 5cm', 'lukisan/Cuplikan layar 2024-06-23 185602.png', 'Lani', 'failed'),
(6, 'bobibi', 'boboiboyy', 'foto', '2020-02-02', '5cm x 5cm', 'lukisan/WhatsApp Image 2024-06-20 at 00.58.01.jpeg', 'Lani', 'success'),
(7, 'meong', 'kucing bukan?', 'foto', '2019-10-01', '5cm x 5cm', 'lukisan/Cuplikan layar 2024-06-23 185805.png', 'Stevey', 'success'),
(8, 'bibibibi', 'apa jelah', 'foto', '2023-12-10', '5cm x 5cm', 'lukisan/WhatsApp Image 2024-06-20 at 00.51.32.jpeg', 'Stevey', 'success'),
(9, 'koala', '2 ekor koala', 'foto', '2022-10-02', '5cm x 6cm', 'lukisan/koala.jpg', 'Stevey', 'failed'),
(10, 'burung lucu', 'seekor nurung', 'foto', '2022-02-02', '5cm x 6cm', 'lukisan/kookabura.jpg', 'Stevey', 'success');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_lukisan` (`id_lukisan`);

--
-- Indeks untuk tabel `data_user`
--
ALTER TABLE `data_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `edit_profil_admin`
--
ALTER TABLE `edit_profil_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lukisan_id` (`lukisan_id`),
  ADD KEY `user_favorite_id` (`user_favorite_id`);

--
-- Indeks untuk tabel `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_follow` (`follower_id`,`following_id`),
  ADD KEY `fk_following` (`following_id`);

--
-- Indeks untuk tabel `lukisan`
--
ALTER TABLE `lukisan`
  ADD PRIMARY KEY (`id_lukisan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_user`
--
ALTER TABLE `data_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `edit_profil_admin`
--
ALTER TABLE `edit_profil_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `follow`
--
ALTER TABLE `follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `lukisan`
--
ALTER TABLE `lukisan`
  MODIFY `id_lukisan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_lukisan`) REFERENCES `lukisan` (`id_lukisan`);

--
-- Ketidakleluasaan untuk tabel `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`lukisan_id`) REFERENCES `lukisan` (`id_lukisan`),
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`user_favorite_id`) REFERENCES `data_user` (`id`);

--
-- Ketidakleluasaan untuk tabel `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_follower` FOREIGN KEY (`follower_id`) REFERENCES `data_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_following` FOREIGN KEY (`following_id`) REFERENCES `data_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
