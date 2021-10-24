-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Sep 2020 pada 19.59
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartkost_new`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id_berita` int(20) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id_berita`, `judul`, `isi`, `gambar`, `tanggal`) VALUES
(34, 'laba-labae', 'Seperti namanya, laba-laba balon juga bisa melayang. Mereka biasanya menjangkau puncak pohon. Ketika ada angin kencang, laba-laba balon membiarkan tubuhnya terbang dibawa angin. Jaring yang mereka punyai dimanfaatkan untuk menentukan arah terbang.', 'IMG_20200703_171955.jpg', '2020-08-01'),
(35, 'Superman', 'Superhero ini digambarkan sebagai sosok lelaki bernama Kal-El yang sangat kuat dan berasal dari planet bernama Krypton. Ia dikirim ke bumi oleh orang tuanya ketika terjadi peperangan besar di planet kelahirannya.\r\n\r\nSedangkan ketika di bumi, Ia ditemukan dan dibesarkan oleh pasangan Jonathan Kent dan Martha Kent serta ia diberi nama Clark Kent.', 'superman.jpg', '2021-01-09'),
(36, 'Batman', 'Batman merupakan salah satu superhero yang tidak mempunyai kekuatan super. Namun dengan bantuan teknologi, intelegensi, dan pengetahuannya.', 'batman.jpg', '2021-05-13'),
(37, 'Ironman', 'Iron Man merupakan salah satu superhero paling populer yang berasal dari Marvel comics. Hampir seperti Batman, sebenarnya Iron Man tidak memiliki kekuatan super.', 'Iron Man.jpg', '2019-08-11'),
(38, 'Spiderman', 'Spiderman merupakan tokoh superhero ramah yang dibuat oleh penulis terkenal dari Marvel, Stan Lee dan pertama kali muncul pada tahun 1960-an.\r\n\r\nNama asli dari Spiderman yaitu Peter Parker, seorang remaja yang tinggal di Queens, Manhattan bersama bibinya bernama May Parker.\r\n\r\nAwal mula Peter parker menjadi Spiderman adalah ketika ia mengunjungi sebuah institut milik Norman Osborn.\r\n\r\nDi dalam sana, ia digigit oleh seekor laba-laba yang terkena radioaktif sehingga ia mempunyai berbagai kekuatan super seperti mampu mengeluarkan jaring laba-laba dari tangannya. Spiderman ini juga merupakan salah satu superhero yang mempunyai sifat jenaka dan ramah.', 'Spiderman.jpg', '2020-08-17'),
(39, 'HULK', 'Hulk merupakan sosok makhluk berbadan hijau besar dengan emosi yang sangat tinggi. Awal mula terciptanya Hulk ini adalah ketika Dr. Bruce Banner terkena ledakan dari bom gamma secara tidak sengaja.\r\n\r\nSemenjak itu, ketika Dr. Bruce Banner marah maka fisiknya akan berubah menjadi menyeramkan dan emosinya tidak terkendali.\r\n\r\nNamun dengan kecerdasan yang dimilikinya, akhirnya sosok Bruce Banner dan Hulk dapat bersatu dengan menjadi Professor Hulk yang mempunyai sifat pandai namun fisiknya kuat.', 'Hulk.jpg', '2020-02-02'),
(41, 'OKEKEKEK', 'BERITA', 'error.png', '2020-01-01'),
(42, 'TUPAI', 'QQQQQQQQQQQQQQQQQQQQQQQQQQQ', 'tupai.jpg', '2020-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logtime`
--

