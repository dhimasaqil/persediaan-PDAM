-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Apr 2022 pada 23.20
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `tbbarang`
--

CREATE TABLE `tbbarang` (
  `kode_barang` varchar(6) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `kode_kategori` int(11) NOT NULL,
  `spesifikasi` varchar(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `lokasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbbarang`
--

INSERT INTO `tbbarang` (`kode_barang`, `nama_barang`, `kode_kategori`, `spesifikasi`, `stok`, `lokasi`) VALUES
('BRG001', 'Obeng', 12, 'Obeng Besar', 5, 'Rak Lemari 1'),
('BRG002', 'Baut 14', 12, 'Drat 14 inchi', 5, 'Rak 2 Bawah'),
('BRG003', 'Penggaris', 11, 'Butterfly 30 cm', 5, 'Rak 2 Atas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbdepartement`
--

CREATE TABLE `tbdepartement` (
  `kode_departement` varchar(6) NOT NULL,
  `nama_departement` varchar(30) NOT NULL,
  `ext` varchar(3) NOT NULL,
  `nama_manager` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbdepartement`
--

INSERT INTO `tbdepartement` (`kode_departement`, `nama_departement`, `ext`, `nama_manager`) VALUES
('DEP001', 'HRD', '105', 'Handoko'),
('DEP002', 'Gudang', '102', 'Hulk'),
('DEP003', 'Purchasing', '119', 'Harry');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbdetail_penerimaan`
--

CREATE TABLE `tbdetail_penerimaan` (
  `id` int(11) NOT NULL,
  `kode_terima` varchar(20) NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbdetail_penerimaan`
--

INSERT INTO `tbdetail_penerimaan` (`id`, `kode_terima`, `kode_barang`, `jumlah_barang`) VALUES
(50, 'TB202204240000', 'BRG003', 1),
(51, 'TB202204240002', 'BRG002', 1),
(52, 'TB202204240003', 'BRG002', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbdetail_pengeluaran`
--

CREATE TABLE `tbdetail_pengeluaran` (
  `id` int(11) NOT NULL,
  `kode_keluar` varchar(20) NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `jumlah_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbdetail_pengeluaran`
--

INSERT INTO `tbdetail_pengeluaran` (`id`, `kode_keluar`, `kode_barang`, `jumlah_barang`) VALUES
(28, 'BT202204240000', 'BRG003', 1),
(29, 'BT202204240001', 'BRG003', 3),
(30, 'BT202204240002', 'BRG001', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbgabung_transaksi`
--

CREATE TABLE `tbgabung_transaksi` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbgabung_transaksi`
--

INSERT INTO `tbgabung_transaksi` (`id`, `kode`, `tanggal`, `kode_barang`, `jumlah_barang`, `ket`) VALUES
(37, 'T202001140001', '2020-01-14', 'BRG001', 2, 'MASUK'),
(38, 'T202001140001', '2020-01-14', 'BRG002', 7, 'MASUK'),
(39, 'T202001140001', '2020-01-14', 'BRG003', 3, 'MASUK'),
(40, 'T202001140001', '2020-01-14', 'BRG001', 0, 'KELUAR'),
(41, 'T202001140001', '2020-01-14', 'BRG002', 0, 'KELUAR'),
(42, 'T202001140001', '2020-01-14', 'BRG003', 0, 'KELUAR'),
(43, 'K202001140001', '2020-01-14', 'BRG001', 2, 'KELUAR'),
(44, 'K202001140001', '2020-01-14', 'BRG001', 0, 'MASUK'),
(45, 'BT202204200001', '2022-04-20', 'BRG001', 3, 'KELUAR'),
(46, 'BT202204200001', '2022-04-20', 'BRG001', 0, 'MASUK'),
(47, 'TB202204200001', '2022-04-20', 'BRG003', 1, 'MASUK'),
(48, 'TB202204200001', '2022-04-20', 'BRG003', 0, 'KELUAR'),
(49, 'TB202204200001', '2022-04-20', 'BRG003', 3, 'MASUK'),
(50, 'TB202204200001', '2022-04-20', 'BRG003', 0, 'KELUAR'),
(51, 'TB202204240001', '2022-04-24', 'BRG001', 1, 'MASUK'),
(52, 'TB202204240001', '2022-04-24', 'BRG001', 0, 'KELUAR'),
(53, 'TB202204240001', '2022-04-24', 'BRG003', 1, 'MASUK'),
(54, 'TB202204240001', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(55, 'BT202204240001', '2022-04-24', 'BRG003', 1, 'KELUAR'),
(56, 'BT202204240001', '2022-04-24', 'BRG003', 0, 'MASUK'),
(57, 'BT202204240001', '2022-04-24', 'BRG002', 1, 'MASUK'),
(58, 'TB202204240001', '2022-04-24', 'BRG003', 1, 'MASUK'),
(60, 'BT202204240001', '2022-04-24', 'BRG002', 0, 'KELUAR'),
(61, 'TB202204240001', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(63, 'TB202204240001', '2022-04-24', 'BRG003', 1, 'MASUK'),
(64, 'TB202204240001', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(65, 'TB202204240001', '2022-04-24', 'BRG003', 1, 'MASUK'),
(66, 'TB202204240001', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(67, 'BT202204240001', '2022-04-24', 'BRG003', 1, 'KELUAR'),
(68, 'BT202204240001', '2022-04-24', 'BRG003', 0, 'MASUK'),
(69, 'TB202204240001', '2022-04-24', 'BRG001', 1, 'MASUK'),
(70, 'TB202204240001', '2022-04-24', 'BRG001', 0, 'KELUAR'),
(71, 'BT202204240001', '2022-04-24', 'BRG002', 1, 'KELUAR'),
(72, 'BT202204240001', '2022-04-24', 'BRG002', 0, 'MASUK'),
(73, 'TB202204242022042400', '2022-04-24', 'BRG002', 1, 'MASUK'),
(74, 'TB202204242022042400', '2022-04-24', 'BRG002', 0, 'KELUAR'),
(75, 'TB202204240001', '2022-04-24', 'BRG003', 1, 'MASUK'),
(76, 'TB202204240001', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(77, 'TB202204242022042400', '2022-04-24', 'BRG003', 1, 'MASUK'),
(78, 'TB202204242022042400', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(79, 'TB202204240000', '2022-04-24', 'BRG003', 1, 'MASUK'),
(80, 'TB202204240000', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(81, 'TB202204240002', '2022-04-24', 'BRG003', 1, 'MASUK'),
(82, 'TB202204240002', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(83, 'TB202204240000', '2022-04-24', 'BRG003', 1, 'MASUK'),
(84, 'TB202204240000', '2022-04-24', 'BRG003', 0, 'KELUAR'),
(85, 'TB202204240002', '2022-04-24', 'BRG002', 1, 'MASUK'),
(86, 'TB202204240002', '2022-04-24', 'BRG002', 0, 'KELUAR'),
(87, 'BT202204240001', '2022-04-24', 'BRG003', 1, 'KELUAR'),
(88, 'BT202204240001', '2022-04-24', 'BRG003', 0, 'MASUK'),
(89, 'BT202204240000', '2022-04-24', 'BRG003', 1, 'KELUAR'),
(90, 'BT202204240000', '2022-04-24', 'BRG003', 0, 'MASUK'),
(91, 'BT202204240002', '2022-04-24', 'BRG002', 1, 'KELUAR'),
(92, 'BT202204240002', '2022-04-24', 'BRG002', 0, 'MASUK'),
(93, 'BT202204240000', '2022-04-24', 'BRG003', 1, 'KELUAR'),
(94, 'BT202204240000', '2022-04-24', 'BRG003', 0, 'MASUK'),
(95, 'BT202204240001', '2022-04-24', 'BRG003', 3, 'KELUAR'),
(96, 'BT202204240001', '2022-04-24', 'BRG003', 0, 'MASUK'),
(97, 'BT202204240002', '2022-04-24', 'BRG001', 3, 'KELUAR'),
(98, 'BT202204240002', '2022-04-24', 'BRG001', 0, 'MASUK'),
(99, 'TB202204240003', '2022-04-24', 'BRG002', 3, 'MASUK'),
(100, 'TB202204240003', '2022-04-24', 'BRG002', 0, 'KELUAR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkategori`
--

CREATE TABLE `tbkategori` (
  `kode_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbkategori`
--

INSERT INTO `tbkategori` (`kode_kategori`, `nama_kategori`) VALUES
(11, 'ATK'),
(12, 'Spare Part'),
(13, 'Elektronik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tblogin`
--

CREATE TABLE `tblogin` (
  `id_login` varchar(6) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `status_admin` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tblogin`
--

INSERT INTO `tblogin` (`id_login`, `username`, `password`, `nama_admin`, `status_admin`) VALUES
('', 'Akira', '101010', 'Akira', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpenerimaan`
--

CREATE TABLE `tbpenerimaan` (
  `kode_terima` varchar(20) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `kode_departement` varchar(6) NOT NULL,
  `id_login` varchar(6) NOT NULL,
  `tenggat_waktu` date DEFAULT NULL,
  `kondisi_barang` varchar(255) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbpenerimaan`
--

INSERT INTO `tbpenerimaan` (`kode_terima`, `tanggal_terima`, `jumlah_item`, `kode_departement`, `id_login`, `tenggat_waktu`, `kondisi_barang`, `nama_peminjam`, `keterangan`) VALUES
('TB202204240000', '2022-04-24', 1, 'DEP002', '', '2022-04-25', 'Baik', 'purwantoro', '2 hari'),
('TB202204240001', '2022-04-24', 0, 'DEP003', '', '2022-04-26', 'Baik', 'purwantoro', '2 hari'),
('TB202204240002', '2022-04-24', 1, 'DEP003', '', '2022-04-27', 'Rusak', 'Ilham', 'a'),
('TB202204240003', '2022-04-24', 1, 'DEP001', '', '2022-04-28', 'Baik', 'Aqil', 'dengan jaminan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbpengeluaran`
--

CREATE TABLE `tbpengeluaran` (
  `kode_keluar` varchar(20) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `kode_departement` varchar(20) NOT NULL,
  `id_login` varchar(60) NOT NULL,
  `tenggat_waktu` date DEFAULT NULL,
  `kondisi_barang_pinjam` varchar(255) NOT NULL,
  `kondisi_barang_kembali` varchar(255) NOT NULL,
  `nama_peminjam` varchar(255) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbpengeluaran`
--

INSERT INTO `tbpengeluaran` (`kode_keluar`, `tanggal_keluar`, `jumlah_item`, `kode_departement`, `id_login`, `tenggat_waktu`, `kondisi_barang_pinjam`, `kondisi_barang_kembali`, `nama_peminjam`, `keterangan`) VALUES
('BT202204240000', '2022-04-24', 1, 'DEP001', '', '2022-04-26', 'Rusak', 'Rusak', 'ikhsan', '2 hari'),
('BT202204240001', '2022-04-24', 1, 'DEP002', '', '2022-04-27', 'Baik', 'Baik', 'Ilham', 'gatau'),
('BT202204240002', '2022-04-24', 1, 'DEP002', '', '2022-04-27', 'Rusak', 'Rusak', 'Suwito', 'insyaallah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbsementara`
--

CREATE TABLE `tbsementara` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `kode_barang` varchar(6) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbbarang`
--
ALTER TABLE `tbbarang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `tbdepartement`
--
ALTER TABLE `tbdepartement`
  ADD PRIMARY KEY (`kode_departement`);

--
-- Indeks untuk tabel `tbdetail_penerimaan`
--
ALTER TABLE `tbdetail_penerimaan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbdetail_pengeluaran`
--
ALTER TABLE `tbdetail_pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbgabung_transaksi`
--
ALTER TABLE `tbgabung_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbkategori`
--
ALTER TABLE `tbkategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indeks untuk tabel `tblogin`
--
ALTER TABLE `tblogin`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `tbpenerimaan`
--
ALTER TABLE `tbpenerimaan`
  ADD PRIMARY KEY (`kode_terima`);

--
-- Indeks untuk tabel `tbpengeluaran`
--
ALTER TABLE `tbpengeluaran`
  ADD PRIMARY KEY (`kode_keluar`);

--
-- Indeks untuk tabel `tbsementara`
--
ALTER TABLE `tbsementara`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbdetail_penerimaan`
--
ALTER TABLE `tbdetail_penerimaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `tbdetail_pengeluaran`
--
ALTER TABLE `tbdetail_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `tbgabung_transaksi`
--
ALTER TABLE `tbgabung_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `tbkategori`
--
ALTER TABLE `tbkategori`
  MODIFY `kode_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbsementara`
--
ALTER TABLE `tbsementara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
