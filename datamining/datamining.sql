-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Jul 2023 pada 13.19
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
-- Database: `datamining2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `upload_data`
--

CREATE TABLE `upload_data` (
  `NIS` int(15) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `nilai_pengetahuan` int(10) NOT NULL,
  `nilai_sikap` int(10) NOT NULL,
  `skor_iq` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `upload_data`
--

INSERT INTO `upload_data` (`NIS`, `nama`, `nilai_pengetahuan`, `nilai_sikap`, `skor_iq`) VALUES
(21227002, 'Ade Damarudin', 80, 3, 97),
(21227003, 'Adelia', 86, 5, 118),
(21227004, 'Ahmad Daffa Fawwaz', 82, 4, 108),
(21227005, 'Ahmad Raihan Rabbani', 81, 4, 106),
(21227007, 'AMANDA NAYRA SEZHA', 84, 4, 113),
(21227008, 'ARYA SUNARTA', 81, 4, 98),
(21227009, 'ASIILA ARIKA SAHARAH', 82, 4, 108),
(21227010, 'BILQIS GHINA KAMILAH', 81, 4, 106),
(21227011, 'Bima Ikhram Ramadhan', 84, 4, 112),
(21227012, 'Dava M Ramadhan', 78, 3, 96),
(21227013, 'DIAN AYU SAFIRA', 87, 5, 118),
(21227014, 'DINDA ZACHRA DWIVANI', 85, 4, 115),
(21227015, 'Faiqoh Nurhanifah', 83, 4, 111),
(21227016, 'Fathir Ilham Anugrah', 81, 4, 98),
(21227017, 'FAUZI FADILAH', 84, 4, 113),
(21227018, 'HABIBIE FAEYZA KUSWARAHARJA', 85, 5, 116),
(21227019, 'Irham Fawwaz Adilla', 80, 3, 96),
(21227020, 'Jemaima Al Tamira', 85, 4, 116),
(21227021, 'JIHAN HUMAYRAH ASSEGAF', 83, 4, 110),
(21227022, 'KASHMIRA PUTRI ELSYELI', 82, 4, 108),
(21227023, 'KHAIRUL FAHRIZAL', 80, 4, 98),
(21227024, 'Khairunnisa Rindiani', 84, 4, 113),
(21227025, 'KIRANA GIO AL BUKHARI', 90, 5, 119),
(21227026, 'Luviana Tjahyadi', 83, 4, 110),
(21227027, 'MUHAMAD FATHIR RISQY', 86, 5, 117),
(21227028, 'MUHAMAD AKMALUDIN', 80, 4, 97),
(21227029, 'Muhammad Dimas Syahputra', 80, 3, 96),
(21227030, 'Muhammad Fahri Saputra', 82, 4, 109),
(21227481, 'Adel Ari Adi Lubis', 83, 4, 111),
(21227500, 'JELITA NANTASYA PUTRI', 83, 4, 110);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(2, 'adminit', 'adminit@gmail.com', '4297f44b13955235245b2497399d7a93', 'admin'),
(3, 'adminguru', 'smpn3tangsel@gmail.com', '4297f44b13955235245b2497399d7a93', 'user'),
(7, 'adminguru2', 'smp3tangsel@gmail.com', '4297f44b13955235245b2497399d7a93', 'user'),
(9, 'adminit2', 'adminit2@gmail.com', '4297f44b13955235245b2497399d7a93', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `upload_data`
--
ALTER TABLE `upload_data`
  ADD PRIMARY KEY (`NIS`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
