-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: laravel
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.22.04.1

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `specifications` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Surveillance & Security','537804591c',NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_reset_tokens_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2024_07_27_212909_create_categories_table',1),(5,'2024_08_12_170329_create_orders_table',1),(6,'2024_08_23_161057_create_sub_categories_table',1),(7,'2024_09_27_212924_create_products_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fullname` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` bigint unsigned NOT NULL,
  `products` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
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
  `expires_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `discounted_price` double(8,2) DEFAULT NULL,
  `stock` int NOT NULL,
  `specifications` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `subcategory_id` bigint unsigned DEFAULT NULL,
  `img_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_subcategory_id_foreign` (`subcategory_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'High-end Power supply 24V/10A',2000.00,1100.00,5,'[{\"specName\":\"Voltage\",\"specValue\":\"24V\"},{\"specName\":\"Wattage\",\"specValue\":\"240W\"}]',1,3,'6221fc5001',NULL,NULL),(2,'Generic SMPS Power supply 12V/10A',1231.00,1111.00,4,'[{\"specName\":\"Voltage\",\"specValue\":\"12V\"},{\"specName\":\"Wattage\",\"specValue\":\"120W\"}]',1,3,'43e2f845f1',NULL,NULL),(3,'Generic SMPS Power supply 12V/6A',2222.00,1111.00,4,'[{\"specName\":\"Voltage\",\"specValue\":\"12V\"},{\"specName\":\"Wattage\",\"specValue\":\"72W\"}]',1,3,'cc231622d2',NULL,NULL),(4,'8 Channel DVR 2MP',2222.00,1111.00,5,'[{\"specName\":\"Channels\",\"specValue\":\"8 Channels\"},{\"specName\":\"Resolution\",\"specValue\":\"2MP\"},{\"specName\":\"Type\",\"specValue\":\"DVR\"}]',1,1,'b6c6a1660c',NULL,NULL),(5,'4 Channel DVR 4MP',535.00,232.00,5,'[{\"specName\":\"Channels\",\"specValue\":\"4 Channels\"},{\"specName\":\"Resolution\",\"specValue\":\"4MP\"},{\"specName\":\"Type\",\"specValue\":\"DVR\"}]',1,1,'8700fc98f8',NULL,NULL),(6,'8 Channel NVR',1232.00,1111.00,3,'[{\"specName\":\"Channels\",\"specValue\":\"8 Channels\"},{\"specName\":\"Resolution\",\"specValue\":\"6MP\"},{\"specName\":\"Type\",\"specValue\":\"NVR\"}]',1,1,'96cbead589',NULL,NULL),(7,'Analog Camera 3MP 12V 1A',600.00,400.00,5,'[{\"specName\":\"Voltage\",\"specValue\":\"12V\"},{\"specName\":\"Wattage\",\"specValue\":\"12W\"},{\"specName\":\"Resolution\",\"specValue\":\"3MP\"},{\"specName\":\"Type\",\"specValue\":\"Analog\"}]',1,2,'8915a7b6a4',NULL,NULL),(8,'Analog Camera 1MP 12V 0.5A',700.00,400.00,6,'[{\"specName\":\"Voltage\",\"specValue\":\"12V\"},{\"specName\":\"Wattage\",\"specValue\":\"6W\"},{\"specName\":\"Resolution\",\"specValue\":\"1MP\"},{\"specName\":\"Type\",\"specValue\":\"Analog\"}]',1,2,'5d7edfe1a1',NULL,NULL),(9,'IP Camera 5MP 24V 2A',700.00,500.00,6,'[{\"specName\":\"Voltage\",\"specValue\":\"24V\"},{\"specName\":\"Wattage\",\"specValue\":\"48W\"},{\"specName\":\"Resolution\",\"specValue\":\"5MP\"},{\"specName\":\"Type\",\"specValue\":\"IP\"}]',1,2,'32a9a0e067',NULL,NULL),(10,'IP Camera 4MP 12V 1A',500.00,400.00,3,'[{\"specName\":\"Voltage\",\"specValue\":\"12V\"},{\"specName\":\"Wattage\",\"specValue\":\"12W\"},{\"specName\":\"Resolution\",\"specValue\":\"4MP\"},{\"specName\":\"Type\",\"specValue\":\"IP\"}]',1,2,'434f818743',NULL,NULL),(11,'Coaxial Cable 4M',200.00,NULL,5,'[{\"specName\":\"Length\",\"specValue\":\"4M\"},{\"specName\":\"Type\",\"specValue\":\"Coaxial\"}]',1,4,'d8e6f8a2f0',NULL,NULL),(12,'Ethernet Cable 4M',300.00,200.00,5,'[{\"specName\":\"Length\",\"specValue\":\"4M\"},{\"specName\":\"Type\",\"specValue\":\"Ethernet\"}]',1,4,'81cd1aac82',NULL,NULL),(13,'Ethernet Cable 8M',400.00,300.00,65,'[{\"specName\":\"Length\",\"specValue\":\"8M\"},{\"specName\":\"Type\",\"specValue\":\"Ethernet\"}]',1,4,'44e47b0740',NULL,NULL),(14,'Coaxial Cable 8M',400.00,300.00,4,'[{\"specName\":\"Length\",\"specValue\":\"8M\"},{\"specName\":\"Type\",\"specValue\":\"Coaxial\"}]',1,4,'0f12816e1c',NULL,NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategories`
--

DROP TABLE IF EXISTS `subcategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subcategories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_id` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `specifications` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subcategories_category_id_foreign` (`category_id`),
  CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategories`
--

LOCK TABLES `subcategories` WRITE;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` VALUES (1,'Video Recorders','3ebd7d6597',1,'[\"Type\",\"Channels\",\"Resolution\"]',NULL,NULL),(2,'Security Cameras','759923d1c7',1,'[\"Type\",\"Voltage\",\"Wattage\",\"Resolution\"]',NULL,NULL),(3,'PDUs','eb9fb76f71',1,'[\"Voltage\",\"Wattage\"]',NULL,NULL),(4,'Cables','184aae9993',1,'[\"Length\",\"Type\"]',NULL,NULL),(5,'Surveillance Accessories','57e0f9914c',1,'[\"Type\"]',NULL,NULL);
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-04 19:57:44
