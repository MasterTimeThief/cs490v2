-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: sql2.njit.edu    Database: wad3
-- ------------------------------------------------------
-- Server version	5.5.29-log

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
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `professor_id` int(11) unsigned NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer_1` varchar(255) DEFAULT NULL,
  `answer_2` varchar(255) DEFAULT NULL,
  `answer_3` varchar(255) DEFAULT NULL,
  `answer_4` varchar(255) DEFAULT NULL,
  `answer_5` varchar(255) DEFAULT NULL,
  `question_type` enum('true_or_false','multiple_choice','fill_in_the_blanks','short_essay') DEFAULT NULL,
  `is_true` enum('0','1') DEFAULT '0',
  `which_is_correct` enum('1','2','3','4','5') DEFAULT NULL,
  `extra_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,3,'Is php an object oriented language?',NULL,NULL,NULL,NULL,NULL,'true_or_false','1',NULL,NULL),(2,3,'when was php created?','1994','1927','6758','67678','7867','multiple_choice','0','1',NULL),(3,3,'create a funciton that returns summation of two numbers?','function add($a,$b){\nreturn $a+b}',NULL,NULL,NULL,NULL,'short_essay','0',NULL,NULL),(4,3,'Linux Torvals created ___','Linux',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),(14,3,'This question is for a TEST EXAM',NULL,NULL,NULL,NULL,NULL,'true_or_false','1',NULL,NULL),(16,3,'For years, the preferred model for software development was the _______ method.','waterfall',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),(17,3,'How would you make a C program that prints out 5 items in testArray?','for (i = 0; i < 5; i++)\n{\n    printf(testArray[i]);\n}',NULL,NULL,NULL,NULL,'short_essay','0',NULL,NULL),(18,3,'What symbol would you use to denote a pointer?','^','$','*','&','@','multiple_choice','0','3',NULL),(20,3,'The MyISAM database engine supports transactions.',NULL,NULL,NULL,NULL,NULL,'true_or_false','0',NULL,NULL),(21,3,'This class uses _____ to learn about programming.','Python',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),(22,3,'C was invented in the year ____','1970',NULL,NULL,NULL,NULL,'fill_in_the_blanks','1','1',NULL),(23,3,'Create a simple Hello World function','echo \"Hello World!\"',NULL,NULL,NULL,NULL,'short_essay','0',NULL,NULL),(24,3,'What is an example of a high level language?','1','2','3','4','5','multiple_choice','0','4',NULL),(25,3,'NJIT teaches a course in PHP',NULL,NULL,NULL,NULL,NULL,'true_or_false','0',NULL,NULL);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-24 18:38:30
