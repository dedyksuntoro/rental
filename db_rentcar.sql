/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50739 (5.7.39)
 Source Host           : localhost:3306
 Source Schema         : db_rentcar

 Target Server Type    : MySQL
 Target Server Version : 50739 (5.7.39)
 File Encoding         : 65001

 Date: 25/07/2023 01:42:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hak_akses`;
CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_hak_akses` varchar(255) DEFAULT NULL,
  `create` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `update` int(11) DEFAULT NULL,
  `delete` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_hak_akses
-- ----------------------------
BEGIN;
INSERT INTO `tbl_hak_akses` (`id`, `nama_hak_akses`, `create`, `read`, `update`, `delete`, `created_at`, `updated_at`) VALUES (1, 'Super Admin', 1, 1, 1, 1, NULL, '2023-07-13 22:45:24');
INSERT INTO `tbl_hak_akses` (`id`, `nama_hak_akses`, `create`, `read`, `update`, `delete`, `created_at`, `updated_at`) VALUES (12, 'Admin Cabang', 1, 0, 1, 1, '2023-07-13 02:03:35', '2023-07-13 21:29:35');
INSERT INTO `tbl_hak_akses` (`id`, `nama_hak_akses`, `create`, `read`, `update`, `delete`, `created_at`, `updated_at`) VALUES (14, 'Manager', 1, 1, 1, 0, '2023-07-13 06:06:51', NULL);
COMMIT;

