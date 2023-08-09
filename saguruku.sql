-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 01:10 AM
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
-- Database: `saguruku`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `image1_url` varchar(255) NOT NULL,
  `image2_url` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `experience_years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `image1_url`, `image2_url`, `heading`, `description`, `experience_years`) VALUES
(1, '../uploads/way of success.jpeg', '../uploads/Curso Online Asesoría Fiscal.jpeg', 'Leading the Way in Foreign Workforce Solutions', 'Kami adalah perusahaan yang berfokus pada solusi ketenagakerjaan asing. Di SAGURUKU, kami memahami betapa pentingnya mendapatkan talenta internasional yang berkualitas untuk mengembangkan bisnis Anda. Dengan pengalaman bertahun-tahun dalam mengurus proses ketenagakerjaan asing, kami bangga menjadi pemimpin dalam industri ini.', 2);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `no_telp`, `images`) VALUES
(2, 'idrus', '$2y$10$JHwC45ncCQVdkt.P2CO2g.XFFYBjmIc5Qm0whfeG0.85Qu/hNxcBG', 'idruswaliulu251@gmail.com', '081240262336', 'WhatsApp Image 2023-08-01 at 1.33.49 PM.jpeg'),
(3, 'rey', '$2y$10$Ea4u74HGXEmuWgJW.RZLjePM2WMyWdBuPpu5Yd68fnesGaU96z9FK', 'rey@gmail.com', '081240262336', 'Desain tanpa judul.png'),
(4, 'reval', '$2y$10$1oRxrSG1znvLhViCIhotTecs7eWYWfBc6rRrKp8jLkQc9HhU2ml3S', 'reval@gmail.com', '084161265', 'Curso Online Asesoría Fiscal.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `blog_details`
--

CREATE TABLE `blog_details` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `blog_link` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_details`
--

INSERT INTO `blog_details` (`id`, `title`, `image_url`, `content`, `blog_link`, `project_id`) VALUES
(7, 'Desyta Rina Marta Guritno', 'blog1.png', 'Punya blog pribadi tapi lama dianggurin? Wah sayang banget, padahal kalau mau diseriusi menjadi seorang blogger bisa jadi  pekerjaan yang penghasilannya lumayan. Coba deh sekarang tilik lagi blog yang sudah terbengkalai itu, setelah itu aktifkan dan kembangkan lagi mulai dari hal-hal kecil.\r\n\r\nKalau kamu bingung mau mulai dari mana, berikut ini ada beberapa hal yang bisa dilakukan untuk membuat blogmu selangkah lebih maju.', 'https://yoursay.suara.com/hobi/2023/07/14/134500/6-cara-agar-blog-pribadimu-selangkah-lebih-maju-sayang-kalau-dianggurin', 3),
(8, 'Veronika Yasinta', 'blog2.png', 'Indotnesia -  Aurel Hermansyah dan Atta Halilintar baru saja menggelar pesta gender reveal atau pengungkapan jenis kelamin calon buah hati. Pada momen spesial itu, keluarga besarnya berkumpul termasuk orangtua Atta dan Aurel, keluarga Krisdayanti dan Anang Hermansyah.', 'https://indotnesia.suara.com/read/2023/06/11/151301/ternyata-begini-kisah-awal-mula-tradisi-pesta-gender-reveal', 4),
(9, 'Prabu Putra Ruspawan', 'blog4.png', 'Sinopsis Film Dear David: Kisah Siswi SMA yang Terjerat Dalam Jeratan Blog Fantasi, Fantasi Laras Siswi Teladan yang Ternyata Seorang...', 'https://bandungbarat.suara.com/read/2023/06/07/221354/sinopsis-film-dear-david-kisah-siswi-sma-yang-terjerat-dalam-jeratan-blog-fantasi-fantasi-laras-siswi-teladan-yang-ternyata-seorang', 5),
(10, 'Fabiola Febrinastri', 'blog3.png', 'Digitalisasi Berkembang, Pembuatan Blog dan Website Pribadi Jadi Pilihan untuk Hasilkan Uang dari Rumah', 'https://www.suara.com/pressrelease/2023/05/20/102500/digitalisasi-berkembang-pembuatan-blog-dan-website-pribadi-jadi-pilihan-untuk-hasilkan-uang-dari-rumah', 6),
(11, 'Selpia SutriYani', 'blog5.png', 'Kiat Mencari Topik Artikel saat Mengalami Kebuntuan Ide, yuk Lakukan!', 'https://yoursay.suara.com/hobi/2023/04/17/150602/kiat-mencari-topik-artikel-saat-mengalami-kebuntuan-ide-yuk-lakukan', 7);

-- --------------------------------------------------------

--
-- Table structure for table `blog_projects`
--

