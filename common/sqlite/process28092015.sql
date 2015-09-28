-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bpm_process
-- ------------------------------------------------------
-- Server version	5.5.44-0+deb7u1

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
-- Table structure for table `questionary_for_driver_licence`
--

DROP TABLE IF EXISTS `questionary_for_driver_licence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionary_for_driver_licence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `driver_licence_category` varchar(255) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `driver_lessons_class_number` int(3) DEFAULT NULL,
  `lector_of_driving_rights` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionary_for_driver_licence`
--

LOCK TABLES `questionary_for_driver_licence` WRITE;
/*!40000 ALTER TABLE `questionary_for_driver_licence` DISABLE KEYS */;
INSERT INTO `questionary_for_driver_licence` VALUES (1,'Владелец Заявки','В',25,NULL,NULL),(3,'xcXZc','XZcXZcXZc',12,NULL,NULL),(4,NULL,NULL,NULL,123,'dfgasgfdg'),(5,'dsfds','fadfad',123,23,'dasfad'),(6,'ytryetr','rtyety',45,NULL,NULL),(7,NULL,NULL,NULL,32,'fdsfad'),(8,'dfdsfa','dfadsfadsf',34,45,'fsaffd'),(9,'dfadsf','adfadsfads',43,56,'dfadfd');
/*!40000 ALTER TABLE `questionary_for_driver_licence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `additional` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (69,'323432','234234','ghfdrf'),(70,'23123','213123213','21321321'),(71,'12321','321312','3213123'),(72,'213213123','12312312','213123');
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `current_node_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,1,1,'2015-09-03 09:15:32'),(2,1,1,3,'2015-09-03 09:15:39');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_cart`
--

DROP TABLE IF EXISTS `tasks_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_id` int(11) NOT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `assigned_to_id` int(11) DEFAULT NULL,
  `current_node_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_cart`
--

LOCK TABLES `tasks_cart` WRITE;
/*!40000 ALTER TABLE `tasks_cart` DISABLE KEYS */;
INSERT INTO `tasks_cart` VALUES (58,2,NULL,NULL,3,NULL,5,1,'2015-09-25 12:20:08'),(60,2,NULL,NULL,3,NULL,7,1,'2015-09-25 14:00:24'),(61,2,NULL,NULL,3,NULL,7,1,'2015-09-25 14:23:41'),(62,2,1,NULL,3,NULL,7,1,'2015-09-25 15:47:07'),(63,2,1,1,3,NULL,7,1,'2015-09-26 09:01:55'),(64,2,2,3,1,NULL,5,1,'2015-09-26 10:00:27'),(65,2,2,3,1,NULL,5,1,'2015-09-26 10:15:06'),(66,2,2,3,1,NULL,5,1,'2015-09-26 13:10:59'),(67,1,2,3,1,NULL,1,1,'2015-09-26 13:11:24'),(68,2,1,1,3,NULL,7,1,'2015-09-27 10:41:13');
/*!40000 ALTER TABLE `tasks_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_entities_link`
--

DROP TABLE IF EXISTS `tasks_entities_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_entities_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_entities_link`
--

LOCK TABLES `tasks_entities_link` WRITE;
/*!40000 ALTER TABLE `tasks_entities_link` DISABLE KEYS */;
INSERT INTO `tasks_entities_link` VALUES (47,49,1,69,1,'2015-09-21 11:41:54'),(48,49,2,17,1,'2015-09-21 11:42:41'),(49,49,1,69,1,'2015-09-21 12:07:23'),(50,50,1,70,1,'2015-09-23 11:23:35'),(51,51,1,71,1,'2015-09-23 11:23:44'),(52,52,1,72,1,'2015-09-23 11:23:51'),(53,52,2,18,1,'2015-09-23 11:26:45'),(54,51,2,19,1,'2015-09-23 11:27:13'),(55,50,2,20,1,'2015-09-23 11:27:44'),(56,59,3,1,3,'2015-09-25 12:21:53'),(57,59,3,2,3,'2015-09-25 12:22:17'),(58,60,3,3,3,'2015-09-25 14:00:32'),(59,60,3,4,1,'2015-09-25 14:16:55'),(60,61,3,5,3,'2015-09-25 14:23:49'),(61,62,3,6,1,'2015-09-27 10:10:28'),(62,62,3,7,1,'2015-09-27 10:10:52'),(63,61,3,5,1,'2015-09-27 10:13:26'),(64,63,3,8,3,'2015-09-27 10:14:46'),(65,63,3,8,1,'2015-09-27 10:15:20'),(66,68,3,9,3,'2015-09-27 10:41:18');
/*!40000 ALTER TABLE `tasks_entities_link` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_entities_link_cart`
--

DROP TABLE IF EXISTS `tasks_entities_link_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_entities_link_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `entity_id` int(11) NOT NULL,
  `entity_item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_entities_link_cart`
--

LOCK TABLES `tasks_entities_link_cart` WRITE;
/*!40000 ALTER TABLE `tasks_entities_link_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks_entities_link_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_nodes_action_log`
--

DROP TABLE IF EXISTS `tasks_nodes_action_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_nodes_action_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_nodes_action_log`
--

LOCK TABLES `tasks_nodes_action_log` WRITE;
/*!40000 ALTER TABLE `tasks_nodes_action_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks_nodes_action_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_nodes_action_log_cart`
--

DROP TABLE IF EXISTS `tasks_nodes_action_log_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_nodes_action_log_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_cart_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_nodes_action_log_cart`
--

LOCK TABLES `tasks_nodes_action_log_cart` WRITE;
/*!40000 ALTER TABLE `tasks_nodes_action_log_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks_nodes_action_log_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_data`
--

DROP TABLE IF EXISTS `user_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `second_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_data`
--

LOCK TABLES `user_data` WRITE;
/*!40000 ALTER TABLE `user_data` DISABLE KEYS */;
INSERT INTO `user_data` VALUES (17,'qwerqe','rqewrqer'),(18,'dfaer','ewrqewr'),(19,'qewr','qewrqewr'),(20,'qwerqew','rewrqewr');
/*!40000 ALTER TABLE `user_data` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-28 12:53:10
