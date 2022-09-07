-- MySQL dump 10.13  Distrib 5.7.37, for Linux (x86_64)
--
-- Host: localhost    Database: books_3V
-- ------------------------------------------------------
-- Server version	5.7.37

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
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (11,'123123123'),(9,'Balackaya A.N.'),(5,'Bunin I.A.'),(7,'Butenko A.S.'),(3,'Dostoevskiy F.M.'),(8,'Kravcov N.A.'),(4,'Marit Kapla'),(2,'Mayakovskiy V.V.'),(1,'Pushkin A.S.'),(10,'Slesarenko Vladislav'),(6,'Vikulin D.A.');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `year` date DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `publisher_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `country_id` (`country_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `books_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`),
  CONSTRAINT `books_ibfk_2` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  CONSTRAINT `books_ibfk_3` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'How to be cool in sex',1069,'2022-01-01',1,1,1),(2,'How to be cool in sex part2',1069,'2023-01-01',1,1,1),(3,'How to be cool in sex part3',1069,'2025-01-01',1,1,1),(4,'How to be cool in sex part4',1069,'2029-01-01',1,1,1),(5,'How to be cool in sex part5',1069,'2029-01-01',2,2,2),(6,'everlasting summer',410,'2017-01-01',6,7,1),(7,'everlasting summer p2',410,'2020-01-01',2,4,9),(8,'everlasting summer p3',410,'2021-01-01',4,3,5),(9,'everlasting summer p4',410,'2022-01-01',6,6,6),(10,'everlasting summer p5',410,'2022-01-01',9,9,9),(11,'123123',123123,'2022-09-15',9,4,8),(12,'123',123,'2022-08-30',9,4,8),(13,'123123',123123,'2022-08-29',9,4,8),(14,'234234',234234234,'0002-12-31',9,4,8),(15,'234234',234234234,'0002-12-31',9,4,8),(16,'234234',234234234,'0002-12-31',9,4,8),(17,'123123',12312312,'2022-09-20',9,4,8),(18,'123123',123123,'2022-09-18',2,9,9),(19,'123123',123123,'2022-09-18',2,9,9),(20,'123123',12312312,'2022-09-20',9,4,8),(21,'234234',234234234,'0002-12-31',9,4,8),(22,'234234',234234234,'0002-12-31',9,4,8),(23,'sanya loh',3222,'2022-08-30',9,4,8),(24,'sanya loh',3222,'2022-08-30',9,4,8),(25,'123123',12313,'0123-02-13',9,4,8),(26,'123123',12313,'0123-02-13',9,4,8),(27,'123123',12313,'0123-02-13',9,4,8),(28,'123123',12313,'0123-02-13',9,4,8),(29,'123123',12313,'0123-02-13',9,4,8),(30,'21312',31231,'0231-12-31',9,4,8),(31,'21312',31231,'0231-12-31',9,4,8),(32,'21312',31231,'0231-12-31',9,4,8),(33,'21312',31231,'0231-12-31',9,4,8),(34,'21312',31231,'0231-12-31',9,4,8),(35,'aaaaa',123,'0001-12-23',9,4,8),(36,'aaaaa',123,'0001-12-23',9,4,8),(37,'123123123',12312313,'3123-12-31',9,4,8),(38,'123123123',12312313,'3123-12-31',9,4,8),(39,'123123',123123,'1111-11-11',9,4,8),(40,'12312',12,'1111-11-11',9,4,8),(41,'12312',12,'1111-11-11',9,4,8),(42,'213123',123123,'1111-11-11',9,4,8),(43,'213123',123123,'1111-11-11',9,4,8),(44,'ghhhh',123,'1223-11-23',9,4,8),(45,'3123',12312,'2221-11-12',9,4,8),(46,'1231',1231,'1113-11-11',9,4,8),(47,'12312',123123,'2112-12-31',9,4,8),(48,'123123',12312,'1222-12-31',9,4,8),(49,'123',3213,'1111-11-11',9,4,8),(50,'123123',123123,'2322-12-31',9,4,8),(51,'123123',123123,'2312-12-31',9,4,8),(52,'12313123',1212312312,'1222-11-23',9,4,8),(53,'123123',123123,'2222-12-31',9,4,8),(54,'543543',543543,'1223-02-12',6,3,11),(55,'554545',12312,'2112-12-31',11,4,8),(56,'545454545',5445454545,'2222-11-11',11,4,8),(57,'12312312',123123123,'0221-11-22',4,1,8);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_categories`
--

DROP TABLE IF EXISTS `books_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_categories` (
  `book_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  KEY `book_id` (`book_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `books_categories_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `books_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_categories`
--

LOCK TABLES `books_categories` WRITE;
/*!40000 ALTER TABLE `books_categories` DISABLE KEYS */;
INSERT INTO `books_categories` VALUES (1,1),(2,3),(2,7),(4,7),(5,7),(5,6),(5,5),(5,8),(4,8),(7,8),(7,4),(3,4),(3,7),(2,7),(2,6),(2,8),(3,8),(9,8),(9,4),(9,6),(3,6),(3,7),(2,7),(2,7);
/*!40000 ALTER TABLE `books_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_libraries`
--

DROP TABLE IF EXISTS `books_libraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_libraries` (
  `book_id` int(11) DEFAULT NULL,
  `library_id` int(11) DEFAULT NULL,
  KEY `book_id` (`book_id`),
  KEY `library_id` (`library_id`),
  CONSTRAINT `books_libraries_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `books_libraries_ibfk_2` FOREIGN KEY (`library_id`) REFERENCES `libraries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_libraries`
--

LOCK TABLES `books_libraries` WRITE;
/*!40000 ALTER TABLE `books_libraries` DISABLE KEYS */;
INSERT INTO `books_libraries` VALUES (1,1),(2,1),(3,1),(4,1),(5,4),(1,4),(3,4),(2,4),(6,4),(5,1),(5,4),(5,5),(5,8),(6,8),(7,8),(8,8),(9,8),(9,1);
/*!40000 ALTER TABLE `books_libraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_racks`
--

DROP TABLE IF EXISTS `books_racks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_racks` (
  `book_id` int(11) DEFAULT NULL,
  `rack_id` int(11) DEFAULT NULL,
  KEY `book_id` (`book_id`),
  KEY `rack_id` (`rack_id`),
  CONSTRAINT `books_racks_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `books_racks_ibfk_2` FOREIGN KEY (`rack_id`) REFERENCES `racks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_racks`
--

LOCK TABLES `books_racks` WRITE;
/*!40000 ALTER TABLE `books_racks` DISABLE KEYS */;
INSERT INTO `books_racks` VALUES (1,1),(2,1),(3,1),(4,1),(4,2),(6,1),(7,1),(8,1),(9,1),(9,2),(9,4),(9,7),(9,6),(4,6),(5,6),(3,6);
/*!40000 ALTER TABLE `books_racks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `parent_id` (`parent_id`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'nauchsex',1),(2,'prikol',1),(3,'lutie prikoli',1),(4,'Romance',2),(5,'lite Romance',2),(6,'drama',4),(7,'Korean drama',4),(8,'novella',5),(9,'novella 18+',5);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (8,'Belarus'),(6,'Castleland'),(5,'Castlevania'),(3,'England'),(9,'France'),(11,'Italy'),(10,'Nigeria'),(1,'Russia'),(7,'Sweden'),(4,'Switzerland'),(2,'USA');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libraries`
--

DROP TABLE IF EXISTS `libraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libraries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `address` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libraries`
--

LOCK TABLES `libraries` WRITE;
/*!40000 ALTER TABLE `libraries` DISABLE KEYS */;
INSERT INTO `libraries` VALUES (1,'Chekhov lib','Grecheskaya'),(2,'Chlidren lib','Frunze'),(3,'WAQ','USA'),(4,'Prikoli mnoga','Lenina'),(5,'California freedom','walnut greek'),(6,'Vlad lib','Chekhova 57'),(7,'Nikita lib','Chekhova 57/1'),(8,'Sanya lib','Chekhova 57/2'),(9,'Alisa lib','Chekhova 57/3'),(10,'Dima lib','Chekhova 57/4'),(11,'2432423','2324234234'),(12,'new page new life','anasdlfjanslfkjaskjdfalskjdfalskj');
/*!40000 ALTER TABLE `libraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publishers`
--

DROP TABLE IF EXISTS `publishers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publishers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `address` (`address`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publishers`
--

LOCK TABLES `publishers` WRITE;
/*!40000 ALTER TABLE `publishers` DISABLE KEYS */;
INSERT INTO `publishers` VALUES (1,'Super book','Moscow'),(2,'kNIGA is best friend','Moscow pranks'),(3,'super-duper','Moscow chiks'),(4,'BOOK SHE/HIS','San-diego'),(5,'Vikings','Malmo'),(6,'German is better than France','Switzerland'),(7,'Bratishka','Niggeria'),(8,'Bratan','Nigeria'),(9,'SALT FUN','ST.Petersburg'),(11,'SALT addiction','ST.Petersburg drug store');
/*!40000 ALTER TABLE `publishers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `racks`
--

DROP TABLE IF EXISTS `racks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `racks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `racks`
--

LOCK TABLES `racks` WRITE;
/*!40000 ALTER TABLE `racks` DISABLE KEYS */;
INSERT INTO `racks` VALUES (1,'rack1',100),(2,'rack2',100),(3,'rack3',100),(4,'rack4',100),(5,'rack5',100),(6,'rack6',100),(7,'rack7',100),(8,'rack8',100),(9,'rack9',100),(10,'rack10',100);
/*!40000 ALTER TABLE `racks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(16) NOT NULL,
  `surname` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'123','123','',''),(2,'$login','$password','',''),(3,'$login','$password','',''),(4,'$login','$password','',''),(5,'$login','$password','',''),(6,'Favis','Favis','',''),(7,'sdfasdfas','sdfasdfasdf','',''),(8,'123123','24234234','',''),(9,'ewrwerwq','werwerwr','',''),(10,'ewrwerwq','werwerwr','',''),(11,'342545345','24243241323','',''),(12,'342545345','24243241323','',''),(13,'asd','asd','','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-07 14:13:31
