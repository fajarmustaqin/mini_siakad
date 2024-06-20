-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_siakad.dosen
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE IF NOT EXISTS `dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nidn` varchar(30) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nidn` (`nidn`),
  KEY `FK_dosen_user` (`id_user`),
  CONSTRAINT `FK_dosen_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_siakad.dosen: ~1 rows (approximately)
DELETE FROM `dosen`;
INSERT INTO `dosen` (`id`, `nidn`, `nama`, `jenis_kelamin`, `no_hp`, `email`, `alamat`, `is_active`, `id_user`, `created_at`, `created_by`, `update_at`, `update_by`) VALUES
	(3, '34324', 'iwan giri', 'Laki-laki', '08263432454', 'iwan@gmail.com', 'tangerang selatan', '1', 21, '2022-10-03 03:29:33', 1, '2022-10-03 03:29:33', NULL),
	(4, '13', 'tri hidayati', 'Perempuan', '0822724234', 'tri@gmail.com', 'jakarta selatan', '1', 22, '2022-10-03 11:07:58', 1, '2022-10-03 11:07:58', 1);

-- Dumping structure for table db_siakad.group_user
DROP TABLE IF EXISTS `group_user`;
CREATE TABLE IF NOT EXISTS `group_user` (
  `id_group` int(11) NOT NULL AUTO_INCREMENT,
  `nama_group` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_group`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_siakad.group_user: ~4 rows (approximately)
DELETE FROM `group_user`;
INSERT INTO `group_user` (`id_group`, `nama_group`, `keterangan`, `is_active`) VALUES
	(1, 'administrator', 'admin tertinggi', '1'),
	(2, 'admin baak', 'admin kemahasiswaan', '1'),
	(3, 'dosen', 'dosen', '1'),
	(4, 'mahasiswa', 'mahasiswa', '1');

-- Dumping structure for table db_siakad.mahasiswa
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `email` varchar(60) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `id_orangtua` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_mahasiswa_user` (`id_user`),
  KEY `FK_mahasiswa_orangtua` (`id_orangtua`),
  KEY `FK_mahasiswa_dosen` (`id_dosen`),
  CONSTRAINT `FK_mahasiswa_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `dosen` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_mahasiswa_orangtua` FOREIGN KEY (`id_orangtua`) REFERENCES `orangtua` (`id_ortu`) ON UPDATE CASCADE,
  CONSTRAINT `FK_mahasiswa_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- Dumping data for table db_siakad.mahasiswa: ~1 rows (approximately)
DELETE FROM `mahasiswa`;
INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `email`, `jenis_kelamin`, `alamat`, `no_hp`, `id_orangtua`, `id_user`, `id_dosen`, `is_active`, `created_at`, `created_by`, `update_at`, `update_by`) VALUES
	(38, '191011402416', 'fajar mustaqin', 'fajar.mustaqin01@gmail.com', 'Laki-laki', 'jambi', '082287364', 83, 17, 4, '1', '2022-10-02 09:42:13', NULL, '2022-10-02 09:42:13', 1),
	(39, '2132', 'fistara lesti rahma fitria', 'fistara@gmail.com', 'Perempuan', 'sidoarjo', '08236733435', 84, 19, NULL, '1', '2022-10-02 15:34:10', 1, '2022-10-02 15:34:10', 1);

-- Dumping structure for table db_siakad.orangtua
DROP TABLE IF EXISTS `orangtua`;
CREATE TABLE IF NOT EXISTS `orangtua` (
  `id_ortu` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ayah` varchar(200) NOT NULL,
  `no_hp_ayah` varchar(15) DEFAULT NULL,
  `nama_ibu` varchar(200) NOT NULL,
  `no_hp_ibu` varchar(15) DEFAULT NULL,
  `alamat_ortu` varchar(255) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ortu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- Dumping data for table db_siakad.orangtua: ~1 rows (approximately)
DELETE FROM `orangtua`;
INSERT INTO `orangtua` (`id_ortu`, `nama_ayah`, `no_hp_ayah`, `nama_ibu`, `no_hp_ibu`, `alamat_ortu`, `is_active`, `created_at`, `created_by`, `update_at`, `update_by`) VALUES
	(83, 'zuk', '25354', 'zura', '42543', 'jambi', '1', '2022-10-02 09:42:13', NULL, '2022-10-02 09:42:13', 1),
	(84, 'joko tole', '0893278323', 'beni aminah', '03828934', 'sidoarjo', '1', '2022-10-02 15:34:10', 1, '2022-10-02 15:34:10', 1);

-- Dumping structure for table db_siakad.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `real_name` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(256) NOT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_group_user` (`id_group`),
  CONSTRAINT `FK_user_group_user` FOREIGN KEY (`id_group`) REFERENCES `group_user` (`id_group`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table db_siakad.user: ~6 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `username`, `real_name`, `email`, `password`, `last_login_at`, `is_active`, `id_group`) VALUES
	(1, 'admin', 'administrator', 'admin@gmail.com', '240be518fabd2724ddb6f04eeb1da5967448d7e831c08c8fa822809f74c720a9', '2022-09-19 01:43:52', '1', 1),
	(17, '191011402416', 'fajar mustaqin', 'fajar.mustaqin01@gmail.com', 'c2bdfe72b4f800a5c880520560496d720b042e93e42bce2eddd38614803e6f25', NULL, '1', 4),
	(19, '2132', 'fistara', 'fistara@gmail.com', 'ddc10a5906f8c0ea77bac646567f9680f2b6f989f35485f0cc65b7b5a223d32c', NULL, '1', 4),
	(21, '34324', 'iwan giri', 'iwan@gmail.com', 'c4fe1e1220b81f76d32aa4db48cc996bd651152047505eac44fcb95f6c5587f6', NULL, '1', 3),
	(22, '13', 'tri hidayati', 'tri@gmail.com', '3fdba35f04dc8c462986c992bcf875546257113072a909c162f7e470e581e278', NULL, '1', 3),
	(25, 'adminbaak', 'lisdalita', 'lisda@gmail.com', 'd59d360dbf1012aa2cbd76c37cf1a6535f06ffbdff65c5e79d0c124ed493b128', NULL, '1', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
