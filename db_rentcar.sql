/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : db_rentcar

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 21/08/2023 01:02:30
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hak_akses`;
CREATE TABLE `tbl_hak_akses`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_hak_akses` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `create` int NULL DEFAULT NULL,
  `read` int NULL DEFAULT NULL,
  `update` int NULL DEFAULT NULL,
  `delete` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_hak_akses
-- ----------------------------
INSERT INTO `tbl_hak_akses` VALUES (1, 'Super Admin', 1, 1, 1, 1, NULL, '2023-07-13 22:45:24');
INSERT INTO `tbl_hak_akses` VALUES (12, 'Admin Cabang', 1, 0, 1, 1, '2023-07-13 02:03:35', '2023-07-13 21:29:35');
INSERT INTO `tbl_hak_akses` VALUES (14, 'Manager', 1, 1, 1, 0, '2023-07-13 06:06:51', NULL);

-- ----------------------------
-- Table structure for tbl_kantor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_kantor`;
CREATE TABLE `tbl_kantor`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_kantor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `alamat_kantor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_kantor
-- ----------------------------
INSERT INTO `tbl_kantor` VALUES (1, 'Kantor Cabang', 'Jl. Kebenaran', '2023-07-13 04:03:32', '2023-07-14 01:06:06');
INSERT INTO `tbl_kantor` VALUES (3, 'Kantor Bali', 'Jl. Sesaat', '2023-07-13 06:06:20', NULL);
INSERT INTO `tbl_kantor` VALUES (4, 'Kantor Kediri', 'Jl. Saja Dulu', '2023-07-13 06:06:33', NULL);

-- ----------------------------
-- Table structure for tbl_mobil
-- ----------------------------
DROP TABLE IF EXISTS `tbl_mobil`;
CREATE TABLE `tbl_mobil`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pabrikan` int NULL DEFAULT NULL,
  `merek` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `tahun` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `nomor_rangka` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `nomor_mesin` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `nopol` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `pemilik` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `kantor` int NULL DEFAULT NULL,
  `harga_perbulan` int NULL DEFAULT NULL,
  `harga_perhari` int NULL DEFAULT NULL,
  `harga_perjam` int NULL DEFAULT NULL,
  `status` enum('Disewakan','Dikantor') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_mobil
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_order_vendor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_order_vendor`;
CREATE TABLE `tbl_order_vendor`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_order_vendor
-- ----------------------------
INSERT INTO `tbl_order_vendor` VALUES (1, 'Offline', '2023-07-15 12:41:07', NULL);
INSERT INTO `tbl_order_vendor` VALUES (3, 'Omo', '2023-07-15 12:41:20', NULL);
INSERT INTO `tbl_order_vendor` VALUES (4, 'Trevo', '2023-07-15 12:41:27', NULL);

-- ----------------------------
-- Table structure for tbl_pabrikan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pabrikan`;
CREATE TABLE `tbl_pabrikan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `pabrikan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_pabrikan
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pelanggan`;
CREATE TABLE `tbl_pelanggan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `tgl_lahir_pelanggan` date NULL DEFAULT NULL,
  `tempat_lahir_pelanggan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `jenis_kelamin_pelanggan` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `no_telp_pelanggan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `alamat_pelanggan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `gambar1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `keterangan_gambar1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `gambar2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `keterangan_gambar2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `gambar3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `keterangan_gambar3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `gambar4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `keterangan_gambar4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `gambar5` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `keterangan_gambar5` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `gambar6` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `keterangan_gambar6` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `status_pelanggan` enum('Aktif','Blokir') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `kantor` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pelanggan
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_pelanggan_rental_lain
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pelanggan_rental_lain`;
CREATE TABLE `tbl_pelanggan_rental_lain`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `nama_rentcar` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `tgl_lahir_pelanggan` date NULL DEFAULT NULL,
  `tempat_lahir_pelanggan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `jenis_kelamin_pelanggan` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `no_telp_pelanggan` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `alamat_pelanggan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `status_pelanggan` enum('Aktif','Blokir') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `kantor` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pelanggan_rental_lain
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pengguna`;
CREATE TABLE `tbl_pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL,
  `email` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `kantor` int NULL DEFAULT NULL,
  `akses` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb3 COLLATE = utf8mb3_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tbl_pengguna
-- ----------------------------
INSERT INTO `tbl_pengguna` VALUES (1, 'Developer', 'Malang', 'developer@email.com', '$2y$10$psfZay83FLt.d13fo1WfB.B8.ifreXeXmXABCgO8.djYNFzhAO6Gi', 1, 1, NULL, '2023-07-15 00:17:27');
INSERT INTO `tbl_pengguna` VALUES (2, 'Admin', 'Bali', 'admin@admin.com', '$2y$10$Z6leiwRIB3H7ZTkDBKHWKe6uWB/6HppWWFMwSc9vGYaDrr6Gf2JTq', 3, 12, '2023-08-20 05:41:41', NULL);

-- ----------------------------
-- Table structure for tbl_persewaan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_persewaan`;
CREATE TABLE `tbl_persewaan`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomor_order` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `kantor` int NULL DEFAULT NULL,
  `mobil` int NULL DEFAULT NULL,
  `pelanggan` int NULL DEFAULT NULL,
  `tanggal_sewa` timestamp NULL DEFAULT NULL,
  `tipe_sewa` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pesan_dari` int NULL DEFAULT NULL,
  `dikirim` enum('Iya','Tidak') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `alamat_pengiriman` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `mulai_sewa` timestamp NULL DEFAULT NULL,
  `selesai_sewa` timestamp NULL DEFAULT NULL,
  `potongan_harga` int NULL DEFAULT NULL,
  `total_harga` int NULL DEFAULT NULL,
  `status_sewa` enum('Moving','Extend','Garage','Cancel','Order') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_persewaan
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
