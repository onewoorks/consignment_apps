-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: consignment
-- ------------------------------------------------------
-- Server version	8.0.29

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

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_branches`
--

DROP TABLE IF EXISTS `kh_branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_branches` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `branch_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_branches`
--

LOCK TABLES `kh_branches` WRITE;
/*!40000 ALTER TABLE `kh_branches` DISABLE KEYS */;
/*!40000 ALTER TABLE `kh_branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_catalogs`
--

DROP TABLE IF EXISTS `kh_catalogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_catalogs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shop_id` int NOT NULL,
  `available_stock` int NOT NULL,
  `price_per_unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_catalogs`
--

LOCK TABLES `kh_catalogs` WRITE;
/*!40000 ALTER TABLE `kh_catalogs` DISABLE KEYS */;
INSERT INTO `kh_catalogs` VALUES (1,'2022-06-06 01:40:26','2022-06-17 11:01:54','AAA',1,2,'1',NULL,'khai'),(2,'2022-06-06 01:40:43','2022-06-17 11:01:54','BBB',1,2,'2',NULL,'khai');
/*!40000 ALTER TABLE `kh_catalogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_customers`
--

DROP TABLE IF EXISTS `kh_customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_customers` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_visit` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_customers`
--

LOCK TABLES `kh_customers` WRITE;
/*!40000 ALTER TABLE `kh_customers` DISABLE KEYS */;
INSERT INTO `kh_customers` VALUES (1,'2022-06-02 09:29:24','2022-06-02 09:29:24','Iwang','DG','Sura','Iwang','0186667777','2.9851648','101.5578624','/uploads/spanar.png',NULL,NULL,NULL),(2,'2022-06-02 09:30:21','2022-06-02 09:30:21','Cikgu','KT','Gong Badak','Hanapi','0178885553','2.9851648','101.5578624','/uploads/spanar.png',NULL,NULL,NULL);
/*!40000 ALTER TABLE `kh_customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_inventories`
--

DROP TABLE IF EXISTS `kh_inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_inventories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shop_id` int NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock_flow` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price_per_unit` double(8,2) DEFAULT NULL,
  `total_price` double(8,2) DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_inventories`
--