-- ----------------------------
-- Table structure for tbl_kantor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kantor`;
CREATE TABLE `tbl_kantor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kantor` varchar(100) DEFAULT NULL,
  `alamat_kantor` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_kantor
-- ----------------------------
BEGIN;
INSERT INTO `tbl_kantor` (`id`, `nama_kantor`, `alamat_kantor`, `created_at`, `updated_at`) VALUES (1, 'Kantor Cabang', 'Jl. Kebenaran', '2023-07-13 04:03:32', '2023-07-14 01:06:06');
INSERT INTO `tbl_kantor` (`id`, `nama_kantor`, `alamat_kantor`, `created_at`, `updated_at`) VALUES (3, 'Kantor Bali', 'Jl. Sesaat', '2023-07-13 06:06:20', NULL);
INSERT INTO `tbl_kantor` (`id`, `nama_kantor`, `alamat_kantor`, `created_at`, `updated_at`) VALUES (4, 'Kantor Kediri', 'Jl. Saja Dulu', '2023-07-13 06:06:33', NULL);
COMMIT;

-- ----------------------------
-- Table structure for tbl_mobil
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mobil`;
CREATE TABLE `tbl_mobil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pabrikan` int(11) DEFAULT NULL,
  `merek` varchar(100) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  `nomor_rangka` varchar(255) DEFAULT NULL,
  `nomor_mesin` varchar(255) DEFAULT NULL,
  `nopol` varchar(100) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kantor` int(11) DEFAULT NULL,
  `harga_perbulan` int(11) DEFAULT NULL,
  `harga_perminggu` int(11) DEFAULT NULL,
  `harga_perhari` int(11) DEFAULT NULL,
  `harga_perjam` int(11) DEFAULT NULL,
  `status` enum('Disewakan','Dikantor') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_mobil
-- ----------------------------
BEGIN;
INSERT INTO `tbl_mobil` (`id`, `pabrikan`, `merek`, `tahun`, `nomor_rangka`, `nomor_mesin`, `nopol`, `pemilik`, `alamat`, `kantor`, `harga_perbulan`, `harga_perminggu`, `harga_perhari`, `harga_perjam`, `status`, `created_at`, `updated_at`) VALUES (3, 2, 'Jazz', '2010', '2201010', '10102020', 'N 2020 ND', 'Malik', 'Jl. Saja Dulu', 4, 2230000, 5230000, 120000, 15000, 'Dikantor', '2023-07-16 04:34:50', '2023-07-18 23:18:11');
INSERT INTO `tbl_mobil` (`id`, `pabrikan`, `merek`, `tahun`, `nomor_rangka`, `nomor_mesin`, `nopol`, `pemilik`, `alamat`, `kantor`, `harga_perbulan`, `harga_perminggu`, `harga_perhari`, `harga_perjam`, `status`, `created_at`, `updated_at`) VALUES (4, 4, 'Nisi velit qui tota', '78', '67', '72', 'Tempore voluptatem', 'Autem incididunt sun', 'Ea voluptatem do vol', 3, 93, 74, 81, 92, 'Disewakan', '2023-07-17 05:21:26', NULL);
INSERT INTO `tbl_mobil` (`id`, `pabrikan`, `merek`, `tahun`, `nomor_rangka`, `nomor_mesin`, `nopol`, `pemilik`, `alamat`, `kantor`, `harga_perbulan`, `harga_perminggu`, `harga_perhari`, `harga_perjam`, `status`, `created_at`, `updated_at`) VALUES (6, 2, 'Ab Nam non exercitat', '26', '70', '3', 'Maiores unde sed lab', 'Ipsam similique exce', 'Consectetur volupta', 4, 19, 39, 65, 11, 'Disewakan', '2023-07-20 05:36:38', NULL);
INSERT INTO `tbl_mobil` (`id`, `pabrikan`, `merek`, `tahun`, `nomor_rangka`, `nomor_mesin`, `nopol`, `pemilik`, `alamat`, `kantor`, `harga_perbulan`, `harga_perminggu`, `harga_perhari`, `harga_perjam`, `status`, `created_at`, `updated_at`) VALUES (7, 4, 'Odio sed ut odio in', '35', '3', '44', 'Pariatur Mollit ill', 'Similique mollit obc', 'Repellendus Nemo im', 3, 19, 32, NULL, 89, 'Dikantor', '2023-07-21 12:21:00', NULL);
COMMIT;

-- ----------------------------
-- Table structure for tbl_order_vendor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_order_vendor`;
CREATE TABLE `tbl_order_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_order_vendor
-- ----------------------------
BEGIN;
INSERT INTO `tbl_order_vendor` (`id`, `nama_vendor`, `created_at`, `updated_at`) VALUES (1, 'Offline', '2023-07-15 12:41:07', NULL);
INSERT INTO `tbl_order_vendor` (`id`, `nama_vendor`, `created_at`, `updated_at`) VALUES (3, 'Omo', '2023-07-15 12:41:20', NULL);
INSERT INTO `tbl_order_vendor` (`id`, `nama_vendor`, `created_at`, `updated_at`) VALUES (4, 'Trevo', '2023-07-15 12:41:27', NULL);
COMMIT;

-- ----------------------------
-- Table structure for tbl_pabrikan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pabrikan`;
CREATE TABLE `tbl_pabrikan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pabrikan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_pabrikan
-- ----------------------------
BEGIN;
INSERT INTO `tbl_pabrikan` (`id`, `pabrikan`, `created_at`, `updated_at`) VALUES (2, 'Honda', '2023-07-15 11:40:37', NULL);
INSERT INTO `tbl_pabrikan` (`id`, `pabrikan`, `created_at`, `updated_at`) VALUES (3, 'Toyota', '2023-07-15 11:41:01', NULL);
INSERT INTO `tbl_pabrikan` (`id`, `pabrikan`, `created_at`, `updated_at`) VALUES (4, 'Mitsubishi', '2023-07-15 11:41:33', NULL);
INSERT INTO `tbl_pabrikan` (`id`, `pabrikan`, `created_at`, `updated_at`) VALUES (5, 'Hyundai', '2023-07-15 11:41:40', NULL);
INSERT INTO `tbl_pabrikan` (`id`, `pabrikan`, `created_at`, `updated_at`) VALUES (6, 'Suzuki', '2023-07-15 11:41:58', '2023-07-15 18:55:59');
COMMIT;

-- ----------------------------
-- Table structure for tbl_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pelanggan`;
CREATE TABLE `tbl_pelanggan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `tgl_lahir_pelanggan` date DEFAULT NULL,
  `tempat_lahir_pelanggan` varchar(100) DEFAULT NULL,
  `jenis_kelamin_pelanggan` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `no_telp_pelanggan` varchar(100) DEFAULT NULL,
  `alamat_pelanggan` text,
  `gambar1` varchar(255) DEFAULT NULL,
  `keterangan_gambar1` varchar(255) DEFAULT NULL,
  `gambar2` varchar(255) DEFAULT NULL,
  `keterangan_gambar2` varchar(255) DEFAULT NULL,
  `gambar3` varchar(255) DEFAULT NULL,
  `keterangan_gambar3` varchar(255) DEFAULT NULL,
  `gambar4` varchar(255) DEFAULT NULL,
  `keterangan_gambar4` varchar(255) DEFAULT NULL,
  `gambar5` varchar(255) DEFAULT NULL,
  `keterangan_gambar5` varchar(255) DEFAULT NULL,
  `gambar6` varchar(255) DEFAULT NULL,
  `keterangan_gambar6` varchar(255) DEFAULT NULL,
  `status_pelanggan` enum('Aktif','Blokir') DEFAULT NULL,
  `kantor` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_pelanggan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_pelanggan_rental_lain
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pelanggan_rental_lain`;
CREATE TABLE `tbl_pelanggan_rental_lain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) DEFAULT NULL,
  `nama_rentcar` varchar(100) DEFAULT NULL,
  `tgl_lahir_pelanggan` date DEFAULT NULL,
  `tempat_lahir_pelanggan` varchar(100) DEFAULT NULL,
  `jenis_kelamin_pelanggan` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `no_telp_pelanggan` varchar(100) DEFAULT NULL,
  `alamat_pelanggan` text,
  `status_pelanggan` enum('Aktif','Blokir') DEFAULT NULL,
  `kantor` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_pelanggan_rental_lain
-- ----------------------------
BEGIN;
INSERT INTO `tbl_pelanggan_rental_lain` (`id`, `nama_pelanggan`, `nama_rentcar`, `tgl_lahir_pelanggan`, `tempat_lahir_pelanggan`, `jenis_kelamin_pelanggan`, `no_telp_pelanggan`, `alamat_pelanggan`, `status_pelanggan`, `kantor`, `created_at`, `updated_at`) VALUES (2, 'Qui esse velit delec', 'BBBB', '1973-01-20', 'Adipisicing autem ve', 'Laki-laki', '66', 'Excepturi sunt qui i', 'Blokir', 4, '2023-07-21 06:32:19', '2023-07-22 01:52:31');
INSERT INTO `tbl_pelanggan_rental_lain` (`id`, `nama_pelanggan`, `nama_rentcar`, `tgl_lahir_pelanggan`, `tempat_lahir_pelanggan`, `jenis_kelamin_pelanggan`, `no_telp_pelanggan`, `alamat_pelanggan`, `status_pelanggan`, `kantor`, `created_at`, `updated_at`) VALUES (4, 'Quo ut nihil dolorib', 'Ut in consectetur N', '1974-08-25', 'Quis voluptas except', 'Perempuan', '43', 'Aut incidunt mollit', 'Blokir', 4, '2023-07-21 06:48:38', '2023-07-22 01:52:40');
COMMIT;

-- ----------------------------
-- Table structure for tbl_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pengguna`;
CREATE TABLE `tbl_pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `kantor` int(11) DEFAULT NULL,
  `akses` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of tbl_pengguna
-- ----------------------------
BEGIN;
INSERT INTO `tbl_pengguna` (`id`, `nama`, `alamat`, `email`, `password`, `kantor`, `akses`, `created_at`, `updated_at`) VALUES (1, 'Developer', 'Malang', 'developer@email.com', '$2y$10$psfZay83FLt.d13fo1WfB.B8.ifreXeXmXABCgO8.djYNFzhAO6Gi', 1, 1, NULL, '2023-07-15 00:17:27');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
