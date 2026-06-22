-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2026 at 07:36 AM
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
-- Database: `db_uas_pbo_ti1c_nadiarizkyrahmadani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` decimal(12,2) NOT NULL,
  `jenis_karyawan` enum('Kontrak','Tetap','Magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(12,2) DEFAULT NULL,
  `opsi_saham_id` varchar(50) DEFAULT NULL,
  `uang_saku_bulanan` decimal(12,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
('K001', 'Andi Wijaya', 'IT Support', 22, '150000.00', 'Kontrak', 12, 'PT Mitratama', NULL, NULL, NULL, NULL),
('K002', 'Budi Santoso', 'Marketing', 20, '140000.00', 'Kontrak', 6, 'PT Mitratama', NULL, NULL, NULL, NULL),
('K003', 'Citra Lestari', 'Finance', 21, '160000.00', 'Kontrak', 12, 'PT Global Daya', NULL, NULL, NULL, NULL),
('K004', 'Deni Prasetyo', 'Operations', 23, '145000.00', 'Kontrak', 6, 'PT Global Daya', NULL, NULL, NULL, NULL),
('K005', 'Eka Putri', 'HRD', 19, '150000.00', 'Kontrak', 24, 'PT Mitratama', NULL, NULL, NULL, NULL),
('K006', 'Fahmi Anwar', 'IT Support', 22, '155000.00', 'Kontrak', 12, 'PT Sukses Bersama', NULL, NULL, NULL, NULL),
('K007', 'Gita Permata', 'Marketing', 20, '140000.00', 'Kontrak', 6, 'PT Sukses Bersama', NULL, NULL, NULL, NULL),
('M001', 'Oki Pratama', 'IT Support', 18, '80000.00', 'Magang', NULL, NULL, NULL, NULL, '1500000.00', 'Sertifikat MSIB - Batch 5'),
('M002', 'Putri Utami', 'Marketing', 20, '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'Sertifikat MSIB - Batch 5'),
('M003', 'Rian Hidayat', 'HRD', 15, '80000.00', 'Magang', NULL, NULL, NULL, NULL, '1500000.00', 'Sertifikat Internal PT'),
('M004', 'Siti Aminah', 'Finance', 22, '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'Sertifikat MSIB - Batch 6'),
('M005', 'Taufik Hidayat', 'IT Engineering', 19, '90000.00', 'Magang', NULL, NULL, NULL, NULL, '1800000.00', 'Sertifikat MSIB - Batch 6'),
('M006', 'Utari Dewi', 'Operations', 20, '75000.00', 'Magang', NULL, NULL, NULL, NULL, '1200000.00', 'Sertifikat Internal PT'),
('M007', 'Viko Aldiano', 'Marketing', 17, '80000.00', 'Magang', NULL, NULL, NULL, NULL, '1500000.00', 'Sertifikat MSIB - Batch 5'),
('T001', 'Hendra Kusuma', 'IT Engineering', 22, '250000.00', 'Tetap', NULL, NULL, '500000.00', 'ESOP-001', NULL, NULL),
('T002', 'Indah Rahayu', 'Finance', 21, '240000.00', 'Tetap', NULL, NULL, '450000.00', 'ESOP-002', NULL, NULL),
('T003', 'Joko Susilo', 'Operations', 23, '230000.00', 'Tetap', NULL, NULL, '400000.00', 'ESOP-003', NULL, NULL),
('T004', 'Kurniawan', 'HRD', 20, '250000.00', 'Tetap', NULL, NULL, '500000.00', 'ESOP-004', NULL, NULL),
('T005', 'Larasati', 'Marketing', 22, '240000.00', 'Tetap', NULL, NULL, '450000.00', 'ESOP-005', NULL, NULL),
('T006', 'Muhammad Rizky', 'IT Engineering', 21, '260000.00', 'Tetap', NULL, NULL, '600000.00', 'ESOP-006', NULL, NULL),
('T007', 'Nadia Safitri', 'Finance', 22, '245000.00', 'Tetap', NULL, NULL, '450000.00', 'ESOP-007', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
