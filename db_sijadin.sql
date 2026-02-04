-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2026 at 12:14 PM
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
-- Database: `db_sijadin`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2026_02_02_065137_create_tb_subkegiatan_table', 2),
(8, '2026_02_02_070011_create_tb_kdrekening_table', 2),
(9, '2026_02_02_070436_create_tb_tahun_table', 2),
(10, '2026_02_02_070613_create_tb_anggaran_table', 3),
(11, '2026_02_02_071242_create_tb_pegawai_table', 3),
(12, '2026_02_02_071440_create_tb_perjadin_table', 3),
(13, '2026_02_02_072552_create_tb_rperjadin_table', 3),
(14, '2026_02_04_080525_create_tb_dpa_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggaran`
--

CREATE TABLE `tb_anggaran` (
  `id_anggaran` varchar(6) NOT NULL,
  `id_tahun` varchar(4) NOT NULL,
  `id_subkegiatan` varchar(4) NOT NULL,
  `id_rekening` varchar(4) NOT NULL,
  `id_pegawai` varchar(7) NOT NULL,
  `pagu` decimal(12,9) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_dpa`
--

CREATE TABLE `tb_dpa` (
  `id_dpa` varchar(9) NOT NULL,
  `dpa` varchar(80) NOT NULL,
  `tgl` date NOT NULL,
  `id_tahun` varchar(6) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_dpa`
--

INSERT INTO `tb_dpa` (`id_dpa`, `dpa`, `tgl`, `id_tahun`, `status`, `created_at`, `updated_at`) VALUES
('dpa-00001', 'DPPA/A.3/2.17.0.00.0.00.01.0000/001/2025', '2025-10-12', 'th-001', 1, '2026-02-04 02:29:01', '2026-02-04 02:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kdrekening`
--

CREATE TABLE `tb_kdrekening` (
  `id_rekening` varchar(8) NOT NULL,
  `kd_rekening` varchar(30) NOT NULL,
  `nm_rekening` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_kdrekening`
--

INSERT INTO `tb_kdrekening` (`id_rekening`, `kd_rekening`, `nm_rekening`, `status`, `created_at`, `updated_at`) VALUES
('rek00001', '5.1.02.04.01.0001', 'Belanja Perjalanan Dinas Biasa', 1, '2026-02-03 22:22:05', '2026-02-03 22:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` varchar(7) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `pangkgol` varchar(15) NOT NULL,
  `jabatan` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_perjadin`
--

CREATE TABLE `tb_perjadin` (
  `id_perjadin` varchar(10) NOT NULL,
  `id_anggaran` varchar(6) NOT NULL,
  `keperuan` text NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  `pagu` decimal(9,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_rperjadin`
--

CREATE TABLE `tb_rperjadin` (
  `id_rperjadin` varchar(17) NOT NULL,
  `id_perjadin` varchar(10) NOT NULL,
  `id_pegawai` varchar(7) NOT NULL,
  `uang_harian` decimal(10,2) DEFAULT NULL,
  `uang_transportasi` decimal(10,2) DEFAULT NULL,
  `uang_penginapan` decimal(10,2) DEFAULT NULL,
  `penginapan` varchar(100) DEFAULT NULL,
  `maskapaib` varchar(80) DEFAULT NULL,
  `bandarab` varchar(80) DEFAULT NULL,
  `no_tiketb` varchar(30) DEFAULT NULL,
  `no_bookingb` varchar(30) DEFAULT NULL,
  `uang_pesawatb` decimal(10,2) DEFAULT NULL,
  `maskapaip` varchar(80) DEFAULT NULL,
  `bandarap` varchar(80) DEFAULT NULL,
  `no_tiketp` varchar(30) DEFAULT NULL,
  `no_bookingp` varchar(30) DEFAULT NULL,
  `uang_pesawatp` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_subkegiatan`
--

CREATE TABLE `tb_subkegiatan` (
  `id_subkegiatan` varchar(8) NOT NULL,
  `kd_subkegiatan` varchar(30) NOT NULL,
  `nm_subkegiatan` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_subkegiatan`
--

INSERT INTO `tb_subkegiatan` (`id_subkegiatan`, `kd_subkegiatan`, `nm_subkegiatan`, `status`, `created_at`, `updated_at`) VALUES
('sub00001', '2.17.01.1.01.0006', 'Koordinasi dan Penyusunan Laporan Capaian Kinerja dan Ikhtisar Realisasi Kinerja SKPD', 1, '2026-02-02 19:19:29', '2026-02-03 22:51:32'),
('sub00002', '2.17.01.1.02.0004', 'Koordinasi dan Pelaksanaan Akuntansi SKPD', 1, '2026-02-02 19:26:30', '2026-02-02 23:56:58'),
('sub00003', '2.17.01.1.05.0009', 'Pendidikan dan Pelatihan Pegawai Berdasarkan Tugas dan Fungsi', 1, '2026-02-02 20:28:52', '2026-02-02 20:28:52'),
('sub00004', '2.17.01.1.06.0009', 'Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD', 1, '2026-02-02 20:53:14', '2026-02-02 20:53:14'),
('sub00005', '2.17.05.1.01.0001', 'Peningkatan Pemahaman dan Pengetahuan Perkoperasian serta Kapasitas dan Kompetensi SDM Koperasi', 1, '2026-02-02 21:52:37', '2026-02-02 21:52:37'),
('sub00006', '2.17.07.1.01.0002', 'Peningkatan Pemahaman dan Pengetahuan UMKM serta Kapasitas dan Kompetensi SDM UMKM dan Kewirausahaan', 1, '2026-02-02 21:53:06', '2026-02-02 23:55:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tahun`
--

CREATE TABLE `tb_tahun` (
  `id_tahun` varchar(6) NOT NULL,
  `tahun` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_tahun`
--

INSERT INTO `tb_tahun` (`id_tahun`, `tahun`, `status`, `created_at`, `updated_at`) VALUES
('th-001', '2026', 1, '2026-02-04 00:27:01', '2026-02-04 00:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tb_anggaran`
--
ALTER TABLE `tb_anggaran`
  ADD PRIMARY KEY (`id_anggaran`);

--
-- Indexes for table `tb_dpa`
--
ALTER TABLE `tb_dpa`
  ADD PRIMARY KEY (`id_dpa`);

--
-- Indexes for table `tb_kdrekening`
--
ALTER TABLE `tb_kdrekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `tb_perjadin`
--
ALTER TABLE `tb_perjadin`
  ADD PRIMARY KEY (`id_perjadin`);

--
-- Indexes for table `tb_rperjadin`
--
ALTER TABLE `tb_rperjadin`
  ADD PRIMARY KEY (`id_rperjadin`);

--
-- Indexes for table `tb_subkegiatan`
--
ALTER TABLE `tb_subkegiatan`
  ADD PRIMARY KEY (`id_subkegiatan`);

--
-- Indexes for table `tb_tahun`
--
ALTER TABLE `tb_tahun`
  ADD PRIMARY KEY (`id_tahun`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
