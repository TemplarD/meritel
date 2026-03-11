-- MySQL dump 10.13  Distrib 5.7.44, for Linux (x86_64)
--
-- Host: localhost    Database: viz620
-- ------------------------------------------------------
-- Server version	5.7.44

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
-- Table structure for table `viz620_additional`
--

DROP TABLE IF EXISTS `viz620_additional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_additional` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_admins`
--

DROP TABLE IF EXISTS `viz620_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_admins` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `access_rules` varchar(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_anons`
--

DROP TABLE IF EXISTS `viz620_anons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_anons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h1` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `pic` text NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `keywords` varchar(512) NOT NULL,
  `date_create` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_brands`
--

DROP TABLE IF EXISTS `viz620_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(512) NOT NULL,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_cart`
--

DROP TABLE IF EXISTS `viz620_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(11) NOT NULL,
  `good` int(11) NOT NULL,
  `kol` int(3) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `price` varchar(64) NOT NULL,
  `mods` varchar(512) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_categories`
--

DROP TABLE IF EXISTS `viz620_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `sort_id` int(11) NOT NULL,
  `id_id` varchar(64) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `h1` varchar(512) NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `keywords` varchar(512) NOT NULL,
  `text` text NOT NULL,
  `child_cnt` int(5) NOT NULL DEFAULT '0',
  `shows` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_cities`
--

DROP TABLE IF EXISTS `viz620_cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_cities` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `namer` varchar(256) NOT NULL,
  `url` varchar(256) NOT NULL,
  `st` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=523 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_faq`
--

DROP TABLE IF EXISTS `viz620_faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `st` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=202 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_good_chars`
--

DROP TABLE IF EXISTS `viz620_good_chars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_good_chars` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(128) NOT NULL,
  `ed` varchar(16) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=183 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_good_chars_val`
--

DROP TABLE IF EXISTS `viz620_good_chars_val`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_good_chars_val` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `char_id` int(3) NOT NULL,
  `good_id` int(11) NOT NULL,
  `char_val` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20069 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_good_rating`
--

DROP TABLE IF EXISTS `viz620_good_rating`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_good_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `good_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `data` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_goods`
--

DROP TABLE IF EXISTS `viz620_goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `cat_ids` varchar(128) NOT NULL,
  `id_id` varchar(128) NOT NULL,
  `brand` int(11) NOT NULL DEFAULT '0',
  `shtrih` varchar(32) NOT NULL,
  `bazed` varchar(512) NOT NULL,
  `name` varchar(256) NOT NULL,
  `logo` varchar(512) NOT NULL,
  `desc_full` text NOT NULL,
  `mods` text NOT NULL,
  `znrek` text NOT NULL,
  `h1` varchar(512) NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `keywords` varchar(512) NOT NULL,
  `g_code` varchar(128) NOT NULL,
  `g_art` varchar(128) NOT NULL,
  `date_create` datetime NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `stock` int(5) NOT NULL DEFAULT '0',
  `onmain` int(1) NOT NULL DEFAULT '0',
  `podzak` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=126 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_mypages`
--

DROP TABLE IF EXISTS `viz620_mypages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_mypages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL DEFAULT '0',
  `shows` int(1) NOT NULL DEFAULT '1',
  `place` varchar(4) NOT NULL DEFAULT 'top',
  `url` varchar(512) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `h1` varchar(256) NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `keywords` varchar(512) NOT NULL,
  `text` mediumtext NOT NULL,
  `logo` text NOT NULL,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_news`
--

DROP TABLE IF EXISTS `viz620_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shows` int(1) NOT NULL DEFAULT '1',
  `name` varchar(512) NOT NULL,
  `h1` varchar(256) NOT NULL,
  `comment` text NOT NULL,
  `pic` text NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `keywords` varchar(512) NOT NULL,
  `date_create` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_orders`
--

DROP TABLE IF EXISTS `viz620_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(11) NOT NULL,
  `status` int(1) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `ship` varchar(50) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_phone` varchar(30) NOT NULL,
  `customer_addr` varchar(512) NOT NULL,
  `customer_coment` text NOT NULL,
  `data` datetime NOT NULL,
  `done` int(1) NOT NULL DEFAULT '0',
  `payed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_partners`
--

DROP TABLE IF EXISTS `viz620_partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(512) NOT NULL,
  `url` varchar(256) NOT NULL,
  `name` varchar(128) NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_photoalb`
--

DROP TABLE IF EXISTS `viz620_photoalb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_photoalb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL DEFAULT '0',
  `sort_id` int(2) NOT NULL DEFAULT '0',
  `logo` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_photogal`
--

DROP TABLE IF EXISTS `viz620_photogal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_photogal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL DEFAULT '0',
  `sort_id` int(2) NOT NULL DEFAULT '0',
  `logo` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=452 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_production`
--

DROP TABLE IF EXISTS `viz620_production`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `text` mediumtext NOT NULL,
  `title` varchar(512) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `keywords` varchar(512) NOT NULL,
  `child_cnt` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1084 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_slides`
--

DROP TABLE IF EXISTS `viz620_slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(256) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_soc`
--

DROP TABLE IF EXISTS `viz620_soc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_soc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sort_id` int(11) NOT NULL DEFAULT '0',
  `pic` varchar(256) NOT NULL,
  `link` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `viz620_urls`
--

DROP TABLE IF EXISTS `viz620_urls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viz620_urls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(512) NOT NULL,
  `target_type` varchar(20) NOT NULL,
  `target_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=302 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-11 18:55:28