CREATE TABLE `blog_projects` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_projects`
--

INSERT INTO `blog_projects` (`id`, `title`, `image_url`) VALUES
(3, 'Desyta Rina Marta Guritno', 'Screenshot 2023-08-03 055218.png'),
(4, 'Veronika Yasinta', 'Screenshot 2023-08-03 055717.png'),
(5, 'Prabu Putra Ruspawan', 'Screenshot 2023-08-03 060002.png'),
(6, 'Fabiola Febrinastri', 'Screenshot 2023-08-03 060419.png'),
(7, 'Selpia SutriYani', 'Screenshot 2023-08-03 060601.png');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption_title` varchar(255) NOT NULL,
  `caption_subtitle` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `image_url`, `caption_title`, `caption_subtitle`) VALUES
(7, 'Labour Lawyers in Vietnam Share Opinions on Labour Contract.jpeg', 'Welcom To', 'Saguruku Andalan Pratama'),
(8, 'ANT Lawyers Sharing on Contract Negotiations at EuroCham.jpeg', 'SAGURUKU ANDALAN PRATAMA', 'Saguruku memberikan layanan profesional untuk memudahkan urusan Anda'),
(9, 'Why Do You Need a Criminal Defense Attorney After an Accident _ The Handley Law Center.jpeg', 'SAGURUKU ANDALAN PRATAMA', 'Saguruku hadir untuk memudahkan proses ketenagakerjaan asing Anda');

-- --------------------------------------------------------

--
-- Table structure for table `facts`
--

