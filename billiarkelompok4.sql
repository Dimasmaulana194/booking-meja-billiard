-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 19 Apr 2025 pada 08.07
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billiarkelompok4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `meja`
--

CREATE TABLE `meja` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `tipe` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `meja_id` bigint(20) UNSIGNED NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `jumlah_jam` int(11) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `order_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `meja_id`, `harga`, `jumlah_jam`, `total`, `asal`, `status`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 50000.00, 1, 50000.00, 'vip', 'completed', 'BOLCTR-1-1744850720', '2025-04-16 17:45:20', '2025-04-16 17:45:20'),
(2, 1, 1, 50000.00, 1, 50000.00, 'vip', 'completed', 'BOLCTR-1-1744851411', '2025-04-16 17:56:51', '2025-04-16 17:56:51'),
(3, 1, 2, 50000.00, 1, 50000.00, 'vip', 'completed', 'BOLCTR-1-1744851601', '2025-04-16 18:00:01', '2025-04-16 18:00:01'),
(4, 3, 7, 30000.00, 1, 30000.00, 'regular', 'completed', 'BOLCTR-3-1744852358', '2025-04-16 18:12:38', '2025-04-16 18:12:38'),
(5, 4, 9, 30000.00, 2, 60000.00, 'regular', 'completed', 'BOLCTR-4-1744853682', '2025-04-16 18:34:42', '2025-04-16 18:34:42'),
(6, 4, 8, 30000.00, 1, 30000.00, 'regular', 'completed', 'BOLCTR-4-1744853744', '2025-04-16 18:35:44', '2025-04-16 18:35:44'),
(7, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744854348', '2025-04-16 18:45:48', '2025-04-16 18:45:48'),
(8, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744854553', '2025-04-16 18:49:13', '2025-04-16 18:49:13'),
(9, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744854672', '2025-04-16 18:51:12', '2025-04-16 18:51:12'),
(10, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744854683', '2025-04-16 18:51:23', '2025-04-16 18:51:23'),
(11, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744854689', '2025-04-16 18:51:29', '2025-04-16 18:51:29'),
(12, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744854702', '2025-04-16 18:51:42', '2025-04-16 18:51:42'),
(13, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744854967', '2025-04-16 18:56:07', '2025-04-16 18:56:07'),
(14, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744855428', '2025-04-16 19:03:48', '2025-04-16 19:03:48'),
(15, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744855644', '2025-04-16 19:07:24', '2025-04-16 19:07:24'),
(16, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744855982', '2025-04-16 19:13:02', '2025-04-16 19:13:02'),
(17, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744856184', '2025-04-16 19:16:24', '2025-04-16 19:16:24'),
(18, 4, 6, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744856191', '2025-04-16 19:16:31', '2025-04-16 19:16:31'),
(19, 4, 5, 75000.00, 1, 75000.00, 'vip', 'pending', 'BOLCTR-4-1744856720', '2025-04-16 19:25:20', '2025-04-16 19:25:20'),
(20, 4, 8, 30000.00, 2, 60000.00, 'regular', 'pending', 'BOLCTR-4-1744856743', '2025-04-16 19:25:43', '2025-04-16 19:25:43'),
(21, 1, 7, 30000.00, 3, 90000.00, 'regular', 'pending', 'BOLCTR-1-1744856846', '2025-04-16 19:27:26', '2025-04-16 19:27:26'),
(22, 5, 7, 30000.00, 1, 30000.00, 'regular', 'pending', 'BOLCTR-5-1744857012', '2025-04-16 19:30:12', '2025-04-16 19:30:12'),
(23, 5, 7, 30000.00, 4, 120000.00, 'regular', 'pending', 'BOLCTR-5-1744857025', '2025-04-16 19:30:25', '2025-04-16 19:30:25'),
(24, 5, 9, 30000.00, 4, 120000.00, 'regular', 'pending', 'BOLCTR-5-1744857060', '2025-04-16 19:31:00', '2025-04-16 19:31:00'),
(25, 5, 9, 30000.00, 4, 120000.00, 'regular', 'pending', 'BOLCTR-5-1744857121', '2025-04-16 19:32:01', '2025-04-16 19:32:01'),
(26, 5, 9, 30000.00, 2, 60000.00, 'regular', 'pending', 'BOLCTR-5-1744857244', '2025-04-16 19:34:04', '2025-04-16 19:34:04'),
(27, 5, 2, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-5-1744857335', '2025-04-16 19:35:35', '2025-04-16 19:35:35'),
(28, 5, 2, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-5-1744857971', '2025-04-16 19:46:11', '2025-04-16 19:46:11'),
(29, 5, 2, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-5-1744858208', '2025-04-16 19:50:08', '2025-04-16 19:50:08'),
(30, 5, 2, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-5-1744858220', '2025-04-16 19:50:20', '2025-04-16 19:50:20'),
(31, 5, 2, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-5-1744858230', '2025-04-16 19:50:30', '2025-04-16 19:50:30'),
(32, 1, 7, 30000.00, 1, 30000.00, 'regular', 'pending', 'BOLCTR-1-1744858292', '2025-04-16 19:51:32', '2025-04-16 19:51:32'),
(33, 1, 7, 30000.00, 1, 30000.00, 'regular', 'pending', 'BOLCTR-1-1744858351', '2025-04-16 19:52:31', '2025-04-16 19:52:31'),
(34, 1, 7, 30000.00, 1, 30000.00, 'regular', 'pending', 'BOLCTR-1-1744858570', '2025-04-16 19:56:10', '2025-04-16 19:56:10'),
(35, 1, 2, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-1-1744858586', '2025-04-16 19:56:26', '2025-04-16 19:56:26'),
(36, 1, 1, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-1-1744858752', '2025-04-16 19:59:12', '2025-04-16 19:59:12'),
(37, 1, 1, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-1-1744858800', '2025-04-16 20:00:00', '2025-04-16 20:00:00'),
(38, 1, 1, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-1-1744858998', '2025-04-16 20:03:18', '2025-04-16 20:03:18'),
(39, 5, 11, 30000.00, 7, 210000.00, 'regular', 'pending', 'BOLCTR-5-1744859176', '2025-04-16 20:06:16', '2025-04-16 20:06:16'),
(40, 1, 2, 50000.00, 1, 50000.00, 'vip', 'pending', 'BOLCTR-1-1744860053', '2025-04-16 20:20:53', '2025-04-16 20:20:53'),
(41, 1, 1, 50000.00, 5, 250000.00, 'vip', 'pending', 'BOLCTR-1-1744878024', '2025-04-17 01:20:24', '2025-04-17 01:20:24'),
(42, 4, 9, 30000.00, 1, 30000.00, 'regular', 'pending', 'BOLCTR-4-1744879143', '2025-04-17 01:39:03', '2025-04-17 01:39:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dina', 'dina@gmail.com', NULL, '$2y$10$TRV1rCGzqH/9ebKXquWhIuXyrIv2PcwSNN7LeaGHkAR8/NMASOMtm', 'user', NULL, '2025-04-09 18:36:28', '2025-04-09 18:36:28'),
(2, 'Dimas', 'dimas752007@gmail.com', NULL, '$2y$10$ni307WE8QODOQFZuWK56Bunq6GKGkhgKABgGYRQWSy/RiIdRb1cIm', 'admin', NULL, '2025-04-09 18:37:09', '2025-04-09 18:37:09'),
(3, 'daniel', 'daniel@gmail.com', NULL, '$2y$10$6uoAEfidPtTdqtORVq/DLOVyW8qT/3xlO3pYHjYoxfbHSLxX1MATW', 'user', NULL, '2025-04-16 06:47:35', '2025-04-16 06:47:35'),
(4, 'asep', 'asep12@gmail.com', NULL, '$2y$10$UmRnsXMehRMykuyWPt2n0u6Ds7DbT5Zz3QFTa3yP.4F8IHRFoR18G', 'user', NULL, '2025-04-16 18:33:35', '2025-04-16 18:33:35'),
(5, 'aos', 'aos@gmail.com', NULL, '$2y$10$lVTp.eJdJk4NJUNYeSaTz.FF54donkRe1Onf3Znv0JXmrDTqdFDte', 'user', NULL, '2025-04-16 19:29:35', '2025-04-16 19:29:35'),
(8, 'rama', 'rama@gmail.com', NULL, '$2y$10$RcgRV..m.q0Zdh/AiTtHBesrpWIxFYWG6Gska9VTacUsy/gzrmVVu', 'user', NULL, '2025-04-16 20:19:50', '2025-04-16 20:19:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `meja`
--
ALTER TABLE `meja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
