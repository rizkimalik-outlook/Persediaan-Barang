-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2020 at 04:46 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40
-- update

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_persediaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `is_barang`
--

CREATE TABLE `is_barang` (
  `id_barang` varchar(7) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_barang`
--

INSERT INTO `is_barang` (`id_barang`, `nama_barang`, `id_jenis`, `id_satuan`, `stok`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
('B000001', 'Pupuk Pulkalet', 1, 2, 310, 3, '2017-03-12 16:31:31', 3, '2020-07-28 19:19:18'),
('B000002', 'Pupuk Dolomite', 1, 2, 0, 3, '2017-03-12 16:31:48', 3, '2020-07-28 19:16:21'),
('B000003', 'Pupuk KCL/MOP', 1, 2, 579, 3, '2017-03-12 16:32:04', 3, '2020-07-28 19:16:35'),
('B000004', 'Gesapax 500 PW', 3, 4, 0, 3, '2017-03-12 16:32:24', 3, '2018-07-17 12:05:53'),
('B000005', 'Amonia Cair', 7, 4, 200, 3, '2017-03-12 16:32:42', 3, '2020-07-28 19:18:51'),
('B000006', 'Asam Sulfate PA 731', 7, 4, 0, 3, '2017-03-12 16:32:59', 3, '2018-07-17 12:05:53'),
('B000007', 'Vitamin Karet Plus Kemasan 1 Kg', 2, 2, 0, 3, '2017-03-12 16:33:15', 3, '2018-07-17 12:05:43'),
('B000008', 'Pupuk Paket B', 3, 2, -50, 3, '2020-06-10 07:31:12', 1, '2020-07-28 19:15:49'),
('B000009', 'Pupuk Paket C', 2, 4, 21, 3, '2020-06-11 12:55:16', 1, '2020-07-28 19:16:59'),
('B000010', 'Pupuk Paket A', 2, 2, 0, 1, '2020-07-28 19:14:02', 1, '2020-07-28 19:14:02'),
('B000011', 'Pupuk Spesies A', 8, 7, 0, 1, '2020-07-28 19:18:00', 1, '2020-07-28 19:18:00'),
('B000012', 'Pupuk Spesies B', 10, 5, 0, 1, '2020-07-28 19:18:15', 1, '2020-07-28 19:18:15'),
('B000013', 'Pupuk Spesies C', 4, 4, 0, 1, '2020-07-28 19:18:28', 1, '2020-07-28 19:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `is_barang_keluar`
--

CREATE TABLE `is_barang_keluar` (
  `id_barang_keluar` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `status` enum('Proses','Approve','Reject') NOT NULL DEFAULT 'Proses',
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_barang_keluar`
--

INSERT INTO `is_barang_keluar` (`id_barang_keluar`, `tanggal_keluar`, `id_barang`, `jumlah_keluar`, `status`, `created_user`, `created_date`) VALUES
('TK-2018-0000001', '2018-07-17', 'B000001', 500, 'Approve', 3, '2018-07-17 12:17:24'),
('TK-2018-0000002', '2018-07-17', 'B000002', 100, 'Reject', 3, '2018-07-17 12:17:01'),
('TK-2019-0000003', '2019-06-18', 'B000002', 450, 'Approve', 1, '2020-06-10 07:46:18'),
('TK-2020-0000004', '2020-06-10', 'B000008', 250, 'Approve', 3, '2020-06-10 07:46:17'),
('TK-2020-0000005', '2020-06-10', 'B000008', 300, 'Approve', 1, '2020-06-10 07:46:17'),
('TK-2020-0000006', '2020-06-11', 'B000009', 499, 'Approve', 3, '2020-06-11 13:07:03'),
('TK-2020-0000007', '2020-07-25', 'B000003', 20, 'Reject', 1, '2020-07-25 06:58:50'),
('TK-2020-0000008', '2020-07-28', 'B000002', 50, 'Proses', 1, '2020-07-28 19:16:21'),
('TK-2020-0000009', '2020-07-28', 'B000001', 210, 'Proses', 1, '2020-07-28 19:16:27'),
('TK-2020-0000010', '2020-07-28', 'B000003', 120, 'Proses', 1, '2020-07-28 19:16:35'),
('TK-2020-0000011', '2020-07-28', 'B000001', 500, 'Proses', 1, '2020-07-28 19:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `is_barang_masuk`
--

CREATE TABLE `is_barang_masuk` (
  `id_barang_masuk` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_barang_masuk`
--

INSERT INTO `is_barang_masuk` (`id_barang_masuk`, `tanggal_masuk`, `id_barang`, `jumlah_masuk`, `created_user`, `created_date`) VALUES
('TM-2018-0000001', '2018-07-17', 'B000001', 1000, 3, '2018-07-17 12:06:31'),
('TM-2018-0000002', '2018-07-17', 'B000002', 500, 3, '2018-07-17 12:06:39'),
('TM-2018-0000003', '2018-07-17', 'B000003', 100, 3, '2018-07-17 12:06:56'),
('TM-2019-0000004', '2019-06-18', 'B000003', 30, 1, '2019-06-18 06:43:47'),
('TM-2020-0000005', '2020-06-10', 'B000008', 500, 3, '2020-06-10 07:44:18'),
('TM-2020-0000006', '2020-06-11', 'B000009', 500, 3, '2020-06-11 12:57:47'),
('TM-2020-0000007', '2020-07-25', 'B000009', 20, 1, '2020-07-25 06:58:40'),
('TM-2020-0000008', '2020-07-28', 'B000001', 500, 1, '2020-07-28 19:14:56'),
('TM-2020-0000009', '2020-07-28', 'B000003', 515, 1, '2020-07-28 19:15:04'),
('TM-2020-0000010', '2020-07-28', 'B000003', 54, 1, '2020-07-28 19:15:20'),
('TM-2020-0000011', '2020-07-28', 'B000005', 200, 1, '2020-07-28 19:18:51'),
('TM-2020-0000012', '2020-07-28', 'B000001', 20, 1, '2020-07-28 19:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `is_jenis_barang`
--

CREATE TABLE `is_jenis_barang` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_jenis_barang`
--

INSERT INTO `is_jenis_barang` (`id_jenis`, `nama_jenis`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(1, 'Pupuk Kimia Alam', 3, '2017-03-12 02:59:45', 3, '2017-03-12 03:01:03'),
(2, 'Pupuk Hijau', 3, '2017-03-12 02:59:58', 3, '2017-03-12 03:01:06'),
(3, 'Herbisida', 3, '2017-03-12 03:00:08', 3, '2017-03-12 03:01:10'),
(4, 'Fungisida', 3, '2017-03-12 03:00:19', 3, '2017-03-12 03:01:13'),
(5, 'Insektisida', 3, '2017-03-12 03:00:29', 3, '2017-03-12 03:01:16'),
(6, 'Bahan Stimulasi', 3, '2017-03-12 03:00:39', 3, '2017-03-12 03:01:19'),
(7, 'Bahan Kimia Pengolahan', 3, '2017-03-12 03:00:49', 3, '2017-03-12 03:01:22'),
(8, 'Pupuk Kompos', 1, '2020-07-28 19:14:16', 1, '2020-07-28 19:14:16'),
(9, 'Pupuk Kandang', 1, '2020-07-28 19:14:24', 1, '2020-07-28 19:14:24'),
(10, 'Pupuk OR', 1, '2020-07-28 19:14:39', 1, '2020-07-28 19:14:39');

-- --------------------------------------------------------

--
-- Table structure for table `is_satuan`
--

CREATE TABLE `is_satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(30) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_satuan`
--

INSERT INTO `is_satuan` (`id_satuan`, `nama_satuan`, `created_user`, `created_date`, `updated_user`, `updated_date`) VALUES
(1, 'Gram', 3, '2017-03-12 02:57:35', 3, '2017-03-12 02:57:45'),
(2, 'Kilogram', 3, '2017-03-12 02:58:07', 3, '2017-03-12 02:59:01'),
(3, 'Meter', 3, '2017-03-12 02:58:19', 3, '2017-03-12 02:59:04'),
(4, 'Liter', 3, '2017-03-12 02:58:25', 3, '2017-03-12 02:59:08'),
(5, 'Botol', 3, '2017-03-12 02:58:36', 3, '2017-03-12 02:59:10'),
(6, 'Lebar', 3, '2017-03-12 02:58:46', 3, '2017-03-12 02:59:13'),
(7, 'Tabung', 3, '2017-03-12 02:58:52', 3, '2017-03-12 02:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `is_users`
--

CREATE TABLE `is_users` (
  `id_user` smallint(6) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','Manajer','Gudang') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `is_users`
--

INSERT INTO `is_users` (`id_user`, `username`, `nama_user`, `password`, `email`, `telepon`, `foto`, `hak_akses`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Rizald', '202cb962ac59075b964b07152d234b70', 'rizal@gmail.com', '0856515662312', '1595149329994.png', 'Super Admin', 'aktif', '2016-05-01 08:42:53', '2020-07-28 19:12:26'),
(2, 'manajer', 'Don', '202cb962ac59075b964b07152d234b70', 'don@gmail.com', '0817845645645', 'kadina.png', 'Manajer', 'aktif', '2016-08-01 08:42:53', '2020-07-28 19:12:47'),
(3, 'gudang', 'Jan', '202cb962ac59075b964b07152d234b70', 'jan@gmail.com', '0565645645646', '1469574126_users-10.png', 'Gudang', 'aktif', '2017-03-11 14:41:46', '2020-07-28 19:20:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `is_barang`
--
ALTER TABLE `is_barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis` (`id_jenis`),
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indexes for table `is_barang_keluar`
--
ALTER TABLE `is_barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `created_user` (`created_user`);

--
-- Indexes for table `is_barang_masuk`
--
ALTER TABLE `is_barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `created_user` (`created_user`);

--
-- Indexes for table `is_jenis_barang`
--
ALTER TABLE `is_jenis_barang`
  ADD PRIMARY KEY (`id_jenis`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indexes for table `is_satuan`
--
ALTER TABLE `is_satuan`
  ADD PRIMARY KEY (`id_satuan`),
  ADD KEY `created_user` (`created_user`),
  ADD KEY `updated_user` (`updated_user`);

--
-- Indexes for table `is_users`
--
ALTER TABLE `is_users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `level` (`hak_akses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `is_jenis_barang`
--
ALTER TABLE `is_jenis_barang`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `is_satuan`
--
ALTER TABLE `is_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `is_users`
--
ALTER TABLE `is_users`
  MODIFY `id_user` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `is_barang`
--
ALTER TABLE `is_barang`
  ADD CONSTRAINT `is_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_ibfk_3` FOREIGN KEY (`id_satuan`) REFERENCES `is_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_ibfk_4` FOREIGN KEY (`id_jenis`) REFERENCES `is_jenis_barang` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `is_barang_keluar`
--
ALTER TABLE `is_barang_keluar`
  ADD CONSTRAINT `is_barang_keluar_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_keluar_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `is_barang_masuk`
--
ALTER TABLE `is_barang_masuk`
  ADD CONSTRAINT `is_barang_masuk_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `is_jenis_barang`
--
ALTER TABLE `is_jenis_barang`
  ADD CONSTRAINT `is_jenis_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_jenis_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `is_satuan`
--
ALTER TABLE `is_satuan`
  ADD CONSTRAINT `is_satuan_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `is_satuan_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
