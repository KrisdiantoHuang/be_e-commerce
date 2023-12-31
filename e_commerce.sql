-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2023 at 05:12 PM
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
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_tb`
--

CREATE TABLE `barang_tb` (
  `gambar_brg` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `kode_brg` int NOT NULL,
  `nama_brg` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `harga_brg` int NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `stok_brg` int NOT NULL,
  `deskripsi_brg` varchar(900) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_tb`
--

CREATE TABLE `kategori_tb` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `kategori_tb`
--

INSERT INTO `kategori_tb` (`id_kategori`, `nama_kategori`) VALUES
(1, 'alip'),
(2, 'septii'),
(3, 'macbook'),
(4012, 'iphone');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_tb`
--
ALTER TABLE `barang_tb`
  ADD PRIMARY KEY (`kode_brg`);

--
-- Indexes for table `kategori_tb`
--
ALTER TABLE `kategori_tb`
  ADD PRIMARY KEY (`id_kategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_tb`
--
ALTER TABLE `barang_tb`
  MODIFY `kode_brg` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_tb`
--
ALTER TABLE `kategori_tb`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4013;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
