-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Nov 2024 pada 01.53
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_barang_atk`
--

CREATE TABLE `inventory_barang_atk` (
  `id_atk` int(11) NOT NULL,
  `kode_kelompok_barang` varchar(100) NOT NULL,
  `id_standart_harga` varchar(50) NOT NULL,
  `kode_barang_dari_pemerintah` varchar(100) NOT NULL,
  `kode_rekening` varchar(100) NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan_barang` varchar(10) NOT NULL,
  `satuan_harga` varchar(10) NOT NULL,
  `ket_barang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_gedung`
--

CREATE TABLE `inventory_gedung` (
  `id_gedung` int(11) NOT NULL,
  `nama_gedung` varchar(20) NOT NULL,
  `ket_gedung` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_gedung`
--

INSERT INTO `inventory_gedung` (`id_gedung`, `nama_gedung`, `ket_gedung`) VALUES
(1, 'YAYASAN', ''),
(2, 'SMP', ''),
(3, 'SMA', ''),
(4, 'SMK', ''),
(5, 'PESANTREN', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_input_aset`
--

CREATE TABLE `inventory_input_aset` (
  `id_input_aset` int(11) NOT NULL,
  `aset_unit_id` int(11) NOT NULL,
  `aset_sub_unit_id` int(11) NOT NULL,
  `lokasi_gedung_id` int(11) NOT NULL,
  `lokasi_ruang_id` int(11) NOT NULL,
  `jenis_aset_id` int(11) NOT NULL,
  `jenis_kelompok_id` int(11) NOT NULL,
  `nama_sarana` varchar(128) NOT NULL,
  `jumlah_aset` varchar(10) NOT NULL,
  `satuan_aset` varchar(10) NOT NULL,
  `status_kepemilikan` varchar(10) NOT NULL,
  `tahun_pengadaan` varchar(10) NOT NULL,
  `harga_perolehan` varchar(20) NOT NULL,
  `total_perolehan` varchar(10) NOT NULL,
  `label_aset` varchar(255) NOT NULL,
  `keterangan_aset` varchar(20) NOT NULL,
  `aset_aktif` int(11) NOT NULL,
  `pic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_input_aset`
--

INSERT INTO `inventory_input_aset` (`id_input_aset`, `aset_unit_id`, `aset_sub_unit_id`, `lokasi_gedung_id`, `lokasi_ruang_id`, `jenis_aset_id`, `jenis_kelompok_id`, `nama_sarana`, `jumlah_aset`, `satuan_aset`, `status_kepemilikan`, `tahun_pengadaan`, `harga_perolehan`, `total_perolehan`, `label_aset`, `keterangan_aset`, `aset_aktif`, `pic_id`) VALUES
(1, 2, 32, 2, 36, 4, 2, 'Loker Guru (Besar)', '1', 'buah', 'milik', '2008', '1000000', '1000000', '1/INV/SMP/2008', '', 0, 61),
(2, 2, 32, 2, 36, 4, 2, 'Loker guru(kecil)', '1', 'buah', 'milik', '2008', '500000', '500000', '1/INV/SMP/2008', '', 0, 61),
(3, 2, 32, 2, 36, 3, 2, 'Meja Catering', '1', 'buah', 'milik', '2008', '500000', '500000', '1/INV/SMP/2008', '', 0, 61),
(4, 2, 32, 2, 36, 4, 2, 'Lemari Arsip', '4', 'buah', 'milik', '2008', '1000000', '4000000', '1/INV/SMP/2008', '', 0, 61),
(5, 2, 32, 2, 36, 4, 2, 'Kotak Obat', '2', 'buah', 'milik', '2008', '150000', '300000', '1/INV/SMP/2008', '', 0, 61),
(6, 2, 32, 2, 36, 3, 2, 'Meja kelas', '21', 'buah', 'milik', '2008', '200000', '4200000', '1/INV/SMP/2008', '', 0, 61),
(7, 2, 32, 2, 36, 2, 2, 'Kursi', '38', 'buah', 'milik', '2008', '200000', '7600000', '1/INV/SMP/2008', '', 0, 61),
(8, 2, 32, 2, 36, 13, 3, 'kipas dinding', '1', 'buah', 'milik', '2008', '250000', '250000', '1/INV/SMP/2008', '', 0, 61),
(9, 2, 32, 2, 36, 13, 3, 'Kipas baling', '1', 'buah', 'milik', '2008', '150000', '150000', '1/INV/SMP/2008', '', 0, 61),
(10, 2, 32, 2, 36, 3, 2, 'Meja Kerja', '1', 'buah', 'milik', '2008', '150000', '150000', '1/INV/SMP/2008', '', 0, 61),
(11, 2, 32, 2, 36, 6, 2, 'Printer', '1', 'buah', 'milik', '2008', '2000000', '2000000', '1/INV/SMP/2008', '', 0, 61),
(12, 2, 32, 2, 36, 5, 2, 'Komputer', '1', 'buah', 'milik', '2008', '2500000', '2500000', '1/INV/SMP/2008', '', 0, 61),
(13, 2, 32, 2, 36, 5, 2, 'Komputer ', '2', 'buah', 'milik', '2008', '2500000', '5000000', '1/INV/SMP/2008', '', 0, 61),
(14, 2, 32, 2, 36, 6, 2, 'Printer', '1', 'buah', 'milik', '2008', '2000000', '2000000', '1/INV/SMP/2008', '', 0, 61),
(15, 2, 32, 2, 36, 12, 2, 'Sound Sistem', '1', 'buah', 'milik', '2008', '1000000', '1000000', '1/INV/SMP/2008', '', 0, 61),
(16, 2, 32, 2, 36, 12, 2, 'Dispenser', '1', 'buah', 'milik', '2008', '350000', '350000', '1/INV/SMP/2008', '', 0, 61),
(17, 2, 32, 2, 36, 4, 2, 'Lemari Raport', '1', 'buah', 'milik', '2008', '1000000', '1000000', '1/INV/SMP/2008', '', 0, 61),
(18, 2, 32, 2, 36, 4, 2, 'Etalase ', '1', 'buah', 'milik', '2008', '1000000', '1000000', '1/INV/SMP/2008', '', 0, 61),
(19, 2, 32, 2, 36, 4, 2, 'Lemari ', '2', 'buah', 'milik', '2008', '1500000', '3000000', '1/INV/SMP/2008', '', 0, 61),
(20, 2, 32, 2, 36, 12, 2, 'Sound', '1', 'buah', 'milik', '2008', '1000000', '1000000', '1/INV/SMP/2008', '', 0, 61),
(21, 2, 32, 2, 36, 3, 2, 'Lemari Bola', '1', 'buah', 'milik', '2008', '1000000', '1000000', '1/INV/SMP/2008', '', 0, 61),
(22, 2, 32, 2, 36, 3, 2, 'Etalase Catering', '1', 'buah', 'milik', '2008', '500000', '500000', '1/INV/SMP/2008', '', 0, 61),
(23, 2, 32, 2, 36, 6, 2, 'Printer ', '1', 'buah', 'milik', '2008', '2000000', '2000000', '1/INV/SMP/2008', '', 0, 61),
(24, 2, 32, 2, 36, 12, 2, 'Alat Cek Suhu Tubuh', '1', 'buah', 'milik', '2008', '1200000', '1200000', '1/INV/SMP/2008', '', 0, 61),
(25, 2, 32, 2, 36, 13, 3, 'Kipas baling', '2', 'buah', 'milik', '2008', '200000', '400000', '1/INV/SMP/2008', '', 0, 61),
(26, 2, 32, 2, 36, 13, 3, 'Kipas dinding', '1', 'buah', 'milik', '2008', '250000', '250000', '1/INV/SMP/2008', '', 0, 61),
(27, 2, 34, 2, 42, 0, 0, 'Meja Kerja', '7', 'buah', 'milik', '2012', '500000', '3500000', '27/INV/SMP/2012', '', 0, 61),
(28, 2, 34, 2, 42, 0, 0, 'Lemari Arsip', '7', 'buah', 'milik', '2012', '2000000', '14000000', '27/INV/SMP/2012', '', 0, 61),
(29, 2, 34, 2, 42, 9, 2, 'Dispenser', '1', 'buah', 'milik', '2012', '350000', '350000', '27/INV/SMP/2012', '', 0, 61),
(30, 2, 34, 2, 42, 0, 0, 'Kipas Baling ', '2', 'buah', 'milik', '2012', '200000', '400000', '27/INV/SMP/2012', '', 0, 61),
(31, 2, 34, 2, 42, 6, 2, 'Printer', '1', 'buah', 'milik', '2012', '2500000', '2500000', '27/INV/SMP/2012', '', 0, 61),
(32, 2, 34, 2, 42, 6, 2, 'Printer', '1', 'buah', 'milik', '2012', '2500000', '2500000', '27/INV/SMP/2012', '', 0, 61),
(33, 2, 34, 2, 42, 0, 0, 'Komputer', '1', 'buah', 'milik', '2012', '2500000', '2500000', '27/INV/SMP/2012', '', 0, 61),
(34, 2, 34, 2, 42, 0, 0, 'Komputer', '1', 'buah', 'milik', '2012', '2500000', '2500000', '27/INV/SMP/2012', '', 0, 61),
(35, 2, 34, 2, 42, 0, 0, 'Kursi kerja', '6', 'buah', 'milik', '2012', '100000', '600000', '27/INV/SMP/2012', '', 0, 61),
(36, 2, 34, 2, 42, 0, 0, 'Loker kecil', '1', 'buah', 'milik', '2012', '500000', '500000', '27/INV/SMP/2012', '', 0, 61),
(37, 2, 34, 2, 42, 0, 0, 'Lemari ', '1', 'buah', 'milik', '2012', '300000', '300000', '27/INV/SMP/2012', '', 0, 61),
(38, 2, 34, 2, 42, 4, 2, 'Lemari', '1', 'buah', 'milik', '2012', '300000', '300000', '27/INV/SMP/2012', '', 0, 61),
(39, 6, 12, 1, 24, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2018', '2500000', '2500000', '1/INV/KEUANGAN/2018', '', 0, 3),
(40, 6, 12, 1, 24, 12, 2, 'Mesin penghitung uang', '1', 'buah', 'YAYASAN', '2014', '2500000', '2500000', '1/INV/KEUANGAN/2014', '', 0, 3),
(41, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '5', 'buah', 'YAYASAN', '2022', '750000', '3750000', '1/INV/KEUANGAN/2022', '', 0, 3),
(42, 6, 12, 1, 24, 5, 2, 'Komputer', '3', 'buah', 'HIBAH', '2021', '3500000', '10500000', '1/INV/KEUANGAN/2021', '', 0, 3),
(43, 6, 12, 1, 24, 4, 2, 'Set Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '7000000', '7000000', '1/INV/KEUANGAN/2022', '', 0, 3),
(44, 6, 12, 1, 24, 4, 2, 'Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '3750000', '3750000', '1/INV/KEUANGAN/2022', '', 0, 3),
(45, 6, 12, 1, 24, 4, 2, 'Loker ', '1', 'buah', 'YAYASAN', '2012', '2500000', '2500000', '1/INV/KEUANGAN/2012', '', 0, 3),
(46, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2022', '750000', '750000', '1/INV/KEUANGAN/2022', '', 0, 3),
(47, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '4', 'buah', 'YAYASAN', '2022', '750000', '3000000', '1/INV/KEUANGAN/2022', '', 0, 3),
(48, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2019', '3500000', '3500000', '1/INV/KEUANGAN/2019', '', 0, 3),
(49, 6, 12, 1, 24, 12, 2, 'Printer Cashless', '1', 'buah', 'YAYASAN', '2019', '2500000', '2500000', '1/INV/KEUANGAN/2019', '', 0, 3),
(50, 6, 12, 1, 24, 12, 2, 'Sidik Jari cashless', '1', 'buah', 'DANA BOS', '2019', '3000000', '3000000', '1/INV/KEUANGAN/2019', '', 0, 3),
(51, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2023', '3500000', '3500000', '1/INV/KEUANGAN/2023', '', 0, 3),
(52, 6, 12, 1, 24, 13, 3, 'Dispenser', '1', 'buah', 'YAYASAN', '2014', '500000', '500000', '1/INV/KEUANGAN/2014', '', 0, 3),
(53, 6, 12, 1, 24, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2014', '4000000', '4000000', '1/INV/KEUANGAN/2014', '', 0, 3),
(54, 6, 12, 1, 24, 4, 2, 'pigura Lukisan  keluarga Kyai Hamid', '1', 'buah', 'YAYASAN', '2014', '1500000', '1500000', '1/INV/KEUANGAN/2014', '', 0, 3),
(55, 6, 12, 1, 24, 4, 2, 'tangga', '1', 'buah', 'YAYASAN', '2022', '900000', '900000', '1/INV/KEUANGAN/2022', '', 0, 3),
(56, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'YAYASAN', '2021', '300000', '300000', '1/INV/KEUANGAN/2021', '', 0, 3),
(57, 6, 12, 1, 24, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2018', '2500000', '2500000', '19/INV/KEUANGAN/2018', '', 0, 3),
(58, 6, 12, 1, 24, 12, 2, 'Mesin penghitung uang', '1', 'buah', 'YAYASAN', '2014', '2500000', '2500000', '19/INV/KEUANGAN/2014', '', 0, 3),
(59, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '5', 'buah', 'YAYASAN', '2022', '750000', '3750000', '19/INV/KEUANGAN/2022', '', 0, 3),
(60, 6, 12, 1, 24, 5, 2, 'Komputer', '3', 'buah', 'HIBAH', '2021', '3500000', '10500000', '19/INV/KEUANGAN/2021', '', 0, 3),
(61, 6, 12, 1, 24, 4, 2, 'Set Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '7000000', '7000000', '19/INV/KEUANGAN/2022', '', 0, 3),
(62, 6, 12, 1, 24, 4, 2, 'Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '3750000', '3750000', '19/INV/KEUANGAN/2022', '', 0, 3),
(63, 6, 12, 1, 24, 4, 2, 'Loker ', '1', 'buah', 'YAYASAN', '2012', '2500000', '2500000', '19/INV/KEUANGAN/2012', '', 0, 3),
(64, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2022', '750000', '750000', '19/INV/KEUANGAN/2022', '', 0, 3),
(65, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '4', 'buah', 'YAYASAN', '2022', '750000', '3000000', '19/INV/KEUANGAN/2022', '', 0, 3),
(66, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2019', '3500000', '3500000', '19/INV/KEUANGAN/2019', '', 0, 3),
(67, 6, 12, 1, 24, 12, 2, 'Printer Cashless', '1', 'buah', 'YAYASAN', '2019', '2500000', '2500000', '19/INV/KEUANGAN/2019', '', 0, 3),
(68, 6, 12, 1, 24, 12, 2, 'Sidik Jari cashless', '1', 'buah', 'DANA BOS', '2019', '3000000', '3000000', '19/INV/KEUANGAN/2019', '', 0, 3),
(69, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2023', '3500000', '3500000', '19/INV/KEUANGAN/2023', '', 0, 3),
(70, 6, 12, 1, 24, 13, 3, 'Dispenser', '1', 'buah', 'YAYASAN', '2014', '500000', '500000', '19/INV/KEUANGAN/2014', '', 0, 3),
(71, 6, 12, 1, 24, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2014', '4000000', '4000000', '19/INV/KEUANGAN/2014', '', 0, 3),
(72, 6, 12, 1, 24, 4, 2, 'pigura Lukisan  keluarga Kyai Hamid', '1', 'buah', 'YAYASAN', '2014', '1500000', '1500000', '19/INV/KEUANGAN/2014', '', 0, 3),
(73, 6, 12, 1, 24, 4, 2, 'tangga', '1', 'buah', 'YAYASAN', '2022', '900000', '900000', '19/INV/KEUANGAN/2022', '', 0, 3),
(74, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'YAYASAN', '2021', '300000', '300000', '19/INV/KEUANGAN/2021', '', 0, 3),
(75, 6, 12, 1, 24, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2018', '2500000', '2500000', '37/INV/KEUANGAN/2018', '', 0, 3),
(76, 6, 12, 1, 24, 12, 2, 'Mesin penghitung uang', '1', 'buah', 'YAYASAN', '2014', '2500000', '2500000', '37/INV/KEUANGAN/2014', '', 0, 3),
(77, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '5', 'buah', 'YAYASAN', '2022', '750000', '3750000', '37/INV/KEUANGAN/2022', '', 0, 3),
(78, 6, 12, 1, 24, 5, 2, 'Komputer', '3', 'buah', 'HIBAH', '2021', '3500000', '10500000', '37/INV/KEUANGAN/2021', '', 0, 3),
(79, 6, 12, 1, 24, 4, 2, 'Set Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '7000000', '7000000', '37/INV/KEUANGAN/2022', '', 0, 3),
(80, 6, 12, 1, 24, 4, 2, 'Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '3750000', '3750000', '37/INV/KEUANGAN/2022', '', 0, 3),
(81, 6, 12, 1, 24, 4, 2, 'Loker ', '1', 'buah', 'YAYASAN', '2012', '2500000', '2500000', '37/INV/KEUANGAN/2012', '', 0, 3),
(82, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2022', '750000', '750000', '37/INV/KEUANGAN/2022', '', 0, 3),
(83, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '4', 'buah', 'YAYASAN', '2022', '750000', '3000000', '37/INV/KEUANGAN/2022', '', 0, 3),
(84, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2019', '3500000', '3500000', '37/INV/KEUANGAN/2019', '', 0, 3),
(85, 6, 12, 1, 24, 12, 2, 'Printer Cashless', '1', 'buah', 'YAYASAN', '2019', '2500000', '2500000', '37/INV/KEUANGAN/2019', '', 0, 3),
(86, 6, 12, 1, 24, 12, 2, 'Sidik Jari cashless', '1', 'buah', 'DANA BOS', '2019', '3000000', '3000000', '37/INV/KEUANGAN/2019', '', 0, 3),
(87, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2023', '3500000', '3500000', '37/INV/KEUANGAN/2023', '', 0, 3),
(88, 6, 12, 1, 24, 13, 3, 'Dispenser', '1', 'buah', 'YAYASAN', '2014', '500000', '500000', '37/INV/KEUANGAN/2014', '', 0, 3),
(89, 6, 12, 1, 24, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2014', '4000000', '4000000', '37/INV/KEUANGAN/2014', '', 0, 3),
(90, 6, 12, 1, 24, 4, 2, 'pigura Lukisan  keluarga Kyai Hamid', '1', 'buah', 'YAYASAN', '2014', '1500000', '1500000', '37/INV/KEUANGAN/2014', '', 0, 3),
(91, 6, 12, 1, 24, 4, 2, 'tangga', '1', 'buah', 'YAYASAN', '2022', '900000', '900000', '37/INV/KEUANGAN/2022', '', 0, 3),
(92, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'YAYASAN', '2021', '300000', '300000', '37/INV/KEUANGAN/2021', '', 0, 3),
(93, 6, 12, 1, 24, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2018', '2500000', '2500000', '55/INV/KEUANGAN/2018', '', 0, 3),
(94, 6, 12, 1, 24, 12, 2, 'Mesin penghitung uang', '1', 'buah', 'YAYASAN', '2014', '2500000', '2500000', '55/INV/KEUANGAN/2014', '', 0, 3),
(95, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '5', 'buah', 'YAYASAN', '2022', '750000', '3750000', '55/INV/KEUANGAN/2022', '', 0, 3),
(96, 6, 12, 1, 24, 5, 2, 'Komputer', '3', 'buah', 'HIBAH', '2021', '3500000', '10500000', '55/INV/KEUANGAN/2021', '', 0, 3),
(97, 6, 12, 1, 24, 4, 2, 'Set Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '7000000', '7000000', '55/INV/KEUANGAN/2022', '', 0, 3),
(98, 6, 12, 1, 24, 4, 2, 'Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '3750000', '3750000', '55/INV/KEUANGAN/2022', '', 0, 3),
(99, 6, 12, 1, 24, 4, 2, 'Loker ', '1', 'buah', 'YAYASAN', '2012', '2500000', '2500000', '55/INV/KEUANGAN/2012', '', 0, 3),
(100, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2022', '750000', '750000', '55/INV/KEUANGAN/2022', '', 0, 3),
(101, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '4', 'buah', 'YAYASAN', '2022', '750000', '3000000', '55/INV/KEUANGAN/2022', '', 0, 3),
(102, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2019', '3500000', '3500000', '55/INV/KEUANGAN/2019', '', 0, 3),
(103, 6, 12, 1, 24, 12, 2, 'Printer Cashless', '1', 'buah', 'YAYASAN', '2019', '2500000', '2500000', '55/INV/KEUANGAN/2019', '', 0, 3),
(104, 6, 12, 1, 24, 12, 2, 'Sidik Jari cashless', '1', 'buah', 'DANA BOS', '2019', '3000000', '3000000', '55/INV/KEUANGAN/2019', '', 0, 3),
(105, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2023', '3500000', '3500000', '55/INV/KEUANGAN/2023', '', 0, 3),
(106, 6, 12, 1, 24, 13, 3, 'Dispenser', '1', 'buah', 'YAYASAN', '2014', '500000', '500000', '55/INV/KEUANGAN/2014', '', 0, 3),
(107, 6, 12, 1, 24, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2014', '4000000', '4000000', '55/INV/KEUANGAN/2014', '', 0, 3),
(108, 6, 12, 1, 24, 4, 2, 'pigura Lukisan  keluarga Kyai Hamid', '1', 'buah', 'YAYASAN', '2014', '1500000', '1500000', '55/INV/KEUANGAN/2014', '', 0, 3),
(109, 6, 12, 1, 24, 4, 2, 'tangga', '1', 'buah', 'YAYASAN', '2022', '900000', '900000', '55/INV/KEUANGAN/2022', '', 0, 3),
(110, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'YAYASAN', '2021', '300000', '300000', '55/INV/KEUANGAN/2021', '', 0, 3),
(111, 6, 12, 1, 24, 14, 3, 'Brankas', '1', 'buah', 'YAYASAN', '2020', '4000000', '4000000', '73/INV/KEUANGAN/2020', '', 0, 3),
(112, 6, 12, 1, 24, 2, 2, 'Set Kursi Tamu', '1', 'buah', 'YAYASAN', '2012', '4000000', '4000000', '73/INV/KEUANGAN/2012', '', 0, 3),
(113, 6, 12, 1, 24, 3, 2, 'Meja Tamu', '1', 'buah', 'YAYASAN', '2012', '15000000', '15000000', '73/INV/KEUANGAN/2012', '', 0, 3),
(114, 6, 12, 1, 24, 2, 2, 'Kursi hadap ', '2', 'buah', 'YAYASAN', '2022', '200000', '400000', '73/INV/KEUANGAN/2022', '', 0, 3),
(115, 6, 12, 1, 24, 4, 2, 'Lemari arsip', '1', 'buah', 'YAYASAN', '2012', '1000000', '1000000', '73/INV/KEUANGAN/2012', '', 0, 3),
(116, 6, 12, 1, 24, 12, 2, 'Lemari Es', '1', 'buah', 'HIBAH', '2022', '4000000', '4000000', '73/INV/KEUANGAN/2022', '', 0, 3),
(117, 6, 12, 1, 24, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2019', '4000000', '4000000', '73/INV/KEUANGAN/2019', '', 0, 3),
(118, 6, 12, 1, 24, 3, 2, 'Meja Kerja Pimpinan', '1', 'buah', 'YAYASAN', '2012', '1500000', '1500000', '73/INV/KEUANGAN/2012', '', 0, 3),
(119, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2012', '1000000', '1000000', '73/INV/KEUANGAN/2012', '', 0, 3),
(120, 6, 12, 1, 24, 12, 2, 'TV', '1', 'buah', 'YAYASAN', '2020', '4500000', '4500000', '73/INV/KEUANGAN/2020', '', 0, 3),
(121, 6, 12, 1, 24, 12, 2, 'Coffe Maker Uncaffe', '1', 'buah', 'YAYASAN', '2020', '1000000', '1000000', '73/INV/KEUANGAN/2020', '', 0, 3),
(122, 6, 12, 1, 24, 14, 3, 'Loker Gelas ', '1', 'buah', 'YAYASAN', '2020', '150000', '150000', '73/INV/KEUANGAN/2020', '', 0, 3),
(123, 6, 12, 1, 24, 11, 2, 'Jam Dinding', '1', 'buah', 'HIBAH', '2014', '100000', '100000', '73/INV/KEUANGAN/2014', '', 0, 3),
(124, 6, 12, 1, 24, 3, 2, 'Meja Komputer', '1', 'buah', 'YAYASAN', '2012', '150000', '150000', '73/INV/KEUANGAN/2012', '', 0, 3),
(125, 6, 12, 1, 24, 11, 2, 'Pigura Lambang Negara', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '73/INV/KEUANGAN/2019', '', 0, 3),
(126, 6, 12, 1, 24, 11, 2, 'Pigura Lambang NU', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '73/INV/KEUANGAN/2019', '', 0, 3),
(127, 6, 12, 1, 24, 11, 2, 'Pigura Lukisan Kyai Hamid', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '73/INV/KEUANGAN/2019', '', 0, 3),
(128, 6, 12, 1, 24, 11, 2, 'Pigura Lukisan Kyai Idris', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '73/INV/KEUANGAN/2019', '', 0, 3),
(129, 6, 12, 1, 24, 14, 3, 'Brankas', '1', 'buah', 'YAYASAN', '2020', '4000000', '4000000', '91/INV/KEUANGAN/2020', '', 0, 3),
(130, 6, 12, 1, 24, 2, 2, 'Set Kursi Tamu', '1', 'buah', 'YAYASAN', '2012', '4000000', '4000000', '91/INV/KEUANGAN/2012', '', 0, 3),
(131, 6, 12, 1, 24, 3, 2, 'Meja Tamu', '1', 'buah', 'YAYASAN', '2012', '15000000', '15000000', '91/INV/KEUANGAN/2012', '', 0, 3),
(132, 6, 12, 1, 24, 2, 2, 'Kursi hadap ', '2', 'buah', 'YAYASAN', '2022', '200000', '400000', '91/INV/KEUANGAN/2022', '', 0, 3),
(133, 6, 12, 1, 24, 4, 2, 'Lemari arsip', '1', 'buah', 'YAYASAN', '2012', '1000000', '1000000', '91/INV/KEUANGAN/2012', '', 0, 3),
(134, 6, 12, 1, 24, 12, 2, 'Lemari Es', '1', 'buah', 'HIBAH', '2022', '4000000', '4000000', '91/INV/KEUANGAN/2022', '', 0, 3),
(135, 6, 12, 1, 24, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2019', '4000000', '4000000', '91/INV/KEUANGAN/2019', '', 0, 3),
(136, 6, 12, 1, 24, 3, 2, 'Meja Kerja Pimpinan', '1', 'buah', 'YAYASAN', '2012', '1500000', '1500000', '91/INV/KEUANGAN/2012', '', 0, 3),
(137, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2012', '1000000', '1000000', '91/INV/KEUANGAN/2012', '', 0, 3),
(138, 6, 12, 1, 24, 12, 2, 'TV', '1', 'buah', 'YAYASAN', '2020', '4500000', '4500000', '91/INV/KEUANGAN/2020', '', 0, 3),
(139, 6, 12, 1, 24, 12, 2, 'Coffe Maker Uncaffe', '1', 'buah', 'YAYASAN', '2020', '1000000', '1000000', '91/INV/KEUANGAN/2020', '', 0, 3),
(140, 6, 12, 1, 24, 14, 3, 'Loker Gelas ', '1', 'buah', 'YAYASAN', '2020', '150000', '150000', '91/INV/KEUANGAN/2020', '', 0, 3),
(141, 6, 12, 1, 24, 11, 2, 'Jam Dinding', '1', 'buah', 'HIBAH', '2014', '100000', '100000', '91/INV/KEUANGAN/2014', '', 0, 3),
(142, 6, 12, 1, 24, 3, 2, 'Meja Komputer', '1', 'buah', 'YAYASAN', '2012', '150000', '150000', '91/INV/KEUANGAN/2012', '', 0, 3),
(143, 6, 12, 1, 24, 11, 2, 'Pigura Lambang Negara', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '91/INV/KEUANGAN/2019', '', 0, 3),
(144, 6, 12, 1, 24, 11, 2, 'Pigura Lambang NU', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '91/INV/KEUANGAN/2019', '', 0, 3),
(145, 6, 12, 1, 24, 11, 2, 'Pigura Lukisan Kyai Hamid', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '91/INV/KEUANGAN/2019', '', 0, 3),
(146, 6, 12, 1, 24, 11, 2, 'Pigura Lukisan Kyai Idris', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '91/INV/KEUANGAN/2019', '', 0, 3),
(147, 2, 32, 2, 36, 2, 2, 'Set Kursi Tamu', '1', 'buah', 'YAYASAN', '2012', '3500000', '3500000', '39/INV/SMP/2012', '', 0, 61),
(148, 2, 32, 2, 36, 3, 2, 'Meja Tamu', '1', 'buah', 'YAYASAN', '2012', '1000000', '1000000', '39/INV/SMP/2012', '', 0, 61),
(149, 2, 32, 2, 36, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2012', '4000000', '4000000', '39/INV/SMP/2012', '', 0, 61),
(150, 2, 32, 2, 36, 4, 2, 'Lemari Arsip', '1', 'buah', 'YAYASAN', '2012', '2500000', '2500000', '39/INV/SMP/2012', '', 0, 61),
(151, 2, 32, 2, 36, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2012', '2500000', '2500000', '39/INV/SMP/2012', '', 0, 61),
(152, 2, 32, 2, 36, 4, 2, 'Lemari Piala', '1', 'buah', 'YAYASAN', '2012', '1500000', '1500000', '39/INV/SMP/2012', '', 0, 61),
(153, 2, 32, 2, 36, 12, 2, 'Proyektor', '1', 'buah', 'YAYASAN', '2012', '2500000', '2500000', '39/INV/SMP/2012', '', 0, 61),
(154, 2, 32, 2, 36, 14, 3, 'Brankas', '1', 'buah', 'YAYASAN', '2012', '5000000', '5000000', '39/INV/SMP/2012', '', 0, 61),
(155, 2, 32, 2, 36, 9, 2, 'Dispenser', '1', 'buah', 'YAYASAN', '2012', '750000', '750000', '39/INV/SMP/2012', '', 0, 61),
(156, 2, 32, 2, 36, 5, 2, 'Komputer', '1', 'buah', 'YAYASAN', '2012', '3500000', '3500000', '39/INV/SMP/2012', '', 0, 61),
(157, 4, 37, 3, 37, 5, 2, 'Komputer ', '1', 'buah', 'YAYASAN', '2019', '4000000', '4000000', '1/INV/SMA/2019', '', 0, 85),
(158, 4, 37, 3, 37, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2019', '3500000', '3500000', '1/INV/SMA/2019', '', 0, 85),
(159, 4, 37, 3, 37, 3, 2, 'Brankas', '1', 'buah', 'YAYASAN', '2019', '5000000', '5000000', '1/INV/SMA/2019', '', 0, 85),
(160, 4, 37, 3, 37, 3, 2, 'Meja Kerja', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '1/INV/SMA/2019', '', 0, 85),
(161, 4, 37, 3, 37, 2, 2, ' Kursi Tamu', '2', 'buah', 'YAYASAN', '2019', '250000', '500000', '1/INV/SMA/2019', '', 0, 85),
(162, 4, 37, 3, 37, 2, 2, 'Kursi Kerja ', '1', 'buah', 'YAYASAN', '2019', '500000', '500000', '1/INV/SMA/2019', '', 0, 85),
(163, 4, 37, 3, 37, 14, 3, 'Loker Berkas', '2', 'buah', 'YAYASAN', '2019', '250000', '500000', '1/INV/SMA/2019', '', 0, 85),
(164, 4, 37, 3, 37, 14, 3, 'Loker Berkas', '1', 'buah', 'YAYASAN', '2019', '250000', '250000', '1/INV/SMA/2019', '', 0, 85),
(165, 4, 37, 3, 37, 12, 2, 'Dispenser', '1', 'buah', 'YAYASAN', '2019', '350000', '350000', '1/INV/SMA/2019', '', 0, 85),
(166, 4, 37, 3, 37, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2019', '2250000', '2250000', '1/INV/SMA/2019', '', 0, 85),
(167, 4, 37, 3, 37, 4, 2, 'Loker File', '1', 'buah', 'YAYASAN', '2019', '1250000', '1250000', '1/INV/SMA/2019', '', 0, 85),
(168, 4, 37, 3, 37, 13, 3, 'AC ', '1', 'buah', 'YAYASAN', '2019', '3000000', '3000000', '1/INV/SMA/2019', '', 0, 85),
(169, 4, 36, 3, 43, 12, 2, 'Sound ', '1', 'buah', 'YAYASAN', '2019', '1500000', '1500000', '1/INV/SMA/2019', '', 0, 60),
(170, 4, 36, 3, 43, 4, 2, 'Rak Buku +Piala', '1', 'buah', 'YAYASAN', '2019', '2500000', '2500000', '1/INV/SMA/2019', '', 0, 60),
(171, 4, 36, 3, 43, 3, 2, 'Set Kursi Tamu', '1', 'buah', 'YAYASAN', '2019', '3500000', '3500000', '1/INV/SMA/2019', '', 0, 60),
(172, 4, 36, 3, 43, 3, 2, 'Meja Tamu', '1', 'buah', 'YAYASAN', '2019', '1000000', '1000000', '1/INV/SMA/2019', '', 0, 60),
(173, 3, 39, 4, 38, 2, 2, 'Set Kursi Tamu', '1', 'Buah', 'Yayasan', '2019', '4000000', '4000000', '1/INV/SMK/2019', '', 0, 84),
(174, 3, 39, 4, 38, 3, 2, 'Meja Tamu', '1', 'Buah', 'Yayasan', '2019', '1000000', '1000000', '1/INV/SMK/2019', '', 0, 84),
(175, 3, 39, 4, 38, 4, 2, 'Lemari Piala', '1', 'Buah', 'Yayasan', '2019', '1750000', '1750000', '1/INV/SMK/2019', '', 0, 84),
(176, 3, 39, 4, 38, 4, 2, 'Lemari Arsip', '1', 'Buah', 'Yayasan', '2019', '1750000', '1750000', '1/INV/SMK/2019', '', 0, 84),
(177, 3, 39, 4, 38, 3, 2, 'Meja Kerja', '1', 'Buah', 'Yayasan', '2019', '1000000', '1000000', '1/INV/SMK/2019', '', 0, 84),
(178, 3, 39, 4, 38, 2, 2, 'Kursi Kerja', '1', 'Buah', 'Yayasan', '2019', '750000', '750000', '1/INV/SMK/2019', '', 0, 84),
(179, 3, 39, 4, 38, 2, 2, 'Kursi Tamu', '1', 'Buah', 'Yayasan', '2019', '2750000', '2750000', '1/INV/SMK/2019', '', 0, 84),
(180, 3, 39, 4, 38, 12, 2, 'Dispenser', '1', 'Buah', 'Yayasan', '2019', '750000', '750000', '1/INV/SMK/2019', '', 0, 84),
(181, 3, 39, 4, 38, 4, 2, 'Lemari Arsip ', '1', 'Buah', 'Yayasan', '2019', '1750000', '1750000', '1/INV/SMK/2019', '', 0, 84),
(182, 3, 39, 4, 38, 5, 2, 'Komputer', '1', 'Buah', 'Yayasan', '2019', '4500000', '4500000', '1/INV/SMK/2019', '', 0, 84),
(183, 3, 39, 4, 38, 11, 2, 'Rak Bunga', '1', 'Buah', 'Yayasan', '2019', '200000', '200000', '1/INV/SMK/2019', '', 0, 84),
(184, 3, 39, 4, 38, 11, 2, 'Rak Majalah', '1', 'Buah', 'Yayasan', '2019', '2000000', '2000000', '1/INV/SMK/2019', '', 0, 84),
(185, 3, 39, 4, 38, 11, 2, 'Rak Dinding', '1', 'Buah', 'Yayasan', '2019', '1500000', '1500000', '1/INV/SMK/2019', '', 0, 84),
(186, 6, 12, 1, 24, 0, 0, 'Printer', '1', 'buah', 'YAYASAN', '2018', '3750000', '3750000', '109/INV/KEUANGAN/2018', '', 0, 3),
(187, 6, 12, 1, 24, 0, 0, 'Mesin penghitung uang', '1', 'buah', 'YAYASAN', '2014', '2500000', '2500000', '109/INV/KEUANGAN/2014', '', 0, 3),
(188, 6, 12, 1, 24, 0, 0, 'Meja Kerja', '5', 'buah', 'YAYASAN', '2022', '750000', '3750000', '109/INV/KEUANGAN/2022', '', 0, 3),
(189, 6, 12, 1, 24, 0, 0, 'Komputer', '3', 'buah', 'HIBAH', '2021', '3500000', '10500000', '109/INV/KEUANGAN/2021', '', 0, 3),
(190, 6, 12, 1, 24, 0, 0, 'Set Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '7500000', '7500000', '109/INV/KEUANGAN/2022', '', 0, 3),
(191, 6, 12, 1, 24, 0, 0, 'Lemari Arsip', '1', 'buah', 'YAYASAN', '2021', '1500000', '1500000', '109/INV/KEUANGAN/2021', '', 0, 3),
(192, 6, 12, 1, 24, 0, 0, 'Loker ', '1', 'buah', 'YAYASAN', '2012', '1000000', '1000000', '109/INV/KEUANGAN/2012', '', 0, 3),
(193, 6, 12, 1, 24, 0, 0, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2022', '1000000', '1000000', '109/INV/KEUANGAN/2022', '', 0, 3),
(194, 6, 12, 1, 24, 0, 0, 'Kursi Kerja', '4', 'buah', 'YAYASAN', '2022', '750000', '3000000', '109/INV/KEUANGAN/2022', '', 0, 3),
(195, 6, 12, 1, 24, 0, 0, 'Komputer', '1', 'buah', 'DANA BOS', '2019', '3500000', '3500000', '109/INV/KEUANGAN/2019', '', 0, 3),
(196, 6, 12, 1, 24, 0, 0, 'Printer Cashless', '1', 'buah', 'YAYASAN', '2019', '3750000', '3750000', '109/INV/KEUANGAN/2019', '', 0, 3),
(197, 6, 12, 1, 24, 0, 0, 'Sidik Jari cashless', '1', 'buah', 'DANA BOS', '2019', '2500000', '2500000', '109/INV/KEUANGAN/2019', '', 0, 3),
(198, 6, 12, 1, 24, 0, 0, 'Komputer', '1', 'buah', 'DANA BOS', '2023', '3000000', '3000000', '109/INV/KEUANGAN/2023', '', 0, 3),
(199, 6, 12, 1, 24, 0, 0, 'Dispenser', '1', 'buah', 'YAYASAN', '2014', '750000', '750000', '109/INV/KEUANGAN/2014', '', 0, 3),
(200, 6, 12, 1, 24, 0, 0, 'AC', '1', 'buah', 'YAYASAN', '2014', '2750000', '2750000', '109/INV/KEUANGAN/2014', '', 0, 3),
(201, 6, 12, 1, 24, 0, 0, 'pigura Lukisan  keluarga Kyai Hamid', '1', 'buah', 'YAYASAN', '2014', '500000', '500000', '109/INV/KEUANGAN/2014', '', 0, 3),
(202, 6, 12, 1, 24, 0, 0, 'tangga', '1', 'buah', 'YAYASAN', '2022', '750000', '750000', '109/INV/KEUANGAN/2022', '', 0, 3),
(203, 6, 12, 1, 24, 0, 0, 'Komputer', '1', 'buah', 'YAYASAN', '2019', '3500000', '3500000', '109/INV/KEUANGAN/2019', '', 0, 3),
(204, 6, 12, 1, 24, 6, 2, 'Printer', '1', 'buah', 'YAYASAN', '2018', '3750000', '3750000', '127/INV/KEUANGAN/2018', '', 0, 3),
(205, 6, 12, 1, 24, 12, 2, 'Mesin penghitung uang', '1', 'buah', 'YAYASAN', '2014', '2500000', '2500000', '127/INV/KEUANGAN/2014', '', 0, 3),
(206, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '5', 'buah', 'YAYASAN', '2022', '750000', '3750000', '127/INV/KEUANGAN/2022', '', 0, 3),
(207, 6, 12, 1, 24, 5, 2, 'Komputer', '3', 'buah', 'HIBAH', '2021', '3500000', '10500000', '127/INV/KEUANGAN/2021', '', 0, 3),
(208, 6, 12, 1, 24, 4, 2, 'Set Lemari Arsip', '1', 'buah', 'YAYASAN', '2022', '7500000', '7500000', '127/INV/KEUANGAN/2022', '', 0, 3),
(209, 6, 12, 1, 24, 4, 2, 'Lemari Arsip', '1', 'buah', 'YAYASAN', '2021', '1500000', '1500000', '127/INV/KEUANGAN/2021', '', 0, 3),
(210, 6, 12, 1, 24, 4, 2, 'Loker ', '1', 'buah', 'YAYASAN', '2012', '1000000', '1000000', '127/INV/KEUANGAN/2012', '', 0, 3),
(211, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '1', 'buah', 'YAYASAN', '2022', '1000000', '1000000', '127/INV/KEUANGAN/2022', '', 0, 3),
(212, 6, 12, 1, 24, 2, 2, 'Kursi Kerja', '4', 'buah', 'YAYASAN', '2022', '750000', '3000000', '127/INV/KEUANGAN/2022', '', 0, 3),
(213, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2019', '3500000', '3500000', '127/INV/KEUANGAN/2019', '', 0, 3),
(214, 6, 12, 1, 24, 12, 2, 'Printer Cashless', '1', 'buah', 'YAYASAN', '2019', '3750000', '3750000', '127/INV/KEUANGAN/2019', '', 0, 3),
(215, 6, 12, 1, 24, 12, 2, 'Sidik Jari cashless', '1', 'buah', 'DANA BOS', '2019', '2500000', '2500000', '127/INV/KEUANGAN/2019', '', 0, 3),
(216, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'DANA BOS', '2023', '3000000', '3000000', '127/INV/KEUANGAN/2023', '', 0, 3),
(217, 6, 12, 1, 24, 9, 2, 'Dispenser', '1', 'buah', 'YAYASAN', '2014', '750000', '750000', '127/INV/KEUANGAN/2014', '', 0, 3),
(218, 6, 12, 1, 24, 13, 3, 'AC', '1', 'buah', 'YAYASAN', '2014', '2750000', '2750000', '127/INV/KEUANGAN/2014', '', 0, 3),
(219, 6, 12, 1, 24, 11, 2, 'pigura Lukisan  keluarga Kyai Hamid', '1', 'buah', 'YAYASAN', '2014', '500000', '500000', '127/INV/KEUANGAN/2014', '', 0, 3),
(220, 6, 12, 1, 24, 11, 2, 'tangga', '1', 'buah', 'YAYASAN', '2022', '750000', '750000', '127/INV/KEUANGAN/2022', '', 0, 3),
(221, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'buah', 'YAYASAN', '2019', '3500000', '3500000', '127/INV/KEUANGAN/2019', '', 0, 3),
(222, 6, 12, 1, 24, 2, 2, 'Kursi Kantor', '1', 'Buah', 'Yayasan', '2022', '1000000', '1000000', '145/INV/KEUANGAN/2022', '', 0, 3),
(223, 6, 12, 1, 24, 4, 2, 'Loker ', '1', 'Buah', 'Yayasan', '2012', '2500000', '2500000', '145/INV/KEUANGAN/2012', '', 0, 3),
(224, 6, 12, 1, 24, 13, 3, 'Lemari Es', '1', 'Buah', 'Hibah', '2022', '4000000', '4000000', '145/INV/KEUANGAN/2022', '', 0, 3),
(225, 6, 12, 1, 24, 6, 2, 'Printer', '1', 'Buah', 'Yayasan', '2018', '3500000', '3500000', '145/INV/KEUANGAN/2018', '', 0, 3),
(226, 6, 12, 1, 24, 12, 2, 'Mesin Fax', '1', 'Buah', 'Yayasan', '2009', '1750000', '1750000', '145/INV/KEUANGAN/2009', '', 0, 3),
(227, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '1', 'Buah', 'Yayasan', '2018', '200000', '200000', '145/INV/KEUANGAN/2018', '', 0, 3),
(228, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '1', 'Buah', 'Yayasan', '2018', '200000', '200000', '145/INV/KEUANGAN/2018', '', 0, 3),
(229, 6, 12, 1, 24, 4, 2, 'Lemari Arsip', '1', 'Buah', 'Yayasan', '2018', '3500000', '3500000', '145/INV/KEUANGAN/2018', '', 0, 3),
(230, 6, 12, 1, 24, 3, 2, 'Meja kelas', '1', 'Buah', 'Hibah', '2018', '150000', '150000', '145/INV/KEUANGAN/2018', '', 0, 3),
(231, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'Buah', 'Hibah', '2023', '2000000', '2000000', '145/INV/KEUANGAN/2023', '', 0, 3),
(232, 6, 12, 1, 24, 2, 2, 'Kursi Kantor', '1', 'Buah', 'Yayasan', '2022', '1000000', '1000000', '155/INV/KEUANGAN/2022', '', 0, 3),
(233, 6, 12, 1, 24, 4, 2, 'Loker ', '1', 'Buah', 'Yayasan', '2012', '2500000', '2500000', '155/INV/KEUANGAN/2012', '', 0, 3),
(234, 6, 12, 1, 24, 13, 3, 'Lemari Es', '1', 'Buah', 'Hibah', '2022', '4000000', '4000000', '155/INV/KEUANGAN/2022', '', 0, 3),
(235, 6, 12, 1, 24, 6, 2, 'Printer', '1', 'Buah', 'Yayasan', '2018', '3500000', '3500000', '155/INV/KEUANGAN/2018', '', 0, 3),
(236, 6, 12, 1, 24, 12, 2, 'Mesin Fax', '1', 'Buah', 'Yayasan', '2009', '1750000', '1750000', '155/INV/KEUANGAN/2009', '', 0, 3),
(237, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '1', 'Buah', 'Yayasan', '2018', '200000', '200000', '155/INV/KEUANGAN/2018', '', 0, 3),
(238, 6, 12, 1, 24, 3, 2, 'Meja Kerja', '1', 'Buah', 'Yayasan', '2018', '200000', '200000', '155/INV/KEUANGAN/2018', '', 0, 3),
(239, 6, 12, 1, 24, 4, 2, 'Lemari Arsip', '1', 'Buah', 'Yayasan', '2018', '3500000', '3500000', '155/INV/KEUANGAN/2018', '', 0, 3),
(240, 6, 12, 1, 24, 3, 2, 'Meja kelas', '1', 'Buah', 'Hibah', '2018', '150000', '150000', '155/INV/KEUANGAN/2018', '', 0, 3),
(241, 6, 12, 1, 24, 5, 2, 'Komputer', '1', 'Buah', 'Hibah', '2023', '2000000', '2000000', '155/INV/KEUANGAN/2023', '', 0, 3),
(242, 32, 22, 1, 18, 3, 2, 'Set meja kerja', '1', 'BUAH', 'YAYASAN', '2019', '12000000', '12000000', '1/INV/HCD/2019', '', 0, 53),
(243, 32, 22, 1, 18, 5, 2, 'Komputer desain', '1', 'BUAH', 'YAYASAN', '2019', '4500000', '4500000', '1/INV/HCD/2019', '', 0, 53),
(244, 32, 22, 1, 18, 5, 2, 'Komputer', '2', 'BUAH', 'YAYASAN', '2019', '3500000', '7000000', '1/INV/HCD/2019', '', 0, 53),
(245, 32, 22, 1, 18, 5, 2, 'Komputer', '3', 'BUAH', 'HIBAH', '2019', '3500000', '10500000', '1/INV/HCD/2019', '', 0, 53),
(246, 32, 22, 1, 18, 5, 2, 'Komputer BOS', '1', 'BUAH', 'YAYASAN', '2019', '3500000', '3500000', '1/INV/HCD/2019', '', 0, 53),
(247, 32, 22, 1, 18, 3, 2, 'Meja Kerja Pimpinan ', '2', 'BUAH', 'YAYASAN', '2019', '2150000', '4300000', '1/INV/HCD/2019', '', 0, 53),
(248, 32, 22, 1, 18, 3, 2, 'Meja Kerja ', '1', 'BUAH', 'YAYASAN', '2019', '2150000', '2150000', '1/INV/HCD/2019', '', 0, 53),
(249, 32, 22, 1, 18, 4, 2, 'Lemari Arsip', '1', 'BUAH', 'YAYASAN', '2019', '2500000', '2500000', '1/INV/HCD/2019', '', 0, 53),
(250, 32, 22, 1, 18, 4, 2, 'Lemari Arsip Humas', '1', 'BUAH', 'YAYASAN', '2019', '2500000', '2500000', '1/INV/HCD/2019', '', 0, 53),
(251, 32, 22, 1, 18, 2, 2, 'Kursi Kerja', '11', 'BUAH', 'YAYASAN', '2022', '1000000', '11000000', '1/INV/HCD/2022', '', 0, 53),
(252, 32, 22, 1, 18, 2, 2, 'Kursi Kerja Pimpinan', '1', 'BUAH', 'YAYASAN', '2019', '1000000', '1000000', '1/INV/HCD/2019', '', 0, 53),
(253, 32, 22, 1, 18, 9, 2, 'Dispenser', '1', 'BUAH', 'YAYASAN', '2019', '500000', '500000', '1/INV/HCD/2019', '', 0, 53),
(254, 32, 22, 1, 18, 3, 2, 'Meja Catering', '1', 'BUAH', 'YAYASAN', '2019', '950000', '950000', '1/INV/HCD/2019', '', 0, 53),
(255, 32, 22, 1, 18, 13, 3, 'Kipas baling baling', '2', 'BUAH', 'YAYASAN', '2007', '250000', '500000', '1/INV/HCD/2007', '', 0, 53),
(256, 32, 22, 1, 18, 3, 2, 'Meja Kerja Panjang', '1', 'BUAH', 'YAYASAN', '2019', '550000', '550000', '1/INV/HCD/2019', '', 0, 53),
(257, 32, 22, 1, 18, 13, 3, 'AC', '2', 'BUAH', 'YAYASAN', '2019', '3500000', '7000000', '1/INV/HCD/2019', '', 0, 53),
(258, 32, 22, 1, 18, 6, 2, 'Printer', '1', 'BUAH', 'YAYASAN', '2019', '2800000', '2800000', '1/INV/HCD/2019', '', 0, 53),
(259, 32, 22, 1, 18, 6, 2, 'Printer', '1', 'BUAH', 'YAYASAN', '2017', '2800000', '2800000', '1/INV/HCD/2017', '', 0, 53),
(260, 32, 22, 1, 18, 11, 2, 'Kotak Kunci ', '1', 'BUAH', 'YAYASAN', '2019', '2000000', '2000000', '1/INV/HCD/2019', '', 0, 53),
(261, 32, 22, 1, 18, 4, 2, 'Almari Dokumen Kabag', '3', 'BUAH', 'YAYASAN', '2019', '2750000', '8250000', '1/INV/HCD/2019', '', 0, 53),
(262, 32, 22, 1, 18, 2, 2, 'Kursi Tamu', '1', 'BUAH', 'YAYASAN', '2014', '3000000', '3000000', '1/INV/HCD/2014', '', 0, 53),
(263, 32, 22, 1, 18, 3, 2, 'Set meja kerja', '1', 'BUAH', 'YAYASAN', '2019', '12000000', '12000000', '22/INV/HCD/2019', '', 0, 53),
(264, 32, 22, 1, 18, 5, 2, 'Komputer desain', '1', 'BUAH', 'YAYASAN', '2019', '4500000', '4500000', '22/INV/HCD/2019', '', 0, 53),
(265, 32, 22, 1, 18, 5, 2, 'Komputer', '2', 'BUAH', 'YAYASAN', '2019', '3500000', '7000000', '22/INV/HCD/2019', '', 0, 53),
(266, 32, 22, 1, 18, 5, 2, 'Komputer', '3', 'BUAH', 'HIBAH', '2019', '3500000', '10500000', '22/INV/HCD/2019', '', 0, 53),
(267, 32, 22, 1, 18, 5, 2, 'Komputer BOS', '1', 'BUAH', 'YAYASAN', '2019', '3500000', '3500000', '22/INV/HCD/2019', '', 0, 53),
(268, 32, 22, 1, 18, 3, 2, 'Meja Kerja Pimpinan ', '2', 'BUAH', 'YAYASAN', '2019', '2150000', '4300000', '22/INV/HCD/2019', '', 0, 53),
(269, 32, 22, 1, 18, 3, 2, 'Meja Kerja ', '1', 'BUAH', 'YAYASAN', '2019', '2150000', '2150000', '22/INV/HCD/2019', '', 0, 53),
(270, 32, 22, 1, 18, 4, 2, 'Lemari Arsip', '1', 'BUAH', 'YAYASAN', '2019', '2500000', '2500000', '22/INV/HCD/2019', '', 0, 53),
(271, 32, 22, 1, 18, 4, 2, 'Lemari Arsip Humas', '1', 'BUAH', 'YAYASAN', '2019', '2500000', '2500000', '22/INV/HCD/2019', '', 0, 53),
(272, 32, 22, 1, 18, 2, 2, 'Kursi Kerja', '11', 'BUAH', 'YAYASAN', '2022', '1000000', '11000000', '22/INV/HCD/2022', '', 0, 53),
(273, 32, 22, 1, 18, 2, 2, 'Kursi Kerja Pimpinan', '1', 'BUAH', 'YAYASAN', '2019', '1000000', '1000000', '22/INV/HCD/2019', '', 0, 53),
(274, 32, 22, 1, 18, 9, 2, 'Dispenser', '1', 'BUAH', 'YAYASAN', '2019', '500000', '500000', '22/INV/HCD/2019', '', 0, 53),
(275, 32, 22, 1, 18, 3, 2, 'Meja Catering', '1', 'BUAH', 'YAYASAN', '2019', '950000', '950000', '22/INV/HCD/2019', '', 0, 53),
(276, 32, 22, 1, 18, 13, 3, 'Kipas baling baling', '2', 'BUAH', 'YAYASAN', '2007', '250000', '500000', '22/INV/HCD/2007', '', 0, 53),
(277, 32, 22, 1, 18, 3, 2, 'Meja Kerja Panjang', '1', 'BUAH', 'YAYASAN', '2019', '550000', '550000', '22/INV/HCD/2019', '', 0, 53),
(278, 32, 22, 1, 18, 13, 3, 'AC', '2', 'BUAH', 'YAYASAN', '2019', '3500000', '7000000', '22/INV/HCD/2019', '', 0, 53),
(279, 32, 22, 1, 18, 6, 2, 'Printer', '1', 'BUAH', 'YAYASAN', '2019', '2800000', '2800000', '22/INV/HCD/2019', '', 0, 53),
(280, 32, 22, 1, 18, 6, 2, 'Printer', '1', 'BUAH', 'YAYASAN', '2017', '2800000', '2800000', '22/INV/HCD/2017', '', 0, 53),
(281, 32, 22, 1, 18, 11, 2, 'Kotak Kunci ', '1', 'BUAH', 'YAYASAN', '2019', '2000000', '2000000', '22/INV/HCD/2019', '', 0, 53),
(282, 32, 22, 1, 18, 4, 2, 'Almari Dokumen Kabag', '3', 'BUAH', 'YAYASAN', '2019', '2750000', '8250000', '22/INV/HCD/2019', '', 0, 53),
(283, 32, 22, 1, 18, 2, 2, 'Kursi Tamu', '1', 'BUAH', 'YAYASAN', '2014', '3000000', '3000000', '22/INV/HCD/2014', '', 0, 53),
(284, 32, 22, 1, 18, 3, 2, 'Set meja kerja', '1', 'BUAH', 'YAYASAN', '2019', '12000000', '12000000', '43/INV/HCD/2019', '', 0, 53),
(285, 32, 22, 1, 18, 5, 2, 'Komputer desain', '1', 'BUAH', 'YAYASAN', '2019', '4500000', '4500000', '43/INV/HCD/2019', '', 0, 53),
(286, 32, 22, 1, 18, 5, 2, 'Komputer', '2', 'BUAH', 'YAYASAN', '2019', '3500000', '7000000', '43/INV/HCD/2019', '', 0, 53),
(287, 32, 22, 1, 18, 5, 2, 'Komputer', '3', 'BUAH', 'HIBAH', '2019', '3500000', '10500000', '43/INV/HCD/2019', '', 0, 53),
(288, 32, 22, 1, 18, 5, 2, 'Komputer BOS', '1', 'BUAH', 'YAYASAN', '2019', '3500000', '3500000', '43/INV/HCD/2019', '', 0, 53),
(289, 32, 22, 1, 18, 3, 2, 'Meja Kerja Pimpinan ', '2', 'BUAH', 'YAYASAN', '2019', '2150000', '4300000', '43/INV/HCD/2019', '', 0, 53),
(290, 32, 22, 1, 18, 3, 2, 'Meja Kerja ', '1', 'BUAH', 'YAYASAN', '2019', '2150000', '2150000', '43/INV/HCD/2019', '', 0, 53),
(291, 32, 22, 1, 18, 4, 2, 'Lemari Arsip', '1', 'BUAH', 'YAYASAN', '2019', '2500000', '2500000', '43/INV/HCD/2019', '', 0, 53),
(292, 32, 22, 1, 18, 4, 2, 'Lemari Arsip Humas', '1', 'BUAH', 'YAYASAN', '2019', '2500000', '2500000', '43/INV/HCD/2019', '', 0, 53),
(293, 32, 22, 1, 18, 2, 2, 'Kursi Kerja', '11', 'BUAH', 'YAYASAN', '2022', '1000000', '11000000', '43/INV/HCD/2022', '', 0, 53),
(294, 32, 22, 1, 18, 2, 2, 'Kursi Kerja Pimpinan', '1', 'BUAH', 'YAYASAN', '2019', '1000000', '1000000', '43/INV/HCD/2019', '', 0, 53),
(295, 32, 22, 1, 18, 9, 2, 'Dispenser', '1', 'BUAH', 'YAYASAN', '2019', '500000', '500000', '43/INV/HCD/2019', '', 0, 53),
(296, 32, 22, 1, 18, 3, 2, 'Meja Catering', '1', 'BUAH', 'YAYASAN', '2019', '950000', '950000', '43/INV/HCD/2019', '', 0, 53),
(297, 32, 22, 1, 18, 13, 3, 'Kipas baling baling', '2', 'BUAH', 'YAYASAN', '2007', '250000', '500000', '43/INV/HCD/2007', '', 0, 53),
(298, 32, 22, 1, 18, 3, 2, 'Meja Kerja Panjang', '1', 'BUAH', 'YAYASAN', '2019', '550000', '550000', '43/INV/HCD/2019', '', 0, 53),
(299, 32, 22, 1, 18, 13, 3, 'AC', '2', 'BUAH', 'YAYASAN', '2019', '3500000', '7000000', '43/INV/HCD/2019', '', 0, 53),
(300, 32, 22, 1, 18, 6, 2, 'Printer', '1', 'BUAH', 'YAYASAN', '2019', '2800000', '2800000', '43/INV/HCD/2019', '', 0, 53),
(301, 32, 22, 1, 18, 6, 2, 'Printer', '1', 'BUAH', 'YAYASAN', '2017', '2800000', '2800000', '43/INV/HCD/2017', '', 0, 53),
(302, 32, 22, 1, 18, 11, 2, 'Kotak Kunci ', '1', 'BUAH', 'YAYASAN', '2019', '2000000', '2000000', '43/INV/HCD/2019', '', 0, 53),
(303, 32, 22, 1, 18, 4, 2, 'Almari Dokumen Kabag', '3', 'BUAH', 'YAYASAN', '2019', '2750000', '8250000', '43/INV/HCD/2019', '', 0, 53),
(304, 32, 22, 1, 18, 2, 2, 'Kursi Tamu', '1', 'BUAH', 'YAYASAN', '2014', '3000000', '3000000', '43/INV/HCD/2014', '', 0, 53),
(305, 13, 26, 1, 13, 13, 3, 'Kipas Angin ', '1', 'BUAH', 'YAYASAN', '2017', '350000', '350000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(306, 13, 26, 1, 13, 4, 2, 'lemari Berkas', '1', 'BUAH', 'YAYASAN', '2017', '1500000', '1500000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(307, 13, 26, 1, 13, 2, 2, 'Set Kursi Tamu', '1', 'BUAH', 'YAYASAN', '2017', '2500000', '2500000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(308, 13, 26, 1, 13, 3, 2, 'Meja Kerja', '1', 'BUAH', 'YAYASAN', '2017', '500000', '500000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(309, 13, 26, 1, 13, 2, 2, 'Kursi kerja', '2', 'BUAH', 'YAYASAN', '2017', '250000', '500000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(310, 13, 26, 1, 13, 2, 2, 'Kursi Kelas', '1', 'BUAH', 'YAYASAN', '2017', '150000', '150000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(311, 13, 26, 1, 13, 3, 2, 'Meja Kelas', '1', 'BUAH', 'YAYASAN', '2017', '150000', '150000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(312, 13, 26, 1, 13, 5, 2, 'Komputer', '1', 'BUAH', 'YAYASAN', '2017', '2000000', '2000000', '1/INV/BIRO KONSELING/2017', '', 0, 14),
(313, 13, 26, 1, 13, 13, 3, 'Kipas Angin ', '1', 'BUAH', 'YAYASAN', '2017', '350000', '350000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(314, 13, 26, 1, 13, 4, 2, 'lemari Berkas', '1', 'BUAH', 'YAYASAN', '2017', '1500000', '1500000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(315, 13, 26, 1, 13, 2, 2, 'Set Kursi Tamu', '1', 'BUAH', 'YAYASAN', '2017', '2500000', '2500000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(316, 13, 26, 1, 13, 3, 2, 'Meja Kerja', '1', 'BUAH', 'YAYASAN', '2017', '500000', '500000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(317, 13, 26, 1, 13, 2, 2, 'Kursi kerja', '2', 'BUAH', 'YAYASAN', '2017', '250000', '500000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(318, 13, 26, 1, 13, 2, 2, 'Kursi Kelas', '1', 'BUAH', 'YAYASAN', '2017', '150000', '150000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(319, 13, 26, 1, 13, 3, 2, 'Meja Kelas', '1', 'BUAH', 'YAYASAN', '2017', '150000', '150000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(320, 13, 26, 1, 13, 5, 2, 'Komputer', '1', 'BUAH', 'YAYASAN', '2017', '2000000', '2000000', '9/INV/BIRO KONSELING/2017', '', 0, 14),
(321, 13, 26, 1, 13, 13, 3, 'Kipas Angin ', '1', 'BUAH', 'YAYASAN', '2017', '350000', '350000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(322, 13, 26, 1, 13, 4, 2, 'lemari Berkas', '1', 'BUAH', 'YAYASAN', '2017', '1500000', '1500000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(323, 13, 26, 1, 13, 2, 2, 'Set Kursi Tamu', '1', 'BUAH', 'YAYASAN', '2017', '2500000', '2500000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(324, 13, 26, 1, 13, 3, 2, 'Meja Kerja', '1', 'BUAH', 'YAYASAN', '2017', '500000', '500000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(325, 13, 26, 1, 13, 2, 2, 'Kursi kerja', '2', 'BUAH', 'YAYASAN', '2017', '250000', '500000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(326, 13, 26, 1, 13, 2, 2, 'Kursi Kelas', '1', 'BUAH', 'YAYASAN', '2017', '150000', '150000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(327, 13, 26, 1, 13, 3, 2, 'Meja Kelas', '1', 'BUAH', 'YAYASAN', '2017', '150000', '150000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(328, 13, 26, 1, 13, 5, 2, 'Komputer', '1', 'BUAH', 'YAYASAN', '2017', '2000000', '2000000', '17/INV/BIRO KONSELING/2017', '', 0, 14),
(329, 13, 26, 1, 13, 13, 3, 'Kipas Angin ', '1', 'BUAH', 'MILIK', '2017', '350000', '350000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(330, 13, 26, 1, 13, 4, 2, 'lemari Berkas', '1', 'BUAH', 'MILIK', '2017', '1500000', '1500000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(331, 13, 26, 1, 13, 2, 2, 'Set Kursi Tamu', '1', 'BUAH', 'MILIK', '2017', '2500000', '2500000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(332, 13, 26, 1, 13, 3, 2, 'Meja Kerja', '1', 'BUAH', 'MILIK', '2017', '500000', '500000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(333, 13, 26, 1, 13, 2, 2, 'Kursi kerja', '2', 'BUAH', 'MILIK', '2017', '250000', '500000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(334, 13, 26, 1, 13, 2, 2, 'Kursi Kelas', '1', 'BUAH', 'MILIK', '2017', '150000', '150000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(335, 13, 26, 1, 13, 3, 2, 'Meja Kelas', '1', 'BUAH', 'MILIK', '2017', '150000', '150000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(336, 13, 26, 1, 13, 5, 2, 'Komputer', '1', 'BUAH', 'MILIK', '2017', '2000000', '2000000', '25/INV/BIRO KONSELING/2017', '', 0, 14),
(337, 15, 21, 1, 14, 6, 2, 'Printer ', '1', 'BUAH', 'MILIK', '2009', '3000000', '3000000', '1/INV/BLC/2009', '', 0, 117),
(338, 15, 21, 1, 14, 5, 2, 'Komputer ', '1', 'BUAH', 'MILIK', '2009', '3500000', '3500000', '1/INV/BLC/2009', '', 0, 117),
(339, 15, 21, 1, 14, 4, 2, 'Lemari Berkas ', '1', 'BUAH', 'MILIK', '2009', '1000000', '1000000', '1/INV/BLC/2009', '', 0, 117),
(340, 15, 21, 1, 14, 13, 3, 'Kipas angin', '1', 'BUAH', 'MILIK', '2009', '3500000', '3500000', '1/INV/BLC/2009', '', 0, 117),
(341, 15, 21, 1, 14, 3, 2, 'Meja kerja ', '1', 'buah', 'milik', '2016', '250000', '250000', '5/INV/BLC/2016', '', 0, 117),
(342, 15, 21, 1, 14, 5, 2, 'Komputer ', '1', 'buah', 'milik', '2016', '3000000', '3000000', '5/INV/BLC/2016', '', 0, 117),
(343, 15, 21, 1, 14, 12, 2, 'Mesin pencetak (printer)+mesin scanner', '1', 'buah', 'milik', '2016', '3000000', '3000000', '5/INV/BLC/2016', '', 0, 117),
(344, 15, 21, 1, 14, 4, 2, 'Lemari berkas ', '1', 'buah', 'milik', '2016', '2000000', '2000000', '5/INV/BLC/2016', '', 0, 117),
(345, 15, 21, 1, 14, 4, 2, 'Loker  ', '1', 'buah', 'milik', '2016', '1000000', '1000000', '5/INV/BLC/2016', '', 0, 117),
(346, 15, 21, 1, 14, 12, 2, 'Kipas angin', '2', 'buah', 'milik', '2016', '250000', '500000', '5/INV/BLC/2016', '', 0, 117),
(347, 15, 21, 1, 14, 12, 2, 'Layar Proyektor', '1', 'buah', 'milik', '2016', '3750000', '3750000', '5/INV/BLC/2016', '', 0, 117),
(348, 15, 21, 1, 14, 11, 2, 'Jam Dinding', '1', 'buah', 'milik', '2016', '200000', '200000', '5/INV/BLC/2016', '', 0, 117),
(349, 15, 21, 1, 14, 11, 2, 'Papan Pengumuman', '1', 'buah', 'milik', '2016', '150000', '150000', '5/INV/BLC/2016', '', 0, 117),
(350, 15, 21, 1, 14, 11, 2, 'Pigura Pajangan ', '1', 'buah', 'milik', '2016', '200000', '200000', '5/INV/BLC/2016', '', 0, 117),
(351, 15, 21, 1, 14, 11, 2, 'Karpet Hijau', '1', 'buah', 'milik', '2016', '600000', '600000', '5/INV/BLC/2016', '', 0, 117),
(352, 15, 21, 1, 14, 3, 2, 'Meja Belajar ( Dampar )', '3', 'buah', 'milik', '2016', '750000', '2250000', '5/INV/BLC/2016', '', 0, 117),
(353, 15, 21, 1, 14, 11, 2, 'Papan Tulis Kecil', '4', 'buah', 'milik', '2016', '500000', '2000000', '5/INV/BLC/2016', '', 0, 117),
(354, 15, 21, 1, 14, 12, 2, 'Keyboard', '1', 'buah', 'milik', '2016', '1000000', '1000000', '5/INV/BLC/2016', '', 0, 117),
(355, 15, 21, 1, 14, 3, 2, 'Meja kerja ', '1', 'buah', 'milik', '2016', '250000', '250000', '19/INV/BLC/2016', '', 0, 117),
(356, 15, 21, 1, 14, 5, 2, 'Komputer ', '1', 'buah', 'milik', '2016', '3000000', '3000000', '19/INV/BLC/2016', '', 0, 117),
(357, 15, 21, 1, 14, 12, 2, 'Mesin pencetak (printer)+mesin scanner', '1', 'buah', 'milik', '2016', '3000000', '3000000', '19/INV/BLC/2016', '', 0, 117),
(358, 15, 21, 1, 14, 4, 2, 'Lemari berkas ', '1', 'buah', 'milik', '2016', '2000000', '2000000', '19/INV/BLC/2016', '', 0, 117),
(359, 15, 21, 1, 14, 4, 2, 'Loker  ', '1', 'buah', 'milik', '2016', '1000000', '1000000', '19/INV/BLC/2016', '', 0, 117),
(360, 15, 21, 1, 14, 12, 2, 'Kipas angin', '2', 'buah', 'milik', '2016', '250000', '500000', '19/INV/BLC/2016', '', 0, 117),
(361, 15, 21, 1, 14, 12, 2, 'Layar Proyektor', '1', 'buah', 'milik', '2016', '3750000', '3750000', '19/INV/BLC/2016', '', 0, 117),
(362, 15, 21, 1, 14, 11, 2, 'Jam Dinding', '1', 'buah', 'milik', '2016', '200000', '200000', '19/INV/BLC/2016', '', 0, 117),
(363, 15, 21, 1, 14, 11, 2, 'Papan Pengumuman', '1', 'buah', 'milik', '2016', '150000', '150000', '19/INV/BLC/2016', '', 0, 117),
(364, 15, 21, 1, 14, 11, 2, 'Pigura Pajangan ', '1', 'buah', 'milik', '2016', '200000', '200000', '19/INV/BLC/2016', '', 0, 117),
(365, 15, 21, 1, 14, 11, 2, 'Karpet Hijau', '1', 'buah', 'milik', '2016', '600000', '600000', '19/INV/BLC/2016', '', 0, 117),
(366, 15, 21, 1, 14, 3, 2, 'Meja Belajar ( Dampar )', '3', 'buah', 'milik', '2016', '750000', '2250000', '19/INV/BLC/2016', '', 0, 117),
(367, 15, 21, 1, 14, 11, 2, 'Papan Tulis Kecil', '4', 'buah', 'milik', '2016', '500000', '2000000', '19/INV/BLC/2016', '', 0, 117),
(368, 15, 21, 1, 14, 12, 2, 'Keyboard', '1', 'buah', 'milik', '2016', '1000000', '1000000', '19/INV/BLC/2016', '', 0, 117),
(369, 8, 52, 5, 17, 4, 2, 'Lemari Arsip Kayu', '3', 'buah', 'milik', '2017', '2500000', '7500000', '1/INV/MADIN/2017', '', 0, 53),
(370, 8, 52, 5, 17, 4, 2, 'Loker Besar', '1', 'buah', 'milik', '2017', '3000000', '3000000', '1/INV/MADIN/2017', '', 0, 53),
(371, 8, 52, 5, 17, 4, 2, 'Lemari Berkas', '1', 'buah', 'milik', '2017', '2000000', '2000000', '1/INV/MADIN/2017', '', 0, 53),
(372, 8, 52, 5, 17, 3, 2, 'Meja Kerja', '2', 'buah', 'milik', '2017', '500000', '1000000', '1/INV/MADIN/2017', '', 0, 53),
(373, 8, 52, 5, 17, 2, 2, 'Kursi ', '2', 'buah', 'milik', '2017', '200000', '400000', '1/INV/MADIN/2017', '', 0, 53),
(374, 8, 52, 5, 17, 5, 2, 'Komputer', '1', 'buah', 'milik', '2017', '3000000', '3000000', '1/INV/MADIN/2017', '', 0, 53),
(375, 8, 52, 5, 17, 5, 2, 'Komputer', '1', 'buah', 'milik', '2017', '300000', '300000', '1/INV/MADIN/2017', '', 0, 53),
(376, 8, 52, 5, 17, 6, 2, 'Printer  ', '1', 'buah', 'milik', '2017', '2500000', '2500000', '1/INV/MADIN/2017', '', 0, 53),
(377, 8, 52, 5, 17, 12, 2, 'Speaker ', '1', 'buah', 'milik', '2017', '500000', '500000', '1/INV/MADIN/2017', '', 0, 53),
(378, 37, 31, 1, 41, 13, 3, 'Kipas Baling', '2', 'BUAH', 'MILIK', '2008', '500000', '1000000', '1/INV/QC/2008', '', 0, 99),
(379, 37, 31, 1, 41, 13, 3, 'Kipas Dinding', '1', 'BUAH', 'MILIK', '2008', '500000', '500000', '1/INV/QC/2008', '', 0, 99),
(380, 37, 31, 1, 41, 7, 2, 'Sound System', '1', 'BUAH', 'MILIK', '2008', '7000000', '7000000', '1/INV/QC/2008', '', 0, 99),
(381, 37, 31, 1, 41, 12, 2, 'Layar Proyektor', '1', 'BUAH', 'MILIK', '2008', '4500000', '4500000', '1/INV/QC/2008', '', 0, 99),
(382, 37, 31, 1, 41, 13, 3, 'Kipas Berdiri', '2', 'BUAH', 'MILIK', '2008', '2250000', '4500000', '1/INV/QC/2008', '', 0, 99),
(383, 37, 31, 1, 41, 2, 2, 'KursI Dainachi', '185', 'BUAH', 'MILIK', '2008', '350000', '64750000', '1/INV/QC/2008', '', 0, 99),
(384, 37, 31, 1, 41, 3, 2, 'Meja Kerja', '10', 'buah', 'milik', '2016', '450000', '4500000', '7/INV/QC/2016', '', 0, 99),
(385, 37, 31, 1, 41, 13, 3, 'AC', '2', 'buah', 'milik', '2016', '3500000', '7000000', '7/INV/QC/2016', '', 0, 99),
(386, 37, 31, 1, 41, 13, 3, 'Kipas Baling', '2', 'buah', 'milik', '2016', '500000', '1000000', '7/INV/QC/2016', '', 0, 99),
(387, 37, 31, 1, 41, 13, 3, 'kipas dinding', '2', 'buah', 'milik', '2016', '500000', '1000000', '7/INV/QC/2016', '', 0, 99),
(388, 37, 31, 1, 41, 12, 2, 'Proyektor', '1', 'buah', 'milik', '2016', '3000000', '3000000', '7/INV/QC/2016', '', 0, 99),
(389, 37, 31, 1, 41, 11, 2, 'Layar', '1', 'buah', 'milik', '2016', '1500000', '1500000', '7/INV/QC/2016', '', 0, 99),
(390, 37, 31, 1, 41, 11, 2, 'Papan Tulis', '1', 'buah', 'milik', '2016', '1000000', '1000000', '7/INV/QC/2016', '', 0, 99),
(391, 37, 31, 1, 41, 12, 2, 'Kabel Proyektor', '1', 'buah', 'milik', '2016', '350000', '350000', '7/INV/QC/2016', '', 0, 99),
(392, 37, 31, 1, 41, 7, 2, 'Ampli', '1', 'buah', 'milik', '2016', '350000', '350000', '7/INV/QC/2016', '', 0, 99),
(393, 37, 31, 1, 41, 2, 2, 'Kursi Dainichi', '35', 'buah', 'milik', '2021', '350000', '12250000', '7/INV/QC/2021', '', 0, 99);
INSERT INTO `inventory_input_aset` (`id_input_aset`, `aset_unit_id`, `aset_sub_unit_id`, `lokasi_gedung_id`, `lokasi_ruang_id`, `jenis_aset_id`, `jenis_kelompok_id`, `nama_sarana`, `jumlah_aset`, `satuan_aset`, `status_kepemilikan`, `tahun_pengadaan`, `harga_perolehan`, `total_perolehan`, `label_aset`, `keterangan_aset`, `aset_aktif`, `pic_id`) VALUES
(394, 37, 31, 1, 41, 12, 2, 'mix', '1', 'buah', 'milik', '2016', '250000', '250000', '7/INV/QC/2016', '', 0, 99),
(395, 4, 36, 3, 43, 0, 0, 'Lemari Arsip', '3', 'buah', 'milik', '2007', '3000000', '9000000', '17/INV/SMA/2007', '', 0, 60),
(396, 4, 36, 3, 43, 0, 0, 'Meja Prasmanan ', '1', 'buah', 'milik', '2007', '1500000', '1500000', '17/INV/SMA/2007', '', 0, 60),
(397, 4, 36, 3, 43, 0, 0, 'Salon + Amply ', '1', 'buah', 'milik', '2007', '1750000', '1750000', '17/INV/SMA/2007', '', 0, 60),
(398, 4, 36, 3, 43, 0, 0, 'Lemari Arsip', '6', 'buah', 'milik', '2007', '2500000', '15000000', '17/INV/SMA/2007', '', 0, 60),
(399, 4, 36, 3, 43, 0, 0, 'Dispenser ', '1', 'buah', 'milik', '2007', '500000', '500000', '17/INV/SMA/2007', '', 0, 60),
(400, 4, 36, 3, 43, 0, 0, 'lemari Bola', '1', 'buah', 'milik', '2007', '900000', '900000', '17/INV/SMA/2007', '', 0, 60),
(401, 4, 36, 3, 43, 0, 0, 'Meja ', '20', 'buah', 'milik', '2007', '150000', '3000000', '17/INV/SMA/2007', '', 0, 60),
(402, 4, 36, 3, 43, 0, 0, 'Kursi', '20', 'buah', 'milik', '2007', '250000', '5000000', '17/INV/SMA/2007', '', 0, 60),
(403, 6, 20, 1, 39, 5, 2, 'Telepon PABX', '1', 'buah', 'Milik', '2013', '1500000', '1500000', '165/INV/KEUANGAN/2013', 'Baru', 1, 112),
(404, 6, 12, 1, 24, 13, 3, 'AC Sharp', '2', 'unit', 'Milik', '2014', '2500000', '5000000', '166/INV/KEUANGAN/2014', 'Baru', 1, 3),
(405, 32, 22, 1, 18, 13, 3, 'Printer Laserjet HP', '1', 'unit', 'Milik', '2017', '1500000', '1500000', '64/INV/HCD/2017', 'Baru', 1, 53),
(406, 6, 12, 1, 24, 6, 2, 'Printer Epson L4150', '1', 'unit', 'Milik', '2018', '2000000', '2000000', '167/INV/KEUANGAN/2018', 'Baru', 1, 3),
(407, 6, 12, 1, 24, 6, 2, 'Printer Epson L1110 kesekretariatan', '1', 'unit', 'Milik', '2018', '2000000', '2000000', '168/INV/KEUANGAN/2018', 'Baru', 1, 3),
(408, 11, 28, 1, 29, 5, 2, 'TV LG 32 inch', '1', 'unit', 'Milik', '2018', '2700000', '2700000', '1/INV/HUMAS/2018', 'Baru', 1, 49),
(409, 10, 23, 1, 26, 12, 2, 'Headphone 01', '1', 'unit', 'Milik', '2017', '400000', '400000', '1/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(410, 10, 23, 1, 26, 12, 2, 'Headphone 02', '1', 'unit', 'Milik', '2017', '0', '0', '2/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(411, 10, 23, 1, 26, 12, 2, 'Headphone 40', '1', 'unit', 'Milik', '2017', '0', '0', '3/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(412, 10, 23, 1, 26, 12, 2, 'Headphone  04', '1', 'unit', 'Milik', '2017', '0', '0', '4/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(413, 10, 23, 1, 26, 12, 2, 'Headphone 05', '1', 'unit', 'Milik', '2017', '0', '0', '5/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(414, 10, 23, 1, 26, 12, 2, 'Headphone 19', '1', 'unit', 'Milik', '2017', '0', '0', '6/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(415, 10, 23, 1, 26, 12, 2, 'Headphone 06', '1', 'unit', 'Milik', '2017', '0', '0', '7/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(416, 10, 23, 1, 26, 12, 2, 'Headphone 07', '1', 'unit', 'Milik', '2017', '0', '0', '8/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(417, 10, 23, 1, 26, 12, 2, 'Headphone 07', '1', 'unit', 'Milik', '2017', '0', '0', '9/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(418, 10, 23, 1, 26, 12, 2, 'Headphone 08', '1', 'unit', 'Milik', '2017', '0', '0', '10/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(419, 10, 23, 1, 26, 12, 2, 'Headphone 09', '1', 'unit', 'Milik', '2017', '0', '0', '11/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(420, 10, 23, 1, 26, 12, 2, 'Headphone 10', '1', 'unit', 'Milik', '2017', '0', '0', '12/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(421, 10, 23, 1, 26, 12, 2, 'Headphone 11', '1', 'unit', 'Milik', '2017', '0', '0', '13/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(422, 10, 23, 1, 26, 12, 2, 'Headphone 12', '1', 'unit', 'Milik', '2018', '0', '0', '14/INV/BIDANG BLP/2018', 'Baru', 1, 27),
(423, 10, 23, 1, 26, 12, 2, 'Headphone 45', '1', 'unit', 'Milik', '2017', '0', '0', '15/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(424, 10, 23, 1, 26, 12, 2, 'Headphone 14', '1', 'unit', 'Milik', '2017', '0', '0', '16/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(425, 10, 23, 1, 26, 12, 2, 'Headphone 15', '1', 'unit', 'Milik', '2017', '0', '0', '17/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(426, 10, 23, 1, 26, 12, 2, 'Headphone 16', '1', 'unit', 'Milik', '2017', '0', '0', '18/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(427, 10, 23, 1, 26, 12, 2, 'Headphone 17', '1', 'unit', 'Milik', '2017', '0', '0', '19/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(428, 10, 23, 1, 26, 12, 2, 'Headphone 26', '1', 'unit', 'Milik', '2017', '0', '0', '20/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(429, 10, 23, 1, 26, 12, 2, 'Headphone 21', '1', 'unit', 'Milik', '2017', '0', '0', '21/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(430, 10, 23, 1, 26, 12, 2, 'Headphone 20', '1', 'unit', 'Milik', '2017', '0', '0', '22/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(431, 10, 23, 1, 26, 12, 2, 'Headphone 23', '1', 'unit', 'Milik', '2017', '0', '0', '23/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(432, 10, 23, 1, 26, 12, 2, 'Headphone 24', '1', 'unit', 'Milik', '2017', '0', '0', '24/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(433, 10, 23, 1, 26, 12, 2, 'Headphone 25', '1', 'unit', 'Milik', '2017', '0', '0', '25/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(434, 10, 23, 1, 26, 12, 2, 'Headphone 27', '1', 'unit', 'Milik', '2017', '0', '0', '26/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(435, 10, 23, 1, 26, 12, 2, 'Headphone 28', '1', 'unit', 'Milik', '2017', '0', '0', '27/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(436, 10, 23, 1, 26, 12, 2, 'Headphone 22', '1', 'unit', 'Milik', '2017', '0', '0', '28/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(437, 10, 23, 1, 26, 12, 2, 'Headphone 20', '1', 'unit', 'Milik', '2017', '0', '0', '29/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(438, 10, 23, 1, 26, 12, 2, 'Headphone 35', '1', 'unit', 'Milik', '2017', '0', '0', '30/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(439, 10, 23, 1, 26, 12, 2, 'Headphone 31', '1', 'unit', 'Milik', '2017', '0', '0', '31/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(440, 10, 23, 1, 26, 12, 2, 'Ampli lab Bahasa', '1', 'unit', 'Milik', '2017', '0', '0', '32/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(441, 10, 23, 1, 26, 3, 2, 'Meja Siswa', '20', 'unit', 'Milik', '2017', '0', '0', '33/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(442, 10, 23, 1, 26, 6, 2, 'Headphone 13', '1', 'unit', 'Milik', '2017', '0', '0', '34/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(443, 10, 23, 1, 26, 6, 2, 'Headphone 29', '1', 'unit', 'Milik', '2017', '0', '0', '35/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(444, 10, 23, 1, 26, 12, 2, 'Headphone 18', '1', 'unit', 'Milik', '2017', '0', '0', '36/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(445, 10, 23, 1, 26, 6, 2, 'Headphone 03', '1', 'unit', 'Milik', '2017', '0', '0', '37/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(446, 10, 23, 1, 26, 5, 2, '1 Set komputer + keyboard + Mouse', '1', 'unit', 'Milik', '2017', '0', '0', '38/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(447, 10, 23, 1, 26, 6, 2, 'Printer epson L120', '1', 'unit', 'Milik', '2017', '0', '0', '39/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(448, 10, 23, 1, 26, 7, 2, 'Sound System Polytron', '1', 'unit', 'Milik', '2021', '700000', '700000', '40/INV/BIDANG BLP/2021', 'Baru', 1, 27),
(449, 52, 54, 1, 39, 12, 2, 'Telepon PABX', '1', 'unit', 'Milik', '2013', '1500000', '1500000', '1/INV/DEWAN MASYAYIKH/2013', 'Baru', 1, 3),
(450, 10, 23, 1, 26, 5, 2, 'CPU DAZUMBA', '1', 'unit', 'Milik', '2017', '0', '0', '41/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(451, 10, 23, 1, 26, 5, 2, 'UPS APC', '1', 'unit', 'Milik', '2017', '0', '0', '42/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(452, 10, 23, 1, 26, 12, 2, 'VGA', '1', 'unit', 'Milik', '2017', '0', '0', '43/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(453, 10, 23, 1, 26, 12, 2, 'Touch Screen LCD', '1', 'unit', 'Milik', '2017', '0', '0', '44/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(454, 10, 23, 1, 26, 12, 2, 'Proyektor Benq', '1', 'unit', 'Milik', '2017', '0', '0', '45/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(455, 10, 23, 1, 26, 11, 2, 'Rak Buku', '1', 'unit', 'Milik', '2021', '0', '0', '46/INV/BIDANG BLP/2021', 'Baru', 1, 27),
(456, 10, 23, 1, 26, 2, 2, 'Kursi siswa Fa FUKUDA', '40', 'buah', 'Milik', '2017', '0', '0', '47/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(457, 10, 23, 1, 26, 3, 2, 'Kursi guru', '1', 'buah', 'Milik', '2017', '0', '0', '48/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(458, 10, 23, 1, 26, 3, 2, 'Meja guru', '1', 'buah', 'Milik', '2017', '0', '0', '49/INV/BIDANG BLP/2017', 'Baru', 1, 27),
(459, 10, 23, 1, 26, 3, 2, 'Meja komputer', '1', 'buah', 'Milik', '2022', '0', '0', '50/INV/BIDANG BLP/2022', 'Baru', 1, 27),
(460, 10, 23, 1, 26, 3, 2, 'Meja komputer', '1', 'buah', 'Milik', '2022', '0', '0', '51/INV/BIDANG BLP/2022', 'Baru', 1, 27),
(461, 6, 12, 1, 24, 4, 2, 'Filling Cabinet VIP 4 laci', '1', 'unit', 'Milik', '2012', '0', '0', '169/INV/KEUANGAN/2012', 'Baru', 1, 3),
(462, 6, 12, 1, 24, 3, 2, 'Meja Komputer', '2', 'unit', 'Milik', '2014', '0', '0', '170/INV/KEUANGAN/2014', 'Baru', 1, 3),
(463, 6, 12, 1, 24, 3, 2, 'Meja Pegawai', '4', 'unit', 'Milik', '2014', '0', '0', '171/INV/KEUANGAN/2014', 'Baru', 1, 3),
(464, 6, 12, 1, 24, 12, 2, 'Mesin Penghitung Uang', '1', 'unit', 'Milik', '2014', '0', '0', '172/INV/KEUANGAN/2014', 'Baru', 1, 3),
(465, 6, 12, 1, 24, 5, 2, 'komputer all in one', '4', 'unit', 'Milik', '2014', '0', '0', '173/INV/KEUANGAN/2014', 'Baru', 1, 3),
(466, 6, 12, 1, 24, 9, 2, 'Dispenser', '1', 'unit', 'Milik', '2014', '0', '0', '174/INV/KEUANGAN/2014', 'Baru', 1, 3),
(467, 6, 12, 1, 24, 13, 3, 'Kipas angin gantung', '1', 'unit', 'Milik', '2014', '0', '0', '175/INV/KEUANGAN/2014', 'Baru', 1, 3),
(468, 6, 12, 1, 24, 5, 2, 'Laptop', '1', 'unit', 'Milik', '2019', '0', '0', '176/INV/KEUANGAN/2019', 'Baru', 1, 3),
(469, 6, 12, 1, 24, 5, 2, 'Printer kasir epson', '1', 'unit', 'Milik', '2020', '0', '0', '177/INV/KEUANGAN/2020', 'Baru', 1, 3),
(470, 6, 12, 1, 24, 2, 2, 'kursi 036A', '4', 'unit', 'Milik', '2022', '0', '0', '178/INV/KEUANGAN/2022', 'Baru', 1, 3),
(471, 6, 12, 1, 24, 2, 2, 'kursi brother 106', '2', 'unit', 'Milik', '2022', '0', '0', '179/INV/KEUANGAN/2022', 'Baru', 1, 3),
(472, 6, 12, 1, 24, 4, 2, 'lemari arsip keuangan', '1', 'unit', 'Milik', '2022', '0', '0', '180/INV/KEUANGAN/2022', 'Baru', 1, 3),
(473, 6, 12, 1, 24, 11, 2, 'tangga rak keuangan', '1', 'unit', 'Milik', '2022', '0', '0', '181/INV/KEUANGAN/2022', 'Baru', 1, 3),
(474, 12, 27, 1, 25, 5, 2, 'Handphone Samsung A-14', '1', 'unit', 'Milik', '2023', '1800000', '1800000', '1/INV/KESEHATAN/2023', 'Baru', 1, 42),
(475, 12, 27, 1, 25, 13, 3, 'Freezer Box', '1', 'unit', 'Milik', '2023', '1850000', '1850000', '2/INV/KESEHATAN/2023', 'Baru', 1, 42),
(476, 12, 27, 1, 25, 4, 2, 'Lemari Besi Klinik', '1', 'unit', 'Milik', '2023', '2700000', '2700000', '3/INV/KESEHATAN/2023', 'Baru', 1, 42),
(477, 52, 54, 1, 39, 13, 3, 'AC daikin', '1', 'unit', 'Milik', '2019', '3500000', '3500000', '2/INV/DEWAN MASYAYIKH/2019', 'Baru', 1, 3),
(478, 52, 54, 1, 39, 13, 3, 'TV LG 42 inch', '1', 'unit', 'Milik', '2020', '3990000', '3990000', '3/INV/DEWAN MASYAYIKH/2020', 'Baru', 1, 3),
(479, 52, 54, 1, 39, 12, 2, 'Coffee maker Unakaffe', '1', 'unit', 'Milik', '2020', '1100000', '1100000', '4/INV/DEWAN MASYAYIKH/2020', 'Baru', 1, 3),
(480, 52, 54, 1, 39, 13, 3, 'Kulkas Sharp', '1', 'unit', 'Milik', '2020', '1700000', '1700000', '5/INV/DEWAN MASYAYIKH/2020', 'Baru', 1, 3),
(481, 52, 54, 1, 39, 2, 2, 'kursi JOGE', '2', 'unit', 'Milik', '2022', '600000', '1200000', '6/INV/DEWAN MASYAYIKH/2022', 'Baru', 1, 3),
(482, 52, 54, 1, 39, 14, 3, 'Brankas Dainichi', '1', 'unit', 'Milik', '2020', '7700000', '7700000', '7/INV/DEWAN MASYAYIKH/2020', 'Baru', 1, 3),
(483, 4, 36, 3, 43, 13, 3, 'AC Gree 1 pk', '1', 'unit', 'Milik', '2023', '4100000', '4100000', '25/INV/SMA/2023', 'Baru', 1, 60),
(484, 4, 36, 3, 43, 14, 3, 'Lemari Besi Importa', '1', 'unit', 'Milik', '2023', '3200000', '3200000', '26/INV/SMA/2023', 'Baru', 1, 60),
(485, 52, 54, 1, 39, 2, 2, 'Kursi Council Black', '10', 'unit', 'Milik', '2024', '1259000', '12590000', '8/INV/DEWAN MASYAYIKH/2024', 'Baru', 1, 3),
(486, 52, 54, 1, 39, 2, 2, 'Kursi putar Uzziel Managerial', '2', 'unit', 'Milik', '2024', '899000', '1798000', '9/INV/DEWAN MASYAYIKH/2024', 'Baru', 1, 3),
(487, 4, 37, 3, 37, 13, 3, 'AC Gree 1 pk', '2', 'unit', 'Milik', '2023', '4100000', '8200000', '27/INV/SMA/2023', 'Baru', 1, 85),
(488, 3, 39, 4, 38, 3, 2, 'Meja Magnus M-HWZ', '1', 'unit', 'Milik', '2022', '2800000', '2800000', '14/INV/SMK/2022', 'Baru', 1, 84),
(489, 3, 39, 4, 38, 3, 2, 'Meja Meeting', '1', 'unit', 'Milik', '2022', '4300000', '4300000', '15/INV/SMK/2022', 'Baru', 1, 84),
(490, 3, 39, 4, 38, 3, 2, 'Meja Podcast', '1', 'unit', 'Milik', '2022', '1165000', '1165000', '16/INV/SMK/2022', 'Baru', 1, 84),
(491, 3, 39, 4, 38, 5, 2, 'video recorder ezcap 275', '1', 'unit', 'Milik', '2022', '2860000', '2860000', '17/INV/SMK/2022', 'Baru', 1, 84),
(492, 3, 39, 4, 38, 5, 2, 'Video Mixer HDS 9125', '1', 'unit', 'Milik', '2022', '9100000', '9100000', '18/INV/SMK/2022', 'Baru', 1, 84),
(493, 3, 39, 4, 38, 5, 2, 'pentablet walcomm intuos', '1', 'unit', 'Milik', '2022', '1718250', '1718250', '19/INV/SMK/2022', 'Baru', 1, 84),
(494, 3, 39, 4, 38, 5, 2, 'pentablet walcomm one small', '5', 'unit', 'Milik', '2022', '777850', '3889250', '20/INV/SMK/2022', 'Baru', 1, 84),
(495, 3, 39, 4, 38, 8, 2, 'kamera panasonic', '1', 'unit', 'Milik', '2022', '26200000', '26200000', '21/INV/SMK/2022', 'Baru', 1, 84),
(496, 3, 39, 4, 38, 11, 2, 'sign papan akrilik SMK', '10', 'unit', 'Milik', '2022', '1531700', '15317000', '22/INV/SMK/2022', 'Baru', 1, 84),
(497, 3, 39, 4, 38, 13, 3, 'AC', '2', 'unit', 'Milik', '2022', '5000000', '10000000', '23/INV/SMK/2022', 'Baru', 1, 84),
(498, 10, 13, 1, 28, 3, 2, 'Meja Siswa', '72', 'unit', 'Milik', '2024', '200000', '14400000', '52/INV/BIDANG BLP/2024', 'Baru', 1, 133);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_jenis_aset`
--

CREATE TABLE `inventory_jenis_aset` (
  `id_jenis` int(11) NOT NULL,
  `kode_aset` varchar(6) NOT NULL,
  `jenis_aset` varchar(20) NOT NULL,
  `kelompok_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_jenis_aset`
--

INSERT INTO `inventory_jenis_aset` (`id_jenis`, `kode_aset`, `jenis_aset`, `kelompok_id`) VALUES
(2, 'A1', 'Kursi', 2),
(3, 'A2', 'Meja', 2),
(4, 'A3', 'Lemari', 2),
(5, 'A4', 'PC', 2),
(6, 'A5', 'Printer', 2),
(7, 'A6', 'Sound System', 2),
(8, 'A7', 'Kamera', 2),
(9, 'A8', 'Dispenser', 2),
(10, 'A9', 'Papan Tulis/Mading', 2),
(11, 'A10', 'Kayu/Plastik Lain', 2),
(12, 'A11', 'Elektronik Lain', 2),
(13, 'B1', 'Pendingin', 3),
(14, 'B2', 'Lemari Besi', 3),
(15, 'B3', 'Genset', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_kelompok_aset`
--

CREATE TABLE `inventory_kelompok_aset` (
  `id_kelompok` int(11) NOT NULL,
  `nama_kelompok` varchar(20) NOT NULL,
  `umur_aset` varchar(4) NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_kelompok_aset`
--

INSERT INTO `inventory_kelompok_aset` (`id_kelompok`, `nama_kelompok`, `umur_aset`, `ket`) VALUES
(2, 'Kelompok 1', '4', ''),
(3, 'Kelompok 2', '8', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_kondisi_aset`
--

CREATE TABLE `inventory_kondisi_aset` (
  `id_kondisi` int(11) NOT NULL,
  `aset_id` int(11) NOT NULL,
  `unit_kondisi_id` int(11) NOT NULL,
  `subunit_kondisi_id` int(11) NOT NULL,
  `pic_kondisi_id` int(11) NOT NULL,
  `tanggal_cek` varchar(20) NOT NULL,
  `kondisi_aset` varchar(20) NOT NULL,
  `ket_kondisi_aset` varchar(255) NOT NULL,
  `jumlah_aset_kondisi` varchar(5) NOT NULL,
  `aturan_edit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_kondisi_aset`
--

INSERT INTO `inventory_kondisi_aset` (`id_kondisi`, `aset_id`, `unit_kondisi_id`, `subunit_kondisi_id`, `pic_kondisi_id`, `tanggal_cek`, `kondisi_aset`, `ket_kondisi_aset`, `jumlah_aset_kondisi`, `aturan_edit`) VALUES
(2, 409, 10, 23, 27, '10/09/2024', 'Baik', 'Baik', '1', 0),
(8, 410, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(9, 411, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(10, 412, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(11, 413, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(12, 414, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(13, 415, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(14, 416, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(15, 417, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(16, 418, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(17, 419, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(18, 420, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(19, 421, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(20, 422, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(21, 423, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(22, 424, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(23, 425, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(24, 426, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(25, 427, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(26, 428, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(27, 429, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(28, 430, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(29, 431, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(30, 432, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(31, 433, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(32, 434, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(33, 435, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(34, 436, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(35, 437, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(36, 438, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(37, 439, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(38, 441, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '20', 0),
(42, 445, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(43, 446, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(44, 447, 10, 23, 27, '10/09/2024', 'Baik', 'baik', '1', 0),
(45, 404, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '2', 0),
(47, 406, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(48, 407, 6, 12, 3, '10/14/2024', 'Rusak Ringan', 'rusak tidak bisa dipakai menunggu perbaikan', '1', 0),
(49, 461, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(51, 462, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '2', 0),
(52, 463, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '4', 0),
(53, 464, 6, 12, 3, '10/14/2024', 'Rusak Berat', 'tidak bisa digunakan uang seling terselip', '1', 0),
(54, 465, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '4', 0),
(55, 466, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(56, 467, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(57, 468, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(58, 469, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(59, 470, 6, 12, 3, '10/14/2024', 'Rusak Berat', 'rusak', '2', 0),
(60, 471, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '2', 0),
(61, 472, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(62, 473, 6, 12, 3, '10/14/2024', 'Baik', 'baik', '1', 0),
(64, 498, 10, 13, 133, '07/20/2024', 'Baik', 'habis perbaikan', '72', 0),
(65, 440, 10, 23, 27, '10/01/2024', 'Rusak Berat', 'Sudah 3x mengalami kerusakan dan butuh perbaikan lagi', '1', 0),
(66, 453, 10, 23, 27, '07/02/2022', 'Rusak Ringan', 'Layar sentuh tidak berfungsi dengan baik', '1', 0),
(67, 442, 10, 23, 27, '10/01/2024', 'Rusak Ringan', 'Mic tidak berfungsi', '1', 0),
(68, 443, 10, 23, 27, '10/01/2024', 'Rusak Ringan', 'Mic tidak berfungsi', '1', 0),
(69, 444, 10, 23, 27, '10/01/2024', 'Rusak Ringan', 'Mic tidak berfungsi', '1', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_pembelian_atk`
--

CREATE TABLE `inventory_pembelian_atk` (
  `id_history_beli` int(11) NOT NULL,
  `beli_atk_id` int(11) NOT NULL,
  `jumlah_atk` varchar(10) NOT NULL,
  `satuan_atk_beli` varchar(20) NOT NULL,
  `harga_beli_atk` varchar(10) NOT NULL,
  `total_beli_atk` varchar(20) NOT NULL,
  `tanggal_beli` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_pengajuan_atk`
--

CREATE TABLE `inventory_pengajuan_atk` (
  `id_pengajuan` int(11) NOT NULL,
  `unit_pengajuan_id` int(11) NOT NULL,
  `atk_pengajuan_id` int(11) NOT NULL,
  `jumlah_pengajuan_atk` int(11) NOT NULL,
  `satuan_atk_pengajuan` varchar(20) NOT NULL,
  `harga_pengajuan_atk` varchar(10) NOT NULL,
  `total_pengajuan_atk` varchar(10) NOT NULL,
  `tanggal_pengajuan` varchar(20) NOT NULL,
  `tahun_pengajuan` varchar(5) NOT NULL,
  `status_pengajuan_atk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_pengambilan_atk`
--

CREATE TABLE `inventory_pengambilan_atk` (
  `id_pengambilan` int(11) NOT NULL,
  `unit_pengambilan_id` int(11) NOT NULL,
  `atk_pengambilan_id` int(11) NOT NULL,
  `jumlah_pengambilan_atk` varchar(10) NOT NULL,
  `satuan_atk_pengambilan` varchar(20) NOT NULL,
  `harga_pengambilan_atk` varchar(10) NOT NULL,
  `total_pengambilan_atk` varchar(10) NOT NULL,
  `tanggal_pengambilan` varchar(20) NOT NULL,
  `tahun_pengambilan` varchar(5) NOT NULL,
  `status_pengambilan_atk` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_pengguna`
--

CREATE TABLE `inventory_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pass_tampil` varchar(40) NOT NULL,
  `img` varchar(128) NOT NULL,
  `jabatan_pengguna` varchar(128) NOT NULL,
  `peran_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_pengguna`
--

INSERT INTO `inventory_pengguna` (`id_pengguna`, `nama`, `username`, `password`, `pass_tampil`, `img`, `jabatan_pengguna`, `peran_id`) VALUES
(1, 'Super Admin', 'adminbayhi', '$2y$10$MjuTq034SNwDHFPS4x0Sbu7zxEyo566tlVD9lOxgtG5AvMFqkBJSC', 'Luky1997.', '5856.jpg', 'IT BAYHI', 1),
(2, 'H. Ahmad Taufiq AR, M.Si', '11481003', '$2y$10$Cv8/u.EAwR1o5wFH1eR19eurzMz4iJ3lbR/FcIxnR4WY3.6pvn9QS', '11481003', '5856.jpg', 'KETUA UMUM / DIREKTUR OPERASIONAL', 10),
(3, 'Mashum As, S.Kom, S.Th.I', '12044044', '$2y$10$sPb0eKqRpKhxvHFVTElRo.r1ympp4a/svHDOuO7uOqZlnT7rMRnOW', '12044044', '5856.jpg', 'WAKIL KEPALA ADMINISTRASI KEUANGAN DAN KEPALA LAZIZWA', 5),
(4, 'H. M. Nailur Rochman, S.I.P', '11615011', '$2y$10$AWOUCJHZGR9bJBDSLtfBVem/fV83n210atw90So3sB7xKjpCau6uG', '11615011', '5856.jpg', 'SEKRETARIS UMUM / DIREKTUR PENDIDIKAN', 10),
(5, 'Hj. Widad Bariroh, S.Si', '13012073', '$2y$10$y0ttNVG1TwVpmNsS6iCw7OIFvfKDzbCIAhu2a42DHbtdcOXduHdWe', '13012073', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH / WADIR BIDANG PESANTREN', 10),
(6, 'Muhammad Subkhan, S.Th.I', '11485012', '$2y$10$9wZyOIfrhSaNw2QorJryE.dk4dEGfB.DjD2aWm4ip72dB.ZmExKtK', '11485012', '5856.jpg', 'KEPALA SEKOLAH SMA', 4),
(7, 'Muslikha, S. Psi', '11516025', '$2y$10$G09HcULtuR7Jib.t8fmcnucQXvr5KQvAoYxdkHBga9uAhwHTo1j5O', '11516025', '5856.jpg', 'KEPALA BK', 4),
(8, 'Imam Syafii, S.Pd', '13411059', '$2y$10$2vzHKxN70y.rHNzIdEGJn./DSn9x8cvH0xDxILxLfVW6KIGS8BQ6u', '13411059', '5856.jpg', 'KABAG. UMUM DAN KEPALA BIRO KEAMANAN', 4),
(9, 'Anik Ariami, S.Pd', '11615014', '$2y$10$FnKw5lHw9.PfuGmjQJKIwuWI.gxypXAHoOR/Q4eXsmmr97ILfo4ha', '11615014', '5856.jpg', 'KEPALA SEKOLAH SMA', 10),
(10, 'Bahrul ulum, M.si', '13976078', '$2y$10$xutv3KepHJn0edHWK6LZ9.KEt6sNcTX6Wfp34d.bV2gEKtW60Bo/G', '13976078', '5856.jpg', 'KEPALA HUMAS', 4),
(11, 'Fitri Kurnia, M. Pd', '12581047', '$2y$10$gnL2Zzd.i/HdHmTCqbFoquBPlcgPzrOXLTzX3y98avZnSiYisO5o2', '12581047', '5856.jpg', 'WADIR BIDANG OPERASIONAL / KEPALA HUMAN CAPITAL DEVELOPMENT', 4),
(12, 'Dwi Ismawati, SE', '12158045', '$2y$10$R4grJSLoq9aM24.UfElbNeCWtvbaD/Sa2Ba2GDT4p.yjq2eu7GTYy', '12158045', '5856.jpg', 'KEPALA KEUANGAN', 4),
(13, 'Aulia Marurin, M.Si', '11168013', '$2y$10$05CkRQf/FZKxCSpmK.1iIOkshdYlWTGS2zuhMci601.tcy3EJZm.W', '11168013', '5856.jpg', 'KEPALA BIDANG KESEHATAN', 4),
(14, 'Alfan Arifuddin, M.Si', '14385093', '$2y$10$wHOOGg5tehLTCW8hjeFwz.cQ1cVvqzCdrAm1xomlA8YgagzgFW8P6', '14385093', '5856.jpg', 'WAKIL KEPALA BK', 5),
(15, 'Bagus Purwanto, S.H', '14559102', '$2y$10$iJSq2qC4AlzWtn/5JUTPTOKlNljW3hpxlJR6n6ZQwkZzbjylCtI5a', '14559102', '5856.jpg', 'KEPALA BIDANG EKTRAKURIKULER DAN LOMBA', 10),
(16, 'Mukhammad Nurdin, M.Pd', '14385158', '$2y$10$lG/PRaGg5H5OoTp0RxjQL.Gdg5.ak8quMahksM.d3fjHC0oXplXMi', '14385158', '5856.jpg', 'KEPALA BAYHI LEARNING POIN (BLP)', 4),
(17, 'Uwais Alqoroni, S.Pd', '13958063', '$2y$10$taG4ZTroO800ZPrafz2h1.E/JOFbKNRnKhIoBgNW3VPBl/9owvU82', '13958063', '5856.jpg', 'STAFF BIRO KONSELING', 5),
(18, 'Dhonny Rabitha Achmadi, S.HI, SH', '17805213', '$2y$10$BjD1xcXXy1o2SZUL6Wx9VOASGSWv6H8qphD3iKmtcBYQnIkcFTorm', '17805213', '5856.jpg', 'KEPALA BTC', 4),
(19, 'Mahmud Zainal Abidin, M.BA', '11385008', '$2y$10$/x5Qah.V1X4qzrPGdgUhJeJGo/Ln5oF5YsNiswtKnq.xlr2g6n.1O', '11385008', '5856.jpg', 'KETUA LAZISWA', 10),
(20, 'Muhammad Makhrus, S.Pd', '96170049', '$2y$10$BPz0Q2BcRaK/pZkkpiHuROkSkbBUV/DIl8bQdzGrKE8xUKUSb6hzy', '96170049', '5856.jpg', 'KEPALA TPQ', 4),
(21, 'Luluk Mamluatus Sholihah,SS', '12616042', '$2y$10$wTPiQdXPlf3uKoFxXCpbC.v9kz.OXhFN/RAmMthr1Hp2aF0N1MKWC', '12616042', '5856.jpg', 'WAKIL KEPALA HCD', 10),
(22, 'Ratih Roudlotul Jannah, S. Pd', '11516026', '$2y$10$o5PiukY/4cGf7guh6wDIC.43x/TXiSguNbTZjDlYH8qaL2N3UCDKq', '11516026', '5856.jpg', 'WAKIL KEPALA SMP', 5),
(23, 'LUTFI ANSORI, S.Pd', '98110001', '$2y$10$UVLiEL.Vnn7wygEcegQDrOem60StTDKPeIu6uQOiVxiBvhxYi0t2C', '98110001', '5856.jpg', 'MANAJER KOPERASI', 10),
(24, 'Badrus Salam, S.Pd', '95140030', '$2y$10$IVqY4uDVJhimwfCyZY8rtO.9QwY1AbSoMtN8xTaSHxUrKKI9MfoHO', '95140030', '5856.jpg', 'KEPALA LAJNAH TAHFIDZUL QUR\'AN', 4),
(25, 'Abdul Kholik, S.Pd.I', '11988020', '$2y$10$8X78B7PilA6lYCCerUsUMOVIPs0xjSA1py3at5tKjXjBHlueLfPlm', '11988020', '5856.jpg', 'LURAH PESANTREN PUTRA', 4),
(26, 'Nidau Diana,S.Psi', '13151060', '$2y$10$EcK8IaKAs2zL48BR9G4rYOSjofsTjU.6QthnPBJxU1oZiegwvc0Fy', '13151060', '5856.jpg', 'WAKIL KEPALA BK', 10),
(27, 'Karimatul Latifa, S.Pd', '19030264', '$2y$10$ITpWgcrsDMIp57OtEAWlLOw.PTxZ5di6uG92yJGB22zy7uXxI0g6G', '19030264', '5856.jpg', 'STAF LABORATORIUM BAHASA', 5),
(28, 'Rifky Muzaki Nur Salim, S.Pd', '20100292', '$2y$10$VleDFNsP6uQk2lizxlljnO5/Vp7srRdSY6wElFu1TIVunmwPYBJ.6', '20100292', '5856.jpg', 'STAF IT', 10),
(29, 'M. Ibrahim', '96220125', '$2y$10$q3RuB9Bd2qyNErxOykaCi.uQQVlzt56fjdfQyuyQs2a9AhUYqYGpO', '96220125', '5856.jpg', 'MANAJER CATERING', 10),
(30, 'Mokhamat Ekhsan, S.Kom', '14215094', '$2y$10$4.ELWjn1jPScAZ7G6JmPSOIHpObh1OSEmuxxXR0qZ7TuQNcvOs0c2', '14215094', '5856.jpg', 'KEPALA SEKOLAH SMK', 4),
(31, 'Hj. Wardah Nafisah, S.Kep., MBA', '11719031', '$2y$10$1u4IkMl8FwHoMb.2ib5JgePjOECeinXO3KtOZE.PmQYj4WVHNgnZO', '11719031', '5856.jpg', 'DEWAN MASYAYIKH/KEPALA BLC', 10),
(32, 'M. Badru zaman', '11615039', '$2y$10$Nj9IUkjTcpIvFDlshUQABOvIKNcbNP8hs.u1FICOLCNpcx0b1TKlu', '11615039', '5856.jpg', 'KEPALA IT', 4),
(33, 'Yogi Adi Prasetyo, S.Pd', '13569089', '$2y$10$w8MykxkNIwUmYO.RSg.WNeShTO5D3e.3lIdum1gk4ajL/hKtmA5qy', '13569089', '5856.jpg', 'STAF PERPUSTAKAAN PUTRA', 5),
(34, 'Nasir, S.Pd', '14999106', '$2y$10$2kXpj7GQqsMj5LMkgJs4secMDxY8vPDqbenDb0e4rpxVOpgePMJf6', '14999106', '5856.jpg', 'STAF PELAPORAN BOS SMA', 10),
(35, 'Mohammad Ikhwan, S.Pd.I', '14685153', '$2y$10$LWM/p/dQ4NHK/Xf6io983OsNJS4wnl1Smv.I9gE7sCbOSsaZ.c0AO', '14685153', '5856.jpg', 'STAF PELAPORAN BOS', 10),
(36, 'Siti Fatimah, S.Pd', '15616161', '$2y$10$eT5dH2CwiVJxN/ZfqncK4uDeRk8wqbPipJfGuTaP6BUup6AkK.QCi', '15616161', '5856.jpg', 'STAF KASIR', 5),
(37, 'Ela Devi Arti, S.Pd', '15458166', '$2y$10$yIBswCoQd7EsqrYjEYcYVuZge7FgS/U6Y/iYLwP1GSGSEHhMOKegC', '15458166', '5856.jpg', 'STAF BK PESANTREN PUTRI', 5),
(38, 'Achmad Matlub', '15164174', '$2y$10$59NuyLbAZfYMfaDpwypW/.P65AYW4F1y3185Zo0gSZyBp3JmJAbOK', '15164174', '5856.jpg', 'STAF OPERASIONAL KENDARAAN', 5),
(39, 'Ayu Zahratul Husna, SE', '16092177', '$2y$10$vaU3adoGK9mESKdl46ad/eoUG9CAjB5bjiSKqsdxmFtcN8WlHS.dK', '16092177', '5856.jpg', 'STAF KEUANGAN PEMBANGUNAN', 3),
(40, 'Ade Riesma Kusumawardani, Amd. Kep', '16620188', '$2y$10$/Xveq68hdZ.3FnG.8F5Stu.yUvbfjKUL3rZJj9OXf86DqA01GmHBa', '16620188', '5856.jpg', 'STAF PERAWAT', 5),
(41, 'Triana Rahmawati, S.Pd', '17965217', '$2y$10$57o6wyzmLioQs.uXg9mzUu3Hc2U21ZeVV9CWEq/XiQ4BSxupjLV4q', '17965217', '5856.jpg', 'STAF LABORATORIUM MIPA', 5),
(42, 'Mudrikah Khasanah, A.Md. Kep', '17123222', '$2y$10$H7TDSZ.pbtZTqHvF3IeFYe4TK3..1FpRnZXSNEDgtFfyzulx8mdTq', '17123222', '5856.jpg', 'STAF PERAWAT', 5),
(43, 'M. Shofi\'uddin', '11385032', '$2y$10$ySJpg4ymzWo/kPCsILY4KeGP/s5t/NDxVFouGJzS197gnIN9m0Xau', '11385032', '5856.jpg', 'TAKMIR MASJID', 4),
(44, 'Khurotul A`yun', '14188188', '$2y$10$wQbW5YOKS.gPKOzc2c9TOuK0UvbOk.H2O9Y0vuf1B.4GAexMwCeje', '14188188', '5856.jpg', 'STAF PERPUSTAKAAN PUTRI', 5),
(45, 'Rizkiyatul Fitriyah', '18031229', '$2y$10$eeXyMdCdkXegeh7yQ6uQ0OSj6AbioofEDPP4R3hVglf4EB1gM7XRG', '18031229', '5856.jpg', 'STAF TU PESANTREN PUTRI', 5),
(46, 'Muchammad Yasin', '18100249', '$2y$10$4QKUgVT8ud/EB/1x1RJ2ouZaEBFxCMHyQPR9hkk7FPGbWq3ZnF9Cm', '18100249', '5856.jpg', 'STAF OPERASIONAL KENDARAAN', 5),
(47, 'Novita Maulidia, A.Md', '18110250', '$2y$10$56BqPzBEt9q4JXRcOFnu6eVF800fLloEo7b.YIn3ziKGT/ELeQ5ja', '18110250', '5856.jpg', 'STAF AKUNTAN', 5),
(48, 'Muhammad Nur Zaini', '19070270', '$2y$10$l3asKaG1dKMSVyi94OCBOuzAVFtzfE91rkIWKFwVjuukeZl7Lbaj2', '19070270', '5856.jpg', 'STAF HUMAS BIDANG DESAIN', 5),
(49, 'Pratiwi Retno Wigati, S.Kom', '20100283', '$2y$10$f6zIOP9oosk6ZjlXnIAOBePUklTNuScAbY.96rS27macYAPFJioda', '20100283', '5856.jpg', 'STAF HUMAS BIDANG RECEPTIONIS', 5),
(50, 'Achmad Maulana Hidayat', '21060296', '$2y$10$JjSvSxXbWGWaEL/R/CTmX.v4skW0xtFRqtWCqbeoNpOk55WhRStrK', '21060296', '5856.jpg', 'AL-MUSYRIF KEPALA PROGRAM QS', 10),
(51, 'Nikmatul Wafiroh', '21060295', '$2y$10$praQG3UhLFV6Odl1ltjOGODUXo9NxNpjyzZQd5rdo2ewLd45VxaUm', '21060295', '5856.jpg', 'LURAH PESANTREN PUTRI', 4),
(52, 'Hassan As\'ari, S.Pd', '20100291', '$2y$10$wSGW2fzi.spy12zvkHChM.rkpuBg0m3lD9PiRx.2T/Cy/mO99nBfK', '20100291', '5856.jpg', 'STAF BK PESANTREN PUTRA', 5),
(53, 'Noer Laily Maulidia, S.Pd', '21090297', '$2y$10$hlkzzOUvvh7EVHh55Nq3gO0Ka1XNxLt3oKQgzqrP/9TVjVQNY8x/a', '21090297', '5856.jpg', 'STAF HCD', 5),
(54, 'Muhammad Aldillah Akbar, S.Akun', '21090300', '$2y$10$b6xS2DnZ8z8HHtVwgFuD1.VExpg.8mPa5tpV681KlkqwE53MgCCJW', '21090300', '5856.jpg', 'STAF AKUNTAN', 2),
(55, 'Anisatul Qolbiyah, S.SD', '21090304', '$2y$10$SVsbM3is1h.HQ47nYIWBg.EGfPmXKcZ5AMpXUUpGvFWucuhBbrAg6', '21090304', '5856.jpg', 'STAF HUMAS BIDANG CONTENT CREATOR', 5),
(56, 'Ainiyatul Fitriyah, SS', '11861027', '$2y$10$RGBTlgwGjUcf5nkuL.yvu.vCSUxLxwaishMFshoCAQH8saidKaq8i', '11861027', '5856.jpg', 'KEPALA TU SMK', 4),
(57, 'Indah Tri Estanty, S.Pd', '11616023', '$2y$10$fi/GJHXh0GHofdT75PJeK.zOKmY2LpzF2DwdTTmYpVsOmZW6M9Ogu', '11616023', '5856.jpg', 'STAF KEPALA TU SMP', 4),
(58, 'Chairul Foundra Syahbana, S. Pd', '13341061', '$2y$10$O8.x5WIG49FFj9G2IFwNJOYXTM5QfWlgZtWmQRtht.DdDqmK.l1dG', '13341061', '5856.jpg', 'STAF TU SMP DAN OPERATOR DAPODIK', 10),
(59, 'Masruhin, S.Pd.I', '14888107', '$2y$10$1cX0P.TLZd2Qx943uJBCW.3Gjw3jwXyB2gLH9sL.bbr8lDQDFtV4K', '14888107', '5856.jpg', 'KEPALA TU SMA', 4),
(60, 'Layla Ulfa Famelia, S.Pd', '15981160', '$2y$10$Pf5tC371gnSdcCEVKPuTGuaQcwl9efBfaPA7Kqf.WPIm7YzBg/WBi', '15981160', '5856.jpg', 'STAF TU SMA', 5),
(61, 'Rini Kurniawati, S.A.B', '21090299', '$2y$10$zRII1O1T/lJznqdLdtb4aeimRMIRGYFZV95cRVJ.MHSRag8LQvZA.', '21090299', '5856.jpg', 'STAF TU SMP', 5),
(62, 'Rosul, S.Pd.I', '98110003', '$2y$10$pqDHhxLfXTGHaCO18JiY4.dtxRcu0MCZF2S6C39ap/hwmnVuCHGha', '98110003', '5856.jpg', 'KEPALA MADIN', 4),
(63, 'Muhammad Imron Hamzah', '98190064', '$2y$10$kZqvirEzOhDX3yR2OkTPWeXtYmnLsz15q4v62FXCy4uZRiAU23YrC', '98190064', '5856.jpg', 'KEPALA PENJURUSAN KITAB', 10),
(64, 'TAKMIR MASJID', '22042701', '$2y$10$wufT7YDIYs.xPhM3xiyD8.4zzvOEbFvtq5haHNH7nCeTrLVKpT2iO', '22042701', '5856.jpg', 'TAKMIR MASJID', 10),
(65, 'Muhammad Subkhan, S.Th.I', '11485012A', '$2y$10$jVrZhm48f7fSGTPOlxNThehCdQj.ZsiPNRpJwQmX1emwxYDKmOkoy', '11485012A', '5856.jpg', 'KEPALA DATA KERJASAMA DAN ALUMNI', 4),
(66, 'Gus Abdul Mukthi Chifdhi, S.ST', '22020272', '$2y$10$.Irr9nP04VTR5kHnAr1pZet45V1bzzOWXQgdBXEcTPEnZVCTLNr42', '22020272', '5856.jpg', 'DEPUTI BIDANG PEMBANGUNAN DAN PENGHIJAUAN', 10),
(67, 'Muchammad Yasin', '17100249', '$2y$10$aUUWmskljV3Ym8dzG37JZe35okYQt4hKYu1jZTWpHBC1FPfflW1ZC', '17100249', '5856.jpg', 'BENDAHARA PESANTREN', 10),
(68, 'Karimatul Latifa, S.Pd', '15030264', '$2y$10$8OmIGscFuIioDQhkgWQxTOMD3q7PucIxAH1BrNp34EFDmjKLKIc.6', '15030264', '5856.jpg', 'SEKRETARIS BLC', 10),
(69, 'Nasir, S.Pd', '18999106', '$2y$10$fNHQzJHMR0dyKUagjqNWneJWaeGLkG8Chyp4vVF2brse8OFwFuoTa', '18999106', '5856.jpg', 'STAF PELAPORAN BOS SMK', 10),
(70, 'Nasir, S.Pd', '21999106', '$2y$10$xJRcJoLpgEDIPwKjQupF/OifxBboO1uBxUQmnY0RRBeYNCuURblea', '21999106', '5856.jpg', 'STAF LABORATORIUM KOMPUTER', 10),
(71, 'Nur Faizah, S.Kom', '11556022', '$2y$10$mOn7GJ9Y5LAN6uAkNHyviu.SeYORL0V2lughdURECZFXmvytQncpi', '11556022', '5856.jpg', 'KOORDINATOR TEAM TEACHING IT', 10),
(72, 'Catur Dina Rahayu, S.TP', '11148016', '$2y$10$m/HfRvXoxWq/1MOLQKTj5..jOPYINBqVkGXdHu3jL/1JcQPrO4TpS', '11148016', '5856.jpg', 'KEPALA SEKOLAH SMP', 4),
(73, 'Dinatur Rohmatika, S.Si', '22050318', '$2y$10$9.Nz2DfSicLQAyf0vGLxTeP2.2zEpjQz.g3mgxBskIVzZIxOdHkWq', '22050318', '5856.jpg', 'PJS KEDISIPLINAN PESANTREN PUTRI', 10),
(74, 'Nabila Sakinah, S.H', '22050319', '$2y$10$OMlmhGHrHkzJNtbj4X8uZOz0ROMsrzYmVMA/Cp6.LtfObcnpFTDHi', '22050319', '5856.jpg', 'Al-Musyrifah Program QS', 10),
(75, 'Rachmat Hidayah, S.Kom', '22060320', '$2y$10$E1.JDTMoCQdCfHcxnIMcc.Atktc8knWtHskqHMXOPi3Z9/ygCEkoy', '22060320', '5856.jpg', 'Staf IT dan Maintenance', 5),
(76, 'Imam Syafii, S.Pd', '13411059A', '$2y$10$8S/0C0GZLBcLW8/mFjrq2uVU32zaykjeIbJFTZ4xPPjlnygqjmjO.', '13411059A', '5856.jpg', 'KEPALA BIRO KEAMANAN', 10),
(77, 'Abdul Kholik, S.Pd.I', '11988020A', '$2y$10$9L7MP1sApkuISRHCIKF38uzHp7oPuU2oJaGZIkMj/k.twaijgI2zK', '11988020A', '5856.jpg', 'KEPALA KANTIN', 10),
(78, 'Amim Arina Fitria, S.Si', '14481157', '$2y$10$C81SktNYVH6GBsya6QbJzOH3.MdE0a3GPrcbfXxmt3xgzRFF/Qtx2', '14481157', '5856.jpg', 'WAKIL KEPALA HCD', 5),
(79, 'dr. Rika Maryam Susilawati', '14158104', '$2y$10$kxCUYCwaJMNO0Vlk.gPBe.IfheTxQsqf4TkyU6Y4brPzy3wfIpDdW', '14158104', '5856.jpg', 'DOKTER PJ KLINIK', 4),
(80, 'Ning Najihah', '11816036', '$2y$10$1P93GcoDMAlsNNd117m/guGaUmvma5T6Rudao87dN.ZQ0kb4drZDq', '11816036', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH / KOORDINATOR PESANTREN QS', 10),
(81, 'Iffatun Nisa, S.Pd', '14821103', '$2y$10$4Ry29flbbb39ZVYfiJRqdesJ.CapSV82.cvMVhV4GkLdu9YUf3SLK', '14821103', '5856.jpg', 'Ketua Majelis Pembina Organisasi Santri', 4),
(82, 'Alfarabi Shidqi Ahmadi, S.Pd', '94200118', '$2y$10$rkEGaCVyXyYXceCMVrHwn.KzMWZBC6G0XJXlc96FzJfov.KAtDhbK', '94200118', '5856.jpg', 'KEPALA BLC', 4),
(83, 'Khurin In, S.Pd', '98120007', '$2y$10$gX3dR8DBn6zwAmDXWfD9muYXs9kFYNVh7HP5FZhjAhOFJ9NTTh8aO', '98120007', '5856.jpg', 'KEPALA MADIN PUTRI', 4),
(84, 'Yudha Prihantanto,S.Pd', '13559090', '$2y$10$A2WIAevEfKnCbknuSQkbXestdVv7VREWL6uvo74DXpX7CLt1tNOEC', '13559090', '5856.jpg', 'WAKIL KEPALA SMK', 5),
(85, 'Agus Susanto, S.Pd., M.Pd', '17120225', '$2y$10$gASGh.ZA8ul0i.f662TAceVZz1Gy5QCDnVq56BphPpE7BPcgIsgpW', '17120225', '5856.jpg', 'WAKIL KEPALA SMA', 5),
(86, 'M. Nasihul Ulum', '96220126', '$2y$10$a7IKLdDmK3dyfdqkvQ9dhuOymIPjxKa7HBKaWK4BgDAoY9gkQYXDu', '96220126', '5856.jpg', 'PJS KEDISIPLINAN PESANTREN PUTRA', 10),
(87, 'Hairul Anam', '96220127', '$2y$10$S.bWkqfIfXghU4jzB7NQeuz/gNLOkA2KGZOLLf6JQ7v/8aV6K5Ob2', '96220127', '5856.jpg', 'Manajer Laundry', 10),
(88, 'Bahrul ulum, M.si', '13976078A', '$2y$10$ROdDhXqZZEykVMPpIraUZurHzxx3HSkEklwMTm7geenwP7RuvR73S', '13976078A', '5856.jpg', 'WADIR BIDANG USAHA', 10),
(89, 'KH. M. Idris Chamid, Lc', '10000001', '$2y$10$IHO.P41.XG.2q9qFYGWyRudt18vDN9STH7QQ2HQkh/Xrpll3PjmcW', '10000001', '5856.jpg', 'PENGASUH', 10),
(90, 'Ibu Nyai Hj. Kuni Zakiyah, S.Th.I', '10000002', '$2y$10$jZ.05MQAb.XTOIMajRXw1.Uj4gihrI3OzR/wGg2H3zTTvvB/N2Iea', '10000002', '5856.jpg', 'PENGASUH', 10),
(91, 'H. Abdul Rozaq, S.Pd', '10000003', '$2y$10$8vSXAiI5jt456BVq0kevOOBCVM9npWqcZ2tRsv8Ii60T/aZMDEHy2', '10000003', '5856.jpg', 'BENDAHARA UMUM', 10),
(92, 'Ning Hj. Maryam Luailik, S.Psi', '10000005', '$2y$10$yWfB.gLS4RbHjPOTAGDNn.QPCDyMqDNtIPyuEplzrKzNQT6lJ6UzO', '10000005', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH / WADIR BIDANG PENGEMBANGAN', 10),
(93, 'Gus dr. H. Mufti Aimah Nurul Anam', '10000010', '$2y$10$.uyMM7k8Z9DP9ecVf6Jjnet0gOMmVFbSO5.t8t6Uh7lt9hG.g/3dS', '10000010', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH / WADIR BIDANG PEMBANGUNAN DAN LINGKUNGAN', 10),
(94, 'Gus Dr. H. Misbahul Munir, SH, M.Ag', '10000009', '$2y$10$bcpTiVW6ICmwT/qEE.LQ0uKTdq.ZHqjreTQKkXFfEKD1iMAZ14M92', '10000009', '5856.jpg', 'KETUA YAYASAN / WADIR BIDANG PELAYANAN', 10),
(95, 'Ning Hj. Wardah Nafisah, S.Kep., MBA', '10000008', '$2y$10$CRhx6E6yOgAJioCTUWaFJe9RbzrVx51W4fwqsMblf8N/kb3IN9D5u', '10000008', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH / DIREKTUR USAHA DAN PEMBANGUNAN', 10),
(96, 'Gus Abdul Aziz, S.Pd', '10000007', '$2y$10$AzQ1l2VVB5YeRMBzkxp0fO4uvcqL8.MgAhTKJ3mRJCiJ6oXdB1GiO', '10000007', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH / DIREKTUR KEAMANAN', 10),
(97, 'Gus H. Abu Yazid, MA', '10000006', '$2y$10$lSayqCrCldytR6VND9WsMuy9PYuZURz00Hem/FL6WsG7RPGwoJnMy', '10000006', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH / WADIR BIDANG PENDIDIKAN DINIYAH', 10),
(98, 'Gus Ahmad Uwais', '10000004', '$2y$10$9CWRM8urrQiu3vAzauNxNexqnUJ3lEH9rmgxFvuVdpjvYP9.pNJJm', '10000004', '5856.jpg', 'ANGGOTA DEWAN MASYAYIKH', 10),
(99, 'Aminulloh', '23010322', '$2y$10$dPhUwdGHAOzCCs6HzmiICu1Hd6VBJVDvCrTwXBFZ17murRTXv8WaW', '23010322', '5856.jpg', 'STAF CHECKER', 5),
(100, 'Rifki Rozali', '23010323', '$2y$10$.YpzjFOKLxDsdbfX2QuW..t/k8y4v7jT8CDuJ9h7houxeprr3BOL6', '23010323', '5856.jpg', 'STAF KEDISIPLINAN PUTRA', 5),
(101, 'Mamlu\'atul Marchamah, M. Stat', '23010324', '$2y$10$2DRfUAm4Qz9cb4pWD01fYO5KG.iz3Rx7e4niyHRwVEbsS490r7dx2', '23010324', '5856.jpg', 'STAF DATA ANALIS (DKA)', 5),
(102, 'Moch. Syarkhi Shodri', '23010326', '$2y$10$DkvqhYAKvHwggnaGt9dOOuTWmYCUTch41XvalfHbzr56NfZFaCsee', '23010326', '5856.jpg', 'STAF TU PESANTREN PUTRA', 5),
(103, 'Maili Launa Tayiba, S. E', '23010325', '$2y$10$Q/7ibieYbRni8pT/OVKoIe8Zf73/fdxkX.KcpsuFhcwjy41AxtFam', '23010325', '5856.jpg', 'STAF', 10),
(104, 'Muhammad Yusuf Muzakki, S.Psi', '20100288', '$2y$10$vm5i2NJ5VOJU4mKjxc0VuOZVIuYzM/4pb5JqkYe2RN.ZV.D2pFKGm', '20100288', '5856.jpg', 'STAF ADMINISTRASI KEDISIPLINAN', 5),
(105, 'M. Nasihul Ulum', '23060328', '$2y$10$e2znGrokPDhWIV/VwVqT8u/pv2y8gMNSe3fws3cvtbxdxA9DWaTFa', '23060328', '5856.jpg', 'STAF', 5),
(106, 'Anastasya Rif\'atul Ainuriyah, S. Sos', '23060329', '$2y$10$hiuggtd0P9vg19oQy9KOKO8YSihtl4l1DBsaxox6hwkbwccpLYgbi', '23060329', '5856.jpg', 'STAF BK', 5),
(107, 'Meidina Nur Nabilah, S. M', '23060330', '$2y$10$p0Hmrz9MF.r4Hy67OAlnb.JsVVeoHFO34V1DDgyciNdbJ9VImhCy.', '23060330', '5856.jpg', 'STAF', 10),
(108, 'Afni Nahdhiya Damayanti, S.Kep., Ns', '23060332', '$2y$10$uXA9cLrPxzmsAZC8PH9ATe5UyI1hqFdxQjYmnuwlQAAbo62piQE3a', '23060332', '5856.jpg', 'STAF PERAWAT', 5),
(109, 'Muchammad Maulana Iqbal, Amd Kep', '23060336', '$2y$10$ymJP5xp4bSszht1yBdkXyegE1u/6OFhWuDSS83xM/4X7Qkx1sdeaO', '23060336', '5856.jpg', 'STAF PERAWAT', 5),
(110, 'Mohammad Khusnul Chuluq, S.Kom', '23060335', '$2y$10$ZyTpI.OoHLf.NEB7KgyA/OMy0AABaQ4LtUY6l/xnE444WJ8p2BA4q', '23060335', '5856.jpg', 'STAF IT', 5),
(111, 'Ayu Zahratul Husna, SE', '16092177_aset', '$2y$10$TL0emYijzhfCy0hbVg9uWe4khzRYt539F23bvhIIHSLXn4g1pkAPW', '16092177_aset', '5856.jpg', 'STAF KEUANGAN PEMBANGUNAN', 2),
(112, 'Ayu Zahratul Husna, SE', '16092177_pic', '$2y$10$84t365liUaSRXb67O8GZnuG68WChSIp0JfVZr/icKuEZfZH1FjPUi', '16092177_pic', '5856.jpg', 'PIC Ruangan', 5),
(113, 'Muhammad Subkhan, S.Th.I', '11485012_pic', '$2y$10$FKOVLChcyPbsbDzwoxHhPuZcLDbD3s3MpgoKfKoQbdcV3uaNpfvWm', '11485012_pic', '5856.jpg', 'PIC Ruangan SMA', 5),
(114, 'Mokhamat Ekhsan, S.Kom', '14215094_pic', '$2y$10$wVTyulpvn7PY1Ny3wqItde9Upj9MUwbdc7/jtqy7pOO.K2UakHb/S', '14215094_pic', '5856.jpg', 'PIC Ruangan', 5),
(115, 'Catur Dina Rahayu, S.TP', '11148016_pic', '$2y$10$acJFmrqPaKD7p3i.AIIqLOmmuYSRIBiPlYi.lOZCvN3ULnBQBZgYS', '11148016_pic', '5856.jpg', 'PIC Ruangan', 5),
(116, 'Nuriyah Sulkha, S. Si', '23070340', '$2y$10$1HdJyTJzf/Y0OHuRXWby1uXH9baH6DdpVyMTuEFqjJPehxF5LeRle', '23070340', '5856.jpg', 'STAF LABORATORIUM MIPA', 5),
(117, 'Aqidatul Mujaddidah, S.Pd', '23070342', '$2y$10$rL.LCIlTpP.prEPq9b67rePIQYjtp7dbYSs0qFfSUO2IOz78428Pe', '23070342', '5856.jpg', 'STAFF BLC', 5),
(118, 'Dhonny Rabitha Achmadi, S.HI, SH', '17805213_pic', '$2y$10$YQf3Y2AIkkNJU0bofgsZxuOI5FqkhXNqunG9yIYSalqZjHoGbQ11W', '17805213_pic', '5856.jpg', 'PIC Ruangan', 5),
(119, 'Iffatun Nisa, S.Pd', '14821103_pic', '$2y$10$G1IPcDhZiNbcErbR/DyZX.lzmIU0xXcW5gg4qKWNwoktyp3lhOdu.', '14821103_pic', '5856.jpg', 'PIC Ruangan', 5),
(120, 'Rosul, S.Pd.I', '98110003_pic', '$2y$10$ACQ26KDrS6sKjcZ87iqfHuKjy4QoYEkQgfyqwYLWlGiqtbgRRJDRO', '98110003_pic', '5856.jpg', 'PIC Ruangan', 5),
(121, 'Khurin In, S.Pd', '98120007_pic', '$2y$10$ZOzLzEPykd/aD1jorsiWiO2TBBSbDLYy8uCqKd6HAYONVYjfImFf.', '98120007_pic', '5856.jpg', 'PIC Ruangan', 5),
(122, 'Puspitaningrum, S. H. I', '18071231', '$2y$10$Uo6kqOIEFMns/lcL3SReO..V38JwHqQ5fpZnR3ZL.p/J7WhHq9EqG', '18071231', '5856.jpg', 'KEPALAS BIRO KEDISIPLINAN', 4),
(123, 'Much. Yazid Al Busthomi', '17122221', '$2y$10$eNNVpC4ZZcIstdre5oKIo.qatFoYtDGwVGgh6Pv5wopV7zkqFrIR2', '17122221', '5856.jpg', 'STAF OPERASIONAL KENDARAAN', 5),
(124, 'Wardatul Baidhok, S.Pd', '13698057', '$2y$10$FyMwL10//OdVNebdvow1K.tIpH7RheOmGxgJY5BgPIeHsiBWu4SwK', '13698057', '5856.jpg', 'KEPALA QC', 4),
(125, 'Syahril Rahmatulloh', '24010352', '$2y$10$lQf5ecSDGPlNYJe/OxfezehP4tY.X0FZJEIKIhE8CYKGrFRXRdOTm', '24010352', '5856.jpg', 'STAF HUMAS DKA', 5),
(126, 'test', 'oke', '$2y$10$qgI3XYBIAZG9JMNJgUaB6.019sE2JQwnjXsCYmPo79hCmrezJM3hO', 'Daprilian31', '5856.jpg', 'test', 0),
(133, 'Karimatul Latifa, S.Pd', '19030264_2', '$2y$10$sCEIymT88OPbNyngckWlpOZPJrFACp/SxnLwjZi4ccslVC.wvxjGC', '19030264_2', '5856.jpg', 'STAFF LAB KOM PUTRA', 5),
(134, 'Aldi Administrator', 'aldikeren', '$2y$10$JII5v87fz2tEMHHJT9nZouYq7ThKh48r0yJyzlN93wjmj3kr7U2zG', 'aldikeren', '5856.jpg', 'Staff Keuangan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_peran_pengguna`
--

CREATE TABLE `inventory_peran_pengguna` (
  `id_peran` int(11) NOT NULL,
  `peran` varchar(40) NOT NULL,
  `ket_peran` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_peran_pengguna`
--

INSERT INTO `inventory_peran_pengguna` (`id_peran`, `peran`, `ket_peran`) VALUES
(1, 'admin', 'Administrator'),
(2, 'aset', 'Admin Aset'),
(3, 'atk', 'Admin ATK'),
(4, 'unit', 'Admin Unit'),
(5, 'subunit', 'Admin Sub Unit'),
(10, 'kosong', 'Kosong');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_riwayat_aset`
--

CREATE TABLE `inventory_riwayat_aset` (
  `id_riwayat` int(11) NOT NULL,
  `pic_id` int(11) NOT NULL,
  `status_aset` varchar(20) NOT NULL,
  `ket_riwayat` varchar(255) NOT NULL,
  `riwayat_lokasi_aset_id` int(11) NOT NULL,
  `tanggal_riwayat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_ruang`
--

CREATE TABLE `inventory_ruang` (
  `id_ruang` int(11) NOT NULL,
  `nama_ruang` varchar(50) NOT NULL,
  `ket_ruang` varchar(60) NOT NULL,
  `gedung_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_ruang`
--

INSERT INTO `inventory_ruang` (`id_ruang`, `nama_ruang`, `ket_ruang`, `gedung_id`) VALUES
(1, 'RUANG RAPAT', '', 0),
(4, 'Asrama A', '', 5),
(5, 'Asrama B', '', 5),
(6, 'Asrama C', '', 5),
(7, 'Asrama D', '', 5),
(8, 'Asrama E', '', 5),
(10, 'Asrama F', '', 5),
(11, 'Asrama G', '', 5),
(12, 'Asrama H', '', 5),
(13, 'BK', '', 1),
(14, 'BLC', '', 1),
(15, 'Food Court', '', 1),
(16, 'Gudang CS', '', 1),
(17, 'Kantor Madin', '', 5),
(18, 'Kantor Staf Yayasan', '', 1),
(19, 'Ruang Kelas SMP', '', 2),
(20, 'Ruang Kelas SMA', '', 3),
(21, 'Ruang Kelas SMK', '', 4),
(22, 'Kemenpera PA', '', 5),
(23, 'Kemenpera PI', '', 5),
(24, 'Keuangan', '', 1),
(25, 'Klinik', '', 1),
(26, 'Lab Bahasa', '', 1),
(27, 'Lab IPA', '', 1),
(28, 'Lab Komputer PA', '', 1),
(29, 'Lobby Yayasan', '', 1),
(30, 'LTQ', '', 5),
(31, 'Masjid PA', '', 1),
(32, 'Masjid PI', '', 1),
(33, 'Pantry', '', 1),
(34, 'Perpustakaan PA', '', 1),
(35, 'Perpustakaan PI', '', 1),
(36, 'Kantor SMP', '', 2),
(37, 'Kantor SMA', '', 3),
(38, 'Kantor SMK', '', 4),
(39, 'Kantor Dewan Masyayih', '', 1),
(40, 'Server', '', 1),
(41, 'Rapat Pimpinan', '', 1),
(42, 'Kantor TU SMP', '', 2),
(43, 'Kantor TU SMA', '', 3),
(44, 'Kantor TU SMK', '', 4),
(45, 'Rumah Kayu', '', 5),
(46, 'Aula', '', 1),
(47, 'Lab Komputer PI', '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_sub_unit`
--

CREATE TABLE `inventory_sub_unit` (
  `id_sub_unit` int(11) NOT NULL,
  `gedung_sub_unit_id` int(11) NOT NULL,
  `ruang_sub_unit_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `subunit_pic_id` int(11) NOT NULL,
  `nama_sub_unit` varchar(100) NOT NULL,
  `ket_sub_unit` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_sub_unit`
--

INSERT INTO `inventory_sub_unit` (`id_sub_unit`, `gedung_sub_unit_id`, `ruang_sub_unit_id`, `unit_id`, `subunit_pic_id`, `nama_sub_unit`, `ket_sub_unit`) VALUES
(11, 1, 16, 37, 99, 'sub gudang cs', ''),
(12, 1, 24, 6, 3, 'sub keuangan', ''),
(13, 1, 28, 10, 133, 'sub lab komputer', ''),
(14, 1, 32, 54, 106, 'sub masjid pi', ''),
(15, 1, 40, 31, 110, 'sub server', ''),
(16, 1, 15, 1, 112, 'sub food court', ''),
(17, 1, 27, 10, 41, 'sub lab ipa', ''),
(18, 1, 31, 23, 52, 'sub masjid pa', ''),
(19, 1, 35, 10, 44, 'sub perpustakaan pi', ''),
(21, 1, 14, 15, 117, 'sub blc', ''),
(22, 1, 18, 32, 53, 'sub kantor staf yayasan', ''),
(23, 1, 26, 10, 27, 'sub lab bahasa', ''),
(24, 1, 34, 10, 33, 'sub perpustakaan pa', ''),
(25, 1, 46, 37, 99, 'sub aula', ''),
(26, 1, 13, 13, 14, 'sub bk', ''),
(27, 1, 25, 12, 42, 'sub klinik', ''),
(28, 1, 29, 11, 49, 'sub lobby', ''),
(29, 1, 33, 37, 99, 'sub pantry', ''),
(31, 1, 41, 37, 99, 'sub rapim', ''),
(32, 2, 36, 2, 61, 'sub kantor smp', ''),
(33, 2, 19, 2, 22, 'sub ruang kelas smp', ''),
(34, 2, 42, 2, 61, 'sub tu smp', ''),
(35, 3, 20, 4, 85, 'sub ruang kelas sma', ''),
(36, 3, 43, 4, 60, 'sub kantor tu sma', ''),
(37, 3, 37, 4, 85, 'sub kantor sma', ''),
(38, 4, 44, 3, 84, 'sub kantor tu smk', ''),
(39, 4, 38, 3, 84, 'sub kantor smk', ''),
(40, 4, 21, 3, 84, 'sub ruang kelas smk', ''),
(41, 5, 4, 1, 102, 'sub asrama a', ''),
(42, 5, 5, 54, 45, 'sub asrama b', ''),
(43, 5, 6, 1, 102, 'sub asrama c', ''),
(44, 5, 7, 54, 45, 'sub asrama d', ''),
(45, 5, 9, 1, 102, 'sub asrama e', ''),
(46, 5, 10, 54, 45, 'sub asrama f', ''),
(47, 5, 11, 1, 102, 'sub asrama g', ''),
(48, 5, 12, 54, 45, 'sub asrama h', ''),
(49, 5, 22, 1, 52, 'sub kemenpera pa', ''),
(50, 5, 23, 54, 45, 'sub kemenpera pi', ''),
(51, 5, 30, 17, 53, 'sub ltq', ''),
(52, 5, 17, 8, 53, 'sub kantor madin', ''),
(53, 5, 45, 1, 102, 'sub rumah kayu', ''),
(54, 1, 39, 52, 3, 'Sub Unit Dewan Masyayikh', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_unit`
--

CREATE TABLE `inventory_unit` (
  `id_unit` int(11) NOT NULL,
  `gedung_unit_id` int(11) NOT NULL,
  `nama_unit` varchar(100) NOT NULL,
  `kepala_unit_id` int(11) NOT NULL,
  `sarpras_unit_id` int(11) NOT NULL,
  `status_pengajuan` varchar(20) NOT NULL,
  `status_pengambilan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_unit`
--

INSERT INTO `inventory_unit` (`id_unit`, `gedung_unit_id`, `nama_unit`, `kepala_unit_id`, `sarpras_unit_id`, `status_pengajuan`, `status_pengambilan`) VALUES
(1, 0, 'PESANTREN PUTRA', 25, 0, '', ''),
(2, 0, 'SMP', 72, 0, '', ''),
(3, 0, 'SMK', 30, 0, '', ''),
(4, 0, 'SMA', 6, 0, '', ''),
(5, 0, 'SEKRETARIAT', 0, 0, '', ''),
(6, 0, 'KEUANGAN', 12, 0, '', ''),
(7, 0, 'BAGIAN UMUM DAN KEAMANAN', 8, 0, '', ''),
(8, 0, 'MADIN', 62, 0, '', ''),
(9, 0, 'LITBANG', 0, 0, '', ''),
(10, 0, 'BIDANG BLP', 16, 0, '', ''),
(11, 0, 'HUMAS', 10, 0, '', ''),
(12, 0, 'KESEHATAN', 13, 0, '', ''),
(13, 0, 'BIRO KONSELING', 7, 0, '', ''),
(14, 0, 'KOPERASI', 0, 0, '', ''),
(15, 0, 'BLC', 82, 0, '', ''),
(16, 0, 'TPQ', 20, 0, '', ''),
(17, 0, 'TAHFIDZ / LTQ', 24, 0, '', ''),
(18, 0, 'PEMBANGUNAN', 0, 0, '', ''),
(20, 0, 'EKTRAKURIKULER DAN LOMBA', 0, 0, '', ''),
(21, 0, 'BAYHI TRAINING CENTER', 18, 0, '', ''),
(22, 0, 'LAZISWA', 0, 0, '', ''),
(23, 0, 'TAKMIR MASJID', 43, 0, '', ''),
(24, 0, 'TPMP', 0, 0, '', ''),
(26, 0, 'PENJURUSAN KITAB', 0, 0, '', ''),
(27, 0, 'BK Karir', 0, 0, '', ''),
(29, 0, 'KOSONG', 0, 0, '', ''),
(30, 0, 'Sekretaris BLC', 0, 0, '', ''),
(31, 0, 'IT', 32, 0, '', ''),
(32, 0, 'HCD', 11, 0, '', ''),
(33, 0, 'STAF IT', 0, 0, '', ''),
(34, 0, 'KATERING', 0, 0, '', ''),
(35, 0, 'PERPUSTAKAAN', 0, 0, '', ''),
(36, 0, 'TEAM TEACHING', 0, 0, '', ''),
(37, 0, 'QC', 0, 0, '', ''),
(38, 0, 'KEAMANAN', 0, 0, '', ''),
(39, 0, 'BANK SAMPAH', 0, 0, '', ''),
(40, 0, 'KANTIN', 0, 0, '', ''),
(41, 0, 'DOKTER PENANGGUNG JAWAB POSKESTREN', 79, 0, '', ''),
(42, 0, 'SEKRETARIS UMUM / DIREKTUR PENDIDIKAN', 0, 0, '', ''),
(43, 0, 'Majelis Pembina Organisasi Santri', 0, 0, '', ''),
(44, 0, 'Koordinator Kelompok Kerja', 0, 0, '', ''),
(45, 0, 'MADIN PUTRI', 83, 0, '', ''),
(46, 0, 'KOORDINATOR KEDISIPLINAN PESANTREN PUTRA', 0, 0, '', ''),
(47, 0, 'KOORDINATOR KEDISIPLINAN PESANTREN PUTRI', 0, 0, '', ''),
(48, 0, 'LAUNDRY', 0, 0, '', ''),
(49, 0, 'WADIR BIDANG USAHA', 0, 0, '', ''),
(50, 0, 'PENGASUH', 0, 0, '', ''),
(51, 0, 'BENDAHARA UMUM', 0, 0, '', ''),
(52, 0, 'DEWAN MASYAYIKH', 0, 0, '', ''),
(53, 0, 'OPERATOR', 0, 0, '', ''),
(54, 0, 'PESANTREN PUTRI', 51, 0, '', ''),
(55, 0, 'KURIKULUM INTEGRASI', 0, 0, '', ''),
(56, 0, 'DATA, KERJA SAMA DAN ALUMNI', 65, 0, '', ''),
(57, 0, 'BK PESANTREN', 0, 0, '', ''),
(58, 0, 'BIRO KEDISIPLINAN BAYHI', 122, 0, '', ''),
(60, 0, 'PESANTREN QS', 0, 0, '', ''),
(61, 0, 'PEMBANGUNAN DAN USAHA', 0, 0, '', ''),
(62, 0, 'PEMBANGUNAN DAN PENGHIJAUAN', 0, 0, '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inventory_barang_atk`
--
ALTER TABLE `inventory_barang_atk`
  ADD PRIMARY KEY (`id_atk`);

--
-- Indeks untuk tabel `inventory_gedung`
--
ALTER TABLE `inventory_gedung`
  ADD PRIMARY KEY (`id_gedung`);

--
-- Indeks untuk tabel `inventory_input_aset`
--
ALTER TABLE `inventory_input_aset`
  ADD PRIMARY KEY (`id_input_aset`);

--
-- Indeks untuk tabel `inventory_jenis_aset`
--
ALTER TABLE `inventory_jenis_aset`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `inventory_kelompok_aset`
--
ALTER TABLE `inventory_kelompok_aset`
  ADD PRIMARY KEY (`id_kelompok`);

--
-- Indeks untuk tabel `inventory_kondisi_aset`
--
ALTER TABLE `inventory_kondisi_aset`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indeks untuk tabel `inventory_pembelian_atk`
--
ALTER TABLE `inventory_pembelian_atk`
  ADD PRIMARY KEY (`id_history_beli`);

--
-- Indeks untuk tabel `inventory_pengajuan_atk`
--
ALTER TABLE `inventory_pengajuan_atk`
  ADD PRIMARY KEY (`id_pengajuan`);

--
-- Indeks untuk tabel `inventory_pengambilan_atk`
--
ALTER TABLE `inventory_pengambilan_atk`
  ADD PRIMARY KEY (`id_pengambilan`);

--
-- Indeks untuk tabel `inventory_pengguna`
--
ALTER TABLE `inventory_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `inventory_peran_pengguna`
--
ALTER TABLE `inventory_peran_pengguna`
  ADD PRIMARY KEY (`id_peran`);

--
-- Indeks untuk tabel `inventory_riwayat_aset`
--
ALTER TABLE `inventory_riwayat_aset`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `inventory_ruang`
--
ALTER TABLE `inventory_ruang`
  ADD PRIMARY KEY (`id_ruang`);

--
-- Indeks untuk tabel `inventory_sub_unit`
--
ALTER TABLE `inventory_sub_unit`
  ADD PRIMARY KEY (`id_sub_unit`);

--
-- Indeks untuk tabel `inventory_unit`
--
ALTER TABLE `inventory_unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inventory_barang_atk`
--
ALTER TABLE `inventory_barang_atk`
  MODIFY `id_atk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventory_gedung`
--
ALTER TABLE `inventory_gedung`
  MODIFY `id_gedung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `inventory_input_aset`
--
ALTER TABLE `inventory_input_aset`
  MODIFY `id_input_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=499;

--
-- AUTO_INCREMENT untuk tabel `inventory_jenis_aset`
--
ALTER TABLE `inventory_jenis_aset`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `inventory_kelompok_aset`
--
ALTER TABLE `inventory_kelompok_aset`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `inventory_kondisi_aset`
--
ALTER TABLE `inventory_kondisi_aset`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT untuk tabel `inventory_pembelian_atk`
--
ALTER TABLE `inventory_pembelian_atk`
  MODIFY `id_history_beli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventory_pengajuan_atk`
--
ALTER TABLE `inventory_pengajuan_atk`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventory_pengambilan_atk`
--
ALTER TABLE `inventory_pengambilan_atk`
  MODIFY `id_pengambilan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventory_pengguna`
--
ALTER TABLE `inventory_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT untuk tabel `inventory_peran_pengguna`
--
ALTER TABLE `inventory_peran_pengguna`
  MODIFY `id_peran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `inventory_riwayat_aset`
--
ALTER TABLE `inventory_riwayat_aset`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventory_ruang`
--
ALTER TABLE `inventory_ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `inventory_sub_unit`
--
ALTER TABLE `inventory_sub_unit`
  MODIFY `id_sub_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `inventory_unit`
--
ALTER TABLE `inventory_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
