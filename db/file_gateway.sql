-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2023 at 02:54 PM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `file_gateway`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

DROP TABLE IF EXISTS `akses`;
CREATE TABLE IF NOT EXISTS `akses` (
  `id_akses` int(15) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL COMMENT 'Setelah menjadi md5 bisa menjadi lebih panjang',
  `akses` varchar(20) NOT NULL COMMENT 'Admin, Consumer',
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id_akses`, `nama`, `kontak`, `email`, `password`, `akses`, `foto`) VALUES
(6, 'Solihul Hadi', '089601154726', 'dhiforester@gmail.com', 'f4a3229c9c5f1bdd9c6a6791080791b7', 'Admin', 'fb7edbefbf3c255a24a16ef6349bda.jpg'),
(25, 'Windy Yanuariska', '089601154721', 'windygiga@gmail.com', 'd748c957a0018bfe3d974f8c44e4f3b7', 'Customer', 'e9149d8e1a8c8dfcee20e8c6f4bcaf.jpg'),
(26, 'Santi Nursari', '08942342342', 'santinursari@gmail.com', '8aab6686729bae15bbb979b3bac166b2', 'Customer', '30a8d22759c583cc5a0538c999798c.jpg'),
(28, 'Budi Utomo', '0895651212', 'budiutomo@gmail.com', 'eca390c06ce2792c675ac3cb595aa4ce', 'Customer', 'a2fe11b9aecbf7264794b0b42afdfc.jpg'),
(30, 'Susan Susanti', '089601154723', 'susansusanti@gmail.com', 'a2ccef0d65f5efdc19d9b968f12d55a2', 'Customer', '84b02d6288cd93dc35e798f8dc92fd.jpg'),
(31, 'Jefri Nicol', '089601154729', 'jefrinicol@gmail.com', '0c8046f1e88d883b22f5b07c55e9a397', 'Customer', '9d7276614e570ed8cc39040d52f203.jpg'),
(32, 'Kiki Ikmalia', '089565121211', 'kiki_ikmalia@gmail.com', 'd3234b942ebb90d9f8feb70033daf81b', 'Customer', '99bb45ed475a051b79b8cd4d7b0d9e.jpg'),
(33, 'Rheza Alacahayu Ditia', '08967768677', 'rhezaalacahayuditia@gmail.com', 'b4ead377831dfc72357955f95c37d97b', 'Customer', '5114c9092ba28bf8528010cf7446d9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `api_key`
--

DROP TABLE IF EXISTS `api_key`;
CREATE TABLE IF NOT EXISTS `api_key` (
  `id_api_key` int(15) NOT NULL AUTO_INCREMENT,
  `id_akses` int(15) NOT NULL,
  `nama` varchar(50) NOT NULL COMMENT 'nama judul',
  `deskripsi` varchar(200) NOT NULL COMMENT 'keterangan api key',
  `api_key` char(32) NOT NULL COMMENT 'Random uniq',
  `tanggal` datetime NOT NULL COMMENT 'tanggal dibuat',
  PRIMARY KEY (`id_api_key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_key`
--

INSERT INTO `api_key` (`id_api_key`, `id_akses`, `nama`, `deskripsi`, `api_key`, `tanggal`) VALUES
(1, 25, 'Aplikasi Koleksi Gambar', 'Aplikasi koleksi gambar', 'Qw7Z0P12dME85McODk4bdE8S24AmSGRK', '2023-12-11 04:14:40'),
(3, 25, 'Aplikasi Koleksi Gambar', 'APIs untuk aplikasi koleksi gambar versi testing', 'f1WC6NOwJ3m5qTgRMqwjf3y9nPDEaO3T', '2023-12-11 05:13:59'),
(4, 30, 'Aplikasi Add', 'Aplikasi Add versi percobaan', 'yycde83XiXUmnu9Otah0YzbzG3yDcrXv', '2023-12-11 05:14:20'),
(5, 30, 'API Key Untuk Aplikasi Gapleh', 'API Key Untuk Aplikasi Gapleh Versi Staging', 'oeAAQGA8LBB50miiuduuahp9LB6QA0M0', '2023-12-11 05:15:21'),
(6, 26, 'Api Key Percobaan', 'Api Key Yang Punya Saya Untuk Percobaan', 'RIq9yG5q6xgY3Iim0Gd58NeAdcEyJIxH', '2023-12-11 05:15:59'),
(7, 33, 'Foto Pribadi', 'Tempat disimpan foto pribadi saya', 'wyPAOEzf5FXnb7Zz3EzgcYXiJudMjR2d', '2023-12-11 05:17:41'),
(8, 32, 'Penyimpanan Saya', 'Penyimpanan Saya', 'qypjuyGW7UDrcjtIpadtlqUZAYiQ6tOx', '2023-12-11 05:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `bucket`
--

DROP TABLE IF EXISTS `bucket`;
CREATE TABLE IF NOT EXISTS `bucket` (
  `id_bucket` int(15) NOT NULL AUTO_INCREMENT,
  `id_akses` int(15) NOT NULL,
  `id_api_key` int(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `maksimal` bigint(20) NOT NULL COMMENT 'Satuan byte',
  PRIMARY KEY (`id_bucket`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bucket`
--

INSERT INTO `bucket` (`id_bucket`, `id_akses`, `id_api_key`, `nama`, `deskripsi`, `maksimal`) VALUES
(1, 25, 3, 'Utama', 'Test', 100000000),
(2, 25, 3, 'Utama', 'Test', 100000000),
(3, 25, 3, 'Utama Sekali', 'test', 1000000000),
(4, 25, 3, 'Tarif Percobaan2', 'test', 100000000000),
(5, 30, 5, 'Solihul Hadi', 'sss', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `file_list`
--

DROP TABLE IF EXISTS `file_list`;
CREATE TABLE IF NOT EXISTS `file_list` (
  `id_file_list` int(15) NOT NULL AUTO_INCREMENT,
  `id_akses` int(15) NOT NULL,
  `id_api_key` int(15) NOT NULL,
  `id_bucket` int(15) NOT NULL,
  `nama` varchar(20) NOT NULL COMMENT '12312367347.jpeg',
  `label` varchar(50) DEFAULT NULL COMMENT 'Aruna Parasilva',
  `kategori` varchar(50) DEFAULT NULL COMMENT 'ex: Foto wajah',
  `tipe_file` tinytext NOT NULL COMMENT 'ex: image/jpeg',
  `ukuran` bigint(20) NOT NULL COMMENT 'dalam byte',
  PRIMARY KEY (`id_file_list`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id_log` int(15) NOT NULL AUTO_INCREMENT,
  `id_akses` int(15) NOT NULL,
  `id_api_key` int(15) DEFAULT NULL,
  `tanggal` datetime NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `id_akses`, `id_api_key`, `tanggal`, `kategori`, `deskripsi`) VALUES
(1, 6, 0, '2023-12-10 20:36:00', 'Akses', 'Edit Akses'),
(2, 6, 0, '2023-12-10 20:43:00', 'Akses', 'Edit Akses'),
(3, 6, 0, '2023-12-10 20:52:00', 'Akses', 'Tambah Akses'),
(4, 6, 0, '2023-12-10 20:53:00', 'Akses', 'Edit Akses'),
(5, 6, 0, '2023-12-10 20:53:00', 'Akses', 'Tambah Akses'),
(6, 6, 0, '2023-12-10 20:56:00', 'Akses', 'Ubah Password'),
(7, 6, 0, '2023-12-10 20:56:00', 'Akses', 'Ubah Foto'),
(8, 6, 0, '2023-12-10 20:57:29', 'Akses', 'Edit Akses'),
(9, 6, 0, '2023-12-10 21:04:31', 'Akses', 'Hapus Akses'),
(10, 6, 0, '2023-12-10 21:54:15', 'Akses', 'Edit Akses'),
(11, 6, 0, '2023-12-11 04:14:40', 'Api Key', 'Tambah Api Key'),
(12, 6, 0, '2023-12-11 04:20:34', 'Api Key', 'Tambah Api Key'),
(13, 6, 0, '2023-12-11 05:05:41', 'Api Key', 'Edit Api Key'),
(14, 6, 0, '2023-12-11 05:05:52', 'Api Key', 'Edit Api Key'),
(15, 6, 0, '2023-12-11 05:05:59', 'Api Key', 'Edit Api Key'),
(16, 6, 0, '2023-12-11 05:12:03', 'Api Key', 'Hapus Api Key'),
(17, 6, 0, '2023-12-11 05:13:59', 'Api Key', 'Tambah Api Key'),
(18, 6, 0, '2023-12-11 05:14:20', 'Api Key', 'Tambah Api Key'),
(19, 6, 0, '2023-12-11 05:15:21', 'Api Key', 'Tambah Api Key'),
(20, 6, 0, '2023-12-11 05:15:59', 'Api Key', 'Tambah Api Key'),
(21, 6, 0, '2023-12-11 05:17:41', 'Api Key', 'Tambah Api Key'),
(22, 6, 0, '2023-12-11 05:17:56', 'Api Key', 'Tambah Api Key'),
(23, 6, 0, '2023-12-11 16:49:16', 'Bucket', 'Tambah Bucket'),
(24, 6, 0, '2023-12-11 16:56:39', 'Bucket', 'Tambah Bucket'),
(25, 6, 0, '2023-12-11 16:57:24', 'Bucket', 'Tambah Bucket'),
(26, 6, 0, '2023-12-11 18:46:50', 'Bucket', 'Edit Bucket'),
(27, 6, 0, '2023-12-11 18:47:00', 'Bucket', 'Edit Bucket'),
(28, 6, 0, '2023-12-11 18:49:28', 'Bucket', 'Tambah Bucket'),
(29, 6, 0, '2023-12-11 18:50:37', 'Bucket', 'Edit Bucket'),
(30, 6, 0, '2023-12-11 18:59:33', 'Bucket', 'Tambah Bucket'),
(31, 6, 0, '2023-12-11 18:59:43', 'Bucket', 'Hapus Bucket');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
