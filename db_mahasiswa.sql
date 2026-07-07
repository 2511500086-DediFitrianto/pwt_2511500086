-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2026 at 01:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mahasiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '266465', 'admin'),
(12, '0067503839', '0qwerty', 'siswa'),
(13, 'G-001', 'test123', 'guru'),
(14, 'G-002', '090909', 'guru'),
(15, '0063778286', '0987654321', 'siswa'),
(16, '0874464444', '12345', 'siswa'),
(17, '43678494', '12345', 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `detailjadwal`
--

CREATE TABLE `detailjadwal` (
  `Id_detail` int(11) NOT NULL,
  `Id_jadwal` int(11) NOT NULL,
  `kd_mapel` varchar(5) NOT NULL,
  `Hari` varchar(20) DEFAULT NULL,
  `Jam_mulai` time DEFAULT NULL,
  `Jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailjadwal`
--

INSERT INTO `detailjadwal` (`Id_detail`, `Id_jadwal`, `kd_mapel`, `Hari`, `Jam_mulai`, `Jam_selesai`) VALUES
(5, 7, 'M-003', 'Kamis', '07:30:00', '10:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `Kd_guru` varchar(5) NOT NULL,
  `Id_user` int(11) NOT NULL,
  `Nm_guru` varchar(50) NOT NULL,
  `Jenkel` varchar(10) NOT NULL,
  `Pend_terakhir` varchar(20) NOT NULL,
  `Hp` varchar(13) NOT NULL,
  `Alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`Kd_guru`, `Id_user`, `Nm_guru`, `Jenkel`, `Pend_terakhir`, `Hp`, `Alamat`) VALUES
('G-002', 2, 'Dedi FItrianto S.Ds', 'L', 'SMK', '085841954944', 'jl.sungai selan');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_kelas`
--

CREATE TABLE `jadwal_kelas` (
  `Id_jadwal` int(11) NOT NULL,
  `Id_kelas` int(11) NOT NULL,
  `Kd_guru` varchar(10) NOT NULL,
  `Thn_ajaran` varchar(20) DEFAULT NULL,
  `Semester` enum('ganjil','genap') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_kelas`
--

INSERT INTO `jadwal_kelas` (`Id_jadwal`, `Id_kelas`, `Kd_guru`, `Thn_ajaran`, `Semester`) VALUES
(7, 1, 'G-002', '2025/2026', 'genap');

-- --------------------------------------------------------

--
-- Table structure for table `Kelas`
--

CREATE TABLE `Kelas` (
  `Id_kelas` int(11) NOT NULL,
  `Nm_kelas` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Kelas`
--

INSERT INTO `Kelas` (`Id_kelas`, `Nm_kelas`) VALUES
(1, 'Desain Komunikasi Visual'),
(2, 'Pemrograman Web'),
(3, 'Desain Ui/Ux'),
(4, 'Fotografi'),
(5, 'Videografi'),
(6, 'Otomotif'),
(7, 'TJKT'),
(98765, 'sdfghjk,');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` varchar(5) NOT NULL,
  `nm_mapel` varchar(35) NOT NULL,
  `kkm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nm_mapel`, `kkm`) VALUES
('M-002', 'Desain', 90),
('M-003', 'Desain Grafis', 75),
('M-005', 'Pemrograman Web', 80),
('M-006', 'Desain Grafis', 75),
('M-007', 'PPKN', 89);

-- --------------------------------------------------------

--
-- Table structure for table `Siswa`
--

CREATE TABLE `Siswa` (
  `Nis` varchar(10) NOT NULL,
  `Id_user` int(11) DEFAULT NULL,
  `Nm_siswa` varchar(50) DEFAULT NULL,
  `Jenkel` varchar(10) DEFAULT NULL,
  `Hp` varchar(13) DEFAULT NULL,
  `Id_kelas` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Siswa`
--

INSERT INTO `Siswa` (`Nis`, `Id_user`, `Nm_siswa`, `Jenkel`, `Hp`, `Id_kelas`) VALUES
('0063778286', 2, 'Sela', 'P', '088773773737', '1'),
('0067503839', 1, 'Dedi Fitrianto', 'L', '085841954944', '1');

-- --------------------------------------------------------

--
-- Table structure for table `skripsi_2511500086`
--

CREATE TABLE `skripsi_2511500086` (
  `id_skripsi086` varchar(5) NOT NULL,
  `judul_skripsi086` varchar(50) NOT NULL,
  `topik086` varchar(20) NOT NULL,
  `semester086` varchar(20) NOT NULL,
  `thn_ajaran086` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skripsi_2511500086`
--

INSERT INTO `skripsi_2511500086` (`id_skripsi086`, `judul_skripsi086`, `topik086`, `semester086`, `thn_ajaran086`) VALUES
('S001', 'dedi', 'dedi', 'Genap', '2023/2024'),
('S002', 'kiki', 'kuku', 'Gasal', '2022/2023');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailjadwal`
--
ALTER TABLE `detailjadwal`
  ADD PRIMARY KEY (`Id_detail`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`Kd_guru`);

--
-- Indexes for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  ADD PRIMARY KEY (`Id_jadwal`);

--
-- Indexes for table `Kelas`
--
ALTER TABLE `Kelas`
  ADD PRIMARY KEY (`Id_kelas`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`);

--
-- Indexes for table `Siswa`
--
ALTER TABLE `Siswa`
  ADD PRIMARY KEY (`Nis`);

--
-- Indexes for table `skripsi_2511500086`
--
ALTER TABLE `skripsi_2511500086`
  ADD PRIMARY KEY (`id_skripsi086`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `detailjadwal`
--
ALTER TABLE `detailjadwal`
  MODIFY `Id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_kelas`
--
ALTER TABLE `jadwal_kelas`
  MODIFY `Id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
