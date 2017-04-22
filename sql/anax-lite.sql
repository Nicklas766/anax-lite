-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: userprofiles
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` char(120) COLLATE utf8_swedish_ci DEFAULT NULL,
  `slug` char(120) COLLATE utf8_swedish_ci DEFAULT NULL,
  `title` varchar(120) COLLATE utf8_swedish_ci DEFAULT NULL,
  `data` text COLLATE utf8_swedish_ci,
  `type` char(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `filter` varchar(80) COLLATE utf8_swedish_ci DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `path` (`path`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'hem','hem','Hem','Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar!!\r\n\r\nDessutom finns ett filter \'nl2br\' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.','page','bbcode,nl2br','0000-00-00 00:00:00','2017-04-20 19:38:36','2017-04-21 23:01:04','2017-04-21 22:37:25'),(2,'om','om','Om','Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML!\r\n\r\nRubrik nivå 2\r\n-------------\r\n\r\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\r\n\r\n###Rubrik nivå 3\r\n\r\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.','page','markdown','0000-00-00 00:00:00','2017-04-20 19:38:36','2017-04-21 17:02:37',NULL),(3,'blogpost-1','valkommen-till-min-blogg','Välkommen till min blogg!','Detta är en bloggpost.\r\n\r\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\r\n\r\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.','post','link,nl2br','0000-00-00 00:00:00','2017-04-20 19:38:36','2017-04-21 10:39:23',NULL),(4,'blogpost-2','nu-har-sommaren-kommit','Nu har sommaren kommit','Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.','post','nl2br',NULL,'2017-04-20 19:38:36',NULL,NULL),(5,'blogpost-3','nu-har-hosten-kommit','Nu har hösten kommit','Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost','post','nl2br',NULL,'2017-04-20 19:38:36',NULL,NULL),(6,'r','u','e','','page','','0000-00-00 00:00:00','2017-04-20 19:45:15','2017-04-21 17:51:37','2017-04-21 09:37:31'),(7,NULL,'jassa','Jasså!','','','','0000-00-00 00:00:00','2017-04-20 19:45:40','2017-04-20 21:53:28',NULL),(8,NULL,'e2','e2','','','','0000-00-00 00:00:00','2017-04-20 19:46:16','2017-04-21 08:49:16',NULL),(9,NULL,'a','Title','Hej!','','','0000-00-00 00:00:00','2017-04-20 19:47:13','2017-04-21 18:03:59','2017-04-21 22:37:58'),(10,NULL,'y','y','','','','0000-00-00 00:00:00','2017-04-20 20:01:08','2017-04-21 17:37:21','2017-04-20 22:02:06'),(11,'he','r','Hej','Hejsan!','Page','bbcode','0000-00-00 00:00:00','2017-04-21 08:19:58','2017-04-21 20:09:59',NULL),(12,NULL,'nicklas-blog','Nicklas blog','Hejsan!\r\n\r\nJag kommer att välja\r\n\r\nnya rader\r\n\r\nHär är en länk https://dbwebb.se/uppgift/bygg-webbsidor-fran-innehall-i-databasen','post','nl2br,link','0000-00-00 00:00:00','2017-04-21 11:01:41','2017-04-21 13:02:58',NULL),(13,NULL,'blog2','blog2','Först lite vanlig text följt av en tom rad.\r\n\r\nDå tar vi ett nytt stycke med lite bbcode med [b]bold[/b] och [i]italic[/i] samt en [url=https://dbwebb.se]länk till dbwebb[/url].\r\n\r\nSen testar vi en länk till https://dbwebb.se som skall bli klickbar.\r\n\r\nAvslutningsvis blir det en [länk skriven i markdown](https://dbwebb.se) och länken leder till dbwebb.\r\n\r\nAvsluter med en lista som formatteras till ul/li med markdown.\r\n\r\n* Item 1\r\n* Item 2','post','markdown','0000-00-00 00:00:00','2017-04-21 11:07:54','2017-04-21 13:08:13','2017-04-21 13:14:25'),(14,NULL,'o','new','','','','0000-00-00 00:00:00','2017-04-21 14:58:32','2017-04-21 17:51:57',NULL),(15,'hhhhhhhh','aaaaa','aaaaa','eeeeee','block','bbcode','0000-00-00 00:00:00','2017-04-21 16:19:47','2017-04-21 23:15:09','2017-04-21 23:18:27'),(16,'d','php-kod','PHP-kod','En fil för programmeringsspråket PHP, slutar med .php','block','','0000-00-00 00:00:00','2017-04-21 16:41:12','2017-04-21 20:05:34',NULL),(17,'Nope','did-you-know','Did you know?','I\'ll just type something here\r\n\r\nIm a new line!','block','markdown','0000-00-00 00:00:00','2017-04-21 19:28:58','2017-04-21 21:30:32',NULL),(18,NULL,NULL,'Tjena!',NULL,NULL,NULL,NULL,'2017-04-21 20:52:43',NULL,NULL),(19,'framsidaa','framsidan','framsidan','[b]Detta är bold[/b]\r\n\r\nOch detta en ny rad','page','bbcode','0000-00-00 00:00:00','2017-04-21 21:02:08','2017-04-21 23:03:40',NULL),(20,NULL,'s','s','','','','0000-00-00 00:00:00','2017-04-21 21:03:08','2017-04-21 23:03:23',NULL),(21,'ddd','eeeeeqqqq','eeeeeqqqq','Heeej!','page','markdown','2018-02-02 00:00:00','2017-04-21 21:19:07','2017-04-21 23:19:27',NULL),(22,'eeeeeeeeeeeeeee','ghhhh','ghhhh','Hejsan!','block','','2018-02-02 00:00:00','2017-04-21 21:19:47','2017-04-21 23:20:04',NULL);
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_swedish_ci DEFAULT NULL,
  `info` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  `authority` varchar(100) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'oopvp','$2y$10$rkvnEGflieKxUrgdjFyvKOtkyEW9O.mav07xuY4ZFLctbmtYt8p9a','Hej! Jag heter oopvp och gillar gaming!!!!','oopvp@gmail.com','Admin'),(3,'test','$2y$10$m7wgtRA5tk8epw4gQvJiserZ3OoR/h0pQV5qG8aOTzKwqyN39ftcW','Hello! This is my site','hello@gmail.com','Admin'),(4,'Nicklas766','$2y$10$9legrfunwpi2EQWL6B59teIozaSQD9F38bnRGE5xHU8x.MEUFdMOS','Hello! I am the creator of this site, welcome to my profile! :)','Nicklas766@live.se','Admin'),(5,'qwerty','$2y$10$GDG2c5qXZIhd31PmmJY.9.aS7bvUuIUx02Q1eYrNXnPJJbY67KaBG','Hello!','aa','Admin'),(10,'yee','$2y$10$iMWplCGaJM28GmciydOTZO4NN6jan/4eIN.iYRAtbpXPIP5AvsK.G','I\'m a profile!','yee@gmail.com',''),(12,'hello','$2y$10$ySqy5PaZUyaAbG5sfSydreYCauai/Ta1Xmtl3CRdgn38AWgXB9r.q','Hellooooooooooooooooooooooooooooooooooooooo','hello@gmail.com',''),(14,'eq','$2y$10$JBioGttnPAyIjjdUlnWBS.DL1u2.uDDL9JmaQHJUChaJRrKE0CVoq','Hello!','eq@gmail.com','User'),(16,'123','$2y$10$kclF0.bZ5mZqmMvO6DkEQeKBkFeb6bsASUkMQf6wCky6C7Rb5xIji','Hej!','hej@gmail.com',''),(18,'ee','$2y$10$6obVY5h682vyuM3G6qrwxuDDvLMePyXKaEHjsCA3skHv0rbmnEoSa','Hej','hej@gmail.com','User'),(19,'eeeee','$2y$10$EQ8UTfNCgxlX4CfrXWM/p.XRsm8OhwTpI5Euflu/QdFMfdYkwMS8y','','','User'),(20,'he','$2y$10$gf/0miyxjhYJJxPKKnp3yeO0Ls65IpEpXnhCJspb2NkyXWsCFFl0a','','','Admin'),(21,'a','$2y$10$/n.B21zT5t4syjwYkaZkve9aRlTYogcVYKc4f0d/CJTB6CoLE16Xm','','','User'),(22,'ea','$2y$10$rN83eLYKOdtjbGNOML2dTOoyOmq1fXw3K5LVf9RKzLUl/qffXCWKa','d','d','User'),(23,'s','$2y$10$q1l436iriW6ntso9ngYAnel0JI0gogTtY0iUf./5f1TcDtQe/DXVy','','','User');
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

-- Dump completed on 2017-04-22 10:17:47