LOCK TABLES `kh_inventories` WRITE;
/*!40000 ALTER TABLE `kh_inventories` DISABLE KEYS */;
INSERT INTO `kh_inventories` VALUES (1,'2022-06-11 21:16:50','2022-06-11 21:16:50',1,'AAA','AAA','OUT',1,1.00,1.00,'',NULL,'DG'),(2,'2022-06-11 21:16:50','2022-06-11 21:16:50',1,'BBB','BBB','OUT',1,2.00,2.00,'',NULL,'DG'),(3,'2022-06-11 21:16:50','2022-06-11 21:16:50',1,'AAA','AAA','IN',5,1.00,5.00,'',NULL,'DG'),(4,'2022-06-11 21:16:50','2022-06-11 21:16:50',1,'BBB','BBB','IN',4,2.00,8.00,'',NULL,'DG'),(5,'2022-06-11 21:23:47','2022-06-11 21:23:47',1,'AAA','AAA','OUT',1,1.00,1.00,'',NULL,'DG'),(6,'2022-06-11 21:23:47','2022-06-11 21:23:47',1,'BBB','BBB','OUT',1,2.00,2.00,'',NULL,'DG'),(7,'2022-06-11 21:23:47','2022-06-11 21:23:47',1,'AAA','AAA','IN',4,1.00,4.00,'',NULL,'DG'),(8,'2022-06-11 21:23:47','2022-06-11 21:23:47',1,'BBB','BBB','IN',3,2.00,6.00,'',NULL,'DG'),(9,'2022-06-11 21:25:40','2022-06-11 21:25:40',1,'AAA','AAA','OUT',1,1.00,1.00,'',NULL,'DG'),(10,'2022-06-11 21:25:40','2022-06-11 21:25:40',1,'BBB','BBB','OUT',1,2.00,2.00,'',NULL,'DG'),(11,'2022-06-11 21:25:40','2022-06-11 21:25:40',1,'AAA','AAA','IN',1,1.00,1.00,'',NULL,'DG'),(12,'2022-06-11 21:25:40','2022-06-11 21:25:40',1,'BBB','BBB','IN',1,2.00,2.00,'',NULL,'DG'),(13,'2022-06-11 21:46:48','2022-06-11 21:46:48',1,'AAA','AAA','OUT',1,1.00,1.00,'',NULL,'DG'),(14,'2022-06-11 21:46:48','2022-06-11 21:46:48',1,'BBB','BBB','OUT',1,2.00,2.00,'',NULL,'DG'),(15,'2022-06-11 21:46:48','2022-06-11 21:46:48',1,'AAA','AAA','IN',3,1.00,3.00,'',NULL,'DG'),(16,'2022-06-11 21:46:48','2022-06-11 21:46:48',1,'BBB','BBB','IN',3,2.00,6.00,'',NULL,'DG'),(17,'2022-06-12 02:39:43','2022-06-12 02:39:43',1,'AAA','AAA','OUT',1,1.00,1.00,'khai',NULL,'DG'),(18,'2022-06-12 02:39:43','2022-06-12 02:39:43',1,'BBB','BBB','OUT',1,2.00,2.00,'khai',NULL,'DG'),(19,'2022-06-12 02:39:43','2022-06-12 02:39:43',1,'AAA','AAA','IN',1,1.00,1.00,'khai',NULL,'DG'),(20,'2022-06-12 02:39:43','2022-06-12 02:39:43',1,'BBB','BBB','IN',1,2.00,2.00,'khai',NULL,'DG'),(21,'2022-06-12 05:39:54','2022-06-12 05:39:54',1,'AAA','AAA','OUT',1,1.00,1.00,'khai',NULL,'DG'),(22,'2022-06-12 05:39:54','2022-06-12 05:39:54',1,'BBB','BBB','OUT',1,2.00,2.00,'khai',NULL,'DG'),(23,'2022-06-12 05:39:54','2022-06-12 05:39:54',1,'AAA','AAA','IN',2,1.00,2.00,'khai',NULL,'DG'),(24,'2022-06-12 05:39:54','2022-06-12 05:39:54',1,'BBB','BBB','IN',1,2.00,2.00,'khai',NULL,'DG'),(25,'2022-06-12 10:49:21','2022-06-12 10:49:21',1,'AAA','AAA','OUT',2,1.00,2.00,'khai',NULL,'DG'),(26,'2022-06-12 10:49:21','2022-06-12 10:49:21',1,'BBB','BBB','OUT',1,2.00,2.00,'khai',NULL,'DG'),(27,'2022-06-12 10:49:21','2022-06-12 10:49:21',1,'AAA','AAA','IN',5,1.00,5.00,'khai',NULL,'DG'),(28,'2022-06-12 10:49:21','2022-06-12 10:49:21',1,'BBB','BBB','IN',3,2.00,6.00,'khai',NULL,'DG'),(29,'2022-06-12 11:04:52','2022-06-12 11:04:52',1,'AAA','AAA','OUT',1,1.00,1.00,'khai',NULL,'DG'),(30,'2022-06-12 11:04:52','2022-06-12 11:04:52',1,'BBB','BBB','OUT',1,2.00,2.00,'khai',NULL,'DG'),(31,'2022-06-12 11:04:52','2022-06-12 11:04:52',1,'AAA','AAA','IN',2,1.00,2.00,'khai',NULL,'DG'),(32,'2022-06-12 11:04:52','2022-06-12 11:04:52',1,'BBB','BBB','IN',2,2.00,4.00,'khai',NULL,'DG'),(33,'2022-06-12 11:11:24','2022-06-12 11:11:24',1,'AAA','AAA','OUT',1,1.00,1.00,'khai',NULL,'DG'),(34,'2022-06-12 11:11:24','2022-06-12 11:11:24',1,'BBB','BBB','OUT',1,2.00,2.00,'khai',NULL,'DG'),(35,'2022-06-12 11:11:24','2022-06-12 11:11:24',1,'AAA','AAA','IN',4,1.00,4.00,'khai',NULL,'DG'),(36,'2022-06-12 11:11:24','2022-06-12 11:11:24',1,'BBB','BBB','IN',3,2.00,6.00,'khai',NULL,'DG'),(37,'2022-06-17 11:01:54','2022-06-17 11:01:54',1,'AAA','AAA','OUT',1,1.00,1.00,'khai',NULL,'DG'),(38,'2022-06-17 11:01:54','2022-06-17 11:01:54',1,'BBB','BBB','OUT',1,2.00,2.00,'khai',NULL,'DG'),(39,'2022-06-17 11:01:54','2022-06-17 11:01:54',1,'AAA','AAA','IN',2,1.00,2.00,'khai',NULL,'DG'),(40,'2022-06-17 11:01:54','2022-06-17 11:01:54',1,'BBB','BBB','IN',2,2.00,4.00,'khai',NULL,'DG'),(41,'2022-06-18 19:39:21','2022-06-18 19:39:21',2,'SHOP_CLOSED',NULL,NULL,NULL,NULL,NULL,'khai',NULL,'KT');
/*!40000 ALTER TABLE `kh_inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_lovs`
--

DROP TABLE IF EXISTS `kh_lovs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_lovs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lov_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lov_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lov_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_lovs`
--

LOCK TABLES `kh_lovs` WRITE;
/*!40000 ALTER TABLE `kh_lovs` DISABLE KEYS */;
INSERT INTO `kh_lovs` VALUES (1,NULL,NULL,'TASK_STATUS','N','New',NULL,NULL,NULL,NULL),(2,NULL,NULL,'TASK_STATUS','R','Running',NULL,NULL,NULL,NULL),(3,NULL,NULL,'TASK_STATUS','C','Completed',NULL,NULL,NULL,NULL),(4,NULL,NULL,'SHOP_STATUS','O','Open',NULL,NULL,NULL,NULL),(5,NULL,NULL,'SHOP_STATUS','C','Close',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `kh_lovs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_products`
--

DROP TABLE IF EXISTS `kh_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_products`
--

LOCK TABLES `kh_products` WRITE;
/*!40000 ALTER TABLE `kh_products` DISABLE KEYS */;
INSERT INTO `kh_products` VALUES (1,NULL,NULL,'AAA','AAA','AAA','A'),(2,NULL,NULL,'BBB','BBB','BBB','A');
/*!40000 ALTER TABLE `kh_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_states`
--

DROP TABLE IF EXISTS `kh_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_states`
--

LOCK TABLES `kh_states` WRITE;
/*!40000 ALTER TABLE `kh_states` DISABLE KEYS */;
/*!40000 ALTER TABLE `kh_states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_task_assignments`
--

DROP TABLE IF EXISTS `kh_task_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_task_assignments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `task_id` int NOT NULL,
  `sequence` int NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `shop_id` int NOT NULL,
  `shop_status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_task_assignments`
--

LOCK TABLES `kh_task_assignments` WRITE;
/*!40000 ALTER TABLE `kh_task_assignments` DISABLE KEYS */;
INSERT INTO `kh_task_assignments` VALUES (4,'2022-06-02 06:04:54','2022-06-02 06:04:54',15,1,'N',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL),(27,'2022-06-18 17:25:50','2022-06-18 19:39:21',23,1,'C',NULL,NULL,2,'C',NULL,'dd',NULL,'khai');
/*!40000 ALTER TABLE `kh_task_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_task_users`
--

DROP TABLE IF EXISTS `kh_task_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_task_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `task_id` int NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_task_users`
--

LOCK TABLES `kh_task_users` WRITE;
/*!40000 ALTER TABLE `kh_task_users` DISABLE KEYS */;
INSERT INTO `kh_task_users` VALUES (20,'2022-06-02 06:04:37','2022-06-02 06:04:37',15,'khai','','admin'),(28,'2022-06-18 03:50:58','2022-06-18 03:50:58',23,'khai','','admin');
/*!40000 ALTER TABLE `kh_task_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_tasks`
--

DROP TABLE IF EXISTS `kh_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `task_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_id` int NOT NULL,
  `task_status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `remarks` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_tasks`
--

LOCK TABLES `kh_tasks` WRITE;
/*!40000 ALTER TABLE `kh_tasks` DISABLE KEYS */;
INSERT INTO `kh_tasks` VALUES (15,'2022-06-02 06:04:37','2022-06-02 06:04:37','Task A',1,'N',NULL,NULL,'kerja ikut tugas diberi','admin'),(23,'2022-06-18 03:50:58','2022-06-18 03:50:58','Task C',1,'N','2022-06-18 19:50:00',NULL,NULL,'admin');
/*!40000 ALTER TABLE `kh_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_team_members`
--

DROP TABLE IF EXISTS `kh_team_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_team_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_id` int NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_joined` date DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_team_members`
--

LOCK TABLES `kh_team_members` WRITE;
/*!40000 ALTER TABLE `kh_team_members` DISABLE KEYS */;
INSERT INTO `kh_team_members` VALUES (1,NULL,NULL,1,'khai','khai','2022-05-29','M'),(2,NULL,NULL,1,'webadmin','admin','2022-05-29','M'),(3,NULL,NULL,1,'admin','admin','2022-05-29','L');
/*!40000 ALTER TABLE `kh_team_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kh_teams`
--

DROP TABLE IF EXISTS `kh_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kh_teams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `team_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kh_teams`
--

LOCK TABLES `kh_teams` WRITE;
/*!40000 ALTER TABLE `kh_teams` DISABLE KEYS */;
INSERT INTO `kh_teams` VALUES (1,NULL,NULL,'ZROX','ZROX'),(2,NULL,NULL,'BVR','BVR'),(3,NULL,NULL,'TWENTY TWO','TWENTY TWO'),(4,NULL,NULL,'SUDENG','SUDENG'),(5,NULL,NULL,'STERN','STERN');
/*!40000 ALTER TABLE `kh_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_05_25_074742_create_states_table',2),(6,'2022_05_25_075050_create_branches_table',3),(7,'2022_05_25_042420_create_inventories_table',4),(8,'2022_05_25_144357_create_products_table',5),(9,'2022_05_25_144909_create_catalogs_table',6),(10,'2022_05_28_144909_create_catalogs_table',7),(11,'2022_05_22_032200_create_customers_table',8),(12,'2022_05_28_152115_create_tasks_table',9),(13,'2022_05_28_152407_create_task_users_table',10),(14,'2022_05_28_152500_create_task_assignments_table',11),(15,'2022_05_28_171405_create_teams_table',12),(16,'2022_05_28_171421_create_team_members_table',13),(17,'2022_05_29_171421_create_team_members_table',14),(18,'2022_06_02_153458_create_lovs_table',15);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','m3sr023@gmail.com',NULL,'$2y$10$X0buP9eH1iZdIUMI4MNR0.JhbFvPIyoHx6DLFiGtISLEedim0qDUm',NULL,'2022-05-16 06:22:32','2022-05-16 06:22:32',NULL,NULL,NULL),(2,'admin','admin@gmail.com',NULL,'$2y$10$tjAY9aAU0WpHKYVvXoc80OCI3w.KP0JNu9Gn0KaNLGt5ZjIw6ltXS',NULL,'2022-05-20 23:32:20','2022-05-20 23:32:20','admin','2022-05-04','/images/1653118340.jpg'),(3,'webadmin','admin@admin.com',NULL,'$2y$10$SKztF/loMG7DTAroZnduSubRASpd3b9WfBJQTGREMdzKFz323BFD2',NULL,'2022-05-21 18:11:56','2022-05-21 18:11:56','admin','2022-05-01','/images/1653185516.jpg'),(4,'khai','mykr8823@yahoo.com',NULL,'$2y$10$6bnunJTQcQKpH3XMHEHaf.8SbJY.k6kvoad/ezVWgGDVA7nR.MP/y',NULL,'2022-05-31 07:56:09','2022-05-31 07:56:09','agent','2000-02-02','/images/1654012569.jpg');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'consignment'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-19 13:34:41
