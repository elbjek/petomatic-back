# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: petomatic
# Generation Time: 2018-08-09 18:52:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table appointment_type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `appointment_type`;

CREATE TABLE `appointment_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `appointment_type` WRITE;
/*!40000 ALTER TABLE `appointment_type` DISABLE KEYS */;

INSERT INTO `appointment_type` (`id`, `title`)
VALUES
	(1,'Checkup'),
	(2,'MicroChipping'),
	(3,'Operation'),
	(4,'Blood');

/*!40000 ALTER TABLE `appointment_type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table appointments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `description` varchar(1500) NOT NULL DEFAULT '',
  `pets_id` int(10) unsigned NOT NULL,
  `customers_id` int(10) unsigned NOT NULL,
  `appointment_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_appointments_pets1_idx` (`pets_id`),
  KEY `fk_appointments_customers1_idx` (`customers_id`),
  KEY `fk_appointments_appointment_type1_idx` (`appointment_type_id`),
  CONSTRAINT `fk_appointments_appointment_type1` FOREIGN KEY (`appointment_type_id`) REFERENCES `appointment_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_appointments_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_appointments_pets1` FOREIGN KEY (`pets_id`) REFERENCES `pets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;

INSERT INTO `appointments` (`id`, `date`, `description`, `pets_id`, `customers_id`, `appointment_type_id`)
VALUES
	(18,'2018-08-13','Long long long Long long long Long long long Long long long  description',15,21,1),
	(20,'2018-08-14','Long long long Long long long Long long long Long long long Long long long  description',16,22,2),
	(22,'2018-08-12','Long long long Long long long Long long long ddescription',15,20,3),
	(23,'2018-08-20','Long long long Long long long Long long long ddescription',19,23,2);

/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table breed
# ------------------------------------------------------------

DROP TABLE IF EXISTS `breed`;

CREATE TABLE `breed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `breed` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `breed` WRITE;
/*!40000 ALTER TABLE `breed` DISABLE KEYS */;

INSERT INTO `breed` (`id`, `breed`)
VALUES
	(1,'Russian Blue'),
	(2,'Poodle'),
	(3,'Golden retriever');

/*!40000 ALTER TABLE `breed` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL DEFAULT '',
  `phone_number` int(11) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `phone_number`, `address`, `city`, `state`, `deleted`)
VALUES
	(20,'Lena','Bjekovic',621467578,'Vukasoviceva','Belgrade','Serbia',0),
	(21,'Jovana','Milic',643223322,'Bogdana Zerajica 24','Belgrade','SErbia',0),
	(22,'Stefan','Radic',987575473,'Cara Dusana','Belgrade','Serbia',0),
	(23,'Jovana','Mirkovic',939484757,'Vuksanovica33','Belgrade','Serbia',0);

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pets`;

CREATE TABLE `pets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `sex_id` int(10) unsigned NOT NULL,
  `species_id` int(10) unsigned NOT NULL,
  `breed_id` int(10) unsigned NOT NULL,
  `date_of_birth` varchar(45) DEFAULT NULL,
  `coat` varchar(45) DEFAULT NULL,
  `customers_id` int(10) unsigned NOT NULL,
  `deleted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_pets_sex_idx` (`sex_id`),
  KEY `fk_pets_species1_idx` (`species_id`),
  KEY `fk_pets_breed1_idx` (`breed_id`),
  KEY `fk_pets_customers1_idx` (`customers_id`),
  CONSTRAINT `fk_pets_breed1` FOREIGN KEY (`breed_id`) REFERENCES `breed` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pets_customers1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pets_sex` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pets_species1` FOREIGN KEY (`species_id`) REFERENCES `species` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

LOCK TABLES `pets` WRITE;
/*!40000 ALTER TABLE `pets` DISABLE KEYS */;

INSERT INTO `pets` (`id`, `name`, `sex_id`, `species_id`, `breed_id`, `date_of_birth`, `coat`, `customers_id`, `deleted`)
VALUES
	(15,'Lucky',1,4,3,'2018-08-14',NULL,20,NULL),
	(16,'Lola',2,2,1,'2018-08-13',NULL,21,NULL),
	(17,'Bobi',1,1,2,'2018-08-19',NULL,22,NULL),
	(19,'Bunny',2,5,2,'2018-08-13',NULL,23,NULL);

/*!40000 ALTER TABLE `pets` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table sex
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sex`;

CREATE TABLE `sex` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gender` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `sex` WRITE;
/*!40000 ALTER TABLE `sex` DISABLE KEYS */;

INSERT INTO `sex` (`id`, `gender`)
VALUES
	(1,'Male'),
	(2,'Female');

/*!40000 ALTER TABLE `sex` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table species
# ------------------------------------------------------------

DROP TABLE IF EXISTS `species`;

CREATE TABLE `species` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `species` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `species` WRITE;
/*!40000 ALTER TABLE `species` DISABLE KEYS */;

INSERT INTO `species` (`id`, `species`)
VALUES
	(1,'Dog'),
	(2,'Cat'),
	(3,'Horse'),
	(4,'Fish'),
	(5,'Bird');

/*!40000 ALTER TABLE `species` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(55) NOT NULL,
  `avatar` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `avatar`)
VALUES
	(1,'Lena','Bjekovic','lenabjekovic@hotmail.com','kiselomleko94',NULL),
	(2,'pera','peric','lena94bree@gmail.com','$1$rasmusle$EZyF9r7crwbH38Yqe20pq0\n',NULL),
	(3,'Len','Bjek','lalal@lalka.dfac','$1$rasmusle$mTROuIIb1VaHr.Djpoq9K/\n',NULL),
	(4,'Len','Bjeovic','lenabjekovic@hotmail.com','$1$rasmusle$D9JeFpTg9dxdoJ1Qf9jl..\n',NULL),
	(5,'Len','Bjeovic','','$1$rasmusle$Lh7EJjJyg.NQdWZOklket0\n',NULL),
	(6,'Len','Djokovic','','$1$rasmusle$Lh7EJjJyg.NQdWZOklket0\n',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
