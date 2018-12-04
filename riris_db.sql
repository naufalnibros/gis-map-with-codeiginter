-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 04 Des 2018 pada 20.00
-- Versi Server: 5.7.11-0ubuntu6
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riris_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kapal`
--

CREATE TABLE `kapal` (
  `id_kapal` int(11) NOT NULL,
  `namakapal` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `koordinatkapal`
--

CREATE TABLE `koordinatkapal` (
  `id_koordinatkapal` int(11) NOT NULL,
  `kapal_id` int(11) DEFAULT NULL,
  `latitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  `longtitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `koordinatrute`
--

CREATE TABLE `koordinatrute` (
  `id_koordinatrute` int(11) NOT NULL,
  `rute_id` int(11) DEFAULT NULL,
  `latitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  `longtitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rute`
--

CREATE TABLE `rute` (
  `id_rute` int(11) NOT NULL,
  `namarute` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `rute`
--

INSERT INTO `rute` (`id_rute`, `namarute`, `keterangan`) VALUES
(1, 'rumah riris', 'rute rumah riris dari rumah naufal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(512) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '1e9dfc474eb2372f7f415b74392b4ec1d5e3c0f5');

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
  MODIFY `id_rute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `koordinatkapal`
--
ALTER TABLE `koordinatkapal`
  ADD CONSTRAINT `koordinatkapal_ibfk_1` FOREIGN KEY (`kapal_id`) REFERENCES `kapal` (`id_kapal`);

--
-- Ketidakleluasaan untuk tabel `koordinatrute`
--
ALTER TABLE `koordinatrute`
  ADD CONSTRAINT `koordinatrute_ibfk_1` FOREIGN KEY (`rute_id`) REFERENCES `rute` (`id_rute`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
