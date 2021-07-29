-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2021 pada 11.05
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_transaksi`
--

CREATE TABLE `t_transaksi` (
  `id_pembayaran` int(11) NOT NULL,
  `kode_barang` varchar(10) COLLATE armscii8_bin NOT NULL,
  `jumlah` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

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
(5, 'adekur22', 'ca8da06d9c842df61ad24e996a577572', 'Ade Kurniawan'),
(6, 'anggasety', '7885a5e19eb944d6e12e5dc5bdccc364', 'Angga Setyadi');

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
-- AUTO_INCREMENT untuk tabel `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
