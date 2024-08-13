-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Agu 2023 pada 16.41
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kdbrg` varchar(10) NOT NULL,
  `nmbrg` varchar(25) NOT NULL,
  `hrgbrg` double NOT NULL,
  `stokbrg` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kdbrg`, `nmbrg`, `hrgbrg`, `stokbrg`) VALUES
('BRG001', 'Beras 5 KG', 500000, 12),
('BRG002', 'Minyak Goreng 1 KG', 25000, 15),
('BRG003', 'Gula 1KG', 12500, 9),
('BRG004', 'Terigu 1 KG', 12500, 25),
('BRG005', 'Garam 250 Gr', 2500, 30),
('BRG006', 'Sagu 1 KG', 12500, 213),
('BRG007', 'Gula Aren 1 KG', 16000, 38);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `idtrans` varchar(10) NOT NULL,
  `tgltrans` datetime NOT NULL,
  `kdbrg` varchar(10) NOT NULL,
  `jmlbeli` int(10) NOT NULL,
  `totalharga` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`idtrans`, `tgltrans`, `kdbrg`, `jmlbeli`, `totalharga`) VALUES
('1', '2023-08-12 22:26:56', 'BRG003', 4, 50000),
('2', '2023-08-12 22:28:52', 'BRG005', 5, 12500),
('3', '2023-08-13 11:28:56', 'BRG005', 2, 5000),
('4', '2023-08-12 21:50:00', 'BRG003', 3, 37500);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kdbrg`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtrans`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
