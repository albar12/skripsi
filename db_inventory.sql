/*
Navicat MySQL Data Transfer

Source Server         : LocalHost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_inventory

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-08-14 00:18:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_barang_keluar`
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang_keluar`;
CREATE TABLE `tb_barang_keluar` (
  `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `id_penjualan` int(11) DEFAULT NULL,
  `jumlah` varchar(64) DEFAULT '',
  `status_produk` varchar(64) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `id_barang_masuk` varchar(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(255) DEFAULT NULL,
  `flag_so` text DEFAULT NULL,
  PRIMARY KEY (`id_barang_keluar`) USING BTREE,
  KEY `id_kategori` (`id_kategori`) USING BTREE,
  KEY `id_produk` (`id_produk`) USING BTREE,
  KEY `id_penjualan` (`id_penjualan`) USING BTREE,
  CONSTRAINT `tb_barang_keluar_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_keluar_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_keluar_ibfk_3` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id_penjualan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_barang_keluar
-- ----------------------------
INSERT INTO `tb_barang_keluar` VALUES ('7', '1', '1', '6', null, null, '1', '2', '2023-07-02 05:22:43', '1', null, null, null);
INSERT INTO `tb_barang_keluar` VALUES ('8', '1', '1', '6', null, null, '1', '3', '2023-07-02 05:22:44', '1', null, null, null);
INSERT INTO `tb_barang_keluar` VALUES ('9', '1', '1', '6', null, null, '1', '1', '2023-07-02 05:22:44', '1', null, null, null);
INSERT INTO `tb_barang_keluar` VALUES ('14', '2', '2', null, '1', 'Produk Rusak', '1', null, '2023-08-13 19:30:57', '1', '2023-08-13 19:38:00', '1', '5');

-- ----------------------------
-- Table structure for `tb_barang_masuk`
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang_masuk`;
CREATE TABLE `tb_barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `id_supp` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `tanggal_kadaluarsa` varchar(64) DEFAULT '',
  `id_status` varchar(64) DEFAULT NULL,
  `id_penjualan` varchar(64) DEFAULT '',
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  `flag_so` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_barang_masuk`),
  KEY `id_supp` (`id_supp`) USING BTREE,
  KEY `id_kategori` (`id_kategori`) USING BTREE,
  KEY `id_produk` (`id_produk`) USING BTREE,
  CONSTRAINT `tb_barang_masuk_ibfk_1` FOREIGN KEY (`id_supp`) REFERENCES `tb_supplier` (`id_supp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_masuk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_masuk_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_barang_masuk
-- ----------------------------
INSERT INTO `tb_barang_masuk` VALUES ('1', '1', '1', '1', '2023-07-15', '3', '6', '2023-06-30 22:55:13', '1', '2023-07-02 05:22:44', '1', null);
INSERT INTO `tb_barang_masuk` VALUES ('2', '1', '1', '1', '2023-06-29', '3', '6', '2023-06-30 23:22:07', '1', '2023-07-02 05:22:44', '1', null);
INSERT INTO `tb_barang_masuk` VALUES ('3', '1', '1', '1', '2023-07-03', '3', '6', '2023-06-30 23:22:33', '1', '2023-07-02 05:22:44', '1', null);
INSERT INTO `tb_barang_masuk` VALUES ('4', '1', '1', '1', '2023-07-11', '3', '', '2023-07-11 15:24:51', '1', null, null, null);
INSERT INTO `tb_barang_masuk` VALUES ('5', '1', '2', '2', '2023-08-31', '1', '', '2023-08-13 18:02:31', '1', '2023-08-13 19:38:00', '1', '1');
INSERT INTO `tb_barang_masuk` VALUES ('6', '1', '2', '3', '2023-08-31', '1', '', '2023-08-13 18:09:17', '1', null, null, null);
INSERT INTO `tb_barang_masuk` VALUES ('7', '1', '2', '2', '2023-08-31', '1', '', '2023-08-13 18:09:32', '1', '2023-08-13 19:37:52', '1', null);

-- ----------------------------
-- Table structure for `tb_detail_penjualan`
-- ----------------------------
DROP TABLE IF EXISTS `tb_detail_penjualan`;
CREATE TABLE `tb_detail_penjualan` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_penjualan` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `diskon` varchar(64) DEFAULT NULL,
  `diskon_tambahan` varchar(64) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `sub_total` int(20) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_penjualan` (`id_penjualan`),
  CONSTRAINT `tb_detail_penjualan_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id_penjualan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_detail_penjualan
-- ----------------------------
INSERT INTO `tb_detail_penjualan` VALUES ('6', '5', '1', '1', '', '', '10000', '20000', '2023-07-02 05:13:04', '1', null, null);
INSERT INTO `tb_detail_penjualan` VALUES ('10', '6', '1', '1', '', '', '1', '10000', '2023-07-02 05:22:43', '1', null, null);
INSERT INTO `tb_detail_penjualan` VALUES ('11', '6', '1', '1', '', '', '2', '20000', '2023-07-02 05:22:44', '1', null, null);
INSERT INTO `tb_detail_penjualan` VALUES ('12', '6', '1', '1', '', '', '1', '10000', '2023-07-02 05:22:44', '1', null, null);

-- ----------------------------
-- Table structure for `tb_kategori`
-- ----------------------------
DROP TABLE IF EXISTS `tb_kategori`;
CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(64) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_kategori
-- ----------------------------
INSERT INTO `tb_kategori` VALUES ('1', 'Kategori01', '3', '2023-06-30 16:26:42', '1', '2023-06-30 21:18:49', '1');
INSERT INTO `tb_kategori` VALUES ('2', 'Sabun Wajah', '1', '2023-07-16 19:46:36', '1', null, null);
INSERT INTO `tb_kategori` VALUES ('3', 'Toner Wajah', '1', '2023-07-16 19:46:51', '1', null, null);
INSERT INTO `tb_kategori` VALUES ('4', 'Serum Wajah', '1', '2023-07-16 19:46:59', '1', null, null);
INSERT INTO `tb_kategori` VALUES ('5', 'Krim Pagi', '1', '2023-07-16 19:47:10', '1', null, null);
INSERT INTO `tb_kategori` VALUES ('6', 'Krim Malam', '1', '2023-07-16 19:47:25', '1', null, null);
INSERT INTO `tb_kategori` VALUES ('7', 'Premium Produk', '3', '2023-07-16 19:47:45', '1', null, null);
INSERT INTO `tb_kategori` VALUES ('8', 'Pelembab Wajah', '1', '2023-07-16 19:47:55', '1', null, null);

-- ----------------------------
-- Table structure for `tb_pelanggan`
-- ----------------------------
DROP TABLE IF EXISTS `tb_pelanggan`;
CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(64) DEFAULT NULL,
  `alamat_pelanggan` text DEFAULT NULL,
  `jenis_kelamin` varchar(64) DEFAULT NULL,
  `tlp_pelanggan` varchar(64) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_pelanggan
-- ----------------------------
INSERT INTO `tb_pelanggan` VALUES ('1', 'Pelanggan 01', 'Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1', 'Laki-laki', '999999999999999999999', '1', '2023-06-30 09:41:16', '1', '2023-06-30 09:57:38', '1');
INSERT INTO `tb_pelanggan` VALUES ('2', 'Pelanggan 2', 'Pelanggan 2', 'Perempuan', '99999999999999999999', '1', '2023-07-16 15:00:14', '1', null, null);
INSERT INTO `tb_pelanggan` VALUES ('3', 'Pelanggan 3', 'Pelanggan 3', 'Perempuan', '99999999999999999', '1', '2023-07-16 15:00:27', '1', null, null);

-- ----------------------------
-- Table structure for `tb_penjualan`
-- ----------------------------
DROP TABLE IF EXISTS `tb_penjualan`;
CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tanggal_penjualan` varchar(64) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `id_user` (`id_user`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_penjualan
-- ----------------------------
INSERT INTO `tb_penjualan` VALUES ('1', '1', '1', '2023-07-01', '3', null, null, null, null);
INSERT INTO `tb_penjualan` VALUES ('2', '1', '1', '2023-07-01', '3', null, null, null, null);
INSERT INTO `tb_penjualan` VALUES ('3', '1', '1', '2023-07-01', '3', null, null, null, null);
INSERT INTO `tb_penjualan` VALUES ('4', '1', '1', '2023-07-04', '3', null, null, '2023-07-02 03:55:23', '1');
INSERT INTO `tb_penjualan` VALUES ('5', '1', '1', '2023-07-02', '3', null, null, null, null);
INSERT INTO `tb_penjualan` VALUES ('6', '1', '1', '2023-07-02', '3', null, null, '2023-07-02 05:22:43', '1');

-- ----------------------------
-- Table structure for `tb_produk`
-- ----------------------------
DROP TABLE IF EXISTS `tb_produk`;
CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) DEFAULT NULL,
  `nama_produk` varchar(64) DEFAULT NULL,
  `harga_satuan` int(20) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_produk`),
  KEY `id_kategori` (`id_kategori`) USING BTREE,
  CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_produk
-- ----------------------------
INSERT INTO `tb_produk` VALUES ('1', '1', 'Produk01', '10000', '3', '2023-06-30 21:41:17', '1', '2023-06-30 21:54:26', '1');
INSERT INTO `tb_produk` VALUES ('2', '2', 'Facial Wash Brightening', '72000', '1', '2023-07-16 19:48:42', '1', null, null);
INSERT INTO `tb_produk` VALUES ('3', '2', 'Facial Wash Sensitif', '70000', '1', '2023-07-16 19:49:37', '1', null, null);
INSERT INTO `tb_produk` VALUES ('4', '2', 'Facial Wash Anti Aging', '71000', '1', '2023-07-16 19:50:01', '1', null, null);
INSERT INTO `tb_produk` VALUES ('5', '3', 'Toner Whitening', '70000', '1', '2023-07-16 19:50:19', '1', null, null);
INSERT INTO `tb_produk` VALUES ('6', '3', 'Toner Anti Aging', '69000', '1', '2023-07-16 19:50:56', '1', null, null);
INSERT INTO `tb_produk` VALUES ('7', '3', 'Premium Toner Acner Prone Skin', '173000', '1', '2023-07-16 19:51:40', '1', null, null);
INSERT INTO `tb_produk` VALUES ('8', '4', 'Serum Brightening', '159000', '1', '2023-07-16 19:52:23', '1', null, null);
INSERT INTO `tb_produk` VALUES ('9', '4', 'Serum Anti Aging', '200000', '1', '2023-07-16 19:52:42', '1', null, null);
INSERT INTO `tb_produk` VALUES ('10', '4', 'Serum Vitamin C 10%', '107000', '1', '2023-07-16 19:53:07', '1', null, null);
INSERT INTO `tb_produk` VALUES ('11', '5', 'Sunscreen Light Pink SPF 30', '73000', '1', '2023-07-16 19:54:13', '1', null, null);
INSERT INTO `tb_produk` VALUES ('12', '5', 'Sunscreen Beige SPF 50', '70000', '1', '2023-07-16 19:55:10', '1', null, null);
INSERT INTO `tb_produk` VALUES ('13', '5', 'Sunblock Pink SPF 50', '75000', '1', '2023-07-16 19:55:43', '1', null, null);
INSERT INTO `tb_produk` VALUES ('14', '6', 'Silky Whitening', '119000', '1', '2023-07-16 19:56:25', '1', null, null);
INSERT INTO `tb_produk` VALUES ('15', '6', 'Cream Anti Aging', '84000', '1', '2023-07-16 19:56:51', '1', null, null);
INSERT INTO `tb_produk` VALUES ('16', '6', 'Premium Acne Whitening Gel', '110000', '1', '2023-07-16 19:57:29', '1', null, null);
INSERT INTO `tb_produk` VALUES ('17', '8', 'Pudding Gel Moisturaizer', '91000', '1', '2023-07-16 19:58:49', '1', null, null);
INSERT INTO `tb_produk` VALUES ('18', '8', 'Skin Barier Cream', '63000', '1', '2023-07-16 19:59:14', '1', null, null);

-- ----------------------------
-- Table structure for `tb_supplier`
-- ----------------------------
DROP TABLE IF EXISTS `tb_supplier`;
CREATE TABLE `tb_supplier` (
  `id_supp` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supp` varchar(64) DEFAULT NULL,
  `alamat_supp` text DEFAULT NULL,
  `tlp_supp` varchar(64) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_supp`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_supplier
-- ----------------------------
INSERT INTO `tb_supplier` VALUES ('1', 'Supplier01', 'Supplier1Supplier1Supplier1Supplier1', '99999999999999999999999', '1', '2023-06-30 15:29:47', '1', '2023-06-30 15:43:11', '1');
INSERT INTO `tb_supplier` VALUES ('2', 'Supplier2', 'Supplier2', '99999999999', '1', '2023-07-16 20:00:41', '1', null, null);
INSERT INTO `tb_supplier` VALUES ('3', 'Supplier3', 'Supplier3', '99999999999999999', '1', '2023-07-16 20:00:52', '1', null, null);

-- ----------------------------
-- Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) DEFAULT NULL,
  `username` varchar(200) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `jenis_kelamin` varchar(64) DEFAULT NULL,
  `nomor_hp` varchar(64) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `posisi` varchar(64) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'Administrator', 'admin', '$2y$10$dCGhrxGWByZjpCXSzooe7.JOk9GsvY3rEkuTiE6321ZY9wXQEIp0e', 'Laki-laki', '88888888888888888888', 'admin admin admin admin', '1', '1', '2023-06-30 05:08:34', null, '2023-06-30 06:07:15', '1');
INSERT INTO `tb_user` VALUES ('2', 'Owner', 'owner', '$2y$10$kDy9fdMHZGpJt8VrP.XTDOja8f0tlGYHwDwNs5On9ye394LU.a0zW', 'Laki-laki', '99999999999999999999999', 'owner owner owner', '2', '1', '2023-07-16 14:42:08', '1', null, null);
INSERT INTO `tb_user` VALUES ('3', 'Supervisor', 'supervisor', '$2y$10$Evsc6DHXZHpnfva/8Kg6fOQVJA3BkUXKq2yP2UYz7U9WcHnwTg5vy', 'Perempuan', '99999999999999999', 'supervisor supervisor supervisor', '3', '1', '2023-07-16 14:44:11', '1', null, null);
INSERT INTO `tb_user` VALUES ('4', 'Team Produk', 'team_produk', '$2y$10$WYg6A2Y8OPnbtqiK1MeXB.UUYoBC5tO8NLz/VYHEFf9uK8E44OQJe', 'Perempuan', '99999999999999999', 'Team Produk Team Produk', '4', '1', '2023-07-16 14:44:54', '1', null, null);
