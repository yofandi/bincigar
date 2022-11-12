-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 27, 2019 at 10:34 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bincigar1807`
--

-- --------------------------------------------------------

--
-- Table structure for table `bagan_store`
--

CREATE TABLE `bagan_store` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bagan_store`
--

INSERT INTO `bagan_store` (`id`, `nama`, `deskripsi`) VALUES
(1, 'STORE', 'Toko BIN'),
(2, 'AGENT', 'Penjualan Orang per orang'),
(3, 'PHRI', 'Hotel-hotel'),
(4, 'NON PHRI', 'Outlet, Pusat oleh-oleh, Cafe, dll'),
(5, 'EXPORT', 'Penjualan luar negeri');

-- --------------------------------------------------------

--
-- Table structure for table `binding`
--

CREATE TABLE `binding` (
  `id` int(11) NOT NULL,
  `produk` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `stock` decimal(10,2) NOT NULL,
  `terpakai` decimal(10,2) NOT NULL,
  `sisa_stock` decimal(10,2) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `binding`
--

INSERT INTO `binding` (`id`, `produk`, `jenis`, `stock`, `terpakai`, `sisa_stock`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', '200.00', '10.50', '189.50', 400, 390, 10, 'lanjut ke pressing', '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', '300.00', '23.20', '276.80', 500, 490, 10, '', '2018-09-13', 'admins'),
(3, 'Corona', 'TS', '100.00', '9.00', '91.00', 420, 410, 10, '', '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', '100.00', '12.42', '87.58', 300, 299, 1, '', '2018-09-17', 'admins'),
(5, 'Robusto', 'VIRGINIA', '137.58', '50.00', '87.58', 301, 250, 51, '', '2018-10-07', 'proses'),
(6, 'Sumatra', 'PADANG', '350.00', '300.00', '50.00', 1000, 1000, 0, 'mak nyus', '2018-11-20', 'admins'),
(7, 'Tambo', 'TAMBO', '300.00', '300.00', '0.00', 1000, 1000, 0, '', '2018-11-23', 'admins'),
(9, 'Robusto', 'TH', '10.00', '4.35', '5.65', 966, 966, 0, '', '2018-12-31', 'bin cigar'),
(12, 'Magic', 'VIRGINIA', '87.58', '10.00', '77.58', 1000, 950, 50, 'binding coy', '2019-02-25', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `binding_tmp`
--

CREATE TABLE `binding_tmp` (
  `id_bind` int(11) NOT NULL,
  `produk_bind` varchar(20) NOT NULL,
  `jenis_bind` varchar(20) NOT NULL,
  `hasil_today` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `binding_tmp`
--

INSERT INTO `binding_tmp` (`id_bind`, `produk_bind`, `jenis_bind`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 73),
(2, 'Robusto', 'H8', 84),
(3, 'Corona', 'TS', 1),
(4, 'Corona', 'H8', 5),
(5, 'Robusto', 'VIRGINIA', 0),
(6, 'Sumatra', 'PADANG', 50),
(7, 'Tambo', 'TAMBO', 0),
(8, 'Robusto', 'TH', 966),
(9, 'Magic', 'VIRGINIA', 25);

-- --------------------------------------------------------

--
-- Table structure for table `cerutu_terjual`
--

CREATE TABLE `cerutu_terjual` (
  `id_cr_terjual` int(11) NOT NULL,
  `id_penjualan_bagan` int(11) NOT NULL,
  `id_subproduk` int(11) NOT NULL,
  `jml` int(3) NOT NULL,
  `diskon_cerutu_terjual` int(5) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cerutu_terjual`
--

INSERT INTO `cerutu_terjual` (`id_cr_terjual`, `id_penjualan_bagan`, `id_subproduk`, `jml`, `diskon_cerutu_terjual`, `total`, `tanggal`) VALUES
(1, 11, 1, 2, 0, 1080000, '2018-10-04'),
(2, 11, 3, 1, 0, 165000, '2018-10-04'),
(3, 12, 3, 2, 0, 330000, '2018-10-04'),
(4, 13, 3, 1, 0, 165000, '2018-10-04'),
(5, 14, 3, 2, 0, 330000, '2018-10-04'),
(6, 15, 3, 2, 0, 330000, '2018-10-04'),
(7, 16, 3, 1, 0, 165000, '2018-10-07'),
(8, 16, 8, 1, 0, 250000, '2018-10-07'),
(9, 17, 1, 1, 0, 540000, '2018-10-07'),
(11, 19, 1, 1, 0, 540000, '2018-10-07'),
(12, 20, 1, 1, 0, 540000, '2018-10-07'),
(13, 21, 1, 1, 0, 540000, '2018-10-07'),
(14, 22, 6, 1, 0, 800000, '2018-10-08'),
(15, 23, 12, 1, 0, 80000, '2018-11-20'),
(16, 24, 1, 2, 10, 972000, '2018-11-20'),
(17, 24, 12, 2, 10, 144000, '2018-11-20'),
(18, 25, 1, 5, 10, 2430000, '2019-01-01'),
(19, 26, 3, 2, 10, 297000, '2019-01-02');

-- --------------------------------------------------------

--
-- Table structure for table `cincin`
--

CREATE TABLE `cincin` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(15) NOT NULL,
  `awal` int(10) NOT NULL,
  `masuk` int(10) NOT NULL,
  `terpakai` int(10) NOT NULL,
  `afkir` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cincin`
--

INSERT INTO `cincin` (`id`, `nama_produk`, `awal`, `masuk`, `terpakai`, `afkir`, `stock`, `tanggal`) VALUES
(5, 'Robusto', 3913, 7000, 285, 42, 10586, '2018-06-22'),
(6, 'Corona', 3563, 6000, 213, 35, 9315, '2018-06-22'),
(7, 'Corona', 200, 10, 4, 1, 205, '2018-06-26'),
(9, 'Robusto', 3000, 200, 100, 20, 3080, '2018-06-27'),
(10, 'Robusto', 4793, 0, 500, 0, 4293, '2018-09-10'),
(11, 'Robusto', 4293, 0, 10, 12, 4271, '2019-02-19'),
(12, 'Robusto', 4273, 0, 70, 2, 4201, '2019-02-20'),
(14, 'Secretos', 0, 100, 0, 0, 100, '2019-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `cool`
--

CREATE TABLE `cool` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(10) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cool`
--

INSERT INTO `cool` (`id`, `produk`, `jenis`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', 360, 355, 5, '30 menit', '', '2018-09-10', 0),
(2, 'Robusto', 'H8', 445, 440, 5, '2 jam', '', '2018-09-13', 0),
(3, 'Corona', 'TS', 392, 390, 2, '2 jam', '', '2018-09-14', 0),
(4, 'Robusto', 'VIRGINIA', 280, 278, 2, '1 jam, 30 ', '', '2018-09-17', 0),
(5, 'Robusto', 'VIRGINIA', 252, 250, 2, '4 jam 15me', '', '2018-10-07', 0),
(6, 'Sumatra', 'PADANG', 915, 900, 15, '2 jam', '', '2018-11-20', 0),
(7, 'Tambo', 'TAMBO', 900, 900, 0, '4 jam', '', '2018-11-23', 0),
(8, 'Robusto', 'TH', 966, 966, 0, '24 jam', '', '2018-12-31', 0),
(10, 'Magic', 'VIRGINIA', 880, 870, 10, '3 jam', '', '2019-02-26', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cool_tmp`
--

CREATE TABLE `cool_tmp` (
  `id_cool` int(11) NOT NULL,
  `produk_cool` varchar(20) NOT NULL,
  `jenis_cool` varchar(20) NOT NULL,
  `hasil_today` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cool_tmp`
--

INSERT INTO `cool_tmp` (`id_cool`, `produk_cool`, `jenis_cool`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 5),
(2, 'Robusto', 'H8', 5),
(3, 'Corona', 'TS', 2),
(4, 'Robusto', 'VIRGINIA', 0),
(5, 'Sumatra', 'PADANG', 0),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `cukai`
--

CREATE TABLE `cukai` (
  `id` int(11) NOT NULL,
  `subproduk` varchar(20) NOT NULL,
  `sub_kode` varchar(10) NOT NULL,
  `lama` int(10) NOT NULL,
  `baru` int(10) NOT NULL,
  `semua` int(10) NOT NULL,
  `masing` int(10) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` int(10) NOT NULL,
  `hje` int(20) NOT NULL,
  `tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cukai`
--

INSERT INTO `cukai` (`id`, `subproduk`, `sub_kode`, `lama`, `baru`, `semua`, `masing`, `jumlah`, `tanggal`, `isi`, `hje`, `tarif`) VALUES
(11, 'Robusto', 'BR10', 0, 100, 0, 0, 100, '2019-02-22', 10, 540000, 11000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `no_telf` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `id_users`, `nama_customer`, `no_telf`, `email`, `alamat`, `keterangan`) VALUES
(1, 6, 'adil maharana', 'maharana@gmail.com', '081234510019', 'ppppaaa', 'aaaaappp'),
(3, 9, 'maha rani', '2345678', 'rani@gmail.com', 'sdfgnh', 'sdfghnm'),
(4, 6, 'kristi', '134546467', 'kristi@gmail.com', 'asdfghjk./lkjhgffdgh', 'fhjhkjhgfdsuioluj,'),
(5, 10, 'muliani', '12345', 'muliani@gmail.com', 'sdfghjkl', 'dfghjkl'),
(6, 11, 'Hotel Matatabi', '091282302', 'matatabi@phri', 'slkdposkdoksopld[ps', ''),
(7, 6, 'umum', '-', '-', '-', '-'),
(8, 9, 'umum', '-', '-', '-', '-'),
(9, 10, 'umum', '-', '-', '-', '-'),
(10, 9, 'Cerutumu.com', '033112312', 'a@mascitra.com', 'Jl. Nusantara GF-7A Jember', '');

-- --------------------------------------------------------

--
-- Table structure for table `data_produksi`
--

CREATE TABLE `data_produksi` (
  `id_pr` int(10) NOT NULL,
  `jenis_pr` varchar(10) NOT NULL,
  `kategori_pr` varchar(10) NOT NULL,
  `produksi_pr` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_produksi`
--

INSERT INTO `data_produksi` (`id_pr`, `jenis_pr`, `kategori_pr`, `produksi_pr`) VALUES
(1, 'H8', 'FILLER 2', '97.26'),
(2, 'TC', 'FILLER 1', '189.50'),
(3, 'TC', 'OMBLAD', '189.50'),
(4, 'TC', 'DEKBLAD', '189.50'),
(5, 'H8', 'FILLER 1', '279.10'),
(6, 'H8', 'OMBLAD', '276.80'),
(7, 'H8', 'DEKBLAD', '276.00'),
(8, 'TS', 'FILLER 1', '92.18'),
(9, 'TS', 'OMBLAD', '91.00'),
(10, 'TS', 'DEKBLAD', '90.50'),
(12, 'TC', 'FILLER 2', '2.50'),
(13, 'VIRGINIA', 'FILLER 1', '77.10'),
(14, 'VIRGINIA', 'OMBLAD', '77.58'),
(15, 'VIRGINIA', 'DEKBLAD', '77.37'),
(16, 'PADANG', 'FILLER 1', '50.00'),
(17, 'PADANG', 'OMBLAD', '50.00'),
(18, 'PADANG', 'DEKBLAD', '50.00'),
(19, 'TAMBO', 'FILLER 1', '0.00'),
(20, 'TAMBO', 'OMBLAD', '0.00'),
(21, 'TAMBO', 'DEKBLAD', '0.00'),
(22, 'TH', 'FILLER 1', '95.02'),
(23, 'TH', 'OMBLAD', '5.65'),
(24, 'TH', 'DEKBLAD', '7.10');

-- --------------------------------------------------------

--
-- Table structure for table `data_stock`
--

CREATE TABLE `data_stock` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `asal` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `stock_masuk` decimal(10,2) NOT NULL,
  `diterima` decimal(10,2) NOT NULL,
  `diproduksi` decimal(10,2) NOT NULL,
  `hari_ini` decimal(10,2) NOT NULL,
  `ket` text NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_stock`
--

INSERT INTO `data_stock` (`id`, `tanggal`, `asal`, `jenis`, `kategori`, `stock_masuk`, `diterima`, `diproduksi`, `hari_ini`, `ket`, `author`) VALUES
(1, '2018-09-10', 'Beli Exsternal', 'H8', 'FILLER 2', '100.00', '100.00', '90.00', '10.00', '', 'admins'),
(2, '2018-09-10', 'Tanam Sendiri', 'TC', 'FILLER 1', '500.00', '500.00', '200.00', '300.00', '', 'admins'),
(3, '2018-09-10', 'Tanam Sendiri', 'TC', 'OMBLAD', '500.00', '500.00', '200.00', '300.00', '', 'admins'),
(4, '2018-09-10', 'Tanam Sendiri', 'TC', 'DEKBLAD', '500.00', '500.00', '200.00', '300.00', '', 'admins'),
(5, '2018-09-13', 'Tanam Sendiri', 'H8', 'FILLER 1', '500.00', '500.00', '300.00', '200.00', '', 'admins'),
(6, '2018-09-13', 'Tanam Sendiri', 'H8', 'OMBLAD', '500.00', '500.00', '300.00', '200.00', '', 'admins'),
(7, '2018-09-13', 'Tanam Sendiri', 'H8', 'DEKBLAD', '500.00', '500.00', '300.00', '200.00', '', 'admins'),
(8, '2018-09-13', 'Beli Exsternal', 'TS', 'FILLER 1', '500.00', '500.00', '100.00', '400.00', '', 'admins'),
(9, '2018-09-13', 'Beli Exsternal', 'TS', 'OMBLAD', '500.00', '500.00', '100.00', '400.00', '', 'admins'),
(10, '2018-09-13', 'Beli Exsternal', 'TS', 'DEKBLAD', '500.00', '500.00', '100.00', '400.00', '', 'admins'),
(11, '2018-09-17', 'Tanam Sendiri', 'VIRGINIA', 'FILLER 1', '500.00', '500.00', '100.00', '400.00', '', 'admins'),
(12, '2018-09-17', 'Tanam Sendiri', 'VIRGINIA', 'OMBLAD', '500.00', '500.00', '100.00', '400.00', '', 'admins'),
(13, '2018-09-17', 'Tanam Sendiri', 'VIRGINIA', 'DEKBLAD', '500.00', '500.00', '100.00', '400.00', '', 'admins'),
(14, '2018-10-07', 'Tanam Sendiri', 'VIRGINIA', 'FILLER 1', '100.00', '100.00', '50.00', '450.00', '', 'bahan'),
(15, '2018-10-07', 'Tanam Sendiri', 'VIRGINIA', 'OMBLAD', '100.00', '100.00', '50.00', '450.00', '', 'bahan'),
(16, '2018-10-07', 'Tanam Sendiri', 'VIRGINIA', 'DEKBLAD', '100.00', '100.00', '50.00', '450.00', '', 'bahan'),
(17, '2018-11-20', 'Beli Exsternal', 'PADANG', 'FILLER 1', '500.00', '500.00', '350.00', '150.00', 'jenis padang masuk', 'admins'),
(18, '2018-11-20', 'Beli Exsternal', 'PADANG', 'OMBLAD', '500.00', '500.00', '350.00', '150.00', 'tembakau jenis padang masuk', 'admins'),
(19, '2018-11-20', 'Beli Exsternal', 'PADANG', 'DEKBLAD', '500.00', '500.00', '350.00', '150.00', 'deklad jenis padang masuk', 'admins'),
(20, '2018-11-23', 'Beli Exsternal', 'TAMBO', 'FILLER 1', '500.00', '500.00', '300.00', '200.00', 'tambo filler 1 in', 'admins'),
(21, '2018-11-23', 'Beli Exsternal', 'TAMBO', 'OMBLAD', '500.00', '500.00', '300.00', '200.00', 'tambo omblad in', 'admins'),
(22, '2018-11-23', 'Beli Exsternal', 'TAMBO', 'DEKBLAD', '500.00', '500.00', '300.00', '200.00', 'tambo deklad in', 'admins'),
(23, '2018-12-31', 'Tanam Sendiri', 'TH', 'OMBLAD', '10.00', '10.00', '10.00', '0.00', '', 'bin cigar'),
(24, '2019-02-19', 'Tanam Sendiri', 'TH', 'DEKBLAD', '9.00', '10.00', '10.00', '0.00', '', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `data_stock_tmp`
--

CREATE TABLE `data_stock_tmp` (
  `id_tmp` int(11) NOT NULL,
  `jenis_tmp` varchar(15) NOT NULL,
  `kategori_tmp` varchar(15) NOT NULL,
  `hs_sblm` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_stock_tmp`
--

INSERT INTO `data_stock_tmp` (`id_tmp`, `jenis_tmp`, `kategori_tmp`, `hs_sblm`) VALUES
(1, 'H8', 'FILLER 2', '10.00'),
(2, 'TC', 'FILLER 1', '300.00'),
(3, 'TC', 'OMBLAD', '300.00'),
(4, 'TC', 'DEKBLAD', '300.00'),
(5, 'H8', 'FILLER 1', '200.00'),
(6, 'H8', 'OMBLAD', '200.00'),
(7, 'H8', 'DEKBLAD', '200.00'),
(8, 'TS', 'FILLER 1', '400.00'),
(9, 'TS', 'OMBLAD', '400.00'),
(10, 'TS', 'DEKBLAD', '400.00'),
(11, 'VIRGINIA', 'FILLER 1', '450.00'),
(12, 'VIRGINIA', 'OMBLAD', '450.00'),
(13, 'VIRGINIA', 'DEKBLAD', '450.00'),
(14, 'PADANG', 'FILLER 1', '150.00'),
(15, 'PADANG', 'OMBLAD', '150.00'),
(16, 'PADANG', 'DEKBLAD', '150.00'),
(17, 'TAMBO', 'FILLER 1', '200.00'),
(18, 'TAMBO', 'OMBLAD', '200.00'),
(19, 'TAMBO', 'DEKBLAD', '200.00'),
(21, 'TH', 'OMBLAD', '0.00'),
(22, 'TH', 'DEKBLAD', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `drying`
--

CREATE TABLE `drying` (
  `id` int(11) NOT NULL,
  `produk` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` text NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying`
--

INSERT INTO `drying` (`id`, `produk`, `jenis`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', 380, 375, 5, '2 jam', '-', '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', 470, 465, 5, '4 jam 15menit', '', '2018-09-13', 'admins'),
(3, 'Corona', 'TS', 400, 398, 2, '2 jam', '', '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', 290, 285, 5, '4 jam 15menit', '', '2018-09-17', 'admins'),
(6, 'Robusto', 'VIRGINIA', 255, 250, 5, '4 jam 15menit', '', '2018-09-17', 'proses'),
(7, 'Sumatra', 'PADANG', 950, 940, 10, '3 jam', 'drying butuh 3 jam', '2018-11-20', 'admins'),
(8, 'Tambo', 'TAMBO', 1000, 900, 100, '3 jam', '', '2018-11-23', 'admins'),
(9, 'Robusto', 'TH', 966, 966, 0, '4 jam', '', '2018-12-31', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', 920, 910, 10, '3 jam', '', '2019-02-26', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `drying2`
--

CREATE TABLE `drying2` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying2`
--

INSERT INTO `drying2` (`id`, `produk`, `jenis`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', 370, 365, 5, '2 jam', '-', '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', 460, 450, 10, '2 jam', '', '2018-09-13', 'admins'),
(3, 'Corona', 'TS', 396, 394, 2, '4 jam 15menit', '', '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', 283, 281, 2, '4 jam 15menit', '', '2018-09-17', 'admins'),
(5, 'Robusto', 'VIRGINIA', 252, 250, 2, '1 jam, 30 menit', '', '2018-10-07', 'proses'),
(6, 'Sumatra', 'PADANG', 925, 920, 5, '3 jam', '...', '2018-11-20', 'admins'),
(7, 'Tambo', 'TAMBO', 900, 900, 0, '2 jam', '', '2018-11-23', 'admins'),
(8, 'Robusto', 'TH', 966, 966, 0, '2 jam', '', '2018-12-31', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', 900, 890, 10, '3 jam', '', '2019-02-26', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `drying2_tmp`
--

CREATE TABLE `drying2_tmp` (
  `id_dry2` int(11) NOT NULL,
  `produk_dry2` varchar(20) NOT NULL,
  `jenis_dry2` varchar(20) NOT NULL,
  `hasil_today` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying2_tmp`
--

INSERT INTO `drying2_tmp` (`id_dry2`, `produk_dry2`, `jenis_dry2`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 5),
(2, 'Robusto', 'H8', 5),
(3, 'Corona', 'TS', 2),
(4, 'Robusto', 'VIRGINIA', 252),
(5, 'Sumatra', 'PADANG', 5),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `drying3`
--

CREATE TABLE `drying3` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying3`
--

INSERT INTO `drying3` (`id`, `produk`, `jenis`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', 355, 350, 350, '2 jam', '', '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', 440, 435, 5, '4 jam 15menit', '', '2018-09-13', 'admins'),
(3, 'Corona', 'TS', 390, 388, 2, '2 jam', '', '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', 278, 276, 2, '4 jam 15menit', '', '2018-09-17', 'admins'),
(5, 'Robusto', 'VIRGINIA', 252, 252, 0, '2 jam', '', '2018-10-07', 'proses'),
(6, 'Sumatra', 'PADANG', 900, 900, 0, '3 jam', 'drying terakhir', '2018-11-20', 'admins'),
(7, 'Tambo', 'TAMBO', 900, 900, 0, '4 jam', '', '2018-11-23', 'admins'),
(8, 'Robusto', 'TH', 966, 966, 0, '2 jam', '', '2018-12-31', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', 870, 860, 860, '3 jam', '', '2019-02-26', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `drying3_tmp`
--

CREATE TABLE `drying3_tmp` (
  `id_dry3` int(11) NOT NULL,
  `produk_dry3` varchar(20) NOT NULL,
  `jenis_dry3` varchar(20) NOT NULL,
  `hasil_today` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying3_tmp`
--

INSERT INTO `drying3_tmp` (`id_dry3`, `produk_dry3`, `jenis_dry3`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 40),
(2, 'Robusto', 'H8', 22),
(3, 'Corona', 'TS', 388),
(4, 'Robusto', 'VIRGINIA', 4),
(5, 'Sumatra', 'PADANG', 0),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `drying_tmp`
--

CREATE TABLE `drying_tmp` (
  `id_dry` int(11) NOT NULL,
  `produk_dry` varchar(20) NOT NULL,
  `jenis_dry` varchar(20) NOT NULL,
  `hasil_today` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying_tmp`
--

INSERT INTO `drying_tmp` (`id_dry`, `produk_dry`, `jenis_dry`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 5),
(2, 'Robusto', 'H8', 5),
(3, 'Corona', 'TS', 2),
(4, 'Robusto', 'VIRGINIA', 2),
(5, 'Sumatra', 'PADANG', 15),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `filling`
--

CREATE TABLE `filling` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `stock` decimal(10,2) NOT NULL,
  `terpakai` decimal(10,2) NOT NULL,
  `sisa` decimal(10,2) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filling`
--

INSERT INTO `filling` (`id`, `produk`, `jenis`, `stock`, `terpakai`, `sisa`, `hasil`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', '200.00', '10.50', '189.50', 400, '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', '300.00', '20.90', '279.10', 500, '2018-09-13', 'admins'),
(3, 'Corona', 'TS', '100.00', '7.82', '92.18', 420, '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', '100.00', '12.90', '87.10', 300, '2018-09-17', 'admins'),
(5, 'Robusto', 'VIRGINIA', '137.10', '50.00', '87.10', 300, '2018-10-07', 'proses'),
(6, 'Sumatra', 'PADANG', '350.00', '300.00', '50.00', 1000, '2018-11-20', 'admins'),
(7, 'Tambo', 'TAMBO', '300.00', '300.00', '0.00', 1000, '2018-11-23', 'admins'),
(8, 'Robusto', 'TH', '124.00', '28.98', '95.02', 966, '2018-12-31', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', '87.10', '10.00', '77.10', 1000, '2019-02-25', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `filling_tmp`
--

CREATE TABLE `filling_tmp` (
  `id_fill` int(11) NOT NULL,
  `produk_fill` varchar(20) NOT NULL,
  `jenis_fill` varchar(20) NOT NULL,
  `hasil_today` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filling_tmp`
--

INSERT INTO `filling_tmp` (`id_fill`, `produk_fill`, `jenis_fill`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 10),
(2, 'Robusto', 'H8', 10),
(3, 'Corona', 'TS', 10),
(4, 'Robusto', 'VIRGINIA', 51),
(5, 'Sumatra', 'PADANG', 0),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 50);

-- --------------------------------------------------------

--
-- Table structure for table `frezer`
--

CREATE TABLE `frezer` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frezer`
--

INSERT INTO `frezer` (`id`, `produk`, `jenis`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', 375, 370, 5, '3 jam', '', '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', 465, 460, 5, '2 jam', '', '2018-09-13', 'admins'),
(3, 'Corona', 'TS', 398, 396, 2, '2 jam', '', '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', 285, 283, 2, '2 jam', '', '2018-09-17', 'admins'),
(5, 'Robusto', 'VIRGINIA', 252, 250, 2, '2 jam', '', '2018-10-07', 'proses'),
(6, 'Sumatra', 'PADANG', 940, 925, 15, '3 jam', 'pendinginan', '2018-11-20', 'admins'),
(7, 'Tambo', 'TAMBO', 900, 900, 0, '3 jam', '', '2018-11-23', 'admins'),
(8, 'Robusto', 'TH', 966, 966, 0, '4 jam', '', '2018-12-31', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', 910, 900, 10, '3 jam', '', '2019-02-26', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `frezer_tmp`
--

CREATE TABLE `frezer_tmp` (
  `id_frez` int(11) NOT NULL,
  `produk_frez` varchar(20) NOT NULL,
  `jenis_frez` varchar(20) NOT NULL,
  `hasil_today` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frezer_tmp`
--

INSERT INTO `frezer_tmp` (`id_frez`, `produk_frez`, `jenis_frez`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 5),
(2, 'Robusto', 'H8', 10),
(3, 'Corona', 'TS', 2),
(4, 'Robusto', 'VIRGINIA', 2),
(5, 'Sumatra', 'PADANG', 5),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `fumigasi`
--

CREATE TABLE `fumigasi` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `ket` text NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fumigasi`
--

INSERT INTO `fumigasi` (`id`, `produk`, `jenis`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `lama`, `tanggal`, `ket`, `author`) VALUES
(1, 'Robusto', 'TC', 365, 360, 5, '1jam', '2018-09-10', '', 'admins'),
(2, 'Robusto', 'H8', 450, 445, 5, '4 jam 15menit', '2018-09-13', '', 'admins'),
(3, 'Corona', 'TS', 394, 392, 2, '2 jam', '2018-09-14', '', 'admins'),
(4, 'Robusto', 'VIRGINIA', 281, 280, 1, '4 jam 15menit', '2018-09-17', '', 'admins'),
(5, 'Robusto', 'VIRGINIA', 252, 250, 2, '1 jam, 30 menit', '2018-10-07', '', 'proses'),
(6, 'Sumatra', 'PADANG', 920, 915, 5, '4 jam', '2018-11-20', 'sterilisasi', 'admins'),
(7, 'Tambo', 'TAMBO', 900, 900, 0, '3 jam', '2018-11-23', '', 'admins'),
(8, 'Robusto', 'TH', 966, 966, 0, '4 jam', '2018-12-31', '', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', 890, 880, 10, '3 jam', '2019-02-26', '', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `fumigasi_tmp`
--

CREATE TABLE `fumigasi_tmp` (
  `id_fumi` int(11) NOT NULL,
  `produk_fumi` varchar(20) NOT NULL,
  `jenis_fumi` varchar(20) NOT NULL,
  `hasil_today` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fumigasi_tmp`
--

INSERT INTO `fumigasi_tmp` (`id_fumi`, `produk_fumi`, `jenis_fumi`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 5),
(2, 'Robusto', 'H8', 5),
(3, 'Corona', 'TS', 2),
(4, 'Robusto', 'VIRGINIA', 2),
(5, 'Sumatra', 'PADANG', 15),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` int(11) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `jenis`, `deskripsi`, `keterangan`) VALUES
(1, 'H8', '-', '-'),
(2, 'TC', '-', '-'),
(3, 'TS', '-', '-'),
(4, 'TH', '-', '-'),
(5, 'VIRGINIA', '-', '-'),
(6, 'TAMBO', '-', '-'),
(7, 'PADANG', '-', '-'),
(8, 'OPL', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `deskripsi`, `keterangan`) VALUES
(1, 'FILLER 1', 'Filler yang bisa dipakai langsung', '-'),
(2, 'FILLER 2', 'Filler kelas 2', '-'),
(3, 'OMBLAD', 'Pembungkus Filler Dalam', '-'),
(4, 'DEKBLAD', 'Pembungkus paling luar', '-');

-- --------------------------------------------------------

--
-- Table structure for table `kemasan`
--

CREATE TABLE `kemasan` (
  `id` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kemasan`
--

INSERT INTO `kemasan` (`id`, `nama`) VALUES
(5, 'Wooden'),
(6, 'Paper'),
(7, 'Plastik'),
(8, 'Foil'),
(9, 'Los');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `cerah_hujan` varchar(25) NOT NULL,
  `pagi` varchar(25) NOT NULL,
  `siang` varchar(25) NOT NULL,
  `sore` varchar(25) NOT NULL,
  `bak_air` varchar(50) NOT NULL,
  `lasiotrap_ruangan` varchar(50) NOT NULL,
  `lasiotrap_lemari` varchar(50) NOT NULL,
  `ds` varchar(50) NOT NULL,
  `store` varchar(50) NOT NULL,
  `agent` varchar(50) NOT NULL,
  `call` varchar(70) NOT NULL,
  `efektif_call` varchar(70) NOT NULL,
  `noo` varchar(70) NOT NULL,
  `direksi` text NOT NULL,
  `kesulitan` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(25) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `cerah_hujan`, `pagi`, `siang`, `sore`, `bak_air`, `lasiotrap_ruangan`, `lasiotrap_lemari`, `ds`, `store`, `agent`, `call`, `efektif_call`, `noo`, `direksi`, `kesulitan`, `tanggal`, `author`, `status`) VALUES
(3, 'ajksdh', 'asasdkjh', 'askjdh', 'akjsdh', 'askdjh', 'aksdjh', 'aksjdh', '897', '987', '987', 'aklsdh', 'alksjdh', 'aksjdh', 'hyhyhyhy', 'hyhyhyhy', '2018-07-02', 'admins', 0),
(4, '17', '18', '27', '24', 'kk', 'll', 'pp', '9', '6', '10', 'p', 'm', 'k', 'keren', 'sulit sam', '2018-08-14', 'admins', 0),
(5, '90', '17', '30', '24', 'sd', 'smp', 'smk', '10', '4', '14', 'cs', 'ds', 'vd', 'mantap', 'kerenlah', '2018-08-14', 'admins', 0),
(6, '12', '22', '28', '2', '12', '23', '34', '12', '23', '234', '23', '44', '53', 'fd', 'df', '2018-08-30', 'admins', 0),
(7, 'sasa', 'as', 'as', 'sa', 'sa', 'as', 'as', '23', '12', '2', 'ew', '21', '12', 'aew', 'asa', '2018-09-04', 'admins', 0);

-- --------------------------------------------------------

--
-- Table structure for table `laporan_produksi`
--

CREATE TABLE `laporan_produksi` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `dek` int(10) NOT NULL,
  `omb` int(10) NOT NULL,
  `fill` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan_produksi`
--

INSERT INTO `laporan_produksi` (`id`, `produk`, `jenis`, `jumlah`, `dek`, `omb`, `fill`, `tanggal`) VALUES
(3, 'Robusto', 'H8', 50, 50, 50, 50, '2018-06-25');

-- --------------------------------------------------------

--
-- Table structure for table `level_user`
--

CREATE TABLE `level_user` (
  `id_level` int(11) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level_user`
--

INSERT INTO `level_user` (`id_level`, `level`) VALUES
(1, 'Bahan Baku'),
(2, 'Proses Produksi'),
(3, 'Quality Control'),
(4, 'RFS');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `subproduk` varchar(15) NOT NULL,
  `id_subproduk` int(15) NOT NULL,
  `sub_kode` varchar(15) NOT NULL,
  `kemasan` varchar(15) NOT NULL,
  `isi` int(10) NOT NULL,
  `hje` int(15) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `total` int(20) NOT NULL,
  `bagan` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `author` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(11) NOT NULL,
  `respon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `subproduk`, `id_subproduk`, `sub_kode`, `kemasan`, `isi`, `hje`, `produk`, `jumlah`, `total`, `bagan`, `ket`, `author`, `tanggal`, `status`, `respon`) VALUES
(3, 'Robusto', 8, 'BR10', 'Wooden', 10, 450000, '5', 2, 900000, 'Store', 'beli ini lagi pak', 'Admin Store', '2018-07-22', 1, 0),
(4, 'Robusto', 8, 'BR10', 'Wooden', 10, 450000, '5', 12, 5400000, 'Store', 'tambah 12 robusto wooden', 'admins', '2018-07-01', 1, 0),
(5, 'Robusto', 10, 'BR1', 'Plastik', 1, 0, '5', 12, 0, 'Store', '12', 'admins', '2018-07-11', 1, 0),
(6, 'Robusto', 8, 'BR10', 'Wooden', 10, 450000, '5', 100, 45000000, 'Hotel', 'dsfsdf', 'admins', '2018-07-04', 1, 0),
(7, 'Robusto', 3, 'BR3', 'Paper', 3, 165000, '1', 12, 1980000, 'AGENT', 'as', 'rfs', '2018-09-18', 1, 0),
(8, 'Robusto', 1, 'BR10', 'Wooden', 10, 540000, '1', 12, 6480000, 'AGENT', 'tolong kirim', 'amora', '2018-09-18', 1, 0),
(9, 'Robusto', 3, 'BR3', 'Paper', 3, 165000, '1', 5, 825000, 'AGENT', '', 'amora', '2019-02-19', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pakai_kemasan`
--

CREATE TABLE `pakai_kemasan` (
  `id` int(11) NOT NULL,
  `produk` varchar(20) NOT NULL,
  `kemasan` varchar(15) NOT NULL,
  `awal` int(10) NOT NULL,
  `masuk` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `terpakai` int(10) NOT NULL,
  `afkir` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pakai_kemasan`
--

INSERT INTO `pakai_kemasan` (`id`, `produk`, `kemasan`, `awal`, `masuk`, `sisa`, `terpakai`, `afkir`, `stock`, `tanggal`) VALUES
(1, 'Robusto', 'Wooden', 40, 0, 40, 22, 0, 18, '2018-06-23'),
(2, 'Corona', 'Wooden', 3, 50, 53, 9, 0, 44, '2018-06-23'),
(4, 'Robusto', 'Wooden', 40, 0, 40, 20, 0, 20, '2018-06-27'),
(5, 'Robusto', 'Wooden', 40, 0, 40, 20, 0, 20, '2018-06-27'),
(6, 'Robusto', 'Wooden', 40, 0, 40, 20, 0, 20, '2018-06-27'),
(7, 'Robusto', 'Wooden', 40, 0, 40, 20, 0, 20, '2018-06-27'),
(8, 'Robusto', 'Wooden', 20, 0, 20, 5, 0, 15, '2018-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `id_subproduk` int(15) NOT NULL,
  `subproduk` varchar(20) NOT NULL,
  `sub_kode` varchar(15) NOT NULL,
  `stock` int(15) NOT NULL,
  `keluar` int(15) NOT NULL,
  `sisa` int(15) NOT NULL,
  `keterangan` text NOT NULL,
  `bagan` varchar(15) NOT NULL,
  `for_user` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `produk`, `id_subproduk`, `subproduk`, `sub_kode`, `stock`, `keluar`, `sisa`, `keterangan`, `bagan`, `for_user`, `tanggal`, `author`, `created_at`) VALUES
(1, 'Robusto', 1, 'Robusto', 'BR10', 16, 5, 2, '', 'AGENT', '', '2018-09-10', 'admins', '2018-09-17 07:12:27'),
(2, 'Robusto', 3, 'Robusto', 'BR3', 15, 8, 4, '', 'STORE', '', '2018-09-13', 'admins', '2018-09-17 07:12:27'),
(3, 'Robusto', 3, 'Robusto', 'BR3', 7, 2, 5, '', 'AGENT', '', '2018-09-17', 'rfs', '2018-09-17 07:12:27'),
(5, 'Robusto', 1, 'Robusto', 'BR10', 11, 1, 10, '', 'AGENT', '', '2018-09-17', 'rfs', '2018-09-17 07:12:27'),
(6, 'Robusto', 1, 'Robusto', 'BR10', 10, 1, 9, '', 'AGENT', '', '2018-09-17', 'rfs', '2018-09-17 07:12:27'),
(7, 'Robusto', 1, 'Robusto', 'BR10', 8, 1, 7, '', 'AGENT', 'devianata', '2018-09-17', 'rfs', '2018-09-17 07:12:27'),
(8, 'Robusto', 1, 'Robusto', 'BR10', 7, 2, 5, '', 'AGENT', 'amora', '2018-09-17', 'rfs', '2018-09-17 07:12:27'),
(9, 'Robusto', 3, 'Robusto', 'BR3', 5, 1, 4, '', 'AGENT', 'amora', '2018-09-17', 'rfs', '2018-09-17 07:12:27'),
(10, 'Robusto', 2, 'Robusto', 'BR10', 20, 15, 5, '', 'AGENT', 'devianata', '2018-09-17', 'admins', '2018-09-17 07:12:27'),
(11, 'Robusto', 1, 'Robusto', 'BR10', 22, 12, 10, '', 'AGENT', 'amora', '2018-09-18', 'rfs', '2018-09-18 09:55:00'),
(12, 'Robusto', 1, 'Robusto', 'BR10', 35, 14, 21, '', 'AGENT', 'devianata', '2018-09-18', 'RFS', '2018-09-18 14:43:48'),
(13, 'Robusto', 1, 'Robusto', 'BR10', 20, 15, 5, '', 'AGENT', 'devianata', '2018-09-24', 'admins', '2018-09-24 04:43:10'),
(14, 'Robusto', 1, 'Robusto', 'BR10', 5, 5, 0, '', 'AGENT', 'amora', '2018-09-24', 'admins', '2018-09-24 04:44:22'),
(15, 'Robusto', 6, 'Harvana Collect', 'BCOLL16H', 3, 2, 1, '', 'PHRI', 'karin', '2018-10-07', 'rfs', '2018-10-07 13:29:21'),
(16, 'Sumatra', 12, 'Sumatera', 'Sumatera', 20, 8, 12, 'kirim ke devianata', 'AGENT', 'devianata', '2018-11-20', 'admins', '2018-11-20 06:40:25'),
(17, 'Tambo', 13, 'Tambo', 'Tambo 1', 15, 10, 5, 'tambo to admin store', 'STORE', 'Admin Store', '2018-11-23', 'admins', '2018-11-23 09:25:23'),
(18, 'Robusto', 1, 'Robusto', 'BR10', 103, 70, 33, '', 'STORE', 'Admin Store', '2018-12-31', 'bin cigar', '2019-02-19 05:06:55'),
(19, 'Robusto', 1, 'Robusto', 'BR10', 33, 10, 23, '', 'AGENT', 'devianata', '2018-12-31', 'bin cigar', '2019-02-19 05:11:00'),
(20, 'Robusto', 1, 'Robusto', 'BR10', 25, 10, 15, '', 'STORE', 'Admin Store', '2018-12-31', 'bin cigar', '2019-02-19 05:28:46'),
(21, 'Robusto', 3, 'Robusto', 'BR3', 19, 5, 14, '', 'AGENT', 'amora', '2019-02-19', 'rfs', '2019-02-19 05:41:10');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_cerutu`
--

CREATE TABLE `penjualan_cerutu` (
  `id_penjualan_bagan` int(11) NOT NULL,
  `harga_semua_cerutu` int(20) NOT NULL,
  `diskon` int(11) NOT NULL,
  `sistem` varchar(50) NOT NULL,
  `ongkos` int(50) NOT NULL,
  `total` int(20) NOT NULL,
  `yang_dibayar` int(20) NOT NULL,
  `id_users` int(11) NOT NULL,
  `bagan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(50) NOT NULL,
  `customer` int(11) NOT NULL,
  `no_invoice` varchar(150) DEFAULT NULL,
  `lokasi_kirim` text NOT NULL,
  `departure_date` date DEFAULT NULL,
  `vessel` varchar(100) DEFAULT NULL,
  `port_of_loading` varchar(100) DEFAULT NULL,
  `port_of_destination` varchar(100) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan_cerutu`
--

INSERT INTO `penjualan_cerutu` (`id_penjualan_bagan`, `harga_semua_cerutu`, `diskon`, `sistem`, `ongkos`, `total`, `yang_dibayar`, `id_users`, `bagan`, `tanggal`, `author`, `customer`, `no_invoice`, `lokasi_kirim`, `departure_date`, `vessel`, `port_of_loading`, `port_of_destination`, `keterangan`, `created_at`) VALUES
(11, 1245000, 5, 'Cash', 50000, 1232750, 1232750, 1, 'AGENT', '2018-10-04', 'admins', 5, '001/EXP/X/2018', '', '0000-00-00', '', '', '', 'mantap', '2019-02-27 08:14:48'),
(12, 330000, 5, 'Cash', 10000, 3235000, 3235000, 1, 'STORE', '2018-10-04', 'admins', 4, '002/EXP/X/2018', '', '0000-00-00', '', '', '', 'ads', '2019-02-27 08:15:00'),
(13, 165000, 0, 'Transfer', 0, 165000, 165000, 1, 'STORE', '2018-10-04', 'admins', 1, '003/EXP/X/2018', '', '0000-00-00', '', '', '', 'asasasasasasasa', '2019-02-27 08:15:08'),
(14, 330000, 5, 'Transfer', 10000, 323500, 323500, 1, 'AGENT', '2018-10-04', 'admins', 3, '004/EXP/X/2018', '', '0000-00-00', '', '', '', 'addda', '2019-02-27 08:15:22'),
(15, 330000, 5, 'Transfer', 30000, 343500, 343500, 1, 'AGENT', '2018-10-04', 'admins', 3, '005/EXP/X/2018', '', '0000-00-00', '', '', '', 'asads', '2019-02-27 08:15:30'),
(16, 415000, 10, 'Cash', 10000, 383500, 283500, 1, 'AGENT', '2018-10-07', 'admins', 5, '006/EXP/X/2018', '', '0000-00-00', '', '', '', 'cak ko', '2019-02-27 08:15:39'),
(17, 540000, 10, 'Cash', 5000, 491000, 491000, 9, 'AGENT', '2018-10-07', 'amora', 3, '007/EXP/X/2018', '', '0000-00-00', '', '', '', 'sip', '2019-02-27 08:15:47'),
(19, 540000, 0, 'Cash', 30000, 570000, 570000, 9, 'AGENT', '2018-10-07', 'amora', 0, '008/EXP/X/2018', '', '0000-00-00', '', '', '', 'ajib bangetlah', '2019-02-27 08:15:54'),
(20, 540000, 5, 'Cash', 15000, 528000, 528000, 9, 'AGENT', '2018-10-07', 'amora', 0, '009/EXP/X/2018', '', '0000-00-00', '', '', '', 'aaads', '2019-02-27 08:16:04'),
(21, 540000, 0, 'Cash', 12000, 552000, 552000, 9, 'AGENT', '2018-10-07', 'amora', 3, '010/EXP/X/2018', '', '0000-00-00', '', '', '', 'asaaaaa', '2019-02-27 08:16:12'),
(22, 800000, 0, 'Cash', 50000, 850000, 850000, 11, 'PHRI', '2018-10-08', 'karin', 6, '011/EXP/X/2018', '', '0000-00-00', '', '', '', 'dsds', '2019-02-27 08:16:21'),
(23, 80000, 0, 'Cash', 15000, 95000, 100000, 10, 'AGENT', '2018-11-20', 'admins', 5, '001/EXP/XI/2018', 'Jakarta', '2018-11-28', '2018-11-20', '-', 'Jember - Jakarta', '.......', '2018-11-22 04:12:52'),
(24, 1116000, 0, 'Cash', 20000, 1136000, 1500000, 10, 'AGENT', '2018-11-20', 'admins', 5, '002/EXP/XI/2018', 'Jl. KaliWangi No.125 ', '2018-11-28', '-', 'Jember - Jakarta', 'Jakarta', 'mantap', '2018-11-22 04:16:13'),
(25, 2430000, 0, 'Transfer', 55000, 2485000, 2500000, 9, 'AGENT', '2019-01-01', 'amora', 10, '001/EXP/I/2019', 'Jl. Nusantara GF-7A Jember', '2019-01-01', '', 'Jember ', 'Jakarta', '', '2019-02-19 05:53:13'),
(26, 297000, 0, 'Transfer', 55000, 352000, 200000, 9, 'AGENT', '2019-01-02', 'amora', 10, '002/EXP/I/2019', 'Jl. Jakarta', '2019-01-02', '', 'Jember', 'Jakarta', '', '2019-02-27 07:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `id_qc` int(10) NOT NULL,
  `pesan` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `id_qc`, `pesan`, `tanggal`, `author`, `status`) VALUES
(1, 3, 'ini pak proses udh selesai, tinggal ready for sale nya sadja', '2018-06-28', 'admins', 1),
(2, 4, 'jelek pak yg ini', '2018-06-29', 'admins', 1),
(3, 5, 'kabar', '2018-06-30', 'admins', 1),
(4, 6, 'udah msuk pak', '2018-06-30', 'admins', 1),
(5, 8, 'yg di accepet cuman 350 batang cerutu pak', '2018-06-30', 'admins', 1),
(6, 9, 'cuman 700 yg di accept :\')', '2018-07-01', 'admins', 1),
(7, 13, 'ini bakau jlek pak', '2018-07-02', 'admins', 1),
(8, 23, 'ini pak yg di accept cuman 60 batang sadja', '2018-07-03', 'admins', 1),
(9, 4, 'kereject 7', '2018-09-13', 'admins', 1),
(10, 8, 'baiklah pokoke', '2018-10-07', 'Quality Control', 1),
(11, 10, 'telah di cek dan aman', '2018-11-23', 'Quality Control', 1);

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `id_piutang` int(11) NOT NULL,
  `id_penjualan_bagan` int(11) NOT NULL,
  `yang_dibayar` int(11) NOT NULL,
  `kurang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status_pembayaran` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`id_piutang`, `id_penjualan_bagan`, `yang_dibayar`, `kurang`, `tanggal`, `status_pembayaran`) VALUES
(9, 13, 100000, 65000, '2018-10-04 10:15:11', 2),
(10, 13, 45000, 20000, '2018-10-04 10:15:11', 2),
(11, 13, 20000, 0, '2018-10-04 10:15:11', 2),
(12, 14, 200000, 123500, '2018-10-04 10:23:34', 2),
(13, 14, 110000, 13500, '2018-10-04 10:23:34', 2),
(14, 14, 13500, 0, '2018-10-04 10:23:34', 2),
(15, 15, 300000, 43500, '2018-10-04 10:27:55', 2),
(16, 15, 50000, 0, '2018-10-04 10:27:55', 2),
(17, 16, 183500, 200000, '2018-10-06 17:00:00', 1),
(18, 16, 100000, 100000, '2018-10-07 11:07:56', 1),
(19, 26, 200000, 152000, '2019-01-01 17:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pressing`
--

CREATE TABLE `pressing` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pressing`
--

INSERT INTO `pressing` (`id`, `produk`, `jenis`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', 390, 385, 5, '4 jam 15menit', '', '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', 490, 485, 5, '30 menit', 'go', '2018-09-13', 'admins'),
(3, 'Corona', 'TS', 410, 409, 1, '2 jam', '', '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', 299, 299, 0, '2 jam', '', '2018-09-17', 'admins'),
(5, 'Robusto', 'VIRGINIA', 250, 250, 0, '2 jam', '', '2018-10-07', 'proses'),
(6, 'Sumatra', 'PADANG', 1000, 950, 50, '1 jam', 'proses mas', '2018-11-20', 'admins'),
(7, 'Tambo', 'TAMBO', 1000, 1000, 0, '2 jam', 'tambo mulai press', '2018-11-23', 'admins'),
(8, 'Robusto', 'TH', 1932, 966, 966, '4 jam', '', '2018-12-31', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', 950, 930, 20, '1 jam', '', '2019-02-25', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `pressing_tmp`
--

CREATE TABLE `pressing_tmp` (
  `id_pres` int(11) NOT NULL,
  `produk_pres` varchar(20) NOT NULL,
  `jenis_pres` varchar(20) NOT NULL,
  `hasil_today` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pressing_tmp`
--

INSERT INTO `pressing_tmp` (`id_pres`, `produk_pres`, `jenis_pres`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 5),
(2, 'Robusto', 'H8', 15),
(3, 'Corona', 'TS', 9),
(4, 'Robusto', 'VIRGINIA', 9),
(5, 'Sumatra', 'PADANG', 0),
(6, 'Tambo', 'TAMBO', 0),
(7, 'Robusto', 'TH', 0),
(8, 'Magic', 'VIRGINIA', 10);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `produk`) VALUES
(1, 'Robusto'),
(2, 'Corona'),
(3, 'Half Corona'),
(4, 'Maumere'),
(5, 'Cigar Master'),
(6, 'El Nino'),
(7, 'C99'),
(8, 'Jember Cigar'),
(9, 'Mondlicht'),
(10, 'Don Agusto'),
(11, 'NFC Red'),
(12, 'NFC Green'),
(13, '212'),
(14, 'Ceo Cappucino'),
(15, 'Ceo Java'),
(16, 'Merubetiri'),
(17, 'Talama'),
(18, 'Tambo'),
(19, 'Sumatra'),
(20, 'Cerutu Flavour'),
(21, 'Robusto Lin'),
(22, 'SIGO I'),
(23, 'SIGO II'),
(24, 'SIGO III'),
(25, 'SIGO IV'),
(26, 'SIGO V'),
(27, 'SIGO VI'),
(28, 'Grand Mondlicht'),
(29, 'Genio'),
(30, 'Magic'),
(31, 'HK52'),
(32, 'HK54'),
(33, 'HK56'),
(34, 'CHB52'),
(35, 'CHB54'),
(36, 'Majestuoso'),
(37, 'Supremo'),
(38, 'Piramide'),
(39, 'Horsetail'),
(40, 'Secretos');

-- --------------------------------------------------------

--
-- Table structure for table `qc`
--

CREATE TABLE `qc` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `stock` int(11) NOT NULL,
  `accept` int(11) NOT NULL,
  `binding_rej` int(11) NOT NULL,
  `wrapping_rej` int(11) NOT NULL,
  `rusak_rej` int(11) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qc`
--

INSERT INTO `qc` (`id`, `produk`, `jenis`, `stock`, `accept`, `binding_rej`, `wrapping_rej`, `rusak_rej`, `ket`, `tanggal`, `author`) VALUES
(3, 'Robusto', 'TC', 350, 300, 2, 3, 2, '', '2018-09-10', 'admins'),
(4, 'Robusto', 'H8', 435, 400, 2, 0, 5, '', '2018-09-13', 'admins'),
(5, 'Robusto', 'H8', 28, 5, 0, 0, 0, '', '2018-09-13', 'admins'),
(6, 'Robusto', 'H8', 23, 1, 0, 0, 0, '', '2018-09-13', 'admins'),
(7, 'Robusto', 'VIRGINIA', 276, 270, 0, 0, 0, 'sip', '2018-09-17', 'admins'),
(8, 'Robusto', 'VIRGINIA', 258, 254, 0, 0, 0, '', '2018-10-07', 'Quality Control'),
(9, 'Sumatra', 'PADANG', 900, 900, 0, 0, 0, 'lolos tanpa cacat', '2018-11-20', 'admins'),
(10, 'Tambo', 'TAMBO', 900, 900, 0, 0, 0, 'tak ada cacat', '2018-11-23', 'Quality Control'),
(11, 'Robusto', 'TH', 966, 966, 0, 0, 0, '', '2018-12-31', 'bin cigar'),
(16, 'Magic', 'VIRGINIA', 860, 840, 5, 5, 0, '', '2019-02-26', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `qual_con_tmp`
--

CREATE TABLE `qual_con_tmp` (
  `id_q` int(11) NOT NULL,
  `produk_q` varchar(50) NOT NULL,
  `stock_q` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qual_con_tmp`
--

INSERT INTO `qual_con_tmp` (`id_q`, `produk_q`, `stock_q`) VALUES
(1, 'Robusto', 78),
(2, 'Sumatra', 300),
(3, 'Tambo', 870),
(6, 'Magic', 840);

-- --------------------------------------------------------

--
-- Table structure for table `reject`
--

CREATE TABLE `reject` (
  `id_reject` int(11) NOT NULL,
  `jenis` varchar(25) NOT NULL,
  `id_subproduk` int(11) DEFAULT NULL,
  `r_binding` int(50) NOT NULL,
  `r_wrapping` int(50) NOT NULL,
  `r_packing` int(50) NOT NULL,
  `r_rusak` int(50) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reject`
--

INSERT INTO `reject` (`id_reject`, `jenis`, `id_subproduk`, `r_binding`, `r_wrapping`, `r_packing`, `r_rusak`, `keterangan`, `status`, `tanggal`) VALUES
(5, 'H8', 7, 3, 2, 2, 5, 'cek ya', 1, '2018-08-26'),
(6, 'H8', 8, 5, 10, 5, 10, '', 1, '2018-08-26'),
(7, 'H8', 4, 2, 0, 2, 4, 'cek', 1, '2018-08-26'),
(8, 'TC', 1, 2, 6, 1, 2, 'xsd', 1, '2018-09-28'),
(9, 'H8', 1, 0, 0, 1, 0, 'kk', 1, '2018-09-28'),
(10, 'H8', 1, 5, 5, 1, 0, '', 1, '2018-09-28');

-- --------------------------------------------------------

--
-- Table structure for table `return_bagan`
--

CREATE TABLE `return_bagan` (
  `id_return_bagan` int(11) NOT NULL,
  `id_subproduk` int(20) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `bagan` varchar(20) NOT NULL,
  `author` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_bagan`
--

INSERT INTO `return_bagan` (`id_return_bagan`, `id_subproduk`, `jumlah`, `bagan`, `author`, `keterangan`, `tanggal`, `status`) VALUES
(1, 1, 2, 'AGENT', 'amora', 'perlu dicek', '2018-09-19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `return_rfs`
--

CREATE TABLE `return_rfs` (
  `id_rtn` int(11) NOT NULL,
  `id_subproduk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `return_rfs`
--

INSERT INTO `return_rfs` (`id_rtn`, `id_subproduk`, `id_produk`, `jumlah`, `ket`, `tanggal`, `status`) VALUES
(3, 8, 2, 0, 'cek hay', '2018-09-15', 1),
(4, 1, 1, 0, 'kfghj', '2018-09-28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rfs`
--

CREATE TABLE `rfs` (
  `id` int(11) NOT NULL,
  `id_subproduk` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `masuk` int(10) NOT NULL,
  `keluar` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `ket` text NOT NULL,
  `produk` varchar(20) NOT NULL,
  `sub_produk` varchar(15) NOT NULL,
  `kemasan` varchar(15) NOT NULL,
  `isi` int(10) NOT NULL,
  `stock_batang` int(15) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `sisa_stock` int(15) NOT NULL,
  `author` varchar(15) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rfs`
--

INSERT INTO `rfs` (`id`, `id_subproduk`, `stock`, `masuk`, `keluar`, `sisa`, `ket`, `produk`, `sub_produk`, `kemasan`, `isi`, `stock_batang`, `jumlah`, `sisa_stock`, `author`, `tanggal`) VALUES
(1, 1, 0, 15, 11, 15, 'ready', 'Robusto', 'Robusto', 'Wooden', 10, 300, 150, 150, 'admins', '2018-09-10'),
(2, 1, 15, 3, 11, 2, '', 'Robusto', 'Robusto', 'Wooden', 10, 150, 30, 120, 'admins', '2018-09-10'),
(3, 3, 0, 32, 15, 17, '', 'Robusto', 'Robusto', 'Paper', 3, 706, 96, 610, 'admins', '2018-09-13'),
(4, 2, 0, 25, 20, 5, '', 'Robusto', 'Robusto', 'Wooden', 10, 884, 250, 634, 'admins', '2018-09-17'),
(5, 1, 2, 50, 30, 22, '', 'Robusto', 'Robusto', 'Wooden', 10, 634, 500, 134, 'proses', '2018-09-18'),
(6, 1, 2, 20, 0, 22, '', 'Robusto', 'Robusto', 'Wooden', 10, 388, 200, 188, 'proses', '2018-10-07'),
(7, 3, 9, 20, 0, 29, '', 'Robusto', 'Robusto', 'Paper', 3, 188, 60, 128, 'proses', '2018-10-07'),
(8, 6, 0, 6, 0, 6, '', 'Robusto', 'Harvana Collect', 'Wooden', 16, 128, 96, 32, 'proses', '2018-10-07'),
(9, 3, 29, 0, 15, 14, '', 'Robusto', 'Robusto', 'Paper', 3, 32, 0, 32, 'proses', '2018-10-07'),
(10, 6, 6, 0, 3, 3, '', 'Robusto', 'Harvana Collect', 'Wooden', 16, 32, 0, 32, 'proses', '2018-10-07'),
(11, 1, 22, 0, 15, 7, '', 'Robusto', 'Robusto', 'Wooden', 10, 32, 0, 32, 'proses', '2018-10-07'),
(13, 12, 0, 60, 0, 60, 'packing sumatera', 'Sumatra', 'Sumatera', 'Wooden', 10, 900, 600, 300, 'admins', '2018-11-20'),
(14, 12, 60, 0, 20, 40, 'stok keluar sumatera', 'Sumatra', 'Sumatera', 'Wooden', 10, 300, 0, 300, 'admins', '2018-11-20'),
(15, 13, 0, 10, 0, 10, 'packing tambo 10 kemasan', 'Tambo', 'Tambo', 'Paper', 1, 900, 10, 890, 'proses', '2018-11-23'),
(16, 13, 10, 20, 15, 15, 'stok tambo utk RFS', 'Tambo', 'Tambo', 'Paper', 1, 890, 20, 870, 'proses', '2018-11-23'),
(17, 1, 5, 90, 0, 95, '', 'Robusto', 'Robusto', 'Wooden', 10, 998, 900, 98, 'bin cigar', '2018-12-31'),
(18, 1, 95, 0, 90, 5, '', 'Robusto', 'Robusto', 'Wooden', 10, 98, 0, 98, 'bin cigar', '2019-02-19'),
(19, 1, 5, 2, 2, 5, '', 'Robusto', 'Robusto', 'Wooden', 10, 98, 20, 78, 'bin cigar', '2019-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `rfs_stock_keluar`
--

CREATE TABLE `rfs_stock_keluar` (
  `id_out` int(11) NOT NULL,
  `id_subproduk` int(11) NOT NULL,
  `stock_keluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rfs_stock_keluar`
--

INSERT INTO `rfs_stock_keluar` (`id_out`, `id_subproduk`, `stock_keluar`) VALUES
(1, 1, 15),
(2, 3, 14),
(3, 2, 5),
(4, 6, 1),
(6, 12, 12),
(7, 13, 5),
(8, 16, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `direktur` varchar(100) NOT NULL,
  `kabag` varchar(100) NOT NULL,
  `qc` varchar(100) NOT NULL,
  `rfs` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `direktur`, `kabag`, `qc`, `rfs`) VALUES
(1, 'Ir. H Imam Wahid Wahyudi', 'Slamet Wijaya', 'Risma', 'Citra Wahyu Lestari');

-- --------------------------------------------------------

--
-- Table structure for table `stiker`
--

CREATE TABLE `stiker` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(20) NOT NULL,
  `stock_l` int(10) NOT NULL,
  `masuk_l` int(10) NOT NULL,
  `pakai_l` int(10) NOT NULL,
  `hasil_l` int(10) NOT NULL,
  `stock_d` int(10) NOT NULL,
  `masuk_d` int(10) NOT NULL,
  `pakai_d` int(10) NOT NULL,
  `hasil_d` int(10) NOT NULL,
  `stock_j` int(10) NOT NULL,
  `masuk_j` int(10) NOT NULL,
  `pakai_j` int(10) NOT NULL,
  `hasil_j` int(10) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stiker`
--

INSERT INTO `stiker` (`id`, `nama_produk`, `stock_l`, `masuk_l`, `pakai_l`, `hasil_l`, `stock_d`, `masuk_d`, `pakai_d`, `hasil_d`, `stock_j`, `masuk_j`, `pakai_j`, `hasil_j`, `tanggal`) VALUES
(4, 'Robusto', 159, 0, 20, 139, 50, 0, 20, 30, 209, 0, 40, 169, '2018-06-22'),
(5, 'Corona', 159, 159, 159, -159, 159, 159, 159, -159, 318, 318, 318, -318, '2018-06-26'),
(6, 'Robusto', 159, 0, 20, 139, 50, 0, 20, 30, 209, 0, 40, 169, '2018-06-26'),
(9, 'Robusto', 139, 0, 10, 129, 30, 0, 10, 20, 169, 0, 20, 149, '2018-06-27'),
(10, 'Robusto', 129, 50, 50, 29, 200, 50, 50, 100, 329, 100, 100, 129, '2018-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `stock_awalrekap`
--

CREATE TABLE `stock_awalrekap` (
  `id_strekap` int(11) NOT NULL,
  `id_subproduk` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `stock_awal` int(11) NOT NULL,
  `tanggal_input_awal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_awalrekap`
--

INSERT INTO `stock_awalrekap` (`id_strekap`, `id_subproduk`, `id_users`, `stock_awal`, `tanggal_input_awal`) VALUES
(1, 1, 9, 6, '2019-01-01'),
(2, 6, 11, 2, '2018-01-01'),
(3, 12, 10, 8, '2018-01-01'),
(4, 1, 10, 21, '2018-01-01'),
(5, 3, 9, 6, '2019-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `stock_bagan`
--

CREATE TABLE `stock_bagan` (
  `id_stock_bagan` int(11) NOT NULL,
  `id_subproduk` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `stock_barang` int(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_bagan`
--

INSERT INTO `stock_bagan` (`id_stock_bagan`, `id_subproduk`, `id_users`, `stock_barang`) VALUES
(1, 1, 9, 1),
(2, 3, 9, 4),
(3, 2, 10, 5),
(4, 1, 10, 29),
(5, 6, 11, 1),
(6, 12, 10, 5),
(7, 13, 6, 10),
(8, 1, 6, 80);

-- --------------------------------------------------------

--
-- Table structure for table `stock_cincin`
--

CREATE TABLE `stock_cincin` (
  `id` int(11) NOT NULL,
  `produk` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_cincin`
--

INSERT INTO `stock_cincin` (`id`, `produk`, `stock`) VALUES
(1, 'Robusto', 4200),
(2, 'Corona', 4941),
(3, 'Half Corona', 7718),
(4, 'Maumere', 7235),
(5, 'El Nino', 2403),
(6, 'Jember Cigar', 6893),
(7, 'C99', 1360),
(8, 'Don Agusto', 4884),
(9, '212', 8000),
(10, 'Secretos', 100),
(11, 'Talama', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_cukai`
--

CREATE TABLE `stock_cukai` (
  `id` int(11) NOT NULL,
  `id_subproduk` int(20) NOT NULL,
  `sub_produk` varchar(15) NOT NULL,
  `sub_kode` varchar(15) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `stock` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_cukai`
--

INSERT INTO `stock_cukai` (`id`, `id_subproduk`, `sub_produk`, `sub_kode`, `produk`, `stock`) VALUES
(8, 14, 'El Nino Mackrup', 'El - nan', 'El Nino', 0),
(9, 1, 'Robusto', 'BR10', 'Robusto', 100);

-- --------------------------------------------------------

--
-- Table structure for table `stock_kemasan`
--

CREATE TABLE `stock_kemasan` (
  `id` int(11) NOT NULL,
  `produk` varchar(20) NOT NULL,
  `nama_kemasan` varchar(20) NOT NULL,
  `stock` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_kemasan`
--

INSERT INTO `stock_kemasan` (`id`, `produk`, `nama_kemasan`, `stock`) VALUES
(1, 'Robusto', 'Wooden', 20),
(2, 'Robusto', 'Paper', 345),
(3, 'Robusto', 'Foil', 4005),
(4, 'Corona', 'Wooden', 38),
(5, 'Corona', 'Paper', 373),
(6, 'Corona', 'Foil', 8),
(8, 'Half Corona', 'Wooden', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_stiker`
--

CREATE TABLE `stock_stiker` (
  `id` int(11) NOT NULL,
  `produk` varchar(25) NOT NULL,
  `stock_luar` int(15) NOT NULL,
  `stock_dalam` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_stiker`
--

INSERT INTO `stock_stiker` (`id`, `produk`, `stock_luar`, `stock_dalam`) VALUES
(2, 'Robusto', 29, 100),
(3, 'Corona', 500, 500),
(4, 'Corona', 300, 300),
(5, 'Siglo VI', 300, 300),
(8, 'Maumere', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_subproduk`
--

CREATE TABLE `stock_subproduk` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `sub_produk` varchar(15) NOT NULL,
  `sub_kode` varchar(15) NOT NULL,
  `stock` int(15) NOT NULL,
  `id_subproduk` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_subproduk`
--

INSERT INTO `stock_subproduk` (`id`, `produk`, `sub_produk`, `sub_kode`, `stock`, `id_subproduk`) VALUES
(1, 'Robusto', 'Robusto', 'BR10', 5, 1),
(2, 'Robusto', 'Robusto', 'BR3', 14, 3),
(3, 'Corona', 'Corona', 'BC10', 2, 7),
(4, 'Corona', 'Corona', 'BC5', 4, 8),
(5, 'Robusto', 'Robusto', 'BR1', 2, 4),
(6, 'Robusto', 'Robusto', 'BR10', 5, 2),
(7, 'Robusto', 'Harvana Collect', 'BCOLL16H', 3, 6),
(9, 'Sumatra', 'Sumatera', 'Sumatera', 40, 12),
(10, 'Tambo', 'Tambo', 'Tambo 1', 15, 13),
(11, 'Magic', 'Magic - Boom', 'M-AIGS', 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `sub_produk`
--

CREATE TABLE `sub_produk` (
  `id` int(11) NOT NULL,
  `sub_produk` varchar(15) NOT NULL,
  `sub_kode` text NOT NULL,
  `kemasan` varchar(15) NOT NULL,
  `isi` int(15) NOT NULL,
  `hje` int(15) NOT NULL,
  `tarif` int(15) NOT NULL,
  `id_produk` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_produk`
--

INSERT INTO `sub_produk` (`id`, `sub_produk`, `sub_kode`, `kemasan`, `isi`, `hje`, `tarif`, `id_produk`) VALUES
(1, 'Robusto', 'BR10', 'Wooden', 10, 540000, 11000, '1'),
(2, 'Robusto', 'BR10', 'Wooden', 10, 540000, 540000, '1'),
(3, 'Robusto', 'BR3', 'Paper', 3, 165000, 165000, '1'),
(4, 'Robusto', 'BR1', 'Foil', 1, 54000, 54000, '1'),
(5, 'Boss Collection', 'BIHUM', 'Akrilik', 24, 1000000, 1000000, '1'),
(6, 'Harvana Collect', 'BCOLL16H', 'Wooden', 16, 800000, 800000, '1'),
(7, 'Corona', 'BC10', 'Wooden', 10, 500000, 500000, '2'),
(8, 'Corona', 'BC5', 'Paper', 5, 250000, 250000, '2'),
(9, 'Corona', 'BC1F', 'Foil', 1, 54000, 54000, '2'),
(10, 'Corona', 'BC1', 'Foil', 1, 50000, 50000, '2'),
(11, 'Boss Collection', 'BCOLL24', 'Wooden', 24, 1000000, 1000000, '2'),
(12, 'Sumatera', 'Sumatera', 'Wooden', 10, 80000, 80000, '19'),
(13, 'Tambo', 'Tambo 1', 'Paper', 1, 10000, 45000, '18'),
(14, 'El Nino Mackrup', 'El - nan', 'Wooden', 10, 500000, 250000, '6'),
(15, 'C99 - Coba', 'C99-DDKA', 'Paper', 10, 800000, 100000, '7'),
(16, 'Magic - Boom', 'M-AIGS', 'Plastik', 10, 550000, 400000, '30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `nama_lengkap` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `upload_foto` text NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `nama_lengkap`, `email`, `password`, `upload_foto`, `level`) VALUES
(1, 'admins', '', 'admin@admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'ice_bears.jpg', 'Super Admin'),
(3, 'bahan', '', 'bahan@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'okada.jpg', 'Bahan Baku'),
(4, 'proses', '', 'proses@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'shani_grc.jpg', 'Proses Produksi'),
(5, 'rfs', '', 'rfs@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'DgYC32CUwAAz1Oi.jpg', 'RFS'),
(6, 'Admin Store', '', 'store@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'img.png', 'STORE'),
(7, 'export', '', 'export@export.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'img.png', 'EXPORT'),
(8, 'Quality Control', '', 'qc@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'images.jpg', 'Quality Control'),
(9, 'amora', '', 'amora@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'DgShgooVQAEDpae.jpg', 'AGENT'),
(10, 'devianata', '', 'devianata@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'IMG_20180517_092725.jpg', 'AGENT'),
(11, 'karin', '', 'karin@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'IMG_20180517_091653.jpg', 'PHRI'),
(13, 'kolonel abega', '', 'kolonelabega@gmail.com', 'c9787e66998ee417e335b562f1d3b942c8f6274b', 'd814088b256e09b53029ac69d595b293.jpg', 'Super Admin'),
(14, 'bin cigar', '', 'bincigarjember@gmail.com', 'caf4460ba43a2540f97b773bc5d7c3d6fe6388f9', 'BIN1.png', 'Super Admin'),
(15, 'Ir. H Febrian Ananta Kahar', '', 'febrian.kahar@tarutamanusantara.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Super Admin'),
(16, 'Ir. H Imam Wahid Wahyudi', '', 'imam.ww@bincigar.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Super Admin'),
(17, 'Yayuk bincigar', '', 'ttn.yayoek@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Super Admin'),
(18, 'undik bincigar', '', 'general@bincigar.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Super Admin'),
(19, 'Nella bincigar', '', 'ttn.nelarevoni@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Super Admin'),
(20, 'Fara bincigar', '', 'farabincigar06@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Super Admin'),
(21, 'Lucky factory', '', 'Ifajariyanto@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Bahan Baku'),
(22, 'Lucky factory pro', '', 'luckybin_proses@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Proses Produksi'),
(23, 'Lucky factory QC', '', 'luckybin_qc@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Quality Control'),
(24, 'risma factory', '', 'rismabin_bahan_baku@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Bahan Baku'),
(25, 'risma pro', '', 'rismabin_proses@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Proses Produksi'),
(26, 'risma qc', '', 'rismabin_qc@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'Quality Control'),
(27, 'yuyun bincigar', '', 'yuyunbincigar07@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'STORE'),
(28, 'citra bincigar', '', 'citra.rfs@bincigar.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'RFS'),
(29, 'imam santoso', '', 'Iman.santoso@bincigar.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'PHRI'),
(30, 'Doni bincigar', '', 'donnynugroho64@gmail.com', '7ec86783d4a66210b58011edb09efd15d3ea1d3c', 'img.png', 'NON PHRI'),
(31, 'Sri Wahyuni', '', 'sriw71322@gmail.com', 'd5315553a29f132867d1c7e98bb9f43e110ee0b3', 'img.png', 'Bahan Baku');

-- --------------------------------------------------------

--
-- Table structure for table `wrapping`
--

CREATE TABLE `wrapping` (
  `id` int(11) NOT NULL,
  `produk` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `stock` decimal(10,2) NOT NULL,
  `terpakai` decimal(10,2) NOT NULL,
  `sisa` decimal(10,2) NOT NULL,
  `hasil` int(10) NOT NULL,
  `tambah_cerutu` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wrapping`
--

INSERT INTO `wrapping` (`id`, `produk`, `jenis`, `stock`, `terpakai`, `sisa`, `hasil`, `tambah_cerutu`, `hasil_akhir`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'TC', '200.00', '10.50', '189.50', 385, 380, 5, 'jam 2 langsung proses', '2018-09-10', 'admins'),
(2, 'Robusto', 'H8', '300.00', '24.00', '276.00', 485, 470, 15, '', '2018-09-13', 'admins'),
(3, 'Corona', 'TS', '100.00', '9.50', '90.50', 409, 400, 9, '', '2018-09-14', 'admins'),
(4, 'Robusto', 'VIRGINIA', '100.00', '12.63', '87.37', 299, 290, 9, '', '2018-09-17', 'admins'),
(5, 'Robusto', 'VIRGINIA', '137.37', '50.00', '87.37', 259, 250, 9, '', '2018-10-07', 'proses'),
(6, 'Sumatra', 'PADANG', '350.00', '300.00', '50.00', 950, 950, 0, 'wrapping tembakau padang sub sumatra', '2018-11-20', 'admins'),
(7, 'Tambo', 'TAMBO', '300.00', '300.00', '0.00', 1000, 1000, 0, 'mulai wrapping', '2018-11-23', 'admins'),
(8, 'Robusto', 'TH', '10.00', '2.90', '7.10', 966, 966, 0, '', '2018-12-31', 'bin cigar'),
(10, 'Magic', 'VIRGINIA', '87.37', '10.00', '77.37', 930, 920, 10, '', '2019-02-25', 'bin cigar');

-- --------------------------------------------------------

--
-- Table structure for table `wrapping_tmp`
--

CREATE TABLE `wrapping_tmp` (
  `id_wrap` int(11) NOT NULL,
  `produk_wrap` varchar(20) NOT NULL,
  `jenis_wrap` varchar(20) NOT NULL,
  `hasil_today` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wrapping_tmp`
--

INSERT INTO `wrapping_tmp` (`id_wrap`, `produk_wrap`, `jenis_wrap`, `hasil_today`) VALUES
(1, 'Robusto', 'TC', 110),
(2, 'Robusto', 'H8', 10),
(3, 'Corona', 'TS', 2),
(4, 'Corona', 'H8', 10),
(5, 'Robusto', 'VIRGINIA', 5),
(6, 'Sumatra', 'PADANG', 10),
(7, 'Tambo', 'TAMBO', 100),
(8, 'Robusto', 'TH', 0),
(9, 'Magic', 'VIRGINIA', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bagan_store`
--
ALTER TABLE `bagan_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binding`
--
ALTER TABLE `binding`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `binding_tmp`
--
ALTER TABLE `binding_tmp`
  ADD PRIMARY KEY (`id_bind`);

--
-- Indexes for table `cerutu_terjual`
--
ALTER TABLE `cerutu_terjual`
  ADD PRIMARY KEY (`id_cr_terjual`);

--
-- Indexes for table `cincin`
--
ALTER TABLE `cincin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cool`
--
ALTER TABLE `cool`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cool_tmp`
--
ALTER TABLE `cool_tmp`
  ADD PRIMARY KEY (`id_cool`);

--
-- Indexes for table `cukai`
--
ALTER TABLE `cukai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `data_produksi`
--
ALTER TABLE `data_produksi`
  ADD PRIMARY KEY (`id_pr`);

--
-- Indexes for table `data_stock`
--
ALTER TABLE `data_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_stock_tmp`
--
ALTER TABLE `data_stock_tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indexes for table `drying`
--
ALTER TABLE `drying`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drying2`
--
ALTER TABLE `drying2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drying2_tmp`
--
ALTER TABLE `drying2_tmp`
  ADD PRIMARY KEY (`id_dry2`);

--
-- Indexes for table `drying3`
--
ALTER TABLE `drying3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drying3_tmp`
--
ALTER TABLE `drying3_tmp`
  ADD PRIMARY KEY (`id_dry3`);

--
-- Indexes for table `drying_tmp`
--
ALTER TABLE `drying_tmp`
  ADD PRIMARY KEY (`id_dry`);

--
-- Indexes for table `filling`
--
ALTER TABLE `filling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filling_tmp`
--
ALTER TABLE `filling_tmp`
  ADD PRIMARY KEY (`id_fill`);

--
-- Indexes for table `frezer`
--
ALTER TABLE `frezer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frezer_tmp`
--
ALTER TABLE `frezer_tmp`
  ADD PRIMARY KEY (`id_frez`);

--
-- Indexes for table `fumigasi`
--
ALTER TABLE `fumigasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fumigasi_tmp`
--
ALTER TABLE `fumigasi_tmp`
  ADD PRIMARY KEY (`id_fumi`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kemasan`
--
ALTER TABLE `kemasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_produksi`
--
ALTER TABLE `laporan_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `level_user`
--
ALTER TABLE `level_user`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakai_kemasan`
--
ALTER TABLE `pakai_kemasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_cerutu`
--
ALTER TABLE `penjualan_cerutu`
  ADD PRIMARY KEY (`id_penjualan_bagan`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id_piutang`);

--
-- Indexes for table `pressing`
--
ALTER TABLE `pressing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pressing_tmp`
--
ALTER TABLE `pressing_tmp`
  ADD PRIMARY KEY (`id_pres`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qc`
--
ALTER TABLE `qc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qual_con_tmp`
--
ALTER TABLE `qual_con_tmp`
  ADD PRIMARY KEY (`id_q`);

--
-- Indexes for table `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id_reject`);

--
-- Indexes for table `return_bagan`
--
ALTER TABLE `return_bagan`
  ADD PRIMARY KEY (`id_return_bagan`);

--
-- Indexes for table `return_rfs`
--
ALTER TABLE `return_rfs`
  ADD PRIMARY KEY (`id_rtn`);

--
-- Indexes for table `rfs`
--
ALTER TABLE `rfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rfs_stock_keluar`
--
ALTER TABLE `rfs_stock_keluar`
  ADD PRIMARY KEY (`id_out`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stiker`
--
ALTER TABLE `stiker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_awalrekap`
--
ALTER TABLE `stock_awalrekap`
  ADD PRIMARY KEY (`id_strekap`);

--
-- Indexes for table `stock_bagan`
--
ALTER TABLE `stock_bagan`
  ADD PRIMARY KEY (`id_stock_bagan`);

--
-- Indexes for table `stock_cincin`
--
ALTER TABLE `stock_cincin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_cukai`
--
ALTER TABLE `stock_cukai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_kemasan`
--
ALTER TABLE `stock_kemasan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_stiker`
--
ALTER TABLE `stock_stiker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_subproduk`
--
ALTER TABLE `stock_subproduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_produk`
--
ALTER TABLE `sub_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wrapping`
--
ALTER TABLE `wrapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wrapping_tmp`
--
ALTER TABLE `wrapping_tmp`
  ADD PRIMARY KEY (`id_wrap`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagan_store`
--
ALTER TABLE `bagan_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `binding`
--
ALTER TABLE `binding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `binding_tmp`
--
ALTER TABLE `binding_tmp`
  MODIFY `id_bind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cerutu_terjual`
--
ALTER TABLE `cerutu_terjual`
  MODIFY `id_cr_terjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cincin`
--
ALTER TABLE `cincin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cool`
--
ALTER TABLE `cool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cool_tmp`
--
ALTER TABLE `cool_tmp`
  MODIFY `id_cool` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cukai`
--
ALTER TABLE `cukai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `data_produksi`
--
ALTER TABLE `data_produksi`
  MODIFY `id_pr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `data_stock`
--
ALTER TABLE `data_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `data_stock_tmp`
--
ALTER TABLE `data_stock_tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `drying`
--
ALTER TABLE `drying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `drying2`
--
ALTER TABLE `drying2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `drying2_tmp`
--
ALTER TABLE `drying2_tmp`
  MODIFY `id_dry2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drying3`
--
ALTER TABLE `drying3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `drying3_tmp`
--
ALTER TABLE `drying3_tmp`
  MODIFY `id_dry3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drying_tmp`
--
ALTER TABLE `drying_tmp`
  MODIFY `id_dry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `filling`
--
ALTER TABLE `filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `filling_tmp`
--
ALTER TABLE `filling_tmp`
  MODIFY `id_fill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `frezer`
--
ALTER TABLE `frezer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `frezer_tmp`
--
ALTER TABLE `frezer_tmp`
  MODIFY `id_frez` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fumigasi`
--
ALTER TABLE `fumigasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `fumigasi_tmp`
--
ALTER TABLE `fumigasi_tmp`
  MODIFY `id_fumi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kemasan`
--
ALTER TABLE `kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `laporan_produksi`
--
ALTER TABLE `laporan_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `level_user`
--
ALTER TABLE `level_user`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pakai_kemasan`
--
ALTER TABLE `pakai_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `penjualan_cerutu`
--
ALTER TABLE `penjualan_cerutu`
  MODIFY `id_penjualan_bagan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id_piutang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pressing`
--
ALTER TABLE `pressing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pressing_tmp`
--
ALTER TABLE `pressing_tmp`
  MODIFY `id_pres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `qc`
--
ALTER TABLE `qc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `qual_con_tmp`
--
ALTER TABLE `qual_con_tmp`
  MODIFY `id_q` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reject`
--
ALTER TABLE `reject`
  MODIFY `id_reject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `return_bagan`
--
ALTER TABLE `return_bagan`
  MODIFY `id_return_bagan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `return_rfs`
--
ALTER TABLE `return_rfs`
  MODIFY `id_rtn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rfs`
--
ALTER TABLE `rfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rfs_stock_keluar`
--
ALTER TABLE `rfs_stock_keluar`
  MODIFY `id_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stiker`
--
ALTER TABLE `stiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stock_awalrekap`
--
ALTER TABLE `stock_awalrekap`
  MODIFY `id_strekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stock_bagan`
--
ALTER TABLE `stock_bagan`
  MODIFY `id_stock_bagan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_cincin`
--
ALTER TABLE `stock_cincin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock_cukai`
--
ALTER TABLE `stock_cukai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_kemasan`
--
ALTER TABLE `stock_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_stiker`
--
ALTER TABLE `stock_stiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_subproduk`
--
ALTER TABLE `stock_subproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sub_produk`
--
ALTER TABLE `sub_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wrapping`
--
ALTER TABLE `wrapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wrapping_tmp`
--
ALTER TABLE `wrapping_tmp`
  MODIFY `id_wrap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
