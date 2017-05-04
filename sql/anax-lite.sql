-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: nien16
-- ------------------------------------------------------
-- Server version	5.5.54-0+deb8u1-log

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
-- Table structure for table `Cst_Order`
--

DROP TABLE IF EXISTS `Cst_Order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cst_Order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) DEFAULT NULL,
  `delivery` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `index_status` (`status`),
  CONSTRAINT `Cst_Order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cst_Order`
--

LOCK TABLES `Cst_Order` WRITE;
/*!40000 ALTER TABLE `Cst_Order` DISABLE KEYS */;
/*!40000 ALTER TABLE `Cst_Order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customer`
--

DROP TABLE IF EXISTS `Customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) DEFAULT NULL,
  `lastName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customer`
--

LOCK TABLES `Customer` WRITE;
/*!40000 ALTER TABLE `Customer` DISABLE KEYS */;
INSERT INTO `Customer` VALUES (1,'Nicklas','Envall');
/*!40000 ALTER TABLE `Customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Image`
--

DROP TABLE IF EXISTS `Image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Image`
--

LOCK TABLES `Image` WRITE;
/*!40000 ALTER TABLE `Image` DISABLE KEYS */;
INSERT INTO `Image` VALUES (1,'img/webshop/cd.png'),(2,'img/webshop/clothesbook.png'),(3,'img/webshop/musicbook.jpg'),(4,'img/webshop/musicshirt.png'),(5,'img/webshop/tshirt.png');
/*!40000 ALTER TABLE `Image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InvenShelf`
--

DROP TABLE IF EXISTS `InvenShelf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `InvenShelf` (
  `shelf` char(6) NOT NULL DEFAULT '',
  `description` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`shelf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InvenShelf`
--

LOCK TABLES `InvenShelf` WRITE;
/*!40000 ALTER TABLE `InvenShelf` DISABLE KEYS */;
INSERT INTO `InvenShelf` VALUES ('A101','House A, shelf 101'),('A102','House A, shelf 102'),('NONE','Currently not in stock');
/*!40000 ALTER TABLE `InvenShelf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Inventory`
--

DROP TABLE IF EXISTS `Inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `shelf_id` char(6) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`),
  KEY `shelf_id` (`shelf_id`),
  CONSTRAINT `Inventory_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
  CONSTRAINT `Inventory_ibfk_2` FOREIGN KEY (`shelf_id`) REFERENCES `InvenShelf` (`shelf`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Inventory`
--

LOCK TABLES `Inventory` WRITE;
/*!40000 ALTER TABLE `Inventory` DISABLE KEYS */;
INSERT INTO `Inventory` VALUES (1,1,'A101',1000),(2,2,'NONE',0),(3,3,'A101',300),(4,4,'NONE',0),(5,5,'NONE',0),(6,6,'A101',1);
/*!40000 ALTER TABLE `Inventory` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`nien16`@`%`*/ /*!50003 TRIGGER checkInventory
AFTER UPDATE ON Inventory FOR EACH ROW
	IF (NEW.amount < 5) THEN
		INSERT INTO LowStock (`prod_id`, `amount`) VALUES (OLD.prod_id, NEW.amount);
	END IF */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `LowStock`
--

DROP TABLE IF EXISTS `LowStock`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LowStock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `occured` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `LowStock_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LowStock`
--

