-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: xarisma
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1-log

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

drop database if exists `xarisma`;
create database `xarisma`;
use `xarisma`;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerNumber` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `accountName` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `repName` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'12975','Church On Wheels',NULL,'2015-04-05 14:53:41',NULL,0),(2,'10719','Tidmore Flags',NULL,'2015-04-05 14:53:41',NULL,0),(3,'12758','Americanflagstore.com INC',NULL,'2015-04-05 14:53:41',NULL,0),(4,'13276','Flutter Flag Source',NULL,'2015-04-05 14:53:41',NULL,0),(5,'13884','Carrot-Top Industries, Inc.',NULL,'2015-04-05 14:53:41',NULL,0),(6,'11157','Oates Flag Co. Inc.',NULL,'2015-04-05 14:53:41',NULL,0),(7,'14584','US Flag Supply',NULL,'2015-04-05 14:53:41',NULL,0);
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custorder`
--

DROP TABLE IF EXISTS `custorder`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `orderNumber` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `orderdate` datetime DEFAULT NULL,
  `orderStatus` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updateBy` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_196FD7DF9395C3F3` (`customer_id`),
  CONSTRAINT `FK_196FD7DF9395C3F3` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custorder`
--

LOCK TABLES `custorder` WRITE;
/*!40000 ALTER TABLE `custorder` DISABLE KEYS */;
INSERT INTO `custorder` VALUES (1,1,'139378',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,0),(2,2,'139379',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,0),(3,2,'139450',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,0),(4,3,'139380',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,1),(5,3,'139381',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,0),(6,4,'139383',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,0),(7,5,'13884',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,0),(8,5,'139456',NULL,'RECEIVED','',1,'2015-04-05 14:53:41',NULL,0);
/*!40000 ALTER TABLE `custorder` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dictionary`
--

DROP TABLE IF EXISTS `dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `term` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `definition` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dictionary`
--

LOCK TABLES `dictionary` WRITE;
/*!40000 ALTER TABLE `dictionary` DISABLE KEYS */;
INSERT INTO `dictionary` VALUES (8,'order_status','RECEIVED','Received from import file','2015-04-05 14:57:46',NULL,0),(9,'order_status','HOLD_CUST','Hold for customer contact','2015-04-05 14:57:46',NULL,0),(10,'order_status','HOLD_MATERIAL','Hold for material to arrive','2015-04-05 14:57:46',NULL,0),(11,'order_status','HOLD_OTHER','Hold for other reason','2015-04-05 14:57:46',NULL,0),(12,'order_status','PRODUCTION','In production','2015-04-05 14:57:46',NULL,0),(13,'order_status','SHIP_READY','Ready to Ship','2015-04-05 14:57:46',NULL,0),(14,'order_status','SHIP_SHIPPED','Order has shipped','2015-04-05 14:57:46',NULL,0);
/*!40000 ALTER TABLE `dictionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `station`
--

DROP TABLE IF EXISTS `station`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stationCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` varchar(3000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `station`
--

LOCK TABLES `station` WRITE;
/*!40000 ALTER TABLE `station` DISABLE KEYS */;
/*!40000 ALTER TABLE `station` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roles` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updateBy` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'admin','admin','Admin User','',100,NULL,NULL,'2015-04-05 14:57:46',NULL,0),(5,'dbriggs','dbriggs','Don','Briggs',90,NULL,NULL,'2015-04-05 14:57:46',NULL,0),(6,'gbrown','gbrown','Greg','Brown',90,NULL,NULL,'2015-04-05 14:57:46',NULL,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worklog`
--

DROP TABLE IF EXISTS `worklog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worklog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `station_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `stationStatus` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `Deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worklog`
--

LOCK TABLES `worklog` WRITE;
/*!40000 ALTER TABLE `worklog` DISABLE KEYS */;
/*!40000 ALTER TABLE `worklog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-08  2:22:54
