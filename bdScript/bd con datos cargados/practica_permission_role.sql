CREATE DATABASE  IF NOT EXISTS `practica` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `practica`;
-- MySQL dump 10.13  Distrib 5.5.55, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: practica
-- ------------------------------------------------------
-- Server version	5.5.55-0ubuntu0.14.04.1

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
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (4,2,1,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(5,2,5,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(6,2,4,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(7,2,6,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(9,2,7,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(10,2,11,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(12,2,9,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(13,2,13,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(14,2,18,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(15,2,10,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(16,2,14,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(18,2,8,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(19,2,12,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(25,1,10,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(26,1,14,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(27,1,6,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(31,1,18,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(36,1,11,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(37,1,1,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(39,1,13,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(40,1,5,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(42,1,12,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(43,1,4,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(44,1,15,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(45,1,17,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(46,1,16,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(47,1,7,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(48,1,9,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(49,1,8,'2017-03-12 15:01:46','2017-03-12 15:01:46'),(50,1,20,'2017-03-30 18:10:29','2017-03-30 18:10:29'),(51,1,21,'2017-03-30 18:10:29','2017-03-30 18:10:29'),(52,1,23,'2017-03-30 18:10:29','2017-03-30 18:10:29'),(53,1,22,'2017-03-30 18:10:29','2017-03-30 18:10:29'),(54,1,25,'2017-04-12 08:28:52','2017-04-12 08:28:52'),(55,1,27,'2017-04-12 08:28:52','2017-04-12 08:28:52'),(56,1,24,'2017-04-12 08:28:52','2017-04-12 08:28:52'),(57,1,26,'2017-04-12 08:28:52','2017-04-12 08:28:52'),(58,2,20,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(59,2,25,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(60,2,21,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(61,2,27,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(62,2,23,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(63,2,24,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(64,2,22,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(65,2,26,'2017-04-12 08:29:51','2017-04-12 08:29:51'),(66,4,28,'2017-04-21 18:05:56','2017-04-21 18:05:56'),(67,4,31,'2017-04-21 18:05:56','2017-04-21 18:05:56'),(68,4,29,'2017-04-21 18:05:56','2017-04-21 18:05:56'),(69,4,30,'2017-04-21 18:05:56','2017-04-21 18:05:56'),(70,4,32,'2017-04-28 14:26:04','2017-04-28 14:26:04'),(71,1,34,'2017-04-30 11:47:20','2017-04-30 11:47:20'),(72,1,36,'2017-04-30 11:47:20','2017-04-30 11:47:20'),(73,1,33,'2017-04-30 11:47:20','2017-04-30 11:47:20'),(74,1,35,'2017-04-30 11:47:20','2017-04-30 11:47:20'),(75,2,34,'2017-04-30 11:47:52','2017-04-30 11:47:52'),(76,2,36,'2017-04-30 11:47:52','2017-04-30 11:47:52'),(77,2,33,'2017-04-30 11:47:52','2017-04-30 11:47:52'),(78,2,35,'2017-04-30 11:47:52','2017-04-30 11:47:52'),(79,1,38,'2017-04-30 11:50:37','2017-04-30 11:50:37'),(80,1,40,'2017-04-30 11:50:37','2017-04-30 11:50:37'),(81,1,37,'2017-04-30 11:50:37','2017-04-30 11:50:37'),(82,1,39,'2017-04-30 11:50:37','2017-04-30 11:50:37'),(83,2,38,'2017-04-30 11:51:01','2017-04-30 11:51:01'),(84,2,40,'2017-04-30 11:51:01','2017-04-30 11:51:01'),(85,2,37,'2017-04-30 11:51:01','2017-04-30 11:51:01'),(86,2,39,'2017-04-30 11:51:01','2017-04-30 11:51:01'),(87,1,42,'2017-04-30 11:56:31','2017-04-30 11:56:31'),(88,1,44,'2017-04-30 11:56:31','2017-04-30 11:56:31'),(89,1,41,'2017-04-30 11:56:31','2017-04-30 11:56:31'),(90,1,43,'2017-04-30 11:56:31','2017-04-30 11:56:31'),(91,2,42,'2017-04-30 11:56:50','2017-04-30 11:56:50'),(92,2,44,'2017-04-30 11:56:50','2017-04-30 11:56:50'),(93,2,41,'2017-04-30 11:56:50','2017-04-30 11:56:50'),(94,2,43,'2017-04-30 11:56:50','2017-04-30 11:56:50'),(95,1,46,'2017-04-30 11:59:05','2017-04-30 11:59:05'),(96,1,48,'2017-04-30 11:59:05','2017-04-30 11:59:05'),(97,1,45,'2017-04-30 11:59:05','2017-04-30 11:59:05'),(98,1,47,'2017-04-30 11:59:05','2017-04-30 11:59:05'),(99,2,46,'2017-04-30 11:59:24','2017-04-30 11:59:24'),(100,2,48,'2017-04-30 11:59:24','2017-04-30 11:59:24'),(101,2,45,'2017-04-30 11:59:25','2017-04-30 11:59:25'),(102,2,47,'2017-04-30 11:59:25','2017-04-30 11:59:25'),(103,1,50,'2017-04-30 12:01:43','2017-04-30 12:01:43'),(104,1,52,'2017-04-30 12:01:43','2017-04-30 12:01:43'),(105,1,49,'2017-04-30 12:01:43','2017-04-30 12:01:43'),(106,1,51,'2017-04-30 12:01:43','2017-04-30 12:01:43'),(107,2,50,'2017-04-30 12:02:01','2017-04-30 12:02:01'),(108,2,52,'2017-04-30 12:02:01','2017-04-30 12:02:01'),(109,2,49,'2017-04-30 12:02:01','2017-04-30 12:02:01'),(110,2,51,'2017-04-30 12:02:02','2017-04-30 12:02:02'),(111,1,54,'2017-04-30 12:10:02','2017-04-30 12:10:02'),(112,1,56,'2017-04-30 12:10:03','2017-04-30 12:10:03'),(113,1,53,'2017-04-30 12:10:03','2017-04-30 12:10:03'),(114,1,55,'2017-04-30 12:10:03','2017-04-30 12:10:03'),(115,2,54,'2017-04-30 12:10:27','2017-04-30 12:10:27'),(116,2,56,'2017-04-30 12:10:27','2017-04-30 12:10:27'),(117,2,53,'2017-04-30 12:10:27','2017-04-30 12:10:27'),(118,2,55,'2017-04-30 12:10:27','2017-04-30 12:10:27'),(119,1,58,'2017-04-30 12:12:15','2017-04-30 12:12:15'),(120,1,60,'2017-04-30 12:12:15','2017-04-30 12:12:15'),(121,1,57,'2017-04-30 12:12:15','2017-04-30 12:12:15'),(122,1,59,'2017-04-30 12:12:15','2017-04-30 12:12:15'),(123,2,58,'2017-04-30 12:12:32','2017-04-30 12:12:32'),(124,2,60,'2017-04-30 12:12:32','2017-04-30 12:12:32'),(125,2,57,'2017-04-30 12:12:32','2017-04-30 12:12:32'),(126,2,59,'2017-04-30 12:12:32','2017-04-30 12:12:32'),(127,1,62,'2017-04-30 12:15:11','2017-04-30 12:15:11'),(128,1,64,'2017-04-30 12:15:11','2017-04-30 12:15:11'),(129,1,61,'2017-04-30 12:15:11','2017-04-30 12:15:11'),(130,1,63,'2017-04-30 12:15:11','2017-04-30 12:15:11'),(131,2,62,'2017-04-30 12:15:33','2017-04-30 12:15:33'),(132,2,64,'2017-04-30 12:15:33','2017-04-30 12:15:33'),(133,2,61,'2017-04-30 12:15:33','2017-04-30 12:15:33'),(134,2,63,'2017-04-30 12:15:33','2017-04-30 12:15:33'),(135,1,66,'2017-04-30 12:17:45','2017-04-30 12:17:45'),(136,1,68,'2017-04-30 12:17:45','2017-04-30 12:17:45'),(137,1,65,'2017-04-30 12:17:45','2017-04-30 12:17:45'),(138,1,67,'2017-04-30 12:17:45','2017-04-30 12:17:45'),(139,2,66,'2017-04-30 12:18:27','2017-04-30 12:18:27'),(140,2,68,'2017-04-30 12:18:27','2017-04-30 12:18:27'),(141,2,65,'2017-04-30 12:18:27','2017-04-30 12:18:27'),(142,2,67,'2017-04-30 12:18:27','2017-04-30 12:18:27'),(143,3,69,'2017-05-04 08:18:45','2017-05-04 08:18:45'),(144,3,71,'2017-05-04 08:18:45','2017-05-04 08:18:45'),(145,3,70,'2017-05-04 08:18:45','2017-05-04 08:18:45'),(146,3,32,'2017-05-04 11:34:37','2017-05-04 11:34:37'),(148,3,72,'2017-05-07 12:52:59','2017-05-07 12:52:59'),(149,3,73,'2017-05-07 12:52:59','2017-05-07 12:52:59'),(150,3,74,'2017-05-07 12:52:59','2017-05-07 12:52:59'),(151,3,75,'2017-05-07 12:57:06','2017-05-07 12:57:06'),(152,3,77,'2017-05-07 13:18:49','2017-05-07 13:18:49'),(153,3,79,'2017-05-07 13:18:50','2017-05-07 13:18:50'),(154,3,76,'2017-05-07 13:18:50','2017-05-07 13:18:50'),(155,3,78,'2017-05-07 13:18:50','2017-05-07 13:18:50'),(156,3,81,'2017-05-07 13:30:48','2017-05-07 13:30:48'),(157,3,83,'2017-05-07 13:30:48','2017-05-07 13:30:48'),(158,3,80,'2017-05-07 13:30:48','2017-05-07 13:30:48'),(159,3,82,'2017-05-07 13:30:48','2017-05-07 13:30:48'),(160,3,85,'2017-05-07 13:45:39','2017-05-07 13:45:39'),(161,3,87,'2017-05-07 13:45:39','2017-05-07 13:45:39'),(162,3,84,'2017-05-07 13:45:39','2017-05-07 13:45:39'),(163,3,86,'2017-05-07 13:45:39','2017-05-07 13:45:39'),(164,3,89,'2017-05-07 13:57:32','2017-05-07 13:57:32'),(165,3,91,'2017-05-07 13:57:32','2017-05-07 13:57:32'),(166,3,88,'2017-05-07 13:57:32','2017-05-07 13:57:32'),(167,3,90,'2017-05-07 13:57:32','2017-05-07 13:57:32'),(168,3,93,'2017-05-07 14:06:31','2017-05-07 14:06:31'),(169,3,95,'2017-05-07 14:06:31','2017-05-07 14:06:31'),(170,3,92,'2017-05-07 14:06:31','2017-05-07 14:06:31'),(171,3,94,'2017-05-07 14:06:31','2017-05-07 14:06:31');
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-30 10:12:05