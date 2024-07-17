-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 17, 2024 at 10:25 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `audit_kendaraan`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit`
--

CREATE TABLE `audit` (
  `id` bigint NOT NULL,
  `id_kendaraan` bigint NOT NULL,
  `id_user` bigint NOT NULL,
  `tanggal_audit` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `audit`
--

INSERT INTO `audit` (`id`, `id_kendaraan`, `id_user`, `tanggal_audit`, `created_at`, `updated_at`) VALUES
(43, 8, 8, '2024-07-17', '2024-07-17 08:38:50', '2024-07-17 08:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `detail_audit`
--

CREATE TABLE `detail_audit` (
  `id` int NOT NULL,
  `id_audit` bigint NOT NULL,
  `cap_ban` enum('Ada','Tidak Ada') NOT NULL,
  `stiker` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `dashcam` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `sunvisor` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `klakson` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `door_trim` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `jok` enum('Bagus','Rusak') NOT NULL,
  `speaker` enum('Bagus','Rusak') NOT NULL,
  `glovebox` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `body` enum('Mulus','Baret','Penyok') NOT NULL,
  `bemper_depan` enum('Mulus','Baret','Penyok') NOT NULL,
  `bemper_belakang` enum('Mulus','Baret','Penyok') NOT NULL,
  `fender_depan` enum('Mulus','Baret','Penyok') NOT NULL,
  `fender_belakang` enum('Mulus','Baret','Penyok') NOT NULL,
  `box` enum('Mulus','Baret','Penyok') NOT NULL,
  `headlamp` enum('Mulus','Baret','Penyok') NOT NULL,
  `stoplamp` enum('Mulus','Baret','Penyok') NOT NULL,
  `kaca_depan` enum('Bagus','Retak','Pecah') NOT NULL,
  `spion` enum('Bagus','Baret','Pecah') NOT NULL,
  `ban_depan` enum('Ada','Tidak Ada') NOT NULL,
  `ban_belakang` enum('Ada','Tidak Ada') NOT NULL,
  `ban_serep` enum('Ada','Tidak Ada') NOT NULL,
  `dongkrak` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `kunci_roda` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `stik_roda` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `kotak_p3k` enum('Ada','Tidak Ada','Habis') NOT NULL,
  `warning_tirangel` enum('Ada','Tidak Ada','Rusak') NOT NULL,
  `stnk` enum('Ada','Tidak Ada') NOT NULL,
  `kir` enum('Ada','Tidak Ada') NOT NULL,
  `kartu_kir` enum('Ada','Tidak Ada') NOT NULL,
  `sipa` enum('Ada','Tidak Ada') NOT NULL,
  `ibm` enum('Ada','Tidak Ada') NOT NULL,
  `temuan` text NOT NULL,
  `status_temuan` enum('Open','Close') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `detail_audit`
--

INSERT INTO `detail_audit` (`id`, `id_audit`, `cap_ban`, `stiker`, `dashcam`, `sunvisor`, `klakson`, `door_trim`, `jok`, `speaker`, `glovebox`, `body`, `bemper_depan`, `bemper_belakang`, `fender_depan`, `fender_belakang`, `box`, `headlamp`, `stoplamp`, `kaca_depan`, `spion`, `ban_depan`, `ban_belakang`, `ban_serep`, `dongkrak`, `kunci_roda`, `stik_roda`, `kotak_p3k`, `warning_tirangel`, `stnk`, `kir`, `kartu_kir`, `sipa`, `ibm`, `temuan`, `status_temuan`) VALUES
(37, 43, 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Bagus', 'Bagus', 'Ada', 'Mulus', 'Mulus', 'Mulus', 'Mulus', 'Mulus', 'Mulus', 'Mulus', 'Mulus', 'Bagus', 'Bagus', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', 'Ada', '     ini adalah temuan audit', 'Close');

-- --------------------------------------------------------

--
-- Table structure for table `detail_gambar`
--

CREATE TABLE `detail_gambar` (
  `id` int NOT NULL,
  `gambar_cap_ban` varchar(255) DEFAULT NULL,
  `gambar_stiker` varchar(255) DEFAULT NULL,
  `gambar_dashcam` varchar(255) DEFAULT NULL,
  `gambar_sunvisor` varchar(255) DEFAULT NULL,
  `gambar_klakson` varchar(255) DEFAULT NULL,
  `gambar_door_trim` varchar(255) DEFAULT NULL,
  `gambar_jok` varchar(255) DEFAULT NULL,
  `gambar_speaker` varchar(255) DEFAULT NULL,
  `gambar_glovebox` varchar(255) DEFAULT NULL,
  `gambar_body` varchar(255) DEFAULT NULL,
  `gambar_bemper_depan` varchar(255) DEFAULT NULL,
  `gambar_bemper_belakang` varchar(255) DEFAULT NULL,
  `gambar_fender_depan` varchar(255) DEFAULT NULL,
  `gambar_fender_belakang` varchar(255) DEFAULT NULL,
  `gambar_box` varchar(255) DEFAULT NULL,
  `gambar_headlamp` varchar(255) DEFAULT NULL,
  `gambar_stoplamp` varchar(255) DEFAULT NULL,
  `gambar_kaca_depan` varchar(255) DEFAULT NULL,
  `gambar_spion` varchar(255) DEFAULT NULL,
  `gambar_ban_depan` varchar(255) DEFAULT NULL,
  `gambar_ban_belakang` varchar(255) DEFAULT NULL,
  `gambar_ban_serep` varchar(255) DEFAULT NULL,
  `gambar_dongkrak` varchar(255) DEFAULT NULL,
  `gambar_kunci_roda` varchar(255) DEFAULT NULL,
  `gambar_stik_roda` varchar(255) DEFAULT NULL,
  `gambar_kotak_p3k` varchar(255) DEFAULT NULL,
  `gambar_warning_triangle` varchar(255) DEFAULT NULL,
  `gambar_stnk` varchar(255) DEFAULT NULL,
  `gambar_kir` varchar(255) DEFAULT NULL,
  `gambar_kartu_kir` varchar(255) DEFAULT NULL,
  `gambar_sipa` varchar(255) DEFAULT NULL,
  `gambar_ibm` varchar(255) DEFAULT NULL,
  `id_audit_detail` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_gambar`