LOCK TABLES `LowStock` WRITE;
/*!40000 ALTER TABLE `LowStock` DISABLE KEYS */;
INSERT INTO `LowStock` VALUES (1,6,3,'2017-04-30 10:28:40'),(2,6,0,'2017-04-30 10:28:47'),(3,6,1,'2017-05-01 08:43:27');
/*!40000 ALTER TABLE `LowStock` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OrderRow`
--

DROP TABLE IF EXISTS `OrderRow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OrderRow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `product` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  CONSTRAINT `OrderRow_ibfk_1` FOREIGN KEY (`order`) REFERENCES `Cst_Order` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OrderRow`
--

LOCK TABLES `OrderRow` WRITE;
/*!40000 ALTER TABLE `OrderRow` DISABLE KEYS */;
/*!40000 ALTER TABLE `OrderRow` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`nien16`@`%`*/ /*!50003 TRIGGER createdOrderRow
AFTER INSERT ON OrderRow FOR EACH ROW
	CALL decreaseInventory(NEW.Product, NEW.amount) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Prod2Cat`
--

DROP TABLE IF EXISTS `Prod2Cat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Prod2Cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `Prod2Cat_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
  CONSTRAINT `Prod2Cat_ibfk_2` FOREIGN KEY (`cat_id`) REFERENCES `ProdCategory` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Prod2Cat`
--

LOCK TABLES `Prod2Cat` WRITE;
/*!40000 ALTER TABLE `Prod2Cat` DISABLE KEYS */;
INSERT INTO `Prod2Cat` VALUES (3,2,1),(4,2,3),(5,3,2),(6,3,3),(7,4,1),(8,4,3),(9,5,1),(10,5,2),(14,6,1),(15,6,2),(23,1,1);
/*!40000 ALTER TABLE `Prod2Cat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProdCategory`
--

DROP TABLE IF EXISTS `ProdCategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProdCategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProdCategory`
--

LOCK TABLES `ProdCategory` WRITE;
/*!40000 ALTER TABLE `ProdCategory` DISABLE KEYS */;
INSERT INTO `ProdCategory` VALUES (1,'music'),(2,'clothes'),(3,'book');
/*!40000 ALTER TABLE `ProdCategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Product`
--

DROP TABLE IF EXISTS `Product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) DEFAULT NULL,
  `imgLink` varchar(40) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_price` (`price`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Product`
--

LOCK TABLES `Product` WRITE;
/*!40000 ALTER TABLE `Product` DISABLE KEYS */;
INSERT INTO `Product` VALUES (1,'Rockband Merchandise','img/webshop/cd.png',102),(2,'Music Book','img/webshop/musicbook.jpg',100),(3,'Styling Book','img/webshop/clothesbook.png',100),(4,'CD book','img/webshop/cd.png',100),(5,'Rockband Merchandise','img/webshop/tshirt.png',100),(6,'Nicklas t-shirt','img/webshop/musicshirt.png',50);
/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`nien16`@`%`*/ /*!50003 TRIGGER createdProduct
AFTER INSERT ON Product FOR EACH ROW
	INSERT INTO Inventory (`prod_id`, `amount`, `shelf_id`) VALUES (NEW.id, 0, "NONE") */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Temporary view structure for view `ProductView`
--

DROP TABLE IF EXISTS `ProductView`;
/*!50001 DROP VIEW IF EXISTS `ProductView`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `ProductView` AS SELECT
 1 AS `id`,
 1 AS `category`,
 1 AS `description`,
 1 AS `InStock`,
 1 AS `image`,
 1 AS `price`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `ShoppingCart`
--

DROP TABLE IF EXISTS `ShoppingCart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ShoppingCart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prod_id` (`prod_id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `ShoppingCart_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
  CONSTRAINT `ShoppingCart_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ShoppingCart`
--

LOCK TABLES `ShoppingCart` WRITE;
/*!40000 ALTER TABLE `ShoppingCart` DISABLE KEYS */;
/*!40000 ALTER TABLE `ShoppingCart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `VCst_Order`
--

DROP TABLE IF EXISTS `VCst_Order`;
/*!50001 DROP VIEW IF EXISTS `VCst_Order`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `VCst_Order` AS SELECT
 1 AS `OrderNumber`,
 1 AS `CostumerNumber`,
 1 AS `OrderDate`,
 1 AS `Price`,
 1 AS `firstName`,
 1 AS `lastName`,
 1 AS `Status`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `VInventory`
--

DROP TABLE IF EXISTS `VInventory`;
/*!50001 DROP VIEW IF EXISTS `VInventory`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `VInventory` AS SELECT
 1 AS `shelf`,
 1 AS `prod_id`,
 1 AS `location`,
 1 AS `amount`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `VShoppingCart`
--

DROP TABLE IF EXISTS `VShoppingCart`;
/*!50001 DROP VIEW IF EXISTS `VShoppingCart`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `VShoppingCart` AS SELECT
 1 AS `prod_id`,
 1 AS `Customer_ID`,
 1 AS `Item`,
 1 AS `Price`,
 1 AS `Amount`*/;
