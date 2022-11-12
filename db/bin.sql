-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2018 at 12:14 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bin`
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
(2, 'Store', '-'),
(3, 'Agent', '-\r\n'),
(4, 'Non Hotel', '-'),
(5, 'Hotel', '-'),
(6, 'Export', '-'),
(7, 'lap Penjualan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `binding`
--

CREATE TABLE `binding` (
  `id` int(11) NOT NULL,
  `produk` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `stock` int(15) NOT NULL,
  `terpakai` int(15) NOT NULL,
  `sisa_stock` int(15) NOT NULL,
  `hasil` int(15) NOT NULL,
  `mutasi` int(15) NOT NULL,
  `hasil_akhir` int(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `binding`
--

INSERT INTO `binding` (`id`, `produk`, `jenis`, `stock`, `terpakai`, `sisa_stock`, `hasil`, `mutasi`, `hasil_akhir`, `ket`, `tanggal`, `author`) VALUES
(10, 'Robusto', 'H8', 100, 90, 10, 150, 2, 148, 'Mutasi 2', '2018-06-27', 'admins'),
(11, 'Corona', 'TS', 400, 200, 200, 600, 50, 550, 'jelek', '2018-06-30', 'admins'),
(13, 'Corona', 'H8', 900, 500, 400, 1000, 10, 990, '-', '2018-07-01', 'admins'),
(14, 'Robusto', 'TC', 1400, 500, 900, 500, 0, 500, '-', '2018-07-02', 'admins');

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
(9, 'Robusto', 3000, 200, 100, 20, 3080, '2018-06-27');

-- --------------------------------------------------------

--
-- Table structure for table `cool`
--

CREATE TABLE `cool` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(10) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cool`
--

INSERT INTO `cool` (`id`, `produk`, `jenis`, `hasil`, `mutasi`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'H8', 140, 2, 138, '4 jam', 'dikit mutasi 2 ', '2018-06-28', 0),
(2, 'Corona', 'TS', 460, 10, 450, '1jam 2meni', '-', '2018-06-30', 0),
(3, 'Corona', 'H8', 800, 0, 800, '4 jam, 30 ', '-', '2018-07-01', 0),
(4, 'Robusto', 'TC', 460, 0, 460, '4jam 2meni', '-', '2018-07-02', 0);

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
  `jumlah` int(10) NOT NULL,
  `masuk` int(10) NOT NULL,
  `semua` int(10) NOT NULL,
  `masing` int(10) NOT NULL,
  `akhir` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `isi` int(10) NOT NULL,
  `hje` int(20) NOT NULL,
  `tarif` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cukai`
--

INSERT INTO `cukai` (`id`, `subproduk`, `sub_kode`, `lama`, `baru`, `jumlah`, `masuk`, `semua`, `masing`, `akhir`, `tanggal`, `isi`, `hje`, `tarif`) VALUES
(2, 'Robusto', 'BR10', 20, 0, 20, 0, 20, 20, 20, '2018-06-23', 10, 450000, 11000),
(3, 'Robusto', 'BR1', 100, 10, 110, 100, 200, 10, 2, '2018-06-27', 1, 0, 0),
(4, 'Corona', 'BC10', 100, 100, 200, 100, 100, 100, 100, '2018-06-26', 10, 500000, 11000),
(5, 'Corona', 'BC10', 4, 0, 4, 0, 4, 4, 0, '2018-06-26', 10, 500000, 11000),
(6, 'Corona', 'BC10', 500, 100, 600, 200, 10, 20, 0, '2018-06-28', 10, 500000, 11000);

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
  `stock_masuk` int(10) NOT NULL,
  `diterima` int(10) NOT NULL,
  `diproduksi` int(10) NOT NULL,
  `hari_ini` int(10) NOT NULL,
  `ket` text NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_stock`
--