--

INSERT INTO `detail_gambar` (`id`, `gambar_cap_ban`, `gambar_stiker`, `gambar_dashcam`, `gambar_sunvisor`, `gambar_klakson`, `gambar_door_trim`, `gambar_jok`, `gambar_speaker`, `gambar_glovebox`, `gambar_body`, `gambar_bemper_depan`, `gambar_bemper_belakang`, `gambar_fender_depan`, `gambar_fender_belakang`, `gambar_box`, `gambar_headlamp`, `gambar_stoplamp`, `gambar_kaca_depan`, `gambar_spion`, `gambar_ban_depan`, `gambar_ban_belakang`, `gambar_ban_serep`, `gambar_dongkrak`, `gambar_kunci_roda`, `gambar_stik_roda`, `gambar_kotak_p3k`, `gambar_warning_triangle`, `gambar_stnk`, `gambar_kir`, `gambar_kartu_kir`, `gambar_sipa`, `gambar_ibm`, `id_audit_detail`) VALUES
(14, 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', '6697831a07950_2021-06-20 (2).png', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', '6697831a07d15_2021-06-12 (1).png', '6697831a07f76_2021-06-12.png', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 'kosong', 37);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id` bigint NOT NULL,
  `nama_pemilik` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nomor_telp_pemilik` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `nomor_plat` varchar(20) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `tahun_pembuatan` year NOT NULL,
  `bu` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id`, `nama_pemilik`, `nomor_telp_pemilik`, `nomor_plat`, `jenis_kendaraan`, `kota`, `model`, `tahun_pembuatan`, `bu`, `created_at`, `updated_at`) VALUES
(6, 'Albert Enstein', '08346265909', 'DM 29123', 'Toyota Avanza', 'Suka Bummi', 'baru', '2022', 'tes', '2024-07-08 03:57:38', '2024-07-08 03:57:38'),
(8, 'Jhon Alpha Edison', '08122121', 'LlhklqR97u', 'f3hC5v4Wcy', 'kr39XXgrqW', '2B8cHPh3rF', '2011', 'snlK3IVg4Y', '2024-07-08 04:21:18', '2024-07-08 04:21:18'),
(9, 'Hitler', '08119922', 'b 22119', 'Lamborgini', 'Kota Hantu', 'Lama', '2027', '1231123', '2024-07-10 11:32:22', '2024-07-10 11:32:22'),
(10, 'didin', '0812311', 'DM 29123', 'porche', 'gorontalo', 'baru', '2024', 'dksjdkfjalfjalk', '2024-07-17 08:08:02', '2024-07-17 08:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','auditor') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(8, 'admin', '$2y$10$4pZjMUcXX7KMWg8CtIP8geUgzifplT8YuKSfIQ37Ejj02vPbv7Cy6', 'admin', '2024-07-04 10:07:12', '2024-07-04 10:07:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit`
--
ALTER TABLE `audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kendaraan` (`id_kendaraan`),
  ADD KEY `audit_ibfk_1` (`id_user`);

--
-- Indexes for table `detail_audit`
--
ALTER TABLE `detail_audit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_audit` (`id_audit`);

--
-- Indexes for table `detail_gambar`
--
ALTER TABLE `detail_gambar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_audit_detail` (`id_audit_detail`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
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
-- AUTO_INCREMENT for table `audit`
--
ALTER TABLE `audit`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `detail_audit`
--
ALTER TABLE `detail_audit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `detail_gambar`
--
ALTER TABLE `detail_gambar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit`
--
ALTER TABLE `audit`
  ADD CONSTRAINT `audit_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `detail_audit`
--
ALTER TABLE `detail_audit`
  ADD CONSTRAINT `detail_audit_ibfk_1` FOREIGN KEY (`id_audit`) REFERENCES `audit` (`id`);

--
-- Constraints for table `detail_gambar`
--
ALTER TABLE `detail_gambar`
  ADD CONSTRAINT `detail_gambar_ibfk_1` FOREIGN KEY (`id_audit_detail`) REFERENCES `detail_audit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
