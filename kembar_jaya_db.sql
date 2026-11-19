-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Jul 2025 pada 19.59
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kembar_jaya_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_content`
--

CREATE TABLE `about_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `section_type` enum('hero','main','services','vision','stats') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'main',
  `section_order` int(11) NOT NULL DEFAULT 1,
  `image_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_url` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stat_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `about_content`
--

INSERT INTO `about_content` (`id`, `title`, `content`, `section_type`, `section_order`, `image_url`, `status`, `created_at`, `updated_at`, `button_text`, `button_url`, `stat_number`) VALUES
(4, 'Visi Perusahaan', 'Menjadi perusahaan pengecoran logam terkemuka di Indonesia yang unggul dalam kualitas, inovasi, dan pelayanan, serta mampu bersaing di pasar nasional maupun internasional.', 'vision', 4, NULL, 'active', '2025-06-27 04:10:17', NULL, NULL, NULL, NULL),
(8, 'Solusi Konstruksi dan Manufaktur Berkualitas', 'CV KEMBAR JAYA ABADI adalah mitra terpercaya dalam jasa pengecoran logam dan permesinan, menyediakan kebutuhan berbagai spare part industri. Dengan material pilihan seperti FC, FCD, Steel, Mangansteel, Ni Hard, High Chrome, Kuningan, Bronze, Alumunium Bronze, SS304, SS306, SS316, hingga Alloy, sehingga kami pastikan setiap produk memiliki ketahanan dan presisi terbaik sesuai kebutuhan pelanggan', 'main', 1, 'uploads/about/about_1751001581_9707.png', 'active', '2025-06-27 04:20:45', '2025-07-06 09:26:42', 'Konsultasi Sekarang', 'https://wa.me/6281226177600', NULL),
(10, 'Layanan Kami', 'CV KEMBAR JAYA ABADI menyediakan layanan konstruksi dan manufaktur yang dirancang untuk memenuhi beragam kebutuhan pembangunan dan industri di Jawa Tengah. Kami memahami bahwa setiap proyek memiliki tantangan unik, itulah sebabnya kami menghadirkan solusi terintegrasi, efisien, dan berkualitas tinggi untuk mendukung kesuksesan klien.', 'services', 1, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(11, '', 'Tim kami berpengalaman dalam membangun berbagai infrastruktur mulai dari gedung komersial, perumahan, jalan, hingga jembatan. Dengan kombinasi teknologi modern dan tenaga ahli, kami memastikan setiap pekerjaan selesai tepat waktu dengan hasil yang optimal.', 'services', 2, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(12, '', 'Dalam bidang manufaktur, kami memproduksi komponen baja, material konstruksi custom, dan peralatan industri dengan presisi tinggi. Melalui proses produksi yang terkontrol, kami memberikan produk yang kokoh, tahan lama, dan sesuai spesifikasi.', 'services', 3, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(13, '', 'Dengan layanan lengkap mulai dari perencanaan, desain, produksi hingga pelaksanaan konstruksi, CV KEMBAR JAYA ABADI siap menjadi mitra strategis Anda untuk mewujudkan proyek impian dengan standar mutu terbaik.', 'services', 4, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(14, 'Visi Perusahaan', 'Menjadi perusahaan pengecoran logam terkemuka di Indonesia yang unggul dalam kualitas, inovasi, dan pelayanan, serta mampu bersaing di pasar nasional maupun internasional.', 'vision', 1, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(15, 'Misi 1', 'Menyediakan layanan pengecoran logam yang presisi dan berkualitas tinggi, sesuai standar industri dan kebutuhan pasar lokal maupun nasional.', 'vision', 2, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(16, 'Misi 2', 'Mengutamakan kepuasan pelanggan melalui ketepatan waktu, ketelitian produksi, dan layanan yang profesional.', 'vision', 3, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(17, 'Misi 3', 'Menjaga kelestarian lingkungan dengan menerapkan prinsip produksi yang ramah lingkungan dan efisien energi.', 'vision', 4, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(18, 'Penutup Visi Misi', 'Bersama CV KEMBAR JAYA ABADI, wujudkan proyek impian Anda dengan solusi terpercaya dan hasil maksimal. Hubungi kami untuk konsultasi dan penawaran terbaik.', 'vision', 5, '', 'active', '2025-06-27 04:20:45', NULL, '', '', NULL),
(19, 'Proyek Terselesaikan', 'Kami telah menyelesaikan lebih dari 500 proyek konstruksi yang mencakup pembangunan infrastruktur vital dan fasilitas industri di Pulau Jawa dengan presisi tinggi dan standar kualitas terbaik.', 'stats', 1, 'proyek terselesaikan.png', 'active', '2025-06-27 04:20:45', '2025-06-29 18:54:47', '', '', '500+'),
(20, 'Klien Terlayani', 'Lebih dari 200 klien dari berbagai sektor, mulai dari industri manufaktur, energi, hingga infrastruktur publik telah mempercayakan kebutuhan konstruksi dan komponen tekniknya kepada kami.', 'stats', 2, 'klien dilayani.png', 'active', '2025-06-27 04:20:45', '2025-06-27 04:20:54', '', '', '200+'),
(21, 'Komponen Diproduksi', 'Kami memproduksi ribuan komponen logam untuk berbagai sektor industri, dengan jaminan ketepatan spesifikasi, kekuatan material, dan ketahanan jangka panjang.', 'stats', 3, 'komponen diproduksi.png', 'active', '2025-06-27 04:20:45', '2025-06-27 04:20:54', '', '', '10K+');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin_kembar_jaya_abadi', 'admin@kembarjaya.com', '$2y$10$AbUFW/g2YEsfzMtXI.PRjOoaMyaZgGi65LEVjYnrEqWl1rpmmAolW', '2025-05-26 07:11:15', '2025-05-26 07:51:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `casting_services`
--

CREATE TABLE `casting_services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `casting_services`
--

INSERT INTO `casting_services` (`id`, `title`, `description`, `image_url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sand Casting (Pengecoran Pasir)', 'Proses pengecoran menggunakan cetakan pasir untuk menghasilkan produk dengan bentuk yang presisi dan fleksibilitas tinggi.', 'uploads/683c65e1316d3.jpeg', 1, 'active', '2025-05-26 15:43:00', '2025-07-06 09:10:03'),
(2, 'Rough Finishing (Finishing Kasar)', 'Layanan untuk menghilangkan sisa cetakan dan memperbaiki permukaan kasar pada hasil coran.', 'rough finishing.jpeg', 2, 'active', '2025-05-26 15:43:00', '2025-05-26 15:43:00'),
(3, 'Custom Casting (Pengecoran Kustom)', 'Pengecoran sesuai kebutuhan khusus pelanggan, dirancang untuk memenuhi spesifikasi unik.', 'custom casting.jpeg', 3, 'active', '2025-05-26 15:43:00', '2025-05-26 15:43:00'),
(4, 'Repair Casting (Perbaikan Coran)', 'Layanan perbaikan untuk memastikan hasil coran bebas cacat dan berkualitas tinggi.', 'repair casting.jpeg', 4, 'active', '2025-05-26 15:43:00', '2025-06-29 16:40:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri_services`
--

CREATE TABLE `galeri_services` (
  `id` int(11) NOT NULL,
  `category` enum('casting','turning','drilling') NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `galeri_services`
--

INSERT INTO `galeri_services` (`id`, `category`, `title`, `description`, `image_url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(6, 'casting', 'Casting Komponen Roda', 'Roda komponen industri dari proses pengecoran logam.', 'uploads/casting3.jpg', 3, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(7, 'casting', 'Cetakan Kuningan', 'Pengecoran logam kuningan untuk kebutuhan fitting pipa.', 'uploads/casting4.jpg', 4, 'inactive', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(8, 'casting', 'Casting As Roda', 'Proses casting untuk pembuatan as roda truk.', 'uploads/casting5.jpg', 5, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(9, 'casting', 'Manifold Casting', 'Komponen manifold hasil pengecoran logam.', 'uploads/casting6.jpg', 6, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(10, 'casting', 'Casting Dudukan Mesin', 'Dudukan mesin hasil pengecoran besi tuang.', 'uploads/casting7.jpg', 7, 'inactive', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(12, 'turning', 'As Gigi Gear', 'Pemrosesan turning pada as gigi transmisi.', 'uploads/turning2.jpg', 2, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(13, 'turning', 'Shaft Baja Karbon', 'Shaft dengan material baja karbon yang dibubut presisi.', 'uploads/turning3.jpg', 3, 'active', '2025-06-29 02:18:56', '2025-07-06 08:50:14'),
(14, 'turning', 'Bubut Pulley', 'Pembuatan pulley menggunakan mesin bubut CNC.', 'uploads/turning4.jpg', 4, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(15, 'turning', 'Spindle Motor', 'Spindle motor dibentuk menggunakan turning lathe.', 'uploads/turning5.jpg', 5, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(16, 'turning', 'Turned Fitting', 'Fitting pipa dibubut untuk presisi ukuran.', 'uploads/turning6.jpg', 6, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(18, 'drilling', 'Bor Duduk Komponen Valve', 'Proses drilling komponen valve dengan bor duduk.', 'uploads/drilling2.jpg', 2, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(19, 'drilling', 'Pengeboran Flange', 'Flange dibor untuk keperluan sambungan pipa.', 'uploads/drilling3.jpg', 3, 'inactive', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(20, 'drilling', 'Bor Presisi Lubang Baut', 'Pengeboran lubang baut untuk mesin industri.', 'uploads/drilling4.jpg', 4, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(21, 'drilling', 'Drilling Komponen Traktor', 'Komponen traktor dibor sesuai spesifikasi.', 'uploads/drilling5.jpg', 5, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(22, 'drilling', 'Bor Panel Kontrol', 'Panel kontrol dibor untuk pemasangan tombol.', 'uploads/drilling6.jpg', 6, 'active', '2025-06-29 02:18:56', '2025-06-29 02:18:56'),
(0, 'casting', 'Sand Casting', 'Proses pengecoran menggunakan cetakan pasir untuk menghasilkan produk dengan bentuk yang presisi dan fleksibilitas tinggi.', 'uploads/686a9863f11af.jpeg', 0, 'active', '2025-07-06 15:38:12', '2025-07-06 15:38:12'),
(0, 'casting', 'Rough Finishing', 'Layanan untuk menghilangkan sisa cetakan dan memperbaiki permukaan kasar pada hasil coran.', 'uploads/686a988a58db9.jpeg', 1, 'active', '2025-07-06 15:38:50', '2025-07-06 15:38:50'),
(0, 'casting', 'Custom Casting', 'Pengecoran sesuai kebutuhan khusus pelanggan, dirancang untuk memenuhi spesifikasi unik.', 'uploads/686a98c5f075b.jpeg', 2, 'active', '2025-07-06 15:39:49', '2025-07-06 15:39:49'),
(0, 'casting', 'Repair Casting', 'Layanan perbaikan untuk memastikan hasil coran bebas cacat dan berkualitas tinggi.', 'uploads/686a99226259e.jpeg', 0, 'active', '2025-07-06 15:41:22', '2025-07-06 15:41:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','confirmed','in_progress','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int(11) DEFAULT NULL,
  `metal_type` enum('FC (Cast Iron)','FCD (Ductile Cast Iron)','Steel (Baja)','Heat Resistant Steel','Mangan Steel','Alumunium','Kuningan (Brass)','Bronze','AB 2 (Alumunium Bronze)','SS304, (Stainless Steel 304)','SS316 (Stainless Steel 316)','SCH22 (Steel Casting Grade 12)','SCH13 (Steel Casting Grade 13)','Alloy') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_teknik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gambar_pola` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `name`, `email`, `phone`, `service_type`, `message`, `status`, `created_at`, `updated_at`, `quantity`, `metal_type`, `gambar_teknik`, `gambar_pola`, `address`) VALUES
(35, 'dsadsad', 'dsadsa@gmail.com', '23134', 'Turning (Bubut)', '', 'pending', '2025-07-06 17:19:01', '2025-07-06 17:19:01', 1, 'FC (Cast Iron)', '686ab00551a66.png', '686ab00551cf9.png', 'dsadsadsa'),
(36, 'bb', 'dsads1a@gmail.com', '23134', 'Casting (Pengecoran)', '', 'pending', '2025-07-06 17:20:06', '2025-07-06 17:20:06', 3, 'FC (Cast Iron)', '686ab0464b136.png', '686ab0464b44d.png', 'dsadsadsa'),
(37, 'fadiya', 'ji.mi.kour354@gmail.com', '082324', 'Turning (Bubut)', '', 'pending', '2025-07-06 17:32:00', '2025-07-06 17:32:00', 1, 'FCD (Ductile Cast Iron)', '686ab31005e1b.jpeg', '686ab3100614a.jpg', 'eh'),
(38, 'rthrtht', 'fey@gmail.com', '4575756', 'Turning (Bubut)', '', 'pending', '2025-07-06 17:35:11', '2025-07-06 17:35:11', 3, 'Steel (Baja)', '686ab3cf0dea2.jpeg', '686ab3cf0e0ef.jpg', 'Jalan Nitikan Baru'),
(39, 'fey', 'felianadia.91@gmail.com', '358923459824', 'Casting (Pengecoran)', '', 'pending', '2025-07-06 17:39:39', '2025-07-06 17:39:39', 2, 'Steel (Baja)', '686ab4dbd1829.png', '686ab4dbd1a8b.png', 'Jalan Nitikan Baruw'),
(40, 'nanad', 'tokoskincare@gmail.com', '53464574', 'Casting (Pengecoran)', '', 'pending', '2025-07-06 17:45:31', '2025-07-06 17:45:31', 7, 'Heat Resistant Steel', '686ab63b769e4.png', '686ab63b76de8.png', 'Jalan Nitikan Baruu'),
(41, 'nanad', 'tokoskincare@gmail.com', '53464574', 'Casting (Pengecoran)', '', 'pending', '2025-07-06 17:46:14', '2025-07-06 17:46:14', 7, 'Heat Resistant Steel', '686ab6660846e.png', '686ab66608704.png', 'Jalan Nitikan Baruu'),
(42, 'nanad', 'tokoskincare@gmail.com', '53464574', 'Casting (Pengecoran)', '', 'pending', '2025-07-06 17:46:22', '2025-07-06 17:46:22', 7, 'Heat Resistant Steel', '686ab66e7f7d5.png', '686ab66e7fa5e.png', 'Jalan Nitikan Baruu'),
(43, 'erghrjyt', '2200018159@webmail.uad.ac.id', '46756847599', 'Casting (Pengecoran)', '', 'pending', '2025-07-06 17:49:48', '2025-07-06 17:49:48', 8, 'FCD (Ductile Cast Iron)', '686ab73ce41c0.png', '686ab73ce43ee.png', 'Jalan Nitikan Baru'),
(44, 'rthrtht', 'ji.mi.kour350@gmail.com', '54768579', 'Casting (Pengecoran)', '', 'pending', '2025-07-06 17:53:24', '2025-07-06 17:53:24', 8, 'FCD (Ductile Cast Iron)', '686ab81403991.png', '686ab81404007.png', 'Jalan Nitikan Baru'),
(45, 'grger', 'ji.mi.kour350@gmail.com', '345346', 'Casting (Pengecoran)', '', 'confirmed', '2025-07-06 17:55:39', '2025-07-06 17:56:45', 9, 'Heat Resistant Steel', '686ab89b350c9.png', '686ab89b35366.png', 'Jalan Nitikan Baru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `page_url` varchar(100) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image_url`, `page_url`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Casting', 'Proses pengecoran logam berkualitas tinggi yang menggunakan teknologi modern untuk menghasilkan produk presisi, baik untuk kebutuhan standar maupun desain khusus.', 'repair casting.jpeg', 'pengecoran.html', 'active', 1, '2025-05-26 07:11:45', '2025-07-06 15:28:54'),
(2, 'Turning', 'Layanan pembubutan dengan mesin canggih untuk menciptakan komponen dengan ukuran presisi dan hasil permukaan yang optimal, sesuai kebutuhan industri.', 'taper turning.jpeg', 'bubut.html', 'active', 2, '2025-05-26 07:11:45', '2025-05-26 07:11:45'),
(11, 'Drilling', 'Proses pengeboran presisi tinggi yang dirancang untuk memenuhi spesifikasi teknis pelanggan, memastikan hasil yang akurat dan andal.', 'uploads/68342a28030bf.png', 'drilling.html', 'active', 3, '2025-05-26 08:45:28', '2025-05-26 08:45:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `service_type` enum('drilling','casting','turning') NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image_url`, `service_type`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Tapping', 'Pembuatan ulir dalam (internal thread) pada lubang yang telah dibor sesuai dengan spesifikasi yang dibutuhkan.', 'tapping.jpg', 'drilling', 3, 'active', '2025-05-26 17:20:45', '2025-06-29 19:12:06'),
(10, 'Reaming', 'Proses finishing lubang untuk mendapatkan dimensi yang presisi dan permukaan yang halus setelah pengeboran awal.', 'reaming.jpg', 'drilling', 4, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45'),
(11, 'Counterboring', 'Pembuatan lubang dengan diameter yang lebih besar pada bagian atas untuk menyembunyikan kepala baut atau mur.', 'counterboring.jpg', 'drilling', 5, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45'),
(12, 'Countersinking', 'Pembuatan chamfer atau sudut pada bagian atas lubang untuk kepala sekrup yang rata dengan permukaan material.', 'countersinking.jpg', 'drilling', 6, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `turning_services`
--

CREATE TABLE `turning_services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `turning_services`
--

INSERT INTO `turning_services` (`id`, `title`, `description`, `image_url`, `sort_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Conventional Turning (Pembubutan Tradisional)', 'Proses dasar pembubutan di mana pahat potong digunakan untuk mengurangi diameter benda kerja menjadi ukuran tertentu dengan gerakan longitudinal.', 'conventional turning.jpeg', 12, 'active', '2025-05-26 17:20:45', '2025-06-29 19:10:30'),
(2, 'Facing (Pembubutan Permukaan)', 'Proses pembubutan yang dilakukan untuk meratakan atau memperhalus permukaan ujung benda kerja dengan gerakan pahat melintang ke arah sumbu benda kerja.', 'facing turning.jpeg', 13, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45'),
(3, 'Taper Turning (Pembubutan Kerucut)', 'Proses pembubutan untuk menghasilkan bentuk kerucut pada benda kerja dengan mengatur sudut pahat terhadap sumbu benda kerja menggunakan teknik offset tailstock atau compound rest.', 'taper turning.jpeg', 14, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45'),
(4, 'Grooving (Pembuatan Alur)', 'Proses pemotongan untuk membuat alur (groove) pada permukaan benda kerja, biasanya digunakan untuk tempat cincin pengunci, segel, atau kebutuhan desain lainnya.', 'grooving.jpeg', 15, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45'),
(5, 'Parting', 'Proses memotong benda kerja menjadi dua bagian menggunakan pahat potong khusus yang sempit untuk menghasilkan pemisahan bersih.', 'parting.jpeg', 16, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45'),
(6, 'Knurling', 'Proses membuat pola bertekstur (seperti garis silang) pada permukaan benda kerja menggunakan alat knurling untuk meningkatkan pegangan atau estetika.', 'knurling.jpeg', 17, 'active', '2025-05-26 17:20:45', '2025-05-26 17:20:45');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about_content`
--
ALTER TABLE `about_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_section_type` (`section_type`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_section_order` (`section_order`),
  ADD KEY `idx_section_status` (`section_type`,`status`),
  ADD KEY `idx_order_status` (`section_order`,`status`);

--
-- Indeks untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `casting_services`
--
ALTER TABLE `casting_services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `created_at` (`created_at`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `turning_services`
--
ALTER TABLE `turning_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about_content`
--
ALTER TABLE `about_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `casting_services`
--
ALTER TABLE `casting_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `turning_services`
--
ALTER TABLE `turning_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
