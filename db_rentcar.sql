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

 Date: 16/07/2023 23:35:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `tbl_hak_akses`;
CREATE TABLE `tbl_hak_akses`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_hak_akses` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `create` int NULL DEFAULT NULL,
  `read` int NULL DEFAULT NULL,
  `update` int NULL DEFAULT NULL,
  `delete` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

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
  `nama_kantor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat_kantor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

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
  `merek` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `tahun` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nomor_rangka` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nomor_mesin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `nopol` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `pemilik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `kantor` int NULL DEFAULT NULL,
  `harga_perbulan` int NULL DEFAULT NULL,
  `harga_perminggu` int NULL DEFAULT NULL,
  `harga_perhari` int NULL DEFAULT NULL,
  `harga_perjam` int NULL DEFAULT NULL,
  `status` enum('Disewakan','Dikantor') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_mobil
-- ----------------------------
INSERT INTO `tbl_mobil` VALUES (2, 3, 'Dignissimos Nam saep', '82', '20', '63', 'Impedit id repelle', 'Porro ut at cumque d', 'Repudiandae qui volu', 1, 52, 89, 78, 23, 'Dikantor', '2023-07-16 04:34:30', NULL);
INSERT INTO `tbl_mobil` VALUES (3, 5, 'Praesentium aliquam ', '3', '77', '40', 'Molestias quis quia ', 'In in molestiae ex v', 'Quis obcaecati tempo', 3, 3, 100, 5, 19, 'Disewakan', '2023-07-16 04:34:50', NULL);

-- ----------------------------
-- Table structure for tbl_order_vendor
-- ----------------------------
DROP TABLE IF EXISTS `tbl_order_vendor`;
CREATE TABLE `tbl_order_vendor`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_vendor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

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
  `pabrikan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pabrikan
-- ----------------------------
INSERT INTO `tbl_pabrikan` VALUES (2, 'Honda', '2023-07-15 11:40:37', NULL);
INSERT INTO `tbl_pabrikan` VALUES (3, 'Toyota', '2023-07-15 11:41:01', NULL);
INSERT INTO `tbl_pabrikan` VALUES (4, 'Mitsubishi', '2023-07-15 11:41:33', NULL);
INSERT INTO `tbl_pabrikan` VALUES (5, 'Hyundai', '2023-07-15 11:41:40', NULL);
INSERT INTO `tbl_pabrikan` VALUES (6, 'Suzuki', '2023-07-15 11:41:58', '2023-07-15 18:55:59');

-- ----------------------------
-- Table structure for tbl_pengguna
-- ----------------------------
DROP TABLE IF EXISTS `tbl_pengguna`;
CREATE TABLE `tbl_pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `kantor` int NULL DEFAULT NULL,
  `akses` int NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_pengguna
-- ----------------------------
INSERT INTO `tbl_pengguna` VALUES (1, 'Developer', 'Malang', 'developer@email.com', '$2y$10$psfZay83FLt.d13fo1WfB.B8.ifreXeXmXABCgO8.djYNFzhAO6Gi', 1, 1, NULL, '2023-07-15 00:17:27');

SET FOREIGN_KEY_CHECKS = 1;
