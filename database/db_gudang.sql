# Host: localhost  (Version 5.7.33)
# Date: 2021-11-10 17:45:47
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "is_barang_keluar"
#

DROP TABLE IF EXISTS `is_barang_keluar`;
CREATE TABLE `is_barang_keluar` (
  `id_barang_keluar` varchar(15) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `no_doc` varchar(50) DEFAULT NULL,
  `id_barang` varchar(7) NOT NULL,
  `id_gudang` int(11) NOT NULL DEFAULT '0',
  `id_rak` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `status` enum('Proses','Approve','Reject') NOT NULL DEFAULT 'Proses',
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_barang_keluar`),
  KEY `id_barang` (`id_barang`),
  KEY `created_user` (`created_user`),
  CONSTRAINT `is_barang_keluar_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_keluar_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "is_barang_keluar"
#

INSERT INTO `is_barang_keluar` VALUES ('TK-2021-0000001','2021-11-09',NULL,'B000001',1,1,2,'Approve',1,'2021-11-09 21:09:28'),('TK-2021-0000002','2021-11-09',NULL,'B000001',1,1,2,'Approve',1,'2021-11-09 21:09:31'),('TK-2021-0000003','2021-11-09',NULL,'B000002',1,1,15,'Reject',3,'2021-11-09 21:05:29'),('TK-2021-0000004','2021-11-09',NULL,'B000001',1,1,1,'Proses',3,'2021-11-09 21:04:17');

#
# Structure for table "is_gudang"
#

DROP TABLE IF EXISTS `is_gudang`;
CREATE TABLE `is_gudang` (
  `id_gudang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_gudang` varchar(50) NOT NULL,
  `nama_gudang` varchar(100) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_gudang`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "is_gudang"
#

INSERT INTO `is_gudang` VALUES (1,'GD001','gudang 1',1,'2021-11-03 13:05:25',1,'2021-11-04 00:05:26'),(2,'GD002','gudang 2',1,'2021-11-03 13:05:31',1,'2021-11-04 00:05:32');

#
# Structure for table "is_rak"
#

DROP TABLE IF EXISTS `is_rak`;
CREATE TABLE `is_rak` (
  `id_rak` int(11) NOT NULL AUTO_INCREMENT,
  `id_gudang` int(11) DEFAULT NULL,
  `kode_rak` varchar(50) NOT NULL,
  `nama_rak` varchar(100) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "is_rak"
#

INSERT INTO `is_rak` VALUES (1,1,'RK001','rak 1',1,'2021-11-03 13:05:41',1,'2021-11-04 00:05:43'),(2,2,'RK002','rak 2',1,'2021-11-03 13:05:48',1,'2021-11-04 00:05:46'),(3,1,'RK003','rak 3',1,'2021-11-03 21:21:25',1,'2021-11-04 00:05:50'),(4,1,'RK004','rak 4',1,'2021-11-03 21:21:33',1,'2021-11-06 23:20:27'),(5,NULL,'RK005','rak5 5',1,'2021-11-06 23:20:22',1,'2021-11-10 09:43:02');

#
# Structure for table "is_users"
#

DROP TABLE IF EXISTS `is_users`;
CREATE TABLE `is_users` (
  `id_user` smallint(6) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `hak_akses` enum('Super Admin','Manajer','Gudang') NOT NULL,
  `status` enum('aktif','blokir') NOT NULL DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  KEY `level` (`hak_akses`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "is_users"
#

INSERT INTO `is_users` VALUES (1,'admin','Rizald','202cb962ac59075b964b07152d234b70','rizal@gmail.com','0856515662312','client.png','Super Admin','aktif','2016-05-01 15:42:53','2021-11-03 13:05:11'),(2,'manajer','Don','202cb962ac59075b964b07152d234b70','don@gmail.com','0817845645645','kadina.png','Manajer','aktif','2016-08-01 15:42:53','2020-07-29 02:12:47'),(3,'gudang','Jan','202cb962ac59075b964b07152d234b70','jan@gmail.com','0565645645646','1469574126_users-10.png','Gudang','aktif','2017-03-11 21:41:46','2020-07-29 02:20:36');

#
# Structure for table "is_satuan"
#

DROP TABLE IF EXISTS `is_satuan`;
CREATE TABLE `is_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_satuan` varchar(30) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_satuan`),
  KEY `created_user` (`created_user`),
  KEY `updated_user` (`updated_user`),
  CONSTRAINT `is_satuan_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_satuan_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

#
# Data for table "is_satuan"
#

INSERT INTO `is_satuan` VALUES (1,'Gram',3,'2017-03-12 09:57:35',3,'2017-03-12 09:57:45'),(2,'Kilogram',3,'2017-03-12 09:58:07',3,'2017-03-12 09:59:01'),(3,'Meter',3,'2017-03-12 09:58:19',3,'2017-03-12 09:59:04'),(4,'Liter',3,'2017-03-12 09:58:25',3,'2017-03-12 09:59:08'),(5,'Botol',3,'2017-03-12 09:58:36',3,'2017-03-12 09:59:10'),(6,'Lebar',3,'2017-03-12 09:58:46',3,'2017-03-12 09:59:13'),(7,'Tabung',3,'2017-03-12 09:58:52',3,'2017-03-12 09:59:16');

#
# Structure for table "is_jenis_barang"
#

DROP TABLE IF EXISTS `is_jenis_barang`;
CREATE TABLE `is_jenis_barang` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(50) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jenis`),
  KEY `created_user` (`created_user`),
  KEY `updated_user` (`updated_user`),
  CONSTRAINT `is_jenis_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_jenis_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

#
# Data for table "is_jenis_barang"
#

INSERT INTO `is_jenis_barang` VALUES (1,'Pupuk Kimia Alam',3,'2017-03-12 09:59:45',3,'2017-03-12 10:01:03'),(2,'Pupuk Hijau',3,'2017-03-12 09:59:58',3,'2017-03-12 10:01:06'),(3,'Herbisida',3,'2017-03-12 10:00:08',3,'2017-03-12 10:01:10'),(4,'Fungisida',3,'2017-03-12 10:00:19',3,'2017-03-12 10:01:13'),(5,'Insektisida',3,'2017-03-12 10:00:29',3,'2017-03-12 10:01:16'),(6,'Bahan Stimulasi',3,'2017-03-12 10:00:39',3,'2017-03-12 10:01:19'),(7,'Bahan Kimia Pengolahan',3,'2017-03-12 10:00:49',3,'2017-03-12 10:01:22'),(8,'Pupuk Kompos',1,'2020-07-29 02:14:16',1,'2020-07-29 02:14:16'),(9,'Pupuk Kandang',1,'2020-07-29 02:14:24',1,'2020-07-29 02:14:24'),(10,'Pupuk OR',1,'2020-07-29 02:14:39',1,'2020-07-29 02:14:39');

#
# Structure for table "is_barang"
#

DROP TABLE IF EXISTS `is_barang`;
CREATE TABLE `is_barang` (
  `id_barang` varchar(7) NOT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_user` smallint(6) NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_barang`),
  KEY `id_jenis` (`id_jenis`),
  KEY `id_satuan` (`id_satuan`),
  KEY `created_user` (`created_user`),
  KEY `updated_user` (`updated_user`),
  CONSTRAINT `is_barang_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_ibfk_2` FOREIGN KEY (`updated_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_ibfk_3` FOREIGN KEY (`id_satuan`) REFERENCES `is_satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_ibfk_4` FOREIGN KEY (`id_jenis`) REFERENCES `is_jenis_barang` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "is_barang"
#

INSERT INTO `is_barang` VALUES ('B000001',NULL,'Pupuk Pulkalet',1,2,110,3,'2017-03-12 23:31:31',3,'2021-11-10 11:51:17'),('B000002',NULL,'Pupuk Dolomite',1,2,15,3,'2017-03-12 23:31:48',3,'2021-11-09 21:05:29'),('B000005',NULL,'Amonia Cair',7,4,0,3,'2017-03-12 23:32:42',3,'2021-11-09 19:16:05'),('B000008','pupu-pb','Pupuk Paket B',3,2,0,3,'2020-06-10 14:31:12',1,'2021-11-10 10:32:12'),('B000009','SRG-65','srg',10,1,0,1,'2021-11-10 10:33:38',1,'2021-11-10 10:33:38');

#
# Structure for table "is_barang_masuk"
#

DROP TABLE IF EXISTS `is_barang_masuk`;
CREATE TABLE `is_barang_masuk` (
  `id_barang_masuk` varchar(15) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `no_doc` varchar(50) NOT NULL,
  `id_barang` varchar(7) NOT NULL,
  `id_gudang` int(11) NOT NULL DEFAULT '0',
  `id_rak` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `created_user` smallint(6) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_barang_masuk`),
  KEY `id_barang` (`id_barang`),
  KEY `created_user` (`created_user`),
  CONSTRAINT `is_barang_masuk_ibfk_1` FOREIGN KEY (`created_user`) REFERENCES `is_users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `is_barang_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `is_barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "is_barang_masuk"
#

INSERT INTO `is_barang_masuk` VALUES ('TM-2021-0000001','2021-11-10','BM-2021-11-00001','B000001',1,1,10,1,'2021-11-10 11:49:31'),('TM-2021-0000002','2021-11-10','BM-2021-11-00002','B000001',1,1,5,1,'2021-11-10 11:51:16'),('TM-2021-0000003','2021-11-10','BM-2021-11-00002','B000001',1,1,5,1,'2021-11-10 11:51:17');
