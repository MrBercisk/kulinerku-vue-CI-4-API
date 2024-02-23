-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kulinerku`
--

-- --------------------------------------------------------

--
-- Table structure for table `best_foods`
--

CREATE TABLE `best_foods` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `best_foods`
--

INSERT INTO `best_foods` (`id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-02-23 10:42:29', '2024-02-23 10:42:29'),
(2, 3, '2024-02-23 10:42:29', '2024-02-23 10:42:29');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `jumlah_pesan` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id`, `product_id`, `jumlah_pesan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '', '2024-02-23 07:52:44', '2024-02-23 07:52:44'),
(2, 7, 1, 'Pedas', '2024-02-23 08:38:43', '2024-02-23 08:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `keranjang_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_meja` int(11) NOT NULL,
  `totalHarga` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `keranjang_id`, `nama`, `no_meja`, `totalHarga`, `created_at`, `updated_at`) VALUES
(1, 2, 'scofield', 1, 32000.00, '2024-02-23 09:25:43', '2024-02-23 09:25:43'),
(2, 1, 'scofield', 1, 32000.00, '2024-02-23 09:25:43', '2024-02-23 09:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` text NOT NULL,
  `is_ready` tinyint(1) DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `kode`, `nama`, `harga`, `gambar`, `is_ready`, `created_at`, `updated_at`) VALUES
(1, 'F-01', 'Kentang Goreng', 10000.00, '1708657687_ecd631a00a23612baeb9.jpg', 1, '2024-02-23 03:08:07', '2024-02-23 03:08:07'),
(2, 'F-02', 'Bakso', 15000.00, '1708658293_d0ed970b249e9e65ad6a.jpg', 1, '2024-02-23 03:18:13', '2024-02-23 03:18:13'),
(3, 'F-03', 'Mie Ayam Bakso', 15000.00, '1708658351_cd329fcebea6e39e06ec.jpg', 1, '2024-02-23 03:19:11', '2024-02-23 03:19:11'),
(4, 'F-04', 'Mie goreng', 10000.00, '1708658730_747b9655a768663ac1ec.jpg', 1, '2024-02-23 03:25:30', '2024-02-23 03:25:30'),
(5, 'F-05', 'Sate Ayam', 12000.00, '1708658889_bb6650a276c4a6a71e4d.jpg', 1, '2024-02-23 03:28:09', '2024-02-23 03:28:09'),
(6, 'F-06', 'Nasi Goreng', 10000.00, '1708658918_46fcccad6b72fd35e260.jpg', 1, '2024-02-23 03:28:38', '2024-02-23 03:28:38'),
(7, 'F-07', 'Ayam Geprek', 12000.00, '1708659509_6da479a4b78de10cd7f6.jpg', 1, '2024-02-23 03:38:29', '2024-02-23 03:38:29'),
(8, 'F-08', 'Lontong Opor', 10000.00, '1708659540_060e26f30dda9652dfe0.jpg', 1, '2024-02-23 03:39:00', '2024-02-23 03:39:00'),
(9, 'F-09', 'Nasi Ramess', 15000.00, '1708659574_93f8cae7e06dec0dd87e.jpg', 1, '2024-02-23 03:39:34', '2024-02-23 07:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin@gmail.com', '$2y$10$REScHmoJTwit1m.Faog6.uiU7sFQ9DFawQO13PsiRPQa3gj6GxqWq', '2024-02-15 14:29:26', '2024-02-15 14:29:26'),
(2, 2, 'tes', 'tes@gmail.com', '$2y$10$3mugSx5UoE9I8K4qmgLEKO2I19z1S3BtjVmMskBPIVWioig7R2fea', '2024-02-15 07:32:41', '2024-02-15 07:32:41'),
(3, 2, 'bim', 'kingbercisk@gmail.com', '$2y$10$6lsAxjO46E9dgBf85WHUWOwfVGfuTzTW3nbt1YRyVwvKS2oGRZUo6', '2024-02-15 07:33:31', '2024-02-15 07:33:31'),
(4, 2, 'tes1', 'tes1@gmail.com', '$2y$10$28Aa2HHAbL7qwufqqYu/zOS3Yu9U8IzuUqvr0tzVzBDaxXPgUudYK', '2024-02-15 07:35:08', '2024-02-15 07:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `best_foods`
--
ALTER TABLE `best_foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`keranjang_id`),
  ADD KEY `keranjang_id` (`keranjang_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `best_foods`
--
ALTER TABLE `best_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `best_foods`
--
ALTER TABLE `best_foods`
  ADD CONSTRAINT `best_foods_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`keranjang_id`) REFERENCES `keranjang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
