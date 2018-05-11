-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: fusioninvoice
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `audit_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `audit_id` int(11) NOT NULL,
  `info` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `activities_object_index` (`audit_type`),
  KEY `activities_activity_index` (`activity`),
  KEY `activities_parent_id_index` (`audit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'2017-10-17 21:34:29','2017-10-17 21:34:29','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',3,NULL),(2,'2017-10-17 21:45:22','2017-10-17 21:45:22','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',3,NULL),(3,'2017-10-17 22:01:55','2017-10-17 22:01:55','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',3,NULL),(4,'2017-10-17 22:02:09','2017-10-17 22:02:09','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',3,NULL),(5,'2017-10-17 22:02:10','2017-10-17 22:02:10','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',3,NULL),(6,'2017-10-18 21:33:47','2017-10-18 21:33:47','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',4,NULL),(7,'2017-10-18 21:38:12','2017-10-18 21:38:12','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',4,NULL),(8,'2017-10-18 21:38:29','2017-10-18 21:38:29','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',4,NULL),(9,'2017-10-18 21:38:30','2017-10-18 21:38:30','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',4,NULL),(10,'2017-10-19 21:15:54','2017-10-19 21:15:54','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',5,NULL),(11,'2017-10-20 08:29:07','2017-10-20 08:29:07','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',5,NULL),(12,'2017-10-20 08:29:45','2017-10-20 08:29:45','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',5,NULL),(13,'2017-10-20 08:29:45','2017-10-20 08:29:45','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',5,NULL),(14,'2017-10-23 20:25:52','2017-10-23 20:25:52','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',6,NULL),(15,'2017-10-23 20:37:54','2017-10-23 20:37:54','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',6,NULL),(16,'2017-10-23 20:39:49','2017-10-23 20:39:49','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',6,NULL),(17,'2017-10-23 20:39:49','2017-10-23 20:39:49','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',6,NULL),(18,'2017-10-25 10:12:26','2017-10-25 10:12:26','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',7,NULL),(19,'2017-10-25 10:13:17','2017-10-25 10:13:17','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',7,NULL),(20,'2017-10-25 10:13:17','2017-10-25 10:13:17','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',7,NULL),(21,'2017-10-27 16:37:21','2017-10-27 16:37:21','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',9,NULL),(22,'2017-10-30 20:16:58','2017-10-30 20:16:58','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',9,NULL),(23,'2017-10-30 20:17:34','2017-10-30 20:17:34','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',9,NULL),(24,'2017-10-30 20:17:34','2017-10-30 20:17:34','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',9,NULL),(25,'2018-01-22 18:05:15','2018-01-22 18:05:15','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',11,NULL),(26,'2018-03-23 13:43:24','2018-03-23 13:43:24','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',13,NULL),(27,'2018-03-23 13:44:20','2018-03-23 13:44:20','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',13,NULL),(28,'2018-03-23 13:44:20','2018-03-23 13:44:20','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',13,NULL),(29,'2018-03-23 13:49:45','2018-03-23 13:49:45','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',13,NULL),(30,'2018-04-20 13:48:28','2018-04-20 13:48:28','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',14,NULL),(31,'2018-04-20 13:49:02','2018-04-20 13:49:02','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',14,NULL),(32,'2018-04-20 14:01:31','2018-04-20 14:01:31','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',14,NULL),(33,'2018-04-20 14:01:31','2018-04-20 14:01:31','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',14,NULL),(34,'2018-05-03 14:02:46','2018-05-03 14:02:46','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',16,NULL),(35,'2018-05-03 14:03:03','2018-05-03 14:03:03','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',16,NULL),(36,'2018-05-04 09:33:02','2018-05-04 09:33:02','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',15,NULL),(37,'2018-05-04 09:33:39','2018-05-04 09:33:39','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',15,NULL),(38,'2018-05-04 09:33:39','2018-05-04 09:33:39','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',15,NULL),(39,'2018-05-07 15:40:09','2018-05-07 15:40:09','FI\\Modules\\Quotes\\Models\\Quote','public.viewed',1,NULL),(40,'2018-05-07 15:46:23','2018-05-07 15:46:23','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',18,NULL),(41,'2018-05-07 15:47:28','2018-05-07 15:47:28','FI\\Modules\\Invoices\\Models\\Invoice','public.paid',18,NULL),(42,'2018-05-07 15:47:28','2018-05-07 15:47:28','FI\\Modules\\Invoices\\Models\\Invoice','public.viewed',18,NULL),(43,'2018-05-09 12:24:38','2018-05-09 12:24:38','FI\\Modules\\Quotes\\Models\\Quote','public.viewed',2,NULL),(44,'2018-05-09 12:24:44','2018-05-09 12:24:44','FI\\Modules\\Quotes\\Models\\Quote','public.approved',2,NULL),(45,'2018-05-09 12:24:45','2018-05-09 12:24:45','FI\\Modules\\Quotes\\Models\\Quote','public.viewed',2,NULL),(46,'2018-05-09 12:24:49','2018-05-09 12:24:49','FI\\Modules\\Quotes\\Models\\Quote','public.viewed',2,NULL);
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `addons`
--

