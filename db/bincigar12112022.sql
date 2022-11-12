-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 12, 2022 at 03:33 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

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
(1, 'Robusto', 'H8', '500.00', '250.00', '250.00', 500, 9500, -9000, 'devtvgfdcd', '2019-05-20', 'bin cigar'),
(3, 'Corona', 'TC', '50.00', '25.00', '25.00', 1000, 850, 150, 'saeefcd', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 525),
(2, 'Corona', 'TC', 50);

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
(1, 1, 1, 2, 0, 1080000, '2019-05-20');

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
(1, 'Robusto', 'H8', 8000, 7800, 200, '2 jam', 'ghynu', '2019-05-04', 0),
(3, 'Corona', 'TC', 640, 620, 20, '4 jam', 'sade', '2019-05-20', 0);

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
(1, 'Robusto', 'H8', 200),
(2, 'Corona', 'TC', 20);

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
(10, 9, 'Cerutumu.com', '033112312', 'a@mascitra.com', 'Jl. Nusantara GF-7A Jember', ''),
(11, 29, 'Aston Jember Hotel & Conference Center', '(0331) 423888', 'jemberfba@astonhotelsinternational.com', 'Jl. Sentot Prawirodirjo No. 88 Kaliwates Jember 68131', 'Konsinyasi, CP: Indri (085259312388)'),
(12, 29, 'Hotel Dafam Lotus Jember', '(0331) 5102777', 'fbm@dafam-lotusjember.com', 'Jl. Jendral, Jl. Gatot Subroto No.47, Tembaan, Kepatihan, Kaliwates, Jember Re,  68131', 'Konsinyasi, CP: Ivan (082396228949)'),
(13, 29, 'Hotel 88 Jember', 'ia.hotel88jember@gmail.com, hotel88jember@gmail.co', '(0331) 482555', 'Jl. Diponegoro No.43, Kaliwates, Jember, 31114', 'Konsinyasi, CP: Santi (08971781495)'),
(14, 29, 'Hotel Cempaka Hill Jember', '(0331) 424479', '', 'Jl. Cempaka No.50, Kedawung , Gebang, Patrang, Jember 68117', 'Konsiyasi, CP: Ilma, (081357031612)'),
(15, 29, 'Hotel Lestari Jember', '(0331) 487920', '', 'Jl. Gajah Mada No.233, Kaliwates, Jember, 68113', 'Konsinyasi, CP:Teguh, 08124910100 '),
(16, 29, 'Hotel Bandung Permai Jember', '(0331) 484528', '', 'Jl. Hayam Wuruk No.38, Kaliwates, Jember, 66184', 'Konsinyasi, CP: Ratna, 081243546623 '),
(17, 29, 'Hotel Royal Jember', '(0331) 326677', '', 'Jl. Karimata No. 50 Kav. 2, Sumbersari, Gumuk Kerang, Jember, 68121', 'Konsinyasi, CP: Firman, 082244938414'),
(18, 29, 'RM. Lestari Jember', '(0331) 489162', '', 'Jl. RA. Kartini 14 - 16, Jember, 68137', 'Konsinyasi, CP: Ari, 0895345282053'),
(19, 29, 'D\'glayer Resto Jember', '0822-5757-3457', '', 'Depan Jember Klinik, Kp. Using, Jemberlor, Patrang, Kabupaten Jember, 68118', 'Agoh/budi, 081233031424'),
(20, 29, 'Transmart Jember', '', '', 'Jl. Hayam Wuruk, Gerdu, Sempusari, Kaliwates, Kabupaten Jember, Jawa Timur 68131', 'Konsinyasi, CP: Indah, 082234127497'),
(21, 29, 'Aston Banyuwangi Hotel & conference center', '(0333) 3383888', 'banyuwangifbm@astonhotelsinternational.com', 'Jl. Brawijaya, Mojopanggung, Giri, Banyuwangi, 68425', 'Konsinyasi, CP:Ariyadi, 087761180809 '),
(23, 31, 'Pembeli Store', '', '', '', ''),
(24, 29, 'Hotel Mirah Banyuwangi', '(0333) 420600', '', 'Jl. Yos Sudarso, Lingkungan Tj., Klatak, Kalipuro, Kabupaten Banyuwangi, Jawa Timur 68421', 'konsinyasi, CP: Wahyu Tano 081333887308'),
(25, 29, 'Hotel Tugu Malang', '(0341) 36389', 'sina.0038@gmail.com', 'Jl. Tugu No.3, Kauman, Klojen, Malang, 65119', 'Konsinyasi, CP: Anis 082143138153 '),
(26, 29, 'Aston Inn Batu', 'baturtm@astonhotelsinternayional.com', '(0341) 595555', 'Jl. Abdul Gani Atas No.42, Ngaglik, Batu, Malang 65311', 'Konsinyasi, CP: Agustin 08125507336 '),
(27, 29, 'Hotel The Alana Surabaya', ' (031) 8286818', 'SurabayaFBM@alanahotels.com', 'Jl. Ketintang Baru I No. 10-12 Surabaya 60231', 'Konsinyasi, CP: Budi Santoso, 0813-3219-9070'),
(28, 29, 'Hotel Zoom Jemursari', '', '', 'Jl. Raya Jemursari No.109 B-C, Jemur Wonosari, Wonocolo, Surabaya, 60237', 'Konsinyasi, CP: Jefri 0895396037541'),
(29, 29, 'Hotel Zoom Dharmahusada', '(031) 5937788', 'suryaramadhan260@gmail.com', 'Jl. Dharmahusada Blok A-3 No.188, Mojo, Gubeng, Surabaya, 60285', 'Konsinyasi, CP: Surya 08981428064'),
(30, 29, 'Hotel Grand Darmo Suite Surabaya', '(031) 5611611', 'fbadmin@granddarmosuite.com', 'Jl. Progo No.1-3, Darmo, Wonokromo, Surabaya, 60241', 'Konsinyasi, CP: Angga 082145007566');

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
(1, 'H8', 'FILLER 2', '0.00'),
(2, 'TC', 'FILLER 1', '50.00'),
(3, 'TC', 'OMBLAD', '25.00'),
(4, 'TC', 'DEKBLAD', '25.00'),
(5, 'H8', 'FILLER 1', '250.00'),
(6, 'H8', 'OMBLAD', '250.00'),
(7, 'H8', 'DEKBLAD', '250.00'),
(8, 'TS', 'FILLER 1', '0.00'),
(9, 'TS', 'OMBLAD', '0.00'),
(10, 'TS', 'DEKBLAD', '0.00'),
(12, 'TC', 'FILLER 2', '0.00'),
(13, 'VIRGINIA', 'FILLER 1', '0.00'),
(14, 'VIRGINIA', 'OMBLAD', '0.00'),
(15, 'VIRGINIA', 'DEKBLAD', '0.00'),
(16, 'PADANG', 'FILLER 1', '0.00'),
(17, 'PADANG', 'OMBLAD', '0.00'),
(18, 'PADANG', 'DEKBLAD', '0.00'),
(19, 'TAMBO', 'FILLER 1', '0.00'),
(20, 'TAMBO', 'OMBLAD', '0.00'),
(21, 'TAMBO', 'DEKBLAD', '0.00'),
(22, 'TH', 'FILLER 1', '0.00'),
(23, 'TH', 'OMBLAD', '0.00'),
(24, 'TH', 'DEKBLAD', '0.00'),
(25, 'OPL', 'FILLER 1', '0.00'),
(26, 'OPL', 'OMBLAD', '0.00'),
(27, 'OPL', 'DEKBLAD', '0.00');

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
(1, '2019-05-04', 'Tanam Sendiri', 'H8', 'FILLER 1', '1000.00', '1000.00', '500.00', '500.00', 'dssd', 'bin cigar'),
(2, '2019-05-04', 'Tanam Sendiri', 'H8', 'OMBLAD', '1000.00', '1000.00', '500.00', '500.00', 'csmkd', 'bin cigar'),
(3, '2019-05-04', 'Tanam Sendiri', 'H8', 'DEKBLAD', '1000.00', '1000.00', '500.00', '500.00', 'dsvf', 'bin cigar'),
(4, '2019-05-20', 'Tanam Sendiri', 'TC', 'FILLER 1', '100.00', '100.00', '50.00', '50.00', 'nxjj', 'bin cigar'),
(5, '2019-05-20', 'Tanam Sendiri', 'TC', 'OMBLAD', '100.00', '100.00', '50.00', '50.00', 'xjks', 'bin cigar'),
(6, '2019-05-20', 'Tanam Sendiri', 'TC', 'FILLER 1', '100.00', '100.00', '50.00', '100.00', 'sadeer', 'bin cigar'),
(7, '2019-05-20', 'Tanam Sendiri', 'TC', 'DEKBLAD', '100.00', '100.00', '50.00', '50.00', 'ndj', 'bin cigar');

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
(1, 'H8', 'FILLER 2', '0.00'),
(2, 'TC', 'FILLER 1', '100.00'),
(3, 'TC', 'OMBLAD', '50.00'),
(4, 'TC', 'DEKBLAD', '50.00'),
(5, 'H8', 'FILLER 1', '500.00'),
(6, 'H8', 'OMBLAD', '500.00'),
(7, 'H8', 'DEKBLAD', '500.00'),
(8, 'TS', 'FILLER 1', '0.00'),
(9, 'TS', 'OMBLAD', '0.00'),
(10, 'TS', 'DEKBLAD', '0.00'),
(11, 'VIRGINIA', 'FILLER 1', '0.00'),
(12, 'VIRGINIA', 'OMBLAD', '0.00'),
(13, 'VIRGINIA', 'DEKBLAD', '0.00'),
(14, 'PADANG', 'FILLER 1', '0.00'),
(15, 'PADANG', 'OMBLAD', '0.00'),
(16, 'PADANG', 'DEKBLAD', '0.00'),
(17, 'TAMBO', 'FILLER 1', '0.00'),
(18, 'TAMBO', 'OMBLAD', '0.00'),
(19, 'TAMBO', 'DEKBLAD', '0.00'),
(21, 'TH', 'OMBLAD', '0.00'),
(22, 'TH', 'DEKBLAD', '0.00'),
(23, 'OPL', 'FILLER 1', '0.00'),
(24, 'OPL', 'OMBLAD', '0.00'),
(25, 'OPL', 'DEKBLAD', '0.00'),
(26, 'TH', 'FILLER 1', '0.00');

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
(1, 'Robusto', 'H8', 8800, 8600, 200, '2 jam', 'dsedv', '2019-05-04', 'bin cigar'),
(4, 'Corona', 'TC', 700, 680, 20, '4 jam', 'asdc', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 8400, 8200, 200, '2 jam', 'gdfh', '2019-05-04', 'bin cigar'),
(3, 'Corona', 'TC', 670, 650, 20, '4 jam', 'xsds', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 200),
(2, 'Corona', 'TC', 10);

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
(1, 'Robusto', 'H8', 7800, 7600, 200, '2 jam', 'sdrvd', '2019-05-04', 'bin cigar'),
(3, 'Corona', 'TC', 620, 600, 600, '4 jam', 'dsfd', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 150),
(2, 'Corona', 'TC', 100);

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
(1, 'Robusto', 'H8', 200),
(2, 'Corona', 'TC', 10);

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
(1, 'Robusto', 'H8', '500.00', '250.00', '250.00', 10000, '2019-05-04', 'bin cigar'),
(3, 'Corona', 'TC', '100.00', '50.00', '50.00', 1000, '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 500),
(2, 'Corona', 'TC', 150);

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
(1, 'Robusto', 'H8', 8600, 8400, 200, '2 jam', 'ftnj', '2019-05-04', 'bin cigar'),
(3, 'Corona', 'TC', 680, 670, 10, '4 jam', 'sadecxvd', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 200),
(2, 'Corona', 'TC', 20);

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
(1, 'Robusto', 'H8', 8200, 8000, 200, '2 jam', '2019-05-04', 'cfgt', 'bin cigar'),
(3, 'Corona', 'TC', 650, 640, 10, '4 jam', '2019-05-20', 'sfrs', 'bin cigar');

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
(1, 'Robusto', 'H8', 200),
(2, 'Corona', 'TC', 20);

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
(8, '', '', '', '', '', '', '', '500000', '2000000', '1000000', '6', '1', '1', '', '', '2019-05-02', 'citra bincigar', 0);

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
(1, 'Robusto', 1, 'Robusto', 'BR10', 300, 15, 285, 'dsr', 'AGENT', 'devianata', '2019-05-04', 'bin cigar', '2019-05-04 04:02:29'),
(2, 'Corona', 7, 'Corona', 'BC10', 10, 5, 5, 'aws', 'AGENT', 'amora', '2019-05-20', 'bin cigar', '2019-05-20 05:05:32');

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
(1, 1080000, 0, 'Cash', 20000, 1100000, 1100000, 10, 'AGENT', '2019-05-20', 'bin cigar', 5, '001/EXP/V/2019', 'Merpati', '2019-05-20', '-', 'Jember', 'Jakarta', 'sedvr', '2019-05-20 03:01:01');

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
(1, 2, 'sip', '2019-05-20', 'bin cigar', 0),
(2, 3, 'dse', '2019-05-20', 'bin cigar', 0);

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
(1, 'Robusto', 'H8', 9500, 9000, 500, '2 jam', 'dcfg', '2019-05-04', 'bin cigar'),
(3, 'Corona', 'TC', 850, 800, 50, '1 jam', 'ade', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 200),
(2, 'Corona', 'TC', 100);

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
(1, 'Robusto', 'H8', 7600, 7400, 25, 25, 0, 'fgtht', '2019-05-04', 'bin cigar'),
(3, 'Corona', 'TC', 600, 500, 0, 0, 0, 'xse', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 1400),
(2, 'Corona', 250);

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
(1, 1, 0, 600, 300, 300, 'cdg', 'Robusto', 'Robusto', 'Wooden', 10, 7400, 6000, 1400, 'bin cigar', '2019-05-04'),
(2, 7, 0, 25, 0, 25, '', 'Corona', 'Corona', 'Wooden', 10, 500, 250, 250, 'bin cigar', '2019-05-20'),
(3, 7, 25, 0, 10, 15, 'as', 'Corona', 'Corona', 'Wooden', 10, 250, 0, 250, 'bin cigar', '2019-05-20');

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
(1, 1, 285),
(2, 7, 5);

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
(1, 1, 10, 15, '2019-01-01');

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
(1, 1, 10, 13),
(2, 7, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `stock_cincin`
--

CREATE TABLE `stock_cincin` (
  `id` int(11) NOT NULL,
  `produk` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Robusto', 'Robusto', 'BR10', 300, 1),
(2, 'Corona', 'Corona', 'BC10', 15, 7);

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
(16, 'Magic - Boom', 'M-AIGS', 'Plastik', 10, 550000, 400000, '30'),
(17, 'HJ Prima', 'HJ - 001', 'Wooden', 10, 800000, 500000, '33');

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
(14, 'bin cigar', 'Bincigar Jember', 'bincigarjember@gmail.com', 'caf4460ba43a2540f97b773bc5d7c3d6fe6388f9', 'BIN1.png', 'Super Admin'),
(15, 'Ir. H Febrian Ananta Kahar', '', 'febrian.kahar@tarutamanusantara.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Super Admin'),
(16, 'Ir. H Imam Wahid Wahyudi', '', 'imam.ww@bincigar.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Super Admin'),
(17, 'Yayuk bincigar', '', 'ttn.yayoek@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Super Admin'),
(18, 'undik bincigar', '', 'general@bincigar.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Super Admin'),
(19, 'Nella bincigar', '', 'ttn.nelarevoni@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Super Admin'),
(20, 'Fara bincigar', '', 'farabincigar06@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Super Admin'),
(21, 'Lucky factory', '', 'Ifajariyanto@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Bahan Baku'),
(22, 'Lucky factory pro', '', 'luckybin_proses@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Proses Produksi'),
(23, 'Lucky factory QC', '', 'luckybin_qc@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Quality Control'),
(24, 'risma factory', '', 'rismabin_bahan_baku@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Bahan Baku'),
(25, 'risma pro', '', 'rismabin_proses@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Proses Produksi'),
(26, 'risma qc', '', 'rismabin_qc@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'Quality Control'),
(27, 'yuyun bincigar', '', 'yuyunbincigar07@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'STORE'),
(28, 'citra bincigar', '', 'citra.rfs@bincigar.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'RFS'),
(29, 'iman santoso', '', 'Iman.santoso@bincigar.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'PHRI'),
(30, 'Doni bincigar', '', 'donnynugroho64@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'NON PHRI'),
(31, 'Sri Wahyuni', '', 'sriw71322@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'img.png', 'STORE');

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
(1, 'Robusto', 'H8', '500.00', '250.00', '250.00', 9000, 8800, 200, '', '2019-05-04', 'bin cigar'),
(3, 'Corona', 'TC', '50.00', '25.00', '25.00', 800, 700, 100, 'derdse', '2019-05-20', 'bin cigar');

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
(1, 'Robusto', 'H8', 225),
(2, 'Corona', 'TC', 20);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `binding_tmp`
--
ALTER TABLE `binding_tmp`
  MODIFY `id_bind` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cerutu_terjual`
--
ALTER TABLE `cerutu_terjual`
  MODIFY `id_cr_terjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cincin`
--
ALTER TABLE `cincin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cool`
--
ALTER TABLE `cool`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cool_tmp`
--
ALTER TABLE `cool_tmp`
  MODIFY `id_cool` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cukai`
--
ALTER TABLE `cukai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `data_produksi`
--
ALTER TABLE `data_produksi`
  MODIFY `id_pr` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `data_stock`
--
ALTER TABLE `data_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `data_stock_tmp`
--
ALTER TABLE `data_stock_tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `drying`
--
ALTER TABLE `drying`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drying2`
--
ALTER TABLE `drying2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drying2_tmp`
--
ALTER TABLE `drying2_tmp`
  MODIFY `id_dry2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drying3`
--
ALTER TABLE `drying3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `drying3_tmp`
--
ALTER TABLE `drying3_tmp`
  MODIFY `id_dry3` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `drying_tmp`
--
ALTER TABLE `drying_tmp`
  MODIFY `id_dry` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filling`
--
ALTER TABLE `filling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `filling_tmp`
--
ALTER TABLE `filling_tmp`
  MODIFY `id_fill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `frezer`
--
ALTER TABLE `frezer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `frezer_tmp`
--
ALTER TABLE `frezer_tmp`
  MODIFY `id_frez` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fumigasi`
--
ALTER TABLE `fumigasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `fumigasi_tmp`
--
ALTER TABLE `fumigasi_tmp`
  MODIFY `id_fumi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pakai_kemasan`
--
ALTER TABLE `pakai_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan_cerutu`
--
ALTER TABLE `penjualan_cerutu`
  MODIFY `id_penjualan_bagan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id_piutang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pressing`
--
ALTER TABLE `pressing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pressing_tmp`
--
ALTER TABLE `pressing_tmp`
  MODIFY `id_pres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `qc`
--
ALTER TABLE `qc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `qual_con_tmp`
--
ALTER TABLE `qual_con_tmp`
  MODIFY `id_q` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reject`
--
ALTER TABLE `reject`
  MODIFY `id_reject` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_bagan`
--
ALTER TABLE `return_bagan`
  MODIFY `id_return_bagan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_rfs`
--
ALTER TABLE `return_rfs`
  MODIFY `id_rtn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rfs`
--
ALTER TABLE `rfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rfs_stock_keluar`
--
ALTER TABLE `rfs_stock_keluar`
  MODIFY `id_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stiker`
--
ALTER TABLE `stiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_awalrekap`
--
ALTER TABLE `stock_awalrekap`
  MODIFY `id_strekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_bagan`
--
ALTER TABLE `stock_bagan`
  MODIFY `id_stock_bagan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_cincin`
--
ALTER TABLE `stock_cincin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_cukai`
--
ALTER TABLE `stock_cukai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_kemasan`
--
ALTER TABLE `stock_kemasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_stiker`
--
ALTER TABLE `stock_stiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_subproduk`
--
ALTER TABLE `stock_subproduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_produk`
--
ALTER TABLE `sub_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `wrapping`
--
ALTER TABLE `wrapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wrapping_tmp`
--
ALTER TABLE `wrapping_tmp`
  MODIFY `id_wrap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
