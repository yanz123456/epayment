/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 5.1.41 : Database - db_transactionportal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_transactionportal` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_transactionportal`;

/*Table structure for table `tbl_clients` */

DROP TABLE IF EXISTS `tbl_clients`;

CREATE TABLE `tbl_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text,
  `password` text,
  `client_type` text,
  `student_number` text,
  `applicant_number` text,
  `lastname` text,
  `firstname` text,
  `middlename` text,
  `dob` text,
  `maiden_name` text,
  `sex` text,
  `civil_status` text,
  `contact_number` text,
  `city_address` text,
  `permanent_address` text,
  `date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_clients` */

insert  into `tbl_clients`(`id`,`email`,`password`,`client_type`,`student_number`,`applicant_number`,`lastname`,`firstname`,`middlename`,`dob`,`maiden_name`,`sex`,`civil_status`,`contact_number`,`city_address`,`permanent_address`,`date_registered`) values (1,'tamares.bld@pnu.edu.ph','c4ca4238a0b923820dcc509a6f75849b','Student','1','','1','BRYAN LESTER','DE JULIAN','07/31/2021','','Male','Single','1','1','1','2021-07-22 23:00:30'),(2,'asd@gc','202cb962ac59075b964b07152d234b70','Applicant','','1','1','BRYAN LESTER','DE JULIAN','07/31/2021','','Male','Single','1','1','1','2021-07-23 18:47:53'),(3,'external@gmail.com','202cb962ac59075b964b07152d234b70','External','','','ex','ex','ex','07/31/2021','','Male','Single','1','1','1','2021-07-23 18:50:55');

/*Table structure for table `tbl_externalview` */

DROP TABLE IF EXISTS `tbl_externalview`;

CREATE TABLE `tbl_externalview` (
  `ExternalNo` varchar(100) NOT NULL,
  `LName` text,
  `GName` text,
  `MName` text,
  `Email` text,
  PRIMARY KEY (`ExternalNo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tbl_externalview` */

insert  into `tbl_externalview`(`ExternalNo`,`LName`,`GName`,`MName`,`Email`) values ('201210549','Tamares','Bryan Lester','De Julian','tamares.bld@pnu.edu.ph'),('1622878235','Dela Cruz','Juan','','delacruzjuan@gmail.com');

/*Table structure for table `tbl_offices` */

DROP TABLE IF EXISTS `tbl_offices`;

CREATE TABLE `tbl_offices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text,
  `remarks` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_offices` */

insert  into `tbl_offices`(`id`,`description`,`remarks`) values (1,'OUR','active'),(2,'CGSTER','active'),(3,'AUXILLARY','active'),(4,'PBDO','active');

/*Table structure for table `tbl_requests` */

DROP TABLE IF EXISTS `tbl_requests`;

CREATE TABLE `tbl_requests` (
  `transaction_id` varchar(100) NOT NULL,
  `requestor_type` text,
  `requestor_id` text,
  `requestor_LName` text,
  `requestor_MName` text,
  `requestor_GName` text,
  `requestor_Email` text,
  `account_code` text,
  `quantity_of_unit` int(11) DEFAULT NULL,
  `amount_to_pay` decimal(11,2) DEFAULT NULL,
  `amount_paid` decimal(11,2) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `note` text,
  `remarks` text,
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted_date` varchar(100) DEFAULT NULL,
  `payment_date` varchar(100) DEFAULT NULL,
  `reason_of_decline` text,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tbl_requests` */

/*Table structure for table `tbl_transactions` */

DROP TABLE IF EXISTS `tbl_transactions`;

CREATE TABLE `tbl_transactions` (
  `account_code` text,
  `description` text,
  `amount` decimal(50,2) DEFAULT NULL,
  `unit` text,
  `transaction_type` text,
  `category` text,
  `unit_inputted_by` text,
  `no_of_copy` text,
  `office_id` int(11) DEFAULT NULL,
  `note` text,
  `remarks` text,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tbl_transactions` */

insert  into `tbl_transactions`(`account_code`,`description`,`amount`,`unit`,`transaction_type`,`category`,`unit_inputted_by`,`no_of_copy`,`office_id`,`note`,`remarks`,`date_added`) values ('613CLST','Checklist','50.00',NULL,'Fixed','Document','Office','YES',1,'This is checklist.','active','2021-07-27 03:16:16'),('628ENTD','Entrance Data','50.00','per page','Fixed With Unit','Document','Client','NO',1,'This is Entrance Data','active','2021-07-27 03:17:15'),('648LDRY','Laundry','25.00','per kilo','Fixed With Unit','Service','Office','NO',3,'This is Laundry','active','2021-07-27 03:17:42');

/*Table structure for table `tbl_users` */

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text,
  `password` text,
  `firstname` text,
  `lastname` text,
  `photo` text,
  `type` text,
  `office_id` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_users` */

insert  into `tbl_users`(`id`,`username`,`password`,`firstname`,`lastname`,`photo`,`type`,`office_id`,`created_on`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','admin',NULL,'admin',NULL,'2021-06-04 01:06:44'),(2,'OUR','1f14b053155ac1b5cb189101ddffe3f9','OUR','OUR',NULL,'office',1,'2021-06-04 01:28:57'),(3,'CGSTER','b78addcd10fd5aff74b9b7053962b774','CGSTER','CGSTER',NULL,'office',2,'2021-07-05 19:20:37'),(4,'AUXILLARY','2f34d282e9d924a737c27dba29bc10ec','AUXILLARY','AUXILLARY',NULL,'office',3,'2021-07-05 19:20:42'),(5,'PBDO','5ff74212f1f6e66597133d7d271c7a91','PBDO','PBDO',NULL,'office',4,'2021-07-05 19:20:47');

/*Table structure for table `vappinfo` */

DROP TABLE IF EXISTS `vappinfo`;

CREATE TABLE `vappinfo` (
  `StudNo` varchar(200) DEFAULT NULL,
  `LName` varchar(200) DEFAULT NULL,
  `GName` varchar(200) DEFAULT NULL,
  `MName` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `vappinfo` */

insert  into `vappinfo`(`StudNo`,`LName`,`GName`,`MName`,`Email`) values ('1','1','BRYAN LESTER','DE JULIAN','tamares.bld@pnu.edu.ph');

/*Table structure for table `vstudinfo` */

DROP TABLE IF EXISTS `vstudinfo`;

CREATE TABLE `vstudinfo` (
  `StudNo` varchar(200) NOT NULL,
  `LName` varchar(200) DEFAULT NULL,
  `GName` varchar(200) DEFAULT NULL,
  `MName` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`StudNo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `vstudinfo` */

insert  into `vstudinfo`(`StudNo`,`LName`,`GName`,`MName`,`Email`) values ('1','1','BRYAN LESTER','DE JULIAN','tamares.bld@pnu.edu.ph');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