DROP TABLE IF EXISTS `addons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `navigation_menu` longtext COLLATE utf8_unicode_ci,
  `system_menu` longtext COLLATE utf8_unicode_ci,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0',
  `navigation_reports` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `addons`
--

LOCK TABLES `addons` WRITE;
/*!40000 ALTER TABLE `addons` DISABLE KEYS */;
/*!40000 ALTER TABLE `addons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  `attachable_id` int(11) NOT NULL,
  `attachable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mimetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size` int(11) NOT NULL,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_visibility` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `currency_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quote_template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unique_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `allow_login` tinyint(1) NOT NULL DEFAULT '0',
  `language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_name_index` (`name`),
  KEY `clients_active_index` (`active`),
  KEY `clients_unique_name_index` (`unique_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'2017-10-16 14:05:50','2017-10-23 21:22:41','The Florida Design Group','218A East Eau Gallie Blvd., Suite #165','Indian Harbour Beach','Florida','32937','United States','(954) 745-9585','','(954) 864-2775','ed@fladg.com','http://www.thefloridadesigngroup.com','ALE29S5MiKAjAFbby5XMEbpdwExh7Rxa',1,'USD','default.blade.php','default.blade.php','The Florida Design Group',0,'en'),(2,'2018-01-20 21:21:24','2018-05-02 11:13:14','Sultan Khan','','','','','','(954) 522-5088','','','evoo.market@gmail.com','https://evoomkt.com','LgVaa60twhBu1tor4QrvMe97gn1jLkg6',1,'USD','default.blade.php','default.blade.php','Sultan Khan',0,'en'),(3,'2018-03-22 12:31:31','2018-03-22 12:33:30','Randall Koch','1401 S. Dixie Hwy. E. Suite 5E','Pompano Beach','FL ','33060','','9542455331','','','info@kravmagatraining.com','','4ezwNCp99tL3RIY2uBFDZ4bjJprXkAxO',1,'USD','default.blade.php','default.blade.php','Randall Koch',0,'en'),(5,'2018-05-08 17:06:30','2018-05-08 17:06:30','Gabriel Jose Carrera, Esq.','1600 W. State Road 84\r\nSuite B','Fort Lauderdale','Florida','33315','','954-533-7593 ','','','carrera@flalaw.us','','cBkn6UOGp8ni0V2KXddsrDkKsngg37CY',1,'USD','default.blade.php','default.blade.php','Gabriel Jose Carrera, Esq.',0,'en'),(6,'2018-05-09 13:36:18','2018-05-09 13:36:34','Brian Sherman','Sunshine Scientific Solutions\r\n4210 NE 15th Ave','Oakland Park','Florida','33334','','305-619-6970','','','brian@sunshinescientific.com','','VhXXNisC7sUiyLEiM85pT765oERBdYcJ',1,'USD','default.blade.php','default.blade.php','Brian Sherman',0,'en');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients_custom`
--

DROP TABLE IF EXISTS `clients_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients_custom` (
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients_custom`
--

LOCK TABLES `clients_custom` WRITE;
/*!40000 ALTER TABLE `clients_custom` DISABLE KEYS */;
INSERT INTO `clients_custom` VALUES (1,'2017-10-16 14:05:50','2017-10-16 14:05:50'),(2,'2018-01-20 21:21:24','2018-01-20 21:21:24'),(3,'2018-03-22 12:31:31','2018-03-22 12:31:31'),(5,'2018-05-08 17:06:30','2018-05-08 17:06:30'),(6,'2018-05-09 13:36:18','2018-05-09 13:36:18');
/*!40000 ALTER TABLE `clients_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_profiles`
--

DROP TABLE IF EXISTS `company_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_profiles`
--

LOCK TABLES `company_profiles` WRITE;
/*!40000 ALTER TABLE `company_profiles` DISABLE KEYS */;
INSERT INTO `company_profiles` VALUES (1,'2017-10-16 10:57:06','2018-04-24 15:03:30','Amber Orchard','8042 SW 21st Place','Davie','Florida','33324','USA','Toll Free: (800) 361-8914','','Local: (954) 247-4290','https://amberorchard.com');
/*!40000 ALTER TABLE `company_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currencies`
--

DROP TABLE IF EXISTS `currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `placement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `decimal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thousands` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `currencies_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currencies`
--

LOCK TABLES `currencies` WRITE;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` VALUES (1,'2017-10-16 13:56:28','2017-10-16 13:56:28','AUD','Australian Dollar','$','before','.',','),(2,'2017-10-16 13:56:28','2017-10-16 13:56:28','CAD','Canadian Dollar','$','before','.',','),(3,'2017-10-16 13:56:28','2017-10-16 13:56:28','EUR','Euro','€','before','.',','),(4,'2017-10-16 13:56:28','2017-10-16 13:56:28','GBP','Pound Sterling','£','before','.',','),(5,'2017-10-16 13:56:28','2017-10-16 13:56:28','USD','US Dollar','$','before','.',',');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custom_fields`
--

DROP TABLE IF EXISTS `custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tbl_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field_meta` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `custom_fields_table_name_index` (`tbl_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_fields`
--

LOCK TABLES `custom_fields` WRITE;
/*!40000 ALTER TABLE `custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_categories`
--

LOCK TABLES `expense_categories` WRITE;
/*!40000 ALTER TABLE `expense_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_vendors`
--

DROP TABLE IF EXISTS `expense_vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_vendors`
--

LOCK TABLES `expense_vendors` WRITE;
/*!40000 ALTER TABLE `expense_vendors` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expense_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `company_profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_category_id_index` (`category_id`),
  KEY `expenses_client_id_index` (`client_id`),
  KEY `expenses_vendor_id_index` (`vendor_id`),
  KEY `expenses_invoice_id_index` (`invoice_id`),
  KEY `expenses_company_profile_id_index` (`company_profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `next_id` int(11) NOT NULL DEFAULT '1',
  `left_pad` int(11) NOT NULL DEFAULT '0',
  `format` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reset_number` int(11) NOT NULL,
  `last_id` int(11) NOT NULL,
  `last_year` int(11) NOT NULL,
  `last_month` int(11) NOT NULL,
  `last_week` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'0000-00-00 00:00:00','2018-05-09 13:36:27','Invoice Default',6,0,'INV{YEAR}{MONTH}-{NUMBER}',2,5,2018,5,19),(2,'0000-00-00 00:00:00','2018-05-08 17:07:01','Quote Default',3,0,'QUO{NUMBER}',0,2,2018,5,19);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_amounts`
--

DROP TABLE IF EXISTS `invoice_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_id` int(11) NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `discount` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `paid` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `balance` decimal(20,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `invoice_amounts_invoice_id_index` (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_amounts`
--

LOCK TABLES `invoice_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_amounts` DISABLE KEYS */;
INSERT INTO `invoice_amounts` VALUES (3,'2017-10-16 20:54:20','2017-10-17 22:02:09',3,310.0000,0.0000,0.0000,310.0000,310.0000,0.0000),(4,'2017-10-17 22:20:47','2017-10-18 21:38:29',4,230.0000,0.0000,0.0000,230.0000,230.0000,0.0000),(5,'2017-10-19 13:25:57','2017-10-20 08:29:45',5,220.0000,0.0000,0.0000,220.0000,220.0000,0.0000),(6,'2017-10-20 16:37:29','2017-10-23 20:39:49',6,120.0000,0.0000,0.0000,120.0000,120.0000,0.0000),(7,'2017-10-23 21:17:31','2017-10-25 10:13:17',7,270.0000,0.0000,0.0000,270.0000,270.0000,0.0000),(9,'2017-10-24 18:47:51','2017-10-30 20:17:34',9,330.0000,0.0000,0.0000,330.0000,330.0000,0.0000),(11,'2018-01-20 21:21:24','2018-03-19 01:08:42',11,200.0000,0.0000,0.0000,200.0000,200.0000,0.0000),(13,'2018-03-22 12:33:04','2018-03-23 13:44:20',13,300.0000,0.0000,0.0000,300.0000,300.0000,0.0000),(14,'2018-04-20 12:33:05','2018-04-20 14:01:31',14,700.0000,0.0000,0.0000,700.0000,700.0000,0.0000),(15,'2018-04-24 15:05:42','2018-05-04 09:33:39',15,475.2500,0.0000,0.0000,475.2500,475.2500,0.0000),(16,'2018-05-01 10:59:55','2018-05-06 17:13:22',16,80.0000,0.0000,0.0000,80.0000,80.0000,0.0000),(17,'2018-05-06 17:12:21','2018-05-06 17:12:37',17,40.0000,0.0000,0.0000,40.0000,0.0000,40.0000),(18,'2018-05-07 15:45:45','2018-05-07 15:47:28',18,250.0000,0.0000,0.0000,250.0000,250.0000,0.0000),(19,'2018-05-09 12:24:44','2018-05-09 12:24:44',19,362.5000,0.0000,0.0000,362.5000,0.0000,362.5000),(20,'2018-05-09 13:36:27','2018-05-09 16:28:32',20,200.0000,0.0000,0.0000,200.0000,200.0000,0.0000);
/*!40000 ALTER TABLE `invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_item_amounts`
--

DROP TABLE IF EXISTS `invoice_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_item_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item_id` int(11) NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_1` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_2` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `invoice_item_amounts_item_id_index` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_item_amounts`
--

LOCK TABLES `invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `invoice_item_amounts` DISABLE KEYS */;
INSERT INTO `invoice_item_amounts` VALUES (1,'2017-10-16 20:55:02','2017-10-17 22:02:09',1,160.0000,0.0000,0.0000,0.0000,160.0000),(2,'2017-10-17 01:44:09','2017-10-17 22:02:09',2,100.0000,0.0000,0.0000,0.0000,100.0000),(3,'2017-10-17 14:37:01','2017-10-17 22:02:09',3,10.0000,0.0000,0.0000,0.0000,10.0000),(4,'2017-10-17 16:41:14','2017-10-17 22:02:09',4,40.0000,0.0000,0.0000,0.0000,40.0000),(5,'2017-10-17 22:47:04','2017-10-18 21:38:29',5,30.0000,0.0000,0.0000,0.0000,30.0000),(7,'2017-10-18 20:40:46','2017-10-18 21:38:29',7,200.0000,0.0000,0.0000,0.0000,200.0000),(8,'2017-10-19 13:26:27','2017-10-20 08:29:45',8,100.0000,0.0000,0.0000,0.0000,100.0000),(9,'2017-10-19 16:20:54','2017-10-20 08:29:45',9,120.0000,0.0000,0.0000,0.0000,120.0000),(11,'2017-10-22 16:25:23','2017-10-23 20:39:49',11,120.0000,0.0000,0.0000,0.0000,120.0000),(13,'2017-10-23 21:18:53','2017-10-25 10:13:17',13,100.0000,0.0000,0.0000,0.0000,100.0000),(14,'2017-10-23 21:18:53','2017-10-25 10:13:17',14,170.0000,0.0000,0.0000,0.0000,170.0000),(18,'2017-10-24 18:48:37','2017-10-30 20:17:34',18,320.0000,0.0000,0.0000,0.0000,320.0000),(20,'2017-10-27 11:53:32','2017-10-30 20:17:34',20,10.0000,0.0000,0.0000,0.0000,10.0000),(22,'2018-01-20 21:24:38','2018-03-19 01:08:42',22,160.0000,0.0000,0.0000,0.0000,160.0000),(23,'2018-01-20 21:24:39','2018-03-19 01:08:42',23,40.0000,0.0000,0.0000,0.0000,40.0000),(25,'2018-03-22 12:33:40','2018-03-23 13:44:20',25,300.0000,0.0000,0.0000,0.0000,300.0000),(26,'2018-04-20 12:33:05','2018-04-20 14:01:31',26,700.0000,0.0000,0.0000,0.0000,700.0000),(27,'2018-04-24 15:06:40','2018-05-04 09:33:39',27,11.2500,0.0000,0.0000,0.0000,11.2500),(28,'2018-04-24 16:47:50','2018-05-04 09:33:39',28,11.2500,0.0000,0.0000,0.0000,11.2500),(29,'2018-04-24 17:10:01','2018-05-04 09:33:39',29,11.2500,0.0000,0.0000,0.0000,11.2500),(30,'2018-04-26 16:27:21','2018-05-04 09:33:39',30,22.5000,0.0000,0.0000,0.0000,22.5000),(31,'2018-04-27 14:07:23','2018-05-04 09:33:39',31,59.0000,0.0000,0.0000,0.0000,59.0000),(33,'2018-05-01 10:59:55','2018-05-06 17:13:22',33,80.0000,0.0000,0.0000,0.0000,80.0000),(35,'2018-05-01 13:03:49','2018-05-04 09:33:39',35,360.0000,0.0000,0.0000,0.0000,360.0000),(36,'2018-05-06 17:12:21','2018-05-06 17:12:37',36,40.0000,0.0000,0.0000,0.0000,40.0000),(37,'2018-05-07 15:45:45','2018-05-07 15:47:28',37,250.0000,0.0000,0.0000,0.0000,250.0000),(38,'2018-05-09 12:24:44','2018-05-09 12:24:44',38,67.5000,0.0000,0.0000,0.0000,67.5000),(39,'2018-05-09 12:24:44','2018-05-09 12:24:44',39,45.0000,0.0000,0.0000,0.0000,45.0000),(40,'2018-05-09 12:24:44','2018-05-09 12:24:44',40,250.0000,0.0000,0.0000,0.0000,250.0000),(41,'2018-05-09 13:39:25','2018-05-09 16:28:32',41,200.0000,0.0000,0.0000,0.0000,200.0000);
/*!40000 ALTER TABLE `invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `tax_rate_2_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `display_order` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `invoice_items_invoice_id_index` (`invoice_id`),
  KEY `invoice_items_tax_rate_id_index` (`tax_rate_id`),
  KEY `invoice_items_display_order_index` (`display_order`),
  KEY `invoice_items_tax_rate_2_id_index` (`tax_rate_2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
INSERT INTO `invoice_items` VALUES (1,'2017-10-16 20:55:02','2017-10-17 16:41:14',3,0,0,'CLIFFSPOOLS','- clean up mobile site\n- clean up of all space',4.0000,1,40.0000),(2,'2017-10-17 01:44:09','2017-10-17 16:41:14',3,0,0,'JUNGLEERVS','- migration to new hosting',2.5000,2,40.0000),(3,'2017-10-17 14:37:01','2017-10-17 16:41:14',3,0,0,'SAGE','- edit of coupons',0.2500,3,40.0000),(4,'2017-10-17 16:41:14','2017-10-17 16:41:14',3,0,0,'SAGE','- edit of hours',1.0000,4,40.0000),(5,'2017-10-17 22:47:04','2017-10-18 20:41:58',4,0,0,'CLIFFSPOOLS','#56: Replace \"BBQ\'s & Aluminums\" on the Top Menu on New Site\n#55: Add New Category to the homepage\n#58: Add a \"Heat your Pool For Free\" on the homepage on the new site',0.7500,1,40.0000),(7,'2017-10-18 20:40:46','2017-10-18 20:41:58',4,0,0,'WESTVILLAGES','Website Changes - 10-18-17',5.0000,3,40.0000),(8,'2017-10-19 13:26:27','2017-10-19 16:20:54',5,0,0,'CAMPBELL','fansearch conversion to bing',2.5000,1,40.0000),(9,'2017-10-19 16:20:54','2017-10-19 16:20:54',5,0,0,'WESTVILLAGE','Website Changes - 10-18-17 v2',3.0000,2,40.0000),(11,'2017-10-22 16:25:23','2017-10-23 17:06:11',6,0,0,'WESTVILLAGES','menu cleanup\nmobile menu',3.0000,2,40.0000),(13,'2017-10-23 21:18:53','2017-10-24 18:29:33',7,0,0,'WAVEWIFI','#24 - Map - Locator',2.5000,1,40.0000),(14,'2017-10-23 21:18:53','2017-10-24 18:29:33',7,0,0,'MATTRESSMARKET','mobile site build out & site cleanup\n#28 - Launch Site\nFix missing google maps api key',4.2500,2,40.0000),(18,'2017-10-24 18:48:37','2017-10-27 16:42:07',9,0,0,'VERTICALCABLE','- misc bug fixes and changes to the website\n- fix image sizing and alignment on recommended, grid view, upsell, new products and recommended products\n- integrate mailgun\n- fix title linking issues\n- fix button alignment on grid view\n- fix image sizing and descriptions on single product page\n- new product page changes\n- clean up of grid and list view when viewing a category\n- customer support and phone calls',8.0000,1,40.0000),(20,'2017-10-27 11:53:32','2017-10-27 16:42:07',9,0,0,'WAXDIRECT','- fix out of stock product\n- fix shipping issues',0.2500,2,40.0000),(22,'2018-01-20 21:24:38','2018-01-23 22:06:09',11,0,0,'HOSTING','October - January',4.0000,1,40.0000),(23,'2018-01-20 21:24:38','2018-01-23 22:06:09',11,0,0,'HOSTING','February',1.0000,2,40.0000),(25,'2018-03-22 12:33:40','2018-03-22 12:35:05',13,0,0,'DEPOSIT','deposit for redesign of kravmagatraining.com',1.0000,1,300.0000),(26,'2018-04-20 12:33:05','2018-04-20 12:33:31',14,0,0,'DEPOSIT','completion of kravmagatraining.com',1.0000,1,700.0000),(27,'2018-04-24 15:06:40','2018-05-01 15:31:17',15,0,0,'MAINTENANCE','mattressmarket.org \n- remove erroneous JavaScript',0.2500,1,45.0000),(28,'2018-04-24 16:47:50','2018-05-01 15:31:17',15,0,0,'UPDATE','lensonrealty.com \n- update of plugins and license',0.2500,2,45.0000),(29,'2018-04-24 17:10:01','2018-05-01 15:31:17',15,0,0,'MAINTENANCE','verticalcable.com \n- fix of list view keeping list on refresh\n- fix of images on list view \n- fix of menu on product view page',0.2500,3,45.0000),(30,'2018-04-26 16:27:21','2018-05-01 15:31:17',15,0,0,'MAINTENANCE','veratics.com \n- fix back-end URL\n- fix heading on the front page motto and the TM\n- sidebar on case studies remove the text\n- front page where it says veratics\n- engage make like the logo',0.5000,4,45.0000),(31,'2018-04-27 14:07:23','2018-05-01 15:31:17',15,0,0,'PURCHASE','spacecoastpoolschool.com\n- Super Forms - Drag & Drop Form Builder\n- Super Forms - Calculator Add-on\n- Super Forms - PayPal Add-on',1.0000,5,59.0000),(33,'2018-05-01 10:59:55','2018-05-06 17:12:44',16,0,0,'HOSTING','March - May',2.0000,1,40.0000),(35,'2018-05-01 13:03:49','2018-05-01 15:31:17',15,0,0,'DEV','spacecoastpoolschool.com \n- create new form\n- promo code integration\n- class schedule for cleanup',8.0000,6,45.0000),(36,'2018-05-06 17:12:21','2018-05-06 17:12:37',17,0,0,'HOSTING','May',1.0000,1,40.0000),(37,'2018-05-07 15:45:45','2018-05-07 15:45:45',18,0,0,'DEV','mattressmarket.org\n- header and footer changes\n- new front page',1.0000,1,250.0000),(38,'2018-05-09 12:24:44','2018-05-09 12:24:44',19,0,0,'DEV','screamingthunder.com\n- Update plug-ins\n- Fix editor\n- Format articles archive\n- Cleanup header ',1.5000,1,45.0000),(39,'2018-05-09 12:24:44','2018-05-09 12:24:44',19,0,0,'DEV','attorneythatrides.com\n- add registration for with PayPal checkout for the 30-Hour Ironman LDR Challenge',1.0000,2,45.0000),(40,'2018-05-09 12:24:44','2018-05-09 12:24:44',19,0,0,'MAINTENANCE','monthly maintenance and upkeep, this will be billed monthly',1.0000,3,250.0000),(41,'2018-05-09 13:39:25','2018-05-09 16:27:18',20,0,0,'DEPOSIT','deposit based upon the development of sunshinescientific.com at a rate or $500.00',1.0000,1,200.0000);
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_tax_rates`
--

DROP TABLE IF EXISTS `invoice_tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_tax_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `include_item_tax` tinyint(1) NOT NULL DEFAULT '0',
  `tax_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `invoice_tax_rates_invoice_id_index` (`invoice_id`),
  KEY `invoice_tax_rates_tax_rate_id_index` (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_tax_rates`
--

LOCK TABLES `invoice_tax_rates` WRITE;
/*!40000 ALTER TABLE `invoice_tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_transactions`
--

DROP TABLE IF EXISTS `invoice_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice_transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_id` int(11) NOT NULL,
  `is_successful` tinyint(1) NOT NULL,
  `transaction_reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_transactions`
--

LOCK TABLES `invoice_transactions` WRITE;
/*!40000 ALTER TABLE `invoice_transactions` DISABLE KEYS */;
INSERT INTO `invoice_transactions` VALUES (1,'2017-10-17 22:02:09','2017-10-17 22:02:09',3,1,'ch_1BE6smETD2BK217JKwgPVTV5'),(2,'2017-10-18 21:38:29','2017-10-18 21:38:29',4,1,'ch_1BESzQETD2BK217JtqVFUPNu'),(3,'2017-10-20 08:29:44','2017-10-20 08:29:44',5,1,'ch_1BEzdDETD2BK217JFChD4A4V'),(4,'2017-10-23 20:39:49','2017-10-23 20:39:49',6,1,'ch_1BGGSOETD2BK217JSKfdqnJO'),(5,'2017-10-25 10:13:17','2017-10-25 10:13:17',7,1,'ch_1BGpd9ETD2BK217JBIptMWHH'),(6,'2017-10-30 20:17:34','2017-10-30 20:17:34',9,1,'ch_1BInRgETD2BK217Jj4wk35Cy'),(7,'2018-03-23 13:44:20','2018-03-23 13:44:20',13,1,'ch_1C8tw6ETD2BK217JlO3IWKV0'),(8,'2018-04-20 13:49:02','2018-04-20 13:49:02',14,0,'Your card was declined.'),(9,'2018-04-20 14:01:31','2018-04-20 14:01:31',14,1,'ch_1CJ3Y3ETD2BK217J4zy0eVcJ'),(10,'2018-05-04 09:33:39','2018-05-04 09:33:39',15,1,'ch_1CO42YETD2BK217J11qW0jyX'),(11,'2018-05-07 15:47:28','2018-05-07 15:47:28',18,1,'ch_1CPFIwETD2BK217JcnzGQAWW');
/*!40000 ALTER TABLE `invoice_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `invoice_status_id` int(11) NOT NULL,
  `due_at` date NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms` text COLLATE utf8_unicode_ci,
  `footer` text COLLATE utf8_unicode_ci,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `company_profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoices_user_id_index` (`user_id`),
  KEY `invoices_client_id_index` (`client_id`),
  KEY `invoices_invoice_group_id_index` (`group_id`),
  KEY `invoices_invoice_status_id_index` (`invoice_status_id`),
  KEY `invoices_company_profile_id_index` (`company_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (3,'2017-10-16 00:00:00','2017-10-17 22:02:09',1,1,1,3,'2017-11-15','INV201710-3','','','8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS','USD',1.0000000,'default.blade.php','',1,0.00,1),(4,'2017-10-17 00:00:00','2017-10-18 21:38:29',1,1,1,3,'2017-11-16','INV201710-4','','','wjsblobQM9P6GDTXuvt5IltHI0y9Todt','USD',1.0000000,'default.blade.php','',1,0.00,1),(5,'2017-10-19 00:00:00','2017-10-20 08:29:45',1,1,1,3,'2017-11-18','INV201710-5','Payment required upon receipt.','','JqYbVzKH1Q7qJ78JALQFvBr6Kl967hSX','USD',1.0000000,'default.blade.php','',1,0.00,1),(6,'2017-10-20 00:00:00','2017-10-23 20:39:49',1,1,1,3,'2017-10-23','INV201710-6','Payment required upon receipt.','','KwXd1MhZdnlCcQoLBBPSFmpXPX6Ngy9T','USD',1.0000000,'default.blade.php','',1,0.00,1),(7,'2017-10-23 00:00:00','2017-10-25 10:13:17',1,1,1,3,'2017-11-22','INV201710-7','Payment required upon receipt.','','noejxmpOdUWKRyiIsedeCtNYi4gF9dp8','USD',1.0000000,'default.blade.php','',1,0.00,1),(9,'2017-10-24 00:00:00','2017-10-30 20:17:34',1,1,1,3,'2017-11-23','INV201710-9','Payment required upon receipt.','','ygczkO8af4OFqos7cnQJrFVxSPXLkaXk','USD',1.0000000,'default.blade.php','',1,0.00,1),(11,'2018-01-20 00:00:00','2018-03-19 01:08:42',1,2,1,3,'2018-02-19','INV201801-1','Payment due upon receipt. Checks can be made to Jonathan Bradley and mailed to the address listed above.','','93MPoPzfwLmIT67CDKYHarWVVfxFiLgg','USD',1.0000000,'default.blade.php','',1,0.00,1),(13,'2018-03-22 00:00:00','2018-03-23 13:44:20',1,3,1,3,'2018-04-21','INV201803-2','Payment can be either via credit card or via check. Checks can be mailed to the address above','','n0aY0yWNeAd6lkhJrTtekQX6uZMvEkjP','USD',1.0000000,'default.blade.php','',1,0.00,1),(14,'2018-04-20 00:00:00','2018-04-20 14:01:31',1,3,1,3,'2018-05-20','INV201804-1','Payment can be either via credit card or via check. Checks can be mailed to the address above','','2wcAgdFkygvG9xdKaSCI2tBC9k25vho8','USD',1.0000000,'default.blade.php','',1,0.00,1),(15,'2018-04-24 00:00:00','2018-05-04 09:33:39',1,1,1,3,'2018-05-24','INV201804-2','Payment required upon receipt.','','RQHyfd4NJxAZOP3CuQyqJTn9BcddbKwg','USD',1.0000000,'default.blade.php','',1,0.00,1),(16,'2018-05-01 00:00:00','2018-05-06 17:13:22',1,2,1,3,'2018-05-31','INV201805-1','Payment due upon receipt. Checks can be made to Jonathan Bradley and mailed to the address listed above.','','cCj3dbt8hRBx4UzfRLOxiq9s82VTHLGs','USD',1.0000000,'default.blade.php','',1,0.00,1),(17,'2018-05-06 00:00:00','2018-05-06 17:12:37',1,2,1,1,'2018-06-05','INV201805-2','Payment due upon receipt. Checks can be made to Jonathan Bradley and mailed to the address listed above.','','vzXtVqpQstUsH9SOD6TaUJPSO0basYb2','USD',1.0000000,'default.blade.php','',0,0.00,1),(18,'2018-05-07 00:00:00','2018-05-07 15:47:28',1,1,1,3,'2018-06-06','INV201805-3','','','0xzuiJioAyMGKBCDkenQKsuN7b38W1oa','USD',1.0000000,'default.blade.php','',1,0.00,1),(19,'2018-05-09 00:00:00','2018-05-09 12:46:53',1,5,1,2,'2018-06-08','INV201805-4','','','HsZlYr1X5bso9XF6lMsmcgbPbcY4mm2S','USD',1.0000000,'default.blade.php','',0,0.00,1),(20,'2018-05-09 00:00:00','2018-05-09 16:28:32',1,6,1,3,'2018-06-08','INV201805-5','Payment required upon receipt. Payment can be made via cash or check. Checks are to be made out to Jonathan Bradley. Future payments can be made via debit/credit card.','For questions please contact <a href=\"mailto:info@amberorchard.com\">info@amberorchard.com</a>','j0ohiuqsdDWQOS8KSPQfrmZvv4GMBnB5','USD',1.0000000,'default.blade.php','',0,0.00,1);
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices_custom`
--

DROP TABLE IF EXISTS `invoices_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices_custom` (
  `invoice_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices_custom`
--

LOCK TABLES `invoices_custom` WRITE;
/*!40000 ALTER TABLE `invoices_custom` DISABLE KEYS */;
INSERT INTO `invoices_custom` VALUES (3,'2017-10-16 20:54:20','2017-10-16 20:54:20'),(4,'2017-10-17 22:20:47','2017-10-17 22:20:47'),(5,'2017-10-19 13:25:57','2017-10-19 13:25:57'),(6,'2017-10-20 16:37:29','2017-10-20 16:37:29'),(7,'2017-10-23 21:17:31','2017-10-23 21:17:31'),(9,'2017-10-24 18:47:51','2017-10-24 18:47:51'),(11,'2018-01-20 21:21:24','2018-01-20 21:21:24'),(13,'2018-03-22 12:33:04','2018-03-22 12:33:04'),(14,'2018-03-22 12:33:04','2018-03-22 12:33:04'),(15,'2018-04-24 15:05:42','2018-04-24 15:05:42'),(16,'2018-01-20 21:21:24','2018-01-20 21:21:24'),(17,'2018-01-20 21:21:24','2018-01-20 21:21:24'),(18,'2018-05-07 15:45:45','2018-05-07 15:45:45'),(19,'2018-05-09 12:24:44','2018-05-09 12:24:44'),(20,'2018-05-09 13:36:27','2018-05-09 13:36:27');
/*!40000 ALTER TABLE `invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_lookups`
--

DROP TABLE IF EXISTS `item_lookups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_lookups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_rate_id` int(11) NOT NULL DEFAULT '0',
  `tax_rate_2_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `item_lookups_tax_rate_id_index` (`tax_rate_id`),
  KEY `item_lookups_tax_rate_2_id_index` (`tax_rate_2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_lookups`
--

LOCK TABLES `item_lookups` WRITE;
/*!40000 ALTER TABLE `item_lookups` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_lookups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mail_queue`
--

DROP TABLE IF EXISTS `mail_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mail_queue` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mailable_id` int(11) NOT NULL,
  `mailable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bcc` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attach_pdf` tinyint(1) NOT NULL,
  `sent` tinyint(1) NOT NULL,
  `error` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mail_queue`
--

LOCK TABLES `mail_queue` WRITE;
/*!40000 ALTER TABLE `mail_queue` DISABLE KEYS */;
INSERT INTO `mail_queue` VALUES (1,'2017-10-17 01:45:30','2017-10-17 01:45:30',3,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"\"]','[\"iamjonbradley@gmail.com\"]','Invoice #INV201710-3','<p>To view your invoice from Jonathan Bradley for $260.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS\">https://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS</a></p>',1,0,NULL),(2,'2017-10-17 01:52:32','2017-10-17 01:52:32',3,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"\"]','[\"iamjonbradley@gmail.com\"]','Invoice #INV201710-3','<p>To view your invoice from Jonathan Bradley for $260.00, click the link below:</p>\n\n<p><a href=\"http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS\">http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS</a></p>',1,0,NULL),(3,'2017-10-17 01:53:15','2017-10-17 01:53:15',3,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"\"]','[\"iamjonbradley@gmail.com\"]','Invoice #INV201710-3','<p>To view your invoice from Jonathan Bradley for $260.00, click the link below:</p>\n\n<p><a href=\"http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS\">http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS</a></p>',1,1,NULL),(4,'2017-10-17 01:53:32','2017-10-17 01:53:32',3,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"\"]','[\"\"]','Invoice #INV201710-3','<p>To view your invoice from Jonathan Bradley for $260.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS\">https://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS</a></p>',1,1,NULL),(5,'2017-10-17 01:55:11','2017-10-17 01:55:11',3,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"iamjonbradley@gmail.com\"]','[\"\"]','[\"\"]','Invoice #INV201710-3','<p>To view your invoice from Jonathan Bradley for $260.00, click the link below:</p>\n\n<p><a href=\"http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS\">http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS</a></p>',1,0,NULL),(6,'2017-10-17 01:55:55','2017-10-17 01:55:56',3,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"iamjonbradley@gmail.com\"]','[\"\"]','[\"\"]','Invoice #INV201710-3','<p>To view your invoice from Jonathan Bradley for $260.00, click the link below:</p>\n\n<p><a href=\"http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS\">http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS</a></p>',1,1,NULL),(7,'2017-10-17 01:56:22','2017-10-17 01:56:22',3,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"\"]','[\"iamjonbradley@gmail.com\"]','Invoice #INV201710-3','<p>To view your invoice from Jonathan Bradley for $260.00, click the link below:</p>\n\n<p><a href=\"http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS\">http://billing.iamjonbradley.com/client_center/invoice/8TNm3Pt3p0Bz1fnx8K1B5wJzmHCdWAAS</a></p>',1,1,NULL),(8,'2017-10-18 20:42:30','2017-10-18 20:42:31',4,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"\"]','[\"\"]','Invoice #INV201710-4','<p>To view your invoice from Jonathan Bradley for $240.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/wjsblobQM9P6GDTXuvt5IltHI0y9Todt\">https://billing.iamjonbradley.com/client_center/invoice/wjsblobQM9P6GDTXuvt5IltHI0y9Todt</a></p>',1,1,NULL),(9,'2017-10-22 16:27:20','2017-10-22 16:27:21',6,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"\"]','[\"\"]','Invoice #INV201710-6','<p>To view your invoice from Jonathan Bradley for $220.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/KwXd1MhZdnlCcQoLBBPSFmpXPX6Ngy9T\">https://billing.iamjonbradley.com/client_center/invoice/KwXd1MhZdnlCcQoLBBPSFmpXPX6Ngy9T</a></p>',1,1,NULL),(10,'2017-10-27 16:33:10','2017-10-27 16:33:11',9,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"floridadg@gmail.com\"]','[\"\"]','Invoice #INV201710-9','<p>To view your invoice from Jonathan Bradley for $330.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/ygczkO8af4OFqos7cnQJrFVxSPXLkaXk\">https://billing.iamjonbradley.com/client_center/invoice/ygczkO8af4OFqos7cnQJrFVxSPXLkaXk</a></p>',1,1,NULL),(11,'2018-01-20 21:27:25','2018-01-20 21:27:25',11,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"evoo.market@gmail.com\"]','[\"\"]','[\"iamjonbradley@gmail.com\"]','Invoice #INV201801-1','<p>Attached is your invoice for November 2017 - Janurary 2018. Also on the invoice is what is due for the remainder of Q1 2018. BIlling will be handled in 4 month cycles. Please contact me if you have any questions concerning the invoice.</p>\n\n<p>You can view and pay online by clicking this link<a href=\"https://billing.iamjonbradley.com/client_center/invoice/93MPoPzfwLmIT67CDKYHarWVVfxFiLgg\">View Invoice</a></p>',1,1,NULL),(12,'2018-01-23 22:06:43','2018-01-23 22:06:43',11,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"evoo.market@gmail.com\"]','[\"\"]','[\"\"]','Invoice #INV201801-1','I have updated the invoice for just the month of February. This way its just the next month.\n\n<p>To view your invoice from Jonathan Bradley for $200.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/93MPoPzfwLmIT67CDKYHarWVVfxFiLgg\">https://billing.iamjonbradley.com/client_center/invoice/93MPoPzfwLmIT67CDKYHarWVVfxFiLgg</a></p>',1,1,NULL),(13,'2018-04-20 12:38:02','2018-04-20 12:38:03',14,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"info@kravmagatraining.com\"]','[\"\"]','[\"\"]','Invoice #INV201804-1','<p>To view your invoice from Jonathan Bradley for $700.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/2wcAgdFkygvG9xdKaSCI2tBC9k25vho8\">https://billing.iamjonbradley.com/client_center/invoice/2wcAgdFkygvG9xdKaSCI2tBC9k25vho8</a></p>',1,1,NULL),(14,'2018-05-01 11:00:22','2018-05-01 11:00:22',16,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"evoo.market@gmail.com\"]','[\"\"]','[\"\"]','Invoice #INV201805-1','<p>To view your invoice from Jonathan Bradley for $120.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/cCj3dbt8hRBx4UzfRLOxiq9s82VTHLGs\">https://billing.iamjonbradley.com/client_center/invoice/cCj3dbt8hRBx4UzfRLOxiq9s82VTHLGs</a></p>',1,1,NULL),(15,'2018-05-01 15:31:57','2018-05-01 15:31:57',15,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"floridadg@gmail.com\"]','[\"\"]','Invoice #INV201804-2','<p>To view your invoice from Jonathan Bradley for $475.25, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/RQHyfd4NJxAZOP3CuQyqJTn9BcddbKwg\">https://billing.iamjonbradley.com/client_center/invoice/RQHyfd4NJxAZOP3CuQyqJTn9BcddbKwg</a></p>',1,1,NULL),(16,'2018-05-02 10:31:32','2018-05-02 10:31:33',15,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.com\"]','[\"floridadg@gmail.com\"]','[\"\"]','Invoice #INV201804-2','<p>To view your invoice from Jonathan Bradley for $475.25, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/RQHyfd4NJxAZOP3CuQyqJTn9BcddbKwg\">https://billing.iamjonbradley.com/client_center/invoice/RQHyfd4NJxAZOP3CuQyqJTn9BcddbKwg</a></p>',1,1,NULL),(17,'2018-05-02 10:31:40','2018-05-02 10:31:40',16,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"evoo.market@gmail.com\"]','[\"\"]','[\"\"]','Invoice #INV201805-1','<p>To view your invoice from Jonathan Bradley for $120.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/cCj3dbt8hRBx4UzfRLOxiq9s82VTHLGs\">https://billing.iamjonbradley.com/client_center/invoice/cCj3dbt8hRBx4UzfRLOxiq9s82VTHLGs</a></p>',1,1,NULL),(18,'2018-05-07 15:39:29','2018-05-07 15:39:30',1,'FI\\Modules\\Quotes\\Models\\Quote','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.co\"]','[\"floridadg@gmail.com\"]','[\"\"]','Quote #QUO1','<p>To view your quote from Jonathan Bradley for $450.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/quote/DSGHt4CDZcOnt2r9gvEdqYV3dILuXedZ\">https://billing.iamjonbradley.com/client_center/quote/DSGHt4CDZcOnt2r9gvEdqYV3dILuXedZ</a></p>',1,1,NULL),(19,'2018-05-07 15:46:03','2018-05-07 15:46:03',18,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"ed@fladg.co\"]','[\"floridadg@gmail.com\"]','[\"\"]','Invoice #INV201805-3','<p>To view your invoice from Jonathan Bradley for $250.00, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/0xzuiJioAyMGKBCDkenQKsuN7b38W1oa\">https://billing.iamjonbradley.com/client_center/invoice/0xzuiJioAyMGKBCDkenQKsuN7b38W1oa</a></p>',1,1,NULL),(20,'2018-05-08 17:12:49','2018-05-08 17:12:50',2,'FI\\Modules\\Quotes\\Models\\Quote','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"carrera@flalaw.us\"]','[\"\"]','[\"\"]','Quote #QUO2','Hey Gabe,\n\n<p>Here is the quote I was telling you about.</p>\n\n<p>To view your quote from Jonathan Bradley for $362.50, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/quote/3C8qELRUJPRWRuNi889wLfm3ZpW1IqLE\">https://billing.iamjonbradley.com/client_center/quote/3C8qELRUJPRWRuNi889wLfm3ZpW1IqLE</a></p>',1,1,NULL),(21,'2018-05-09 12:24:44','2018-05-09 12:24:45',2,'FI\\Modules\\Quotes\\Models\\Quote','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"iamjonbradley@gmail.com\"]','[\"\"]','[\"\"]','Notification: Quote Status Change','<p><a href=\"https://billing.iamjonbradley.com/client_center/quote/3C8qELRUJPRWRuNi889wLfm3ZpW1IqLE\">Quote #QUO2</a> has been APPROVED.</p>',1,1,NULL),(22,'2018-05-09 12:46:53','2018-05-09 12:46:53',19,'FI\\Modules\\Invoices\\Models\\Invoice','{\"email\":\"iamjonbradley@gmail.com\",\"name\":\"Jonathan Bradley\"}','[\"carrera@flalaw.us\"]','[\"\"]','[\"\"]','Invoice #INV201805-4','<p>To view your invoice from Jonathan Bradley for $362.50, click the link below:</p>\n\n<p><a href=\"https://billing.iamjonbradley.com/client_center/invoice/HsZlYr1X5bso9XF6lMsmcgbPbcY4mm2S\">https://billing.iamjonbradley.com/client_center/invoice/HsZlYr1X5bso9XF6lMsmcgbPbcY4mm2S</a></p>',1,1,NULL);
/*!40000 ALTER TABLE `mail_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_04_11_020152_install',1),('2014_04_26_034100_update',1),('2014_04_28_052539_invoice_transactions',1),('2014_05_03_054406_title_setting',1),('2014_05_12_000250_activities',1),('2014_05_12_023615_user_update',1),('2014_06_14_040116_activities_update',1),('2014_06_16_015352_version_220',1),('2014_06_18_055133_user_custom_fields',1),('2014_06_27_233838_version_223',1),('2014_07_08_042425_currencies',1),('2014_08_02_005019_recurring_cleanup',1),('2014_08_03_035548_payment_methods',1),('2014_08_10_052026_quote_terms',1),('2014_08_10_214603_payment_receipt',1),('2014_09_08_024058_tax_rate_decimals',1),('2014_10_10_050434_templates',1),('2014_10_29_021905_fix_template_fields',1),('2014_12_23_022718_pdf_driver',1),('2015_02_18_041012_recurring_invoices',1),('2015_03_03_015011_decimal_amounts',1),('2015_03_14_221251_item_taxes',1),('2015_03_26_021135_quote_term_option',1),('2015_04_05_041737_currency',1),('2015_04_25_195050_add_client_list_identifier',1),('2015_05_04_025949_dashboard_total_setting',1),('2015_05_10_043924_version_266',1),('2015_06_07_062652_rename_invoice_groups',1),('2015_06_13_182739_dashboard_widget_settings',1),('2015_06_14_035737_api_keys',1),('2015_07_19_043642_currency_driver',1),('2015_07_20_022514_addresses',1),('2015_07_26_012508_profileimagedriver',1),('2015_07_27_035101_client_login',1),('2015_08_02_053301_invoice_quote_summary',1),('2015_08_11_032441_dashboard_settings',1),('2015_08_14_190749_default_templates',1),('2015_08_15_182237_amounts',1),('2015_08_15_193800_merchant_settings',1),('2015_09_04_053725_notes',1),('2015_09_14_013423_client_language',1),('2015_09_20_235940_addons',1),('2015_10_05_011820_viewed',1),('2015_10_12_022848_quote_status_change_settings',1),('2015_10_17_060408_mail_queue',1),('2015_11_07_052938_default_skin',1),('2015_12_29_065734_address_format_setting',1),('2015_12_29_071028_user_address',1),('2016_01_04_015003_results_per_page',1),('2016_01_04_015121_version_2016-1',1),('2016_01_04_061739_version_2016-2',1),('2016_01_05_033252_version_2016-3',1),('2016_01_07_043853_profile_image_setting',1),('2016_01_08_050627_version_2016-4',1),('2016_01_10_211014_mail_queue_body',1),('2016_01_10_220731_version_2016-5',1),('2016_01_31_012603_version_2016-6',1),('2016_02_08_033744_paypal_test_mode',1),('2016_02_12_040151_client_user_accounts',1),('2016_02_12_042242_version_2016-7',1),('2016_02_15_051826_version_2016-8',1),('2016_02_21_033244_fix_dates',1),('2016_02_21_044055_version_2016-9',1),('2016_03_14_021212_addon_reports',1),('2016_03_15_033138_version_2016-10',1),('2016_03_23_010154_discount',1),('2016_03_23_013411_discount_amounts',1),('2016_03_26_191950_version_2016-11',1),('2016_03_29_033334_expenses',1),('2016_04_02_200740_attachments',1),('2016_04_05_000426_stripe_requirements',1),('2016_04_18_022459_attachment_visibility',1),('2016_04_26_210754_version_2016-12',1),('2016_04_28_025617_version_2016-13',1),('2016_05_08_202446_enhance_groups',1),('2016_05_09_003007_groups_last_generated',1),('2016_05_10_045747_upcoming_payment_notice_email_body',1),('2016_05_11_045249_email_subject_settings',1),('2016_05_18_044934_write_email_templates',1),('2016_06_19_235132_fix_templates',1),('2016_06_20_000522_version_2016-14',1),('2016_07_09_040501_payment_button_text',1),('2016_08_14_185034_version_2016-15',1),('2016_08_22_015141_fix_expense_column',1),('2016_08_31_042637_version_2016-16',1),('2016_09_10_200830_amount_field_decimals',1),('2016_09_10_203542_decimal_settings',1),('2016_09_10_223620_item_lookup_tax_rates',1),('2016_09_19_051414_version_2016-17',1),('2016_11_29_053823_custom_date_range_reset',1),('2016_12_05_035454_version_2016-18',1),('2016_12_07_030044_version_2016-19',1),('2016_12_12_235934_default_custom_records',1),('2016_12_15_043022_version_2016-20',1),('2016_12_19_003158_company_profiles_table',1),('2016_12_19_003536_company_profiles_fks',1),('2016_12_19_003748_company_profiles_create',1),('2016_12_19_020559_company_profiles_del_cols',1),('2016_12_26_211622_recurring_invoice_tables',1),('2016_12_26_233503_migrate_recurring_invoices',1),('2017_01_02_005236_recurring_invoices_custom',1),('2017_01_15_030556_payment_without_balance',1),('2017_01_23_020903_version_2017-1',1),('2017_01_24_042624_upgrade_email_templates',1),('2017_02_13_051633_version_2017-2',1),('2017_02_23_033753_custom_fields_tbl_name',1),('2017_02_27_031528_recent_client_activity_widget',1),('2017_02_27_033017_version_2017-3',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  `notable_id` int(11) NOT NULL,
  `notable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `private` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
INSERT INTO `payment_methods` VALUES (1,'2017-10-16 13:56:28','2017-10-16 13:56:28','Cash'),(2,'2017-10-16 13:56:28','2017-10-16 13:56:28','Credit Card'),(3,'2017-10-16 13:56:28','2017-10-16 13:56:28','Online Payment'),(4,'2018-05-06 17:13:11','2018-05-06 17:13:11','Check');
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `paid_at` date NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(20,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `payments_invoice_id_index` (`invoice_id`),
  KEY `payments_payment_method_id_index` (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'2017-10-17 22:02:09','2017-10-17 22:02:09',3,3,'2017-10-17','',310.0000),(2,'2017-10-18 21:38:29','2017-10-18 21:38:29',4,3,'2017-10-18','',230.0000),(3,'2017-10-20 08:29:45','2017-10-20 08:29:45',5,3,'2017-10-20','',220.0000),(4,'2017-10-23 20:39:49','2017-10-23 20:39:49',6,3,'2017-10-23','',120.0000),(5,'2017-10-25 10:13:17','2017-10-25 10:13:17',7,3,'2017-10-25','',270.0000),(6,'2017-10-30 20:17:34','2017-10-30 20:17:34',9,3,'2017-10-30','',330.0000),(7,'2018-03-19 01:08:42','2018-03-19 01:08:42',11,1,'2018-03-19','',200.0000),(8,'2018-03-23 13:44:20','2018-03-23 13:44:20',13,3,'2018-03-23','',300.0000),(9,'2018-04-20 14:01:31','2018-04-20 14:01:31',14,3,'2018-04-20','',700.0000),(10,'2018-05-04 09:33:39','2018-05-04 09:33:39',15,3,'2018-05-04','',475.2500),(11,'2018-05-06 17:13:22','2018-05-06 17:13:22',16,4,'2018-05-06','',80.0000),(12,'2018-05-07 15:47:28','2018-05-07 15:47:28',18,3,'2018-05-07','',250.0000),(13,'2018-05-09 16:28:32','2018-05-09 16:28:32',20,4,'2018-05-09','',200.0000);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments_custom`
--

DROP TABLE IF EXISTS `payments_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments_custom` (
  `payment_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments_custom`
--

LOCK TABLES `payments_custom` WRITE;
/*!40000 ALTER TABLE `payments_custom` DISABLE KEYS */;
INSERT INTO `payments_custom` VALUES (1,'2017-10-17 22:02:09','2017-10-17 22:02:09'),(2,'2017-10-18 21:38:29','2017-10-18 21:38:29'),(3,'2017-10-20 08:29:45','2017-10-20 08:29:45'),(4,'2017-10-23 20:39:49','2017-10-23 20:39:49'),(5,'2017-10-25 10:13:17','2017-10-25 10:13:17'),(6,'2017-10-30 20:17:34','2017-10-30 20:17:34'),(7,'2018-03-19 01:08:42','2018-03-19 01:08:42'),(8,'2018-03-23 13:44:20','2018-03-23 13:44:20'),(9,'2018-04-20 14:01:31','2018-04-20 14:01:31'),(10,'2018-05-04 09:33:39','2018-05-04 09:33:39'),(11,'2018-05-06 17:13:22','2018-05-06 17:13:22'),(12,'2018-05-07 15:47:28','2018-05-07 15:47:28'),(13,'2018-05-09 16:28:32','2018-05-09 16:28:32');
/*!40000 ALTER TABLE `payments_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_amounts`
--

DROP TABLE IF EXISTS `quote_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `quote_id` int(11) NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `discount` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `quote_amounts_quote_id_index` (`quote_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_amounts`
--

LOCK TABLES `quote_amounts` WRITE;
/*!40000 ALTER TABLE `quote_amounts` DISABLE KEYS */;
INSERT INTO `quote_amounts` VALUES (1,'2018-05-07 15:38:32','2018-05-09 10:35:16',1,250.0000,0.0000,0.0000,250.0000),(2,'2018-05-08 17:07:01','2018-05-08 17:12:21',2,362.5000,0.0000,0.0000,362.5000);
/*!40000 ALTER TABLE `quote_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_item_amounts`
--

DROP TABLE IF EXISTS `quote_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_item_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item_id` int(11) NOT NULL,
  `subtotal` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_1` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax_2` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `tax` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `total` decimal(20,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `quote_item_amounts_item_id_index` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_item_amounts`
--

LOCK TABLES `quote_item_amounts` WRITE;
/*!40000 ALTER TABLE `quote_item_amounts` DISABLE KEYS */;
INSERT INTO `quote_item_amounts` VALUES (1,'2018-05-07 15:38:59','2018-05-09 10:35:16',1,250.0000,0.0000,0.0000,0.0000,250.0000),(2,'2018-05-08 17:09:07','2018-05-08 17:12:21',2,67.5000,0.0000,0.0000,0.0000,67.5000),(3,'2018-05-08 17:11:10','2018-05-08 17:12:21',3,45.0000,0.0000,0.0000,0.0000,45.0000),(4,'2018-05-08 17:12:21','2018-05-08 17:12:21',4,250.0000,0.0000,0.0000,0.0000,250.0000);
/*!40000 ALTER TABLE `quote_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_items`
--

DROP TABLE IF EXISTS `quote_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `quote_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `tax_rate_2_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `display_order` int(11) NOT NULL,
  `price` decimal(20,4) NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `quote_items_quote_id_index` (`quote_id`),
  KEY `quote_items_display_order_index` (`display_order`),
  KEY `quote_items_tax_rate_id_index` (`tax_rate_id`),
  KEY `quote_items_tax_rate_2_id_index` (`tax_rate_2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_items`
--

LOCK TABLES `quote_items` WRITE;
/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
INSERT INTO `quote_items` VALUES (1,'2018-05-07 15:38:59','2018-05-09 10:35:16',1,0,0,'DEV','mattressmarket.org\n- header and footer changes\n- new front page',1.0000,1,250.0000),(2,'2018-05-08 17:09:07','2018-05-08 17:12:21',2,0,0,'DEV','screamingthunder.com\n- Update plug-ins\n- Fix editor\n- Format articles archive\n- Cleanup header ',1.5000,1,45.0000),(3,'2018-05-08 17:11:10','2018-05-08 17:12:21',2,0,0,'DEV','attorneythatrides.com\n- add registration for with PayPal checkout for the 30-Hour Ironman LDR Challenge',1.0000,2,45.0000),(4,'2018-05-08 17:12:21','2018-05-08 17:12:21',2,0,0,'MAINTENANCE','monthly maintenance and upkeep, this will be billed monthly',1.0000,3,250.0000);
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote_tax_rates`
--

DROP TABLE IF EXISTS `quote_tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote_tax_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `quote_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL,
  `include_item_tax` tinyint(1) NOT NULL DEFAULT '0',
  `tax_total` decimal(15,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `quote_tax_rates_quote_id_index` (`quote_id`),
  KEY `quote_tax_rates_tax_rate_id_index` (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote_tax_rates`
--

LOCK TABLES `quote_tax_rates` WRITE;
/*!40000 ALTER TABLE `quote_tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes`
--

DROP TABLE IF EXISTS `quotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `quote_status_id` int(11) NOT NULL,
  `expires_at` date NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `footer` text COLLATE utf8_unicode_ci,
  `url_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `exchange_rate` decimal(10,7) NOT NULL DEFAULT '1.0000000',
  `terms` text COLLATE utf8_unicode_ci,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `summary` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewed` tinyint(1) NOT NULL DEFAULT '0',
  `discount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `company_profile_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quotes_user_id_index` (`user_id`),
  KEY `quotes_client_id_index` (`client_id`),
  KEY `quotes_invoice_group_id_index` (`group_id`),
  KEY `quotes_number_index` (`number`),
  KEY `quotes_company_profile_id_index` (`company_profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes`
--

LOCK TABLES `quotes` WRITE;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
INSERT INTO `quotes` VALUES (1,'2018-05-07 00:00:00','2018-05-09 10:35:16',18,1,1,2,3,'2018-05-22','QUO1','','DSGHt4CDZcOnt2r9gvEdqYV3dILuXedZ','USD',1.0000000,'','default.blade.php','',1,0.00,1),(2,'2018-05-08 00:00:00','2018-05-09 12:24:44',19,1,5,2,3,'2018-05-23','QUO2','','3C8qELRUJPRWRuNi889wLfm3ZpW1IqLE','USD',1.0000000,'','default.blade.php','',1,0.00,1);
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotes_custom`
--

DROP TABLE IF EXISTS `quotes_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotes_custom` (
  `quote_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`quote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotes_custom`
--

LOCK TABLES `quotes_custom` WRITE;
/*!40000 ALTER TABLE `quotes_custom` DISABLE KEYS */;
INSERT INTO `quotes_custom` VALUES (1,'2018-05-07 15:38:32','2018-05-07 15:38:32'),(2,'2018-05-08 17:07:01','2018-05-08 17:07:01');
/*!40000 ALTER TABLE `quotes_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_amounts`
--

DROP TABLE IF EXISTS `recurring_invoice_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoice_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recurring_invoice_id` int(11) NOT NULL,
  `subtotal` decimal(20,4) NOT NULL,
  `discount` decimal(20,4) NOT NULL,
  `tax` decimal(20,4) NOT NULL,
  `total` decimal(20,4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoice_amounts_recurring_invoice_id_index` (`recurring_invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_amounts`
--

LOCK TABLES `recurring_invoice_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_item_amounts`
--

DROP TABLE IF EXISTS `recurring_invoice_item_amounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoice_item_amounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `item_id` int(11) NOT NULL,
  `subtotal` decimal(20,4) NOT NULL,
  `tax_1` decimal(20,4) NOT NULL,
  `tax_2` decimal(20,4) NOT NULL,
  `tax` decimal(20,4) NOT NULL,
  `total` decimal(20,4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoice_item_amounts_item_id_index` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_item_amounts`
--

LOCK TABLES `recurring_invoice_item_amounts` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_item_amounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoice_items`
--

DROP TABLE IF EXISTS `recurring_invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoice_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recurring_invoice_id` int(11) NOT NULL,
  `tax_rate_id` int(11) NOT NULL DEFAULT '0',
  `tax_rate_2_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `quantity` decimal(20,4) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT '0',
  `price` decimal(20,4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoice_items_recurring_invoice_id_index` (`recurring_invoice_id`),
  KEY `recurring_invoice_items_tax_rate_id_index` (`tax_rate_id`),
  KEY `recurring_invoice_items_tax_rate_2_id_index` (`tax_rate_2_id`),
  KEY `recurring_invoice_items_display_order_index` (`display_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoice_items`
--

LOCK TABLES `recurring_invoice_items` WRITE;
/*!40000 ALTER TABLE `recurring_invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoices`
--

DROP TABLE IF EXISTS `recurring_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `company_profile_id` int(11) NOT NULL,
  `terms` text COLLATE utf8_unicode_ci,
  `footer` text COLLATE utf8_unicode_ci,
  `currency_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` decimal(10,7) NOT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` decimal(15,2) NOT NULL,
  `recurring_frequency` int(11) NOT NULL,
  `recurring_period` int(11) NOT NULL,
  `next_date` date NOT NULL,
  `stop_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `recurring_invoices_user_id_index` (`user_id`),
  KEY `recurring_invoices_client_id_index` (`client_id`),
  KEY `recurring_invoices_company_profile_id_index` (`company_profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoices`
--

LOCK TABLES `recurring_invoices` WRITE;
/*!40000 ALTER TABLE `recurring_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoices_custom`
--

DROP TABLE IF EXISTS `recurring_invoices_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoices_custom` (
  `recurring_invoice_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`recurring_invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoices_custom`
--

LOCK TABLES `recurring_invoices_custom` WRITE;
/*!40000 ALTER TABLE `recurring_invoices_custom` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoices_custom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recurring_invoices_old`
--

DROP TABLE IF EXISTS `recurring_invoices_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recurring_invoices_old` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `invoice_id` int(11) NOT NULL,
  `recurring_frequency` int(11) NOT NULL,
  `recurring_period` int(11) NOT NULL,
  `generate_at` date NOT NULL DEFAULT '0000-00-00',
  `stop_at` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recurring_invoices_old`
--

LOCK TABLES `recurring_invoices_old` WRITE;
/*!40000 ALTER TABLE `recurring_invoices_old` DISABLE KEYS */;
/*!40000 ALTER TABLE `recurring_invoices_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `setting_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_setting_key_index` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'2017-10-16 13:56:28','2017-10-16 13:56:28','language','en'),(2,'2017-10-16 13:56:28','2017-10-23 21:25:20','dateFormat','Y-m-d'),(3,'2017-10-16 13:56:28','2017-10-16 13:56:28','invoiceTemplate','default.blade.php'),(4,'2017-10-16 13:56:28','2017-10-16 13:56:28','invoicesDueAfter','30'),(5,'2017-10-16 13:56:28','2017-10-16 13:56:28','invoiceGroup','1'),(6,'2017-10-16 13:56:28','2017-10-16 13:56:28','quoteTemplate','default.blade.php'),(7,'2017-10-16 13:56:28','2017-10-16 13:56:28','quotesExpireAfter','15'),(8,'2017-10-16 13:56:28','2017-10-16 13:56:28','quoteGroup','2'),(9,'2017-10-16 13:56:28','2017-10-16 13:56:28','automaticEmailOnRecur','1'),(10,'2017-10-16 13:56:28','2017-10-16 13:56:28','markInvoicesSentPdf','0'),(11,'2017-10-16 13:56:28','2017-10-16 13:56:28','markQuotesSentPdf','0'),(12,'2017-10-16 13:56:28','2017-10-16 11:01:51','timezone','America/New_York'),(13,'2017-10-16 13:56:28','2017-10-16 13:56:28','attachPdf','1'),(14,'2017-10-16 13:56:28','2017-10-16 11:00:21','headerTitleText','Billing'),(15,'2017-10-16 13:56:28','2017-10-16 13:56:28','overdueInvoiceEmailBody','<p>This is a reminder to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is overdue. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>'),(16,'2017-10-16 13:56:28','2017-10-16 13:56:28','invoiceEmailBody','<p>To view your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>'),(17,'2017-10-16 13:56:28','2017-10-16 13:56:28','quoteEmailBody','<p>To view your quote from {{ $quote->user->name }} for {{ $quote->amount->formatted_total }}, click the link below:</p>\r\n\r\n<p><a href=\"{{ $quote->public_url }}\">{{ $quote->public_url }}</a></p>'),(18,'2017-10-16 13:56:28','2017-10-16 13:56:28','convertQuoteWhenApproved','1'),(19,'2017-10-16 13:56:28','2017-10-16 13:56:28','paperOrientation','portrait'),(20,'2017-10-16 13:56:28','2017-10-16 13:56:28','paperSize','letter'),(21,'2017-10-16 13:56:28','2017-10-16 13:56:30','version','2017-3'),(22,'2017-10-16 13:56:28','2017-10-16 13:56:28','baseCurrency','USD'),(23,'2017-10-16 13:56:28','2017-10-16 13:56:28','exchangeRateMode','automatic'),(24,'2017-10-16 13:56:28','2017-10-16 13:56:28','paymentReceiptBody','<p>Thank you! Your payment of {{ $payment->formatted_amount }} has been applied to Invoice #{{ $payment->invoice->number }}.</p>'),(25,'2017-10-16 13:56:28','2017-10-16 13:56:28','pdfDriver','domPDF'),(26,'2017-10-16 13:56:29','2017-10-16 13:56:29','convertQuoteTerms','quote'),(27,'2017-10-16 13:56:29','2017-10-16 13:56:29','displayClientUniqueName','0'),(28,'2017-10-16 13:56:29','2017-10-16 13:56:29','dashboardTotals','year_to_date'),(29,'2017-10-16 13:56:29','2017-10-16 13:56:29','widgetEnabledInvoiceSummary','1'),(30,'2017-10-16 13:56:29','2017-10-16 13:56:29','widgetInvoiceSummaryDashboardTotals','year_to_date'),(31,'2017-10-16 13:56:29','2018-05-08 17:04:28','widgetEnabledQuoteSummary','1'),(32,'2017-10-16 13:56:29','2017-10-16 13:56:29','widgetQuoteSummaryDashboardTotals','year_to_date'),(33,'2017-10-16 13:56:29','2017-10-16 13:56:29','currencyConversionDriver','YQLCurrencyConverter'),(34,'2017-10-16 13:56:29','2017-10-16 13:56:29','profileImageDriver','Gravatar'),(35,'2017-10-16 13:56:29','2017-10-16 13:56:29','widgetDisplayOrderInvoiceSummary','1'),(36,'2017-10-16 13:56:29','2017-10-16 13:56:29','widgetColumnWidthInvoiceSummary','6'),(37,'2017-10-16 13:56:29','2017-10-16 13:56:29','widgetDisplayOrderQuoteSummary','2'),(38,'2017-10-16 13:56:29','2017-10-16 13:56:29','widgetColumnWidthQuoteSummary','6'),(39,'2017-10-16 13:56:29','2017-10-23 21:25:38','merchant','{\"PayPalExpress\":{\"enabled\":\"0\",\"testMode\":\"0\",\"username\":\"\",\"password\":\"\",\"signature\":\"\",\"paymentButtonText\":\"Pay with PayPal\"},\"Stripe\":{\"enabled\":\"1\",\"secretKey\":\"sk_live_bgdWSlLX2e7WtYIP5fWfVgci\",\"publishableKey\":\"pk_live_LNUuNnCjpUnFonajwvxTIe9Z\",\"requireBillingName\":\"2\",\"requireBillingAddress\":\"0\",\"requireBillingCity\":\"0\",\"requireBillingState\":\"0\",\"requireBillingZip\":\"2\",\"paymentButtonText\":\"Pay with Credit Card\"},\"Mollie\":{\"enabled\":\"0\",\"apiKey\":\"\",\"paymentButtonText\":\"Pay with Mollie\"}}'),(40,'2017-10-16 13:56:29','2017-10-16 13:56:29','quoteApprovedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been APPROVED.</p>'),(41,'2017-10-16 13:56:29','2017-10-16 13:56:29','quoteRejectedEmailBody','<p><a href=\"{{ $quote->public_url }}\">Quote #{{ $quote->number }}</a> has been REJECTED.</p>'),(42,'2017-10-16 13:56:29','2018-05-09 13:37:42','skin','skin-green.min.css'),(43,'2017-10-16 13:56:29','2017-10-16 13:56:29','addressFormat','{{ address }}\r\n{{ city }}, {{ state }} {{ postal_code }}'),(44,'2017-10-16 13:56:29','2017-10-16 13:56:29','resultsPerPage','15'),(45,'2017-10-16 13:56:29','2017-10-23 21:24:54','displayProfileImage','0'),(46,'2017-10-16 13:56:30','2017-10-16 13:56:30','upcomingPaymentNoticeEmailBody','<p>This is a notice to let you know your invoice from {{ $invoice->user->name }} for {{ $invoice->amount->formatted_total }} is due on {{ $invoice->formatted_due_at }}. Click the link below to view the invoice:</p>\r\n\r\n<p><a href=\"{{ $invoice->public_url }}\">{{ $invoice->public_url }}</a></p>'),(47,'2017-10-16 13:56:30','2017-10-16 13:56:30','quoteEmailSubject','Quote #{{ $quote->number }}'),(48,'2017-10-16 13:56:30','2017-10-16 13:56:30','invoiceEmailSubject','Invoice #{{ $invoice->number }}'),(49,'2017-10-16 13:56:30','2017-10-16 13:56:30','overdueInvoiceEmailSubject','Overdue Invoice Reminder: Invoice #{{ $invoice->number }}'),(50,'2017-10-16 13:56:30','2017-10-16 13:56:30','upcomingPaymentNoticeEmailSubject','Upcoming Payment Due Notice: Invoice #{{ $invoice->number }}'),(51,'2017-10-16 13:56:30','2017-10-16 13:56:30','paymentReceiptEmailSubject','Payment Receipt for Invoice #{{ $payment->invoice->number }}'),(52,'2017-10-16 13:56:30','2017-10-16 13:56:30','amountDecimals','2'),(53,'2017-10-16 13:56:30','2018-05-09 13:37:42','roundTaxDecimals','2'),(54,'2017-10-16 13:56:30','2017-10-16 13:56:30','allowPaymentsWithoutBalance','0'),(55,'2017-10-16 13:56:30','2017-10-16 14:02:10','widgetEnabledClientActivity','1'),(56,'2017-10-16 13:56:30','2017-10-16 13:56:30','widgetDisplayOrderClientActivity','3'),(57,'2017-10-16 13:56:30','2017-10-18 20:54:23','widgetColumnWidthClientActivity','6'),(58,'2017-10-16 10:57:06','2017-10-16 10:57:06','defaultCompanyProfile','1'),(59,'2017-10-16 10:59:28','2017-10-16 10:59:28','widgetInvoiceSummaryDashboardTotalsFromDate',''),(60,'2017-10-16 10:59:28','2017-10-16 10:59:28','widgetInvoiceSummaryDashboardTotalsToDate',''),(61,'2017-10-16 10:59:28','2017-10-16 10:59:28','widgetQuoteSummaryDashboardTotalsFromDate',''),(62,'2017-10-16 10:59:28','2017-10-16 10:59:28','widgetQuoteSummaryDashboardTotalsToDate',''),(63,'2017-10-16 10:59:28','2018-05-09 13:44:41','invoiceTerms','Payment required upon receipt. Payment can be made via cash/debit/credit/check. Checks are to be made out to Jonathan Bradley.'),(64,'2017-10-16 10:59:28','2018-05-09 13:44:41','invoiceFooter','For questions please contact <a href=\"mailto:info@amberorchard.com\">info@amberorchard.com</a>'),(65,'2017-10-16 10:59:28','2017-10-16 10:59:28','automaticEmailPaymentReceipts','0'),(66,'2017-10-16 10:59:28','2017-10-16 14:06:36','onlinePaymentMethod','3'),(67,'2017-10-16 10:59:28','2017-10-16 10:59:28','quoteTerms',''),(68,'2017-10-16 10:59:28','2017-10-16 10:59:28','quoteFooter',''),(69,'2017-10-16 10:59:28','2017-10-16 10:59:28','itemTaxRate','0'),(70,'2017-10-16 10:59:28','2017-10-16 10:59:28','itemTax2Rate','0'),(71,'2017-10-16 10:59:28','2017-10-17 01:54:57','mailDriver','sendmail'),(72,'2017-10-16 10:59:28','2017-10-16 10:59:28','mailHost',''),(73,'2017-10-16 10:59:28','2017-10-16 10:59:28','mailPort',''),(74,'2017-10-16 10:59:28','2017-10-16 10:59:28','mailUsername',''),(75,'2017-10-16 10:59:28','2017-10-16 10:59:28','mailEncryption','0'),(76,'2017-10-16 10:59:28','2017-10-17 01:55:41','mailSendmail','/usr/sbin/sendmail -t'),(77,'2017-10-16 10:59:28','2017-10-16 10:59:28','mailDefaultCc',''),(78,'2017-10-16 10:59:28','2017-10-16 10:59:28','mailDefaultBcc',''),(79,'2017-10-16 10:59:28','2017-10-16 10:59:28','overdueInvoiceReminderFrequency',''),(80,'2017-10-16 10:59:28','2017-10-16 10:59:28','upcomingPaymentNoticeFrequency',''),(81,'2017-10-16 10:59:28','2017-10-16 10:59:28','pdfBinaryPath',''),(84,'2018-04-24 15:02:31','2018-04-24 15:02:31','logo','logo.png');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tax_rates`
--

DROP TABLE IF EXISTS `tax_rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tax_rates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `percent` decimal(5,3) NOT NULL DEFAULT '0.000',
  `is_compound` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tax_rates`
--

LOCK TABLES `tax_rates` WRITE;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_public_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_secret_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `users_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2017-10-16 10:57:06','2018-05-09 13:37:03','info@amberorchard.com','$2y$10$eEF1N/bDqgiz8egFQOyBNuRtVuhF1U.47esS5rcBvsj7Asl55FTJq','Jonathan Bradley','WXzUm0uFmQFVGonMc18eMO2TBg3qpMPzjsB98gG0J5hOXTp2x0HcHUCzuQxq','t7oJNkBQQYtYIbo5TBlcb5TZgdmr4wOX','fYVnXj7y2d78zcKDqVJUXXE0lw1HlhHn',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_custom`
--

DROP TABLE IF EXISTS `users_custom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_custom` (
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_custom`
--

LOCK TABLES `users_custom` WRITE;
/*!40000 ALTER TABLE `users_custom` DISABLE KEYS */;
INSERT INTO `users_custom` VALUES (1,'2017-10-16 10:57:06','2017-10-16 10:57:06');
/*!40000 ALTER TABLE `users_custom` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-11  3:56:55
