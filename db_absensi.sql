-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Nov 2020 pada 04.03
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id` int(20) NOT NULL,
  `nip` int(8) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `date_stamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id`, `nip`, `status`, `date`, `date_stamp`) VALUES
(10, 12010041, 'Sakit', '2020-11-07', '0000-00-00 00:00:00'),
(11, 20010045, 'Ijin', '2020-11-08', '0000-00-00 00:00:00'),
(12, 20010045, 'Sakit', '2020-10-10', '0000-00-00 00:00:00'),
(13, 20010045, 'Hadir', '2020-11-12', '2020-11-12 08:11:00'),
(15, 20010045, 'Hadir', '2020-11-12', '2020-11-12 09:05:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_karyawan`
--

CREATE TABLE `tbl_karyawan` (
  `nip` int(8) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `fungsional` varchar(20) NOT NULL,
  `struktural` varchar(20) NOT NULL,
  `pin` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_karyawan`
--

INSERT INTO `tbl_karyawan` (`nip`, `nama`, `tgl_masuk`, `fungsional`, `struktural`, `pin`) VALUES
(12010041, 'Budi', '0000-00-00', 'Enginner', 'Manager', 12),
(12020042, 'Weti', '0000-00-00', 'Administrasi', 'Team Leader', 12),
(12020043, 'Iwan', '0000-00-00', 'Administrasi', 'Staff', 12),
(13020044, 'Yudi', '2013-10-09', 'Administrasi', 'Staff', 1234),
(20010045, 'kun', '2020-10-10', 'Engineer', 'Manager', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `username` int(8) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`username`, `nama`, `password`) VALUES
(1, 'test', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_karyawan`
--
ALTER TABLE `tbl_karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
