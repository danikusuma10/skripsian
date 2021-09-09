/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.14-MariaDB : Database - danimasu_payment
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`danimasu_payment` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `danimasu_payment`;

/*Table structure for table `bulan` */

DROP TABLE IF EXISTS `bulan`;

CREATE TABLE `bulan` (
  `id_bulan` int(10) NOT NULL,
  `bulan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bulan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `bulan` */

/*Table structure for table `datapembayaran` */

DROP TABLE IF EXISTS `datapembayaran`;

CREATE TABLE `datapembayaran` (
  `id_transaksi` varchar(100) NOT NULL,
  `nis` int(20) NOT NULL,
  `id_bulan` int(100) NOT NULL,
  `id_tahun` int(100) NOT NULL,
  `tanggal_bayar` int(100) NOT NULL,
  `id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `datapembayaran` */

/*Table structure for table `hapus_transaksi` */

DROP TABLE IF EXISTS `hapus_transaksi`;

CREATE TABLE `hapus_transaksi` (
  `id` varchar(255) DEFAULT NULL,
  `id_transaksi` varchar(255) DEFAULT NULL,
  `transaksi` varchar(255) DEFAULT NULL,
  `nis` varchar(255) DEFAULT NULL,
  `tahun_ajaran` varchar(255) DEFAULT NULL,
  `id_bulan` varchar(255) DEFAULT NULL,
  `id_tahun` varchar(255) DEFAULT NULL,
  `tanggal_bayar` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `hapus_transaksi` */

/*Table structure for table `jurnal` */

DROP TABLE IF EXISTS `jurnal`;

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaksi` (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `jurnal` */

insert  into `jurnal`(`id`,`id_transaksi`,`keterangan`,`tgl_transaksi`) values (3,'28032021-1101','DANA BOS ','2021-03-28 00:00:00'),(4,'05042021-6175','donsi','2021-04-05 00:00:00');

/*Table structure for table `jurnal_detail` */

DROP TABLE IF EXISTS `jurnal_detail`;

CREATE TABLE `jurnal_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jurnal` varchar(255) DEFAULT NULL,
  `kredit` int(255) DEFAULT NULL,
  `debit` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jurnal` (`id_jurnal`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jurnal_detail` */

insert  into `jurnal_detail`(`id`,`id_jurnal`,`kredit`,`debit`) values (1,'3',0,200000000),(2,'4',0,80000000);

/*Table structure for table `kas` */

DROP TABLE IF EXISTS `kas`;

CREATE TABLE `kas` (
  `id_transaksi` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `tipe_kas` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nominal` int(255) DEFAULT NULL,
  `tgl_transaksi` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `kas` */

insert  into `kas`(`id_transaksi`,`tipe_kas`,`keterangan`,`nominal`,`tgl_transaksi`) values ('28032021-6020','masuk','DANA BOS ',90000000,'2021-03-28 00:00:00'),('28032021-2623','masuk','Dana',1222222222,'2021-03-28 00:00:00'),('28032021-4465','masuk','DANA BOS ',80000000,'2021-03-28 00:00:00'),('28032021-1362','masuk','bayar spp',200000000,'2021-03-28 00:00:00'),('28032021-7112','masuk','DANA BOS ',200000000,'2021-03-28 00:00:00'),('28032021-2533','masuk','utang',200000,'2021-03-28 00:00:00'),('28032021-1792','keluar','Beli Komputer Asus',200000000,'2021-03-28 00:00:00'),('28032021-3928','keluar','bayar spp',20000000,'2021-03-28 00:00:00'),('28032021-5249','masuk','Dana BOS',20000000,'2021-03-28 00:00:00'),('28032021-6646','masuk','utang',200000,'2021-03-28 00:00:00'),('28032021-1389','masuk','bayar spp',1500000,'2021-03-28 00:00:00'),('28032021-6226','keluar','Dana BOS',200000000,'2021-03-28 00:00:00'),('28032021-1101','masuk','DANA BOS ',200000000,'2021-03-28 00:00:00'),('05042021-6175','masuk','donsi',80000000,'2021-04-05 00:00:00');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(128) NOT NULL,
  `id_kurikulum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kelas` */

insert  into `kelas`(`id`,`nama_kelas`,`id_kurikulum`) values (1,'Kelas X - TEI',1),(2,'Kelas XI - TEI',1),(3,'Kelas XII - TEI',1),(4,'Kelas X - TKJ',1),(5,'Kelas XI - TKJ',1),(6,'Kelas XII - TKJ',1),(7,'Kelas X - TKR',1),(8,'Kelas XI - TKR',1),(9,'Kelas XII - TKR',1),(10,'X TFL',1),(11,'X TFL',3);

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nis` int(100) DEFAULT NULL,
  `nama_siswa` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(2) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp_siswa` decimal(10,0) DEFAULT NULL,
  `id_tahun` int(20) DEFAULT NULL,
  `role_id` int(20) DEFAULT NULL,
  `is_active` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `siswa` */

insert  into `siswa`(`id`,`nis`,`nama_siswa`,`jenis_kelamin`,`alamat`,`no_hp_siswa`,`id_tahun`,`role_id`,`is_active`) values (1,201701027,'Dani Al','la','kalikidang Rt1/1',815420202,2,2,1),(2,2017010290,'Dani Alfida Kusuma','la','banjar',81828,2,2,1),(3,2147483647,'wqwq','pe','wqwq',123123,2,2,0),(4,2147483647,'Ganjil','la','Kab.banyumas Kec.sokaraja Ds.kalikidang No.10',9999999999,1,2,1),(5,2147483647,'Danixese','la','banjar',81828,2,2,1);

/*Table structure for table `tahun_ajaran` */

DROP TABLE IF EXISTS `tahun_ajaran`;

CREATE TABLE `tahun_ajaran` (
  `no` int(100) NOT NULL,
  `id_tahun` int(100) NOT NULL,
  `tahun_ajaran` int(100) NOT NULL,
  `besar_spp` int(100) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tahun_ajaran` */

insert  into `tahun_ajaran`(`no`,`id_tahun`,`tahun_ajaran`,`besar_spp`) values (0,2,2021,250000),(1,1,2020,200000),(3,3,2022,300000);

/*Table structure for table `tahun_aktif` */

DROP TABLE IF EXISTS `tahun_aktif`;

CREATE TABLE `tahun_aktif` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `nis` int(100) NOT NULL,
  `id_tahun` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tahun_aktif` */

insert  into `tahun_aktif`(`id`,`nis`,`id_tahun`) values (1,2017010290,2);

/*Table structure for table `tbl_requesttransaksi` */

DROP TABLE IF EXISTS `tbl_requesttransaksi`;

CREATE TABLE `tbl_requesttransaksi` (
  `order_id` int(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kelas` varchar(255) DEFAULT NULL,
  `gross_amount` int(255) DEFAULT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `va_number` decimal(65,0) DEFAULT NULL,
  `transaction_time` datetime DEFAULT NULL,
  `settlement_time` datetime DEFAULT NULL,
  `bill_key` varchar(255) DEFAULT NULL,
  `biller_code` varchar(255) DEFAULT NULL,
  `transaction_status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_requesttransaksi` */

insert  into `tbl_requesttransaksi`(`order_id`,`nama`,`kelas`,`gross_amount`,`payment_type`,`bank`,`va_number`,`transaction_time`,`settlement_time`,`bill_key`,`biller_code`,`transaction_status`) values (428274138,'Hengky Wijaya','XI TEKNIK ELEKTRONIKA INDUSTRI',600000,'echannel','-',0,'2021-04-04 16:38:55',NULL,'650971792623','70012','pending'),(2017873280,'jh','XI TEKNIK FABRIKASI LOGAM',450000,'qris','-',0,'2021-04-04 16:23:44',NULL,'-','-','pending');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(100) NOT NULL,
  `nis` int(100) NOT NULL,
  `id_bulan` int(100) NOT NULL,
  `id_tahun` int(100) NOT NULL,
  `tanggal_bayar` int(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi` */

/*Table structure for table `tunggakan` */

DROP TABLE IF EXISTS `tunggakan`;

CREATE TABLE `tunggakan` (
  `id` int(100) NOT NULL,
  `nis` int(100) NOT NULL,
  `id_tahun` int(100) NOT NULL,
  `tunggakan` int(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tunggakan` */

insert  into `tunggakan`(`id`,`nis`,`id_tahun`,`tunggakan`) values (0,2017010290,2,3000000);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `image` blob DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT 0,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`email`,`image`,`password`,`role_id`,`is_active`,`date_created`) values (9,'DANI ALFIDA KUSUMA','dani@gmail.com','1616831925217.jpg','$2y$10$wBhaqNFdc.EXMo7BpQ8ZUe5SngzezWlm8/S3/1ba6bnv7n1.vN2ha',1,1,1616831925),(31,'NANING S.Kom','naning@gmail.com','1616831287435.jpg','$2y$10$xqIlVA.hBM0jIGYhdHqdWe1KhZfGLZj32wuX2zej6oNXtzKmuvRDu',2,1,1616817152),(33,'DANI KUSUMA. S.Kom','danikusumaelektro@gmail.com','1616831287435.jpg','$2y$10$wBhaqNFdc.EXMo7BpQ8ZUe5SngzezWlm8/S3/1ba6bnv7n1.vN2ha',1,1,1616817170),(34,'assssssssssss','asssssssssssssssn@email.com','1616831060556.jpg','$2y$10$7OM7ZCSnQKvcLw7amq97bek4eabcL04PgIopEuLxGCNyq.kaeLXmG',1,0,1616831060),(35,'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz','zzzzzzzzzzzzzzzzzzzzzz@email.com','1616831287435.jpg','$2y$10$dtakGp7rob6ot0Wx5PokCeN0fMtPZ3NuFcMTXlGuVNae0Sri0313O',1,1,1616831287),(36,'sdgdfd','admin@email.com','1.PNG','$2y$10$GSk2cQu.y3Gi3cuVr4ProOYL5J/b6pjPaja7cZfUA7pycStNPySKy',1,1,1616833546),(37,'sdgdfd','admin@email.com','1.PNG','$2y$10$XdQq7j7UWFADHLjGBgn7a.EoJX6FdgIuzr74aY0lsQkT.nMKt06Xu',2,1,1616832398),(43,'zzzzzz','dani.kusuma@stikomyos.ac.id','default.jpg','$2y$10$WlqFEbSJZQu3fY7xEY1qROEJAoRRn7AJZotjbsD6C5dO/dR0b5xri',1,0,1617891638),(44,'Dani','babang@gmail.com','default.jpg','$2y$10$Hzcul38Vo7bQGq6OriLv7eA2Jw1vVK/lFLQhqJCHv511phAuNoCCy',1,0,1617892014),(45,'Kocakkacd@gmail.coms','kocakkacd@gmail.coms','default.jpg','$2y$10$luMjAZLxVToF7HsT/kAsaeBLCYdiplTZjAnHUkalX2gFABNd8HkGG',1,0,1617896999);

/*Table structure for table `user_access_menu` */

DROP TABLE IF EXISTS `user_access_menu`;

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_access_menu` */

insert  into `user_access_menu`(`id`,`role_id`,`menu_id`) values (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7);

/*Table structure for table `user_menu` */

DROP TABLE IF EXISTS `user_menu`;

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_menu` */

insert  into `user_menu`(`id`,`menu`) values (1,'admin'),(2,'transaksi masuk'),(3,'siswa'),(5,'kas jurnal umum'),(6,'user'),(7,'settings');

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role` */

insert  into `user_role`(`id`,`role`) values (1,'Administrator'),(2,'Member'),(3,'Kepala');

/*Table structure for table `user_sub_menu` */

DROP TABLE IF EXISTS `user_sub_menu`;

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_sub_menu` */

/*Table structure for table `user_token` */

DROP TABLE IF EXISTS `user_token`;

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_token` */

insert  into `user_token`(`id`,`email`,`token`,`date_created`) values (2,'kusumadanikusuma@outlook.com','EEyUJYo80j+B4hqCTiFhytsyi1C3vNxfIW67HHnUHcA=',1617889604),(5,'babang@gmail.com','HxsdVXRLqiVQM2a/axjwVXRJC9Jv+WEmINAqe0I3GB4=',1617892014),(6,'kocakkacd@gmail.coms','gD5DSJEWlolnAIiDfUscaKibZeVmGEQRxV/mNLmJgc4=',1617896999);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
