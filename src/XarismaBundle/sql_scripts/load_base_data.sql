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

use `xarisma`;

--
-- Dumping data for table `dictionary`
--

LOCK TABLES `dictionary` WRITE;
/*!40000 ALTER TABLE `dictionary` DISABLE KEYS */;
INSERT INTO `dictionary` VALUES (8,'order_status','RECEIVED','Received from import file','2015-04-05 14:57:46',NULL,0),(9,'order_status','HOLD_CUST','Hold for customer contact','2015-04-05 14:57:46',NULL,0),(10,'order_status','HOLD_MATERIAL','Hold for material to arrive','2015-04-05 14:57:46',NULL,0),(11,'order_status','HOLD_OTHER','Hold for other reason','2015-04-05 14:57:46',NULL,0),(12,'order_status','PRODUCTION','In production','2015-04-05 14:57:46',NULL,0),(13,'order_status','SHIP_READY','Ready to Ship','2015-04-05 14:57:46',NULL,0),(14,'order_status','SHIP_SHIPPED','Order has shipped','2015-04-05 14:57:46',NULL,0);
/*!40000 ALTER TABLE `dictionary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `station`
--

LOCK TABLES `station` WRITE;
/*!40000 ALTER TABLE `station` DISABLE KEYS */;
/*!40000 ALTER TABLE `station` ENABLE KEYS */;
UNLOCK TABLES;


--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'admin','admin','Admin User','',100,NULL,NULL,'2015-04-05 14:57:46',NULL,0),(5,'dbriggs','dbriggs','Don','Briggs',90,NULL,NULL,'2015-04-05 14:57:46',NULL,0),(6,'gbrown','gbrown','Greg','Brown',90,NULL,NULL,'2015-04-05 14:57:46',NULL,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


