-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2021 pada 16.40
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siabangade`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_barang`
--

CREATE TABLE `t_barang` (
  `kode_barang` varchar(10) COLLATE armscii8_bin NOT NULL,
  `nama` varchar(255) COLLATE armscii8_bin NOT NULL,
  `harga` double NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `t_barang`
--

INSERT INTO `t_barang` (`kode_barang`, `nama`, `harga`, `stok`) VALUES
('BRG00001', 'Raket TOHO', 65000, 1),
('BRG00002', 'Lampu HANNOCS 35 Watt', 26000, 42),
('BRG00003', 'Pena Standart Hitam', 2000, 91),
('BRG00004', 'Pena Pilot Biru', 3000, 43),
('BRG00005', 'Buku agenda sedang', 10000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_pembayaran`
--

CREATE TABLE `t_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `total_harga` double NOT NULL,
  `uang_pembayaran` double NOT NULL,
  `uang_kembalian` double NOT NULL,
  `tanggal` date NOT NULL,
  `tipe` enum('masuk','keluar') COLLATE armscii8_bin NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `t_pembayaran`
--

INSERT INTO `t_pembayaran` (`id_pembayaran`, `total_harga`, `uang_pembayaran`, `uang_kembalian`, `tanggal`, `tipe`, `id_user`) VALUES
(1, 195000, 200000, 5000, '2021-07-31', 'masuk', 11),
(2, 91000, 100000, 9000, '2021-07-31', 'masuk', 11),
(3, 195000, 200000, 5000, '2021-07-31', 'keluar', 11),
(4, 53000, 70000, 17000, '2021-07-31', 'keluar', 11),
(5, 221000, 250000, 29000, '2021-07-31', 'keluar', 11),
(6, 169000, 200000, 31000, '2021-07-31', 'masuk', 11),
(7, 65000, 100000, 35000, '2021-07-31', 'masuk', 11),
(8, 65000, 100000, 35000, '2021-07-31', 'keluar', 11),
(9, 195000, 200000, 5000, '2021-07-31', 'keluar', 11),
(10, 20000, 20000, 0, '2021-07-31', 'keluar', 11),
(11, 8000, 10000, 2000, '2021-08-01', 'keluar', 11),
(12, 78000, 100000, 22000, '2021-08-01', 'masuk', 11),
(13, 27000, 30000, 3000, '2021-08-01', 'masuk', 11),
(14, 12000, 15000, 3000, '2021-08-01', 'keluar', 11),
(15, 130000, 150000, 20000, '2021-08-01', 'keluar', 11),
(16, 28000, 30000, 2000, '2021-08-01', 'masuk', 11),
(17, 35000, 40000, 5000, '2021-08-01', 'keluar', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_transaksi`
--

CREATE TABLE `t_transaksi` (
  `id_pembayaran` int(11) NOT NULL,
  `kode_barang` varchar(10) COLLATE armscii8_bin NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `t_transaksi`
--

INSERT INTO `t_transaksi` (`id_pembayaran`, `kode_barang`, `jumlah`) VALUES
(1, 'BRG00001', 2),
(1, 'BRG00002', 2),
(2, 'BRG00001', 1),
(2, 'BRG00002', 1),
(3, 'BRG00001', 2),
(3, 'BRG00002', 2),
(4, 'BRG00002', 1),
(4, 'BRG00004', 9),
(5, 'BRG00001', 1),
(5, 'BRG00002', 6),
(6, 'BRG00001', 1),
(6, 'BRG00002', 4),
(7, 'BRG00001', 1),
(8, 'BRG00001', 1),
(9, 'BRG00001', 3),
(10, 'BRG00003', 10),
(11, 'BRG00003', 4),
(12, 'BRG00002', 3),
(13, 'BRG00004', 9),
(14, 'BRG00003', 6),
(15, 'BRG00001', 2),
(16, 'BRG00002', 1),
(16, 'BRG00003', 1),
(17, 'BRG00003', 10),
(17, 'BRG00004', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) COLLATE armscii8_bin NOT NULL,
  `password` varchar(100) COLLATE armscii8_bin NOT NULL,
  `nama` varchar(24) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

--
-- Dumping data untuk tabel `t_user`
--

INSERT INTO `t_user` (`id_user`, `username`, `password`, `nama`) VALUES
(4, 'resaendr', '2c9f0615ca2e463732f1f146adcfa6e9', 'Resa Endrawan'),
(5, 'adekur223', '08923e5f9f8e387d2a29684a46ea6af7', 'Ade Kurniawannn'),
(7, 'juliadit666', '907dbf7425889a23284794aeb5069ae2', 'Juliadit Syahputra'),
(8, 'sidiqqqqq', '6bdcd2946bae31321c8d8eb3ce960951', 'Sidiq Sanjaya Bakti'),
(9, 'asul02', 'c59e19e1f0bcb7b1e331652ad45221a4', 'Asul Supriatna'),
(10, 'afi', 'a963c09f1ea9aef6f5013e139e14c75d', 'Fildzah Safirah Lutfi'),
(11, 'admin', '0192023a7bbd73250516f069df18b500', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `t_barang`
--
ALTER TABLE `t_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indeks untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `t_transaksi`
--
ALTER TABLE `t_transaksi`
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indeks untuk tabel `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `t_pembayaran`
--
ALTER TABLE `t_pembayaran`
  ADD CONSTRAINT `t_pembayaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `t_transaksi`
--
ALTER TABLE `t_transaksi`
  ADD CONSTRAINT `t_transaksi_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `t_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_transaksi_ibfk_2` FOREIGN KEY (`id_pembayaran`) REFERENCES `t_pembayaran` (`id_pembayaran`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