INSERT INTO `data_stock` (`id`, `tanggal`, `asal`, `jenis`, `kategori`, `stock_masuk`, `diterima`, `diproduksi`, `hari_ini`, `ket`, `author`) VALUES
(8, '2018-06-26', 'Tanam Sendiri', 'H8', 'Fillter', 120, 120, 100, 0, 'No Problem', 'admins'),
(9, '2018-06-27', 'Tanam Sendiri', 'H8', 'Fillter', 200, 200, 100, 0, 'bagus', 'admins'),
(10, '2018-06-27', 'Tanam Sendiri', 'H8', 'Omblad', 100, 100, 900, 0, 'good', 'admins'),
(11, '2018-06-27', 'Tanam Sendiri', 'H8', 'Dekblad', 80, 80, 1000, 0, '-', 'admins'),
(12, '2018-06-30', 'Tanam Sendiri', 'TS', 'Fillter', 500, 500, 100, 0, 'masuk tanpa ada kesalahan', 'admins'),
(14, '2018-06-30', 'Tanam Sendiri', 'H8', 'Omblad', 300, 300, 900, 0, '-', 'admins'),
(15, '2018-06-30', 'Tanam Sendiri', 'H8', 'Dekblad', 700, 700, 1000, 0, '', 'admins'),
(16, '2018-07-01', 'Tanam Sendiri', 'H8', 'Fillter', 500, 500, 100, 0, '-\r\n', 'admins'),
(17, '2018-07-01', 'Tanam Sendiri', 'H8', 'Omblad', 500, 500, 900, 0, '-', 'admins'),
(18, '2018-07-01', 'Tanam Sendiri', 'H8', 'Dekblad', 500, 500, 1000, 0, '-', 'admins'),
(19, '2018-07-02', 'Tanam Sendiri', 'TC', 'Fillter', 500, 500, 100, 0, '-', 'admins'),
(20, '2018-07-02', 'Tanam Sendiri', 'TC', 'Omblad', 500, 500, 900, 0, '-', 'admins'),
(21, '2018-07-02', 'Tanam Sendiri', 'TC', 'Dekblad', 500, 500, 1000, 0, '-', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `drying`
--

CREATE TABLE `drying` (
  `id` int(11) NOT NULL,
  `produk` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` text NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying`
--

INSERT INTO `drying` (`id`, `produk`, `jenis`, `hasil`, `mutasi`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(7, 'Robusto', 'H8', 147, 1, 146, '4 jam, 40 Menit', 'mutasi 1', '2018-06-27', 'admins'),
(8, 'Corona', 'TS', 500, 10, 490, '1jam 2menit', '-', '2018-06-30', 'admins'),
(9, 'Corona', 'H8', 980, 20, 960, '4jam 2menit', '-', '2018-07-01', 'admins'),
(10, 'Robusto', 'TC', 490, 10, 480, '4jam 2menit', '-', '2018-07-02', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `drying2`
--

CREATE TABLE `drying2` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying2`
--

INSERT INTO `drying2` (`id`, `produk`, `jenis`, `hasil`, `mutasi`, `sisa`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(5, 'Robusto', 'H8', 143, 3, 0, 140, '4 jam', 'mutasi 3', '2018-06-28', 'admins'),
(6, 'Corona', 'TS', 470, 10, 0, 460, '4jam 2menit', '-', '2018-06-30', 'admins'),
(7, 'Corona', 'H8', 900, 100, 0, 800, '4jam 2menit', '-', '2018-07-01', 'admins'),
(8, 'Robusto', 'TC', 470, 10, 0, 460, '4jam 2menit', '-', '2018-07-02', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `drying3`
--

CREATE TABLE `drying3` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drying3`
--

INSERT INTO `drying3` (`id`, `produk`, `jenis`, `hasil`, `mutasi`, `sisa`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(2, '', '', 0, 0, 0, 0, '1jam 30menit', '', '2018-06-18', 'admins'),
(3, 'Robusto', 'H8', 138, 3, 0, 400, '4jam 2menit', 'mutasi 3', '2018-06-28', 'admins'),
(4, 'Corona', 'TS', 450, 50, 0, 700, '4jam 2menit', '-', '2018-06-30', 'admins'),
(5, 'Corona', 'H8', 800, 50, 0, 700, '4jam 2menit', '-', '2018-07-01', 'admins'),
(6, 'Robusto', 'TC', 460, 10, 0, 400, '4 jam, 30 Menit', '-', '2018-07-02', 'admins'),
(7, 'Robusto', 'TC', 460, 60, 0, 400, '1jam 2menit', '-', '2018-07-03', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `filling`
--

CREATE TABLE `filling` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `stock` int(15) NOT NULL,
  `terpakai` int(15) NOT NULL,
  `sisa` int(15) NOT NULL,
  `hasil` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `filling`
--

INSERT INTO `filling` (`id`, `produk`, `jenis`, `stock`, `terpakai`, `sisa`, `hasil`, `tanggal`, `author`) VALUES
(5, 'Robusto', 'H8', 200, 180, 20, 150, '2018-06-27', 'admins'),
(6, 'Corona', 'TS', 500, 490, 10, 600, '2018-06-30', 'admins'),
(8, 'Corona', 'H8', 500, 300, 200, 1000, '2018-07-01', 'admins'),
(9, 'Robusto', 'TC', 500, 300, 200, 500, '2018-07-02', 'admins'),
(10, 'Robusto', 'TC', 200, 100, 100, 90, '2018-07-03', 'admins'),
(11, 'Robusto', 'TC', 200, 100, 100, 90, '2018-07-03', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `frezer`
--

CREATE TABLE `frezer` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `frezer`
--

INSERT INTO `frezer` (`id`, `produk`, `jenis`, `hasil`, `mutasi`, `sisa`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(2, '', '', 0, 0, 0, 0, '1jam 30menit', '', '2018-06-18', 'admins'),
(4, 'Robusto', 'H8', 145, 2, 0, 143, '4 jam, 30 Menit', 'mutasi 2 saat frezer', '2018-06-28', 'admins'),
(5, 'Corona', 'TS', 480, 10, 0, 470, '4jam 2menit', '-', '2018-06-30', 'admins'),
(6, 'Corona', 'H8', 950, 50, 0, 900, '4jam 2menit', '-', '2018-07-01', 'admins'),
(7, 'Robusto', 'TC', 470, 0, 0, 470, '4jam 2menit', '-', '2018-07-02', 'admins');

-- --------------------------------------------------------

--
-- Table structure for table `fumigasi`
--

CREATE TABLE `fumigasi` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(25) NOT NULL,
  `tanggal` date NOT NULL,
  `ket` text NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fumigasi`
--

INSERT INTO `fumigasi` (`id`, `produk`, `jenis`, `hasil`, `mutasi`, `hasil_akhir`, `lama`, `tanggal`, `ket`, `author`) VALUES
(4, 'Robusto', 'H8', 146, 6, 140, '4 jam', '2018-06-27', 'Mutasi 6, banyak amat >:(', 'admins'),
(5, 'Robusto', 'H8', 146, 1, 145, '4jam 2menit', '2018-06-28', 'mutasi 1', 'admins'),
(6, 'Corona', 'TS', 490, 10, 480, '1jam 2menit', '2018-06-30', '-', 'admins'),
(7, 'Corona', 'H8', 960, 10, 950, '4 jam, 30 Menit', '2018-07-01', '-', 'admins'),
(8, 'Robusto', 'TC', 480, 10, 470, '4jam 2menit', '2018-07-02', '-', 'admins');

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
(5, 'H8', '-', '-'),
(6, 'TC', '-', '-'),
(7, 'TS', '-', '-');

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
(4, 'Filler', 'Filling', '-'),
(5, 'Omblad', '-', '-'),
(6, 'Dekblad', '-', '-');

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
(8, 'Foil');

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
(3, 'ajksdh', 'asasdkjh', 'askjdh', 'akjsdh', 'askdjh', 'aksdjh', 'aksjdh', '897', '987', '987', 'aklsdh', 'alksjdh', 'aksjdh', '<p>hyhyhyhy</p>', '<p>hyhyhyhy</p>', '2018-07-02', 'admins', 0);

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
(4, 'Robusto', 9, 'BR3', 'Paper', 3, 165000, '5', 3, 495000, 'Store', 'beli pak', 'Admin Store', '2018-06-27', 1, 0),
(5, 'Robusto', 8, 'BR10', 'Wooden', 10, 450000, '5', 10, 4500000, 'Hotel', 'beli ini pak 10', 'hotel', '2018-07-23', 1, 0);

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
  `terjual` int(15) NOT NULL,
  `hje` int(15) NOT NULL,
  `total` int(15) NOT NULL,
  `diskon` int(15) NOT NULL,
  `sistem` varchar(10) NOT NULL,
  `ongkos` int(20) NOT NULL,
  `bagan` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `produk`, `id_subproduk`, `subproduk`, `sub_kode`, `stock`, `keluar`, `sisa`, `terjual`, `hje`, `total`, `diskon`, `sistem`, `ongkos`, `bagan`, `tanggal`, `author`) VALUES
(25, 'Robusto', 8, 'Robusto', 'BR10', 100, 50, 49, 1, 450000, 225000, 50, '', 0, 'Store', '2018-07-02', 'admins'),
(26, 'Corona', 14, 'Corona', 'BC5', 3, 2, 1, 1, 275000, 137500, 50, 'Transfer', 0, 'Store', '2018-07-01', 'rfs'),
(29, 'Corona', 13, 'Corona', 'BC10', 5, 2, 0, 2, 500000, 500000, 50, 'Transfer', 2000, 'Store', '2018-07-03', 'admins'),
(30, '5', 8, 'Robusto', 'BR10', 115, 2, 113, 2, 450000, 450000, 0, '', 0, '', '0000-00-00', ''),
(31, '5', 8, 'Robusto', 'BR10', 111, 2, 109, 2, 450000, 450000, 50, '', 13000, 'Store', '2018-07-22', 'rfs'),
(32, '6', 14, 'Corona', 'BC5', 25, 3, 22, 3, 275000, 577500, 30, 'Cash', 10000, 'Store', '2018-07-23', 'rfs'),
(33, 'Corona', 13, 'Corona', 'BC10', 3, 2, 0, 2, 500000, 500000, 50, 'Cash', 100000, 'Export', '2018-07-18', 'rfs');

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
(8, 23, 'ini pak yg di accept cuman 60 batang sadja', '2018-07-03', 'admins', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pressing`
--

CREATE TABLE `pressing` (
  `id` int(11) NOT NULL,
  `produk` varchar(15) NOT NULL,
  `jenis` varchar(15) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `lama` varchar(15) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pressing`
--

INSERT INTO `pressing` (`id`, `produk`, `jenis`, `hasil`, `mutasi`, `sisa`, `hasil_akhir`, `lama`, `ket`, `tanggal`, `author`) VALUES
(6, 'Robusto', 'H8', 148, 2, 0, 146, '4 jam, 30 Menit', 'Mutasi 2', '2018-06-27', 'admins'),
(7, 'Corona', 'TS', 550, 25, 0, 525, '4jam 2menit', '-', '2018-06-30', 'admins'),
(9, 'Corona', 'H8', 990, 10, 0, 980, '4jam 2menit', '-', '2018-07-01', 'admins'),
(10, 'Robusto', 'TC', 500, 10, 0, 490, '4jam 2menit', 'karena jelek', '2018-07-02', 'admins');

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
(5, 'Robusto'),
(6, 'Corona');

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
  `reject` int(11) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qc`
--

INSERT INTO `qc` (`id`, `produk`, `jenis`, `stock`, `accept`, `reject`, `ket`, `tanggal`, `author`) VALUES
(3, 'Robusto', 'H8', 138, 110, 28, 'Jelek Bangetdzzz', '2018-06-28', 'admins'),
(4, 'Robusto', 'H8', 138, 120, 18, 'jelek yg 18 pak', '2018-06-29', 'admins'),
(5, 'Robusto', 'H8', 138, 137, 1, '-', '2018-06-30', 'admins'),
(6, 'Robusto', 'H8', 138, 136, 2, '-', '2018-06-30', 'admins'),
(7, 'Robusto', 'H8', 138, 120, 18, '-', '2018-06-30', 'admins'),
(8, 'Corona', 'TS', 400, 350, 50, 'di reject 50', '2018-06-30', 'admins'),
(12, 'Corona', 'H8', 750, 700, 50, '-', '2018-07-01', 'proses'),
(28, 'Robusto', 'TC', 460, 60, 0, '-', '2018-07-03', 'admins'),
(29, 'Corona', 'H8', 750, 50, 0, '-', '2018-07-03', 'admins');

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
(47, 0, 460, 0, 0, 0, '', 'Robusto', '', '', 0, 0, 0, 60, 'admins', '2018-07-03'),
(48, 0, 750, 0, 0, 0, '', 'Corona', '', '', 0, 0, 0, 50, 'admins', '2018-07-03'),
(49, 13, 15, 3, 1, 13, '-', '', 'Corona', 'Wooden', 10, 50, 30, 20, 'admins', '2018-07-03'),
(50, 8, 113, 2, 0, 115, '-', '', 'Robusto', 'Wooden', 10, 60, 20, 40, 'rfs', '2018-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `direktur` varchar(15) NOT NULL,
  `kabag` varchar(15) NOT NULL,
  `qc` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `direktur`, `kabag`, `qc`) VALUES
(1, 'Ir.H.M Imam Wah', 'Slamet Wijaya', 'Citra Wahyu Les');

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
(9, 'Robusto', 139, 0, 10, 129, 30, 0, 10, 20, 169, 0, 20, 149, '2018-06-27');

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
(1, 'Robusto', 3080),
(4, 'Corona', 2000);

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
(7, 13, 'Corona', 'BC10', 'Corona', 500);

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
(2, 'Robusto', 'Wooden', 15);

-- --------------------------------------------------------

--
-- Table structure for table `stock_stiker`
--

CREATE TABLE `stock_stiker` (
  `id` int(11) NOT NULL,
  `produk` varchar(25) NOT NULL,
  `stock_luar` int(15) NOT NULL,
  `stock_dalam` int(15) NOT NULL,
  `jumlah` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_stiker`
--

INSERT INTO `stock_stiker` (`id`, `produk`, `stock_luar`, `stock_dalam`, `jumlah`) VALUES
(2, 'Robusto', 129, 20, 149);

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
(1, 'Robusto', 'Tsting', 'BR 10', 109, 8),
(2, 'Corona', 'Corona', 'BC10', 13, 13),
(3, 'Corona', 'Corona', 'BC1', 20, 16),
(4, 'Corona', 'Corona', 'BC5', 22, 14),
(5, 'Robusto', 'Robusto', 'BR1', 50, 10);

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
(6, 'Robusto', 'BR10', 'Wooden', 10, 540000, 11000, '3'),
(8, 'Robusto', 'BR10', 'Wooden', 10, 450000, 11000, '5'),
(9, 'Robusto', 'BR3', 'Paper', 3, 165000, 11000, '5'),
(10, 'Robusto', 'BR1', 'Plastik', 1, 0, 0, '5'),
(11, 'Boss Collection', 'BIHUMSeed', 'Wooden', 3, 0, 0, '5'),
(12, 'Harvana Collect', 'BIHUMSeed', 'Wooden', 3, 0, 0, '5'),
(13, 'Corona', 'BC10', 'Wooden', 10, 500000, 11000, '6'),
(14, 'Corona', 'BC5', 'Paper', 5, 275000, 11000, '6'),
(15, 'Corona', 'BC1F', 'Foil', 1, 54000, 11000, '6'),
(16, 'Corona', 'BC1', 'Plastik', 1, 0, 0, '6'),
(17, 'Boss Collection', 'BIHUMSeed', 'Wooden', 1, 0, 0, '6');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `upload_foto` text NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `upload_foto`, `level`) VALUES
(1, 'admins', 'admin@admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'A6ygJjmU_400x400.jpg', 'Super Admin'),
(3, 'bahan', 'bahan@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'img.png', 'Bahan Baku'),
(4, 'proses', 'proses@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'img.png', 'Proses Produksi'),
(5, 'rfs', 'rfs@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'img.png', 'RFS'),
(6, 'Admin Store', 'store@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'img.png', 'Store'),
(7, 'hotel', 'hotel@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'img.png', 'Hotel');

-- --------------------------------------------------------

--
-- Table structure for table `wrapping`
--

CREATE TABLE `wrapping` (
  `id` int(11) NOT NULL,
  `produk` varchar(10) NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `terpakai` int(10) NOT NULL,
  `sisa` int(10) NOT NULL,
  `hasil` int(10) NOT NULL,
  `mutasi` int(10) NOT NULL,
  `hasil_akhir` int(10) NOT NULL,
  `ket` text NOT NULL,
  `tanggal` date NOT NULL,
  `author` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wrapping`
--

INSERT INTO `wrapping` (`id`, `produk`, `jenis`, `stock`, `terpakai`, `sisa`, `hasil`, `mutasi`, `hasil_akhir`, `ket`, `tanggal`, `author`) VALUES
(1, 'Robusto', 'H8', 80, 79, 1, 148, 1, 147, 'tidak ada mutasi hari ini, jadi mutasi 1', '2018-06-27', 'admins'),
(2, 'Corona', 'TS', 780, 500, 280, 525, 25, 500, '-', '2018-06-30', 'admins'),
(5, 'Corona', 'H8', 1200, 500, 700, 980, 0, 980, '-', '2018-07-01', 'admins'),
(6, 'Robusto', 'TC', 1700, 700, 1000, 490, 0, 490, '-', '2018-07-02', 'admins');

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
-- Indexes for table `cukai`
--
ALTER TABLE `cukai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_stock`
--
ALTER TABLE `data_stock`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `drying3`
--
ALTER TABLE `drying3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filling`
--
ALTER TABLE `filling`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frezer`
--
ALTER TABLE `frezer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fumigasi`
--
ALTER TABLE `fumigasi`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pressing`
--
ALTER TABLE `pressing`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `rfs`
--
ALTER TABLE `rfs`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bagan_store`
--
ALTER TABLE `bagan_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `binding`
--
ALTER TABLE `binding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cincin`
--
ALTER TABLE `cincin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cool`
--
ALTER TABLE `cool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cukai`
--
ALTER TABLE `cukai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `data_stock`
--
ALTER TABLE `data_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `drying`
--
ALTER TABLE `drying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `drying2`
--
ALTER TABLE `drying2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `drying3`
--
ALTER TABLE `drying3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `filling`
--
ALTER TABLE `filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `frezer`
--
ALTER TABLE `frezer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fumigasi`
--
ALTER TABLE `fumigasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kemasan`
--
ALTER TABLE `kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `laporan_produksi`
--
ALTER TABLE `laporan_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pakai_kemasan`
--
ALTER TABLE `pakai_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pressing`
--
ALTER TABLE `pressing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `qc`
--
ALTER TABLE `qc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `rfs`
--
ALTER TABLE `rfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stiker`
--
ALTER TABLE `stiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stock_cincin`
--
ALTER TABLE `stock_cincin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_cukai`
--
ALTER TABLE `stock_cukai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_kemasan`
--
ALTER TABLE `stock_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_stiker`
--
ALTER TABLE `stock_stiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_subproduk`
--
ALTER TABLE `stock_subproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sub_produk`
--
ALTER TABLE `sub_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wrapping`
--
ALTER TABLE `wrapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
