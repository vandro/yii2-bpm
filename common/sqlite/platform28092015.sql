-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: platform
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
-- Table structure for table `Request`
--

DROP TABLE IF EXISTS `Request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) DEFAULT NULL,
  `address` text,
  `phone` varchar(20) DEFAULT NULL,
  `entrepreneur_name` varchar(255) DEFAULT NULL,
  `description` text,
  `requests_nums` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Request`
--

LOCK TABLES `Request` WRITE;
/*!40000 ALTER TABLE `Request` DISABLE KEYS */;
INSERT INTO `Request` VALUES (1,'Рахимов Эркин Шодикович','Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres','+9989032423','ООО Рахимов Эркин Шодикович','Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni','12; 45; 23;','adsd@df.df',1,1),(4,'Анваров Эркин Шодикович',' Yashash manzili yoki Yuridik adres Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres','+9989032423','ООО Рахимов Эркин Шодикович','Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni','12; 45;','adsd@df.df',3,1),(5,'Рахимов Эркин Шодикович','Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres','+9989032423','ООО Рахимов Эркин Шодикович','Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni','12; 45; 23;','adsd@df.df',2,1),(6,'Ботиров Эргаш Мирмухамедович','г. Ташкен, Мирабадский район, улица Фаргона йули, дом 234','+998905672341','OOO Spark parts','Нету претензии','23, 45, 67','dfg@gh.pf',1,1),(7,'Ашуров Мухмуд Эргашевич','Yashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adresYashash manzili yoki Yuridik adres','+9989032423','ООО Ашуров Мухмуд Эргашевич','Murojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuniMurojaatning qisqacha mazmuni','23','ffg@fg.com',3,1);
/*!40000 ALTER TABLE `Request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Request2`
--

DROP TABLE IF EXISTS `Request2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Request2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` int(11) DEFAULT NULL,
  `question_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Request2`
--

LOCK TABLES `Request2` WRITE;
/*!40000 ALTER TABLE `Request2` DISABLE KEYS */;
INSERT INTO `Request2` VALUES (1,1,1);
/*!40000 ALTER TABLE `Request2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin',1,1439802215),('member',2,1440143150);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,'Administrator of this application',NULL,NULL,1439802051,1439802051),('adminArticle',2,'Allows admin+ roles to manage articles',NULL,NULL,1439802051,1439802051),('createArticle',2,'Allows editor+ roles to create articles',NULL,NULL,1439802051,1439802051),('deleteArticle',2,'Allows admin+ roles to delete articles',NULL,NULL,1439802051,1439802051),('editor',1,'Editor of this application',NULL,NULL,1439802051,1439802051),('manageUsers',2,'Allows admin+ roles to manage users',NULL,NULL,1439802051,1439802051),('member',1,'Registered users, members of this site',NULL,NULL,1439802051,1439802051),('premium',1,'Premium members. They have more permissions than normal members',NULL,NULL,1439802051,1439802051),('support',1,'Support staff',NULL,NULL,1439802051,1439802051),('theCreator',1,'You!',NULL,NULL,1439802051,1439802051),('updateArticle',2,'Allows editor+ roles to update articles',NULL,NULL,1439802051,1439802051),('updateOwnArticle',2,'Update own article','isAuthor',NULL,1439802051,1439802051),('usePremiumContent',2,'Allows premium+ roles to use premium content',NULL,NULL,1439802051,1439802051);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('theCreator','admin'),('editor','adminArticle'),('editor','createArticle'),('admin','deleteArticle'),('admin','editor'),('admin','manageUsers'),('support','member'),('support','premium'),('editor','support'),('admin','updateArticle'),('updateOwnArticle','updateArticle'),('editor','updateOwnArticle'),('premium','usePremiumContent');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` VALUES ('isAuthor','O:28:\"common\\rbac\\rules\\AuthorRule\":3:{s:4:\"name\";s:8:\"isAuthor\";s:9:\"createdAt\";i:1439802051;s:9:\"updatedAt\";i:1439802051;}',1439802051,1439802051);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Ташкент',500);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dictionary`
--

DROP TABLE IF EXISTS `dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `added` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dictionary`
--

LOCK TABLES `dictionary` WRITE;
/*!40000 ALTER TABLE `dictionary` DISABLE KEYS */;
INSERT INTO `dictionary` VALUES (1,'Регионы','regions',1),(2,'Города','cities',1),(3,'Типы вопросов','question_type',1);
/*!40000 ALTER TABLE `dictionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity`
--

DROP TABLE IF EXISTS `entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `added` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity`
--

LOCK TABLES `entity` WRITE;
/*!40000 ALTER TABLE `entity` DISABLE KEYS */;
INSERT INTO `entity` VALUES (1,'Заявка','Request',1),(2,'Заявка2','Request2',1),(3,'Заявка3','Request3',0);
/*!40000 ALTER TABLE `entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entity_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `length` int(11) NOT NULL,
  `dictionary_id` int(11) DEFAULT NULL,
  `added` tinyint(1) NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `entity_id` (`entity_id`),
  CONSTRAINT `fields_ibfk_1` FOREIGN KEY (`entity_id`) REFERENCES `entity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (1,1,'Murojaatchining F.I.Sh','full_name','VARCHAR',255,0,1,1),(2,1,'Yashash manzili yoki Yuridik adres','address','TEXT',500,0,1,1),(3,1,'Telefon raqami','phone','VARCHAR',20,0,1,1),(4,1,'Tadbirkorlik subyekti nomi','entrepreneur_name','VARCHAR',255,0,1,1),(5,1,'Murojaatning qisqacha mazmuni','description','TEXT',500,0,1,1),(6,1,'Oldingi arizaning raqami','requests_nums','VARCHAR',255,0,1,1),(7,1,'Electron pochta manzili','email','VARCHAR',50,0,1,1),(8,1,'Регион','region','INT',11,1,1,1),(9,1,'Города','city','INT',11,2,1,1),(10,2,'Города','city','INT',11,2,1,1),(11,2,'Тип вопросов','question_type','INT',11,3,1,1),(12,3,'Города','city','INT',11,2,0,1);
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gridview_fields`
--

DROP TABLE IF EXISTS `gridview_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gridview_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gridview_id` int(11) NOT NULL,
  `entity_type_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL,
  `condition` varchar(40) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `order` int(6) NOT NULL DEFAULT '100',
  PRIMARY KEY (`id`),
  KEY `gridview_id` (`gridview_id`),
  CONSTRAINT `gridview_fields_ibfk_1` FOREIGN KEY (`gridview_id`) REFERENCES `gridviews` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gridview_fields`
--

LOCK TABLES `gridview_fields` WRITE;
/*!40000 ALTER TABLE `gridview_fields` DISABLE KEYS */;
INSERT INTO `gridview_fields` VALUES (5,1,1,1,'contains','Принт',100),(6,1,3,8,'greater','18',100);
/*!40000 ALTER TABLE `gridview_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gridviews`
--

DROP TABLE IF EXISTS `gridviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gridviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gridviews`
--

LOCK TABLES `gridviews` WRITE;
/*!40000 ALTER TABLE `gridviews` DISABLE KEYS */;
INSERT INTO `gridviews` VALUES (1,'MyView',1,0),(3,'Test',1,0);
/*!40000 ALTER TABLE `gridviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1439802033),('m141022_115823_create_user_table',1439802037),('m141022_115912_create_rbac_tables',1439802037),('m141022_115922_create_session_table',1439802037),('m150104_153617_create_article_table',1439802037);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `process`
--

DROP TABLE IF EXISTS `process`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `process`
--

LOCK TABLES `process` WRITE;
/*!40000 ALTER TABLE `process` DISABLE KEYS */;
/*!40000 ALTER TABLE `process` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question_type`
--

DROP TABLE IF EXISTS `question_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question_type`
--

LOCK TABLES `question_type` WRITE;
/*!40000 ALTER TABLE `question_type` DISABLE KEYS */;
INSERT INTO `question_type` VALUES (1,'Алименты',500),(2,'Уголовный',500);
/*!40000 ALTER TABLE `question_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '500',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regions`
--

LOCK TABLES `regions` WRITE;
/*!40000 ALTER TABLE `regions` DISABLE KEYS */;
INSERT INTO `regions` VALUES (1,'Андижанская область',500),(2,'Наманганская область',500),(3,'Ташкентская область',500);
/*!40000 ALTER TABLE `regions` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rules`
--

DROP TABLE IF EXISTS `rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fields_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_id` (`fields_id`),
  CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`fields_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rules`
--

LOCK TABLES `rules` WRITE;
/*!40000 ALTER TABLE `rules` DISABLE KEYS */;
INSERT INTO `rules` VALUES (1,1,'required','true'),(2,1,'string','true'),(4,2,'required','true'),(5,2,'string','true'),(6,3,'string','true'),(7,3,'required','true'),(8,4,'required','true'),(9,5,'required','true'),(10,6,'required','true'),(11,7,'required','1'),(12,8,'required','true'),(13,9,'string','true'),(14,10,'required','true'),(15,11,'required','true');
/*!40000 ALTER TABLE `rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) NOT NULL,
  `data` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` VALUES ('02uvrf7jbrob7jhuleh9mjg5i1',1440489344,'__flash|a:0:{}__id|i:1;'),('095q56te5eg9s5i7mslstpu5m3',1441528125,'__flash|a:0:{}__id|i:1;'),('0rb25tassoce5cs07vppj5k4l7',1439988730,'__flash|a:0:{}__returnUrl|s:9:\"/backend/\";'),('13dh5ffa41luq5e7c4tvsjh175',1442252001,'__flash|a:0:{}'),('2ggnsp9rsj96e3pb8g3josnl61',1442233606,'__flash|a:0:{}'),('3csppg72jnsoqocou7cfvc10t4',1439978051,'__flash|a:0:{}__id|i:1;'),('3hi2iaaq2neb8iheraft1u3ir2',1442068474,'__flash|a:0:{}__id|i:1;'),('4hgluujnvaacdpji5h619jtea6',1440144676,'__flash|a:0:{}__id|i:2;__captcha/site/captcha|s:6:\"zmkcno\";__captcha/site/captchacount|i:1;'),('4v41uoicj8ke1fm76sibs6sc27',1443184998,'__flash|a:0:{}'),('5fj489kr8fq0q0lsbla172oug2',1441983398,'__flash|a:0:{}__id|i:1;'),('5l5joavgl6fqn67ofghl1aa2l1',1442397541,'__flash|a:0:{}'),('6ujidr8u48djpklhfpdpfebdp3',1440143874,'__flash|a:0:{}'),('721ic3h7v31tk7e4q2hi9mn4i4',1441796456,'__flash|a:0:{}__id|i:1;'),('77s63sj5f465e7nniemb8hv196',1441645230,'__flash|a:0:{}__id|i:1;'),('9dcp73bc84vn7k63aa6vpf15g4',1440154160,'__flash|a:0:{}'),('9hjbgg1kepoen1qvp2v0a4qdc3',1442234153,'__flash|a:0:{}'),('9k2lbubo6p9l2ol3c9ustep696',1442814333,'__flash|a:0:{}'),('c35eb2vpmp0ff00d4h71u60155',1439989252,'__flash|a:0:{}'),('ckuv71gnc2ln4fpd80ttf7hkt4',1441437057,'__flash|a:0:{}'),('d4gokjcger8m8hdd5bbadlnlt5',1443170131,'__flash|a:0:{}'),('dadb96i56coavtfa8aup21hfr1',1440765232,'__flash|a:0:{}__id|i:1;'),('e5pdp3ahr2r8nt9eebt62f57v3',1439804331,'__flash|a:0:{}__id|i:1;'),('e81giprlqal4bdh47v5jve38n6',1441121846,'__flash|a:0:{}__id|i:1;'),('ed53r569lj83hk2u854jpdot91',1442985275,'__flash|a:0:{}'),('f6c9pf3ljougi4jk6ine4tsdc7',1442925532,'__flash|a:0:{}'),('faofvll3603b30pf1n715h4bg0',1441287622,'__flash|a:0:{}__id|i:1;'),('ff4akefqqn91sfengqar5o8d77',1443340164,'__flash|a:0:{}'),('fn6t92bih9c0s1k5c690u9n3h0',1441256776,'__flash|a:0:{}'),('g22ct2ut9ksbri8n53ic20qus1',1439912118,'__flash|a:0:{}__id|i:1;'),('g38jimo4pmj9uj5tch009983n2',1443012510,'__flash|a:0:{}'),('gb6m7jhin54t2keoap64jb3i20',1441208984,'__flash|a:0:{}__id|i:1;'),('glmboo0pdqec3melvpmt6k9lp4',1440153978,'__flash|a:0:{}'),('h2sb0ajkm31gl6pnjjnhe5nad6',1441715179,'__flash|a:0:{}__id|i:1;'),('hivfjdm7bvkjer20d3keh8ep14',1439872701,'__flash|a:0:{}'),('hr4k158ompvgl1jn819n36prs1',1442557328,'__flash|a:0:{}'),('i80e0vs9vkqq9aebj5vt9coh64',1442064566,'__flash|a:0:{}__id|i:1;'),('itgv61vs84ej1t23g0rkrgk9h1',1442652574,'__flash|a:0:{}'),('jm3s7kg5neqrdvse8bif2bdg66',1442469951,'__flash|a:0:{}'),('k3fg1ng2i9rcbob9pe2q5t9mt7',1442223321,'__flash|a:0:{}__returnUrl|s:35:\"/sys/admin/index.php?r=site%2Findex\";'),('kq3vb033avqu7cqjg1bg7sapc3',1439989753,'__flash|a:0:{}__id|i:1;'),('l238s3l1vckjqgro7h4bu33rc6',1441026021,'__flash|a:0:{}__captcha/site/captcha|s:7:\"cumhfif\";__captcha/site/captchacount|i:1;__returnUrl|s:9:\"/backend/\";'),('ljjupdt9q6urp5j68rk8u84hp2',1442579882,'__flash|a:0:{}'),('lumdc8uiffhh2vm1n1iooeklr6',1439978240,'__flash|a:0:{}'),('md99gt4no5g00tpmasifhaga21',1442133500,'__flash|a:0:{}__id|i:1;'),('mjoo1at2kqo2j7aiojq51umqg5',1442299026,'__flash|a:0:{}'),('mvraf6l1n6qn8vmge0qbj9t435',1441375601,'__flash|a:0:{}__id|i:1;'),('netsiqvvb844juqlq7iigkl577',1440860247,'__flash|a:0:{}__id|i:1;'),('nud99ic4tclubgulii8t974gu3',1440168639,'__flash|a:0:{}'),('odlcd6j9uj7pj51pkg6s7ria21',1443256622,'__flash|a:0:{}'),('ofjdcf53g5qo9uvdelo09cie64',1442083243,'__flash|a:0:{}__id|i:1;'),('pin5621i4qhtu1vp94la77spi5',1440676433,'__flash|a:0:{}__id|i:1;'),('q84kqh2jonslp07v26ojhg7ke6',1442219288,'__flash|a:0:{}__id|i:1;'),('si7q7b4pub8d6nuk466qamvet5',1441635185,'__flash|a:0:{}__id|i:1;'),('udbmb7rq6unt3dq7p2ff458is5',1439827143,'__flash|a:0:{}__id|i:1;'),('ujv5lj5odbgn7uq95j78027j21',1440953318,'__flash|a:0:{}__id|i:1;');
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisation_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `role` int(4) DEFAULT '10',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_activation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,2,3,'avazbe','avazbe@gmail.com','$2y$13$6MZ1rdwT3Qwjv4G6gt6nRucLFFBXytWJ4mrbKwiLFMTkU0P4aQlyS',10,2,'8Ul_0mgB7bH6dOD8tcmRcS_fBiIH0Xz2','','',1439802215,1439802754),(2,NULL,NULL,'mirsaid','m.mirmaksudov@uzinfocom.uz','$2y$13$tOL3.StxjuwGPzO4VwyIputkFWDk.TJTm2FbqI4gxX7E7AImxSroC',10,2,'kOtqJb7S3aMHCA8YzAczOcYZhMT5tvvz','kOtqJb7S3aMHCA8YzAczOcYZhMT5tvvz','kOtqJb7S3aMHCA8YzAczOcYZhMT5tvvz',1440143150,1440143150),(3,NULL,NULL,'Owner','Owner@umail.com','$2y$13$P9wDzShX.JyxWahHpsRf0OiHnvb6xXmocaEaeqzxswA6lwkgjYdzi',10,10,'J3wi3MQBAerpS3qG8inKMHo4NN8Ey-iH',NULL,NULL,1443183596,1443183596);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_link`
--

DROP TABLE IF EXISTS `user_role_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_link`
--

LOCK TABLES `user_role_link` WRITE;
/*!40000 ALTER TABLE `user_role_link` DISABLE KEYS */;
INSERT INTO `user_role_link` VALUES (2,3,4),(3,1,2);
/*!40000 ALTER TABLE `user_role_link` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-28 12:56:48
