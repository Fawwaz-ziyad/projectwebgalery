-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 20 Apr 2025 pada 18.51
-- Versi server: 8.0.30
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webgalery`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `foto`
--

CREATE TABLE `foto` (
  `id` int NOT NULL,
  `galery_id` int DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `foto`
--

INSERT INTO `foto` (`id`, `galery_id`, `file`, `judul`) VALUES
(1, 1, '1745027840_ppdb.jpg', 'PPDB'),
(2, 3, '1745175069_027457600_1600754989-photo-1542744173-8e7e53415bb0__4_.jpg', 'PESISIR 2023'),
(3, 4, '1745034418_peta.jpg', 'peta'),
(4, 5, '1745038481_maulid.jpeg', 'Maulid 2025');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galery`
--

CREATE TABLE `galery` (
  `id` int NOT NULL,
  `post_id` int DEFAULT NULL,
  `position` int DEFAULT NULL,
  `status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galery`
--

INSERT INTO `galery` (`id`, `post_id`, `position`, `status`) VALUES
(1, 1, 1, 1),
(3, 4, 2, 0),
(4, NULL, 999, 1),
(5, 5, 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `judul`) VALUES
(1, 'Informasi Terkini'),
(6, 'Galeri Sekolah'),
(7, 'Agenda Sekolah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'ziyad', 'adfdffb9983534659fd3553af85913b5', '2025-04-18 06:31:49'),
(2, 'admin', '0192023a7bbd73250516f069df18b500', '2025-04-19 01:29:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `isi` text,
  `petugas_id` int DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `judul`, `kategori_id`, `isi`, `petugas_id`, `status`, `created_at`) VALUES
(1, 'PPDB', 1, 'Penerimaan Peserta Didik Baru (PPDB) adalah proses seleksi bagi calon siswa yang ingin masuk ke jenjang pendidikan tertentu, seperti SD, SMP, dan SMA. Pada tahun 2025, sistem PPDB mengalami perubahan menjadi Sistem Penerimaan Murid Baru (SPMB), yang menggantikan mekanisme zonasi dengan sistem domisili. Artinya, seleksi tidak lagi berdasarkan jarak rumah ke sekolah, tetapi lebih mempertimbangkan wilayah administratif tempat tinggal calon siswa. Selain itu, kuota jalur afirmasi bagi siswa dari keluarga kurang mampu juga ditingkatkan, serta ada kebijakan baru yang memungkinkan siswa yang tidak tertampung di sekolah negeri untuk bersekolah di swasta dengan biaya yang ditanggung pemerintah.\r\n\r\nProses PPDB 2025 dilakukan secara bertahap, dimulai dari perencanaan pada bulan Maret, sosialisasi pada bulan April, dan pendaftaran yang diumumkan paling lambat minggu pertama Mei. Seleksi dilakukan melalui beberapa jalur, seperti jalur domisili, afirmasi, perpindahan tugas orang tua, dan prestasi, dengan kuota yang telah ditentukan untuk masing-masing jalur. Pemerintah menargetkan sistem ini lebih transparan dan adil, sehingga semua siswa memiliki kesempatan yang sama untuk mendapatkan pendidikan berkualitas. Jika ingin mendaftar, calon siswa dan orang tua perlu memperhatikan jadwal serta persyaratan yang berlaku di daerah masing-masing.\r\n', 2, 'publish', '2025-04-19 01:35:47'),
(3, 'PPDB Gelombang 2', 7, 'Penerimaan Peserta Didik Baru (PPDB) adalah proses seleksi bagi calon siswa yang ingin masuk ke jenjang pendidikan tertentu, seperti SD, SMP, dan SMA. Pada tahun 2025, sistem PPDB mengalami perubahan menjadi Sistem Penerimaan Murid Baru (SPMB), yang menggantikan mekanisme zonasi dengan sistem domisili. Artinya, seleksi tidak lagi berdasarkan jarak rumah ke sekolah, tetapi lebih mempertimbangkan wilayah administratif tempat tinggal calon siswa. Selain itu, kuota jalur afirmasi bagi siswa dari keluarga kurang mampu juga ditingkatkan, serta ada kebijakan baru yang memungkinkan siswa yang tidak tertampung di sekolah negeri untuk bersekolah di swasta dengan biaya yang ditanggung pemerintah.\r\n\r\nProses PPDB 2025 dilakukan secara bertahap, dimulai dari perencanaan pada bulan Maret, sosialisasi pada bulan April, dan pendaftaran yang diumumkan paling lambat minggu pertama Mei. Seleksi dilakukan melalui beberapa jalur, seperti jalur domisili, afirmasi, perpindahan tugas orang tua, dan prestasi, dengan kuota yang telah ditentukan untuk masing-masing jalur. Pemerintah menargetkan sistem ini lebih transparan dan adil, sehingga semua siswa memiliki kesempatan yang sama untuk mendapatkan pendidikan berkualitas. Jika ingin mendaftar, calon siswa dan orang tua perlu memperhatikan jadwal serta persyaratan yang berlaku di daerah masing-masing.', 2, 'publish', '2025-04-19 01:41:39'),
(4, 'Kegiatan Pekan Syiar Islam Ramadan ( Pesisir) 2023 ', 6, 'Kegiatan Pekan Syiar Islam Ramadan ( Pesisir) 2023 dengan tema kegiatan \" menjadi generasi cerdas dan berakhlak mulia dengan Alquran.  Kegiatan yang bertempat  di SMK Raflesia ini berlangsung selama 4 hari dimulai dari tanggal 3 - 6 April 2023.\r\n\r\nAdapun tujuan diadakan kegiatan Pekan Spirit dan Syiar Ramadhan ( Pesisir ) adalah sebagai berikut:\r\n1. Menanamkan pemahaman ajaran Alquran  bagi peserta didik SMK Raflesia \r\n2. Menghidupkan suasana dibulan ramadhan dengan berbagai macam kegiatan religius\r\n3. Meningkatkan iman dan taqwa dengan cara memahami ilmu - ilmu keagamaan secara intensif\r\n4. Memberikan wawasan yang lebih luas tentang dunia Islam kepada peserta didik\r\n5. Menjalankan program kalender pendidikan sekolah SMK Raflesia \r\n6. Menjalin kekeluargaan dan silaturahmi antar sivitas SMK Raflesia \r\n7. Menumbuhkan rasa kepekaan terhadap sesama\r\n\r\nBentuk kegiatan pesantren Ramadhan adalah sebagai berikut:\r\n\r\n1. Tadarus , tahfiz Qur an dan doa bersama\r\n2. Kuliah puasa ( KUPAS )\r\n3. Wejangan dan kajian Alquran ( Wajiq)\r\n4. Musabaqah ( perlombaan)\r\n5. Buka puasa bersama', 1, 'publish', '2025-04-19 02:14:41'),
(5, 'Maulid 2023', 6, 'Maulid Nabi Muhammad SAW adalah peringatan hari kelahiran Nabi Muhammad yang jatuh pada tanggal 12 Rabiul Awal dalam kalender Hijriah. Pada tahun 2025, Maulid Nabi diperingati pada 5 September, yang juga ditetapkan sebagai hari libur nasional di Indonesia. Peringatan ini menjadi momen bagi umat Islam untuk mengenang sejarah dan perjuangan Rasulullah dalam menyebarkan ajaran Islam serta meneladani akhlak mulianya.\r\nDi berbagai daerah di Indonesia, Maulid Nabi dirayakan dengan beragam tradisi khas yang mencerminkan budaya setempat. Misalnya, tradisi Sekaten di Yogyakarta, Panjang Jimat di Cirebon, dan Bunga Lado di Padang. Selain itu, banyak masjid dan komunitas Muslim mengadakan pengajian, pembacaan shalawat, serta kegiatan sosial seperti berbagi makanan dan santunan kepada yang membutuhkan. Semua ini dilakukan sebagai bentuk penghormatan dan kecintaan kepada Nabi Muhammad SAW.\r\nPeringatan Maulid Nabi juga menjadi kesempatan bagi umat Islam untuk memperkuat nilai-nilai kebersamaan dan kepedulian sosial. Dengan mengikuti ajaran Nabi, umat Islam diharapkan dapat menerapkan sikap saling menghormati, berbagi, dan menjaga persatuan. Di era modern ini, Maulid Nabi tidak hanya menjadi perayaan tradisional, tetapi juga momentum untuk merefleksikan bagaimana ajaran Rasulullah dapat diterapkan dalam kehidupan sehari-hari.\r\n', 1, 'publish', '2025-04-19 04:51:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profile`
--

CREATE TABLE `profile` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `profile`
--

INSERT INTO `profile` (`id`, `judul`, `isi`, `created_at`) VALUES
(1, 'peta', 'Penerimaan Peserta Didik Baru (PPDB) adalah proses seleksi bagi calon siswa yang ingin masuk ke jenjang pendidikan tertentu, seperti SD, SMP, dan SMA. Pada tahun 2025, sistem PPDB mengalami perubahan menjadi Sistem Penerimaan Murid Baru (SPMB), yang menggantikan mekanisme zonasi dengan sistem domisili. Artinya, seleksi tidak lagi berdasarkan jarak rumah ke sekolah, tetapi lebih mempertimbangkan wilayah administratif tempat tinggal calon siswa. Selain itu, kuota jalur afirmasi bagi siswa dari keluarga kurang mampu juga ditingkatkan, serta ada kebijakan baru yang memungkinkan siswa yang tidak tertampung di sekolah negeri untuk bersekolah di swasta dengan biaya yang ditanggung pemerintah.\r\n\r\nProses PPDB 2025 dilakukan secara bertahap, dimulai dari perencanaan pada bulan Maret, sosialisasi pada bulan April, dan pendaftaran yang diumumkan paling lambat minggu pertama Mei. Seleksi dilakukan melalui beberapa jalur, seperti jalur domisili, afirmasi, perpindahan tugas orang tua, dan prestasi, dengan kuota yang telah ditentukan untuk masing-masing jalur. Pemerintah menargetkan sistem ini lebih transparan dan adil, sehingga semua siswa memiliki kesempatan yang sama untuk mendapatkan pendidikan berkualitas. Jika ingin mendaftar, calon siswa dan orang tua perlu memperhatikan jadwal serta persyaratan yang berlaku di daerah masing-masing.\r\n', '2025-04-19 01:59:32');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galery_id` (`galery_id`);

--
-- Indeks untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `petugas_id` (`petugas_id`);

--
-- Indeks untuk tabel `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `galery`
--
ALTER TABLE `galery`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`galery_id`) REFERENCES `galery` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `galery`
--
ALTER TABLE `galery`
  ADD CONSTRAINT `galery_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