CREATE TABLE `logtime` (
  `id_log` int(11) NOT NULL,
  `perangkat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `keterangan` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `waktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `logtime`
--

INSERT INTO `logtime` (`id_log`, `perangkat`, `user`, `keterangan`, `waktu`) VALUES
(1, 'Lampu 1', 'admin', 'ON', 1598875392),
(2, 'Lampu 1', 'admin', 'OFF', 1598875412),
(3, 'Kipas 1', 'admin', 'ON', 1598875427),
(4, 'Kipas 1', 'admin', 'OFF', 1598875437),
(5, 'Kunci 1', 'admin', 'Open', 1598875445),
(6, 'Kunci 1', 'admin', 'Close', 1598875453),
(7, 'Lampu 2', 'admin', 'ON', 1598875465),
(8, 'Lampu 2', 'admin', 'OFF', 1598875471),
(9, 'Kipas 2', 'admin', 'ON', 1598875478),
(10, 'Kipas 2', 'admin', 'OFF', 1598875488),
(11, 'Kunci 2', 'admin', 'Open', 1598875503),
(12, 'Kunci 2', 'admin', 'Close', 1598875511),
(13, 'Lampu 1', 'user', 'ON', 1598875611),
(14, 'Kipas 1', 'user', 'ON', 1598875613),
(15, 'Kunci 1', 'user', 'Open', 1598875628),
(16, 'Kipas 1', 'user', 'OFF', 1598875629),
(17, 'Lampu 1', 'user', 'OFF', 1598875630),
(18, 'Kunci 1', 'user', 'Close', 1598875645);

-- --------------------------------------------------------

--
-- Struktur dari tabel `moderaspi`
--

CREATE TABLE `moderaspi` (
  `id_mode` int(11) NOT NULL,
  `mode` tinyint(1) NOT NULL COMMENT '1. Tambah User - 2. System Access'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `moderaspi`
--

INSERT INTO `moderaspi` (`id_mode`, `mode`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penghuni`
--

CREATE TABLE `penghuni` (
  `id_penghuni` int(20) NOT NULL,
  `foto_asli` varchar(30) NOT NULL,
  `foto_ktp` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(6) NOT NULL,
  `alamat_asal` text NOT NULL,
  `no_ruangan` varchar(10) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penghuni`
--

INSERT INTO `penghuni` (`id_penghuni`, `foto_asli`, `foto_ktp`, `nama`, `jenis_kelamin`, `alamat_asal`, `no_ruangan`, `no_hp`, `tanggal_masuk`) VALUES
(6, 'laba-laba.jpg', 'foto ktp.jpg', 'Siapa', 'Pria', 'Bandung', '2', '082911901119', '2020-08-12'),
(7, 'mesin gerinda.jpg', 'sakura3.jpg', 'wong', 'Pria', 'Brebes', '1', '08218910012', '2020-08-11'),
(8, 'foto ktp.jpg', 'error.png', 'Sepuluh', 'wanita', 'Jakarta', '1', '082189281121', '2020-08-02'),
(11, 'foto ktp.jpg', 'ikan terbang.jpg', 'Sepuluh', 'wanita', 'Jakarta', '1', '082189281121', '2020-08-01'),
(12, 'katak.jpg', 'superman.jpg', 'Coba', 'wanita', 'Bekasi', '2', '082189281121', '2020-08-20'),
(13, 'foto ktp 1.jpg', 'katak.jpg', 'Test', 'Pria', 'kjkjl', '1', '082189281121', '2020-08-17'),
(14, 'ikan gupy.png', 'foto ktp 1.jpg', 'Adit', 'Pria', 'Tegal', '1', '08123456723', '2020-08-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room1`
--

CREATE TABLE `room1` (
  `id_room1` int(11) NOT NULL,
  `kipas1` tinyint(20) NOT NULL,
  `lampu1` tinyint(20) NOT NULL,
  `kunci1` tinyint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `room1`
--

INSERT INTO `room1` (`id_room1`, `kipas1`, `lampu1`, `kunci1`) VALUES
(1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `room2`
--

CREATE TABLE `room2` (
  `id_room2` int(11) NOT NULL,
  `kipas2` tinyint(20) NOT NULL,
  `lampu2` tinyint(20) NOT NULL,
  `kunci2` tinyint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `room2`
--

INSERT INTO `room2` (`id_room2`, `kipas2`, `lampu2`, `kunci2`) VALUES
(1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`) VALUES
(1, 'Ruangan A'),
(2, 'Ruangan B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `scanrfid`
--

CREATE TABLE `scanrfid` (
  `id_rfid` int(11) NOT NULL,
  `rfid` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `scanrfid`
--

INSERT INTO `scanrfid` (`id_rfid`, `rfid`, `status`) VALUES
(1, 'f9-ac-a8-55-a8', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `rfid` varchar(30) NOT NULL,
  `ruangan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `is_admin`, `rfid`, `ruangan`) VALUES
(12, 'userb', 'user123', 3, '2-212-331-31', 2),
(29, 'admin', 'admin', 1, 'a', 1),
(30, 'user', 'user123', 2, 'aa-bb-cc-dd', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indeks untuk tabel `logtime`
--
ALTER TABLE `logtime`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `moderaspi`
--
ALTER TABLE `moderaspi`
  ADD PRIMARY KEY (`id_mode`);

--
-- Indeks untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  ADD PRIMARY KEY (`id_penghuni`);

--
-- Indeks untuk tabel `room1`
--
ALTER TABLE `room1`
  ADD PRIMARY KEY (`id_room1`);

--
-- Indeks untuk tabel `room2`
--
ALTER TABLE `room2`
  ADD PRIMARY KEY (`id_room2`);

--
-- Indeks untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `scanrfid`
--
ALTER TABLE `scanrfid`
  ADD PRIMARY KEY (`id_rfid`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id_berita` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `logtime`
--
ALTER TABLE `logtime`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `moderaspi`
--
ALTER TABLE `moderaspi`
  MODIFY `id_mode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `penghuni`
--
ALTER TABLE `penghuni`
  MODIFY `id_penghuni` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `room1`
--
ALTER TABLE `room1`
  MODIFY `id_room1` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `room2`
--
ALTER TABLE `room2`
  MODIFY `id_room2` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `scanrfid`
--
ALTER TABLE `scanrfid`
  MODIFY `id_rfid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
