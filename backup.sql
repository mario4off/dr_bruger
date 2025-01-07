-- MySQL dump 10.13  Distrib 9.0.1, for macos14.7 (x86_64)
--
-- Host: 127.0.0.1    Database: dr_burger
-- ------------------------------------------------------
-- Server version	9.0.1

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
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(250) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Hamburguesas'),(2,'Combos'),(3,'Complementos'),(4,'Bebidas'),(5,'Postres'),(6,'Salsas');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredients` (
  `ingredient_id` int NOT NULL AUTO_INCREMENT,
  `ingredient_name` varchar(250) DEFAULT NULL,
  `ingredient_allergen` varchar(250) DEFAULT NULL,
  `ingredient_photo` varchar(250) DEFAULT NULL,
  `extra_base_price` decimal(4,2) DEFAULT NULL,
  `ingredient_stock` int DEFAULT NULL,
  PRIMARY KEY (`ingredient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Pan de hamburguesa','Gluten',NULL,NULL,NULL),(2,'Hamburguesa de ternera',NULL,NULL,1.50,NULL),(3,'Lechuga',NULL,NULL,NULL,NULL),(4,'Tomate pera',NULL,NULL,NULL,NULL),(5,'Cheddar','Lácteos',NULL,0.60,NULL),(6,'Pepinillo',NULL,NULL,0.00,NULL),(7,'Salsa DR BURGER ORIGINALS',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `action` varchar(250) NOT NULL,
  `altered_table` varchar(250) NOT NULL,
  `object_id` int DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=255 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'INSERT','ORDERS',102,'2025-01-05 18:59:05',7),(2,'INSERT','ORDERS',103,'2025-01-05 18:59:17',7),(3,'SELECT','ORDERS',NULL,'2025-01-05 20:27:14',7),(4,'SELECT','ORDERS',NULL,'2025-01-05 20:27:19',7),(5,'DELETE','ORDERS',103,'2025-01-05 20:27:29',7),(6,'SELECT','ORDERS',NULL,'2025-01-05 20:27:31',7),(7,'UPDATE','ORDERS',63,'2025-01-05 20:27:52',7),(8,'SELECT','ORDERS',NULL,'2025-01-05 20:27:59',7),(9,'SELECT','ORDERS',NULL,'2025-01-05 20:34:19',7),(10,'SELECT','ORDERS',NULL,'2025-01-05 20:36:11',7),(11,'SELECT','ORDERS',NULL,'2025-01-05 20:36:37',7),(12,'SELECT','ORDERS',NULL,'2025-01-05 20:37:34',7),(13,'SELECT','ORDERS',NULL,'2025-01-05 20:37:39',7),(14,'SELECT','ORDERS',NULL,'2025-01-05 20:37:43',7),(15,'SELECT','ORDERS',NULL,'2025-01-05 20:40:38',7),(16,'SELECT','ORDERS',NULL,'2025-01-05 20:41:19',7),(17,'SELECT','ORDERS',NULL,'2025-01-05 20:41:30',7),(18,'SELECT','ORDERS',NULL,'2025-01-05 20:42:06',7),(19,'SELECT','ORDERS',NULL,'2025-01-05 20:42:11',7),(20,'SELECT','ORDERS',NULL,'2025-01-05 20:42:16',7),(21,'SELECT','ORDERS',NULL,'2025-01-05 20:42:20',7),(22,'SELECT','ORDERS',NULL,'2025-01-05 20:42:32',7),(23,'SELECT','ORDERS',NULL,'2025-01-06 00:47:30',7),(24,'SELECT','USERS',NULL,'2025-01-06 00:50:45',7),(25,'SELECT','USERS',NULL,'2025-01-06 00:50:51',7),(26,'SELECT','USERS',NULL,'2025-01-06 00:51:28',7),(27,'SELECT','USERS',NULL,'2025-01-06 00:52:31',7),(28,'SELECT','USERS',NULL,'2025-01-06 00:52:39',7),(29,'SELECT','USERS',NULL,'2025-01-06 00:53:25',7),(30,'SELECT','ORDERS',NULL,'2025-01-06 00:53:27',7),(31,'SELECT','USERS',NULL,'2025-01-06 00:56:47',7),(32,'SELECT','USERS',NULL,'2025-01-06 00:56:57',7),(33,'SELECT','USERS',NULL,'2025-01-06 01:03:12',7),(34,'SELECT','USERS',NULL,'2025-01-06 01:13:22',7),(35,'SELECT','USERS',NULL,'2025-01-06 01:14:13',7),(36,'SELECT','USERS',NULL,'2025-01-06 01:14:19',7),(37,'SELECT','USERS',NULL,'2025-01-06 01:15:20',7),(38,'SELECT','USERS',NULL,'2025-01-06 01:15:22',7),(39,'SELECT','USERS',NULL,'2025-01-06 01:15:41',7),(40,'SELECT','USERS',NULL,'2025-01-06 01:20:13',7),(41,'SELECT','USERS',NULL,'2025-01-06 01:23:09',7),(42,'SELECT','USERS',NULL,'2025-01-06 01:24:09',7),(43,'SELECT','USERS',NULL,'2025-01-06 01:24:24',7),(44,'SELECT','ORDERS',NULL,'2025-01-06 01:24:25',7),(45,'SELECT','USERS',NULL,'2025-01-06 01:24:34',7),(46,'SELECT','USERS',NULL,'2025-01-06 01:34:51',7),(47,'SELECT','USERS',NULL,'2025-01-06 01:34:52',7),(48,'SELECT','USERS',NULL,'2025-01-06 01:34:53',7),(49,'SELECT','ORDERS',NULL,'2025-01-06 01:34:57',7),(50,'SELECT','USERS',NULL,'2025-01-06 01:34:58',7),(51,'SELECT','USERS',NULL,'2025-01-06 01:35:25',7),(52,'SELECT','USERS',NULL,'2025-01-06 01:36:18',7),(53,'SELECT','USERS',NULL,'2025-01-06 01:36:19',7),(54,'DELETE','USERS',1,'2025-01-06 01:44:41',7),(55,'SELECT','USERS',NULL,'2025-01-06 01:44:47',7),(56,'SELECT','USERS',NULL,'2025-01-06 01:44:49',7),(57,'SELECT','ORDERS',NULL,'2025-01-06 01:45:23',7),(58,'SELECT','USERS',NULL,'2025-01-06 01:45:34',7),(59,'DELETE','USERS',13,'2025-01-06 01:45:44',7),(60,'SELECT','ORDERS',NULL,'2025-01-06 01:45:47',7),(61,'SELECT','USERS',NULL,'2025-01-06 01:47:17',7),(62,'SELECT','USERS',NULL,'2025-01-06 01:50:11',7),(63,'SELECT','USERS',NULL,'2025-01-06 01:57:14',7),(64,'SELECT','USERS',NULL,'2025-01-06 01:57:15',7),(65,'SELECT','USERS',NULL,'2025-01-06 01:58:43',7),(66,'SELECT','USERS',NULL,'2025-01-06 01:58:45',7),(67,'SELECT','USERS',NULL,'2025-01-06 02:00:30',7),(68,'SELECT','USERS',NULL,'2025-01-06 02:00:50',7),(69,'SELECT','USERS',NULL,'2025-01-06 02:00:54',7),(70,'SELECT','ORDERS',NULL,'2025-01-06 02:00:58',7),(71,'SELECT','USERS',NULL,'2025-01-06 02:00:59',7),(72,'SELECT','USERS',NULL,'2025-01-06 02:01:47',7),(73,'SELECT','USERS',NULL,'2025-01-06 02:01:57',7),(74,'SELECT','USERS',NULL,'2025-01-06 02:02:06',7),(75,'SELECT','USERS',NULL,'2025-01-06 02:02:08',7),(76,'SELECT','USERS',NULL,'2025-01-06 02:02:14',7),(77,'SELECT','USERS',NULL,'2025-01-06 02:03:28',7),(78,'SELECT','USERS',NULL,'2025-01-06 02:03:30',7),(79,'SELECT','ORDERS',NULL,'2025-01-06 02:03:33',7),(80,'SELECT','USERS',NULL,'2025-01-06 02:03:37',7),(81,'SELECT','USERS',NULL,'2025-01-06 02:04:32',7),(82,'SELECT','USERS',NULL,'2025-01-06 02:04:39',7),(83,'SELECT','USERS',NULL,'2025-01-06 02:06:15',7),(84,'SELECT','USERS',NULL,'2025-01-06 02:06:22',7),(85,'SELECT','USERS',NULL,'2025-01-06 02:06:30',7),(86,'SELECT','USERS',NULL,'2025-01-06 02:09:01',7),(87,'SELECT','USERS',NULL,'2025-01-06 02:09:02',7),(88,'SELECT','USERS',NULL,'2025-01-06 02:09:03',7),(89,'SELECT','USERS',NULL,'2025-01-06 02:09:35',7),(90,'SELECT','ORDERS',NULL,'2025-01-06 02:09:37',7),(91,'SELECT','USERS',NULL,'2025-01-06 02:09:40',7),(92,'SELECT','USERS',NULL,'2025-01-06 02:10:39',7),(93,'SELECT','USERS',NULL,'2025-01-06 02:10:46',7),(94,'SELECT','USERS',NULL,'2025-01-06 02:10:53',7),(95,'SELECT','ORDERS',NULL,'2025-01-06 02:11:12',7),(96,'SELECT','USERS',NULL,'2025-01-06 02:11:14',7),(97,'SELECT','ORDERS',NULL,'2025-01-06 02:11:16',7),(98,'SELECT','USERS',NULL,'2025-01-06 02:11:25',7),(99,'SELECT','USERS',NULL,'2025-01-06 02:13:15',7),(100,'SELECT','USERS',NULL,'2025-01-06 02:27:59',7),(101,'SELECT','USERS',NULL,'2025-01-06 02:29:19',7),(102,'SELECT','USERS',NULL,'2025-01-06 02:31:10',7),(103,'SELECT','USERS',NULL,'2025-01-06 02:35:29',7),(104,'SELECT','USERS',NULL,'2025-01-06 02:36:34',7),(105,'SELECT','USERS',NULL,'2025-01-06 02:37:48',7),(106,'SELECT','USERS',NULL,'2025-01-06 02:39:05',7),(107,'SELECT','USERS',NULL,'2025-01-06 02:44:12',7),(108,'SELECT','USERS',NULL,'2025-01-06 02:52:35',7),(109,'UPDATE','USERS',NULL,'2025-01-06 02:53:04',7),(110,'SELECT','ORDERS',NULL,'2025-01-06 02:53:56',7),(111,'SELECT','USERS',NULL,'2025-01-06 02:54:55',7),(112,'UPDATE','USERS',NULL,'2025-01-06 02:55:01',7),(113,'SELECT','ORDERS',NULL,'2025-01-06 02:55:33',7),(114,'SELECT','USERS',NULL,'2025-01-06 02:55:39',7),(115,'SELECT','ORDERS',NULL,'2025-01-06 02:55:40',7),(116,'SELECT','USERS',NULL,'2025-01-06 02:55:45',7),(117,'UPDATE','USERS',NULL,'2025-01-06 02:55:51',7),(118,'SELECT','ORDERS',NULL,'2025-01-06 02:55:53',7),(119,'SELECT','USERS',NULL,'2025-01-06 02:56:32',7),(120,'SELECT','USERS',NULL,'2025-01-06 02:56:42',7),(121,'UPDATE','USERS',NULL,'2025-01-06 02:56:48',7),(122,'SELECT','ORDERS',NULL,'2025-01-06 02:56:53',7),(123,'SELECT','ORDERS',NULL,'2025-01-06 02:56:56',7),(124,'SELECT','USERS',NULL,'2025-01-06 02:56:59',7),(125,'SELECT','ORDERS',NULL,'2025-01-06 02:57:00',7),(126,'SELECT','USERS',NULL,'2025-01-06 02:57:02',7),(127,'UPDATE','USERS',NULL,'2025-01-06 02:57:12',7),(128,'SELECT','ORDERS',NULL,'2025-01-06 02:57:14',7),(129,'SELECT','USERS',NULL,'2025-01-06 02:58:35',7),(130,'SELECT','USERS',NULL,'2025-01-06 02:58:35',7),(131,'SELECT','USERS',NULL,'2025-01-06 02:58:38',7),(132,'SELECT','ORDERS',NULL,'2025-01-06 02:58:39',7),(133,'SELECT','USERS',NULL,'2025-01-06 02:58:41',7),(134,'SELECT','USERS',NULL,'2025-01-06 03:04:20',7),(135,'SELECT','USERS',NULL,'2025-01-06 03:04:28',7),(136,'SELECT','USERS',NULL,'2025-01-06 03:07:34',7),(137,'SELECT','USERS',NULL,'2025-01-06 03:09:43',7),(138,'UPDATE','USERS',12,'2025-01-06 03:09:50',7),(139,'SELECT','ORDERS',NULL,'2025-01-06 03:09:54',7),(140,'SELECT','USERS',NULL,'2025-01-06 03:11:56',7),(141,'SELECT','USERS',NULL,'2025-01-06 03:13:15',7),(142,'UPDATE','USERS',12,'2025-01-06 03:13:20',7),(143,'UPDATE','USERS',12,'2025-01-06 03:14:46',7),(144,'SELECT','USERS',NULL,'2025-01-06 03:15:10',7),(145,'UPDATE','USERS',12,'2025-01-06 03:15:17',7),(146,'SELECT','USERS',NULL,'2025-01-06 03:16:33',7),(147,'SELECT','USERS',NULL,'2025-01-06 03:17:16',7),(148,'SELECT','USERS',NULL,'2025-01-06 03:17:33',7),(149,'SELECT','ORDERS',NULL,'2025-01-06 03:17:46',7),(150,'SELECT','ORDERS',NULL,'2025-01-06 03:17:49',7),(151,'SELECT','USERS',NULL,'2025-01-06 03:18:10',7),(152,'SELECT','ORDERS',NULL,'2025-01-06 03:18:12',7),(153,'SELECT','USERS',NULL,'2025-01-06 03:18:47',7),(154,'SELECT','ORDERS',NULL,'2025-01-06 03:18:55',7),(155,'SELECT','USERS',NULL,'2025-01-06 03:19:06',7),(156,'SELECT','ORDERS',NULL,'2025-01-06 03:19:06',7),(157,'SELECT','USERS',NULL,'2025-01-06 03:30:10',7),(158,'SELECT','ORDERS',NULL,'2025-01-06 03:30:11',7),(159,'SELECT','USERS',NULL,'2025-01-06 14:39:11',7),(160,'SELECT','USERS',NULL,'2025-01-06 14:49:38',7),(161,'SELECT','USERS',NULL,'2025-01-06 14:52:36',7),(162,'SELECT','USERS',NULL,'2025-01-06 14:58:23',7),(163,'SELECT','USERS',NULL,'2025-01-06 14:59:17',7),(164,'SELECT','USERS',NULL,'2025-01-06 15:09:24',7),(165,'SELECT','USERS',NULL,'2025-01-06 15:09:25',7),(166,'SELECT','USERS',NULL,'2025-01-06 15:13:00',7),(167,'SELECT','USERS',NULL,'2025-01-06 15:13:05',7),(168,'SELECT','USERS',NULL,'2025-01-06 15:13:08',7),(169,'SELECT','USERS',NULL,'2025-01-06 15:13:16',7),(170,'SELECT','USERS',NULL,'2025-01-06 15:13:19',7),(171,'SELECT','USERS',NULL,'2025-01-06 15:13:21',7),(172,'SELECT','USERS',NULL,'2025-01-06 15:14:06',7),(173,'SELECT','USERS',NULL,'2025-01-06 15:14:18',7),(174,'SELECT','USERS',NULL,'2025-01-06 15:17:44',7),(175,'SELECT','USERS',NULL,'2025-01-06 15:17:58',7),(176,'SELECT','USERS',NULL,'2025-01-06 15:18:00',7),(177,'SELECT','USERS',NULL,'2025-01-06 15:18:33',7),(178,'SELECT','USERS',NULL,'2025-01-06 15:20:12',7),(179,'SELECT','USERS',NULL,'2025-01-06 15:20:51',7),(180,'SELECT','USERS',NULL,'2025-01-06 15:21:00',7),(181,'SELECT','USERS',NULL,'2025-01-06 15:21:13',7),(182,'SELECT','USERS',NULL,'2025-01-06 15:21:25',7),(183,'SELECT','USERS',NULL,'2025-01-06 15:22:21',7),(184,'SELECT','USERS',NULL,'2025-01-06 15:23:08',7),(185,'SELECT','USERS',NULL,'2025-01-06 15:23:13',7),(186,'SELECT','USERS',NULL,'2025-01-06 15:23:15',7),(187,'SELECT','USERS',NULL,'2025-01-06 15:23:43',7),(188,'SELECT','USERS',NULL,'2025-01-06 15:23:51',7),(189,'SELECT','USERS',NULL,'2025-01-06 15:24:28',7),(190,'SELECT','USERS',NULL,'2025-01-06 15:46:06',7),(191,'SELECT','USERS',NULL,'2025-01-06 15:47:34',7),(192,'SELECT','USERS',NULL,'2025-01-06 15:48:00',7),(193,'SELECT','USERS',NULL,'2025-01-06 16:05:21',7),(194,'SELECT','USERS',NULL,'2025-01-06 16:06:27',7),(195,'SELECT','USERS',NULL,'2025-01-06 16:06:28',7),(196,'SELECT','USERS',NULL,'2025-01-06 16:06:30',7),(197,'SELECT','USERS',NULL,'2025-01-06 16:06:33',7),(198,'SELECT','USERS',NULL,'2025-01-06 16:06:34',7),(199,'SELECT','USERS',NULL,'2025-01-06 16:06:45',7),(200,'SELECT','USERS',NULL,'2025-01-06 16:06:53',7),(201,'SELECT','USERS',NULL,'2025-01-06 16:06:58',7),(202,'SELECT','USERS',NULL,'2025-01-06 16:12:26',7),(203,'SELECT','USERS',NULL,'2025-01-06 16:12:34',7),(204,'SELECT','USERS',NULL,'2025-01-06 16:12:40',7),(205,'UPDATE','USERS',12,'2025-01-06 16:12:51',7),(206,'SELECT','USERS',NULL,'2025-01-06 16:13:41',7),(207,'INSERT','USERS',0,'2025-01-06 16:13:46',7),(208,'SELECT','ORDERS',NULL,'2025-01-06 16:13:59',7),(209,'SELECT','USERS',NULL,'2025-01-06 16:15:15',7),(210,'INSERT','USERS',15,'2025-01-06 16:15:27',7),(211,'SELECT','USERS',NULL,'2025-01-06 16:15:29',7),(212,'SELECT','USERS',NULL,'2025-01-06 16:17:54',7),(213,'SELECT','USERS',NULL,'2025-01-06 16:17:57',7),(214,'INSERT','USERS',16,'2025-01-06 16:18:04',7),(215,'SELECT','USERS',NULL,'2025-01-06 16:18:06',7),(216,'INSERT','USERS',17,'2025-01-06 16:18:13',7),(217,'SELECT','USERS',NULL,'2025-01-06 16:18:14',7),(218,'SELECT','USERS',NULL,'2025-01-06 16:19:59',7),(219,'SELECT','USERS',NULL,'2025-01-06 16:20:07',7),(220,'SELECT','USERS',NULL,'2025-01-06 16:20:18',7),(221,'SELECT','USERS',NULL,'2025-01-06 16:20:31',7),(222,'SELECT','USERS',NULL,'2025-01-06 16:20:59',7),(223,'SELECT','USERS',NULL,'2025-01-06 16:21:03',7),(224,'SELECT','USERS',NULL,'2025-01-06 16:30:10',7),(225,'SELECT','USERS',NULL,'2025-01-06 16:30:15',7),(226,'SELECT','USERS',NULL,'2025-01-06 16:30:59',7),(227,'SELECT','ORDERS',NULL,'2025-01-06 16:31:00',7),(228,'SELECT','USERS',NULL,'2025-01-06 16:31:02',7),(229,'SELECT','USERS',NULL,'2025-01-06 16:31:41',7),(230,'SELECT','ORDERS',NULL,'2025-01-06 16:31:42',7),(231,'SELECT','USERS',NULL,'2025-01-06 16:31:49',7),(232,'SELECT','USERS',NULL,'2025-01-06 16:34:11',7),(233,'SELECT','USERS',NULL,'2025-01-06 16:34:12',7),(234,'SELECT','USERS',NULL,'2025-01-06 16:34:14',7),(235,'SELECT','ORDERS',NULL,'2025-01-06 16:34:18',7),(236,'SELECT','USERS',NULL,'2025-01-06 16:34:19',7),(237,'SELECT','USERS',NULL,'2025-01-06 16:34:51',7),(238,'INSERT','USERS',18,'2025-01-06 16:35:05',7),(239,'SELECT','USERS',NULL,'2025-01-06 16:35:07',7),(240,'DELETE','USERS',12,'2025-01-06 16:35:17',7),(241,'SELECT','USERS',NULL,'2025-01-06 16:37:14',7),(242,'SELECT','USERS',NULL,'2025-01-06 16:38:18',7),(243,'SELECT','USERS',NULL,'2025-01-06 16:38:48',7),(244,'SELECT','ORDERS',NULL,'2025-01-06 16:39:55',7),(245,'SELECT','ORDERS',NULL,'2025-01-06 19:29:39',7),(246,'SELECT','ORDERS',NULL,'2025-01-06 19:29:44',7),(247,'SELECT','ORDERS',NULL,'2025-01-06 19:29:47',7),(248,'SELECT','ORDERS',NULL,'2025-01-06 19:44:59',7),(249,'SELECT','USERS',NULL,'2025-01-06 19:45:07',7),(250,'UPDATE','USERS',18,'2025-01-06 19:45:20',7),(251,'SELECT','ORDERS',NULL,'2025-01-06 22:44:56',7),(252,'SELECT','USERS',NULL,'2025-01-06 22:44:57',7),(253,'UPDATE','USERS',18,'2025-01-06 22:45:11',7),(254,'UPDATE','USERS',18,'2025-01-06 22:45:30',7);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `line_id` int NOT NULL AUTO_INCREMENT,
  `line_price` decimal(5,2) NOT NULL,
  `quantity` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `promotion_id` int DEFAULT NULL,
  PRIMARY KEY (`line_id`),
  KEY `product_id` (`product_id`),
  KEY `promotion_id` (`promotion_id`),
  KEY `order_details_ibfk_1` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `order_details_ibfk_3` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`promotion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (43,12.00,1,29,7,NULL),(44,144.00,12,30,1,NULL),(45,24.00,2,30,7,NULL),(46,56.00,4,30,4,NULL),(47,15.50,1,30,12,NULL),(48,6.00,1,30,15,NULL),(49,0.50,1,30,17,NULL),(50,0.50,1,30,16,NULL),(51,9.00,2,30,2,NULL),(52,5.00,2,30,3,NULL),(53,5.20,2,30,13,NULL),(54,4.00,2,30,14,NULL),(58,12.00,2,40,1,3),(59,15.50,1,44,12,NULL),(60,6.00,1,44,15,NULL),(61,4.50,1,45,2,NULL),(62,2.00,1,45,14,NULL),(66,12.00,1,48,9,NULL),(67,9.50,1,48,8,NULL),(68,12.00,1,108,1,NULL),(69,14.00,1,108,4,NULL);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `promotion_id` int DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(250) NOT NULL,
  `total_amount` decimal(5,2) NOT NULL,
  `card_number` int DEFAULT NULL,
  `payment_method` varchar(250) NOT NULL,
  `delivery_cost` decimal(5,2) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL,
  `allergies_comments` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `promotion_id` (`promotion_id`),
  KEY `orders_ibfk_1` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`promotion_id`) REFERENCES `promotions` (`promotion_id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (29,7,NULL,'2025-01-02 19:49:53','Pendiente',12.00,1234,'Tarjeta',3.50,3.26,NULL),(30,7,NULL,'2025-01-02 22:36:11','Pendiente',269.70,NULL,'Efectivo',0.00,56.64,NULL),(32,7,NULL,'2025-01-03 15:42:45','Pendiente',24.00,NULL,'PayPal',3.50,5.78,NULL),(33,7,NULL,'2025-01-03 15:43:19','Pendiente',24.00,NULL,'PayPal',3.50,5.78,NULL),(34,7,NULL,'2025-01-03 15:45:13','Pendiente',24.00,NULL,'PayPal',3.50,5.78,NULL),(35,7,NULL,'2025-01-03 15:46:34','Pendiente',24.00,NULL,'PayPal',3.50,5.78,NULL),(36,7,NULL,'2025-01-03 15:47:41','Pendiente',24.00,NULL,'PayPal',3.50,5.78,NULL),(37,7,NULL,'2025-01-03 15:48:05','Pendiente',24.00,NULL,'PayPal',3.50,5.78,NULL),(40,7,NULL,'2025-01-03 15:50:20','Pendiente',24.00,NULL,'PayPal',3.50,5.78,NULL),(41,7,NULL,'2025-01-03 15:52:08','Pendiente',21.50,NULL,'PayPal',3.50,5.25,NULL),(42,7,NULL,'2025-01-03 15:52:26','Pendiente',21.50,NULL,'PayPal',3.50,5.25,NULL),(43,7,NULL,'2025-01-03 15:53:37','Pendiente',21.50,NULL,'PayPal',3.50,5.25,NULL),(44,7,NULL,'2025-01-03 15:56:51','En preparación',21.50,NULL,'PayPal',3.50,5.25,NULL),(45,7,NULL,'2025-01-03 16:07:03','Listo para recoger',6.50,NULL,'PayPal',3.50,2.10,NULL),(48,7,NULL,'2025-01-05 03:00:08','Pendiente',21.50,NULL,'Efectivo',0.00,4.52,NULL),(51,7,NULL,'2025-01-05 15:40:20','En preparación',12.00,0,'Paypal',3.50,2.52,NULL),(100,7,NULL,'2025-01-05 18:55:59','En preparación',123.00,0,'Paypal',0.00,25.83,NULL),(101,7,NULL,'2025-01-05 18:56:12','En preparación',123.00,0,'Paypal',0.00,25.83,NULL),(102,7,NULL,'2025-01-05 18:59:05','En preparación',123.00,0,'Paypal',0.00,25.83,NULL),(108,7,1,'2025-01-06 22:48:09','Pendiente de aceptación',23.40,NULL,'Efectivo',0.00,4.91,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(250) NOT NULL,
  `main_photo` varchar(250) DEFAULT NULL,
  `category_id` int NOT NULL,
  `base_price` decimal(5,2) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'dr burger original','dr_burger.webp',1,12.00),(2,'Patatas grandes','fries.webp',3,4.50),(3,'Coca-Cola Zero','cola-zero33.webp',4,2.50),(4,'la trufada','trufada.webp',1,14.00),(5,'la green point','green_point.webp',1,14.00),(6,'la chilanga','chilanga.webp',1,11.50),(7,'la pollos hermanos','burger_pollos.webp',1,12.00),(8,'la sole','burger_sole.webp',1,9.50),(9,'la smoke bbq','smoke-bbq.webp',1,12.00),(10,'la vegan','vegan.webp',1,14.00),(11,'bbq combo','combo-bbq.webp',2,15.50),(12,'original combo','combo-original.webp',2,15.50),(13,'coca-Cola','cola.webp',4,2.60),(14,'agua 50 cl.','agua-50.webp',4,2.00),(15,'Pastel de oreo','oreo-cake.webp',5,6.00),(16,'Salsa smoked bbq','smoke-sauce-bbq.webp',6,0.50),(17,'salsa chipotle','chipotle-sauce.webp',6,0.50);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_ingredients`
--

DROP TABLE IF EXISTS `products_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_ingredients` (
  `product_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  `ingredient_quantity` int NOT NULL,
  PRIMARY KEY (`product_id`,`ingredient_id`),
  KEY `ingredient_id` (`ingredient_id`),
  CONSTRAINT `products_ingredients_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  CONSTRAINT `products_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`ingredient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_ingredients`
--

LOCK TABLES `products_ingredients` WRITE;
/*!40000 ALTER TABLE `products_ingredients` DISABLE KEYS */;
INSERT INTO `products_ingredients` VALUES (1,1,1),(1,2,2),(1,3,1),(1,4,1),(1,5,1),(1,6,1),(1,7,1);
/*!40000 ALTER TABLE `products_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotions` (
  `promotion_id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(250) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `discount_value` decimal(5,2) NOT NULL,
  `discount_type` varchar(250) NOT NULL,
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`promotion_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotions`
--

LOCK TABLES `promotions` WRITE;
/*!40000 ALTER TABLE `promotions` DISABLE KEYS */;
INSERT INTO `promotions` VALUES (1,'WELCOME10','2024-10-01','2025-10-02',10.00,'percentage',NULL),(2,'ORDER5','2024-10-01','2025-10-02',5.00,'fixed',NULL),(3,'PR7','2024-10-01','2025-10-02',100.00,'percentage',1);
/*!40000 ALTER TABLE `promotions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `last_name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `cp` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'Mario','Pozo','Can Sucarrats 15','mario31991@gmail.com','637546332','admin','$2y$10$KgRm4IXBQsSVONJBkXecsue.8LiIeZ.MojQ.Md5oWUNc2ooMkXZcK','Rubi','08191'),(18,'MARIO','POZO ROMERO','JAUME BALMES 3','acerfred.inox@gmail.com','637546332','customer','$2y$10$KgRm4IXBQsSVONJBkXecsue.8LiIeZ.MojQ.Md5oWUNc2ooMkXZcK','MOLINS DE REI','08750');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dr_burger'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-07  0:38:04
