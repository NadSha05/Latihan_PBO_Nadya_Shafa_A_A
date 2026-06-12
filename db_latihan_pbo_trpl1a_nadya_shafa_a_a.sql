-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2026 at 05:04 AM
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
-- Database: `db_latihan_pbo_trpl1a_nadya_shafa_a_a`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int(11) NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int(11) NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('reguler','imax','velvet') NOT NULL,
  `tipe_audio` varchar(50) DEFAULT NULL,
  `lokasi_baris` varchar(10) DEFAULT NULL,
  `kacamata_3d_id` varchar(20) DEFAULT NULL,
  `efek_gerak_fitur` varchar(50) DEFAULT NULL,
  `bantal_selimut_pack` tinyint(1) DEFAULT NULL,
  `layanan_butler` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'spider-man', '2026-06-12 14:00:00', 100, 45000.00, 'reguler', 'dolby 7.1', 'a1', NULL, NULL, NULL, NULL),
(2, 'spider-man', '2026-06-12 16:00:00', 100, 45000.00, 'reguler', 'dolby 7.1', 'b2', NULL, NULL, NULL, NULL),
(3, 'dilan', '2026-06-12 15:00:00', 80, 40000.00, 'reguler', 'stereo', 'c3', NULL, NULL, NULL, NULL),
(4, 'dilan', '2026-06-12 17:00:00', 80, 40000.00, 'reguler', 'stereo', 'd4', NULL, NULL, NULL, NULL),
(5, 'the conjuring', '2026-06-12 19:00:00', 100, 50000.00, 'reguler', 'dolby 7.1', 'e5', NULL, NULL, NULL, NULL),
(6, 'the conjuring', '2026-06-12 21:00:00', 100, 50000.00, 'reguler', 'dolby 7.1', 'f6', NULL, NULL, NULL, NULL),
(7, 'the conjuring', '2026-06-13 14:00:00', 100, 50000.00, 'reguler', 'dolby 7.1', 'a7', NULL, NULL, NULL, NULL),
(8, 'avatar 3', '2026-06-12 13:00:00', 200, 75000.00, 'imax', 'imax 12.0', NULL, 'g-3d-001', 'vibration', NULL, NULL),
(9, 'avatar 3', '2026-06-12 16:00:00', 200, 75000.00, 'imax', 'imax 12.0', NULL, 'g-3d-002', 'vibration', NULL, NULL),
(10, 'interstellar', '2026-06-12 18:00:00', 200, 80000.00, 'imax', 'imax 12.0', NULL, 'g-3d-003', 'motion', NULL, NULL),
(11, 'interstellar', '2026-06-12 21:00:00', 200, 80000.00, 'imax', 'imax 12.0', NULL, 'g-3d-004', 'motion', NULL, NULL),
(12, 'dune', '2026-06-13 15:00:00', 200, 75000.00, 'imax', 'imax 12.0', NULL, 'g-3d-005', 'vibration', NULL, NULL),
(13, 'dune', '2026-06-13 18:00:00', 200, 75000.00, 'imax', 'imax 12.0', NULL, 'g-3d-006', 'vibration', NULL, NULL),
(14, 'dune', '2026-06-13 21:00:00', 200, 75000.00, 'imax', 'imax 12.0', NULL, 'g-3d-007', 'vibration', NULL, NULL),
(15, 'titanic', '2026-06-12 14:00:00', 40, 150000.00, 'velvet', 'dolby atmos', NULL, NULL, NULL, 1, 1),
(16, 'titanic', '2026-06-12 17:00:00', 40, 150000.00, 'velvet', 'dolby atmos', NULL, NULL, NULL, 1, 1),
(17, 'the notebook', '2026-06-12 20:00:00', 40, 160000.00, 'velvet', 'dolby atmos', NULL, NULL, NULL, 1, 1),
(18, 'the notebook', '2026-06-12 22:00:00', 40, 160000.00, 'velvet', 'dolby atmos', NULL, NULL, NULL, 1, 1),
(19, 'la la land', '2026-06-13 16:00:00', 40, 150000.00, 'velvet', 'dolby atmos', NULL, NULL, NULL, 1, 1),
(20, 'la la land', '2026-06-13 19:00:00', 40, 150000.00, 'velvet', 'dolby atmos', NULL, NULL, NULL, 1, 1),
(21, 'jurassic park', '2026-06-13 16:00:00', 100, 45000.00, 'reguler', 'dolby 7.1', 'g1', NULL, NULL, NULL, NULL),
(22, 'jurassic park', '2026-06-13 18:00:00', 100, 45000.00, 'reguler', 'dolby 7.1', 'h2', NULL, NULL, NULL, NULL),
(23, 'batman begins', '2026-06-13 14:00:00', 200, 80000.00, 'imax', 'imax 12.0', NULL, 'g-3d-008', 'motion', NULL, NULL),
(24, 'batman begins', '2026-06-13 17:00:00', 200, 80000.00, 'imax', 'imax 12.0', NULL, 'g-3d-009', 'motion', NULL, NULL),
(25, 'gladiator', '2026-06-13 20:00:00', 40, 150000.00, 'velvet', 'dolby atmos', NULL, NULL, NULL, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
