-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2026 at 04:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_warkop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_user`) VALUES
(1, 'bintang', '123', 'bintangss');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` int(11) NOT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `total_bayar` int(11) DEFAULT NULL,
  `waktu_cetak` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_menu`
--

CREATE TABLE `kategori_menu` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_menu`
--

INSERT INTO `kategori_menu` (`id_kategori`, `nama_kategori`) VALUES
(1, 'makanan'),
(2, 'minuman'),
(3, 'cemilan');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `rating` decimal(3,1) DEFAULT 0.0,
  `status` enum('aktif','nonaktif') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `harga`, `stok`, `rating`, `status`) VALUES
(2, 2, 'es teh', 10000, 20, 0.0, 'aktif'),
(3, 2, 'kopi', 10000, 5, 0.0, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `no_meja` varchar(10) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `nama_menu` varchar(100) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `status_pesanan` varchar(50) DEFAULT 'belum selesai',
  `id_transaksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `no_meja`, `nama_user`, `nama_menu`, `jumlah`, `status_pesanan`, `id_transaksi`) VALUES
(1, '1', '', NULL, 2, 'belum selesai', NULL),
(2, '1', '', 'nasi uduk', 2, 'selesai', NULL),
(3, '2', 'bintang', 'kopi', 2, 'belum selesai', NULL),
(4, '2', 'bintang', 'es teh', 2, 'belum selesai', NULL),
(5, '5', 'raka', 'kopi', 1, 'belum selesai', NULL),
(6, '6', 'nuness', 'kopi', 1, 'belum selesai', NULL),
(7, '6', 'nuness', 'es teh', 1, 'belum selesai', NULL),
(8, '1', 'skhaaa', 'kopi', 3, 'belum selesai', NULL),
(9, '1', 'skhaaa', 'es teh', 1, 'belum selesai', NULL),
(10, '3', 'aril', 'kopi', 5, 'belum selesai', 19),
(11, '12', 'mesii', 'kopi', 1, 'belum selesai', NULL),
(12, '12', 'mesii', 'es teh', 4, 'belum selesai', NULL),
(13, '2', 'dans', 'kopi', 3, 'belum selesai', 22);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pesanan` int(11) DEFAULT NULL,
  `no_meja` varchar(10) DEFAULT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `metode_bayar` enum('Tunai','Debit','QRIS') NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_transaksi` enum('Pending','Lunas','Batal') DEFAULT 'Pending',
  `nama_user` varchar(100) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `ppn` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `no_meja`, `tanggal_pesan`, `metode_bayar`, `total_harga`, `status_transaksi`, `nama_user`, `subtotal`, `ppn`) VALUES
(13, 0, '04', '2026-05-10 12:14:39', 'Tunai', 13200, '', 'bintang', 12000.00, 1200.00),
(14, 0, '04', '2026-05-10 12:15:56', 'Tunai', 13200, '', 'bintang', 12000.00, 1200.00),
(15, 0, '07', '2026-05-10 12:17:43', 'Tunai', 13200, '', 'japran', 12000.00, 1200.00),
(16, 0, '07', '2026-05-10 12:19:37', 'Tunai', 13200, '', 'japran', 12000.00, 1200.00),
(17, NULL, '6', '2026-05-10 14:03:10', 'Tunai', 22000, 'Lunas', 'nuness', 20000.00, NULL),
(18, NULL, '1', '2026-05-10 14:19:54', 'Tunai', 44000, 'Lunas', 'skhaaa', 40000.00, NULL),
(19, NULL, '3', '2026-05-10 14:23:23', 'Tunai', 55000, 'Lunas', 'aril', 50000.00, NULL),
(20, NULL, '12', '2026-05-10 14:31:17', 'Tunai', 55000, 'Lunas', 'mesii', 50000.00, NULL),
(21, NULL, '5', '2026-05-10 14:35:25', 'Tunai', 66000, 'Lunas', 'danu', 60000.00, NULL),
(22, NULL, '2', '2026-05-10 14:40:11', 'Tunai', 33000, 'Lunas', 'dans', 30000.00, NULL);

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
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_menu` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
