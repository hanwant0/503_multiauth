/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.6.28-0ubuntu0.15.04.1 : Database - 503_multiauth
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`503_multiauth` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `503_multiauth`;

/*Table structure for table `admins` */

DROP TABLE IF EXISTS `admins`;

CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usertype` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'W',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admins` */

insert  into `admins`(`id`,`name`,`email`,`password`,`usertype`,`remember_token`,`created_at`,`updated_at`) values (1,'hanwant singh','hanwant0@gmail.com','$2y$10$NvTUZYU.QmXGHo2aljVEcuv7rFgd/KDs2pA4pjbQMFnEQ6TGaa0bm','W','4VvWnQonf4czioUY1wsUXgJpMqGWN0OW1ImQaSHdkqb3cgPIcQZykdKbC4gQ','2016-12-05 08:40:53','2016-12-17 12:58:45');

/*Table structure for table `admins_password_resets` */

DROP TABLE IF EXISTS `admins_password_resets`;

CREATE TABLE `admins_password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admins_password_resets_email_index` (`email`),
  KEY `admins_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admins_password_resets` */

/*Table structure for table `auto_tag` */

DROP TABLE IF EXISTS `auto_tag`;

CREATE TABLE `auto_tag` (
  `auto_tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `auto_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`auto_tag_id`),
  KEY `auto_tag_auto_id_foreign` (`auto_id`),
  KEY `auto_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `auto_tag_auto_id_foreign` FOREIGN KEY (`auto_id`) REFERENCES `autos` (`auto_id`) ON DELETE CASCADE,
  CONSTRAINT `auto_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `auto_tag` */

insert  into `auto_tag`(`auto_tag_id`,`auto_id`,`tag_id`,`created_at`,`updated_at`) values (9,2,6,'2016-12-14 05:21:39','2016-12-14 05:21:39'),(10,2,7,'2016-12-14 05:21:39','2016-12-14 05:21:39'),(11,2,8,'2016-12-14 05:21:39','2016-12-14 05:21:39'),(12,2,4,'2016-12-14 05:21:55','2016-12-14 05:21:55');

/*Table structure for table `automanufacturers` */

DROP TABLE IF EXISTS `automanufacturers`;

CREATE TABLE `automanufacturers` (
  `automanufacturer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`automanufacturer_id`),
  UNIQUE KEY `automanufacturers_title_unique` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `automanufacturers` */

insert  into `automanufacturers`(`automanufacturer_id`,`title`,`created_at`,`updated_at`) values (12,'skoda','2016-12-12 05:33:25','2016-12-12 05:33:25');

/*Table structure for table `autos` */

DROP TABLE IF EXISTS `autos`;

CREATE TABLE `autos` (
  `auto_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `automanufacturer_id` int(10) unsigned NOT NULL,
  `auto_model` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `auto_slug` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `auto_model_year` year(4) NOT NULL,
  `auto_asking_price` decimal(10,0) NOT NULL,
  `auto_mileage` decimal(5,2) NOT NULL,
  `auto_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`auto_id`),
  UNIQUE KEY `auto_slug` (`auto_slug`),
  KEY `fk_auto_1_idx` (`automanufacturer_id`),
  CONSTRAINT `autos_ibfk_1` FOREIGN KEY (`automanufacturer_id`) REFERENCES `automanufacturers` (`automanufacturer_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `autos` */

insert  into `autos`(`auto_id`,`automanufacturer_id`,`auto_model`,`auto_slug`,`auto_model_year`,`auto_asking_price`,`auto_mileage`,`auto_image`,`created_at`,`updated_at`) values (2,12,'Rapid','rapid',2012,'400000','15.00','skoda-rapid-pKfIx.jpg','2016-12-14 05:21:39','2016-12-14 05:21:39');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_10_18_131257_create_admins_table',1),(4,'2016_10_18_131630_create_admins_passowrd_resets_table',1),(7,'2016_12_12_053853_create_tags_table',2),(8,'2016_12_12_061156_create_auto_tag_table',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `tag_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tag_slug` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tags_tag_title_unique` (`tag_title`),
  KEY `tags_tag_slug_index` (`tag_slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `tags` */

insert  into `tags`(`tag_id`,`tag_title`,`tag_slug`,`created_at`,`updated_at`) values (1,'shine','shine','2016-12-13 13:37:32','2016-12-13 13:37:32'),(2,'125cc','125cc','2016-12-13 13:37:32','2016-12-13 13:37:32'),(3,'alloy wheel','alloy-wheel','2016-12-13 13:37:32','2016-12-13 13:37:32'),(4,'google','google','2016-12-13 13:57:40','2016-12-13 13:57:40'),(5,'yahoo','yahoo','2016-12-13 13:59:43','2016-12-13 13:59:43'),(6,'rapid','rapid','2016-12-14 05:21:38','2016-12-14 05:21:38'),(7,'red','red','2016-12-14 05:21:39','2016-12-14 05:21:39'),(8,'v2engine','v2engine','2016-12-14 05:21:39','2016-12-14 05:21:39');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'prince singh','prinse007@gmail.com','$2y$10$HHUOlp4m5M1ySaU9rdKYv.1NihJbs5H2.vTpk6StbQzuK/sYwqzY2','rRRcEm3VX9s9ywgs2AzwBKDb9NIw8kr71BrBkHW0uJRIwTWAX6qOXp0jn6D2','2016-12-05 08:42:37','2016-12-17 12:50:59'),(2,'lalit lakhara','lalitlakhara1424@gmail.com','$2y$10$PL43G2m8NtVq7sqqxlhYm.uUqzZf6NIdTIrbz7ivZi2ZowX74Mb96',NULL,'2016-12-17 10:42:53','2016-12-17 10:42:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
