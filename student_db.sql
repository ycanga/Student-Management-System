-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 09 Oca 2023, 21:56:32
-- Sunucu sürümü: 5.7.36
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `student_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `classes_id` int(11) NOT NULL AUTO_INCREMENT,
  `classes_name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `classes_count` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`classes_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `classes`
--

INSERT INTO `classes` (`classes_id`, `classes_name`, `classes_count`) VALUES
(1, '101', '25'),
(7, '102', '44'),
(8, '103', '35');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sifa_admin_page`
--

DROP TABLE IF EXISTS `sifa_admin_page`;
CREATE TABLE IF NOT EXISTS `sifa_admin_page` (
  `sifa_admin_page_id` int(11) NOT NULL AUTO_INCREMENT,
  `sifa_admin_page_name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_admin_page_url` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_admin_page_icons` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_admin_page_yetki` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`sifa_admin_page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sifa_admin_page`
--

INSERT INTO `sifa_admin_page` (`sifa_admin_page_id`, `sifa_admin_page_name`, `sifa_admin_page_url`, `sifa_admin_page_icons`, `sifa_admin_page_yetki`) VALUES
(83, 'Sınıflar', 'classes.php', 'mdi mdi-book-open-page-variant', 'Admin'),
(85, 'Öğrenciler', 'students.php', 'mdi mdi-account', 'Admin'),
(90, 'Yaka Kartı', 'cards.php', 'mdi mdi-contact-mail', 'Admin'),
(89, 'Öğrenci İçe Aktar', 'upload_student.php', 'mdi mdi-cloud-upload', 'Admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sifa_head`
--

DROP TABLE IF EXISTS `sifa_head`;
CREATE TABLE IF NOT EXISTS `sifa_head` (
  `sifa_id` int(11) NOT NULL AUTO_INCREMENT,
  `sifa_name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_icon` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_logo` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`sifa_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sifa_head`
--

INSERT INTO `sifa_head` (`sifa_id`, `sifa_name`, `sifa_icon`, `sifa_logo`) VALUES
(1, 'Öğrenci Sistemi', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sifa_user`
--

DROP TABLE IF EXISTS `sifa_user`;
CREATE TABLE IF NOT EXISTS `sifa_user` (
  `sifa_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `sifa_user_profile` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_user_name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_user_passwd` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_user_yetki` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`sifa_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sifa_user`
--

INSERT INTO `sifa_user` (`sifa_user_id`, `sifa_user_profile`, `sifa_user_name`, `sifa_user_passwd`, `sifa_user_yetki`) VALUES
(1, 'face15.jpg', 'admin', 'tBstKqPfGAF1/ZgS7aoE3g==', 'Admin');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sifa_yetkiler`
--

DROP TABLE IF EXISTS `sifa_yetkiler`;
CREATE TABLE IF NOT EXISTS `sifa_yetkiler` (
  `sifa_yetki_id` int(11) NOT NULL AUTO_INCREMENT,
  `sifa_yetki_name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `sifa_yetki_kod` int(11) NOT NULL,
  PRIMARY KEY (`sifa_yetki_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `sifa_yetkiler`
--

INSERT INTO `sifa_yetkiler` (`sifa_yetki_id`, `sifa_yetki_name`, `sifa_yetki_kod`) VALUES
(1, 'Admin', 1),
(2, 'Herkes', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_no` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `student_name` varchar(256) COLLATE utf8_turkish_ci NOT NULL,
  `student_class` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `student_lesson` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `student_exam` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `student_date` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `student_time` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2508 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