CREATE TABLE `facts` (
  `id` int(11) NOT NULL,
  `icon_class` varchar(50) NOT NULL,
  `count` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facts`
--

INSERT INTO `facts` (`id`, `icon_class`, `count`, `label`) VALUES
(1, 'fa fa-check-double fa-3x text-white mb-3', 500, 'Projects Done'),
(2, 'fa fa-users fa-3x text-white mb-3', 196, 'Happy Clients');

-- --------------------------------------------------------

--
-- Table structure for table `individual_features`
--

CREATE TABLE `individual_features` (
  `id` int(11) NOT NULL,
  `main_feature_id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `individual_features`
--

INSERT INTO `individual_features` (`id`, `main_feature_id`, `icon`, `title`, `description`) VALUES
(1, 1, 'fa fa-check text-white', 'Proses Cepat dan Efisien', 'Kami menyediakan paket New ITA dengan proses cepat dan efisien untuk mendukung\r\n kebutuhan perusahaan Anda dalam merekrut karyawan internasional.'),
(2, 1, 'fa fa-check text-white', 'Solusi Terpadu', 'Paket Rekawak ITAS kami mencakup berbagai layanan yang terintegrasi, termasuk perpanjangan izin tinggal dan administrasi yang diperlukan.'),
(4, 1, 'fa fa-check text-white', 'Kemudahan Pengajuan', 'Layanan VKUBP kami memudahkan pengajuan visa kunjungan ulang untuk keperluan bisnis pendek');

-- --------------------------------------------------------

--
-- Table structure for table `main_features`
--

CREATE TABLE `main_features` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `main_features`
--

INSERT INTO `main_features` (`id`, `title`, `description`) VALUES
(1, 'Few Reasons Why People Choosing Us!', 'Kami adalah mitra yang berpengalaman dalam menyediakan solusi ketenagakerjaan asing. Dengan pengetahuan mendalam tentang hukum dan regulasi internasional, kami menghadirkan layanan yang terpercaya untuk memenuhi kebutuhan ketenagakerjaan perusahaan Anda.');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `image_url`, `description`) VALUES
(1, 'Paket New Itas', 'service_1691006086_itas3.jpeg', 'Kami menyediakan paket New ITA dengan proses cepat dan efisien untuk mendukung kebutuhan perusahaan Anda dalam merekrut karyawan internasional.'),
(2, 'Paket Renewal Itas', 'service_1691006153_itas3.jpeg', 'Layanan perpanjangan izin tinggal terintegrasi untuk pemegang Izin Tinggal Terbatas (ITAS).\"'),
(3, 'Epo', 'service_1691006274_itas3.jpeg', 'Epo adalah singkatan dari European Patent Office, yaitu organisasi yang bertanggung jawab untuk menerbitkan dan mengelola paten di wilayah Eropa.'),
(4, 'Mutasi Pasport', 'service_1691006341_itas3.jpeg', 'Mutasi Paspor adalah proses mengubah atau mengganti informasi pada paspor yang telah diterbitkan sebelumnya'),
(5, 'Ali Status', 'service_1691006387_itas3.jpeg', 'Ali Status adalah istilah untuk menggambarkan seseorang yang memiliki izin tinggal terbatas (ITAS) di Indonesia karena perkawinan dengan Warga Negara Indonesia (WNI).'),
(6, 'Visit Visa, Renewal, VKUBP', 'service_1691006450_itas3.jpeg', 'Visit Visa adalah izin kunjungan sementara untuk masuk ke negara tertentu, Renewal adalah proses perpanjangan izin tinggal, dan VKUBP adalah Visa Kunjungan untuk Kegiatan Usaha dan Bisnis di Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `service_details`
--

CREATE TABLE `service_details` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `details_text` text NOT NULL,
  `additional_info` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_details`
--

INSERT INTO `service_details` (`id`, `service_id`, `details_text`, `additional_info`) VALUES
(1, 1, 'Paket New Itas', 'Paket New ITAS adalah layanan yang disediakan untuk membantu perusahaan dalam merekrut karyawan internasional dengan proses cepat dan efisien. ITAS (Izin Tinggal Terbatas) adalah izin tinggal yang diberikan kepada warga negara asing untuk tinggal dan bekerja di Indonesia dalam jangka waktu tertentu.\r\n\r\n\r\nPaket New ITAS mencakup berbagai layanan yang diperlukan dalam proses perekrutan karyawan internasional, termasuk proses pengajuan dan pengurusan izin tinggal, pengurusan dokumen dan persyaratan administratif, serta dukungan dalam proses adaptasi dan akomodasi bagi karyawan asing yang baru tiba di Indonesia.\r\n\r\n\r\nUndang-undang yang berlaku terkait perekrutan karyawan internasional dan izin tinggal di Indonesia adalah Undang-Undang Nomor 6 Tahun 2011 tentang Keimigrasian. Undang-undang ini mengatur tentang tata cara pemberian izin tinggal terbatas bagi warga negara asing yang ingin tinggal dan bekerja di Indonesia.\r\n\r\nBeberapa hal yang diatur dalam Undang-Undang Keimigrasian terkait perekrutan karyawan internasional antara lain:\r\n\r\nIzin Tinggal Terbatas (ITAS): Undang-Undang ini mengatur tentang persyaratan dan prosedur untuk mendapatkan izin tinggal terbatas bagi warga negara asing yang ingin bekerja di Indonesia.\r\n\r\nSponsorship: Perusahaan yang ingin merekrut karyawan internasional harus menjadi sponsor atau pemberi jaminan untuk mendukung permohonan izin tinggal karyawan tersebut.\r\n\r\nTenaga Kerja Asing (TKA): Undang-Undang Keimigrasian juga mengatur tentang tenaga kerja asing, termasuk jumlah maksimal TKA yang diizinkan bekerja di Indonesia dan persyaratan tertentu yang harus dipenuhi.\r\n\r\nPengawasan dan Sanksi: Undang-Undang ini juga mengatur tentang pengawasan terhadap karyawan internasional yang bekerja di Indonesia serta sanksi yang diberikan apabila ada pelanggaran terhadap ketentuan izin tinggal dan keimigrasian.\r\n\r\nPenting untuk mematuhi semua ketentuan hukum yang berlaku terkait perekrutan karyawan internasional dan izin tinggal di Indonesia. Hal ini untuk menjaga kepatuhan perusahaan terhadap regulasi negara dan mencegah terjadinya masalah hukum yang dapat berdampak negatif bagi perusahaan dan karyawan yang bersangkutan. Oleh karena itu, sebaiknya perusahaan yang berencana merekrut karyawan internasional untuk berkonsultasi dengan ahli hukum atau perusahaan jasa keimigrasian yang berpengalaman guna memastikan semua prosedur dan persyaratan diikuti dengan benar dan sesuai dengan hukum yang berlaku.'),
(4, 2, 'Paket Renewal Itas', 'Paket Renewal ITAS adalah layanan untuk memperpanjang izin tinggal (Izin Tinggal Terbatas) bagi para tenaga kerja asing yang telah bekerja di Indonesia dan ingin melanjutkan tinggal dan bekerja di negara ini. ITAS adalah dokumen izin tinggal yang dikeluarkan oleh Direktorat Jenderal Imigrasi Indonesia kepada Warga Negara Asing (WNA) yang memenuhi syarat untuk bekerja atau tinggal sementara di Indonesia.\r\n\r\nUndang-Undang yang mengatur tentang izin tinggal dan keimigrasian di Indonesia adalah Undang-Undang Nomor 6 Tahun 2011 tentang Keimigrasian. Undang-Undang ini mengatur tentang berbagai jenis izin tinggal, termasuk Izin Tinggal Terbatas (ITAS) dan prosedur perpanjangannya.\r\n\r\nProses perpanjangan ITAS, juga dikenal sebagai Paket Renewal ITAS, melibatkan beberapa tahapan, antara lain:\r\n\r\nPemeriksaan Kembali (Re-Assessment): Calon pemberi kerja (sponsor) atau WNA yang memiliki ITAS harus mengajukan permohonan perpanjangan ITAS kepada Kepala Kantor Imigrasi yang berwenang. Permohonan ini mencakup pemeriksaan ulang terhadap status dan kelayakan WNA untuk melanjutkan tinggal dan bekerja di Indonesia.\r\n\r\nPembayaran Biaya: Setelah permohonan diterima, calon pemberi kerja atau WNA yang bersangkutan harus membayar biaya administrasi dan pungutan sesuai dengan ketentuan yang berlaku.\r\n\r\nPeninjauan Lapangan (Field Inspection): Dalam beberapa kasus, petugas imigrasi dapat melakukan peninjauan lapangan untuk memverifikasi informasi yang terkait dengan pekerjaan dan tinggal WNA di Indonesia.\r\n\r\nPenerbitan ITAS Baru: Jika permohonan diterima dan dinyatakan memenuhi persyaratan, petugas imigrasi akan menerbitkan ITAS baru dengan jangka waktu yang ditentukan sesuai dengan ketentuan hukum.\r\n\r\nAdapun Undang-Undang Keimigrasian juga mengatur berbagai kewajiban dan hak bagi WNA yang memiliki ITAS, termasuk aturan terkait perpanjangan izin tinggal, larangan kerja di sektor tertentu, serta hak dan kewajiban lainnya yang harus dipatuhi oleh WNA selama tinggal di Indonesia.\r\n\r\nPenting untuk selalu mematuhi peraturan dan prosedur yang berlaku terkait izin tinggal dan keimigrasian di Indonesia. Jika ada pertanyaan lebih lanjut mengenai proses perpanjangan ITAS atau informasi lebih lanjut tentang peraturan keimigrasian di Indonesia, sebaiknya menghubungi kantor imigrasi terdekat atau pengacara imigrasi yang terpercaya untuk mendapatkan bantuan dan panduan yang tepat.\r\n\r\n\r\n\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `service_images`
--

CREATE TABLE `service_images` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `image_url1` varchar(255) NOT NULL,
  `image_url2` varchar(255) DEFAULT NULL,
  `image_url3` varchar(255) DEFAULT NULL,
  `image_url4` varchar(255) DEFAULT NULL,
  `image_url5` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_images`
--

INSERT INTO `service_images` (`id`, `service_id`, `image_url1`, `image_url2`, `image_url3`, `image_url4`, `image_url5`) VALUES
(5, 1, '09b7600b-7fdb-4e22-9bef-1e2a97eb2ddb.jpeg', 'Hello UCLA_ _ Tiffany Bee.jpeg', 'how i wanna be.jpeg', 'Former Ivy League admissions officer reveals how they pick students.jpeg', 'The Decline and Fall of the Roman Empire_ Crosspost from r_oddlysatisfying credits to u_negrettino.jpeg'),
(7, 2, '64cacbdda1c37_ea00e740-bf75-4d34-b02c-9b97d73ea4c1.jpeg', '64cacbdda20e5_NYC_ skating in the night (1).jpeg', '64cacbdda23f0_3 Ekim 2020.jpeg', '64cacbdda2654_NYC_ skating in the night.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `testimonial_text` text NOT NULL,
  `image_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `youtube_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `youtube_url`) VALUES
(1, 'https://www.youtube.com/watch?v=PzRa9nWVpKU&ab_channel=BintangDiJerman');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blog_details`
--
ALTER TABLE `blog_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- Indexes for table `blog_projects`
--
ALTER TABLE `blog_projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facts`
--
ALTER TABLE `facts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `individual_features`
--
ALTER TABLE `individual_features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `main_feature_id` (`main_feature_id`);

--
-- Indexes for table `main_features`
--
ALTER TABLE `main_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_details`
--
ALTER TABLE `service_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `service_images`
--
ALTER TABLE `service_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_details`
--
ALTER TABLE `blog_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blog_projects`
--
ALTER TABLE `blog_projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `facts`
--
ALTER TABLE `facts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `individual_features`
--
ALTER TABLE `individual_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `main_features`
--
ALTER TABLE `main_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_details`
--
ALTER TABLE `service_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_images`
--
ALTER TABLE `service_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_details`
--
ALTER TABLE `blog_details`
  ADD CONSTRAINT `blog_details_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `blog_projects` (`id`);

--
-- Constraints for table `individual_features`
--
ALTER TABLE `individual_features`
  ADD CONSTRAINT `individual_features_ibfk_1` FOREIGN KEY (`main_feature_id`) REFERENCES `main_features` (`id`);

--
-- Constraints for table `service_details`
--
ALTER TABLE `service_details`
  ADD CONSTRAINT `service_details_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_images`
--
ALTER TABLE `service_images`
  ADD CONSTRAINT `service_images_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
