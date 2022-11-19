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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (15,'aas'),(26,'asdaasdasd'),(28,'asdasdasd'),(17,'asdasdasdasd123123'),(5,'Bunin I.A.'),(7,'Butenko A.S.'),(3,'Dostoevskiy F.M.'),(18,'gdfdaad2dfsd'),(29,'gfdfg'),(8,'Kravcov N.A.'),(4,'Marit Kapl'),(2,'Mayakovskiy V.V.'),(19,'prikolishsda'),(1,'Pushkin A.S.'),(10,'Slesarenko Vladislav'),(6,'Vikulin D.A.'),(12,'Zalupa');
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
INSERT INTO `books` VALUES (2,'How to be cool in sex part2',1069,'2023-01-01',1,1,1),(3,'How to be cool in sex part3',1069,'2025-01-01',1,1,1),(4,'How to be cool in sex part4',1069,'2029-01-01',1,1,1),(5,'How to be cool in sex part5',1069,'2029-01-01',2,2,2),(6,'everlasting summer',410,'2017-01-01',6,7,1),(7,'everlasting summer p2',410,'2020-01-01',2,4,9),(8,'everlasting summer p3',410,'2021-01-01',4,3,5),(9,'everlasting summer p4',410,'2022-01-01',6,6,6),(18,'123123',123123,'2022-09-18',2,9,9),(19,'123123',123123,'2022-09-18',2,9,9),(54,'543543',543543,'1223-02-12',6,3,11),(57,'12312312',123123123,'0221-11-22',4,1,8);
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
INSERT INTO `books_categories` VALUES (2,3),(2,7),(4,7),(5,7),(5,6),(5,5),(5,8),(4,8),(7,8),(7,4),(3,4),(3,7),(2,7),(2,6),(2,8),(3,8),(9,8),(9,4),(9,6),(3,6),(3,7),(2,7),(2,7);
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
INSERT INTO `books_libraries` VALUES (2,1),(3,1),(4,1),(5,4),(3,4),(2,4),(6,4),(5,1),(5,4),(5,5),(5,8),(6,8),(7,8),(8,8),(9,8),(9,1);
/*!40000 ALTER TABLE `books_libraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_users`
--

DROP TABLE IF EXISTS `books_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_users` (
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `books_users_ibfk1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  CONSTRAINT `books_users_ibfk2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_users`
--

LOCK TABLES `books_users` WRITE;
/*!40000 ALTER TABLE `books_users` DISABLE KEYS */;
INSERT INTO `books_users` VALUES (3,37),(2,37),(2,37);
/*!40000 ALTER TABLE `books_users` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libraries`
--

LOCK TABLES `libraries` WRITE;
/*!40000 ALTER TABLE `libraries` DISABLE KEYS */;
INSERT INTO `libraries` VALUES (1,'Chekhov lib','Grecheskaya'),(2,'Chlidren lib','Frunze'),(3,'WAQ','USA'),(4,'Prikoli mnoga','Lenina'),(5,'California freedom','walnut greek'),(6,'Vlad lib','Chekhova 57'),(7,'Nikita lib','Chekhova 57/1'),(8,'Sanya lib','Chekhova 57/2'),(9,'Alisa lib','Chekhova 57/3'),(10,'Dima lib','Chekhova 57/4'),(11,'Alisa','New Taganrog'),(12,'new page new life','anasdlfjanslfkjaskjdfalskjdfalskj'),(15,'nice cockcc','asdasdasdsdasadadsdasd'),(18,'super nice cock ','asdasd'),(20,'sadagfdgdcxv','gvbdbdcvzxcv');
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
  `password` varchar(256) NOT NULL,
  `name` varchar(16) NOT NULL,
  `surname` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (36,'Favisdd','123','asdasda','asdasd'),(37,'Favis','$2y$10$GA7aym45cRo8ME1w9Zc0A.UjKxgPXykIo8EQqhN53F/F4WZ5HyQ4q','Dimon','Vikulin'),(45,'Favisfgds','$2y$10$aZaJR5aaibvohcmubtaCaOW6L6NvlsYqW3SXQ/pqT5ZeInP40s1Re','123','123'),(46,'Favisfgdsasdsd','$2y$10$dgknAcyF3kBtCQZeT.ILO.tJkfo4dlNk9ikf9U0V4S68VoazmN5A.','123','123'),(47,'Sansan','$2y$10$NlCj.Y2VU9wY7RM7SBKYkOpJ1GIB7AiB.Q0n1ZH.VqpeoFgEZIL6a','123','123'),(48,'PrIK','$2y$10$MrI9bnHY1rcZ2IXaI8A.MuuSKNSQcz/QiD5VkZHZlKf9hgMWJdlHC','PRIK','PRIK'),(52,'Dimon','$2y$10$oBwRDgJtKSBlXeQQqNW0EOBKbyFdFH31NsLVJ7D.kvXa1l5A3nQOK','Dimon','Dimon'),(53,'Alisa','$2y$10$6juyAyDx/gfEKKeQ3Ego2unkg5wJsbE9IyNQQ0QPa0Nn/tTqwU0Qe','Alisa','Alisa'),(54,'BIba','$2y$10$qFG31DnSwTGYJLkKANCdOuumzHnm4totjy//Kb0BMj6BqZ.59sL8C','BIba','BIba'),(55,'boba','$2y$10$qZlKLM1N112n1ItTpZkbBuW9LbLOVi77G0VDx0urIXQhNmHuFMfie','boba','boba'),(60,'Favis123123','$2y$10$2gMuJE8br780kZ3Guxr9k.UvVVdMWA2zKD5nvdGo4RB1vLj8jBQaW','12312312','123123'),(61,'Popa','$2y$10$PjVXpu/sUJE44I2xzJYF/OsFaC/mF68xvY3acxGNrG2MlP9HzNZfu','Popa','Popa');
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

-- Dump completed on 2022-09-26 15:52:44
