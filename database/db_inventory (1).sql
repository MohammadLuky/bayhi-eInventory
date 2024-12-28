-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Nov 2023 pada 02.31
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

--
-- Dumping data untuk tabel `inventory_barang_atk`
--

INSERT INTO `inventory_barang_atk` (`id_atk`, `kode_kelompok_barang`, `id_standart_harga`, `kode_barang_dari_pemerintah`, `kode_rekening`, `kode_barang`, `nama_barang`, `satuan_barang`, `satuan_harga`, `ket_barang`) VALUES
(6, '1.1.12.01.03.0001-6-bayhi', '9520001-6-bayhi', '1.1.12.01.03.0001.6-bayhi', '5.1.02.01.01.0024.-6-bayhi', 'K1', 'Kertas F4 500 g', 'rim', '50000', 'bayhi'),
(7, '1.1.12.01.03.0001', '9468958', '1.1.12.01.03.0001.02626', '5.1.02.01.01.0024', 'KOSONG', 'ISI SEPLES-', 'pak', '35100', 'pemerintah');

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
(15, 'Gedung Putra', '');

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
  `pic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_input_aset`
--

INSERT INTO `inventory_input_aset` (`id_input_aset`, `aset_unit_id`, `aset_sub_unit_id`, `lokasi_gedung_id`, `lokasi_ruang_id`, `jenis_aset_id`, `jenis_kelompok_id`, `nama_sarana`, `jumlah_aset`, `satuan_aset`, `status_kepemilikan`, `tahun_pengadaan`, `harga_perolehan`, `total_perolehan`, `label_aset`, `keterangan_aset`, `pic_id`) VALUES
(24, 23, 17, 15, 10, 18, 8, 'Almari Rak Komputer', '2', 'set', 'Milik', '2021', '250000', '500000', '1/INV/Unit IT/2021', 'Baru', 13),
(28, 23, 17, 15, 10, 18, 8, 'Almari Kabel', '2', 'unit', 'Milik', '2021', '3200000', '6400000', '2/INV/Unit IT/2021', '', 13);

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
(18, 'A1', 'Almari', 8);

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
(8, 'Kelompok 1', '4', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_kondisi_aset`
--

CREATE TABLE `inventory_kondisi_aset` (
  `id_kondisi` int(11) NOT NULL,
  `aset_id` int(11) NOT NULL,
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

INSERT INTO `inventory_kondisi_aset` (`id_kondisi`, `aset_id`, `pic_kondisi_id`, `tanggal_cek`, `kondisi_aset`, `ket_kondisi_aset`, `jumlah_aset_kondisi`, `aturan_edit`) VALUES
(19, 24, 13, '10/18/2023', 'Baik', 'Baik', '2', 0);

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

--
-- Dumping data untuk tabel `inventory_pengajuan_atk`
--

INSERT INTO `inventory_pengajuan_atk` (`id_pengajuan`, `unit_pengajuan_id`, `atk_pengajuan_id`, `jumlah_pengajuan_atk`, `satuan_atk_pengajuan`, `harga_pengajuan_atk`, `total_pengajuan_atk`, `tanggal_pengajuan`, `tahun_pengajuan`, `status_pengajuan_atk`) VALUES
(9, 23, 6, 2, 'rim', '50000', '100000', '10/23/2023', '2023', 'approval'),
(10, 23, 7, 2, 'pak', '35100', '70200', '10/23/2023', '2023', 'approval'),
(11, 24, 6, 3, 'rim', '50000', '150000', '10/23/2023', '2023', 'pengisian'),
(12, 24, 7, 4, 'pak', '35100', '140400', '10/23/2023', '2023', 'pengisian');

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

--
-- Dumping data untuk tabel `inventory_pengambilan_atk`
--

INSERT INTO `inventory_pengambilan_atk` (`id_pengambilan`, `unit_pengambilan_id`, `atk_pengambilan_id`, `jumlah_pengambilan_atk`, `satuan_atk_pengambilan`, `harga_pengambilan_atk`, `total_pengambilan_atk`, `tanggal_pengambilan`, `tahun_pengambilan`, `status_pengambilan_atk`) VALUES
(6, 23, 6, '1', 'rim', '50000', '50000', '10/24/2023', '2023', 'approval');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_pengguna`
--

CREATE TABLE `inventory_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `niy` varchar(20) NOT NULL,
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

INSERT INTO `inventory_pengguna` (`id_pengguna`, `niy`, `nama`, `username`, `password`, `pass_tampil`, `img`, `jabatan_pengguna`, `peran_id`) VALUES
(1, '', 'Mohammad Khusnul Chuluq', 'admin', '$2y$10$ySNOlWdZDmp/xDNQAaQcXu/YBFVu0wfhP7fCl6gThZzN20/DZe4Zu', '123456', 'Aset_ATK.jpg', 'Staff IT', 1),
(13, '', 'Admin Sub Unit IT', 'subunit_it', '$2y$10$7w5X67b6WRYotv0bOR4RwuRqFlcScmX8XLqy1k32SOek7c7AiBZvm', '098765', '5856.jpg', 'Staff IT', 5),
(14, '', 'Kepala Unit IT', 'unit_IT', '$2y$10$tQXWUZFrs81qF55T6e9y1uifwUl.w/GGK86vWQnvot07D5Jlbm7Zq', '098765', '5856.jpg', 'Kepala Unit', 4),
(15, '', 'Kepala Unit Keuangan', 'unit_keuangan', '$2y$10$1izLozvHFFsL5SwhSFaAi.fRxobXYrLuewUrEicbAF9VFO4caA91q', '098765', '5856.jpg', 'Kepala Unit', 4),
(16, '', 'Admin Sub Unit Keuangan', 'subunit_keuangan', '$2y$10$EY6ykoQl2OCp6UQ43bpILO0jdybUCKzHJUPdmsYmRsJBzFyAcEe4S', '098765', '5856.jpg', 'Staff Keuangan', 5),
(17, '', 'Pengelola ATK', 'admin_atk', '$2y$10$zLQqtjNwpm6Rf0uZ2EN1N.Rg0/wuNXHWh.X86Tabh1eT/Y.95Zgv6', '123456', '5856.jpg', 'Kepala Pengelola ATK', 3),
(18, '', 'Pengelola Aset', 'admin_aset', '$2y$10$DNBxlosSxWzpe/wmjb3G8eWreF0Iz/vt4s6ah0x1xpLt9EU4O0q/m', '123456', '5856.jpg', 'Kepala Aset', 2);

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
(6, 'sarpras', 'Sarana Dan Prasarana');

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
(10, 'Ruang Server', '', 15),
(11, 'Ruang Keuangan', '', 15);

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
  `nama_sub_unit` varchar(20) NOT NULL,
  `ket_sub_unit` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_sub_unit`
--

INSERT INTO `inventory_sub_unit` (`id_sub_unit`, `gedung_sub_unit_id`, `ruang_sub_unit_id`, `unit_id`, `subunit_pic_id`, `nama_sub_unit`, `ket_sub_unit`) VALUES
(17, 15, 10, 23, 13, 'Sub Unit IT', ''),
(18, 15, 11, 24, 16, 'Sub Unit Keuangan', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_unit`
--

CREATE TABLE `inventory_unit` (
  `id_unit` int(11) NOT NULL,
  `gedung_unit_id` int(11) NOT NULL,
  `nama_unit` varchar(20) NOT NULL,
  `kepala_unit_id` int(11) NOT NULL,
  `sarpras_unit_id` int(11) NOT NULL,
  `status_pengajuan` varchar(20) NOT NULL,
  `status_pengambilan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_unit`
--

INSERT INTO `inventory_unit` (`id_unit`, `gedung_unit_id`, `nama_unit`, `kepala_unit_id`, `sarpras_unit_id`, `status_pengajuan`, `status_pengambilan`) VALUES
(23, 0, 'Unit IT', 14, 13, 'approval', 'pengisian'),
(24, 0, 'Unit Keuangan', 15, 16, 'pengisian', '');

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
  MODIFY `id_atk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `inventory_gedung`
--
ALTER TABLE `inventory_gedung`
  MODIFY `id_gedung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `inventory_input_aset`
--
ALTER TABLE `inventory_input_aset`
  MODIFY `id_input_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `inventory_jenis_aset`
--
ALTER TABLE `inventory_jenis_aset`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `inventory_kelompok_aset`
--
ALTER TABLE `inventory_kelompok_aset`
  MODIFY `id_kelompok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `inventory_kondisi_aset`
--
ALTER TABLE `inventory_kondisi_aset`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `inventory_pembelian_atk`
--
ALTER TABLE `inventory_pembelian_atk`
  MODIFY `id_history_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `inventory_pengajuan_atk`
--
ALTER TABLE `inventory_pengajuan_atk`
  MODIFY `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `inventory_pengambilan_atk`
--
ALTER TABLE `inventory_pengambilan_atk`
  MODIFY `id_pengambilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `inventory_pengguna`
--
ALTER TABLE `inventory_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `inventory_peran_pengguna`
--
ALTER TABLE `inventory_peran_pengguna`
  MODIFY `id_peran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `inventory_riwayat_aset`
--
ALTER TABLE `inventory_riwayat_aset`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inventory_ruang`
--
ALTER TABLE `inventory_ruang`
  MODIFY `id_ruang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `inventory_sub_unit`
--
ALTER TABLE `inventory_sub_unit`
  MODIFY `id_sub_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `inventory_unit`
--
ALTER TABLE `inventory_unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