SET character_set_client = @saved_cs_client;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,'hem',NULL,'Hem','Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter \'nl2br\' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.','page','bbcode,nl2br',NULL,'2017-04-22 07:44:38',NULL,NULL),(2,'om',NULL,'Om','Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.','page','markdown',NULL,'2017-04-22 07:44:38',NULL,NULL),(3,'blogpost-1','valkommen-till-min-blogg','Välkommen till min blogg!','Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.','post','link,nl2br',NULL,'2017-04-22 07:44:38',NULL,NULL),(4,'blogpost-2','nu-har-sommaren-kommit','Nu har sommaren kommit','Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.','post','nl2br',NULL,'2017-04-22 07:44:38',NULL,NULL),(5,'blogpost-3','nu-har-hosten-kommit','Nu har hösten kommit','Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost','post','nl2br',NULL,'2017-04-22 07:44:38',NULL,NULL),(6,NULL,'random','random','','','','0000-00-00 00:00:00','2017-04-22 08:33:13','2017-04-22 11:49:44',NULL),(7,NULL,'nicklas-first-blog','Nicklas first blog','My first post {#id1}\r\n=====================\r\n\r\nHello! Welcome to my first blogpost. I\'m currently using markdown as filter for this text.\r\n\r\nI have however more options such as, \r\n\r\n* bbcode\r\n* link\r\n* nl2br\r\n* markdown','post','markdown','0000-00-00 00:00:00','2017-04-22 08:39:04','2017-04-22 10:42:10',NULL),(8,'nicklaspage','nicklas-first-page','Nicklas first page','Of course I need a new page aswell. For this one I\'ll use filter such as \"bbcode\" and \"nl2br\".\r\n\r\nIm a new line,\r\n\r\nIm another new line.','page','bbcode, nl2br','0000-00-00 00:00:00','2017-04-22 08:43:00','2017-04-22 10:44:23',NULL),(9,'hej','notpublishedyet','notpublishedyet','This will use markdown as default, since i gave no filter.\r\n\r\nHowever, it will not be posted until 2018, since I typed that i wanted the publish date to be in 2018.','page','','2018-02-02 00:00:00','2017-04-22 08:44:47','2017-04-22 10:46:06',NULL),(10,'deletedpage','deletedpage','deletedpage','This page will be published but later deleted','page','','0000-00-00 00:00:00','2017-04-22 08:46:49','2017-04-22 10:47:26','2017-04-22 10:47:41'),(11,'homepage','homepage','Homepage','This type will be displayed as \"block\".\r\n\r\nIt uses however same method as the type \"page\" to display the actual content.','block','markdown','0000-00-00 00:00:00','2017-04-22 08:48:32','2017-04-22 10:49:39',NULL),(12,'didyouknow','did-you-know','Did you know','Did you know that the type is \"block\"? \r\n\r\nTherefore it displays on the first page. \r\n\r\nAwesome!','block','markdown','0000-00-00 00:00:00','2017-04-22 08:50:02','2017-04-22 10:50:40',NULL),(13,'dp','nicklas-deleted-post','Nicklas deleted post','I will delete this','post','markdown','0000-00-00 00:00:00','2017-04-22 09:42:35','2017-04-22 11:43:24','2017-04-22 11:43:47'),(14,'newblock','new-block','new block','[b]Bold text[/b] [i]Italic text[/i] [url=http://dbwebb.se]a link to dbwebb[/url]\r\n\r\nhttp://dbwebb.se\r\n\r\nHello this is a sentence for linebreak.\r\nI just made a line break,\r\nand another one,\r\nand another one','block','bbcode,link,nl2br','0000-00-00 00:00:00','2017-04-22 09:44:33','2017-04-22 11:46:48',NULL),(15,NULL,'new-blocke','empty','','','','0000-00-00 00:00:00','2017-04-22 09:47:24','2017-04-22 11:49:06','2017-04-22 11:49:13'),(16,NULL,'new-post','new post','This is a published post.','post','markdown','0000-00-00 00:00:00','2017-04-22 09:52:27','2017-04-23 17:43:01',NULL),(17,'aaaa','a','aaaaa','#aaaaa','page','markdown','0000-00-00 00:00:00','2017-04-27 03:28:11','2017-04-27 05:28:32','2017-04-27 05:29:00'),(18,'APIexemplen','api-exemplen','API-exemplen','Exemplen\r\n=====================\r\n\r\nAlla följande exemplen antar att du har gjort följande,\r\n\r\n`INSERT INTO `ProdCategory` (`category`) VALUES\r\n(\"music\"), (\"clothes\"), (\"book\");\r\n\r\nINSERT INTO `Image` (`link`) VALUES\r\n(\"img/webshop/cd.png\"), (\"img/webshop/clothesbook.png\"), (\"img/webshop/musicbook.jpg\"),\r\n(\"img/webshop/musicshirt.png\"), (\"img/webshop/tshirt.png\");\r\n\r\nINSERT INTO `Product` (`description`, `imgLink`, `price`) VALUES\r\n(\"Rockband Merchandise Sleeve\", \"img/webshop/musicshirt.png\", 100),\r\n(\"Music Book\", \"img/webshop/musicbook.jpg\", 100),\r\n(\"Styling Book\", \"img/webshop/clothesbook.png\", 100),\r\n(\"CD book\", \"img/webshop/cd.png\", 100),\r\n(\"Rockband Merchandise T-shirt\", \"img/webshop/tshirt.png\", 100);\r\n\r\nINSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES\r\n(1, 1), (1, 2),\r\n(2, 1), (2, 3),\r\n(3, 2), (3, 3),\r\n(4, 1), (4, 3),\r\n(5, 1), (5, 2);\r\n\r\nINSERT INTO `InvenShelf` (`shelf`, `description`) VALUES\r\n(\"NONE\", \"Currently not in stock\"),\r\n(\"A101\", \"House A, shelf 101\"),\r\n(\"A102\", \"House A, shelf 102\");`\r\n\r\nCALL updateInventory(1, \"A101\", 1000);\r\nCALL updateInventory(3, \"A101\", 300);\r\n\r\n\r\nSkapa en order för en kund (SQL-KOD, idén är att man kan kopiera rakt av)\r\n-------------\r\n\r\nINSERT INTO `Customer` (`firstName`, `lastName`) VALUES\r\n(\"Nicklas\", \"Envall\");\r\n\r\n-- Ska fungera,\r\nCALL addCart(1, 1);\r\nCALL addCart(1, 1);\r\n\r\n-- Ska inte fungera,\r\nCALL addCart(1, 2);\r\n\r\n-- Ska fungera,\r\nCALL addCart(1, 3);\r\nCALL addCart(1, 3);\r\n\r\n-- Kontroll\r\nSELECT * FROM VShoppingCart WHERE Customer_ID = 1;\r\n\r\n-- Ta bort vara 1\r\nCALL removeCart(1, 1);\r\n\r\n-- Kontroll\r\nSELECT * FROM VShoppingCart WHERE Customer_ID = 1;\r\n\r\n-- Skapa order, kontrollera lagret så det tas bort\r\nSELECT * FROM Inventory;\r\nCALL createOrder(1);\r\nSELECT * FROM Inventory;\r\n\r\n-- Titta allt som har med ordrar att göra\r\nSELECT * FROM Cst_Order;\r\nSELECT * FROM OrderRow;\r\n\r\n-- Avbryt ordern, kontrollera så allt tas tillbaka till lagret och status ändras till cancel\r\nSELECT * FROM VCst_Order;\r\nSELECT * FROM Inventory;\r\ncall cancelOrder(1);\r\n\r\nSELECT * FROM VCst_Order;\r\nSELECT * FROM Inventory;\r\n\r\n\r\nRapporten (SQL-KOD, idén är att man kan kopiera rakt av)\r\n-------------\r\n\r\n--En trigger kontrollerar efter varje UPDATE.\r\n\r\nCALL updateInventory(4, \"A101\", 1);\r\nSELECT * FROM LowStock;\r\nCALL updateInventory(4, \"A101\", 4);\r\nSELECT * FROM LowStock;\r\nCALL updateInventory(4, \"A101\", 7);\r\nSELECT * FROM LowStock;\r\nCALL updateInventory(4, \"A101\", 10);\r\nSELECT * FROM LowStock;\r\n','post','nl2br,link','0000-00-00 00:00:00','2017-04-30 10:21:54','2017-04-30 12:23:18',NULL);
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Nicklas766','$2y$10$8Fhmz0Nzo4jmmFXOtTHJYO.S92k8XYcny7udxptF8jF9PcBXxMMSG','Hello, I\'m the creator of the site. Feel free to look around. :)','Nicklas766@live.se','Admin'),(2,'qwerty','$2y$10$FUs3zzV3ji.0mDNwnfUBFudjW8A2QL7amadfRmysTTVmNAOVty.Iy','Hello I\'m admin.','admin@gmail.com','Admin'),(3,'Hello','$2y$10$TsBEqCyFbGaN6Ll2b1xriu.P5VSFxokpHG4zRNMA/wYpWUS2MZS/.','','',''),(4,'Hello2','$2y$10$kmYkhI845DHaR06HnAnbT./GXm4kSdOKIWKIsdUnlFuwRCyvp4aP.','Helloo!','hello@gmail.com',''),(6,'Randomguy','$2y$10$m2qDzy.hDCwZ6bCNJNLyoOPdwM78x4d4s1WXOQAN6q4e8gonRp8d6','','','User'),(7,'random2','$2y$10$EJU2cs06ltVaqP/S8FRtGuZ4rSaUYBxrtjyY4Gi2KwdVVX86WM3EK','random','random@gmail.com','User'),(9,'admin','$2y$10$RxLLMhJgWS4R2QBeewxMGuhUw7WyMRl6vuymLhJmmYBtZOHu9zFgW','I am admin123','admin@gmail.com','Admin'),(13,'Hej','$2y$10$i6yZbgpO8mj.8X4Bcp5kL.aGgZOV9gDjbk5UKEJvrl/XSss9pfvHu','','','User'),(14,'x','$2y$10$SJ5xXVERMkQ5Ogo5UBxzHuDcN6RbywMSWVhxtt5JD/aZ6JgDqTpXS','','','User'),(15,'doe','$2y$10$pa.pzTusHUK81HnUcFJnvOFrE99TFcWLM79YNu6wGd.aBvzfVMPVe','','','User'),(16,'','$2y$10$ZI97kpSWbHkHMONoS7dn8OfIde8WxW4cfp/9DXtA2XDGu8NEKnOgG','','','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'nien16'
--

--
-- Dumping routines for database 'nien16'
--
/*!50003 DROP FUNCTION IF EXISTS `removeInventory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` FUNCTION `removeInventory`(
    I_id INTEGER
) RETURNS char(20) CHARSET latin1
BEGIN
	DECLARE P_id INT;
    -- Get products id
    set P_id = (SELECT prod_id FROM Inventory WHERE id = I_id);

    -- If product exists do a rollback.
    IF EXISTS (SELECT * FROM Product WHERE id = P_id) THEN
        RETURN "FALSE";
    ELSE
        DELETE FROM Inventory WHERE id = I_id;
        RETURN "TRUE";
	END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP FUNCTION IF EXISTS `StockStatus` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` FUNCTION `StockStatus`(
    Amount INTEGER
) RETURNS char(30) CHARSET latin1
BEGIN
    IF Amount > 0 THEN
        RETURN CONCAT("Yes(", Amount, ")");
    ELSEIF Amount = 0 THEN
        RETURN "No";
    END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addCart` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `addCart`(
     customerId INT,
     prodId int
)
BEGIN
    DECLARE amountInStock INT;
    START TRANSACTION;

    SET amountInStock = (SELECT amount FROM Inventory WHERE prod_id = prodId);

    IF amountInStock <= 0 THEN
        ROLLBACK;
        SELECT "Sorry! That product is currently not in stock.";
    ELSE
        INSERT INTO `ShoppingCart` (`customer_id`, `prod_id`) VALUES (customerId, prodId);
        END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `addCategory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `addCategory`(
    P_id INT,
    C_id INT
)
BEGIN
    INSERT INTO `Prod2Cat` (`prod_id`, `cat_id`) VALUES (P_id, C_id);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `cancelOrder` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `cancelOrder`(
     orderId INT
)
BEGIN
	DECLARE numOfOrders INT;
    DECLARE theProd INT;
    DECLARE theAmount INT;
    DECLARE p1 INT;
    SET p1 = 0;
	-- No delete, set status as canceled instead
    UPDATE Cst_Order SET status = "canceled" WHERE id = orderId;

    -- Get product id and amount
    set numOfOrders = (SELECT COUNT(`order`) FROM OrderRow WHERE `order` = orderId);

	-- Return the goods to the warehouse
	label1: WHILE p1 < numOfOrders + 1 DO
		set theProd = (SELECT product FROM OrderRow WHERE `order` = orderId LIMIT 1 OFFSET p1);
		set theAmount = (SELECT amount FROM OrderRow WHERE `order` = orderId LIMIT 1 OFFSET p1);
		CALL increaseInventory(theProd, theAmount);
		SET p1 = p1 + 1;
   END WHILE label1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createOrder` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `createOrder`(
     customerId INT
)
BEGIN
    DECLARE latestId INT;
    -- Start with creating order
    INSERT INTO Cst_Order (`customer_id`, `status`) VALUES (customerId, 'active');

    -- Get the id of order.
    SET latestId = (SELECT MAX(id) FROM Cst_Order);

    -- Create orderrows for the order
	INSERT INTO OrderRow (`order`, `product`, `amount`)
	SELECT latestId, prod_id, Amount FROM `VShoppingCart` WHERE Customer_ID = customerId;

    -- Delete the ShoppingCart after ordermade
	DELETE FROM `ShoppingCart` WHERE Customer_ID = customerId;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `createProduct` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `createProduct`(
    des VARCHAR(20),
    imgLink VARCHAR(40),
    price INT,
    C_id INT
)
BEGIN
	DECLARE latestId INT;
    INSERT INTO `Product` (`description`, `imgLink`, `price`) VALUES
	(des, imgLink, price);

    -- Get the id of product.
    SET latestId = (SELECT MAX(id) FROM Product);

    call addCategory(latestId, C_id);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `decreaseInventory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `decreaseInventory`(
     P_id INT,
     decrease INT
)
BEGIN
	UPDATE Inventory SET amount = amount - decrease WHERE prod_id = P_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `increaseInventory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `increaseInventory`(
     P_id INT,
     increase INT
)
BEGIN
    UPDATE Inventory SET amount = amount + increase WHERE prod_id = P_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `removeCart` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `removeCart`(
     customerId INT,
     prodId int
)
BEGIN
    DELETE FROM `ShoppingCart` WHERE customer_id = customerId AND prod_id = prodId limit 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `removeCategory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `removeCategory`(
    P_id INT
)
BEGIN
    DELETE FROM Prod2Cat WHERE prod_id = P_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `removeProduct` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `removeProduct`(
     P_id INT
)
BEGIN
	SET FOREIGN_KEY_CHECKS=0; -- to disable them
	DELETE FROM LowStock WHERE prod_id = P_id;
	DELETE FROM Prod2Cat WHERE prod_id = P_id;
    DELETE FROM Product WHERE id = P_id;
    SET FOREIGN_KEY_CHECKS=1; -- to re-enable them
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `updateInventory` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `updateInventory`(
     P_id INT,
     newShelf CHAR(6),
     newAmount INT
)
BEGIN
	DECLARE amountInStock INT;
    START TRANSACTION;

    SET amountInStock = (SELECT amount FROM Inventory WHERE prod_id = P_id);

    IF (amountInStock + (newAmount)) < 0 THEN
        ROLLBACK;
        SELECT "You cant decrease below zero!";
    ELSE
        UPDATE Inventory SET shelf_id = newShelf, amount = amount + (newAmount), prod_id = P_id WHERE prod_id = P_id;
        COMMIT;
        END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `updateProduct` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
CREATE DEFINER=`nien16`@`%` PROCEDURE `updateProduct`(
     P_id INT,
     newDes VARCHAR(20),
     newImg VARCHAR(40),
     newPrice INT
)
BEGIN
    UPDATE Product SET description = newDes, imgLink = newImg, price = newPrice WHERE id = P_id;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `ProductView`
--

/*!50001 DROP VIEW IF EXISTS `ProductView`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`nien16`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `ProductView` AS select `P`.`id` AS `id`,group_concat(`PC`.`category` separator ',') AS `category`,`P`.`description` AS `description`,`StockStatus`(`INV`.`amount`) AS `InStock`,`P`.`imgLink` AS `image`,`P`.`price` AS `price` from (((`Prod2Cat` `P2C` join `Product` `P` on((`P2C`.`prod_id` = `P`.`id`))) join `ProdCategory` `PC` on((`P2C`.`cat_id` = `PC`.`id`))) join `Inventory` `INV` on((`INV`.`prod_id` = `P`.`id`))) group by `P`.`id` order by `P`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VCst_Order`
--

/*!50001 DROP VIEW IF EXISTS `VCst_Order`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`nien16`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VCst_Order` AS select `CO`.`id` AS `OrderNumber`,`C`.`id` AS `CostumerNumber`,`CO`.`created` AS `OrderDate`,sum((`P`.`price` * `O`.`amount`)) AS `Price`,`C`.`firstName` AS `firstName`,`C`.`lastName` AS `lastName`,`CO`.`status` AS `Status` from (((`Cst_Order` `CO` join `OrderRow` `O` on((`CO`.`id` = `O`.`order`))) join `Customer` `C` on((`CO`.`customer_id` = `C`.`id`))) join `Product` `P` on((`P`.`id` = `O`.`product`))) group by `CO`.`id` order by `P`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VInventory`
--

/*!50001 DROP VIEW IF EXISTS `VInventory`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`nien16`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VInventory` AS select `S`.`shelf` AS `shelf`,`I`.`prod_id` AS `prod_id`,`S`.`description` AS `location`,`I`.`amount` AS `amount` from (`Inventory` `I` join `InvenShelf` `S` on((`I`.`shelf_id` = `S`.`shelf`))) order by `S`.`shelf` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `VShoppingCart`
--

/*!50001 DROP VIEW IF EXISTS `VShoppingCart`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`nien16`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `VShoppingCart` AS select `P`.`id` AS `prod_id`,`C`.`id` AS `Customer_ID`,`P`.`description` AS `Item`,sum(`P`.`price`) AS `Price`,count(0) AS `Amount` from ((`ShoppingCart` `SC` join `Customer` `C` on((`SC`.`customer_id` = `C`.`id`))) join `Product` `P` on((`P`.`id` = `SC`.`prod_id`))) group by `P`.`id` order by `P`.`id` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-04  9:54:16
