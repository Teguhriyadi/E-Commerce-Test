-- MySQL dump 10.13  Distrib 9.5.0, for macos15.7 (arm64)
--
-- Host: localhost    Database: ecommerce
-- ------------------------------------------------------
-- Server version	9.5.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ 'c481f5dc-e7b7-11f0-a921-4794129ddf86:1-28845';

--
-- Table structure for table `master_barang`
--

DROP TABLE IF EXISTS `master_barang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_barang` (
  `kode_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_barang`
--

LOCK TABLES `master_barang` WRITE;
/*!40000 ALTER TABLE `master_barang` DISABLE KEYS */;
INSERT INTO `master_barang` VALUES ('BRG-001','Teko Murah',300000.00),('BRG-002','Tisu Paseo',500000.00);
/*!40000 ALTER TABLE `master_barang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (12,'2026-09-11-075730','App\\Database\\Migrations\\CreateMasterBarangTable','default','App',1789115354,1),(13,'2026-09-11-075802','App\\Database\\Migrations\\CreatePromoTable','default','App',1789115354,1),(14,'2026-09-11-075816','App\\Database\\Migrations\\CreatePenjualanHeaderTable','default','App',1789115354,1),(15,'2026-09-11-075822','App\\Database\\Migrations\\CreatePenjualanHeaderDetailTable','default','App',1789115354,1),(16,'2026-09-12-094705','App\\Database\\Migrations\\CreatePromoPeriodeTable','default','App',1789206538,2),(17,'2026-09-12-094724','App\\Database\\Migrations\\CreatePromoAturanTable','default','App',1789206538,2),(18,'2026-09-12-094745','App\\Database\\Migrations\\CreatePromoDetailTable','default','App',1789206538,2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan_header`
--

DROP TABLE IF EXISTS `penjualan_header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penjualan_header` (
  `no_transaksi` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `customer` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_promo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_bayar` decimal(10,0) NOT NULL DEFAULT '0',
  `ppn` decimal(10,0) NOT NULL DEFAULT '0',
  `grand_total` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no_transaksi`),
  KEY `penjualan_header_kode_promo_foreign` (`kode_promo`),
  CONSTRAINT `penjualan_header_kode_promo_foreign` FOREIGN KEY (`kode_promo`) REFERENCES `promo` (`kode_promo`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan_header`
--

LOCK TABLES `penjualan_header` WRITE;
/*!40000 ALTER TABLE `penjualan_header` DISABLE KEYS */;
INSERT INTO `penjualan_header` VALUES ('202609-001','2026-09-13','Ramadhan',NULL,797000,87670,884670),('202609-002','2026-09-13','Nurul Agustiyanti',NULL,297000,32670,329670);
/*!40000 ALTER TABLE `penjualan_header` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjualan_header_detail`
--

DROP TABLE IF EXISTS `penjualan_header_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penjualan_header_detail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_barang` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `penjualan_header_detail_no_transaksi_foreign` (`no_transaksi`),
  KEY `penjualan_header_detail_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `penjualan_header_detail_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penjualan_header_detail_no_transaksi_foreign` FOREIGN KEY (`no_transaksi`) REFERENCES `penjualan_header` (`no_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan_header_detail`
--

LOCK TABLES `penjualan_header_detail` WRITE;
/*!40000 ALTER TABLE `penjualan_header_detail` DISABLE KEYS */;
INSERT INTO `penjualan_header_detail` VALUES (4,'202609-001','BRG-001',1,300000.00,3000.00,297000.00),(5,'202609-001','BRG-002',1,500000.00,0.00,500000.00),(6,'202609-002','BRG-001',1,300000.00,3000.00,297000.00);
/*!40000 ALTER TABLE `penjualan_header_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo`
--

DROP TABLE IF EXISTS `promo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promo` (
  `kode_promo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_promo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  UNIQUE KEY `kode_promo` (`kode_promo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo`
--

LOCK TABLES `promo` WRITE;
/*!40000 ALTER TABLE `promo` DISABLE KEYS */;
INSERT INTO `promo` VALUES ('PRM-01','Promo 1','Test Promo');
/*!40000 ALTER TABLE `promo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_aturan`
--

DROP TABLE IF EXISTS `promo_aturan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promo_aturan` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode_promo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tipe_promo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `nilai_promo` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promo_aturan_kode_promo_foreign` (`kode_promo`),
  CONSTRAINT `promo_aturan_kode_promo_foreign` FOREIGN KEY (`kode_promo`) REFERENCES `promo` (`kode_promo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_aturan`
--

LOCK TABLES `promo_aturan` WRITE;
/*!40000 ALTER TABLE `promo_aturan` DISABLE KEYS */;
INSERT INTO `promo_aturan` VALUES (4,'PRM-01','PRODUCT_DISCOUNT',3000.00,NULL,NULL);
/*!40000 ALTER TABLE `promo_aturan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_detail`
--

DROP TABLE IF EXISTS `promo_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promo_detail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode_promo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_barang` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `min_qty` int unsigned NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_promo_kode_barang` (`kode_promo`,`kode_barang`),
  KEY `promo_detail_kode_barang_foreign` (`kode_barang`),
  CONSTRAINT `promo_detail_kode_barang_foreign` FOREIGN KEY (`kode_barang`) REFERENCES `master_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `promo_detail_kode_promo_foreign` FOREIGN KEY (`kode_promo`) REFERENCES `promo` (`kode_promo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_detail`
--

LOCK TABLES `promo_detail` WRITE;
/*!40000 ALTER TABLE `promo_detail` DISABLE KEYS */;
INSERT INTO `promo_detail` VALUES (5,'PRM-01','BRG-001',1,NULL,NULL);
/*!40000 ALTER TABLE `promo_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promo_periode`
--

DROP TABLE IF EXISTS `promo_periode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promo_periode` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `kode_promo` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `promo_periode_kode_promo_foreign` (`kode_promo`),
  CONSTRAINT `promo_periode_kode_promo_foreign` FOREIGN KEY (`kode_promo`) REFERENCES `promo` (`kode_promo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promo_periode`
--

LOCK TABLES `promo_periode` WRITE;
/*!40000 ALTER TABLE `promo_periode` DISABLE KEYS */;
INSERT INTO `promo_periode` VALUES (4,'PRM-01','2026-09-13','2026-09-25',NULL,NULL);
/*!40000 ALTER TABLE `promo_periode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ecommerce'
--
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-14 11:54:28
