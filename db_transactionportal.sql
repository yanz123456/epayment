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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_clients` */

insert  into `tbl_clients`(`id`,`email`,`password`,`client_type`,`student_number`,`applicant_number`,`lastname`,`firstname`,`middlename`,`dob`,`maiden_name`,`sex`,`civil_status`,`contact_number`,`city_address`,`permanent_address`,`date_registered`) values (1,'tamares.bld@pnu.edu.ph','c4ca4238a0b923820dcc509a6f75849b','Student','1','','1','BRYAN LESTER','DE JULIAN','07/31/2021','','Male','Single','1','1','1','2021-07-22 23:00:30'),(2,'asd@gc','202cb962ac59075b964b07152d234b70','Applicant','','1','1','BRYAN LESTER','DE JULIAN','07/31/2021','','Male','Single','1','1','1','2021-07-23 18:47:53'),(3,'external@gmail.com','202cb962ac59075b964b07152d234b70','External','','','ex','ex','ex','07/31/2021','','Male','Single','1','1','1','2021-07-23 18:50:55'),(4,'delacruz.j@pnu.edu.ph','202cb962ac59075b964b07152d234b70','Student','G201210549','','DELA CRUZ','JUAN','','08/31/1995','','Male','Single','09156540385','Habay 1 Bacoor, Cavite','Habay 1 Bacoor, Cavite','2021-08-09 02:27:40'),(5,'delacruz.j@pnu.edu.ph','c4ca4238a0b923820dcc509a6f75849b','Student','G2001','','DELA CRUZ','JUAN','','09/26/1995','','Male','Single','09151234567','096 Ilaya Street Habay 1 Bacoor, Cavite','096 Ilaya Street Habay 1 Bacoor, Cavite','2021-09-21 01:38:08'),(6,'external1@gmail.com','c4ca4238a0b923820dcc509a6f75849b','External','','','Dela Cruz','Juan','','09/26/1995','','Male','Single','09123456789','096 Ilaya Street Habay 1 Bacoor, Cavite','096 Ilaya Street Habay 1 Bacoor, Cavite','2021-09-21 01:39:59');

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

/*Table structure for table `tbl_paymenterrors` */

DROP TABLE IF EXISTS `tbl_paymenterrors`;

CREATE TABLE `tbl_paymenterrors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `last_name` text,
  `first_name` text,
  `middle_name` text,
  `amount_paid` decimal(11,2) DEFAULT NULL,
  `date_of_payment` date DEFAULT NULL,
  `date_of_import` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_paymenterrors` */

insert  into `tbl_paymenterrors`(`id`,`transaction_id`,`last_name`,`first_name`,`middle_name`,`amount_paid`,`date_of_payment`,`date_of_import`) values (1,'01202012-43','BUGAY','ADRIAN','ULGASAN','4820.00','2020-12-10','2021-09-29 20:25:26'),(2,'01202012-47','SALUD','ANABELLE','CARAAN','3100.00','2020-12-10','2021-09-29 20:25:26'),(3,'01202012-57','Ramos','Marester','Mendijar','4820.00','2020-12-10','2021-09-29 20:25:26'),(4,'12202012-65','Falcunaya','Cladys','Malano','6690.00','2020-12-10','2021-09-29 20:25:26'),(5,'01202012-72','Combo','John Edward','Avetria','4820.00','2020-12-10','2021-09-29 20:25:26'),(6,'01202012-44','Castro','Jed Aries','Fajardo','4820.00','2020-12-10','2021-09-29 20:25:26'),(7,'01202012-77','DAAN','HENRICK CHASE','LECIAS','5000.00','2020-12-10','2021-09-29 20:25:26'),(8,'01202012-86','PINGOL','KATRISHA FAYE','GERONIMO','6060.00','2020-12-10','2021-09-29 20:25:26'),(9,'01202012-85','RODRIGUEZ','ROBERTO JR','LANTING','6690.00','2020-12-10','2021-09-29 20:25:26'),(10,'01202012-32','Barsana','Jayson','Gatmaitan','4820.00','2020-12-10','2021-09-29 20:25:26'),(11,'01202012-60','Cariaga','Mary Audie','Dela Cruz','6690.00','2020-12-10','2021-09-29 20:25:26'),(12,'01202012-104','Soriano','Remedios Jona','Cuenca','9102.50','2020-12-10','2021-09-29 20:25:26'),(13,'01202012-120','FLORES','LEROY','A.','2950.00','2020-12-10','2021-09-29 20:25:26');

/*Table structure for table `tbl_payments` */

DROP TABLE IF EXISTS `tbl_payments`;

CREATE TABLE `tbl_payments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `amount_paid` decimal(63,2) DEFAULT NULL,
  `date_of_payment` varchar(255) DEFAULT NULL,
  `date_of_import` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_payments` */

insert  into `tbl_payments`(`id`,`transaction_id`,`amount_paid`,`date_of_payment`,`date_of_import`,`status`) values (1,'20219-000008','250.00','2020-12-03','2021-09-29 20:25:26','pending');

/*Table structure for table `tbl_request_transactions` */

DROP TABLE IF EXISTS `tbl_request_transactions`;

CREATE TABLE `tbl_request_transactions` (
  `request_transactions_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `account_code` varchar(255) DEFAULT NULL,
  `quantity_of_unit` decimal(11,2) DEFAULT NULL,
  `no_of_copies` int(11) DEFAULT NULL,
  `amount` decimal(63,2) NOT NULL,
  PRIMARY KEY (`request_transactions_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_request_transactions` */

insert  into `tbl_request_transactions`(`request_transactions_id`,`transaction_id`,`account_code`,`quantity_of_unit`,`no_of_copies`,`amount`) values (1,'20218-000001','628ENTD','1.00',2,'0.00'),(2,'20218-000001','613CLST','1.00',1,'0.00'),(3,'20218-000001','628COCM','1.00',1,'0.00'),(10,'20218-000002','628COCM','1.00',1,'5000.00'),(11,'20219-000003','628ENTD','2.00',2,'200.00'),(8,'20218-000002','613CLST','1.00',1,'50.00'),(9,'20218-000002','628ENTD','2.00',2,'200.00'),(12,'20219-000003','628ID','1.00',1,'150.00'),(13,'20219-000004','613CLST','1.00',1,'0.00'),(14,'20219-000005','613CLST','1.00',1,'50.00'),(15,'20219-000006','439SEMRC','1.00',1,'5000.00'),(16,'20219-000007','439SEMRC','1.00',1,'0.00'),(17,'20219-000008','613CLST','1.00',2,'100.00'),(18,'20219-000008','628ENTD','3.00',1,'150.00');

/*Table structure for table `tbl_requests` */

DROP TABLE IF EXISTS `tbl_requests`;

CREATE TABLE `tbl_requests` (
  `transaction_id` varchar(255) NOT NULL,
  `requestor_id` text,
  `amount_to_pay` decimal(63,2) NOT NULL,
  `amount_paid` decimal(63,2) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `remarks` text,
  `transaction_office_id` int(11) DEFAULT NULL,
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `accepted_date` varchar(100) DEFAULT NULL,
  `payment_date` varchar(100) DEFAULT NULL,
  `reason_of_decline` text,
  PRIMARY KEY (`transaction_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `tbl_requests` */

insert  into `tbl_requests`(`transaction_id`,`requestor_id`,`amount_to_pay`,`amount_paid`,`year`,`remarks`,`transaction_office_id`,`transaction_date`,`accepted_date`,`payment_date`,`reason_of_decline`) values ('20218-000001','1','0.00',NULL,2021,'Declined',1,'2021-08-31 06:34:59',NULL,NULL,'This transaction is not available.'),('20218-000002','1','5250.00',NULL,2021,'Accepted',1,'2021-08-31 06:45:32','2021-08-31 14:57:31',NULL,NULL),('20219-000003','1','350.00',NULL,2021,'Accepted',1,'2021-09-01 06:14:24','2021-09-01 14:16:44',NULL,NULL),('20219-000004','1','0.00',NULL,2021,'Declined',1,'2021-09-01 06:17:17',NULL,NULL,'asd'),('20219-000005','6','50.00',NULL,2021,'Accepted',1,'2021-09-21 01:47:07','2021-09-21 09:52:27',NULL,NULL),('20219-000006','6','5000.00',NULL,2021,'Accepted',4,'2021-09-21 02:13:43','2021-09-21 10:15:06',NULL,NULL),('20219-000007','6','0.00',NULL,2021,'Declined',4,'2021-09-21 02:30:50',NULL,NULL,'Unavailable'),('20219-000008','1','250.00',NULL,2021,'Accepted',1,'2021-09-29 19:24:50','2021-09-30 03:46:03',NULL,NULL);

/*Table structure for table `tbl_transactions` */

DROP TABLE IF EXISTS `tbl_transactions`;

CREATE TABLE `tbl_transactions` (
  `account_code` varchar(255) DEFAULT NULL,
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

insert  into `tbl_transactions`(`account_code`,`description`,`amount`,`unit`,`transaction_type`,`category`,`unit_inputted_by`,`no_of_copy`,`office_id`,`note`,`remarks`,`date_added`) values ('613CLST','Checklist','50.00',NULL,'Fixed','Document','Office','YES',1,'This is checklist.','active','2021-07-27 03:16:16'),('628ENTD','Entrance Data','50.00','per page','Fixed With Unit','Document','Office','YES',1,'This is Entrance Data','active','2021-07-27 03:17:15'),('648LDRY','Laundry','25.00','per kilo','Fixed With Unit','Service','Office','NO',3,'This is Laundry','active','2021-07-27 03:17:42'),('439SEMRC','Seminar Workshop on Action Research Capability Building for Classroom Teachers',NULL,NULL,'Variable','Service','Office','NO',4,'This is seminar','active','2021-07-28 21:37:34'),('628ID','University ID - CTL','150.00',NULL,'Fixed','Service','Office','NO',1,'This is ID','active','2021-07-28 22:04:44');

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

insert  into `vstudinfo`(`StudNo`,`LName`,`GName`,`MName`,`Email`) values ('1','1','BRYAN LESTER','DE JULIAN','tamares.bld@pnu.edu.ph'),('G201210549','DELA CRUZ','JUAN',NULL,'delacruz.j@pnu.edu.ph'),('G2001','DELA CRUZ','JUAN',NULL,'delacruz.j@pnu.edu.ph');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
