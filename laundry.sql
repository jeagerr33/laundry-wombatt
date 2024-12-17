-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2024 at 04:53 AM
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
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kecamatan`
--

CREATE TABLE `tbl_kecamatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kecamatan`
--

INSERT INTO `tbl_kecamatan` (`id`, `nama`) VALUES
(1, 'Andir'),
(2, 'Arcamanik'),
(3, 'Astana Anyar'),
(4, 'Babakan Ciparay'),
(5, 'Bandung Kidul'),
(6, 'Bandung Kulon'),
(7, 'Bandung Wetan'),
(8, 'Coblong'),
(9, 'Cidadap'),
(10, 'Cibiru'),
(11, 'Cimahi Selatan'),
(12, 'Cimahi Utara'),
(13, 'Lengkong'),
(14, 'Mandalajati'),
(15, 'Panyileukan'),
(16, 'Rancasari'),
(17, 'Regol'),
(18, 'Sumur Bandung'),
(19, 'Kiaracondong'),
(20, 'Bojongloa Kaler'),
(21, 'Bojongloa Kidul');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kelurahan`
--

CREATE TABLE `tbl_kelurahan` (
  `id` int(11) NOT NULL,
  `nama_kelurahan` varchar(15) NOT NULL,
  `idKecamatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kelurahan`
--

INSERT INTO `tbl_kelurahan` (`id`, `nama_kelurahan`, `idKecamatan`) VALUES
(1, 'Andir', 1),
(2, 'Arcamanik', 2),
(3, 'Astana Anyar', 3),
(4, 'Babakan Cipray', 4),
(5, 'Bandung Kidul', 5),
(6, 'Bandung Kulon', 6),
(7, 'Bandung Wetan', 7),
(8, 'Coblong', 8),
(9, 'Cidadap', 9),
(10, 'Cibiru', 10),
(11, 'Cimahi Sel', 11),
(12, 'Cimahi Utara', 12),
(13, 'Lengkong', 13),
(14, 'Mandalajati', 14),
(15, 'Panyileukan', 15),
(16, 'Rancasari', 16),
(17, 'Regol', 17),
(18, 'Sumur Band', 18),
(19, 'Kiaracondong', 19),
(20, 'Bojongloa Kal', 20),
(21, 'Bojongloa Kidul', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mesincuci`
--

CREATE TABLE `tbl_mesincuci` (
  `id` int(11) NOT NULL,
  `nama` varchar(10) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `merek` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `harga_per_15_menit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mesincuci`
--

INSERT INTO `tbl_mesincuci` (`id`, `nama`, `kapasitas`, `merek`, `status`, `harga_per_15_menit`) VALUES
(3, 'Lupi', 7, 'Sharp', 'tersedia', 5000),
(4, 'Dodo', 8, 'Panasonic', 'tersedia', 5500),
(5, 'Wombit', 6, 'Bosch', 'terpakai', 7000),
(13, 'Didi', 10, 'LG', 'tersedia', 6000),
(18, 'Hugo', 9, 'Samsung', 'terpakai', 5000),
(22, 'Wombat', 6, 'Samsung', 'terpakai', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `HP` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_kelurahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`id`, `nama`, `HP`, `email`, `id_kelurahan`) VALUES
(6, 'Andi Pratama', '081234567890', 'andi.pratama@gmail.com', 14),
(7, 'Budi Santoso', '082345678901', 'budi.santoso@yahoo.com', 19),
(8, 'Citra Dewi', '083456789012', 'citra.dewi@hotmail.com', 5),
(9, 'Diana Putri', '084567890123', 'diana.putri@outlook.com', 4),
(10, 'Eka Saputra', '085678901234', 'eka.saputra@gmail.com', 5),
(11, 'Haryono', '081385731538', 'Haryono@gmail.com', 21),
(12, 'Raditya', '081276563789', 'udinsanjaya@gmail.com', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`id`, `nama`, `status`, `password`) VALUES
(1, 'Andi Wijaya', 'pemilik', '123'),
(2, 'Siti Rahmawati', 'pegawai', '456'),
(3, 'Budi Santoso', 'pegawai', '789'),
(4, 'Ani Prasetyo', 'pegawai', 'abc'),
(5, 'Rizky Kurniawan', 'pegawai', 'efg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id` int(11) NOT NULL,
  `tanggalTransaksi` date NOT NULL,
  `waktuMulai` time NOT NULL,
  `waktuSelesai` time NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_mesinCuci` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id`, `tanggalTransaksi`, `waktuMulai`, `waktuSelesai`, `id_pelanggan`, `id_mesinCuci`, `total`) VALUES
(12, '2024-12-01', '00:06:00', '02:08:00', 7, 5, 63000),
(13, '2024-12-02', '08:10:00', '10:08:00', 6, 18, 40000),
(14, '2024-12-30', '15:13:00', '16:11:00', 10, 3, 20000),
(15, '2025-02-08', '11:41:00', '13:48:00', 10, 5, 63000),
(16, '2024-01-25', '02:50:00', '03:48:00', 9, 4, 22000),
(17, '2024-12-22', '08:25:00', '10:25:00', 7, 13, 48000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kelurahan`
--
ALTER TABLE `tbl_kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKecamatan` (`idKecamatan`) USING BTREE;

--
-- Indexes for table `tbl_mesincuci`
--
ALTER TABLE `tbl_mesincuci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idKelurahan` (`id_kelurahan`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_mesinCuci` (`id_mesinCuci`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kecamatan`
--
ALTER TABLE `tbl_kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_kelurahan`
--
ALTER TABLE `tbl_kelurahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_mesincuci`
--
ALTER TABLE `tbl_mesincuci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_kelurahan`
--
ALTER TABLE `tbl_kelurahan`
  ADD CONSTRAINT `tbl_kelurahan_ibfk_1` FOREIGN KEY (`idKecamatan`) REFERENCES `tbl_kecamatan` (`id`);

--
-- Constraints for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD CONSTRAINT `tbl_pelanggan_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `tbl_kelurahan` (`id`);

--
-- Constraints for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tbl_pelanggan` (`id`),
  ADD CONSTRAINT `tbl_transaksi_ibfk_2` FOREIGN KEY (`id_mesinCuci`) REFERENCES `tbl_mesincuci` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
