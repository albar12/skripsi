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

 Date: 30/04/2026 08:20:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for table_absensi
-- ----------------------------
DROP TABLE IF EXISTS `table_absensi`;
CREATE TABLE `table_absensi`  (
  `id_absensi` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `jam_absen` time NULL DEFAULT NULL,
  `status` enum('Hadir','Izin','Sakit','Alpha') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_absensi`) USING BTREE,
  INDEX `pegawai`(`id_user` ASC) USING BTREE,
  CONSTRAINT `pegawai` FOREIGN KEY (`id_user`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_absensi
-- ----------------------------
INSERT INTO `table_absensi` VALUES (1, 1, '2026-04-28', '12:42:33', 'Sakit');
INSERT INTO `table_absensi` VALUES (2, 3, '2026-04-28', '16:24:22', 'Hadir');
INSERT INTO `table_absensi` VALUES (3, 1, '2026-04-29', '09:58:02', 'Hadir');
INSERT INTO `table_absensi` VALUES (7, 3, '2026-04-29', '11:45:59', 'Hadir');

-- ----------------------------
-- Table structure for table_agama
-- ----------------------------
DROP TABLE IF EXISTS `table_agama`;
CREATE TABLE `table_agama`  (
  `id_agama` int NOT NULL AUTO_INCREMENT,
  `nama_agama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `create_admin` int NULL DEFAULT NULL,
  `update_admin` int NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_agama`) USING BTREE,
  INDEX `status`(`status` ASC) USING BTREE,
  INDEX `agama_input`(`create_admin` ASC) USING BTREE,
  INDEX `agama_update`(`update_admin` ASC) USING BTREE,
  CONSTRAINT `agama_input` FOREIGN KEY (`create_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `agama_update` FOREIGN KEY (`update_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status` FOREIGN KEY (`status`) REFERENCES `table_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_agama
-- ----------------------------
INSERT INTO `table_agama` VALUES (1, 'Islam', 1, 1, NULL, '2026-04-28 09:17:20', NULL);
INSERT INTO `table_agama` VALUES (2, 'Kristen', 1, 1, NULL, '2026-04-28 09:17:32', NULL);
INSERT INTO `table_agama` VALUES (3, 'Hindu', 1, 1, NULL, '2026-04-28 09:17:41', NULL);
INSERT INTO `table_agama` VALUES (4, 'Budha', 1, 1, NULL, '2026-04-28 09:17:56', NULL);
INSERT INTO `table_agama` VALUES (5, 'testx', 3, 1, 1, '2026-04-28 15:43:37', '2026-04-28 16:17:39');

-- ----------------------------
-- Table structure for table_cuti
-- ----------------------------
DROP TABLE IF EXISTS `table_cuti`;
CREATE TABLE `table_cuti`  (
  `id_cuti` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `waktu` int NULL DEFAULT NULL,
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `status_approval` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `create_admin` int NULL DEFAULT NULL,
  `update_admin` int NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_cuti`) USING BTREE,
  INDEX `pegawai_cuti`(`id_user` ASC) USING BTREE,
  INDEX `status_data_cuti`(`status` ASC) USING BTREE,
  INDEX `input_cuti`(`create_admin` ASC) USING BTREE,
  INDEX `update_cuti`(`update_admin` ASC) USING BTREE,
  CONSTRAINT `input_cuti` FOREIGN KEY (`create_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pegawai_cuti` FOREIGN KEY (`id_user`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status_data_cuti` FOREIGN KEY (`status`) REFERENCES `table_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `update_cuti` FOREIGN KEY (`update_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_cuti
-- ----------------------------
INSERT INTO `table_cuti` VALUES (1, 1, '2026-04-29', 3, 'pulang kampung', 'Approve', 1, 1, 1, '2026-04-28 13:00:32', '2026-04-28 13:21:45');
INSERT INTO `table_cuti` VALUES (2, 1, '2026-05-02', 1, 'pulang kampung lagi', NULL, 1, 1, NULL, '2026-04-28 13:22:11', NULL);
INSERT INTO `table_cuti` VALUES (3, 3, '2026-04-29', 3, 'pulkam', NULL, 1, 3, NULL, '2026-04-28 16:27:17', NULL);

-- ----------------------------
-- Table structure for table_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `table_jabatan`;
CREATE TABLE `table_jabatan`  (
  `id_jabatan` int NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `create_admin` int NULL DEFAULT NULL,
  `update_admin` int NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`) USING BTREE,
  INDEX `status_data_jabatan`(`status` ASC) USING BTREE,
  INDEX `input_jabatan`(`create_admin` ASC) USING BTREE,
  INDEX `update_jabatan`(`update_admin` ASC) USING BTREE,
  CONSTRAINT `input_jabatan` FOREIGN KEY (`create_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status_data_jabatan` FOREIGN KEY (`status`) REFERENCES `table_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `update_jabatan` FOREIGN KEY (`update_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_jabatan
-- ----------------------------
INSERT INTO `table_jabatan` VALUES (1, 'Admin', 1, 1, NULL, '2026-04-28 09:14:13', NULL);
INSERT INTO `table_jabatan` VALUES (2, 'Kepala Sekolah', 1, 1, NULL, '2026-04-28 09:14:24', NULL);
INSERT INTO `table_jabatan` VALUES (3, 'Guru', 1, 1, NULL, '2026-04-28 09:14:34', NULL);
INSERT INTO `table_jabatan` VALUES (4, 'Staff TU', 1, 1, 1, '2026-04-28 09:44:46', '2026-04-28 10:15:07');

-- ----------------------------
-- Table structure for table_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `table_jadwal`;
CREATE TABLE `table_jadwal`  (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_mapel` int NULL DEFAULT NULL,
  `jam_mulai` time NULL DEFAULT NULL,
  `jam_selesai` time NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `create_admin` int NULL DEFAULT NULL,
  `update_admin` int NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE,
  INDEX `mapel`(`id_mapel` ASC) USING BTREE,
  INDEX `status_data_jadwal`(`status` ASC) USING BTREE,
  INDEX `input_jadwal`(`create_admin` ASC) USING BTREE,
  INDEX `update_jadwal`(`update_admin` ASC) USING BTREE,
  CONSTRAINT `input_jadwal` FOREIGN KEY (`create_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `mapel` FOREIGN KEY (`id_mapel`) REFERENCES `table_mapel` (`id_mapel`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status_data_jadwal` FOREIGN KEY (`status`) REFERENCES `table_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `update_jadwal` FOREIGN KEY (`update_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_jadwal
-- ----------------------------
INSERT INTO `table_jadwal` VALUES (1, 1, '08:00:00', '10:00:00', 1, 1, 1, '2026-04-28 14:09:32', '2026-04-28 13:57:36');

-- ----------------------------
-- Table structure for table_mapel
-- ----------------------------
DROP TABLE IF EXISTS `table_mapel`;
CREATE TABLE `table_mapel`  (
  `id_mapel` int NOT NULL AUTO_INCREMENT,
  `nama_mapel` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `create_admin` int NULL DEFAULT NULL,
  `update_admin` int NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_mapel`) USING BTREE,
  INDEX `status_data_mapel`(`status` ASC) USING BTREE,
  INDEX `input_mapel`(`create_admin` ASC) USING BTREE,
  INDEX `update_mapel`(`update_admin` ASC) USING BTREE,
  CONSTRAINT `input_mapel` FOREIGN KEY (`create_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status_data_mapel` FOREIGN KEY (`status`) REFERENCES `table_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `update_mapel` FOREIGN KEY (`update_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_mapel
-- ----------------------------
INSERT INTO `table_mapel` VALUES (1, 'MTK', 1, 1, 1, '2026-04-28 13:33:48', '2026-04-28 13:43:55');

-- ----------------------------
-- Table structure for table_status
-- ----------------------------
DROP TABLE IF EXISTS `table_status`;
CREATE TABLE `table_status`  (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `create_admin` int NULL DEFAULT NULL,
  `update_admin` int NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_status`) USING BTREE,
  INDEX `input_status`(`create_admin` ASC) USING BTREE,
  INDEX `update_status`(`update_admin` ASC) USING BTREE,
  CONSTRAINT `input_status` FOREIGN KEY (`create_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `update_status` FOREIGN KEY (`update_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_status
-- ----------------------------
INSERT INTO `table_status` VALUES (1, 'Aktif', 1, NULL, '2026-04-28 09:10:11', NULL);
INSERT INTO `table_status` VALUES (2, 'Non-Aktif', 1, NULL, '2026-04-28 09:10:20', NULL);
INSERT INTO `table_status` VALUES (3, 'Hapus', 1, NULL, '2026-04-28 09:10:29', NULL);

-- ----------------------------
-- Table structure for table_user
-- ----------------------------
DROP TABLE IF EXISTS `table_user`;
CREATE TABLE `table_user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nip` int NULL DEFAULT NULL,
  `nama` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `jk` enum('Laki-laki','Perempuan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jabatan` int NULL DEFAULT NULL,
  `no_hp` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `agama` int NULL DEFAULT NULL,
  `status` int NULL DEFAULT NULL,
  `create_admin` int NULL DEFAULT NULL,
  `update_admin` int NULL DEFAULT NULL,
  `create_date` datetime NULL DEFAULT NULL,
  `update_date` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE,
  INDEX `jabatan`(`jabatan` ASC) USING BTREE,
  INDEX `agama`(`agama` ASC) USING BTREE,
  INDEX `create_admin`(`create_admin` ASC) USING BTREE,
  INDEX `update_admin`(`update_admin` ASC) USING BTREE,
  INDEX `status_data_user`(`status` ASC) USING BTREE,
  CONSTRAINT `agama` FOREIGN KEY (`agama`) REFERENCES `table_agama` (`id_agama`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `create_admin` FOREIGN KEY (`create_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `jabatan` FOREIGN KEY (`jabatan`) REFERENCES `table_jabatan` (`id_jabatan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `status_data_user` FOREIGN KEY (`status`) REFERENCES `table_status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `update_admin` FOREIGN KEY (`update_admin`) REFERENCES `table_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of table_user
-- ----------------------------
INSERT INTO `table_user` VALUES (1, 111111, 'Administrator', 'admin@gmail.com', '$2y$10$dCGhrxGWByZjpCXSzooe7.JOk9GsvY3rEkuTiE6321ZY9wXQEIp0e', 'Laki-laki', 1, '0871231729132', 'Jalan kemerdekaan', 1, 1, 1, 1, '2026-04-28 09:06:41', '2026-04-28 10:22:00');
INSERT INTO `table_user` VALUES (3, 260401, 'Wali kelas 1', 'walikelas1@gmail.com', '$2y$10$kwLTkYCR3/lePAbLILCyK./a545GNdcMuk5kmzbOHzR/kxBHR5N6G', 'Perempuan', 3, '0872193812', 'jalan kemerdekaan', 1, 1, 1, 1, '2026-04-28 06:57:30', '2026-04-28 10:22:05');
INSERT INTO `table_user` VALUES (4, 260402, 'Kepsek 1', 'kepsek1@gmail.com', '$2y$10$FkykUnpvFRtCofROAIB/L.f3NQGkzoJuUR.htT63THtV9Vw4JaQLi', 'Laki-laki', 2, '0981293013', 'jalan kemerdekaan', 1, 1, 1, NULL, '2026-04-28 11:18:30', NULL);

SET FOREIGN_KEY_CHECKS = 1;
