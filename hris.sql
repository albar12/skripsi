/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100424 (10.4.24-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : hris

 Target Server Type    : MySQL
 Target Server Version : 100424 (10.4.24-MariaDB)
 File Encoding         : 65001

 Date: 27/04/2026 15:32:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for table_absensi
-- ----------------------------
DROP TABLE IF EXISTS `table_absensi`;
CREATE TABLE `table_absensi`  (
  `id_absensi` int NOT NULL AUTO_INCREMENT,
  `nip` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpha') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_absensi`) USING BTREE,
  INDEX `nip`(`nip` ASC) USING BTREE,
  CONSTRAINT `nip` FOREIGN KEY (`nip`) REFERENCES `table_guru` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_absensi
-- ----------------------------
INSERT INTO `table_absensi` VALUES (1, 260401, '2026-04-25', 'Hadir');

-- ----------------------------
-- Table structure for table_admin
-- ----------------------------
DROP TABLE IF EXISTS `table_admin`;
CREATE TABLE `table_admin`  (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `role` enum('Admin','Kepala Sekolah') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_admin
-- ----------------------------
INSERT INTO `table_admin` VALUES (1, 'Admin', 'admin', '$2y$10$dCGhrxGWByZjpCXSzooe7.JOk9GsvY3rEkuTiE6321ZY9wXQEIp0e', 'Admin');

-- ----------------------------
-- Table structure for table_cuti
-- ----------------------------
DROP TABLE IF EXISTS `table_cuti`;
CREATE TABLE `table_cuti`  (
  `id_cuti` int NOT NULL AUTO_INCREMENT,
  `nip` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `waktu` int NULL DEFAULT NULL,
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_cuti`) USING BTREE,
  INDEX `cuti_nip`(`nip` ASC) USING BTREE,
  CONSTRAINT `cuti_nip` FOREIGN KEY (`nip`) REFERENCES `table_guru` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_cuti
-- ----------------------------
INSERT INTO `table_cuti` VALUES (4, 260401, '2026-04-27', 1, 'cuti pulang kampung', 'Approve');
INSERT INTO `table_cuti` VALUES (5, 260402, '2026-04-28', 2, 'pulang kampung', NULL);

-- ----------------------------
-- Table structure for table_guru
-- ----------------------------
DROP TABLE IF EXISTS `table_guru`;
CREATE TABLE `table_guru`  (
  `nip` int NOT NULL,
  `id_admin` int NULL DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jk` enum('Laki-Laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jabatan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_hp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `agama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`nip`) USING BTREE,
  INDEX `id_admin`(`id_admin` ASC) USING BTREE,
  CONSTRAINT `id_admin` FOREIGN KEY (`id_admin`) REFERENCES `table_admin` (`id_admin`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_guru
-- ----------------------------
INSERT INTO `table_guru` VALUES (260401, 1, 'Wali kelas 1', 'Perempuan', 'Wali Kelas', '0812378123123', 'Jln. Kenaga 8 rt 2 rw 1', 'Islam');
INSERT INTO `table_guru` VALUES (260402, 1, 'Wali kelas 2', 'Perempuan', 'Wali Kelas', '081237173912', 'jl kenanga rt 1 rw 02', 'Islam');

-- ----------------------------
-- Table structure for table_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `table_jadwal`;
CREATE TABLE `table_jadwal`  (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_admin` int NULL DEFAULT NULL,
  `hari` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jam_mulai` time NULL DEFAULT NULL,
  `jam_selesai` time NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE,
  INDEX `jadwal_admin`(`id_admin` ASC) USING BTREE,
  CONSTRAINT `jadwal_admin` FOREIGN KEY (`id_admin`) REFERENCES `table_admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_jadwal
-- ----------------------------
INSERT INTO `table_jadwal` VALUES (1, 1, 'Senin', '07:00:00', '12:00:00');

-- ----------------------------
-- Table structure for table_kepala_sekolah
-- ----------------------------
DROP TABLE IF EXISTS `table_kepala_sekolah`;
CREATE TABLE `table_kepala_sekolah`  (
  `nip` int NOT NULL,
  `id_cuti` int NULL DEFAULT NULL,
  `nama_kepsek` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `role` enum('Admin','Guru') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`nip`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_kepala_sekolah
-- ----------------------------
INSERT INTO `table_kepala_sekolah` VALUES (111111, NULL, 'Kepsek1', 'kepsek1', '$2y$10$dCGhrxGWByZjpCXSzooe7.JOk9GsvY3rEkuTiE6321ZY9wXQEIp0e', 'Admin');

-- ----------------------------
-- Table structure for table_mapel
-- ----------------------------
DROP TABLE IF EXISTS `table_mapel`;
CREATE TABLE `table_mapel`  (
  `id_mapel` int NOT NULL AUTO_INCREMENT,
  `id_admin` int NULL DEFAULT NULL,
  `nama_mapel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_mapel`) USING BTREE,
  INDEX `admin_mapel`(`id_admin` ASC) USING BTREE,
  CONSTRAINT `admin_mapel` FOREIGN KEY (`id_admin`) REFERENCES `table_admin` (`id_admin`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_mapel
-- ----------------------------
INSERT INTO `table_mapel` VALUES (2, 1, 'MTK');

-- ----------------------------
-- Table structure for tb_barang_keluar
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang_keluar`;
CREATE TABLE `tb_barang_keluar`  (
  `id_barang_keluar` int NOT NULL AUTO_INCREMENT,
  `id_kategori` int NULL DEFAULT NULL,
  `id_produk` int NULL DEFAULT NULL,
  `id_penjualan` int NULL DEFAULT NULL,
  `jumlah` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `status_produk` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_barang_masuk` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_so` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_barang_keluar`) USING BTREE,
  INDEX `id_kategori`(`id_kategori` ASC) USING BTREE,
  INDEX `id_produk`(`id_produk` ASC) USING BTREE,
  INDEX `id_penjualan`(`id_penjualan` ASC) USING BTREE,
  CONSTRAINT `tb_barang_keluar_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_keluar_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_keluar_ibfk_3` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id_penjualan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_barang_keluar
-- ----------------------------
INSERT INTO `tb_barang_keluar` VALUES (7, 1, 1, 6, NULL, NULL, '1', '2', '2023-07-02 05:22:43', '1', NULL, NULL, NULL);
INSERT INTO `tb_barang_keluar` VALUES (8, 1, 1, 6, NULL, NULL, '1', '3', '2023-07-02 05:22:44', '1', NULL, NULL, NULL);
INSERT INTO `tb_barang_keluar` VALUES (9, 1, 1, 6, NULL, NULL, '1', '1', '2023-07-02 05:22:44', '1', NULL, NULL, NULL);
INSERT INTO `tb_barang_keluar` VALUES (14, 2, 2, NULL, '1', 'Produk Rusak', '1', NULL, '2023-08-13 19:30:57', '1', '2023-08-13 19:38:00', '1', '5');

-- ----------------------------
-- Table structure for tb_barang_masuk
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang_masuk`;
CREATE TABLE `tb_barang_masuk`  (
  `id_barang_masuk` int NOT NULL AUTO_INCREMENT,
  `id_supp` int NULL DEFAULT NULL,
  `id_kategori` int NULL DEFAULT NULL,
  `id_produk` int NULL DEFAULT NULL,
  `tanggal_kadaluarsa` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_penjualan` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '',
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `flag_so` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_barang_masuk`) USING BTREE,
  INDEX `id_supp`(`id_supp` ASC) USING BTREE,
  INDEX `id_kategori`(`id_kategori` ASC) USING BTREE,
  INDEX `id_produk`(`id_produk` ASC) USING BTREE,
  CONSTRAINT `tb_barang_masuk_ibfk_1` FOREIGN KEY (`id_supp`) REFERENCES `tb_supplier` (`id_supp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_masuk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_masuk_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_barang_masuk
-- ----------------------------
INSERT INTO `tb_barang_masuk` VALUES (1, 1, 1, 1, '2023-07-15', '3', '6', '2023-06-30 22:55:13', '1', '2023-07-02 05:22:44', '1', NULL);
INSERT INTO `tb_barang_masuk` VALUES (2, 1, 1, 1, '2023-06-29', '3', '6', '2023-06-30 23:22:07', '1', '2023-07-02 05:22:44', '1', NULL);
INSERT INTO `tb_barang_masuk` VALUES (3, 1, 1, 1, '2023-07-03', '3', '6', '2023-06-30 23:22:33', '1', '2023-07-02 05:22:44', '1', NULL);
INSERT INTO `tb_barang_masuk` VALUES (4, 1, 1, 1, '2023-07-11', '3', '', '2023-07-11 15:24:51', '1', NULL, NULL, NULL);
INSERT INTO `tb_barang_masuk` VALUES (5, 1, 2, 2, '2023-08-31', '1', '', '2023-08-13 18:02:31', '1', '2023-08-13 19:38:00', '1', '1');
INSERT INTO `tb_barang_masuk` VALUES (6, 1, 2, 3, '2023-08-31', '1', '', '2023-08-13 18:09:17', '1', NULL, NULL, NULL);
INSERT INTO `tb_barang_masuk` VALUES (7, 1, 2, 2, '2023-08-31', '1', '', '2023-08-13 18:09:32', '1', '2023-08-13 19:37:52', '1', NULL);

-- ----------------------------
-- Table structure for tb_detail_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `tb_detail_penjualan`;
CREATE TABLE `tb_detail_penjualan`  (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `id_penjualan` int NULL DEFAULT NULL,
  `id_kategori` int NULL DEFAULT NULL,
  `id_produk` int NULL DEFAULT NULL,
  `diskon` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `diskon_tambahan` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `qty` int NULL DEFAULT NULL,
  `sub_total` int NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_detail`) USING BTREE,
  INDEX `id_penjualan`(`id_penjualan` ASC) USING BTREE,
  CONSTRAINT `tb_detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id_penjualan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_detail_penjualan
-- ----------------------------
INSERT INTO `tb_detail_penjualan` VALUES (6, 5, 1, 1, '', '', 10000, 20000, '2023-07-02 05:13:04', '1', NULL, NULL);
INSERT INTO `tb_detail_penjualan` VALUES (10, 6, 1, 1, '', '', 1, 10000, '2023-07-02 05:22:43', '1', NULL, NULL);
INSERT INTO `tb_detail_penjualan` VALUES (11, 6, 1, 1, '', '', 2, 20000, '2023-07-02 05:22:44', '1', NULL, NULL);
INSERT INTO `tb_detail_penjualan` VALUES (12, 6, 1, 1, '', '', 1, 10000, '2023-07-02 05:22:44', '1', NULL, NULL);

-- ----------------------------
-- Table structure for tb_kategori
-- ----------------------------
DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE `tb_kategori`  (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kategori`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_kategori
-- ----------------------------
INSERT INTO `tb_kategori` VALUES (1, 'Kategori01', '3', '2023-06-30 16:26:42', '1', '2023-06-30 21:18:49', '1');
INSERT INTO `tb_kategori` VALUES (2, 'Sabun Wajah', '1', '2023-07-16 19:46:36', '1', NULL, NULL);
INSERT INTO `tb_kategori` VALUES (3, 'Toner Wajah', '1', '2023-07-16 19:46:51', '1', NULL, NULL);
INSERT INTO `tb_kategori` VALUES (4, 'Serum Wajah', '1', '2023-07-16 19:46:59', '1', NULL, NULL);
INSERT INTO `tb_kategori` VALUES (5, 'Krim Pagi', '1', '2023-07-16 19:47:10', '1', NULL, NULL);
INSERT INTO `tb_kategori` VALUES (6, 'Krim Malam', '1', '2023-07-16 19:47:25', '1', NULL, NULL);
INSERT INTO `tb_kategori` VALUES (7, 'Premium Produk', '3', '2023-07-16 19:47:45', '1', NULL, NULL);
INSERT INTO `tb_kategori` VALUES (8, 'Pelembab Wajah', '1', '2023-07-16 19:47:55', '1', NULL, NULL);

-- ----------------------------
-- Table structure for tb_pelanggan
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE `tb_pelanggan`  (
  `id_pelanggan` int NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_pelanggan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `jenis_kelamin` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tlp_pelanggan` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_pelanggan
-- ----------------------------
INSERT INTO `tb_pelanggan` VALUES (1, 'Pelanggan 01', 'Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1', 'Laki-laki', '999999999999999999999', '1', '2023-06-30 09:41:16', '1', '2023-06-30 09:57:38', '1');
INSERT INTO `tb_pelanggan` VALUES (2, 'Pelanggan 2', 'Pelanggan 2', 'Perempuan', '99999999999999999999', '1', '2023-07-16 15:00:14', '1', NULL, NULL);
INSERT INTO `tb_pelanggan` VALUES (3, 'Pelanggan 3', 'Pelanggan 3', 'Perempuan', '99999999999999999', '1', '2023-07-16 15:00:27', '1', NULL, NULL);

-- ----------------------------
-- Table structure for tb_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `tb_penjualan`;
CREATE TABLE `tb_penjualan`  (
  `id_penjualan` int NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `tanggal_penjualan` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`) USING BTREE,
  INDEX `id_user`(`id_user` ASC) USING BTREE,
  INDEX `id_pelanggan`(`id_pelanggan` ASC) USING BTREE,
  CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_penjualan
-- ----------------------------
INSERT INTO `tb_penjualan` VALUES (1, 1, 1, '2023-07-01', '3', NULL, NULL, NULL, NULL);
INSERT INTO `tb_penjualan` VALUES (2, 1, 1, '2023-07-01', '3', NULL, NULL, NULL, NULL);
INSERT INTO `tb_penjualan` VALUES (3, 1, 1, '2023-07-01', '3', NULL, NULL, NULL, NULL);
INSERT INTO `tb_penjualan` VALUES (4, 1, 1, '2023-07-04', '3', NULL, NULL, '2023-07-02 03:55:23', '1');
INSERT INTO `tb_penjualan` VALUES (5, 1, 1, '2023-07-02', '3', NULL, NULL, NULL, NULL);
INSERT INTO `tb_penjualan` VALUES (6, 1, 1, '2023-07-02', '3', NULL, NULL, '2023-07-02 05:22:43', '1');

-- ----------------------------
-- Table structure for tb_produk
-- ----------------------------
DROP TABLE IF EXISTS `tb_produk`;
CREATE TABLE `tb_produk`  (
  `id_produk` int NOT NULL AUTO_INCREMENT,
  `id_kategori` int NULL DEFAULT NULL,
  `nama_produk` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga_satuan` int NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_produk`) USING BTREE,
  INDEX `id_kategori`(`id_kategori` ASC) USING BTREE,
  CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_produk
-- ----------------------------
INSERT INTO `tb_produk` VALUES (1, 1, 'Produk01', 10000, '3', '2023-06-30 21:41:17', '1', '2023-06-30 21:54:26', '1');
INSERT INTO `tb_produk` VALUES (2, 2, 'Facial Wash Brightening', 72000, '1', '2023-07-16 19:48:42', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (3, 2, 'Facial Wash Sensitif', 70000, '1', '2023-07-16 19:49:37', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (4, 2, 'Facial Wash Anti Aging', 71000, '1', '2023-07-16 19:50:01', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (5, 3, 'Toner Whitening', 70000, '1', '2023-07-16 19:50:19', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (6, 3, 'Toner Anti Aging', 69000, '1', '2023-07-16 19:50:56', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (7, 3, 'Premium Toner Acner Prone Skin', 173000, '1', '2023-07-16 19:51:40', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (8, 4, 'Serum Brightening', 159000, '1', '2023-07-16 19:52:23', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (9, 4, 'Serum Anti Aging', 200000, '1', '2023-07-16 19:52:42', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (10, 4, 'Serum Vitamin C 10%', 107000, '1', '2023-07-16 19:53:07', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (11, 5, 'Sunscreen Light Pink SPF 30', 73000, '1', '2023-07-16 19:54:13', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (12, 5, 'Sunscreen Beige SPF 50', 70000, '1', '2023-07-16 19:55:10', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (13, 5, 'Sunblock Pink SPF 50', 75000, '1', '2023-07-16 19:55:43', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (14, 6, 'Silky Whitening', 119000, '1', '2023-07-16 19:56:25', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (15, 6, 'Cream Anti Aging', 84000, '1', '2023-07-16 19:56:51', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (16, 6, 'Premium Acne Whitening Gel', 110000, '1', '2023-07-16 19:57:29', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (17, 8, 'Pudding Gel Moisturaizer', 91000, '1', '2023-07-16 19:58:49', '1', NULL, NULL);
INSERT INTO `tb_produk` VALUES (18, 8, 'Skin Barier Cream', 63000, '1', '2023-07-16 19:59:14', '1', NULL, NULL);

-- ----------------------------
-- Table structure for tb_supplier
-- ----------------------------
DROP TABLE IF EXISTS `tb_supplier`;
CREATE TABLE `tb_supplier`  (
  `id_supp` int NOT NULL AUTO_INCREMENT,
  `nama_supp` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat_supp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `tlp_supp` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_supp`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_supplier
-- ----------------------------
INSERT INTO `tb_supplier` VALUES (1, 'Supplier01', 'Supplier1Supplier1Supplier1Supplier1', '99999999999999999999999', '1', '2023-06-30 15:29:47', '1', '2023-06-30 15:43:11', '1');
INSERT INTO `tb_supplier` VALUES (2, 'Supplier2', 'Supplier2', '99999999999', '1', '2023-07-16 20:00:41', '1', NULL, NULL);
INSERT INTO `tb_supplier` VALUES (3, 'Supplier3', 'Supplier3', '99999999999999999', '1', '2023-07-16 20:00:52', '1', NULL, NULL);

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `jenis_kelamin` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_hp` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `posisi` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES (1, 'Administrator', 'admin', '$2y$10$dCGhrxGWByZjpCXSzooe7.JOk9GsvY3rEkuTiE6321ZY9wXQEIp0e', 'Laki-laki', '88888888888888888888', 'admin admin admin admin', '1', '1', '2023-06-30 05:08:34', NULL, '2023-06-30 06:07:15', '1');
INSERT INTO `tb_user` VALUES (2, 'Owner', 'owner', '$2y$10$kDy9fdMHZGpJt8VrP.XTDOja8f0tlGYHwDwNs5On9ye394LU.a0zW', 'Laki-laki', '99999999999999999999999', 'owner owner owner', '2', '1', '2023-07-16 14:42:08', '1', NULL, NULL);
INSERT INTO `tb_user` VALUES (3, 'Supervisor', 'supervisor', '$2y$10$Evsc6DHXZHpnfva/8Kg6fOQVJA3BkUXKq2yP2UYz7U9WcHnwTg5vy', 'Perempuan', '99999999999999999', 'supervisor supervisor supervisor', '3', '1', '2023-07-16 14:44:11', '1', NULL, NULL);
INSERT INTO `tb_user` VALUES (4, 'Team Produk', 'team_produk', '$2y$10$WYg6A2Y8OPnbtqiK1MeXB.UUYoBC5tO8NLz/VYHEFf9uK8E44OQJe', 'Perempuan', '99999999999999999', 'Team Produk Team Produk', '4', '1', '2023-07-16 14:44:54', '1', NULL, NULL);

-- ----------------------------
-- Table structure for tb_user_copy1
-- ----------------------------
DROP TABLE IF EXISTS `tb_user_copy1`;
CREATE TABLE `tb_user_copy1`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `jenis_kelamin` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nomor_hp` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `posisi` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `create_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `update_adm` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_user_copy1
-- ----------------------------
INSERT INTO `tb_user_copy1` VALUES (1, 'Administrator', 'admin', '$2y$10$dCGhrxGWByZjpCXSzooe7.JOk9GsvY3rEkuTiE6321ZY9wXQEIp0e', 'Laki-laki', '88888888888888888888', 'admin admin admin admin', '1', '1', '2023-06-30 05:08:34', NULL, '2023-06-30 06:07:15', '1');
INSERT INTO `tb_user_copy1` VALUES (2, 'Owner', 'owner', '$2y$10$kDy9fdMHZGpJt8VrP.XTDOja8f0tlGYHwDwNs5On9ye394LU.a0zW', 'Laki-laki', '99999999999999999999999', 'owner owner owner', '2', '1', '2023-07-16 14:42:08', '1', NULL, NULL);
INSERT INTO `tb_user_copy1` VALUES (3, 'Supervisor', 'supervisor', '$2y$10$Evsc6DHXZHpnfva/8Kg6fOQVJA3BkUXKq2yP2UYz7U9WcHnwTg5vy', 'Perempuan', '99999999999999999', 'supervisor supervisor supervisor', '3', '1', '2023-07-16 14:44:11', '1', NULL, NULL);
INSERT INTO `tb_user_copy1` VALUES (4, 'Team Produk', 'team_produk', '$2y$10$WYg6A2Y8OPnbtqiK1MeXB.UUYoBC5tO8NLz/VYHEFf9uK8E44OQJe', 'Perempuan', '99999999999999999', 'Team Produk Team Produk', '4', '1', '2023-07-16 14:44:54', '1', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
