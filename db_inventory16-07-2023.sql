/*
Navicat MySQL Data Transfer

Source Server         : LocalHost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : db_inventory

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2023-07-11 08:29:49
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
  `id_status` varchar(64) DEFAULT NULL,
  `id_barang_masuk` varchar(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang_keluar`) USING BTREE,
  KEY `id_kategori` (`id_kategori`) USING BTREE,
  KEY `id_produk` (`id_produk`) USING BTREE,
  KEY `id_penjualan` (`id_penjualan`) USING BTREE,
  CONSTRAINT `tb_barang_keluar_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_keluar_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_keluar_ibfk_3` FOREIGN KEY (`id_penjualan`) REFERENCES `tb_penjualan` (`id_penjualan`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_barang_keluar
-- ----------------------------
INSERT INTO `tb_barang_keluar` VALUES ('7', '1', '1', '6', '1', '2', '2023-07-02 05:22:43', '1', null, null);
INSERT INTO `tb_barang_keluar` VALUES ('8', '1', '1', '6', '1', '3', '2023-07-02 05:22:44', '1', null, null);
INSERT INTO `tb_barang_keluar` VALUES ('9', '1', '1', '6', '1', '1', '2023-07-02 05:22:44', '1', null, null);

-- ----------------------------
-- Table structure for `tb_barang_masuk`
-- ----------------------------
DROP TABLE IF EXISTS `tb_barang_masuk`;
CREATE TABLE `tb_barang_masuk` (
  `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT,
  `id_supp` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `tanggal_kadaluarsa` varchar(64) DEFAULT NULL,
  `id_status` varchar(64) DEFAULT NULL,
  `id_penjualan` varchar(64) DEFAULT '',
  `create_date` datetime DEFAULT NULL,
  `create_adm` varchar(64) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `update_adm` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_barang_masuk`),
  KEY `id_supp` (`id_supp`) USING BTREE,
  KEY `id_kategori` (`id_kategori`) USING BTREE,
  KEY `id_produk` (`id_produk`) USING BTREE,
  CONSTRAINT `tb_barang_masuk_ibfk_1` FOREIGN KEY (`id_supp`) REFERENCES `tb_supplier` (`id_supp`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_masuk_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `tb_barang_masuk_ibfk_3` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_barang_masuk
-- ----------------------------
INSERT INTO `tb_barang_masuk` VALUES ('1', '1', '1', '1', '2023-07-15', '1', '6', '2023-06-30 22:55:13', '1', '2023-07-02 05:22:44', '1');
INSERT INTO `tb_barang_masuk` VALUES ('2', '1', '1', '1', '2023-06-29', '3', '6', '2023-06-30 23:22:07', '1', '2023-07-02 05:22:44', '1');
INSERT INTO `tb_barang_masuk` VALUES ('3', '1', '1', '1', '2023-07-03', '1', '6', '2023-06-30 23:22:33', '1', '2023-07-02 05:22:44', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_kategori
-- ----------------------------
INSERT INTO `tb_kategori` VALUES ('1', 'Kategori01', '1', '2023-06-30 16:26:42', '1', '2023-06-30 21:18:49', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_pelanggan
-- ----------------------------
INSERT INTO `tb_pelanggan` VALUES ('1', 'Pelanggan 01', 'Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1Pelanggan 1', 'Laki-laki', '999999999999999999999', '1', '2023-06-30 09:41:16', '1', '2023-06-30 09:57:38', '1');

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
INSERT INTO `tb_penjualan` VALUES ('4', '1', '1', '2023-07-04', '1', null, null, '2023-07-02 03:55:23', '1');
INSERT INTO `tb_penjualan` VALUES ('5', '1', '1', '2023-07-02', '3', null, null, null, null);
INSERT INTO `tb_penjualan` VALUES ('6', '1', '1', '2023-07-02', '1', null, null, '2023-07-02 05:22:43', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_produk
-- ----------------------------
INSERT INTO `tb_produk` VALUES ('1', '1', 'Produk01', '10000', '1', '2023-06-30 21:41:17', '1', '2023-06-30 21:54:26', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_supplier
-- ----------------------------
INSERT INTO `tb_supplier` VALUES ('1', 'Supplier01', 'Supplier1Supplier1Supplier1Supplier1', '99999999999999999999999', '1', '2023-06-30 15:29:47', '1', '2023-06-30 15:43:11', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'Administrator', 'admin', '$2y$10$dCGhrxGWByZjpCXSzooe7.JOk9GsvY3rEkuTiE6321ZY9wXQEIp0e', 'Laki-laki', '88888888888888888888', 'admin admin admin admin', '1', '1', '2023-06-30 05:08:34', null, '2023-06-30 06:07:15', '1');
