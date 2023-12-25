-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 06:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dss_profile_matching`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_pelamar`
--

CREATE TABLE `master_pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `nama_pelamar` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_pelamar`
--

INSERT INTO `master_pelamar` (`id_pelamar`, `nama_pelamar`, `no_hp`, `email`) VALUES
(1, 'Farhan Muhammad', '081212678712', 'FarhanMuhammad@gmail.com'),
(2, 'Irfan Priyadi Nurfauzi', '081212678712', 'IrfanPriyadiNurfauzi@gmail.com'),
(3, 'Muhamad Firdaus', '081212678712', 'MuhamadFirdaus@gmail.com'),
(4, 'Randi Agus Revaldi', '081212678712', 'RandiAgusRevaldi@gmail.com'),
(5, 'Sulthan Aldi Budiono', '081212678712', 'SulthanAldiBudiono@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` tinyint(1) NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `tgl_dibuat` datetime NOT NULL,
  `diubah_oleh` int(11) NOT NULL,
  `tgl_diubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id_user`, `username`, `nama`, `password`, `level`, `dibuat_oleh`, `tgl_dibuat`, `diubah_oleh`, `tgl_diubah`) VALUES
(1, 'HRD', 'Muhamad Fikri Rahmat', '21232f297a57a5a743894a0e4a801fc3', 1, 1, '2020-08-25 22:05:05', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pm_aspek`
--

CREATE TABLE `pm_aspek` (
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `aspek` varchar(100) NOT NULL,
  `prosentase` float NOT NULL,
  `bobot_core` float NOT NULL,
  `bobot_secondary` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_aspek`
--

INSERT INTO `pm_aspek` (`id_aspek`, `aspek`, `prosentase`, `bobot_core`, `bobot_secondary`) VALUES
(1, 'Kecerdasan', 40, 60, 40),
(2, 'Wawancara', 30, 60, 40),
(3, 'Sikap Kerja', 30, 60, 40);

-- --------------------------------------------------------

--
-- Table structure for table `pm_bobot`
--

CREATE TABLE `pm_bobot` (
  `selisih` tinyint(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_bobot`
--

INSERT INTO `pm_bobot` (`selisih`, `bobot`, `keterangan`) VALUES
(0, 5, 'Tidak ada selisih (kompetensi sesuai dgn yg dibutuhkan)'),
(1, 4.5, 'Kompetensi individu kelebihan 1 tingkat'),
(-1, 4, 'Kompetensi individu kekurangan 1 tingkat'),
(2, 3.5, 'Kompetensi individu kelebihan 2 tingkat'),
(-2, 3, 'Kompetensi individu kekurangan 2 tingkat'),
(3, 2.5, 'Kompetensi individu  kelebihan 3 tingkat'),
(-3, 2, 'Kompetensi individu  kekurangan 3 tingkat'),
(4, 1.5, 'Kompetensi individu kelebihan 4 tingkat'),
(-4, 1, 'Kompetensi individu kekurangan 4 tingkat');

-- --------------------------------------------------------

--
-- Table structure for table `pm_faktor`
--

CREATE TABLE `pm_faktor` (
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `id_aspek` tinyint(3) UNSIGNED NOT NULL,
  `faktor` varchar(30) NOT NULL,
  `target` tinyint(3) NOT NULL,
  `type` set('core','secondary') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_faktor`
--

INSERT INTO `pm_faktor` (`id_faktor`, `id_aspek`, `faktor`, `target`, `type`) VALUES
(1, 1, 'Penguasaan Bahasa Pemprograman', 4, 'core'),
(2, 1, 'Kreatif', 4, 'secondary'),
(3, 1, 'Logika', 4, 'core'),
(4, 1, 'Inovatif', 3, 'secondary'),
(5, 2, 'Kejujuran', 4, 'core'),
(6, 2, 'Pengetahuan Tentang pekerjaan', 4, 'secondary'),
(7, 2, 'Pengalaman', 3, 'core'),
(8, 2, 'Karakter', 3, 'secondary'),
(9, 3, 'Kecepatan', 4, 'core'),
(10, 3, 'Ketelitian', 3, 'core'),
(11, 3, 'Inisiatif', 3, 'secondary'),
(12, 3, 'Percaya Diri', 3, 'secondary');

-- --------------------------------------------------------

--
-- Table structure for table `pm_ranking`
--

CREATE TABLE `pm_ranking` (
  `id_pelamar` int(11) NOT NULL,
  `nilai_akhir` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_ranking`
--

INSERT INTO `pm_ranking` (`id_pelamar`, `nilai_akhir`) VALUES
(8, '1.84'),
(1, '4.05'),
(2, '4.45'),
(3, '4.47'),
(4, '4.31'),
(5, '4.42'),
(9, '4.03');

-- --------------------------------------------------------

--
-- Table structure for table `pm_sample`
--

CREATE TABLE `pm_sample` (
  `id_sample` int(11) UNSIGNED NOT NULL,
  `id_pelamar` tinyint(3) UNSIGNED NOT NULL,
  `id_faktor` tinyint(3) UNSIGNED NOT NULL,
  `value` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pm_sample`
--

INSERT INTO `pm_sample` (`id_sample`, `id_pelamar`, `id_faktor`, `value`) VALUES
(532, 5, 8, 4),
(559, 9, 11, 3),
(556, 5, 12, 4),
(531, 5, 7, 4),
(530, 5, 6, 4),
(529, 5, 5, 2),
(528, 4, 8, 3),
(527, 4, 7, 4),
(512, 9, 4, 2),
(555, 5, 11, 3),
(526, 4, 6, 4),
(554, 5, 10, 4),
(525, 4, 5, 2),
(524, 3, 8, 3),
(553, 5, 9, 3),
(511, 9, 3, 2),
(552, 4, 12, 4),
(523, 3, 7, 4),
(560, 9, 12, 3),
(557, 9, 9, 3),
(522, 3, 6, 2),
(521, 3, 5, 4),
(534, 9, 6, 3),
(551, 4, 11, 3),
(520, 2, 8, 4),
(536, 9, 8, 3),
(519, 2, 7, 4),
(510, 9, 2, 3),
(550, 4, 10, 3),
(518, 2, 6, 4),
(517, 2, 5, 4),
(549, 4, 9, 4),
(548, 3, 12, 3),
(516, 1, 8, 3),
(515, 1, 7, 3),
(514, 1, 6, 3),
(547, 3, 11, 3),
(513, 1, 5, 2),
(546, 3, 10, 3),
(509, 9, 1, 2),
(508, 5, 4, 4),
(545, 3, 9, 3),
(507, 5, 3, 3),
(506, 5, 2, 4),
(544, 2, 12, 4),
(505, 5, 1, 4),
(504, 4, 4, 4),
(543, 2, 11, 3),
(503, 4, 3, 2),
(502, 4, 2, 2),
(542, 2, 10, 4),
(501, 4, 1, 4),
(500, 3, 4, 4),
(541, 2, 9, 4),
(499, 3, 3, 2),
(498, 3, 2, 4),
(558, 9, 10, 3),
(540, 1, 12, 2),
(497, 3, 1, 4),
(496, 2, 4, 4),
(495, 2, 3, 3),
(539, 1, 11, 3),
(494, 2, 2, 4),
(493, 2, 1, 2),
(533, 9, 5, 3),
(538, 1, 10, 2),
(492, 1, 4, 3),
(491, 1, 3, 2),
(535, 9, 7, 2),
(537, 1, 9, 4),
(490, 1, 2, 3),
(489, 1, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_pelamar`
--
ALTER TABLE `master_pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `pm_aspek`
--
ALTER TABLE `pm_aspek`
  ADD PRIMARY KEY (`id_aspek`);

--
-- Indexes for table `pm_bobot`
--
ALTER TABLE `pm_bobot`
  ADD PRIMARY KEY (`selisih`);

--
-- Indexes for table `pm_faktor`
--
ALTER TABLE `pm_faktor`
  ADD PRIMARY KEY (`id_faktor`);

--
-- Indexes for table `pm_sample`
--
ALTER TABLE `pm_sample`
  ADD PRIMARY KEY (`id_sample`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_pelamar`
--
ALTER TABLE `master_pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pm_aspek`
--
ALTER TABLE `pm_aspek`
  MODIFY `id_aspek` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pm_faktor`
--
ALTER TABLE `pm_faktor`
  MODIFY `id_faktor` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pm_sample`
--
ALTER TABLE `pm_sample`
  MODIFY `id_sample` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=561;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
