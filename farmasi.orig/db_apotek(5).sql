-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jul 06, 2011 at 08:35 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `db_apotek`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `admin`
-- 

CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `jns_kel` varchar(1) NOT NULL,
  `kode` varchar(1) NOT NULL,
  `ket` varchar(25) NOT NULL,
  `status_aktivasi` varchar(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `admin`
-- 

INSERT INTO `admin` VALUES (1, 'angga', 'anggara suci nugraha', '8479c86c7afcb56631104f5ce5d6de62', 'L', '1', 'Admin', '1');
INSERT INTO `admin` VALUES (2, 'yui', 'yui aora', '4eff0335928a2d0e92f38ea9bb56d72b', 'P', '2', 'Apoteker', '1');
INSERT INTO `admin` VALUES (3, 'hyde', 'hyde takarai', 'c597ea1ed1948f1a6ef867787ea1772b', 'L', '3', 'Kasir', '0');
INSERT INTO `admin` VALUES (4, 'nani', 'nani nani', '02ea2ae2a237c042285e093e6972eaa9', 'P', '3', 'Kasir', '0');
INSERT INTO `admin` VALUES (5, 'gara', 'gara', '04b7aaeab58d4c6507e86a90250694af', 'P', '3', 'Kasir', '1');
INSERT INTO `admin` VALUES (6, '234', '234Lovers', '25d55ad283aa400af464c76d713c07ad', 'L', '2', 'Apoteker', '0');

-- --------------------------------------------------------

-- 
-- Table structure for table `apotik`
-- 

CREATE TABLE `apotik` (
  `id` int(11) NOT NULL auto_increment,
  `kd_barang` varchar(20) NOT NULL,
  `jml` float(9,2) NOT NULL,
  `harga` float(9,2) NOT NULL,
  `F` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `apotik`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `barang_unit`
-- 

CREATE TABLE `barang_unit` (
  `id` int(11) NOT NULL auto_increment,
  `barang_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `stok` float(9,2) NOT NULL,
  `min_stok` float(9,2) NOT NULL,
  `max_stok` float(9,2) NOT NULL,
  `flags` bit(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  `expire_date` varchar(10) NOT NULL,
  `ex_date` int(2) NOT NULL,
  `ex_month` int(2) NOT NULL,
  `ex_year` int(4) NOT NULL,
  PRIMARY KEY  (`id`,`barang_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `barang_unit`
-- 

INSERT INTO `barang_unit` VALUES (10, 6, 2, 0.00, 10.00, 100.00, '', '2011-07-02 07:52:59', 'UAPT', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);
INSERT INTO `barang_unit` VALUES (9, 1, 2, 1.00, 10.00, 50.00, '', '2011-07-02 07:50:15', 'UAPT', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);
INSERT INTO `barang_unit` VALUES (8, 5, 2, 1.00, 10.00, 100.00, '', '2011-07-02 07:38:30', 'UAPT', '2011-07-02 07:38:33', 'UAPT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);
INSERT INTO `barang_unit` VALUES (11, 43, 51, 54.00, 10.00, 100.00, '', '2011-07-05 00:21:32', 'RTR', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12-12-2011', 12, 12, 2011);
INSERT INTO `barang_unit` VALUES (12, 44, 2, 24.00, 50.00, 500.00, '', '2011-07-05 21:27:10', 'UAPT', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);
INSERT INTO `barang_unit` VALUES (13, 21, 2, 3.00, 102.00, 9999.00, '', '2011-07-06 03:27:44', 'UAPT', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);
INSERT INTO `barang_unit` VALUES (14, 44, 51, 22.00, 50.00, 500.00, '', '2011-07-06 03:55:44', 'UIGD', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);
INSERT INTO `barang_unit` VALUES (15, 44, 52, 7.00, 50.00, 500.00, '', '2011-07-06 04:44:28', 'UOCA', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);
INSERT INTO `barang_unit` VALUES (16, 5, 4, 20.00, 10.00, 100.00, '', '2011-07-06 04:57:14', 'angga', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `bayar`
-- 

CREATE TABLE `bayar` (
  `id` int(15) NOT NULL auto_increment,
  `no_transaksi` varchar(20) NOT NULL,
  `bayar` float(9,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `bayar`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `detail_spb`
-- 

CREATE TABLE `detail_spb` (
  `id` int(11) NOT NULL auto_increment,
  `spb_no` varchar(50) NOT NULL,
  `barang_id` varchar(20) NOT NULL,
  `req_stock` float(9,2) NOT NULL default '0.00',
  `harga` float(14,2) NOT NULL default '0.00',
  `subtotal` float(14,2) NOT NULL default '0.00',
  `status_approval` char(3) NOT NULL,
  `is_po` int(1) NOT NULL,
  `flags` int(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(50) NOT NULL,
  `fld00` varchar(255) NOT NULL,
  `fld01` varchar(255) NOT NULL,
  `fld02` varchar(255) NOT NULL,
  `fld03` varchar(255) NOT NULL,
  `fld04` varchar(255) NOT NULL,
  `fld05` varchar(255) NOT NULL,
  `fld06` varchar(255) NOT NULL,
  `fld07` varchar(255) NOT NULL,
  `fld08` varchar(255) NOT NULL,
  `fld09` varchar(255) NOT NULL,
  `fld10` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- Dumping data for table `detail_spb`
-- 

INSERT INTO `detail_spb` VALUES (1, 'SPB/2506110001', '2', 80.00, 30000.00, 2400000.00, 'PR', 1, 1, '2011-06-25 05:20:23', 'JL', '0000-00-00 00:00:00', 'JL', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (2, 'SPB/2506110001', '3', 80.00, 30000.00, 2400000.00, 'PR', 1, 1, '2011-06-25 05:20:23', 'JL', '0000-00-00 00:00:00', 'JL', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (3, 'SPB/2506110001', '4', 80.00, 20000.00, 1600000.00, 'PR', 1, 1, '2011-06-25 05:20:23', 'JL', '0000-00-00 00:00:00', 'JL', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (10, 'SPB/2806110008', '31', 200.00, 3000.00, 600000.00, 'PR', 1, 1, '2011-06-28 04:34:45', 'Jalu', '2011-06-28 04:34:45', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (11, 'SPB/2806110008', '32', 300.00, 5000.00, 1500000.00, 'PR', 1, 1, '2011-06-28 04:34:45', 'Jalu', '2011-06-28 04:34:45', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (12, 'SPB/2806110008', '34', 400.00, 700.00, 280000.00, 'PR', 1, 1, '2011-06-28 04:34:45', 'Jalu', '2011-06-28 04:34:45', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (13, 'SPB/2806110008', '38', 500.00, 67700.00, 33850000.00, 'PR', 1, 1, '2011-06-28 04:34:45', 'Jalu', '2011-06-28 04:34:45', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (14, 'SPB/2806110008', '40', 500.00, 800.00, 400000.00, 'PR', 1, 1, '2011-06-28 04:34:45', 'Jalu', '2011-06-28 04:34:45', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (15, 'SPB/2806110022', '31', 200.00, 3000.00, 600000.00, 'PR', 1, 1, '2011-06-28 18:48:09', 'Jalu', '2011-06-28 18:48:09', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (16, 'SPB/2806110022', '41', 332.00, 569.00, 188908.00, 'PR', 1, 1, '2011-06-28 18:48:09', 'Jalu', '2011-06-28 18:48:09', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (17, 'SPB/0207110033', '35', 150.00, 800.00, 120000.00, 'PR', 1, 1, '2011-07-02 04:29:15', 'Jalu', '2011-07-05 19:35:08', 'JalU', '1', '8', 'PON/0207110007', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (18, 'SPB/0207110033', '36', 100.00, 90890.00, 9089000.00, 'PR', 1, 1, '2011-07-02 04:29:15', 'Jalu', '2011-07-05 19:35:08', 'JalU', '1', '8', 'PON/0207110007', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (19, 'SPB/0207110033', '37', 50.00, 99800.00, 4990000.00, 'PR', 1, 1, '2011-07-02 04:29:15', 'Jalu', '2011-07-05 19:35:08', 'JalU', '1', '8', 'PON/0207110007', '', '', '', '', '', '', '', '');
INSERT INTO `detail_spb` VALUES (20, 'SPB/0207110034', '39', 90.00, 98990.00, 8909100.00, 'PR', 0, 1, '2011-07-02 04:41:17', 'Jalu', '2011-07-02 04:41:17', 'Jalu', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `dokter`
-- 

CREATE TABLE `dokter` (
  `id` tinyint(3) NOT NULL auto_increment,
  `subspesialisasi_id` tinyint(3) default NULL,
  `nama` varchar(50) default NULL,
  `alamat` varchar(50) default NULL,
  `telp` varchar(20) default NULL,
  `aktif` enum('0','1') default '1',
  PRIMARY KEY  (`id`),
  KEY `subspesialisasi_id` (`subspesialisasi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

-- 
-- Dumping data for table `dokter`
-- 

INSERT INTO `dokter` VALUES (5, 10, 'Heru Prajadmo, dr., Sp. OG', '', '', '1');
INSERT INTO `dokter` VALUES (6, 10, 'Budiono, dr., Sp. OG', '', '', '1');
INSERT INTO `dokter` VALUES (7, 10, 'Ahmad Hidayat, dr., Sp. OG', '', '', '1');
INSERT INTO `dokter` VALUES (8, 12, 'Sasmito N, dr., Sp. A', '', '', '1');
INSERT INTO `dokter` VALUES (10, 10, 'Sulistyarini Retnowati, dr., Sp. OG', '', '', '1');
INSERT INTO `dokter` VALUES (11, 15, 'Nurdwi Esti, dr., Sp. J', '', '', '1');
INSERT INTO `dokter` VALUES (12, 14, 'Sunaryanto, dr., SP.THT', '', '', '1');
INSERT INTO `dokter` VALUES (13, 14, 'M. Ghofur, dr., Sp. THT', '', '', '1');
INSERT INTO `dokter` VALUES (14, 9, 'Agustini, dr., Sp. M', '', '', '1');
INSERT INTO `dokter` VALUES (15, 1, 'Sumardi, dr., Sp. PD', '', '', '1');
INSERT INTO `dokter` VALUES (16, 1, 'Yuli Armini, dr., Sp. PD', '', '', '1');
INSERT INTO `dokter` VALUES (17, 1, 'Neneng R, dr., Sp. PD', '', '', '1');
INSERT INTO `dokter` VALUES (18, 1, 'Iri Kuswadi, dr., Sp. PD', '', '', '1');
INSERT INTO `dokter` VALUES (19, 8, 'Agus Mulato, dr., Sp. BM', '', '', '1');
INSERT INTO `dokter` VALUES (20, 7, 'Dhananto, drg', '', '', '1');
INSERT INTO `dokter` VALUES (21, 7, 'Budi Setyowati, drg', '', '', '1');
INSERT INTO `dokter` VALUES (22, 7, 'Soebiono, drg', '', '', '1');
INSERT INTO `dokter` VALUES (23, 7, 'Prasasti, drg', '', '', '1');
INSERT INTO `dokter` VALUES (24, 3, 'Marijoto, dr., Sp. BD', '', '', '1');
INSERT INTO `dokter` VALUES (25, 5, 'Kuncahyo, dr., Sp. BO', '', '', '1');
INSERT INTO `dokter` VALUES (26, 4, 'Supomo, dr., Sp. BT', '', '', '1');
INSERT INTO `dokter` VALUES (27, 2, 'Agung, dr., Sp. B', '', '', '1');
INSERT INTO `dokter` VALUES (28, 5, 'Sugeng Y, dr., Sp. BO', '', '', '1');
INSERT INTO `dokter` VALUES (29, 2, 'Aburawas, dr., Sp. B', '', '', '1');
INSERT INTO `dokter` VALUES (30, 2, 'Adam, dr., Sp. B', '', '', '1');
INSERT INTO `dokter` VALUES (31, 2, 'Agus B, dr., Sp. BD', '', '', '1');
INSERT INTO `dokter` VALUES (32, 6, 'A. Mahmudi, dr., Sp. BA', '', '', '1');
INSERT INTO `dokter` VALUES (33, 2, 'Suryo H, dr., Sp. B', '', '', '1');
INSERT INTO `dokter` VALUES (34, 13, 'Sugiantini, dr., Sp.KK', '', '', '1');
INSERT INTO `dokter` VALUES (35, 13, 'Dwi Rini Marganingsih, dr., M. Kes, Sp. KK', '', '', '1');
INSERT INTO `dokter` VALUES (36, 11, 'Ana Budi Z, dr., Sp.S', '', '', '1');
INSERT INTO `dokter` VALUES (37, 12, 'Anik Dwiani, dr., Sp.A', '', '', '1');
INSERT INTO `dokter` VALUES (38, 12, 'Syarmarini Larasati, dr., Sp. A, M. Kes', '', '', '1');
INSERT INTO `dokter` VALUES (39, 12, 'Sutrisno, dr., SP.A', '', '', '1');
INSERT INTO `dokter` VALUES (40, 12, 'Nurnaningsih, dr., Sp.A', '', '', '1');
INSERT INTO `dokter` VALUES (41, 16, 'Adi Anggoro, dr', '', '', '1');
INSERT INTO `dokter` VALUES (42, 16, 'Ali Musa, dr', '', '', '1');
INSERT INTO `dokter` VALUES (43, 16, 'Ani Kartika, dr', '', '', '1');

-- --------------------------------------------------------

-- 
-- Table structure for table `dosis`
-- 

CREATE TABLE `dosis` (
  `id` int(11) NOT NULL auto_increment,
  `deskripsi` varchar(255) NOT NULL,
  `obat_per_hari` float NOT NULL,
  PRIMARY KEY  (`id`,`deskripsi`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `dosis`
-- 

INSERT INTO `dosis` VALUES (1, '1 X 1', 1);
INSERT INTO `dosis` VALUES (2, '1 X 1 1/2', 0);
INSERT INTO `dosis` VALUES (3, '1 X 1/2', 0.5);

-- --------------------------------------------------------

-- 
-- Table structure for table `generate_po`
-- 

CREATE TABLE `generate_po` (
  `id` int(11) NOT NULL auto_increment,
  `last_po_no` varchar(50) NOT NULL,
  `base_po_no` varchar(50) NOT NULL,
  `request_no` varchar(50) default NULL,
  `supp_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `stock_req` int(11) NOT NULL,
  `harga_req` double NOT NULL,
  `stok` int(11) NOT NULL,
  `expired_date` date default NULL,
  `subtotal_req` double NOT NULL,
  `stok_app` int(11) NOT NULL,
  `subtotal_app` double NOT NULL,
  `flags` int(1) NOT NULL,
  `crtd_datetime` datetime NOT NULL,
  `crtd_user` varchar(30) NOT NULL,
  `lupd_datetime` datetime NOT NULL,
  `lupd_user` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`,`last_po_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dumping data for table `generate_po`
-- 

INSERT INTO `generate_po` VALUES (9, 'PON/0207110007', 'PON/0207110007', 'SPB/0207110033', 1, 35, 150, 800, 440, '0000-00-00', 120000, 150, 120000, 1, '2011-07-05 19:13:45', 'Jalu', '2011-07-05 19:13:45', 'Jalu');
INSERT INTO `generate_po` VALUES (10, 'PON/0207110007', 'PON/0207110007', 'SPB/0207110033', 1, 36, 100, 90890, 550, '0000-00-00', 9089000, 100, 9089000, 1, '2011-07-05 19:13:45', 'Jalu', '2011-07-05 19:13:45', 'Jalu');
INSERT INTO `generate_po` VALUES (11, 'PON/0207110007', 'PON/0207110007', 'SPB/0207110033', 1, 37, 50, 99800, 20, '0000-00-00', 4990000, 50, 4990000, 1, '2011-07-05 19:13:45', 'Jalu', '2011-07-05 19:13:45', 'Jalu');

-- --------------------------------------------------------

-- 
-- Table structure for table `golongan_obat`
-- 

CREATE TABLE `golongan_obat` (
  `id` int(11) NOT NULL auto_increment,
  `kd_golongan_obat` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`,`kd_golongan_obat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `golongan_obat`
-- 

INSERT INTO `golongan_obat` VALUES (1, 'GNR', 'Generic');
INSERT INTO `golongan_obat` VALUES (2, 'N-GNR', 'Non - Generic');

-- --------------------------------------------------------

-- 
-- Table structure for table `group_barang`
-- 

CREATE TABLE `group_barang` (
  `id` int(11) NOT NULL auto_increment,
  `kd_group_barang` varchar(20) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`,`kd_group_barang`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `group_barang`
-- 

INSERT INTO `group_barang` VALUES (1, 'A', 'Alkes');
INSERT INTO `group_barang` VALUES (2, 'BC', 'Beauty Care');
INSERT INTO `group_barang` VALUES (3, 'C', 'Cosmetic');
INSERT INTO `group_barang` VALUES (4, 'J', 'Jamu');
INSERT INTO `group_barang` VALUES (5, 'NM', 'Non - Medik');
INSERT INTO `group_barang` VALUES (6, 'F', 'Obat');

-- --------------------------------------------------------

-- 
-- Table structure for table `group_unit`
-- 

CREATE TABLE `group_unit` (
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL,
  `name_group` varchar(50) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `f_status` varchar(255) NOT NULL,
  `f_aktifasi` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `group_unit`
-- 

INSERT INTO `group_unit` VALUES (1, 1, 'Pelayanan', '2011-06-27 20:47:26', 'Hardi', '2011-06-27 20:49:19', 'Hardi', '-', 1);
INSERT INTO `group_unit` VALUES (2, 2, 'Non-Pelayanan', '2011-06-27 20:47:40', 'Hardi', '2011-06-27 20:49:33', 'Hardi', '-', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `guna_obat`
-- 

CREATE TABLE `guna_obat` (
  `id` int(11) NOT NULL auto_increment,
  `kd_guna_obat` varchar(20) NOT NULL,
  `nama_guna_obat` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`,`kd_guna_obat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `guna_obat`
-- 

INSERT INTO `guna_obat` VALUES (1, 'K-001', 'testing');

-- --------------------------------------------------------

-- 
-- Table structure for table `head_spb`
-- 

CREATE TABLE `head_spb` (
  `id` int(11) NOT NULL auto_increment,
  `spb_no` varchar(50) NOT NULL,
  `tgl_req` varchar(10) NOT NULL,
  `flags` int(1) NOT NULL default '1',
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(50) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(50) NOT NULL,
  `fld00` varchar(255) default NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `head_spb`
-- 

INSERT INTO `head_spb` VALUES (1, 'SPB/2506110001', '2011-06-25', 1, '2011-06-25 05:20:23', 'JL', '2011-06-26 00:27:59', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `head_spb` VALUES (3, 'SPB/2806110008', '2011-06-28', 1, '2011-06-28 04:34:45', 'Jalu', '2011-06-28 04:34:45', 'Jalu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `head_spb` VALUES (4, 'SPB/2806110022', '2011-06-28', 1, '2011-06-28 18:48:09', 'Jalu', '2011-06-28 18:48:09', 'Jalu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `head_spb` VALUES (5, 'SPB/0207110033', '2011-07-02', 1, '2011-07-02 04:29:15', 'Jalu', '2011-07-05 19:35:06', 'Jalu', '1', '8', 'PON/0207110007', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `head_spb` VALUES (6, 'SPB/0207110034', '2011-07-02', 1, '2011-07-02 04:41:17', 'Jalu', '2011-07-02 04:41:17', 'Jalu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `inventory`
-- 

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL auto_increment,
  `kd_barang` varchar(20) NOT NULL,
  `jml` float(9,2) NOT NULL,
  `harga` float(14,2) NOT NULL,
  `F` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `inventory`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `jenis_obat`
-- 

CREATE TABLE `jenis_obat` (
  `id` int(11) NOT NULL auto_increment,
  `kd_jenis_obat` varchar(15) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

-- 
-- Dumping data for table `jenis_obat`
-- 

INSERT INTO `jenis_obat` VALUES (1, 'NKT', 'Narkotika');
INSERT INTO `jenis_obat` VALUES (2, 'NPSI', 'Obat Non Psicotrophica');
INSERT INTO `jenis_obat` VALUES (9, 'PSI', 'Obat Psicotrophica');

-- --------------------------------------------------------

-- 
-- Table structure for table `kat_menu`
-- 

CREATE TABLE `kat_menu` (
  `id` int(11) NOT NULL auto_increment,
  `Id_Type` varchar(10) NOT NULL,
  `Nm_Type` varchar(50) NOT NULL,
  `f_Status` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `kat_menu`
-- 

INSERT INTO `kat_menu` VALUES (1, 'M', 'Master', 1);
INSERT INTO `kat_menu` VALUES (2, 'C1', 'child1', 1);
INSERT INTO `kat_menu` VALUES (3, 'C2', 'child2', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `klasifikasi_inventory`
-- 

CREATE TABLE `klasifikasi_inventory` (
  `kd_klasifikasi_inventory` varchar(11) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY  (`kd_klasifikasi_inventory`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `klasifikasi_inventory`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `kunjungan`
-- 

CREATE TABLE `kunjungan` (
  `id` bigint(20) NOT NULL auto_increment,
  `kunjungan_ke` int(11) default NULL,
  `pasien_id` int(8) unsigned zerofill NOT NULL default '00000000',
  `perujuk_id` int(11) default NULL,
  `cara_masuk` enum('DATANG SENDIRI','KASUS POLISI','RUJUKAN','LAIN-LAIN') NOT NULL,
  `keadaan_keluar` enum('BELUM SEMBUH','SEMBUH','MATI < 48 JAM','MATI >= 48 JAM') default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `kunjungan_ke` (`kunjungan_ke`,`pasien_id`),
  KEY `pasien_id` (`pasien_id`),
  KEY `cara_masuk_id` (`cara_masuk`),
  KEY `perujuk_id` (`perujuk_id`),
  KEY `kunjungan_ibfk_4` (`keadaan_keluar`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `kunjungan`
-- 

INSERT INTO `kunjungan` VALUES (1, 1, 00151127, NULL, 'DATANG SENDIRI', 'SEMBUH');
INSERT INTO `kunjungan` VALUES (2, 1, 00151128, NULL, 'DATANG SENDIRI', NULL);
INSERT INTO `kunjungan` VALUES (3, 1, 00151129, NULL, 'DATANG SENDIRI', 'SEMBUH');
INSERT INTO `kunjungan` VALUES (4, 1, 00151130, NULL, 'DATANG SENDIRI', NULL);
INSERT INTO `kunjungan` VALUES (5, 1, 00132037, NULL, 'DATANG SENDIRI', NULL);
INSERT INTO `kunjungan` VALUES (6, 1, 00102359, NULL, 'DATANG SENDIRI', NULL);
INSERT INTO `kunjungan` VALUES (7, 1, 00151131, NULL, 'DATANG SENDIRI', NULL);
INSERT INTO `kunjungan` VALUES (8, 1, 00151132, NULL, 'DATANG SENDIRI', 'BELUM SEMBUH');
INSERT INTO `kunjungan` VALUES (9, 1, 00151133, NULL, 'KASUS POLISI', NULL);
INSERT INTO `kunjungan` VALUES (10, 1, 00151134, 12, 'RUJUKAN', NULL);
INSERT INTO `kunjungan` VALUES (11, 2, 00151134, 12, '', NULL);
INSERT INTO `kunjungan` VALUES (12, 1, 00151135, 12, '', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `kunjungan_kamar`
-- 

CREATE TABLE `kunjungan_kamar` (
  `id` bigint(20) NOT NULL auto_increment,
  `parent_id` bigint(20) default NULL,
  `kunjungan_id` bigint(20) NOT NULL default '0',
  `kamar_id` smallint(6) NOT NULL default '0',
  `no_antrian` tinyint(3) default NULL,
  `tgl_daftar` datetime default NULL,
  `tgl_periksa` datetime default NULL,
  `tgl_keluar` datetime default NULL,
  `dokter_id` tinyint(4) default NULL,
  `kelanjutan` enum('DIRAWAT','DIRUJUK','PULANG','PINDAH KAMAR') default NULL,
  `diagnosa_utama_id` int(11) default NULL,
  `cara_bayar` enum('UMUM','JAMSOSTEK','DANA REKSA DESA','KONTRAK','LAIN-LAIN','ASKES') NOT NULL,
  `jenis_askes` enum('Askes Alba','Askes Blue','Askes Diamond','Askes Gold','Askes Platinum','Askes Silver','Askes Kin','Askes Sosial') default NULL,
  `perusahaan_id` tinyint(3) default NULL,
  `nomor` varchar(255) default NULL,
  `pj_nama` varchar(255) default NULL,
  `pj_alamat` varchar(255) default NULL,
  `pj_telp` varchar(255) default NULL,
  `pj_hubungan_keluarga` enum('AYAH','IBU','SAUDARA','PAMAN','BIBI','LAIN-LAIN','SUAMI','ISTRI') default NULL,
  PRIMARY KEY  (`id`),
  KEY `kunjungan_id` (`kunjungan_id`),
  KEY `bed_id` (`kamar_id`),
  KEY `diagnosa_utama_id` (`diagnosa_utama_id`),
  KEY `kelanjutan_id` (`kelanjutan`),
  KEY `kunjungan_kamar_ibfk_5` (`cara_bayar`),
  KEY `kunjungan_kamar_ibfk_6` (`pj_hubungan_keluarga`),
  KEY `kunjungan_kamar_ibfk_8` (`parent_id`),
  KEY `dokter_id` (`dokter_id`),
  KEY `perusahaan_id` (`perusahaan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `kunjungan_kamar`
-- 

INSERT INTO `kunjungan_kamar` VALUES (1, NULL, 1, 1, NULL, '2011-02-20 11:00:00', '2011-02-20 11:00:00', '2011-02-20 11:00:00', 41, 'PULANG', 5, 'UMUM', NULL, NULL, NULL, 'Hartanto', 'JL JAKARTA NO 35', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (2, NULL, 2, 10, 1, '2011-02-20 12:16:49', '2011-02-20 00:00:00', '2011-02-20 12:16:49', 19, NULL, NULL, 'UMUM', NULL, NULL, NULL, 'Heri', 'JL. GATOT SOEBROTO NO 45', '', 'ISTRI');
INSERT INTO `kunjungan_kamar` VALUES (3, 1, 1, 61, NULL, '2011-02-20 16:06:06', '2011-02-20 16:06:06', NULL, NULL, NULL, NULL, 'UMUM', NULL, NULL, NULL, 'Hartanto', 'JL JAKARTA NO 35', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (4, NULL, 3, 1, NULL, '2011-02-26 06:16:00', '2011-02-26 06:16:00', '2011-02-26 06:26:27', 41, 'DIRAWAT', 5, 'UMUM', NULL, NULL, NULL, 'Harjanto', 'JL. GATOT SOEBROTO', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (5, NULL, 4, 10, 1, '2011-02-26 06:19:45', '2011-02-26 00:00:00', '2011-02-26 06:19:45', 20, NULL, NULL, 'ASKES', 'Askes Alba', 1, NULL, 'Roni', 'JL PAJAJARAN', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (6, 4, 3, 27, NULL, '2011-02-26 06:26:27', '2011-02-26 06:26:27', NULL, 29, NULL, 6, 'UMUM', NULL, NULL, NULL, 'Harjanto', 'JL. GATOT SOEBROTO', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (7, 4, 3, 61, NULL, '2011-02-26 23:50:36', '2011-02-26 23:50:36', NULL, NULL, NULL, NULL, 'UMUM', NULL, NULL, NULL, 'Harjanto', 'JL. GATOT SOEBROTO', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (8, 4, 3, 81, NULL, '2011-02-26 23:50:36', '2011-02-26 23:50:36', NULL, NULL, NULL, NULL, 'UMUM', NULL, NULL, NULL, 'Harjanto', 'JL. GATOT SOEBROTO', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (9, 4, 3, 71, NULL, '2011-02-26 23:50:36', '2011-02-26 23:50:36', NULL, NULL, NULL, NULL, 'UMUM', NULL, NULL, NULL, 'Harjanto', 'JL. GATOT SOEBROTO', '', 'AYAH');
INSERT INTO `kunjungan_kamar` VALUES (10, NULL, 5, 5, 1, '2011-02-27 00:59:31', '2011-02-27 00:00:00', '2011-02-27 00:59:31', 37, NULL, NULL, 'UMUM', NULL, NULL, NULL, '', '', '', NULL);
INSERT INTO `kunjungan_kamar` VALUES (11, NULL, 6, 4, 1, '2011-02-27 01:00:37', '2011-02-27 00:00:00', '2011-02-27 01:00:37', 32, NULL, NULL, 'UMUM', NULL, NULL, NULL, '', '', '', NULL);
INSERT INTO `kunjungan_kamar` VALUES (12, NULL, 7, 10, 1, '2011-02-27 14:15:43', '2011-02-27 00:00:00', '2011-02-27 14:15:43', 19, NULL, NULL, 'UMUM', NULL, NULL, NULL, 'HERI', 'JL. DEWI SARTIKA', '', 'PAMAN');
INSERT INTO `kunjungan_kamar` VALUES (13, NULL, 8, 5, 1, '2011-05-14 13:17:21', '2011-05-14 00:00:00', '2011-05-14 14:36:43', 8, 'DIRAWAT', NULL, 'ASKES', 'Askes Blue', 11, NULL, 'Budi', 'BUMI PANYILEUKAN E9 NO 5', '', 'PAMAN');
INSERT INTO `kunjungan_kamar` VALUES (14, 13, 8, 31, NULL, '2011-05-14 14:36:43', '2011-05-14 14:36:43', NULL, 15, NULL, NULL, 'ASKES', 'Askes Blue', 11, NULL, 'Budi', 'BUMI PANYILEUKAN E9 NO 5', '', 'PAMAN');
INSERT INTO `kunjungan_kamar` VALUES (15, NULL, 9, 10, 1, '2011-06-17 19:34:29', '2011-06-17 00:00:00', '2011-06-17 19:34:29', 21, NULL, NULL, 'UMUM', NULL, NULL, NULL, '', 'ARCAMANIK', '', NULL);
INSERT INTO `kunjungan_kamar` VALUES (16, NULL, 10, 5, 1, '2011-06-18 10:58:36', '2011-06-18 00:00:00', '2011-06-18 10:58:36', 37, NULL, NULL, 'UMUM', NULL, NULL, NULL, 'anggara suci nugraha penanggung jawab', 'A', '09090990', 'IBU');

-- --------------------------------------------------------

-- 
-- Table structure for table `k_unt`
-- 

CREATE TABLE `k_unt` (
  `id` int(1) NOT NULL auto_increment,
  `nama` varchar(40) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `k_unt`
-- 

INSERT INTO `k_unt` VALUES (1, 'Farmasi');
INSERT INTO `k_unt` VALUES (2, 'Apotik');
INSERT INTO `k_unt` VALUES (3, 'Unit');

-- --------------------------------------------------------

-- 
-- Table structure for table `leveling_akses`
-- 

CREATE TABLE `leveling_akses` (
  `id` int(11) NOT NULL auto_increment,
  `akses_lvl` int(1) NOT NULL,
  `akses_va` varchar(100) NOT NULL,
  `akses_vae` varchar(100) NOT NULL,
  `akses_vaed` varchar(100) NOT NULL,
  `akses_ve` varchar(100) NOT NULL,
  `flags` bit(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- 
-- Dumping data for table `leveling_akses`
-- 

INSERT INTO `leveling_akses` VALUES (4, 3, '0', '1', '1', '1', '', '2011-06-28 14:27:35', 'Hardi', '2011-06-28 14:33:37', 'Hardi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `leveling_akses` VALUES (5, 2, '1', '0', '0', '0', '', '2011-06-28 14:52:56', 'Hardi', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `leveling_akses` VALUES (6, 4, '1', '1', '0', '1', '', '2011-06-28 14:53:07', 'Hardi', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `margin`
-- 

CREATE TABLE `margin` (
  `id` int(11) NOT NULL auto_increment,
  `jenis` enum('Tunai','Non-Tunai') NOT NULL,
  `kode` varchar(10) NOT NULL,
  `klasifikasi_pasien` varchar(20) NOT NULL,
  `margin` float NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `margin`
-- 

INSERT INTO `margin` VALUES (5, 'Tunai', 'PNJB', 'UMUM', 30);
INSERT INTO `margin` VALUES (4, 'Tunai', 'PNJB', 'KARYAWAN', 10);
INSERT INTO `margin` VALUES (6, 'Tunai', 'RSDL', 'UMUM', 30);
INSERT INTO `margin` VALUES (7, 'Tunai', 'RSRJ', 'ASKES', 42.5);
INSERT INTO `margin` VALUES (8, 'Tunai', 'RSRJ', 'UMUM', 30);

-- --------------------------------------------------------

-- 
-- Table structure for table `margin_tunai`
-- 

CREATE TABLE `margin_tunai` (
  `id` int(11) NOT NULL auto_increment,
  `kategori_obat` varchar(100) NOT NULL,
  `margin` float(14,2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `margin_tunai`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `mr`
-- 

CREATE TABLE `mr` (
  `id` int(11) NOT NULL auto_increment,
  `type` char(3) NOT NULL default 'SPB',
  `param_no` int(4) NOT NULL default '1',
  `last_no` int(4) NOT NULL,
  `next_no` int(4) NOT NULL,
  `full_no` varchar(50) default NULL,
  `frm_update_by` varchar(255) NOT NULL,
  `lupd_datetime` datetime NOT NULL,
  `lupd_user` varchar(30) NOT NULL,
  `in_use` int(1) NOT NULL default '1',
  `is_reg` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `mr`
-- 

INSERT INTO `mr` VALUES (1, 'SPB', 1, 35, 36, 'SPB/0207110035', 'content/mr_auto', '2011-07-02 04:46:25', '', 0, 1);
INSERT INTO `mr` VALUES (2, 'PO', 1, 8, 9, 'PON/0207110007', 'action/generate_po', '2011-07-05 19:13:45', '', 1, 1);
INSERT INTO `mr` VALUES (3, 'SPP', 1, 1, 2, 'SPP/2506110002', 'content/list_spp', '2011-06-26 04:39:11', 'JL', 0, 1);
INSERT INTO `mr` VALUES (4, 'BPB', 1, 1, 2, 'BPB/2506110002', 'content/mr_auto', '2011-06-26 04:39:17', 'JL', 0, 1);
INSERT INTO `mr` VALUES (5, 'BTB', 1, 1, 2, 'BTB/2506110002', 'content/mr_auto', '2011-06-26 04:39:22', 'JL', 0, 1);
INSERT INTO `mr` VALUES (6, 'STB', 0, 0, 1, 'STB/2506110001', 'content/mr_auto', '2011-06-26 04:41:52', 'JL', 1, 1);
INSERT INTO `mr` VALUES (7, 'RPO', 0, 0, 1, 'RPO/2906110001', 'content/po_receive_go', '0000-00-00 00:00:00', 'JL', 1, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `ms_barang`
-- 

CREATE TABLE `ms_barang` (
  `id` bigint(22) NOT NULL auto_increment,
  `group_barang` varchar(11) NOT NULL,
  `kd_barang` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `satuan` varchar(11) default NULL,
  `pabrik01` varchar(11) default NULL,
  `pabrik02` tinyint(4) default NULL,
  `pabrik03` tinyint(4) default NULL,
  `pabrik04` tinyint(4) default NULL,
  `pabrik05` tinyint(4) default NULL,
  `satuan_kirim` varchar(255) default NULL,
  `jenis_obat` varchar(11) default NULL,
  `kategori_obat` varchar(30) NOT NULL,
  `golongan` varchar(11) default NULL,
  `kode_guna` varchar(11) default NULL,
  `kode_persediaan` varchar(50) default NULL,
  `kode_pendapatan` varchar(50) default NULL,
  `kode_reduksi` varchar(50) default NULL,
  `kode_biaya` varchar(50) default NULL,
  `kode_ppn_k` varchar(50) default NULL,
  `kode_ppn_m` varchar(50) default NULL,
  `expire_date` varchar(10) default NULL,
  `ex_date` int(2) default NULL,
  `ex_month` int(2) default NULL,
  `ex_year` int(4) default NULL,
  `tipe_obat` varchar(11) default NULL,
  `obat_tunai` varchar(20) default NULL,
  `hna` varchar(255) default NULL,
  `harga_dosp` float(14,2) default NULL,
  `discount` float(9,2) default NULL,
  `ppn` float(14,2) default NULL,
  `averange_sale` float(14,2) default NULL,
  `stok_max` int(9) default NULL,
  `stok_min` int(9) default NULL,
  `stok` float(9,2) NOT NULL,
  `isi` int(9) default NULL,
  `kemasan` varchar(11) default NULL,
  `status` varchar(40) default NULL,
  `flags` tinyint(1) NOT NULL default '1',
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

-- 
-- Dumping data for table `ms_barang`
-- 

INSERT INTO `ms_barang` VALUES (1, 'J', 'd', 'kdjakf', 'POT', '2', NULL, NULL, NULL, NULL, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 3000.00, 0.00, 10.00, 0.00, 50, 10, 40.00, 0, 'POT', 'Aktif', 1, '2011-06-24 05:44:21', 'JL', '2011-06-24 05:44:21', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (2, 'C', 'aaangga', 'asdasd', 'AMP', '1', 2, NULL, NULL, NULL, 'satuan kirim', 'NKT', 'Obat Bebas', 'GNR', 'K-001', 'persediaan', 'adad', 'reduksi', 'biaya', 'ppn k', 'ppn m', '30/06/2011', 30, 6, 2011, 'STD', 'Tunai', 'asda', 30000.00, 0.00, 10.00, 0.00, 100, 10, 3.00, 12, 'AMP', 'Aktif', 2, '2011-06-24 05:44:50', 'JL', '2011-06-24 05:44:50', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (3, 'J', 'dsasd', 'dsadasd', 'AMP', '1', 2, NULL, NULL, NULL, 'satuan kirim', 'NPSI', 'Obat Bebas', 'GNR', 'K-001', 'persediaan', 'adad', 'reduksi', 'biaya', 'ppn k', 'ppn m', '25/06/2011', 25, 6, 2011, 'STD', 'Tunai', 'asd', 30000.00, 0.00, 10.00, 0.00, 100, 10, 0.00, 12, 'AMP', 'Aktif', 2, '2011-06-24 05:45:04', 'JL', '2011-06-24 05:45:04', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (4, 'F', 'ah', 'Phoenix down', 'BTL', '2', NULL, 3, NULL, NULL, 'satuan adjah', 'PSI', 'Obat Keras', 'N-GNR', 'K-001', 'p', 'p', 'p', 'p', 'p', 'p', '17/08/2011', 17, 8, 2011, 'NSTD', 'Non-Tunai', 'h', 20000.00, 20.00, 20.00, 2000.00, 100, 10, 144.00, 9, 'BTL', 'Aktif', 2, '2011-06-24 05:45:16', 'JL', '2011-06-24 05:45:16', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (5, 'F', 'KK01', 'Konidin', 'STR', '1', 2, 3, 5, 2, 'das', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', 'adfds', 'adad', 'adasd', 'ad', 'fad', 'ad', '28/06/2012', 28, 6, 2012, 'STD', 'Tunai', 'dfds', 4000.00, 0.00, 0.00, 0.00, 100, 10, 76.00, 15, 'KPL', 'Aktif', 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (6, 'BC', 'P001', 'Ponds', 'BTL', '2', 1, 0, 0, 0, 'das', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', 'das', 'dsa', 'adsas', 'ad', 'asda', 'ad', '29/07/2011', 29, 7, 2011, 'STD', 'Tunai', 'daaasd', 13000.00, 0.00, 0.00, 0.00, 100, 10, 0.00, 100, 'BOX', 'Aktif', 1, '2011-06-28 00:47:29', 'Hardi', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (7, 'group1', 'kd_barang1', 'nama01', 'POT', '1', 4, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 3000.00, 0.00, 10.00, 0.00, 9999, 300, 500.00, 0, 'POT', 'Aktif', 1, '0000-00-00 00:00:00', 'JL', '0000-00-00 00:00:00', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (44, 'F', 'K-003', 'Oskadon Pancen OYE', 'AMP', '1', 2, 5, 0, 0, 'box', 'NKT', 'Obat Bebas', 'GNR', 'K-001', 'dw', 'dsd', 'sds', 'dede', 'dsds', 'sds', '05/07/2012', 5, 7, 2012, 'STD', 'Tunai', 'dsds', 1000.00, 0.00, 0.00, 0.00, 500, 50, 453.00, 10, 'ML', NULL, 1, '2011-07-05 21:20:04', 'Hardi', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (9, 'group1', 'kd_barang1', 'nama01', 'POT', '1', 4, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 3000.00, 0.00, 10.00, 0.00, 9999, 300, 500.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:00', 'JL', '2011-06-28 01:32:00', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (11, 'group3', 'kd_barang3', 'nama03', 'POT', '4', 3, 1, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2019', 6, 3, 2019, 'STD', 'Tunai', '', 10000.00, 0.02, 10.02, 0.02, 9999, 499, 699.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:02', 'JL', '2011-06-28 01:32:02', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (12, 'group4', 'kd_barang4', 'nama04', 'POT', '5', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 700.00, 0.03, 10.03, 0.03, 9999, 120, 320.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:02', 'JL', '2011-06-28 01:32:02', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (13, 'group5', 'kd_barang5', 'nama05', 'POT', '2', 1, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/11/2013', 6, 11, 2013, 'STD', 'Tunai', '', 800.00, 0.04, 10.04, 0.04, 9999, 440, 640.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:03', 'JL', '2011-06-28 01:32:03', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (14, 'group6', 'kd_barang6', 'nama06', 'POT', '1', 2, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 90890.00, 0.05, 10.05, 0.05, 9999, 550, 750.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:04', 'JL', '2011-06-28 01:32:04', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (15, 'group7', 'kd_barang7', 'nama07', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 99800.00, 0.06, 10.06, 0.06, 9999, 20, 220.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:04', 'JL', '2011-06-28 01:32:04', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (16, 'group8', 'kd_barang8', 'nama08', 'POT', '4', 4, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 67700.00, 0.07, 10.07, 0.07, 9999, 120, 320.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:05', 'JL', '2011-06-28 01:32:05', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (17, 'group9', 'kd_barang9', 'nama09', 'POT', '5', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 98990.00, 0.08, 10.08, 0.08, 9999, 44, 244.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:05', 'JL', '2011-06-28 01:32:05', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (18, 'group10', 'kd_barang10', 'nama10', 'POT', '2', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/11/2013', 6, 11, 2013, 'STD', 'Tunai', '', 800.00, 0.09, 10.09, 0.09, 9999, 2220, 2420.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:06', 'JL', '2011-06-28 01:32:06', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (19, 'group11', 'kd_barang11', 'nama11', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 569.00, 0.10, 10.10, 0.10, 9999, 123, 323.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:32:07', 'JL', '2011-06-28 01:32:07', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (20, 'group1', 'kd_barang90', 'nama01', 'POT', '1', 4, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 3000.00, 0.00, 10.00, 0.00, 9999, 300, 300.00, 0, 'POT', 'Aktif', 2, '2011-06-28 01:34:53', 'JL', '2011-06-28 18:41:25', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (21, 'group2', 'kd_barang51', 'nama02', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/08/2011', 6, 8, 2011, 'STD', 'Tunai', '', 5000.00, 0.01, 10.01, 0.01, 9999, 102, 286.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:53', 'JL', '2011-06-28 01:34:53', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (22, 'group3', 'kd_barang52', 'nama03', 'POT', '4', 3, 1, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2019', 6, 3, 2019, 'STD', 'Tunai', '', 10000.00, 0.02, 10.02, 0.02, 9999, 499, 699.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:54', 'JL', '2011-06-28 01:34:54', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (23, 'group4', 'kd_barang53', 'nama04', 'POT', '5', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 700.00, 0.03, 10.03, 0.03, 9999, 120, 320.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:54', 'JL', '2011-06-28 01:34:54', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (24, 'group5', 'kd_barang54', 'nama05', 'POT', '2', 1, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/11/2013', 6, 11, 2013, 'STD', 'Tunai', '', 800.00, 0.04, 10.04, 0.04, 9999, 440, 640.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:55', 'JL', '2011-06-28 01:34:55', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (25, 'group6', 'kd_barang55', 'nama06', 'POT', '1', 2, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 90890.00, 0.05, 10.05, 0.05, 9999, 550, 750.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:55', 'JL', '2011-06-28 01:34:55', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (26, 'group7', 'kd_barang56', 'nama07', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 99800.00, 0.06, 10.06, 0.06, 9999, 20, 220.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:56', 'JL', '2011-06-28 01:34:56', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (27, 'group8', 'kd_barang57', 'nama08', 'POT', '4', 4, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 67700.00, 0.07, 10.07, 0.07, 9999, 120, 320.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:57', 'JL', '2011-06-28 01:34:57', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (28, 'group9', 'kd_barang58', 'nama09', 'POT', '5', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 98990.00, 0.08, 10.08, 0.08, 9999, 44, 244.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:57', 'JL', '2011-06-28 01:34:57', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (29, 'group10', 'kd_barang59', 'nama10', 'POT', '2', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/11/2013', 6, 11, 2013, 'STD', 'Tunai', '', 800.00, 0.09, 10.09, 0.09, 9999, 2220, 2420.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:58', 'JL', '2011-06-28 01:34:58', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (30, 'group11', 'kd_barang60', 'nama11', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 569.00, 0.10, 10.10, 0.10, 9999, 123, 323.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:34:58', 'JL', '2011-06-28 01:34:58', 'JL', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (31, 'group1', 'kd_barang50', 'nama01', 'POT', '1', 4, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 3000.00, 0.00, 10.00, 0.00, 9999, 300, 300.00, 0, 'POT', 'Aktif', 2, '2011-06-28 01:36:26', 'JL', '2011-06-28 01:58:04', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (32, 'group2', 'kd_barang51', 'nama02', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/08/2011', 6, 8, 2011, 'STD', 'Tunai', '', 5000.00, 0.01, 10.01, 0.01, 9999, 102, 289.00, 0, 'POT', 'Aktif', 2, '2011-06-28 01:36:27', 'JL', '2011-06-28 01:58:04', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (33, 'group3', 'kd_barang52', 'nama03', 'POT', '4', 3, 1, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2019', 6, 3, 2019, 'STD', 'Tunai', '', 10000.00, 0.02, 10.02, 0.02, 9999, 499, 499.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:36:27', 'JL', '2011-07-02 04:41:06', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (34, 'group4', 'kd_barang53', 'nama04', 'POT', '5', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 700.00, 0.03, 10.03, 0.03, 9999, 120, 120.00, 0, 'POT', 'Aktif', 5, '2011-06-28 01:36:28', 'JL', '2011-06-28 04:24:35', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (35, 'group5', 'kd_barang54', 'nama05', 'POT', '2', 1, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/11/2013', 6, 11, 2013, 'STD', 'Tunai', '', 800.00, 0.04, 10.04, 0.04, 9999, 440, 440.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:36:29', 'JL', '2011-07-02 04:28:38', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (36, 'group6', 'kd_barang55', 'nama06', 'POT', '1', 2, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 90890.00, 0.05, 10.05, 0.05, 9999, 550, 550.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:36:29', 'JL', '2011-07-02 04:28:38', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (37, 'group7', 'kd_barang56', 'nama07', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 99800.00, 0.06, 10.06, 0.06, 9999, 20, 20.00, 0, 'POT', 'Aktif', 1, '2011-06-28 01:36:30', 'JL', '2011-07-02 04:28:38', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (38, 'group8', 'kd_barang57', 'nama08', 'POT', '4', 4, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/03/2013', 6, 3, 2013, 'STD', 'Tunai', '', 67700.00, 0.07, 10.07, 0.07, 9999, 120, 120.00, 0, 'POT', 'Aktif', 2, '2011-06-28 01:36:30', 'JL', '2011-06-28 04:24:35', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (39, 'group9', 'kd_barang58', 'nama09', 'POT', '5', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 98990.00, 0.08, 10.08, 0.08, 9999, 44, 44.00, 0, 'POT', 'Aktif', 2, '2011-06-28 01:36:31', 'JL', '2011-07-02 04:41:06', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (40, 'group10', 'kd_barang59', 'nama10', 'POT', '2', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '06/11/2013', 6, 11, 2013, 'STD', 'Tunai', '', 800.00, 0.09, 10.09, 0.09, 9999, 2220, 2220.00, 0, 'POT', 'Aktif', 2, '2011-06-28 01:36:32', 'JL', '2011-06-28 04:24:35', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (41, 'group11', 'kd_barang60', 'nama11', 'POT', '3', 0, 0, 0, 0, 'BOX', 'NPSI', 'Obat Bebas', 'N-GNR', 'K-001', '', '', '', '', '', '', '09/03/2015', 9, 3, 2015, 'STD', 'Tunai', '', 569.00, 0.10, 10.10, 0.10, 9999, 123, 123.00, 0, 'POT', 'Aktif', 2, '2011-06-28 01:36:32', 'JL', '2011-06-28 18:41:25', 'Jalu', '', '', '', '', '', '', '', '', '', '');
INSERT INTO `ms_barang` VALUES (42, 'groi', 'K002', 'Abraham', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (43, 'group1', 'K001', 'Nisiprin', 'Strip', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'F', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12-12-2011', 12, 12, 2011, NULL, NULL, NULL, 10000.00, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, 1, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `ms_barang` VALUES (45, 'F', 'ah', 'Phoenix down', 'BTL', '3', NULL, NULL, NULL, NULL, 'box', 'PSI', 'Obat Keras', 'N-GNR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 'NSTD', NULL, NULL, 9000.00, 1.00, 900.00, NULL, NULL, NULL, 70.00, NULL, NULL, NULL, 1, '2011-07-06 02:27:58', 'Jalu', '0000-00-00 00:00:00', '2011-07-06 02:27:58', 'PON/2806110005', 'SPB/2506110001', '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `pabrik`
-- 

CREATE TABLE `pabrik` (
  `kd_pabrik` varchar(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY  (`kd_pabrik`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `pabrik`
-- 

INSERT INTO `pabrik` VALUES ('P-001', 'Kiara Condong, Co.Ltd');

-- --------------------------------------------------------

-- 
-- Table structure for table `pasien`
-- 

CREATE TABLE `pasien` (
  `id` int(8) unsigned zerofill NOT NULL auto_increment,
  `nama` varchar(25) default NULL,
  `tempat_lahir` varchar(20) default NULL,
  `tgl_lahir` date default NULL,
  `sex` enum('LAKI-LAKI','PEREMPUAN') default NULL,
  `alamat` varchar(50) default NULL,
  `rt` char(3) default NULL,
  `rw` char(3) default NULL,
  `desa_id` int(11) default NULL,
  `telp` varchar(25) default NULL,
  `agama` enum('ISLAM','KATHOLIK','PROTESTAN','HINDU','BUDHA','KONG HU CHU','ALIRAN KEPERCAYAAN','LAIN-LAIN') default NULL,
  `gol_darah` enum('A','B','AB','O') default NULL,
  `pendidikan_id` tinyint(3) default NULL,
  `pekerjaan_id` tinyint(3) default NULL,
  `status_nikah` enum('BELUM KAWIN','DUDA','JANDA','KAWIN') default NULL,
  `tgl_daftar` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `agama_id` (`agama`),
  KEY `sex_id` (`sex`),
  KEY `pendidikan_id` (`pendidikan_id`),
  KEY `pekerjaan_id` (`pekerjaan_id`),
  KEY `status_nikah_id` (`status_nikah`),
  KEY `pasien_ibfk_1` (`desa_id`),
  KEY `gol_darah_id` (`gol_darah`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=980989 ;

-- 
-- Dumping data for table `pasien`
-- 

INSERT INTO `pasien` VALUES (00151134, 'angga lagi', NULL, '2011-06-18', 'LAKI-LAKI', 'A', NULL, NULL, 7339, NULL, 'ISLAM', NULL, 1, 1, 'BELUM KAWIN', '2011-06-18 11:37:31');
INSERT INTO `pasien` VALUES (00151135, 'testing', 'bandung', '2011-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-06-20 15:03:18');
INSERT INTO `pasien` VALUES (00980988, 'Silangga Leong', 'Bandung', '1987-07-01', 'LAKI-LAKI', 'Bandung Yoo', '2', '3', 123, '8558786', 'ISLAM', 'A', 0, 0, 'BELUM KAWIN', '2011-07-01 06:22:18');

-- --------------------------------------------------------

-- 
-- Table structure for table `pbf`
-- 

CREATE TABLE `pbf` (
  `id` int(11) NOT NULL auto_increment,
  `kd_rekanan` varchar(20) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `kontak` varchar(100) NOT NULL,
  `no_rek` varchar(100) NOT NULL,
  `type` int(1) NOT NULL default '1',
  `status` varchar(40) default NULL,
  `flags` int(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  PRIMARY KEY  (`id`,`kd_rekanan`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `pbf`
-- 

INSERT INTO `pbf` VALUES (1, 'PBF-01', 'PT, Kimia Farma', 'jlm. cimuncang no 12 rt 01/ rw02', 'Bandung', '022-088900', '022-088900', 'Angga', '8999090977382', 1, '1', 1, '2011-06-25 02:01:57', 'JL', '2011-06-25 02:01:57', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pbf` VALUES (2, 'PBF-02', 'PT, Maju Terus', 'ujung berung ', 'bandung', '022-088901', '022-088901', 'hyde', '788888989098-090-', 1, '1', 1, '2011-06-25 02:02:21', 'JL', '2011-06-25 02:02:21', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pbf` VALUES (3, 'PBF-003', 'PBF 003', 'KLALD', 'LKDFLAK', '3I9EU888', '888399', 'JKAKK', '838388392', 1, '1', 1, '0000-00-00 00:00:00', 'JL', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pbf` VALUES (4, 'PBF-003', 'PBF 003', 'KLALD', 'LKDFLAK', '3I9EU888', '888399', 'JKAKK', '838388392', 1, '1', 1, '2011-06-25 03:47:57', 'JL', '2011-06-25 03:47:57', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `pbf` VALUES (5, 'PBF-004', 'PT. Priatman', 'Ciledug Raya No 14', 'Jakarta Selatan', '021-73458372', '021-73652625', 'Bpk. Heri', '8752872827 BCA', 1, NULL, 0, '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `pelayanan`
-- 

CREATE TABLE `pelayanan` (
  `id` tinyint(3) NOT NULL auto_increment,
  `spesialisasi_id` tinyint(3) default NULL,
  `nama` varchar(25) default NULL,
  `nama_lain` varchar(25) default NULL,
  `hari_buka` tinyint(1) default NULL,
  `jenis` varchar(100) default NULL,
  `Id_unit` int(11) NOT NULL,
  `group_id` int(11) NOT NULL default '0',
  `unit_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `spesialisasi_id` (`spesialisasi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=98 ;

-- 
-- Dumping data for table `pelayanan`
-- 

INSERT INTO `pelayanan` VALUES (1, 10, 'IGD', '-', NULL, 'IGD', 1, 1, 51);
INSERT INTO `pelayanan` VALUES (2, 1, 'PENYAKIT DALAM', NULL, 6, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (3, 7, 'THT', NULL, 6, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (4, 2, 'BEDAH', NULL, 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (8, 3, 'ANAK', NULL, 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (9, 9, 'KULIT KELAMIN', 'Poli - Kulit Kelamin', 6, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (10, 5, 'SYARAF', NULL, 4, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (11, 8, 'MATA', NULL, 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (13, 12, 'GIGI & MULUT', NULL, 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (14, 10, 'UMUM', NULL, 6, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (36, 4, 'RASUNA SAID', 'PERINATOLOGI', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (37, 1, 'CUT NYAK DIEN', 'PENYAKIT DALAM', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (38, 2, 'CUT MEUTIA', 'BEDAH', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (39, 4, 'OBSTETRI DAN GINEKOLOGI', NULL, 6, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (40, 6, 'JIWA', NULL, 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (41, 10, 'UMUM', 'UMUM', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (42, 3, 'DEWI SARTIKA', 'KESEHATAN ANAK', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (43, 10, 'ICU', 'ICU', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (44, 4, 'INGGIT GAMASIH', 'OBSTETRI', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (45, 7, 'KARTINI', 'THT', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (46, 8, 'NYI AGENG SERANG', 'MATA', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (47, 10, 'REHABILITASI MEDIK', '-', 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (49, 13, 'KB', '-', 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (51, 15, 'NYI AHMAD DAHLAN', 'LUKA BAKAR', NULL, 'Rawat Inap', 1, 1, 50);
INSERT INTO `pelayanan` VALUES (56, 10, 'PSIKOLOGI', '-', 5, 'Rawat Jalan', 1, 1, 4);
INSERT INTO `pelayanan` VALUES (60, NULL, 'VK', '-', NULL, 'OCA (Ruang Tindakan)', 1, 1, 52);
INSERT INTO `pelayanan` VALUES (70, NULL, 'RUANG OPERASI', '-', NULL, 'OCA (Ruang Tindakan)', 1, 1, 52);
INSERT INTO `pelayanan` VALUES (80, NULL, 'ANESTESI', '-', NULL, 'OCA (Ruang Tindakan)', 1, 1, 52);
INSERT INTO `pelayanan` VALUES (93, NULL, 'Administrasi', 'Apotik - Administrasi', NULL, 'Apotik', 0, 2, 2);
INSERT INTO `pelayanan` VALUES (94, NULL, 'Gudang', '-', NULL, 'Apotik', 0, 2, 2);
INSERT INTO `pelayanan` VALUES (95, NULL, 'Administrasi', 'Famasi - Administrasi', NULL, 'Farmasi', 0, 2, 1);
INSERT INTO `pelayanan` VALUES (96, NULL, 'Gudang', '-', NULL, 'Farmasi', 0, 2, 1);
INSERT INTO `pelayanan` VALUES (97, NULL, 'Administrasi', 'Pur - Administrasi', NULL, 'Purchasing', 0, 2, 5);

-- --------------------------------------------------------

-- 
-- Table structure for table `penjualan`
-- 

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL auto_increment,
  `no_trans` varchar(15) NOT NULL,
  `no_resep` varchar(35) NOT NULL,
  `obat_id` varchar(11) NOT NULL,
  `tgl_expire` varchar(10) NOT NULL,
  `dosis_id` varchar(2) NOT NULL,
  `diminta` int(11) NOT NULL,
  `diberi` int(11) NOT NULL,
  `ket` varchar(15) NOT NULL default '',
  `racikan` varchar(2) NOT NULL default '',
  `ket_banyak` varchar(255) NOT NULL,
  `sub_total` float(9,2) NOT NULL,
  `fld01` varchar(255) NOT NULL default '',
  `fld02` varchar(25) NOT NULL default '',
  `fld03` varchar(100) NOT NULL default '',
  `param_no` int(11) NOT NULL,
  `tgl` date default '2001-01-01',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=156 ;

-- 
-- Dumping data for table `penjualan`
-- 

INSERT INTO `penjualan` VALUES (92, 'TRK/0207110040', 'RRI/0207110033', '', '', '1', 0, 0, 'Sesudah Makan', 'YA', 'hehehe', 33600.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (91, 'TRK/0207110040', 'RRI/0207110033', '', '', '1', 0, 0, 'Sesudah Makan', 'YA', 'sdsd', 38110.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (90, 'TRK/0207110039', 'RRI/0207110026', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'ada', 442900.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (89, 'TRK/0207110039', 'RRI/0207110026', 'ah', '', '1', 0, 2, 'Sebelum Makan', '', 'asda', 40000.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (88, 'TRK/0207110038', 'RRI/0207110026', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'ada', 442900.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (87, 'TRK/0207110038', 'RRI/0207110026', 'ah', '', '1', 0, 2, 'Sebelum Makan', '', 'asda', 40000.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (86, 'TRK/0207110037', 'RRI/0207110027', 'ah', '', '1', 0, 2, 'Sebelum Makan', '', 'wwweerrddg', 40000.00, 'Silangga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (85, 'TRK/0207110036', '', 'KK01', '28/06/2012', '1', 1, 1, 'Sebelum Makan', '', '', 4000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (84, 'TRK/0207110036', '', 'KK01', '28/06/2012', '1', 3, 3, 'Sebelum Makan', '', 'www', 12000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (83, 'TRK/0107110035', '', 'KK01', '28/06/2012', '1', 3, 3, 'Sebelum Makan', '', '', 12000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (82, 'TRK/0107110034', '', 'ah', '17/08/2011', '1', 1, 1, 'Sebelum Makan', '', '', 20000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (81, 'TRK/0107110033', 'RRI/0107110022', 'KK01', '', '1', 0, 3, 'Sebelum Makan', '', 'trt', 12000.00, 'Silangga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (80, 'TRK/0107110032', '', 'KK01', '28/06/2012', '1', 5, 5, 'Sebelum Makan', '', 'test', 20000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (79, 'TRK/0107110031', '', 'KK01', '28/06/2012', '2', 3, 3, 'Sesudah Makan', '', '', 12000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (78, 'TRK/0107110030', '', 'KK01', '28/06/2012', '1', 3, 3, 'Sebelum Makan', '', '', 12000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (77, 'TRK/0107110029', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', '', 60000.00, 'sona', '', 'RCK/0107110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (76, 'TRK/0107110029', '', 'ah', '17/08/2011', '2', 2, 2, 'Sesudah Makan', '', '', 40000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (75, 'TRK/0107110028', 'RRI/0107110021', 'ah', '', '1', 0, 2, 'Sesudah Makan', '', '', 40000.00, 'Silangga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (74, 'TRK/0107110028', 'RRI/0107110021', '', '', '2', 0, 0, 'Sebelum Makan', 'YA', '', 60000.00, 'Silangga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (73, 'TRK/0107110027', 'RRI/0107110020', 'ah', '', '1', 0, 1, 'Sebelum Makan', '', '', 20000.00, '', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (72, 'TRK/0107110027', 'RRI/0107110020', 'KK01', '', '2', 0, 3, 'Sesudah Makan', '', '', 12000.00, '', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (69, 'TRK/0107110025', 'RRI/0107110017', 'ah', '', '1', 0, 1, 'Sebelum Makan', '', '', 20000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (70, 'TRK/0107110026', 'RRI/0107110019', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', '34554', 16500.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (71, 'TRK/0107110026', 'RRI/0107110019', 'ah', '', '1', 0, 5, 'Sesudah Makan', '', '', 100000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (67, 'TRK/0107110024', 'RRI/0107110016', 'KK01', '', '1', 0, 1, 'Sebelum Makan', '', '', 4000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (68, 'TRK/0107110024', 'RRI/0107110016', 'ah', '', '1', 0, 3, 'Sesudah Makan', '', '', 60000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (93, 'TRK/0207110040', 'RRI/0207110033', 'KK01', '', '1', 0, 2, 'Sebelum Makan', '', 'sadsd', 8500.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (94, 'TRK/0207110040', 'RRI/0207110033', 'ah', '', '1', 0, 2, 'Sebelum Makan', '', 'asadsa', 40500.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (95, 'TRK/0207110041', '', 'ah', '17/08/2011', '1', 2, 2, 'Sebelum Makan', '', 'rrrrr', 40000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (96, 'TRK/0207110042', '', 'KK01', '28/06/2012', '1', 1, 1, 'Sebelum Makan', '', 'ewewewew', 4000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (97, 'TRK/0207110043', '', 'KK01', '28/06/2012', '1', 2, 2, 'Sebelum Makan', '', 'Bagus untuk kesehatan :)', 8000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (98, 'TRK/0207110044', 'RRI/0207110025', 'KK01', '', '1', 0, 63, 'Sebelum Makan', '', 'dsad', 252000.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (99, 'TRK/0207110044', 'RRI/0207110025', 'ah', '', '1', 0, 2, 'Sebelum Makan', '', 'ada', 40000.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (100, 'TRK/0207110045', '', 'ah', '17/08/2011', '1', 1, 1, 'Sebelum Makan', '', 'kjkjk', 20000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (101, 'TRK/0207110046', 'w3ee', 'KK01', '28/06/2012', '1', 2, 2, 'Sebelum Makan', '', 'dd', 8000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (102, 'TRK/0207110047', 'RRI/0207110034', 'KK01', '', '1', 0, 12, 'Sebelum Makan', '', 'rwfsaafsbsfg', 48500.00, 'Silangga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (103, 'TRK/0207110048', 'RRI/0207110037', 'KK01', '', '1', 0, 3, 'Sebelum Makan', '', '12', 12500.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (104, 'TRK/0207110049', 'RRI/0207110036', 'ah', '', '2', 0, 1, 'Sebelum Makan', '', 'dsdsds', 20500.00, 'Silangga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (105, 'TRK/0207110050', '', '', '', '3', 0, 0, 'Sebelum Makan', 'YA', 'test', 11000.00, 'tuukul', '', 'RCK/0207110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (106, 'TRK/0207110051', '', 'ah', '17/08/2011', '1', 1, 1, 'Sebelum Makan', '', 'kokoko', 20000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (107, 'TRK/0207110052', '', 'ah', '17/08/2011', '1', 1, 1, 'Sebelum Makan', '', 'ewrffd', 20000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (108, 'TRK/0207110053', 'Nbb', 'ah', '17/08/2011', '1', 1, 1, 'Sebelum Makan', '', 'siong', 20000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (109, 'TRK/0207110054', '', 'KK01', '', '2', 3, 0, 'Sebelum Makan', '', '', 0.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (110, 'TRK/0207110054', '', 'KK01', '', '1', 1, 1, 'Sebelum Makan', '', '', 4000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (111, 'TRK/0207110055', 'RRI/0207110038', 'ah', '', '1', 0, 1, 'Sebelum Makan', '', 'daasd', 20500.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (112, 'TRK/0207110055', 'RRI/0207110038', '', '', '1', 0, 0, 'Sesudah Makan', 'YA', 'fd', 27500.00, 'angga', '', 'k_racik', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (113, 'TRK/0307110056', '', 'P001', '', '2', 2, 2, 'Sebelum Makan', '', 'hjhj', 26000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (114, '', '', 'd', '', '2', 1, 1, 'Sebelum Makan', '', '1', 3000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (115, '', '', 'P001', '', '1', 1, 1, 'Sebelum Makan', '', 'wewewewe', 13000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (116, 'TRK/0307110058', '', 'P001', '', '1', 1, 1, 'Sebelum Makan', '', 'hhh', 13000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (117, 'TRK/0307110060', '', 'P001', '', '1', 1, 1, 'Sebelum Makan', '', 'asd', 13000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (118, 'TRK/0307110060', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'lplp', 3000.00, 'koko', '', 'RCK/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (119, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 25000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (120, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 28000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (121, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sesudah Makan', 'YA', 'ggg', 31000.00, 'try again', '', 'RCU/0307110014', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (122, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 1, '0000-00-00');
INSERT INTO `penjualan` VALUES (123, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (124, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (125, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (126, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (127, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (128, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (129, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 1, '0000-00-00');
INSERT INTO `penjualan` VALUES (130, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 1, '0000-00-00');
INSERT INTO `penjualan` VALUES (131, 'TRK/0307110062', '', 'd', '', '1', 2, 2, 'Sebelum Makan', '', '222', 6000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (132, 'TRK/0307110062', '', 'd', '', '1', 1, 1, 'Sebelum Makan', '', '11', 3000.00, '', '', '', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (133, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (134, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 0, '0000-00-00');
INSERT INTO `penjualan` VALUES (135, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 1, '0000-00-00');
INSERT INTO `penjualan` VALUES (136, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 1, '0000-00-00');
INSERT INTO `penjualan` VALUES (137, 'TRK/0307110062', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 31000.00, 'koko', '', 'RCU/0307110001', 1, '0000-00-00');
INSERT INTO `penjualan` VALUES (138, 'TRK/0307110063', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'koko', 12000.00, 'koko', '', 'RCU/0307110001', 1, '2011-07-03');
INSERT INTO `penjualan` VALUES (139, 'TRK/0307110064', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'ddgdgdd', 3000.00, '1212', '', 'RCU/0307110002', 0, '2011-07-03');
INSERT INTO `penjualan` VALUES (140, 'TRK/0307110064', '', 'd', '', '1', 1, 1, 'Sebelum Makan', '', 'huhu', 3000.00, '', '', '', 0, '2001-01-01');
INSERT INTO `penjualan` VALUES (141, 'TRK/0307110064', '', 'd', '', '1', 2, 2, 'Sebelum Makan', '', 'dddd', 6000.00, '', '', '', 0, '2001-01-01');
INSERT INTO `penjualan` VALUES (142, 'TRK/0307110065', '', 'P001', '', '1', 1, 1, 'Sebelum Makan', '', 'swsws', 13000.00, '', '', '', 0, '2001-01-01');
INSERT INTO `penjualan` VALUES (143, 'TRK/0307110065', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'ddgdgdd', 0.00, '1212', '', 'RCU/0307110002', 2, '2011-07-03');
INSERT INTO `penjualan` VALUES (144, 'TRK/0307110065', '', '', '', '2', 0, 0, 'Sebelum Makan', 'YA', 'jijo', 16000.00, '55667', '', 'RCU/0307110003', 0, '2011-07-03');
INSERT INTO `penjualan` VALUES (145, 'TRK/0407110066', '25677', 'd', '', '1', 1, 1, 'Sebelum Makan', '', 'wwed', 3000.00, '', '', '', 2, '2001-01-01');
INSERT INTO `penjualan` VALUES (146, 'TRK/0407110066', '', '', '', '2', 0, 0, 'Sebelum Makan', 'YA', 'Racikan untuk orang stres', 16000.00, 'Umum Gitu', '', 'RCU/0407110001', 0, '2011-07-04');
INSERT INTO `penjualan` VALUES (147, 'TRK/0407110066', '', '', '', '2', 0, 0, 'Sebelum Makan', 'YA', 'Racikan untuk orang stres', 16000.00, 'Umum Gitu', '', 'RCU/0407110001', 1, '2011-07-04');
INSERT INTO `penjualan` VALUES (148, 'TRK/0407110066', '', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'Diminum sebelum makan', 22000.00, 'Criop', '', 'RCU/0407110002', 0, '2011-07-04');
INSERT INTO `penjualan` VALUES (149, 'TRK/0407110066', '25677', 'd', '', '1', 1, 1, 'Sebelum Makan', '', 'ffrff', 3000.00, '', '', '', 1, '2001-01-01');
INSERT INTO `penjualan` VALUES (150, 'TRK/0407110067', '0307110001', 'd', '', '1', 0, 2, 'Sebelum Makan', '', 'sdd', 6500.00, 'Silangga', '', 'k_racik', 0, '2001-01-01');
INSERT INTO `penjualan` VALUES (151, 'TRK/0407110068', '', '', '', '2', 0, 0, 'Sebelum Makan', 'YA', 'Racikan untuk orang stres', 13000.00, 'Umum Gitu', '', 'RCU/0407110001', 0, '2011-07-04');
INSERT INTO `penjualan` VALUES (152, 'TRK/0507110070', '', '', '', '2', 0, 0, 'Sebelum Makan', 'YA', 'khjj', 2300.00, 'indojj', '', 'RCU/0507110001', 1, '2011-07-05');
INSERT INTO `penjualan` VALUES (153, 'TRK/0607110071', 'IGD/0607110027', 'K001', '', '1', 0, 1, 'Sebelum Makan', '', 'huhuhu', 10000.00, 'angga', '', 'k_racik', 0, '2001-01-01');
INSERT INTO `penjualan` VALUES (154, 'TRK/0607110071', 'IGD/0607110027', '', '', '1', 0, 0, 'Sebelum Makan', 'YA', 'diminum malem-malem', 30500.00, 'angga', '', 'k_racik', 0, '2001-01-01');
INSERT INTO `penjualan` VALUES (155, 'TRK/0607110073', 'IGD/0607110033', 'K001', '', '1', 0, 10, 'Sesudah Makan', '', 'wqwqwqwq', 100000.00, 'angga', '', 'k_racik', 0, '2001-01-01');

-- --------------------------------------------------------

-- 
-- Table structure for table `penjualan_head`
-- 

CREATE TABLE `penjualan_head` (
  `id` int(11) unsigned zerofill NOT NULL auto_increment,
  `no_trans` varchar(15) NOT NULL,
  `no_resep` varchar(30) NOT NULL COMMENT 'RRI/ RRJ/ RPU/ RNR/',
  `istunai` tinyint(1) NOT NULL default '1',
  `asuransi_id` int(11) NOT NULL default '0',
  `tgl` date NOT NULL default '2000-01-01',
  `param_no` int(7) NOT NULL,
  `pasien_id` varchar(30) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(30) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(30) NOT NULL,
  `flags` int(2) NOT NULL default '0',
  `fld01` varchar(100) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `total` double default NULL,
  `bayar` double default NULL,
  PRIMARY KEY  (`id`,`no_trans`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=147 ;

-- 
-- Dumping data for table `penjualan_head`
-- 

INSERT INTO `penjualan_head` VALUES (00000000052, 'TRK/2906110001', '', 1, 0, '2011-06-29', 1, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 3, 'Rianan', '', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000053, 'TRK/2906110002', '12365', 1, 0, '2011-06-29', 2, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'Rendom', 'RSDE', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000051, 'RSS123', 'N909', 1, 0, '2011-06-29', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'Nindia', 'RS BErsalin', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000050, 'u8u8', '', 1, 0, '2011-06-29', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'jikk', '', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000049, '909', '', 1, 0, '2011-06-29', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'ddfg', '', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000048, '434343434', 'wwwnns49', 1, 0, '2011-06-29', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'Riadu', 'RS WWW DIO', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000047, 'TRANS00001', '', 1, 0, '2011-06-29', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 3, 'Yayan Sudjana', '', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000054, 'TRK/2906110003', 'enti9090', 1, 0, '2011-06-29', 3, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'entiti', 'RS TNI Medan', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000055, 'TRK/2906110004', '', 1, 0, '2011-06-29', 4, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 3, 'sasadf', '', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000056, 'TRK/2906110005', 't765', 1, 0, '2011-06-29', 5, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'nia', 'bbaa', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000057, 'TRK/2906110006', '', 1, 0, '2011-06-29', 6, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 3, 'derd', '', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000058, 'TRK/3006110007', '', 1, 0, '2011-06-30', 7, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 3, 'angga', '', NULL, 0, NULL);
INSERT INTO `penjualan_head` VALUES (00000000059, 'TRK/3006110008', '2525', 1, 0, '2011-06-30', 8, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'Sindaya', 'RS Jii', NULL, 22000, 200000);
INSERT INTO `penjualan_head` VALUES (00000000060, 'TRK/3006110009', '', 1, 0, '2011-06-30', 9, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, '2500', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000061, 'TRK/3006110010', '25445', 1, 0, '2011-06-30', 10, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 4, 'Hanamasa', 'Jepang', NULL, 22000, 59999);
INSERT INTO `penjualan_head` VALUES (00000000062, '', '', 1, 0, '2000-01-01', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '', 0, NULL, NULL, NULL, 0, 0);
INSERT INTO `penjualan_head` VALUES (00000000063, 'TRK/0107110001', 'BBGT443', 1, 0, '2011-07-01', 1, '', '2011-07-01 00:30:41', '4', '0000-00-00 00:00:00', '', 4, 'Monyet', 'Binatang', NULL, 66000, 100000);
INSERT INTO `penjualan_head` VALUES (00000000064, 'TRK/0107110002', '', 1, 0, '2011-07-01', 2, '', '2011-07-01 01:23:49', 'Hardi', '0000-00-00 00:00:00', '', 3, 'teste', '', NULL, 17600, 45000);
INSERT INTO `penjualan_head` VALUES (00000000065, 'TRK/0107110003', '', 1, 0, '2011-07-01', 3, '', '2011-07-01 01:28:19', 'Hardi', '0000-00-00 00:00:00', '', 4, 'bbb', '', NULL, 22000, 30000);
INSERT INTO `penjualan_head` VALUES (00000000066, 'TRK/0107110004', '', 1, 0, '2011-07-01', 4, '', '2011-07-01 01:28:57', 'Hardi', '0000-00-00 00:00:00', '', 4, 'anggara', '', NULL, 22000, 50000);
INSERT INTO `penjualan_head` VALUES (00000000067, 'TRK/0107110005', '', 1, 0, '2011-07-01', 5, '', '2011-07-01 01:31:28', 'Hardi', '0000-00-00 00:00:00', '', 3, 'angga', '', NULL, 48400, 50000);
INSERT INTO `penjualan_head` VALUES (00000000068, 'TRK/0107110006', '', 1, 0, '2011-07-01', 6, '', '2011-07-01 01:32:35', 'Hardi', '0000-00-00 00:00:00', '', 4, 'test', '', NULL, 4400, 68000);
INSERT INTO `penjualan_head` VALUES (00000000069, 'TRK/0107110007', '', 1, 0, '2011-07-01', 7, '', '2011-07-01 01:34:24', 'Hardi', '0000-00-00 00:00:00', '', 4, 'nininini', '', NULL, 97350, 100000);
INSERT INTO `penjualan_head` VALUES (00000000070, 'TRK/0107110008', 'ty56600', 1, 0, '2011-07-01', 8, '', '2011-07-01 01:51:22', 'Hardi', '0000-00-00 00:00:00', '', 4, 'asda', 'RS.hghhhhfhf', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000081, 'TRK/0107110011', 'RRI/2906110013', 1, 0, '2011-07-01', 11, '', '2011-07-01 06:11:59', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 4400, 10000);
INSERT INTO `penjualan_head` VALUES (00000000080, 'TRK/0107110010', 'RRI/2906110012', 1, 0, '2011-07-01', 10, '', '2011-07-01 06:05:46', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 33000, 50000);
INSERT INTO `penjualan_head` VALUES (00000000079, 'TRK/0107110009', 'RRI/2906110012', 1, 0, '2011-07-01', 9, '', '2011-07-01 05:45:05', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 33000, 50000);
INSERT INTO `penjualan_head` VALUES (00000000078, 'TRK/0107110009', 'RRI/2906110012', 1, 0, '0000-00-00', 0, '', '2011-07-01 05:39:23', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 33000, 500000);
INSERT INTO `penjualan_head` VALUES (00000000077, 'TRK/0107110009', '', 1, 0, '0000-00-00', 0, '', '2011-07-01 05:33:21', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 440000, 1000000);
INSERT INTO `penjualan_head` VALUES (00000000082, 'TRK/0107110012', 'RRI/0107110016', 1, 0, '2011-07-01', 12, '', '2011-07-01 06:25:10', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 100000);
INSERT INTO `penjualan_head` VALUES (00000000083, 'TRK/0107110013', 'RRI/0107110016', 1, 0, '2011-07-01', 13, '', '2011-07-01 06:33:04', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 100000);
INSERT INTO `penjualan_head` VALUES (00000000084, 'TRK/0107110014', 'RRI/0107110016', 1, 0, '2011-07-01', 14, '', '2011-07-01 06:59:36', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 75000);
INSERT INTO `penjualan_head` VALUES (00000000085, 'TRK/0107110014', 'RRI/0107110016', 1, 0, '2011-07-01', 14, '', '2011-07-01 07:02:01', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 75000);
INSERT INTO `penjualan_head` VALUES (00000000086, 'TRK/0107110015', 'RRI/0107110016', 1, 0, '2011-07-01', 15, '', '2011-07-01 07:02:37', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 78000);
INSERT INTO `penjualan_head` VALUES (00000000087, 'TRK/0107110016', 'RRI/0107110016', 1, 0, '2011-07-01', 16, '', '2011-07-01 07:10:50', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 1000000);
INSERT INTO `penjualan_head` VALUES (00000000088, 'TRK/0107110017', 'RRI/0107110016', 1, 0, '2011-07-01', 17, '', '2011-07-01 13:49:29', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 500000);
INSERT INTO `penjualan_head` VALUES (00000000089, 'TRK/0107110017', 'RRI/0107110016', 1, 0, '2011-07-01', 17, '', '2011-07-01 13:49:59', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 500000);
INSERT INTO `penjualan_head` VALUES (00000000090, 'TRK/0107110018', 'RRI/0107110016', 1, 0, '2011-07-01', 18, '', '2011-07-01 13:50:37', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 100000);
INSERT INTO `penjualan_head` VALUES (00000000091, 'TRK/0107110019', 'RCP/gjgj09r8r8', 1, 0, '2011-07-01', 19, '', '2011-07-01 13:55:51', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Rio', 'RS UNANO', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000092, 'TRK/0107110020', 'RRI/0107110016', 1, 0, '2011-07-01', 20, '', '2011-07-01 14:11:07', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 100000);
INSERT INTO `penjualan_head` VALUES (00000000093, 'TRK/0107110021', 'RRI/0107110016', 1, 0, '2011-07-01', 21, '', '2011-07-01 14:20:02', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 209099);
INSERT INTO `penjualan_head` VALUES (00000000094, 'TRK/0107110022', '', 1, 0, '2011-07-01', 22, '', '2011-07-01 14:21:42', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Ibro', '', NULL, 4400, 5000);
INSERT INTO `penjualan_head` VALUES (00000000095, 'TRK/0107110023', 'RRI/0107110016', 1, 0, '2011-07-01', 23, '', '2011-07-01 14:26:37', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 76000);
INSERT INTO `penjualan_head` VALUES (00000000096, 'TRK/0107110023', 'RRI/0107110016', 1, 0, '2011-07-01', 23, '', '2011-07-01 14:29:07', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 76000);
INSERT INTO `penjualan_head` VALUES (00000000097, 'TRK/0107110024', 'RRI/0107110016', 1, 0, '2011-07-01', 24, '', '2011-07-01 14:31:28', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 70400, 80000);
INSERT INTO `penjualan_head` VALUES (00000000098, 'TRK/0107110025', 'RRI/0107110017', 1, 0, '2011-07-01', 25, '', '2011-07-01 14:55:55', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 22000, 52000);
INSERT INTO `penjualan_head` VALUES (00000000099, 'TRK/0107110026', 'RRI/0107110019', 1, 0, '2011-07-01', 26, '', '2011-07-01 15:07:10', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 128150, 150000);
INSERT INTO `penjualan_head` VALUES (00000000100, 'TRK/0107110027', 'RRI/0107110020', 1, 0, '2011-07-01', 27, '', '2011-07-01 15:33:45', 'Hardi', '0000-00-00 00:00:00', '', 1, NULL, NULL, NULL, 35200, 40000);
INSERT INTO `penjualan_head` VALUES (00000000101, 'TRK/0107110028', 'RRI/0107110021', 1, 0, '2011-07-01', 28, 'Silangga', '2011-07-01 15:44:51', 'Hardi', '0000-00-00 00:00:00', '', 1, 'Silangga', NULL, NULL, 110000, 110000);
INSERT INTO `penjualan_head` VALUES (00000000102, 'TRK/0107110029', '', 1, 0, '2011-07-01', 29, '', '2011-07-01 15:49:52', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Singgasana', '', NULL, 110000, 20000);
INSERT INTO `penjualan_head` VALUES (00000000103, 'TRK/0107110030', '', 1, 0, '2011-07-01', 30, '', '2011-07-01 15:59:41', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Sionse', '', NULL, 13200, 15000);
INSERT INTO `penjualan_head` VALUES (00000000104, 'TRK/0107110031', '', 1, 0, '2011-07-01', 31, '', '2011-07-01 16:05:41', 'Hardi', '0000-00-00 00:00:00', '', 4, 'op', '', NULL, 13200, 15000);
INSERT INTO `penjualan_head` VALUES (00000000105, 'TRK/0107110032', '', 1, 0, '2011-07-01', 32, '', '2011-07-01 20:28:52', 'Hardi', '0000-00-00 00:00:00', '', 4, 'test', '', NULL, 22000, 34000);
INSERT INTO `penjualan_head` VALUES (00000000106, 'TRK/0107110033', 'RRI/0107110022', 1, 0, '2011-07-01', 33, 'Silangga', '2011-07-01 20:32:38', 'Hardi', '0000-00-00 00:00:00', '', 1, 'Silangga', NULL, NULL, 13200, 50000);
INSERT INTO `penjualan_head` VALUES (00000000107, 'TRK/0107110034', '', 1, 0, '2011-07-01', 34, '', '2011-07-01 21:59:12', 'Hardi', '0000-00-00 00:00:00', '', 3, 'Dede', '', NULL, 22000, 25000);
INSERT INTO `penjualan_head` VALUES (00000000108, 'TRK/0107110035', '', 1, 0, '2011-07-01', 35, '', '2011-07-01 22:02:11', 'Hardi', '0000-00-00 00:00:00', '', 4, '332ddd', '', NULL, 13200, 15000);
INSERT INTO `penjualan_head` VALUES (00000000109, 'TRK/0207110036', '', 1, 0, '2011-07-02', 36, '', '2011-07-02 00:17:47', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Dede Ariyanto', '', NULL, 17600, 20000);
INSERT INTO `penjualan_head` VALUES (00000000110, 'TRK/0207110037', 'RRI/0207110027', 1, 0, '2011-07-02', 37, 'Silangga', '2011-07-02 01:00:13', 'Hardi', '0000-00-00 00:00:00', '', 1, 'Silangga', NULL, NULL, 44000, 50000);
INSERT INTO `penjualan_head` VALUES (00000000111, 'TRK/0207110038', 'RRI/0207110026', 1, 0, '2011-07-02', 38, 'angga', '2011-07-02 01:21:17', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 531190, 600000);
INSERT INTO `penjualan_head` VALUES (00000000112, 'TRK/0207110039', 'RRI/0207110026', 1, 0, '2011-07-02', 39, 'angga', '2011-07-02 01:47:56', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 531190, 600000);
INSERT INTO `penjualan_head` VALUES (00000000113, 'TRK/0207110040', 'RRI/0207110033', 1, 0, '2011-07-02', 40, 'angga', '2011-07-02 01:50:52', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 132781, 150000);
INSERT INTO `penjualan_head` VALUES (00000000114, 'TRK/0207110041', '', 1, 0, '2011-07-02', 41, '', '2011-07-02 01:52:58', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Rita', '', NULL, 44000, 50000);
INSERT INTO `penjualan_head` VALUES (00000000115, 'TRK/0207110042', '', 1, 0, '2011-07-02', 42, '', '2011-07-02 01:55:31', 'Hardi', '0000-00-00 00:00:00', '', 4, '123rfff', '', NULL, 4400, 5000);
INSERT INTO `penjualan_head` VALUES (00000000116, 'TRK/0207110043', '', 1, 0, '2011-07-02', 43, '', '2011-07-02 02:02:50', 'Hardi', '0000-00-00 00:00:00', '', 4, 'YS', '', NULL, 8800, 10000);
INSERT INTO `penjualan_head` VALUES (00000000117, 'TRK/0207110044', 'RRI/0207110025', 1, 0, '2011-07-02', 44, 'angga', '2011-07-02 02:25:43', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 321200, 230000);
INSERT INTO `penjualan_head` VALUES (00000000118, 'TRK/0207110045', '', 1, 0, '2011-07-02', 45, '', '2011-07-02 02:40:53', 'Hardi', '0000-00-00 00:00:00', '', 4, '7099', '', NULL, 22000, 10000);
INSERT INTO `penjualan_head` VALUES (00000000119, 'TRK/0207110046', 'w3ee', 1, 0, '2011-07-02', 46, '', '2011-07-02 02:44:15', 'Hardi', '0000-00-00 00:00:00', '', 4, 'farmina', 'ninini', NULL, 8800, 10000);
INSERT INTO `penjualan_head` VALUES (00000000120, 'TRK/0207110047', 'RRI/0207110034', 1, 0, '2011-07-02', 47, 'Silangga', '2011-07-02 03:12:16', 'Hardi', '0000-00-00 00:00:00', '', 1, 'Silangga', NULL, NULL, 53350, 200000);
INSERT INTO `penjualan_head` VALUES (00000000121, 'TRK/0207110048', 'RRI/0207110037', 1, 0, '2011-07-02', 48, 'angga', '2011-07-02 03:32:09', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 13750, 15000);
INSERT INTO `penjualan_head` VALUES (00000000122, 'TRK/0207110049', 'RRI/0207110036', 1, 0, '2011-07-02', 49, 'Silangga', '2011-07-02 03:32:54', 'Hardi', '0000-00-00 00:00:00', '', 1, 'Silangga', NULL, NULL, 22550, 30000);
INSERT INTO `penjualan_head` VALUES (00000000123, 'TRK/0207110050', 'test', 1, 0, '2011-07-02', 50, '', '2011-07-02 03:33:54', 'Hardi', '0000-00-00 00:00:00', '', 4, 'yuda', 'kunsyahidan', NULL, 12100, 15000);
INSERT INTO `penjualan_head` VALUES (00000000124, 'TRK/0207110051', '', 1, 0, '2011-07-02', 51, '', '2011-07-02 04:40:33', 'Hardi', '0000-00-00 00:00:00', '', 4, '', '', NULL, 22000, 100000);
INSERT INTO `penjualan_head` VALUES (00000000125, 'TRK/0207110052', '', 1, 0, '2011-07-02', 52, '', '2011-07-02 04:43:28', 'Hardi', '0000-00-00 00:00:00', '', 4, 'diana', '', NULL, 22000, 24000);
INSERT INTO `penjualan_head` VALUES (00000000126, 'TRK/0207110053', 'Nbb', 1, 0, '2011-07-02', 53, '', '2011-07-02 06:14:19', 'Hardi', '0000-00-00 00:00:00', '', 4, 'fiut', 'firang', NULL, 22000, 25000);
INSERT INTO `penjualan_head` VALUES (00000000127, 'TRK/0207110054', '', 1, 0, '2011-07-02', 54, '', '2011-07-02 08:41:21', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Yayan Sudjana', '', NULL, 4400, 10000);
INSERT INTO `penjualan_head` VALUES (00000000128, 'TRK/0207110055', 'RRI/0207110038', 1, 0, '2011-07-02', 55, 'angga', '2011-07-02 08:47:15', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 52800, 100000);
INSERT INTO `penjualan_head` VALUES (00000000129, 'TRK/0307110056', '', 1, 0, '2011-07-03', 56, '', '2011-07-03 17:25:39', 'Hardi', '0000-00-00 00:00:00', '', 4, 'fyfy', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000130, 'TRK/0307110057', '232323232', 1, 0, '2011-07-03', 57, '', '2011-07-03 17:52:42', 'Hardi', '0000-00-00 00:00:00', '', 4, 'gdg', 'gfhdhdhdh', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000131, 'TRK/0307110058', '', 1, 0, '2011-07-03', 58, '', '2011-07-03 17:56:33', 'Hardi', '0000-00-00 00:00:00', '', 4, '232', '', NULL, 14300, 40000);
INSERT INTO `penjualan_head` VALUES (00000000132, 'TRK/0307110059', '', 1, 0, '2011-07-03', 59, '', '2011-07-03 18:01:26', 'Hardi', '0000-00-00 00:00:00', '', 4, 'gigi', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000133, 'TRK/0307110060', '', 1, 0, '2011-07-03', 60, '', '2011-07-03 18:18:18', 'Hardi', '0000-00-00 00:00:00', '', 3, 'angga', '', NULL, 17600, 20000);
INSERT INTO `penjualan_head` VALUES (00000000134, 'TRK/0307110061', '', 1, 0, '2011-07-03', 61, '', '2011-07-03 18:27:28', 'Hardi', '0000-00-00 00:00:00', '', 4, 'sss', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000135, 'TRK/0307110062', '', 1, 0, '2011-07-03', 62, '', '2011-07-03 18:38:40', 'Hardi', '0000-00-00 00:00:00', '', 4, 'uhu', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000136, 'TRK/0307110063', '', 1, 0, '2011-07-03', 63, '', '2011-07-03 19:38:04', 'Hardi', '0000-00-00 00:00:00', '', 4, '12121', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000137, 'TRK/0307110064', '', 1, 0, '2011-07-03', 64, '', '2011-07-03 19:40:52', 'Hardi', '0000-00-00 00:00:00', '', 4, '', '', NULL, 13200, 20000);
INSERT INTO `penjualan_head` VALUES (00000000138, 'TRK/0307110065', '', 1, 0, '2011-07-03', 65, '', '2011-07-03 19:50:06', 'Hardi', '0000-00-00 00:00:00', '', 4, 'swe', '', NULL, 31900, 50000);
INSERT INTO `penjualan_head` VALUES (00000000139, 'TRK/0407110066', '25677', 1, 0, '2011-07-04', 66, '', '2011-07-04 12:59:16', 'Hardi', '0000-00-00 00:00:00', '', 4, 'Sola Ridha', 'RS Bersalin', NULL, 66000, 100000);
INSERT INTO `penjualan_head` VALUES (00000000140, 'TRK/0407110067', '0307110001', 1, 0, '2011-07-04', 67, 'Silangga', '2011-07-04 13:12:01', 'Jalu', '0000-00-00 00:00:00', '', 1, 'Silangga', NULL, NULL, 7150, 9000);
INSERT INTO `penjualan_head` VALUES (00000000141, 'TRK/0407110068', '', 1, 0, '2011-07-04', 68, '', '2011-07-04 22:09:12', 'Hardi', '0000-00-00 00:00:00', '', 4, '', '', NULL, 14300, 15000);
INSERT INTO `penjualan_head` VALUES (00000000142, 'TRK/0507110069', '', 1, 0, '2011-07-05', 69, '', '2011-07-05 00:16:31', 'Hardi', '0000-00-00 00:00:00', '', 4, 'fff', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000143, 'TRK/0507110070', '', 1, 0, '2011-07-05', 70, '', '2011-07-05 03:41:03', 'Hardi', '0000-00-00 00:00:00', '', 4, 'qq', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000144, 'TRK/0607110071', 'IGD/0607110027', 1, 0, '2011-07-06', 71, 'angga', '2011-07-06 01:31:18', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 44550, 50000);
INSERT INTO `penjualan_head` VALUES (00000000145, 'TRK/0607110072', '', 1, 0, '2011-07-06', 72, '', '2011-07-06 05:17:11', 'Hardi', '0000-00-00 00:00:00', '', 4, 'huhuhuhuhuhuh', '', NULL, NULL, NULL);
INSERT INTO `penjualan_head` VALUES (00000000146, 'TRK/0607110073', 'IGD/0607110033', 1, 0, '2011-07-06', 73, 'angga', '2011-07-06 06:26:35', 'Hardi', '0000-00-00 00:00:00', '', 1, 'angga', NULL, NULL, 110000, 110000);

-- --------------------------------------------------------

-- 
-- Table structure for table `permintaan_unit`
-- 

CREATE TABLE `permintaan_unit` (
  `ID` int(11) NOT NULL auto_increment,
  `No_SPP` varchar(20) NOT NULL,
  `No_BPB` varchar(255) default NULL,
  `No_BTB` varchar(255) default NULL,
  `No_RPB` varchar(20) default NULL,
  `param_no` int(7) default '0',
  `param_bpb` int(11) default '0',
  `param_btb` int(11) default '0',
  `param_rpb` int(11) default '0',
  `Tgl_SPP` varchar(10) NOT NULL,
  `Keterangan` text,
  `Tgl_pakai` varchar(20) default NULL,
  `UsrBuat` varchar(5) default NULL,
  `UsrApprove` varchar(5) default NULL,
  `UsrReceived` varchar(255) NOT NULL,
  `UsrRetur` varchar(20) default NULL,
  `Tgl_Cancel` datetime default NULL,
  `Tgl_Received` varchar(10) default NULL,
  `Unit` varchar(10) default NULL,
  `status` int(1) NOT NULL default '5',
  `user_cancel` varchar(100) default NULL,
  `flags_unit` int(1) NOT NULL default '0',
  `tgl_retur` varchar(10) default NULL,
  `tgl_bpb` varchar(10) default NULL,
  `ket_status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=646 ;

-- 
-- Dumping data for table `permintaan_unit`
-- 

INSERT INTO `permintaan_unit` VALUES (636, 'SPP/0507110002', 'BPB/0507110002', 'BTB/0507110002', 'RPB/0607110001', 2, 2, 2, 1, '05/07/2011', NULL, NULL, 'UAPT', 'UFRM', '', 'UAPT', NULL, '05/07/2011', '93', 7, NULL, 0, '06/07/2011', '05/07/2011', 0);
INSERT INTO `permintaan_unit` VALUES (634, 'SPP/0507110001', 'BPB/0507110001', 'BTB/0507110001', NULL, 1, 1, 1, 0, '05/07/2011', NULL, NULL, 'UAPT', 'UFRM', 'UAPT', NULL, NULL, '05/07/2011', '93', 9, NULL, 0, NULL, '05/07/2011', 0);
INSERT INTO `permintaan_unit` VALUES (637, 'SPP/0607110003', 'BPB/0607110003', 'BTB/0607110006', NULL, 3, 3, 6, 0, '06/07/2011', NULL, NULL, 'UAPT', 'UFRM', 'UAPT', NULL, NULL, '06/07/2011', '93', 9, NULL, 0, NULL, '06/07/2011', 0);
INSERT INTO `permintaan_unit` VALUES (638, 'SPP/0607110004', 'BPB/0607110004', NULL, NULL, 4, 4, 0, 0, '06/07/2011', NULL, NULL, 'Hardi', 'UAPT', '', NULL, NULL, NULL, '0', 2, NULL, 0, NULL, '06/07/2011', 1);
INSERT INTO `permintaan_unit` VALUES (639, 'SPP/0607110005', 'BPB/0607110005', 'BTB/0607110007', 'RPB/0607110004', 5, 5, 7, 4, '06/07/2011', NULL, NULL, 'UAPT', 'UFRM', '', 'UAPT', NULL, '06/07/2011', '93', 7, NULL, 0, '06/07/2011', '06/07/2011', 0);
INSERT INTO `permintaan_unit` VALUES (640, 'SPP/0607110006', 'BPB/0607110006', 'BTB/0607110010', NULL, 6, 6, 10, 0, '06/07/2011', NULL, NULL, 'UIGD', 'UAPT', 'UIGD', NULL, NULL, '06/07/2011', '1', 9, NULL, 0, NULL, '06/07/2011', 1);
INSERT INTO `permintaan_unit` VALUES (641, 'SPP/0607110007', 'BPB/0607110007', NULL, NULL, 7, 7, 0, 0, '06/07/2011', NULL, NULL, 'angga', 'UFRM', '', NULL, NULL, NULL, '9', 1, NULL, 0, NULL, '06/07/2011', 0);
INSERT INTO `permintaan_unit` VALUES (642, 'SPP/0607110008', 'BPB/0607110008', 'BTB/0607110011', NULL, 8, 8, 11, 0, '06/07/2011', NULL, NULL, 'UOCA', 'UAPT', 'UOCA', NULL, NULL, '06/07/2011', '80', 9, NULL, 0, NULL, '06/07/2011', 1);
INSERT INTO `permintaan_unit` VALUES (643, 'SPP/0607110009', NULL, NULL, NULL, 9, 0, 0, 0, '06/07/2011', NULL, NULL, 'angga', NULL, '', NULL, NULL, NULL, '9', 1, NULL, 0, NULL, NULL, 0);
INSERT INTO `permintaan_unit` VALUES (644, 'SPP/0607110010', 'BPB/0607110009', NULL, NULL, 10, 9, 0, 0, '06/07/2011', NULL, NULL, 'angga', 'UFRM', '', NULL, NULL, NULL, '9', 1, NULL, 0, NULL, '06/07/2011', 0);
INSERT INTO `permintaan_unit` VALUES (645, 'SPP/0607110011', 'BPB/0607110010', 'BTB/0607110012', NULL, 11, 10, 12, 0, '06/07/2011', NULL, NULL, 'angga', 'UFRM', '', NULL, NULL, '06/07/2011', '9', 2, NULL, 0, NULL, '06/07/2011', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `permintaan_unitdetail`
-- 

CREATE TABLE `permintaan_unitdetail` (
  `id` int(11) NOT NULL auto_increment,
  `No_SPP` varchar(20) NOT NULL,
  `No_BPB` varchar(20) default NULL,
  `No_BTB` varchar(20) default NULL,
  `barang_id` varchar(15) NOT NULL,
  `No_RPB` varchar(20) default NULL,
  `Nm_Barang` varchar(50) NOT NULL,
  `Satuan` varchar(10) NOT NULL,
  `Qty` float NOT NULL,
  `Keterangan` text NOT NULL,
  `Tgl_pakai` varchar(10) NOT NULL,
  `Qty_sisa` float NOT NULL,
  `F_del` int(1) NOT NULL,
  `status_detail` int(1) NOT NULL default '1',
  `flags` int(1) NOT NULL default '1',
  `Unit` int(11) NOT NULL,
  `f2` varchar(255) NOT NULL,
  `f3` varchar(255) NOT NULL,
  `f4` varchar(255) NOT NULL,
  `f5` varchar(255) NOT NULL,
  `f6` varchar(255) NOT NULL,
  `ket_retur` varchar(255) default NULL,
  `tgl_retur` varchar(10) NOT NULL,
  `UsrRetur` varchar(30) NOT NULL,
  `tgl_terima` varchar(10) default NULL,
  `UsrReceived` varchar(150) default NULL,
  `Qty_diberi` float(9,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=207 ;

-- 
-- Dumping data for table `permintaan_unitdetail`
-- 

INSERT INTO `permintaan_unitdetail` VALUES (198, 'SPP/0607110006', 'BPB/0607110006', 'BTB/0607110010', 'K-003', NULL, 'Oskadon Pancen OYE', 'AMP', 10, 'fasdfds', '09/07/2011', 0, 0, 9, 1, 1, '', '', '', '', '', NULL, '', '', '06/07/2011', 'UIGD', 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (197, 'SPP/0607110005', 'BPB/0607110005', 'BTB/0607110007', 'KK01', 'RPB/0607110004', 'Konidin', 'Strip', 2, 'tset', '06/07/2011', 0, 0, 6, 1, 93, '', '', '', '', '', 'expired', '06/07/2011', 'UAPT', NULL, NULL, 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (199, 'SPP/0607110007', '', NULL, 'KK01', NULL, 'Konidin', 'Strip', 6, 'dsd', '21/07/2011', 0, 0, 2, 1, 9, '', '', '', '', '', NULL, '', '', NULL, NULL, 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (200, 'SPP/0607110007', '', NULL, 'd', NULL, 'kdjakf', 'POT', 2, 'dsad', '13/07/2011', 0, 0, 2, 1, 9, '', '', '', '', '', NULL, '', '', NULL, NULL, 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (195, 'SPP/0607110005', 'BPB/0607110005', 'BTB/0607110007', 'K-003', 'RPB/0607110004', 'Oskadon Pancen OYE', 'AMP', 2, 'etset', '06/07/2011', 0, 0, 6, 1, 93, '', '', '', '', '', 'rusak', '06/07/2011', 'UAPT', NULL, NULL, 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (192, 'SPP/0507110002', 'BPB/0507110002', 'BTB/0507110002', 'K-003', 'RPB/0607110001', 'Oskadon Pancen OYE', 'AMP', 4, 'test', '05/07/2011', 0, 0, 6, 1, 93, '', '', '', '', '', 'test', '05/07/2011', 'UAPT', NULL, NULL, 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (193, 'SPP/0607110003', 'BPB/0607110003', 'BTB/0607110005', 'kd_barang51', NULL, 'nama02', 'POT', 3, 'tset', '05/07/2011', 0, 0, 9, 1, 93, '', '', '', '', '', NULL, '', '', '06/07/2011', 'UAPT', 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (194, 'SPP/0607110004', 'BPB/0607110004', NULL, 'K-003', NULL, 'Oskadon Pancen OYE', 'AMP', 10, 'minta obat dong', '17/07/2011', 0, 0, 2, 1, 0, '', '', '', '', '', NULL, '', '', NULL, NULL, 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (190, 'SPP/0507110001', 'BPB/0507110001', 'BTB/0507110001', 'K-003', NULL, 'Oskadon Pancen OYE', 'AMP', 1, 'tetst', '05/07/2011', 0, 0, 9, 1, 93, '', '', '', '', '', NULL, '', '', '05/07/2011', 'UAPT', 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (201, 'SPP/0607110008', '', 'BTB/0607110011', 'K-003', NULL, 'Oskadon Pancen OYE', 'AMP', 5, 'gagagagg', '10/07/2011', 0, 0, 9, 1, 80, '', '', '', '', '', NULL, '', '', '06/07/2011', 'UOCA', 5.00);
INSERT INTO `permintaan_unitdetail` VALUES (202, 'SPP/0607110009', NULL, NULL, 'ah', NULL, 'Phoenix down', 'Botol', 2, 'sda', '13/07/2011', 0, 0, 1, 1, 9, '', '', '', '', '', NULL, '', '', NULL, NULL, 0.00);
INSERT INTO `permintaan_unitdetail` VALUES (203, 'SPP/0607110010', '', NULL, 'KK01', NULL, 'Konidin', 'Strip', 3, 'dss', '12/07/2011', 0, 0, 2, 1, 9, '', '', '', '', '', NULL, '', '', NULL, NULL, 10.00);
INSERT INTO `permintaan_unitdetail` VALUES (204, 'SPP/0607110010', '', NULL, 'd', NULL, 'kdjakf', 'POT', 4, 'sd', '14/07/2011', 0, 0, 2, 1, 9, '', '', '', '', '', NULL, '', '', NULL, NULL, 10.00);
INSERT INTO `permintaan_unitdetail` VALUES (205, 'SPP/0607110011', '', 'BTB/0607110012', 'KK01', NULL, 'Konidin', 'Strip', 7, 'dad', '21/07/2011', 0, 0, 9, 1, 9, '', '', '', '', '', NULL, '', '', '06/07/2011', 'angga', 20.00);
INSERT INTO `permintaan_unitdetail` VALUES (206, 'SPP/0607110011', '', NULL, 'd', NULL, 'kdjakf', 'POT', 3, 'ads', '16/07/2011', 0, 0, 2, 1, 9, '', '', '', '', '', NULL, '', '', NULL, NULL, 17.00);

-- --------------------------------------------------------

-- 
-- Table structure for table `purchase_order`
-- 

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL auto_increment,
  `po_no` varchar(35) NOT NULL,
  `tgl_po` datetime NOT NULL,
  `request_no` varchar(80) default NULL,
  `id_supplier` int(11) NOT NULL,
  `flags` int(1) NOT NULL default '0' COMMENT 'flags',
  `po_approved_by` varchar(50) default NULL,
  `total_price` double NOT NULL default '0' COMMENT 'amount',
  `percent_discount` decimal(10,2) NOT NULL default '0.00',
  `discount_amount` double NOT NULL default '0',
  `after_discount` double NOT NULL default '0',
  `ppn_amount` double NOT NULL default '0',
  `grand_total` double NOT NULL default '0' COMMENT 'GrandTotal',
  `total_items` int(11) NOT NULL default '0',
  `remark` varchar(255) default NULL,
  `is_revisi` int(1) NOT NULL default '0',
  `usr_revisi` varchar(50) default NULL,
  `tgl_revisi` datetime default NULL,
  `usr_cancel` varchar(50) default NULL,
  `tgl_cancel` datetime default NULL,
  `btb_no` varchar(80) NOT NULL default '0' COMMENT 'bukti terima barang',
  `penerima` varchar(30) default NULL COMMENT 'penerima barang',
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(30) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `updated_user` varchar(30) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  PRIMARY KEY  (`id`,`po_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `purchase_order`
-- 

INSERT INTO `purchase_order` VALUES (1, 'PON/2806119999', '2011-06-28 00:18:15', 'SPB/2506110001', 2, 3, NULL, 0, 0.00, 0, 0, 0, 1080000, 1, NULL, 0, NULL, NULL, NULL, NULL, '0', NULL, '2011-06-28 00:18:15', 'Jalu', '2011-07-02 03:11:50', 'pospv', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (2, 'PON/2806119998', '2011-06-28 00:18:15', 'SPB/2506110001', 3, 1, 'Jalu', 0, 0.00, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, '', 'Jalu', '2011-06-28 00:18:15', 'Jalu', '2011-07-06 02:27:58', 'Jalu', '2011-07-06 02:27:58', NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (3, 'PON/2806110005', '2011-06-28 00:18:15', 'SPB/2506110001', 1, 1, 'Jalu', 0, 0.00, 0, 0, 0, 630000, 1, NULL, 0, NULL, NULL, NULL, NULL, 'STB/2506110001', 'Jalu', '2011-06-28 00:18:15', 'Jalu', '2011-07-01 06:40:01', 'Jalu', '2011-07-01 06:40:01', NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (4, 'PON/2806110001', '2011-06-28 04:39:32', 'SPB/2806110008', 2, 1, 'Jalu', 0, 0.00, 0, 0, 0, 3280400, 1, NULL, 0, NULL, NULL, NULL, NULL, '', 'pospv', '2011-06-28 04:39:32', 'Jalu', '2011-07-06 04:56:53', 'pospv', '2011-07-06 04:56:53', NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (5, 'PON/2806110002', '2011-06-28 04:39:32', 'SPB/2806110008', 5, 1, 'pospv', 1290, 0.00, 0, 1290, 38700, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, '', 'pospv', '2011-06-28 04:39:32', 'Jalu', '2011-07-06 04:13:56', 'pospv', '2011-07-06 04:13:56', NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (6, 'PON/2806110003', '2011-06-28 04:39:32', 'SPB/2806110008', 1, 3, NULL, 560, 0.00, 0, 560, 28000, 280000, 1, NULL, 0, NULL, NULL, NULL, NULL, '0', NULL, '2011-06-28 04:39:32', 'Jalu', '2011-07-06 04:20:22', 'pospv', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (7, 'PON/2806110004', '2011-06-28 04:39:32', 'SPB/2806110008', 4, 4, NULL, 0, 0.00, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, '0', NULL, '2011-06-28 04:39:32', 'Jalu', '2011-06-28 04:39:32', 'Jalu', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (8, 'PON/0207110007', '2011-07-05 19:13:45', 'SPB/0207110033', 1, 2, 'Jalu', 0, 0.00, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, '', 'Jalu', '2011-07-05 19:13:45', 'Jalu', '2011-07-05 21:14:28', 'Jalu', '2011-07-05 21:14:28', NULL, NULL, NULL, NULL);
INSERT INTO `purchase_order` VALUES (9, 'PON/0207110007', '2011-07-06 04:46:38', 'RPO/2906110001', 2, 3, NULL, 0, 0.00, 0, 0, 0, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, '0', NULL, '2011-07-06 04:46:38', 'pospv', '2011-07-06 04:46:38', 'pospv', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `purchase_orderdetail`
-- 

CREATE TABLE `purchase_orderdetail` (
  `id` int(11) NOT NULL auto_increment,
  `no_po` varchar(35) NOT NULL,
  `no_spb` varchar(20) NOT NULL,
  `barang_id` varchar(20) NOT NULL,
  `satuan_po` varchar(20) NOT NULL,
  `qty_po` int(11) NOT NULL,
  `harga_po` double NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `amount_discount` double NOT NULL,
  `subtotal` float(14,2) NOT NULL,
  `f_revisi` int(1) NOT NULL,
  `tgl_revisi` datetime NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(30) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `updated_user` varchar(30) NOT NULL,
  `fld01` varchar(100) NOT NULL,
  `fld02` varchar(100) NOT NULL,
  `fld03` varchar(255) NOT NULL,
  `fld04` varchar(255) NOT NULL,
  `fld05` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- 
-- Dumping data for table `purchase_orderdetail`
-- 

INSERT INTO `purchase_orderdetail` VALUES (1, 'PON/2806119999', 'SPB/2506110001', '2', 'box', 120, 9000, 0.00, 0, 1080000.00, 0, '2011-06-29 06:03:11', '2011-06-28 00:18:15', 'Jalu', '2011-07-02 03:11:50', 'pospv', '2', '', '', '', '');
INSERT INTO `purchase_orderdetail` VALUES (2, 'PON/2806119998', 'SPB/2506110001', '3', 'box', 80, 8000, 5.00, 4000, 636000.00, 0, '2011-06-29 06:07:07', '2011-06-28 00:18:15', 'Jalu', '2011-07-06 02:27:58', 'Jalu', '3', '0', 'Jalu', '', '06/07/2011');
INSERT INTO `purchase_orderdetail` VALUES (3, 'PON/2806110005', 'SPB/2506110001', '4', 'box', 70, 9000, 1.00, 900, 630000.00, 0, '0000-00-00 00:00:00', '2011-06-28 00:18:15', 'Jalu', '2011-07-01 06:40:01', 'Jalu', '1', '', '', '', '');
INSERT INTO `purchase_orderdetail` VALUES (4, 'PON/2806110001', 'SPB/2806110008', '31', 'box', 200, 8000, 0.00, 0, 1600000.00, 0, '0000-00-00 00:00:00', '2011-06-28 04:39:32', 'Jalu', '2011-07-06 04:56:53', 'pospv', '2', '0', 'pospv', '', '');
INSERT INTO `purchase_orderdetail` VALUES (5, 'PON/2806110001', 'SPB/2806110008', '34', 'box', 400, 8201, 0.00, 0, 3280400.00, 1, '0000-00-00 00:00:00', '2011-06-28 04:39:32', 'Jalu', '2011-07-06 02:42:25', 'Jalu', '2', '', '', '', '');
INSERT INTO `purchase_orderdetail` VALUES (6, 'PON/2806110002', 'SPB/2806110008', '32', 'btl', 300, 1290, 0.00, 0, 387000.00, 0, '0000-00-00 00:00:00', '2011-06-28 04:39:32', 'Jalu', '2011-07-06 04:13:56', 'pospv', '5', '0', 'pospv', '', '06/07/2011');
INSERT INTO `purchase_orderdetail` VALUES (7, 'PON/2806110003', 'SPB/2806110008', '38', 'dus', 500, 560, 0.00, 0, 280000.00, 0, '0000-00-00 00:00:00', '2011-06-28 04:39:32', 'Jalu', '2011-07-06 04:20:22', 'pospv', '1', '', '', '', '');
INSERT INTO `purchase_orderdetail` VALUES (8, 'PON/2806110004', 'SPB/2806110008', '40', '', 500, 0, 0.00, 0, 400000.00, 0, '0000-00-00 00:00:00', '2011-06-28 04:39:32', 'Jalu', '2011-06-28 04:39:32', 'Jalu', '4', '', '', '', '');
INSERT INTO `purchase_orderdetail` VALUES (9, 'PON/0207110007', 'SPB/0207110033', '35', 'pcs', 150, 800, 0.00, 0, 120000.00, 0, '0000-00-00 00:00:00', '2011-07-05 19:13:45', 'Jalu', '2011-07-05 21:14:28', 'Jalu', '1', '0', 'Jalu', '', '');
INSERT INTO `purchase_orderdetail` VALUES (10, 'PON/0207110007', 'SPB/0207110033', '36', 'pcs', 100, 90890, 0.00, 0, 9089000.00, 0, '0000-00-00 00:00:00', '2011-07-05 19:13:45', 'Jalu', '2011-07-05 21:14:28', 'Jalu', '1', '0', 'Jalu', '', '');
INSERT INTO `purchase_orderdetail` VALUES (11, 'PON/0207110007', 'SPB/0207110033', '37', 'pcs', 50, 99800, 0.00, 0, 4990000.00, 0, '0000-00-00 00:00:00', '2011-07-05 19:13:45', 'Jalu', '2011-07-05 21:14:28', 'Jalu', '1', '0', 'Jalu', '', '');
INSERT INTO `purchase_orderdetail` VALUES (12, 'PON/0207110007', 'RPO/2906110001', '34', '', 400, 8201, 0.00, 0, 3280400.00, 0, '0000-00-00 00:00:00', '2011-07-06 04:46:38', 'pospv', '2011-07-06 04:46:38', 'pospv', '2', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `racik_detail`
-- 

CREATE TABLE `racik_detail` (
  `id` int(11) NOT NULL auto_increment,
  `no_racik` varchar(20) NOT NULL,
  `no_resep` varchar(20) NOT NULL,
  `kode_obat` varchar(20) NOT NULL,
  `qty` float(4,2) NOT NULL,
  `harga` float(14,2) NOT NULL,
  `subtotal` float(14,2) NOT NULL,
  `fld01` varchar(255) NOT NULL,
  `fld02` varchar(255) NOT NULL,
  `fld03` varchar(255) NOT NULL,
  `fld04` varchar(255) NOT NULL,
  `fld05` varchar(255) NOT NULL,
  `fld06` varchar(255) NOT NULL,
  `fld07` varchar(255) NOT NULL,
  `fld08` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=145 ;

-- 
-- Dumping data for table `racik_detail`
-- 

INSERT INTO `racik_detail` VALUES (129, 'RCK/0307110002', 'IGD/0307110005', 'd', 10.00, 3000.00, 30500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (128, 'RCK/0307110002', 'IGD/0307110005', 'P001', 5.00, 13000.00, 65500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (127, 'RCU/0307110014', 'TRK/0307110062', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (126, 'RCU/0307110001', 'TRK/0307110062', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (125, 'RCU/0307110001', 'TRK/0307110062', 'P001', 1.00, 13000.00, 13000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (124, 'RCK/0307110001', 'TRK/0307110060', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (123, 'RCK/0307110001', 'TRK/0307110059', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (122, 'RCK/0207110011', 'RRI/0207110043', 'KK01', 2.00, 4000.00, 8500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (121, 'RCK/0207110011', 'RRI/0207110043', 'KK01', 1.00, 4000.00, 4500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (120, 'RCK/0207110011', 'RRI/0207110043', 'aaangga', 3.00, 30000.00, 90500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (119, 'RCK/0207110001', 'TRK/0207110050', 'KK01', 2.00, 4000.00, 8000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (116, 'RCK/0207110007', 'RRI/0207110033', 'KK01', 1.00, 4000.00, 4500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (118, 'RCK/0207110008', 'RRI/0207110038', 'ah', 1.00, 20000.00, 20500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (117, 'RCK/0207110008', 'RRI/0207110038', 'KK01', 1.00, 4000.00, 4500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (113, 'RCK/0207110006', 'RRI/0207110033', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (112, 'RCK/0207110006', 'RRI/0207110033', 'KK01', 2.00, 4000.00, 8000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (109, 'RCK/0207110004', 'RRI/0207110026', 'ah', 2.00, 20000.00, 40000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (108, 'RCK/0207110004', 'RRI/0207110026', 'ah', 18.00, 20000.00, 360000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (107, 'RCK/0207110004', 'RRI/0207110026', 'ah', 2.00, 20000.00, 40000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (106, 'RCK/0107110001', 'TRK/0107110029', 'ah', 3.00, 20000.00, 60000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (105, 'RCK/0107110002', 'RRI/0107110021', 'ah', 3.00, 20000.00, 60000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (104, 'RCK/0107110001', 'RRI/0107110019', 'KK01', 3.00, 4000.00, 12000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (103, 'RCK/0107110001', 'TRK/0107110007', 'ah', 3.00, 20000.00, 60000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (102, 'RCK/3006110014', 'RRI/3006110015', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (101, 'RCK/2906110001', 'TRK/2906110002', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (100, 'RCK/2906110001', 'TRK/2906110001', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (99, 'RCK/2906110001', 'RSS123', 'ah', 3.00, 20000.00, 60000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (81, 'RCK/2806110001', 'RRI/2806110001', 'KK01', 2.00, 4000.00, 8000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (84, 'RCK/2806110002', 'RRI/2806110001', 'KK01', 1.00, 4000.00, 4000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (85, 'RCK/2806110005', '', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (86, 'RCK/2806110005', '', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (87, 'RCK/2806110006', '2806110006', 'ah', 2.00, 20000.00, 40000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (88, 'RCK/2806110006', '2806110006', 'KK01', 6.00, 4000.00, 24000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (89, '', '', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (90, 'RCK/2906110010', '', 'ah', 2.00, 20000.00, 40000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (91, 'RCK/2906110010', '', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (92, 'RCK/2906110010', 'TRANS00001', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (93, 'RCK/2906110011', 'RRI/2906110012', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (94, 'RCK/2906110012', '434343434', 'ah', 2.00, 20000.00, 40000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (95, 'RCK/2906110012', '909', 'ah', 3.00, 20000.00, 60000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (96, 'RCK/2906110012', 'RRI/2906110013', 'KK01', 1.00, 4000.00, 4000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (97, 'RCK/2906110014', 'u8u8', 'ah', 1.00, 20000.00, 20000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (98, 'RCK/2906110014', 'u8u8', 'ah', 2.00, 20000.00, 40000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (130, 'RCK/0307110002', 'IGD/0307110005', 'P001', 1.00, 13000.00, 13500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (131, 'RCU/0307110002', 'TRK/0307110064', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (132, 'RCU/0307110003', 'TRK/0307110065', 'd', 2.00, 3000.00, 6000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (133, 'RCU/0407110001', 'TRK/0407110066', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (134, 'RCU/0407110001', 'TRK/0407110066', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (135, 'RCU/0407110002', 'TRK/0407110066', 'd', 2.00, 3000.00, 6000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (136, 'RCU/0407110001', 'TRK/0407110068', 'd', 1.00, 3000.00, 3000.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (137, 'RCK/0507110003', 'OCA/0507110002', 'P001', 1.00, 13000.00, 13500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (138, 'RCK/0507110004', 'IGD/0507110001', 'K001', 1.00, 10000.00, 10500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (139, 'RCK/0507110007', 'IGD/0507110006', 'K001', 1.00, 10000.00, 10500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (140, 'RCK/0507110007', 'IGD/0507110006', 'K001', 1.00, 10000.00, 10500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (141, 'RCK/0507110007', 'IGD/0507110006', 'K001', 1.00, 10000.00, 10500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (142, 'RCK/0507110009', 'IGD/0507110008', 'K001', 2.00, 10000.00, 20500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (143, 'RCK/0607110010', 'IGD/0607110027', 'K001', 2.00, 10000.00, 20500.00, '', '', '', '', '', '', '', '');
INSERT INTO `racik_detail` VALUES (144, 'RCK/0607110011', 'IGD/0607110032', 'K001', 1.00, 10000.00, 10500.00, '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `racik_head`
-- 

CREATE TABLE `racik_head` (
  `id` int(11) NOT NULL auto_increment,
  `no_racik` varchar(20) NOT NULL,
  `param_no` int(7) NOT NULL,
  `no_resep` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `dosis_id` varchar(3) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `total` float(14,2) NOT NULL,
  `biaya_racik` float(14,2) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(30) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(30) NOT NULL,
  `tgl` varchar(10) NOT NULL,
  `fld02` varchar(255) NOT NULL,
  `fld03` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=181 ;

-- 
-- Dumping data for table `racik_head`
-- 

INSERT INTO `racik_head` VALUES (108, 'RCK/0107110001', 0, '', 'sona', '1', 'Sebelum Makan', '', 60000.00, 0.00, '2011-07-01 15:50:48', 'Hardi', '0000-00-00 00:00:00', '', '01/07/2011', '', '');
INSERT INTO `racik_head` VALUES (109, 'RCK/0207110003', 3, '', '', '', '', '', 0.00, 0.00, '2011-07-02 00:13:57', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (107, 'RCK/0107110002', 2, 'RRI/0107110021', 'indo', '2', 'Sebelum Makan', '', 60000.00, 0.00, '2011-07-01 15:42:17', 'Hardi', '0000-00-00 00:00:00', '', '01/07/2011', '', '');
INSERT INTO `racik_head` VALUES (105, 'RCK/0107110001', 0, '', 'sona', '1', 'Sebelum Makan', '', 60000.00, 0.00, '2011-07-01 01:39:45', 'Hardi', '0000-00-00 00:00:00', '', '01/07/2011', '', '');
INSERT INTO `racik_head` VALUES (106, 'RCK/0107110001', 1, 'RRI/0107110019', 'sona', '1', 'Sebelum Makan', '', 60000.00, 0.00, '2011-07-01 15:05:22', 'Hardi', '0000-00-00 00:00:00', '', '01/07/2011', '', '');
INSERT INTO `racik_head` VALUES (104, 'RCK/0107110001', 0, '', 'sona', '1', 'Sebelum Makan', '', 60000.00, 0.00, '2011-07-01 01:38:09', 'Hardi', '0000-00-00 00:00:00', '', '01/07/2011', '', '');
INSERT INTO `racik_head` VALUES (103, 'RCK/3006110014', 14, 'RRI/3006110015', 'ssa', '1', 'Sebelum Makan', 'dede', 0.00, 2000.00, '2011-06-30 19:34:40', 'Hardi', '0000-00-00 00:00:00', '', '30/06/2011', '', '');
INSERT INTO `racik_head` VALUES (102, 'RCK/2906110001', 0, '', 'SDK', '3', 'Sebelum Makan', '', 20000.00, 0.00, '2011-06-29 04:43:16', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (101, 'RCK/2906110001', 0, '', 'SDK', '3', 'Sebelum Makan', '', 20000.00, 0.00, '2011-06-29 04:20:53', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (100, 'RCK/2906110001', 0, '', 'SDK', '3', 'Sebelum Makan', '', 20000.00, 0.00, '2011-06-29 03:59:34', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (99, 'RCK/2906110001', 0, '', 'SDK', '3', 'Sebelum Makan', '', 20000.00, 0.00, '2011-06-29 03:54:09', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (98, 'RCK/2906110001', 0, '', 'SDK', '3', 'Sebelum Makan', '', 20000.00, 0.00, '2011-06-29 03:43:56', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (97, 'RCK/2906110014', 0, '', '', '', '', '', 0.00, 0.00, '2011-06-29 03:37:04', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (96, 'RCK/2906110014', 0, '', 'soniiibrol', '2', 'Sebelum Makan', 'siapa', 70000.00, 10000.00, '2011-06-29 03:35:22', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (94, 'RCK/2906110014', 0, '', 'soniiibrol', '2', 'Sebelum Makan', 'siapa', 70000.00, 10000.00, '2011-06-29 03:13:15', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (92, 'RCK/2906110012', 12, 'RRI/2906110013', 'hyhy', '2', 'Sesudah Makan', '', 4000.00, 0.00, '2011-06-29 03:03:03', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (91, 'RCK/2906110012', 0, '', 'hyhy', '2', 'Sesudah Makan', '', 4000.00, 0.00, '2011-06-29 02:57:31', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (93, 'RCK/2906110013', 13, 'RRI/2906110013', '', '', '', '', 0.00, 0.00, '2011-06-29 03:04:14', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (90, 'RCK/2906110012', 0, '', 'hyhy', '2', 'Sesudah Makan', '', 4000.00, 0.00, '2011-06-29 02:52:12', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (89, 'RCK/2906110012', 0, '', 'hyhy', '2', 'Sesudah Makan', '', 4000.00, 0.00, '2011-06-29 02:13:01', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (88, 'RCK/2906110011', 11, 'RRI/2906110012', 'Hidau', '2', 'Sebelum Makan', 'satu', 30000.00, 10000.00, '2011-06-29 02:10:52', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (87, 'RCK/2906110010', 10, 'RRI/2906110011', '', '', '', '', 0.00, 0.00, '2011-06-29 02:08:40', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (86, 'RCK/2906110010', 0, '', '', '', 'Sesudah Makan', '', 0.00, 0.00, '2011-06-29 01:55:57', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (85, 'RCK/2906110010', 0, '', '', '', 'Sesudah Makan', '', 0.00, 0.00, '2011-06-29 01:12:19', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (84, 'RCK/2906110010', 0, '', '', '', 'Sesudah Makan', '', 0.00, 0.00, '2011-06-29 00:09:53', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (83, 'RCK/2906110009', 9, 'RRI/2906110009', '', '', '', '', 0.00, 0.00, '2011-06-28 23:37:51', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (82, 'RCK/2906110008', 8, '', '', '', '', '', 0.00, 0.00, '2011-06-28 23:14:16', 'Hardi', '0000-00-00 00:00:00', '', '29/06/2011', '', '');
INSERT INTO `racik_head` VALUES (81, 'RCK/2806110007', 7, '2806110007', '', '', '', '', 0.00, 0.00, '2011-06-28 22:23:40', 'Hardi', '0000-00-00 00:00:00', '', '28/06/2011', '', '');
INSERT INTO `racik_head` VALUES (80, 'RCK/2806110006', 6, '2806110006', 'dada', '1', 'Sesudah Makan', 'asdd', 66000.00, 2000.00, '2011-06-28 22:22:59', 'Hardi', '0000-00-00 00:00:00', '', '28/06/2011', '', '');
INSERT INTO `racik_head` VALUES (79, 'RCK/2806110005', 5, '', '', '', 'Sesudah Makan', '', 40000.00, 0.00, '2011-06-28 22:17:36', 'Hardi', '0000-00-00 00:00:00', '', '28/06/2011', '', '');
INSERT INTO `racik_head` VALUES (78, 'RCK/2806110004', 4, '2806110007', '', '', 'Sesudah Makan', '', 0.00, 0.00, '2011-06-28 22:14:45', 'Hardi', '0000-00-00 00:00:00', '', '28/06/2011', '', '');
INSERT INTO `racik_head` VALUES (77, 'RCK/2806110003', 3, '2806110004', '', '', '', '', 0.00, 0.00, '2011-06-28 21:59:52', 'Hardi', '0000-00-00 00:00:00', '', '28/06/2011', '', '');
INSERT INTO `racik_head` VALUES (76, 'RCK/2806110002', 2, 'RRI/2806110001', 'racik no2', '1', 'Sesudah Makan', 'dads', 14400.00, 2400.00, '2011-06-28 16:42:22', 'Hardi', '0000-00-00 00:00:00', '', '28/06/2011', '', '');
INSERT INTO `racik_head` VALUES (75, 'RCK/2806110001', 1, 'RRI/2806110001', 'resep 01', '1', 'Sesudah Makan', 'aangga', 10500.00, 2500.00, '2011-06-28 16:40:05', 'Hardi', '0000-00-00 00:00:00', '', '28/06/2011', '', '');
INSERT INTO `racik_head` VALUES (110, 'RCK/0207110004', 4, 'RRI/0207110026', 'adfda', '1', 'Sebelum Makan', 'ada', 442900.00, 2900.00, '2011-07-02 00:14:14', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (111, 'RCK/0207110005', 5, 'RRI/0207110031', '', '', '', '', 0.00, 0.00, '2011-07-02 00:55:07', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (112, 'RCK/0207110006', 6, 'RRI/0207110033', 'racikan 1', '1', 'Sesudah Makan', 'hehehe', 33600.00, 5600.00, '2011-07-02 01:33:21', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (113, 'RCK/0207110007', 7, 'RRI/0207110033', 'test', '1', 'Sesudah Makan', 'sdsd', 38110.00, 5610.00, '2011-07-02 01:43:32', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (114, 'RCK/0207110008', 8, 'RRI/0207110038', 'resep 01', '1', 'Sesudah Makan', 'fd', 27500.00, 2500.00, '2011-07-02 03:25:08', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (115, 'RCK/0207110001', 0, '', 'tuukul', '3', 'Sebelum Makan', 'test', 11000.00, 3000.00, '2011-07-02 03:33:58', 'Hardi', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (116, 'RCK/0207110009', 9, 'RRI/0207110041', '', '', 'Sesudah Makan', '', 0.00, 0.00, '2011-07-02 05:46:40', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (117, 'RCK/0207110010', 10, 'RRI/0207110042', 'testt', '1', 'Sesudah Makan', 'sda', 0.00, 3450.00, '2011-07-02 05:59:42', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (118, 'RCK/0207110011', 11, 'RRI/0207110043', 'hohooh', '1', 'Sebelum Makan', 'sad', 106950.00, 3450.00, '2011-07-02 06:00:33', 'UAPT', '0000-00-00 00:00:00', '', '02/07/2011', '', '');
INSERT INTO `racik_head` VALUES (119, 'RCK/0307110001', 0, '', 'koko', '1', 'Sebelum Makan', 'lplp', 3000.00, 0.00, '2011-07-03 18:02:57', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (120, 'RCK/0307110001', 0, '', '', '', '', '', 3000.00, 0.00, '2011-07-03 18:18:33', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (121, 'RCK/0307110001', 0, '', '', '', '', '', 0.00, 0.00, '2011-07-03 18:27:31', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (122, 'RCK/0307110012', 12, 'RRI/0307110044', '', '', 'Sesudah Makan', '', 0.00, 0.00, '2011-07-03 18:31:33', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (123, 'RCK/0307110013', 13, 'RRI/0307110045', '', '', '', '', 0.00, 0.00, '2011-07-03 18:35:23', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (124, 'RCU/0307110001', 0, '', 'koko', '1', 'Sebelum Makan', 'koko', 12000.00, 12000.00, '2011-07-03 18:38:44', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (125, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:41:38', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (126, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:44:36', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (127, 'RCU/0307110014', 0, '', 'try again', '1', 'Sesudah Makan', 'ggg', 31000.00, 12000.00, '2011-07-03 18:49:13', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (128, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:54:50', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (129, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:55:07', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (130, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:56:15', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (131, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:57:07', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (132, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:57:19', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (133, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 18:57:44', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (134, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:02:00', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (135, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:05:21', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (136, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:06:30', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (137, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:07:08', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (138, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:13:17', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (139, 'RCU/0307110001', 0, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:13:32', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (140, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:17:58', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (141, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:18:18', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (142, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:19:01', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (143, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:19:12', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (144, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:23:00', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (145, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:23:14', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (146, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:24:26', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (147, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:24:58', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (148, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:25:22', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (149, 'RCK/0307110002', 2, 'IGD/0307110005', 'racik', '1', 'Sesudah Makan', 'sdsd', 112950.00, 3450.00, '2011-07-03 19:25:26', 'UAPT', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (150, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:31:29', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (151, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:33:42', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (152, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:34:17', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (153, 'RCU/0307110001', 1, '', '', '', '', '', 12000.00, 0.00, '2011-07-03 19:38:08', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (154, 'RCU/0307110002', 2, '', '1212', '1', 'Sebelum Makan', 'ddgdgdd', 0.00, 0.00, '2011-07-03 19:38:21', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (155, 'RCU/0307110002', 2, '', '1212', '1', 'Sebelum Makan', 'ddgdgdd', 0.00, 0.00, '2011-07-03 19:40:56', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (157, 'RCU/0307110003', 3, '', '55667', '2', 'Sebelum Makan', 'jijo', 16000.00, 10000.00, '2011-07-03 19:55:32', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (156, 'RCU/0307110002', 2, '', '', '', '', '', 0.00, 0.00, '2011-07-03 19:55:12', 'Hardi', '0000-00-00 00:00:00', '', '03/07/2011', '', '');
INSERT INTO `racik_head` VALUES (158, 'RCU/0407110001', 1, '', 'Umum Gitu', '2', 'Sebelum Makan', 'Racikan untuk orang stres', 13000.00, 10000.00, '2011-07-04 13:00:04', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', '', '');
INSERT INTO `racik_head` VALUES (159, 'RCU/0407110001', 1, '', '', '', '', '', 13000.00, 0.00, '2011-07-04 13:02:19', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', '', '');
INSERT INTO `racik_head` VALUES (160, 'RCU/0407110001', 1, '', '', '', '', '', 13000.00, 0.00, '2011-07-04 13:02:47', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', '', '');
INSERT INTO `racik_head` VALUES (161, 'RCU/0407110002', 2, '', 'Criop', '1', 'Sebelum Makan', 'Diminum sebelum makan', 22000.00, 10000.00, '2011-07-04 13:05:20', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', '', '');
INSERT INTO `racik_head` VALUES (162, 'RCK/0407110003', 3, '0407110004', '', '', '', '', 0.00, 0.00, '2011-07-04 14:24:46', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', '', '');
INSERT INTO `racik_head` VALUES (163, 'RCK/0407110004', 4, '0407110005', '', '', '', '', 0.00, 0.00, '2011-07-04 15:25:01', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', '', '');
INSERT INTO `racik_head` VALUES (164, 'RCU/0407110001', 1, '', '', '', '', '', 13000.00, 0.00, '2011-07-04 22:09:17', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', '', '');
INSERT INTO `racik_head` VALUES (165, 'RCU/0507110001', 1, '', 'indojj', '2', 'Sebelum Makan', 'khjj', 2300.00, 2300.00, '2011-07-05 00:18:28', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (166, 'RCU/0507110001', 1, '', '', '', '', '', 2300.00, 0.00, '2011-07-05 03:41:29', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (167, 'RCK/0507110002', 2, 'OCA/0507110001', 'das', '1', 'Sebelum Makan', 'dags', 0.00, 1200.00, '2011-07-05 03:44:31', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (168, 'RCK/0507110003', 3, 'OCA/0507110002', 'ertf', '1', 'Sebelum Makan', 'fgs', 25500.00, 12000.00, '2011-07-05 03:49:07', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (169, 'RCK/0507110004', 4, 'IGD/0507110001', 'CDR', '1', 'Sebelum Makan', '23ew', 10500.00, 0.00, '2011-07-05 04:15:09', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (170, 'RCK/0507110005', 5, 'IGD/0507110003', '1212', '2', 'Sesudah Makan', '', 0.00, 0.00, '2011-07-05 04:19:30', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (171, 'RCK/0507110006', 4, 'IGD/0507110004', 'das', '1', 'Sebelum Makan', '  bbn', 0.00, 1000.00, '2011-07-05 04:39:34', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (172, 'RCK/0507110005', 5, 'IGD/0507110005', '1212', '2', 'Sesudah Makan', '', 0.00, 0.00, '2011-07-05 12:32:05', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (173, 'RCK/0507110006', 6, 'IGD/0507110006', '', '', '', '', 0.00, 0.00, '2011-07-05 12:41:07', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (174, 'RCK/0507110007', 6, 'IGD/0507110006', 'gfgf', '1', 'Sebelum Makan', '', 11500.00, 1000.00, '2011-07-05 12:48:44', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (175, 'RCK/0507110007', 6, 'IGD/0507110006', '', '', '', '', 11500.00, 0.00, '2011-07-05 13:21:14', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (176, 'RCK/0507110007', 7, 'IGD/0507110001', '', '', '', '', 11500.00, 0.00, '2011-07-05 13:23:26', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (177, 'RCK/0507110008', 8, 'IGD/0507110001', '', '', '', '', 0.00, 0.00, '2011-07-05 13:23:52', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (178, 'RCK/0507110009', 9, 'IGD/0507110008', 'coabaaba', '2', 'Sesudah Makan', 'gtgtg', 20500.00, 0.00, '2011-07-05 13:30:06', 'UIGD', '0000-00-00 00:00:00', '', '05/07/2011', '', '');
INSERT INTO `racik_head` VALUES (179, 'RCK/0607110010', 10, 'IGD/0607110027', 'malemmalem', '1', 'Sebelum Makan', 'diminum malem-malem', 30500.00, 10000.00, '2011-07-06 01:28:34', 'Hardi', '0000-00-00 00:00:00', '', '06/07/2011', '', '');
INSERT INTO `racik_head` VALUES (180, 'RCK/0607110011', 11, 'IGD/0607110032', 'racik puyeng', '3', 'Sebelum Makan', 'fefefefe', 12500.00, 2000.00, '2011-07-06 06:12:50', 'UIGD', '0000-00-00 00:00:00', '', '06/07/2011', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `radio_kunjungan`
-- 

CREATE TABLE `radio_kunjungan` (
  `id` bigint(20) NOT NULL auto_increment,
  `pasien_id` int(8) unsigned zerofill NOT NULL,
  `kunjungan_kamar_id` bigint(20) default NULL COMMENT 'diisi jika pasien berasal dari IGD, RAJAL r RANAP',
  `kelas` enum('I','II','III','VIP','TANPA KELAS') default NULL,
  `tgl_daftar` datetime default NULL,
  `tgl_periksa` datetime default NULL,
  `pengirim` varchar(255) default NULL,
  `cara_masuk` enum('IGD','RAWAT JALAN','RAWAT INAP','PASIEN LUAR') NOT NULL,
  `cara_bayar` enum('UMUM','JAMSOSTEK','DANA REKSA DESA','KONTRAK','LAIN-LAIN','ASKES') NOT NULL,
  `jenis_askes` enum('Askes Alba','Askes Blue','Askes Diamond','Askes Gold','Askes Platinum','Askes Silver','Askes Kin','Askes Sosial') default NULL,
  `perusahaan_id` tinyint(3) default NULL,
  `nomor` varchar(255) default NULL,
  `pj_nama` varchar(255) default NULL,
  `pj_alamat` varchar(255) default NULL,
  `pj_telp` varchar(255) default NULL,
  `pj_hubungan_keluarga` enum('AYAH','IBU','SUAMI','ISTRI','SAUDARA','PAMAN','BIBI','LAIN-LAIN') default NULL,
  `catatan_masuk` text,
  `catatan_keluar` text,
  PRIMARY KEY  (`id`),
  KEY `kunjungan_id` (`kunjungan_kamar_id`),
  KEY `kunjungan_kamar_ibfk_5` (`cara_bayar`),
  KEY `dokter_id` (`pengirim`),
  KEY `perusahaan_id` (`perusahaan_id`),
  KEY `pasien_id` (`pasien_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `radio_kunjungan`
-- 

INSERT INTO `radio_kunjungan` VALUES (1, 00151129, 4, 'II', '2011-02-26 23:50:36', '2011-02-26 23:50:36', 'Adi Anggoro, dr', 'IGD', 'UMUM', NULL, NULL, NULL, 'Harjanto', 'JL. GATOT SOEBROTO', '', 'AYAH', NULL, NULL);
INSERT INTO `radio_kunjungan` VALUES (2, 00151129, 4, 'II', '2011-02-26 23:50:36', '2011-02-26 23:50:36', 'Adi Anggoro, dr', 'IGD', 'UMUM', NULL, NULL, NULL, 'Harjanto', 'JL. GATOT SOEBROTO', '', 'AYAH', NULL, NULL);
INSERT INTO `radio_kunjungan` VALUES (3, 00151132, 13, 'III', '2011-05-14 13:25:18', '2011-05-14 13:25:18', 'Sasmito N, dr., Sp. A', 'RAWAT JALAN', 'ASKES', 'Askes Blue', 11, NULL, 'Budi', 'BUMI PANYILEUKAN E9 NO 5', '', 'PAMAN', NULL, NULL);
INSERT INTO `radio_kunjungan` VALUES (4, 00151132, 13, 'III', '2011-05-14 13:26:47', '2011-05-14 13:26:47', 'Sasmito N, dr., Sp. A', 'RAWAT JALAN', 'ASKES', 'Askes Blue', 11, NULL, 'Budi', 'BUMI PANYILEUKAN E9 NO 5', '', 'PAMAN', NULL, NULL);
INSERT INTO `radio_kunjungan` VALUES (5, 00151134, NULL, NULL, NULL, NULL, NULL, 'IGD', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `radio_kunjungan` VALUES (6, 00151135, NULL, NULL, NULL, NULL, NULL, 'RAWAT JALAN', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `radio_kunjungan` VALUES (7, 00000000, NULL, NULL, NULL, NULL, NULL, 'RAWAT JALAN', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `ref_desa`
-- 

CREATE TABLE `ref_desa` (
  `id` int(11) NOT NULL auto_increment,
  `kecamatan_id` int(11) NOT NULL default '0',
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `kecamatan_id` (`kecamatan_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7340 ;

-- 
-- Dumping data for table `ref_desa`
-- 

INSERT INTO `ref_desa` VALUES (1, 1, 'MULYODADI');
INSERT INTO `ref_desa` VALUES (2, 1, 'SIDOMULYO');
INSERT INTO `ref_desa` VALUES (3, 1, 'SUMBERMULYO');
INSERT INTO `ref_desa` VALUES (4, 2, 'BANGUNTAPAN');
INSERT INTO `ref_desa` VALUES (5, 2, 'BATURETNO');
INSERT INTO `ref_desa` VALUES (6, 2, 'JAGALAN');
INSERT INTO `ref_desa` VALUES (7, 2, 'JAMBIDAN');
INSERT INTO `ref_desa` VALUES (8, 2, 'POTORONO');
INSERT INTO `ref_desa` VALUES (9, 2, 'SINGOSAREN');
INSERT INTO `ref_desa` VALUES (10, 2, 'TAMANAN');
INSERT INTO `ref_desa` VALUES (11, 2, 'WIROKERTEN');
INSERT INTO `ref_desa` VALUES (12, 3, 'BANTUL');
INSERT INTO `ref_desa` VALUES (13, 3, 'PALBAPANG');
INSERT INTO `ref_desa` VALUES (14, 3, 'RINGINHARJO');
INSERT INTO `ref_desa` VALUES (15, 3, 'SABDODADI');
INSERT INTO `ref_desa` VALUES (16, 3, 'TRIRENGGO');
INSERT INTO `ref_desa` VALUES (17, 4, 'DLINGO');
INSERT INTO `ref_desa` VALUES (18, 4, 'JATIMULYO');
INSERT INTO `ref_desa` VALUES (19, 4, 'MANGUNAN');
INSERT INTO `ref_desa` VALUES (20, 4, 'MUNTUK');
INSERT INTO `ref_desa` VALUES (21, 4, 'TEMUWUH');
INSERT INTO `ref_desa` VALUES (22, 4, 'TERONG');
INSERT INTO `ref_desa` VALUES (23, 5, 'GIRIREJO');
INSERT INTO `ref_desa` VALUES (24, 5, 'IMOGIRI');
INSERT INTO `ref_desa` VALUES (25, 5, 'KARANGTALUN');
INSERT INTO `ref_desa` VALUES (26, 5, 'KARANGTENGAH');
INSERT INTO `ref_desa` VALUES (27, 5, 'KEBONAGUNG');
INSERT INTO `ref_desa` VALUES (28, 5, 'SELOPAMIORO');
INSERT INTO `ref_desa` VALUES (29, 5, 'SRIHARJO');
INSERT INTO `ref_desa` VALUES (30, 5, 'WUKIRSARI');
INSERT INTO `ref_desa` VALUES (31, 6, 'CANDEN');
INSERT INTO `ref_desa` VALUES (32, 6, 'PATALAN');
INSERT INTO `ref_desa` VALUES (33, 6, 'SUMBERAGUNG');
INSERT INTO `ref_desa` VALUES (34, 6, 'TRIMULYO');
INSERT INTO `ref_desa` VALUES (35, 7, 'BANGUNJIWO');
INSERT INTO `ref_desa` VALUES (36, 7, 'NGESTIHARJO');
INSERT INTO `ref_desa` VALUES (37, 7, 'TAMANTIRTO');
INSERT INTO `ref_desa` VALUES (38, 7, 'TIRTONIRMOLO');
INSERT INTO `ref_desa` VALUES (39, 8, 'DONOTIRTO');
INSERT INTO `ref_desa` VALUES (40, 8, 'PARANGTRITIS');
INSERT INTO `ref_desa` VALUES (41, 8, 'TIRTOHARGO');
INSERT INTO `ref_desa` VALUES (42, 8, 'TIRTOMULYO');
INSERT INTO `ref_desa` VALUES (43, 8, 'TIRTOSARI');
INSERT INTO `ref_desa` VALUES (44, 9, 'GUWOSARI');
INSERT INTO `ref_desa` VALUES (45, 9, 'SENDANGSARI');
INSERT INTO `ref_desa` VALUES (46, 9, 'TRIWIDADI');
INSERT INTO `ref_desa` VALUES (47, 10, 'CATURHARJO');
INSERT INTO `ref_desa` VALUES (48, 10, 'GILANGHARJO');
INSERT INTO `ref_desa` VALUES (49, 10, 'TRIHARJO');
INSERT INTO `ref_desa` VALUES (50, 10, 'WIJIREJO');
INSERT INTO `ref_desa` VALUES (51, 11, 'SITIMULYO');
INSERT INTO `ref_desa` VALUES (52, 11, 'SRIMARTANI');
INSERT INTO `ref_desa` VALUES (53, 11, 'SRIMULYO');
INSERT INTO `ref_desa` VALUES (54, 12, 'BAWURAN');
INSERT INTO `ref_desa` VALUES (55, 12, 'PLERET');
INSERT INTO `ref_desa` VALUES (56, 12, 'SEGOROYOSO');
INSERT INTO `ref_desa` VALUES (57, 12, 'WONOKROMO');
INSERT INTO `ref_desa` VALUES (58, 12, 'WONOLELO');
INSERT INTO `ref_desa` VALUES (59, 13, 'PANJANGREJO');
INSERT INTO `ref_desa` VALUES (60, 13, 'SELOHARJO');
INSERT INTO `ref_desa` VALUES (61, 13, 'SRIHARDONO');
INSERT INTO `ref_desa` VALUES (62, 14, 'GADINGHARJO');
INSERT INTO `ref_desa` VALUES (63, 14, 'GADINGSARI');
INSERT INTO `ref_desa` VALUES (64, 14, 'MURTIGADING');
INSERT INTO `ref_desa` VALUES (65, 14, 'SRIGADING');
INSERT INTO `ref_desa` VALUES (66, 15, 'ARGODADI');
INSERT INTO `ref_desa` VALUES (67, 15, 'ARGOMULYO');
INSERT INTO `ref_desa` VALUES (68, 15, 'ARGOREJO');
INSERT INTO `ref_desa` VALUES (69, 15, 'ARGOSARI');
INSERT INTO `ref_desa` VALUES (70, 16, 'BANGUNHARJO');
INSERT INTO `ref_desa` VALUES (71, 16, 'PANGGUNGHARJO');
INSERT INTO `ref_desa` VALUES (72, 16, 'PENDOWOHARJO');
INSERT INTO `ref_desa` VALUES (73, 16, 'TIMBULHARJO');
INSERT INTO `ref_desa` VALUES (74, 17, 'PONCOSARI');
INSERT INTO `ref_desa` VALUES (75, 17, 'TRIMURTI');
INSERT INTO `ref_desa` VALUES (76, 18, 'JOGOTIRTO');
INSERT INTO `ref_desa` VALUES (77, 18, 'KALITIRTO');
INSERT INTO `ref_desa` VALUES (78, 18, 'SENDANGTIRTO');
INSERT INTO `ref_desa` VALUES (79, 18, 'TEGALTIRTO');
INSERT INTO `ref_desa` VALUES (80, 19, 'ARGOMULYO');
INSERT INTO `ref_desa` VALUES (81, 19, 'GLAGAHHARJO');
INSERT INTO `ref_desa` VALUES (82, 19, 'KEPUHHARJO');
INSERT INTO `ref_desa` VALUES (83, 19, 'UMBULHARJO');
INSERT INTO `ref_desa` VALUES (84, 19, 'WUKIRSARI');
INSERT INTO `ref_desa` VALUES (85, 20, 'CATURTUNGGAL');
INSERT INTO `ref_desa` VALUES (86, 20, 'CONDONGCATUR');
INSERT INTO `ref_desa` VALUES (87, 20, 'MAGUWOHARJO');
INSERT INTO `ref_desa` VALUES (88, 21, 'AMBARKETAWANG');
INSERT INTO `ref_desa` VALUES (89, 21, 'BALECATUR');
INSERT INTO `ref_desa` VALUES (90, 21, 'BANYURADEN');
INSERT INTO `ref_desa` VALUES (91, 21, 'NOGOTIRTO');
INSERT INTO `ref_desa` VALUES (92, 21, 'TRIHANGGO');
INSERT INTO `ref_desa` VALUES (93, 22, 'SIDOAGUNG');
INSERT INTO `ref_desa` VALUES (94, 22, 'SIDOARUM');
INSERT INTO `ref_desa` VALUES (95, 22, 'SIDOKARTO');
INSERT INTO `ref_desa` VALUES (96, 22, 'SIDOLUHUR');
INSERT INTO `ref_desa` VALUES (97, 22, 'SIDOMOYO');
INSERT INTO `ref_desa` VALUES (98, 22, 'SIDOMULYO');
INSERT INTO `ref_desa` VALUES (99, 22, 'SIDOREJO');
INSERT INTO `ref_desa` VALUES (100, 23, 'PURWOMARTANI');
INSERT INTO `ref_desa` VALUES (101, 23, 'SELOMARTANI');
INSERT INTO `ref_desa` VALUES (102, 23, 'TAMANMARTANI');
INSERT INTO `ref_desa` VALUES (103, 23, 'TIRTOMARTANI');
INSERT INTO `ref_desa` VALUES (104, 24, 'SENDANGAGUNG');
INSERT INTO `ref_desa` VALUES (105, 24, 'SENDANGARUM');
INSERT INTO `ref_desa` VALUES (106, 24, 'SENDANGMULYO');
INSERT INTO `ref_desa` VALUES (107, 24, 'SENDANGREJO');
INSERT INTO `ref_desa` VALUES (108, 24, 'SENDANGSARI');
INSERT INTO `ref_desa` VALUES (109, 25, 'SENDANGDADI');
INSERT INTO `ref_desa` VALUES (110, 25, 'SINDUADI');
INSERT INTO `ref_desa` VALUES (111, 25, 'SUMBERADI');
INSERT INTO `ref_desa` VALUES (112, 25, 'TIRTOADI');
INSERT INTO `ref_desa` VALUES (113, 25, 'TLOGOADI');
INSERT INTO `ref_desa` VALUES (114, 26, 'SUMBERAGUNG');
INSERT INTO `ref_desa` VALUES (115, 26, 'SUMBERARUM');
INSERT INTO `ref_desa` VALUES (116, 26, 'SUMBERRAHAYU');
INSERT INTO `ref_desa` VALUES (117, 26, 'SUMBERSARI');
INSERT INTO `ref_desa` VALUES (118, 27, 'DONOHARJO');
INSERT INTO `ref_desa` VALUES (119, 27, 'MINOMARTANI');
INSERT INTO `ref_desa` VALUES (120, 27, 'SARDONOHARJO');
INSERT INTO `ref_desa` VALUES (121, 27, 'SARIHARJO');
INSERT INTO `ref_desa` VALUES (122, 27, 'SINDUHARJO');
INSERT INTO `ref_desa` VALUES (123, 27, 'SUKOHARJO');
INSERT INTO `ref_desa` VALUES (124, 28, 'BIMOMARTANI');
INSERT INTO `ref_desa` VALUES (125, 28, 'SINDUMARTANI');
INSERT INTO `ref_desa` VALUES (126, 28, 'UMBULMARTANI');
INSERT INTO `ref_desa` VALUES (127, 28, 'WEDOMARTANI');
INSERT INTO `ref_desa` VALUES (128, 28, 'WIDODOMARTANI');
INSERT INTO `ref_desa` VALUES (129, 29, 'CANDIBINANGUN');
INSERT INTO `ref_desa` VALUES (130, 29, 'HARGOBINANGUN');
INSERT INTO `ref_desa` VALUES (131, 29, 'HARJOBINANGUN');
INSERT INTO `ref_desa` VALUES (132, 29, 'PAKEMBINANGUN');
INSERT INTO `ref_desa` VALUES (133, 29, 'PURWOBINANGUN');
INSERT INTO `ref_desa` VALUES (134, 30, 'BOKOHARJO');
INSERT INTO `ref_desa` VALUES (135, 30, 'GAYAMHARJO');
INSERT INTO `ref_desa` VALUES (136, 30, 'MADUREJO');
INSERT INTO `ref_desa` VALUES (137, 30, 'SAMBIREJO');
INSERT INTO `ref_desa` VALUES (138, 30, 'SUMBERHARJO');
INSERT INTO `ref_desa` VALUES (139, 30, 'WUKIRHARJO');
INSERT INTO `ref_desa` VALUES (140, 31, 'MARGOAGUNG');
INSERT INTO `ref_desa` VALUES (141, 31, 'MARGODADI');
INSERT INTO `ref_desa` VALUES (142, 31, 'MARGOKATON');
INSERT INTO `ref_desa` VALUES (143, 31, 'MARGOLUWIH');
INSERT INTO `ref_desa` VALUES (144, 31, 'MARGOMULYO');
INSERT INTO `ref_desa` VALUES (145, 32, 'CATURHARJO');
INSERT INTO `ref_desa` VALUES (146, 32, 'PENDOWOHARJO');
INSERT INTO `ref_desa` VALUES (147, 32, 'TRIDADI');
INSERT INTO `ref_desa` VALUES (148, 32, 'TRIHARJO');
INSERT INTO `ref_desa` VALUES (149, 32, 'TRIMULYO');
INSERT INTO `ref_desa` VALUES (150, 33, 'BANYUREJO');
INSERT INTO `ref_desa` VALUES (151, 33, 'LUMBUNGREJO');
INSERT INTO `ref_desa` VALUES (152, 33, 'MARGOREJO');
INSERT INTO `ref_desa` VALUES (153, 33, 'MERDIKOREJO');
INSERT INTO `ref_desa` VALUES (154, 33, 'MOROREJO');
INSERT INTO `ref_desa` VALUES (155, 33, 'PONDOKREJO');
INSERT INTO `ref_desa` VALUES (156, 33, 'SUMBERREJO');
INSERT INTO `ref_desa` VALUES (157, 33, 'TAMBAKREJO');
INSERT INTO `ref_desa` VALUES (158, 34, 'BANGUNKERTO');
INSERT INTO `ref_desa` VALUES (159, 34, 'DONOKERTO');
INSERT INTO `ref_desa` VALUES (160, 34, 'GIRIKERTO');
INSERT INTO `ref_desa` VALUES (161, 34, 'WONOKERTO');
INSERT INTO `ref_desa` VALUES (162, 35, 'BAUSASRAN');
INSERT INTO `ref_desa` VALUES (163, 35, 'SURYATMAJAN');
INSERT INTO `ref_desa` VALUES (164, 35, 'TEGALPANGGUNG');
INSERT INTO `ref_desa` VALUES (165, 36, 'PRINGGOKUSUMAN');
INSERT INTO `ref_desa` VALUES (166, 36, 'SOSROMENDURAN');
INSERT INTO `ref_desa` VALUES (167, 37, 'BACIRO');
INSERT INTO `ref_desa` VALUES (168, 37, 'DEMANGAN');
INSERT INTO `ref_desa` VALUES (169, 37, 'KLITREN');
INSERT INTO `ref_desa` VALUES (170, 37, 'KOTABARU');
INSERT INTO `ref_desa` VALUES (171, 37, 'TERBAN');
INSERT INTO `ref_desa` VALUES (172, 38, 'NGUPASAN');
INSERT INTO `ref_desa` VALUES (173, 38, 'PRAWIRODIRJAN');
INSERT INTO `ref_desa` VALUES (174, 39, 'BUMIJO');
INSERT INTO `ref_desa` VALUES (175, 39, 'COKRODININGRATAN');
INSERT INTO `ref_desa` VALUES (176, 39, 'GOWONGAN');
INSERT INTO `ref_desa` VALUES (177, 40, 'PRENGGAN');
INSERT INTO `ref_desa` VALUES (178, 40, 'PURBAYAN');
INSERT INTO `ref_desa` VALUES (179, 40, 'REJOWINANGUN');
INSERT INTO `ref_desa` VALUES (180, 41, 'KADIPATEN');
INSERT INTO `ref_desa` VALUES (181, 41, 'PANEMBAHAN');
INSERT INTO `ref_desa` VALUES (182, 41, 'PATIHAN');
INSERT INTO `ref_desa` VALUES (183, 42, 'GEDONGKIWO');
INSERT INTO `ref_desa` VALUES (184, 42, 'MANTRIJERON');
INSERT INTO `ref_desa` VALUES (185, 42, 'SURYODININGRATAN');
INSERT INTO `ref_desa` VALUES (186, 43, 'BRONTOKUSUMAN');
INSERT INTO `ref_desa` VALUES (187, 43, 'KEPARAKAN');
INSERT INTO `ref_desa` VALUES (188, 43, 'WIROGUNAN');
INSERT INTO `ref_desa` VALUES (189, 44, 'NGAMPILAN');
INSERT INTO `ref_desa` VALUES (190, 44, 'NOTOPRAJAN');
INSERT INTO `ref_desa` VALUES (191, 45, 'GUNUNGKETUR');
INSERT INTO `ref_desa` VALUES (192, 45, 'PURWOKINANTI');
INSERT INTO `ref_desa` VALUES (193, 46, 'BENER');
INSERT INTO `ref_desa` VALUES (194, 46, 'KARANGWARU');
INSERT INTO `ref_desa` VALUES (195, 46, 'KRICAK');
INSERT INTO `ref_desa` VALUES (196, 46, 'TEGALREJO');
INSERT INTO `ref_desa` VALUES (197, 47, 'GIWANGAN');
INSERT INTO `ref_desa` VALUES (198, 47, 'MUJAMUJU');
INSERT INTO `ref_desa` VALUES (199, 47, 'PANDEYAN');
INSERT INTO `ref_desa` VALUES (200, 47, 'SEMAKI');
INSERT INTO `ref_desa` VALUES (201, 47, 'SOROSUTAN');
INSERT INTO `ref_desa` VALUES (202, 47, 'TAHUNAN');
INSERT INTO `ref_desa` VALUES (203, 47, 'WARUNGBOTO');
INSERT INTO `ref_desa` VALUES (204, 48, 'PAKUNCEN');
INSERT INTO `ref_desa` VALUES (205, 48, 'PATANGPULUHAN');
INSERT INTO `ref_desa` VALUES (206, 48, 'WIROBRAJAN');
INSERT INTO `ref_desa` VALUES (207, 49, 'BANARAN');
INSERT INTO `ref_desa` VALUES (208, 49, 'BROSOT');
INSERT INTO `ref_desa` VALUES (209, 49, 'KARANGSEWU');
INSERT INTO `ref_desa` VALUES (210, 49, 'KRANGGAN');
INSERT INTO `ref_desa` VALUES (211, 49, 'NOMPOREJO');
INSERT INTO `ref_desa` VALUES (212, 49, 'PANDOWAN');
INSERT INTO `ref_desa` VALUES (213, 49, 'TIRTORAHAYU');
INSERT INTO `ref_desa` VALUES (214, 50, 'GIRIPURWO');
INSERT INTO `ref_desa` VALUES (215, 50, 'JATIMULYO');
INSERT INTO `ref_desa` VALUES (216, 50, 'PENDOWOREJO');
INSERT INTO `ref_desa` VALUES (217, 50, 'PURWOSARI');
INSERT INTO `ref_desa` VALUES (218, 51, 'BANJARARUM');
INSERT INTO `ref_desa` VALUES (219, 51, 'BANJARASRI');
INSERT INTO `ref_desa` VALUES (220, 51, 'BANJARHARJO');
INSERT INTO `ref_desa` VALUES (221, 51, 'BANJAROYO');
INSERT INTO `ref_desa` VALUES (222, 52, 'HARGOMULYO');
INSERT INTO `ref_desa` VALUES (223, 52, 'HARGOREJO');
INSERT INTO `ref_desa` VALUES (224, 52, 'HARGOTIRTO');
INSERT INTO `ref_desa` VALUES (225, 52, 'HARGOWILIS');
INSERT INTO `ref_desa` VALUES (226, 52, 'KALIREJO');
INSERT INTO `ref_desa` VALUES (227, 53, 'BUMIREJO');
INSERT INTO `ref_desa` VALUES (228, 53, 'GULUREJO');
INSERT INTO `ref_desa` VALUES (229, 53, 'JATIREJO');
INSERT INTO `ref_desa` VALUES (230, 53, 'NGENTAKREJO');
INSERT INTO `ref_desa` VALUES (231, 53, 'SIDOREJO');
INSERT INTO `ref_desa` VALUES (232, 53, 'WAHYUHARJO');
INSERT INTO `ref_desa` VALUES (233, 54, 'BANYUROTO');
INSERT INTO `ref_desa` VALUES (234, 54, 'DONOMULYO');
INSERT INTO `ref_desa` VALUES (235, 54, 'JATISARONO');
INSERT INTO `ref_desa` VALUES (236, 54, 'KEMBANG');
INSERT INTO `ref_desa` VALUES (237, 54, 'TANJUNGHARJO');
INSERT INTO `ref_desa` VALUES (238, 54, 'WIJIMULYO');
INSERT INTO `ref_desa` VALUES (239, 55, 'BOJONG');
INSERT INTO `ref_desa` VALUES (240, 55, 'BUGEL');
INSERT INTO `ref_desa` VALUES (241, 55, 'CERME');
INSERT INTO `ref_desa` VALUES (242, 55, 'DEPOK');
INSERT INTO `ref_desa` VALUES (243, 55, 'GARONGAN');
INSERT INTO `ref_desa` VALUES (244, 55, 'GOTAKAN');
INSERT INTO `ref_desa` VALUES (245, 55, 'KANOMAN');
INSERT INTO `ref_desa` VALUES (246, 55, 'KREMBANGAN');
INSERT INTO `ref_desa` VALUES (247, 55, 'PANJATAN');
INSERT INTO `ref_desa` VALUES (248, 55, 'PLERET');
INSERT INTO `ref_desa` VALUES (249, 55, 'TAYUBAN');
INSERT INTO `ref_desa` VALUES (250, 56, 'KARANGSARI');
INSERT INTO `ref_desa` VALUES (251, 56, 'KEDUNGSARI');
INSERT INTO `ref_desa` VALUES (252, 56, 'MARGOSARI');
INSERT INTO `ref_desa` VALUES (253, 56, 'PENGASIH');
INSERT INTO `ref_desa` VALUES (254, 56, 'SENDANGSARI');
INSERT INTO `ref_desa` VALUES (255, 56, 'SIDOMULYO');
INSERT INTO `ref_desa` VALUES (256, 56, 'TAWANGSARI');
INSERT INTO `ref_desa` VALUES (257, 57, 'BANJARSARI');
INSERT INTO `ref_desa` VALUES (258, 57, 'GERBOSARI');
INSERT INTO `ref_desa` VALUES (259, 57, 'KEBONHARJO');
INSERT INTO `ref_desa` VALUES (260, 57, 'NGARGOSARI');
INSERT INTO `ref_desa` VALUES (261, 57, 'PAGERHARJO');
INSERT INTO `ref_desa` VALUES (262, 57, 'PURWOHARJO');
INSERT INTO `ref_desa` VALUES (263, 57, 'SIDOHARJO');
INSERT INTO `ref_desa` VALUES (264, 58, 'BANGUNCIPTO');
INSERT INTO `ref_desa` VALUES (265, 58, 'DEMANGREJO');
INSERT INTO `ref_desa` VALUES (266, 58, 'KALIAGUNG');
INSERT INTO `ref_desa` VALUES (267, 58, 'SALAMREJO');
INSERT INTO `ref_desa` VALUES (268, 58, 'SENTOLO');
INSERT INTO `ref_desa` VALUES (269, 58, 'SRIKAYANGAN');
INSERT INTO `ref_desa` VALUES (270, 58, 'SUKORENO');
INSERT INTO `ref_desa` VALUES (271, 58, 'TUKSONO');
INSERT INTO `ref_desa` VALUES (272, 59, 'DEMEN');
INSERT INTO `ref_desa` VALUES (273, 59, 'GLAGAH');
INSERT INTO `ref_desa` VALUES (274, 59, 'JANGKARAN');
INSERT INTO `ref_desa` VALUES (275, 59, 'JANTEN');
INSERT INTO `ref_desa` VALUES (276, 59, 'KALIDENGEN');
INSERT INTO `ref_desa` VALUES (277, 59, 'KALIGINTUNG');
INSERT INTO `ref_desa` VALUES (278, 59, 'KARANGWULUH');
INSERT INTO `ref_desa` VALUES (279, 59, 'KEBONREJO');
INSERT INTO `ref_desa` VALUES (280, 59, 'KEDUNDANG');
INSERT INTO `ref_desa` VALUES (281, 59, 'KULUR');
INSERT INTO `ref_desa` VALUES (282, 59, 'PALIHAN');
INSERT INTO `ref_desa` VALUES (283, 59, 'PLUMBON');
INSERT INTO `ref_desa` VALUES (284, 59, 'SINDUTAN');
INSERT INTO `ref_desa` VALUES (285, 59, 'TEMONKULON');
INSERT INTO `ref_desa` VALUES (286, 59, 'TEMONWETAN');
INSERT INTO `ref_desa` VALUES (287, 60, 'BENDUNGAN');
INSERT INTO `ref_desa` VALUES (288, 60, 'GIRIPENI');
INSERT INTO `ref_desa` VALUES (289, 60, 'KARANGWUNI');
INSERT INTO `ref_desa` VALUES (290, 60, 'KULWARU');
INSERT INTO `ref_desa` VALUES (291, 60, 'NGESTIHARJO');
INSERT INTO `ref_desa` VALUES (292, 60, 'SOGAN');
INSERT INTO `ref_desa` VALUES (293, 60, 'TRIHARJO');
INSERT INTO `ref_desa` VALUES (294, 60, 'WATES');
INSERT INTO `ref_desa` VALUES (295, 61, 'HARGOMULYO');
INSERT INTO `ref_desa` VALUES (296, 61, 'MERTELU');
INSERT INTO `ref_desa` VALUES (297, 61, 'NGALANG');
INSERT INTO `ref_desa` VALUES (298, 61, 'SAMPANG');
INSERT INTO `ref_desa` VALUES (299, 61, 'SERUT');
INSERT INTO `ref_desa` VALUES (300, 61, 'TEGALREJO');
INSERT INTO `ref_desa` VALUES (301, 61, 'WATUGAJAH');
INSERT INTO `ref_desa` VALUES (302, 62, 'BEJIHARJO');
INSERT INTO `ref_desa` VALUES (303, 62, 'BENDUNGAN');
INSERT INTO `ref_desa` VALUES (304, 62, 'GEDANGREJO');
INSERT INTO `ref_desa` VALUES (305, 62, 'JATIAYU');
INSERT INTO `ref_desa` VALUES (306, 62, 'KARANGMOJO');
INSERT INTO `ref_desa` VALUES (307, 62, 'KELOR');
INSERT INTO `ref_desa` VALUES (308, 62, 'NGAWIS');
INSERT INTO `ref_desa` VALUES (309, 62, 'NGIPAK');
INSERT INTO `ref_desa` VALUES (310, 62, 'WILADEG');
INSERT INTO `ref_desa` VALUES (311, 63, 'BEJI');
INSERT INTO `ref_desa` VALUES (312, 63, 'JURANGREJO');
INSERT INTO `ref_desa` VALUES (313, 63, 'KAMPUNG');
INSERT INTO `ref_desa` VALUES (314, 63, 'SAMBIREJO');
INSERT INTO `ref_desa` VALUES (315, 63, 'TANCEP');
INSERT INTO `ref_desa` VALUES (316, 63, 'WATUSIGAR');
INSERT INTO `ref_desa` VALUES (317, 64, 'KATONGAN');
INSERT INTO `ref_desa` VALUES (318, 64, 'KEDUNGKERIS');
INSERT INTO `ref_desa` VALUES (319, 64, 'KEDUNGPOH');
INSERT INTO `ref_desa` VALUES (320, 64, 'NATAH');
INSERT INTO `ref_desa` VALUES (321, 64, 'NGLIPAR');
INSERT INTO `ref_desa` VALUES (322, 64, 'PENGKOL');
INSERT INTO `ref_desa` VALUES (323, 64, 'PILANGREJO');
INSERT INTO `ref_desa` VALUES (324, 65, 'GIRING');
INSERT INTO `ref_desa` VALUES (325, 65, 'GROGOL');
INSERT INTO `ref_desa` VALUES (326, 65, 'KARANGASEM');
INSERT INTO `ref_desa` VALUES (327, 65, 'KARANGDUWET');
INSERT INTO `ref_desa` VALUES (328, 65, 'MULUSAN');
INSERT INTO `ref_desa` VALUES (329, 65, 'PAMPANG');
INSERT INTO `ref_desa` VALUES (330, 65, 'SODO');
INSERT INTO `ref_desa` VALUES (331, 66, 'GIRIASIH');
INSERT INTO `ref_desa` VALUES (332, 66, 'GIRICAHYO');
INSERT INTO `ref_desa` VALUES (333, 66, 'GIRIHARJO');
INSERT INTO `ref_desa` VALUES (334, 66, 'GIRIJATI');
INSERT INTO `ref_desa` VALUES (335, 66, 'GIRIKARTO');
INSERT INTO `ref_desa` VALUES (336, 66, 'GIRIMULYO');
INSERT INTO `ref_desa` VALUES (337, 66, 'GIRIPURWO');
INSERT INTO `ref_desa` VALUES (338, 66, 'GIRISEKAR');
INSERT INTO `ref_desa` VALUES (339, 66, 'GIRISUKO');
INSERT INTO `ref_desa` VALUES (340, 66, 'GIRITIRTO');
INSERT INTO `ref_desa` VALUES (341, 66, 'GIRIWUNGU');
INSERT INTO `ref_desa` VALUES (342, 67, 'BEJI');
INSERT INTO `ref_desa` VALUES (343, 67, 'BUNDER');
INSERT INTO `ref_desa` VALUES (344, 67, 'NGLANGGERAN');
INSERT INTO `ref_desa` VALUES (345, 67, 'NGLEGI');
INSERT INTO `ref_desa` VALUES (346, 67, 'NGOROORO');
INSERT INTO `ref_desa` VALUES (347, 67, 'PATUK');
INSERT INTO `ref_desa` VALUES (348, 67, 'PENGKOK');
INSERT INTO `ref_desa` VALUES (349, 67, 'PUTAT');
INSERT INTO `ref_desa` VALUES (350, 67, 'SALAM');
INSERT INTO `ref_desa` VALUES (351, 67, 'SEMOYO');
INSERT INTO `ref_desa` VALUES (352, 67, 'TERBAH');
INSERT INTO `ref_desa` VALUES (353, 68, 'BANARAN');
INSERT INTO `ref_desa` VALUES (354, 68, 'BANDUNG');
INSERT INTO `ref_desa` VALUES (355, 68, 'BANYUSOCO');
INSERT INTO `ref_desa` VALUES (356, 68, 'BLEBERAN');
INSERT INTO `ref_desa` VALUES (357, 68, 'DENGOK');
INSERT INTO `ref_desa` VALUES (358, 68, 'GADING');
INSERT INTO `ref_desa` VALUES (359, 68, 'GETAS');
INSERT INTO `ref_desa` VALUES (360, 68, 'LOGANDENG');
INSERT INTO `ref_desa` VALUES (361, 68, 'NGAWU');
INSERT INTO `ref_desa` VALUES (362, 68, 'NGLERI');
INSERT INTO `ref_desa` VALUES (363, 68, 'NGUNUT');
INSERT INTO `ref_desa` VALUES (364, 68, 'PLAYEN');
INSERT INTO `ref_desa` VALUES (365, 68, 'PLEMBUTAN');
INSERT INTO `ref_desa` VALUES (366, 69, 'BEDOYO');
INSERT INTO `ref_desa` VALUES (367, 69, 'GENJAHAN');
INSERT INTO `ref_desa` VALUES (368, 69, 'GOMBANG');
INSERT INTO `ref_desa` VALUES (369, 69, 'KARANGASEM');
INSERT INTO `ref_desa` VALUES (370, 69, 'KENTENG');
INSERT INTO `ref_desa` VALUES (371, 69, 'PONJONG');
INSERT INTO `ref_desa` VALUES (372, 69, 'SAWAHAN');
INSERT INTO `ref_desa` VALUES (373, 69, 'SIDOREJO');
INSERT INTO `ref_desa` VALUES (374, 69, 'SUMBERGIRI');
INSERT INTO `ref_desa` VALUES (375, 69, 'TAMBAKKROMO');
INSERT INTO `ref_desa` VALUES (376, 69, 'UMBULREJO');
INSERT INTO `ref_desa` VALUES (377, 70, 'BALONG');
INSERT INTO `ref_desa` VALUES (378, 70, 'BOHOL');
INSERT INTO `ref_desa` VALUES (379, 70, 'BOTODAYAAN');
INSERT INTO `ref_desa` VALUES (380, 70, 'JEPITU');
INSERT INTO `ref_desa` VALUES (381, 70, 'JERUKWUDEL');
INSERT INTO `ref_desa` VALUES (382, 70, 'KARANGAWEN');
INSERT INTO `ref_desa` VALUES (383, 70, 'KARANGWUNI');
INSERT INTO `ref_desa` VALUES (384, 70, 'MELIKAN');
INSERT INTO `ref_desa` VALUES (385, 70, 'NGLINDUR');
INSERT INTO `ref_desa` VALUES (386, 70, 'PETIR');
INSERT INTO `ref_desa` VALUES (387, 70, 'PRINGOMBO');
INSERT INTO `ref_desa` VALUES (388, 70, 'PUCANGANOM');
INSERT INTO `ref_desa` VALUES (389, 70, 'PUCUNG');
INSERT INTO `ref_desa` VALUES (390, 70, 'SEMUGIH');
INSERT INTO `ref_desa` VALUES (391, 70, 'SONGBANYU');
INSERT INTO `ref_desa` VALUES (392, 70, 'TILENG');
INSERT INTO `ref_desa` VALUES (393, 71, 'JETIS');
INSERT INTO `ref_desa` VALUES (394, 71, 'KANIGORO');
INSERT INTO `ref_desa` VALUES (395, 71, 'KEPEK');
INSERT INTO `ref_desa` VALUES (396, 71, 'KRAMBILSAWIT');
INSERT INTO `ref_desa` VALUES (397, 71, 'MONGOL');
INSERT INTO `ref_desa` VALUES (398, 71, 'NGLORO');
INSERT INTO `ref_desa` VALUES (399, 71, 'PLANJAN');
INSERT INTO `ref_desa` VALUES (400, 72, 'CANDIREJO');
INSERT INTO `ref_desa` VALUES (401, 72, 'DADAPAYU');
INSERT INTO `ref_desa` VALUES (402, 72, 'NGEPOSARI');
INSERT INTO `ref_desa` VALUES (403, 72, 'PACAREJO');
INSERT INTO `ref_desa` VALUES (404, 72, 'SEMANU');
INSERT INTO `ref_desa` VALUES (405, 73, 'BENDUNG');
INSERT INTO `ref_desa` VALUES (406, 73, 'BULUREJO');
INSERT INTO `ref_desa` VALUES (407, 73, 'CANDIREJO');
INSERT INTO `ref_desa` VALUES (408, 73, 'KALITEKUK');
INSERT INTO `ref_desa` VALUES (409, 73, 'KARANGSARI');
INSERT INTO `ref_desa` VALUES (410, 73, 'KEMEJING');
INSERT INTO `ref_desa` VALUES (411, 73, 'PUNDUNGSARI');
INSERT INTO `ref_desa` VALUES (412, 73, 'REJOSARI');
INSERT INTO `ref_desa` VALUES (413, 73, 'SEMIN');
INSERT INTO `ref_desa` VALUES (414, 73, 'SUMBERREJO');
INSERT INTO `ref_desa` VALUES (415, 74, 'BANJAREJO');
INSERT INTO `ref_desa` VALUES (416, 74, 'GIRIPANGGUNG');
INSERT INTO `ref_desa` VALUES (417, 74, 'HARGOSARI');
INSERT INTO `ref_desa` VALUES (418, 74, 'KEMADANG');
INSERT INTO `ref_desa` VALUES (419, 74, 'KEMIRI');
INSERT INTO `ref_desa` VALUES (420, 74, 'NGESTIHARJO');
INSERT INTO `ref_desa` VALUES (421, 74, 'PURWODADI');
INSERT INTO `ref_desa` VALUES (422, 74, 'SIDOHARJO');
INSERT INTO `ref_desa` VALUES (423, 74, 'SUMBERWUNGU');
INSERT INTO `ref_desa` VALUES (424, 74, 'TEPUS');
INSERT INTO `ref_desa` VALUES (425, 75, 'BALEHARJO');
INSERT INTO `ref_desa` VALUES (426, 75, 'DUWET');
INSERT INTO `ref_desa` VALUES (427, 75, 'GARI');
INSERT INTO `ref_desa` VALUES (428, 75, 'KARANGREJEK');
INSERT INTO `ref_desa` VALUES (429, 75, 'KARANGTENGAH');
INSERT INTO `ref_desa` VALUES (430, 75, 'KEPEK');
INSERT INTO `ref_desa` VALUES (431, 75, 'MULO');
INSERT INTO `ref_desa` VALUES (432, 75, 'PIYAMAN');
INSERT INTO `ref_desa` VALUES (433, 75, 'PULUTAN');
INSERT INTO `ref_desa` VALUES (434, 75, 'SELANG');
INSERT INTO `ref_desa` VALUES (435, 75, 'SIRAMAN');
INSERT INTO `ref_desa` VALUES (436, 75, 'WARENG');
INSERT INTO `ref_desa` VALUES (437, 75, 'WONOSARI');
INSERT INTO `ref_desa` VALUES (438, 75, 'WUNUNG');
INSERT INTO `ref_desa` VALUES (439, 32, 'ADIMARTANI');
INSERT INTO `ref_desa` VALUES (443, 19, 'UUU');
INSERT INTO `ref_desa` VALUES (445, 80, 'LUAR NEGERI');
INSERT INTO `ref_desa` VALUES (446, 81, 'JOMBANG');
INSERT INTO `ref_desa` VALUES (447, 18, 'XXX');
INSERT INTO `ref_desa` VALUES (448, 20, 'CIPAYUNG');
INSERT INTO `ref_desa` VALUES (449, 20, 'DEPOK');
INSERT INTO `ref_desa` VALUES (450, 20, 'KEMANG');
INSERT INTO `ref_desa` VALUES (451, 20, 'LIMO/DEPOK');
INSERT INTO `ref_desa` VALUES (452, 20, 'PANCORAN MAS');
INSERT INTO `ref_desa` VALUES (453, 20, 'TUGU');
INSERT INTO `ref_desa` VALUES (454, 32, 'TRIHARJO');
INSERT INTO `ref_desa` VALUES (455, 82, 'SANGGARAN AGUNG');
INSERT INTO `ref_desa` VALUES (456, 83, 'BOJONG');
INSERT INTO `ref_desa` VALUES (457, 83, 'BOJONG/BOJONG');
INSERT INTO `ref_desa` VALUES (458, 83, 'GIJAKAN');
INSERT INTO `ref_desa` VALUES (459, 84, 'BAYAH');
INSERT INTO `ref_desa` VALUES (460, 84, 'BAYAH BARAT');
INSERT INTO `ref_desa` VALUES (461, 84, 'BAYAH/BAYAH');
INSERT INTO `ref_desa` VALUES (462, 84, 'BAYANG');
INSERT INTO `ref_desa` VALUES (463, 84, 'CIBALENGGO');
INSERT INTO `ref_desa` VALUES (464, 84, 'CIBALENOK/BAYAH');
INSERT INTO `ref_desa` VALUES (465, 84, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (466, 84, 'CIBARENO /BAYAH');
INSERT INTO `ref_desa` VALUES (467, 84, 'CIBARENO/BAYAH');
INSERT INTO `ref_desa` VALUES (468, 84, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (469, 84, 'CIKAMUNDING/BAYAH');
INSERT INTO `ref_desa` VALUES (470, 84, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (471, 84, 'CIKATOMAS /BAYAH');
INSERT INTO `ref_desa` VALUES (472, 84, 'CILOGERANG/BOYOH');
INSERT INTO `ref_desa` VALUES (473, 84, 'CILOGRAN/BAYAH');
INSERT INTO `ref_desa` VALUES (474, 84, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (475, 84, 'CILOGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (476, 84, 'CILOGRANG/CILOGRANG');
INSERT INTO `ref_desa` VALUES (477, 84, 'CILONGRANG');
INSERT INTO `ref_desa` VALUES (478, 84, 'CIROGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (479, 84, 'CISUNGSANG');
INSERT INTO `ref_desa` VALUES (480, 84, 'GIRI MUKTI');
INSERT INTO `ref_desa` VALUES (481, 84, 'GUNUNGBATU/BAYAH');
INSERT INTO `ref_desa` VALUES (482, 84, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (483, 84, 'PASIR BUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (484, 84, 'PASIR GOMBONG/BAYAH');
INSERT INTO `ref_desa` VALUES (485, 84, 'PASIRBUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (486, 84, 'SAWARNA');
INSERT INTO `ref_desa` VALUES (487, 84, 'SAWARNA/BAYAH');
INSERT INTO `ref_desa` VALUES (488, 84, 'SUKAMULYA SUKATANI');
INSERT INTO `ref_desa` VALUES (489, 84, 'SUWAKAN');
INSERT INTO `ref_desa` VALUES (490, 85, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (491, 85, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (492, 85, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (493, 85, 'CROGRANG');
INSERT INTO `ref_desa` VALUES (494, 85, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (495, 86, 'BAYAH');
INSERT INTO `ref_desa` VALUES (496, 86, 'BAYAH BARAT');
INSERT INTO `ref_desa` VALUES (497, 86, 'BAYAH/BAYAH');
INSERT INTO `ref_desa` VALUES (498, 86, 'BAYANG');
INSERT INTO `ref_desa` VALUES (499, 86, 'CIBALENGGO');
INSERT INTO `ref_desa` VALUES (500, 86, 'CIBALENOK/BAYAH');
INSERT INTO `ref_desa` VALUES (501, 86, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (502, 86, 'CIBARENO /BAYAH');
INSERT INTO `ref_desa` VALUES (503, 86, 'CIBARENO/BAYAH');
INSERT INTO `ref_desa` VALUES (504, 86, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (505, 86, 'CIKAMUNDING/BAYAH');
INSERT INTO `ref_desa` VALUES (506, 86, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (507, 86, 'CIKATOMAS /BAYAH');
INSERT INTO `ref_desa` VALUES (508, 86, 'CILOGERANG/BOYOH');
INSERT INTO `ref_desa` VALUES (509, 86, 'CILOGRAN/BAYAH');
INSERT INTO `ref_desa` VALUES (510, 86, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (511, 86, 'CILOGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (512, 86, 'CILOGRANG/CILOGRANG');
INSERT INTO `ref_desa` VALUES (513, 86, 'CILONGRANG');
INSERT INTO `ref_desa` VALUES (514, 86, 'CIROGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (515, 86, 'CISUNGSANG');
INSERT INTO `ref_desa` VALUES (516, 86, 'GIRI MUKTI');
INSERT INTO `ref_desa` VALUES (517, 86, 'GUNUNGBATU/BAYAH');
INSERT INTO `ref_desa` VALUES (518, 86, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (519, 86, 'PASIR BUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (520, 86, 'PASIR GOMBONG/BAYAH');
INSERT INTO `ref_desa` VALUES (521, 86, 'PASIRBUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (522, 86, 'SAWARNA');
INSERT INTO `ref_desa` VALUES (523, 86, 'SAWARNA/BAYAH');
INSERT INTO `ref_desa` VALUES (524, 86, 'SUKAMULYA SUKATANI');
INSERT INTO `ref_desa` VALUES (525, 86, 'SUWAKAN');
INSERT INTO `ref_desa` VALUES (526, 87, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (527, 87, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (528, 87, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (529, 87, 'CROGRANG');
INSERT INTO `ref_desa` VALUES (530, 87, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (531, 88, 'CIPANAS/CIPANAS');
INSERT INTO `ref_desa` VALUES (532, 88, 'LUHUR JAYA');
INSERT INTO `ref_desa` VALUES (533, 89, 'CIKATOMAS/LEBAK');
INSERT INTO `ref_desa` VALUES (534, 89, 'CISUNGSANG/LEBAK');
INSERT INTO `ref_desa` VALUES (535, 90, 'CIBADAK/RANGKAS BITUNG');
INSERT INTO `ref_desa` VALUES (536, 90, 'CIMANGGEUNTENG');
INSERT INTO `ref_desa` VALUES (537, 90, 'CIMANGGEUNTEUNG');
INSERT INTO `ref_desa` VALUES (538, 90, 'GN BATU');
INSERT INTO `ref_desa` VALUES (539, 90, 'RANGKASBITUNG');
INSERT INTO `ref_desa` VALUES (540, 91, 'PADA ASIH');
INSERT INTO `ref_desa` VALUES (541, 92, 'CILANDAK');
INSERT INTO `ref_desa` VALUES (542, 93, 'CILANDAKBARAT/CILANDAK');
INSERT INTO `ref_desa` VALUES (543, 94, 'CIPUTAT');
INSERT INTO `ref_desa` VALUES (544, 94, 'PISANGAN');
INSERT INTO `ref_desa` VALUES (545, 94, 'REMPOA/CIPUTAT');
INSERT INTO `ref_desa` VALUES (546, 95, 'BATUAMPAR');
INSERT INTO `ref_desa` VALUES (547, 95, 'CIJANTUNG');
INSERT INTO `ref_desa` VALUES (548, 95, 'CILANDAK');
INSERT INTO `ref_desa` VALUES (549, 95, 'CIPOCOK JAYA');
INSERT INTO `ref_desa` VALUES (550, 95, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (551, 95, 'DUREN SAWIT');
INSERT INTO `ref_desa` VALUES (552, 95, 'GROGOL');
INSERT INTO `ref_desa` VALUES (553, 95, 'JAKARAT');
INSERT INTO `ref_desa` VALUES (554, 95, 'JAKARATA');
INSERT INTO `ref_desa` VALUES (555, 95, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (556, 95, 'JAKARTA BARAT');
INSERT INTO `ref_desa` VALUES (557, 95, 'JAKARTA PUSAT');
INSERT INTO `ref_desa` VALUES (558, 95, 'JAKARTA SELATAN');
INSERT INTO `ref_desa` VALUES (559, 95, 'JAKARTA TIMUR/JAKARTA');
INSERT INTO `ref_desa` VALUES (560, 95, 'JAKARTA UTARA');
INSERT INTO `ref_desa` VALUES (561, 95, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (562, 95, 'JOHAR BARU');
INSERT INTO `ref_desa` VALUES (563, 95, 'LAGUA');
INSERT INTO `ref_desa` VALUES (564, 95, 'PAMULANG');
INSERT INTO `ref_desa` VALUES (565, 95, 'PONDOK AREN/');
INSERT INTO `ref_desa` VALUES (566, 95, 'SEMPER BARAT');
INSERT INTO `ref_desa` VALUES (567, 95, 'TANAH ABANG');
INSERT INTO `ref_desa` VALUES (568, 95, 'TEBET');
INSERT INTO `ref_desa` VALUES (569, 96, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (570, 96, 'JAKARTA SELATAN');
INSERT INTO `ref_desa` VALUES (571, 96, 'JAKARTA/JAKARTA SELATAN');
INSERT INTO `ref_desa` VALUES (572, 96, 'MAMPANG');
INSERT INTO `ref_desa` VALUES (573, 97, 'KALIBATA/PANCORAN');
INSERT INTO `ref_desa` VALUES (574, 98, 'PULO');
INSERT INTO `ref_desa` VALUES (575, 98, 'PULO KEBAYORAN BARU');
INSERT INTO `ref_desa` VALUES (576, 99, 'CIPETE UTARA');
INSERT INTO `ref_desa` VALUES (577, 100, 'PEJATEN BARAT/JAKARTA');
INSERT INTO `ref_desa` VALUES (578, 101, 'MANGGARAI/TEBET');
INSERT INTO `ref_desa` VALUES (579, 101, 'TEBET');
INSERT INTO `ref_desa` VALUES (580, 102, 'CAKUNG BARAT');
INSERT INTO `ref_desa` VALUES (581, 102, 'CAKUNG/CAKUNG');
INSERT INTO `ref_desa` VALUES (582, 102, 'CICURUG');
INSERT INTO `ref_desa` VALUES (583, 102, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (584, 102, 'PULO GERANG/CAKUNG');
INSERT INTO `ref_desa` VALUES (585, 103, 'CIPINANG JAKARTA');
INSERT INTO `ref_desa` VALUES (586, 104, 'CIRACAS/JAKARTA TIMUR');
INSERT INTO `ref_desa` VALUES (587, 104, 'PURWA SEGAR');
INSERT INTO `ref_desa` VALUES (588, 105, 'DURENSAWIT /DURENSAWIT JAK-TIM');
INSERT INTO `ref_desa` VALUES (589, 105, 'PONDOK KOPI/DUREN SAWIT');
INSERT INTO `ref_desa` VALUES (590, 106, 'BATUAMPAR');
INSERT INTO `ref_desa` VALUES (591, 106, 'CIJANTUNG');
INSERT INTO `ref_desa` VALUES (592, 106, 'CILANDAK');
INSERT INTO `ref_desa` VALUES (593, 106, 'CIPOCOK JAYA');
INSERT INTO `ref_desa` VALUES (594, 106, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (595, 106, 'DUREN SAWIT');
INSERT INTO `ref_desa` VALUES (596, 106, 'GROGOL');
INSERT INTO `ref_desa` VALUES (597, 106, 'JAKARAT');
INSERT INTO `ref_desa` VALUES (598, 106, 'JAKARATA');
INSERT INTO `ref_desa` VALUES (599, 106, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (600, 106, 'JAKARTA BARAT');
INSERT INTO `ref_desa` VALUES (601, 106, 'JAKARTA PUSAT');
INSERT INTO `ref_desa` VALUES (602, 106, 'JAKARTA SELATAN');
INSERT INTO `ref_desa` VALUES (603, 106, 'JAKARTA TIMUR/JAKARTA');
INSERT INTO `ref_desa` VALUES (604, 106, 'JAKARTA UTARA');
INSERT INTO `ref_desa` VALUES (605, 106, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (606, 106, 'JOHAR BARU');
INSERT INTO `ref_desa` VALUES (607, 106, 'LAGUA');
INSERT INTO `ref_desa` VALUES (608, 106, 'PAMULANG');
INSERT INTO `ref_desa` VALUES (609, 106, 'PONDOK AREN/');
INSERT INTO `ref_desa` VALUES (610, 106, 'SEMPER BARAT');
INSERT INTO `ref_desa` VALUES (611, 106, 'TANAH ABANG');
INSERT INTO `ref_desa` VALUES (612, 106, 'TEBET');
INSERT INTO `ref_desa` VALUES (613, 107, 'KAYU MANIS/JAKARTA TIMUR');
INSERT INTO `ref_desa` VALUES (614, 108, 'JAKARTA TIMUR/JAKARTA');
INSERT INTO `ref_desa` VALUES (615, 108, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (616, 108, 'JL PEMUDA 103');
INSERT INTO `ref_desa` VALUES (617, 108, 'KAYU MANIS/JAKARTA TIMUR');
INSERT INTO `ref_desa` VALUES (618, 108, 'PONDOK KELAPA');
INSERT INTO `ref_desa` VALUES (619, 109, 'BALI MESTER');
INSERT INTO `ref_desa` VALUES (620, 109, 'CIPINANG MUARA');
INSERT INTO `ref_desa` VALUES (621, 110, 'LKELENDER');
INSERT INTO `ref_desa` VALUES (622, 111, 'CILILITAN');
INSERT INTO `ref_desa` VALUES (623, 112, 'PONDOK KACANG');
INSERT INTO `ref_desa` VALUES (624, 113, 'PONDOK LABU /CILANDAK JAKTIM');
INSERT INTO `ref_desa` VALUES (625, 114, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (626, 114, 'KAYU PUTIH');
INSERT INTO `ref_desa` VALUES (627, 114, 'PISANGAN LAMA');
INSERT INTO `ref_desa` VALUES (628, 114, 'PULO GADUNG/JAKTIM');
INSERT INTO `ref_desa` VALUES (629, 115, 'BATUAMPAR');
INSERT INTO `ref_desa` VALUES (630, 115, 'CIJANTUNG');
INSERT INTO `ref_desa` VALUES (631, 115, 'CILANDAK');
INSERT INTO `ref_desa` VALUES (632, 115, 'CIPOCOK JAYA');
INSERT INTO `ref_desa` VALUES (633, 115, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (634, 115, 'DUREN SAWIT');
INSERT INTO `ref_desa` VALUES (635, 115, 'GROGOL');
INSERT INTO `ref_desa` VALUES (636, 115, 'JAKARAT');
INSERT INTO `ref_desa` VALUES (637, 115, 'JAKARATA');
INSERT INTO `ref_desa` VALUES (638, 115, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (639, 115, 'JAKARTA BARAT');
INSERT INTO `ref_desa` VALUES (640, 115, 'JAKARTA PUSAT');
INSERT INTO `ref_desa` VALUES (641, 115, 'JAKARTA SELATAN');
INSERT INTO `ref_desa` VALUES (642, 115, 'JAKARTA TIMUR/JAKARTA');
INSERT INTO `ref_desa` VALUES (643, 115, 'JAKARTA UTARA');
INSERT INTO `ref_desa` VALUES (644, 115, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (645, 115, 'JOHAR BARU');
INSERT INTO `ref_desa` VALUES (646, 115, 'LAGUA');
INSERT INTO `ref_desa` VALUES (647, 115, 'PAMULANG');
INSERT INTO `ref_desa` VALUES (648, 115, 'PONDOK AREN/');
INSERT INTO `ref_desa` VALUES (649, 115, 'SEMPER BARAT');
INSERT INTO `ref_desa` VALUES (650, 115, 'TANAH ABANG');
INSERT INTO `ref_desa` VALUES (651, 115, 'TEBET');
INSERT INTO `ref_desa` VALUES (652, 116, 'JAKARTA PUSAT');
INSERT INTO `ref_desa` VALUES (653, 116, 'JAKARTA PUSAT/JAKARTA PUSAT');
INSERT INTO `ref_desa` VALUES (654, 116, 'JAKPUS');
INSERT INTO `ref_desa` VALUES (655, 116, 'KEBAYORAN');
INSERT INTO `ref_desa` VALUES (656, 116, 'KEBON KACANG');
INSERT INTO `ref_desa` VALUES (657, 117, 'SAWAH BESAR/JAKARTA');
INSERT INTO `ref_desa` VALUES (658, 118, 'KWITANG');
INSERT INTO `ref_desa` VALUES (659, 119, 'KEBON MELATI');
INSERT INTO `ref_desa` VALUES (660, 120, 'TANAH TINGGI');
INSERT INTO `ref_desa` VALUES (661, 121, 'CENGKARENG');
INSERT INTO `ref_desa` VALUES (662, 121, 'KAPUK');
INSERT INTO `ref_desa` VALUES (663, 121, 'KAPUK/CENGKARENG');
INSERT INTO `ref_desa` VALUES (664, 122, 'BATUAMPAR');
INSERT INTO `ref_desa` VALUES (665, 122, 'CIJANTUNG');
INSERT INTO `ref_desa` VALUES (666, 122, 'CILANDAK');
INSERT INTO `ref_desa` VALUES (667, 122, 'CIPOCOK JAYA');
INSERT INTO `ref_desa` VALUES (668, 122, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (669, 122, 'DUREN SAWIT');
INSERT INTO `ref_desa` VALUES (670, 122, 'GROGOL');
INSERT INTO `ref_desa` VALUES (671, 122, 'JAKARAT');
INSERT INTO `ref_desa` VALUES (672, 122, 'JAKARATA');
INSERT INTO `ref_desa` VALUES (673, 122, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (674, 122, 'JAKARTA BARAT');
INSERT INTO `ref_desa` VALUES (675, 122, 'JAKARTA PUSAT');
INSERT INTO `ref_desa` VALUES (676, 122, 'JAKARTA SELATAN');
INSERT INTO `ref_desa` VALUES (677, 122, 'JAKARTA TIMUR/JAKARTA');
INSERT INTO `ref_desa` VALUES (678, 122, 'JAKARTA UTARA');
INSERT INTO `ref_desa` VALUES (679, 122, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (680, 122, 'JOHAR BARU');
INSERT INTO `ref_desa` VALUES (681, 122, 'LAGUA');
INSERT INTO `ref_desa` VALUES (682, 122, 'PAMULANG');
INSERT INTO `ref_desa` VALUES (683, 122, 'PONDOK AREN/');
INSERT INTO `ref_desa` VALUES (684, 122, 'SEMPER BARAT');
INSERT INTO `ref_desa` VALUES (685, 122, 'TANAH ABANG');
INSERT INTO `ref_desa` VALUES (686, 122, 'TEBET');
INSERT INTO `ref_desa` VALUES (687, 123, 'CENGKARENG');
INSERT INTO `ref_desa` VALUES (688, 123, 'JOGLO');
INSERT INTO `ref_desa` VALUES (689, 123, 'KALIDERES/JAKARTA BARAT');
INSERT INTO `ref_desa` VALUES (690, 123, 'RAWABUAYA');
INSERT INTO `ref_desa` VALUES (691, 123, 'TAMBORA');
INSERT INTO `ref_desa` VALUES (692, 124, 'KALIDERES/JAKARTA BARAT');
INSERT INTO `ref_desa` VALUES (693, 125, 'GROGOL');
INSERT INTO `ref_desa` VALUES (694, 125, 'GROGOL PETAMBURAN/JAKARTA BRT');
INSERT INTO `ref_desa` VALUES (695, 126, 'SUKAPURA/CILINCING JAKARTA');
INSERT INTO `ref_desa` VALUES (696, 127, 'GROGOL UTARA /KABAYORANLAMA');
INSERT INTO `ref_desa` VALUES (697, 128, 'BATUAMPAR');
INSERT INTO `ref_desa` VALUES (698, 128, 'CIJANTUNG');
INSERT INTO `ref_desa` VALUES (699, 128, 'CILANDAK');
INSERT INTO `ref_desa` VALUES (700, 128, 'CIPOCOK JAYA');
INSERT INTO `ref_desa` VALUES (701, 128, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (702, 128, 'DUREN SAWIT');
INSERT INTO `ref_desa` VALUES (703, 128, 'GROGOL');
INSERT INTO `ref_desa` VALUES (704, 128, 'JAKARAT');
INSERT INTO `ref_desa` VALUES (705, 128, 'JAKARATA');
INSERT INTO `ref_desa` VALUES (706, 128, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (707, 128, 'JAKARTA BARAT');
INSERT INTO `ref_desa` VALUES (708, 128, 'JAKARTA PUSAT');
INSERT INTO `ref_desa` VALUES (709, 128, 'JAKARTA SELATAN');
INSERT INTO `ref_desa` VALUES (710, 128, 'JAKARTA TIMUR/JAKARTA');
INSERT INTO `ref_desa` VALUES (711, 128, 'JAKARTA UTARA');
INSERT INTO `ref_desa` VALUES (712, 128, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (713, 128, 'JOHAR BARU');
INSERT INTO `ref_desa` VALUES (714, 128, 'LAGUA');
INSERT INTO `ref_desa` VALUES (715, 128, 'PAMULANG');
INSERT INTO `ref_desa` VALUES (716, 128, 'PONDOK AREN/');
INSERT INTO `ref_desa` VALUES (717, 128, 'SEMPER BARAT');
INSERT INTO `ref_desa` VALUES (718, 128, 'TANAH ABANG');
INSERT INTO `ref_desa` VALUES (719, 128, 'TEBET');
INSERT INTO `ref_desa` VALUES (720, 129, 'TG PRIOK');
INSERT INTO `ref_desa` VALUES (721, 129, 'TUGU UTARA');
INSERT INTO `ref_desa` VALUES (722, 130, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (723, 130, 'SANGIANG JAYA');
INSERT INTO `ref_desa` VALUES (724, 130, 'TANJUNG PRIOK');
INSERT INTO `ref_desa` VALUES (725, 130, 'TG PRIOK');
INSERT INTO `ref_desa` VALUES (726, 130, 'WARAKAS');
INSERT INTO `ref_desa` VALUES (727, 131, 'BOJONG');
INSERT INTO `ref_desa` VALUES (728, 131, 'BOJONG/BOJONG');
INSERT INTO `ref_desa` VALUES (729, 131, 'GIJAKAN');
INSERT INTO `ref_desa` VALUES (730, 132, 'BAYAH');
INSERT INTO `ref_desa` VALUES (731, 132, 'BAYAH BARAT');
INSERT INTO `ref_desa` VALUES (732, 132, 'BAYAH/BAYAH');
INSERT INTO `ref_desa` VALUES (733, 132, 'BAYANG');
INSERT INTO `ref_desa` VALUES (734, 132, 'CIBALENGGO');
INSERT INTO `ref_desa` VALUES (735, 132, 'CIBALENOK/BAYAH');
INSERT INTO `ref_desa` VALUES (736, 132, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (737, 132, 'CIBARENO /BAYAH');
INSERT INTO `ref_desa` VALUES (738, 132, 'CIBARENO/BAYAH');
INSERT INTO `ref_desa` VALUES (739, 132, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (740, 132, 'CIKAMUNDING/BAYAH');
INSERT INTO `ref_desa` VALUES (741, 132, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (742, 132, 'CIKATOMAS /BAYAH');
INSERT INTO `ref_desa` VALUES (743, 132, 'CILOGERANG/BOYOH');
INSERT INTO `ref_desa` VALUES (744, 132, 'CILOGRAN/BAYAH');
INSERT INTO `ref_desa` VALUES (745, 132, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (746, 132, 'CILOGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (747, 132, 'CILOGRANG/CILOGRANG');
INSERT INTO `ref_desa` VALUES (748, 132, 'CILONGRANG');
INSERT INTO `ref_desa` VALUES (749, 132, 'CIROGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (750, 132, 'CISUNGSANG');
INSERT INTO `ref_desa` VALUES (751, 132, 'GIRI MUKTI');
INSERT INTO `ref_desa` VALUES (752, 132, 'GUNUNGBATU/BAYAH');
INSERT INTO `ref_desa` VALUES (753, 132, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (754, 132, 'PASIR BUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (755, 132, 'PASIR GOMBONG/BAYAH');
INSERT INTO `ref_desa` VALUES (756, 132, 'PASIRBUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (757, 132, 'SAWARNA');
INSERT INTO `ref_desa` VALUES (758, 132, 'SAWARNA/BAYAH');
INSERT INTO `ref_desa` VALUES (759, 132, 'SUKAMULYA SUKATANI');
INSERT INTO `ref_desa` VALUES (760, 132, 'SUWAKAN');
INSERT INTO `ref_desa` VALUES (761, 133, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (762, 133, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (763, 133, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (764, 133, 'CROGRANG');
INSERT INTO `ref_desa` VALUES (765, 133, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (766, 134, 'BAYAH');
INSERT INTO `ref_desa` VALUES (767, 134, 'BAYAH BARAT');
INSERT INTO `ref_desa` VALUES (768, 134, 'BAYAH/BAYAH');
INSERT INTO `ref_desa` VALUES (769, 134, 'BAYANG');
INSERT INTO `ref_desa` VALUES (770, 134, 'CIBALENGGO');
INSERT INTO `ref_desa` VALUES (771, 134, 'CIBALENOK/BAYAH');
INSERT INTO `ref_desa` VALUES (772, 134, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (773, 134, 'CIBARENO /BAYAH');
INSERT INTO `ref_desa` VALUES (774, 134, 'CIBARENO/BAYAH');
INSERT INTO `ref_desa` VALUES (775, 134, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (776, 134, 'CIKAMUNDING/BAYAH');
INSERT INTO `ref_desa` VALUES (777, 134, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (778, 134, 'CIKATOMAS /BAYAH');
INSERT INTO `ref_desa` VALUES (779, 134, 'CILOGERANG/BOYOH');
INSERT INTO `ref_desa` VALUES (780, 134, 'CILOGRAN/BAYAH');
INSERT INTO `ref_desa` VALUES (781, 134, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (782, 134, 'CILOGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (783, 134, 'CILOGRANG/CILOGRANG');
INSERT INTO `ref_desa` VALUES (784, 134, 'CILONGRANG');
INSERT INTO `ref_desa` VALUES (785, 134, 'CIROGRANG/BAYAH');
INSERT INTO `ref_desa` VALUES (786, 134, 'CISUNGSANG');
INSERT INTO `ref_desa` VALUES (787, 134, 'GIRI MUKTI');
INSERT INTO `ref_desa` VALUES (788, 134, 'GUNUNGBATU/BAYAH');
INSERT INTO `ref_desa` VALUES (789, 134, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (790, 134, 'PASIR BUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (791, 134, 'PASIR GOMBONG/BAYAH');
INSERT INTO `ref_desa` VALUES (792, 134, 'PASIRBUNGUR/BAYAH');
INSERT INTO `ref_desa` VALUES (793, 134, 'SAWARNA');
INSERT INTO `ref_desa` VALUES (794, 134, 'SAWARNA/BAYAH');
INSERT INTO `ref_desa` VALUES (795, 134, 'SUKAMULYA SUKATANI');
INSERT INTO `ref_desa` VALUES (796, 134, 'SUWAKAN');
INSERT INTO `ref_desa` VALUES (797, 135, 'CIBARENO');
INSERT INTO `ref_desa` VALUES (798, 135, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (799, 135, 'CILOGRANG');
INSERT INTO `ref_desa` VALUES (800, 135, 'CROGRANG');
INSERT INTO `ref_desa` VALUES (801, 135, 'PASIR BUNGUR');
INSERT INTO `ref_desa` VALUES (802, 136, 'CIPANAS/CIPANAS');
INSERT INTO `ref_desa` VALUES (803, 136, 'LUHUR JAYA');
INSERT INTO `ref_desa` VALUES (804, 137, 'CIKATOMAS/LEBAK');
INSERT INTO `ref_desa` VALUES (805, 137, 'CISUNGSANG/LEBAK');
INSERT INTO `ref_desa` VALUES (806, 138, 'CIBADAK/RANGKAS BITUNG');
INSERT INTO `ref_desa` VALUES (807, 138, 'CIMANGGEUNTENG');
INSERT INTO `ref_desa` VALUES (808, 138, 'CIMANGGEUNTEUNG');
INSERT INTO `ref_desa` VALUES (809, 138, 'GN BATU');
INSERT INTO `ref_desa` VALUES (810, 138, 'RANGKASBITUNG');
INSERT INTO `ref_desa` VALUES (811, 139, 'ARIGIN PONDOK');
INSERT INTO `ref_desa` VALUES (812, 139, 'BAKOM SARI');
INSERT INTO `ref_desa` VALUES (813, 139, 'BATU LAMPA');
INSERT INTO `ref_desa` VALUES (814, 139, 'BOGOE');
INSERT INTO `ref_desa` VALUES (815, 139, 'BOGOR');
INSERT INTO `ref_desa` VALUES (816, 139, 'BOGOR BARAT');
INSERT INTO `ref_desa` VALUES (817, 139, 'BOGOR TENGAH');
INSERT INTO `ref_desa` VALUES (818, 139, 'BOGOR TIMUR/BOGOR');
INSERT INTO `ref_desa` VALUES (819, 139, 'BOGOR/BOGOR');
INSERT INTO `ref_desa` VALUES (820, 139, 'BTR JATI BOGOR');
INSERT INTO `ref_desa` VALUES (821, 139, 'CADAS NGAMPAR');
INSERT INTO `ref_desa` VALUES (822, 139, 'CAINGIN KULON/CIBADAK');
INSERT INTO `ref_desa` VALUES (823, 139, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (824, 139, 'CIAMPEA');
INSERT INTO `ref_desa` VALUES (825, 139, 'CIAWI');
INSERT INTO `ref_desa` VALUES (826, 139, 'CIAWIBOGOR');
INSERT INTO `ref_desa` VALUES (827, 139, 'CIBINONG/CIANJUR');
INSERT INTO `ref_desa` VALUES (828, 139, 'CIBULU');
INSERT INTO `ref_desa` VALUES (829, 139, 'CICANGKAL');
INSERT INTO `ref_desa` VALUES (830, 139, 'CICURUG');
INSERT INTO `ref_desa` VALUES (831, 139, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (832, 139, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (833, 139, 'CILENGSING');
INSERT INTO `ref_desa` VALUES (834, 139, 'CIMANDE');
INSERT INTO `ref_desa` VALUES (835, 139, 'CIMANGGIS');
INSERT INTO `ref_desa` VALUES (836, 139, 'CIPAYUNG');
INSERT INTO `ref_desa` VALUES (837, 139, 'CIPELANG');
INSERT INTO `ref_desa` VALUES (838, 139, 'CISARUA');
INSERT INTO `ref_desa` VALUES (839, 139, 'CURUG KALONG');
INSERT INTO `ref_desa` VALUES (840, 139, 'CURUG/BOGOR');
INSERT INTO `ref_desa` VALUES (841, 139, 'DARMAGA');
INSERT INTO `ref_desa` VALUES (842, 139, 'DEPOK');
INSERT INTO `ref_desa` VALUES (843, 139, 'DERMAGA/BOGOR');
INSERT INTO `ref_desa` VALUES (844, 139, 'GUNUNG BATU');
INSERT INTO `ref_desa` VALUES (845, 139, 'JEMBATAN DUA/BOGOR');
INSERT INTO `ref_desa` VALUES (846, 139, 'KATULAMPA');
INSERT INTO `ref_desa` VALUES (847, 139, 'KEBON KALAPA');
INSERT INTO `ref_desa` VALUES (848, 139, 'KEDUNG HALANG');
INSERT INTO `ref_desa` VALUES (849, 139, 'KEMANG');
INSERT INTO `ref_desa` VALUES (850, 139, 'KURIPAN');
INSERT INTO `ref_desa` VALUES (851, 139, 'LAWANG GINTUNG');
INSERT INTO `ref_desa` VALUES (852, 139, 'LIDO');
INSERT INTO `ref_desa` VALUES (853, 139, 'OGOR');
INSERT INTO `ref_desa` VALUES (854, 139, 'PANCAWATI/BOGOR');
INSERT INTO `ref_desa` VALUES (855, 139, 'PARUNGPAJANG');
INSERT INTO `ref_desa` VALUES (856, 139, 'PASIR JAYA');
INSERT INTO `ref_desa` VALUES (857, 139, 'POLOEMPANG');
INSERT INTO `ref_desa` VALUES (858, 139, 'PRAJA 9 NO 3 BOGOR');
INSERT INTO `ref_desa` VALUES (859, 139, 'SEMPLAK');
INSERT INTO `ref_desa` VALUES (860, 139, 'SUUKASARI');
INSERT INTO `ref_desa` VALUES (861, 139, 'TANAH SAREAL');
INSERT INTO `ref_desa` VALUES (862, 139, 'TEGAL LEGA');
INSERT INTO `ref_desa` VALUES (863, 139, 'WAAATES JAYA');
INSERT INTO `ref_desa` VALUES (864, 139, 'WARINGIN');
INSERT INTO `ref_desa` VALUES (865, 140, 'CIMANGGIS');
INSERT INTO `ref_desa` VALUES (866, 140, 'KEDUNG WARINGIN');
INSERT INTO `ref_desa` VALUES (867, 141, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (868, 141, '01-APR');
INSERT INTO `ref_desa` VALUES (869, 141, 'AGRAK');
INSERT INTO `ref_desa` VALUES (870, 141, 'AINGIN');
INSERT INTO `ref_desa` VALUES (871, 141, 'ARAINGIN');
INSERT INTO `ref_desa` VALUES (872, 141, 'ARINGIN');
INSERT INTO `ref_desa` VALUES (873, 141, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (874, 141, 'BABAKAN LEUNGIS');
INSERT INTO `ref_desa` VALUES (875, 141, 'BATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (876, 141, 'BOBOJONG');
INSERT INTO `ref_desa` VALUES (877, 141, 'BOBOJONG/CARINGIN');
INSERT INTO `ref_desa` VALUES (878, 141, 'BOJONG KONENG');
INSERT INTO `ref_desa` VALUES (879, 141, 'BOJONG/CARINGIN');
INSERT INTO `ref_desa` VALUES (880, 141, 'CAAAARINGI CIJARIAN');
INSERT INTO `ref_desa` VALUES (881, 141, 'CAARINGIN WETAN/CIBADAK');
INSERT INTO `ref_desa` VALUES (882, 141, 'CANTAYAN');
INSERT INTO `ref_desa` VALUES (883, 141, 'CANTAYAN/CANTAYAN');
INSERT INTO `ref_desa` VALUES (884, 141, 'CARAINGIN');
INSERT INTO `ref_desa` VALUES (885, 141, 'CARGIN');
INSERT INTO `ref_desa` VALUES (886, 141, 'CARIGIN');
INSERT INTO `ref_desa` VALUES (887, 141, 'CARIINGIN WETAN');
INSERT INTO `ref_desa` VALUES (888, 141, 'CARIMGIN KULON');
INSERT INTO `ref_desa` VALUES (889, 141, 'CARINGAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (890, 141, 'CARINGI KULON');
INSERT INTO `ref_desa` VALUES (891, 141, 'CARINGI WETAN');
INSERT INTO `ref_desa` VALUES (892, 141, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (893, 141, 'CARINGIN  KULON');
INSERT INTO `ref_desa` VALUES (894, 141, 'CARINGIN / CARINGIN');
INSERT INTO `ref_desa` VALUES (895, 141, 'CARINGIN / CIBADAK');
INSERT INTO `ref_desa` VALUES (896, 141, 'CARINGIN / CIKUKULU');
INSERT INTO `ref_desa` VALUES (897, 141, 'CARINGIN /CARINGIN');
INSERT INTO `ref_desa` VALUES (898, 141, 'CARINGIN /CIKUKULU');
INSERT INTO `ref_desa` VALUES (899, 141, 'CARINGIN BOGOR');
INSERT INTO `ref_desa` VALUES (900, 141, 'CARINGIN CICURUG');
INSERT INTO `ref_desa` VALUES (901, 141, 'CARINGIN CIKUKULU/CARINGIN');
INSERT INTO `ref_desa` VALUES (902, 141, 'CARINGIN HILIIR');
INSERT INTO `ref_desa` VALUES (903, 141, 'CARINGIN HILIR/CARINGIN');
INSERT INTO `ref_desa` VALUES (904, 141, 'CARINGIN KALER');
INSERT INTO `ref_desa` VALUES (905, 141, 'CARINGIN KIDUL');
INSERT INTO `ref_desa` VALUES (906, 141, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (907, 141, 'CARINGIN KULON /CARINGIN');
INSERT INTO `ref_desa` VALUES (908, 141, 'CARINGIN KULON/');
INSERT INTO `ref_desa` VALUES (909, 141, 'CARINGIN KULON/CARINGIN');
INSERT INTO `ref_desa` VALUES (910, 141, 'CARINGIN KULON/CARINGINB');
INSERT INTO `ref_desa` VALUES (911, 141, 'CARINGIN KULON/CIBADAK');
INSERT INTO `ref_desa` VALUES (912, 141, 'CARINGIN KULUN');
INSERT INTO `ref_desa` VALUES (913, 141, 'CARINGIN LEBAK');
INSERT INTO `ref_desa` VALUES (914, 141, 'CARINGIN MASENG');
INSERT INTO `ref_desa` VALUES (915, 141, 'CARINGIN NUNGGAL');
INSERT INTO `ref_desa` VALUES (916, 141, 'CARINGIN NUNGGAL /WALURAN');
INSERT INTO `ref_desa` VALUES (917, 141, 'CARINGIN NUNGGAL/CIRACAP');
INSERT INTO `ref_desa` VALUES (918, 141, 'CARINGIN PANDAK');
INSERT INTO `ref_desa` VALUES (919, 141, 'CARINGIN POJOK');
INSERT INTO `ref_desa` VALUES (920, 141, 'CARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (921, 141, 'CARINGIN WETAN / CIBADAK');
INSERT INTO `ref_desa` VALUES (922, 141, 'CARINGIN WETAN /CARINGIN');
INSERT INTO `ref_desa` VALUES (923, 141, 'CARINGIN WETAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (924, 141, 'CARINGIN WETAN/CIBADAK');
INSERT INTO `ref_desa` VALUES (925, 141, 'CARINGIN/BOGOR');
INSERT INTO `ref_desa` VALUES (926, 141, 'CARINGIN/CANTAYAN');
INSERT INTO `ref_desa` VALUES (927, 141, 'CARINGIN/CARINGIN');
INSERT INTO `ref_desa` VALUES (928, 141, 'CARINGIN/CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (929, 141, 'CARINGIN/CARTINGIN');
INSERT INTO `ref_desa` VALUES (930, 141, 'CARINGIN/CIBADAK');
INSERT INTO `ref_desa` VALUES (931, 141, 'CARINGIN/CICANTAYAN');
INSERT INTO `ref_desa` VALUES (932, 141, 'CARINGIN/CIKUKULU');
INSERT INTO `ref_desa` VALUES (933, 141, 'CARINGIN/CISAAT');
INSERT INTO `ref_desa` VALUES (934, 141, 'CARINGIN/GEGER BITUNG');
INSERT INTO `ref_desa` VALUES (935, 141, 'CARINGIN/GEGERBITUNG');
INSERT INTO `ref_desa` VALUES (936, 141, 'CARINGIN/KADUDAMPIT');
INSERT INTO `ref_desa` VALUES (937, 141, 'CARINGIN/SUKABUMI');
INSERT INTO `ref_desa` VALUES (938, 141, 'CARINGINKULON /CARINGIN');
INSERT INTO `ref_desa` VALUES (939, 141, 'CARINGINKULON/CARINGIN');
INSERT INTO `ref_desa` VALUES (940, 141, 'CARINGINKULON/CIBADAK');
INSERT INTO `ref_desa` VALUES (941, 141, 'CARINGINN WETAN');
INSERT INTO `ref_desa` VALUES (942, 141, 'CARINGINWETAN');
INSERT INTO `ref_desa` VALUES (943, 141, 'CARINGINWETAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (944, 141, 'CARINGINWETAN/CIBADAK');
INSERT INTO `ref_desa` VALUES (945, 141, 'CARINGN');
INSERT INTO `ref_desa` VALUES (946, 141, 'CARINIM');
INSERT INTO `ref_desa` VALUES (947, 141, 'CARININ');
INSERT INTO `ref_desa` VALUES (948, 141, 'CARRINGIN');
INSERT INTO `ref_desa` VALUES (949, 141, 'CATRINGIN');
INSERT INTO `ref_desa` VALUES (950, 141, 'CCARAINGIN');
INSERT INTO `ref_desa` VALUES (951, 141, 'CENGKOL');
INSERT INTO `ref_desa` VALUES (952, 141, 'CIANTAYAN/CICANTAYAN');
INSERT INTO `ref_desa` VALUES (953, 141, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (954, 141, 'CIBADAK /CIBADAK');
INSERT INTO `ref_desa` VALUES (955, 141, 'CIBADAK/CIBADAK');
INSERT INTO `ref_desa` VALUES (956, 141, 'CIBALUNG');
INSERT INTO `ref_desa` VALUES (957, 141, 'CIBAREBEG');
INSERT INTO `ref_desa` VALUES (958, 141, 'CIBAREGBEG');
INSERT INTO `ref_desa` VALUES (959, 141, 'CIBATU');
INSERT INTO `ref_desa` VALUES (960, 141, 'CIBEUREUM');
INSERT INTO `ref_desa` VALUES (961, 141, 'CICANDE/CANTAYAN');
INSERT INTO `ref_desa` VALUES (962, 141, 'CICANTAYAN/CICANTAYAN');
INSERT INTO `ref_desa` VALUES (963, 141, 'CICURUG');
INSERT INTO `ref_desa` VALUES (964, 141, 'CIDERUM');
INSERT INTO `ref_desa` VALUES (965, 141, 'CIDERUM /CARINGIN');
INSERT INTO `ref_desa` VALUES (966, 141, 'CIDERUM/CARINGIN');
INSERT INTO `ref_desa` VALUES (967, 141, 'CIDEUREUM/CARINGIN');
INSERT INTO `ref_desa` VALUES (968, 141, 'CIEGKOL');
INSERT INTO `ref_desa` VALUES (969, 141, 'CIGERUM/CARINGIN');
INSERT INTO `ref_desa` VALUES (970, 141, 'CIGOMBONG/CARINGIN');
INSERT INTO `ref_desa` VALUES (971, 141, 'CIHERANG');
INSERT INTO `ref_desa` VALUES (972, 141, 'CIHERANG PONDOH');
INSERT INTO `ref_desa` VALUES (973, 141, 'CIHERANG PONDOK');
INSERT INTO `ref_desa` VALUES (974, 141, 'CIHERANG PONDOK/CARINGIN');
INSERT INTO `ref_desa` VALUES (975, 141, 'CIHERANG TONGGOH');
INSERT INTO `ref_desa` VALUES (976, 141, 'CIHERANG TONGGOH/CARINGIN');
INSERT INTO `ref_desa` VALUES (977, 141, 'CIHERANGPONDOK/CARINGIN');
INSERT INTO `ref_desa` VALUES (978, 141, 'CIHEULANG PONDOH');
INSERT INTO `ref_desa` VALUES (979, 141, 'CIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (980, 141, 'CIHEURANG PONDOK/CARINGIN');
INSERT INTO `ref_desa` VALUES (981, 141, 'CIJAENGKOL');
INSERT INTO `ref_desa` VALUES (982, 141, 'CIJALINGAN');
INSERT INTO `ref_desa` VALUES (983, 141, 'CIJEMGKOL/CARINGIN');
INSERT INTO `ref_desa` VALUES (984, 141, 'CIJENGGKOL');
INSERT INTO `ref_desa` VALUES (985, 141, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (986, 141, 'CIJENGKOL / CARINGIN');
INSERT INTO `ref_desa` VALUES (987, 141, 'CIJENGKOL /CARINGIN');
INSERT INTO `ref_desa` VALUES (988, 141, 'CIJENGKOL/ CARINGIN');
INSERT INTO `ref_desa` VALUES (989, 141, 'CIJENGKOL/CARINGIN');
INSERT INTO `ref_desa` VALUES (990, 141, 'CIJENGKOL/CI1BADAK');
INSERT INTO `ref_desa` VALUES (991, 141, 'CIJENGKOL/CIBADAK');
INSERT INTO `ref_desa` VALUES (992, 141, 'CIJENGKOL/CICANTAYAN');
INSERT INTO `ref_desa` VALUES (993, 141, 'CIJENGKOL/CIJENGKOL');
INSERT INTO `ref_desa` VALUES (994, 141, 'CIJENGKOL/PAREANG');
INSERT INTO `ref_desa` VALUES (995, 141, 'CIJENGOL/CARINGIN');
INSERT INTO `ref_desa` VALUES (996, 141, 'CIJENKOL');
INSERT INTO `ref_desa` VALUES (997, 141, 'CIJERAH/CARINGIN');
INSERT INTO `ref_desa` VALUES (998, 141, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (999, 141, 'CIJIENGKOL /CIBADAK');
INSERT INTO `ref_desa` VALUES (1000, 141, 'CIJNGKOL');
INSERT INTO `ref_desa` VALUES (1001, 141, 'CIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (1002, 141, 'CIKAROYA');
INSERT INTO `ref_desa` VALUES (1003, 141, 'CIKEAMABANG');
INSERT INTO `ref_desa` VALUES (1004, 141, 'CIKEANG');
INSERT INTO `ref_desa` VALUES (1005, 141, 'CIKEMABANG');
INSERT INTO `ref_desa` VALUES (1006, 141, 'CIKEMANG');
INSERT INTO `ref_desa` VALUES (1007, 141, 'CIKEMBAN');
INSERT INTO `ref_desa` VALUES (1008, 141, 'CIKEMBANG');
INSERT INTO `ref_desa` VALUES (1009, 141, 'CIKEMBAR');
INSERT INTO `ref_desa` VALUES (1010, 141, 'CIKERETEG/BOGOR');
INSERT INTO `ref_desa` VALUES (1011, 141, 'CIKERETEUG');
INSERT INTO `ref_desa` VALUES (1012, 141, 'CIKLEMBANG/CIKEMBAR');
INSERT INTO `ref_desa` VALUES (1013, 141, 'CIKUKULI/CIBADAK');
INSERT INTO `ref_desa` VALUES (1014, 141, 'CIKUKULU');
INSERT INTO `ref_desa` VALUES (1015, 141, 'CIKUKULU /CIBADAK');
INSERT INTO `ref_desa` VALUES (1016, 141, 'CIKUKULU/CARINGIN');
INSERT INTO `ref_desa` VALUES (1017, 141, 'CIKUKULU/CIBADAK');
INSERT INTO `ref_desa` VALUES (1018, 141, 'CIKUKULU/CICANTAYAN');
INSERT INTO `ref_desa` VALUES (1019, 141, 'CIMANDE');
INSERT INTO `ref_desa` VALUES (1020, 141, 'CIMANDE / CARINGIN');
INSERT INTO `ref_desa` VALUES (1021, 141, 'CIMANDE /CARINGIN');
INSERT INTO `ref_desa` VALUES (1022, 141, 'CIMANDE GIRANG');
INSERT INTO `ref_desa` VALUES (1023, 141, 'CIMANDE HELER');
INSERT INTO `ref_desa` VALUES (1024, 141, 'CIMANDE HILIE');
INSERT INTO `ref_desa` VALUES (1025, 141, 'CIMANDE HILIR');
INSERT INTO `ref_desa` VALUES (1026, 141, 'CIMANDE HILIR/CARINGIN');
INSERT INTO `ref_desa` VALUES (1027, 141, 'CIMANDE/CARINGIN');
INSERT INTO `ref_desa` VALUES (1028, 141, 'CINAGARA');
INSERT INTO `ref_desa` VALUES (1029, 141, 'CINAGARA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1030, 141, 'CINAGRA');
INSERT INTO `ref_desa` VALUES (1031, 141, 'CINEGARA');
INSERT INTO `ref_desa` VALUES (1032, 141, 'CINYOCOK');
INSERT INTO `ref_desa` VALUES (1033, 141, 'CIPENDEY');
INSERT INTO `ref_desa` VALUES (1034, 141, 'CIPUNTANG');
INSERT INTO `ref_desa` VALUES (1035, 141, 'CIPUNTANG/CARINGIN');
INSERT INTO `ref_desa` VALUES (1036, 141, 'CIPUNTUNG/CARINGIN');
INSERT INTO `ref_desa` VALUES (1037, 141, 'CIRAWEY');
INSERT INTO `ref_desa` VALUES (1038, 141, 'CISALOPA/');
INSERT INTO `ref_desa` VALUES (1039, 141, 'CISALOPA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1040, 141, 'CISANDE');
INSERT INTO `ref_desa` VALUES (1041, 141, 'CISANDE / CIBADAK');
INSERT INTO `ref_desa` VALUES (1042, 141, 'CISANDE / CICANTAYAN');
INSERT INTO `ref_desa` VALUES (1043, 141, 'CISANDE /CIBADA');
INSERT INTO `ref_desa` VALUES (1044, 141, 'CISANDE /CIBADAK');
INSERT INTO `ref_desa` VALUES (1045, 141, 'CISANDE HILIR');
INSERT INTO `ref_desa` VALUES (1046, 141, 'CISANDE/ CICANTAYAN');
INSERT INTO `ref_desa` VALUES (1047, 141, 'CISANDE/CANTAYAN');
INSERT INTO `ref_desa` VALUES (1048, 141, 'CISANDE/CARINGIN');
INSERT INTO `ref_desa` VALUES (1049, 141, 'CISANDE/CIBADAK');
INSERT INTO `ref_desa` VALUES (1050, 141, 'CISANDE/CICANTAYAN');
INSERT INTO `ref_desa` VALUES (1051, 141, 'CISANDE/CICANTAYN');
INSERT INTO `ref_desa` VALUES (1052, 141, 'CISANDE/CISAAT');
INSERT INTO `ref_desa` VALUES (1053, 141, 'CISARUA');
INSERT INTO `ref_desa` VALUES (1054, 141, 'CISAUPAN');
INSERT INTO `ref_desa` VALUES (1055, 141, 'CISEPAN');
INSERT INTO `ref_desa` VALUES (1056, 141, 'CISEPAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1057, 141, 'CISEPANN');
INSERT INTO `ref_desa` VALUES (1058, 141, 'CISEUPAN');
INSERT INTO `ref_desa` VALUES (1059, 141, 'CISEUPAN / CARINGIN');
INSERT INTO `ref_desa` VALUES (1060, 141, 'CISEUPAN /CARINGGIN');
INSERT INTO `ref_desa` VALUES (1061, 141, 'CISEUPAN /CARINGIN');
INSERT INTO `ref_desa` VALUES (1062, 141, 'CISEUPAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1063, 141, 'CISEUPAN/CARINGIN LEBAK');
INSERT INTO `ref_desa` VALUES (1064, 141, 'CISEUPAN/SEUSEUPAN');
INSERT INTO `ref_desa` VALUES (1065, 141, 'CISITU');
INSERT INTO `ref_desa` VALUES (1066, 141, 'CISSEUPAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1067, 141, 'CISUEPAN');
INSERT INTO `ref_desa` VALUES (1068, 141, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (1069, 141, 'COBLOG');
INSERT INTO `ref_desa` VALUES (1070, 141, 'COBLONG/CARINGIN');
INSERT INTO `ref_desa` VALUES (1071, 141, 'CQRRIMGIM');
INSERT INTO `ref_desa` VALUES (1072, 141, 'CRAINGIN');
INSERT INTO `ref_desa` VALUES (1073, 141, 'CRINGIN');
INSERT INTO `ref_desa` VALUES (1074, 141, 'CUJENGKOL/CARINGIN');
INSERT INTO `ref_desa` VALUES (1075, 141, 'DARMAGA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1076, 141, 'DEPLAT');
INSERT INTO `ref_desa` VALUES (1077, 141, 'DSLEMBAH LUHUR/CARINGIN');
INSERT INTO `ref_desa` VALUES (1078, 141, 'GUNUNGJAYA');
INSERT INTO `ref_desa` VALUES (1079, 141, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (1080, 141, 'IJENGKOL');
INSERT INTO `ref_desa` VALUES (1081, 141, 'IKEMBANG/CARINGIN');
INSERT INTO `ref_desa` VALUES (1082, 141, 'ISEAPAN');
INSERT INTO `ref_desa` VALUES (1083, 141, 'JANGAL');
INSERT INTO `ref_desa` VALUES (1084, 141, 'JANGGAL');
INSERT INTO `ref_desa` VALUES (1085, 141, 'JAYANEGARA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1086, 141, 'KADUPUGUR');
INSERT INTO `ref_desa` VALUES (1087, 141, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (1088, 141, 'KONGSI');
INSERT INTO `ref_desa` VALUES (1089, 141, 'KONGSI/CARINGIN');
INSERT INTO `ref_desa` VALUES (1090, 141, 'KP JAMBE');
INSERT INTO `ref_desa` VALUES (1091, 141, 'KUTA TEGAL');
INSERT INTO `ref_desa` VALUES (1092, 141, 'KUTAJAYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1093, 141, 'KUTASIRNA');
INSERT INTO `ref_desa` VALUES (1094, 141, 'LEAMAHDUHUR');
INSERT INTO `ref_desa` VALUES (1095, 141, 'LEBAK PARI');
INSERT INTO `ref_desa` VALUES (1096, 141, 'LEMAG DUHUR');
INSERT INTO `ref_desa` VALUES (1097, 141, 'LEMAH DUHUR');
INSERT INTO `ref_desa` VALUES (1098, 141, 'LEMAH DUHUR /CARINGIN');
INSERT INTO `ref_desa` VALUES (1099, 141, 'LEMAH DUHUR/CARINGIN');
INSERT INTO `ref_desa` VALUES (1100, 141, 'LEMAH DUHUR/CARINGIN BOGOR');
INSERT INTO `ref_desa` VALUES (1101, 141, 'LEMAH DULUR');
INSERT INTO `ref_desa` VALUES (1102, 141, 'LEMAH DUWUR');
INSERT INTO `ref_desa` VALUES (1103, 141, 'LEMAH LUHUR');
INSERT INTO `ref_desa` VALUES (1104, 141, 'LEMAHDUHUR');
INSERT INTO `ref_desa` VALUES (1105, 141, 'LEMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (1106, 141, 'LENGKONG');
INSERT INTO `ref_desa` VALUES (1107, 141, 'MAANGUNJYA');
INSERT INTO `ref_desa` VALUES (1108, 141, 'MADUHUR/CARINGIN');
INSERT INTO `ref_desa` VALUES (1109, 141, 'MAKAR JAYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1110, 141, 'MEAR JAYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1111, 141, 'MEKAR JAYA');
INSERT INTO `ref_desa` VALUES (1112, 141, 'MEKAR JAYA / CARINGIN');
INSERT INTO `ref_desa` VALUES (1113, 141, 'MEKAR JAYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1114, 141, 'MEKAR SARI');
INSERT INTO `ref_desa` VALUES (1115, 141, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (1116, 141, 'MEKARJAYA / CARINGIN');
INSERT INTO `ref_desa` VALUES (1117, 141, 'MEKARJAYA /CARINGGIN');
INSERT INTO `ref_desa` VALUES (1118, 141, 'MEKARJAYA /CARINGIN');
INSERT INTO `ref_desa` VALUES (1119, 141, 'MEKARJAYA /CIBADAK');
INSERT INTO `ref_desa` VALUES (1120, 141, 'MEKARJAYA CARINGIN');
INSERT INTO `ref_desa` VALUES (1121, 141, 'MEKARJAYA/ CARINGIN');
INSERT INTO `ref_desa` VALUES (1122, 141, 'MEKARJAYA/CARINGIIN');
INSERT INTO `ref_desa` VALUES (1123, 141, 'MEKARJAYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1124, 141, 'MEKARJAYA/CIBADAK');
INSERT INTO `ref_desa` VALUES (1125, 141, 'MEKARJAYACARINGIN');
INSERT INTO `ref_desa` VALUES (1126, 141, 'MEKARNANGKA');
INSERT INTO `ref_desa` VALUES (1127, 141, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (1128, 141, 'MEKASRJAYA');
INSERT INTO `ref_desa` VALUES (1129, 141, 'MERKARJAYA');
INSERT INTO `ref_desa` VALUES (1130, 141, 'MUARA JAYA');
INSERT INTO `ref_desa` VALUES (1131, 141, 'MUARA JAYA / CARINGIN');
INSERT INTO `ref_desa` VALUES (1132, 141, 'MUARA JAYA /CARINGIN');
INSERT INTO `ref_desa` VALUES (1133, 141, 'MUARA JAYA/ CARINGIN');
INSERT INTO `ref_desa` VALUES (1134, 141, 'MUARA JAYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1135, 141, 'MUARAJAYA');
INSERT INTO `ref_desa` VALUES (1136, 141, 'MUARAJAYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1137, 141, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (1138, 141, 'NEGLASARI/CARINGIN');
INSERT INTO `ref_desa` VALUES (1139, 141, 'NENGGENG/KEBON PEDES');
INSERT INTO `ref_desa` VALUES (1140, 141, 'NONGGENG');
INSERT INTO `ref_desa` VALUES (1141, 141, 'NYANGKOEK');
INSERT INTO `ref_desa` VALUES (1142, 141, 'NYANGKOEK/CARINGIN');
INSERT INTO `ref_desa` VALUES (1143, 141, 'PABUARAN/MEKARJAYA');
INSERT INTO `ref_desa` VALUES (1144, 141, 'PADANG GEANAYANG');
INSERT INTO `ref_desa` VALUES (1145, 141, 'PADANGENYANG');
INSERT INTO `ref_desa` VALUES (1146, 141, 'PAJEAGAN');
INSERT INTO `ref_desa` VALUES (1147, 141, 'PAJEGAN');
INSERT INTO `ref_desa` VALUES (1148, 141, 'PALEDANG /CANTAYAN');
INSERT INTO `ref_desa` VALUES (1149, 141, 'PAMURAUYAN');
INSERT INTO `ref_desa` VALUES (1150, 141, 'PANCAWATI');
INSERT INTO `ref_desa` VALUES (1151, 141, 'PANCAWATI /CARINGIN');
INSERT INTO `ref_desa` VALUES (1152, 141, 'PANCAWATI/CARINGIN');
INSERT INTO `ref_desa` VALUES (1153, 141, 'PASAWAHAN');
INSERT INTO `ref_desa` VALUES (1154, 141, 'PASI RMULTYA');
INSERT INTO `ref_desa` VALUES (1155, 141, 'PASIR  JAYA');
INSERT INTO `ref_desa` VALUES (1156, 141, 'PASIR ANGIN');
INSERT INTO `ref_desa` VALUES (1157, 141, 'PASIR ANGIN/PASIR ANGIN');
INSERT INTO `ref_desa` VALUES (1158, 141, 'PASIR BENTIK');
INSERT INTO `ref_desa` VALUES (1159, 141, 'PASIR BINCIR/CARINGIN');
INSERT INTO `ref_desa` VALUES (1160, 141, 'PASIR BUNAR');
INSERT INTO `ref_desa` VALUES (1161, 141, 'PASIR BUNCIR');
INSERT INTO `ref_desa` VALUES (1162, 141, 'PASIR BUNCIR /CARINGIN');
INSERT INTO `ref_desa` VALUES (1163, 141, 'PASIR BUNCIR/CARINGIN');
INSERT INTO `ref_desa` VALUES (1164, 141, 'PASIR BUNCIT');
INSERT INTO `ref_desa` VALUES (1165, 141, 'PASIR BUNCIT /CARINGIN');
INSERT INTO `ref_desa` VALUES (1166, 141, 'PASIR BUNCIT/CARINGIN');
INSERT INTO `ref_desa` VALUES (1167, 141, 'PASIR DALAM/CIDAHU');
INSERT INTO `ref_desa` VALUES (1168, 141, 'PASIR DATAR');
INSERT INTO `ref_desa` VALUES (1169, 141, 'PASIR GUNCIR');
INSERT INTO `ref_desa` VALUES (1170, 141, 'PASIR KIARA');
INSERT INTO `ref_desa` VALUES (1171, 141, 'PASIR KUNCIR');
INSERT INTO `ref_desa` VALUES (1172, 141, 'PASIR MINCANG');
INSERT INTO `ref_desa` VALUES (1173, 141, 'PASIR MUNCANG');
INSERT INTO `ref_desa` VALUES (1174, 141, 'PASIR MUNCANG/CARINGIN');
INSERT INTO `ref_desa` VALUES (1175, 141, 'PASIR MUNCANG/CIBADAK');
INSERT INTO `ref_desa` VALUES (1176, 141, 'PASIR MUNCANG/PASIR MUNCANG');
INSERT INTO `ref_desa` VALUES (1177, 141, 'PASIRBUNCIR/CARINGIN');
INSERT INTO `ref_desa` VALUES (1178, 141, 'PASIRDATAR');
INSERT INTO `ref_desa` VALUES (1179, 141, 'PASIRMUNCANG');
INSERT INTO `ref_desa` VALUES (1180, 141, 'PASIRMUNCANG / CARINGIN');
INSERT INTO `ref_desa` VALUES (1181, 141, 'PASIRMUNCANG/CARINGIN');
INSERT INTO `ref_desa` VALUES (1182, 141, 'PASIRUANG');
INSERT INTO `ref_desa` VALUES (1183, 141, 'PASIRUNCANG/CARINGIN');
INSERT INTO `ref_desa` VALUES (1184, 141, 'PENDEUY');
INSERT INTO `ref_desa` VALUES (1185, 141, 'PERK CARINGIN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1186, 141, 'PONDOKKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (1187, 141, 'PS BUNCIR');
INSERT INTO `ref_desa` VALUES (1188, 141, 'PS MUNCANG');
INSERT INTO `ref_desa` VALUES (1189, 141, 'PSR ANGIN');
INSERT INTO `ref_desa` VALUES (1190, 141, 'PSR. MUNCANG');
INSERT INTO `ref_desa` VALUES (1191, 141, 'SALAAAWI');
INSERT INTO `ref_desa` VALUES (1192, 141, 'SALAAWI/CARINGIN');
INSERT INTO `ref_desa` VALUES (1193, 141, 'SARI KOLOT/CARINGIN');
INSERT INTO `ref_desa` VALUES (1194, 141, 'SELAAWI');
INSERT INTO `ref_desa` VALUES (1195, 141, 'SELAAWI/CARINGIN');
INSERT INTO `ref_desa` VALUES (1196, 141, 'SELAGOMBONG/ CANTAYAN');
INSERT INTO `ref_desa` VALUES (1197, 141, 'SELAKOPI');
INSERT INTO `ref_desa` VALUES (1198, 141, 'SELAKOPI/CIBADAK');
INSERT INTO `ref_desa` VALUES (1199, 141, 'SESEPAN');
INSERT INTO `ref_desa` VALUES (1200, 141, 'SESEPAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1201, 141, 'SESEUPAN');
INSERT INTO `ref_desa` VALUES (1202, 141, 'SESEUPAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1203, 141, 'SEUSEPAN');
INSERT INTO `ref_desa` VALUES (1204, 141, 'SEUSEPAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1205, 141, 'SEUSEUPAN');
INSERT INTO `ref_desa` VALUES (1206, 141, 'SEUSEUPAN /CARINGIN');
INSERT INTO `ref_desa` VALUES (1207, 141, 'SEUSEUPAN /CIBADAK');
INSERT INTO `ref_desa` VALUES (1208, 141, 'SEUSEUPAN GIRANG/CIBADAK');
INSERT INTO `ref_desa` VALUES (1209, 141, 'SEUSEUPAN/CARINGIN');
INSERT INTO `ref_desa` VALUES (1210, 141, 'SIKAMULYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1211, 141, 'SINAGARA');
INSERT INTO `ref_desa` VALUES (1212, 141, 'SINAGARA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1213, 141, 'SINDANGLENGO/SINDANGLENGO');
INSERT INTO `ref_desa` VALUES (1214, 141, 'SIRNARESMI/GUNUNGGURUH');
INSERT INTO `ref_desa` VALUES (1215, 141, 'SISIPAN');
INSERT INTO `ref_desa` VALUES (1216, 141, 'SIUKAMULYA');
INSERT INTO `ref_desa` VALUES (1217, 141, 'SLAAWI');
INSERT INTO `ref_desa` VALUES (1218, 141, 'SUKA  MULYA');
INSERT INTO `ref_desa` VALUES (1219, 141, 'SUKA MULYA');
INSERT INTO `ref_desa` VALUES (1220, 141, 'SUKA MULYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1221, 141, 'SUKA MURYA /CARINGIN');
INSERT INTO `ref_desa` VALUES (1222, 141, 'SUKAMAJU/CARINGIN');
INSERT INTO `ref_desa` VALUES (1223, 141, 'SUKAMANTRI');
INSERT INTO `ref_desa` VALUES (1224, 141, 'SUKAMAULYA');
INSERT INTO `ref_desa` VALUES (1225, 141, 'SUKAMULUYA');
INSERT INTO `ref_desa` VALUES (1226, 141, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (1227, 141, 'SUKAMULYA / CARINGIN');
INSERT INTO `ref_desa` VALUES (1228, 141, 'SUKAMULYA /CARIGIN');
INSERT INTO `ref_desa` VALUES (1229, 141, 'SUKAMULYA/CARINGIN');
INSERT INTO `ref_desa` VALUES (1230, 141, 'SUKAMULYA/CARINGTIN');
INSERT INTO `ref_desa` VALUES (1231, 141, 'SUKAMULYA/CIBADAK');
INSERT INTO `ref_desa` VALUES (1232, 141, 'SUKMULYA/CIKEMBANG');
INSERT INTO `ref_desa` VALUES (1233, 141, 'SULLAMULYA');
INSERT INTO `ref_desa` VALUES (1234, 141, 'SUNAGAPAN');
INSERT INTO `ref_desa` VALUES (1235, 141, 'TAJUR');
INSERT INTO `ref_desa` VALUES (1236, 141, 'TALAGA');
INSERT INTO `ref_desa` VALUES (1237, 141, 'TALAGA  CANGIN');
INSERT INTO `ref_desa` VALUES (1238, 141, 'TALAGA ARINGIN');
INSERT INTO `ref_desa` VALUES (1239, 141, 'TALAGA CAINGIN');
INSERT INTO `ref_desa` VALUES (1240, 141, 'TALAGA CARINGN');
INSERT INTO `ref_desa` VALUES (1241, 141, 'TALAGA GIRANG');
INSERT INTO `ref_desa` VALUES (1242, 141, 'TALAGA HILIR');
INSERT INTO `ref_desa` VALUES (1243, 141, 'TALAGA TENGAH');
INSERT INTO `ref_desa` VALUES (1244, 141, 'TANAGA');
INSERT INTO `ref_desa` VALUES (1245, 645, 'WARNASARI');
INSERT INTO `ref_desa` VALUES (1246, 645, 'SUKAJAYA');
INSERT INTO `ref_desa` VALUES (1247, 645, 'SUDAJAYA GIRANG');
INSERT INTO `ref_desa` VALUES (1248, 645, 'KARAWANG');
INSERT INTO `ref_desa` VALUES (1249, 691, 'SELAWANGI');
INSERT INTO `ref_desa` VALUES (1250, 691, 'PASIRHALANG');
INSERT INTO `ref_desa` VALUES (1251, 691, 'SUKARAJA');
INSERT INTO `ref_desa` VALUES (1252, 691, 'SELAAWI');
INSERT INTO `ref_desa` VALUES (1253, 691, 'MARGULUYU');
INSERT INTO `ref_desa` VALUES (1254, 691, 'LIMBANGAN');
INSERT INTO `ref_desa` VALUES (1255, 691, 'CISARUA');
INSERT INTO `ref_desa` VALUES (1256, 691, 'SUKAMEKAR');
INSERT INTO `ref_desa` VALUES (1257, 691, 'LANGENSARI');
INSERT INTO `ref_desa` VALUES (1258, 646, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (1259, 646, 'SUKALARANG');
INSERT INTO `ref_desa` VALUES (1260, 646, 'CIMANGKOK');
INSERT INTO `ref_desa` VALUES (1261, 646, 'TITISAN');
INSERT INTO `ref_desa` VALUES (1262, 646, 'SEMPLAK');
INSERT INTO `ref_desa` VALUES (1263, 646, 'PRIANGANJAYA');
INSERT INTO `ref_desa` VALUES (1264, 647, 'CIPURUT');
INSERT INTO `ref_desa` VALUES (1265, 647, 'CIREUNGHAS');
INSERT INTO `ref_desa` VALUES (1266, 647, 'BENCOY');
INSERT INTO `ref_desa` VALUES (1267, 647, 'CIKUTURUG');
INSERT INTO `ref_desa` VALUES (1268, 647, 'TEGALPANJANG');
INSERT INTO `ref_desa` VALUES (1269, 648, 'SASAGARAN');
INSERT INTO `ref_desa` VALUES (1270, 648, 'JAMBENENGGANG');
INSERT INTO `ref_desa` VALUES (1271, 648, 'CIKARET');
INSERT INTO `ref_desa` VALUES (1272, 648, 'KEBONPEDES');
INSERT INTO `ref_desa` VALUES (1273, 648, 'BOJONGSAWAH');
INSERT INTO `ref_desa` VALUES (1274, 649, 'CISAAT');
INSERT INTO `ref_desa` VALUES (1275, 649, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (1276, 649, 'CIBATU');
INSERT INTO `ref_desa` VALUES (1277, 649, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (1278, 649, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (1279, 649, 'SUKARESMI');
INSERT INTO `ref_desa` VALUES (1280, 649, 'SELAJAMBE');
INSERT INTO `ref_desa` VALUES (1281, 649, 'KUTASIMA');
INSERT INTO `ref_desa` VALUES (1282, 649, 'CIBOLANGKALER');
INSERT INTO `ref_desa` VALUES (1283, 649, 'GUNUNGJAYA');
INSERT INTO `ref_desa` VALUES (1284, 650, 'SIMARESMI');
INSERT INTO `ref_desa` VALUES (1285, 650, 'KEBONMANGGU');
INSERT INTO `ref_desa` VALUES (1286, 650, 'GUNUNGGURUH');
INSERT INTO `ref_desa` VALUES (1287, 650, 'CIBENTANG');
INSERT INTO `ref_desa` VALUES (1288, 650, 'CIKUJANG');
INSERT INTO `ref_desa` VALUES (1289, 650, 'CIBOLANG');
INSERT INTO `ref_desa` VALUES (1290, 650, 'PADAASIH');
INSERT INTO `ref_desa` VALUES (1291, 650, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (1292, 650, 'SUKAMANTRI');
INSERT INTO `ref_desa` VALUES (1293, 651, 'MUARADUA');
INSERT INTO `ref_desa` VALUES (1294, 651, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (1295, 651, 'CIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (1296, 651, 'SUKAMANIS');
INSERT INTO `ref_desa` VALUES (1297, 651, 'KADUDAMPIT');
INSERT INTO `ref_desa` VALUES (1298, 651, 'GEDE PANGRANGO');
INSERT INTO `ref_desa` VALUES (1299, 651, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (1300, 651, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (1301, 651, 'UNDRUS BINANGUN');
INSERT INTO `ref_desa` VALUES (1302, 652, 'CIENGANG');
INSERT INTO `ref_desa` VALUES (1303, 652, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (1304, 652, 'GEGERBITUNG');
INSERT INTO `ref_desa` VALUES (1305, 652, 'CIJUREY');
INSERT INTO `ref_desa` VALUES (1306, 652, 'KARANGJAYA');
INSERT INTO `ref_desa` VALUES (1307, 652, 'BUNIWANGI');
INSERT INTO `ref_desa` VALUES (1308, 652, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (1309, 653, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (1310, 653, 'TENJOJAYA');
INSERT INTO `ref_desa` VALUES (1311, 653, 'SEKARWANGI');
INSERT INTO `ref_desa` VALUES (1312, 653, 'BATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (1313, 653, 'KARANGTENGAH');
INSERT INTO `ref_desa` VALUES (1314, 653, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (1315, 653, 'WARNAJATI');
INSERT INTO `ref_desa` VALUES (1316, 653, 'SUKASIRNA');
INSERT INTO `ref_desa` VALUES (1317, 653, 'PAMURUYAN');
INSERT INTO `ref_desa` VALUES (1318, 653, 'CIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (1319, 654, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (1320, 654, 'CICANTAYAN');
INSERT INTO `ref_desa` VALUES (1321, 654, 'SUKADAMAI');
INSERT INTO `ref_desa` VALUES (1322, 654, 'CIMAHI');
INSERT INTO `ref_desa` VALUES (1323, 654, 'CISANDE');
INSERT INTO `ref_desa` VALUES (1324, 654, 'LEMBURSAWAH');
INSERT INTO `ref_desa` VALUES (1325, 654, 'CIJALINGAN');
INSERT INTO `ref_desa` VALUES (1326, 655, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (1327, 655, 'TALAGA');
INSERT INTO `ref_desa` VALUES (1328, 655, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (1329, 655, 'SEUSEUPAN');
INSERT INTO `ref_desa` VALUES (1330, 655, 'CARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (1331, 655, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (1332, 655, 'CIKEMBANG');
INSERT INTO `ref_desa` VALUES (1333, 655, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (1334, 656, 'CISARUA');
INSERT INTO `ref_desa` VALUES (1335, 656, 'BALEKAMBANG');
INSERT INTO `ref_desa` VALUES (1336, 656, 'NAGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (1337, 656, 'NAGRAK UTARA');
INSERT INTO `ref_desa` VALUES (1338, 656, 'PAWENANG');
INSERT INTO `ref_desa` VALUES (1339, 656, 'CIHANYAWAR');
INSERT INTO `ref_desa` VALUES (1340, 656, 'GIRIJAYA');
INSERT INTO `ref_desa` VALUES (1341, 656, 'BABAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (1342, 656, 'KALAPAREA');
INSERT INTO `ref_desa` VALUES (1343, 656, 'DARMAREJA');
INSERT INTO `ref_desa` VALUES (1344, 657, 'MUNJUL');
INSERT INTO `ref_desa` VALUES (1345, 657, 'CIAMBAR');
INSERT INTO `ref_desa` VALUES (1346, 657, 'GINANJAR');
INSERT INTO `ref_desa` VALUES (1347, 657, 'WANGUNJAYA');
INSERT INTO `ref_desa` VALUES (1348, 658, 'SAMPORA');
INSERT INTO `ref_desa` VALUES (1349, 658, 'CIJAMBE');
INSERT INTO `ref_desa` VALUES (1350, 658, 'CIKIRAY');
INSERT INTO `ref_desa` VALUES (1351, 658, 'MEKARNANGKA');
INSERT INTO `ref_desa` VALUES (1352, 658, 'CIKIDANG');
INSERT INTO `ref_desa` VALUES (1353, 658, 'GUNUNG MALANG');
INSERT INTO `ref_desa` VALUES (1354, 658, 'NANGKA KONENG');
INSERT INTO `ref_desa` VALUES (1355, 658, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (1356, 658, 'BUMISARI');
INSERT INTO `ref_desa` VALUES (1357, 658, 'CICAREUH');
INSERT INTO `ref_desa` VALUES (1358, 658, 'TAMANSARI');
INSERT INTO `ref_desa` VALUES (1359, 659, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (1360, 659, 'CIBATU');
INSERT INTO `ref_desa` VALUES (1361, 659, 'PARAKANLIMA');
INSERT INTO `ref_desa` VALUES (1362, 659, 'KERTARAHARJA');
INSERT INTO `ref_desa` VALUES (1363, 659, 'BOJONG');
INSERT INTO `ref_desa` VALUES (1364, 659, 'BOJONGKEMBAR');
INSERT INTO `ref_desa` VALUES (1365, 659, 'CIKEMBAR');
INSERT INTO `ref_desa` VALUES (1366, 659, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (1367, 659, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (1368, 660, 'PALASARI HILIR');
INSERT INTO `ref_desa` VALUES (1369, 660, 'SUNDAWENANG');
INSERT INTO `ref_desa` VALUES (1370, 660, 'PARUNGKUDA');
INSERT INTO `ref_desa` VALUES (1371, 660, 'LANGENSARI');
INSERT INTO `ref_desa` VALUES (1372, 660, 'BOJONG KOKOSAN');
INSERT INTO `ref_desa` VALUES (1373, 660, 'KOMPA');
INSERT INTO `ref_desa` VALUES (1374, 660, 'PONDOK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (1375, 660, 'BABAKANJAYA');
INSERT INTO `ref_desa` VALUES (1376, 661, 'BOJONG GENTENG');
INSERT INTO `ref_desa` VALUES (1377, 661, 'BOJONG GALING');
INSERT INTO `ref_desa` VALUES (1378, 661, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (1379, 661, 'BEREKAH');
INSERT INTO `ref_desa` VALUES (1380, 661, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (1381, 662, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (1382, 662, 'CIANAGA');
INSERT INTO `ref_desa` VALUES (1383, 662, 'TUGUBANDUNG');
INSERT INTO `ref_desa` VALUES (1384, 662, 'KABANDUNGAN');
INSERT INTO `ref_desa` VALUES (1385, 662, 'CIPEUTEUY');
INSERT INTO `ref_desa` VALUES (1386, 662, 'CIHAMERANG');
INSERT INTO `ref_desa` VALUES (1387, 663, 'WALANGSARI');
INSERT INTO `ref_desa` VALUES (1388, 663, 'PALASARI GIRANG');
INSERT INTO `ref_desa` VALUES (1389, 663, 'KALAPANUNGGAL');
INSERT INTO `ref_desa` VALUES (1390, 663, 'KADUNUNGGAL');
INSERT INTO `ref_desa` VALUES (1391, 663, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (1392, 663, 'GUNUNG ENDUT');
INSERT INTO `ref_desa` VALUES (1393, 663, 'PULOSARI');
INSERT INTO `ref_desa` VALUES (1394, 664, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (1395, 664, 'SUKAKERSA');
INSERT INTO `ref_desa` VALUES (1396, 664, 'BOJONGLONGOK');
INSERT INTO `ref_desa` VALUES (1397, 664, 'BOJONGASIH');
INSERT INTO `ref_desa` VALUES (1398, 664, 'LEBAKSARI');
INSERT INTO `ref_desa` VALUES (1399, 664, 'PARAKANSALAK');
INSERT INTO `ref_desa` VALUES (1400, 665, 'CICURUG');
INSERT INTO `ref_desa` VALUES (1401, 665, 'NYANGKOWEK');
INSERT INTO `ref_desa` VALUES (1402, 665, 'BENDA');
INSERT INTO `ref_desa` VALUES (1403, 665, 'PASAWAHAN');
INSERT INTO `ref_desa` VALUES (1404, 665, 'PURWASARI');
INSERT INTO `ref_desa` VALUES (1405, 665, 'TENJOAYU');
INSERT INTO `ref_desa` VALUES (1406, 665, 'NANGERANG');
INSERT INTO `ref_desa` VALUES (1407, 665, 'KUTAJAYA');
INSERT INTO `ref_desa` VALUES (1408, 665, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (1409, 665, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (1410, 665, 'CISAAT');
INSERT INTO `ref_desa` VALUES (1411, 665, 'BANGBAYANG');
INSERT INTO `ref_desa` VALUES (1412, 665, 'TENJOLAYA');
INSERT INTO `ref_desa` VALUES (1413, 666, 'PONDOK KASO TENGAH');
INSERT INTO `ref_desa` VALUES (1414, 666, 'PASIRDOTON');
INSERT INTO `ref_desa` VALUES (1415, 666, 'PONDOK KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (1416, 666, 'BABAKAN PARI');
INSERT INTO `ref_desa` VALUES (1417, 666, 'TANGKIL');
INSERT INTO `ref_desa` VALUES (1418, 666, 'JAYAMUKTI');
INSERT INTO `ref_desa` VALUES (1419, 666, 'CIDAHU');
INSERT INTO `ref_desa` VALUES (1420, 666, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (1421, 667, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (1422, 667, 'BANTARKALONG');
INSERT INTO `ref_desa` VALUES (1423, 667, 'SIRNAJAYA');
INSERT INTO `ref_desa` VALUES (1424, 667, 'BOJONGKERTA');
INSERT INTO `ref_desa` VALUES (1425, 667, 'SUKAHARJA');
INSERT INTO `ref_desa` VALUES (1426, 667, 'UBRUG');
INSERT INTO `ref_desa` VALUES (1427, 667, 'GIRIJAYA');
INSERT INTO `ref_desa` VALUES (1428, 667, 'WARUNGKIARA');
INSERT INTO `ref_desa` VALUES (1429, 668, 'MANGUNJAYA');
INSERT INTO `ref_desa` VALUES (1430, 668, 'BANTARGADUNG');
INSERT INTO `ref_desa` VALUES (1431, 668, 'BOJONGGALING');
INSERT INTO `ref_desa` VALUES (1432, 668, 'LIMUSNUNGGAL');
INSERT INTO `ref_desa` VALUES (1433, 668, 'BANTARGEBANG');
INSERT INTO `ref_desa` VALUES (1434, 669, 'CITEPUS');
INSERT INTO `ref_desa` VALUES (1435, 669, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (1436, 669, 'BUNIWANGI');
INSERT INTO `ref_desa` VALUES (1437, 669, 'PALABUHANRATU');
INSERT INTO `ref_desa` VALUES (1438, 669, 'CITARIK');
INSERT INTO `ref_desa` VALUES (1439, 669, 'CIKADU');
INSERT INTO `ref_desa` VALUES (1440, 669, 'TONJONG');
INSERT INTO `ref_desa` VALUES (1441, 669, 'PASIRSUREN');
INSERT INTO `ref_desa` VALUES (1442, 670, 'CIHAUR');
INSERT INTO `ref_desa` VALUES (1443, 670, 'KERTAJAYA');
INSERT INTO `ref_desa` VALUES (1444, 670, 'LOJI');
INSERT INTO `ref_desa` VALUES (1445, 670, 'CIDADAP');
INSERT INTO `ref_desa` VALUES (1446, 670, 'CIBUNTU');
INSERT INTO `ref_desa` VALUES (1447, 670, 'MEKARASIH');
INSERT INTO `ref_desa` VALUES (1448, 671, 'PASIRBARU');
INSERT INTO `ref_desa` VALUES (1449, 671, 'CIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (1450, 671, 'CISOLOK');
INSERT INTO `ref_desa` VALUES (1451, 671, 'KARANGPAPAK');
INSERT INTO `ref_desa` VALUES (1452, 671, 'SIMARESMI');
INSERT INTO `ref_desa` VALUES (1453, 671, 'CICADAS');
INSERT INTO `ref_desa` VALUES (1454, 671, 'CIKELAT');
INSERT INTO `ref_desa` VALUES (1455, 671, 'GUNUNG KRAMAT');
INSERT INTO `ref_desa` VALUES (1456, 671, 'GUNUNG TANJUNG');
INSERT INTO `ref_desa` VALUES (1457, 671, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (1458, 672, 'CIMAJA');
INSERT INTO `ref_desa` VALUES (1459, 672, 'CIKAKAK');
INSERT INTO `ref_desa` VALUES (1460, 672, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (1461, 672, 'CILEUNGSING');
INSERT INTO `ref_desa` VALUES (1462, 672, 'GANDASOLI');
INSERT INTO `ref_desa` VALUES (1463, 672, 'RIDOGALIH');
INSERT INTO `ref_desa` VALUES (1464, 672, 'MARGALAKSANA');
INSERT INTO `ref_desa` VALUES (1465, 672, 'SIRNARASA');
INSERT INTO `ref_desa` VALUES (1466, 673, 'BANTARPANJANG');
INSERT INTO `ref_desa` VALUES (1467, 673, 'BOJONGTIPAR');
INSERT INTO `ref_desa` VALUES (1468, 673, 'CIJULANG');
INSERT INTO `ref_desa` VALUES (1469, 673, 'NANGERANG');
INSERT INTO `ref_desa` VALUES (1470, 673, 'BOJONG JENGKOL');
INSERT INTO `ref_desa` VALUES (1471, 673, 'BANTAR AGUNG');
INSERT INTO `ref_desa` VALUES (1472, 673, 'JAMPANG TENGAH');
INSERT INTO `ref_desa` VALUES (1473, 673, 'PANUMBANGAN');
INSERT INTO `ref_desa` VALUES (1474, 673, 'SINDANGRESMI');
INSERT INTO `ref_desa` VALUES (1475, 673, 'TANJUNGSARI');
INSERT INTO `ref_desa` VALUES (1476, 673, 'PADABEUNGHAR');
INSERT INTO `ref_desa` VALUES (1477, 674, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (1478, 674, 'CICUKANG');
INSERT INTO `ref_desa` VALUES (1479, 674, 'MARGALAYU');
INSERT INTO `ref_desa` VALUES (1480, 674, 'PURABAYA');
INSERT INTO `ref_desa` VALUES (1481, 674, 'PAGELARAN');
INSERT INTO `ref_desa` VALUES (1482, 674, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (1483, 674, 'CIMERANG');
INSERT INTO `ref_desa` VALUES (1484, 675, 'NYALINDUNG');
INSERT INTO `ref_desa` VALUES (1485, 675, 'KARTAANGSANA');
INSERT INTO `ref_desa` VALUES (1486, 675, 'BOJONGKALONG');
INSERT INTO `ref_desa` VALUES (1487, 675, 'BOJONGSARI');
INSERT INTO `ref_desa` VALUES (1488, 675, 'CISITU');
INSERT INTO `ref_desa` VALUES (1489, 675, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (1490, 675, 'CIJANGKAR');
INSERT INTO `ref_desa` VALUES (1491, 675, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (1492, 675, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (1493, 675, 'WANGUNREJA');
INSERT INTO `ref_desa` VALUES (1494, 676, 'LANGKAPJAYA');
INSERT INTO `ref_desa` VALUES (1495, 676, 'CILANGKAP');
INSERT INTO `ref_desa` VALUES (1496, 676, 'LENGKONG');
INSERT INTO `ref_desa` VALUES (1497, 676, 'TEGALLEGA');
INSERT INTO `ref_desa` VALUES (1498, 676, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (1499, 677, 'SUKAJAYA');
INSERT INTO `ref_desa` VALUES (1500, 677, 'CIWALAT');
INSERT INTO `ref_desa` VALUES (1501, 677, 'PABUARAN');
INSERT INTO `ref_desa` VALUES (1502, 677, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (1503, 677, 'SIRNASARI');
INSERT INTO `ref_desa` VALUES (1504, 677, 'BANTARSARI');
INSERT INTO `ref_desa` VALUES (1505, 678, 'CIPARAY');
INSERT INTO `ref_desa` VALUES (1506, 678, 'BOJONG GENTENG');
INSERT INTO `ref_desa` VALUES (1507, 678, 'BOJONG SARI');
INSERT INTO `ref_desa` VALUES (1508, 678, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (1509, 678, 'NAGRAKSARI');
INSERT INTO `ref_desa` VALUES (1510, 678, 'JAMPANG KULON');
INSERT INTO `ref_desa` VALUES (1511, 678, 'TANJUNG');
INSERT INTO `ref_desa` VALUES (1512, 678, 'PADAJAYA');
INSERT INTO `ref_desa` VALUES (1513, 678, 'CIKARANG');
INSERT INTO `ref_desa` VALUES (1514, 678, 'KARANGANYAR');
INSERT INTO `ref_desa` VALUES (1515, 679, 'BOREGAN INDAH');
INSERT INTO `ref_desa` VALUES (1516, 679, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (1517, 679, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (1518, 679, 'SUKAJADI');
INSERT INTO `ref_desa` VALUES (1519, 679, 'KARANGMEKAR');
INSERT INTO `ref_desa` VALUES (1520, 679, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (1521, 680, 'CIMAHPAR');
INSERT INTO `ref_desa` VALUES (1522, 680, 'SEKARSARI');
INSERT INTO `ref_desa` VALUES (1523, 680, 'KALIBUNDER');
INSERT INTO `ref_desa` VALUES (1524, 680, 'SUKALUYU');
INSERT INTO `ref_desa` VALUES (1525, 680, 'BOJONG');
INSERT INTO `ref_desa` VALUES (1526, 680, 'BALEKAMBANG');
INSERT INTO `ref_desa` VALUES (1527, 681, 'SWAKARYA');
INSERT INTO `ref_desa` VALUES (1528, 681, 'JAGAMUKTI');
INSERT INTO `ref_desa` VALUES (1529, 681, 'CITANGKAR');
INSERT INTO `ref_desa` VALUES (1530, 681, 'KADALEMAN');
INSERT INTO `ref_desa` VALUES (1531, 681, 'WANASARI');
INSERT INTO `ref_desa` VALUES (1532, 681, 'SIRNASARI');
INSERT INTO `ref_desa` VALUES (1533, 681, 'PASIR IPIS');
INSERT INTO `ref_desa` VALUES (1534, 681, 'BUNIWANGI');
INSERT INTO `ref_desa` VALUES (1535, 681, 'CIPEUNDEUY');
INSERT INTO `ref_desa` VALUES (1536, 681, 'GUNUNG SUNGGING');
INSERT INTO `ref_desa` VALUES (1537, 681, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (1538, 682, 'CIDAHU');
INSERT INTO `ref_desa` VALUES (1539, 682, 'CIBITUNG');
INSERT INTO `ref_desa` VALUES (1540, 682, 'BANYUWANGI');
INSERT INTO `ref_desa` VALUES (1541, 682, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (1542, 682, 'BANYUMURNI');
INSERT INTO `ref_desa` VALUES (1543, 682, 'TALAGAMURNI');
INSERT INTO `ref_desa` VALUES (1544, 683, 'SINAR BENTANG');
INSERT INTO `ref_desa` VALUES (1545, 683, 'GUNUNG BENTANG');
INSERT INTO `ref_desa` VALUES (1546, 683, 'PASANGGRAHAN');
INSERT INTO `ref_desa` VALUES (1547, 683, 'CURUGLUHUR');
INSERT INTO `ref_desa` VALUES (1548, 683, 'DATARNANGKA');
INSERT INTO `ref_desa` VALUES (1549, 683, 'SEGARANTEN');
INSERT INTO `ref_desa` VALUES (1550, 683, 'MARGALUYU');
INSERT INTO `ref_desa` VALUES (1551, 683, 'CIBITUNG');
INSERT INTO `ref_desa` VALUES (1552, 683, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (1553, 683, 'CIBAREGBEG');
INSERT INTO `ref_desa` VALUES (1554, 683, 'PUNCAKMANGGIS');
INSERT INTO `ref_desa` VALUES (1555, 684, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (1556, 684, 'CURUGKEMBAR');
INSERT INTO `ref_desa` VALUES (1557, 684, 'TANJUNGSARI');
INSERT INTO `ref_desa` VALUES (1558, 684, 'MEKARTANJUNG');
INSERT INTO `ref_desa` VALUES (1559, 684, 'SINDANGRAJA');
INSERT INTO `ref_desa` VALUES (1560, 685, 'HEGARMULYA');
INSERT INTO `ref_desa` VALUES (1561, 685, 'CIDADAP');
INSERT INTO `ref_desa` VALUES (1562, 685, 'PADASENANG');
INSERT INTO `ref_desa` VALUES (1563, 685, 'BANJARSARI');
INSERT INTO `ref_desa` VALUES (1564, 686, 'GUNUNGBATU');
INSERT INTO `ref_desa` VALUES (1565, 686, 'CIKANGKUNG');
INSERT INTO `ref_desa` VALUES (1566, 686, 'PURWASEDAR');
INSERT INTO `ref_desa` VALUES (1567, 686, 'CIRACAP');
INSERT INTO `ref_desa` VALUES (1568, 686, 'PASIRPANJANG');
INSERT INTO `ref_desa` VALUES (1569, 686, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (1570, 687, 'CARINGIN NUNGGAL');
INSERT INTO `ref_desa` VALUES (1571, 687, 'WALURAN');
INSERT INTO `ref_desa` VALUES (1572, 687, 'SUKAMUKTI');
INSERT INTO `ref_desa` VALUES (1573, 687, 'MEKAR MUKTI');
INSERT INTO `ref_desa` VALUES (1574, 688, 'CIDOLOG');
INSERT INTO `ref_desa` VALUES (1575, 688, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (1576, 688, 'CIKARANG');
INSERT INTO `ref_desa` VALUES (1577, 688, 'CIPAMINGKIS');
INSERT INTO `ref_desa` VALUES (1578, 688, 'TEGALLEGA');
INSERT INTO `ref_desa` VALUES (1579, 689, 'TEGALBULEUD');
INSERT INTO `ref_desa` VALUES (1580, 689, 'BUNIASIH');
INSERT INTO `ref_desa` VALUES (1581, 689, 'SUMBERJAYA');
INSERT INTO `ref_desa` VALUES (1582, 689, 'NANGELA');
INSERT INTO `ref_desa` VALUES (1583, 689, 'RAMBAY');
INSERT INTO `ref_desa` VALUES (1584, 689, 'BANGBAYANG');
INSERT INTO `ref_desa` VALUES (1585, 689, 'TEGALBULEUD');
INSERT INTO `ref_desa` VALUES (1586, 690, 'CIEMAS');
INSERT INTO `ref_desa` VALUES (1587, 690, 'GIRIMUKTI');
INSERT INTO `ref_desa` VALUES (1588, 690, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (1589, 690, 'CIWARU');
INSERT INTO `ref_desa` VALUES (1590, 690, 'CIBENDA');
INSERT INTO `ref_desa` VALUES (1591, 690, 'TAMANJAYA');
INSERT INTO `ref_desa` VALUES (1592, 690, 'MANDRAJAYA');
INSERT INTO `ref_desa` VALUES (1593, 645, 'PARUNGSEAH');
INSERT INTO `ref_desa` VALUES (1594, 692, 'UUU');
INSERT INTO `ref_desa` VALUES (1595, 692, 'OLOOLLO');
INSERT INTO `ref_desa` VALUES (1596, 585, 'BANDUNG');
INSERT INTO `ref_desa` VALUES (1597, 582, 'CIMAHI');
INSERT INTO `ref_desa` VALUES (1598, 583, 'SEKEJEJATI');
INSERT INTO `ref_desa` VALUES (1599, 644, 'BANJAR MASIN');
INSERT INTO `ref_desa` VALUES (1600, 85, 'CIREUNDEU');
INSERT INTO `ref_desa` VALUES (1601, 85, 'GUNUNG BATU');
INSERT INTO `ref_desa` VALUES (1602, 637, 'SERPONG');
INSERT INTO `ref_desa` VALUES (1603, 637, 'TANGGERANG');
INSERT INTO `ref_desa` VALUES (1604, 629, 'MUARA BAKTI');
INSERT INTO `ref_desa` VALUES (1605, 631, 'ARENG JAYA');
INSERT INTO `ref_desa` VALUES (1606, 631, 'BEKASI');
INSERT INTO `ref_desa` VALUES (1607, 631, 'BEKASI TIMUR');
INSERT INTO `ref_desa` VALUES (1608, 631, 'CIKARANG');
INSERT INTO `ref_desa` VALUES (1609, 631, 'JATIWARINGIN');
INSERT INTO `ref_desa` VALUES (1610, 631, 'TELUK PUCUNG');
INSERT INTO `ref_desa` VALUES (1611, 632, 'ARENJAYA');
INSERT INTO `ref_desa` VALUES (1612, 632, 'BEKASI TIMUR');
INSERT INTO `ref_desa` VALUES (1613, 632, 'MARGAHAYU');
INSERT INTO `ref_desa` VALUES (1614, 633, 'WANASARI');
INSERT INTO `ref_desa` VALUES (1615, 634, 'CIKARANGBARU');
INSERT INTO `ref_desa` VALUES (1616, 634, 'KARANG ASIH');
INSERT INTO `ref_desa` VALUES (1617, 634, 'SIMPENAN');
INSERT INTO `ref_desa` VALUES (1618, 635, 'BOJONG RAWA LUMBU');
INSERT INTO `ref_desa` VALUES (1619, 636, 'SUMBER JAYA');
INSERT INTO `ref_desa` VALUES (1620, 637, 'TANGERAMG');
INSERT INTO `ref_desa` VALUES (1621, 139, 'BOJONG GEDE');
INSERT INTO `ref_desa` VALUES (1622, 139, 'BTR');
INSERT INTO `ref_desa` VALUES (1623, 139, 'CAINGIN KULON');
INSERT INTO `ref_desa` VALUES (1624, 139, 'CIBENING');
INSERT INTO `ref_desa` VALUES (1625, 139, 'CIBINONG');
INSERT INTO `ref_desa` VALUES (1626, 139, 'CILUWER');
INSERT INTO `ref_desa` VALUES (1627, 139, 'CITEUREUP');
INSERT INTO `ref_desa` VALUES (1628, 139, 'DERMAGA');
INSERT INTO `ref_desa` VALUES (1629, 139, 'MALASARI');
INSERT INTO `ref_desa` VALUES (1630, 139, 'MUARA JAYA');
INSERT INTO `ref_desa` VALUES (1631, 139, 'PALASARI');
INSERT INTO `ref_desa` VALUES (1632, 139, 'PANCAWATI');
INSERT INTO `ref_desa` VALUES (1633, 139, 'SEMPUR');
INSERT INTO `ref_desa` VALUES (1634, 139, 'TAJUR');
INSERT INTO `ref_desa` VALUES (1635, 203, 'TEGAL LEGA');
INSERT INTO `ref_desa` VALUES (1636, 150, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (1637, 151, 'BOGOR UTARA');
INSERT INTO `ref_desa` VALUES (1638, 151, 'KEDUNG HALANG');
INSERT INTO `ref_desa` VALUES (1639, 140, 'BOJONG GEDE');
INSERT INTO `ref_desa` VALUES (1640, 140, 'PABUARAB');
INSERT INTO `ref_desa` VALUES (1641, 140, 'RAGAJAYA');
INSERT INTO `ref_desa` VALUES (1642, 141, 'CAARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (1643, 141, 'CARNGIN WETAN');
INSERT INTO `ref_desa` VALUES (1644, 141, 'CIHERANGPONDOK');
INSERT INTO `ref_desa` VALUES (1645, 141, 'CIKARETEK');
INSERT INTO `ref_desa` VALUES (1646, 141, 'CISALOPA');
INSERT INTO `ref_desa` VALUES (1647, 141, 'CLAEATUH');
INSERT INTO `ref_desa` VALUES (1648, 141, 'LEMAH DUUR');
INSERT INTO `ref_desa` VALUES (1649, 141, 'MUARA DUA');
INSERT INTO `ref_desa` VALUES (1650, 141, 'PASIR BIUNCIR');
INSERT INTO `ref_desa` VALUES (1651, 141, 'PASIRMUJCANG');
INSERT INTO `ref_desa` VALUES (1652, 141, 'TANGKIL');
INSERT INTO `ref_desa` VALUES (1653, 141, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (1654, 155, 'CIADEG');
INSERT INTO `ref_desa` VALUES (1655, 155, 'TEGAL KOPI');
INSERT INTO `ref_desa` VALUES (1656, 156, 'CIAMPEA');
INSERT INTO `ref_desa` VALUES (1657, 156, 'CIAMPEA UDIK');
INSERT INTO `ref_desa` VALUES (1658, 157, 'SINARGALIH');
INSERT INTO `ref_desa` VALUES (1659, 158, 'BAKOM');
INSERT INTO `ref_desa` VALUES (1660, 158, 'CIAWI');
INSERT INTO `ref_desa` VALUES (1661, 158, 'CIBEDUG');
INSERT INTO `ref_desa` VALUES (1662, 158, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (1663, 158, 'CILEUNGSI');
INSERT INTO `ref_desa` VALUES (1664, 158, 'HARJASARI');
INSERT INTO `ref_desa` VALUES (1665, 158, 'PANCAWATI');
INSERT INTO `ref_desa` VALUES (1666, 158, 'PANDANSARI');
INSERT INTO `ref_desa` VALUES (1667, 158, 'PASIR MUNCANG');
INSERT INTO `ref_desa` VALUES (1668, 158, 'TAJUR');
INSERT INTO `ref_desa` VALUES (1669, 158, 'TELUK PINANG');
INSERT INTO `ref_desa` VALUES (1670, 158, 'WARUNGNANGKA');
INSERT INTO `ref_desa` VALUES (1671, 160, 'CIBINONG');
INSERT INTO `ref_desa` VALUES (1672, 160, 'NANGGEWER');
INSERT INTO `ref_desa` VALUES (1673, 160, 'PABUARAN');
INSERT INTO `ref_desa` VALUES (1674, 160, 'PEKAN SARI');
INSERT INTO `ref_desa` VALUES (1675, 161, 'CIBULUH');
INSERT INTO `ref_desa` VALUES (1676, 161, 'CIBULUH BOGOR');
INSERT INTO `ref_desa` VALUES (1677, 162, 'CIBUNGBULANG');
INSERT INTO `ref_desa` VALUES (1678, 163, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (1679, 163, 'CIGOMABONG');
INSERT INTO `ref_desa` VALUES (1680, 164, 'PARUNG KUDA');
INSERT INTO `ref_desa` VALUES (1681, 142, 'BATES JAYA');
INSERT INTO `ref_desa` VALUES (1682, 142, 'BENDA');
INSERT INTO `ref_desa` VALUES (1683, 142, 'BENDA MUTIARALIDO');
INSERT INTO `ref_desa` VALUES (1684, 142, 'BOJONG CIHARIK');
INSERT INTO `ref_desa` VALUES (1685, 142, 'BOJONG KIHARIP');
INSERT INTO `ref_desa` VALUES (1686, 142, 'BOJONGKIHRID');
INSERT INTO `ref_desa` VALUES (1687, 142, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (1688, 142, 'CBADAK MASASNG');
INSERT INTO `ref_desa` VALUES (1689, 142, 'CBRAYUT');
INSERT INTO `ref_desa` VALUES (1690, 142, 'CBRUY');
INSERT INTO `ref_desa` VALUES (1691, 142, 'CIADEG');
INSERT INTO `ref_desa` VALUES (1692, 142, 'CIADEUG');
INSERT INTO `ref_desa` VALUES (1693, 142, 'CIATEG');
INSERT INTO `ref_desa` VALUES (1694, 142, 'CIBARAYUT');
INSERT INTO `ref_desa` VALUES (1695, 142, 'CIBARUYAT');
INSERT INTO `ref_desa` VALUES (1696, 142, 'CIBGOMBONG');
INSERT INTO `ref_desa` VALUES (1697, 142, 'CIBUARAYUT');
INSERT INTO `ref_desa` VALUES (1698, 142, 'CIBULUH BOGOR');
INSERT INTO `ref_desa` VALUES (1699, 142, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (1700, 142, 'CIBURIH');
INSERT INTO `ref_desa` VALUES (1701, 142, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (1702, 142, 'CIBURUY CIJERUK');
INSERT INTO `ref_desa` VALUES (1703, 142, 'CIBURYUT');
INSERT INTO `ref_desa` VALUES (1704, 142, 'CIBUURUY');
INSERT INTO `ref_desa` VALUES (1705, 142, 'CIGEMBONG');
INSERT INTO `ref_desa` VALUES (1706, 142, 'CIGGOMBONG');
INSERT INTO `ref_desa` VALUES (1707, 142, 'CIGOMBING');
INSERT INTO `ref_desa` VALUES (1708, 142, 'CIGOMBOBG');
INSERT INTO `ref_desa` VALUES (1709, 142, 'CIGOMBOMNG');
INSERT INTO `ref_desa` VALUES (1710, 142, 'CIGOMBOMNHNG');
INSERT INTO `ref_desa` VALUES (1711, 142, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (1712, 142, 'CIGOMBONG BGOR');
INSERT INTO `ref_desa` VALUES (1713, 142, 'CIGOMBONG BOGOR');
INSERT INTO `ref_desa` VALUES (1714, 142, 'CIGOMBONG LIDO');
INSERT INTO `ref_desa` VALUES (1715, 142, 'CIGOMBONGLIDO');
INSERT INTO `ref_desa` VALUES (1716, 142, 'CIGOMGNB');
INSERT INTO `ref_desa` VALUES (1717, 142, 'CIGPMBONG');
INSERT INTO `ref_desa` VALUES (1718, 142, 'CIJAMBU');
INSERT INTO `ref_desa` VALUES (1719, 142, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (1720, 142, 'CIJUERUK');
INSERT INTO `ref_desa` VALUES (1721, 142, 'CIKIDANG');
INSERT INTO `ref_desa` VALUES (1722, 142, 'CILETUH');
INSERT INTO `ref_desa` VALUES (1723, 142, 'CIMANDE');
INSERT INTO `ref_desa` VALUES (1724, 142, 'CINBURAYUT');
INSERT INTO `ref_desa` VALUES (1725, 142, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (1726, 142, 'CIPULUS');
INSERT INTO `ref_desa` VALUES (1727, 142, 'CISALADA');
INSERT INTO `ref_desa` VALUES (1728, 142, 'CISALADAH');
INSERT INTO `ref_desa` VALUES (1729, 142, 'CITUGU');
INSERT INTO `ref_desa` VALUES (1730, 142, 'CIWATES JAYA');
INSERT INTO `ref_desa` VALUES (1731, 142, 'COGOMBONG');
INSERT INTO `ref_desa` VALUES (1732, 142, 'COIGOMBONG');
INSERT INTO `ref_desa` VALUES (1733, 142, 'COIGOMBONGLIDO');
INSERT INTO `ref_desa` VALUES (1734, 142, 'KEBON JERUK');
INSERT INTO `ref_desa` VALUES (1735, 142, 'KILENJONG');
INSERT INTO `ref_desa` VALUES (1736, 142, 'LENGSKOJNG');
INSERT INTO `ref_desa` VALUES (1737, 142, 'LIDO');
INSERT INTO `ref_desa` VALUES (1738, 142, 'MALOINGPING');
INSERT INTO `ref_desa` VALUES (1739, 142, 'MUARA');
INSERT INTO `ref_desa` VALUES (1740, 142, 'NAGROG');
INSERT INTO `ref_desa` VALUES (1741, 142, 'PAJAGAN');
INSERT INTO `ref_desa` VALUES (1742, 142, 'PALAJAYA');
INSERT INTO `ref_desa` VALUES (1743, 142, 'PALALANGON');
INSERT INTO `ref_desa` VALUES (1744, 142, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (1745, 142, 'PAPISANGAN');
INSERT INTO `ref_desa` VALUES (1746, 142, 'PAS JAYA');
INSERT INTO `ref_desa` VALUES (1747, 142, 'PASI RAJAYA');
INSERT INTO `ref_desa` VALUES (1748, 142, 'PASIR  JAYA');
INSERT INTO `ref_desa` VALUES (1749, 142, 'PASIR BUNCIR');
INSERT INTO `ref_desa` VALUES (1750, 142, 'PASIR JAYA');
INSERT INTO `ref_desa` VALUES (1751, 142, 'PASIR JYA');
INSERT INTO `ref_desa` VALUES (1752, 142, 'PASIR KUDA');
INSERT INTO `ref_desa` VALUES (1753, 142, 'PASIRBUNCIR');
INSERT INTO `ref_desa` VALUES (1754, 142, 'PASIRJAA');
INSERT INTO `ref_desa` VALUES (1755, 142, 'PASIRJAYA');
INSERT INTO `ref_desa` VALUES (1756, 142, 'PS SIR JAYA');
INSERT INTO `ref_desa` VALUES (1757, 142, 'PSR. JAYA');
INSERT INTO `ref_desa` VALUES (1758, 142, 'SAWAH ASEP');
INSERT INTO `ref_desa` VALUES (1759, 142, 'SEROGOL');
INSERT INTO `ref_desa` VALUES (1760, 142, 'SOROGOL');
INSERT INTO `ref_desa` VALUES (1761, 142, 'SROGOL');
INSERT INTO `ref_desa` VALUES (1762, 142, 'TUGU');
INSERT INTO `ref_desa` VALUES (1763, 142, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (1764, 142, 'TUGUJAYA');
INSERT INTO `ref_desa` VALUES (1765, 142, 'WAAAATES JAYA');
INSERT INTO `ref_desa` VALUES (1766, 142, 'WAATESJAYA');
INSERT INTO `ref_desa` VALUES (1767, 142, 'WARES  JAYA');
INSERT INTO `ref_desa` VALUES (1768, 142, 'WARTES JAYA');
INSERT INTO `ref_desa` VALUES (1769, 142, 'WARTESJAYA');
INSERT INTO `ref_desa` VALUES (1770, 142, 'WARTI JAYA');
INSERT INTO `ref_desa` VALUES (1771, 142, 'WATAES JAYA');
INSERT INTO `ref_desa` VALUES (1772, 142, 'WATES JAYA');
INSERT INTO `ref_desa` VALUES (1773, 142, 'WATES JYA');
INSERT INTO `ref_desa` VALUES (1774, 142, 'WATESJAYA');
INSERT INTO `ref_desa` VALUES (1775, 142, 'WATTES JAYA');
INSERT INTO `ref_desa` VALUES (1776, 142, 'WATTESJAYA');
INSERT INTO `ref_desa` VALUES (1777, 166, 'CIHERANG');
INSERT INTO `ref_desa` VALUES (1778, 167, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (1779, 143, 'BATA ALAM');
INSERT INTO `ref_desa` VALUES (1780, 143, 'BATU ALAM');
INSERT INTO `ref_desa` VALUES (1781, 143, 'BENDA');
INSERT INTO `ref_desa` VALUES (1782, 143, 'BENTENGTUGU');
INSERT INTO `ref_desa` VALUES (1783, 143, 'BOJONG HAREUP');
INSERT INTO `ref_desa` VALUES (1784, 143, 'BOJONG KIHARIP');
INSERT INTO `ref_desa` VALUES (1785, 143, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (1786, 143, 'CBALUNG CUJERUK');
INSERT INTO `ref_desa` VALUES (1787, 143, 'CIADEG');
INSERT INTO `ref_desa` VALUES (1788, 143, 'CIADEM');
INSERT INTO `ref_desa` VALUES (1789, 143, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (1790, 143, 'CIBALUNG');
INSERT INTO `ref_desa` VALUES (1791, 143, 'CIBARU');
INSERT INTO `ref_desa` VALUES (1792, 143, 'CIBARUYAT');
INSERT INTO `ref_desa` VALUES (1793, 143, 'CIBAURAYUT');
INSERT INTO `ref_desa` VALUES (1794, 143, 'CIBEBER II');
INSERT INTO `ref_desa` VALUES (1795, 143, 'CIBERAYUT');
INSERT INTO `ref_desa` VALUES (1796, 143, 'CIBOGO');
INSERT INTO `ref_desa` VALUES (1797, 143, 'CIBUNAN');
INSERT INTO `ref_desa` VALUES (1798, 143, 'CIBURAYOT');
INSERT INTO `ref_desa` VALUES (1799, 143, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (1800, 143, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (1801, 143, 'CIBURUYUT');
INSERT INTO `ref_desa` VALUES (1802, 143, 'CICBURUY');
INSERT INTO `ref_desa` VALUES (1803, 143, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (1804, 143, 'CIGOPMBONG');
INSERT INTO `ref_desa` VALUES (1805, 143, 'CIJEERUK');
INSERT INTO `ref_desa` VALUES (1806, 143, 'CIJERUJK');
INSERT INTO `ref_desa` VALUES (1807, 143, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (1808, 143, 'CIJERUK BOGOR');
INSERT INTO `ref_desa` VALUES (1809, 143, 'CIJEUK');
INSERT INTO `ref_desa` VALUES (1810, 143, 'CIJURUK');
INSERT INTO `ref_desa` VALUES (1811, 143, 'CILADEG');
INSERT INTO `ref_desa` VALUES (1812, 143, 'CILETUH');
INSERT INTO `ref_desa` VALUES (1813, 143, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (1814, 143, 'CIPELANG');
INSERT INTO `ref_desa` VALUES (1815, 143, 'CISALADA');
INSERT INTO `ref_desa` VALUES (1816, 143, 'CISALAGA');
INSERT INTO `ref_desa` VALUES (1817, 143, 'CISALOPA');
INSERT INTO `ref_desa` VALUES (1818, 143, 'CITUGU');
INSERT INTO `ref_desa` VALUES (1819, 143, 'CUKANG GALUH');
INSERT INTO `ref_desa` VALUES (1820, 143, 'DANAU LIDO');
INSERT INTO `ref_desa` VALUES (1821, 143, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (1822, 143, 'GUNUNG JAYA');
INSERT INTO `ref_desa` VALUES (1823, 143, 'KIARA LIDO');
INSERT INTO `ref_desa` VALUES (1824, 143, 'KONGSI');
INSERT INTO `ref_desa` VALUES (1825, 143, 'LENGKONG');
INSERT INTO `ref_desa` VALUES (1826, 143, 'LIDO');
INSERT INTO `ref_desa` VALUES (1827, 143, 'LOJI');
INSERT INTO `ref_desa` VALUES (1828, 143, 'MALASARI');
INSERT INTO `ref_desa` VALUES (1829, 143, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (1830, 143, 'MUARA JAYA');
INSERT INTO `ref_desa` VALUES (1831, 143, 'PADIR JAYA');
INSERT INTO `ref_desa` VALUES (1832, 143, 'PASAIR JAYA');
INSERT INTO `ref_desa` VALUES (1833, 143, 'PASIR  JAYA');
INSERT INTO `ref_desa` VALUES (1834, 143, 'PASIR AJAYA');
INSERT INTO `ref_desa` VALUES (1835, 143, 'PASIR BUNCIR');
INSERT INTO `ref_desa` VALUES (1836, 143, 'PASIR JAYA');
INSERT INTO `ref_desa` VALUES (1837, 143, 'PASIR JAYA.');
INSERT INTO `ref_desa` VALUES (1838, 143, 'PASIRJAYA');
INSERT INTO `ref_desa` VALUES (1839, 143, 'PASIRPACAR');
INSERT INTO `ref_desa` VALUES (1840, 143, 'PAWASAWAHAN');
INSERT INTO `ref_desa` VALUES (1841, 143, 'PS JAYA');
INSERT INTO `ref_desa` VALUES (1842, 143, 'ROGOL');
INSERT INTO `ref_desa` VALUES (1843, 143, 'SELAAWI');
INSERT INTO `ref_desa` VALUES (1844, 143, 'SEROGOL');
INSERT INTO `ref_desa` VALUES (1845, 143, 'SILIH ASUH');
INSERT INTO `ref_desa` VALUES (1846, 143, 'SILIWANGI');
INSERT INTO `ref_desa` VALUES (1847, 143, 'SOGOROL');
INSERT INTO `ref_desa` VALUES (1848, 143, 'SOROGOL');
INSERT INTO `ref_desa` VALUES (1849, 143, 'SPN LIDO');
INSERT INTO `ref_desa` VALUES (1850, 143, 'SROGOL');
INSERT INTO `ref_desa` VALUES (1851, 143, 'SUKA SARI');
INSERT INTO `ref_desa` VALUES (1852, 143, 'TANJUNG SARI');
INSERT INTO `ref_desa` VALUES (1853, 143, 'TENJO JAYA');
INSERT INTO `ref_desa` VALUES (1854, 143, 'TUGU');
INSERT INTO `ref_desa` VALUES (1855, 143, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (1856, 143, 'TUGUJAYA');
INSERT INTO `ref_desa` VALUES (1857, 143, 'WARES JAYA');
INSERT INTO `ref_desa` VALUES (1858, 143, 'WARNAJATI');
INSERT INTO `ref_desa` VALUES (1859, 143, 'WARTES JAYA');
INSERT INTO `ref_desa` VALUES (1860, 143, 'WARUNG GENTENG');
INSERT INTO `ref_desa` VALUES (1861, 143, 'WARUNG MENTENG');
INSERT INTO `ref_desa` VALUES (1862, 143, 'WATES AJAYA');
INSERT INTO `ref_desa` VALUES (1863, 143, 'WATES JAYA');
INSERT INTO `ref_desa` VALUES (1864, 143, 'WATESJAYA');
INSERT INTO `ref_desa` VALUES (1865, 143, 'WAWTES JAYA');
INSERT INTO `ref_desa` VALUES (1866, 143, 'WR MENTENG');
INSERT INTO `ref_desa` VALUES (1867, 172, 'CIKARET');
INSERT INTO `ref_desa` VALUES (1868, 172, 'CIOMAS');
INSERT INTO `ref_desa` VALUES (1869, 172, 'PADA SUKA');
INSERT INTO `ref_desa` VALUES (1870, 172, 'PAGELARAN');
INSERT INTO `ref_desa` VALUES (1871, 172, 'TAMAN SARI');
INSERT INTO `ref_desa` VALUES (1872, 600, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (1873, 174, 'CIBUBUTAN');
INSERT INTO `ref_desa` VALUES (1874, 174, 'CIPAYUNG');
INSERT INTO `ref_desa` VALUES (1875, 174, 'CISARUA');
INSERT INTO `ref_desa` VALUES (1876, 174, 'LEUWI MALANG');
INSERT INTO `ref_desa` VALUES (1877, 176, 'CIPAMUAN');
INSERT INTO `ref_desa` VALUES (1878, 176, 'CITEUREP');
INSERT INTO `ref_desa` VALUES (1879, 176, 'CITEUREUP');
INSERT INTO `ref_desa` VALUES (1880, 176, 'KARANG ASEM');
INSERT INTO `ref_desa` VALUES (1881, 176, 'PUSPASARI');
INSERT INTO `ref_desa` VALUES (1882, 176, 'SANJA');
INSERT INTO `ref_desa` VALUES (1883, 176, 'TAJUR');
INSERT INTO `ref_desa` VALUES (1884, 144, 'CIHERANG');
INSERT INTO `ref_desa` VALUES (1885, 20, 'JAJAR');
INSERT INTO `ref_desa` VALUES (1886, 20, 'JATIAJAR');
INSERT INTO `ref_desa` VALUES (1887, 20, 'JATIJAJAR');
INSERT INTO `ref_desa` VALUES (1888, 20, 'JATIJJAR');
INSERT INTO `ref_desa` VALUES (1889, 20, 'LIMO');
INSERT INTO `ref_desa` VALUES (1890, 145, 'CIBINONG');
INSERT INTO `ref_desa` VALUES (1891, 180, 'SIPAK');
INSERT INTO `ref_desa` VALUES (1892, 181, 'JONGGOL');
INSERT INTO `ref_desa` VALUES (1893, 182, 'WATESJAYA');
INSERT INTO `ref_desa` VALUES (1894, 183, 'CIPARIGI');
INSERT INTO `ref_desa` VALUES (1895, 184, 'KEMANG');
INSERT INTO `ref_desa` VALUES (1896, 185, 'LIMUSNUNGGAL');
INSERT INTO `ref_desa` VALUES (1897, 186, 'CIADEG');
INSERT INTO `ref_desa` VALUES (1898, 186, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (1899, 186, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (1900, 186, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (1901, 186, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (1902, 186, 'CILEBUT TTIMUR');
INSERT INTO `ref_desa` VALUES (1903, 186, 'CILEUNGSI');
INSERT INTO `ref_desa` VALUES (1904, 186, 'CIMANDE');
INSERT INTO `ref_desa` VALUES (1905, 186, 'CIOMAS');
INSERT INTO `ref_desa` VALUES (1906, 186, 'CIPURUT');
INSERT INTO `ref_desa` VALUES (1907, 186, 'KARANG WANGI');
INSERT INTO `ref_desa` VALUES (1908, 186, 'LIDO');
INSERT INTO `ref_desa` VALUES (1909, 186, 'LUAR WILAYAH');
INSERT INTO `ref_desa` VALUES (1910, 186, 'MALASARI');
INSERT INTO `ref_desa` VALUES (1911, 186, 'NANGGUNG');
INSERT INTO `ref_desa` VALUES (1912, 186, 'PASIR EURIH');
INSERT INTO `ref_desa` VALUES (1913, 186, 'PASIR JAYA');
INSERT INTO `ref_desa` VALUES (1914, 186, 'PASIRJAYA');
INSERT INTO `ref_desa` VALUES (1915, 186, 'SOROGOL');
INSERT INTO `ref_desa` VALUES (1916, 186, 'SROGOL');
INSERT INTO `ref_desa` VALUES (1917, 186, 'SUKAJAYA');
INSERT INTO `ref_desa` VALUES (1918, 186, 'SUKAKARYA');
INSERT INTO `ref_desa` VALUES (1919, 186, 'SUKAKERSA');
INSERT INTO `ref_desa` VALUES (1920, 186, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (1921, 186, 'WARU');
INSERT INTO `ref_desa` VALUES (1922, 188, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (1923, 188, 'NGRAK UTARA');
INSERT INTO `ref_desa` VALUES (1924, 188, 'SUKADAMAI');
INSERT INTO `ref_desa` VALUES (1925, 146, 'BTR.KARET');
INSERT INTO `ref_desa` VALUES (1926, 146, 'MALASARI');
INSERT INTO `ref_desa` VALUES (1927, 146, 'MALSARI');
INSERT INTO `ref_desa` VALUES (1928, 146, 'PALASARI');
INSERT INTO `ref_desa` VALUES (1929, 190, 'PALEDANG');
INSERT INTO `ref_desa` VALUES (1930, 193, 'CANDALI');
INSERT INTO `ref_desa` VALUES (1931, 683, 'CINAGARA');
INSERT INTO `ref_desa` VALUES (1932, 194, 'SASAK PANJANG');
INSERT INTO `ref_desa` VALUES (1933, 195, 'PANBUARAN');
INSERT INTO `ref_desa` VALUES (1934, 196, 'BOJONG SAWAH');
INSERT INTO `ref_desa` VALUES (1935, 196, 'CADAS NGAMPAR');
INSERT INTO `ref_desa` VALUES (1936, 196, 'CIJUJUNG');
INSERT INTO `ref_desa` VALUES (1937, 196, 'CIMANDALA');
INSERT INTO `ref_desa` VALUES (1938, 196, 'PASIR JAMI');
INSERT INTO `ref_desa` VALUES (1939, 196, 'PS HALANG');
INSERT INTO `ref_desa` VALUES (1940, 198, 'WARINGIN');
INSERT INTO `ref_desa` VALUES (1941, 139, 'BOGOR TIMUR');
INSERT INTO `ref_desa` VALUES (1942, 139, 'BONDONGAN');
INSERT INTO `ref_desa` VALUES (1943, 139, 'CIBINONG');
INSERT INTO `ref_desa` VALUES (1944, 139, 'GENTENG');
INSERT INTO `ref_desa` VALUES (1945, 139, 'JEMBATAN DUA');
INSERT INTO `ref_desa` VALUES (1946, 139, 'MEKARWNGI');
INSERT INTO `ref_desa` VALUES (1947, 139, 'PRAJA');
INSERT INTO `ref_desa` VALUES (1948, 139, 'TANAH BARU');
INSERT INTO `ref_desa` VALUES (1949, 201, 'BOGOR');
INSERT INTO `ref_desa` VALUES (1950, 201, 'BOGOR BARAT');
INSERT INTO `ref_desa` VALUES (1951, 201, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (1952, 201, 'CILENDEK');
INSERT INTO `ref_desa` VALUES (1953, 201, 'CURUG MEKAR');
INSERT INTO `ref_desa` VALUES (1954, 201, 'DARMAGA');
INSERT INTO `ref_desa` VALUES (1955, 201, 'GUNUNG BATU');
INSERT INTO `ref_desa` VALUES (1956, 201, 'GUNUNGBATU');
INSERT INTO `ref_desa` VALUES (1957, 202, 'BONDONGAN');
INSERT INTO `ref_desa` VALUES (1958, 202, 'CIKARET');
INSERT INTO `ref_desa` VALUES (1959, 202, 'HARJASARI');
INSERT INTO `ref_desa` VALUES (1960, 202, 'KARTAMAYA');
INSERT INTO `ref_desa` VALUES (1961, 202, 'KEBON KALAPA');
INSERT INTO `ref_desa` VALUES (1962, 202, 'KERTAMAYA');
INSERT INTO `ref_desa` VALUES (1963, 202, 'RANCAMAYA');
INSERT INTO `ref_desa` VALUES (1964, 202, 'RANGGA MEKAR');
INSERT INTO `ref_desa` VALUES (1965, 203, 'GUDANG');
INSERT INTO `ref_desa` VALUES (1966, 203, 'KEBON KOPI');
INSERT INTO `ref_desa` VALUES (1967, 150, 'BARANANG SIANG');
INSERT INTO `ref_desa` VALUES (1968, 150, 'BOGOR TIMUR');
INSERT INTO `ref_desa` VALUES (1969, 150, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (1970, 151, 'BANTAR JATI');
INSERT INTO `ref_desa` VALUES (1971, 151, 'BARANANG SIANG');
INSERT INTO `ref_desa` VALUES (1972, 141, 'CAARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (1973, 142, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (1974, 142, 'CIGOMBONG LIDO');
INSERT INTO `ref_desa` VALUES (1975, 142, 'CISALADA');
INSERT INTO `ref_desa` VALUES (1976, 142, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (1977, 142, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (1978, 142, 'WATES JAYA');
INSERT INTO `ref_desa` VALUES (1979, 143, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (1980, 143, 'CUJAMBYIU');
INSERT INTO `ref_desa` VALUES (1981, 143, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (1982, 209, 'DRAMAGA');
INSERT INTO `ref_desa` VALUES (1983, 190, 'PALEDANG');
INSERT INTO `ref_desa` VALUES (1984, 211, 'SINDANGSARI');
INSERT INTO `ref_desa` VALUES (1985, 620, 'ANDAP PRAJA');
INSERT INTO `ref_desa` VALUES (1986, 196, 'SUKAJADI');
INSERT INTO `ref_desa` VALUES (1987, 574, 'CISUJEN');
INSERT INTO `ref_desa` VALUES (1988, 621, 'DSUKAHARJA');
INSERT INTO `ref_desa` VALUES (1989, 82, 'JATIJAR');
INSERT INTO `ref_desa` VALUES (1990, 186, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (1991, 186, 'DEPOK');
INSERT INTO `ref_desa` VALUES (1992, 616, 'GARUT');
INSERT INTO `ref_desa` VALUES (1993, 616, 'KOTA KULON');
INSERT INTO `ref_desa` VALUES (1994, 616, 'TAROGGONG');
INSERT INTO `ref_desa` VALUES (1995, 616, 'TAROGONG');
INSERT INTO `ref_desa` VALUES (1996, 640, 'LEBENG SUMO');
INSERT INTO `ref_desa` VALUES (1997, 104, 'CICCAS');
INSERT INTO `ref_desa` VALUES (1998, 95, 'JAKARTA TIMUR');
INSERT INTO `ref_desa` VALUES (1999, 95, 'JAKARTABARAT');
INSERT INTO `ref_desa` VALUES (2000, 95, 'JAKRATA');
INSERT INTO `ref_desa` VALUES (2001, 95, 'JAKRTA');
INSERT INTO `ref_desa` VALUES (2002, 95, 'JKARTA');
INSERT INTO `ref_desa` VALUES (2003, 95, 'JKRATA');
INSERT INTO `ref_desa` VALUES (2004, 95, 'PETAMBURAN');
INSERT INTO `ref_desa` VALUES (2005, 95, 'PULOGADUNG');
INSERT INTO `ref_desa` VALUES (2006, 95, 'TANJUNG PRIOK');
INSERT INTO `ref_desa` VALUES (2007, 107, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (2008, 107, 'PONDOK KELAPA');
INSERT INTO `ref_desa` VALUES (2009, 637, 'TANGGERANG');
INSERT INTO `ref_desa` VALUES (2010, 124, 'KALIDERES');
INSERT INTO `ref_desa` VALUES (2011, 117, 'SAWAH BESAR');
INSERT INTO `ref_desa` VALUES (2012, 94, 'REMPOA');
INSERT INTO `ref_desa` VALUES (2013, 97, 'KALIBATA');
INSERT INTO `ref_desa` VALUES (2014, 101, 'MANGGARAI');
INSERT INTO `ref_desa` VALUES (2015, 631, 'BEKASI');
INSERT INTO `ref_desa` VALUES (2016, 102, 'CAKUNG');
INSERT INTO `ref_desa` VALUES (2017, 102, 'PULO GERANG');
INSERT INTO `ref_desa` VALUES (2018, 104, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (2019, 104, 'SUSUKAN');
INSERT INTO `ref_desa` VALUES (2020, 107, 'JAKARTA TIMUR');
INSERT INTO `ref_desa` VALUES (2021, 107, 'JATI NEGARA');
INSERT INTO `ref_desa` VALUES (2022, 107, 'JL PEMUDA 103');
INSERT INTO `ref_desa` VALUES (2023, 107, 'KAYU MANIS');
INSERT INTO `ref_desa` VALUES (2024, 107, 'PONDOK KELAPA');
INSERT INTO `ref_desa` VALUES (2025, 113, 'PONDOK LABU');
INSERT INTO `ref_desa` VALUES (2026, 114, 'PULO GADUNG');
INSERT INTO `ref_desa` VALUES (2027, 126, 'KALIBARU');
INSERT INTO `ref_desa` VALUES (2028, 126, 'SUKAPURA');
INSERT INTO `ref_desa` VALUES (2029, 603, 'KRAJAN');
INSERT INTO `ref_desa` VALUES (2030, 603, 'SRAJAN');
INSERT INTO `ref_desa` VALUES (2031, 585, 'ANDIR');
INSERT INTO `ref_desa` VALUES (2032, 585, 'ANDUNG');
INSERT INTO `ref_desa` VALUES (2033, 585, 'BANDUNG');
INSERT INTO `ref_desa` VALUES (2034, 585, 'BATU JAJAR');
INSERT INTO `ref_desa` VALUES (2035, 585, 'CILANGGARI');
INSERT INTO `ref_desa` VALUES (2036, 585, 'CIPATONGKOR');
INSERT INTO `ref_desa` VALUES (2037, 585, 'CIPEDES');
INSERT INTO `ref_desa` VALUES (2038, 585, 'PADA LARANG');
INSERT INTO `ref_desa` VALUES (2039, 585, 'PADALARANG');
INSERT INTO `ref_desa` VALUES (2040, 586, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (2041, 586, 'SINDANG PANON');
INSERT INTO `ref_desa` VALUES (2042, 159, 'BATU NUNGGAL');
INSERT INTO `ref_desa` VALUES (2043, 159, 'KARANG TANGAH');
INSERT INTO `ref_desa` VALUES (2044, 159, 'SITU SAER');
INSERT INTO `ref_desa` VALUES (2045, 159, 'SRAKAEAWNGI');
INSERT INTO `ref_desa` VALUES (2046, 590, 'CICALENGKA KULON');
INSERT INTO `ref_desa` VALUES (2047, 591, 'CANTAYAN');
INSERT INTO `ref_desa` VALUES (2048, 591, 'HGARAMNAH');
INSERT INTO `ref_desa` VALUES (2049, 591, 'KADU PUGUR');
INSERT INTO `ref_desa` VALUES (2050, 592, 'NYANGKOEK');
INSERT INTO `ref_desa` VALUES (2051, 690, 'SELMANJAH');
INSERT INTO `ref_desa` VALUES (2052, 142, 'WATES JAYA');
INSERT INTO `ref_desa` VALUES (2053, 169, 'BAJU INDAH');
INSERT INTO `ref_desa` VALUES (2054, 169, 'SUKA  MULYA');
INSERT INTO `ref_desa` VALUES (2055, 595, 'PAMOYAYANAN');
INSERT INTO `ref_desa` VALUES (2056, 596, 'CILEUNYI');
INSERT INTO `ref_desa` VALUES (2057, 582, 'CIGUGUR TENGAH');
INSERT INTO `ref_desa` VALUES (2058, 582, 'CIMAHI');
INSERT INTO `ref_desa` VALUES (2059, 599, 'CITATAH');
INSERT INTO `ref_desa` VALUES (2060, 600, 'CIBOLANG KALER');
INSERT INTO `ref_desa` VALUES (2061, 600, 'CIROYOM');
INSERT INTO `ref_desa` VALUES (2062, 600, 'CISAAAT');
INSERT INTO `ref_desa` VALUES (2063, 603, 'BJ SOANG');
INSERT INTO `ref_desa` VALUES (2064, 604, 'ACISARUA');
INSERT INTO `ref_desa` VALUES (2065, 188, 'CIKANYERE');
INSERT INTO `ref_desa` VALUES (2066, 188, 'PANGKLAN CUIBOLANG');
INSERT INTO `ref_desa` VALUES (2067, 605, 'BANTARI');
INSERT INTO `ref_desa` VALUES (2068, 606, 'CAMPAKA MEKAR');
INSERT INTO `ref_desa` VALUES (2069, 606, 'PADALARANG');
INSERT INTO `ref_desa` VALUES (2070, 607, 'PANGALENGAN');
INSERT INTO `ref_desa` VALUES (2071, 84, 'CIBUNGUR');
INSERT INTO `ref_desa` VALUES (2072, 631, 'BEKASI');
INSERT INTO `ref_desa` VALUES (2073, 555, 'BJ KASO');
INSERT INTO `ref_desa` VALUES (2074, 555, 'BOJONGKASO');
INSERT INTO `ref_desa` VALUES (2075, 555, 'BUNISARI');
INSERT INTO `ref_desa` VALUES (2076, 555, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (2077, 555, 'WARNA SARI');
INSERT INTO `ref_desa` VALUES (2078, 559, 'CAMPAKA');
INSERT INTO `ref_desa` VALUES (2079, 559, 'SUKAJADI');
INSERT INTO `ref_desa` VALUES (2080, 560, 'SUKAJADI');
INSERT INTO `ref_desa` VALUES (2081, 561, 'CEMPAKA');
INSERT INTO `ref_desa` VALUES (2082, 561, 'CIAJUR');
INSERT INTO `ref_desa` VALUES (2083, 561, 'CIANJR');
INSERT INTO `ref_desa` VALUES (2084, 561, 'CIANJUR');
INSERT INTO `ref_desa` VALUES (2085, 561, 'CIANJUR SAYANG');
INSERT INTO `ref_desa` VALUES (2086, 561, 'CIBINONG');
INSERT INTO `ref_desa` VALUES (2087, 561, 'CIWALEN');
INSERT INTO `ref_desa` VALUES (2088, 561, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (2089, 561, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (2090, 561, 'PAMONYENAN');
INSERT INTO `ref_desa` VALUES (2091, 561, 'PARAKAN TUGU');
INSERT INTO `ref_desa` VALUES (2092, 561, 'PUNCAK');
INSERT INTO `ref_desa` VALUES (2093, 561, 'SAYANG');
INSERT INTO `ref_desa` VALUES (2094, 561, 'SELOK PANDAN');
INSERT INTO `ref_desa` VALUES (2095, 561, 'SOLOK PANDAN');
INSERT INTO `ref_desa` VALUES (2096, 561, 'SUKARAMAI');
INSERT INTO `ref_desa` VALUES (2097, 561, 'TAKOKAK');
INSERT INTO `ref_desa` VALUES (2098, 561, 'WARUNGKONDANG');
INSERT INTO `ref_desa` VALUES (2099, 160, 'CIBINONG');
INSERT INTO `ref_desa` VALUES (2100, 160, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (2101, 579, 'BOJONG LOANG');
INSERT INTO `ref_desa` VALUES (2102, 580, 'SIRNAGALIH');
INSERT INTO `ref_desa` VALUES (2103, 580, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (2104, 563, 'CILELES');
INSERT INTO `ref_desa` VALUES (2105, 563, 'SUKAJAYA');
INSERT INTO `ref_desa` VALUES (2106, 581, 'SINDANG JAYA');
INSERT INTO `ref_desa` VALUES (2107, 564, 'BENJOT');
INSERT INTO `ref_desa` VALUES (2108, 564, 'CIANJUR');
INSERT INTO `ref_desa` VALUES (2109, 564, 'CUGENANG');
INSERT INTO `ref_desa` VALUES (2110, 564, 'MANGUNKERTA');
INSERT INTO `ref_desa` VALUES (2111, 564, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (2112, 565, 'CIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (2113, 565, 'GEKBRONG');
INSERT INTO `ref_desa` VALUES (2114, 565, 'SONGGONG');
INSERT INTO `ref_desa` VALUES (2115, 566, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (2116, 567, 'PACET');
INSERT INTO `ref_desa` VALUES (2117, 568, 'CUGENANG');
INSERT INTO `ref_desa` VALUES (2118, 570, 'SIMPANG');
INSERT INTO `ref_desa` VALUES (2119, 571, 'CIANJUR');
INSERT INTO `ref_desa` VALUES (2120, 571, 'JAYA GIRI');
INSERT INTO `ref_desa` VALUES (2121, 571, 'JAYAGIRI');
INSERT INTO `ref_desa` VALUES (2122, 571, 'TALAGA SARI');
INSERT INTO `ref_desa` VALUES (2123, 572, 'BABAKAN SARI');
INSERT INTO `ref_desa` VALUES (2124, 572, 'HEGAR MANAH');
INSERT INTO `ref_desa` VALUES (2125, 572, 'SUKALUYU');
INSERT INTO `ref_desa` VALUES (2126, 572, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (2127, 573, 'PAKLUWON');
INSERT INTO `ref_desa` VALUES (2128, 574, 'BUNGBANG SARI');
INSERT INTO `ref_desa` VALUES (2129, 574, 'BUNGBANGSARI');
INSERT INTO `ref_desa` VALUES (2130, 574, 'SINDANG RESMI');
INSERT INTO `ref_desa` VALUES (2131, 574, 'SUKAREMI');
INSERT INTO `ref_desa` VALUES (2132, 574, 'TAKOKAK');
INSERT INTO `ref_desa` VALUES (2133, 575, 'CIANJUR');
INSERT INTO `ref_desa` VALUES (2134, 575, 'CIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (2135, 575, 'CIWALAEN');
INSERT INTO `ref_desa` VALUES (2136, 575, 'JAMBU DIPA');
INSERT INTO `ref_desa` VALUES (2137, 575, 'TEGAL LEGA');
INSERT INTO `ref_desa` VALUES (2138, 575, 'WAUNG KOANG');
INSERT INTO `ref_desa` VALUES (2139, 84, 'CIKOTOK');
INSERT INTO `ref_desa` VALUES (2140, 625, 'KARANG');
INSERT INTO `ref_desa` VALUES (2141, 625, 'KARAWANG');
INSERT INTO `ref_desa` VALUES (2142, 627, 'RENGAS DENGKLOK');
INSERT INTO `ref_desa` VALUES (2143, 585, 'BANDUNG');
INSERT INTO `ref_desa` VALUES (2144, 596, 'CILEUNYI WETAN');
INSERT INTO `ref_desa` VALUES (2145, 613, 'KOPO');
INSERT INTO `ref_desa` VALUES (2146, 573, 'SARI JADI');
INSERT INTO `ref_desa` VALUES (2147, 573, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (2148, 637, 'TANGERANG');
INSERT INTO `ref_desa` VALUES (2149, 637, 'TANGGERANG');
INSERT INTO `ref_desa` VALUES (2150, 84, 'CIBALENOK');
INSERT INTO `ref_desa` VALUES (2151, 84, 'CIKAMUNDING');
INSERT INTO `ref_desa` VALUES (2152, 84, 'CILOGERANG');
INSERT INTO `ref_desa` VALUES (2153, 84, 'CILOGRAN');
INSERT INTO `ref_desa` VALUES (2154, 84, 'CIROGRANG');
INSERT INTO `ref_desa` VALUES (2155, 84, 'GUNUNGBATU');
INSERT INTO `ref_desa` VALUES (2156, 84, 'PASIR GOMBONG');
INSERT INTO `ref_desa` VALUES (2157, 89, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (2158, 89, 'CISUNGSANG');
INSERT INTO `ref_desa` VALUES (2159, 89, 'LEBAK');
INSERT INTO `ref_desa` VALUES (2160, 622, 'NAGGEWER');
INSERT INTO `ref_desa` VALUES (2161, 641, 'BANYURIP');
INSERT INTO `ref_desa` VALUES (2162, 624, 'CISEUREUH');
INSERT INTO `ref_desa` VALUES (2163, 624, 'PURWAKARTA');
INSERT INTO `ref_desa` VALUES (2164, 639, 'RTRIREJO');
INSERT INTO `ref_desa` VALUES (2165, 84, 'PASIRBUNGUR');
INSERT INTO `ref_desa` VALUES (2166, 141, 'CIKLEMBANG');
INSERT INTO `ref_desa` VALUES (2167, 623, 'SUKAMANDIJAYA');
INSERT INTO `ref_desa` VALUES (2168, 668, 'BANTARGADUNGF');
INSERT INTO `ref_desa` VALUES (2169, 668, 'MANGUN JAYA');
INSERT INTO `ref_desa` VALUES (2170, 84, 'BAYAH TIMUR');
INSERT INTO `ref_desa` VALUES (2171, 84, 'CISUREN');
INSERT INTO `ref_desa` VALUES (2172, 84, 'MANCAK');
INSERT INTO `ref_desa` VALUES (2173, 631, 'BEKASI');
INSERT INTO `ref_desa` VALUES (2174, 631, 'CIKARANG BARAT');
INSERT INTO `ref_desa` VALUES (2175, 151, 'TEGAL GUNDUL');
INSERT INTO `ref_desa` VALUES (2176, 83, 'BOJONGGENTENG');
INSERT INTO `ref_desa` VALUES (2177, 140, 'PABUARAN');
INSERT INTO `ref_desa` VALUES (2178, 140, 'RAWAPANJANG');
INSERT INTO `ref_desa` VALUES (2179, 661, 'BOJONGGENTENG');
INSERT INTO `ref_desa` VALUES (2180, 661, 'KUBANG');
INSERT INTO `ref_desa` VALUES (2181, 102, 'BENADA');
INSERT INTO `ref_desa` VALUES (2182, 102, 'CISAAT');
INSERT INTO `ref_desa` VALUES (2183, 102, 'TAENJOLAYA');
INSERT INTO `ref_desa` VALUES (2184, 102, 'TENJOJAYU');
INSERT INTO `ref_desa` VALUES (2185, 102, 'TENJOJY');
INSERT INTO `ref_desa` VALUES (2186, 141, 'ACISEAPAN');
INSERT INTO `ref_desa` VALUES (2187, 141, 'BOJONG');
INSERT INTO `ref_desa` VALUES (2188, 141, 'BUBULANG');
INSERT INTO `ref_desa` VALUES (2189, 141, 'CA3RINGIN');
INSERT INTO `ref_desa` VALUES (2190, 141, 'CAARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (2191, 141, 'CAREINGI');
INSERT INTO `ref_desa` VALUES (2192, 141, 'CAREINGIN');
INSERT INTO `ref_desa` VALUES (2193, 141, 'CARIMNGIM');
INSERT INTO `ref_desa` VALUES (2194, 141, 'CARINGAN');
INSERT INTO `ref_desa` VALUES (2195, 141, 'CARINGIMN');
INSERT INTO `ref_desa` VALUES (2196, 141, 'CARINGIN CIKUKULU');
INSERT INTO `ref_desa` VALUES (2197, 141, 'CARINGIN HILIR');
INSERT INTO `ref_desa` VALUES (2198, 141, 'CARINGIN WETN');
INSERT INTO `ref_desa` VALUES (2199, 141, 'CARINGINCARING');
INSERT INTO `ref_desa` VALUES (2200, 141, 'CARINGINKULOM');
INSERT INTO `ref_desa` VALUES (2201, 141, 'CARINGINKULON');
INSERT INTO `ref_desa` VALUES (2202, 141, 'CARNGIN WETAN');
INSERT INTO `ref_desa` VALUES (2203, 141, 'CCARINGIN');
INSERT INTO `ref_desa` VALUES (2204, 141, 'CIANTAYAN');
INSERT INTO `ref_desa` VALUES (2205, 141, 'CIBALUNA');
INSERT INTO `ref_desa` VALUES (2206, 141, 'CICANDE');
INSERT INTO `ref_desa` VALUES (2207, 141, 'CICANTAYAN');
INSERT INTO `ref_desa` VALUES (2208, 141, 'CIDEUREUM');
INSERT INTO `ref_desa` VALUES (2209, 141, 'CIGERUM');
INSERT INTO `ref_desa` VALUES (2210, 141, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (2211, 141, 'CIHERANGPONDOK');
INSERT INTO `ref_desa` VALUES (2212, 141, 'CIHEURANG PONDOK');
INSERT INTO `ref_desa` VALUES (2213, 141, 'CIJEMGKOL');
INSERT INTO `ref_desa` VALUES (2214, 141, 'CIJENGOL');
INSERT INTO `ref_desa` VALUES (2215, 141, 'CIJERAH');
INSERT INTO `ref_desa` VALUES (2216, 141, 'CIJIENGKOL');
INSERT INTO `ref_desa` VALUES (2217, 141, 'CIKERETEG');
INSERT INTO `ref_desa` VALUES (2218, 141, 'CIKJENGKOL');
INSERT INTO `ref_desa` VALUES (2219, 141, 'CIKUKULI');
INSERT INTO `ref_desa` VALUES (2220, 141, 'CIPUNMTANG');
INSERT INTO `ref_desa` VALUES (2221, 141, 'CIPUNTUNG');
INSERT INTO `ref_desa` VALUES (2222, 141, 'CIRINGIN');
INSERT INTO `ref_desa` VALUES (2223, 141, 'CISALOPA');
INSERT INTO `ref_desa` VALUES (2224, 141, 'CISEAPAN');
INSERT INTO `ref_desa` VALUES (2225, 141, 'CISSEUPAN');
INSERT INTO `ref_desa` VALUES (2226, 141, 'COBLONG');
INSERT INTO `ref_desa` VALUES (2227, 141, 'CRIGIN');
INSERT INTO `ref_desa` VALUES (2228, 141, 'CUJENGKOL');
INSERT INTO `ref_desa` VALUES (2229, 141, 'DARMAGA');
INSERT INTO `ref_desa` VALUES (2230, 141, 'DSLEMBAH LUHUR');
INSERT INTO `ref_desa` VALUES (2231, 141, 'IKEMBANG');
INSERT INTO `ref_desa` VALUES (2232, 141, 'JAYANEGARA');
INSERT INTO `ref_desa` VALUES (2233, 141, 'KUTAJAYA');
INSERT INTO `ref_desa` VALUES (2234, 141, 'MADUHUR');
INSERT INTO `ref_desa` VALUES (2235, 141, 'MAKAR JAYA');
INSERT INTO `ref_desa` VALUES (2236, 141, 'MEKARJYA');
INSERT INTO `ref_desa` VALUES (2237, 141, 'MEKRAJAYA');
INSERT INTO `ref_desa` VALUES (2238, 141, 'NANGKOD');
INSERT INTO `ref_desa` VALUES (2239, 141, 'NENGGENG');
INSERT INTO `ref_desa` VALUES (2240, 141, 'PABUARAN');
INSERT INTO `ref_desa` VALUES (2241, 141, 'PADANGEYANG');
INSERT INTO `ref_desa` VALUES (2242, 141, 'PALEDANG');
INSERT INTO `ref_desa` VALUES (2243, 141, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (2244, 141, 'PANGKLAN CUIBOLANG');
INSERT INTO `ref_desa` VALUES (2245, 141, 'PARENG');
INSERT INTO `ref_desa` VALUES (2246, 141, 'PASIR BINCIR');
INSERT INTO `ref_desa` VALUES (2247, 141, 'PASIR DALAM');
INSERT INTO `ref_desa` VALUES (2248, 141, 'PASIR MUNCNAG');
INSERT INTO `ref_desa` VALUES (2249, 141, 'PASIRBUNCIR');
INSERT INTO `ref_desa` VALUES (2250, 141, 'PASIRMUJCANG');
INSERT INTO `ref_desa` VALUES (2251, 141, 'PASIRUNCANG');
INSERT INTO `ref_desa` VALUES (2252, 141, 'PERK');
INSERT INTO `ref_desa` VALUES (2253, 141, 'PURWASARI');
INSERT INTO `ref_desa` VALUES (2254, 141, 'SALAAWI');
INSERT INTO `ref_desa` VALUES (2255, 141, 'SELA AWI');
INSERT INTO `ref_desa` VALUES (2256, 141, 'SELAGOMBONG');
INSERT INTO `ref_desa` VALUES (2257, 141, 'SEUSEUOAN');
INSERT INTO `ref_desa` VALUES (2258, 141, 'SEUSEUPAN GIRANG');
INSERT INTO `ref_desa` VALUES (2259, 141, 'SIKAMULYA');
INSERT INTO `ref_desa` VALUES (2260, 141, 'SINDANGLENGO');
INSERT INTO `ref_desa` VALUES (2261, 141, 'SKAMULYA');
INSERT INTO `ref_desa` VALUES (2262, 141, 'SUKA MURYA');
INSERT INTO `ref_desa` VALUES (2263, 141, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (2264, 141, 'SUKMULYA');
INSERT INTO `ref_desa` VALUES (2265, 141, 'SUNGAPAN');
INSERT INTO `ref_desa` VALUES (2266, 141, 'SUSUKAN');
INSERT INTO `ref_desa` VALUES (2267, 141, 'TANGKIL');
INSERT INTO `ref_desa` VALUES (2268, 141, 'TARI KOLOT');
INSERT INTO `ref_desa` VALUES (2269, 141, 'TEGAL LEGA');
INSERT INTO `ref_desa` VALUES (2270, 141, 'TENGGEK');
INSERT INTO `ref_desa` VALUES (2271, 141, 'TUGU');
INSERT INTO `ref_desa` VALUES (2272, 141, 'TUGUJAYA');
INSERT INTO `ref_desa` VALUES (2273, 141, ']CIJENGKOL');
INSERT INTO `ref_desa` VALUES (2274, 560, 'CEMPAKA');
INSERT INTO `ref_desa` VALUES (2275, 657, 'ACIAMABAR');
INSERT INTO `ref_desa` VALUES (2276, 657, 'BABAKAN MUNJUL');
INSERT INTO `ref_desa` VALUES (2277, 657, 'CIABAR');
INSERT INTO `ref_desa` VALUES (2278, 657, 'CIAMABAR');
INSERT INTO `ref_desa` VALUES (2279, 657, 'CIAMAHI');
INSERT INTO `ref_desa` VALUES (2280, 657, 'CIAMAR');
INSERT INTO `ref_desa` VALUES (2281, 657, 'CIAMBAAAR');
INSERT INTO `ref_desa` VALUES (2282, 657, 'CIAMBAAR');
INSERT INTO `ref_desa` VALUES (2283, 657, 'CIAMBAE');
INSERT INTO `ref_desa` VALUES (2284, 657, 'CIAMBAR .');
INSERT INTO `ref_desa` VALUES (2285, 657, 'CIAMBAR KOLOT');
INSERT INTO `ref_desa` VALUES (2286, 657, 'CIAMBAR N');
INSERT INTO `ref_desa` VALUES (2287, 657, 'CIAMBAR NAGRAK');
INSERT INTO `ref_desa` VALUES (2288, 657, 'CIAMBAR PR KUDA');
INSERT INTO `ref_desa` VALUES (2289, 657, 'CIAMBAR?NAGRAK');
INSERT INTO `ref_desa` VALUES (2290, 657, 'CIAMBRA');
INSERT INTO `ref_desa` VALUES (2291, 657, 'CIAMCAR');
INSERT INTO `ref_desa` VALUES (2292, 657, 'CIAMDAR');
INSERT INTO `ref_desa` VALUES (2293, 657, 'CIANBAR');
INSERT INTO `ref_desa` VALUES (2294, 657, 'CIANDE');
INSERT INTO `ref_desa` VALUES (2295, 657, 'CIANYAWAR');
INSERT INTO `ref_desa` VALUES (2296, 657, 'CIARPIN');
INSERT INTO `ref_desa` VALUES (2297, 657, 'CIARUA');
INSERT INTO `ref_desa` VALUES (2298, 657, 'CIASARUA');
INSERT INTO `ref_desa` VALUES (2299, 657, 'CIASRUA');
INSERT INTO `ref_desa` VALUES (2300, 657, 'CIATER');
INSERT INTO `ref_desa` VALUES (2301, 657, 'CIAWAI TALI');
INSERT INTO `ref_desa` VALUES (2302, 657, 'CIAWAITALI');
INSERT INTO `ref_desa` VALUES (2303, 657, 'CIAWI TALI');
INSERT INTO `ref_desa` VALUES (2304, 657, 'CIAWITAL');
INSERT INTO `ref_desa` VALUES (2305, 657, 'CIAWITALI');
INSERT INTO `ref_desa` VALUES (2306, 657, 'CIAYERE');
INSERT INTO `ref_desa` VALUES (2307, 657, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (2308, 657, 'CIBADAK .');
INSERT INTO `ref_desa` VALUES (2309, 657, 'CIBATU');
INSERT INTO `ref_desa` VALUES (2310, 657, 'CIGANAS');
INSERT INTO `ref_desa` VALUES (2311, 657, 'CIJAMBU');
INSERT INTO `ref_desa` VALUES (2312, 657, 'CIKEMBNG');
INSERT INTO `ref_desa` VALUES (2313, 657, 'CIMABAR');
INSERT INTO `ref_desa` VALUES (2314, 657, 'CIMBAR');
INSERT INTO `ref_desa` VALUES (2315, 657, 'CINANJAR');
INSERT INTO `ref_desa` VALUES (2316, 657, 'GIANANJAR');
INSERT INTO `ref_desa` VALUES (2317, 657, 'GINAAJAR');
INSERT INTO `ref_desa` VALUES (2318, 657, 'GINAJAR');
INSERT INTO `ref_desa` VALUES (2319, 657, 'GINJAR');
INSERT INTO `ref_desa` VALUES (2320, 657, 'LEUWI NAGGUNG');
INSERT INTO `ref_desa` VALUES (2321, 657, 'LUWI KERIS');
INSERT INTO `ref_desa` VALUES (2322, 657, 'MANGUNJAYA');
INSERT INTO `ref_desa` VALUES (2323, 657, 'MIUNJUL');
INSERT INTO `ref_desa` VALUES (2324, 657, 'MNGUJAYA');
INSERT INTO `ref_desa` VALUES (2325, 657, 'MNGUNJYA');
INSERT INTO `ref_desa` VALUES (2326, 657, 'MUNJL');
INSERT INTO `ref_desa` VALUES (2327, 657, 'NYLINDUNG');
INSERT INTO `ref_desa` VALUES (2328, 657, 'WAGUN JAYA');
INSERT INTO `ref_desa` VALUES (2329, 657, 'WANGUI JAYA');
INSERT INTO `ref_desa` VALUES (2330, 657, 'WANGUN JAYA');
INSERT INTO `ref_desa` VALUES (2331, 657, 'WANGUNJYA');
INSERT INTO `ref_desa` VALUES (2332, 657, 'WARUNGOMBONG');
INSERT INTO `ref_desa` VALUES (2333, 561, 'CIANJUR');
INSERT INTO `ref_desa` VALUES (2334, 561, 'PAMOYANAN');
INSERT INTO `ref_desa` VALUES (2335, 159, ',BATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2336, 159, ',NEGLASARI');
INSERT INTO `ref_desa` VALUES (2337, 159, '02');
INSERT INTO `ref_desa` VALUES (2338, 159, '15');
INSERT INTO `ref_desa` VALUES (2339, 159, 'AARMED');
INSERT INTO `ref_desa` VALUES (2340, 159, 'ACIBADAK');
INSERT INTO `ref_desa` VALUES (2341, 159, 'ACIHEALANGTONGGOH');
INSERT INTO `ref_desa` VALUES (2342, 159, 'ACIHELANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2343, 159, 'AINGIN');
INSERT INTO `ref_desa` VALUES (2344, 159, 'AKARQANGTEANGH');
INSERT INTO `ref_desa` VALUES (2345, 159, 'AL MASTURIYAH');
INSERT INTO `ref_desa` VALUES (2346, 159, 'AL UMAH');
INSERT INTO `ref_desa` VALUES (2347, 159, 'ALBAYAN');
INSERT INTO `ref_desa` VALUES (2348, 159, 'AMURUYAN');
INSERT INTO `ref_desa` VALUES (2349, 159, 'AMURYAB');
INSERT INTO `ref_desa` VALUES (2350, 159, 'ANAR KARET');
INSERT INTO `ref_desa` VALUES (2351, 159, 'ANGGA YUDA');
INSERT INTO `ref_desa` VALUES (2352, 159, 'ANGGAYUDA');
INSERT INTO `ref_desa` VALUES (2353, 159, 'ANGGGAYUDA');
INSERT INTO `ref_desa` VALUES (2354, 159, 'ANGUN JAYA');
INSERT INTO `ref_desa` VALUES (2355, 159, 'ANTARMUCANG');
INSERT INTO `ref_desa` VALUES (2356, 159, 'ARAGTENAGAH');
INSERT INTO `ref_desa` VALUES (2357, 159, 'ARANGTENGAH');
INSERT INTO `ref_desa` VALUES (2358, 159, 'ASGORA');
INSERT INTO `ref_desa` VALUES (2359, 159, 'ATNJOJYA');
INSERT INTO `ref_desa` VALUES (2360, 159, 'ATUUGGAL');
INSERT INTO `ref_desa` VALUES (2361, 159, 'AYAM MANGGIS');
INSERT INTO `ref_desa` VALUES (2362, 159, 'AYAM MANGIS');
INSERT INTO `ref_desa` VALUES (2363, 159, 'B ATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2364, 159, 'B OJONGGENTENG');
INSERT INTO `ref_desa` VALUES (2365, 159, 'BAAAAATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2366, 159, 'BAAATUNUNGGA');
INSERT INTO `ref_desa` VALUES (2367, 159, 'BAAATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2368, 159, 'BAATUNUNGGL');
INSERT INTO `ref_desa` VALUES (2369, 159, 'BABAAN');
INSERT INTO `ref_desa` VALUES (2370, 159, 'BABAKAB BANTEN');
INSERT INTO `ref_desa` VALUES (2371, 159, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (2372, 159, 'BABAKAN  PANJANG');
INSERT INTO `ref_desa` VALUES (2373, 159, 'BABAKAN AGENG');
INSERT INTO `ref_desa` VALUES (2374, 159, 'BABAKAN ANYAR');
INSERT INTO `ref_desa` VALUES (2375, 159, 'BABAKAN BANTEN');
INSERT INTO `ref_desa` VALUES (2376, 159, 'BABAKAN BARU');
INSERT INTO `ref_desa` VALUES (2377, 159, 'BABAKAN BOGOR');
INSERT INTO `ref_desa` VALUES (2378, 159, 'BABAKAN JAYA');
INSERT INTO `ref_desa` VALUES (2379, 159, 'BABAKAN KARATE');
INSERT INTO `ref_desa` VALUES (2380, 159, 'BABAKAN NAGRAK');
INSERT INTO `ref_desa` VALUES (2381, 159, 'BABAKAN PAMURUYAN');
INSERT INTO `ref_desa` VALUES (2382, 159, 'BABAKAN PANAJANG');
INSERT INTO `ref_desa` VALUES (2383, 159, 'BABAKAN PANJAGANG');
INSERT INTO `ref_desa` VALUES (2384, 159, 'BABAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (2385, 159, 'BABAKAN PARI');
INSERT INTO `ref_desa` VALUES (2386, 159, 'BABAKAN PASAR');
INSERT INTO `ref_desa` VALUES (2387, 159, 'BABAKAN PENDEUY');
INSERT INTO `ref_desa` VALUES (2388, 159, 'BABAKAN POJOK');
INSERT INTO `ref_desa` VALUES (2389, 159, 'BABAKAN SARAI');
INSERT INTO `ref_desa` VALUES (2390, 159, 'BABAKAN SARI');
INSERT INTO `ref_desa` VALUES (2391, 159, 'BABAKAN SAWAH');
INSERT INTO `ref_desa` VALUES (2392, 159, 'BABAKAN SIEANA');
INSERT INTO `ref_desa` VALUES (2393, 159, 'BABAKAN SIRANA');
INSERT INTO `ref_desa` VALUES (2394, 159, 'BABAKAN SIRNA');
INSERT INTO `ref_desa` VALUES (2395, 159, 'BABAKAN TALANG');
INSERT INTO `ref_desa` VALUES (2396, 159, 'BABAKANSIRNA');
INSERT INTO `ref_desa` VALUES (2397, 159, 'BABAKLAN');
INSERT INTO `ref_desa` VALUES (2398, 159, 'BABAKN ANYAR');
INSERT INTO `ref_desa` VALUES (2399, 159, 'BABAKN PANJANG');
INSERT INTO `ref_desa` VALUES (2400, 159, 'BABAN SIRNA');
INSERT INTO `ref_desa` VALUES (2401, 159, 'BABKAN JAYA');
INSERT INTO `ref_desa` VALUES (2402, 159, 'BABKAN SIRNA');
INSERT INTO `ref_desa` VALUES (2403, 159, 'BADAK');
INSERT INTO `ref_desa` VALUES (2404, 159, 'BAKAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (2405, 159, 'BAKAN');
INSERT INTO `ref_desa` VALUES (2406, 159, 'BAKAN BANTEN');
INSERT INTO `ref_desa` VALUES (2407, 159, 'BAKAN SARI');
INSERT INTO `ref_desa` VALUES (2408, 159, 'BALE KAMBANG');
INSERT INTO `ref_desa` VALUES (2409, 159, 'BANAGKUANG');
INSERT INTO `ref_desa` VALUES (2410, 159, 'BANGKOWONG]');
INSERT INTO `ref_desa` VALUES (2411, 159, 'BANGKUANG');
INSERT INTO `ref_desa` VALUES (2412, 159, 'BANJAR SARI');
INSERT INTO `ref_desa` VALUES (2413, 159, 'BANTAMUNCANG');
INSERT INTO `ref_desa` VALUES (2414, 159, 'BANTAR BADAK');
INSERT INTO `ref_desa` VALUES (2415, 159, 'BANTAR GADUNG');
INSERT INTO `ref_desa` VALUES (2416, 159, 'BANTAR IAREAT');
INSERT INTO `ref_desa` VALUES (2417, 159, 'BANTAR KARET');
INSERT INTO `ref_desa` VALUES (2418, 159, 'BANTAR M7NANG');
INSERT INTO `ref_desa` VALUES (2419, 159, 'BANTAR MANCUNG');
INSERT INTO `ref_desa` VALUES (2420, 159, 'BANTAR MNCANG');
INSERT INTO `ref_desa` VALUES (2421, 159, 'BANTAR MUCANG');
INSERT INTO `ref_desa` VALUES (2422, 159, 'BANTAR MUNCANF');
INSERT INTO `ref_desa` VALUES (2423, 159, 'BANTAR MUNCANG');
INSERT INTO `ref_desa` VALUES (2424, 159, 'BANTAR MUNCCNGG');
INSERT INTO `ref_desa` VALUES (2425, 159, 'BANTAR MUNCZANG');
INSERT INTO `ref_desa` VALUES (2426, 159, 'BANTARAMUCANG');
INSERT INTO `ref_desa` VALUES (2427, 159, 'BANTARAMUNCANG');
INSERT INTO `ref_desa` VALUES (2428, 159, 'BANTARKARET');
INSERT INTO `ref_desa` VALUES (2429, 159, 'BANTARMIUNCANG');
INSERT INTO `ref_desa` VALUES (2430, 159, 'BANTARMUNCANG');
INSERT INTO `ref_desa` VALUES (2431, 159, 'BANTARMUNCNAG');
INSERT INTO `ref_desa` VALUES (2432, 159, 'BANTR MUUNCNG');
INSERT INTO `ref_desa` VALUES (2433, 159, 'BANTU NUNGGUL');
INSERT INTO `ref_desa` VALUES (2434, 159, 'BANTUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2435, 159, 'BARANGTENGAH');
INSERT INTO `ref_desa` VALUES (2436, 159, 'BARAUJANGUNG');
INSERT INTO `ref_desa` VALUES (2437, 159, 'BAREKAH');
INSERT INTO `ref_desa` VALUES (2438, 159, 'BARTU NUNGGAL');
INSERT INTO `ref_desa` VALUES (2439, 159, 'BARTUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2440, 159, 'BARU SAWAH');
INSERT INTO `ref_desa` VALUES (2441, 159, 'BARUSAWAH');
INSERT INTO `ref_desa` VALUES (2442, 159, 'BATAUMUNGGL');
INSERT INTO `ref_desa` VALUES (2443, 159, 'BATAUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2444, 159, 'BATU ASIH');
INSERT INTO `ref_desa` VALUES (2445, 159, 'BATU ASSIH');
INSERT INTO `ref_desa` VALUES (2446, 159, 'BATU LAYANG');
INSERT INTO `ref_desa` VALUES (2447, 159, 'BATU N UNGGAL');
INSERT INTO `ref_desa` VALUES (2448, 159, 'BATU N8NNGGAL');
INSERT INTO `ref_desa` VALUES (2449, 159, 'BATU NAUNGGAL');
INSERT INTO `ref_desa` VALUES (2450, 159, 'BATU NUGGAL');
INSERT INTO `ref_desa` VALUES (2451, 159, 'BATU NUNGAL');
INSERT INTO `ref_desa` VALUES (2452, 159, 'BATU NUNGG');
INSERT INTO `ref_desa` VALUES (2453, 159, 'BATU NUNGGAL');
INSERT INTO `ref_desa` VALUES (2454, 159, 'BATU NUNGGALCIBADAK');
INSERT INTO `ref_desa` VALUES (2455, 159, 'BATU NUNGGGAL');
INSERT INTO `ref_desa` VALUES (2456, 159, 'BATU NUNGGL');
INSERT INTO `ref_desa` VALUES (2457, 159, 'BATU NUNGGUL');
INSERT INTO `ref_desa` VALUES (2458, 159, 'BATU NUNNGAL');
INSERT INTO `ref_desa` VALUES (2459, 159, 'BATU UGGAL');
INSERT INTO `ref_desa` VALUES (2460, 159, 'BATU UNGGAL');
INSERT INTO `ref_desa` VALUES (2461, 159, 'BATUBNUNGGAL');
INSERT INTO `ref_desa` VALUES (2462, 159, 'BATUGUNGGAL');
INSERT INTO `ref_desa` VALUES (2463, 159, 'BATUI NUNGGAL');
INSERT INTO `ref_desa` VALUES (2464, 159, 'BATUMUNNGAL');
INSERT INTO `ref_desa` VALUES (2465, 159, 'BATUNGAL');
INSERT INTO `ref_desa` VALUES (2466, 159, 'BATUNGGAL');
INSERT INTO `ref_desa` VALUES (2467, 159, 'BATUNINGGAL');
INSERT INTO `ref_desa` VALUES (2468, 159, 'BATUNIUNGGAL');
INSERT INTO `ref_desa` VALUES (2469, 159, 'BATUNUGGAL');
INSERT INTO `ref_desa` VALUES (2470, 159, 'BATUNUNGAGGAL');
INSERT INTO `ref_desa` VALUES (2471, 159, 'BATUNUNGAL');
INSERT INTO `ref_desa` VALUES (2472, 159, 'BATUNUNGGAK');
INSERT INTO `ref_desa` VALUES (2473, 159, 'BATUNUNGGAL;');
INSERT INTO `ref_desa` VALUES (2474, 159, 'BATUNUNGGALK');
INSERT INTO `ref_desa` VALUES (2475, 159, 'BATUNUNGGALL');
INSERT INTO `ref_desa` VALUES (2476, 159, 'BATUNUNGGGAL');
INSERT INTO `ref_desa` VALUES (2477, 159, 'BATUNUNGGUL');
INSERT INTO `ref_desa` VALUES (2478, 159, 'BBAKAN ANYAR');
INSERT INTO `ref_desa` VALUES (2479, 159, 'BBAKAN BANTEN');
INSERT INTO `ref_desa` VALUES (2480, 159, 'BBAKAN SIRNA');
INSERT INTO `ref_desa` VALUES (2481, 159, 'BBAKANPANJANG');
INSERT INTO `ref_desa` VALUES (2482, 159, 'BBKN SIRNA');
INSERT INTO `ref_desa` VALUES (2483, 159, 'BCIBADAK');
INSERT INTO `ref_desa` VALUES (2484, 159, 'BENDA');
INSERT INTO `ref_desa` VALUES (2485, 159, 'BERKAH');
INSERT INTO `ref_desa` VALUES (2486, 159, 'BICIBAAADAK');
INSERT INTO `ref_desa` VALUES (2487, 159, 'BIJOONG JAGA');
INSERT INTO `ref_desa` VALUES (2488, 159, 'BINADAK');
INSERT INTO `ref_desa` VALUES (2489, 159, 'BIOJONGDUREN');
INSERT INTO `ref_desa` VALUES (2490, 159, 'BITUNG');
INSERT INTO `ref_desa` VALUES (2491, 159, 'BJ JAGAL');
INSERT INTO `ref_desa` VALUES (2492, 159, 'BJ KONENG');
INSERT INTO `ref_desa` VALUES (2493, 159, 'BJ KURING');
INSERT INTO `ref_desa` VALUES (2494, 159, 'BJ TALANG');
INSERT INTO `ref_desa` VALUES (2495, 159, 'BJ. SETRA');
INSERT INTO `ref_desa` VALUES (2496, 159, 'BJG MESJID');
INSERT INTO `ref_desa` VALUES (2497, 159, 'BJGJAGAL');
INSERT INTO `ref_desa` VALUES (2498, 159, 'BKARANGTATEANGH');
INSERT INTO `ref_desa` VALUES (2499, 159, 'BNAGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (2500, 159, 'BNATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2501, 159, 'BNTARAMUNACANG');
INSERT INTO `ref_desa` VALUES (2502, 159, 'BOJHONG TALANG');
INSERT INTO `ref_desa` VALUES (2503, 159, 'BOJNGLAUNG');
INSERT INTO `ref_desa` VALUES (2504, 159, 'BOJONG');
INSERT INTO `ref_desa` VALUES (2505, 159, 'BOJONG ASIH');
INSERT INTO `ref_desa` VALUES (2506, 159, 'BOJONG DUREN');
INSERT INTO `ref_desa` VALUES (2507, 159, 'BOJONG GALING');
INSERT INTO `ref_desa` VALUES (2508, 159, 'BOJONG GALING A');
INSERT INTO `ref_desa` VALUES (2509, 159, 'BOJONG GENTENG');
INSERT INTO `ref_desa` VALUES (2510, 159, 'BOJONG JAGAL');
INSERT INTO `ref_desa` VALUES (2511, 159, 'BOJONG JENGKOL');
INSERT INTO `ref_desa` VALUES (2512, 159, 'BOJONG KALAPA');
INSERT INTO `ref_desa` VALUES (2513, 159, 'BOJONG KAUNG');
INSERT INTO `ref_desa` VALUES (2514, 159, 'BOJONG KELAPA');
INSERT INTO `ref_desa` VALUES (2515, 159, 'BOJONG KERING');
INSERT INTO `ref_desa` VALUES (2516, 159, 'BOJONG KOKOSAN');
INSERT INTO `ref_desa` VALUES (2517, 159, 'BOJONG KOMENG');
INSERT INTO `ref_desa` VALUES (2518, 159, 'BOJONG KONENG');
INSERT INTO `ref_desa` VALUES (2519, 159, 'BOJONG KURING');
INSERT INTO `ref_desa` VALUES (2520, 159, 'BOJONG LONGOK');
INSERT INTO `ref_desa` VALUES (2521, 159, 'BOJONG MESJED');
INSERT INTO `ref_desa` VALUES (2522, 159, 'BOJONG MESJID');
INSERT INTO `ref_desa` VALUES (2523, 159, 'BOJONG SETRA');
INSERT INTO `ref_desa` VALUES (2524, 159, 'BOJONG TALAG');
INSERT INTO `ref_desa` VALUES (2525, 159, 'BOJONG TALANG');
INSERT INTO `ref_desa` VALUES (2526, 159, 'BOJONGF JAGAL');
INSERT INTO `ref_desa` VALUES (2527, 159, 'BOJONGGENTENG');
INSERT INTO `ref_desa` VALUES (2528, 159, 'BOJONGKALAPA');
INSERT INTO `ref_desa` VALUES (2529, 159, 'BOJONGKAUNG');
INSERT INTO `ref_desa` VALUES (2530, 159, 'BOJONGKONENG');
INSERT INTO `ref_desa` VALUES (2531, 159, 'BOJONGKURING');
INSERT INTO `ref_desa` VALUES (2532, 159, 'BOJONGMESJID');
INSERT INTO `ref_desa` VALUES (2533, 159, 'BOJONGTALANG');
INSERT INTO `ref_desa` VALUES (2534, 159, 'BRI');
INSERT INTO `ref_desa` VALUES (2535, 159, 'BSEAKARWANGI');
INSERT INTO `ref_desa` VALUES (2536, 159, 'BT  NUNGGAL');
INSERT INTO `ref_desa` VALUES (2537, 159, 'BT MUNCANG');
INSERT INTO `ref_desa` VALUES (2538, 159, 'BT NUGGAL');
INSERT INTO `ref_desa` VALUES (2539, 159, 'BT NUNGGAL');
INSERT INTO `ref_desa` VALUES (2540, 159, 'BT NUNGGUL');
INSERT INTO `ref_desa` VALUES (2541, 159, 'BT. MUCANG');
INSERT INTO `ref_desa` VALUES (2542, 159, 'BT. NUNGGAL');
INSERT INTO `ref_desa` VALUES (2543, 159, 'BT.NUNGGAL');
INSERT INTO `ref_desa` VALUES (2544, 159, 'BTN SEKARWANGI');
INSERT INTO `ref_desa` VALUES (2545, 159, 'BTN SURYA INDAH');
INSERT INTO `ref_desa` VALUES (2546, 159, 'BTN TAMAN LESTARI');
INSERT INTO `ref_desa` VALUES (2547, 159, 'BTR. MUNCANG');
INSERT INTO `ref_desa` VALUES (2548, 159, 'BTR.MUNCANG');
INSERT INTO `ref_desa` VALUES (2549, 159, 'BTU NUNGGAL');
INSERT INTO `ref_desa` VALUES (2550, 159, 'BTUNNUNGGAL');
INSERT INTO `ref_desa` VALUES (2551, 159, 'BTUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2552, 159, 'BUMBULANG');
INSERT INTO `ref_desa` VALUES (2553, 159, 'BUMBUMLANG');
INSERT INTO `ref_desa` VALUES (2554, 159, 'BUMI ASIH');
INSERT INTO `ref_desa` VALUES (2555, 159, 'BUNGBULANG');
INSERT INTO `ref_desa` VALUES (2556, 159, 'C IBADAK');
INSERT INTO `ref_desa` VALUES (2557, 159, 'CAARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (2558, 159, 'CADAK');
INSERT INTO `ref_desa` VALUES (2559, 159, 'CAINGIN KULON');
INSERT INTO `ref_desa` VALUES (2560, 159, 'CANGKORE');
INSERT INTO `ref_desa` VALUES (2561, 159, 'CANTAYAN');
INSERT INTO `ref_desa` VALUES (2562, 159, 'CANYATAN');
INSERT INTO `ref_desa` VALUES (2563, 159, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (2564, 159, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (2565, 159, 'CARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (2566, 159, 'CARINGINNEGLASARI');
INSERT INTO `ref_desa` VALUES (2567, 159, 'CARINGINWETAN');
INSERT INTO `ref_desa` VALUES (2568, 159, 'CARRINGIN');
INSERT INTO `ref_desa` VALUES (2569, 159, 'CBADAK');
INSERT INTO `ref_desa` VALUES (2570, 159, 'CBADASK');
INSERT INTO `ref_desa` VALUES (2571, 159, 'CBAFAKCIDBADAK');
INSERT INTO `ref_desa` VALUES (2572, 159, 'CBATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2573, 159, 'CBDAK');
INSERT INTO `ref_desa` VALUES (2574, 159, 'CCIBADAK');
INSERT INTO `ref_desa` VALUES (2575, 159, 'CCIHEULANG');
INSERT INTO `ref_desa` VALUES (2576, 159, 'CCIJALINGAN');
INSERT INTO `ref_desa` VALUES (2577, 159, 'CEHEALANGTONGOH');
INSERT INTO `ref_desa` VALUES (2578, 159, 'CEHELANG');
INSERT INTO `ref_desa` VALUES (2579, 159, 'CEIHEULANG');
INSERT INTO `ref_desa` VALUES (2580, 159, 'CELAG ONGGOH');
INSERT INTO `ref_desa` VALUES (2581, 159, 'CENDEU');
INSERT INTO `ref_desa` VALUES (2582, 159, 'CH3LANG');
INSERT INTO `ref_desa` VALUES (2583, 159, 'CHELANG');
INSERT INTO `ref_desa` VALUES (2584, 159, 'CHELANG TNGGOH');
INSERT INTO `ref_desa` VALUES (2585, 159, 'CHELANGHILIR');
INSERT INTO `ref_desa` VALUES (2586, 159, 'CHELANGTNGGOH');
INSERT INTO `ref_desa` VALUES (2587, 159, 'CI ADAK');
INSERT INTO `ref_desa` VALUES (2588, 159, 'CI8BADAK');
INSERT INTO `ref_desa` VALUES (2589, 159, 'CIAADAK');
INSERT INTO `ref_desa` VALUES (2590, 159, 'CIABAD');
INSERT INTO `ref_desa` VALUES (2591, 159, 'CIABADAK');
INSERT INTO `ref_desa` VALUES (2592, 159, 'CIABADK');
INSERT INTO `ref_desa` VALUES (2593, 159, 'CIABDAK');
INSERT INTO `ref_desa` VALUES (2594, 159, 'CIADAK');
INSERT INTO `ref_desa` VALUES (2595, 159, 'CIADK');
INSERT INTO `ref_desa` VALUES (2596, 159, 'CIAHELANG');
INSERT INTO `ref_desa` VALUES (2597, 159, 'CIAMBAR');
INSERT INTO `ref_desa` VALUES (2598, 159, 'CIAMHI');
INSERT INTO `ref_desa` VALUES (2599, 159, 'CIANDAM');
INSERT INTO `ref_desa` VALUES (2600, 159, 'CIANGSANA');
INSERT INTO `ref_desa` VALUES (2601, 159, 'CIANSANA');
INSERT INTO `ref_desa` VALUES (2602, 159, 'CIANSANAN');
INSERT INTO `ref_desa` VALUES (2603, 159, 'CIAWI TALI');
INSERT INTO `ref_desa` VALUES (2604, 159, 'CIB ADAK');
INSERT INTO `ref_desa` VALUES (2605, 159, 'CIBAAATU');
INSERT INTO `ref_desa` VALUES (2606, 159, 'CIBAADAK');
INSERT INTO `ref_desa` VALUES (2607, 159, 'CIBAADK');
INSERT INTO `ref_desa` VALUES (2608, 159, 'CIBAAK');
INSERT INTO `ref_desa` VALUES (2609, 159, 'CIBADA');
INSERT INTO `ref_desa` VALUES (2610, 159, 'CIBADAAK');
INSERT INTO `ref_desa` VALUES (2611, 159, 'CIBADAAKSEKARWANGI');
INSERT INTO `ref_desa` VALUES (2612, 159, 'CIBADADAK');
INSERT INTO `ref_desa` VALUES (2613, 159, 'CIBADADK');
INSERT INTO `ref_desa` VALUES (2614, 159, 'CIBADAJK');
INSERT INTO `ref_desa` VALUES (2615, 159, 'CIBADAK .');
INSERT INTO `ref_desa` VALUES (2616, 159, 'CIBADAK B 10');
INSERT INTO `ref_desa` VALUES (2617, 159, 'CIBADAK GANG SADAR');
INSERT INTO `ref_desa` VALUES (2618, 159, 'CIBADAK POS');
INSERT INTO `ref_desa` VALUES (2619, 159, 'CIBADAK SEKARWANGI');
INSERT INTO `ref_desa` VALUES (2620, 159, 'CIBADAK.');
INSERT INTO `ref_desa` VALUES (2621, 159, 'CIBADAK.CIBADAK');
INSERT INTO `ref_desa` VALUES (2622, 159, 'CIBADAK3');
INSERT INTO `ref_desa` VALUES (2623, 159, 'CIBADAK?CIBADAK');
INSERT INTO `ref_desa` VALUES (2624, 159, 'CIBADAKA');
INSERT INTO `ref_desa` VALUES (2625, 159, 'CIBADAKCIBADAK');
INSERT INTO `ref_desa` VALUES (2626, 159, 'CIBADAKJ');
INSERT INTO `ref_desa` VALUES (2627, 159, 'CIBADAKL');
INSERT INTO `ref_desa` VALUES (2628, 159, 'CIBADAK[NYANGKOEK]');
INSERT INTO `ref_desa` VALUES (2629, 159, 'CIBADAK]');
INSERT INTO `ref_desa` VALUES (2630, 159, 'CIBADAK]CIBADAK');
INSERT INTO `ref_desa` VALUES (2631, 159, 'CIBADALK');
INSERT INTO `ref_desa` VALUES (2632, 159, 'CIBADAQK');
INSERT INTO `ref_desa` VALUES (2633, 159, 'CIBADDAK');
INSERT INTO `ref_desa` VALUES (2634, 159, 'CIBADEAK');
INSERT INTO `ref_desa` VALUES (2635, 159, 'CIBADK');
INSERT INTO `ref_desa` VALUES (2636, 159, 'CIBADKAK');
INSERT INTO `ref_desa` VALUES (2637, 159, 'CIBAEDAK');
INSERT INTO `ref_desa` VALUES (2638, 159, 'CIBAFAK');
INSERT INTO `ref_desa` VALUES (2639, 159, 'CIBAGA');
INSERT INTO `ref_desa` VALUES (2640, 159, 'CIBAK');
INSERT INTO `ref_desa` VALUES (2641, 159, 'CIBALUNG');
INSERT INTO `ref_desa` VALUES (2642, 159, 'CIBARAJA');
INSERT INTO `ref_desa` VALUES (2643, 159, 'CIBARENGKOK');
INSERT INTO `ref_desa` VALUES (2644, 159, 'CIBARU GIRANG');
INSERT INTO `ref_desa` VALUES (2645, 159, 'CIBASAK');
INSERT INTO `ref_desa` VALUES (2646, 159, 'CIBASDAK');
INSERT INTO `ref_desa` VALUES (2647, 159, 'CIBATI HILIR');
INSERT INTO `ref_desa` VALUES (2648, 159, 'CIBATU');
INSERT INTO `ref_desa` VALUES (2649, 159, 'CIBATU ASIH');
INSERT INTO `ref_desa` VALUES (2650, 159, 'CIBATU GIRANG');
INSERT INTO `ref_desa` VALUES (2651, 159, 'CIBATU HILIR');
INSERT INTO `ref_desa` VALUES (2652, 159, 'CIBATU NUNGGAL');
INSERT INTO `ref_desa` VALUES (2653, 159, 'CIBATUGIRANG');
INSERT INTO `ref_desa` VALUES (2654, 159, 'CIBATUHILIR');
INSERT INTO `ref_desa` VALUES (2655, 159, 'CIBATU]');
INSERT INTO `ref_desa` VALUES (2656, 159, 'CIBDAK');
INSERT INTO `ref_desa` VALUES (2657, 159, 'CIBDFAK');
INSERT INTO `ref_desa` VALUES (2658, 159, 'CIBDK');
INSERT INTO `ref_desa` VALUES (2659, 159, 'CIBHELANG');
INSERT INTO `ref_desa` VALUES (2660, 159, 'CIBITUNG');
INSERT INTO `ref_desa` VALUES (2661, 159, 'CIBNADAK');
INSERT INTO `ref_desa` VALUES (2662, 159, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (2663, 159, 'CIBOLANG');
INSERT INTO `ref_desa` VALUES (2664, 159, 'CIBOLANG  KALER');
INSERT INTO `ref_desa` VALUES (2665, 159, 'CIBSADAK');
INSERT INTO `ref_desa` VALUES (2666, 159, 'CIBSDASK');
INSERT INTO `ref_desa` VALUES (2667, 159, 'CIBSDSK');
INSERT INTO `ref_desa` VALUES (2668, 159, 'CIBSSK');
INSERT INTO `ref_desa` VALUES (2669, 159, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (2670, 159, 'CIBVADAK');
INSERT INTO `ref_desa` VALUES (2671, 159, 'CICALENGKA KULON');
INSERT INTO `ref_desa` VALUES (2672, 159, 'CICANTAYAN');
INSERT INTO `ref_desa` VALUES (2673, 159, 'CICAREAH');
INSERT INTO `ref_desa` VALUES (2674, 159, 'CICAREUH');
INSERT INTO `ref_desa` VALUES (2675, 159, 'CICURUG');
INSERT INTO `ref_desa` VALUES (2676, 159, 'CIDADAP');
INSERT INTO `ref_desa` VALUES (2677, 159, 'CIDAK');
INSERT INTO `ref_desa` VALUES (2678, 159, 'CIDATU HILIR');
INSERT INTO `ref_desa` VALUES (2679, 159, 'CIEHULANG');
INSERT INTO `ref_desa` VALUES (2680, 159, 'CIEHULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2681, 159, 'CIELANG');
INSERT INTO `ref_desa` VALUES (2682, 159, 'CIELANG TOGGOH');
INSERT INTO `ref_desa` VALUES (2683, 159, 'CIEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2684, 159, 'CIEURIH');
INSERT INTO `ref_desa` VALUES (2685, 159, 'CIGADOG');
INSERT INTO `ref_desa` VALUES (2686, 159, 'CIGEREJI');
INSERT INTO `ref_desa` VALUES (2687, 159, 'CIGERIJI');
INSERT INTO `ref_desa` VALUES (2688, 159, 'CIHAEALNG');
INSERT INTO `ref_desa` VALUES (2689, 159, 'CIHANYAWAR');
INSERT INTO `ref_desa` VALUES (2690, 159, 'CIHEALANG KB KAI');
INSERT INTO `ref_desa` VALUES (2691, 159, 'CIHEALANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2692, 159, 'CIHEALANG TONGOH');
INSERT INTO `ref_desa` VALUES (2693, 159, 'CIHEALANGAN');
INSERT INTO `ref_desa` VALUES (2694, 159, 'CIHEALANGHILIR');
INSERT INTO `ref_desa` VALUES (2695, 159, 'CIHEALANGTONGGOH');
INSERT INTO `ref_desa` VALUES (2696, 159, 'CIHEALNG');
INSERT INTO `ref_desa` VALUES (2697, 159, 'CIHEALNGTONGOH');
INSERT INTO `ref_desa` VALUES (2698, 159, 'CIHEKLABNGTOMGGOH');
INSERT INTO `ref_desa` VALUES (2699, 159, 'CIHEKLANG');
INSERT INTO `ref_desa` VALUES (2700, 159, 'CIHELANG');
INSERT INTO `ref_desa` VALUES (2701, 159, 'CIHELANG HILIR');
INSERT INTO `ref_desa` VALUES (2702, 159, 'CIHELANG HIRLIR');
INSERT INTO `ref_desa` VALUES (2703, 159, 'CIHELANG TENGAH');
INSERT INTO `ref_desa` VALUES (2704, 159, 'CIHELANG TENGGOH');
INSERT INTO `ref_desa` VALUES (2705, 159, 'CIHELANG TONGGO');
INSERT INTO `ref_desa` VALUES (2706, 159, 'CIHELANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2707, 159, 'CIHELANG TONGOH');
INSERT INTO `ref_desa` VALUES (2708, 159, 'CIHELANG TONNGGOH');
INSERT INTO `ref_desa` VALUES (2709, 159, 'CIHELANG TONNGOH');
INSERT INTO `ref_desa` VALUES (2710, 159, 'CIHELANGTEONGGOH');
INSERT INTO `ref_desa` VALUES (2711, 159, 'CIHELANGTONGGOG');
INSERT INTO `ref_desa` VALUES (2712, 159, 'CIHELANGTONGGOH');
INSERT INTO `ref_desa` VALUES (2713, 159, 'CIHELANGTONGOH');
INSERT INTO `ref_desa` VALUES (2714, 159, 'CIHELANH');
INSERT INTO `ref_desa` VALUES (2715, 159, 'CIHELNG HILIR');
INSERT INTO `ref_desa` VALUES (2716, 159, 'CIHELNGTONGGOH');
INSERT INTO `ref_desa` VALUES (2717, 159, 'CIHELNGTONGH');
INSERT INTO `ref_desa` VALUES (2718, 159, 'CIHEOLANGTONGGOH');
INSERT INTO `ref_desa` VALUES (2719, 159, 'CIHERANG');
INSERT INTO `ref_desa` VALUES (2720, 159, 'CIHESLSNGTONGOH');
INSERT INTO `ref_desa` VALUES (2721, 159, 'CIHEUANG');
INSERT INTO `ref_desa` VALUES (2722, 159, 'CIHEULANG');
INSERT INTO `ref_desa` VALUES (2723, 159, 'CIHEULANG  TONGGOH');
INSERT INTO `ref_desa` VALUES (2724, 159, 'CIHEULANG .');
INSERT INTO `ref_desa` VALUES (2725, 159, 'CIHEULANG HILIR');
INSERT INTO `ref_desa` VALUES (2726, 159, 'CIHEULANG KALER');
INSERT INTO `ref_desa` VALUES (2727, 159, 'CIHEULANG TOGGOH');
INSERT INTO `ref_desa` VALUES (2728, 159, 'CIHEULANG TOGOH');
INSERT INTO `ref_desa` VALUES (2729, 159, 'CIHEULANG TONGGGOH');
INSERT INTO `ref_desa` VALUES (2730, 159, 'CIHEULANG TONGGIH');
INSERT INTO `ref_desa` VALUES (2731, 159, 'CIHEULANG TONGGIO');
INSERT INTO `ref_desa` VALUES (2732, 159, 'CIHEULANG TONGGO');
INSERT INTO `ref_desa` VALUES (2733, 159, 'CIHEULANG TONGGOH .');
INSERT INTO `ref_desa` VALUES (2734, 159, 'CIHEULANG TONGGOH.');
INSERT INTO `ref_desa` VALUES (2735, 159, 'CIHEULANG TONGGOHHILIR');
INSERT INTO `ref_desa` VALUES (2736, 159, 'CIHEULANG TONGOH');
INSERT INTO `ref_desa` VALUES (2737, 159, 'CIHEULANG.TONGGOH');
INSERT INTO `ref_desa` VALUES (2738, 159, 'CIHEULANGHILIR');
INSERT INTO `ref_desa` VALUES (2739, 159, 'CIHEULANGN TONGGOH');
INSERT INTO `ref_desa` VALUES (2740, 159, 'CIHEULANGONGGOH');
INSERT INTO `ref_desa` VALUES (2741, 159, 'CIHEULANGTONGGGOH');
INSERT INTO `ref_desa` VALUES (2742, 159, 'CIHEULANGTONGGOH');
INSERT INTO `ref_desa` VALUES (2743, 159, 'CIHEULANH TONGGOH');
INSERT INTO `ref_desa` VALUES (2744, 159, 'CIHEULANNG TONGGOH');
INSERT INTO `ref_desa` VALUES (2745, 159, 'CIHEULNG TONGGOH');
INSERT INTO `ref_desa` VALUES (2746, 159, 'CIHEURANG');
INSERT INTO `ref_desa` VALUES (2747, 159, 'CIHEUULANGTONGGOH');
INSERT INTO `ref_desa` VALUES (2748, 159, 'CIHUELANG');
INSERT INTO `ref_desa` VALUES (2749, 159, 'CIHUELANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2750, 159, 'CIHULANG TONGGGOH');
INSERT INTO `ref_desa` VALUES (2751, 159, 'CIHULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2752, 159, 'CIIBADAK');
INSERT INTO `ref_desa` VALUES (2753, 159, 'CIIHEALANG');
INSERT INTO `ref_desa` VALUES (2754, 159, 'CIJABON');
INSERT INTO `ref_desa` VALUES (2755, 159, 'CIJALANGAN');
INSERT INTO `ref_desa` VALUES (2756, 159, 'CIJALINAGN');
INSERT INTO `ref_desa` VALUES (2757, 159, 'CIJALINGAN');
INSERT INTO `ref_desa` VALUES (2758, 159, 'CIJALKINAGAN');
INSERT INTO `ref_desa` VALUES (2759, 159, 'CIJAMBE');
INSERT INTO `ref_desa` VALUES (2760, 159, 'CIJATI');
INSERT INTO `ref_desa` VALUES (2761, 159, 'CIJEHELANG TONNGOH');
INSERT INTO `ref_desa` VALUES (2762, 159, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (2763, 159, 'CIJENKOL');
INSERT INTO `ref_desa` VALUES (2764, 159, 'CIJHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2765, 159, 'CIJOLANG');
INSERT INTO `ref_desa` VALUES (2766, 159, 'CIJULANG');
INSERT INTO `ref_desa` VALUES (2767, 159, 'CIKADAKA');
INSERT INTO `ref_desa` VALUES (2768, 159, 'CIKAREO');
INSERT INTO `ref_desa` VALUES (2769, 159, 'CIKAROYA');
INSERT INTO `ref_desa` VALUES (2770, 159, 'CIKAWUNG');
INSERT INTO `ref_desa` VALUES (2771, 159, 'CIKEMBANG');
INSERT INTO `ref_desa` VALUES (2772, 159, 'CIKEMBAR');
INSERT INTO `ref_desa` VALUES (2773, 159, 'CIKIDANG');
INSERT INTO `ref_desa` VALUES (2774, 159, 'CIKIWU;L');
INSERT INTO `ref_desa` VALUES (2775, 159, 'CIKIWUL');
INSERT INTO `ref_desa` VALUES (2776, 159, 'CIKIWUL LEBAK');
INSERT INTO `ref_desa` VALUES (2777, 159, 'CIKIWUL TONGGOH');
INSERT INTO `ref_desa` VALUES (2778, 159, 'CIKIWULLWBWK');
INSERT INTO `ref_desa` VALUES (2779, 159, 'CIKUKULU');
INSERT INTO `ref_desa` VALUES (2780, 159, 'CIKUWUL');
INSERT INTO `ref_desa` VALUES (2781, 159, 'CIKUYA');
INSERT INTO `ref_desa` VALUES (2782, 159, 'CILEATUH');
INSERT INTO `ref_desa` VALUES (2783, 159, 'CILENGGO');
INSERT INTO `ref_desa` VALUES (2784, 159, 'CILENGO');
INSERT INTO `ref_desa` VALUES (2785, 159, 'CILENGO SUKASIRNA');
INSERT INTO `ref_desa` VALUES (2786, 159, 'CILENTAB');
INSERT INTO `ref_desa` VALUES (2787, 159, 'CILENTB');
INSERT INTO `ref_desa` VALUES (2788, 159, 'CILETUH');
INSERT INTO `ref_desa` VALUES (2789, 159, 'CILKSANA');
INSERT INTO `ref_desa` VALUES (2790, 159, 'CILUBANG');
INSERT INTO `ref_desa` VALUES (2791, 159, 'CIMAHI');
INSERT INTO `ref_desa` VALUES (2792, 159, 'CIMANDE');
INSERT INTO `ref_desa` VALUES (2793, 159, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (2794, 159, 'CIMBADAK');
INSERT INTO `ref_desa` VALUES (2795, 159, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (2796, 159, 'CINABADAK');
INSERT INTO `ref_desa` VALUES (2797, 159, 'CINADAK');
INSERT INTO `ref_desa` VALUES (2798, 159, 'CINBADAK');
INSERT INTO `ref_desa` VALUES (2799, 159, 'CINYOCOK');
INSERT INTO `ref_desa` VALUES (2800, 159, 'CINYOJOK');
INSERT INTO `ref_desa` VALUES (2801, 159, 'CIOBADAK');
INSERT INTO `ref_desa` VALUES (2802, 159, 'CIOHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2803, 159, 'CIORAY');
INSERT INTO `ref_desa` VALUES (2804, 159, 'CIPAETIR');
INSERT INTO `ref_desa` VALUES (2805, 159, 'CIPANADS');
INSERT INTO `ref_desa` VALUES (2806, 159, 'CIPANAS');
INSERT INTO `ref_desa` VALUES (2807, 159, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (2808, 159, 'CIPASUNG');
INSERT INTO `ref_desa` VALUES (2809, 159, 'CIPENDEUY');
INSERT INTO `ref_desa` VALUES (2810, 159, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (2811, 159, 'CIPICUNG');
INSERT INTO `ref_desa` VALUES (2812, 159, 'CIRENDEU');
INSERT INTO `ref_desa` VALUES (2813, 159, 'CIRENDU');
INSERT INTO `ref_desa` VALUES (2814, 159, 'CIREUNGED');
INSERT INTO `ref_desa` VALUES (2815, 159, 'CISAANDE');
INSERT INTO `ref_desa` VALUES (2816, 159, 'CISAAT');
INSERT INTO `ref_desa` VALUES (2817, 159, 'CISANDE');
INSERT INTO `ref_desa` VALUES (2818, 159, 'CISARUA');
INSERT INTO `ref_desa` VALUES (2819, 159, 'CISEUPAN');
INSERT INTO `ref_desa` VALUES (2820, 159, 'CITIRIS');
INSERT INTO `ref_desa` VALUES (2821, 159, 'CITUSAER');
INSERT INTO `ref_desa` VALUES (2822, 159, 'CIUADG');
INSERT INTO `ref_desa` VALUES (2823, 159, 'CIUHELANG');
INSERT INTO `ref_desa` VALUES (2824, 159, 'CIUJUNG');
INSERT INTO `ref_desa` VALUES (2825, 159, 'CIVBADAK');
INSERT INTO `ref_desa` VALUES (2826, 159, 'CI[PANAS');
INSERT INTO `ref_desa` VALUES (2827, 159, 'CMENTENG');
INSERT INTO `ref_desa` VALUES (2828, 159, 'COCOK');
INSERT INTO `ref_desa` VALUES (2829, 159, 'COIBADAK');
INSERT INTO `ref_desa` VALUES (2830, 159, 'COIBFDAK');
INSERT INTO `ref_desa` VALUES (2831, 159, 'COIBOLANG');
INSERT INTO `ref_desa` VALUES (2832, 159, 'COIKADOG');
INSERT INTO `ref_desa` VALUES (2833, 159, 'COPADAKPERMAI');
INSERT INTO `ref_desa` VALUES (2834, 159, 'COSMO TEKNOLOGOI');
INSERT INTO `ref_desa` VALUES (2835, 159, 'CPASKO');
INSERT INTO `ref_desa` VALUES (2836, 159, 'CRENDEU');
INSERT INTO `ref_desa` VALUES (2837, 159, 'CRINGIN');
INSERT INTO `ref_desa` VALUES (2838, 159, 'CSUKASIRNA');
INSERT INTO `ref_desa` VALUES (2839, 159, 'CUBADAK');
INSERT INTO `ref_desa` VALUES (2840, 159, 'CUHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2841, 159, 'CUHEULANGTONGGOH');
INSERT INTO `ref_desa` VALUES (2842, 159, 'CUIBADAK');
INSERT INTO `ref_desa` VALUES (2843, 159, 'CUIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (2844, 159, 'CVIBADAK');
INSERT INTO `ref_desa` VALUES (2845, 159, 'CXIBADAK');
INSERT INTO `ref_desa` VALUES (2846, 159, 'DALIMA');
INSERT INTO `ref_desa` VALUES (2847, 159, 'DARMAGA');
INSERT INTO `ref_desa` VALUES (2848, 159, 'DATAR NANGKA');
INSERT INTO `ref_desa` VALUES (2849, 159, 'DSALAMJAH');
INSERT INTO `ref_desa` VALUES (2850, 159, 'DSEKARWANGI');
INSERT INTO `ref_desa` VALUES (2851, 159, 'EAKARWANGI');
INSERT INTO `ref_desa` VALUES (2852, 159, 'EAKRWANGI');
INSERT INTO `ref_desa` VALUES (2853, 159, 'EBURSAWAH');
INSERT INTO `ref_desa` VALUES (2854, 159, 'EGARSARI');
INSERT INTO `ref_desa` VALUES (2855, 159, 'EKARWANGI');
INSERT INTO `ref_desa` VALUES (2856, 159, 'EMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (2857, 159, 'ENJOJAYA');
INSERT INTO `ref_desa` VALUES (2858, 159, 'GANG KRISTIN');
INSERT INTO `ref_desa` VALUES (2859, 159, 'GANG TALIB');
INSERT INTO `ref_desa` VALUES (2860, 159, 'GANG TOLIB');
INSERT INTO `ref_desa` VALUES (2861, 159, 'GANG TOLOB');
INSERT INTO `ref_desa` VALUES (2862, 159, 'GEANTEANG');
INSERT INTO `ref_desa` VALUES (2863, 159, 'GENTENG');
INSERT INTO `ref_desa` VALUES (2864, 159, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (2865, 159, 'GIRIJAYA');
INSERT INTO `ref_desa` VALUES (2866, 159, 'GUNG KARANG');
INSERT INTO `ref_desa` VALUES (2867, 159, 'GUNNG JAYA');
INSERT INTO `ref_desa` VALUES (2868, 159, 'GUNUNG JAYA');
INSERT INTO `ref_desa` VALUES (2869, 159, 'GUNUNG KARANG');
INSERT INTO `ref_desa` VALUES (2870, 159, 'GUNUNG WALAT');
INSERT INTO `ref_desa` VALUES (2871, 159, 'GUNUNGSARI');
INSERT INTO `ref_desa` VALUES (2872, 159, 'HEDAR MANAH');
INSERT INTO `ref_desa` VALUES (2873, 159, 'HEGA SARI');
INSERT INTO `ref_desa` VALUES (2874, 159, 'HEGAARMANAH');
INSERT INTO `ref_desa` VALUES (2875, 159, 'HEGAR  MANAH');
INSERT INTO `ref_desa` VALUES (2876, 159, 'HEGAR ALAM');
INSERT INTO `ref_desa` VALUES (2877, 159, 'HEGAR MANAH');
INSERT INTO `ref_desa` VALUES (2878, 159, 'HEGAR SARI');
INSERT INTO `ref_desa` VALUES (2879, 159, 'HEGARA MANAH');
INSERT INTO `ref_desa` VALUES (2880, 159, 'HEGARALAM');
INSERT INTO `ref_desa` VALUES (2881, 159, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (2882, 159, 'HEGARSARI');
INSERT INTO `ref_desa` VALUES (2883, 159, 'HEGRAMANAH');
INSERT INTO `ref_desa` VALUES (2884, 159, 'HERGARSARI');
INSERT INTO `ref_desa` VALUES (2885, 159, 'IB');
INSERT INTO `ref_desa` VALUES (2886, 159, 'IBADAK');
INSERT INTO `ref_desa` VALUES (2887, 159, 'IBADAK]');
INSERT INTO `ref_desa` VALUES (2888, 159, 'IBDK');
INSERT INTO `ref_desa` VALUES (2889, 159, 'JAYA BAKTI');
INSERT INTO `ref_desa` VALUES (2890, 159, 'JAYABAKTI');
INSERT INTO `ref_desa` VALUES (2891, 159, 'JEAGLASARI');
INSERT INTO `ref_desa` VALUES (2892, 159, 'JKB PALA');
INSERT INTO `ref_desa` VALUES (2893, 159, 'JOHOR');
INSERT INTO `ref_desa` VALUES (2894, 159, 'KAANAGTEANGAH');
INSERT INTO `ref_desa` VALUES (2895, 159, 'KAANGTEANAGJ');
INSERT INTO `ref_desa` VALUES (2896, 159, 'KAANGTEANGHA');
INSERT INTO `ref_desa` VALUES (2897, 159, 'KAANGTEGAH');
INSERT INTO `ref_desa` VALUES (2898, 159, 'KAANGTENAGH');
INSERT INTO `ref_desa` VALUES (2899, 159, 'KAANGYEGAH');
INSERT INTO `ref_desa` VALUES (2900, 159, 'KAB RANDAU');
INSERT INTO `ref_desa` VALUES (2901, 159, 'KAB RANDU');
INSERT INTO `ref_desa` VALUES (2902, 159, 'KADU NUNGGAL');
INSERT INTO `ref_desa` VALUES (2903, 159, 'KADU PUGUR');
INSERT INTO `ref_desa` VALUES (2904, 159, 'KADUNUNGGAL');
INSERT INTO `ref_desa` VALUES (2905, 159, 'KADUPUGUR');
INSERT INTO `ref_desa` VALUES (2906, 159, 'KAERANGTENAGAH');
INSERT INTO `ref_desa` VALUES (2907, 159, 'KALABANG');
INSERT INTO `ref_desa` VALUES (2908, 159, 'KALABANGMALINGGUT');
INSERT INTO `ref_desa` VALUES (2909, 159, 'KALAPANUNGAL');
INSERT INTO `ref_desa` VALUES (2910, 159, 'KALAPANUNGGAL');
INSERT INTO `ref_desa` VALUES (2911, 159, 'KAMANDORAN');
INSERT INTO `ref_desa` VALUES (2912, 159, 'KAMANDORANG');
INSERT INTO `ref_desa` VALUES (2913, 159, 'KAMNADORAN');
INSERT INTO `ref_desa` VALUES (2914, 159, 'KAMPUNG PINTU');
INSERT INTO `ref_desa` VALUES (2915, 159, 'KANDENGAN');
INSERT INTO `ref_desa` VALUES (2916, 159, 'KANGTEAGH');
INSERT INTO `ref_desa` VALUES (2917, 159, 'KANREABG');
INSERT INTO `ref_desa` VALUES (2918, 159, 'KAR TENGAH');
INSERT INTO `ref_desa` VALUES (2919, 159, 'KAR4ANGTEAGH');
INSERT INTO `ref_desa` VALUES (2920, 159, 'KARAANGTEANGH');
INSERT INTO `ref_desa` VALUES (2921, 159, 'KARABGTENAGAH');
INSERT INTO `ref_desa` VALUES (2922, 159, 'KARABNGTENGAH');
INSERT INTO `ref_desa` VALUES (2923, 159, 'KARADENAGAN');
INSERT INTO `ref_desa` VALUES (2924, 159, 'KARADENAN');
INSERT INTO `ref_desa` VALUES (2925, 159, 'KARAG TENGAH');
INSERT INTO `ref_desa` VALUES (2926, 159, 'KARAGTENAGAH');
INSERT INTO `ref_desa` VALUES (2927, 159, 'KARAGTENGAH');
INSERT INTO `ref_desa` VALUES (2928, 159, 'KARAMG TENGAH');
INSERT INTO `ref_desa` VALUES (2929, 159, 'KARAMNG');
INSERT INTO `ref_desa` VALUES (2930, 159, 'KARAMNG TENGAH');
INSERT INTO `ref_desa` VALUES (2931, 159, 'KARAMNGTENGAH');
INSERT INTO `ref_desa` VALUES (2932, 159, 'KARAN TENAHA');
INSERT INTO `ref_desa` VALUES (2933, 159, 'KARAN TENGAH');
INSERT INTO `ref_desa` VALUES (2934, 159, 'KARANAG TENGAH');
INSERT INTO `ref_desa` VALUES (2935, 159, 'KARANAGTBNGAHA');
INSERT INTO `ref_desa` VALUES (2936, 159, 'KARANAGTENAGAH');
INSERT INTO `ref_desa` VALUES (2937, 159, 'KARANG');
INSERT INTO `ref_desa` VALUES (2938, 159, 'KARANG  TENGAH');
INSERT INTO `ref_desa` VALUES (2939, 159, 'KARANG ENGAH');
INSERT INTO `ref_desa` VALUES (2940, 159, 'KARANG HILIR');
INSERT INTO `ref_desa` VALUES (2941, 159, 'KARANG TANGAH');
INSERT INTO `ref_desa` VALUES (2942, 159, 'KARANG TEANGAH');
INSERT INTO `ref_desa` VALUES (2943, 159, 'KARANG TEGAH');
INSERT INTO `ref_desa` VALUES (2944, 159, 'KARANG TEMGAH');
INSERT INTO `ref_desa` VALUES (2945, 159, 'KARANG TENAGAH');
INSERT INTO `ref_desa` VALUES (2946, 159, 'KARANG TENAGH');
INSERT INTO `ref_desa` VALUES (2947, 159, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (2948, 159, 'KARANG TENGAH .');
INSERT INTO `ref_desa` VALUES (2949, 159, 'KARANG TENGAH.');
INSERT INTO `ref_desa` VALUES (2950, 159, 'KARANG TENGAHJ');
INSERT INTO `ref_desa` VALUES (2951, 159, 'KARANG TENGAH]');
INSERT INTO `ref_desa` VALUES (2952, 159, 'KARANG TENGAN');
INSERT INTO `ref_desa` VALUES (2953, 159, 'KARANG TENGASH');
INSERT INTO `ref_desa` VALUES (2954, 159, 'KARANG TENGFAH');
INSERT INTO `ref_desa` VALUES (2955, 159, 'KARANG TENGHA');
INSERT INTO `ref_desa` VALUES (2956, 159, 'KARANG TENMGAH');
INSERT INTO `ref_desa` VALUES (2957, 159, 'KARANG TENNGAH');
INSERT INTO `ref_desa` VALUES (2958, 159, 'KARANG TNGAH');
INSERT INTO `ref_desa` VALUES (2959, 159, 'KARANG TRENGAH');
INSERT INTO `ref_desa` VALUES (2960, 159, 'KARANG TYENGAH');
INSERT INTO `ref_desa` VALUES (2961, 159, 'KARANG YENGAH');
INSERT INTO `ref_desa` VALUES (2962, 159, 'KARANG.TENGAH');
INSERT INTO `ref_desa` VALUES (2963, 159, 'KARANGENGAH');
INSERT INTO `ref_desa` VALUES (2964, 159, 'KARANGETNGAH');
INSERT INTO `ref_desa` VALUES (2965, 159, 'KARANGF TENGAH');
INSERT INTO `ref_desa` VALUES (2966, 159, 'KARANGHILIR');
INSERT INTO `ref_desa` VALUES (2967, 159, 'KARANGN TENGAH');
INSERT INTO `ref_desa` VALUES (2968, 159, 'KARANGN TENGHA');
INSERT INTO `ref_desa` VALUES (2969, 159, 'KARANGRAHTEANH');
INSERT INTO `ref_desa` VALUES (2970, 159, 'KARANGRTEAH');
INSERT INTO `ref_desa` VALUES (2971, 159, 'KARANGSARI');
INSERT INTO `ref_desa` VALUES (2972, 159, 'KARANGTAEAHK');
INSERT INTO `ref_desa` VALUES (2973, 159, 'KARANGTAEANAGAHA');
INSERT INTO `ref_desa` VALUES (2974, 159, 'KARANGTAEANGH');
INSERT INTO `ref_desa` VALUES (2975, 159, 'KARANGTAGAH');
INSERT INTO `ref_desa` VALUES (2976, 159, 'KARANGTANH');
INSERT INTO `ref_desa` VALUES (2977, 159, 'KARANGTEABAGAH');
INSERT INTO `ref_desa` VALUES (2978, 159, 'KARANGTEABNAGAH');
INSERT INTO `ref_desa` VALUES (2979, 159, 'KARANGTEABNAGH');
INSERT INTO `ref_desa` VALUES (2980, 159, 'KARANGTEAGAH');
INSERT INTO `ref_desa` VALUES (2981, 159, 'KARANGTEAGAHA');
INSERT INTO `ref_desa` VALUES (2982, 159, 'KARANGTEAGAN');
INSERT INTO `ref_desa` VALUES (2983, 159, 'KARANGTEAGH');
INSERT INTO `ref_desa` VALUES (2984, 159, 'KARANGTEAH');
INSERT INTO `ref_desa` VALUES (2985, 159, 'KARANGTEANAGAH');
INSERT INTO `ref_desa` VALUES (2986, 159, 'KARANGTEANAGH');
INSERT INTO `ref_desa` VALUES (2987, 159, 'KARANGTEANAGJH');
INSERT INTO `ref_desa` VALUES (2988, 159, 'KARANGTEANAH');
INSERT INTO `ref_desa` VALUES (2989, 159, 'KARANGTEANFGH');
INSERT INTO `ref_desa` VALUES (2990, 159, 'KARANGTEANGAH');
INSERT INTO `ref_desa` VALUES (2991, 159, 'KARANGTEANGAHA');
INSERT INTO `ref_desa` VALUES (2992, 159, 'KARANGTEANGH');
INSERT INTO `ref_desa` VALUES (2993, 159, 'KARANGTEANGHA');
INSERT INTO `ref_desa` VALUES (2994, 159, 'KARANGTEANH');
INSERT INTO `ref_desa` VALUES (2995, 159, 'KARANGTEEANGH');
INSERT INTO `ref_desa` VALUES (2996, 159, 'KARANGTEGAH');
INSERT INTO `ref_desa` VALUES (2997, 159, 'KARANGTEGANGAH');
INSERT INTO `ref_desa` VALUES (2998, 159, 'KARANGTEH');
INSERT INTO `ref_desa` VALUES (2999, 159, 'KARANGTENAAGAH');
INSERT INTO `ref_desa` VALUES (3000, 159, 'KARANGTENAGAH');
INSERT INTO `ref_desa` VALUES (3001, 159, 'KARANGTENAGAHA');
INSERT INTO `ref_desa` VALUES (3002, 159, 'KARANGTENAGAJH');
INSERT INTO `ref_desa` VALUES (3003, 159, 'KARANGTENAGANH');
INSERT INTO `ref_desa` VALUES (3004, 159, 'KARANGTENAGH');
INSERT INTO `ref_desa` VALUES (3005, 159, 'KARANGTENAGHA');
INSERT INTO `ref_desa` VALUES (3006, 159, 'KARANGTENAGJH');
INSERT INTO `ref_desa` VALUES (3007, 159, 'KARANGTENAH');
INSERT INTO `ref_desa` VALUES (3008, 159, 'KARANGTENAHA');
INSERT INTO `ref_desa` VALUES (3009, 159, 'KARANGTENGA');
INSERT INTO `ref_desa` VALUES (3010, 159, 'KARANGTENGAA');
INSERT INTO `ref_desa` VALUES (3011, 159, 'KARANGTENGAGH');
INSERT INTO `ref_desa` VALUES (3012, 159, 'KARANGTENGAH .');
INSERT INTO `ref_desa` VALUES (3013, 159, 'KARANGTENGAH.');
INSERT INTO `ref_desa` VALUES (3014, 159, 'KARANGTENGAHA');
INSERT INTO `ref_desa` VALUES (3015, 159, 'KARANGTENGAUJH');
INSERT INTO `ref_desa` VALUES (3016, 159, 'KARANGTENGHA');
INSERT INTO `ref_desa` VALUES (3017, 159, 'KARANGTNEGAH');
INSERT INTO `ref_desa` VALUES (3018, 159, 'KARANGTTEAGH');
INSERT INTO `ref_desa` VALUES (3019, 159, 'KARANGYTEANAGAH');
INSERT INTO `ref_desa` VALUES (3020, 159, 'KARANMG  HILIR');
INSERT INTO `ref_desa` VALUES (3021, 159, 'KARANMG TENGAH');
INSERT INTO `ref_desa` VALUES (3022, 159, 'KARANNG TENGAH');
INSERT INTO `ref_desa` VALUES (3023, 159, 'KARANNGTENGAH');
INSERT INTO `ref_desa` VALUES (3024, 159, 'KARANTEAGAH');
INSERT INTO `ref_desa` VALUES (3025, 159, 'KARANTEAH');
INSERT INTO `ref_desa` VALUES (3026, 159, 'KARANTEANGH');
INSERT INTO `ref_desa` VALUES (3027, 159, 'KARANTEGAH');
INSERT INTO `ref_desa` VALUES (3028, 159, 'KARANTENAGAH');
INSERT INTO `ref_desa` VALUES (3029, 159, 'KARANTENAGAHY');
INSERT INTO `ref_desa` VALUES (3030, 159, 'KARANTENGAH');
INSERT INTO `ref_desa` VALUES (3031, 159, 'KARASNG TENGAH');
INSERT INTO `ref_desa` VALUES (3032, 159, 'KARATE');
INSERT INTO `ref_desa` VALUES (3033, 159, 'KARATENAGAH');
INSERT INTO `ref_desa` VALUES (3034, 159, 'KARATENGAH');
INSERT INTO `ref_desa` VALUES (3035, 159, 'KARATENGAHCIBADAK');
INSERT INTO `ref_desa` VALUES (3036, 159, 'KARENG TENGAH');
INSERT INTO `ref_desa` VALUES (3037, 159, 'KARNAG TENGAH');
INSERT INTO `ref_desa` VALUES (3038, 159, 'KARNAGTENAGAH');
INSERT INTO `ref_desa` VALUES (3039, 159, 'KARNG TENGAH');
INSERT INTO `ref_desa` VALUES (3040, 159, 'KARNGAH');
INSERT INTO `ref_desa` VALUES (3041, 159, 'KARNGTAEAGH');
INSERT INTO `ref_desa` VALUES (3042, 159, 'KARNGTEAGAH');
INSERT INTO `ref_desa` VALUES (3043, 159, 'KARNGTEAGHA');
INSERT INTO `ref_desa` VALUES (3044, 159, 'KARNGTEAH');
INSERT INTO `ref_desa` VALUES (3045, 159, 'KARNGTEANAH');
INSERT INTO `ref_desa` VALUES (3046, 159, 'KARNGTEANGAH');
INSERT INTO `ref_desa` VALUES (3047, 159, 'KARNGTRH');
INSERT INTO `ref_desa` VALUES (3048, 159, 'KATRANG TENGAH');
INSERT INTO `ref_desa` VALUES (3049, 159, 'KATRANG TENGFAGH');
INSERT INTO `ref_desa` VALUES (3050, 159, 'KATRANGTEANGAH');
INSERT INTO `ref_desa` VALUES (3051, 159, 'KATRANGTENGAH');
INSERT INTO `ref_desa` VALUES (3052, 159, 'KAUM');
INSERT INTO `ref_desa` VALUES (3053, 159, 'KAUM KALER');
INSERT INTO `ref_desa` VALUES (3054, 159, 'KAUM KIDUL');
INSERT INTO `ref_desa` VALUES (3055, 159, 'KAUM KLER');
INSERT INTO `ref_desa` VALUES (3056, 159, 'KAUMKALER');
INSERT INTO `ref_desa` VALUES (3057, 159, 'KAWUNG KIDUL');
INSERT INTO `ref_desa` VALUES (3058, 159, 'KB KAI');
INSERT INTO `ref_desa` VALUES (3059, 159, 'KB KALAPA');
INSERT INTO `ref_desa` VALUES (3060, 159, 'KB KELAPA');
INSERT INTO `ref_desa` VALUES (3061, 159, 'KB PALA');
INSERT INTO `ref_desa` VALUES (3062, 159, 'KB RANDU');
INSERT INTO `ref_desa` VALUES (3063, 159, 'KB. KELAPA');
INSERT INTO `ref_desa` VALUES (3064, 159, 'KB. PALA');
INSERT INTO `ref_desa` VALUES (3065, 159, 'KBN PALA');
INSERT INTO `ref_desa` VALUES (3066, 159, 'KBN PASLA');
INSERT INTO `ref_desa` VALUES (3067, 159, 'KBN RANDU');
INSERT INTO `ref_desa` VALUES (3068, 159, 'KBRANDU');
INSERT INTO `ref_desa` VALUES (3069, 159, 'KD PUGUR');
INSERT INTO `ref_desa` VALUES (3070, 159, 'KEBON');
INSERT INTO `ref_desa` VALUES (3071, 159, 'KEBON JATI');
INSERT INTO `ref_desa` VALUES (3072, 159, 'KEBON KAI');
INSERT INTO `ref_desa` VALUES (3073, 159, 'KEBON KALAPA');
INSERT INTO `ref_desa` VALUES (3074, 159, 'KEBON KATYU');
INSERT INTO `ref_desa` VALUES (3075, 159, 'KEBON KAUM');
INSERT INTO `ref_desa` VALUES (3076, 159, 'KEBON KELAPA');
INSERT INTO `ref_desa` VALUES (3077, 159, 'KEBON PALA');
INSERT INTO `ref_desa` VALUES (3078, 159, 'KEBON PLA');
INSERT INTO `ref_desa` VALUES (3079, 159, 'KEBON RABNDU');
INSERT INTO `ref_desa` VALUES (3080, 159, 'KEBON RADU');
INSERT INTO `ref_desa` VALUES (3081, 159, 'KEBON RANDU');
INSERT INTO `ref_desa` VALUES (3082, 159, 'KEBONAKALA');
INSERT INTO `ref_desa` VALUES (3083, 159, 'KEBONKALAPA');
INSERT INTO `ref_desa` VALUES (3084, 159, 'KEBONPALA');
INSERT INTO `ref_desa` VALUES (3085, 159, 'KEBONRANDU');
INSERT INTO `ref_desa` VALUES (3086, 159, 'KEBUN KELAPA');
INSERT INTO `ref_desa` VALUES (3087, 159, 'KEMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3088, 159, 'KEON PALA');
INSERT INTO `ref_desa` VALUES (3089, 159, 'KERTARAHARJA');
INSERT INTO `ref_desa` VALUES (3090, 159, 'KKARANGTENGAH');
INSERT INTO `ref_desa` VALUES (3091, 159, 'KLARANG TENGAH');
INSERT INTO `ref_desa` VALUES (3092, 159, 'KLP NUNGGAL');
INSERT INTO `ref_desa` VALUES (3093, 159, 'KLP. NUNGGAGL');
INSERT INTO `ref_desa` VALUES (3094, 159, 'KLP. NUNGGAL');
INSERT INTO `ref_desa` VALUES (3095, 159, 'KP CIPANAS');
INSERT INTO `ref_desa` VALUES (3096, 159, 'KP DALIMA');
INSERT INTO `ref_desa` VALUES (3097, 159, 'KP DELIMA');
INSERT INTO `ref_desa` VALUES (3098, 159, 'KP PASAR');
INSERT INTO `ref_desa` VALUES (3099, 159, 'KP PASRIS');
INSERT INTO `ref_desa` VALUES (3100, 159, 'KP PINTI');
INSERT INTO `ref_desa` VALUES (3101, 159, 'KP PINTU');
INSERT INTO `ref_desa` VALUES (3102, 159, 'KP SEGOG');
INSERT INTO `ref_desa` VALUES (3103, 159, 'KP SELAAWI');
INSERT INTO `ref_desa` VALUES (3104, 159, 'KP TUGU');
INSERT INTO `ref_desa` VALUES (3105, 159, 'KP. BINTANG');
INSERT INTO `ref_desa` VALUES (3106, 159, 'KR HILIR');
INSERT INTO `ref_desa` VALUES (3107, 159, 'KR TENGAH');
INSERT INTO `ref_desa` VALUES (3108, 159, 'KR.');
INSERT INTO `ref_desa` VALUES (3109, 159, 'KR. TENGAH');
INSERT INTO `ref_desa` VALUES (3110, 159, 'KR. TENGAJH');
INSERT INTO `ref_desa` VALUES (3111, 159, 'KR. YENGAH');
INSERT INTO `ref_desa` VALUES (3112, 159, 'KR. YTENGAH');
INSERT INTO `ref_desa` VALUES (3113, 159, 'KR.TENGAH');
INSERT INTO `ref_desa` VALUES (3114, 159, 'KRANG TENGAH');
INSERT INTO `ref_desa` VALUES (3115, 159, 'KRANGTEAGH');
INSERT INTO `ref_desa` VALUES (3116, 159, 'KRANGTENGAH');
INSERT INTO `ref_desa` VALUES (3117, 159, 'KRG TENGAH');
INSERT INTO `ref_desa` VALUES (3118, 159, 'KRNGTENGAH');
INSERT INTO `ref_desa` VALUES (3119, 159, 'KRTENGAH');
INSERT INTO `ref_desa` VALUES (3120, 159, 'KSRSNGTESNGH');
INSERT INTO `ref_desa` VALUES (3121, 159, 'KUBANG');
INSERT INTO `ref_desa` VALUES (3122, 159, 'KUTA JAYA');
INSERT INTO `ref_desa` VALUES (3123, 159, 'KUTA SIRNA');
INSERT INTO `ref_desa` VALUES (3124, 159, 'KUTAJAYA');
INSERT INTO `ref_desa` VALUES (3125, 159, 'KUTASIRNA');
INSERT INTO `ref_desa` VALUES (3126, 159, 'L DATAR');
INSERT INTO `ref_desa` VALUES (3127, 159, 'L. DATAR');
INSERT INTO `ref_desa` VALUES (3128, 159, 'LABORA');
INSERT INTO `ref_desa` VALUES (3129, 159, 'LEBAK SIRNA');
INSERT INTO `ref_desa` VALUES (3130, 159, 'LEBAK SIUH');
INSERT INTO `ref_desa` VALUES (3131, 159, 'LEBAKSARI');
INSERT INTO `ref_desa` VALUES (3132, 159, 'LEBBURSAWAH');
INSERT INTO `ref_desa` VALUES (3133, 159, 'LEBUR AI');
INSERT INTO `ref_desa` VALUES (3134, 159, 'LEBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3135, 159, 'LEGOK PICUNG');
INSERT INTO `ref_desa` VALUES (3136, 159, 'LEGOKNYENANG');
INSERT INTO `ref_desa` VALUES (3137, 159, 'LEMB UR SAWAH');
INSERT INTO `ref_desa` VALUES (3138, 159, 'LEMBAURSAWAH');
INSERT INTO `ref_desa` VALUES (3139, 159, 'LEMBUR');
INSERT INTO `ref_desa` VALUES (3140, 159, 'LEMBUR JAMBI');
INSERT INTO `ref_desa` VALUES (3141, 159, 'LEMBUR JAMI');
INSERT INTO `ref_desa` VALUES (3142, 159, 'LEMBUR SAWA DOYONG');
INSERT INTO `ref_desa` VALUES (3143, 159, 'LEMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3144, 159, 'LEMBUR SAWAH SATU');
INSERT INTO `ref_desa` VALUES (3145, 159, 'LEMBUR SITU');
INSERT INTO `ref_desa` VALUES (3146, 159, 'LEMBUR SWAH');
INSERT INTO `ref_desa` VALUES (3147, 159, 'LEMBURSAWAH');
INSERT INTO `ref_desa` VALUES (3148, 159, 'LENGKONG SARI');
INSERT INTO `ref_desa` VALUES (3149, 159, 'LENMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3150, 159, 'LESUKASIRNA');
INSERT INTO `ref_desa` VALUES (3151, 159, 'LEUMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3152, 159, 'LEUWENG DATAR');
INSERT INTO `ref_desa` VALUES (3153, 159, 'LEUWEUNG DATAR');
INSERT INTO `ref_desa` VALUES (3154, 159, 'LEUWEUNG DDATAR');
INSERT INTO `ref_desa` VALUES (3155, 159, 'LEUWI GOONG');
INSERT INTO `ref_desa` VALUES (3156, 159, 'LEUWIGOONG');
INSERT INTO `ref_desa` VALUES (3157, 159, 'LEUWUNG DATAR');
INSERT INTO `ref_desa` VALUES (3158, 159, 'LEWENG DATAR');
INSERT INTO `ref_desa` VALUES (3159, 159, 'LEWENGDATAR');
INSERT INTO `ref_desa` VALUES (3160, 159, 'LEWEUNG DATAR');
INSERT INTO `ref_desa` VALUES (3161, 159, 'LIMUS NUNGGAL');
INSERT INTO `ref_desa` VALUES (3162, 159, 'LINGKUG SARI');
INSERT INTO `ref_desa` VALUES (3163, 159, 'LINGKUNG SARI');
INSERT INTO `ref_desa` VALUES (3164, 159, 'LINGKUNGSARI');
INSERT INTO `ref_desa` VALUES (3165, 159, 'LIO');
INSERT INTO `ref_desa` VALUES (3166, 159, 'LKARANG TENGAH');
INSERT INTO `ref_desa` VALUES (3167, 159, 'LKARANGTENAGH');
INSERT INTO `ref_desa` VALUES (3168, 159, 'LODAYA');
INSERT INTO `ref_desa` VALUES (3169, 159, 'LW DATAR');
INSERT INTO `ref_desa` VALUES (3170, 159, 'LW. DATAR');
INSERT INTO `ref_desa` VALUES (3171, 159, 'LWENG DATAR');
INSERT INTO `ref_desa` VALUES (3172, 159, 'MALINGGUT');
INSERT INTO `ref_desa` VALUES (3173, 159, 'MALUINGGUT');
INSERT INTO `ref_desa` VALUES (3174, 159, 'MANGGIS CIANGSANA');
INSERT INTO `ref_desa` VALUES (3175, 159, 'MEAKARSARI');
INSERT INTO `ref_desa` VALUES (3176, 159, 'MEJARJAYA');
INSERT INTO `ref_desa` VALUES (3177, 159, 'MEKAKJAYA');
INSERT INTO `ref_desa` VALUES (3178, 159, 'MEKAR  SARI');
INSERT INTO `ref_desa` VALUES (3179, 159, 'MEKAR ALAM');
INSERT INTO `ref_desa` VALUES (3180, 159, 'MEKAR JAYA');
INSERT INTO `ref_desa` VALUES (3181, 159, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (3182, 159, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (3183, 159, 'MGL');
INSERT INTO `ref_desa` VALUES (3184, 159, 'NAGLASARI');
INSERT INTO `ref_desa` VALUES (3185, 159, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (3186, 159, 'NAGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (3187, 159, 'NAGRAK UTARA');
INSERT INTO `ref_desa` VALUES (3188, 159, 'NBOJONG');
INSERT INTO `ref_desa` VALUES (3189, 159, 'NEAGLASARI');
INSERT INTO `ref_desa` VALUES (3190, 159, 'NEGALASARI');
INSERT INTO `ref_desa` VALUES (3191, 159, 'NEGKASARI');
INSERT INTO `ref_desa` VALUES (3192, 159, 'NEGLA SARI');
INSERT INTO `ref_desa` VALUES (3193, 159, 'NEGLASARI CAIBADAK');
INSERT INTO `ref_desa` VALUES (3194, 159, 'NEGLASAZRI');
INSERT INTO `ref_desa` VALUES (3195, 159, 'NEGLASRI');
INSERT INTO `ref_desa` VALUES (3196, 159, 'NEGLASSARI');
INSERT INTO `ref_desa` VALUES (3197, 159, 'NEGLSARI');
INSERT INTO `ref_desa` VALUES (3198, 159, 'NEGRA SARI');
INSERT INTO `ref_desa` VALUES (3199, 159, 'NEGRASALI');
INSERT INTO `ref_desa` VALUES (3200, 159, 'NJO JAYA');
INSERT INTO `ref_desa` VALUES (3201, 159, 'NRGLASARI');
INSERT INTO `ref_desa` VALUES (3202, 159, 'NYALINDUG');
INSERT INTO `ref_desa` VALUES (3203, 159, 'NYALINDUNG');
INSERT INTO `ref_desa` VALUES (3204, 159, 'ONGKRAK');
INSERT INTO `ref_desa` VALUES (3205, 159, 'ONGLAK');
INSERT INTO `ref_desa` VALUES (3206, 159, 'ONGRAK');
INSERT INTO `ref_desa` VALUES (3207, 159, 'ONRAK');
INSERT INTO `ref_desa` VALUES (3208, 159, 'P.RATU');
INSERT INTO `ref_desa` VALUES (3209, 159, 'PA;ASARI GIRANG');
INSERT INTO `ref_desa` VALUES (3210, 159, 'PABUARAB');
INSERT INTO `ref_desa` VALUES (3211, 159, 'PABUARAN');
INSERT INTO `ref_desa` VALUES (3212, 159, 'PADA ASIH');
INSERT INTO `ref_desa` VALUES (3213, 159, 'PAGELARAN');
INSERT INTO `ref_desa` VALUES (3214, 159, 'PALAMARTA');
INSERT INTO `ref_desa` VALUES (3215, 159, 'PALASARI GIRANG');
INSERT INTO `ref_desa` VALUES (3216, 159, 'PALASARI HILIR');
INSERT INTO `ref_desa` VALUES (3217, 159, 'PALEDANG');
INSERT INTO `ref_desa` VALUES (3218, 159, 'PAMARUYAN');
INSERT INTO `ref_desa` VALUES (3219, 159, 'PAMAURUYAN');
INSERT INTO `ref_desa` VALUES (3220, 159, 'PAMIRUYAN');
INSERT INTO `ref_desa` VALUES (3221, 159, 'PAMIURUYAN');
INSERT INTO `ref_desa` VALUES (3222, 159, 'PAMIYAN');
INSERT INTO `ref_desa` VALUES (3223, 159, 'PAMJURUYAN');
INSERT INTO `ref_desa` VALUES (3224, 159, 'PAMRUYAN');
INSERT INTO `ref_desa` VALUES (3225, 159, 'PAMUJRUYAN');
INSERT INTO `ref_desa` VALUES (3226, 159, 'PAMUR7YAN');
INSERT INTO `ref_desa` VALUES (3227, 159, 'PAMURAUYAN');
INSERT INTO `ref_desa` VALUES (3228, 159, 'PAMURAYAN');
INSERT INTO `ref_desa` VALUES (3229, 159, 'PAMURIUYAN');
INSERT INTO `ref_desa` VALUES (3230, 159, 'PAMURUAYN');
INSERT INTO `ref_desa` VALUES (3231, 159, 'PAMURUN');
INSERT INTO `ref_desa` VALUES (3232, 159, 'PAMURUYAB');
INSERT INTO `ref_desa` VALUES (3233, 159, 'PAMURUYAN CIADAKI');
INSERT INTO `ref_desa` VALUES (3234, 159, 'PAMURUYAN,');
INSERT INTO `ref_desa` VALUES (3235, 159, 'PAMURUYANA');
INSERT INTO `ref_desa` VALUES (3236, 159, 'PAMURUYANCIBADAK');
INSERT INTO `ref_desa` VALUES (3237, 159, 'PAMURUYANH');
INSERT INTO `ref_desa` VALUES (3238, 159, 'PAMURUYANN');
INSERT INTO `ref_desa` VALUES (3239, 159, 'PAMURUYN');
INSERT INTO `ref_desa` VALUES (3240, 159, 'PAMURUYNA');
INSERT INTO `ref_desa` VALUES (3241, 159, 'PAMURYAN');
INSERT INTO `ref_desa` VALUES (3242, 159, 'PAMURYNA');
INSERT INTO `ref_desa` VALUES (3243, 159, 'PAMUTRUYAN');
INSERT INTO `ref_desa` VALUES (3244, 159, 'PAMUTUYAN');
INSERT INTO `ref_desa` VALUES (3245, 159, 'PAMUURUYAN');
INSERT INTO `ref_desa` VALUES (3246, 159, 'PAMUURYAN');
INSERT INTO `ref_desa` VALUES (3247, 159, 'PAMUYA');
INSERT INTO `ref_desa` VALUES (3248, 159, 'PAMUYUYAN');
INSERT INTO `ref_desa` VALUES (3249, 159, 'PANAGAN');
INSERT INTO `ref_desa` VALUES (3250, 159, 'PANANAHAN');
INSERT INTO `ref_desa` VALUES (3251, 159, 'PANCALIKAN');
INSERT INTO `ref_desa` VALUES (3252, 159, 'PANGADENGAN');
INSERT INTO `ref_desa` VALUES (3253, 159, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (3254, 159, 'PANJALU');
INSERT INTO `ref_desa` VALUES (3255, 159, 'PANURUYAN');
INSERT INTO `ref_desa` VALUES (3256, 159, 'PANYINDANGAN');
INSERT INTO `ref_desa` VALUES (3257, 159, 'PANYINMDANGAN');
INSERT INTO `ref_desa` VALUES (3258, 159, 'PANYUSUHAN');
INSERT INTO `ref_desa` VALUES (3259, 159, 'PAPANAHAN');
INSERT INTO `ref_desa` VALUES (3260, 159, 'PARAKANSALAK');
INSERT INTO `ref_desa` VALUES (3261, 159, 'PAREANG');
INSERT INTO `ref_desa` VALUES (3262, 159, 'PARIS');
INSERT INTO `ref_desa` VALUES (3263, 159, 'PARMURUYAN');
INSERT INTO `ref_desa` VALUES (3264, 159, 'PARUNG BALIUNG');
INSERT INTO `ref_desa` VALUES (3265, 159, 'PAS POGOR');
INSERT INTO `ref_desa` VALUES (3266, 159, 'PASAR');
INSERT INTO `ref_desa` VALUES (3267, 159, 'PASAR HEUBEL');
INSERT INTO `ref_desa` VALUES (3268, 159, 'PASIR ANGIN');
INSERT INTO `ref_desa` VALUES (3269, 159, 'PASIR BADAK');
INSERT INTO `ref_desa` VALUES (3270, 159, 'PASIR DATAR');
INSERT INTO `ref_desa` VALUES (3271, 159, 'PASIR DOTON');
INSERT INTO `ref_desa` VALUES (3272, 159, 'PASIR JENJING');
INSERT INTO `ref_desa` VALUES (3273, 159, 'PASIR KIARA');
INSERT INTO `ref_desa` VALUES (3274, 159, 'PASIR KOLOTOK');
INSERT INTO `ref_desa` VALUES (3275, 159, 'PASIR MUNCANG');
INSERT INTO `ref_desa` VALUES (3276, 159, 'PASIR SERUM');
INSERT INTO `ref_desa` VALUES (3277, 159, 'PASIR SIREM');
INSERT INTO `ref_desa` VALUES (3278, 159, 'PASIR SIREMM');
INSERT INTO `ref_desa` VALUES (3279, 159, 'PASIR SIREUM');
INSERT INTO `ref_desa` VALUES (3280, 159, 'PASIRKOLOTOK');
INSERT INTO `ref_desa` VALUES (3281, 159, 'PASIRSUREN');
INSERT INTO `ref_desa` VALUES (3282, 159, 'PASKO');
INSERT INTO `ref_desa` VALUES (3283, 159, 'PAURUYAN');
INSERT INTO `ref_desa` VALUES (3284, 159, 'PDK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (3285, 159, 'PINANGGADING');
INSERT INTO `ref_desa` VALUES (3286, 159, 'PINTU');
INSERT INTO `ref_desa` VALUES (3287, 159, 'PMURUYAN');
INSERT INTO `ref_desa` VALUES (3288, 159, 'POASIR JATI');
INSERT INTO `ref_desa` VALUES (3289, 159, 'POJIK');
INSERT INTO `ref_desa` VALUES (3290, 159, 'POJOK');
INSERT INTO `ref_desa` VALUES (3291, 159, 'POJOK IDAH');
INSERT INTO `ref_desa` VALUES (3292, 159, 'POJOK INDAH');
INSERT INTO `ref_desa` VALUES (3293, 159, 'POJOKINDAH');
INSERT INTO `ref_desa` VALUES (3294, 159, 'POLSEK');
INSERT INTO `ref_desa` VALUES (3295, 159, 'PONDOK KAS LANDEUH');
INSERT INTO `ref_desa` VALUES (3296, 159, 'PONDOK KASO');
INSERT INTO `ref_desa` VALUES (3297, 159, 'PONDOK KASO TENGAH');
INSERT INTO `ref_desa` VALUES (3298, 159, 'PONDOK KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (3299, 159, 'PONDOK KASOM TENGAH');
INSERT INTO `ref_desa` VALUES (3300, 159, 'PONDOK LENGSIR');
INSERT INTO `ref_desa` VALUES (3301, 159, 'PONDOK LENSIR');
INSERT INTO `ref_desa` VALUES (3302, 159, 'PONDOK TIDUK');
INSERT INTO `ref_desa` VALUES (3303, 159, 'PONDOK TISU');
INSERT INTO `ref_desa` VALUES (3304, 159, 'PONDOK TISUK');
INSERT INTO `ref_desa` VALUES (3305, 159, 'PONDOKKASOTENGAH');
INSERT INTO `ref_desa` VALUES (3306, 159, 'PONDOKLEUNGSIR');
INSERT INTO `ref_desa` VALUES (3307, 159, 'POSKO');
INSERT INTO `ref_desa` VALUES (3308, 159, 'PPAMURUYAN');
INSERT INTO `ref_desa` VALUES (3309, 159, 'PR KUDA');
INSERT INTO `ref_desa` VALUES (3310, 159, 'PS JENJING');
INSERT INTO `ref_desa` VALUES (3311, 159, 'PS RARANGAN');
INSERT INTO `ref_desa` VALUES (3312, 159, 'PSBL PALAMARTA');
INSERT INTO `ref_desa` VALUES (3313, 159, 'PSR. KOLOTOK');
INSERT INTO `ref_desa` VALUES (3314, 159, 'PT BAJU INDAH');
INSERT INTO `ref_desa` VALUES (3315, 159, 'PT MGL');
INSERT INTO `ref_desa` VALUES (3316, 159, 'PT MUARA TUNGGAL');
INSERT INTO `ref_desa` VALUES (3317, 159, 'PT PAPARTI');
INSERT INTO `ref_desa` VALUES (3318, 159, 'PT PUALAN');
INSERT INTO `ref_desa` VALUES (3319, 159, 'PURWASARI');
INSERT INTO `ref_desa` VALUES (3320, 159, 'P[AMURUYAN');
INSERT INTO `ref_desa` VALUES (3321, 159, 'RAWA BUMIN');
INSERT INTO `ref_desa` VALUES (3322, 159, 'RS SEKARWANGI');
INSERT INTO `ref_desa` VALUES (3323, 159, 'RSU SEKARWANGI');
INSERT INTO `ref_desa` VALUES (3324, 159, 'RSUD SEKARWANGI');
INSERT INTO `ref_desa` VALUES (3325, 159, 'S3AKARWANGI');
INSERT INTO `ref_desa` VALUES (3326, 159, 'SAKRWANGI');
INSERT INTO `ref_desa` VALUES (3327, 159, 'SALA KOPI');
INSERT INTO `ref_desa` VALUES (3328, 159, 'SALAJAMBE');
INSERT INTO `ref_desa` VALUES (3329, 159, 'SALAKOPI');
INSERT INTO `ref_desa` VALUES (3330, 159, 'SALAMANJAH');
INSERT INTO `ref_desa` VALUES (3331, 159, 'SALAWAI');
INSERT INTO `ref_desa` VALUES (3332, 159, 'SATALAGA');
INSERT INTO `ref_desa` VALUES (3333, 159, 'SBATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (3334, 159, 'SCIBADAK');
INSERT INTO `ref_desa` VALUES (3335, 159, 'SCIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (3336, 159, 'SE KARWANGI');
INSERT INTO `ref_desa` VALUES (3337, 159, 'SEAGOG');
INSERT INTO `ref_desa` VALUES (3338, 159, 'SEAIKARWANGI');
INSERT INTO `ref_desa` VALUES (3339, 159, 'SEAKAAAAAARWANGI');
INSERT INTO `ref_desa` VALUES (3340, 159, 'SEAKAARWANGFI');
INSERT INTO `ref_desa` VALUES (3341, 159, 'SEAKAARWANGI');
INSERT INTO `ref_desa` VALUES (3342, 159, 'SEAKARANGI');
INSERT INTO `ref_desa` VALUES (3343, 159, 'SEAKAREWANGI');
INSERT INTO `ref_desa` VALUES (3344, 159, 'SEAKARWABGI');
INSERT INTO `ref_desa` VALUES (3345, 159, 'SEAKARWANGICIBADAK');
INSERT INTO `ref_desa` VALUES (3346, 159, 'SEAKARWNGI');
INSERT INTO `ref_desa` VALUES (3347, 159, 'SEAKRANGI');
INSERT INTO `ref_desa` VALUES (3348, 159, 'SEAKRAWANGI');
INSERT INTO `ref_desa` VALUES (3349, 159, 'SEAKRWAJGI');
INSERT INTO `ref_desa` VALUES (3350, 159, 'SEAKRWANFGI');
INSERT INTO `ref_desa` VALUES (3351, 159, 'SEAKRWANGI');
INSERT INTO `ref_desa` VALUES (3352, 159, 'SEAKRWNGI');
INSERT INTO `ref_desa` VALUES (3353, 159, 'SEALAGEBONG');
INSERT INTO `ref_desa` VALUES (3354, 159, 'SEALAKOPI');
INSERT INTO `ref_desa` VALUES (3355, 159, 'SEALAMANJAH');
INSERT INTO `ref_desa` VALUES (3356, 159, 'SEARWAGI');
INSERT INTO `ref_desa` VALUES (3357, 159, 'SEARWANGI');
INSERT INTO `ref_desa` VALUES (3358, 159, 'SEDONG');
INSERT INTO `ref_desa` VALUES (3359, 159, 'SEGOG');
INSERT INTO `ref_desa` VALUES (3360, 159, 'SEGOG HILIR');
INSERT INTO `ref_desa` VALUES (3361, 159, 'SEGOG KARATAE');
INSERT INTO `ref_desa` VALUES (3362, 159, 'SEKAERWANGI');
INSERT INTO `ref_desa` VALUES (3363, 159, 'SEKAEWANGI');
INSERT INTO `ref_desa` VALUES (3364, 159, 'SEKAR');
INSERT INTO `ref_desa` VALUES (3365, 159, 'SEKAR WANGI');
INSERT INTO `ref_desa` VALUES (3366, 159, 'SEKARANGI');
INSERT INTO `ref_desa` VALUES (3367, 159, 'SEKARAWANGI');
INSERT INTO `ref_desa` VALUES (3368, 159, 'SEKARAWNGI');
INSERT INTO `ref_desa` VALUES (3369, 159, 'SEKARSIRNA');
INSERT INTO `ref_desa` VALUES (3370, 159, 'SEKARTWANGI');
INSERT INTO `ref_desa` VALUES (3371, 159, 'SEKARWA NGI');
INSERT INTO `ref_desa` VALUES (3372, 159, 'SEKARWAANGI');
INSERT INTO `ref_desa` VALUES (3373, 159, 'SEKARWABGI');
INSERT INTO `ref_desa` VALUES (3374, 159, 'SEKARWACINGI');
INSERT INTO `ref_desa` VALUES (3375, 159, 'SEKARWAGI');
INSERT INTO `ref_desa` VALUES (3376, 159, 'SEKARWAMGI');
INSERT INTO `ref_desa` VALUES (3377, 159, 'SEKARWANAGI');
INSERT INTO `ref_desa` VALUES (3378, 159, 'SEKARWANG');
INSERT INTO `ref_desa` VALUES (3379, 159, 'SEKARWANGGI');
INSERT INTO `ref_desa` VALUES (3380, 159, 'SEKARWANGI.CIBADAK');
INSERT INTO `ref_desa` VALUES (3381, 159, 'SEKARWANGI?CIBADAK');
INSERT INTO `ref_desa` VALUES (3382, 159, 'SEKARWANGICIBADAK');
INSERT INTO `ref_desa` VALUES (3383, 159, 'SEKARWANGIO');
INSERT INTO `ref_desa` VALUES (3384, 159, 'SEKARWANGI]');
INSERT INTO `ref_desa` VALUES (3385, 159, 'SEKARWANGO');
INSERT INTO `ref_desa` VALUES (3386, 159, 'SEKARWANMGI');
INSERT INTO `ref_desa` VALUES (3387, 159, 'SEKARWANNGI');
INSERT INTO `ref_desa` VALUES (3388, 159, 'SEKARWNAGI');
INSERT INTO `ref_desa` VALUES (3389, 159, 'SEKARWNGI');
INSERT INTO `ref_desa` VALUES (3390, 159, 'SEKATWANGI');
INSERT INTO `ref_desa` VALUES (3391, 159, 'SEKAWANGI');
INSERT INTO `ref_desa` VALUES (3392, 159, 'SEKAWRANGI');
INSERT INTO `ref_desa` VALUES (3393, 159, 'SEKAWRWAGI');
INSERT INTO `ref_desa` VALUES (3394, 159, 'SEKAWRWANGI');
INSERT INTO `ref_desa` VALUES (3395, 159, 'SEKLARWANGI');
INSERT INTO `ref_desa` VALUES (3396, 159, 'SEKRANGI');
INSERT INTO `ref_desa` VALUES (3397, 159, 'SEKRARWANGI');
INSERT INTO `ref_desa` VALUES (3398, 159, 'SEKRAWANGI');
INSERT INTO `ref_desa` VALUES (3399, 159, 'SEKRNGI');
INSERT INTO `ref_desa` VALUES (3400, 159, 'SEKRWAGI');
INSERT INTO `ref_desa` VALUES (3401, 159, 'SEKRWANGI');
INSERT INTO `ref_desa` VALUES (3402, 159, 'SEKRWNGI');
INSERT INTO `ref_desa` VALUES (3403, 159, 'SEKRWQNGI');
INSERT INTO `ref_desa` VALUES (3404, 159, 'SELA AWI');
INSERT INTO `ref_desa` VALUES (3405, 159, 'SELA KOPI');
INSERT INTO `ref_desa` VALUES (3406, 159, 'SELAAWI');
INSERT INTO `ref_desa` VALUES (3407, 159, 'SELAAWI KARANG');
INSERT INTO `ref_desa` VALUES (3408, 159, 'SELAJADI');
INSERT INTO `ref_desa` VALUES (3409, 159, 'SELAJAMBE');
INSERT INTO `ref_desa` VALUES (3410, 159, 'SELAKOPI');
INSERT INTO `ref_desa` VALUES (3411, 159, 'SELAMAJAH');
INSERT INTO `ref_desa` VALUES (3412, 159, 'SELAMAJNJAH');
INSERT INTO `ref_desa` VALUES (3413, 159, 'SELAMANJAH');
INSERT INTO `ref_desa` VALUES (3414, 159, 'SELARWANGI');
INSERT INTO `ref_desa` VALUES (3415, 159, 'SELKARWANGI');
INSERT INTO `ref_desa` VALUES (3416, 159, 'SEMPUR');
INSERT INTO `ref_desa` VALUES (3417, 159, 'SENATOR');
INSERT INTO `ref_desa` VALUES (3418, 159, 'SERKARWANGI');
INSERT INTO `ref_desa` VALUES (3419, 159, 'SESEPAN');
INSERT INTO `ref_desa` VALUES (3420, 159, 'SESEUPAN');
INSERT INTO `ref_desa` VALUES (3421, 159, 'SEUSEUPAN');
INSERT INTO `ref_desa` VALUES (3422, 159, 'SEUSEUPANB');
INSERT INTO `ref_desa` VALUES (3423, 159, 'SIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (3424, 159, 'SIKAJADI');
INSERT INTO `ref_desa` VALUES (3425, 159, 'SIKASIRNA');
INSERT INTO `ref_desa` VALUES (3426, 159, 'SILIWANGI');
INSERT INTO `ref_desa` VALUES (3427, 159, 'SIMPENAN');
INSERT INTO `ref_desa` VALUES (3428, 159, 'SINAGARA');
INSERT INTO `ref_desa` VALUES (3429, 159, 'SINDANG ASIH');
INSERT INTO `ref_desa` VALUES (3430, 159, 'SINDANG LENGO');
INSERT INTO `ref_desa` VALUES (3431, 159, 'SIRNASARI');
INSERT INTO `ref_desa` VALUES (3432, 159, 'SIRTU SAEUR');
INSERT INTO `ref_desa` VALUES (3433, 159, 'SITSAEUR');
INSERT INTO `ref_desa` VALUES (3434, 159, 'SITU SAER');
INSERT INTO `ref_desa` VALUES (3435, 159, 'SITU SAEUR');
INSERT INTO `ref_desa` VALUES (3436, 159, 'SITUSAER');
INSERT INTO `ref_desa` VALUES (3437, 159, 'SITUSAEUR');
INSERT INTO `ref_desa` VALUES (3438, 159, 'SIUKASIRNA');
INSERT INTO `ref_desa` VALUES (3439, 159, 'SK SIRNA');
INSERT INTO `ref_desa` VALUES (3440, 159, 'SK WANGI');
INSERT INTO `ref_desa` VALUES (3441, 159, 'SK. WANGI');
INSERT INTO `ref_desa` VALUES (3442, 159, 'SKARWANGI');
INSERT INTO `ref_desa` VALUES (3443, 159, 'SKASIRNA');
INSERT INTO `ref_desa` VALUES (3444, 159, 'SLAKOPI');
INSERT INTO `ref_desa` VALUES (3445, 159, 'SRAKARWANGI');
INSERT INTO `ref_desa` VALUES (3446, 159, 'SREKARWANGI');
INSERT INTO `ref_desa` VALUES (3447, 159, 'SRKARWANGI');
INSERT INTO `ref_desa` VALUES (3448, 159, 'SSEGOG');
INSERT INTO `ref_desa` VALUES (3449, 159, 'STENJOJAYA');
INSERT INTO `ref_desa` VALUES (3450, 159, 'SUAKSIRNA');
INSERT INTO `ref_desa` VALUES (3451, 159, 'SUASIRNA');
INSERT INTO `ref_desa` VALUES (3452, 159, 'SUIKAMAJU');
INSERT INTO `ref_desa` VALUES (3453, 159, 'SUIKASIRNA');
INSERT INTO `ref_desa` VALUES (3454, 159, 'SUKA JADI');
INSERT INTO `ref_desa` VALUES (3455, 159, 'SUKA MAJU');
INSERT INTO `ref_desa` VALUES (3456, 159, 'SUKA MANAH');
INSERT INTO `ref_desa` VALUES (3457, 159, 'SUKA MULYA');
INSERT INTO `ref_desa` VALUES (3458, 159, 'SUKA SIRNA');
INSERT INTO `ref_desa` VALUES (3459, 159, 'SUKAASIRNA');
INSERT INTO `ref_desa` VALUES (3460, 159, 'SUKABAKTI');
INSERT INTO `ref_desa` VALUES (3461, 159, 'SUKADAMAI');
INSERT INTO `ref_desa` VALUES (3462, 159, 'SUKAIRNA');
INSERT INTO `ref_desa` VALUES (3463, 159, 'SUKAJAADI');
INSERT INTO `ref_desa` VALUES (3464, 159, 'SUKAJADAI');
INSERT INTO `ref_desa` VALUES (3465, 159, 'SUKAJADI');
INSERT INTO `ref_desa` VALUES (3466, 159, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (3467, 159, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (3468, 159, 'SUKAMANTRI');
INSERT INTO `ref_desa` VALUES (3469, 159, 'SUKAMJU');
INSERT INTO `ref_desa` VALUES (3470, 159, 'SUKAMULAYA');
INSERT INTO `ref_desa` VALUES (3471, 159, 'SUKAMULKYA');
INSERT INTO `ref_desa` VALUES (3472, 159, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (3473, 159, 'SUKARESMI');
INSERT INTO `ref_desa` VALUES (3474, 159, 'SUKARINA');
INSERT INTO `ref_desa` VALUES (3475, 159, 'SUKARIRNA');
INSERT INTO `ref_desa` VALUES (3476, 159, 'SUKARSIRNA');
INSERT INTO `ref_desa` VALUES (3477, 159, 'SUKARSIRNS');
INSERT INTO `ref_desa` VALUES (3478, 159, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (3479, 159, 'SUKASIERNA');
INSERT INTO `ref_desa` VALUES (3480, 159, 'SUKASINA');
INSERT INTO `ref_desa` VALUES (3481, 159, 'SUKASIRA');
INSERT INTO `ref_desa` VALUES (3482, 159, 'SUKASIRANA');
INSERT INTO `ref_desa` VALUES (3483, 159, 'SUKASIRENA');
INSERT INTO `ref_desa` VALUES (3484, 159, 'SUKASIRJMA');
INSERT INTO `ref_desa` VALUES (3485, 159, 'SUKASIRMA');
INSERT INTO `ref_desa` VALUES (3486, 159, 'SUKASIRMNA');
INSERT INTO `ref_desa` VALUES (3487, 159, 'SUKASIRNA .');
INSERT INTO `ref_desa` VALUES (3488, 159, 'SUKASIRNAH');
INSERT INTO `ref_desa` VALUES (3489, 159, 'SUKASIRNAS');
INSERT INTO `ref_desa` VALUES (3490, 159, 'SUKASORNA');
INSERT INTO `ref_desa` VALUES (3491, 159, 'SUKASRNA');
INSERT INTO `ref_desa` VALUES (3492, 159, 'SUKASSIRNA');
INSERT INTO `ref_desa` VALUES (3493, 159, 'SUKASURNA');
INSERT INTO `ref_desa` VALUES (3494, 159, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (3495, 159, 'SUKMAJU');
INSERT INTO `ref_desa` VALUES (3496, 159, 'SUKQSIMNA');
INSERT INTO `ref_desa` VALUES (3497, 159, 'SUKSASIRNA');
INSERT INTO `ref_desa` VALUES (3498, 159, 'SUKSIARNA');
INSERT INTO `ref_desa` VALUES (3499, 159, 'SUKSIRNA');
INSERT INTO `ref_desa` VALUES (3500, 159, 'SUMAKAJU');
INSERT INTO `ref_desa` VALUES (3501, 159, 'SUNDA WENANG');
INSERT INTO `ref_desa` VALUES (3502, 159, 'SUNDAWENANG');
INSERT INTO `ref_desa` VALUES (3503, 159, 'SWEKARWANGI');
INSERT INTO `ref_desa` VALUES (3504, 159, 'TAJUNGSARI');
INSERT INTO `ref_desa` VALUES (3505, 159, 'TALAGA');
INSERT INTO `ref_desa` VALUES (3506, 159, 'TALUN');
INSERT INTO `ref_desa` VALUES (3507, 159, 'TAMAN SARI');
INSERT INTO `ref_desa` VALUES (3508, 159, 'TANGJUNG SARI');
INSERT INTO `ref_desa` VALUES (3509, 159, 'TANIUNGSARI');
INSERT INTO `ref_desa` VALUES (3510, 159, 'TANJOJAYA');
INSERT INTO `ref_desa` VALUES (3511, 159, 'TANJUNG  SARI');
INSERT INTO `ref_desa` VALUES (3512, 159, 'TANJUNG JAYA');
INSERT INTO `ref_desa` VALUES (3513, 159, 'TANJUNG SARI');
INSERT INTO `ref_desa` VALUES (3514, 159, 'TANJUNGSARI');
INSERT INTO `ref_desa` VALUES (3515, 159, 'TANUJNG SARI');
INSERT INTO `ref_desa` VALUES (3516, 159, 'TAPOS');
INSERT INTO `ref_desa` VALUES (3517, 159, 'TARENGTONG');
INSERT INTO `ref_desa` VALUES (3518, 159, 'TEANJOJAYA');
INSERT INTO `ref_desa` VALUES (3519, 159, 'TEBAJOJAYA');
INSERT INTO `ref_desa` VALUES (3520, 159, 'TEBJOJAYA');
INSERT INTO `ref_desa` VALUES (3521, 159, 'TEBNJO JAYA');
INSERT INTO `ref_desa` VALUES (3522, 159, 'TEJOJAYA');
INSERT INTO `ref_desa` VALUES (3523, 159, 'TEMJO JAYA');
INSERT INTO `ref_desa` VALUES (3524, 159, 'TEMJOJAYA');
INSERT INTO `ref_desa` VALUES (3525, 159, 'TEMNJPOJAYA');
INSERT INTO `ref_desa` VALUES (3526, 159, 'TENJAOJAYA');
INSERT INTO `ref_desa` VALUES (3527, 159, 'TENJAYA');
INSERT INTO `ref_desa` VALUES (3528, 159, 'TENJO AYU');
INSERT INTO `ref_desa` VALUES (3529, 159, 'TENJO JAYA');
INSERT INTO `ref_desa` VALUES (3530, 159, 'TENJO JAYA]');
INSERT INTO `ref_desa` VALUES (3531, 159, 'TENJO LAYA');
INSERT INTO `ref_desa` VALUES (3532, 159, 'TENJOAJAYA');
INSERT INTO `ref_desa` VALUES (3533, 159, 'TENJOJYA');
INSERT INTO `ref_desa` VALUES (3534, 159, 'TENJOLAYA');
INSERT INTO `ref_desa` VALUES (3535, 159, 'TG SARI');
INSERT INTO `ref_desa` VALUES (3536, 159, 'TIPAR');
INSERT INTO `ref_desa` VALUES (3537, 159, 'TIPARCIBADAK');
INSERT INTO `ref_desa` VALUES (3538, 159, 'TONJOJAYA');
INSERT INTO `ref_desa` VALUES (3539, 159, 'TUGU');
INSERT INTO `ref_desa` VALUES (3540, 159, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (3541, 159, 'UKASIRNA');
INSERT INTO `ref_desa` VALUES (3542, 159, 'WAAAAAARNAJATI');
INSERT INTO `ref_desa` VALUES (3543, 159, 'WAAAAARNAJATI');
INSERT INTO `ref_desa` VALUES (3544, 159, 'WANAJATI');
INSERT INTO `ref_desa` VALUES (3545, 159, 'WANANA JATI');
INSERT INTO `ref_desa` VALUES (3546, 159, 'WANGUN');
INSERT INTO `ref_desa` VALUES (3547, 159, 'WANGUNJAYA');
INSERT INTO `ref_desa` VALUES (3548, 159, 'WARANAJATI');
INSERT INTO `ref_desa` VALUES (3549, 159, 'WARANAJATIWARJ');
INSERT INTO `ref_desa` VALUES (3550, 159, 'WARNA BAKTI');
INSERT INTO `ref_desa` VALUES (3551, 159, 'WARNA JATAI');
INSERT INTO `ref_desa` VALUES (3552, 159, 'WARNA JATI');
INSERT INTO `ref_desa` VALUES (3553, 159, 'WARNA JAYA');
INSERT INTO `ref_desa` VALUES (3554, 159, 'WARNA MUKTI');
INSERT INTO `ref_desa` VALUES (3555, 159, 'WARNA NJATI');
INSERT INTO `ref_desa` VALUES (3556, 159, 'WARNA SARI');
INSERT INTO `ref_desa` VALUES (3557, 159, 'WARNAJTI');
INSERT INTO `ref_desa` VALUES (3558, 159, 'WARNJATI');
INSERT INTO `ref_desa` VALUES (3559, 159, 'WARTERKERAN');
INSERT INTO `ref_desa` VALUES (3560, 159, 'WARUNG BANTEN');
INSERT INTO `ref_desa` VALUES (3561, 159, 'WARUNG KIARA');
INSERT INTO `ref_desa` VALUES (3562, 159, 'WARUNGBANTEN');
INSERT INTO `ref_desa` VALUES (3563, 159, 'WATES AJAYA');
INSERT INTO `ref_desa` VALUES (3564, 159, 'WATRNA JATI');
INSERT INTO `ref_desa` VALUES (3565, 159, 'WATRNAJATI');
INSERT INTO `ref_desa` VALUES (3566, 159, 'YAEANJOJAYA');
INSERT INTO `ref_desa` VALUES (3567, 633, 'BANYU MURNI');
INSERT INTO `ref_desa` VALUES (3568, 633, 'BANYU WANGI');
INSERT INTO `ref_desa` VALUES (3569, 633, 'BAYU MURNI');
INSERT INTO `ref_desa` VALUES (3570, 633, 'BAYUWANGI');
INSERT INTO `ref_desa` VALUES (3571, 633, 'CIKARANG BARAT');
INSERT INTO `ref_desa` VALUES (3572, 633, 'CITANGLAR');
INSERT INTO `ref_desa` VALUES (3573, 633, 'JAMPANG');
INSERT INTO `ref_desa` VALUES (3574, 633, 'TALAGA BODAS');
INSERT INTO `ref_desa` VALUES (3575, 633, 'TALAGA MURNI');
INSERT INTO `ref_desa` VALUES (3576, 633, 'TELAGA MURNI');
INSERT INTO `ref_desa` VALUES (3577, 161, 'BANTAR KALONG');
INSERT INTO `ref_desa` VALUES (3578, 161, 'BOJONGGENTENG');
INSERT INTO `ref_desa` VALUES (3579, 163, 'BENTENG');
INSERT INTO `ref_desa` VALUES (3580, 590, 'CICANTAYAN');
INSERT INTO `ref_desa` VALUES (3581, 591, '01-APR');
INSERT INTO `ref_desa` VALUES (3582, 591, '3');
INSERT INTO `ref_desa` VALUES (3583, 591, 'ANTYAN');
INSERT INTO `ref_desa` VALUES (3584, 591, 'B OJONGGENTENG');
INSERT INTO `ref_desa` VALUES (3585, 591, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (3586, 591, 'BABAKAN TIPAR');
INSERT INTO `ref_desa` VALUES (3587, 591, 'BANTAR KARET');
INSERT INTO `ref_desa` VALUES (3588, 591, 'BANTARAKARET');
INSERT INTO `ref_desa` VALUES (3589, 591, 'BANTARKARET');
INSERT INTO `ref_desa` VALUES (3590, 591, 'BANTERKARET');
INSERT INTO `ref_desa` VALUES (3591, 591, 'BATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (3592, 591, 'BBAKAN TIPAR');
INSERT INTO `ref_desa` VALUES (3593, 591, 'BENDA');
INSERT INTO `ref_desa` VALUES (3594, 591, 'BNTARKARET');
INSERT INTO `ref_desa` VALUES (3595, 591, 'BOJONG');
INSERT INTO `ref_desa` VALUES (3596, 591, 'CANATAYAN');
INSERT INTO `ref_desa` VALUES (3597, 591, 'CANTANYAN');
INSERT INTO `ref_desa` VALUES (3598, 591, 'CANTAYAAN');
INSERT INTO `ref_desa` VALUES (3599, 591, 'CANTAYAN');
INSERT INTO `ref_desa` VALUES (3600, 591, 'CANTAYNA');
INSERT INTO `ref_desa` VALUES (3601, 591, 'CANYATAYAN');
INSERT INTO `ref_desa` VALUES (3602, 591, 'CANYTAYAN');
INSERT INTO `ref_desa` VALUES (3603, 591, 'CARIGIN');
INSERT INTO `ref_desa` VALUES (3604, 591, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (3605, 591, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (3606, 591, 'CASANDE');
INSERT INTO `ref_desa` VALUES (3607, 591, 'CATAYA');
INSERT INTO `ref_desa` VALUES (3608, 591, 'CCANTAYAN');
INSERT INTO `ref_desa` VALUES (3609, 591, 'CCIANTAYAN');
INSERT INTO `ref_desa` VALUES (3610, 591, 'CCISANDE HILIR');
INSERT INTO `ref_desa` VALUES (3611, 591, 'CHEULANG');
INSERT INTO `ref_desa` VALUES (3612, 591, 'CIALINGAN');
INSERT INTO `ref_desa` VALUES (3613, 591, 'CIAMHI');
INSERT INTO `ref_desa` VALUES (3614, 591, 'CIANDE');
INSERT INTO `ref_desa` VALUES (3615, 591, 'CIANTAYAN');
INSERT INTO `ref_desa` VALUES (3616, 591, 'CIAWI');
INSERT INTO `ref_desa` VALUES (3617, 591, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (3618, 591, 'CIBALUNG');
INSERT INTO `ref_desa` VALUES (3619, 591, 'CIBARAJA');
INSERT INTO `ref_desa` VALUES (3620, 591, 'CIBARONGBOK');
INSERT INTO `ref_desa` VALUES (3621, 591, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (3622, 591, 'CIBOLANG');
INSERT INTO `ref_desa` VALUES (3623, 591, 'CIBOLANG KALER');
INSERT INTO `ref_desa` VALUES (3624, 591, 'CICABTYAN');
INSERT INTO `ref_desa` VALUES (3625, 591, 'CICACNTYAN');
INSERT INTO `ref_desa` VALUES (3626, 591, 'CICADAS');
INSERT INTO `ref_desa` VALUES (3627, 591, 'CICAJNTAYAN');
INSERT INTO `ref_desa` VALUES (3628, 591, 'CICANATAYAN');
INSERT INTO `ref_desa` VALUES (3629, 591, 'CICANATYA');
INSERT INTO `ref_desa` VALUES (3630, 591, 'CICANTAUYNA');
INSERT INTO `ref_desa` VALUES (3631, 591, 'CICANTAYA');
INSERT INTO `ref_desa` VALUES (3632, 591, 'CICANTAYAYAN');
INSERT INTO `ref_desa` VALUES (3633, 591, 'CICANTAYN');
INSERT INTO `ref_desa` VALUES (3634, 591, 'CICANTAYNA');
INSERT INTO `ref_desa` VALUES (3635, 591, 'CICANTRAYA');
INSERT INTO `ref_desa` VALUES (3636, 591, 'CICANTYAAN');
INSERT INTO `ref_desa` VALUES (3637, 591, 'CICANTYAB');
INSERT INTO `ref_desa` VALUES (3638, 591, 'CICANTYAN');
INSERT INTO `ref_desa` VALUES (3639, 591, 'CICANYATAN');
INSERT INTO `ref_desa` VALUES (3640, 591, 'CICANYAYAN');
INSERT INTO `ref_desa` VALUES (3641, 591, 'CICANYTAYAN');
INSERT INTO `ref_desa` VALUES (3642, 591, 'CICAREUH');
INSERT INTO `ref_desa` VALUES (3643, 591, 'CICATAYAN');
INSERT INTO `ref_desa` VALUES (3644, 591, 'CICCANTAYAN');
INSERT INTO `ref_desa` VALUES (3645, 591, 'CICNTAYAN');
INSERT INTO `ref_desa` VALUES (3646, 591, 'CICNTYAN');
INSERT INTO `ref_desa` VALUES (3647, 591, 'CICNYAYAN');
INSERT INTO `ref_desa` VALUES (3648, 591, 'CICOHAG');
INSERT INTO `ref_desa` VALUES (3649, 591, 'CICSANDE');
INSERT INTO `ref_desa` VALUES (3650, 591, 'CICURUG');
INSERT INTO `ref_desa` VALUES (3651, 591, 'CIDANDE');
INSERT INTO `ref_desa` VALUES (3652, 591, 'CIDSANDE');
INSERT INTO `ref_desa` VALUES (3653, 591, 'CIGENTENG');
INSERT INTO `ref_desa` VALUES (3654, 591, 'CIHAMERANG');
INSERT INTO `ref_desa` VALUES (3655, 591, 'CIHAUR');
INSERT INTO `ref_desa` VALUES (3656, 591, 'CIHAWUR');
INSERT INTO `ref_desa` VALUES (3657, 591, 'CIHEULANG');
INSERT INTO `ref_desa` VALUES (3658, 591, 'CIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (3659, 591, 'CIHMAHI');
INSERT INTO `ref_desa` VALUES (3660, 591, 'CIJABON');
INSERT INTO `ref_desa` VALUES (3661, 591, 'CIJALAINGAN');
INSERT INTO `ref_desa` VALUES (3662, 591, 'CIJALIAN');
INSERT INTO `ref_desa` VALUES (3663, 591, 'CIJALIANGAN');
INSERT INTO `ref_desa` VALUES (3664, 591, 'CIJALIGAN');
INSERT INTO `ref_desa` VALUES (3665, 591, 'CIJALINAGAN');
INSERT INTO `ref_desa` VALUES (3666, 591, 'CIJALINAGN');
INSERT INTO `ref_desa` VALUES (3667, 591, 'CIJALINFDAN');
INSERT INTO `ref_desa` VALUES (3668, 591, 'CIJALINGAHN');
INSERT INTO `ref_desa` VALUES (3669, 591, 'CIJALINGAN.');
INSERT INTO `ref_desa` VALUES (3670, 591, 'CIJALINGN');
INSERT INTO `ref_desa` VALUES (3671, 591, 'CIJALINGNA');
INSERT INTO `ref_desa` VALUES (3672, 591, 'CIJALIONGAN');
INSERT INTO `ref_desa` VALUES (3673, 591, 'CIJALUINGAN');
INSERT INTO `ref_desa` VALUES (3674, 591, 'CIJANTAYAN');
INSERT INTO `ref_desa` VALUES (3675, 591, 'CIJARINGAN');
INSERT INTO `ref_desa` VALUES (3676, 591, 'CIJATI');
INSERT INTO `ref_desa` VALUES (3677, 591, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (3678, 591, 'CIJLAINGAN');
INSERT INTO `ref_desa` VALUES (3679, 591, 'CIJLINGAN');
INSERT INTO `ref_desa` VALUES (3680, 591, 'CIJLINGNA');
INSERT INTO `ref_desa` VALUES (3681, 591, 'CIKAREO');
INSERT INTO `ref_desa` VALUES (3682, 591, 'CIKJALINGAN');
INSERT INTO `ref_desa` VALUES (3683, 591, 'CIKONDANG');
INSERT INTO `ref_desa` VALUES (3684, 591, 'CIKONDNG');
INSERT INTO `ref_desa` VALUES (3685, 591, 'CIKPNDANG');
INSERT INTO `ref_desa` VALUES (3686, 591, 'CIKUKULI');
INSERT INTO `ref_desa` VALUES (3687, 591, 'CIKUKULLU');
INSERT INTO `ref_desa` VALUES (3688, 591, 'CIKUKULU');
INSERT INTO `ref_desa` VALUES (3689, 591, 'CIKUL;U');
INSERT INTO `ref_desa` VALUES (3690, 591, 'CIKULU');
INSERT INTO `ref_desa` VALUES (3691, 591, 'CILAJLINGAN');
INSERT INTO `ref_desa` VALUES (3692, 591, 'CILALINGAN');
INSERT INTO `ref_desa` VALUES (3693, 591, 'CILIBANG');
INSERT INTO `ref_desa` VALUES (3694, 591, 'CILUBANG');
INSERT INTO `ref_desa` VALUES (3695, 591, 'CIMAHAI');
INSERT INTO `ref_desa` VALUES (3696, 591, 'CIMAHI .');
INSERT INTO `ref_desa` VALUES (3697, 591, 'CIMAHI CISAAT');
INSERT INTO `ref_desa` VALUES (3698, 591, 'CIMAHIO');
INSERT INTO `ref_desa` VALUES (3699, 591, 'CIMAHIU');
INSERT INTO `ref_desa` VALUES (3700, 591, 'CIMAHI]CICANTAYAN');
INSERT INTO `ref_desa` VALUES (3701, 591, 'CIMAI');
INSERT INTO `ref_desa` VALUES (3702, 591, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (3703, 591, 'CIMHI');
INSERT INTO `ref_desa` VALUES (3704, 591, 'CIMUNCANG');
INSERT INTO `ref_desa` VALUES (3705, 591, 'CIOSANDE');
INSERT INTO `ref_desa` VALUES (3706, 591, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (3707, 591, 'CIPERUE');
INSERT INTO `ref_desa` VALUES (3708, 591, 'CIPUNTANG');
INSERT INTO `ref_desa` VALUES (3709, 591, 'CIROYOM');
INSERT INTO `ref_desa` VALUES (3710, 591, 'CISABDE');
INSERT INTO `ref_desa` VALUES (3711, 591, 'CISABNDE');
INSERT INTO `ref_desa` VALUES (3712, 591, 'CISADE');
INSERT INTO `ref_desa` VALUES (3713, 591, 'CISAJDE');
INSERT INTO `ref_desa` VALUES (3714, 591, 'CISANADE');
INSERT INTO `ref_desa` VALUES (3715, 591, 'CISAND');
INSERT INTO `ref_desa` VALUES (3716, 591, 'CISANDE HIKLIR');
INSERT INTO `ref_desa` VALUES (3717, 591, 'CISANDE HILIR');
INSERT INTO `ref_desa` VALUES (3718, 591, 'CISANDE HILIR CIBADAK');
INSERT INTO `ref_desa` VALUES (3719, 591, 'CISANDE I');
INSERT INTO `ref_desa` VALUES (3720, 591, 'CISANDEHILIR');
INSERT INTO `ref_desa` VALUES (3721, 591, 'CISANDEN');
INSERT INTO `ref_desa` VALUES (3722, 591, 'CISANDEU');
INSERT INTO `ref_desa` VALUES (3723, 591, 'CISARUA');
INSERT INTO `ref_desa` VALUES (3724, 591, 'CISDE');
INSERT INTO `ref_desa` VALUES (3725, 591, 'CISNDE');
INSERT INTO `ref_desa` VALUES (3726, 591, 'CISSANDE');
INSERT INTO `ref_desa` VALUES (3727, 591, 'CISSSANDE');
INSERT INTO `ref_desa` VALUES (3728, 591, 'CITOKET');
INSERT INTO `ref_desa` VALUES (3729, 591, 'CIVANTAYAN');
INSERT INTO `ref_desa` VALUES (3730, 591, 'CJALINGA');
INSERT INTO `ref_desa` VALUES (3731, 591, 'CJALINGAN');
INSERT INTO `ref_desa` VALUES (3732, 591, 'CJALINGN');
INSERT INTO `ref_desa` VALUES (3733, 591, 'CNATAYAN');
INSERT INTO `ref_desa` VALUES (3734, 591, 'CNTAYAN');
INSERT INTO `ref_desa` VALUES (3735, 591, 'CNTYN');
INSERT INTO `ref_desa` VALUES (3736, 591, 'CSANDE');
INSERT INTO `ref_desa` VALUES (3737, 591, 'CUCIKUKULU');
INSERT INTO `ref_desa` VALUES (3738, 591, 'EAMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3739, 591, 'EGARMANAH');
INSERT INTO `ref_desa` VALUES (3740, 591, 'GENTONG SALAJAMBE');
INSERT INTO `ref_desa` VALUES (3741, 591, 'GUNUNG GURUH');
INSERT INTO `ref_desa` VALUES (3742, 591, 'GUNUNGPUYUH');
INSERT INTO `ref_desa` VALUES (3743, 591, 'HAGAR MANAH');
INSERT INTO `ref_desa` VALUES (3744, 591, 'HAGARMANAH');
INSERT INTO `ref_desa` VALUES (3745, 591, 'HEAGARAMANAH');
INSERT INTO `ref_desa` VALUES (3746, 591, 'HEAGRMNAH');
INSERT INTO `ref_desa` VALUES (3747, 591, 'HEGAMANAH');
INSERT INTO `ref_desa` VALUES (3748, 591, 'HEGAR  MANAH');
INSERT INTO `ref_desa` VALUES (3749, 591, 'HEGAR MANAH');
INSERT INTO `ref_desa` VALUES (3750, 591, 'HEGARA MANAH');
INSERT INTO `ref_desa` VALUES (3751, 591, 'HEGARAMANAH');
INSERT INTO `ref_desa` VALUES (3752, 591, 'HEGARMANA');
INSERT INTO `ref_desa` VALUES (3753, 591, 'HEGARMANAG');
INSERT INTO `ref_desa` VALUES (3754, 591, 'HEGARNAMANAH');
INSERT INTO `ref_desa` VALUES (3755, 591, 'HEGARNANAH');
INSERT INTO `ref_desa` VALUES (3756, 591, 'HEGARNMANAH');
INSERT INTO `ref_desa` VALUES (3757, 591, 'HEGQRANAH');
INSERT INTO `ref_desa` VALUES (3758, 591, 'HEGRMANAH');
INSERT INTO `ref_desa` VALUES (3759, 591, 'HERGAMANAH');
INSERT INTO `ref_desa` VALUES (3760, 591, 'HRAGARAMANAH');
INSERT INTO `ref_desa` VALUES (3761, 591, 'IBARONGBOK');
INSERT INTO `ref_desa` VALUES (3762, 591, 'ICANTAYAN');
INSERT INTO `ref_desa` VALUES (3763, 591, 'IMAHI');
INSERT INTO `ref_desa` VALUES (3764, 591, 'JCIJALINGAN');
INSERT INTO `ref_desa` VALUES (3765, 591, 'KADU PUGUR');
INSERT INTO `ref_desa` VALUES (3766, 591, 'KADUDAMPIT');
INSERT INTO `ref_desa` VALUES (3767, 591, 'KADUPPUGUR');
INSERT INTO `ref_desa` VALUES (3768, 591, 'KADUPUDUR');
INSERT INTO `ref_desa` VALUES (3769, 591, 'KADUPUGUR');
INSERT INTO `ref_desa` VALUES (3770, 591, 'KADUPUIGUR');
INSERT INTO `ref_desa` VALUES (3771, 591, 'KARADENAN');
INSERT INTO `ref_desa` VALUES (3772, 591, 'KARANG  TENGAH');
INSERT INTO `ref_desa` VALUES (3773, 591, 'KB JATI');
INSERT INTO `ref_desa` VALUES (3774, 591, 'KD PUGUR');
INSERT INTO `ref_desa` VALUES (3775, 591, 'KEBON BERA');
INSERT INTO `ref_desa` VALUES (3776, 591, 'KEMBANG');
INSERT INTO `ref_desa` VALUES (3777, 591, 'KHEGARMANAH');
INSERT INTO `ref_desa` VALUES (3778, 591, 'KLB');
INSERT INTO `ref_desa` VALUES (3779, 591, 'KLEMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3780, 591, 'KLEMBUR SAWH');
INSERT INTO `ref_desa` VALUES (3781, 591, 'KP SAWAH');
INSERT INTO `ref_desa` VALUES (3782, 591, 'KT SIRNA');
INSERT INTO `ref_desa` VALUES (3783, 591, 'KUTA DAMAI');
INSERT INTO `ref_desa` VALUES (3784, 591, 'KUTASIRNA');
INSERT INTO `ref_desa` VALUES (3785, 591, 'L.');
INSERT INTO `ref_desa` VALUES (3786, 591, 'L;EMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3787, 591, 'LB SAWAH');
INSERT INTO `ref_desa` VALUES (3788, 591, 'LB. SAWAH');
INSERT INTO `ref_desa` VALUES (3789, 591, 'LBR. SAWAH');
INSERT INTO `ref_desa` VALUES (3790, 591, 'LEAMABUR SAWAH');
INSERT INTO `ref_desa` VALUES (3791, 591, 'LEAMABURJAMBI');
INSERT INTO `ref_desa` VALUES (3792, 591, 'LEAMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3793, 591, 'LEBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3794, 591, 'LEBURSAWAH');
INSERT INTO `ref_desa` VALUES (3795, 591, 'LEMABURSAWAH');
INSERT INTO `ref_desa` VALUES (3796, 591, 'LEMBAR');
INSERT INTO `ref_desa` VALUES (3797, 591, 'LEMBU SAWAH');
INSERT INTO `ref_desa` VALUES (3798, 591, 'LEMBUR ASWAH');
INSERT INTO `ref_desa` VALUES (3799, 591, 'LEMBUR JAMI');
INSERT INTO `ref_desa` VALUES (3800, 591, 'LEMBUR SAAWAH');
INSERT INTO `ref_desa` VALUES (3801, 591, 'LEMBUR SAWA DOYONG');
INSERT INTO `ref_desa` VALUES (3802, 591, 'LEMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3803, 591, 'LEMBUR SAWAH?CICANTAYAN');
INSERT INTO `ref_desa` VALUES (3804, 591, 'LEMBUR SAWAHDOYONG');
INSERT INTO `ref_desa` VALUES (3805, 591, 'LEMBUR SAWH');
INSERT INTO `ref_desa` VALUES (3806, 591, 'LEMBUR SWAH');
INSERT INTO `ref_desa` VALUES (3807, 591, 'LEMBURS AWAH');
INSERT INTO `ref_desa` VALUES (3808, 591, 'LEMBURSAWA');
INSERT INTO `ref_desa` VALUES (3809, 591, 'LEMBURSAWAH CANTAYAN');
INSERT INTO `ref_desa` VALUES (3810, 591, 'LEMBURSAWH');
INSERT INTO `ref_desa` VALUES (3811, 591, 'LEMBURSWAH');
INSERT INTO `ref_desa` VALUES (3812, 591, 'LEMBURWASAH');
INSERT INTO `ref_desa` VALUES (3813, 591, 'LEMBURWSAWAH 01');
INSERT INTO `ref_desa` VALUES (3814, 591, 'LEMBUSAWAH');
INSERT INTO `ref_desa` VALUES (3815, 591, 'LEMBUSRSAWAH');
INSERT INTO `ref_desa` VALUES (3816, 591, 'LEMBVUR SAWAH');
INSERT INTO `ref_desa` VALUES (3817, 591, 'LEMNBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3818, 591, 'LEMNUR SAWAH');
INSERT INTO `ref_desa` VALUES (3819, 591, 'LEMNURSAWAH');
INSERT INTO `ref_desa` VALUES (3820, 591, 'LEMNURWASAH');
INSERT INTO `ref_desa` VALUES (3821, 591, 'LEMUR SAWAH');
INSERT INTO `ref_desa` VALUES (3822, 591, 'LENBURSAWAH');
INSERT INTO `ref_desa` VALUES (3823, 591, 'LENMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3824, 591, 'LENMBURSAWAH');
INSERT INTO `ref_desa` VALUES (3825, 591, 'LERMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3826, 591, 'LEUMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3827, 591, 'LEUMBURSAWAH');
INSERT INTO `ref_desa` VALUES (3828, 591, 'LMBR SAWAH');
INSERT INTO `ref_desa` VALUES (3829, 591, 'LONGKEWANG');
INSERT INTO `ref_desa` VALUES (3830, 591, 'MANGGIS');
INSERT INTO `ref_desa` VALUES (3831, 591, 'MANGGIS GIRANG');
INSERT INTO `ref_desa` VALUES (3832, 591, 'MANGIS');
INSERT INTO `ref_desa` VALUES (3833, 591, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (3834, 591, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (3835, 591, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (3836, 591, 'NAGRAK UTARA');
INSERT INTO `ref_desa` VALUES (3837, 591, 'NAGROG');
INSERT INTO `ref_desa` VALUES (3838, 591, 'NAGROK');
INSERT INTO `ref_desa` VALUES (3839, 591, 'NANGEALA');
INSERT INTO `ref_desa` VALUES (3840, 591, 'NANGELA');
INSERT INTO `ref_desa` VALUES (3841, 591, 'NAROGONG');
INSERT INTO `ref_desa` VALUES (3842, 591, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (3843, 591, 'PADA ASIH');
INSERT INTO `ref_desa` VALUES (3844, 591, 'PADAASIH');
INSERT INTO `ref_desa` VALUES (3845, 591, 'PALEDANG');
INSERT INTO `ref_desa` VALUES (3846, 591, 'PAMURUYAN');
INSERT INTO `ref_desa` VALUES (3847, 591, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (3848, 591, 'PASIR ANGIN');
INSERT INTO `ref_desa` VALUES (3849, 591, 'PASIR POGOR');
INSERT INTO `ref_desa` VALUES (3850, 591, 'PASKIARA');
INSERT INTO `ref_desa` VALUES (3851, 591, 'PASWAHAN');
INSERT INTO `ref_desa` VALUES (3852, 591, 'PD LENSIR');
INSERT INTO `ref_desa` VALUES (3853, 591, 'PD.LENGSIR');
INSERT INTO `ref_desa` VALUES (3854, 591, 'PECANTILAN');
INSERT INTO `ref_desa` VALUES (3855, 591, 'PNDK LEUNGSIR');
INSERT INTO `ref_desa` VALUES (3856, 591, 'PONDOK LEMGDIR');
INSERT INTO `ref_desa` VALUES (3857, 591, 'PONDOK LENGSIR');
INSERT INTO `ref_desa` VALUES (3858, 591, 'PONDOK LEUNGSIR');
INSERT INTO `ref_desa` VALUES (3859, 591, 'PONDOKJ LENGSIR');
INSERT INTO `ref_desa` VALUES (3860, 591, 'PONDOKLENGSIR');
INSERT INTO `ref_desa` VALUES (3861, 591, 'PONDOKLEUNGSIR');
INSERT INTO `ref_desa` VALUES (3862, 591, 'PT MGL');
INSERT INTO `ref_desa` VALUES (3863, 591, 'PT SOSTRO');
INSERT INTO `ref_desa` VALUES (3864, 591, 'RAWA BUMIN');
INSERT INTO `ref_desa` VALUES (3865, 591, 'SALAGOMBONG');
INSERT INTO `ref_desa` VALUES (3866, 591, 'SALAKOPI');
INSERT INTO `ref_desa` VALUES (3867, 591, 'SCISANDE');
INSERT INTO `ref_desa` VALUES (3868, 591, 'SEALABOMBONG');
INSERT INTO `ref_desa` VALUES (3869, 591, 'SEALAGOMBONG');
INSERT INTO `ref_desa` VALUES (3870, 591, 'SEALAKOPAI');
INSERT INTO `ref_desa` VALUES (3871, 591, 'SEALAKOPI');
INSERT INTO `ref_desa` VALUES (3872, 591, 'SEALGOMBONG');
INSERT INTO `ref_desa` VALUES (3873, 591, 'SEALKOPI');
INSERT INTO `ref_desa` VALUES (3874, 591, 'SEAOLAGEDANG');
INSERT INTO `ref_desa` VALUES (3875, 591, 'SEGOG');
INSERT INTO `ref_desa` VALUES (3876, 591, 'SELAAKOPI');
INSERT INTO `ref_desa` VALUES (3877, 591, 'SELAGOMBONG');
INSERT INTO `ref_desa` VALUES (3878, 591, 'SELAJAMABE');
INSERT INTO `ref_desa` VALUES (3879, 591, 'SELAJAMBE');
INSERT INTO `ref_desa` VALUES (3880, 591, 'SELAKOPI');
INSERT INTO `ref_desa` VALUES (3881, 591, 'SELJAMBE');
INSERT INTO `ref_desa` VALUES (3882, 591, 'SERLAJAMBE');
INSERT INTO `ref_desa` VALUES (3883, 591, 'SIMPENAN');
INSERT INTO `ref_desa` VALUES (3884, 591, 'SIRNA JAYA');
INSERT INTO `ref_desa` VALUES (3885, 591, 'SITU MEKAR');
INSERT INTO `ref_desa` VALUES (3886, 591, 'SLAKOPI');
INSERT INTO `ref_desa` VALUES (3887, 591, 'SLAKOPI LEMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (3888, 591, 'SMK BINA MANDIRI');
INSERT INTO `ref_desa` VALUES (3889, 591, 'SUKA DAMAI');
INSERT INTO `ref_desa` VALUES (3890, 591, 'SUKA DAMEI');
INSERT INTO `ref_desa` VALUES (3891, 591, 'SUKA RAME');
INSERT INTO `ref_desa` VALUES (3892, 591, 'SUKADAMI');
INSERT INTO `ref_desa` VALUES (3893, 591, 'SUKAKARSA');
INSERT INTO `ref_desa` VALUES (3894, 591, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (3895, 591, 'SUKARAMAI');
INSERT INTO `ref_desa` VALUES (3896, 591, 'SUKARAME');
INSERT INTO `ref_desa` VALUES (3897, 591, 'SUKASIRNA');
INSERT INTO `ref_desa` VALUES (3898, 591, 'TALAGA');
INSERT INTO `ref_desa` VALUES (3899, 591, 'TALAGA HILIR');
INSERT INTO `ref_desa` VALUES (3900, 591, 'TENJO LAYA');
INSERT INTO `ref_desa` VALUES (3901, 591, 'TIPAR');
INSERT INTO `ref_desa` VALUES (3902, 592, '-PASAWAHAN');
INSERT INTO `ref_desa` VALUES (3903, 592, '01-APR');
INSERT INTO `ref_desa` VALUES (3904, 592, '04');
INSERT INTO `ref_desa` VALUES (3905, 592, 'ACICURUG');
INSERT INTO `ref_desa` VALUES (3906, 592, 'AMEKARSARI');
INSERT INTO `ref_desa` VALUES (3907, 592, 'ASGORA');
INSERT INTO `ref_desa` VALUES (3908, 592, 'ASRAMA POLISI');
INSERT INTO `ref_desa` VALUES (3909, 592, 'AYAM MANGGIS');
INSERT INTO `ref_desa` VALUES (3910, 592, 'BABAKA PARI');
INSERT INTO `ref_desa` VALUES (3911, 592, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (3912, 592, 'BABAKAN JAY A');
INSERT INTO `ref_desa` VALUES (3913, 592, 'BABAKAN JAYA');
INSERT INTO `ref_desa` VALUES (3914, 592, 'BABAKAN KAM');
INSERT INTO `ref_desa` VALUES (3915, 592, 'BABAKAN KANDANG');
INSERT INTO `ref_desa` VALUES (3916, 592, 'BABAKAN KAUM');
INSERT INTO `ref_desa` VALUES (3917, 592, 'BABAKAN KEAMABAG');
INSERT INTO `ref_desa` VALUES (3918, 592, 'BABAKAN KENCANA');
INSERT INTO `ref_desa` VALUES (3919, 592, 'BABAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (3920, 592, 'BABAKAN PARI');
INSERT INTO `ref_desa` VALUES (3921, 592, 'BABAKAN PARI CIDAHU');
INSERT INTO `ref_desa` VALUES (3922, 592, 'BABAKAN PENDEUY');
INSERT INTO `ref_desa` VALUES (3923, 592, 'BABAKAN SARAI');
INSERT INTO `ref_desa` VALUES (3924, 592, 'BABAKAN SARI');
INSERT INTO `ref_desa` VALUES (3925, 592, 'BABAKAN TENGAH');
INSERT INTO `ref_desa` VALUES (3926, 592, 'BABAKANPARI');
INSERT INTO `ref_desa` VALUES (3927, 592, 'BABAKN ANYAR');
INSERT INTO `ref_desa` VALUES (3928, 592, 'BABAYANG');
INSERT INTO `ref_desa` VALUES (3929, 592, 'BABKAN JAYA');
INSERT INTO `ref_desa` VALUES (3930, 592, 'BABKANJAYA');
INSERT INTO `ref_desa` VALUES (3931, 592, 'BABNGBYANG');
INSERT INTO `ref_desa` VALUES (3932, 592, 'BAENDA');
INSERT INTO `ref_desa` VALUES (3933, 592, 'BAENTEANG');
INSERT INTO `ref_desa` VALUES (3934, 592, 'BAKAN JAYA');
INSERT INTO `ref_desa` VALUES (3935, 592, 'BAMBAYANG');
INSERT INTO `ref_desa` VALUES (3936, 592, 'BANAGBAYANG');
INSERT INTO `ref_desa` VALUES (3937, 592, 'BANBAYANG');
INSERT INTO `ref_desa` VALUES (3938, 592, 'BANDA');
INSERT INTO `ref_desa` VALUES (3939, 592, 'BANG BAYAN');
INSERT INTO `ref_desa` VALUES (3940, 592, 'BANG BAYANG');
INSERT INTO `ref_desa` VALUES (3941, 592, 'BANG KONG RAEANG');
INSERT INTO `ref_desa` VALUES (3942, 592, 'BANG KONGRENG');
INSERT INTO `ref_desa` VALUES (3943, 592, 'BANGABAYANG');
INSERT INTO `ref_desa` VALUES (3944, 592, 'BANGABYANG');
INSERT INTO `ref_desa` VALUES (3945, 592, 'BANGBANYANG');
INSERT INTO `ref_desa` VALUES (3946, 592, 'BANGBAYAN');
INSERT INTO `ref_desa` VALUES (3947, 592, 'BANGBAYANG .');
INSERT INTO `ref_desa` VALUES (3948, 592, 'BANGBAYNAG');
INSERT INTO `ref_desa` VALUES (3949, 592, 'BANGBAYNG');
INSERT INTO `ref_desa` VALUES (3950, 592, 'BANGBAYTANG');
INSERT INTO `ref_desa` VALUES (3951, 592, 'BANGBYANG');
INSERT INTO `ref_desa` VALUES (3952, 592, 'BANGKONG REANG');
INSERT INTO `ref_desa` VALUES (3953, 592, 'BANGKONG REG');
INSERT INTO `ref_desa` VALUES (3954, 592, 'BANGKONG RENAG');
INSERT INTO `ref_desa` VALUES (3955, 592, 'BANGKONGREANG');
INSERT INTO `ref_desa` VALUES (3956, 592, 'BANGKONGRENAG');
INSERT INTO `ref_desa` VALUES (3957, 592, 'BANGKONGRENG');
INSERT INTO `ref_desa` VALUES (3958, 592, 'BANKONG REANG');
INSERT INTO `ref_desa` VALUES (3959, 592, 'BANNGBAYANG');
INSERT INTO `ref_desa` VALUES (3960, 592, 'BANYBAYANG');
INSERT INTO `ref_desa` VALUES (3961, 592, 'BBAKAN PARI');
INSERT INTO `ref_desa` VALUES (3962, 592, 'BEANADA');
INSERT INTO `ref_desa` VALUES (3963, 592, 'BEANTAG');
INSERT INTO `ref_desa` VALUES (3964, 592, 'BEANTEANG');
INSERT INTO `ref_desa` VALUES (3965, 592, 'BEANTENG');
INSERT INTO `ref_desa` VALUES (3966, 592, 'BEDA');
INSERT INTO `ref_desa` VALUES (3967, 592, 'BENDA .');
INSERT INTO `ref_desa` VALUES (3968, 592, 'BENDA GIRANG');
INSERT INTO `ref_desa` VALUES (3969, 592, 'BENDA LEGOK');
INSERT INTO `ref_desa` VALUES (3970, 592, 'BENDACICURUG');
INSERT INTO `ref_desa` VALUES (3971, 592, 'BENDAN');
INSERT INTO `ref_desa` VALUES (3972, 592, 'BENDDA');
INSERT INTO `ref_desa` VALUES (3973, 592, 'BENDEA');
INSERT INTO `ref_desa` VALUES (3974, 592, 'BENDNDA');
INSERT INTO `ref_desa` VALUES (3975, 592, 'BENTEG');
INSERT INTO `ref_desa` VALUES (3976, 592, 'BENTENG');
INSERT INTO `ref_desa` VALUES (3977, 592, 'BENTENG KUTA JAYA');
INSERT INTO `ref_desa` VALUES (3978, 592, 'BERKAH');
INSERT INTO `ref_desa` VALUES (3979, 592, 'BJPARI');
INSERT INTO `ref_desa` VALUES (3980, 592, 'BNEDA');
INSERT INTO `ref_desa` VALUES (3981, 592, 'BOJONG KERENG');
INSERT INTO `ref_desa` VALUES (3982, 592, 'BOJONG KOKOSAN');
INSERT INTO `ref_desa` VALUES (3983, 592, 'BOJONG PARI');
INSERT INTO `ref_desa` VALUES (3984, 592, 'BOJONG PERENG');
INSERT INTO `ref_desa` VALUES (3985, 592, 'BOJONGP[ELENG');
INSERT INTO `ref_desa` VALUES (3986, 592, 'BRNDA');
INSERT INTO `ref_desa` VALUES (3987, 592, 'BSNGBAYANG');
INSERT INTO `ref_desa` VALUES (3988, 592, 'BTN CICURG');
INSERT INTO `ref_desa` VALUES (3989, 592, 'BTN MEKAR SARI');
INSERT INTO `ref_desa` VALUES (3990, 592, 'BUMI AYU');
INSERT INTO `ref_desa` VALUES (3991, 592, 'C ARINGIN');
INSERT INTO `ref_desa` VALUES (3992, 592, 'CARAINGIN');
INSERT INTO `ref_desa` VALUES (3993, 592, 'CARAINGIN LAMPANG');
INSERT INTO `ref_desa` VALUES (3994, 592, 'CARIGIN');
INSERT INTO `ref_desa` VALUES (3995, 592, 'CARINGIN KARET');
INSERT INTO `ref_desa` VALUES (3996, 592, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (3997, 592, 'CARINGIN LAPANG');
INSERT INTO `ref_desa` VALUES (3998, 592, 'CARINGIN TONGOH');
INSERT INTO `ref_desa` VALUES (3999, 592, 'CARINGIN WETAN');
INSERT INTO `ref_desa` VALUES (4000, 592, 'CARINGINM');
INSERT INTO `ref_desa` VALUES (4001, 592, 'CARNGINKORAMIL');
INSERT INTO `ref_desa` VALUES (4002, 592, 'CASRINGIN');
INSERT INTO `ref_desa` VALUES (4003, 592, 'CCICATIH');
INSERT INTO `ref_desa` VALUES (4004, 592, 'CCICURUG');
INSERT INTO `ref_desa` VALUES (4005, 592, 'CCIURUG');
INSERT INTO `ref_desa` VALUES (4006, 592, 'CCRUG');
INSERT INTO `ref_desa` VALUES (4007, 592, 'CCURUG');
INSERT INTO `ref_desa` VALUES (4008, 592, 'CIAGADOG');
INSERT INTO `ref_desa` VALUES (4009, 592, 'CIANGSANA');
INSERT INTO `ref_desa` VALUES (4010, 592, 'CIARINGIN');
INSERT INTO `ref_desa` VALUES (4011, 592, 'CIASAAT');
INSERT INTO `ref_desa` VALUES (4012, 592, 'CIATIH');
INSERT INTO `ref_desa` VALUES (4013, 592, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (4014, 592, 'CIBAREGBEG');
INSERT INTO `ref_desa` VALUES (4015, 592, 'CIBATU');
INSERT INTO `ref_desa` VALUES (4016, 592, 'CIBEBER');
INSERT INTO `ref_desa` VALUES (4017, 592, 'CIBEBER GIRANG');
INSERT INTO `ref_desa` VALUES (4018, 592, 'CIBEBER HILIR');
INSERT INTO `ref_desa` VALUES (4019, 592, 'CIBELIK');
INSERT INTO `ref_desa` VALUES (4020, 592, 'CIBEREBEG');
INSERT INTO `ref_desa` VALUES (4021, 592, 'CIBGOMBONG');
INSERT INTO `ref_desa` VALUES (4022, 592, 'CIBILIK');
INSERT INTO `ref_desa` VALUES (4023, 592, 'CIBLILIK');
INSERT INTO `ref_desa` VALUES (4024, 592, 'CIBTU PASAWAHAN');
INSERT INTO `ref_desa` VALUES (4025, 592, 'CIBUNTU');
INSERT INTO `ref_desa` VALUES (4026, 592, 'CIBUNTU CICUTRUG');
INSERT INTO `ref_desa` VALUES (4027, 592, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (4028, 592, 'CIBURIAL');
INSERT INTO `ref_desa` VALUES (4029, 592, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (4030, 592, 'CIC URUG');
INSERT INTO `ref_desa` VALUES (4031, 592, 'CICANTAYAN');
INSERT INTO `ref_desa` VALUES (4032, 592, 'CICATIH');
INSERT INTO `ref_desa` VALUES (4033, 592, 'CICAURUG');
INSERT INTO `ref_desa` VALUES (4034, 592, 'CICEWOL');
INSERT INTO `ref_desa` VALUES (4035, 592, 'CICIRIU');
INSERT INTO `ref_desa` VALUES (4036, 592, 'CICIRUG');
INSERT INTO `ref_desa` VALUES (4037, 592, 'CICIRUUG');
INSERT INTO `ref_desa` VALUES (4038, 592, 'CICIURUG');
INSERT INTO `ref_desa` VALUES (4039, 592, 'CICRUG');
INSERT INTO `ref_desa` VALUES (4040, 592, 'CICRUUG');
INSERT INTO `ref_desa` VALUES (4041, 592, 'CICTAIH');
INSERT INTO `ref_desa` VALUES (4042, 592, 'CICTH');
INSERT INTO `ref_desa` VALUES (4043, 592, 'CICU');
INSERT INTO `ref_desa` VALUES (4044, 592, 'CICUARUG');
INSERT INTO `ref_desa` VALUES (4045, 592, 'CICUCRUG');
INSERT INTO `ref_desa` VALUES (4046, 592, 'CICUCRUG]');
INSERT INTO `ref_desa` VALUES (4047, 592, 'CICUCUG');
INSERT INTO `ref_desa` VALUES (4048, 592, 'CICUCURUG');
INSERT INTO `ref_desa` VALUES (4049, 592, 'CICUERUG');
INSERT INTO `ref_desa` VALUES (4050, 592, 'CICUIRUG');
INSERT INTO `ref_desa` VALUES (4051, 592, 'CICURAUG');
INSERT INTO `ref_desa` VALUES (4052, 592, 'CICUREUG');
INSERT INTO `ref_desa` VALUES (4053, 592, 'CICURG');
INSERT INTO `ref_desa` VALUES (4054, 592, 'CICURU');
INSERT INTO `ref_desa` VALUES (4055, 592, 'CICURUG PASAR');
INSERT INTO `ref_desa` VALUES (4056, 592, 'CICURUG.');
INSERT INTO `ref_desa` VALUES (4057, 592, 'CICURUG0');
INSERT INTO `ref_desa` VALUES (4058, 592, 'CICURUGCICURUG');
INSERT INTO `ref_desa` VALUES (4059, 592, 'CICURUG]');
INSERT INTO `ref_desa` VALUES (4060, 592, 'CICURUH');
INSERT INTO `ref_desa` VALUES (4061, 592, 'CICURUNG');
INSERT INTO `ref_desa` VALUES (4062, 592, 'CICURURG');
INSERT INTO `ref_desa` VALUES (4063, 592, 'CICURURUG');
INSERT INTO `ref_desa` VALUES (4064, 592, 'CICURUT');
INSERT INTO `ref_desa` VALUES (4065, 592, 'CICURYG');
INSERT INTO `ref_desa` VALUES (4066, 592, 'CICUURG');
INSERT INTO `ref_desa` VALUES (4067, 592, 'CICUURUG');
INSERT INTO `ref_desa` VALUES (4068, 592, 'CICUUUG');
INSERT INTO `ref_desa` VALUES (4069, 592, 'CICUWOL');
INSERT INTO `ref_desa` VALUES (4070, 592, 'CICWAWOL');
INSERT INTO `ref_desa` VALUES (4071, 592, 'CIDAHU');
INSERT INTO `ref_desa` VALUES (4072, 592, 'CIDAHUCICURUG');
INSERT INTO `ref_desa` VALUES (4073, 592, 'CIGADOG');
INSERT INTO `ref_desa` VALUES (4074, 592, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (4075, 592, 'CIICURUG');
INSERT INTO `ref_desa` VALUES (4076, 592, 'CIIDAHU');
INSERT INTO `ref_desa` VALUES (4077, 592, 'CIIRUG');
INSERT INTO `ref_desa` VALUES (4078, 592, 'CIJAMBE');
INSERT INTO `ref_desa` VALUES (4079, 592, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (4080, 592, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (4081, 592, 'CIKEMABANRG');
INSERT INTO `ref_desa` VALUES (4082, 592, 'CIKEMBANG');
INSERT INTO `ref_desa` VALUES (4083, 592, 'CIKIRAI');
INSERT INTO `ref_desa` VALUES (4084, 592, 'CIKIRAY');
INSERT INTO `ref_desa` VALUES (4085, 592, 'CIKMELATI');
INSERT INTO `ref_desa` VALUES (4086, 592, 'CIMALATI');
INSERT INTO `ref_desa` VALUES (4087, 592, 'CIMANDE');
INSERT INTO `ref_desa` VALUES (4088, 592, 'CIMANGGU . CIKEMBAR');
INSERT INTO `ref_desa` VALUES (4089, 592, 'CIMEALATI');
INSERT INTO `ref_desa` VALUES (4090, 592, 'CIMELATI');
INSERT INTO `ref_desa` VALUES (4091, 592, 'CIMELSTI');
INSERT INTO `ref_desa` VALUES (4092, 592, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (4093, 592, 'CIMEOLATI');
INSERT INTO `ref_desa` VALUES (4094, 592, 'CINANGRANG');
INSERT INTO `ref_desa` VALUES (4095, 592, 'CINYANGKOEK');
INSERT INTO `ref_desa` VALUES (4096, 592, 'CIORAY');
INSERT INTO `ref_desa` VALUES (4097, 592, 'CIPAMULAAN');
INSERT INTO `ref_desa` VALUES (4098, 592, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (4099, 592, 'CIPARAI');
INSERT INTO `ref_desa` VALUES (4100, 592, 'CIPARI');
INSERT INTO `ref_desa` VALUES (4101, 592, 'CIPARI CSAAT');
INSERT INTO `ref_desa` VALUES (4102, 592, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (4103, 592, 'CIRNA SARI');
INSERT INTO `ref_desa` VALUES (4104, 592, 'CIRURUG');
INSERT INTO `ref_desa` VALUES (4105, 592, 'CISAAAT');
INSERT INTO `ref_desa` VALUES (4106, 592, 'CISAAT CICUCURG');
INSERT INTO `ref_desa` VALUES (4107, 592, 'CISALADA');
INSERT INTO `ref_desa` VALUES (4108, 592, 'CISAT');
INSERT INTO `ref_desa` VALUES (4109, 592, 'CISSAT');
INSERT INTO `ref_desa` VALUES (4110, 592, 'CITENJO AYU');
INSERT INTO `ref_desa` VALUES (4111, 592, 'CIUATA');
INSERT INTO `ref_desa` VALUES (4112, 592, 'CIUCURUG');
INSERT INTO `ref_desa` VALUES (4113, 592, 'CIURATA');
INSERT INTO `ref_desa` VALUES (4114, 592, 'CIURUG');
INSERT INTO `ref_desa` VALUES (4115, 592, 'CIUTA');
INSERT INTO `ref_desa` VALUES (4116, 592, 'CIUTAR');
INSERT INTO `ref_desa` VALUES (4117, 592, 'CIUTARA');
INSERT INTO `ref_desa` VALUES (4118, 592, 'CIUTARA CICUCRUG');
INSERT INTO `ref_desa` VALUES (4119, 592, 'CKUTA JAYA');
INSERT INTO `ref_desa` VALUES (4120, 592, 'CMEKAR SARI');
INSERT INTO `ref_desa` VALUES (4121, 592, 'CNYANGKOEK');
INSERT INTO `ref_desa` VALUES (4122, 592, 'CO9CURUG');
INSERT INTO `ref_desa` VALUES (4123, 592, 'COICURUG');
INSERT INTO `ref_desa` VALUES (4124, 592, 'CRAINGIN');
INSERT INTO `ref_desa` VALUES (4125, 592, 'CSAAT');
INSERT INTO `ref_desa` VALUES (4126, 592, 'CUCTENJOAYU');
INSERT INTO `ref_desa` VALUES (4127, 592, 'CUCURG');
INSERT INTO `ref_desa` VALUES (4128, 592, 'CUICURUG');
INSERT INTO `ref_desa` VALUES (4129, 592, 'DARMAREJA');
INSERT INTO `ref_desa` VALUES (4130, 592, 'EKARSARI');
INSERT INTO `ref_desa` VALUES (4131, 592, 'EMJOAYAU');
INSERT INTO `ref_desa` VALUES (4132, 592, 'GARINGIN');
INSERT INTO `ref_desa` VALUES (4133, 592, 'GIN ANJAR');
INSERT INTO `ref_desa` VALUES (4134, 592, 'GINTUNG');
INSERT INTO `ref_desa` VALUES (4135, 592, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (4136, 592, 'GIRIJAYA');
INSERT INTO `ref_desa` VALUES (4137, 592, 'GOMBONG ONANG');
INSERT INTO `ref_desa` VALUES (4138, 592, 'GUNAJAYA');
INSERT INTO `ref_desa` VALUES (4139, 592, 'HANGKONG RENGA');
INSERT INTO `ref_desa` VALUES (4140, 592, 'HEGAR MANAH');
INSERT INTO `ref_desa` VALUES (4141, 592, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (4142, 592, 'ICURUG');
INSERT INTO `ref_desa` VALUES (4143, 592, 'ICUUG');
INSERT INTO `ref_desa` VALUES (4144, 592, 'JAMI');
INSERT INTO `ref_desa` VALUES (4145, 592, 'JANGKOEK');
INSERT INTO `ref_desa` VALUES (4146, 592, 'JAYA');
INSERT INTO `ref_desa` VALUES (4147, 592, 'JAYA BAKTI');
INSERT INTO `ref_desa` VALUES (4148, 592, 'JAYABAKTI');
INSERT INTO `ref_desa` VALUES (4149, 592, 'JL LEGOS');
INSERT INTO `ref_desa` VALUES (4150, 592, 'KAMP PAKAMETAN');
INSERT INTO `ref_desa` VALUES (4151, 592, 'KAMPUNG GINTUNG');
INSERT INTO `ref_desa` VALUES (4152, 592, 'KAMPUNGLEMPO');
INSERT INTO `ref_desa` VALUES (4153, 592, 'KARANG JAYA');
INSERT INTO `ref_desa` VALUES (4154, 592, 'KARANG SIRNA');
INSERT INTO `ref_desa` VALUES (4155, 592, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (4156, 592, 'KAUM');
INSERT INTO `ref_desa` VALUES (4157, 592, 'KAUM KALER');
INSERT INTO `ref_desa` VALUES (4158, 592, 'KAUM KIDUL');
INSERT INTO `ref_desa` VALUES (4159, 592, 'KAUM TENGAH');
INSERT INTO `ref_desa` VALUES (4160, 592, 'KAUMTZNGAH');
INSERT INTO `ref_desa` VALUES (4161, 592, 'KB KAUNG');
INSERT INTO `ref_desa` VALUES (4162, 592, 'KEBON CAU');
INSERT INTO `ref_desa` VALUES (4163, 592, 'KEBON KAWUNG');
INSERT INTO `ref_desa` VALUES (4164, 592, 'KEBONKAUNG');
INSERT INTO `ref_desa` VALUES (4165, 592, 'KEL');
INSERT INTO `ref_desa` VALUES (4166, 592, 'KERTA JAYA');
INSERT INTO `ref_desa` VALUES (4167, 592, 'KERTAJAYA');
INSERT INTO `ref_desa` VALUES (4168, 592, 'KOIN BAJU');
INSERT INTO `ref_desa` VALUES (4169, 592, 'KOMNGSI');
INSERT INTO `ref_desa` VALUES (4170, 592, 'KOMPA');
INSERT INTO `ref_desa` VALUES (4171, 592, 'KONGSI');
INSERT INTO `ref_desa` VALUES (4172, 592, 'KOTA JAAYA');
INSERT INTO `ref_desa` VALUES (4173, 592, 'KP LIO');
INSERT INTO `ref_desa` VALUES (4174, 592, 'KP NAMPEL');
INSERT INTO `ref_desa` VALUES (4175, 592, 'KUT JY');
INSERT INTO `ref_desa` VALUES (4176, 592, 'KUTA GIRANG');
INSERT INTO `ref_desa` VALUES (4177, 592, 'KUTA JAYA');
INSERT INTO `ref_desa` VALUES (4178, 592, 'KUTA JYA');
INSERT INTO `ref_desa` VALUES (4179, 592, 'KUTACICURUG');
INSERT INTO `ref_desa` VALUES (4180, 592, 'KUTAJA');
INSERT INTO `ref_desa` VALUES (4181, 592, 'KUTAJYA');
INSERT INTO `ref_desa` VALUES (4182, 592, 'KUTJAYA');
INSERT INTO `ref_desa` VALUES (4183, 592, 'LABAK JAYA');
INSERT INTO `ref_desa` VALUES (4184, 592, 'LEABAK PARI');
INSERT INTO `ref_desa` VALUES (4185, 592, 'LEBAK JAYA');
INSERT INTO `ref_desa` VALUES (4186, 592, 'LEBAK PASAR');
INSERT INTO `ref_desa` VALUES (4187, 592, 'LEBAK SARI');
INSERT INTO `ref_desa` VALUES (4188, 592, 'LEBAK SINYAR');
INSERT INTO `ref_desa` VALUES (4189, 592, 'LEBAKJAYA');
INSERT INTO `ref_desa` VALUES (4190, 592, 'LEBAKSAR');
INSERT INTO `ref_desa` VALUES (4191, 592, 'LEBAKSARI');
INSERT INTO `ref_desa` VALUES (4192, 592, 'LEGOG NYENAG');
INSERT INTO `ref_desa` VALUES (4193, 592, 'LEGOG NYENANG');
INSERT INTO `ref_desa` VALUES (4194, 592, 'LEGOS');
INSERT INTO `ref_desa` VALUES (4195, 592, 'LEGOS CCCURUG');
INSERT INTO `ref_desa` VALUES (4196, 592, 'LEMBUR KOLOT');
INSERT INTO `ref_desa` VALUES (4197, 592, 'LEMBURKOLOT');
INSERT INTO `ref_desa` VALUES (4198, 592, 'LEMBUTKOLOT');
INSERT INTO `ref_desa` VALUES (4199, 592, 'LEUBAK PASAR');
INSERT INTO `ref_desa` VALUES (4200, 592, 'LEUWI PECANG');
INSERT INTO `ref_desa` VALUES (4201, 592, 'LEWI PECANG');
INSERT INTO `ref_desa` VALUES (4202, 592, 'LIDO PERMAI');
INSERT INTO `ref_desa` VALUES (4203, 592, 'LIMBANG JAYA');
INSERT INTO `ref_desa` VALUES (4204, 592, 'LINGKUNGAN');
INSERT INTO `ref_desa` VALUES (4205, 592, 'MAEKAR SARI');
INSERT INTO `ref_desa` VALUES (4206, 592, 'MAGGIS GIRANG');
INSERT INTO `ref_desa` VALUES (4207, 592, 'MAKA SARI');
INSERT INTO `ref_desa` VALUES (4208, 592, 'MAKARSARI');
INSERT INTO `ref_desa` VALUES (4209, 592, 'MAKASARI');
INSERT INTO `ref_desa` VALUES (4210, 592, 'MAKASRI');
INSERT INTO `ref_desa` VALUES (4211, 592, 'MANGGIS  GIRANG');
INSERT INTO `ref_desa` VALUES (4212, 592, 'MANGGIS GIRANG');
INSERT INTO `ref_desa` VALUES (4213, 592, 'MANGGIS HILIR');
INSERT INTO `ref_desa` VALUES (4214, 592, 'MANGGISGIRANG');
INSERT INTO `ref_desa` VALUES (4215, 592, 'MANGIS');
INSERT INTO `ref_desa` VALUES (4216, 592, 'MANGUN JAYA');
INSERT INTO `ref_desa` VALUES (4217, 592, 'MARGALUYU');
INSERT INTO `ref_desa` VALUES (4218, 592, 'MEAKARSARI');
INSERT INTO `ref_desa` VALUES (4219, 592, 'MEAKASARI');
INSERT INTO `ref_desa` VALUES (4220, 592, 'MEAKRSARI');
INSERT INTO `ref_desa` VALUES (4221, 592, 'MEKAERSAI');
INSERT INTO `ref_desa` VALUES (4222, 592, 'MEKAR  SARI');
INSERT INTO `ref_desa` VALUES (4223, 592, 'MEKAR ASIH');
INSERT INTO `ref_desa` VALUES (4224, 592, 'MEKAR SARI');
INSERT INTO `ref_desa` VALUES (4225, 592, 'MEKAR SARI BTN D 10 NO 02');
INSERT INTO `ref_desa` VALUES (4226, 592, 'MEKARARI');
INSERT INTO `ref_desa` VALUES (4227, 592, 'MEKARASARI');
INSERT INTO `ref_desa` VALUES (4228, 592, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (4229, 592, 'MEKARKAJA');
INSERT INTO `ref_desa` VALUES (4230, 592, 'MEKARS ARI');
INSERT INTO `ref_desa` VALUES (4231, 592, 'MEKARSAARI');
INSERT INTO `ref_desa` VALUES (4232, 592, 'MEKARSAR I');
INSERT INTO `ref_desa` VALUES (4233, 592, 'MEKARSARI PERMAI');
INSERT INTO `ref_desa` VALUES (4234, 592, 'MEKARSRAI');
INSERT INTO `ref_desa` VALUES (4235, 592, 'MEKARTSARI');
INSERT INTO `ref_desa` VALUES (4236, 592, 'MEKASARI');
INSERT INTO `ref_desa` VALUES (4237, 592, 'MEKASRSARI PERMAI');
INSERT INTO `ref_desa` VALUES (4238, 592, 'MEKRJAYA');
INSERT INTO `ref_desa` VALUES (4239, 592, 'MEKRSARI');
INSERT INTO `ref_desa` VALUES (4240, 592, 'MENTENG');
INSERT INTO `ref_desa` VALUES (4241, 592, 'MMNANGERANG');
INSERT INTO `ref_desa` VALUES (4242, 592, 'MUTIARALIDO');
INSERT INTO `ref_desa` VALUES (4243, 592, 'NABGERANG');
INSERT INTO `ref_desa` VALUES (4244, 592, 'NAGERANG');
INSERT INTO `ref_desa` VALUES (4245, 592, 'NAGGERANG');
INSERT INTO `ref_desa` VALUES (4246, 592, 'NAGGERANGSENTARAL');
INSERT INTO `ref_desa` VALUES (4247, 592, 'NAGKALAK');
INSERT INTO `ref_desa` VALUES (4248, 592, 'NAGKLEK');
INSERT INTO `ref_desa` VALUES (4249, 592, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (4250, 592, 'NAGRGERANG');
INSERT INTO `ref_desa` VALUES (4251, 592, 'NANGEARANG');
INSERT INTO `ref_desa` VALUES (4252, 592, 'NANGEARNG');
INSERT INTO `ref_desa` VALUES (4253, 592, 'NANGERAMG');
INSERT INTO `ref_desa` VALUES (4254, 592, 'NANGEREANG');
INSERT INTO `ref_desa` VALUES (4255, 592, 'NANGGERANG');
INSERT INTO `ref_desa` VALUES (4256, 592, 'NANGGGERANG');
INSERT INTO `ref_desa` VALUES (4257, 592, 'NANGKLAK');
INSERT INTO `ref_desa` VALUES (4258, 592, 'NANGKLAL');
INSERT INTO `ref_desa` VALUES (4259, 592, 'NANGKOEK');
INSERT INTO `ref_desa` VALUES (4260, 592, 'NANGKOWE');
INSERT INTO `ref_desa` VALUES (4261, 592, 'NANNGERANG');
INSERT INTO `ref_desa` VALUES (4262, 592, 'NANYAKOWEK');
INSERT INTO `ref_desa` VALUES (4263, 592, 'NAYANGKOEK');
INSERT INTO `ref_desa` VALUES (4264, 592, 'NAYANGKOWEK');
INSERT INTO `ref_desa` VALUES (4265, 592, 'NAYNGKOEK');
INSERT INTO `ref_desa` VALUES (4266, 592, 'NAYNGKOWEK');
INSERT INTO `ref_desa` VALUES (4267, 592, 'NBABAKAN');
INSERT INTO `ref_desa` VALUES (4268, 592, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (4269, 592, 'NEGOS');
INSERT INTO `ref_desa` VALUES (4270, 592, 'NEMPEL');
INSERT INTO `ref_desa` VALUES (4271, 592, 'NENGGERANG');
INSERT INTO `ref_desa` VALUES (4272, 592, 'NGGERNG');
INSERT INTO `ref_desa` VALUES (4273, 592, 'NYAGKOWEK');
INSERT INTO `ref_desa` VALUES (4274, 592, 'NYAINDUNG');
INSERT INTO `ref_desa` VALUES (4275, 592, 'NYAKOWEK');
INSERT INTO `ref_desa` VALUES (4276, 592, 'NYALINDUG');
INSERT INTO `ref_desa` VALUES (4277, 592, 'NYALINDUNG');
INSERT INTO `ref_desa` VALUES (4278, 592, 'NYAMNGKOEK');
INSERT INTO `ref_desa` VALUES (4279, 592, 'NYAMPLONG');
INSERT INTO `ref_desa` VALUES (4280, 592, 'NYANG KOEK');
INSERT INTO `ref_desa` VALUES (4281, 592, 'NYANG KOWEK');
INSERT INTO `ref_desa` VALUES (4282, 592, 'NYANGJOEK');
INSERT INTO `ref_desa` VALUES (4283, 592, 'NYANGKEOK');
INSERT INTO `ref_desa` VALUES (4284, 592, 'NYANGKEWOK');
INSERT INTO `ref_desa` VALUES (4285, 592, 'NYANGKKOWEK');
INSERT INTO `ref_desa` VALUES (4286, 592, 'NYANGKOEK');
INSERT INTO `ref_desa` VALUES (4287, 592, 'NYANGKOENG');
INSERT INTO `ref_desa` VALUES (4288, 592, 'NYANGKOEWEK');
INSERT INTO `ref_desa` VALUES (4289, 592, 'NYANGKOWE');
INSERT INTO `ref_desa` VALUES (4290, 592, 'NYANGKOWEK CICUURUG');
INSERT INTO `ref_desa` VALUES (4291, 592, 'NYANGKOWWEK');
INSERT INTO `ref_desa` VALUES (4292, 592, 'NYANKOEK');
INSERT INTO `ref_desa` VALUES (4293, 592, 'NYNAGKOWEK');
INSERT INTO `ref_desa` VALUES (4294, 592, 'NYNGKOEK');
INSERT INTO `ref_desa` VALUES (4295, 592, 'NYNGKOWEK');
INSERT INTO `ref_desa` VALUES (4296, 592, 'PACANTILAN');
INSERT INTO `ref_desa` VALUES (4297, 592, 'PACAWATI');
INSERT INTO `ref_desa` VALUES (4298, 592, 'PADA ASIH');
INSERT INTO `ref_desa` VALUES (4299, 592, 'PADAGENYANG');
INSERT INTO `ref_desa` VALUES (4300, 592, 'PAJAGAN');
INSERT INTO `ref_desa` VALUES (4301, 592, 'PAKEMITAN');
INSERT INTO `ref_desa` VALUES (4302, 592, 'PALA SARI');
INSERT INTO `ref_desa` VALUES (4303, 592, 'PALASARI');
INSERT INTO `ref_desa` VALUES (4304, 592, 'PALASARI HILIR');
INSERT INTO `ref_desa` VALUES (4305, 592, 'PAMOYANAN');
INSERT INTO `ref_desa` VALUES (4306, 592, 'PAMOYANANA');
INSERT INTO `ref_desa` VALUES (4307, 592, 'PAMOYENAN');
INSERT INTO `ref_desa` VALUES (4308, 592, 'PAMUJRUYAN');
INSERT INTO `ref_desa` VALUES (4309, 592, 'PANCA WATI');
INSERT INTO `ref_desa` VALUES (4310, 592, 'PANCANJILAN');
INSERT INTO `ref_desa` VALUES (4311, 592, 'PANCAWATI');
INSERT INTO `ref_desa` VALUES (4312, 592, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (4313, 592, 'PANKALAN CICUCURUG');
INSERT INTO `ref_desa` VALUES (4314, 592, 'PARIGI');
INSERT INTO `ref_desa` VALUES (4315, 592, 'PASAAWAHAN');
INSERT INTO `ref_desa` VALUES (4316, 592, 'PASAHAHAN');
INSERT INTO `ref_desa` VALUES (4317, 592, 'PASAHAN');
INSERT INTO `ref_desa` VALUES (4318, 592, 'PASAHAWAN');
INSERT INTO `ref_desa` VALUES (4319, 592, 'PASAWAHA');
INSERT INTO `ref_desa` VALUES (4320, 592, 'PASAWAHAN CICU');
INSERT INTO `ref_desa` VALUES (4321, 592, 'PASAWAHAN.');
INSERT INTO `ref_desa` VALUES (4322, 592, 'PASAWAHN');
INSERT INTO `ref_desa` VALUES (4323, 592, 'PASAWAN');
INSERT INTO `ref_desa` VALUES (4324, 592, 'PASAWANHAN');
INSERT INTO `ref_desa` VALUES (4325, 592, 'PASAWHAN');
INSERT INTO `ref_desa` VALUES (4326, 592, 'PASAWSAHAN');
INSERT INTO `ref_desa` VALUES (4327, 592, 'PASIR DOTON');
INSERT INTO `ref_desa` VALUES (4328, 592, 'PASIR DOTON CIDAHU');
INSERT INTO `ref_desa` VALUES (4329, 592, 'PASIR GADUNG');
INSERT INTO `ref_desa` VALUES (4330, 592, 'PASIR HALANG');
INSERT INTO `ref_desa` VALUES (4331, 592, 'PASIR JAYA');
INSERT INTO `ref_desa` VALUES (4332, 592, 'PASIR KONDANG');
INSERT INTO `ref_desa` VALUES (4333, 592, 'PASIR PACAR');
INSERT INTO `ref_desa` VALUES (4334, 592, 'PASIRDALEM');
INSERT INTO `ref_desa` VALUES (4335, 592, 'PASIRDOTON');
INSERT INTO `ref_desa` VALUES (4336, 592, 'PASIRTEAGAH');
INSERT INTO `ref_desa` VALUES (4337, 592, 'PASIRTENAGAHA');
INSERT INTO `ref_desa` VALUES (4338, 592, 'PASSIRTENGAHA');
INSERT INTO `ref_desa` VALUES (4339, 592, 'PASWAHAN');
INSERT INTO `ref_desa` VALUES (4340, 592, 'PAUWASARI');
INSERT INTO `ref_desa` VALUES (4341, 592, 'PAWAHAN');
INSERT INTO `ref_desa` VALUES (4342, 592, 'PAWASAHAN');
INSERT INTO `ref_desa` VALUES (4343, 592, 'PAWENANG');
INSERT INTO `ref_desa` VALUES (4344, 592, 'PD KAO LANDEH');
INSERT INTO `ref_desa` VALUES (4345, 592, 'PD KASO');
INSERT INTO `ref_desa` VALUES (4346, 592, 'PD KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4347, 592, 'PD KASO TENAH');
INSERT INTO `ref_desa` VALUES (4348, 592, 'PD KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4349, 592, 'PD KASOLANDEUH');
INSERT INTO `ref_desa` VALUES (4350, 592, 'PDK KASO');
INSERT INTO `ref_desa` VALUES (4351, 592, 'PENJOAYU');
INSERT INTO `ref_desa` VALUES (4352, 592, 'PERUM MEKAR SARI');
INSERT INTO `ref_desa` VALUES (4353, 592, 'PESAWAHAN');
INSERT INTO `ref_desa` VALUES (4354, 592, 'PNDK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4355, 592, 'POJOK');
INSERT INTO `ref_desa` VALUES (4356, 592, 'POJOK SARI');
INSERT INTO `ref_desa` VALUES (4357, 592, 'POJOKNANGKA');
INSERT INTO `ref_desa` VALUES (4358, 592, 'POLSEK');
INSERT INTO `ref_desa` VALUES (4359, 592, 'PONDAOKAN');
INSERT INTO `ref_desa` VALUES (4360, 592, 'PONDOK AKSO  TONGGOHANDEUH');
INSERT INTO `ref_desa` VALUES (4361, 592, 'PONDOK KASO');
INSERT INTO `ref_desa` VALUES (4362, 592, 'PONDOK KASO LADEUH');
INSERT INTO `ref_desa` VALUES (4363, 592, 'PONDOK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4364, 592, 'PONDOK KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4365, 592, 'PONDOK KASOLANDEH');
INSERT INTO `ref_desa` VALUES (4366, 592, 'PONDOK KASOTEGHA');
INSERT INTO `ref_desa` VALUES (4367, 592, 'PONDOKASO');
INSERT INTO `ref_desa` VALUES (4368, 592, 'PONDOKASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4369, 592, 'PONDOKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4370, 592, 'PONDOKKASO');
INSERT INTO `ref_desa` VALUES (4371, 592, 'PONDOKKASO TONGGO');
INSERT INTO `ref_desa` VALUES (4372, 592, 'PONDOKKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4373, 592, 'PONDOKKASO TONGOH');
INSERT INTO `ref_desa` VALUES (4374, 592, 'PONDOKKASOTENGAH');
INSERT INTO `ref_desa` VALUES (4375, 592, 'PRWASARI');
INSERT INTO `ref_desa` VALUES (4376, 592, 'PS DOTON');
INSERT INTO `ref_desa` VALUES (4377, 592, 'PSAWAHAN');
INSERT INTO `ref_desa` VALUES (4378, 592, 'PSIGAN');
INSERT INTO `ref_desa` VALUES (4379, 592, 'PSINGAH');
INSERT INTO `ref_desa` VALUES (4380, 592, 'PT AGRAWIRA');
INSERT INTO `ref_desa` VALUES (4381, 592, 'PT KOIN BAJU');
INSERT INTO `ref_desa` VALUES (4382, 592, 'PT MANITO WOLD');
INSERT INTO `ref_desa` VALUES (4383, 592, 'PT. KOIB BAJU');
INSERT INTO `ref_desa` VALUES (4384, 592, 'PT. KOIN BAJU');
INSERT INTO `ref_desa` VALUES (4385, 592, 'PUALAM');
INSERT INTO `ref_desa` VALUES (4386, 592, 'PUEWASARI');
INSERT INTO `ref_desa` VALUES (4387, 592, 'PULASARI');
INSERT INTO `ref_desa` VALUES (4388, 592, 'PULOSARI');
INSERT INTO `ref_desa` VALUES (4389, 592, 'PULWASARI');
INSERT INTO `ref_desa` VALUES (4390, 592, 'PURAWASARI');
INSERT INTO `ref_desa` VALUES (4391, 592, 'PURNASARI');
INSERT INTO `ref_desa` VALUES (4392, 592, 'PURWA SARI');
INSERT INTO `ref_desa` VALUES (4393, 592, 'PURWA SARI ATU');
INSERT INTO `ref_desa` VALUES (4394, 592, 'PURWA SARI I');
INSERT INTO `ref_desa` VALUES (4395, 592, 'PURWASAAAARI');
INSERT INTO `ref_desa` VALUES (4396, 592, 'PURWASAARI');
INSERT INTO `ref_desa` VALUES (4397, 592, 'PURWASAEI');
INSERT INTO `ref_desa` VALUES (4398, 592, 'PURWASARAI');
INSERT INTO `ref_desa` VALUES (4399, 592, 'PURWASARI 1');
INSERT INTO `ref_desa` VALUES (4400, 592, 'PURWASARI I');
INSERT INTO `ref_desa` VALUES (4401, 592, 'PURWASRI');
INSERT INTO `ref_desa` VALUES (4402, 592, 'PURWSARI');
INSERT INTO `ref_desa` VALUES (4403, 592, 'PURWWASARI');
INSERT INTO `ref_desa` VALUES (4404, 592, 'PURWZSZRI');
INSERT INTO `ref_desa` VALUES (4405, 592, 'PUWASARI');
INSERT INTO `ref_desa` VALUES (4406, 592, 'RAWA SIDKIN');
INSERT INTO `ref_desa` VALUES (4407, 592, 'RAWA SINGKIN');
INSERT INTO `ref_desa` VALUES (4408, 592, 'RAWASIDKIN');
INSERT INTO `ref_desa` VALUES (4409, 592, 'SADA MUKTI');
INSERT INTO `ref_desa` VALUES (4410, 592, 'SADAMIKTI');
INSERT INTO `ref_desa` VALUES (4411, 592, 'SADAMUKTI');
INSERT INTO `ref_desa` VALUES (4412, 592, 'SAWAH RANDU');
INSERT INTO `ref_desa` VALUES (4413, 592, 'SEKARWANGI');
INSERT INTO `ref_desa` VALUES (4414, 592, 'SELAJAMBE');
INSERT INTO `ref_desa` VALUES (4415, 592, 'SEUSEUPAN');
INSERT INTO `ref_desa` VALUES (4416, 592, 'SINANG RESMI');
INSERT INTO `ref_desa` VALUES (4417, 592, 'SINANGFALAI');
INSERT INTO `ref_desa` VALUES (4418, 592, 'SINANGPALAI');
INSERT INTO `ref_desa` VALUES (4419, 592, 'SINDANG PALANG');
INSERT INTO `ref_desa` VALUES (4420, 592, 'SINDANG PALAY');
INSERT INTO `ref_desa` VALUES (4421, 592, 'SINDANG PARAI');
INSERT INTO `ref_desa` VALUES (4422, 592, 'SINDANG RESMI');
INSERT INTO `ref_desa` VALUES (4423, 592, 'SINDANG RESMIN');
INSERT INTO `ref_desa` VALUES (4424, 592, 'SINDANG SARI');
INSERT INTO `ref_desa` VALUES (4425, 592, 'SINDANGPALAY');
INSERT INTO `ref_desa` VALUES (4426, 592, 'SINDANNGPPALAY');
INSERT INTO `ref_desa` VALUES (4427, 592, 'SIRANBAKTI');
INSERT INTO `ref_desa` VALUES (4428, 592, 'SIRNA BAKTI');
INSERT INTO `ref_desa` VALUES (4429, 592, 'SIRNA SARI');
INSERT INTO `ref_desa` VALUES (4430, 592, 'SIRNABAKTI');
INSERT INTO `ref_desa` VALUES (4431, 592, 'SIRNAJAYA');
INSERT INTO `ref_desa` VALUES (4432, 592, 'SIRNARESMI');
INSERT INTO `ref_desa` VALUES (4433, 592, 'SIRNASARI');
INSERT INTO `ref_desa` VALUES (4434, 592, 'SUKA JAYA');
INSERT INTO `ref_desa` VALUES (4435, 592, 'SUKA SIRNA');
INSERT INTO `ref_desa` VALUES (4436, 592, 'SUKAJAYA');
INSERT INTO `ref_desa` VALUES (4437, 592, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (4438, 592, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (4439, 592, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (4440, 592, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (4441, 592, 'TANGGERANG');
INSERT INTO `ref_desa` VALUES (4442, 592, 'TANGKIL');
INSERT INTO `ref_desa` VALUES (4443, 592, 'TANJOLAYA');
INSERT INTO `ref_desa` VALUES (4444, 592, 'TANJUNG SARI');
INSERT INTO `ref_desa` VALUES (4445, 592, 'TEBJO AYU');
INSERT INTO `ref_desa` VALUES (4446, 592, 'TEBJO JAYA');
INSERT INTO `ref_desa` VALUES (4447, 592, 'TEJO AYU');
INSERT INTO `ref_desa` VALUES (4448, 592, 'TEJO LAYA');
INSERT INTO `ref_desa` VALUES (4449, 592, 'TEMJOAYU');
INSERT INTO `ref_desa` VALUES (4450, 592, 'TEMNJO AYU');
INSERT INTO `ref_desa` VALUES (4451, 592, 'TENJO AYAU');
INSERT INTO `ref_desa` VALUES (4452, 592, 'TENJO AYU');
INSERT INTO `ref_desa` VALUES (4453, 592, 'TENJO JAYA');
INSERT INTO `ref_desa` VALUES (4454, 592, 'TENJO LAYA');
INSERT INTO `ref_desa` VALUES (4455, 592, 'TENJO RAYA');
INSERT INTO `ref_desa` VALUES (4456, 592, 'TENJOA AYU');
INSERT INTO `ref_desa` VALUES (4457, 592, 'TENJOA YU');
INSERT INTO `ref_desa` VALUES (4458, 592, 'TENJOAYAU');
INSERT INTO `ref_desa` VALUES (4459, 592, 'TENJOJAYA');
INSERT INTO `ref_desa` VALUES (4460, 592, 'TENJOLYA');
INSERT INTO `ref_desa` VALUES (4461, 592, 'TENJON AYU');
INSERT INTO `ref_desa` VALUES (4462, 592, 'TENJOSYU');
INSERT INTO `ref_desa` VALUES (4463, 592, 'TTENJOLAYA');
INSERT INTO `ref_desa` VALUES (4464, 592, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (4465, 592, 'TUGU JYA');
INSERT INTO `ref_desa` VALUES (4466, 592, 'TUGUJAYA');
INSERT INTO `ref_desa` VALUES (4467, 592, 'TUGUJYA');
INSERT INTO `ref_desa` VALUES (4468, 592, 'TWNJOLAYA');
INSERT INTO `ref_desa` VALUES (4469, 592, 'UBRUG');
INSERT INTO `ref_desa` VALUES (4470, 592, 'WANGUN JAYA');
INSERT INTO `ref_desa` VALUES (4471, 592, 'WANGUNJAYA');
INSERT INTO `ref_desa` VALUES (4472, 592, 'WARNAJATI');
INSERT INTO `ref_desa` VALUES (4473, 592, 'WARUGCERI');
INSERT INTO `ref_desa` VALUES (4474, 592, 'WATES JAYA');
INSERT INTO `ref_desa` VALUES (4475, 592, ']CISAT');
INSERT INTO `ref_desa` VALUES (4476, 685, 'BANJAR SARI');
INSERT INTO `ref_desa` VALUES (4477, 685, 'CIADADAP');
INSERT INTO `ref_desa` VALUES (4478, 685, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (4479, 685, 'CIBARENGKOK');
INSERT INTO `ref_desa` VALUES (4480, 685, 'CIBDK');
INSERT INTO `ref_desa` VALUES (4481, 685, 'CIDAAP');
INSERT INTO `ref_desa` VALUES (4482, 685, 'CIDADH');
INSERT INTO `ref_desa` VALUES (4483, 685, 'CIDADP');
INSERT INTO `ref_desa` VALUES (4484, 685, 'CIDAHU');
INSERT INTO `ref_desa` VALUES (4485, 685, 'CIHURANG');
INSERT INTO `ref_desa` VALUES (4486, 685, 'GUNUNGBATU');
INSERT INTO `ref_desa` VALUES (4487, 685, 'HEGAR MULYA');
INSERT INTO `ref_desa` VALUES (4488, 685, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (4489, 685, 'JAYABAKTI');
INSERT INTO `ref_desa` VALUES (4490, 685, 'LEDENG');
INSERT INTO `ref_desa` VALUES (4491, 685, 'PADA SEKAR');
INSERT INTO `ref_desa` VALUES (4492, 685, 'PADA SENANG');
INSERT INTO `ref_desa` VALUES (4493, 685, 'PADASENENG');
INSERT INTO `ref_desa` VALUES (4494, 685, 'PD SENANG');
INSERT INTO `ref_desa` VALUES (4495, 685, 'PERKEBUNAN CIKASINTU');
INSERT INTO `ref_desa` VALUES (4496, 685, 'SIMPENAN');
INSERT INTO `ref_desa` VALUES (4497, 164, '05');
INSERT INTO `ref_desa` VALUES (4498, 164, 'ACIDAHU');
INSERT INTO `ref_desa` VALUES (4499, 164, 'ANKIL CDAHU');
INSERT INTO `ref_desa` VALUES (4500, 164, 'BABABKAN PARI');
INSERT INTO `ref_desa` VALUES (4501, 164, 'BABAKA N PARI');
INSERT INTO `ref_desa` VALUES (4502, 164, 'BABAKA PARI');
INSERT INTO `ref_desa` VALUES (4503, 164, 'BABAKAB PARI');
INSERT INTO `ref_desa` VALUES (4504, 164, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (4505, 164, 'BABAKAN  PARI');
INSERT INTO `ref_desa` VALUES (4506, 164, 'BABAKAN APRI');
INSERT INTO `ref_desa` VALUES (4507, 164, 'BABAKAN JAMBPAMNG');
INSERT INTO `ref_desa` VALUES (4508, 164, 'BABAKAN JAMPANG');
INSERT INTO `ref_desa` VALUES (4509, 164, 'BABAKAN JAY A');
INSERT INTO `ref_desa` VALUES (4510, 164, 'BABAKAN JAYA');
INSERT INTO `ref_desa` VALUES (4511, 164, 'BABAKAN PARAI');
INSERT INTO `ref_desa` VALUES (4512, 164, 'BABAKAN PARI ANYAR');
INSERT INTO `ref_desa` VALUES (4513, 164, 'BABAKAN PEUNDEUY');
INSERT INTO `ref_desa` VALUES (4514, 164, 'BABAKANPARI');
INSERT INTO `ref_desa` VALUES (4515, 164, 'BABAKN PARI');
INSERT INTO `ref_desa` VALUES (4516, 164, 'BABAKNAN PARI');
INSERT INTO `ref_desa` VALUES (4517, 164, 'BABKAN PANJANG');
INSERT INTO `ref_desa` VALUES (4518, 164, 'BABKAN PARI');
INSERT INTO `ref_desa` VALUES (4519, 164, 'BAKAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (4520, 164, 'BAKAN PARI');
INSERT INTO `ref_desa` VALUES (4521, 164, 'BB PARI');
INSERT INTO `ref_desa` VALUES (4522, 164, 'BBAKAN PAARI');
INSERT INTO `ref_desa` VALUES (4523, 164, 'BBAKAN PARI');
INSERT INTO `ref_desa` VALUES (4524, 164, 'BBAKANPARI');
INSERT INTO `ref_desa` VALUES (4525, 164, 'BBKAN JAMPANG');
INSERT INTO `ref_desa` VALUES (4526, 164, 'BBKN PARI');
INSERT INTO `ref_desa` VALUES (4527, 164, 'BENDA');
INSERT INTO `ref_desa` VALUES (4528, 164, 'BJ KOKOSAN');
INSERT INTO `ref_desa` VALUES (4529, 164, 'BJ PARI');
INSERT INTO `ref_desa` VALUES (4530, 164, 'BOJOJNG PARI');
INSERT INTO `ref_desa` VALUES (4531, 164, 'BOJONG  GENTENG');
INSERT INTO `ref_desa` VALUES (4532, 164, 'BOJONG GALING');
INSERT INTO `ref_desa` VALUES (4533, 164, 'BOJONG KAWUNG');
INSERT INTO `ref_desa` VALUES (4534, 164, 'BOJONG PARAI');
INSERT INTO `ref_desa` VALUES (4535, 164, 'BOJONG PARI');
INSERT INTO `ref_desa` VALUES (4536, 164, 'BOJONGPARI');
INSERT INTO `ref_desa` VALUES (4537, 164, 'BOOJNG PARI');
INSERT INTO `ref_desa` VALUES (4538, 164, 'BUMI SARI');
INSERT INTO `ref_desa` VALUES (4539, 164, 'CDAHU CICURUG');
INSERT INTO `ref_desa` VALUES (4540, 164, 'CDAHUCICURUG');
INSERT INTO `ref_desa` VALUES (4541, 164, 'CDATI');
INSERT INTO `ref_desa` VALUES (4542, 164, 'CEURI');
INSERT INTO `ref_desa` VALUES (4543, 164, 'CIADAHU');
INSERT INTO `ref_desa` VALUES (4544, 164, 'CIAHU');
INSERT INTO `ref_desa` VALUES (4545, 164, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (4546, 164, 'CIBALAAGUNG');
INSERT INTO `ref_desa` VALUES (4547, 164, 'CIBOJONG');
INSERT INTO `ref_desa` VALUES (4548, 164, 'CIBUNTU');
INSERT INTO `ref_desa` VALUES (4549, 164, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (4550, 164, 'CICAHU');
INSERT INTO `ref_desa` VALUES (4551, 164, 'CICAREUH');
INSERT INTO `ref_desa` VALUES (4552, 164, 'CICDAHU');
INSERT INTO `ref_desa` VALUES (4553, 164, 'CIDAAAHU');
INSERT INTO `ref_desa` VALUES (4554, 164, 'CIDAAHU');
INSERT INTO `ref_desa` VALUES (4555, 164, 'CIDADAP');
INSERT INTO `ref_desa` VALUES (4556, 164, 'CIDAHI');
INSERT INTO `ref_desa` VALUES (4557, 164, 'CIDAHIU');
INSERT INTO `ref_desa` VALUES (4558, 164, 'CIDAHU CICURUG');
INSERT INTO `ref_desa` VALUES (4559, 164, 'CIDAHU I');
INSERT INTO `ref_desa` VALUES (4560, 164, 'CIDAHU MANGIS');
INSERT INTO `ref_desa` VALUES (4561, 164, 'CIDAHU PASAR');
INSERT INTO `ref_desa` VALUES (4562, 164, 'CIDAHU PENTAS');
INSERT INTO `ref_desa` VALUES (4563, 164, 'CIDAHU PSAR');
INSERT INTO `ref_desa` VALUES (4564, 164, 'CIDAHU TANGKIL');
INSERT INTO `ref_desa` VALUES (4565, 164, 'CIDAHU TONGGOH');
INSERT INTO `ref_desa` VALUES (4566, 164, 'CIDAHU TONGOH');
INSERT INTO `ref_desa` VALUES (4567, 164, 'CIDAHUCICURG');
INSERT INTO `ref_desa` VALUES (4568, 164, 'CIDAHUCICURUG');
INSERT INTO `ref_desa` VALUES (4569, 164, 'CIDAHUI');
INSERT INTO `ref_desa` VALUES (4570, 164, 'CIDAHU]CIDAHU');
INSERT INTO `ref_desa` VALUES (4571, 164, 'CIDAJU');
INSERT INTO `ref_desa` VALUES (4572, 164, 'CIDAU');
INSERT INTO `ref_desa` VALUES (4573, 164, 'CIDHU');
INSERT INTO `ref_desa` VALUES (4574, 164, 'CIGAHU');
INSERT INTO `ref_desa` VALUES (4575, 164, 'CIHDAHU');
INSERT INTO `ref_desa` VALUES (4576, 164, 'CIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (4577, 164, 'CIIAI');
INSERT INTO `ref_desa` VALUES (4578, 164, 'CIJABON');
INSERT INTO `ref_desa` VALUES (4579, 164, 'CIKALONG WETAN');
INSERT INTO `ref_desa` VALUES (4580, 164, 'CILUBANG');
INSERT INTO `ref_desa` VALUES (4581, 164, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (4582, 164, 'CIPAENGAH');
INSERT INTO `ref_desa` VALUES (4583, 164, 'CIPANAS');
INSERT INTO `ref_desa` VALUES (4584, 164, 'CIPANEANGHA');
INSERT INTO `ref_desa` VALUES (4585, 164, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (4586, 164, 'CIPANENGAHA');
INSERT INTO `ref_desa` VALUES (4587, 164, 'CIPARI');
INSERT INTO `ref_desa` VALUES (4588, 164, 'CISAAT');
INSERT INTO `ref_desa` VALUES (4589, 164, 'CISAHU');
INSERT INTO `ref_desa` VALUES (4590, 164, 'CITENGAH');
INSERT INTO `ref_desa` VALUES (4591, 164, 'CUDAHUCIDAHU');
INSERT INTO `ref_desa` VALUES (4592, 164, 'DEPOK');
INSERT INTO `ref_desa` VALUES (4593, 164, 'DIDAHU');
INSERT INTO `ref_desa` VALUES (4594, 164, 'GIIRJAYA');
INSERT INTO `ref_desa` VALUES (4595, 164, 'GIRI  JAYA');
INSERT INTO `ref_desa` VALUES (4596, 164, 'GIRIJAJAYA');
INSERT INTO `ref_desa` VALUES (4597, 164, 'GIRIJAYA');
INSERT INTO `ref_desa` VALUES (4598, 164, 'GIRIJAYACIDAHU');
INSERT INTO `ref_desa` VALUES (4599, 164, 'GUIRI JAYA');
INSERT INTO `ref_desa` VALUES (4600, 164, 'IDAHU CICURUG');
INSERT INTO `ref_desa` VALUES (4601, 164, 'JAYA');
INSERT INTO `ref_desa` VALUES (4602, 164, 'JAYA  BAKTI');
INSERT INTO `ref_desa` VALUES (4603, 164, 'JAYA B AKTI');
INSERT INTO `ref_desa` VALUES (4604, 164, 'JAYA BAKAT');
INSERT INTO `ref_desa` VALUES (4605, 164, 'JAYA BAKRI');
INSERT INTO `ref_desa` VALUES (4606, 164, 'JAYA BAKTI');
INSERT INTO `ref_desa` VALUES (4607, 164, 'JAYA BATI');
INSERT INTO `ref_desa` VALUES (4608, 164, 'JAYA BAYA');
INSERT INTO `ref_desa` VALUES (4609, 164, 'JAYA NBAKTI');
INSERT INTO `ref_desa` VALUES (4610, 164, 'JAYABAKTI');
INSERT INTO `ref_desa` VALUES (4611, 164, 'JAYABKTI');
INSERT INTO `ref_desa` VALUES (4612, 164, 'JAYANAKTI');
INSERT INTO `ref_desa` VALUES (4613, 164, 'JAYUA BAKTI');
INSERT INTO `ref_desa` VALUES (4614, 164, 'JOGJOGAN');
INSERT INTO `ref_desa` VALUES (4615, 164, 'JUKJUKAN');
INSERT INTO `ref_desa` VALUES (4616, 164, 'JYA BAKTI');
INSERT INTO `ref_desa` VALUES (4617, 164, 'KEBON CAU');
INSERT INTO `ref_desa` VALUES (4618, 164, 'KJAYABAKTI');
INSERT INTO `ref_desa` VALUES (4619, 164, 'KJAYANAKTI');
INSERT INTO `ref_desa` VALUES (4620, 164, 'KOMPA');
INSERT INTO `ref_desa` VALUES (4621, 164, 'KOTA BESAR');
INSERT INTO `ref_desa` VALUES (4622, 164, 'KP MANGGIS');
INSERT INTO `ref_desa` VALUES (4623, 164, 'KUTA JAYA');
INSERT INTO `ref_desa` VALUES (4624, 164, 'LEBAK PIJUNG');
INSERT INTO `ref_desa` VALUES (4625, 164, 'LEBAK SARI');
INSERT INTO `ref_desa` VALUES (4626, 164, 'MANGLID');
INSERT INTO `ref_desa` VALUES (4627, 164, 'MARGA JAYA');
INSERT INTO `ref_desa` VALUES (4628, 164, 'MEKAR SARI');
INSERT INTO `ref_desa` VALUES (4629, 164, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (4630, 164, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (4631, 164, 'NAGHRKA BERUIT');
INSERT INTO `ref_desa` VALUES (4632, 164, 'NANGKA BEURIT');
INSERT INTO `ref_desa` VALUES (4633, 164, 'PADA TEGAH');
INSERT INTO `ref_desa` VALUES (4634, 164, 'PADA TENGAH');
INSERT INTO `ref_desa` VALUES (4635, 164, 'PAIR DOTON');
INSERT INTO `ref_desa` VALUES (4636, 164, 'PANAGAN');
INSERT INTO `ref_desa` VALUES (4637, 164, 'PAPISANGAN');
INSERT INTO `ref_desa` VALUES (4638, 164, 'PARAKAN PARI');
INSERT INTO `ref_desa` VALUES (4639, 164, 'PARUNGKUDA');
INSERT INTO `ref_desa` VALUES (4640, 164, 'PASIEDOTON');
INSERT INTO `ref_desa` VALUES (4641, 164, 'PASINGAN');
INSERT INTO `ref_desa` VALUES (4642, 164, 'PASIR  JAYA');
INSERT INTO `ref_desa` VALUES (4643, 164, 'PASIR DALAM');
INSERT INTO `ref_desa` VALUES (4644, 164, 'PASIR DATAR');
INSERT INTO `ref_desa` VALUES (4645, 164, 'PASIR DATON');
INSERT INTO `ref_desa` VALUES (4646, 164, 'PASIR DOOTN');
INSERT INTO `ref_desa` VALUES (4647, 164, 'PASIR DOOTON');
INSERT INTO `ref_desa` VALUES (4648, 164, 'PASIR DOTON');
INSERT INTO `ref_desa` VALUES (4649, 164, 'PASIR DOTON]CIDAHU');
INSERT INTO `ref_desa` VALUES (4650, 164, 'PASIR RENGI');
INSERT INTO `ref_desa` VALUES (4651, 164, 'PASIR RENGIT');
INSERT INTO `ref_desa` VALUES (4652, 164, 'PASIR REUNGIT');
INSERT INTO `ref_desa` VALUES (4653, 164, 'PASIR SARANGAN');
INSERT INTO `ref_desa` VALUES (4654, 164, 'PASIR TANGKIL');
INSERT INTO `ref_desa` VALUES (4655, 164, 'PASIRDALEM');
INSERT INTO `ref_desa` VALUES (4656, 164, 'PASIRDATON');
INSERT INTO `ref_desa` VALUES (4657, 164, 'PASIRDOTON]');
INSERT INTO `ref_desa` VALUES (4658, 164, 'PASIRDOTOON');
INSERT INTO `ref_desa` VALUES (4659, 164, 'PD');
INSERT INTO `ref_desa` VALUES (4660, 164, 'PD  KASO');
INSERT INTO `ref_desa` VALUES (4661, 164, 'PD KASO');
INSERT INTO `ref_desa` VALUES (4662, 164, 'PD KASO L');
INSERT INTO `ref_desa` VALUES (4663, 164, 'PD KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4664, 164, 'PD KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4665, 164, 'PD KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4666, 164, 'PD TENGAH');
INSERT INTO `ref_desa` VALUES (4667, 164, 'PD. KASO');
INSERT INTO `ref_desa` VALUES (4668, 164, 'PD. KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4669, 164, 'PD. KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4670, 164, 'PD.KASO');
INSERT INTO `ref_desa` VALUES (4671, 164, 'PD.KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4672, 164, 'PD.KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4673, 164, 'PDK KASO');
INSERT INTO `ref_desa` VALUES (4674, 164, 'PDK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4675, 164, 'PDK KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4676, 164, 'PDK KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4677, 164, 'PDK TENGAH');
INSERT INTO `ref_desa` VALUES (4678, 164, 'PDK. KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4679, 164, 'PDK. TONGGOH');
INSERT INTO `ref_desa` VALUES (4680, 164, 'PDK.KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4681, 164, 'PDKASO TENGAH');
INSERT INTO `ref_desa` VALUES (4682, 164, 'PDKASOLANDEH');
INSERT INTO `ref_desa` VALUES (4683, 164, 'PN KASO');
INSERT INTO `ref_desa` VALUES (4684, 164, 'PNDOK KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4685, 164, 'PNDOKASO TENGAH');
INSERT INTO `ref_desa` VALUES (4686, 164, 'PNGK KASO');
INSERT INTO `ref_desa` VALUES (4687, 164, 'PO9NDOKKASO TENGAH');
INSERT INTO `ref_desa` VALUES (4688, 164, 'PODOK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4689, 164, 'PODOKKASO');
INSERT INTO `ref_desa` VALUES (4690, 164, 'PONDIK KASO');
INSERT INTO `ref_desa` VALUES (4691, 164, 'PONDIK KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4692, 164, 'PONDIOK KAO TONGGOH');
INSERT INTO `ref_desa` VALUES (4693, 164, 'PONDIOK KASO');
INSERT INTO `ref_desa` VALUES (4694, 164, 'PONDIOKKASO TENGAH');
INSERT INTO `ref_desa` VALUES (4695, 164, 'PONDK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4696, 164, 'PONDKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4697, 164, 'PONDO KASO');
INSERT INTO `ref_desa` VALUES (4698, 164, 'PONDO KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4699, 164, 'PONDO LANDEH');
INSERT INTO `ref_desa` VALUES (4700, 164, 'PONDOK AKSO  TONGGOHANDEUH');
INSERT INTO `ref_desa` VALUES (4701, 164, 'PONDOK AKSO LANDEUH');
INSERT INTO `ref_desa` VALUES (4702, 164, 'PONDOK ASOLANDEH');
INSERT INTO `ref_desa` VALUES (4703, 164, 'PONDOK KAOS TENGAH');
INSERT INTO `ref_desa` VALUES (4704, 164, 'PONDOK KASO');
INSERT INTO `ref_desa` VALUES (4705, 164, 'PONDOK KASO LADEUH');
INSERT INTO `ref_desa` VALUES (4706, 164, 'PONDOK KASO LAN DEUH');
INSERT INTO `ref_desa` VALUES (4707, 164, 'PONDOK KASO LANDEUH');
INSERT INTO `ref_desa` VALUES (4708, 164, 'PONDOK KASO LANDEUH TONGOH');
INSERT INTO `ref_desa` VALUES (4709, 164, 'PONDOK KASO TENAGH');
INSERT INTO `ref_desa` VALUES (4710, 164, 'PONDOK KASO TONGGH');
INSERT INTO `ref_desa` VALUES (4711, 164, 'PONDOK KASO TONGOH');
INSERT INTO `ref_desa` VALUES (4712, 164, 'PONDOK KASO TONNGOH');
INSERT INTO `ref_desa` VALUES (4713, 164, 'PONDOK KASO TON]');
INSERT INTO `ref_desa` VALUES (4714, 164, 'PONDOK KASOTONGGOH');
INSERT INTO `ref_desa` VALUES (4715, 164, 'PONDOK KKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4716, 164, 'PONDOK KOASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4717, 164, 'PONDOK KSO');
INSERT INTO `ref_desa` VALUES (4718, 164, 'PONDOK KSO TONGGOH');
INSERT INTO `ref_desa` VALUES (4719, 164, 'PONDOK TEANAGAH');
INSERT INTO `ref_desa` VALUES (4720, 164, 'PONDOK TENGAH');
INSERT INTO `ref_desa` VALUES (4721, 164, 'PONDOK TONGGOH');
INSERT INTO `ref_desa` VALUES (4722, 164, 'PONDOK TONGOH');
INSERT INTO `ref_desa` VALUES (4723, 164, 'PONDOKA KSO TENGAH');
INSERT INTO `ref_desa` VALUES (4724, 164, 'PONDOKAKSO TENGAH');
INSERT INTO `ref_desa` VALUES (4725, 164, 'PONDOKASO');
INSERT INTO `ref_desa` VALUES (4726, 164, 'PONDOKASO TENGAH');
INSERT INTO `ref_desa` VALUES (4727, 164, 'PONDOKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4728, 164, 'PONDOKASO TONGOH');
INSERT INTO `ref_desa` VALUES (4729, 164, 'PONDOKASOTENGAH');
INSERT INTO `ref_desa` VALUES (4730, 164, 'PONDOKASOTONGGOH');
INSERT INTO `ref_desa` VALUES (4731, 164, 'PONDOKKADO');
INSERT INTO `ref_desa` VALUES (4732, 164, 'PONDOKKASO');
INSERT INTO `ref_desa` VALUES (4733, 164, 'PONDOKKASO TANGGOH');
INSERT INTO `ref_desa` VALUES (4734, 164, 'PONDOKKASO TENGAH');
INSERT INTO `ref_desa` VALUES (4735, 164, 'PONDOKKASO TONGGAH');
INSERT INTO `ref_desa` VALUES (4736, 164, 'PONDOKKASO TONGGIH');
INSERT INTO `ref_desa` VALUES (4737, 164, 'PONDOKKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4738, 164, 'PONDOKKASO TONGOH');
INSERT INTO `ref_desa` VALUES (4739, 164, 'PONDOKKASO TOPNGGOH');
INSERT INTO `ref_desa` VALUES (4740, 164, 'PONDOKKASOTENGAH');
INSERT INTO `ref_desa` VALUES (4741, 164, 'PONDOKKASOTONGGOH');
INSERT INTO `ref_desa` VALUES (4742, 164, 'PONDOKKASOTONGGOK');
INSERT INTO `ref_desa` VALUES (4743, 164, 'PONDOKKASOTONGOH');
INSERT INTO `ref_desa` VALUES (4744, 164, 'PONDOKKASSO');
INSERT INTO `ref_desa` VALUES (4745, 164, 'PONDOKKASSO TONGGOH');
INSERT INTO `ref_desa` VALUES (4746, 164, 'PONDOKKSAO');
INSERT INTO `ref_desa` VALUES (4747, 164, 'PONDOKOSATONGGOH');
INSERT INTO `ref_desa` VALUES (4748, 164, 'PONDOKTONGGOH');
INSERT INTO `ref_desa` VALUES (4749, 164, 'PONKASO TONGGOH');
INSERT INTO `ref_desa` VALUES (4750, 164, 'POPONDOKASO TENGAH');
INSERT INTO `ref_desa` VALUES (4751, 164, 'PPONDOK KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4752, 164, 'PS DOTON');
INSERT INTO `ref_desa` VALUES (4753, 164, 'PS KASO');
INSERT INTO `ref_desa` VALUES (4754, 164, 'PS REUNGIT');
INSERT INTO `ref_desa` VALUES (4755, 164, 'PSR DOTON');
INSERT INTO `ref_desa` VALUES (4756, 164, 'PSR. KLOTOK');
INSERT INTO `ref_desa` VALUES (4757, 164, 'PSR.DOTON');
INSERT INTO `ref_desa` VALUES (4758, 164, 'PT KOIN BAJU');
INSERT INTO `ref_desa` VALUES (4759, 164, 'SADA MUKTI');
INSERT INTO `ref_desa` VALUES (4760, 164, 'SELAGADOG');
INSERT INTO `ref_desa` VALUES (4761, 164, 'SPONDOK KASO TENGAH');
INSERT INTO `ref_desa` VALUES (4762, 164, 'TABNGKIL');
INSERT INTO `ref_desa` VALUES (4763, 164, 'TALANG');
INSERT INTO `ref_desa` VALUES (4764, 164, 'TAMNGKIL');
INSERT INTO `ref_desa` VALUES (4765, 164, 'TANGKI');
INSERT INTO `ref_desa` VALUES (4766, 164, 'TANGKIL I');
INSERT INTO `ref_desa` VALUES (4767, 164, 'TANGKLI');
INSERT INTO `ref_desa` VALUES (4768, 164, 'TENGAH');
INSERT INTO `ref_desa` VALUES (4769, 164, 'TENJO JAYA');
INSERT INTO `ref_desa` VALUES (4770, 164, 'TENJOAYU');
INSERT INTO `ref_desa` VALUES (4771, 164, 'TUGU');
INSERT INTO `ref_desa` VALUES (4772, 164, 'WANGUN JAYA');
INSERT INTO `ref_desa` VALUES (4773, 164, 'WARUGCERI');
INSERT INTO `ref_desa` VALUES (4774, 164, 'WARUNGCERI');
INSERT INTO `ref_desa` VALUES (4775, 688, 'CIBARENGKOK');
INSERT INTO `ref_desa` VALUES (4776, 688, 'CIDALAM');
INSERT INTO `ref_desa` VALUES (4777, 688, 'CIDOLANG');
INSERT INTO `ref_desa` VALUES (4778, 688, 'CIKABANG');
INSERT INTO `ref_desa` VALUES (4779, 688, 'CIMANGGIS');
INSERT INTO `ref_desa` VALUES (4780, 688, 'CIPADALI');
INSERT INTO `ref_desa` VALUES (4781, 688, 'CIPAMANGIS');
INSERT INTO `ref_desa` VALUES (4782, 688, 'CIPAMANGKAS');
INSERT INTO `ref_desa` VALUES (4783, 688, 'CIPAMIIS');
INSERT INTO `ref_desa` VALUES (4784, 688, 'CIPAMINPIS');
INSERT INTO `ref_desa` VALUES (4785, 688, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (4786, 688, 'MEKAR JAYA');
INSERT INTO `ref_desa` VALUES (4787, 688, 'SAGARANTEN');
INSERT INTO `ref_desa` VALUES (4788, 688, 'TEGAL LEGA');
INSERT INTO `ref_desa` VALUES (4789, 688, 'TEGALEGA');
INSERT INTO `ref_desa` VALUES (4790, 690, 'BANDDRA JAYA');
INSERT INTO `ref_desa` VALUES (4791, 690, 'BENDA');
INSERT INTO `ref_desa` VALUES (4792, 690, 'BOJONGKEMABAR');
INSERT INTO `ref_desa` VALUES (4793, 690, 'CIBUNDA');
INSERT INTO `ref_desa` VALUES (4794, 690, 'CIWANGU');
INSERT INTO `ref_desa` VALUES (4795, 690, 'GIRI MUKTI');
INSERT INTO `ref_desa` VALUES (4796, 690, 'GIRMUKTI');
INSERT INTO `ref_desa` VALUES (4797, 690, 'KEKARJAYA');
INSERT INTO `ref_desa` VALUES (4798, 690, 'MANDRA JAYA');
INSERT INTO `ref_desa` VALUES (4799, 690, 'MEKAR JAYA');
INSERT INTO `ref_desa` VALUES (4800, 690, 'PASIRMANGGU');
INSERT INTO `ref_desa` VALUES (4801, 690, 'SINAR JAYA');
INSERT INTO `ref_desa` VALUES (4802, 690, 'TAMAN JAYA');
INSERT INTO `ref_desa` VALUES (4803, 690, 'WARU');
INSERT INTO `ref_desa` VALUES (4804, 142, 'BENDA');
INSERT INTO `ref_desa` VALUES (4805, 142, 'BIGOMBOMG');
INSERT INTO `ref_desa` VALUES (4806, 142, 'CIADEG');
INSERT INTO `ref_desa` VALUES (4807, 142, 'CIBOMOBONG');
INSERT INTO `ref_desa` VALUES (4808, 142, 'CIBURAY');
INSERT INTO `ref_desa` VALUES (4809, 142, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (4810, 142, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (4811, 142, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (4812, 142, 'CIGOMBONGF');
INSERT INTO `ref_desa` VALUES (4813, 142, 'CIGPMBONG');
INSERT INTO `ref_desa` VALUES (4814, 142, 'CIHGOMBONG');
INSERT INTO `ref_desa` VALUES (4815, 142, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (4816, 142, 'CILETUH');
INSERT INTO `ref_desa` VALUES (4817, 142, 'CINAGARA');
INSERT INTO `ref_desa` VALUES (4818, 142, 'CISALADA');
INSERT INTO `ref_desa` VALUES (4819, 142, 'LIDO');
INSERT INTO `ref_desa` VALUES (4820, 142, 'PASIR JAYA');
INSERT INTO `ref_desa` VALUES (4821, 142, 'PASIRJAYA');
INSERT INTO `ref_desa` VALUES (4822, 142, 'PT HIT EMIK');
INSERT INTO `ref_desa` VALUES (4823, 142, 'SEROGOL');
INSERT INTO `ref_desa` VALUES (4824, 142, 'SROGOL');
INSERT INTO `ref_desa` VALUES (4825, 142, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (4826, 142, 'TUGUJAYA');
INSERT INTO `ref_desa` VALUES (4827, 142, 'WATES JAYA');
INSERT INTO `ref_desa` VALUES (4828, 167, 'BUNGBULANG');
INSERT INTO `ref_desa` VALUES (4829, 167, 'C IJANGKAAR');
INSERT INTO `ref_desa` VALUES (4830, 167, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (4831, 167, 'CIBANGBARA');
INSERT INTO `ref_desa` VALUES (4832, 167, 'CIJANGKAR');
INSERT INTO `ref_desa` VALUES (4833, 167, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (4834, 167, 'PASIRMUNDING');
INSERT INTO `ref_desa` VALUES (4835, 167, 'SIRNA GALIH');
INSERT INTO `ref_desa` VALUES (4836, 143, 'CIBALUNG');
INSERT INTO `ref_desa` VALUES (4837, 143, 'CIBURAYUT');
INSERT INTO `ref_desa` VALUES (4838, 143, 'CIBURUY');
INSERT INTO `ref_desa` VALUES (4839, 143, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (4840, 143, 'CIJAMBU');
INSERT INTO `ref_desa` VALUES (4841, 143, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (4842, 143, 'CIPELANG');
INSERT INTO `ref_desa` VALUES (4843, 143, 'CIPICUNG');
INSERT INTO `ref_desa` VALUES (4844, 143, 'CISALADA');
INSERT INTO `ref_desa` VALUES (4845, 143, 'SROGOL');
INSERT INTO `ref_desa` VALUES (4846, 143, 'WATES JAYA');
INSERT INTO `ref_desa` VALUES (4847, 143, 'WATESJAYA');
INSERT INTO `ref_desa` VALUES (4848, 143, 'WATEUS JAYA');
INSERT INTO `ref_desa` VALUES (4849, 672, 'CILENGSING');
INSERT INTO `ref_desa` VALUES (4850, 672, 'CILEUNGSI');
INSERT INTO `ref_desa` VALUES (4851, 672, 'CIPEDES');
INSERT INTO `ref_desa` VALUES (4852, 672, 'COIMAJA');
INSERT INTO `ref_desa` VALUES (4853, 672, 'KP PANGGUYANGAN');
INSERT INTO `ref_desa` VALUES (4854, 672, 'LIDO GALIH');
INSERT INTO `ref_desa` VALUES (4855, 672, 'LIDOGALIH');
INSERT INTO `ref_desa` VALUES (4856, 672, 'MARGA LAKSANA');
INSERT INTO `ref_desa` VALUES (4857, 672, 'MARGALAYU');
INSERT INTO `ref_desa` VALUES (4858, 672, 'PASIR BADAK');
INSERT INTO `ref_desa` VALUES (4859, 672, 'RIDO GALIH');
INSERT INTO `ref_desa` VALUES (4860, 672, 'RIDO GALING');
INSERT INTO `ref_desa` VALUES (4861, 672, 'SINAR RASA');
INSERT INTO `ref_desa` VALUES (4862, 672, 'SIRNA RASA');
INSERT INTO `ref_desa` VALUES (4863, 672, 'SIRNARESMI');
INSERT INTO `ref_desa` VALUES (4864, 672, 'SUKA MAJU');
INSERT INTO `ref_desa` VALUES (4865, 169, '+CCIKEMBAR');
INSERT INTO `ref_desa` VALUES (4866, 169, 'ACGRUG');
INSERT INTO `ref_desa` VALUES (4867, 169, 'ACIKEMBAR');
INSERT INTO `ref_desa` VALUES (4868, 169, 'ACIKRMBAR');
INSERT INTO `ref_desa` VALUES (4869, 169, 'ARMED');
INSERT INTO `ref_desa` VALUES (4870, 169, 'ASRAMA');
INSERT INTO `ref_desa` VALUES (4871, 169, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (4872, 169, 'BALEKAMBAG');
INSERT INTO `ref_desa` VALUES (4873, 169, 'BATU HEJO');
INSERT INTO `ref_desa` VALUES (4874, 169, 'BATUNUNGGAL');
INSERT INTO `ref_desa` VALUES (4875, 169, 'BIOJONG KEMBAR');
INSERT INTO `ref_desa` VALUES (4876, 169, 'BJ');
INSERT INTO `ref_desa` VALUES (4877, 169, 'BJ KEMABAR');
INSERT INTO `ref_desa` VALUES (4878, 169, 'BJ KEMBANG');
INSERT INTO `ref_desa` VALUES (4879, 169, 'BJ KEMBAR');
INSERT INTO `ref_desa` VALUES (4880, 169, 'BJ KERTA');
INSERT INTO `ref_desa` VALUES (4881, 169, 'BJ. KEMBAR');
INSERT INTO `ref_desa` VALUES (4882, 169, 'BJ.KEMBAR');
INSERT INTO `ref_desa` VALUES (4883, 169, 'BJ.KEMBAT');
INSERT INTO `ref_desa` VALUES (4884, 169, 'BNOJONG KEMBAR');
INSERT INTO `ref_desa` VALUES (4885, 169, 'BOJNG KEMBAR');
INSERT INTO `ref_desa` VALUES (4886, 169, 'BOJOBG KEMBAR');
INSERT INTO `ref_desa` VALUES (4887, 169, 'BOJOMNGKEAMBAR');
INSERT INTO `ref_desa` VALUES (4888, 169, 'BOJOMNGLONGOK');
INSERT INTO `ref_desa` VALUES (4889, 169, 'BOJONBG');
INSERT INTO `ref_desa` VALUES (4890, 169, 'BOJONG  GENTENG');
INSERT INTO `ref_desa` VALUES (4891, 169, 'BOJONG BABAKAN');
INSERT INTO `ref_desa` VALUES (4892, 169, 'BOJONG CIKENVAR');
INSERT INTO `ref_desa` VALUES (4893, 169, 'BOJONG CUKEAMABAR');
INSERT INTO `ref_desa` VALUES (4894, 169, 'BOJONG EBAR');
INSERT INTO `ref_desa` VALUES (4895, 169, 'BOJONG INDAH');
INSERT INTO `ref_desa` VALUES (4896, 169, 'BOJONG INDUK');
INSERT INTO `ref_desa` VALUES (4897, 169, 'BOJONG KALER');
INSERT INTO `ref_desa` VALUES (4898, 169, 'BOJONG KAMBAR');
INSERT INTO `ref_desa` VALUES (4899, 169, 'BOJONG KEAMABAR');
INSERT INTO `ref_desa` VALUES (4900, 169, 'BOJONG KEAMABR');
INSERT INTO `ref_desa` VALUES (4901, 169, 'BOJONG KEMAABAR');
INSERT INTO `ref_desa` VALUES (4902, 169, 'BOJONG KEMABAR');
INSERT INTO `ref_desa` VALUES (4903, 169, 'BOJONG KEMABR');
INSERT INTO `ref_desa` VALUES (4904, 169, 'BOJONG KEMBANG');
INSERT INTO `ref_desa` VALUES (4905, 169, 'BOJONG KEMBANR');
INSERT INTO `ref_desa` VALUES (4906, 169, 'BOJONG KEMBAR');
INSERT INTO `ref_desa` VALUES (4907, 169, 'BOJONG KEMNAR');
INSERT INTO `ref_desa` VALUES (4908, 169, 'BOJONG KERTA');
INSERT INTO `ref_desa` VALUES (4909, 169, 'BOJONG KIDUL');
INSERT INTO `ref_desa` VALUES (4910, 169, 'BOJONG KONENG');
INSERT INTO `ref_desa` VALUES (4911, 169, 'BOJONG RANGKAS');
INSERT INTO `ref_desa` VALUES (4912, 169, 'BOJONG SARI');
INSERT INTO `ref_desa` VALUES (4913, 169, 'BOJONGCIKEMBAR');
INSERT INTO `ref_desa` VALUES (4914, 169, 'BOJONGCKEMBAR');
INSERT INTO `ref_desa` VALUES (4915, 169, 'BOJONGKEAMABAR');
INSERT INTO `ref_desa` VALUES (4916, 169, 'BOJONGKEBAR');
INSERT INTO `ref_desa` VALUES (4917, 169, 'BOJONGKEEMABR');
INSERT INTO `ref_desa` VALUES (4918, 169, 'BOJONGKEMABAR');
INSERT INTO `ref_desa` VALUES (4919, 169, 'BOJONGKEMBANG');
INSERT INTO `ref_desa` VALUES (4920, 169, 'BOJONGWARUNG');
INSERT INTO `ref_desa` VALUES (4921, 169, 'BOOJONG KEMBAR');
INSERT INTO `ref_desa` VALUES (4922, 169, 'BOONGKEMBAR');
INSERT INTO `ref_desa` VALUES (4923, 169, 'BPOJONG KEMBAR');
INSERT INTO `ref_desa` VALUES (4924, 169, 'CAGGU CIEMBAR');
INSERT INTO `ref_desa` VALUES (4925, 169, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (4926, 169, 'CBOJONG');
INSERT INTO `ref_desa` VALUES (4927, 169, 'CIANGSANA');
INSERT INTO `ref_desa` VALUES (4928, 169, 'CIBAATU');
INSERT INTO `ref_desa` VALUES (4929, 169, 'CIBARENGKOK');
INSERT INTO `ref_desa` VALUES (4930, 169, 'CIBARU CIJERUK');
INSERT INTO `ref_desa` VALUES (4931, 169, 'CIBATU CIKEMBBAR');
INSERT INTO `ref_desa` VALUES (4932, 169, 'CIBEREUM');
INSERT INTO `ref_desa` VALUES (4933, 169, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (4934, 169, 'CIBOJONG');
INSERT INTO `ref_desa` VALUES (4935, 169, 'CIBULUH');
INSERT INTO `ref_desa` VALUES (4936, 169, 'CIBULUH BOGOR');
INSERT INTO `ref_desa` VALUES (4937, 169, 'CICAATIH');
INSERT INTO `ref_desa` VALUES (4938, 169, 'CICATIH');
INSERT INTO `ref_desa` VALUES (4939, 169, 'CIEKMBANG');
INSERT INTO `ref_desa` VALUES (4940, 169, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (4941, 169, 'CIIMANGGU');
INSERT INTO `ref_desa` VALUES (4942, 169, 'CIJALINGAN');
INSERT INTO `ref_desa` VALUES (4943, 169, 'CIJERUK');
INSERT INTO `ref_desa` VALUES (4944, 169, 'CIKAMERANG');
INSERT INTO `ref_desa` VALUES (4945, 169, 'CIKANDANG');
INSERT INTO `ref_desa` VALUES (4946, 169, 'CIKAREO');
INSERT INTO `ref_desa` VALUES (4947, 169, 'CIKATE');
INSERT INTO `ref_desa` VALUES (4948, 169, 'CIKEABAR');
INSERT INTO `ref_desa` VALUES (4949, 169, 'CIKEAMABANG');
INSERT INTO `ref_desa` VALUES (4950, 169, 'CIKEAMABAR');
INSERT INTO `ref_desa` VALUES (4951, 169, 'CIKEAMABARA');
INSERT INTO `ref_desa` VALUES (4952, 169, 'CIKEAMABR');
INSERT INTO `ref_desa` VALUES (4953, 169, 'CIKEAMABRA');
INSERT INTO `ref_desa` VALUES (4954, 169, 'CIKEAMBANG');
INSERT INTO `ref_desa` VALUES (4955, 169, 'CIKEAMBAR');
INSERT INTO `ref_desa` VALUES (4956, 169, 'CIKEAMBR');
INSERT INTO `ref_desa` VALUES (4957, 169, 'CIKEAR');
INSERT INTO `ref_desa` VALUES (4958, 169, 'CIKEBANG');
INSERT INTO `ref_desa` VALUES (4959, 169, 'CIKEBAR');
INSERT INTO `ref_desa` VALUES (4960, 169, 'CIKEM');
INSERT INTO `ref_desa` VALUES (4961, 169, 'CIKEMABANG');
INSERT INTO `ref_desa` VALUES (4962, 169, 'CIKEMABAR');
INSERT INTO `ref_desa` VALUES (4963, 169, 'CIKEMABR');
INSERT INTO `ref_desa` VALUES (4964, 169, 'CIKEMANG');
INSERT INTO `ref_desa` VALUES (4965, 169, 'CIKEMAR');
INSERT INTO `ref_desa` VALUES (4966, 169, 'CIKEMBA');
INSERT INTO `ref_desa` VALUES (4967, 169, 'CIKEMBABAR');
INSERT INTO `ref_desa` VALUES (4968, 169, 'CIKEMBAN');
INSERT INTO `ref_desa` VALUES (4969, 169, 'CIKEMBANAG');
INSERT INTO `ref_desa` VALUES (4970, 169, 'CIKEMBANG');
INSERT INTO `ref_desa` VALUES (4971, 169, 'CIKEMBANG CIMANGGU');
INSERT INTO `ref_desa` VALUES (4972, 169, 'CIKEMBANGT');
INSERT INTO `ref_desa` VALUES (4973, 169, 'CIKEMBANR');
INSERT INTO `ref_desa` VALUES (4974, 169, 'CIKEMBAR?CIKEMBAR');
INSERT INTO `ref_desa` VALUES (4975, 169, 'CIKEMBNAG');
INSERT INTO `ref_desa` VALUES (4976, 169, 'CIKEMBR');
INSERT INTO `ref_desa` VALUES (4977, 169, 'CIKEMBVNAG');
INSERT INTO `ref_desa` VALUES (4978, 169, 'CIKEMMBAR');
INSERT INTO `ref_desa` VALUES (4979, 169, 'CIKEMVAR');
INSERT INTO `ref_desa` VALUES (4980, 169, 'CIKERMBAR');
INSERT INTO `ref_desa` VALUES (4981, 169, 'CIKIRAY');
INSERT INTO `ref_desa` VALUES (4982, 169, 'CIKIEMBAR');
INSERT INTO `ref_desa` VALUES (4983, 169, 'CIKLEMBANG');
INSERT INTO `ref_desa` VALUES (4984, 169, 'CIKMBARA');
INSERT INTO `ref_desa` VALUES (4985, 169, 'CIKMEBAR');
INSERT INTO `ref_desa` VALUES (4986, 169, 'CIKRMBANG');
INSERT INTO `ref_desa` VALUES (4987, 169, 'CIKRNGKAP');
INSERT INTO `ref_desa` VALUES (4988, 169, 'CILAKSANA');
INSERT INTO `ref_desa` VALUES (4989, 169, 'CILANGKAP');
INSERT INTO `ref_desa` VALUES (4990, 169, 'CILKEMBANG');
INSERT INTO `ref_desa` VALUES (4991, 169, 'CILKSANA');
INSERT INTO `ref_desa` VALUES (4992, 169, 'CIM,ENTAENG');
INSERT INTO `ref_desa` VALUES (4993, 169, 'CIMAGGU');
INSERT INTO `ref_desa` VALUES (4994, 169, 'CIMAGU');
INSERT INTO `ref_desa` VALUES (4995, 169, 'CIMAHI');
INSERT INTO `ref_desa` VALUES (4996, 169, 'CIMANGU');
INSERT INTO `ref_desa` VALUES (4997, 169, 'CIMANGUU');
INSERT INTO `ref_desa` VALUES (4998, 169, 'CIMANNGU');
INSERT INTO `ref_desa` VALUES (4999, 169, 'CIMARU');
INSERT INTO `ref_desa` VALUES (5000, 169, 'CIMEANTENG');
INSERT INTO `ref_desa` VALUES (5001, 169, 'CIMENGGU');
INSERT INTO `ref_desa` VALUES (5002, 169, 'CIMENTANG');
INSERT INTO `ref_desa` VALUES (5003, 169, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (5004, 169, 'CIMKEMBAR');
INSERT INTO `ref_desa` VALUES (5005, 169, 'CIMNGGU');
INSERT INTO `ref_desa` VALUES (5006, 169, 'CIMSNGGU');
INSERT INTO `ref_desa` VALUES (5007, 169, 'CINAMGGU');
INSERT INTO `ref_desa` VALUES (5008, 169, 'CINANGGGU');
INSERT INTO `ref_desa` VALUES (5009, 169, 'CINANGGU');
INSERT INTO `ref_desa` VALUES (5010, 169, 'CINATU');
INSERT INTO `ref_desa` VALUES (5011, 169, 'CINBATU');
INSERT INTO `ref_desa` VALUES (5012, 169, 'CINGGU');
INSERT INTO `ref_desa` VALUES (5013, 169, 'CINMANGGU');
INSERT INTO `ref_desa` VALUES (5014, 169, 'CIORAY');
INSERT INTO `ref_desa` VALUES (5015, 169, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (5016, 169, 'CIPANENNGAH');
INSERT INTO `ref_desa` VALUES (5017, 169, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (5018, 169, 'CIPICUNG');
INSERT INTO `ref_desa` VALUES (5019, 169, 'CIRUMPUT');
INSERT INTO `ref_desa` VALUES (5020, 169, 'CISALAK');
INSERT INTO `ref_desa` VALUES (5021, 169, 'CISESEPAN');
INSERT INTO `ref_desa` VALUES (5022, 169, 'CISEUPAN');
INSERT INTO `ref_desa` VALUES (5023, 169, 'CISOGOM');
INSERT INTO `ref_desa` VALUES (5024, 169, 'CISONGGOM');
INSERT INTO `ref_desa` VALUES (5025, 169, 'CITANGLAR');
INSERT INTO `ref_desa` VALUES (5026, 169, 'CITATIH');
INSERT INTO `ref_desa` VALUES (5027, 169, 'CITEAGAH');
INSERT INTO `ref_desa` VALUES (5028, 169, 'CITENGAH');
INSERT INTO `ref_desa` VALUES (5029, 169, 'CITENGKOR');
INSERT INTO `ref_desa` VALUES (5030, 169, 'CIUKEMBANG');
INSERT INTO `ref_desa` VALUES (5031, 169, 'CKAREO');
INSERT INTO `ref_desa` VALUES (5032, 169, 'CKEBAR');
INSERT INTO `ref_desa` VALUES (5033, 169, 'CMANGGU');
INSERT INTO `ref_desa` VALUES (5034, 169, 'COGARUNG');
INSERT INTO `ref_desa` VALUES (5035, 169, 'CUMANGGU');
INSERT INTO `ref_desa` VALUES (5036, 169, 'CURUG KEMBAR');
INSERT INTO `ref_desa` VALUES (5037, 169, 'DESA BOJONG KEMBAR');
INSERT INTO `ref_desa` VALUES (5038, 169, 'DS SUKAMULYA');
INSERT INTO `ref_desa` VALUES (5039, 169, 'DS.SUKAMULYA');
INSERT INTO `ref_desa` VALUES (5040, 169, 'GANASO0LI');
INSERT INTO `ref_desa` VALUES (5041, 169, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (5042, 169, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (5043, 169, 'IGOBONG');
INSERT INTO `ref_desa` VALUES (5044, 169, 'IKEMABAR');
INSERT INTO `ref_desa` VALUES (5045, 169, 'IKEMBAER');
INSERT INTO `ref_desa` VALUES (5046, 169, 'JAYA BAKTI');
INSERT INTO `ref_desa` VALUES (5047, 169, 'JL. CAGAK');
INSERT INTO `ref_desa` VALUES (5048, 169, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (5049, 169, 'KARTA RAHARJA');
INSERT INTO `ref_desa` VALUES (5050, 169, 'KARTARAHARJA');
INSERT INTO `ref_desa` VALUES (5051, 169, 'KB JERUK');
INSERT INTO `ref_desa` VALUES (5052, 169, 'KB. WARU');
INSERT INTO `ref_desa` VALUES (5053, 169, 'KBJERUK');
INSERT INTO `ref_desa` VALUES (5054, 169, 'KBN JERUK');
INSERT INTO `ref_desa` VALUES (5055, 169, 'KEBON JERUK');
INSERT INTO `ref_desa` VALUES (5056, 169, 'KEBON WARU');
INSERT INTO `ref_desa` VALUES (5057, 169, 'KEBONJERUK');
INSERT INTO `ref_desa` VALUES (5058, 169, 'KERTA HARJA');
INSERT INTO `ref_desa` VALUES (5059, 169, 'KERTA RAHARJA');
INSERT INTO `ref_desa` VALUES (5060, 169, 'KERTA RAJAHARJA');
INSERT INTO `ref_desa` VALUES (5061, 169, 'KERTAHARJA');
INSERT INTO `ref_desa` VALUES (5062, 169, 'KERTAKARJA');
INSERT INTO `ref_desa` VALUES (5063, 169, 'KERTALAHARJA');
INSERT INTO `ref_desa` VALUES (5064, 169, 'KERTAMIHARJA');
INSERT INTO `ref_desa` VALUES (5065, 169, 'KERTARAH ARJA');
INSERT INTO `ref_desa` VALUES (5066, 169, 'KERTARAHAJA');
INSERT INTO `ref_desa` VALUES (5067, 169, 'KERTARAHARUJA');
INSERT INTO `ref_desa` VALUES (5068, 169, 'KERTARAHRJA');
INSERT INTO `ref_desa` VALUES (5069, 169, 'KUBANG');
INSERT INTO `ref_desa` VALUES (5070, 169, 'LEMBUR SITU');
INSERT INTO `ref_desa` VALUES (5071, 169, 'LEMBUR TENGAH');
INSERT INTO `ref_desa` VALUES (5072, 169, 'MANDALING');
INSERT INTO `ref_desa` VALUES (5073, 169, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (5074, 169, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (5075, 169, 'MUNJUL');
INSERT INTO `ref_desa` VALUES (5076, 169, 'NETGLASARI');
INSERT INTO `ref_desa` VALUES (5077, 169, 'NOJONG LONGGK');
INSERT INTO `ref_desa` VALUES (5078, 169, 'NOJONG LONGGOK');
INSERT INTO `ref_desa` VALUES (5079, 169, 'NOJONGKEMBAR');
INSERT INTO `ref_desa` VALUES (5080, 169, 'PAAKANLIMA');
INSERT INTO `ref_desa` VALUES (5081, 169, 'PADA BENGHAR');
INSERT INTO `ref_desa` VALUES (5082, 169, 'PADA SUKA');
INSERT INTO `ref_desa` VALUES (5083, 169, 'PADASUKA');
INSERT INTO `ref_desa` VALUES (5084, 169, 'PALABUHAN RATU');
INSERT INTO `ref_desa` VALUES (5085, 169, 'PANGANTOLAN');
INSERT INTO `ref_desa` VALUES (5086, 169, 'PANGLESERAN');
INSERT INTO `ref_desa` VALUES (5087, 169, 'PARAK LIMA');
INSERT INTO `ref_desa` VALUES (5088, 169, 'PARAKAN LIMA');
INSERT INTO `ref_desa` VALUES (5089, 169, 'PARAKN LIMA');
INSERT INTO `ref_desa` VALUES (5090, 169, 'PASIR GEDE');
INSERT INTO `ref_desa` VALUES (5091, 169, 'PASIR GEXDE');
INSERT INTO `ref_desa` VALUES (5092, 169, 'PASIR KALI');
INSERT INTO `ref_desa` VALUES (5093, 169, 'PASIR KUNTUL');
INSERT INTO `ref_desa` VALUES (5094, 169, 'PASIR POGOR');
INSERT INTO `ref_desa` VALUES (5095, 169, 'PASRAKAN LIMA');
INSERT INTO `ref_desa` VALUES (5096, 169, 'PERUM BABAKAN');
INSERT INTO `ref_desa` VALUES (5097, 169, 'PONDOK BITUNG');
INSERT INTO `ref_desa` VALUES (5098, 169, 'PR LIMA');
INSERT INTO `ref_desa` VALUES (5099, 169, 'PR LIMAM BJLOPANG');
INSERT INTO `ref_desa` VALUES (5100, 169, 'PRALIMA');
INSERT INTO `ref_desa` VALUES (5101, 169, 'PRK LIMA');
INSERT INTO `ref_desa` VALUES (5102, 169, 'RAWEY');
INSERT INTO `ref_desa` VALUES (5103, 169, 'SADAMUKTI');
INSERT INTO `ref_desa` VALUES (5104, 169, 'SAMPALAN');
INSERT INTO `ref_desa` VALUES (5105, 169, 'SAMPORA');
INSERT INTO `ref_desa` VALUES (5106, 169, 'SEAKRWANGI');
INSERT INTO `ref_desa` VALUES (5107, 169, 'SEDAMUKTI');
INSERT INTO `ref_desa` VALUES (5108, 169, 'SIKEMBANG');
INSERT INTO `ref_desa` VALUES (5109, 169, 'SIKEMBAR');
INSERT INTO `ref_desa` VALUES (5110, 169, 'SIM-ENAN');
INSERT INTO `ref_desa` VALUES (5111, 169, 'SIMPENAN');
INSERT INTO `ref_desa` VALUES (5112, 169, 'SINDANGRAJA');
INSERT INTO `ref_desa` VALUES (5113, 169, 'SIRNA JAYA');
INSERT INTO `ref_desa` VALUES (5114, 169, 'SIRNA RESMI');
INSERT INTO `ref_desa` VALUES (5115, 169, 'SIUKAMULYA');
INSERT INTO `ref_desa` VALUES (5116, 169, 'SK. MULYA');
INSERT INTO `ref_desa` VALUES (5117, 169, 'SKAMULYA');
INSERT INTO `ref_desa` VALUES (5118, 169, 'SMA');
INSERT INTO `ref_desa` VALUES (5119, 169, 'SUAKAMULYA');
INSERT INTO `ref_desa` VALUES (5120, 169, 'SUAKMULYA');
INSERT INTO `ref_desa` VALUES (5121, 169, 'SUHARJA');
INSERT INTO `ref_desa` VALUES (5122, 169, 'SUIKAMAJU');
INSERT INTO `ref_desa` VALUES (5123, 169, 'SUIKAMULYA');
INSERT INTO `ref_desa` VALUES (5124, 169, 'SUKA  MULYA');
INSERT INTO `ref_desa` VALUES (5125, 169, 'SUKA BAKTI');
INSERT INTO `ref_desa` VALUES (5126, 169, 'SUKA MAJU');
INSERT INTO `ref_desa` VALUES (5127, 169, 'SUKA MULYA');
INSERT INTO `ref_desa` VALUES (5128, 169, 'SUKA MURYA');
INSERT INTO `ref_desa` VALUES (5129, 169, 'SUKABAKTI');
INSERT INTO `ref_desa` VALUES (5130, 169, 'SUKABMULYA');
INSERT INTO `ref_desa` VALUES (5131, 169, 'SUKAHARJA');
INSERT INTO `ref_desa` VALUES (5132, 169, 'SUKALMULYA');
INSERT INTO `ref_desa` VALUES (5133, 169, 'SUKAMANIS');
INSERT INTO `ref_desa` VALUES (5134, 169, 'SUKAMANTRI');
INSERT INTO `ref_desa` VALUES (5135, 169, 'SUKAMAULYA');
INSERT INTO `ref_desa` VALUES (5136, 169, 'SUKAMAYA');
INSERT INTO `ref_desa` VALUES (5137, 169, 'SUKAMJU');
INSERT INTO `ref_desa` VALUES (5138, 169, 'SUKAMLUYA');
INSERT INTO `ref_desa` VALUES (5139, 169, 'SUKAMLYA');
INSERT INTO `ref_desa` VALUES (5140, 169, 'SUKAMUILYA');
INSERT INTO `ref_desa` VALUES (5141, 169, 'SUKAMUKTI');
INSERT INTO `ref_desa` VALUES (5142, 169, 'SUKAMULAYA');
INSERT INTO `ref_desa` VALUES (5143, 169, 'SUKAMULYA.');
INSERT INTO `ref_desa` VALUES (5144, 169, 'SUKAMUYA');
INSERT INTO `ref_desa` VALUES (5145, 169, 'SUKANMULYA');
INSERT INTO `ref_desa` VALUES (5146, 169, 'SUKARAHARJA');
INSERT INTO `ref_desa` VALUES (5147, 169, 'SUKASIRNA');
INSERT INTO `ref_desa` VALUES (5148, 169, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (5149, 169, 'SUKLAMULYA');
INSERT INTO `ref_desa` VALUES (5150, 169, 'SUKMAJU');
INSERT INTO `ref_desa` VALUES (5151, 169, 'SUKMULYA');
INSERT INTO `ref_desa` VALUES (5152, 169, 'SULAMULYA');
INSERT INTO `ref_desa` VALUES (5153, 169, 'SULJU');
INSERT INTO `ref_desa` VALUES (5154, 169, 'SUMAKULYA');
INSERT INTO `ref_desa` VALUES (5155, 169, 'SUNGAAN');
INSERT INTO `ref_desa` VALUES (5156, 169, 'SUNGAPAN');
INSERT INTO `ref_desa` VALUES (5157, 169, 'TEGAL DATAR');
INSERT INTO `ref_desa` VALUES (5158, 169, 'TEGAL PANJANG');
INSERT INTO `ref_desa` VALUES (5159, 169, 'TENJOLAUT');
INSERT INTO `ref_desa` VALUES (5160, 169, 'TG SARI');
INSERT INTO `ref_desa` VALUES (5161, 169, 'WANGUN JAYA');
INSERT INTO `ref_desa` VALUES (5162, 595, 'AMANSARI');
INSERT INTO `ref_desa` VALUES (5163, 595, 'ANYINDANGAN');
INSERT INTO `ref_desa` VALUES (5164, 595, 'BABAKAN JAYA');
INSERT INTO `ref_desa` VALUES (5165, 595, 'BABAKAN SIRNA');
INSERT INTO `ref_desa` VALUES (5166, 595, 'BANTAR GADUNG');
INSERT INTO `ref_desa` VALUES (5167, 595, 'BANTAR SELANG');
INSERT INTO `ref_desa` VALUES (5168, 595, 'BIMISARI');
INSERT INTO `ref_desa` VALUES (5169, 595, 'BITUNG');
INSERT INTO `ref_desa` VALUES (5170, 595, 'BUISARI');
INSERT INTO `ref_desa` VALUES (5171, 595, 'BUMI');
INSERT INTO `ref_desa` VALUES (5172, 595, 'BUMI  SARI');
INSERT INTO `ref_desa` VALUES (5173, 595, 'BUMI ASIH');
INSERT INTO `ref_desa` VALUES (5174, 595, 'BUMI SARI');
INSERT INTO `ref_desa` VALUES (5175, 595, 'BUNI SARI');
INSERT INTO `ref_desa` VALUES (5176, 595, 'BUNI WANGI');
INSERT INTO `ref_desa` VALUES (5177, 595, 'BUNISARI');
INSERT INTO `ref_desa` VALUES (5178, 595, 'CBUMI SARI');
INSERT INTO `ref_desa` VALUES (5179, 595, 'CCAREUH');
INSERT INTO `ref_desa` VALUES (5180, 595, 'CCICAREUH');
INSERT INTO `ref_desa` VALUES (5181, 595, 'CCIIDANG');
INSERT INTO `ref_desa` VALUES (5182, 595, 'CI,IDANG');
INSERT INTO `ref_desa` VALUES (5183, 595, 'CIACAREUH');
INSERT INTO `ref_desa` VALUES (5184, 595, 'CIACREUH');
INSERT INTO `ref_desa` VALUES (5185, 595, 'CIAIADANG');
INSERT INTO `ref_desa` VALUES (5186, 595, 'CIALINGAN');
INSERT INTO `ref_desa` VALUES (5187, 595, 'CIANGKREK');
INSERT INTO `ref_desa` VALUES (5188, 595, 'CIANGREK');
INSERT INTO `ref_desa` VALUES (5189, 595, 'CIATER');
INSERT INTO `ref_desa` VALUES (5190, 595, 'CIAWI TALI');
INSERT INTO `ref_desa` VALUES (5191, 595, 'CIAWITALI');
INSERT INTO `ref_desa` VALUES (5192, 595, 'CIBANTENG');
INSERT INTO `ref_desa` VALUES (5193, 595, 'CIBATU');
INSERT INTO `ref_desa` VALUES (5194, 595, 'CIBOGO');
INSERT INTO `ref_desa` VALUES (5195, 595, 'CICADAS');
INSERT INTO `ref_desa` VALUES (5196, 595, 'CICAEUH');
INSERT INTO `ref_desa` VALUES (5197, 595, 'CICAREAH');
INSERT INTO `ref_desa` VALUES (5198, 595, 'CICAREH');
INSERT INTO `ref_desa` VALUES (5199, 595, 'CICAREU');
INSERT INTO `ref_desa` VALUES (5200, 595, 'CICAREUG');
INSERT INTO `ref_desa` VALUES (5201, 595, 'CICAREUGH');
INSERT INTO `ref_desa` VALUES (5202, 595, 'CICARUEH');
INSERT INTO `ref_desa` VALUES (5203, 595, 'CICARUH');
INSERT INTO `ref_desa` VALUES (5204, 595, 'CICREUH');
INSERT INTO `ref_desa` VALUES (5205, 595, 'CICURUG');
INSERT INTO `ref_desa` VALUES (5206, 595, 'CIDADAP');
INSERT INTO `ref_desa` VALUES (5207, 595, 'CIDAEU');
INSERT INTO `ref_desa` VALUES (5208, 595, 'CIDANG');
INSERT INTO `ref_desa` VALUES (5209, 595, 'CIGELONG');
INSERT INTO `ref_desa` VALUES (5210, 595, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (5211, 595, 'CIGUHA');
INSERT INTO `ref_desa` VALUES (5212, 595, 'CIHANYAWAR');
INSERT INTO `ref_desa` VALUES (5213, 595, 'CIHANYAWR');
INSERT INTO `ref_desa` VALUES (5214, 595, 'CIHELANG');
INSERT INTO `ref_desa` VALUES (5215, 595, 'CIHURIP');
INSERT INTO `ref_desa` VALUES (5216, 595, 'CIIDANG');
INSERT INTO `ref_desa` VALUES (5217, 595, 'CIIDNG');
INSERT INTO `ref_desa` VALUES (5218, 595, 'CIIRAY');
INSERT INTO `ref_desa` VALUES (5219, 595, 'CIJAMBU');
INSERT INTO `ref_desa` VALUES (5220, 595, 'CIJKIDANG');
INSERT INTO `ref_desa` VALUES (5221, 595, 'CIKADUG');
INSERT INTO `ref_desa` VALUES (5222, 595, 'CIKARAE THOYIBAH');
INSERT INTO `ref_desa` VALUES (5223, 595, 'CIKARANG');
INSERT INTO `ref_desa` VALUES (5224, 595, 'CIKARARANGE');
INSERT INTO `ref_desa` VALUES (5225, 595, 'CIKDANG');
INSERT INTO `ref_desa` VALUES (5226, 595, 'CIKDIANG');
INSERT INTO `ref_desa` VALUES (5227, 595, 'CIKIAAMG]');
INSERT INTO `ref_desa` VALUES (5228, 595, 'CIKIADANG');
INSERT INTO `ref_desa` VALUES (5229, 595, 'CIKIADANGCIKIDANG');
INSERT INTO `ref_desa` VALUES (5230, 595, 'CIKIDAG');
INSERT INTO `ref_desa` VALUES (5231, 595, 'CIKIDAMG');
INSERT INTO `ref_desa` VALUES (5232, 595, 'CIKIDAMH');
INSERT INTO `ref_desa` VALUES (5233, 595, 'CIKIDANFG');
INSERT INTO `ref_desa` VALUES (5234, 595, 'CIKIDANG HILIR');
INSERT INTO `ref_desa` VALUES (5235, 595, 'CIKIDANG?CIKIDANG');
INSERT INTO `ref_desa` VALUES (5236, 595, 'CIKIDANGA');
INSERT INTO `ref_desa` VALUES (5237, 595, 'CIKIDANHG');
INSERT INTO `ref_desa` VALUES (5238, 595, 'CIKIDANMG');
INSERT INTO `ref_desa` VALUES (5239, 595, 'CIKIDNG');
INSERT INTO `ref_desa` VALUES (5240, 595, 'CIKIRAYA');
INSERT INTO `ref_desa` VALUES (5241, 595, 'CIKISANG');
INSERT INTO `ref_desa` VALUES (5242, 595, 'CIKIURAY');
INSERT INTO `ref_desa` VALUES (5243, 595, 'CIKKIDANG');
INSERT INTO `ref_desa` VALUES (5244, 595, 'CILENAB');
INSERT INTO `ref_desa` VALUES (5245, 595, 'CILENGO');
INSERT INTO `ref_desa` VALUES (5246, 595, 'CILENTAB');
INSERT INTO `ref_desa` VALUES (5247, 595, 'CILETUH');
INSERT INTO `ref_desa` VALUES (5248, 595, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (5249, 595, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (5250, 595, 'CIPETYIR');
INSERT INTO `ref_desa` VALUES (5251, 595, 'CIPICUNG');
INSERT INTO `ref_desa` VALUES (5252, 595, 'CIRAEUH');
INSERT INTO `ref_desa` VALUES (5253, 595, 'CISAAR');
INSERT INTO `ref_desa` VALUES (5254, 595, 'CISALAK');
INSERT INTO `ref_desa` VALUES (5255, 595, 'CISAMPORA');
INSERT INTO `ref_desa` VALUES (5256, 595, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (5257, 595, 'CKIDANG');
INSERT INTO `ref_desa` VALUES (5258, 595, 'CKIDNG');
INSERT INTO `ref_desa` VALUES (5259, 595, 'CPANGKA;A');
INSERT INTO `ref_desa` VALUES (5260, 595, 'CUIKIDANG');
INSERT INTO `ref_desa` VALUES (5261, 595, 'CUKIDANG');
INSERT INTO `ref_desa` VALUES (5262, 595, 'CUKIRAY');
INSERT INTO `ref_desa` VALUES (5263, 595, 'GEGUDANG');
INSERT INTO `ref_desa` VALUES (5264, 595, 'GIRIJAYA');
INSERT INTO `ref_desa` VALUES (5265, 595, 'GN MALANG');
INSERT INTO `ref_desa` VALUES (5266, 595, 'GN.MALANG');
INSERT INTO `ref_desa` VALUES (5267, 595, 'GNMALANG');
INSERT INTO `ref_desa` VALUES (5268, 595, 'GUNUNG BALANG');
INSERT INTO `ref_desa` VALUES (5269, 595, 'GUNUNG MLANG');
INSERT INTO `ref_desa` VALUES (5270, 595, 'GUNUNG SARI');
INSERT INTO `ref_desa` VALUES (5271, 595, 'GUNUNGMALANG');
INSERT INTO `ref_desa` VALUES (5272, 595, 'GUUNUNGMALANG');
INSERT INTO `ref_desa` VALUES (5273, 595, 'HEGAR MULYA');
INSERT INTO `ref_desa` VALUES (5274, 595, 'HUNUNG MALANG');
INSERT INTO `ref_desa` VALUES (5275, 595, 'IDANG');
INSERT INTO `ref_desa` VALUES (5276, 595, 'IIANG');
INSERT INTO `ref_desa` VALUES (5277, 595, 'IKIDANG');
INSERT INTO `ref_desa` VALUES (5278, 595, 'KALAPA REA');
INSERT INTO `ref_desa` VALUES (5279, 595, 'KP CIMAPAG');
INSERT INTO `ref_desa` VALUES (5280, 595, 'KP.PAJAGAN');
INSERT INTO `ref_desa` VALUES (5281, 595, 'KUBANG');
INSERT INTO `ref_desa` VALUES (5282, 595, 'KUBANG HERANG');
INSERT INTO `ref_desa` VALUES (5283, 595, 'LANGEN SARI');
INSERT INTO `ref_desa` VALUES (5284, 595, 'LANGENSARI');
INSERT INTO `ref_desa` VALUES (5285, 595, 'LEBAK NANGKA');
INSERT INTO `ref_desa` VALUES (5286, 595, 'LEMBUR SITU');
INSERT INTO `ref_desa` VALUES (5287, 595, 'LEUWENG DATAR');
INSERT INTO `ref_desa` VALUES (5288, 595, 'LEUWEUNG DATAR');
INSERT INTO `ref_desa` VALUES (5289, 595, 'LEUWEUNGDATAR');
INSERT INTO `ref_desa` VALUES (5290, 595, 'LEUWUENG DATAR');
INSERT INTO `ref_desa` VALUES (5291, 595, 'LEWENG DATAR');
INSERT INTO `ref_desa` VALUES (5292, 595, 'LEWENGDATAR');
INSERT INTO `ref_desa` VALUES (5293, 595, 'LEWEUNG DATAR');
INSERT INTO `ref_desa` VALUES (5294, 595, 'LW DATAR');
INSERT INTO `ref_desa` VALUES (5295, 595, 'MALINPING');
INSERT INTO `ref_desa` VALUES (5296, 595, 'MEAKARANANGKA');
INSERT INTO `ref_desa` VALUES (5297, 595, 'MEKA RNANGKA');
INSERT INTO `ref_desa` VALUES (5298, 595, 'MEKAR ANGSA');
INSERT INTO `ref_desa` VALUES (5299, 595, 'MEKAR MNAGKA');
INSERT INTO `ref_desa` VALUES (5300, 595, 'MEKAR NAGKA');
INSERT INTO `ref_desa` VALUES (5301, 595, 'MEKAR NANGKA');
INSERT INTO `ref_desa` VALUES (5302, 595, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (5303, 595, 'MEKARNAGKA');
INSERT INTO `ref_desa` VALUES (5304, 595, 'MEKARNANGKO');
INSERT INTO `ref_desa` VALUES (5305, 595, 'MEKASRNANGKA');
INSERT INTO `ref_desa` VALUES (5306, 595, 'MUARA SARI');
INSERT INTO `ref_desa` VALUES (5307, 595, 'NAGKA');
INSERT INTO `ref_desa` VALUES (5308, 595, 'NAGKA KONENG');
INSERT INTO `ref_desa` VALUES (5309, 595, 'NAGKAKONENG');
INSERT INTO `ref_desa` VALUES (5310, 595, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (5311, 595, 'NAGRAK KONENG');
INSERT INTO `ref_desa` VALUES (5312, 595, 'NANGELAR');
INSERT INTO `ref_desa` VALUES (5313, 595, 'NANGGKAKONENG');
INSERT INTO `ref_desa` VALUES (5314, 595, 'NANGKA');
INSERT INTO `ref_desa` VALUES (5315, 595, 'NANGKA KONONG');
INSERT INTO `ref_desa` VALUES (5316, 595, 'NANGKA LEAH');
INSERT INTO `ref_desa` VALUES (5317, 595, 'NANGKAKONENG');
INSERT INTO `ref_desa` VALUES (5318, 595, 'NANGTKAKONENG');
INSERT INTO `ref_desa` VALUES (5319, 595, 'NARINGGUL');
INSERT INTO `ref_desa` VALUES (5320, 595, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (5321, 595, 'NYANGKONENG');
INSERT INTO `ref_desa` VALUES (5322, 595, 'NYOMPLONG');
INSERT INTO `ref_desa` VALUES (5323, 595, 'PAAAASIRGUDANG');
INSERT INTO `ref_desa` VALUES (5324, 595, 'PAANGKAALAN');
INSERT INTO `ref_desa` VALUES (5325, 595, 'PAANGKALAN');
INSERT INTO `ref_desa` VALUES (5326, 595, 'PAJAGAN');
INSERT INTO `ref_desa` VALUES (5327, 595, 'PAJAGAN CICURUG');
INSERT INTO `ref_desa` VALUES (5328, 595, 'PALASARI');
INSERT INTO `ref_desa` VALUES (5329, 595, 'PAMNGKALAN');
INSERT INTO `ref_desa` VALUES (5330, 595, 'PAMURUYAN');
INSERT INTO `ref_desa` VALUES (5331, 595, 'PAN GKALAN');
INSERT INTO `ref_desa` VALUES (5332, 595, 'PANBGKALAN');
INSERT INTO `ref_desa` VALUES (5333, 595, 'PANGAKALAN');
INSERT INTO `ref_desa` VALUES (5334, 595, 'PANGAKALN');
INSERT INTO `ref_desa` VALUES (5335, 595, 'PANGAKAN');
INSERT INTO `ref_desa` VALUES (5336, 595, 'PANGALAN');
INSERT INTO `ref_desa` VALUES (5337, 595, 'PANGASHAN');
INSERT INTO `ref_desa` VALUES (5338, 595, 'PANGKAAN');
INSERT INTO `ref_desa` VALUES (5339, 595, 'PANGKAN');
INSERT INTO `ref_desa` VALUES (5340, 595, 'PANGKKALANCIIDANG');
INSERT INTO `ref_desa` VALUES (5341, 595, 'PANGKLAN');
INSERT INTO `ref_desa` VALUES (5342, 595, 'PANGKLAN CUIBOLANG');
INSERT INTO `ref_desa` VALUES (5343, 595, 'PANGLKALAN');
INSERT INTO `ref_desa` VALUES (5344, 595, 'PANHKALAN');
INSERT INTO `ref_desa` VALUES (5345, 595, 'PANKALAN');
INSERT INTO `ref_desa` VALUES (5346, 595, 'PANKALAN CICUCURUG');
INSERT INTO `ref_desa` VALUES (5347, 595, 'PARAKAN TELU');
INSERT INTO `ref_desa` VALUES (5348, 595, 'PARANBON');
INSERT INTO `ref_desa` VALUES (5349, 595, 'PASIR DOTON');
INSERT INTO `ref_desa` VALUES (5350, 595, 'PASIR GOMBONG');
INSERT INTO `ref_desa` VALUES (5351, 595, 'PASIR GUDANG');
INSERT INTO `ref_desa` VALUES (5352, 595, 'PASIR LARANGAN');
INSERT INTO `ref_desa` VALUES (5353, 595, 'PASIR RARANGAN');
INSERT INTO `ref_desa` VALUES (5354, 595, 'PASIR RARARANGAN');
INSERT INTO `ref_desa` VALUES (5355, 595, 'PASIRLANGKAP');
INSERT INTO `ref_desa` VALUES (5356, 595, 'PASIRNANGKA');
INSERT INTO `ref_desa` VALUES (5357, 595, 'PASIRRARANGAN');
INSERT INTO `ref_desa` VALUES (5358, 595, 'PENGKOLAN');
INSERT INTO `ref_desa` VALUES (5359, 595, 'PGKALAN');
INSERT INTO `ref_desa` VALUES (5360, 595, 'PINANG GADING');
INSERT INTO `ref_desa` VALUES (5361, 595, 'PINANGGADING');
INSERT INTO `ref_desa` VALUES (5362, 595, 'PINDANG GALING');
INSERT INTO `ref_desa` VALUES (5363, 595, 'SAAGEDANG');
INSERT INTO `ref_desa` VALUES (5364, 595, 'SADA MUKTI');
INSERT INTO `ref_desa` VALUES (5365, 595, 'SALAGEDANG');
INSERT INTO `ref_desa` VALUES (5366, 595, 'SAMBA SARI');
INSERT INTO `ref_desa` VALUES (5367, 595, 'SAMPALAN');
INSERT INTO `ref_desa` VALUES (5368, 595, 'SAMPOARA');
INSERT INTO `ref_desa` VALUES (5369, 595, 'SAMPURNA');
INSERT INTO `ref_desa` VALUES (5370, 595, 'SAPALAN');
INSERT INTO `ref_desa` VALUES (5371, 595, 'SEDAKMUKTI');
INSERT INTO `ref_desa` VALUES (5372, 595, 'SEKARSARI');
INSERT INTO `ref_desa` VALUES (5373, 595, 'SIKIDANG');
INSERT INTO `ref_desa` VALUES (5374, 595, 'SOROGOL');
INSERT INTO `ref_desa` VALUES (5375, 595, 'SUKA MAJU');
INSERT INTO `ref_desa` VALUES (5376, 595, 'SUKA SARNA');
INSERT INTO `ref_desa` VALUES (5377, 595, 'SUKA SIRNA');
INSERT INTO `ref_desa` VALUES (5378, 595, 'SUKA SIRNA CIBADAK');
INSERT INTO `ref_desa` VALUES (5379, 595, 'SUKABMUTI');
INSERT INTO `ref_desa` VALUES (5380, 595, 'SUKAMUKTI');
INSERT INTO `ref_desa` VALUES (5381, 595, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (5382, 595, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (5383, 595, 'SUKASIRNA');
INSERT INTO `ref_desa` VALUES (5384, 595, 'SUKASIRNA .');
INSERT INTO `ref_desa` VALUES (5385, 595, 'SUKASIRNA CIBADAK');
INSERT INTO `ref_desa` VALUES (5386, 595, 'SUKASIRNA.');
INSERT INTO `ref_desa` VALUES (5387, 595, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (5388, 595, 'TAMAN');
INSERT INTO `ref_desa` VALUES (5389, 595, 'TAMAN LESTARI');
INSERT INTO `ref_desa` VALUES (5390, 595, 'TAMAN SARI');
INSERT INTO `ref_desa` VALUES (5391, 595, 'TANGKIL');
INSERT INTO `ref_desa` VALUES (5392, 595, 'TANMANSARI');
INSERT INTO `ref_desa` VALUES (5393, 595, 'TAPOS');
INSERT INTO `ref_desa` VALUES (5394, 595, 'TEGALLEGA');
INSERT INTO `ref_desa` VALUES (5395, 595, 'TENJO JAYA');
INSERT INTO `ref_desa` VALUES (5396, 595, 'TENJOJAYA');
INSERT INTO `ref_desa` VALUES (5397, 595, 'TMN. SARI');
INSERT INTO `ref_desa` VALUES (5398, 595, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (5399, 595, 'TUGU MALANG');
INSERT INTO `ref_desa` VALUES (5400, 582, 'CIKONDANG');
INSERT INTO `ref_desa` VALUES (5401, 582, 'CIMAHI');
INSERT INTO `ref_desa` VALUES (5402, 679, 'BBAKAN KARET');
INSERT INTO `ref_desa` VALUES (5403, 679, 'BOREGAHINDAH');
INSERT INTO `ref_desa` VALUES (5404, 679, 'CAGGU');
INSERT INTO `ref_desa` VALUES (5405, 679, 'CIHUJAN');
INSERT INTO `ref_desa` VALUES (5406, 679, 'CIKEMBANG');
INSERT INTO `ref_desa` VALUES (5407, 679, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (5408, 679, 'CISONGGONG');
INSERT INTO `ref_desa` VALUES (5409, 679, 'CITATIH');
INSERT INTO `ref_desa` VALUES (5410, 679, 'KALIJAGA');
INSERT INTO `ref_desa` VALUES (5411, 679, 'KARANG MEKAR');
INSERT INTO `ref_desa` VALUES (5412, 679, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (5413, 679, 'SALUPAN');
INSERT INTO `ref_desa` VALUES (5414, 679, 'SMPLAN');
INSERT INTO `ref_desa` VALUES (5415, 679, 'SUKAM,ULYA');
INSERT INTO `ref_desa` VALUES (5416, 679, 'SUKAMANH');
INSERT INTO `ref_desa` VALUES (5417, 686, ',CIRACAP');
INSERT INTO `ref_desa` VALUES (5418, 686, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (5419, 686, 'CARINGIN NUNGGAL');
INSERT INTO `ref_desa` VALUES (5420, 686, 'CICAKANGKUNG');
INSERT INTO `ref_desa` VALUES (5421, 686, 'CICARAP');
INSERT INTO `ref_desa` VALUES (5422, 686, 'CICKANGKUNG');
INSERT INTO `ref_desa` VALUES (5423, 686, 'CIKAKUNG');
INSERT INTO `ref_desa` VALUES (5424, 686, 'CIKANG KUNG');
INSERT INTO `ref_desa` VALUES (5425, 686, 'CILAAACAP');
INSERT INTO `ref_desa` VALUES (5426, 686, 'CILINGKUNG');
INSERT INTO `ref_desa` VALUES (5427, 686, 'CIRAJAB');
INSERT INTO `ref_desa` VALUES (5428, 686, 'CISASAK JAMPANG');
INSERT INTO `ref_desa` VALUES (5429, 686, 'GIUNUNG BATU');
INSERT INTO `ref_desa` VALUES (5430, 686, 'GN BATU');
INSERT INTO `ref_desa` VALUES (5431, 686, 'GUNUNG BARU');
INSERT INTO `ref_desa` VALUES (5432, 686, 'GUNUNG BATU');
INSERT INTO `ref_desa` VALUES (5433, 686, 'KARANGSARI');
INSERT INTO `ref_desa` VALUES (5434, 686, 'PASIR  PANJANG');
INSERT INTO `ref_desa` VALUES (5435, 686, 'PASIR MALANG');
INSERT INTO `ref_desa` VALUES (5436, 686, 'PASIR PANJANG');
INSERT INTO `ref_desa` VALUES (5437, 686, 'PS PANJANG');
INSERT INTO `ref_desa` VALUES (5438, 686, 'PURWA SEDAR');
INSERT INTO `ref_desa` VALUES (5439, 686, 'PURWASARI');
INSERT INTO `ref_desa` VALUES (5440, 686, 'PURWASEDA');
INSERT INTO `ref_desa` VALUES (5441, 686, 'PURWASEGAR');
INSERT INTO `ref_desa` VALUES (5442, 686, 'PURWASEKAR');
INSERT INTO `ref_desa` VALUES (5443, 686, 'SALAGEDANG');
INSERT INTO `ref_desa` VALUES (5444, 686, 'SUKAMUKTI');
INSERT INTO `ref_desa` VALUES (5445, 686, 'TALAGAMURNI');
INSERT INTO `ref_desa` VALUES (5446, 686, 'WALURAN');
INSERT INTO `ref_desa` VALUES (5447, 647, 'CIBENCOY');
INSERT INTO `ref_desa` VALUES (5448, 647, 'CIKURUTUG');
INSERT INTO `ref_desa` VALUES (5449, 647, 'CIPULUT');
INSERT INTO `ref_desa` VALUES (5450, 647, 'CIPUTAT');
INSERT INTO `ref_desa` VALUES (5451, 647, 'CIRENGHAS');
INSERT INTO `ref_desa` VALUES (5452, 647, 'SUKARAJA');
INSERT INTO `ref_desa` VALUES (5453, 647, 'TEGAL PANJANG');
INSERT INTO `ref_desa` VALUES (5454, 600, '03');
INSERT INTO `ref_desa` VALUES (5455, 600, '07');
INSERT INTO `ref_desa` VALUES (5456, 600, '17-APR');
INSERT INTO `ref_desa` VALUES (5457, 600, 'AL MASTURIYAH');
INSERT INTO `ref_desa` VALUES (5458, 600, 'ALMASTURIYAH');
INSERT INTO `ref_desa` VALUES (5459, 600, 'ANGKALAYA');
INSERT INTO `ref_desa` VALUES (5460, 600, 'ARAMBAY');
INSERT INTO `ref_desa` VALUES (5461, 600, 'BABABAKAN JAYA');
INSERT INTO `ref_desa` VALUES (5462, 600, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (5463, 600, 'BABAKAN  PANJANG');
INSERT INTO `ref_desa` VALUES (5464, 600, 'BABAKAN AKAJAM-ANG');
INSERT INTO `ref_desa` VALUES (5465, 600, 'BABAKAN DAMAI PERUM');
INSERT INTO `ref_desa` VALUES (5466, 600, 'BABAKAN DAMI');
INSERT INTO `ref_desa` VALUES (5467, 600, 'BABAKAN ISAAT');
INSERT INTO `ref_desa` VALUES (5468, 600, 'BABAKAN JAMPANG');
INSERT INTO `ref_desa` VALUES (5469, 600, 'BABAKAN JAY A');
INSERT INTO `ref_desa` VALUES (5470, 600, 'BABAKAN JAYA');
INSERT INTO `ref_desa` VALUES (5471, 600, 'BABAKAN KUPA');
INSERT INTO `ref_desa` VALUES (5472, 600, 'BABAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (5473, 600, 'BABAKAN PARI');
INSERT INTO `ref_desa` VALUES (5474, 600, 'BABAKAN TIPAR');
INSERT INTO `ref_desa` VALUES (5475, 600, 'BABAKANCISAAT');
INSERT INTO `ref_desa` VALUES (5476, 600, 'BABAKANSAR');
INSERT INTO `ref_desa` VALUES (5477, 600, 'BABKAN');
INSERT INTO `ref_desa` VALUES (5478, 600, 'BABKAN APANJANG');
INSERT INTO `ref_desa` VALUES (5479, 600, 'BATU ASIH');
INSERT INTO `ref_desa` VALUES (5480, 600, 'BATU NUNGGAL');
INSERT INTO `ref_desa` VALUES (5481, 600, 'BBABAKAN');
INSERT INTO `ref_desa` VALUES (5482, 600, 'BBAJAN');
INSERT INTO `ref_desa` VALUES (5483, 600, 'BBAK JAMPANG');
INSERT INTO `ref_desa` VALUES (5484, 600, 'BBAKAAN JAYA');
INSERT INTO `ref_desa` VALUES (5485, 600, 'BBAKAN');
INSERT INTO `ref_desa` VALUES (5486, 600, 'BBAKAN DAMAI');
INSERT INTO `ref_desa` VALUES (5487, 600, 'BBAKAN TIPAR');
INSERT INTO `ref_desa` VALUES (5488, 600, 'BBAKARAMBAY');
INSERT INTO `ref_desa` VALUES (5489, 600, 'BBKAN JAMPANG');
INSERT INTO `ref_desa` VALUES (5490, 600, 'BENTENG');
INSERT INTO `ref_desa` VALUES (5491, 600, 'BJ KALER');
INSERT INTO `ref_desa` VALUES (5492, 600, 'BJ KAUNG HILIR');
INSERT INTO `ref_desa` VALUES (5493, 600, 'BJ NEROS');
INSERT INTO `ref_desa` VALUES (5494, 600, 'BOBOJONG');
INSERT INTO `ref_desa` VALUES (5495, 600, 'BOJONG ASIH');
INSERT INTO `ref_desa` VALUES (5496, 600, 'BOJONG KAUNG');
INSERT INTO `ref_desa` VALUES (5497, 600, 'BOJONG NAGKA');
INSERT INTO `ref_desa` VALUES (5498, 600, 'BOLANG');
INSERT INTO `ref_desa` VALUES (5499, 600, 'BSBSKSN');
INSERT INTO `ref_desa` VALUES (5500, 600, 'CAGAK');
INSERT INTO `ref_desa` VALUES (5501, 600, 'CANTAYAN');
INSERT INTO `ref_desa` VALUES (5502, 600, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (5503, 600, 'CATU');
INSERT INTO `ref_desa` VALUES (5504, 600, 'CBATU');
INSERT INTO `ref_desa` VALUES (5505, 600, 'CBENCOY');
INSERT INTO `ref_desa` VALUES (5506, 600, 'CBETANG');
INSERT INTO `ref_desa` VALUES (5507, 600, 'CBOLANGKALER');
INSERT INTO `ref_desa` VALUES (5508, 600, 'CI BOLANG');
INSERT INTO `ref_desa` VALUES (5509, 600, 'CI9BATU');
INSERT INTO `ref_desa` VALUES (5510, 600, 'CI9LANGSI');
INSERT INTO `ref_desa` VALUES (5511, 600, 'CIAAT');
INSERT INTO `ref_desa` VALUES (5512, 600, 'CIABTU');
INSERT INTO `ref_desa` VALUES (5513, 600, 'CIAHURIPAN');
INSERT INTO `ref_desa` VALUES (5514, 600, 'CIAKROYA');
INSERT INTO `ref_desa` VALUES (5515, 600, 'CIAMBE');
INSERT INTO `ref_desa` VALUES (5516, 600, 'CIASAAT');
INSERT INTO `ref_desa` VALUES (5517, 600, 'CIATU');
INSERT INTO `ref_desa` VALUES (5518, 600, 'CIB ENTANG');
INSERT INTO `ref_desa` VALUES (5519, 600, 'CIB9OKLANG KALER');
INSERT INTO `ref_desa` VALUES (5520, 600, 'CIBAAAAAAAATUTEGH');
INSERT INTO `ref_desa` VALUES (5521, 600, 'CIBAAATU');
INSERT INTO `ref_desa` VALUES (5522, 600, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (5523, 600, 'CIBADTU');
INSERT INTO `ref_desa` VALUES (5524, 600, 'CIBALANG KALER');
INSERT INTO `ref_desa` VALUES (5525, 600, 'CIBAOLANG KALER');
INSERT INTO `ref_desa` VALUES (5526, 600, 'CIBARAJA');
INSERT INTO `ref_desa` VALUES (5527, 600, 'CIBARJA');
INSERT INTO `ref_desa` VALUES (5528, 600, 'CIBARTU');
INSERT INTO `ref_desa` VALUES (5529, 600, 'CIBATAU');
INSERT INTO `ref_desa` VALUES (5530, 600, 'CIBATI');
INSERT INTO `ref_desa` VALUES (5531, 600, 'CIBATU .');
INSERT INTO `ref_desa` VALUES (5532, 600, 'CIBATU BABAKAN');
INSERT INTO `ref_desa` VALUES (5533, 600, 'CIBATU CARINGIN');
INSERT INTO `ref_desa` VALUES (5534, 600, 'CIBATU CIASSAAT');
INSERT INTO `ref_desa` VALUES (5535, 600, 'CIBATU KALER');
INSERT INTO `ref_desa` VALUES (5536, 600, 'CIBATU LIK');
INSERT INTO `ref_desa` VALUES (5537, 600, 'CIBATU NAGRAK');
INSERT INTO `ref_desa` VALUES (5538, 600, 'CIBATU POS');
INSERT INTO `ref_desa` VALUES (5539, 600, 'CIBATU RIK CIASATT');
INSERT INTO `ref_desa` VALUES (5540, 600, 'CIBATU SAAT');
INSERT INTO `ref_desa` VALUES (5541, 600, 'CIBATUCAAT');
INSERT INTO `ref_desa` VALUES (5542, 600, 'CIBATUCISAAT');
INSERT INTO `ref_desa` VALUES (5543, 600, 'CIBATUCISAT');
INSERT INTO `ref_desa` VALUES (5544, 600, 'CIBATUKALAER');
INSERT INTO `ref_desa` VALUES (5545, 600, 'CIBATULEGOJK');
INSERT INTO `ref_desa` VALUES (5546, 600, 'CIBATULIK');
INSERT INTO `ref_desa` VALUES (5547, 600, 'CIBATUNG');
INSERT INTO `ref_desa` VALUES (5548, 600, 'CIBATUPOS');
INSERT INTO `ref_desa` VALUES (5549, 600, 'CIBATUTEGAH');
INSERT INTO `ref_desa` VALUES (5550, 600, 'CIBATU]CISAAT');
INSERT INTO `ref_desa` VALUES (5551, 600, 'CIBAU');
INSERT INTO `ref_desa` VALUES (5552, 600, 'CIBDU');
INSERT INTO `ref_desa` VALUES (5553, 600, 'CIBEBER');
INSERT INTO `ref_desa` VALUES (5554, 600, 'CIBENCOY');
INSERT INTO `ref_desa` VALUES (5555, 600, 'CIBENTANG');
INSERT INTO `ref_desa` VALUES (5556, 600, 'CIBENTENG');
INSERT INTO `ref_desa` VALUES (5557, 600, 'CIBERNCOY');
INSERT INTO `ref_desa` VALUES (5558, 600, 'CIBILANG KALER');
INSERT INTO `ref_desa` VALUES (5559, 600, 'CIBLANG KALER');
INSERT INTO `ref_desa` VALUES (5560, 600, 'CIBO;ANG');
INSERT INTO `ref_desa` VALUES (5561, 600, 'CIBOALANG');
INSERT INTO `ref_desa` VALUES (5562, 600, 'CIBOALNG');
INSERT INTO `ref_desa` VALUES (5563, 600, 'CIBOALNG KALER');
INSERT INTO `ref_desa` VALUES (5564, 600, 'CIBOANG KALER');
INSERT INTO `ref_desa` VALUES (5565, 600, 'CIBOKLANG KALER');
INSERT INTO `ref_desa` VALUES (5566, 600, 'CIBOLA KALER');
INSERT INTO `ref_desa` VALUES (5567, 600, 'CIBOLAG');
INSERT INTO `ref_desa` VALUES (5568, 600, 'CIBOLALANG KALER');
INSERT INTO `ref_desa` VALUES (5569, 600, 'CIBOLAMNG KALER');
INSERT INTO `ref_desa` VALUES (5570, 600, 'CIBOLAN KALER');
INSERT INTO `ref_desa` VALUES (5571, 600, 'CIBOLANG');
INSERT INTO `ref_desa` VALUES (5572, 600, 'CIBOLANG  KALER');
INSERT INTO `ref_desa` VALUES (5573, 600, 'CIBOLANG HILIR');
INSERT INTO `ref_desa` VALUES (5574, 600, 'CIBOLANG KAELER');
INSERT INTO `ref_desa` VALUES (5575, 600, 'CIBOLANG KALEAR');
INSERT INTO `ref_desa` VALUES (5576, 600, 'CIBOLANG KALER');
INSERT INTO `ref_desa` VALUES (5577, 600, 'CIBOLANG KALR');
INSERT INTO `ref_desa` VALUES (5578, 600, 'CIBOLANG KAREL');
INSERT INTO `ref_desa` VALUES (5579, 600, 'CIBOLANG KELER');
INSERT INTO `ref_desa` VALUES (5580, 600, 'CIBOLANG KIDUL');
INSERT INTO `ref_desa` VALUES (5581, 600, 'CIBOLANG KLAER');
INSERT INTO `ref_desa` VALUES (5582, 600, 'CIBOLANG KLER');
INSERT INTO `ref_desa` VALUES (5583, 600, 'CIBOLANG LKALAER');
INSERT INTO `ref_desa` VALUES (5584, 600, 'CIBOLANG LKALER');
INSERT INTO `ref_desa` VALUES (5585, 600, 'CIBOLANG MANGKALAYA');
INSERT INTO `ref_desa` VALUES (5586, 600, 'CIBOLANG.');
INSERT INTO `ref_desa` VALUES (5587, 600, 'CIBOLANGA KALER');
INSERT INTO `ref_desa` VALUES (5588, 600, 'CIBOLANGALER');
INSERT INTO `ref_desa` VALUES (5589, 600, 'CIBOLANGK KALER');
INSERT INTO `ref_desa` VALUES (5590, 600, 'CIBOLANGKALAER');
INSERT INTO `ref_desa` VALUES (5591, 600, 'CIBOLANGKALLER');
INSERT INTO `ref_desa` VALUES (5592, 600, 'CIBOLANGKIDUL');
INSERT INTO `ref_desa` VALUES (5593, 600, 'CIBOLANHKALER');
INSERT INTO `ref_desa` VALUES (5594, 600, 'CIBOLANKALER');
INSERT INTO `ref_desa` VALUES (5595, 600, 'CIBOLLANG KALER');
INSERT INTO `ref_desa` VALUES (5596, 600, 'CIBOLNG');
INSERT INTO `ref_desa` VALUES (5597, 600, 'CIBTU');
INSERT INTO `ref_desa` VALUES (5598, 600, 'CIBUNTU');
INSERT INTO `ref_desa` VALUES (5599, 600, 'CICANTAYAN');
INSERT INTO `ref_desa` VALUES (5600, 600, 'CICAREUH');
INSERT INTO `ref_desa` VALUES (5601, 600, 'CICOHAG');
INSERT INTO `ref_desa` VALUES (5602, 600, 'CICSAATK');
INSERT INTO `ref_desa` VALUES (5603, 600, 'CICURUG');
INSERT INTO `ref_desa` VALUES (5604, 600, 'CIDADAP');
INSERT INTO `ref_desa` VALUES (5605, 600, 'CIDOYONG');
INSERT INTO `ref_desa` VALUES (5606, 600, 'CIGAYUNG');
INSERT INTO `ref_desa` VALUES (5607, 600, 'CIGUNUNG');
INSERT INTO `ref_desa` VALUES (5608, 600, 'CIHENGKIK');
INSERT INTO `ref_desa` VALUES (5609, 600, 'CIHINGKIG');
INSERT INTO `ref_desa` VALUES (5610, 600, 'CIHINGKIK');
INSERT INTO `ref_desa` VALUES (5611, 600, 'CIHMAHI');
INSERT INTO `ref_desa` VALUES (5612, 600, 'CIHWENGKIK');
INSERT INTO `ref_desa` VALUES (5613, 600, 'CIIBOLANG');
INSERT INTO `ref_desa` VALUES (5614, 600, 'CIJABE');
INSERT INTO `ref_desa` VALUES (5615, 600, 'CIJAGAUNG');
INSERT INTO `ref_desa` VALUES (5616, 600, 'CIJAGUNG');
INSERT INTO `ref_desa` VALUES (5617, 600, 'CIJALINGAN');
INSERT INTO `ref_desa` VALUES (5618, 600, 'CIJAMBAE');
INSERT INTO `ref_desa` VALUES (5619, 600, 'CIJAMBE');
INSERT INTO `ref_desa` VALUES (5620, 600, 'CIJAMBE TENGAH');
INSERT INTO `ref_desa` VALUES (5621, 600, 'CIJAMBU');
INSERT INTO `ref_desa` VALUES (5622, 600, 'CIJASMBE');
INSERT INTO `ref_desa` VALUES (5623, 600, 'CIJENGKOL');
INSERT INTO `ref_desa` VALUES (5624, 600, 'CIKADU');
INSERT INTO `ref_desa` VALUES (5625, 600, 'CIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (5626, 600, 'CIKARAI');
INSERT INTO `ref_desa` VALUES (5627, 600, 'CIKAROYA');
INSERT INTO `ref_desa` VALUES (5628, 600, 'CIKEMBAR');
INSERT INTO `ref_desa` VALUES (5629, 600, 'CIKIRAY');
INSERT INTO `ref_desa` VALUES (5630, 600, 'CIKIRNY');
INSERT INTO `ref_desa` VALUES (5631, 600, 'CIKOLE');
INSERT INTO `ref_desa` VALUES (5632, 600, 'CIKONDANG');
INSERT INTO `ref_desa` VALUES (5633, 600, 'CIKUJANG');
INSERT INTO `ref_desa` VALUES (5634, 600, 'CIKUKULU');
INSERT INTO `ref_desa` VALUES (5635, 600, 'CIKUNDUL');
INSERT INTO `ref_desa` VALUES (5636, 600, 'CIKUTUY');
INSERT INTO `ref_desa` VALUES (5637, 600, 'CILELES');
INSERT INTO `ref_desa` VALUES (5638, 600, 'CIMAAHI');
INSERT INTO `ref_desa` VALUES (5639, 600, 'CIMAHI');
INSERT INTO `ref_desa` VALUES (5640, 600, 'CIMENTEANG');
INSERT INTO `ref_desa` VALUES (5641, 600, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (5642, 600, 'CINBOLANG KALER');
INSERT INTO `ref_desa` VALUES (5643, 600, 'CIOBATU');
INSERT INTO `ref_desa` VALUES (5644, 600, 'CIOLANG');
INSERT INTO `ref_desa` VALUES (5645, 600, 'CIOSAAT');
INSERT INTO `ref_desa` VALUES (5646, 600, 'CIPANCUR');
INSERT INTO `ref_desa` VALUES (5647, 600, 'CIPEALANG MARBABU');
INSERT INTO `ref_desa` VALUES (5648, 600, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (5649, 600, 'CIPUNGUR');
INSERT INTO `ref_desa` VALUES (5650, 600, 'CIPUNTANG');
INSERT INTO `ref_desa` VALUES (5651, 600, 'CIRADEN');
INSERT INTO `ref_desa` VALUES (5652, 600, 'CIRENGED');
INSERT INTO `ref_desa` VALUES (5653, 600, 'CIRENGET');
INSERT INTO `ref_desa` VALUES (5654, 600, 'CIRENYED');
INSERT INTO `ref_desa` VALUES (5655, 600, 'CIROYOM');
INSERT INTO `ref_desa` VALUES (5656, 600, 'CIROYON');
INSERT INTO `ref_desa` VALUES (5657, 600, 'CISAA');
INSERT INTO `ref_desa` VALUES (5658, 600, 'CISAAAT');
INSERT INTO `ref_desa` VALUES (5659, 600, 'CISAAS');
INSERT INTO `ref_desa` VALUES (5660, 600, 'CISAAT AL MASTURIYAH');
INSERT INTO `ref_desa` VALUES (5661, 600, 'CISAAT CIBOLANG');
INSERT INTO `ref_desa` VALUES (5662, 600, 'CISAAT CIBOLANG KALER');
INSERT INTO `ref_desa` VALUES (5663, 600, 'CISAAT CIHNGKIK');
INSERT INTO `ref_desa` VALUES (5664, 600, 'CISAAT KADU DAMPIT');
INSERT INTO `ref_desa` VALUES (5665, 600, 'CISAAT TIPAR');
INSERT INTO `ref_desa` VALUES (5666, 600, 'CISAAT.');
INSERT INTO `ref_desa` VALUES (5667, 600, 'CISAAT]');
INSERT INTO `ref_desa` VALUES (5668, 600, 'CISALADA');
INSERT INTO `ref_desa` VALUES (5669, 600, 'CISANDE');
INSERT INTO `ref_desa` VALUES (5670, 600, 'CISAT');
INSERT INTO `ref_desa` VALUES (5671, 600, 'CISDAAT');
INSERT INTO `ref_desa` VALUES (5672, 600, 'CISERUH');
INSERT INTO `ref_desa` VALUES (5673, 600, 'CISSAAT');
INSERT INTO `ref_desa` VALUES (5674, 600, 'CISSAT');
INSERT INTO `ref_desa` VALUES (5675, 600, 'CIST');
INSERT INTO `ref_desa` VALUES (5676, 600, 'CISUKAMANAH');
INSERT INTO `ref_desa` VALUES (5677, 600, 'CITAMIANAG');
INSERT INTO `ref_desa` VALUES (5678, 600, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (5679, 600, 'CITAMIANG .');
INSERT INTO `ref_desa` VALUES (5680, 600, 'CITAMINAG');
INSERT INTO `ref_desa` VALUES (5681, 600, 'CITENGKOR');
INSERT INTO `ref_desa` VALUES (5682, 600, 'CIUTARA');
INSERT INTO `ref_desa` VALUES (5683, 600, 'CIVATU');
INSERT INTO `ref_desa` VALUES (5684, 600, 'CMAHICISAAT');
INSERT INTO `ref_desa` VALUES (5685, 600, 'CNAGRAK');
INSERT INTO `ref_desa` VALUES (5686, 600, 'COBOLANG KALER');
INSERT INTO `ref_desa` VALUES (5687, 600, 'COBOLANG KLER');
INSERT INTO `ref_desa` VALUES (5688, 600, 'COBOLNG');
INSERT INTO `ref_desa` VALUES (5689, 600, 'COIBOLANG');
INSERT INTO `ref_desa` VALUES (5690, 600, 'COIBOLANG KALAER');
INSERT INTO `ref_desa` VALUES (5691, 600, 'COIBOLANG KALER');
INSERT INTO `ref_desa` VALUES (5692, 600, 'COSAAT');
INSERT INTO `ref_desa` VALUES (5693, 600, 'CSAAT');
INSERT INTO `ref_desa` VALUES (5694, 600, 'CSABTU');
INSERT INTO `ref_desa` VALUES (5695, 600, 'CTAMIANG');
INSERT INTO `ref_desa` VALUES (5696, 600, 'CUISAAT');
INSERT INTO `ref_desa` VALUES (5697, 600, 'CUKASARI');
INSERT INTO `ref_desa` VALUES (5698, 600, 'CUKUKULU');
INSERT INTO `ref_desa` VALUES (5699, 600, 'CVISAAT');
INSERT INTO `ref_desa` VALUES (5700, 600, 'DANGDEUR');
INSERT INTO `ref_desa` VALUES (5701, 600, 'DARMAREJA');
INSERT INTO `ref_desa` VALUES (5702, 600, 'DIBOLANG');
INSERT INTO `ref_desa` VALUES (5703, 600, 'GANAS SOLI');
INSERT INTO `ref_desa` VALUES (5704, 600, 'GANDA SOLI');
INSERT INTO `ref_desa` VALUES (5705, 600, 'GANG PELUKIS');
INSERT INTO `ref_desa` VALUES (5706, 600, 'GEDE PANGRAGO');
INSERT INTO `ref_desa` VALUES (5707, 600, 'GEDE PANGRANGO');
INSERT INTO `ref_desa` VALUES (5708, 600, 'GEDEPANGRANGO');
INSERT INTO `ref_desa` VALUES (5709, 600, 'GENTONG');
INSERT INTO `ref_desa` VALUES (5710, 600, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (5711, 600, 'GN ENDUT');
INSERT INTO `ref_desa` VALUES (5712, 600, 'GN GURUH');
INSERT INTO `ref_desa` VALUES (5713, 600, 'GN JAYA');
INSERT INTO `ref_desa` VALUES (5714, 600, 'GN JYA');
INSERT INTO `ref_desa` VALUES (5715, 600, 'GN.JAYA');
INSERT INTO `ref_desa` VALUES (5716, 600, 'GN.KARAMAT');
INSERT INTO `ref_desa` VALUES (5717, 600, 'GNG JAYA');
INSERT INTO `ref_desa` VALUES (5718, 600, 'GUNG JAYA');
INSERT INTO `ref_desa` VALUES (5719, 600, 'GUNGGURU');
INSERT INTO `ref_desa` VALUES (5720, 600, 'GUNGGURUH');
INSERT INTO `ref_desa` VALUES (5721, 600, 'GUNGJAYA');
INSERT INTO `ref_desa` VALUES (5722, 600, 'GUNGTAYA');
INSERT INTO `ref_desa` VALUES (5723, 600, 'GUNNG JAYA');
INSERT INTO `ref_desa` VALUES (5724, 600, 'GUNNGG JAYA');
INSERT INTO `ref_desa` VALUES (5725, 600, 'GUNUG GURUH');
INSERT INTO `ref_desa` VALUES (5726, 600, 'GUNUG JAYA');
INSERT INTO `ref_desa` VALUES (5727, 600, 'GUNUGGURUH');
INSERT INTO `ref_desa` VALUES (5728, 600, 'GUNUGJAYA');
INSERT INTO `ref_desa` VALUES (5729, 600, 'GUNUING JAYA');
INSERT INTO `ref_desa` VALUES (5730, 600, 'GUNUN GURUH');
INSERT INTO `ref_desa` VALUES (5731, 600, 'GUNUNG');
INSERT INTO `ref_desa` VALUES (5732, 600, 'GUNUNG ENDUT');
INSERT INTO `ref_desa` VALUES (5733, 600, 'GUNUNG GUEUH');
INSERT INTO `ref_desa` VALUES (5734, 600, 'GUNUNG GULUNG');
INSERT INTO `ref_desa` VALUES (5735, 600, 'GUNUNG GURUG');
INSERT INTO `ref_desa` VALUES (5736, 600, 'GUNUNG GURUH');
INSERT INTO `ref_desa` VALUES (5737, 600, 'GUNUNG GUYUH');
INSERT INTO `ref_desa` VALUES (5738, 600, 'GUNUNG JAA');
INSERT INTO `ref_desa` VALUES (5739, 600, 'GUNUNG JAMBU');
INSERT INTO `ref_desa` VALUES (5740, 600, 'GUNUNG JAYA');
INSERT INTO `ref_desa` VALUES (5741, 600, 'GUNUNG.GURUH');
INSERT INTO `ref_desa` VALUES (5742, 600, 'GUNUNGGUJAYA');
INSERT INTO `ref_desa` VALUES (5743, 600, 'GUNUNGGURUG');
INSERT INTO `ref_desa` VALUES (5744, 600, 'GUNUNGGURUH');
INSERT INTO `ref_desa` VALUES (5745, 600, 'GUNUNGHJAYA');
INSERT INTO `ref_desa` VALUES (5746, 600, 'GUNUNGJYA');
INSERT INTO `ref_desa` VALUES (5747, 600, 'GUNUNGPUYUH');
INSERT INTO `ref_desa` VALUES (5748, 600, 'GUNUNGURUH');
INSERT INTO `ref_desa` VALUES (5749, 600, 'GUNUNUNG JAYA');
INSERT INTO `ref_desa` VALUES (5750, 600, 'HAMBE LAER');
INSERT INTO `ref_desa` VALUES (5751, 600, 'HEGAR MANAH');
INSERT INTO `ref_desa` VALUES (5752, 600, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (5753, 600, 'HEGARSARI');
INSERT INTO `ref_desa` VALUES (5754, 600, 'IBATU');
INSERT INTO `ref_desa` VALUES (5755, 600, 'ICBOLANG');
INSERT INTO `ref_desa` VALUES (5756, 600, 'ISAAT');
INSERT INTO `ref_desa` VALUES (5757, 600, 'JALAN CAGAK');
INSERT INTO `ref_desa` VALUES (5758, 600, 'JAMBE LAER');
INSERT INTO `ref_desa` VALUES (5759, 600, 'JAMBU LAER');
INSERT INTO `ref_desa` VALUES (5760, 600, 'JAYABAKTI');
INSERT INTO `ref_desa` VALUES (5761, 600, 'JKUTA SIRNA');
INSERT INTO `ref_desa` VALUES (5762, 600, 'KADAUDAMPIT');
INSERT INTO `ref_desa` VALUES (5763, 600, 'KADU DAMPIT');
INSERT INTO `ref_desa` VALUES (5764, 600, 'KADUDAMPIT');
INSERT INTO `ref_desa` VALUES (5765, 600, 'KADUPUGUR');
INSERT INTO `ref_desa` VALUES (5766, 600, 'KAHURIPAN');
INSERT INTO `ref_desa` VALUES (5767, 600, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (5768, 600, 'KARANGTENGAH');
INSERT INTO `ref_desa` VALUES (5769, 600, 'KARDENANA');
INSERT INTO `ref_desa` VALUES (5770, 600, 'KAUM KULON');
INSERT INTO `ref_desa` VALUES (5771, 600, 'KCIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (5772, 600, 'KD DAMPIT');
INSERT INTO `ref_desa` VALUES (5773, 600, 'KEBON MANGGU');
INSERT INTO `ref_desa` VALUES (5774, 600, 'KERTASARI');
INSERT INTO `ref_desa` VALUES (5775, 600, 'KGENTONG');
INSERT INTO `ref_desa` VALUES (5776, 600, 'KOTAMANEH');
INSERT INTO `ref_desa` VALUES (5777, 600, 'KP LIUNG TUTUP');
INSERT INTO `ref_desa` VALUES (5778, 600, 'KP PABUARA');
INSERT INTO `ref_desa` VALUES (5779, 600, 'KPTIPT');
INSERT INTO `ref_desa` VALUES (5780, 600, 'KUA SIRNA');
INSERT INTO `ref_desa` VALUES (5781, 600, 'KUSIRNA');
INSERT INTO `ref_desa` VALUES (5782, 600, 'KUTA');
INSERT INTO `ref_desa` VALUES (5783, 600, 'KUTA MANEH');
INSERT INTO `ref_desa` VALUES (5784, 600, 'KUTA RESMI');
INSERT INTO `ref_desa` VALUES (5785, 600, 'KUTA SIRN');
INSERT INTO `ref_desa` VALUES (5786, 600, 'KUTA SIRNA');
INSERT INTO `ref_desa` VALUES (5787, 600, 'KUTA TENGAH');
INSERT INTO `ref_desa` VALUES (5788, 600, 'KUTAJAYA');
INSERT INTO `ref_desa` VALUES (5789, 600, 'KUTAMANAH');
INSERT INTO `ref_desa` VALUES (5790, 600, 'KUTAMANEUH');
INSERT INTO `ref_desa` VALUES (5791, 600, 'KUTARESMI');
INSERT INTO `ref_desa` VALUES (5792, 600, 'KUTARSIRNA');
INSERT INTO `ref_desa` VALUES (5793, 600, 'KUTASARI');
INSERT INTO `ref_desa` VALUES (5794, 600, 'KUTASIRNA');
INSERT INTO `ref_desa` VALUES (5795, 600, 'KUTASIRNA SALAJAMBE');
INSERT INTO `ref_desa` VALUES (5796, 600, 'KUTATENGAH');
INSERT INTO `ref_desa` VALUES (5797, 600, 'LEBAK SIRNA');
INSERT INTO `ref_desa` VALUES (5798, 600, 'LEBAKSIRNA');
INSERT INTO `ref_desa` VALUES (5799, 600, 'LEGOK INGGRIS');
INSERT INTO `ref_desa` VALUES (5800, 600, 'LEMBUR SAWAH');
INSERT INTO `ref_desa` VALUES (5801, 600, 'LEOKNYESNSG');
INSERT INTO `ref_desa` VALUES (5802, 600, 'LINGKUNG SARI');
INSERT INTO `ref_desa` VALUES (5803, 600, 'LIUNG TUTUT');
INSERT INTO `ref_desa` VALUES (5804, 600, 'MAGKALAYA');
INSERT INTO `ref_desa` VALUES (5805, 600, 'MAKARSARRI');
INSERT INTO `ref_desa` VALUES (5806, 600, 'MANGKALAYA');
INSERT INTO `ref_desa` VALUES (5807, 600, 'MANGKALYA');
INSERT INTO `ref_desa` VALUES (5808, 600, 'MANGUNJAYA');
INSERT INTO `ref_desa` VALUES (5809, 600, 'MANKALAYA');
INSERT INTO `ref_desa` VALUES (5810, 600, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (5811, 600, 'MUARA D UA');
INSERT INTO `ref_desa` VALUES (5812, 600, 'MUARA DUA');
INSERT INTO `ref_desa` VALUES (5813, 600, 'NAGAAK');
INSERT INTO `ref_desa` VALUES (5814, 600, 'NAGARAK');
INSERT INTO `ref_desa` VALUES (5815, 600, 'NAGARK');
INSERT INTO `ref_desa` VALUES (5816, 600, 'NAGARRAKCISAAT');
INSERT INTO `ref_desa` VALUES (5817, 600, 'NAGGELENG CIMIANG');
INSERT INTO `ref_desa` VALUES (5818, 600, 'NAGGRAK');
INSERT INTO `ref_desa` VALUES (5819, 600, 'NAGRAK KIDAUL');
INSERT INTO `ref_desa` VALUES (5820, 600, 'NAGRAK KIDUL');
INSERT INTO `ref_desa` VALUES (5821, 600, 'NAGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (5822, 600, 'NAGRAK TENGAH');
INSERT INTO `ref_desa` VALUES (5823, 600, 'NAGRAK UTARA');
INSERT INTO `ref_desa` VALUES (5824, 600, 'NAGRAK.');
INSERT INTO `ref_desa` VALUES (5825, 600, 'NAGRAK?CISAAT');
INSERT INTO `ref_desa` VALUES (5826, 600, 'NAGRK SELATAN');
INSERT INTO `ref_desa` VALUES (5827, 600, 'NAGRQAK');
INSERT INTO `ref_desa` VALUES (5828, 600, 'NANGERANG');
INSERT INTO `ref_desa` VALUES (5829, 600, 'NGARAK');
INSERT INTO `ref_desa` VALUES (5830, 600, 'NGRAK');
INSERT INTO `ref_desa` VALUES (5831, 600, 'NMANGKALAYA');
INSERT INTO `ref_desa` VALUES (5832, 600, 'NYOMPLONG');
INSERT INTO `ref_desa` VALUES (5833, 600, 'PABUARAN');
INSERT INTO `ref_desa` VALUES (5834, 600, 'PADA ASIH');
INSERT INTO `ref_desa` VALUES (5835, 600, 'PADA ASIH S');
INSERT INTO `ref_desa` VALUES (5836, 600, 'PADA MELANG');
INSERT INTO `ref_desa` VALUES (5837, 600, 'PADAA ASIH');
INSERT INTO `ref_desa` VALUES (5838, 600, 'PADAAASIH');
INSERT INTO `ref_desa` VALUES (5839, 600, 'PADAASIH');
INSERT INTO `ref_desa` VALUES (5840, 600, 'PADAMELAN');
INSERT INTO `ref_desa` VALUES (5841, 600, 'PADASIH');
INSERT INTO `ref_desa` VALUES (5842, 600, 'PADURENAN');
INSERT INTO `ref_desa` VALUES (5843, 600, 'PADURENN');
INSERT INTO `ref_desa` VALUES (5844, 600, 'PALEDANG');
INSERT INTO `ref_desa` VALUES (5845, 600, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (5846, 600, 'PANGRANGO');
INSERT INTO `ref_desa` VALUES (5847, 600, 'PANYAINDANGAN');
INSERT INTO `ref_desa` VALUES (5848, 600, 'PANYINDANG SELAJAMBE');
INSERT INTO `ref_desa` VALUES (5849, 600, 'PARA ASIH');
INSERT INTO `ref_desa` VALUES (5850, 600, 'PARIGI');
INSERT INTO `ref_desa` VALUES (5851, 600, 'PASAWAHAN');
INSERT INTO `ref_desa` VALUES (5852, 600, 'PASDAASIH');
INSERT INTO `ref_desa` VALUES (5853, 600, 'PASI PARAJI');
INSERT INTO `ref_desa` VALUES (5854, 600, 'PASIHUNI');
INSERT INTO `ref_desa` VALUES (5855, 600, 'PASIR BADAK');
INSERT INTO `ref_desa` VALUES (5856, 600, 'PASIR HALANG');
INSERT INTO `ref_desa` VALUES (5857, 600, 'PASIR LANGU');
INSERT INTO `ref_desa` VALUES (5858, 600, 'PD ASIH');
INSERT INTO `ref_desa` VALUES (5859, 600, 'PD.ASIH');
INSERT INTO `ref_desa` VALUES (5860, 600, 'PDAASIH');
INSERT INTO `ref_desa` VALUES (5861, 600, 'PERUM DISEN');
INSERT INTO `ref_desa` VALUES (5862, 600, 'PERUM MANGKALA');
INSERT INTO `ref_desa` VALUES (5863, 600, 'PETEU CDONG');
INSERT INTO `ref_desa` VALUES (5864, 600, 'PETEY CONDONG');
INSERT INTO `ref_desa` VALUES (5865, 600, 'PEUTEUY CONDONG');
INSERT INTO `ref_desa` VALUES (5866, 600, 'PONPES AL SALAFIYAH');
INSERT INTO `ref_desa` VALUES (5867, 600, 'PULASARI');
INSERT INTO `ref_desa` VALUES (5868, 600, 'PUNCAK MANIS');
INSERT INTO `ref_desa` VALUES (5869, 600, 'RABAY');
INSERT INTO `ref_desa` VALUES (5870, 600, 'RAMBAI');
INSERT INTO `ref_desa` VALUES (5871, 600, 'RAMBAY');
INSERT INTO `ref_desa` VALUES (5872, 600, 'RAMBAY TENGAH');
INSERT INTO `ref_desa` VALUES (5873, 600, 'RAMBONG');
INSERT INTO `ref_desa` VALUES (5874, 600, 'RANMABAY KALER');
INSERT INTO `ref_desa` VALUES (5875, 600, 'RMBAY');
INSERT INTO `ref_desa` VALUES (5876, 600, 'SALA AWI');
INSERT INTO `ref_desa` VALUES (5877, 600, 'SALA JAMBE');
INSERT INTO `ref_desa` VALUES (5878, 600, 'SALAAWI');
INSERT INTO `ref_desa` VALUES (5879, 600, 'SALAJAMBE');
INSERT INTO `ref_desa` VALUES (5880, 600, 'SASAGARAN');
INSERT INTO `ref_desa` VALUES (5881, 600, 'SAWAH LEGA');
INSERT INTO `ref_desa` VALUES (5882, 600, 'SAWAH LWGA');
INSERT INTO `ref_desa` VALUES (5883, 600, 'SEALAJAMBE');
INSERT INTO `ref_desa` VALUES (5884, 600, 'SEALAJMBE');
INSERT INTO `ref_desa` VALUES (5885, 600, 'SEALJAMBE');
INSERT INTO `ref_desa` VALUES (5886, 600, 'SEKARSARI');
INSERT INTO `ref_desa` VALUES (5887, 600, 'SELA JAMBE');
INSERT INTO `ref_desa` VALUES (5888, 600, 'SELAAWI');
INSERT INTO `ref_desa` VALUES (5889, 600, 'SELAJAMABE');
INSERT INTO `ref_desa` VALUES (5890, 600, 'SELAJAMBE CSAAT');
INSERT INTO `ref_desa` VALUES (5891, 600, 'SELAJAMBEN');
INSERT INTO `ref_desa` VALUES (5892, 600, 'SELAJAMNE');
INSERT INTO `ref_desa` VALUES (5893, 600, 'SELAJANBE');
INSERT INTO `ref_desa` VALUES (5894, 600, 'SELAJMABE');
INSERT INTO `ref_desa` VALUES (5895, 600, 'SELAJMBE');
INSERT INTO `ref_desa` VALUES (5896, 600, 'SELAKAMBE');
INSERT INTO `ref_desa` VALUES (5897, 600, 'SELAMAJAH');
INSERT INTO `ref_desa` VALUES (5898, 600, 'SELAMANJAH');
INSERT INTO `ref_desa` VALUES (5899, 600, 'SELAMJAMBE');
INSERT INTO `ref_desa` VALUES (5900, 600, 'SELJAAMBE');
INSERT INTO `ref_desa` VALUES (5901, 600, 'SELJAMBE');
INSERT INTO `ref_desa` VALUES (5902, 600, 'SERLAJAMBE');
INSERT INTO `ref_desa` VALUES (5903, 600, 'SIKASARI');
INSERT INTO `ref_desa` VALUES (5904, 600, 'SINDAG RESMI');
INSERT INTO `ref_desa` VALUES (5905, 600, 'SINDANG RESMI');
INSERT INTO `ref_desa` VALUES (5906, 600, 'SINDANGRESMI');
INSERT INTO `ref_desa` VALUES (5907, 600, 'SIRBARESMI');
INSERT INTO `ref_desa` VALUES (5908, 600, 'SIRNA RESMI');
INSERT INTO `ref_desa` VALUES (5909, 600, 'SIRNARESMI');
INSERT INTO `ref_desa` VALUES (5910, 600, 'SIRNASARI');
INSERT INTO `ref_desa` VALUES (5911, 600, 'SIRNASRESMI');
INSERT INTO `ref_desa` VALUES (5912, 600, 'SL JAMBE');
INSERT INTO `ref_desa` VALUES (5913, 600, 'SLAAWI');
INSERT INTO `ref_desa` VALUES (5914, 600, 'SLAJAMBE');
INSERT INTO `ref_desa` VALUES (5915, 600, 'SLASJAMBE');
INSERT INTO `ref_desa` VALUES (5916, 600, 'SLEAJAMBE');
INSERT INTO `ref_desa` VALUES (5917, 600, 'SLJAMBE');
INSERT INTO `ref_desa` VALUES (5918, 600, 'SSUKAMANTRI');
INSERT INTO `ref_desa` VALUES (5919, 600, 'SUAKASARI');
INSERT INTO `ref_desa` VALUES (5920, 600, 'SUAKMANAH');
INSERT INTO `ref_desa` VALUES (5921, 600, 'SUAMANAH');
INSERT INTO `ref_desa` VALUES (5922, 600, 'SUIKAMANAH');
INSERT INTO `ref_desa` VALUES (5923, 600, 'SUKA KARYA');
INSERT INTO `ref_desa` VALUES (5924, 600, 'SUKA KERSA');
INSERT INTO `ref_desa` VALUES (5925, 600, 'SUKA MANAH');
INSERT INTO `ref_desa` VALUES (5926, 600, 'SUKA MANTRI');
INSERT INTO `ref_desa` VALUES (5927, 600, 'SUKA MANTU');
INSERT INTO `ref_desa` VALUES (5928, 600, 'SUKA RAME');
INSERT INTO `ref_desa` VALUES (5929, 600, 'SUKA RESMI');
INSERT INTO `ref_desa` VALUES (5930, 600, 'SUKA SARI');
INSERT INTO `ref_desa` VALUES (5931, 600, 'SUKA SIRNA');
INSERT INTO `ref_desa` VALUES (5932, 600, 'SUKA,MANAH');
INSERT INTO `ref_desa` VALUES (5933, 600, 'SUKAAAARESMI');
INSERT INTO `ref_desa` VALUES (5934, 600, 'SUKAAARESMI');
INSERT INTO `ref_desa` VALUES (5935, 600, 'SUKAANTRI');
INSERT INTO `ref_desa` VALUES (5936, 600, 'SUKAASIH');
INSERT INTO `ref_desa` VALUES (5937, 600, 'SUKABUMI');
INSERT INTO `ref_desa` VALUES (5938, 600, 'SUKADAMAI');
INSERT INTO `ref_desa` VALUES (5939, 600, 'SUKAKARYA');
INSERT INTO `ref_desa` VALUES (5940, 600, 'SUKAMA');
INSERT INTO `ref_desa` VALUES (5941, 600, 'SUKAMAH');
INSERT INTO `ref_desa` VALUES (5942, 600, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (5943, 600, 'SUKAMAMANAH');
INSERT INTO `ref_desa` VALUES (5944, 600, 'SUKAMANA');
INSERT INTO `ref_desa` VALUES (5945, 600, 'SUKAMANAG');
INSERT INTO `ref_desa` VALUES (5946, 600, 'SUKAMANAGH');
INSERT INTO `ref_desa` VALUES (5947, 600, 'SUKAMANAH .');
INSERT INTO `ref_desa` VALUES (5948, 600, 'SUKAMANAH II');
INSERT INTO `ref_desa` VALUES (5949, 600, 'SUKAMANAH?CISAAT');
INSERT INTO `ref_desa` VALUES (5950, 600, 'SUKAMANAHA');
INSERT INTO `ref_desa` VALUES (5951, 600, 'SUKAMANAN');
INSERT INTO `ref_desa` VALUES (5952, 600, 'SUKAMANATRI');
INSERT INTO `ref_desa` VALUES (5953, 600, 'SUKAMANDI');
INSERT INTO `ref_desa` VALUES (5954, 600, 'SUKAMANH');
INSERT INTO `ref_desa` VALUES (5955, 600, 'SUKAMANIS');
INSERT INTO `ref_desa` VALUES (5956, 600, 'SUKAMANTARI');
INSERT INTO `ref_desa` VALUES (5957, 600, 'SUKAMANTRI');
INSERT INTO `ref_desa` VALUES (5958, 600, 'SUKAMANTRI .');
INSERT INTO `ref_desa` VALUES (5959, 600, 'SUKAMANTRTI');
INSERT INTO `ref_desa` VALUES (5960, 600, 'SUKAMANTTRRI');
INSERT INTO `ref_desa` VALUES (5961, 600, 'SUKAMATRI');
INSERT INTO `ref_desa` VALUES (5962, 600, 'SUKAMNAH');
INSERT INTO `ref_desa` VALUES (5963, 600, 'SUKAMNATRI');
INSERT INTO `ref_desa` VALUES (5964, 600, 'SUKAMNTRI');
INSERT INTO `ref_desa` VALUES (5965, 600, 'SUKAMTRI');
INSERT INTO `ref_desa` VALUES (5966, 600, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (5967, 600, 'SUKANMANAH');
INSERT INTO `ref_desa` VALUES (5968, 600, 'SUKANTRI');
INSERT INTO `ref_desa` VALUES (5969, 600, 'SUKARAJA');
INSERT INTO `ref_desa` VALUES (5970, 600, 'SUKARAME');
INSERT INTO `ref_desa` VALUES (5971, 600, 'SUKAREAMI');
INSERT INTO `ref_desa` VALUES (5972, 600, 'SUKAREASMI');
INSERT INTO `ref_desa` VALUES (5973, 600, 'SUKAREMI');
INSERT INTO `ref_desa` VALUES (5974, 600, 'SUKARESMI .');
INSERT INTO `ref_desa` VALUES (5975, 600, 'SUKARESTU');
INSERT INTO `ref_desa` VALUES (5976, 600, 'SUKASARI.');
INSERT INTO `ref_desa` VALUES (5977, 600, 'SUKASIRNA');
INSERT INTO `ref_desa` VALUES (5978, 600, 'SUKASRI');
INSERT INTO `ref_desa` VALUES (5979, 600, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (5980, 600, 'SUKATRESMI');
INSERT INTO `ref_desa` VALUES (5981, 600, 'SUKIAMANAH');
INSERT INTO `ref_desa` VALUES (5982, 600, 'SUKLAMANTRI');
INSERT INTO `ref_desa` VALUES (5983, 600, 'SUKLMANAH');
INSERT INTO `ref_desa` VALUES (5984, 600, 'SUKMANAH');
INSERT INTO `ref_desa` VALUES (5985, 600, 'SUKMANHA');
INSERT INTO `ref_desa` VALUES (5986, 600, 'SUKMNAH]');
INSERT INTO `ref_desa` VALUES (5987, 600, 'SUKSARI');
INSERT INTO `ref_desa` VALUES (5988, 600, 'SUMKAMANAH');
INSERT INTO `ref_desa` VALUES (5989, 600, 'SUMKAMANTRI');
INSERT INTO `ref_desa` VALUES (5990, 600, 'SUNDA WENANG');
INSERT INTO `ref_desa` VALUES (5991, 600, 'SUNKAMANTRI');
INSERT INTO `ref_desa` VALUES (5992, 600, 'SUYKAMANAH');
INSERT INTO `ref_desa` VALUES (5993, 600, 'SUYKARESMI');
INSERT INTO `ref_desa` VALUES (5994, 600, 'TALAGA');
INSERT INTO `ref_desa` VALUES (5995, 600, 'TEGAL PADUL');
INSERT INTO `ref_desa` VALUES (5996, 600, 'TEJOLYA');
INSERT INTO `ref_desa` VALUES (5997, 600, 'TENJO JAYA');
INSERT INTO `ref_desa` VALUES (5998, 600, 'TENJO LAYA');
INSERT INTO `ref_desa` VALUES (5999, 600, 'TENJOLAYA');
INSERT INTO `ref_desa` VALUES (6000, 600, 'TIPAR');
INSERT INTO `ref_desa` VALUES (6001, 600, 'TIPAR PEUNTAS');
INSERT INTO `ref_desa` VALUES (6002, 600, 'TIPARA');
INSERT INTO `ref_desa` VALUES (6003, 600, 'TIPAS PENUTAS');
INSERT INTO `ref_desa` VALUES (6004, 600, 'UKAMANAH');
INSERT INTO `ref_desa` VALUES (6005, 600, 'VETERAN');
INSERT INTO `ref_desa` VALUES (6006, 600, ']SUKASARI');
INSERT INTO `ref_desa` VALUES (6007, 174, 'BATU LAYANG');
INSERT INTO `ref_desa` VALUES (6008, 174, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (6009, 174, 'CISARUA');
INSERT INTO `ref_desa` VALUES (6010, 174, 'CITEKO');
INSERT INTO `ref_desa` VALUES (6011, 174, 'KABANDUNGAN');
INSERT INTO `ref_desa` VALUES (6012, 174, 'MEKAR SARI');
INSERT INTO `ref_desa` VALUES (6013, 174, 'TUGU SELATAN');
INSERT INTO `ref_desa` VALUES (6014, 671, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (6015, 671, 'CICSOLOK');
INSERT INTO `ref_desa` VALUES (6016, 671, 'CIKAKAK');
INSERT INTO `ref_desa` VALUES (6017, 671, 'CIKLAK');
INSERT INTO `ref_desa` VALUES (6018, 671, 'CILENGSING');
INSERT INTO `ref_desa` VALUES (6019, 671, 'CILEUNGSI');
INSERT INTO `ref_desa` VALUES (6020, 671, 'CILEUNGSIH');
INSERT INTO `ref_desa` VALUES (6021, 671, 'CILEUNGSING');
INSERT INTO `ref_desa` VALUES (6022, 671, 'CIMAJA');
INSERT INTO `ref_desa` VALUES (6023, 671, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (6024, 671, 'CISOLO');
INSERT INTO `ref_desa` VALUES (6025, 671, 'CITARIK');
INSERT INTO `ref_desa` VALUES (6026, 671, 'COSOLOK');
INSERT INTO `ref_desa` VALUES (6027, 671, 'GN KARAMAT');
INSERT INTO `ref_desa` VALUES (6028, 671, 'GN KRAMAT');
INSERT INTO `ref_desa` VALUES (6029, 671, 'GN TANJUNG');
INSERT INTO `ref_desa` VALUES (6030, 671, 'GUNUNG KARAMAT');
INSERT INTO `ref_desa` VALUES (6031, 671, 'GUNUNG KERAMAT');
INSERT INTO `ref_desa` VALUES (6032, 671, 'GUNUNGKARAMAT');
INSERT INTO `ref_desa` VALUES (6033, 671, 'GUNUNGKERAMAT');
INSERT INTO `ref_desa` VALUES (6034, 671, 'JAMBE LAER');
INSERT INTO `ref_desa` VALUES (6035, 671, 'KALANG PAK PAK');
INSERT INTO `ref_desa` VALUES (6036, 671, 'KARANG PAPAK');
INSERT INTO `ref_desa` VALUES (6037, 671, 'KARANG PAPAK.CISOLOK');
INSERT INTO `ref_desa` VALUES (6038, 671, 'KARANG PAPAT');
INSERT INTO `ref_desa` VALUES (6039, 671, 'KRG PAKPAK');
INSERT INTO `ref_desa` VALUES (6040, 671, 'MARINJUNG');
INSERT INTO `ref_desa` VALUES (6041, 671, 'MUKAMANAH');
INSERT INTO `ref_desa` VALUES (6042, 671, 'OASIBRU');
INSERT INTO `ref_desa` VALUES (6043, 671, 'PASAR BARU');
INSERT INTO `ref_desa` VALUES (6044, 671, 'PASIR BARU');
INSERT INTO `ref_desa` VALUES (6045, 671, 'PASIR GARU');
INSERT INTO `ref_desa` VALUES (6046, 671, 'PASIRBATU');
INSERT INTO `ref_desa` VALUES (6047, 671, 'RIDO GALIH');
INSERT INTO `ref_desa` VALUES (6048, 671, 'RIDOGALIH');
INSERT INTO `ref_desa` VALUES (6049, 671, 'SIRNA RASA');
INSERT INTO `ref_desa` VALUES (6050, 671, 'SIRNA RESMI');
INSERT INTO `ref_desa` VALUES (6051, 671, 'SIRNARESMI');
INSERT INTO `ref_desa` VALUES (6052, 671, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (6053, 565, 'KEBON PETEUI');
INSERT INTO `ref_desa` VALUES (6054, 565, 'SONGGOM');
INSERT INTO `ref_desa` VALUES (6055, 95, 'JAKARTA TIMUR');
INSERT INTO `ref_desa` VALUES (6056, 95, 'JAKRATA');
INSERT INTO `ref_desa` VALUES (6057, 95, 'JKARTA');
INSERT INTO `ref_desa` VALUES (6058, 107, 'JAKARTA');
INSERT INTO `ref_desa` VALUES (6059, 182, 'ATANGKOLO');
INSERT INTO `ref_desa` VALUES (6060, 182, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (6061, 182, 'BABAKAN JAYA');
INSERT INTO `ref_desa` VALUES (6062, 182, 'BANDUNGAN');
INSERT INTO `ref_desa` VALUES (6063, 182, 'BENDA');
INSERT INTO `ref_desa` VALUES (6064, 182, 'CIARAGA');
INSERT INTO `ref_desa` VALUES (6065, 182, 'CIAUL');
INSERT INTO `ref_desa` VALUES (6066, 182, 'CIAWI TALI');
INSERT INTO `ref_desa` VALUES (6067, 182, 'CIAWITALI');
INSERT INTO `ref_desa` VALUES (6068, 182, 'CIBEUREUM');
INSERT INTO `ref_desa` VALUES (6069, 182, 'CICADAS');
INSERT INTO `ref_desa` VALUES (6070, 182, 'CIHAMBERANG');
INSERT INTO `ref_desa` VALUES (6071, 182, 'CIHAMEARANG');
INSERT INTO `ref_desa` VALUES (6072, 182, 'CIHAMERANGCIHAMERANG');
INSERT INTO `ref_desa` VALUES (6073, 182, 'CIHAMERNG');
INSERT INTO `ref_desa` VALUES (6074, 182, 'CIHEMERANG');
INSERT INTO `ref_desa` VALUES (6075, 182, 'CIHUMERANG');
INSERT INTO `ref_desa` VALUES (6076, 182, 'CIKALONG WETAN');
INSERT INTO `ref_desa` VALUES (6077, 182, 'CIKAMERANG');
INSERT INTO `ref_desa` VALUES (6078, 182, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (6079, 182, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (6080, 182, 'CIPANAS');
INSERT INTO `ref_desa` VALUES (6081, 182, 'CIPANENGAH');
INSERT INTO `ref_desa` VALUES (6082, 182, 'CIPEEUY');
INSERT INTO `ref_desa` VALUES (6083, 182, 'CIPETEU');
INSERT INTO `ref_desa` VALUES (6084, 182, 'CIPETEUI');
INSERT INTO `ref_desa` VALUES (6085, 182, 'CIPETEUY');
INSERT INTO `ref_desa` VALUES (6086, 182, 'CIPETEY');
INSERT INTO `ref_desa` VALUES (6087, 182, 'CIPETUY');
INSERT INTO `ref_desa` VALUES (6088, 182, 'CIPEUTEUY.');
INSERT INTO `ref_desa` VALUES (6089, 182, 'CIPEUTEY');
INSERT INTO `ref_desa` VALUES (6090, 182, 'CIPEUTUY');
INSERT INTO `ref_desa` VALUES (6091, 182, 'CIPEUYEUY');
INSERT INTO `ref_desa` VALUES (6092, 182, 'CIPEUYTEUY');
INSERT INTO `ref_desa` VALUES (6093, 182, 'CIPUETEUY');
INSERT INTO `ref_desa` VALUES (6094, 182, 'CIPUETTEUY');
INSERT INTO `ref_desa` VALUES (6095, 182, 'CIRAKSAMALA');
INSERT INTO `ref_desa` VALUES (6096, 182, 'CISALIMAR');
INSERT INTO `ref_desa` VALUES (6097, 182, 'CISARUA');
INSERT INTO `ref_desa` VALUES (6098, 182, 'CISAT');
INSERT INTO `ref_desa` VALUES (6099, 182, 'CPEUTEUY');
INSERT INTO `ref_desa` VALUES (6100, 182, 'CUIPEUTEUY');
INSERT INTO `ref_desa` VALUES (6101, 182, 'CUIPEUTEY');
INSERT INTO `ref_desa` VALUES (6102, 182, 'GUNUNG TANJUNG');
INSERT INTO `ref_desa` VALUES (6103, 182, 'JAYA BAKTI');
INSERT INTO `ref_desa` VALUES (6104, 182, 'JAYA NEGARA');
INSERT INTO `ref_desa` VALUES (6105, 182, 'JAYANEGARA');
INSERT INTO `ref_desa` VALUES (6106, 182, 'KAAAABNDAUNGAN');
INSERT INTO `ref_desa` VALUES (6107, 182, 'KAADUNGAN');
INSERT INTO `ref_desa` VALUES (6108, 182, 'KAANDUNGAN');
INSERT INTO `ref_desa` VALUES (6109, 182, 'KABADUNGAN');
INSERT INTO `ref_desa` VALUES (6110, 182, 'KABAN DUNGAN');
INSERT INTO `ref_desa` VALUES (6111, 182, 'KABANDU NGAN');
INSERT INTO `ref_desa` VALUES (6112, 182, 'KABANDUGAN');
INSERT INTO `ref_desa` VALUES (6113, 182, 'KABANDUNAGAMN');
INSERT INTO `ref_desa` VALUES (6114, 182, 'KABANDUNAGAN');
INSERT INTO `ref_desa` VALUES (6115, 182, 'KABANDUNAGN');
INSERT INTO `ref_desa` VALUES (6116, 182, 'KABANDUNGANG');
INSERT INTO `ref_desa` VALUES (6117, 182, 'KABANDUNGN');
INSERT INTO `ref_desa` VALUES (6118, 182, 'KABNADUNGAN');
INSERT INTO `ref_desa` VALUES (6119, 182, 'KABNDUNGAN');
INSERT INTO `ref_desa` VALUES (6120, 182, 'KABNDUNGN');
INSERT INTO `ref_desa` VALUES (6121, 182, 'KABUNDANG');
INSERT INTO `ref_desa` VALUES (6122, 182, 'KAKABNDUNGAN');
INSERT INTO `ref_desa` VALUES (6123, 182, 'KALADI');
INSERT INTO `ref_desa` VALUES (6124, 182, 'KALAPA  NUNGGAL');
INSERT INTO `ref_desa` VALUES (6125, 182, 'KALAPANUGGAL');
INSERT INTO `ref_desa` VALUES (6126, 182, 'KAMPUNG TUGU');
INSERT INTO `ref_desa` VALUES (6127, 182, 'KANBANDUNGAN');
INSERT INTO `ref_desa` VALUES (6128, 182, 'KANDUNGAN');
INSERT INTO `ref_desa` VALUES (6129, 182, 'KBANDUNAGN');
INSERT INTO `ref_desa` VALUES (6130, 182, 'KBANDUNGAN');
INSERT INTO `ref_desa` VALUES (6131, 182, 'KP PAJAGAN');
INSERT INTO `ref_desa` VALUES (6132, 182, 'KP. KALADI');
INSERT INTO `ref_desa` VALUES (6133, 182, 'LANGENSARI');
INSERT INTO `ref_desa` VALUES (6134, 182, 'MEKAR JAYA');
INSERT INTO `ref_desa` VALUES (6135, 182, 'MEKAR JAYA]');
INSERT INTO `ref_desa` VALUES (6136, 182, 'MEKRAJAYA');
INSERT INTO `ref_desa` VALUES (6137, 182, 'MRKAR JAYA');
INSERT INTO `ref_desa` VALUES (6138, 182, 'PAJAGAN');
INSERT INTO `ref_desa` VALUES (6139, 182, 'PAJAGAN GIRANG');
INSERT INTO `ref_desa` VALUES (6140, 182, 'PAJAGANGIRANG');
INSERT INTO `ref_desa` VALUES (6141, 182, 'PAJANGAN');
INSERT INTO `ref_desa` VALUES (6142, 182, 'PALASARI');
INSERT INTO `ref_desa` VALUES (6143, 182, 'PALASARI GIRANG');
INSERT INTO `ref_desa` VALUES (6144, 182, 'PAMEKARAN');
INSERT INTO `ref_desa` VALUES (6145, 182, 'PAMEUNGPEUK');
INSERT INTO `ref_desa` VALUES (6146, 182, 'PAMUMJPUG');
INSERT INTO `ref_desa` VALUES (6147, 182, 'PASIR MENIR');
INSERT INTO `ref_desa` VALUES (6148, 182, 'SIANAGA');
INSERT INTO `ref_desa` VALUES (6149, 182, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (6150, 182, 'SUKASIRNA');
INSERT INTO `ref_desa` VALUES (6151, 182, 'TANGGOLO');
INSERT INTO `ref_desa` VALUES (6152, 182, 'TANGKOLO');
INSERT INTO `ref_desa` VALUES (6153, 182, 'TUGABANDUNGAN');
INSERT INTO `ref_desa` VALUES (6154, 182, 'TUGU');
INSERT INTO `ref_desa` VALUES (6155, 182, 'TUGU ANDUNG');
INSERT INTO `ref_desa` VALUES (6156, 182, 'TUGU BANDUGAN');
INSERT INTO `ref_desa` VALUES (6157, 182, 'TUGU BANDUNG');
INSERT INTO `ref_desa` VALUES (6158, 182, 'TUGU BANDUNGA');
INSERT INTO `ref_desa` VALUES (6159, 182, 'TUGU BANDUNGAN');
INSERT INTO `ref_desa` VALUES (6160, 182, 'TUGU BANDUNGN');
INSERT INTO `ref_desa` VALUES (6161, 182, 'TUGU BNADUNG');
INSERT INTO `ref_desa` VALUES (6162, 182, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (6163, 182, 'TUGUBANUNG');
INSERT INTO `ref_desa` VALUES (6164, 651, 'KADUDAMMPIT');
INSERT INTO `ref_desa` VALUES (6165, 651, 'MUARA D UA');
INSERT INTO `ref_desa` VALUES (6166, 651, 'MUARA DUA');
INSERT INTO `ref_desa` VALUES (6167, 663, 'KLPANUNGGAL');
INSERT INTO `ref_desa` VALUES (6168, 680, 'BALAIKAMBANG');
INSERT INTO `ref_desa` VALUES (6169, 680, 'BALAIKEMBANG');
INSERT INTO `ref_desa` VALUES (6170, 680, 'BALEKEMBANG');
INSERT INTO `ref_desa` VALUES (6171, 680, 'BLEKAMBANG');
INSERT INTO `ref_desa` VALUES (6172, 680, 'BOJONG SATU');
INSERT INTO `ref_desa` VALUES (6173, 680, 'BUNIWANGI');
INSERT INTO `ref_desa` VALUES (6174, 680, 'KALI BUNDER');
INSERT INTO `ref_desa` VALUES (6175, 680, 'KALIBUNDAR');
INSERT INTO `ref_desa` VALUES (6176, 680, 'PANYUSUHAN');
INSERT INTO `ref_desa` VALUES (6177, 680, 'PULOSARI');
INSERT INTO `ref_desa` VALUES (6178, 680, 'SUKA LUYU');
INSERT INTO `ref_desa` VALUES (6179, 680, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (6180, 680, 'SUKARSARI');
INSERT INTO `ref_desa` VALUES (6181, 680, 'SUKASARI');
INSERT INTO `ref_desa` VALUES (6182, 625, 'BABAKAN SITU');
INSERT INTO `ref_desa` VALUES (6183, 625, 'KARAWANG');
INSERT INTO `ref_desa` VALUES (6184, 625, 'RENGASDENGKLOK');
INSERT INTO `ref_desa` VALUES (6185, 625, 'SUKAJAYA');
INSERT INTO `ref_desa` VALUES (6186, 625, 'SUNDA JAYA GIRANG');
INSERT INTO `ref_desa` VALUES (6187, 625, 'WARNASARI');
INSERT INTO `ref_desa` VALUES (6188, 184, 'ATANG SENJAYA');
INSERT INTO `ref_desa` VALUES (6189, 184, 'HEGAR MANAH');
INSERT INTO `ref_desa` VALUES (6190, 184, 'LEMBUR JAMI');
INSERT INTO `ref_desa` VALUES (6191, 184, 'RANCABUNGUR');
INSERT INTO `ref_desa` VALUES (6192, 603, 'ALMASTURIYAH');
INSERT INTO `ref_desa` VALUES (6193, 603, 'BANTARSARI');
INSERT INTO `ref_desa` VALUES (6194, 603, 'BOJONG HAUR');
INSERT INTO `ref_desa` VALUES (6195, 603, 'CEMPAKA');
INSERT INTO `ref_desa` VALUES (6196, 603, 'CILANGKAP I');
INSERT INTO `ref_desa` VALUES (6197, 603, 'CILENGKO');
INSERT INTO `ref_desa` VALUES (6198, 603, 'CIRANGKAP');
INSERT INTO `ref_desa` VALUES (6199, 603, 'HEGARSARI');
INSERT INTO `ref_desa` VALUES (6200, 603, 'JAMPANG TENGAH');
INSERT INTO `ref_desa` VALUES (6201, 603, 'LANGKAP JAYA');
INSERT INTO `ref_desa` VALUES (6202, 603, 'LANGKAT JAYA');
INSERT INTO `ref_desa` VALUES (6203, 603, 'LEANGOONG');
INSERT INTO `ref_desa` VALUES (6204, 603, 'LENGKOMG');
INSERT INTO `ref_desa` VALUES (6205, 603, 'LENKONG');
INSERT INTO `ref_desa` VALUES (6206, 603, 'NEGLA SARI');
INSERT INTO `ref_desa` VALUES (6207, 603, 'PANCA SARI');
INSERT INTO `ref_desa` VALUES (6208, 603, 'PASIR BENDA');
INSERT INTO `ref_desa` VALUES (6209, 603, 'RANGKAP JAYA');
INSERT INTO `ref_desa` VALUES (6210, 603, 'RNGKAPJAYA');
INSERT INTO `ref_desa` VALUES (6211, 603, 'SIRNASARI');
INSERT INTO `ref_desa` VALUES (6212, 603, 'TEGAL BULED');
INSERT INTO `ref_desa` VALUES (6213, 603, 'TEGAL LEGA');
INSERT INTO `ref_desa` VALUES (6214, 603, 'TEGALDATAR');
INSERT INTO `ref_desa` VALUES (6215, 603, 'TEGALEGA');
INSERT INTO `ref_desa` VALUES (6216, 604, 'LIMO');
INSERT INTO `ref_desa` VALUES (6217, 186, 'BJ JENGKOL');
INSERT INTO `ref_desa` VALUES (6218, 186, 'KR TENGAH');
INSERT INTO `ref_desa` VALUES (6219, 186, 'PASIR JAYA');
INSERT INTO `ref_desa` VALUES (6220, 188, '04');
INSERT INTO `ref_desa` VALUES (6221, 188, '08');
INSERT INTO `ref_desa` VALUES (6222, 188, '3CISARUA');
INSERT INTO `ref_desa` VALUES (6223, 188, 'ACIAMBAR');
INSERT INTO `ref_desa` VALUES (6224, 188, 'AGRAK');
INSERT INTO `ref_desa` VALUES (6225, 188, 'AGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (6226, 188, 'AGRAK TARA');
INSERT INTO `ref_desa` VALUES (6227, 188, 'AGRAKCISARUA');
INSERT INTO `ref_desa` VALUES (6228, 188, 'AGRAKSELATAN');
INSERT INTO `ref_desa` VALUES (6229, 188, 'ALTAKWIN');
INSERT INTO `ref_desa` VALUES (6230, 188, 'ARAK UTARA');
INSERT INTO `ref_desa` VALUES (6231, 188, 'AYINDANGAN');
INSERT INTO `ref_desa` VALUES (6232, 188, 'BABAJAN PANJANG');
INSERT INTO `ref_desa` VALUES (6233, 188, 'BABAKAB N PANJAANG');
INSERT INTO `ref_desa` VALUES (6234, 188, 'BABAKAN');
INSERT INTO `ref_desa` VALUES (6235, 188, 'BABAKAN  PANJANG');
INSERT INTO `ref_desa` VALUES (6236, 188, 'BABAKAN -PANJANG');
INSERT INTO `ref_desa` VALUES (6237, 188, 'BABAKAN GOBANG');
INSERT INTO `ref_desa` VALUES (6238, 188, 'BABAKAN JPANJANG');
INSERT INTO `ref_desa` VALUES (6239, 188, 'BABAKAN KEMBANG');
INSERT INTO `ref_desa` VALUES (6240, 188, 'BABAKAN PAANJANG');
INSERT INTO `ref_desa` VALUES (6241, 188, 'BABAKAN PANAJANG');
INSERT INTO `ref_desa` VALUES (6242, 188, 'BABAKAN PANAJNG');
INSERT INTO `ref_desa` VALUES (6243, 188, 'BABAKAN PANJNAG');
INSERT INTO `ref_desa` VALUES (6244, 188, 'BABAKAN SAWAH');
INSERT INTO `ref_desa` VALUES (6245, 188, 'BABAKAN SIRNA');
INSERT INTO `ref_desa` VALUES (6246, 188, 'BABAKAN TENGAH');
INSERT INTO `ref_desa` VALUES (6247, 188, 'BABAKANA PANJANG');
INSERT INTO `ref_desa` VALUES (6248, 188, 'BABAKANPANJANG');
INSERT INTO `ref_desa` VALUES (6249, 188, 'BABAKN PANJANG');
INSERT INTO `ref_desa` VALUES (6250, 188, 'BABAKNA PANJANG');
INSERT INTO `ref_desa` VALUES (6251, 188, 'BABKAN APANJANG');
INSERT INTO `ref_desa` VALUES (6252, 188, 'BABKAN PANAJANG');
INSERT INTO `ref_desa` VALUES (6253, 188, 'BABKAN PANJANG');
INSERT INTO `ref_desa` VALUES (6254, 188, 'BAEAJKAMBANG');
INSERT INTO `ref_desa` VALUES (6255, 188, 'BAGARAK');
INSERT INTO `ref_desa` VALUES (6256, 188, 'BAGRAK');
INSERT INTO `ref_desa` VALUES (6257, 188, 'BAKLEKAMBANG');
INSERT INTO `ref_desa` VALUES (6258, 188, 'BAL;RKAMBANG');
INSERT INTO `ref_desa` VALUES (6259, 188, 'BALAAKAMBANG');
INSERT INTO `ref_desa` VALUES (6260, 188, 'BALAEKAMBANG');
INSERT INTO `ref_desa` VALUES (6261, 188, 'BALAI KAMBANG');
INSERT INTO `ref_desa` VALUES (6262, 188, 'BALAIKAMABANG');
INSERT INTO `ref_desa` VALUES (6263, 188, 'BALAIKAMBANG');
INSERT INTO `ref_desa` VALUES (6264, 188, 'BALE KAMBANG');
INSERT INTO `ref_desa` VALUES (6265, 188, 'BALE KEMBANG');
INSERT INTO `ref_desa` VALUES (6266, 188, 'BALEAJAMBANG');
INSERT INTO `ref_desa` VALUES (6267, 188, 'BALEAKAMBANG');
INSERT INTO `ref_desa` VALUES (6268, 188, 'BALEAKAMBNG');
INSERT INTO `ref_desa` VALUES (6269, 188, 'BALEIKAMBANG');
INSERT INTO `ref_desa` VALUES (6270, 188, 'BALEKAAMBANG');
INSERT INTO `ref_desa` VALUES (6271, 188, 'BALEKABANG');
INSERT INTO `ref_desa` VALUES (6272, 188, 'BALEKAMBAG');
INSERT INTO `ref_desa` VALUES (6273, 188, 'BALEKAMBBANG');
INSERT INTO `ref_desa` VALUES (6274, 188, 'BALEKAMBNAG');
INSERT INTO `ref_desa` VALUES (6275, 188, 'BALEKAMNBANG');
INSERT INTO `ref_desa` VALUES (6276, 188, 'BALEKEMBANG');
INSERT INTO `ref_desa` VALUES (6277, 188, 'BALEKMABNG');
INSERT INTO `ref_desa` VALUES (6278, 188, 'BALERKAMBANG');
INSERT INTO `ref_desa` VALUES (6279, 188, 'BALIK KAMBANG');
INSERT INTO `ref_desa` VALUES (6280, 188, 'BARAU RATA');
INSERT INTO `ref_desa` VALUES (6281, 188, 'BARU JAGONG');
INSERT INTO `ref_desa` VALUES (6282, 188, 'BBAKAN PA NJANG');
INSERT INTO `ref_desa` VALUES (6283, 188, 'BBAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (6284, 188, 'BBK.PANJANG');
INSERT INTO `ref_desa` VALUES (6285, 188, 'BBKN PANJANG');
INSERT INTO `ref_desa` VALUES (6286, 188, 'BELAKAMBANG');
INSERT INTO `ref_desa` VALUES (6287, 188, 'BELEKAMBANG');
INSERT INTO `ref_desa` VALUES (6288, 188, 'BJ KAUNG HILIR');
INSERT INTO `ref_desa` VALUES (6289, 188, 'BJ KAWUNG');
INSERT INTO `ref_desa` VALUES (6290, 188, 'BJ.KAWUNG');
INSERT INTO `ref_desa` VALUES (6291, 188, 'BJG KAWUNG');
INSERT INTO `ref_desa` VALUES (6292, 188, 'BLE KAMBANG');
INSERT INTO `ref_desa` VALUES (6293, 188, 'BLEKABANG');
INSERT INTO `ref_desa` VALUES (6294, 188, 'BLEKAMBANG');
INSERT INTO `ref_desa` VALUES (6295, 188, 'BLOK B.2 NO.17');
INSERT INTO `ref_desa` VALUES (6296, 188, 'BLOK M 04');
INSERT INTO `ref_desa` VALUES (6297, 188, 'BLOK Q 18 CIBADAK');
INSERT INTO `ref_desa` VALUES (6298, 188, 'BNAGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (6299, 188, 'BNAGRAK SLATAN');
INSERT INTO `ref_desa` VALUES (6300, 188, 'BNAGRAKUTARA');
INSERT INTO `ref_desa` VALUES (6301, 188, 'BOJONG');
INSERT INTO `ref_desa` VALUES (6302, 188, 'BOJONG GALING');
INSERT INTO `ref_desa` VALUES (6303, 188, 'BOJONG HONJE');
INSERT INTO `ref_desa` VALUES (6304, 188, 'BOJONG HONYE');
INSERT INTO `ref_desa` VALUES (6305, 188, 'BOJONG KAUM');
INSERT INTO `ref_desa` VALUES (6306, 188, 'BOJONG KAUNG');
INSERT INTO `ref_desa` VALUES (6307, 188, 'BOJONG KUNG');
INSERT INTO `ref_desa` VALUES (6308, 188, 'BOJONG LONGOK');
INSERT INTO `ref_desa` VALUES (6309, 188, 'BOJONG SARANG');
INSERT INTO `ref_desa` VALUES (6310, 188, 'BOJONG SARI');
INSERT INTO `ref_desa` VALUES (6311, 188, 'BOJONGHONJE');
INSERT INTO `ref_desa` VALUES (6312, 188, 'BOJONGJONJE');
INSERT INTO `ref_desa` VALUES (6313, 188, 'BOJONGKUNG');
INSERT INTO `ref_desa` VALUES (6314, 188, 'BTN TAMAN LESTARI');
INSERT INTO `ref_desa` VALUES (6315, 188, 'BUBGUR SARANG');
INSERT INTO `ref_desa` VALUES (6316, 188, 'BUNGUR');
INSERT INTO `ref_desa` VALUES (6317, 188, 'BUNGUR SARANG');
INSERT INTO `ref_desa` VALUES (6318, 188, 'BUNJUL');
INSERT INTO `ref_desa` VALUES (6319, 188, 'CAGAK');
INSERT INTO `ref_desa` VALUES (6320, 188, 'CAIHANJAWAR');
INSERT INTO `ref_desa` VALUES (6321, 188, 'CAIMBAR');
INSERT INTO `ref_desa` VALUES (6322, 188, 'CAMBAR');
INSERT INTO `ref_desa` VALUES (6323, 188, 'CANGKORE');
INSERT INTO `ref_desa` VALUES (6324, 188, 'CBADAS');
INSERT INTO `ref_desa` VALUES (6325, 188, 'CERENDEU');
INSERT INTO `ref_desa` VALUES (6326, 188, 'CFIHANYAWAR');
INSERT INTO `ref_desa` VALUES (6327, 188, 'CGINANJAR');
INSERT INTO `ref_desa` VALUES (6328, 188, 'CHANJAWAR');
INSERT INTO `ref_desa` VALUES (6329, 188, 'CHANYAWAR');
INSERT INTO `ref_desa` VALUES (6330, 188, 'CI AWI TALI');
INSERT INTO `ref_desa` VALUES (6331, 188, 'CI HANJAWAR');
INSERT INTO `ref_desa` VALUES (6332, 188, 'CIAHNJAWAR');
INSERT INTO `ref_desa` VALUES (6333, 188, 'CIAMABAR');
INSERT INTO `ref_desa` VALUES (6334, 188, 'CIAMBAR');
INSERT INTO `ref_desa` VALUES (6335, 188, 'CIANMABAR');
INSERT INTO `ref_desa` VALUES (6336, 188, 'CIARIPIN TENGAH');
INSERT INTO `ref_desa` VALUES (6337, 188, 'CIARUA');
INSERT INTO `ref_desa` VALUES (6338, 188, 'CIASARUA');
INSERT INTO `ref_desa` VALUES (6339, 188, 'CIASRUA');
INSERT INTO `ref_desa` VALUES (6340, 188, 'CIATALI');
INSERT INTO `ref_desa` VALUES (6341, 188, 'CIATER');
INSERT INTO `ref_desa` VALUES (6342, 188, 'CIAWI TALI');
INSERT INTO `ref_desa` VALUES (6343, 188, 'CIAWIAI');
INSERT INTO `ref_desa` VALUES (6344, 188, 'CIAWITALI');
INSERT INTO `ref_desa` VALUES (6345, 188, 'CIAWITTALI');
INSERT INTO `ref_desa` VALUES (6346, 188, 'CIBADAS');
INSERT INTO `ref_desa` VALUES (6347, 188, 'CIBAODAS');
INSERT INTO `ref_desa` VALUES (6348, 188, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (6349, 188, 'CIBUBUAY');
INSERT INTO `ref_desa` VALUES (6350, 188, 'CIBUGIS');
INSERT INTO `ref_desa` VALUES (6351, 188, 'CIBULUH BOGOR');
INSERT INTO `ref_desa` VALUES (6352, 188, 'CIBURIAL');
INSERT INTO `ref_desa` VALUES (6353, 188, 'CICANGKORE');
INSERT INTO `ref_desa` VALUES (6354, 188, 'CIDSARUA');
INSERT INTO `ref_desa` VALUES (6355, 188, 'CIGANAS');
INSERT INTO `ref_desa` VALUES (6356, 188, 'CIGANAS GIRANG');
INSERT INTO `ref_desa` VALUES (6357, 188, 'CIGANJAR');
INSERT INTO `ref_desa` VALUES (6358, 188, 'CIGAOK');
INSERT INTO `ref_desa` VALUES (6359, 188, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (6360, 188, 'CIHAJAWAR');
INSERT INTO `ref_desa` VALUES (6361, 188, 'CIHAMJAWAR');
INSERT INTO `ref_desa` VALUES (6362, 188, 'CIHANAJAWAR');
INSERT INTO `ref_desa` VALUES (6363, 188, 'CIHANAJWAR');
INSERT INTO `ref_desa` VALUES (6364, 188, 'CIHANAWAR');
INSERT INTO `ref_desa` VALUES (6365, 188, 'CIHANJAEAR');
INSERT INTO `ref_desa` VALUES (6366, 188, 'CIHANJAWA');
INSERT INTO `ref_desa` VALUES (6367, 188, 'CIHANJAWAN');
INSERT INTO `ref_desa` VALUES (6368, 188, 'CIHANJAWAR');
INSERT INTO `ref_desa` VALUES (6369, 188, 'CIHANJAWAT');
INSERT INTO `ref_desa` VALUES (6370, 188, 'CIHANJAWWAR');
INSERT INTO `ref_desa` VALUES (6371, 188, 'CIHANJWAR');
INSERT INTO `ref_desa` VALUES (6372, 188, 'CIHANNYAWAR');
INSERT INTO `ref_desa` VALUES (6373, 188, 'CIHANYAEWAR');
INSERT INTO `ref_desa` VALUES (6374, 188, 'CIHANYAMAR');
INSERT INTO `ref_desa` VALUES (6375, 188, 'CIHANYAWAR NAGR4AK');
INSERT INTO `ref_desa` VALUES (6376, 188, 'CIHANYAWAR]');
INSERT INTO `ref_desa` VALUES (6377, 188, 'CIHANYAWQAR');
INSERT INTO `ref_desa` VALUES (6378, 188, 'CIHANYAWR');
INSERT INTO `ref_desa` VALUES (6379, 188, 'CIHANYAWWAR');
INSERT INTO `ref_desa` VALUES (6380, 188, 'CIHANYSZAWAR');
INSERT INTO `ref_desa` VALUES (6381, 188, 'CIHAYAWAR');
INSERT INTO `ref_desa` VALUES (6382, 188, 'CIHAYWAR');
INSERT INTO `ref_desa` VALUES (6383, 188, 'CIHONJE');
INSERT INTO `ref_desa` VALUES (6384, 188, 'CIJAMBE');
INSERT INTO `ref_desa` VALUES (6385, 188, 'CIJELEGONG');
INSERT INTO `ref_desa` VALUES (6386, 188, 'CIJULANG');
INSERT INTO `ref_desa` VALUES (6387, 188, 'CIKANYERE');
INSERT INTO `ref_desa` VALUES (6388, 188, 'CIKARET');
INSERT INTO `ref_desa` VALUES (6389, 188, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (6390, 188, 'CIKAUNG');
INSERT INTO `ref_desa` VALUES (6391, 188, 'CIKAWUNG');
INSERT INTO `ref_desa` VALUES (6392, 188, 'CIKAWUNG HILIR');
INSERT INTO `ref_desa` VALUES (6393, 188, 'CIKOPAK');
INSERT INTO `ref_desa` VALUES (6394, 188, 'CIKUKULU');
INSERT INTO `ref_desa` VALUES (6395, 188, 'CIMABAR');
INSERT INTO `ref_desa` VALUES (6396, 188, 'CIMABRA');
INSERT INTO `ref_desa` VALUES (6397, 188, 'CIMADE');
INSERT INTO `ref_desa` VALUES (6398, 188, 'CIMANDAE');
INSERT INTO `ref_desa` VALUES (6399, 188, 'CIMANDE');
INSERT INTO `ref_desa` VALUES (6400, 188, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (6401, 188, 'CIMBAR');
INSERT INTO `ref_desa` VALUES (6402, 188, 'CINABAR');
INSERT INTO `ref_desa` VALUES (6403, 188, 'CINAGARAK');
INSERT INTO `ref_desa` VALUES (6404, 188, 'CINUMPANG');
INSERT INTO `ref_desa` VALUES (6405, 188, 'CINUNMPANG');
INSERT INTO `ref_desa` VALUES (6406, 188, 'CIOBODAS');
INSERT INTO `ref_desa` VALUES (6407, 188, 'CIOSARUA');
INSERT INTO `ref_desa` VALUES (6408, 188, 'CIPAARANJE');
INSERT INTO `ref_desa` VALUES (6409, 188, 'CIPAMUTIH');
INSERT INTO `ref_desa` VALUES (6410, 188, 'CIPARANJE');
INSERT INTO `ref_desa` VALUES (6411, 188, 'CIPARI');
INSERT INTO `ref_desa` VALUES (6412, 188, 'CIPAYUNG');
INSERT INTO `ref_desa` VALUES (6413, 188, 'CIPETIR');
INSERT INTO `ref_desa` VALUES (6414, 188, 'CIRANGKONG');
INSERT INTO `ref_desa` VALUES (6415, 188, 'CIRENDEU');
INSERT INTO `ref_desa` VALUES (6416, 188, 'CIREUNDEPENTAS');
INSERT INTO `ref_desa` VALUES (6417, 188, 'CIREUNDEU');
INSERT INTO `ref_desa` VALUES (6418, 188, 'CIROHANI');
INSERT INTO `ref_desa` VALUES (6419, 188, 'CISAAADARIA');
INSERT INTO `ref_desa` VALUES (6420, 188, 'CISAAT');
INSERT INTO `ref_desa` VALUES (6421, 188, 'CISADARIA');
INSERT INTO `ref_desa` VALUES (6422, 188, 'CISANA');
INSERT INTO `ref_desa` VALUES (6423, 188, 'CISANDARIA');
INSERT INTO `ref_desa` VALUES (6424, 188, 'CISANGKOEG');
INSERT INTO `ref_desa` VALUES (6425, 188, 'CISARAU');
INSERT INTO `ref_desa` VALUES (6426, 188, 'CISARAUA');
INSERT INTO `ref_desa` VALUES (6427, 188, 'CISAREA');
INSERT INTO `ref_desa` VALUES (6428, 188, 'CISARIA');
INSERT INTO `ref_desa` VALUES (6429, 188, 'CISARRUA');
INSERT INTO `ref_desa` VALUES (6430, 188, 'CISARU');
INSERT INTO `ref_desa` VALUES (6431, 188, 'CISARU A');
INSERT INTO `ref_desa` VALUES (6432, 188, 'CISARUA B 5 NO 1');
INSERT INTO `ref_desa` VALUES (6433, 188, 'CISARUA B05 NO 1');
INSERT INTO `ref_desa` VALUES (6434, 188, 'CISARUA NAGARAK');
INSERT INTO `ref_desa` VALUES (6435, 188, 'CISARUA NGARAK');
INSERT INTO `ref_desa` VALUES (6436, 188, 'CISARUAQ');
INSERT INTO `ref_desa` VALUES (6437, 188, 'CISATUA');
INSERT INTO `ref_desa` VALUES (6438, 188, 'CISAUA');
INSERT INTO `ref_desa` VALUES (6439, 188, 'CISAURA');
INSERT INTO `ref_desa` VALUES (6440, 188, 'CISAURUA');
INSERT INTO `ref_desa` VALUES (6441, 188, 'CISEAPAN');
INSERT INTO `ref_desa` VALUES (6442, 188, 'CISRUA');
INSERT INTO `ref_desa` VALUES (6443, 188, 'CISSARUA');
INSERT INTO `ref_desa` VALUES (6444, 188, 'CISSAWRUA');
INSERT INTO `ref_desa` VALUES (6445, 188, 'CIUTARA');
INSERT INTO `ref_desa` VALUES (6446, 188, 'CIWARUNG');
INSERT INTO `ref_desa` VALUES (6447, 188, 'CNAGRAK');
INSERT INTO `ref_desa` VALUES (6448, 188, 'CUIJULANG');
INSERT INTO `ref_desa` VALUES (6449, 188, 'CUISARUA');
INSERT INTO `ref_desa` VALUES (6450, 188, 'CUJULANG');
INSERT INTO `ref_desa` VALUES (6451, 188, 'CUSARUA');
INSERT INTO `ref_desa` VALUES (6452, 188, 'CVIAMBAR');
INSERT INTO `ref_desa` VALUES (6453, 188, 'DAMAREJA');
INSERT INTO `ref_desa` VALUES (6454, 188, 'DAMARJA');
INSERT INTO `ref_desa` VALUES (6455, 188, 'DARAMAGA');
INSERT INTO `ref_desa` VALUES (6456, 188, 'DARMA REJA');
INSERT INTO `ref_desa` VALUES (6457, 188, 'DARMA REUJA');
INSERT INTO `ref_desa` VALUES (6458, 188, 'DARMAGA');
INSERT INTO `ref_desa` VALUES (6459, 188, 'DARMAGA NGARAK');
INSERT INTO `ref_desa` VALUES (6460, 188, 'DARMAJA');
INSERT INTO `ref_desa` VALUES (6461, 188, 'DARMARAJA');
INSERT INTO `ref_desa` VALUES (6462, 188, 'DARMAREZA');
INSERT INTO `ref_desa` VALUES (6463, 188, 'DARMARJA');
INSERT INTO `ref_desa` VALUES (6464, 188, 'DARNAREJA');
INSERT INTO `ref_desa` VALUES (6465, 188, 'DEGONG');
INSERT INTO `ref_desa` VALUES (6466, 188, 'DEPOK');
INSERT INTO `ref_desa` VALUES (6467, 188, 'DERMAGA');
INSERT INTO `ref_desa` VALUES (6468, 188, 'DERMAJA');
INSERT INTO `ref_desa` VALUES (6469, 188, 'DERMAREJA');
INSERT INTO `ref_desa` VALUES (6470, 188, 'DGIRIJAYA');
INSERT INTO `ref_desa` VALUES (6471, 188, 'DRMARJA');
INSERT INTO `ref_desa` VALUES (6472, 188, 'DS.CISARUA');
INSERT INTO `ref_desa` VALUES (6473, 188, 'DS.GINANJAR');
INSERT INTO `ref_desa` VALUES (6474, 188, 'EARUNG KAWUNG');
INSERT INTO `ref_desa` VALUES (6475, 188, 'EWANGUN');
INSERT INTO `ref_desa` VALUES (6476, 188, 'GIIRIJAYA');
INSERT INTO `ref_desa` VALUES (6477, 188, 'GINAAJAR');
INSERT INTO `ref_desa` VALUES (6478, 188, 'GINAJAR');
INSERT INTO `ref_desa` VALUES (6479, 188, 'GINANAJAR');
INSERT INTO `ref_desa` VALUES (6480, 188, 'GINANAR');
INSERT INTO `ref_desa` VALUES (6481, 188, 'GINANJAR');
INSERT INTO `ref_desa` VALUES (6482, 188, 'GINNJAR');
INSERT INTO `ref_desa` VALUES (6483, 188, 'GINQNJAR');
INSERT INTO `ref_desa` VALUES (6484, 188, 'GIRI');
INSERT INTO `ref_desa` VALUES (6485, 188, 'GIRI  JAYA');
INSERT INTO `ref_desa` VALUES (6486, 188, 'GIRI JAYA');
INSERT INTO `ref_desa` VALUES (6487, 188, 'GIRI JYA');
INSERT INTO `ref_desa` VALUES (6488, 188, 'GIRIJYA');
INSERT INTO `ref_desa` VALUES (6489, 188, 'GOBANG');
INSERT INTO `ref_desa` VALUES (6490, 188, 'GOILING JAYA');
INSERT INTO `ref_desa` VALUES (6491, 188, 'GRIJAYA');
INSERT INTO `ref_desa` VALUES (6492, 188, 'GUDANG');
INSERT INTO `ref_desa` VALUES (6493, 188, 'GUIRI JAYA');
INSERT INTO `ref_desa` VALUES (6494, 188, 'GULING JAWA');
INSERT INTO `ref_desa` VALUES (6495, 188, 'GUNUNG JAYA');
INSERT INTO `ref_desa` VALUES (6496, 188, 'HEGAAMANAH');
INSERT INTO `ref_desa` VALUES (6497, 188, 'HEGARMANAH');
INSERT INTO `ref_desa` VALUES (6498, 188, 'ISARUA');
INSERT INTO `ref_desa` VALUES (6499, 188, 'JAELEGONG');
INSERT INTO `ref_desa` VALUES (6500, 188, 'JAYA AMBAR');
INSERT INTO `ref_desa` VALUES (6501, 188, 'JELEGONG');
INSERT INTO `ref_desa` VALUES (6502, 188, 'JELEKONG');
INSERT INTO `ref_desa` VALUES (6503, 188, 'JENJING');
INSERT INTO `ref_desa` VALUES (6504, 188, 'KALAP REA');
INSERT INTO `ref_desa` VALUES (6505, 188, 'KALAPA');
INSERT INTO `ref_desa` VALUES (6506, 188, 'KALAPA  REA');
INSERT INTO `ref_desa` VALUES (6507, 188, 'KALAPA RAA');
INSERT INTO `ref_desa` VALUES (6508, 188, 'KALAPA RAE');
INSERT INTO `ref_desa` VALUES (6509, 188, 'KALAPA REA');
INSERT INTO `ref_desa` VALUES (6510, 188, 'KALAPACARANG');
INSERT INTO `ref_desa` VALUES (6511, 188, 'KALAPAREA .');
INSERT INTO `ref_desa` VALUES (6512, 188, 'KALAPREA');
INSERT INTO `ref_desa` VALUES (6513, 188, 'KALPA REA');
INSERT INTO `ref_desa` VALUES (6514, 188, 'KALPAREA');
INSERT INTO `ref_desa` VALUES (6515, 188, 'KAPLAPAREA');
INSERT INTO `ref_desa` VALUES (6516, 188, 'KARANG TEANGAH');
INSERT INTO `ref_desa` VALUES (6517, 188, 'KARANG TENAGAH');
INSERT INTO `ref_desa` VALUES (6518, 188, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (6519, 188, 'KARANG TENGAH .');
INSERT INTO `ref_desa` VALUES (6520, 188, 'KARANGTENGAH');
INSERT INTO `ref_desa` VALUES (6521, 188, 'KAUM');
INSERT INTO `ref_desa` VALUES (6522, 188, 'KEBON KAI');
INSERT INTO `ref_desa` VALUES (6523, 188, 'KELAPA REA');
INSERT INTO `ref_desa` VALUES (6524, 188, 'KELAPAREA');
INSERT INTO `ref_desa` VALUES (6525, 188, 'KEMANG');
INSERT INTO `ref_desa` VALUES (6526, 188, 'KEMBANG KUNING');
INSERT INTO `ref_desa` VALUES (6527, 188, 'KL APA REA');
INSERT INTO `ref_desa` VALUES (6528, 188, 'KL REA');
INSERT INTO `ref_desa` VALUES (6529, 188, 'KL. REA');
INSERT INTO `ref_desa` VALUES (6530, 188, 'KLAPA');
INSERT INTO `ref_desa` VALUES (6531, 188, 'KLAPAREA');
INSERT INTO `ref_desa` VALUES (6532, 188, 'KLP REA');
INSERT INTO `ref_desa` VALUES (6533, 188, 'KLP. REA');
INSERT INTO `ref_desa` VALUES (6534, 188, 'KLP.REA');
INSERT INTO `ref_desa` VALUES (6535, 188, 'KP BALEKAMBANG');
INSERT INTO `ref_desa` VALUES (6536, 188, 'KP GUDANG');
INSERT INTO `ref_desa` VALUES (6537, 188, 'KUBANG');
INSERT INTO `ref_desa` VALUES (6538, 188, 'KUBANG HERANG');
INSERT INTO `ref_desa` VALUES (6539, 188, 'KUTA JAYA');
INSERT INTO `ref_desa` VALUES (6540, 188, 'KUTARA');
INSERT INTO `ref_desa` VALUES (6541, 188, 'LEGOK YENANG');
INSERT INTO `ref_desa` VALUES (6542, 188, 'LEKAMBANG');
INSERT INTO `ref_desa` VALUES (6543, 188, 'LEMAH PUTIH');
INSERT INTO `ref_desa` VALUES (6544, 188, 'LEUWI KERIS');
INSERT INTO `ref_desa` VALUES (6545, 188, 'LEUWI NAGGUNG');
INSERT INTO `ref_desa` VALUES (6546, 188, 'LEWUI OROK');
INSERT INTO `ref_desa` VALUES (6547, 188, 'LKALAPAREA');
INSERT INTO `ref_desa` VALUES (6548, 188, 'LNGRAK');
INSERT INTO `ref_desa` VALUES (6549, 188, 'MAANGUNJYA');
INSERT INTO `ref_desa` VALUES (6550, 188, 'MAGRAK');
INSERT INTO `ref_desa` VALUES (6551, 188, 'MALASARI');
INSERT INTO `ref_desa` VALUES (6552, 188, 'MANGGIS');
INSERT INTO `ref_desa` VALUES (6553, 188, 'MANGUN JAYA');
INSERT INTO `ref_desa` VALUES (6554, 188, 'MANGUNJAYA');
INSERT INTO `ref_desa` VALUES (6555, 188, 'MANUNJUL');
INSERT INTO `ref_desa` VALUES (6556, 188, 'MAYA');
INSERT INTO `ref_desa` VALUES (6557, 188, 'MEKARJAYA');
INSERT INTO `ref_desa` VALUES (6558, 188, 'MINJUL');
INSERT INTO `ref_desa` VALUES (6559, 188, 'MNAGRAK');
INSERT INTO `ref_desa` VALUES (6560, 188, 'MNJUL');
INSERT INTO `ref_desa` VALUES (6561, 188, 'MUARA DUA');
INSERT INTO `ref_desa` VALUES (6562, 188, 'MUINJUL');
INSERT INTO `ref_desa` VALUES (6563, 188, 'MUJUL');
INSERT INTO `ref_desa` VALUES (6564, 188, 'MUNJAL');
INSERT INTO `ref_desa` VALUES (6565, 188, 'MUNJUL');
INSERT INTO `ref_desa` VALUES (6566, 188, 'MWANGUN JAYA');
INSERT INTO `ref_desa` VALUES (6567, 188, 'NABGERANG');
INSERT INTO `ref_desa` VALUES (6568, 188, 'NACISARUA');
INSERT INTO `ref_desa` VALUES (6569, 188, 'NADGRAK');
INSERT INTO `ref_desa` VALUES (6570, 188, 'NAGAAK');
INSERT INTO `ref_desa` VALUES (6571, 188, 'NAGAK');
INSERT INTO `ref_desa` VALUES (6572, 188, 'NAGARAK');
INSERT INTO `ref_desa` VALUES (6573, 188, 'NAGARAK  UTARA');
INSERT INTO `ref_desa` VALUES (6574, 188, 'NAGARAK SELATAN');
INSERT INTO `ref_desa` VALUES (6575, 188, 'NAGARAK UTARA');
INSERT INTO `ref_desa` VALUES (6576, 188, 'NAGARK');
INSERT INTO `ref_desa` VALUES (6577, 188, 'NAGARK UTARA');
INSERT INTO `ref_desa` VALUES (6578, 188, 'NAGARKA');
INSERT INTO `ref_desa` VALUES (6579, 188, 'NAGGARAK SLATAN');
INSERT INTO `ref_desa` VALUES (6580, 188, 'NAGGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (6581, 188, 'NAGGRAK UTARA');
INSERT INTO `ref_desa` VALUES (6582, 188, 'NAGGRAKCISAA');
INSERT INTO `ref_desa` VALUES (6583, 188, 'NAGHRAK UTARA');
INSERT INTO `ref_desa` VALUES (6584, 188, 'NAGKA KONENG');
INSERT INTO `ref_desa` VALUES (6585, 188, 'NAGKAT SELATAN');
INSERT INTO `ref_desa` VALUES (6586, 188, 'NAGRA');
INSERT INTO `ref_desa` VALUES (6587, 188, 'NAGRA SELATAN');
INSERT INTO `ref_desa` VALUES (6588, 188, 'NAGRA UTARA');
INSERT INTO `ref_desa` VALUES (6589, 188, 'NAGRAJK');
INSERT INTO `ref_desa` VALUES (6590, 188, 'NAGRAJK UTARA');
INSERT INTO `ref_desa` VALUES (6591, 188, 'NAGRAK');
INSERT INTO `ref_desa` VALUES (6592, 188, 'NAGRAK  SELATAN');
INSERT INTO `ref_desa` VALUES (6593, 188, 'NAGRAK  UTARA');
INSERT INTO `ref_desa` VALUES (6594, 188, 'NAGRAK BATAS');
INSERT INTO `ref_desa` VALUES (6595, 188, 'NAGRAK CIBADAK');
INSERT INTO `ref_desa` VALUES (6596, 188, 'NAGRAK CSARUA');
INSERT INTO `ref_desa` VALUES (6597, 188, 'NAGRAK JUTARA');
INSERT INTO `ref_desa` VALUES (6598, 188, 'NAGRAK KALER');
INSERT INTO `ref_desa` VALUES (6599, 188, 'NAGRAK KAUM');
INSERT INTO `ref_desa` VALUES (6600, 188, 'NAGRAK MNAGRAK');
INSERT INTO `ref_desa` VALUES (6601, 188, 'NAGRAK SAKATAN');
INSERT INTO `ref_desa` VALUES (6602, 188, 'NAGRAK SARI');
INSERT INTO `ref_desa` VALUES (6603, 188, 'NAGRAK SEKATAN');
INSERT INTO `ref_desa` VALUES (6604, 188, 'NAGRAK SELA');
INSERT INTO `ref_desa` VALUES (6605, 188, 'NAGRAK SELAATN');
INSERT INTO `ref_desa` VALUES (6606, 188, 'NAGRAK SELATA');
INSERT INTO `ref_desa` VALUES (6607, 188, 'NAGRAK SELATAN UTARA');
INSERT INTO `ref_desa` VALUES (6608, 188, 'NAGRAK SELATANNAGRAK');
INSERT INTO `ref_desa` VALUES (6609, 188, 'NAGRAK SELATN');
INSERT INTO `ref_desa` VALUES (6610, 188, 'NAGRAK SELTAN');
INSERT INTO `ref_desa` VALUES (6611, 188, 'NAGRAK SSELATAN');
INSERT INTO `ref_desa` VALUES (6612, 188, 'NAGRAK TARA');
INSERT INTO `ref_desa` VALUES (6613, 188, 'NAGRAK TENGAH');
INSERT INTO `ref_desa` VALUES (6614, 188, 'NAGRAK TUTARA');
INSERT INTO `ref_desa` VALUES (6615, 188, 'NAGRAK UATARA');
INSERT INTO `ref_desa` VALUES (6616, 188, 'NAGRAK URATA');
INSERT INTO `ref_desa` VALUES (6617, 188, 'NAGRAK UTAR');
INSERT INTO `ref_desa` VALUES (6618, 188, 'NAGRAK UTARA]');
INSERT INTO `ref_desa` VALUES (6619, 188, 'NAGRAK UTRA');
INSERT INTO `ref_desa` VALUES (6620, 188, 'NAGRAK?');
INSERT INTO `ref_desa` VALUES (6621, 188, 'NAGRAKA SELATAN');
INSERT INTO `ref_desa` VALUES (6622, 188, 'NAGRAKARA');
INSERT INTO `ref_desa` VALUES (6623, 188, 'NAGRAKJ');
INSERT INTO `ref_desa` VALUES (6624, 188, 'NAGRAKK');
INSERT INTO `ref_desa` VALUES (6625, 188, 'NAGRAKL');
INSERT INTO `ref_desa` VALUES (6626, 188, 'NAGRAKNAGRAK');
INSERT INTO `ref_desa` VALUES (6627, 188, 'NAGRAKS ELATAN');
INSERT INTO `ref_desa` VALUES (6628, 188, 'NAGRAKSELATAN');
INSERT INTO `ref_desa` VALUES (6629, 188, 'NAGRAKSELAYTAN');
INSERT INTO `ref_desa` VALUES (6630, 188, 'NAGRAKUATYARA');
INSERT INTO `ref_desa` VALUES (6631, 188, 'NAGRAKUTARA');
INSERT INTO `ref_desa` VALUES (6632, 188, 'NAGRAKUTRA');
INSERT INTO `ref_desa` VALUES (6633, 188, 'NAGRAK]');
INSERT INTO `ref_desa` VALUES (6634, 188, 'NAGRAL SELATAN');
INSERT INTO `ref_desa` VALUES (6635, 188, 'NAGRASK');
INSERT INTO `ref_desa` VALUES (6636, 188, 'NAGRK');
INSERT INTO `ref_desa` VALUES (6637, 188, 'NAGRK SELATAN');
INSERT INTO `ref_desa` VALUES (6638, 188, 'NAGRK UTARA');
INSERT INTO `ref_desa` VALUES (6639, 188, 'NAGROG');
INSERT INTO `ref_desa` VALUES (6640, 188, 'NAGRTAK SELATAN');
INSERT INTO `ref_desa` VALUES (6641, 188, 'NAGTRAK');
INSERT INTO `ref_desa` VALUES (6642, 188, 'NAGTRAK UTARA');
INSERT INTO `ref_desa` VALUES (6643, 188, 'NAHGRAK');
INSERT INTO `ref_desa` VALUES (6644, 188, 'NAKRAG');
INSERT INTO `ref_desa` VALUES (6645, 188, 'NANGRAK');
INSERT INTO `ref_desa` VALUES (6646, 188, 'NANGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (6647, 188, 'NANGRAK UTARA');
INSERT INTO `ref_desa` VALUES (6648, 188, 'NANGRAKUTARA');
INSERT INTO `ref_desa` VALUES (6649, 188, 'NARAK');
INSERT INTO `ref_desa` VALUES (6650, 188, 'NARAK SELATAN');
INSERT INTO `ref_desa` VALUES (6651, 188, 'NASGRAK');
INSERT INTO `ref_desa` VALUES (6652, 188, 'NAYLINDUNG');
INSERT INTO `ref_desa` VALUES (6653, 188, 'NCISARUA');
INSERT INTO `ref_desa` VALUES (6654, 188, 'NEGLASARI');
INSERT INTO `ref_desa` VALUES (6655, 188, 'NGARAK');
INSERT INTO `ref_desa` VALUES (6656, 188, 'NGARAK SELATAN');
INSERT INTO `ref_desa` VALUES (6657, 188, 'NGARAK UTARA');
INSERT INTO `ref_desa` VALUES (6658, 188, 'NGRAK');
INSERT INTO `ref_desa` VALUES (6659, 188, 'NGRAK UTARA');
INSERT INTO `ref_desa` VALUES (6660, 188, 'NGRAK UTRA');
INSERT INTO `ref_desa` VALUES (6661, 188, 'NGRAKUTARA');
INSERT INTO `ref_desa` VALUES (6662, 188, 'NGWEWER');
INSERT INTO `ref_desa` VALUES (6663, 188, 'NMUNJUL');
INSERT INTO `ref_desa` VALUES (6664, 188, 'NNAGRAK');
INSERT INTO `ref_desa` VALUES (6665, 188, 'NNAGRAK SELATAN');
INSERT INTO `ref_desa` VALUES (6666, 188, 'NSGRAK');
INSERT INTO `ref_desa` VALUES (6667, 188, 'NYALINDUNG');
INSERT INTO `ref_desa` VALUES (6668, 188, 'NYAMPLUNG');
INSERT INTO `ref_desa` VALUES (6669, 188, 'NYANGEGENG');
INSERT INTO `ref_desa` VALUES (6670, 188, 'NYANGKOEK');
INSERT INTO `ref_desa` VALUES (6671, 188, 'NYELEPET');
INSERT INTO `ref_desa` VALUES (6672, 188, 'NYENAG');
INSERT INTO `ref_desa` VALUES (6673, 188, 'NYENANG');
INSERT INTO `ref_desa` VALUES (6674, 188, 'OAWWENANG');
INSERT INTO `ref_desa` VALUES (6675, 188, 'PADANGENYANG');
INSERT INTO `ref_desa` VALUES (6676, 188, 'PADASUKA');
INSERT INTO `ref_desa` VALUES (6677, 188, 'PALASARI');
INSERT INTO `ref_desa` VALUES (6678, 188, 'PALEDANG');
INSERT INTO `ref_desa` VALUES (6679, 188, 'PAMURUYAN');
INSERT INTO `ref_desa` VALUES (6680, 188, 'PANAGAN');
INSERT INTO `ref_desa` VALUES (6681, 188, 'PANGKALAN');
INSERT INTO `ref_desa` VALUES (6682, 188, 'PANGKALAN NANGARAK');
INSERT INTO `ref_desa` VALUES (6683, 188, 'PANGKLANNAGRAK');
INSERT INTO `ref_desa` VALUES (6684, 188, 'PANYINANGAN');
INSERT INTO `ref_desa` VALUES (6685, 188, 'PANYINDANGAN');
INSERT INTO `ref_desa` VALUES (6686, 188, 'PARAGAHJEN');
INSERT INTO `ref_desa` VALUES (6687, 188, 'PARAGAJEN');
INSERT INTO `ref_desa` VALUES (6688, 188, 'PARIGI');
INSERT INTO `ref_desa` VALUES (6689, 188, 'PARUNGKUDA');
INSERT INTO `ref_desa` VALUES (6690, 188, 'PASIR ANGIN');
INSERT INTO `ref_desa` VALUES (6691, 188, 'PASIR BENTIK');
INSERT INTO `ref_desa` VALUES (6692, 188, 'PASIR BEUNTIK');
INSERT INTO `ref_desa` VALUES (6693, 188, 'PASIR BUNTUNG');
INSERT INTO `ref_desa` VALUES (6694, 188, 'PASIR ERIH');
INSERT INTO `ref_desa` VALUES (6695, 188, 'PASIR HUNI');
INSERT INTO `ref_desa` VALUES (6696, 188, 'PASIR JENJI');
INSERT INTO `ref_desa` VALUES (6697, 188, 'PASIR JINGJING');
INSERT INTO `ref_desa` VALUES (6698, 188, 'PASIR JINJING');
INSERT INTO `ref_desa` VALUES (6699, 188, 'PASIR MUNCANG');
INSERT INTO `ref_desa` VALUES (6700, 188, 'PASIR UTARA');
INSERT INTO `ref_desa` VALUES (6701, 188, 'PASIRBENTIK');
INSERT INTO `ref_desa` VALUES (6702, 188, 'PASIRBRNTIK');
INSERT INTO `ref_desa` VALUES (6703, 188, 'PASIRJEANGJING');
INSERT INTO `ref_desa` VALUES (6704, 188, 'PASSIR HUMI');
INSERT INTO `ref_desa` VALUES (6705, 188, 'PAWAEANG');
INSERT INTO `ref_desa` VALUES (6706, 188, 'PAWANANG');
INSERT INTO `ref_desa` VALUES (6707, 188, 'PAWEANAG');
INSERT INTO `ref_desa` VALUES (6708, 188, 'PAWEANANG');
INSERT INTO `ref_desa` VALUES (6709, 188, 'PAWEANG');
INSERT INTO `ref_desa` VALUES (6710, 188, 'PAWEEANANG');
INSERT INTO `ref_desa` VALUES (6711, 188, 'PAWENAG');
INSERT INTO `ref_desa` VALUES (6712, 188, 'PAWENANGAN');
INSERT INTO `ref_desa` VALUES (6713, 188, 'PAWENG');
INSERT INTO `ref_desa` VALUES (6714, 188, 'PAWENNAG');
INSERT INTO `ref_desa` VALUES (6715, 188, 'PAWEUNANG');
INSERT INTO `ref_desa` VALUES (6716, 188, 'PAWEWNANG');
INSERT INTO `ref_desa` VALUES (6717, 188, 'PAWWEANAG');
INSERT INTO `ref_desa` VALUES (6718, 188, 'PEANG');
INSERT INTO `ref_desa` VALUES (6719, 188, 'PONDOK TISUK');
INSERT INTO `ref_desa` VALUES (6720, 188, 'PS ANGIN');
INSERT INTO `ref_desa` VALUES (6721, 188, 'PS BENTIK');
INSERT INTO `ref_desa` VALUES (6722, 188, 'PSR. JINJING');
INSERT INTO `ref_desa` VALUES (6723, 188, 'PT MANGGIS');
INSERT INTO `ref_desa` VALUES (6724, 188, 'PT PAPARTI');
INSERT INTO `ref_desa` VALUES (6725, 188, 'PWENAMG');
INSERT INTO `ref_desa` VALUES (6726, 188, 'SADARMARJA');
INSERT INTO `ref_desa` VALUES (6727, 188, 'SALAJAMBE');
INSERT INTO `ref_desa` VALUES (6728, 188, 'SAMPALAN');
INSERT INTO `ref_desa` VALUES (6729, 188, 'SEKARSARI');
INSERT INTO `ref_desa` VALUES (6730, 188, 'SEKARWANGI');
INSERT INTO `ref_desa` VALUES (6731, 188, 'SELAAWI');
INSERT INTO `ref_desa` VALUES (6732, 188, 'SIMPENAN');
INSERT INTO `ref_desa` VALUES (6733, 188, 'SINAGAR');
INSERT INTO `ref_desa` VALUES (6734, 188, 'SINAGAR KOLOT');
INSERT INTO `ref_desa` VALUES (6735, 188, 'SINAGRA KOLOT');
INSERT INTO `ref_desa` VALUES (6736, 188, 'SINAGRAR');
INSERT INTO `ref_desa` VALUES (6737, 188, 'SINEGAR');
INSERT INTO `ref_desa` VALUES (6738, 188, 'SIRNA GALIH');
INSERT INTO `ref_desa` VALUES (6739, 188, 'SNAGAR');
INSERT INTO `ref_desa` VALUES (6740, 188, 'SOMANG');
INSERT INTO `ref_desa` VALUES (6741, 188, 'SSELAAWI');
INSERT INTO `ref_desa` VALUES (6742, 188, 'SUKADAMAI');
INSERT INTO `ref_desa` VALUES (6743, 188, 'SUKAMANAH');
INSERT INTO `ref_desa` VALUES (6744, 188, 'SUKAMULYA');
INSERT INTO `ref_desa` VALUES (6745, 188, 'SUNDAWENAG');
INSERT INTO `ref_desa` VALUES (6746, 188, 'SUNDAWENANG');
INSERT INTO `ref_desa` VALUES (6747, 188, 'SUNDAWENANG NAGRAK KAB.S');
INSERT INTO `ref_desa` VALUES (6748, 188, 'TALAGA');
INSERT INTO `ref_desa` VALUES (6749, 188, 'TALAGA HILIR');
INSERT INTO `ref_desa` VALUES (6750, 188, 'TALAGA MURNI');
INSERT INTO `ref_desa` VALUES (6751, 188, 'TALUN');
INSERT INTO `ref_desa` VALUES (6752, 188, 'TAMAN');
INSERT INTO `ref_desa` VALUES (6753, 188, 'TAMAN LESTAI');
INSERT INTO `ref_desa` VALUES (6754, 188, 'TAMAN LESTAREI');
INSERT INTO `ref_desa` VALUES (6755, 188, 'TAMAN LESTARI');
INSERT INTO `ref_desa` VALUES (6756, 188, 'TAMAN SARI');
INSERT INTO `ref_desa` VALUES (6757, 188, 'TEGAL LEGA');
INSERT INTO `ref_desa` VALUES (6758, 188, 'TEGALEGA');
INSERT INTO `ref_desa` VALUES (6759, 188, 'TUGU JAYA');
INSERT INTO `ref_desa` VALUES (6760, 188, 'UJUNG GALIH');
INSERT INTO `ref_desa` VALUES (6761, 188, 'WAARANA MUKTI');
INSERT INTO `ref_desa` VALUES (6762, 188, 'WABNGUN NAGTRAK');
INSERT INTO `ref_desa` VALUES (6763, 188, 'WANGGGUN JAYA');
INSERT INTO `ref_desa` VALUES (6764, 188, 'WANGGUN JAYA');
INSERT INTO `ref_desa` VALUES (6765, 188, 'WANGU AYA AGRAK');
INSERT INTO `ref_desa` VALUES (6766, 188, 'WANGU JAY');
INSERT INTO `ref_desa` VALUES (6767, 188, 'WANGUJAYA');
INSERT INTO `ref_desa` VALUES (6768, 188, 'WANGUN');
INSERT INTO `ref_desa` VALUES (6769, 188, 'WANGUN JAYA');
INSERT INTO `ref_desa` VALUES (6770, 188, 'WANGUNJAYA');
INSERT INTO `ref_desa` VALUES (6771, 188, 'WANGUNKAYA');
INSERT INTO `ref_desa` VALUES (6772, 188, 'WARNA JATI');
INSERT INTO `ref_desa` VALUES (6773, 188, 'WARNA MUKTI');
INSERT INTO `ref_desa` VALUES (6774, 188, 'WARNAKUKTI');
INSERT INTO `ref_desa` VALUES (6775, 188, 'WARNAMUKTI');
INSERT INTO `ref_desa` VALUES (6776, 188, 'WARUGKAUNG');
INSERT INTO `ref_desa` VALUES (6777, 188, 'WARUNG KAUNG');
INSERT INTO `ref_desa` VALUES (6778, 188, 'WARUNG KAWUNG');
INSERT INTO `ref_desa` VALUES (6779, 188, 'WARUNG KIARA');
INSERT INTO `ref_desa` VALUES (6780, 188, 'WARUNGGOMBONG');
INSERT INTO `ref_desa` VALUES (6781, 188, 'WARUNGKAUNG');
INSERT INTO `ref_desa` VALUES (6782, 188, 'WARUNGKAWUNG');
INSERT INTO `ref_desa` VALUES (6783, 146, 'MALASARI');
INSERT INTO `ref_desa` VALUES (6784, 146, 'MALASARI 3');
INSERT INTO `ref_desa` VALUES (6785, 146, 'NANGGUNG');
INSERT INTO `ref_desa` VALUES (6786, 146, 'NIRAAGUNG');
INSERT INTO `ref_desa` VALUES (6787, 146, 'PALASARI');
INSERT INTO `ref_desa` VALUES (6788, 146, 'PARAKAN MUNCANG');
INSERT INTO `ref_desa` VALUES (6789, 566, 'NARINGGUL');
INSERT INTO `ref_desa` VALUES (6790, 675, 'BAROS');
INSERT INTO `ref_desa` VALUES (6791, 675, 'BJ SARI');
INSERT INTO `ref_desa` VALUES (6792, 675, 'BOJONG GENTENG');
INSERT INTO `ref_desa` VALUES (6793, 675, 'BOJONG KALONG');
INSERT INTO `ref_desa` VALUES (6794, 675, 'BOJONG SARI');
INSERT INTO `ref_desa` VALUES (6795, 675, 'BOJONGSRI');
INSERT INTO `ref_desa` VALUES (6796, 675, 'CIANSANA');
INSERT INTO `ref_desa` VALUES (6797, 675, 'CIBALOBAK');
INSERT INTO `ref_desa` VALUES (6798, 675, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (6799, 675, 'CICSITU');
INSERT INTO `ref_desa` VALUES (6800, 675, 'CICURUG');
INSERT INTO `ref_desa` VALUES (6801, 675, 'CIGADOG');
INSERT INTO `ref_desa` VALUES (6802, 675, 'CIGATI');
INSERT INTO `ref_desa` VALUES (6803, 675, 'CIHERANG');
INSERT INTO `ref_desa` VALUES (6804, 675, 'CIJAMNGKAR');
INSERT INTO `ref_desa` VALUES (6805, 675, 'DS.MEKARSARI');
INSERT INTO `ref_desa` VALUES (6806, 675, 'GANAS SOLI');
INSERT INTO `ref_desa` VALUES (6807, 675, 'JYALDUHG');
INSERT INTO `ref_desa` VALUES (6808, 675, 'KARTA RAHARJA');
INSERT INTO `ref_desa` VALUES (6809, 675, 'KEBON KAI');
INSERT INTO `ref_desa` VALUES (6810, 675, 'KERTA ANGSANA');
INSERT INTO `ref_desa` VALUES (6811, 675, 'KERTAANGSANA');
INSERT INTO `ref_desa` VALUES (6812, 675, 'MAKASARI');
INSERT INTO `ref_desa` VALUES (6813, 675, 'MEKAR  SARI');
INSERT INTO `ref_desa` VALUES (6814, 675, 'MEKAR JAYA');
INSERT INTO `ref_desa` VALUES (6815, 675, 'MEKAR SARI');
INSERT INTO `ref_desa` VALUES (6816, 675, 'MEKARSRAI');
INSERT INTO `ref_desa` VALUES (6817, 675, 'MUNJUL');
INSERT INTO `ref_desa` VALUES (6818, 675, 'NEAGLASARI');
INSERT INTO `ref_desa` VALUES (6819, 675, 'NEGLA SARI');
INSERT INTO `ref_desa` VALUES (6820, 675, 'NYAINDUNG');
INSERT INTO `ref_desa` VALUES (6821, 675, 'NYAKLINDUNG');
INSERT INTO `ref_desa` VALUES (6822, 675, 'NYALIBDUNG');
INSERT INTO `ref_desa` VALUES (6823, 675, 'NYALIDUNG');
INSERT INTO `ref_desa` VALUES (6824, 675, 'NYALIHNDUNG');
INSERT INTO `ref_desa` VALUES (6825, 675, 'PASIR SLAM');
INSERT INTO `ref_desa` VALUES (6826, 675, 'SICITU');
INSERT INTO `ref_desa` VALUES (6827, 675, 'SITU DAUN');
INSERT INTO `ref_desa` VALUES (6828, 675, 'SUKA MAJU');
INSERT INTO `ref_desa` VALUES (6829, 675, 'SUMAKAJU');
INSERT INTO `ref_desa` VALUES (6830, 675, 'TALANG');
INSERT INTO `ref_desa` VALUES (6831, 675, 'WAGUNLEGA');
INSERT INTO `ref_desa` VALUES (6832, 675, 'WANGUN REJA');
INSERT INTO `ref_desa` VALUES (6833, 675, 'WANGUNREAJA');
INSERT INTO `ref_desa` VALUES (6834, 605, 'BANTAR SARI');
INSERT INTO `ref_desa` VALUES (6835, 605, 'BATARSARI');
INSERT INTO `ref_desa` VALUES (6836, 605, 'BOJONG HAUR');
INSERT INTO `ref_desa` VALUES (6837, 605, 'BT SARI');
INSERT INTO `ref_desa` VALUES (6838, 605, 'BTR SARI');
INSERT INTO `ref_desa` VALUES (6839, 605, 'BTR.SARI');
INSERT INTO `ref_desa` VALUES (6840, 605, 'CIBEBER');
INSERT INTO `ref_desa` VALUES (6841, 605, 'CIUTARA');
INSERT INTO `ref_desa` VALUES (6842, 605, 'CUBUNGUR');
INSERT INTO `ref_desa` VALUES (6843, 605, 'PABUARARA');
INSERT INTO `ref_desa` VALUES (6844, 605, 'PARIGI');
INSERT INTO `ref_desa` VALUES (6845, 605, 'PARUFKAU');
INSERT INTO `ref_desa` VALUES (6846, 605, 'PAURABAYA');
INSERT INTO `ref_desa` VALUES (6847, 605, 'PUNCAK TUGU');
INSERT INTO `ref_desa` VALUES (6848, 605, 'SINARSRI');
INSERT INTO `ref_desa` VALUES (6849, 605, 'SIRNA SARI');
INSERT INTO `ref_desa` VALUES (6850, 605, 'SIRNASRI');
INSERT INTO `ref_desa` VALUES (6851, 605, 'SUKA JAYA');
INSERT INTO `ref_desa` VALUES (6852, 605, 'SUKATANI');
INSERT INTO `ref_desa` VALUES (6853, 605, 'WARU DOYONG');
INSERT INTO `ref_desa` VALUES (6854, 567, 'BOJONG ASIH');
INSERT INTO `ref_desa` VALUES (6855, 606, 'PADA ASIH');
INSERT INTO `ref_desa` VALUES (6856, 664, 'BOJONG ASIH');
INSERT INTO `ref_desa` VALUES (6857, 191, 'BOJONGKOKOSAN');
INSERT INTO `ref_desa` VALUES (6858, 191, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (6859, 191, 'PARNGKUDA');
INSERT INTO `ref_desa` VALUES (6860, 191, 'PARUNG KUDA');
INSERT INTO `ref_desa` VALUES (6861, 191, 'PONDOK KASO TONGGOH');
INSERT INTO `ref_desa` VALUES (6862, 191, 'PONDOKASO');
INSERT INTO `ref_desa` VALUES (6863, 191, 'PONDOKASO LAN');
INSERT INTO `ref_desa` VALUES (6864, 191, 'PONDOKKASO');
INSERT INTO `ref_desa` VALUES (6865, 191, 'SUNDA WE NANG');
INSERT INTO `ref_desa` VALUES (6866, 191, 'SUNDA WENANG');
INSERT INTO `ref_desa` VALUES (6867, 191, 'TENJO AYU');
INSERT INTO `ref_desa` VALUES (6868, 674, 'CIBUNGUR');
INSERT INTO `ref_desa` VALUES (6869, 674, 'CIGEMBONG');
INSERT INTO `ref_desa` VALUES (6870, 674, 'CIKUCANG');
INSERT INTO `ref_desa` VALUES (6871, 674, 'CIKUKANG');
INSERT INTO `ref_desa` VALUES (6872, 674, 'CIROYOM');
INSERT INTO `ref_desa` VALUES (6873, 674, 'CISARUA');
INSERT INTO `ref_desa` VALUES (6874, 674, 'CISUKA');
INSERT INTO `ref_desa` VALUES (6875, 674, 'MARGA LUYU');
INSERT INTO `ref_desa` VALUES (6876, 674, 'MARGALUYU');
INSERT INTO `ref_desa` VALUES (6877, 674, 'MARGARUYU');
INSERT INTO `ref_desa` VALUES (6878, 674, 'NANGERANG');
INSERT INTO `ref_desa` VALUES (6879, 674, 'NANGGERANG');
INSERT INTO `ref_desa` VALUES (6880, 674, 'NETGLASSARI');
INSERT INTO `ref_desa` VALUES (6881, 674, 'OURABAYA');
INSERT INTO `ref_desa` VALUES (6882, 674, 'PAGALEARAN');
INSERT INTO `ref_desa` VALUES (6883, 674, 'PAGALERAN');
INSERT INTO `ref_desa` VALUES (6884, 674, 'PANGELARAN');
INSERT INTO `ref_desa` VALUES (6885, 674, 'PANGLESERAN');
INSERT INTO `ref_desa` VALUES (6886, 674, 'PASANGRAHAN');
INSERT INTO `ref_desa` VALUES (6887, 674, 'PUIRABAYA');
INSERT INTO `ref_desa` VALUES (6888, 674, 'PURABAA');
INSERT INTO `ref_desa` VALUES (6889, 674, 'PURBABAYA');
INSERT INTO `ref_desa` VALUES (6890, 674, 'SIRNASARI');
INSERT INTO `ref_desa` VALUES (6891, 674, 'TENJO JAYA');
INSERT INTO `ref_desa` VALUES (6892, 624, 'PURWAKARTA');
INSERT INTO `ref_desa` VALUES (6893, 90, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (6894, 683, 'BABMBAYANG');
INSERT INTO `ref_desa` VALUES (6895, 683, 'BAROS');
INSERT INTO `ref_desa` VALUES (6896, 683, 'BOJONG JENGKOL');
INSERT INTO `ref_desa` VALUES (6897, 683, 'CANTAYAN');
INSERT INTO `ref_desa` VALUES (6898, 683, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (6899, 683, 'CIBADAKCIBADAK');
INSERT INTO `ref_desa` VALUES (6900, 683, 'CIBUNGUR');
INSERT INTO `ref_desa` VALUES (6901, 683, 'CICURUG');
INSERT INTO `ref_desa` VALUES (6902, 683, 'CIDADAP');
INSERT INTO `ref_desa` VALUES (6903, 683, 'CIDAHU');
INSERT INTO `ref_desa` VALUES (6904, 683, 'CIDOLOG');
INSERT INTO `ref_desa` VALUES (6905, 683, 'CIGDOG');
INSERT INTO `ref_desa` VALUES (6906, 683, 'CIHEULANG TONGGOH');
INSERT INTO `ref_desa` VALUES (6907, 683, 'CIMENTENG');
INSERT INTO `ref_desa` VALUES (6908, 683, 'CUCURGLUHUR');
INSERT INTO `ref_desa` VALUES (6909, 683, 'CURUG KEMBAR');
INSERT INTO `ref_desa` VALUES (6910, 683, 'CURUG LUHUR');
INSERT INTO `ref_desa` VALUES (6911, 683, 'CURUGKEMBAR');
INSERT INTO `ref_desa` VALUES (6912, 683, 'DATAR NANGKA');
INSERT INTO `ref_desa` VALUES (6913, 683, 'GN BENTANG');
INSERT INTO `ref_desa` VALUES (6914, 683, 'GN.BENTANG');
INSERT INTO `ref_desa` VALUES (6915, 683, 'HEGAR  MANAH');
INSERT INTO `ref_desa` VALUES (6916, 683, 'HEGAR MANAH');
INSERT INTO `ref_desa` VALUES (6917, 683, 'HEGAR MULYA');
INSERT INTO `ref_desa` VALUES (6918, 683, 'JAMPANG');
INSERT INTO `ref_desa` VALUES (6919, 683, 'JERUK LUHUR');
INSERT INTO `ref_desa` VALUES (6920, 683, 'KABANDUNGAN');
INSERT INTO `ref_desa` VALUES (6921, 683, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (6922, 683, 'KEBON MANGGU');
INSERT INTO `ref_desa` VALUES (6923, 683, 'KERTANANGKA');
INSERT INTO `ref_desa` VALUES (6924, 683, 'MARGA LUYU');
INSERT INTO `ref_desa` VALUES (6925, 683, 'MARGARUYU');
INSERT INTO `ref_desa` VALUES (6926, 683, 'MEKAR TANJUNG');
INSERT INTO `ref_desa` VALUES (6927, 683, 'MULYASARI');
INSERT INTO `ref_desa` VALUES (6928, 683, 'NAGRAOG');
INSERT INTO `ref_desa` VALUES (6929, 683, 'PABUARAN');
INSERT INTO `ref_desa` VALUES (6930, 683, 'PADA SENANG');
INSERT INTO `ref_desa` VALUES (6931, 683, 'PADASENANG');
INSERT INTO `ref_desa` VALUES (6932, 683, 'PARAKAN SAAK PARAKA SAKAK');
INSERT INTO `ref_desa` VALUES (6933, 683, 'PASANGARAHAN');
INSERT INTO `ref_desa` VALUES (6934, 683, 'PASANGGARAHAN');
INSERT INTO `ref_desa` VALUES (6935, 683, 'PASANGRAHAN');
INSERT INTO `ref_desa` VALUES (6936, 683, 'PASIR  JAYA');
INSERT INTO `ref_desa` VALUES (6937, 683, 'PESANGGRAHAN');
INSERT INTO `ref_desa` VALUES (6938, 683, 'PUNCAK MANGGIS');
INSERT INTO `ref_desa` VALUES (6939, 683, 'PUNCAK MANGGU');
INSERT INTO `ref_desa` VALUES (6940, 683, 'PUNCAK MANGIS');
INSERT INTO `ref_desa` VALUES (6941, 683, 'PUNCAK MANIS');
INSERT INTO `ref_desa` VALUES (6942, 683, 'PURABAYA');
INSERT INTO `ref_desa` VALUES (6943, 683, 'SAGARANRTEN');
INSERT INTO `ref_desa` VALUES (6944, 683, 'SAGARANTEAN');
INSERT INTO `ref_desa` VALUES (6945, 683, 'SAGARANTEN');
INSERT INTO `ref_desa` VALUES (6946, 683, 'SIANAR BENTENG');
INSERT INTO `ref_desa` VALUES (6947, 683, 'SINARBENTANG');
INSERT INTO `ref_desa` VALUES (6948, 683, 'SINDANG RAJA');
INSERT INTO `ref_desa` VALUES (6949, 683, 'SINDANG RESMI');
INSERT INTO `ref_desa` VALUES (6950, 683, 'SINDANGRAJA');
INSERT INTO `ref_desa` VALUES (6951, 683, 'SNDANGRAJA');
INSERT INTO `ref_desa` VALUES (6952, 683, 'SOROGOL');
INSERT INTO `ref_desa` VALUES (6953, 683, 'SUKAAAH');
INSERT INTO `ref_desa` VALUES (6954, 683, 'SUKABUMI');
INSERT INTO `ref_desa` VALUES (6955, 683, 'SUKAKARYA');
INSERT INTO `ref_desa` VALUES (6956, 683, 'TANJUNG SARI');
INSERT INTO `ref_desa` VALUES (6957, 683, 'TEGAL BULED');
INSERT INTO `ref_desa` VALUES (6958, 683, 'TG SARI');
INSERT INTO `ref_desa` VALUES (6959, 683, 'WARNA JATI');
INSERT INTO `ref_desa` VALUES (6960, 570, 'VIDADAP');
INSERT INTO `ref_desa` VALUES (6961, 670, 'BOJONG ASIH');
INSERT INTO `ref_desa` VALUES (6962, 670, 'CIHURANG');
INSERT INTO `ref_desa` VALUES (6963, 670, 'CIKIDANG');
INSERT INTO `ref_desa` VALUES (6964, 670, 'CIPICUNG.MEKAR ASIH');
INSERT INTO `ref_desa` VALUES (6965, 670, 'KEBON KOPI');
INSERT INTO `ref_desa` VALUES (6966, 670, 'KERTA JAYA');
INSERT INTO `ref_desa` VALUES (6967, 670, 'KERTARAHARJA');
INSERT INTO `ref_desa` VALUES (6968, 670, 'KUTA JAYA');
INSERT INTO `ref_desa` VALUES (6969, 670, 'LOA');
INSERT INTO `ref_desa` VALUES (6970, 670, 'LOGI');
INSERT INTO `ref_desa` VALUES (6971, 670, 'MAEKARASIH');
INSERT INTO `ref_desa` VALUES (6972, 670, 'MARIUK');
INSERT INTO `ref_desa` VALUES (6973, 670, 'MEKAR ASIH');
INSERT INTO `ref_desa` VALUES (6974, 670, 'MEKAR SARI');
INSERT INTO `ref_desa` VALUES (6975, 670, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (6976, 670, 'PADA SUKA');
INSERT INTO `ref_desa` VALUES (6977, 670, 'PADAASIH');
INSERT INTO `ref_desa` VALUES (6978, 670, 'SEMPENAN');
INSERT INTO `ref_desa` VALUES (6979, 670, 'SIMPENAN');
INSERT INTO `ref_desa` VALUES (6980, 670, 'WRKIARA');
INSERT INTO `ref_desa` VALUES (6981, 211, 'SINDAND SARI');
INSERT INTO `ref_desa` VALUES (6982, 211, 'SINDANG SARI');
INSERT INTO `ref_desa` VALUES (6983, 645, 'BABAKAN PANJANG');
INSERT INTO `ref_desa` VALUES (6984, 645, 'BAROS');
INSERT INTO `ref_desa` VALUES (6985, 645, 'BAYANG KARA');
INSERT INTO `ref_desa` VALUES (6986, 645, 'BAYANGKARA');
INSERT INTO `ref_desa` VALUES (6987, 645, 'BAYANGLARA');
INSERT INTO `ref_desa` VALUES (6988, 645, 'BHAYANGKARA');
INSERT INTO `ref_desa` VALUES (6989, 645, 'BOJONG GENTENG');
INSERT INTO `ref_desa` VALUES (6990, 645, 'CIAUL');
INSERT INTO `ref_desa` VALUES (6991, 645, 'CIAWUL');
INSERT INTO `ref_desa` VALUES (6992, 645, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (6993, 645, 'CIBOLANG KALER');
INSERT INTO `ref_desa` VALUES (6994, 645, 'CICANATAYAN');
INSERT INTO `ref_desa` VALUES (6995, 645, 'CIGUNUNG');
INSERT INTO `ref_desa` VALUES (6996, 645, 'CIJALINAGAN');
INSERT INTO `ref_desa` VALUES (6997, 645, 'CIKATOMAS');
INSERT INTO `ref_desa` VALUES (6998, 645, 'CIKOLE');
INSERT INTO `ref_desa` VALUES (6999, 645, 'CIKONDANG');
INSERT INTO `ref_desa` VALUES (7000, 645, 'CIKUJANG');
INSERT INTO `ref_desa` VALUES (7001, 645, 'CIPELANG');
INSERT INTO `ref_desa` VALUES (7002, 645, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (7003, 645, 'DAYEHLUHUR');
INSERT INTO `ref_desa` VALUES (7004, 645, 'DAYEUH LUHUR');
INSERT INTO `ref_desa` VALUES (7005, 645, 'DUKSBU');
INSERT INTO `ref_desa` VALUES (7006, 645, 'GGEGR BITUNG');
INSERT INTO `ref_desa` VALUES (7007, 645, 'GUNGJAYA');
INSERT INTO `ref_desa` VALUES (7008, 645, 'GUNUNG PUYUH');
INSERT INTO `ref_desa` VALUES (7009, 645, 'KARANGTENGAH');
INSERT INTO `ref_desa` VALUES (7010, 645, 'KARWANG');
INSERT INTO `ref_desa` VALUES (7011, 645, 'KB JATI');
INSERT INTO `ref_desa` VALUES (7012, 645, 'KB PEDEUS');
INSERT INTO `ref_desa` VALUES (7013, 645, 'KB RANDU');
INSERT INTO `ref_desa` VALUES (7014, 645, 'KERAMAT');
INSERT INTO `ref_desa` VALUES (7015, 645, 'KP RANJI');
INSERT INTO `ref_desa` VALUES (7016, 645, 'LEMBUR SITU');
INSERT INTO `ref_desa` VALUES (7017, 645, 'LIMUS NUNGGAL');
INSERT INTO `ref_desa` VALUES (7018, 645, 'LIMUSNUNGGAL');
INSERT INTO `ref_desa` VALUES (7019, 645, 'MALINGGUT');
INSERT INTO `ref_desa` VALUES (7020, 645, 'NYAINDUNG');
INSERT INTO `ref_desa` VALUES (7021, 645, 'NYOMPLONG');
INSERT INTO `ref_desa` VALUES (7022, 645, 'PANGLESERAN');
INSERT INTO `ref_desa` VALUES (7023, 645, 'PARAUNGSEAH');
INSERT INTO `ref_desa` VALUES (7024, 645, 'PARUNG SEAH');
INSERT INTO `ref_desa` VALUES (7025, 645, 'PRIANGAN JAYA');
INSERT INTO `ref_desa` VALUES (7026, 645, 'PT GRIYA LESTARI');
INSERT INTO `ref_desa` VALUES (7027, 645, 'PT GRIYALESTARI');
INSERT INTO `ref_desa` VALUES (7028, 645, 'PT MUARA GRIRYA LESTARI');
INSERT INTO `ref_desa` VALUES (7029, 645, 'SALABINTANA');
INSERT INTO `ref_desa` VALUES (7030, 645, 'SALAKOPU');
INSERT INTO `ref_desa` VALUES (7031, 645, 'SEAKARWANGICIBADAK');
INSERT INTO `ref_desa` VALUES (7032, 645, 'SEALBINTANA');
INSERT INTO `ref_desa` VALUES (7033, 645, 'SELABINTANA');
INSERT INTO `ref_desa` VALUES (7034, 645, 'SINDANG RESMI');
INSERT INTO `ref_desa` VALUES (7035, 645, 'SIUKAJAYA');
INSERT INTO `ref_desa` VALUES (7036, 645, 'SLABINTANA');
INSERT INTO `ref_desa` VALUES (7037, 645, 'SRI WIDARI');
INSERT INTO `ref_desa` VALUES (7038, 645, 'SUKABUMI');
INSERT INTO `ref_desa` VALUES (7039, 645, 'SUKABUNI');
INSERT INTO `ref_desa` VALUES (7040, 645, 'SUKAKARYA');
INSERT INTO `ref_desa` VALUES (7041, 645, 'SUKALARANG');
INSERT INTO `ref_desa` VALUES (7042, 645, 'SUKANMBUMI');
INSERT INTO `ref_desa` VALUES (7043, 645, 'SUKARAJA');
INSERT INTO `ref_desa` VALUES (7044, 645, 'SUNDAJAYA GIRANG');
INSERT INTO `ref_desa` VALUES (7045, 645, 'SUNDAJAYAGIRANG');
INSERT INTO `ref_desa` VALUES (7046, 645, 'TEGAL PADUL');
INSERT INTO `ref_desa` VALUES (7047, 645, 'WARU DOYONG');
INSERT INTO `ref_desa` VALUES (7048, 645, 'WARUDOYONG');
INSERT INTO `ref_desa` VALUES (7049, 645, 'WRNASARI');
INSERT INTO `ref_desa` VALUES (7050, 584, 'BENDA');
INSERT INTO `ref_desa` VALUES (7051, 584, 'BOJONG LARANG');
INSERT INTO `ref_desa` VALUES (7052, 584, 'CIKAMPEK');
INSERT INTO `ref_desa` VALUES (7053, 584, 'CIMANGKGOG');
INSERT INTO `ref_desa` VALUES (7054, 584, 'CIMANGOK');
INSERT INTO `ref_desa` VALUES (7055, 584, 'LIMBANGAN');
INSERT INTO `ref_desa` VALUES (7056, 584, 'MEKARSARI');
INSERT INTO `ref_desa` VALUES (7057, 584, 'PIANGAN JAYA');
INSERT INTO `ref_desa` VALUES (7058, 584, 'PRIANGAN JAYA');
INSERT INTO `ref_desa` VALUES (7059, 584, 'SSUKARARANG');
INSERT INTO `ref_desa` VALUES (7060, 584, 'SUKA LARANG');
INSERT INTO `ref_desa` VALUES (7061, 584, 'SUKALAAARANG');
INSERT INTO `ref_desa` VALUES (7062, 584, 'SUKALARANGA');
INSERT INTO `ref_desa` VALUES (7063, 195, 'CIBADAK');
INSERT INTO `ref_desa` VALUES (7064, 196, 'BENCOY');
INSERT INTO `ref_desa` VALUES (7065, 196, 'BOBOJONG');
INSERT INTO `ref_desa` VALUES (7066, 196, 'BOJONG SAWAH');
INSERT INTO `ref_desa` VALUES (7067, 196, 'BOJONGSAWAH');
INSERT INTO `ref_desa` VALUES (7068, 196, 'CIAWUL');
INSERT INTO `ref_desa` VALUES (7069, 196, 'CIBEUREM');
INSERT INTO `ref_desa` VALUES (7070, 196, 'CIBEUREUM');
INSERT INTO `ref_desa` VALUES (7071, 196, 'CIJUJUNG');
INSERT INTO `ref_desa` VALUES (7072, 196, 'CIKAHURIPAN');
INSERT INTO `ref_desa` VALUES (7073, 196, 'CIKARET');
INSERT INTO `ref_desa` VALUES (7074, 196, 'CILANGKA');
INSERT INTO `ref_desa` VALUES (7075, 196, 'CILEBUT BARAT');
INSERT INTO `ref_desa` VALUES (7076, 196, 'CIMAHPAR');
INSERT INTO `ref_desa` VALUES (7077, 196, 'CIMAMPAH II');
INSERT INTO `ref_desa` VALUES (7078, 196, 'CIMANGKOK');
INSERT INTO `ref_desa` VALUES (7079, 196, 'CIPURUT');
INSERT INTO `ref_desa` VALUES (7080, 196, 'CIRENGHAS');
INSERT INTO `ref_desa` VALUES (7081, 196, 'GOAPARA');
INSERT INTO `ref_desa` VALUES (7082, 196, 'HAREMPOY');
INSERT INTO `ref_desa` VALUES (7083, 196, 'JAMBE NEGANG');
INSERT INTO `ref_desa` VALUES (7084, 196, 'JAMBE NENGGANG');
INSERT INTO `ref_desa` VALUES (7085, 196, 'JAMBENENGGENG');
INSERT INTO `ref_desa` VALUES (7086, 196, 'JAMBENENGGONG');
INSERT INTO `ref_desa` VALUES (7087, 196, 'JAMINUNGGAL');
INSERT INTO `ref_desa` VALUES (7088, 196, 'KEBON PEDES');
INSERT INTO `ref_desa` VALUES (7089, 196, 'KEBONPEDES');
INSERT INTO `ref_desa` VALUES (7090, 196, 'LANGEN SARI');
INSERT INTO `ref_desa` VALUES (7091, 196, 'LANGGENSARI');
INSERT INTO `ref_desa` VALUES (7092, 196, 'LENGANSARI');
INSERT INTO `ref_desa` VALUES (7093, 196, 'LIMBANG');
INSERT INTO `ref_desa` VALUES (7094, 196, 'LIMBSNGSN');
INSERT INTO `ref_desa` VALUES (7095, 196, 'MARGALUYU');
INSERT INTO `ref_desa` VALUES (7096, 196, 'PALASARI');
INSERT INTO `ref_desa` VALUES (7097, 196, 'PASAIR HALANG');
INSERT INTO `ref_desa` VALUES (7098, 196, 'PASIR  JAYA');
INSERT INTO `ref_desa` VALUES (7099, 196, 'PASIR HALANG');
INSERT INTO `ref_desa` VALUES (7100, 196, 'PRIANGANJAYA');
INSERT INTO `ref_desa` VALUES (7101, 196, 'SALAAWI');
INSERT INTO `ref_desa` VALUES (7102, 196, 'SELA AWI');
INSERT INTO `ref_desa` VALUES (7103, 196, 'SELAWANGGI');
INSERT INTO `ref_desa` VALUES (7104, 196, 'SELAWAWI');
INSERT INTO `ref_desa` VALUES (7105, 196, 'SELAWI');
INSERT INTO `ref_desa` VALUES (7106, 196, 'SUKA EKAR');
INSERT INTO `ref_desa` VALUES (7107, 196, 'SUKA MEKAR');
INSERT INTO `ref_desa` VALUES (7108, 196, 'SUKA RAJA');
INSERT INTO `ref_desa` VALUES (7109, 196, 'SUKAAAARAJA');
INSERT INTO `ref_desa` VALUES (7110, 196, 'SUKABUMI');
INSERT INTO `ref_desa` VALUES (7111, 196, 'SUKALARANG');
INSERT INTO `ref_desa` VALUES (7112, 196, 'SUKAMAJU');
INSERT INTO `ref_desa` VALUES (7113, 196, 'SUKARAAJA');
INSERT INTO `ref_desa` VALUES (7114, 196, 'SUKARJA');
INSERT INTO `ref_desa` VALUES (7115, 196, 'TITISAN');
INSERT INTO `ref_desa` VALUES (7116, 681, 'BALANDONAGN');
INSERT INTO `ref_desa` VALUES (7117, 681, 'BANJARSARI');
INSERT INTO `ref_desa` VALUES (7118, 681, 'BANYMURNI');
INSERT INTO `ref_desa` VALUES (7119, 681, 'BANYU MURNI');
INSERT INTO `ref_desa` VALUES (7120, 681, 'BANYUMURNI');
INSERT INTO `ref_desa` VALUES (7121, 681, 'BANYUWANGI');
INSERT INTO `ref_desa` VALUES (7122, 681, 'BAROS');
INSERT INTO `ref_desa` VALUES (7123, 681, 'BITUNG SARI');
INSERT INTO `ref_desa` VALUES (7124, 681, 'BIUNI WANGI');
INSERT INTO `ref_desa` VALUES (7125, 681, 'BUMI WANGI');
INSERT INTO `ref_desa` VALUES (7126, 681, 'BUMIWANGI');
INSERT INTO `ref_desa` VALUES (7127, 681, 'BUNI WANGI');
INSERT INTO `ref_desa` VALUES (7128, 681, 'BUNIOWANGI');
INSERT INTO `ref_desa` VALUES (7129, 681, 'BUNIWANGGI');
INSERT INTO `ref_desa` VALUES (7130, 681, 'BUNUWANGI');
INSERT INTO `ref_desa` VALUES (7131, 681, 'CBUMIMWANGI');
INSERT INTO `ref_desa` VALUES (7132, 681, 'CIBENTENG');
INSERT INTO `ref_desa` VALUES (7133, 681, 'CIBENTEUR');
INSERT INTO `ref_desa` VALUES (7134, 681, 'CIBITUNG');
INSERT INTO `ref_desa` VALUES (7135, 681, 'CIBODAS');
INSERT INTO `ref_desa` VALUES (7136, 681, 'CIDAHU');
INSERT INTO `ref_desa` VALUES (7137, 681, 'CIEUNDEUY');
INSERT INTO `ref_desa` VALUES (7138, 681, 'CIHAUR');
INSERT INTO `ref_desa` VALUES (7139, 681, 'CINBUNTU');
INSERT INTO `ref_desa` VALUES (7140, 681, 'CIPEANDEUY');
INSERT INTO `ref_desa` VALUES (7141, 681, 'CIPEDEUY');
INSERT INTO `ref_desa` VALUES (7142, 681, 'CIPENDEUY');
INSERT INTO `ref_desa` VALUES (7143, 681, 'CIPENDEY');
INSERT INTO `ref_desa` VALUES (7144, 681, 'CIPEUNCEUY');
INSERT INTO `ref_desa` VALUES (7145, 681, 'CIPEUNDEY');
INSERT INTO `ref_desa` VALUES (7146, 681, 'CIPEUTEUY');
INSERT INTO `ref_desa` VALUES (7147, 681, 'CIRACAP');
INSERT INTO `ref_desa` VALUES (7148, 681, 'CIRACAS');
INSERT INTO `ref_desa` VALUES (7149, 681, 'CITANGEALAR');
INSERT INTO `ref_desa` VALUES (7150, 681, 'CITANGELAR');
INSERT INTO `ref_desa` VALUES (7151, 681, 'CITANGGAR');
INSERT INTO `ref_desa` VALUES (7152, 681, 'CITANGGELAR');
INSERT INTO `ref_desa` VALUES (7153, 681, 'CITANGLAB');
INSERT INTO `ref_desa` VALUES (7154, 681, 'CITANGLAR');
INSERT INTO `ref_desa` VALUES (7155, 681, 'DAYEUH LUHUR');
INSERT INTO `ref_desa` VALUES (7156, 681, 'GN SUNGGING');
INSERT INTO `ref_desa` VALUES (7157, 681, 'GN.SUNGGING');
INSERT INTO `ref_desa` VALUES (7158, 681, 'GUNUGSNGGING');
INSERT INTO `ref_desa` VALUES (7159, 681, 'GUNUNG BONGKOK');
INSERT INTO `ref_desa` VALUES (7160, 681, 'GUNUNG SUMING');
INSERT INTO `ref_desa` VALUES (7161, 681, 'GUNUNG SUNGING');
INSERT INTO `ref_desa` VALUES (7162, 681, 'GUNUNGSUNGGING');
INSERT INTO `ref_desa` VALUES (7163, 681, 'JAGA MUKTI');
INSERT INTO `ref_desa` VALUES (7164, 681, 'JAYA MUKTI');
INSERT INTO `ref_desa` VALUES (7165, 681, 'KAADALEMAN');
INSERT INTO `ref_desa` VALUES (7166, 681, 'KADALAMAN');
INSERT INTO `ref_desa` VALUES (7167, 681, 'PADALEMAN');
INSERT INTO `ref_desa` VALUES (7168, 681, 'PASAR IPIS');
INSERT INTO `ref_desa` VALUES (7169, 681, 'PASIR KRIPIS');
INSERT INTO `ref_desa` VALUES (7170, 681, 'PASIRIPIS');
INSERT INTO `ref_desa` VALUES (7171, 681, 'PEUNDEUY');
INSERT INTO `ref_desa` VALUES (7172, 681, 'PS IPIS');
INSERT INTO `ref_desa` VALUES (7173, 681, 'PURWASEDA');
INSERT INTO `ref_desa` VALUES (7174, 681, 'SADAMUKTI');
INSERT INTO `ref_desa` VALUES (7175, 681, 'SEKARSARI');
INSERT INTO `ref_desa` VALUES (7176, 681, 'SIERNA SARI');
INSERT INTO `ref_desa` VALUES (7177, 681, 'SIMPANGKARET');
INSERT INTO `ref_desa` VALUES (7178, 681, 'SIRNA SARI');
INSERT INTO `ref_desa` VALUES (7179, 681, 'SUAKARYA');
INSERT INTO `ref_desa` VALUES (7180, 681, 'SUKA KARYA');
INSERT INTO `ref_desa` VALUES (7181, 681, 'SUKAKARYA');
INSERT INTO `ref_desa` VALUES (7182, 681, 'SUKAKERSA');
INSERT INTO `ref_desa` VALUES (7183, 681, 'SUKARYA');
INSERT INTO `ref_desa` VALUES (7184, 681, 'SURADE');
INSERT INTO `ref_desa` VALUES (7185, 681, 'SURASDE');
INSERT INTO `ref_desa` VALUES (7186, 681, 'SUWAKARYA');
INSERT INTO `ref_desa` VALUES (7187, 681, 'SWA KARYA');
INSERT INTO `ref_desa` VALUES (7188, 681, 'SWAKARSA');
INSERT INTO `ref_desa` VALUES (7189, 681, 'SWAKRYA');
INSERT INTO `ref_desa` VALUES (7190, 681, 'TALAGA MURNI');
INSERT INTO `ref_desa` VALUES (7191, 681, 'TALAGA SARI');
INSERT INTO `ref_desa` VALUES (7192, 681, 'TEGAL BULEUD');
INSERT INTO `ref_desa` VALUES (7193, 681, 'TEGAL LOA');
INSERT INTO `ref_desa` VALUES (7194, 681, 'WALURAN');
INSERT INTO `ref_desa` VALUES (7195, 681, 'WARNA SARI');
INSERT INTO `ref_desa` VALUES (7196, 681, 'WARNASARI');
INSERT INTO `ref_desa` VALUES (7197, 574, 'BUMBANG SAARI');
INSERT INTO `ref_desa` VALUES (7198, 574, 'BUMBANG SARI');
INSERT INTO `ref_desa` VALUES (7199, 687, 'CARINGIN');
INSERT INTO `ref_desa` VALUES (7200, 687, 'CARINGIN KULON');
INSERT INTO `ref_desa` VALUES (7201, 687, 'CIPICUNG');
INSERT INTO `ref_desa` VALUES (7202, 687, 'MEKARMUKTI');
INSERT INTO `ref_desa` VALUES (7203, 687, 'MUKTI');
INSERT INTO `ref_desa` VALUES (7204, 687, 'PADA ASIH');
INSERT INTO `ref_desa` VALUES (7205, 687, 'SEDAMUKTI');
INSERT INTO `ref_desa` VALUES (7206, 687, 'SUKA MUKTI');
INSERT INTO `ref_desa` VALUES (7207, 687, 'WARUNGGOMBONG');
INSERT INTO `ref_desa` VALUES (7208, 575, 'CIRENDEUR');
INSERT INTO `ref_desa` VALUES (7209, 575, 'WARUNG KONDANG');
INSERT INTO `ref_desa` VALUES (7210, 609, 'BANTARGADUNG');
INSERT INTO `ref_desa` VALUES (7211, 609, 'CIGOMBONG');
INSERT INTO `ref_desa` VALUES (7212, 609, 'DAMARAJA');
INSERT INTO `ref_desa` VALUES (7213, 609, 'DARMAREJA');
INSERT INTO `ref_desa` VALUES (7214, 609, 'SIEANAJAYA');
INSERT INTO `ref_desa` VALUES (7215, 609, 'SIRNA JAYA');
INSERT INTO `ref_desa` VALUES (7216, 609, 'SIRNJY');
INSERT INTO `ref_desa` VALUES (7217, 609, 'WARUNG  KIARA');
INSERT INTO `ref_desa` VALUES (7218, 609, 'WARUNG KIARA');
INSERT INTO `ref_desa` VALUES (7219, 609, 'WARUNGKIAAR');
INSERT INTO `ref_desa` VALUES (7220, 657, 'CIAWITALI');
INSERT INTO `ref_desa` VALUES (7221, 159, 'CIMANGGU');
INSERT INTO `ref_desa` VALUES (7222, 159, 'CIPANAS');
INSERT INTO `ref_desa` VALUES (7223, 159, 'KAAFHILIR');
INSERT INTO `ref_desa` VALUES (7224, 159, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (7225, 159, 'SEAKARWNGI');
INSERT INTO `ref_desa` VALUES (7226, 169, 'BOJONG KEMBAR');
INSERT INTO `ref_desa` VALUES (7227, 647, 'CIRENGHAS');
INSERT INTO `ref_desa` VALUES (7228, 600, 'CIGUNUNG');
INSERT INTO `ref_desa` VALUES (7229, 600, 'CIJAMBE');
INSERT INTO `ref_desa` VALUES (7230, 600, 'GUNUNG GURUH');
INSERT INTO `ref_desa` VALUES (7231, 600, 'GUNUNG JAYA');
INSERT INTO `ref_desa` VALUES (7232, 671, 'CITERIK');
INSERT INTO `ref_desa` VALUES (7233, 182, 'PARUNGSEAH GEDE');
INSERT INTO `ref_desa` VALUES (7234, 186, 'DAYEUH LUHUR');
INSERT INTO `ref_desa` VALUES (7235, 186, 'GUNUNG PUYUH');
INSERT INTO `ref_desa` VALUES (7236, 186, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (7237, 186, 'LEMBUR SITU');
INSERT INTO `ref_desa` VALUES (7238, 186, 'NYOMPLONG');
INSERT INTO `ref_desa` VALUES (7239, 186, 'SALABATU');
INSERT INTO `ref_desa` VALUES (7240, 186, 'SUKA KARYA');
INSERT INTO `ref_desa` VALUES (7241, 186, 'SUKABUMI');
INSERT INTO `ref_desa` VALUES (7242, 186, 'SUKAKARYA');
INSERT INTO `ref_desa` VALUES (7243, 188, 'ACISARUA');
INSERT INTO `ref_desa` VALUES (7244, 645, 'BAROS');
INSERT INTO `ref_desa` VALUES (7245, 645, 'BAYANGKARA');
INSERT INTO `ref_desa` VALUES (7246, 645, 'BBKN JAMPANG');
INSERT INTO `ref_desa` VALUES (7247, 645, 'BENTENG');
INSERT INTO `ref_desa` VALUES (7248, 645, 'BHAYANGKARA');
INSERT INTO `ref_desa` VALUES (7249, 645, 'BJ KEMBAR');
INSERT INTO `ref_desa` VALUES (7250, 645, 'BTN SECAPA');
INSERT INTO `ref_desa` VALUES (7251, 645, 'C8IBADAK');
INSERT INTO `ref_desa` VALUES (7252, 645, 'CELANG TONGOH');
INSERT INTO `ref_desa` VALUES (7253, 645, 'CEPANENGAH');
INSERT INTO `ref_desa` VALUES (7254, 645, 'CIAUL');
INSERT INTO `ref_desa` VALUES (7255, 645, 'CIBEUREM');
INSERT INTO `ref_desa` VALUES (7256, 645, 'CIBEUREUM');
INSERT INTO `ref_desa` VALUES (7257, 645, 'CIBEUREUM HILIR');
INSERT INTO `ref_desa` VALUES (7258, 645, 'CICURUG');
INSERT INTO `ref_desa` VALUES (7259, 645, 'CIGUNUNG');
INSERT INTO `ref_desa` VALUES (7260, 645, 'CIJANGKAR');
INSERT INTO `ref_desa` VALUES (7261, 645, 'CIKALEO');
INSERT INTO `ref_desa` VALUES (7262, 645, 'CIKAUNG');
INSERT INTO `ref_desa` VALUES (7263, 645, 'CIKOLE');
INSERT INTO `ref_desa` VALUES (7264, 645, 'CIKONDANG');
INSERT INTO `ref_desa` VALUES (7265, 645, 'CIPELANG');
INSERT INTO `ref_desa` VALUES (7266, 645, 'CIPOHO');
INSERT INTO `ref_desa` VALUES (7267, 645, 'CIPOHO INDAH');
INSERT INTO `ref_desa` VALUES (7268, 645, 'CISARUA');
INSERT INTO `ref_desa` VALUES (7269, 645, 'CITAMIANG');
INSERT INTO `ref_desa` VALUES (7270, 645, 'DAYEUH LUHUR');
INSERT INTO `ref_desa` VALUES (7271, 645, 'GEDONG PANJANG');
INSERT INTO `ref_desa` VALUES (7272, 645, 'GEDUNG PANAJANG');
INSERT INTO `ref_desa` VALUES (7273, 645, 'GIRIJAYA');
INSERT INTO `ref_desa` VALUES (7274, 645, 'GN PUYUH');
INSERT INTO `ref_desa` VALUES (7275, 645, 'GOALPARA');
INSERT INTO `ref_desa` VALUES (7276, 645, 'GUNUNG PUYUH');
INSERT INTO `ref_desa` VALUES (7277, 645, 'JL');
INSERT INTO `ref_desa` VALUES (7278, 645, 'KARAMAT');
INSERT INTO `ref_desa` VALUES (7279, 645, 'KARANG  TENGAH');
INSERT INTO `ref_desa` VALUES (7280, 645, 'KARANG TENGAH');
INSERT INTO `ref_desa` VALUES (7281, 645, 'KEBON PEDES');
INSERT INTO `ref_desa` VALUES (7282, 645, 'KUITAJAYA');
INSERT INTO `ref_desa` VALUES (7283, 645, 'LEMBUR SITU');
INSERT INTO `ref_desa` VALUES (7284, 645, 'NANGELENG');
INSERT INTO `ref_desa` VALUES (7285, 645, 'NANGGELENG');
INSERT INTO `ref_desa` VALUES (7286, 645, 'NANGLENG');
INSERT INTO `ref_desa` VALUES (7287, 645, 'NYOMPLONG');
INSERT INTO `ref_desa` VALUES (7288, 645, 'PAJAGAN CICURUG');
INSERT INTO `ref_desa` VALUES (7289, 645, 'PALASARI');
INSERT INTO `ref_desa` VALUES (7290, 645, 'PANJALU');
INSERT INTO `ref_desa` VALUES (7291, 645, 'PARUGSEAH');
INSERT INTO `ref_desa` VALUES (7292, 645, 'PARUNG SEAH');
INSERT INTO `ref_desa` VALUES (7293, 645, 'PARUNGSEAH GEDE');
INSERT INTO `ref_desa` VALUES (7294, 645, 'PASANGGRAHAN');
INSERT INTO `ref_desa` VALUES (7295, 645, 'PASIR GERONG');
INSERT INTO `ref_desa` VALUES (7296, 645, 'PASIR HALANG');
INSERT INTO `ref_desa` VALUES (7297, 645, 'PLAMBOYAN');
INSERT INTO `ref_desa` VALUES (7298, 645, 'RAMBAY');
INSERT INTO `ref_desa` VALUES (7299, 645, 'SELABATU');
INSERT INTO `ref_desa` VALUES (7300, 645, 'SELABINTANA');
INSERT INTO `ref_desa` VALUES (7301, 645, 'SITU MEKAR');
INSERT INTO `ref_desa` VALUES (7302, 645, 'SRIWEDARI');
INSERT INTO `ref_desa` VALUES (7303, 645, 'SUDA JAYA GIRANG');
INSERT INTO `ref_desa` VALUES (7304, 645, 'SUKA BUMI');
INSERT INTO `ref_desa` VALUES (7305, 645, 'SUKABUMI');
INSERT INTO `ref_desa` VALUES (7306, 645, 'SUKABUMU');
INSERT INTO `ref_desa` VALUES (7307, 645, 'SUKAJAYA.');
INSERT INTO `ref_desa` VALUES (7308, 645, 'SUKAKARYA');
INSERT INTO `ref_desa` VALUES (7309, 645, 'SUKARESMI');
INSERT INTO `ref_desa` VALUES (7310, 645, 'SUKASIRNA');
INSERT INTO `ref_desa` VALUES (7311, 645, 'SUNDA JAYA GIRANG');
INSERT INTO `ref_desa` VALUES (7312, 645, 'SUYKABUMI');
INSERT INTO `ref_desa` VALUES (7313, 645, 'TANJUNG SARI');
INSERT INTO `ref_desa` VALUES (7314, 645, 'TEGAL WANGI');
INSERT INTO `ref_desa` VALUES (7315, 645, 'TIPAR');
INSERT INTO `ref_desa` VALUES (7316, 645, 'WANASARI');
INSERT INTO `ref_desa` VALUES (7317, 645, 'WARNA SARI');
INSERT INTO `ref_desa` VALUES (7318, 645, 'WARU DOYONG');
INSERT INTO `ref_desa` VALUES (7319, 645, 'WARUNG SEAH');
INSERT INTO `ref_desa` VALUES (7320, 196, 'CIBEUREUM');
INSERT INTO `ref_desa` VALUES (7321, 196, 'LANEGENSARI');
INSERT INTO `ref_desa` VALUES (7322, 196, 'PASIR HALANG');
INSERT INTO `ref_desa` VALUES (7323, 196, 'SUAKARYA');
INSERT INTO `ref_desa` VALUES (7324, 637, 'BITUNG');
INSERT INTO `ref_desa` VALUES (7325, 637, 'CIMONE');
INSERT INTO `ref_desa` VALUES (7326, 637, 'CIMONE JAYA');
INSERT INTO `ref_desa` VALUES (7327, 637, 'KOSAMBI BARAT');
INSERT INTO `ref_desa` VALUES (7328, 637, 'PASAR KEMIS');
INSERT INTO `ref_desa` VALUES (7329, 637, 'TANGERANG');
INSERT INTO `ref_desa` VALUES (7330, 637, 'TANGGERANG');
INSERT INTO `ref_desa` VALUES (7331, 617, 'CIJULANG');
INSERT INTO `ref_desa` VALUES (7332, 617, 'TASIK');
INSERT INTO `ref_desa` VALUES (7333, 618, 'KAHURIPAN');
INSERT INTO `ref_desa` VALUES (7334, 589, 'BOJONGLOA');
INSERT INTO `ref_desa` VALUES (7335, 693, 'CIBIRU');
INSERT INTO `ref_desa` VALUES (7336, 611, 'CIPADUNG');
INSERT INTO `ref_desa` VALUES (7337, 694, 'A');
INSERT INTO `ref_desa` VALUES (7338, 695, 'BANDUNG');
INSERT INTO `ref_desa` VALUES (7339, 696, 'A');

-- --------------------------------------------------------

-- 
-- Table structure for table `ref_pekerjaan`
-- 

CREATE TABLE `ref_pekerjaan` (
  `id` tinyint(3) NOT NULL auto_increment,
  `nama` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `ref_pekerjaan`
-- 

INSERT INTO `ref_pekerjaan` VALUES (1, 'DIBAWAH UMUR');
INSERT INTO `ref_pekerjaan` VALUES (2, 'IBU RUMAH TANGGA');
INSERT INTO `ref_pekerjaan` VALUES (3, 'MAHASISWA');
INSERT INTO `ref_pekerjaan` VALUES (4, 'NELAYAN');
INSERT INTO `ref_pekerjaan` VALUES (5, 'PEDAGANG');
INSERT INTO `ref_pekerjaan` VALUES (6, 'PEGAWAI SWASTA');
INSERT INTO `ref_pekerjaan` VALUES (7, 'PEGAWAI LEPAS');
INSERT INTO `ref_pekerjaan` VALUES (8, 'PELAJAR');
INSERT INTO `ref_pekerjaan` VALUES (9, 'PENSIUNAN');
INSERT INTO `ref_pekerjaan` VALUES (10, 'PETANI');
INSERT INTO `ref_pekerjaan` VALUES (11, 'PNS');
INSERT INTO `ref_pekerjaan` VALUES (12, 'TIDAK BEKERJA');
INSERT INTO `ref_pekerjaan` VALUES (13, 'TIDAK TAHU');
INSERT INTO `ref_pekerjaan` VALUES (14, 'TNI &amp; POLRI');
INSERT INTO `ref_pekerjaan` VALUES (15, 'LAIN-LAIN');

-- --------------------------------------------------------

-- 
-- Table structure for table `ref_pendidikan`
-- 

CREATE TABLE `ref_pendidikan` (
  `id` tinyint(3) NOT NULL auto_increment,
  `nama` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `ref_pendidikan`
-- 

INSERT INTO `ref_pendidikan` VALUES (1, 'TIDAK SEKOLAH');
INSERT INTO `ref_pendidikan` VALUES (2, 'BELUM/ TIDAK TAMAT SD');
INSERT INTO `ref_pendidikan` VALUES (3, 'TAMAT SD');
INSERT INTO `ref_pendidikan` VALUES (4, 'TAMAT SMP');
INSERT INTO `ref_pendidikan` VALUES (5, 'TAMAT SMU');
INSERT INTO `ref_pendidikan` VALUES (6, 'TAMAT SARJANA MUDA');
INSERT INTO `ref_pendidikan` VALUES (7, 'TAMAT SARJANA');
INSERT INTO `ref_pendidikan` VALUES (8, 'TAMAT PASCA SARJANA');
INSERT INTO `ref_pendidikan` VALUES (9, 'LAIN-LAIN');

-- --------------------------------------------------------

-- 
-- Table structure for table `ref_perujuk`
-- 

CREATE TABLE `ref_perujuk` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(50) default NULL,
  `alamat` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- 
-- Dumping data for table `ref_perujuk`
-- 

INSERT INTO `ref_perujuk` VALUES (1, 'BIDAN KARMINI', NULL);
INSERT INTO `ref_perujuk` VALUES (2, 'PKM. PLERET', NULL);
INSERT INTO `ref_perujuk` VALUES (3, 'PKM. JOGOKARIYAN', NULL);
INSERT INTO `ref_perujuk` VALUES (4, 'DR. SUHARTANTOS, SP.A', 'dukuhsari purwomartani kalasan');
INSERT INTO `ref_perujuk` VALUES (5, 'LAIN-LAIN', NULL);
INSERT INTO `ref_perujuk` VALUES (6, 'pak bina', 'kalasan');
INSERT INTO `ref_perujuk` VALUES (7, 'dr. Handoko', 'sda');
INSERT INTO `ref_perujuk` VALUES (8, 'dr. Andika', 'jogokariyan');
INSERT INTO `ref_perujuk` VALUES (9, 'dr. Andika', 'sda');
INSERT INTO `ref_perujuk` VALUES (10, 'hehe', 'huhu');
INSERT INTO `ref_perujuk` VALUES (11, 'coba perujuk', 'jl. mangkubumi 20');
INSERT INTO `ref_perujuk` VALUES (12, 'aaa', 'ddd');
INSERT INTO `ref_perujuk` VALUES (13, 'dr. subandi', 'alamatnya');
INSERT INTO `ref_perujuk` VALUES (14, 'dr. Perujuk', 'alamat dr perujuk');
INSERT INTO `ref_perujuk` VALUES (15, 'dr. Budi', 'jl. P. Mangkubumi');
INSERT INTO `ref_perujuk` VALUES (16, 'x', '123');
INSERT INTO `ref_perujuk` VALUES (17, 'xxx', '666');
INSERT INTO `ref_perujuk` VALUES (18, 'asdf', 'asdf');
INSERT INTO `ref_perujuk` VALUES (19, 'halao', 'disini');

-- --------------------------------------------------------

-- 
-- Table structure for table `req_pembelian`
-- 

CREATE TABLE `req_pembelian` (
  `id` int(11) NOT NULL auto_increment,
  `kd_barang` varchar(20) NOT NULL,
  `tgl` varchar(10) NOT NULL,
  `aktivasi` varchar(1) NOT NULL,
  `no_req` varchar(20) default NULL,
  `jml` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- 
-- Dumping data for table `req_pembelian`
-- 

INSERT INTO `req_pembelian` VALUES (1, 'dsasd', '24/06/2011', '2', 'SPB/2506110001', 80);
INSERT INTO `req_pembelian` VALUES (5, 'aaangga', '25/06/2011', '2', 'SPB/2506110001', 80);
INSERT INTO `req_pembelian` VALUES (4, 'ah', '24/06/2011', '2', 'SPB/2506110001', 80);
INSERT INTO `req_pembelian` VALUES (6, 'kd_barang51', '28/06/2011', '2', 'SPB/2806110008', 300);
INSERT INTO `req_pembelian` VALUES (7, 'kd_barang50', '28/06/2011', '2', 'SPB/2806110022', 200);
INSERT INTO `req_pembelian` VALUES (8, 'kd_barang55', '28/06/2011', '2', 'SPB/0207110033', 100);
INSERT INTO `req_pembelian` VALUES (9, 'kd_barang57', '28/06/2011', '2', 'SPB/2806110008', 500);
INSERT INTO `req_pembelian` VALUES (11, 'kd_barang59', '28/06/2011', '2', 'SPB/2806110008', 500);
INSERT INTO `req_pembelian` VALUES (12, 'kd_barang53', '28/06/2011', '2', 'SPB/2806110008', 400);
INSERT INTO `req_pembelian` VALUES (13, 'kd_barang56', '28/06/2011', '2', 'SPB/0207110033', 50);
INSERT INTO `req_pembelian` VALUES (14, 'kd_barang58', '28/06/2011', '2', 'SPB/0207110034', 90);
INSERT INTO `req_pembelian` VALUES (15, 'kd_barang60', '28/06/2011', '2', 'SPB/2806110022', 332);
INSERT INTO `req_pembelian` VALUES (16, 'kd_barang52', '28/06/2011', '0', NULL, 0);
INSERT INTO `req_pembelian` VALUES (17, 'kd_barang54', '28/06/2011', '2', 'SPB/0207110033', 150);

-- --------------------------------------------------------

-- 
-- Table structure for table `resep`
-- 

CREATE TABLE `resep` (
  `id` int(11) NOT NULL auto_increment,
  `no_resep` varchar(15) NOT NULL,
  `pasien_id` varchar(15) NOT NULL,
  `kode_obat` varchar(15) NOT NULL,
  `tgl` varchar(10) NOT NULL,
  `dosis_id` varchar(2) NOT NULL,
  `diminta` float(4,2) NOT NULL,
  `diberi` float(4,2) NOT NULL,
  `ket` varchar(15) NOT NULL,
  `racikan` varchar(2) NOT NULL,
  `ket_banyak` varchar(255) NOT NULL,
  `harga` float(14,2) NOT NULL,
  `sub_total` float(9,2) NOT NULL,
  `fld01` varchar(255) NOT NULL,
  `fld02` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=275 ;

-- 
-- Dumping data for table `resep`
-- 

INSERT INTO `resep` VALUES (274, 'IGD/0607110033', '00151134', 'K001', '06/07/2011', '1', 10.00, 10.00, 'Sesudah Makan', '', 'wqwqwqwq', 10000.00, 100000.00, '', '');
INSERT INTO `resep` VALUES (273, 'IGD/0607110032', '00151134', '', '06/07/2011', '3', 0.00, 0.00, 'Sebelum Makan', 'YA', 'fefefefe', 0.00, 12500.00, 'racik puyeng', 'RCK/0607110011');
INSERT INTO `resep` VALUES (271, 'IGD/0607110031', '00151134', 'K001', '06/07/2011', '2', 2.00, 2.00, 'Sesudah Makan', '', '', 10000.00, 20000.00, '', '');
INSERT INTO `resep` VALUES (272, 'IGD/0607110032', '00151134', 'K-003', '06/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', 'rffef', 1000.00, 2000.00, '', '');
INSERT INTO `resep` VALUES (269, 'OCA/0607110031', '00151134', 'K-003', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'grgrg', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (270, 'OCA/0607110031', '00151134', 'K-003', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '[llp', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (267, '', '', 'K-003', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'ere', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (268, 'OCA/0607110031', '00151134', 'K-003', '06/07/2011', '2', 2.00, 2.00, 'Sebelum Makan', '', 'dsfdsf', 1000.00, 2000.00, '', '');
INSERT INTO `resep` VALUES (266, 'OCA/0607110031', '00151134', 'K-003', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'shbf', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (265, 'OCA/0607110031', '00151134', 'K-003', '06/07/2011', '2', 10.00, 10.00, 'Sebelum Makan', '', 'dhfsg', 1000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (264, 'IGD/0607110030', '00151134', 'K-003', '06/07/2011', '2', 1.00, 1.00, 'Sesudah Makan', '', 'fadag', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (263, 'IGD/0607110030', '00151134', 'K-003', '06/07/2011', '1', 3.00, 3.00, 'Sebelum Makan', '', 'hsghb', 1000.00, 3000.00, '', '');
INSERT INTO `resep` VALUES (262, 'IGD/0607110030', '00151134', 'K-003', '06/07/2011', '2', 10.00, 10.00, 'Sesudah Makan', '', 'gtgt', 1000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (261, 'IGD/0607110030', '00151134', 'K001', '06/07/2011', '2', 5.00, 5.00, 'Sebelum Makan', '', 'bbsdfb', 10000.00, 50000.00, '', '');
INSERT INTO `resep` VALUES (260, 'IGD/0607110030', '00151134', 'K-003', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'gasdgasgasg', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (259, 'OCA/0607110029', '00151134', 'K-003', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'gtgt', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (258, 'OCA/0607110029', '00151134', 'K-003', '06/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 'esda', 1000.00, 1000.00, '', '');
INSERT INTO `resep` VALUES (256, 'IGD/0607110027', '00151134', 'K001', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'huhuhu', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (257, 'IGD/0607110027', '00151134', '', '06/07/2011', '1', 0.00, 0.00, 'Sebelum Makan', 'YA', 'diminum malem-malem', 0.00, 30500.00, 'malemmalem', 'RCK/0607110010');
INSERT INTO `resep` VALUES (255, 'IGD/0607110026', '00151134', 'K001', '06/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 're', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (254, 'IGD/0607110025', '00151134', 'K001', '06/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'sgfa', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (253, 'IGD/0507110024', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'dfdsagafdh', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (252, 'IGD/0507110023', '00151134', 'K001', '05/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 'jhjh', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (251, 'IGD/0507110022', '00151134', 'K001', '05/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 'gsgsf', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (250, 'IGD/0507110001', '00151134', 'K001', '05/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 'test', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (249, '', '', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'frfrf', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (248, 'IGD/0507110008', '00151134', '', '05/07/2011', '2', 0.00, 0.00, 'Sesudah Makan', 'YA', 'gtgtg', 0.00, 20500.00, 'coabaaba', 'RCK/0507110009');
INSERT INTO `resep` VALUES (247, 'IGD/0507110008', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sesudah Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (245, 'IGD/0507110006', '00151134', '', '05/07/2011', '1', 0.00, 0.00, 'Sebelum Makan', 'YA', '', 0.00, 22000.00, 'gfgf', 'RCK/0507110007');
INSERT INTO `resep` VALUES (246, 'IGD/0507110001', '00151134', '', '05/07/2011', '1', 0.00, 0.00, 'Sebelum Makan', 'YA', '', 0.00, 11500.00, 'gfgf', 'RCK/0507110007');
INSERT INTO `resep` VALUES (243, 'IGD/0507110001', '', '', '05/07/2011', '1', 0.00, 0.00, 'Sebelum Makan', 'YA', '23ew', 0.00, 10500.00, 'CDR', 'RCK/0507110004');
INSERT INTO `resep` VALUES (244, 'IGD/0507110003', '', '', '05/07/2011', '', 0.00, 0.00, '', 'YA', '', 0.00, 0.00, '', 'RCK/0507110005');
INSERT INTO `resep` VALUES (241, 'IGD/0507110002', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (242, 'OCA/0507110002', '00980988', '', '05/07/2011', '1', 0.00, 0.00, 'Sebelum Makan', 'YA', 'fgs', 0.00, 25500.00, 'ertf', 'RCK/0507110003');
INSERT INTO `resep` VALUES (240, 'IGD/0507110002', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (239, 'IGD/0507110001', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (238, 'IGD/0507110001', '00151134', 'K001', '05/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 'fdfsd', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (237, 'IGD/0507110010', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (236, 'IGD/0507110010', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (235, 'IGD/0507110010', '00151134', 'K001', '05/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', '', 10000.00, 20000.00, '', '');
INSERT INTO `resep` VALUES (234, 'IGD/0507110010', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (233, 'IGD/0507110010', '00151134', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (232, 'IGD/0507110010', '', 'K001', '05/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', '', 10000.00, 20000.00, '', '');
INSERT INTO `resep` VALUES (231, 'IGD/0507110010', '', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'dsds', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (230, 'IGD/0507110010', '', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (229, 'IGD/0507110010', '', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (228, 'IGD/0507110010', '', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (227, 'IGD/0507110010', '', 'K001', '05/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', '', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (226, 'IGD/0507110010', '', 'K001', '05/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 'fdfd', 10000.00, 10000.00, '', '');
INSERT INTO `resep` VALUES (225, 'IGD/0407110010', '', 'd', '04/07/2011', '2', 1.00, 1.00, 'Sebelum Makan', '', 'gdsgs', 3000.00, 3500.00, '', '');
INSERT INTO `resep` VALUES (224, 'IGD/0407110010', '', 'd', '04/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'ewrwrfvd', 3000.00, 3500.00, '', '');
INSERT INTO `resep` VALUES (223, 'IGD/0407110003', '00151134', 'd', '04/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'sd', 3000.00, 3500.00, '', '');
INSERT INTO `resep` VALUES (222, 'RRJ/0307110002', '00151135', 'd', '03/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', 'sd', 3000.00, 6500.00, '', '');
INSERT INTO `resep` VALUES (221, 'IGD/0307110003', '00151134', 'P001', '03/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', 'dsd', 13000.00, 26500.00, '', '');
INSERT INTO `resep` VALUES (220, '0307110001', '00980988', 'd', '03/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', 'sdd', 3000.00, 6500.00, '', '');
INSERT INTO `resep` VALUES (219, 'IGD/0307110002', '00151134', 'd', '03/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', 'sdsd', 3000.00, 6500.00, '', '');
INSERT INTO `resep` VALUES (218, 'RRJ/0307110001', '00151135', 'd', '03/07/2011', '1', 2.00, 2.00, 'Sesudah Makan', '', 'dsd', 3000.00, 6500.00, '', '');
INSERT INTO `resep` VALUES (217, 'RRJ/0307110001', '00151135', 'd', '03/07/2011', '1', 2.00, 2.00, 'Sebelum Makan', '', 'dsd', 3000.00, 6500.00, '', '');
INSERT INTO `resep` VALUES (216, 'IGD/0307110001', '00151134', 'd', '03/07/2011', '1', 1.00, 1.00, 'Sebelum Makan', '', 'sd', 3000.00, 3500.00, '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `resep_head`
-- 

CREATE TABLE `resep_head` (
  `id` int(11) NOT NULL auto_increment,
  `no_resep` varchar(30) NOT NULL COMMENT 'RRI/ RRJ/ RPU/ RNR/',
  `param_no` int(7) NOT NULL,
  `pasien_id` varchar(30) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(30) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(30) NOT NULL,
  `tgl` varchar(10) NOT NULL,
  `unit_id` int(2) NOT NULL default '0',
  `f_status` varchar(100) default NULL,
  `flags` int(2) default '0',
  `fld01` varchar(5) NOT NULL,
  `fld02` varchar(255) NOT NULL,
  `fld03` varchar(255) NOT NULL,
  `status_bayar` varchar(20) NOT NULL,
  `cara_masuk` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `no_resep` (`no_resep`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=280 ;

-- 
-- Dumping data for table `resep_head`
-- 

INSERT INTO `resep_head` VALUES (231, 'RRJ/0507110004', 4, '00151135', '2011-07-05 14:41:03', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (230, 'IGD/0507110003', 3, '00151134', '2011-07-05 14:39:43', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (229, 'IGD/0507110002', 2, '00151134', '2011-07-05 14:39:30', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (228, 'RRJ/0507110003', 3, '00151135', '2011-07-05 14:39:25', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (227, 'IGD/0507110001', 1, '00151134', '2011-07-05 14:39:17', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (226, 'IGD/0507110008', 8, '00151134', '2011-07-05 13:29:47', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (225, 'IGD/0507110004', 7, '00151134', '2011-07-05 13:01:56', 'Hardi', '0000-00-00 00:00:00', '', '2011/07/05', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (224, 'IGD/0507110006', 6, '00151134', '2011-07-05 12:41:05', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (223, 'IGD/0507110005', 5, '00151134', '2011-07-05 12:31:59', 'UAPT', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (222, 'IGD/0507110004', 4, '00151134', '2011-07-05 04:39:24', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (221, 'IGD/0507110003', 3, '00151134', '2011-07-05 04:19:24', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (220, 'OCA/0507110002', 2, '00980988', '2011-07-05 03:49:01', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (219, 'OCA/0507110001', 1, '00980988', '2011-07-05 03:43:47', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (218, 'IGD/0507110002', 2, '00151134', '2011-07-05 03:36:21', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (215, 'IGD/0507110001', 1, '00151134', '2011-07-05 03:21:04', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (214, '', 0, '', '2011-07-05 02:09:17', 'UIGD', '0000-00-00 00:00:00', '', '', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (213, 'IGD/0507110010', 0, '00151134', '2011-07-05 01:29:55', 'Hardi', '0000-00-00 00:00:00', '', '', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (212, 'IGD/0407110009', 9, '', '2011-07-04 20:21:12', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (211, 'OCA/0407110008', 8, '', '2011-07-04 20:16:36', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (210, 'RRJ/0407110002', 2, '00151135', '2011-07-04 20:11:09', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (209, '0407110007', 7, '00980988', '2011-07-04 20:08:50', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (208, '0407110006', 6, '00980988', '2011-07-04 19:52:34', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (207, 'IGD/0407110003', 3, '00151134', '2011-07-04 18:37:38', 'UAPT', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (206, '0407110005', 5, '00980988', '2011-07-04 15:23:55', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (205, '0407110004', 4, '00980988', '2011-07-04 14:23:58', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (204, 'RRJ/0407110001', 1, '00151135', '2011-07-04 14:20:56', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (203, 'IGD/0407110002', 2, '00151134', '2011-07-04 14:20:45', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (202, '0407110003', 3, '00980988', '2011-07-04 14:20:37', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (201, '0407110002', 2, '00980988', '2011-07-04 14:19:54', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (200, 'IGD/0407110001', 1, '00151134', '2011-07-04 14:19:30', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (199, '0407110001', 1, '00980988', '2011-07-04 14:11:05', 'Hardi', '0000-00-00 00:00:00', '', '04/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (198, 'RRJ/0307110002', 2, '00151135', '2011-07-03 19:40:36', 'UAPT', '0000-00-00 00:00:00', '', '', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (197, 'IGD/0307110003', 3, '00151134', '2011-07-03 19:40:23', 'UAPT', '0000-00-00 00:00:00', '', '', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (196, '0307110001', 1, '00980988', '2011-07-03 19:40:01', 'UAPT', '0000-00-00 00:00:00', '', '', 0, NULL, 0, '', '', '', 'Sudah Dilayani', '');
INSERT INTO `resep_head` VALUES (195, 'IGD/0307110002', 2, '00151134', '2011-07-03 19:39:45', 'UAPT', '0000-00-00 00:00:00', '', '', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (193, 'IGD/0307110001', 1, '00151134', '2011-07-03 19:38:53', 'UAPT', '0000-00-00 00:00:00', '', '', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (194, 'RRJ/0307110001', 1, '00151135', '2011-07-03 19:39:17', 'UAPT', '0000-00-00 00:00:00', '', '', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (232, 'IGD/0507110004', 4, '00151134', '2011-07-05 14:41:08', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (233, 'OCA/0507110001', 1, '00980988', '2011-07-05 14:41:14', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (234, 'RRJ/0507110005', 5, '00151135', '2011-07-05 14:41:25', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (235, 'IGD/0507110005', 5, '00151134', '2011-07-05 14:41:30', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (236, 'OCA/0507110002', 2, '00980988', '2011-07-05 14:41:35', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (237, 'IGD/0507110006', 6, '00151134', '2011-07-05 14:41:55', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (238, 'RRJ/0507110006', 6, '00151135', '2011-07-05 14:42:01', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (239, 'IGD/0507110007', 7, '00151134', '2011-07-05 14:42:05', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (240, 'RRJ/0507110007', 7, '00151135', '2011-07-05 14:42:09', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (241, 'OCA/0507110003', 3, '00980988', '2011-07-05 14:42:13', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (242, 'OCA/0507110004', 4, '00980988', '2011-07-05 14:42:17', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (243, 'OCA/0507110005', 5, '00980988', '2011-07-05 14:42:23', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (244, 'RRJ/0507110008', 8, '00151135', '2011-07-05 14:42:27', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (245, 'IGD/0507110008', 8, '00151134', '2011-07-05 14:43:26', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (246, 'OCA/0507110006', 6, '00980988', '2011-07-05 14:43:34', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (247, 'IGD/0507110009', 9, '00151134', '2011-07-05 14:43:39', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (248, 'IGD/0507110010', 10, '00151134', '2011-07-05 14:43:46', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (249, 'IGD/0507110011', 11, '00151134', '2011-07-05 14:44:06', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (250, 'IGD/0507110012', 12, '00151134', '2011-07-05 14:44:11', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (251, 'IGD/0507110013', 13, '00151134', '2011-07-05 14:44:14', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (252, 'IGD/0507110014', 14, '00151134', '2011-07-05 14:44:18', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (253, 'IGD/0507110015', 15, '00151134', '2011-07-05 14:44:21', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (254, 'RRJ/0507110009', 9, '00151135', '2011-07-05 14:44:26', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (255, 'OCA/0507110007', 7, '00980988', '2011-07-05 14:44:30', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (256, 'IGD/0507110016', 16, '00151134', '2011-07-05 14:45:57', 'UAPT', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (257, 'IGD/0507110017', 17, '00151134', '2011-07-05 15:25:58', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (258, 'RRJ/0507110010', 10, '00151135', '2011-07-05 15:26:03', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (259, 'OCA/0507110008', 8, '00980988', '2011-07-05 15:26:08', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (260, 'IGD/0507110018', 18, '00151134', '2011-07-05 15:26:13', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (261, 'IGD/0507110019', 19, '00151134', '2011-07-05 15:26:18', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (262, 'IGD/0507110020', 20, '00151134', '2011-07-05 20:08:30', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (263, 'IGD/0507110021', 21, '00151134', '2011-07-05 20:11:28', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'IGD');
INSERT INTO `resep_head` VALUES (264, 'RRJ/0507110011', 11, '00151135', '2011-07-05 20:24:24', 'Hardi', '0000-00-00 00:00:00', '', '05/07/2011', 0, NULL, 0, '', '', '', '', 'RAWAT JALAN');
INSERT INTO `resep_head` VALUES (265, 'IGD/0507110022', 22, '00151134', '2011-07-05 22:30:57', 'Hardi', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (266, 'IGD/0507110023', 23, '00151134', '2011-07-05 22:34:24', 'Hardi', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (267, 'IGD/0507110024', 24, '00151134', '2011-07-05 22:35:57', 'Hardi', '0000-00-00 00:00:00', '', '2011/07/05', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (268, 'IGD/0607110025', 25, '00151134', '2011-07-06 00:02:14', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (269, 'IGD/0607110026', 26, '00151134', '2011-07-06 00:05:58', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (270, 'IGD/0607110027', 27, '00151134', '2011-07-06 01:27:48', 'Hardi', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', 'Sudah Dilayani', '');
INSERT INTO `resep_head` VALUES (271, 'OCA/0607110028', 28, '00151134', '2011-07-06 01:32:40', 'Hardi', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (272, 'IGD/0607110028', 28, '00151134', '2011-07-06 03:58:52', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (273, 'OCA/0607110029', 29, '00151134', '2011-07-06 04:45:15', 'UOCA', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (274, 'IGD/0607110029', 29, '00151134', '2011-07-06 05:13:50', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (275, 'IGD/0607110030', 30, '00151134', '2011-07-06 05:18:55', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (276, 'OCA/0607110031', 31, '00151134', '2011-07-06 05:30:19', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (277, 'IGD/0607110031', 31, '00151134', '2011-07-06 05:55:29', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (278, 'IGD/0607110032', 32, '00151134', '2011-07-06 06:07:47', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', '', '');
INSERT INTO `resep_head` VALUES (279, 'IGD/0607110033', 33, '00151134', '2011-07-06 06:23:21', 'UIGD', '0000-00-00 00:00:00', '', '2011/07/06', 51, NULL, 0, '', '', '', 'Sudah Dilayani', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `retur`
-- 

CREATE TABLE `retur` (
  `ID` int(11) NOT NULL auto_increment,
  `No_BTB` varchar(10) default NULL,
  `No_RPB` varchar(20) NOT NULL,
  `param_no` int(7) default '0',
  `Tgl_BTB` varchar(10) default NULL,
  `Tgl_RPB` varchar(10) NOT NULL,
  `Keterangan` text,
  `Tgl_pakai` date NOT NULL,
  `UsrBuat` varchar(5) default NULL,
  `UsrApprove` varchar(5) default NULL,
  `UsrReceived` varchar(255) NOT NULL,
  `Tgl_Cancel` datetime default NULL,
  `Tgl_Received` varchar(10) default NULL,
  `Unit` varchar(10) default NULL,
  `status` int(1) NOT NULL default '5',
  `user_cancel` varchar(100) default NULL,
  `flags_unit` int(1) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `retur`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `satuan`
-- 

CREATE TABLE `satuan` (
  `kd_satuan` varchar(11) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  PRIMARY KEY  (`kd_satuan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `satuan`
-- 

INSERT INTO `satuan` VALUES ('AMP', 'AMP');
INSERT INTO `satuan` VALUES ('BTL', 'Botol');
INSERT INTO `satuan` VALUES ('BOX', 'Box');
INSERT INTO `satuan` VALUES ('BH', 'Buah');
INSERT INTO `satuan` VALUES ('CAP', 'Cap');
INSERT INTO `satuan` VALUES ('CM', 'Centimeter');
INSERT INTO `satuan` VALUES ('DOS', 'Dos');
INSERT INTO `satuan` VALUES ('DROP', 'DROP');
INSERT INTO `satuan` VALUES ('FL', 'FL');
INSERT INTO `satuan` VALUES ('GRAM', 'GRAM');
INSERT INTO `satuan` VALUES ('KAP', 'KAP');
INSERT INTO `satuan` VALUES ('KASET', 'KASET');
INSERT INTO `satuan` VALUES ('KG', 'Kilo Gram');
INSERT INTO `satuan` VALUES ('KPL', 'KPL');
INSERT INTO `satuan` VALUES ('KTK', 'KTK');
INSERT INTO `satuan` VALUES ('LBR', 'Lembar');
INSERT INTO `satuan` VALUES ('MTR', 'Meter');
INSERT INTO `satuan` VALUES ('ML', 'ML');
INSERT INTO `satuan` VALUES ('OVULA', 'OVULA');
INSERT INTO `satuan` VALUES ('PAK', 'PAK');
INSERT INTO `satuan` VALUES ('PCS', 'Pieces');
INSERT INTO `satuan` VALUES ('POT', 'POT');
INSERT INTO `satuan` VALUES ('ROLL', 'Roll');
INSERT INTO `satuan` VALUES ('SAC', 'Sac');
INSERT INTO `satuan` VALUES ('STR', 'Strip');
INSERT INTO `satuan` VALUES ('SUP', 'Supp');
INSERT INTO `satuan` VALUES ('SYR', 'SYR');
INSERT INTO `satuan` VALUES ('TAB', 'TAB');
INSERT INTO `satuan` VALUES ('TUBE', 'Tube');
INSERT INTO `satuan` VALUES ('VIAL', 'VIAL');
INSERT INTO `satuan` VALUES ('YB', 'YB');

-- --------------------------------------------------------

-- 
-- Table structure for table `set_harga`
-- 

CREATE TABLE `set_harga` (
  `id` int(11) unsigned zerofill NOT NULL auto_increment,
  `barang_id` int(11) NOT NULL,
  `exp_date` varchar(10) NOT NULL,
  `po_no` varchar(50) NOT NULL,
  `po_date` datetime default NULL,
  `price_ms_date` datetime default NULL,
  `price_ms` float(14,2) default '0.00',
  `price_po` float(14,2) default '0.00',
  `price_now` float(14,2) default '0.00',
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `updated_datetime` datetime NOT NULL,
  `updated_user` varchar(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `set_harga`
-- 

INSERT INTO `set_harga` VALUES (00000000001, 3, '06/07/2011', 'PON/2806119998', '2011-06-28 00:18:15', '2011-07-06 02:27:58', 30000.00, 8000.00, 0.00, '2011-07-06 02:27:58', 'Jalu', '2011-07-06 02:27:58', 'Jalu');
INSERT INTO `set_harga` VALUES (00000000002, 32, '06/07/2011', 'PON/2806110002', '2011-06-28 04:39:32', '2011-07-06 04:13:56', 5000.00, 1290.00, 0.00, '2011-07-06 04:13:56', 'pospv', '2011-07-06 04:13:56', 'pospv');
INSERT INTO `set_harga` VALUES (00000000003, 31, '', 'PON/2806110001', '2011-06-28 04:39:32', '2011-07-06 04:56:53', 3000.00, 8000.00, 0.00, '2011-07-06 04:56:53', 'pospv', '2011-07-06 04:56:53', 'pospv');

-- --------------------------------------------------------

-- 
-- Table structure for table `spesialisasi`
-- 

CREATE TABLE `spesialisasi` (
  `id` tinyint(3) NOT NULL auto_increment,
  `nama` varchar(25) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `spesialisasi`
-- 

INSERT INTO `spesialisasi` VALUES (1, 'Penyakit Dalam');
INSERT INTO `spesialisasi` VALUES (2, 'Bedah');
INSERT INTO `spesialisasi` VALUES (3, 'Anak');
INSERT INTO `spesialisasi` VALUES (4, 'Obsgyn');
INSERT INTO `spesialisasi` VALUES (5, 'Syaraf');
INSERT INTO `spesialisasi` VALUES (6, 'Jiwa');
INSERT INTO `spesialisasi` VALUES (7, 'THT');
INSERT INTO `spesialisasi` VALUES (8, 'Mata');
INSERT INTO `spesialisasi` VALUES (9, 'Kulit Kelamin');
INSERT INTO `spesialisasi` VALUES (10, 'Umum');
INSERT INTO `spesialisasi` VALUES (11, 'Psikiatri');
INSERT INTO `spesialisasi` VALUES (12, 'Gigi');
INSERT INTO `spesialisasi` VALUES (13, 'Kandungan');
INSERT INTO `spesialisasi` VALUES (14, 'Psikiatri');
INSERT INTO `spesialisasi` VALUES (15, 'Luka Bakar');

-- --------------------------------------------------------

-- 
-- Table structure for table `status`
-- 

CREATE TABLE `status` (
  `id` int(11) NOT NULL auto_increment,
  `param_no` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `f_aktif` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `status`
-- 

INSERT INTO `status` VALUES (1, 1, 'Need Approval', '-', 1);
INSERT INTO `status` VALUES (2, 2, 'Approved', '-', 1);
INSERT INTO `status` VALUES (3, 3, 'Pending', '-', 1);
INSERT INTO `status` VALUES (4, 4, 'Cancel', '-', 1);
INSERT INTO `status` VALUES (5, 5, 'Out Standing', '-', 1);
INSERT INTO `status` VALUES (6, 6, 'Retur', '-', 1);
INSERT INTO `status` VALUES (7, 7, 'Close', '', 1);
INSERT INTO `status` VALUES (8, 8, 'Not Complited', '-', 1);
INSERT INTO `status` VALUES (9, 9, 'Received', '-', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `stok_opname`
-- 

CREATE TABLE `stok_opname` (
  `id` int(11) NOT NULL auto_increment,
  `barang_id` int(11) NOT NULL,
  `stok_ms` float(9,2) NOT NULL default '0.00',
  `stok_apt` float(9,2) NOT NULL default '0.00',
  `stok_rj` float(9,2) NOT NULL default '0.00',
  `stok_ri` float(9,2) NOT NULL default '0.00',
  `stok_igd` float(9,2) NOT NULL default '0.00',
  `stok_oca` float(9,2) NOT NULL default '0.00',
  `jumlah` float(14,2) NOT NULL default '0.00',
  `tgl` varchar(10) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(30) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(30) NOT NULL,
  `fld01` varchar(255) NOT NULL,
  `fld02` varchar(255) NOT NULL,
  `fld03` varchar(255) NOT NULL,
  `fld04` varchar(255) NOT NULL,
  `fld05` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

-- 
-- Dumping data for table `stok_opname`
-- 

INSERT INTO `stok_opname` VALUES (2, 1, -6.00, 5.00, 0.00, 0.00, 0.00, 0.00, -1.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (3, 2, 3.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (4, 3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (5, 4, 144.00, 0.00, 0.00, 0.00, 0.00, 0.00, 144.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (6, 5, -2.00, 1.00, 0.00, 0.00, 0.00, 0.00, -1.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (7, 6, 9.00, 1.00, 0.00, 0.00, 0.00, 0.00, 10.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (8, 7, 500.00, 0.00, 0.00, 0.00, 0.00, 0.00, 500.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (9, 8, 293.00, 0.00, 0.00, 0.00, 0.00, 0.00, 293.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (10, 9, 500.00, 0.00, 0.00, 0.00, 0.00, 0.00, 500.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (11, 10, 293.00, 0.00, 0.00, 0.00, 0.00, 0.00, 293.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (12, 11, 699.00, 0.00, 0.00, 0.00, 0.00, 0.00, 699.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (13, 12, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (14, 13, 640.00, 0.00, 0.00, 0.00, 0.00, 0.00, 640.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (15, 14, 750.00, 0.00, 0.00, 0.00, 0.00, 0.00, 750.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (16, 15, 220.00, 0.00, 0.00, 0.00, 0.00, 0.00, 220.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (17, 16, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (18, 17, 244.00, 0.00, 0.00, 0.00, 0.00, 0.00, 244.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (19, 18, 2420.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2420.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (20, 19, 323.00, 0.00, 0.00, 0.00, 0.00, 0.00, 323.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (21, 20, 300.00, 0.00, 0.00, 0.00, 0.00, 0.00, 300.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (22, 21, 292.00, 0.00, 0.00, 0.00, 0.00, 0.00, 292.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (23, 22, 699.00, 0.00, 0.00, 0.00, 0.00, 0.00, 699.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (24, 23, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (25, 24, 640.00, 0.00, 0.00, 0.00, 0.00, 0.00, 640.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (26, 25, 750.00, 0.00, 0.00, 0.00, 0.00, 0.00, 750.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (27, 26, 220.00, 0.00, 0.00, 0.00, 0.00, 0.00, 220.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (28, 27, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (29, 28, 244.00, 0.00, 0.00, 0.00, 0.00, 0.00, 244.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (30, 29, 2420.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2420.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (31, 30, 323.00, 0.00, 0.00, 0.00, 0.00, 0.00, 323.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (32, 31, 300.00, 0.00, 0.00, 0.00, 0.00, 0.00, 300.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (33, 32, 292.00, 0.00, 0.00, 0.00, 0.00, 0.00, 292.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (34, 33, 499.00, 0.00, 0.00, 0.00, 0.00, 0.00, 499.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (35, 34, 120.00, 0.00, 0.00, 0.00, 0.00, 0.00, 120.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (36, 35, 440.00, 0.00, 0.00, 0.00, 0.00, 0.00, 440.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (37, 36, 550.00, 0.00, 0.00, 0.00, 0.00, 0.00, 550.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (38, 37, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (39, 38, 120.00, 0.00, 0.00, 0.00, 0.00, 0.00, 120.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (40, 39, 44.00, 0.00, 0.00, 0.00, 0.00, 0.00, 44.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (41, 40, 2220.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2220.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (42, 41, 123.00, 0.00, 0.00, 0.00, 0.00, 0.00, 123.00, '04/07/2011', '2011-07-04 15:10:57', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (43, 1, -6.00, 1.00, 0.00, 0.00, 0.00, 0.00, -5.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (44, 2, 3.00, 0.00, 0.00, 0.00, 0.00, 0.00, 3.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (45, 3, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (46, 4, 144.00, 0.00, 0.00, 0.00, 0.00, 0.00, 144.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (47, 5, -2.00, 1.00, 0.00, 0.00, 0.00, 0.00, -1.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (48, 6, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (49, 7, 500.00, 0.00, 0.00, 0.00, 0.00, 0.00, 500.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (50, 8, 293.00, 0.00, 0.00, 0.00, 0.00, 0.00, 293.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (51, 9, 500.00, 0.00, 0.00, 0.00, 0.00, 0.00, 500.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (52, 10, 293.00, 0.00, 0.00, 0.00, 0.00, 0.00, 293.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (53, 11, 699.00, 0.00, 0.00, 0.00, 0.00, 0.00, 699.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (54, 12, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (55, 13, 640.00, 0.00, 0.00, 0.00, 0.00, 0.00, 640.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (56, 14, 750.00, 0.00, 0.00, 0.00, 0.00, 0.00, 750.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (57, 15, 220.00, 0.00, 0.00, 0.00, 0.00, 0.00, 220.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (58, 16, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (59, 17, 244.00, 0.00, 0.00, 0.00, 0.00, 0.00, 244.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (60, 18, 2420.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2420.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (61, 19, 323.00, 0.00, 0.00, 0.00, 0.00, 0.00, 323.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (62, 20, 300.00, 0.00, 0.00, 0.00, 0.00, 0.00, 300.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (63, 21, 292.00, 0.00, 0.00, 0.00, 0.00, 0.00, 292.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (64, 22, 699.00, 0.00, 0.00, 0.00, 0.00, 0.00, 699.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (65, 23, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (66, 24, 640.00, 0.00, 0.00, 0.00, 0.00, 0.00, 640.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (67, 25, 750.00, 0.00, 0.00, 0.00, 0.00, 0.00, 750.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (68, 26, 220.00, 0.00, 0.00, 0.00, 0.00, 0.00, 220.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (69, 27, 320.00, 0.00, 0.00, 0.00, 0.00, 0.00, 320.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (70, 28, 244.00, 0.00, 0.00, 0.00, 0.00, 0.00, 244.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (71, 29, 2420.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2420.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (72, 30, 323.00, 0.00, 0.00, 0.00, 0.00, 0.00, 323.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (73, 31, 300.00, 0.00, 0.00, 0.00, 0.00, 0.00, 300.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (74, 32, 292.00, 0.00, 0.00, 0.00, 0.00, 0.00, 292.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (75, 33, 499.00, 0.00, 0.00, 0.00, 0.00, 0.00, 499.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (76, 34, 120.00, 0.00, 0.00, 0.00, 0.00, 0.00, 120.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (77, 35, 440.00, 0.00, 0.00, 0.00, 0.00, 0.00, 440.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (78, 36, 550.00, 0.00, 0.00, 0.00, 0.00, 0.00, 550.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (79, 37, 20.00, 0.00, 0.00, 0.00, 0.00, 0.00, 20.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (80, 38, 120.00, 0.00, 0.00, 0.00, 0.00, 0.00, 120.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (81, 39, 44.00, 0.00, 0.00, 0.00, 0.00, 0.00, 44.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (82, 40, 2220.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2220.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (83, 41, 123.00, 0.00, 0.00, 0.00, 0.00, 0.00, 123.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (84, 42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');
INSERT INTO `stok_opname` VALUES (85, 43, 0.00, 0.00, 0.00, 0.00, 81.00, 0.00, 81.00, '05/07/2011', '2011-07-05 12:42:19', '', '0000-00-00 00:00:00', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Table structure for table `subspesialisasi`
-- 

CREATE TABLE `subspesialisasi` (
  `id` tinyint(3) NOT NULL auto_increment,
  `spesialisasi_id` tinyint(3) NOT NULL,
  `nama` varchar(25) default NULL,
  PRIMARY KEY  (`id`),
  KEY `spesialisasi_id` (`spesialisasi_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `subspesialisasi`
-- 

INSERT INTO `subspesialisasi` VALUES (1, 1, 'Penyakit Dalam');
INSERT INTO `subspesialisasi` VALUES (2, 2, 'Bedah Umum');
INSERT INTO `subspesialisasi` VALUES (3, 2, 'Bedah Digestif');
INSERT INTO `subspesialisasi` VALUES (4, 2, 'Bedah Thorak');
INSERT INTO `subspesialisasi` VALUES (5, 2, 'Bedah Orthopedi');
INSERT INTO `subspesialisasi` VALUES (6, 2, 'Bedah Anak');
INSERT INTO `subspesialisasi` VALUES (7, 12, 'Gigi');
INSERT INTO `subspesialisasi` VALUES (8, 12, 'Bedah Mulut');
INSERT INTO `subspesialisasi` VALUES (9, 8, 'Mata');
INSERT INTO `subspesialisasi` VALUES (10, 4, 'Obsgyn');
INSERT INTO `subspesialisasi` VALUES (11, 5, 'Syaraf');
INSERT INTO `subspesialisasi` VALUES (12, 3, 'Anak');
INSERT INTO `subspesialisasi` VALUES (13, 9, 'Kulit Kelamin');
INSERT INTO `subspesialisasi` VALUES (14, 7, 'THT');
INSERT INTO `subspesialisasi` VALUES (15, 6, 'Jiwa');
INSERT INTO `subspesialisasi` VALUES (16, 10, 'Umum');

-- --------------------------------------------------------

-- 
-- Table structure for table `tbl_menu`
-- 

CREATE TABLE `tbl_menu` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(100) NOT NULL,
  `name_menu` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `flags` bit(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `Menu` int(11) NOT NULL,
  `fld01` varchar(11) default '0',
  `fld02` varchar(11) default '0',
  `fld03` varchar(11) default '0',
  `fld04` varchar(255) default '0',
  `Link` varchar(50) default 'content/#',
  `group_id` int(11) default NULL,
  `fld07` int(11) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `f_aktif` int(11) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

-- 
-- Dumping data for table `tbl_menu`
-- 

INSERT INTO `tbl_menu` VALUES (1, 'MFRM', 'Farmasi', '-', '', '2011-06-26 03:37:23', '', '2011-06-27 15:45:43', '', 1, '0', '0', '0', '0', 'content/daftar_dokumen_farmasi', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (2, 'MAPT', 'Apotik', '-', '', '2011-06-26 03:49:32', '', '2011-06-25 23:28:31', '', 1, '0', '0', '0', '0', 'content/list_spp', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (3, 'MGDG', 'List Permintaan Pembelian', '-', '', '2011-06-26 03:50:09', '', '2011-06-27 15:50:14', '', 2, '1', '1', '1', '0', 'content/ps', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (4, 'MRWJ', 'Rawat Jalan', '-', '', '2011-06-26 03:56:49', '', '2011-06-29 00:06:39', '', 1, '0', '0', '0', '0', 'content/list_spp', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (5, 'MPOR', 'Purchasing', '-', '', '2011-06-26 03:59:52', '', '2011-06-27 15:50:34', '', 1, '0', '0', '0', '0', 'content/#', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (6, 'MKSR', 'Kasir', '-', '', '2011-06-26 04:00:30', '', '2011-07-01 23:13:42', '', 1, '0', '0', '0', '0', 'content/menu_kasir', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (7, 'MDMR', 'Data Master', '-', '', '2011-06-26 04:01:57', '', '0000-00-00 00:00:00', '', 2, '1', '53', '0', '0', 'content/#', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (8, 'MSTP', 'Setup', '-', '', '2011-06-26 04:02:22', '', '0000-00-00 00:00:00', '', 2, '1', '53', '0', '0', 'content/#', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (9, 'MMNU', 'Master Daftar Menu', '-', '', '2011-06-26 04:03:21', '', '2011-06-27 19:00:30', '', 3, '1', '53', '8', '2', 'setup/tbl_menu', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (11, 'MMTU', 'Master Pelayanan', '-', '', '2011-06-26 04:53:17', '', '2011-06-28 17:23:32', '', 3, '1', '53', '7', '0', 'content/unit', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (12, 'MGRB', 'Master Group Barang', '-', '', '2011-06-26 04:59:23', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/group_barang', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (13, 'MJOB', 'Master Jenis Obat', '-', '', '2011-06-26 05:01:22', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/jenis_obat', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (14, 'MTOB', 'Master Type Obat', '-', '', '2011-06-26 05:02:41', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/jenis_obat', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (15, 'MGOB', 'Master Golongan Obat', '-', '', '2011-06-26 05:03:41', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/golongan_obat', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (16, 'MGNO', 'Master Guna Obat', '-', '', '2011-06-26 05:05:03', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/guna_obat', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (17, 'MKSI', 'Master Kla.Inventory', '-', '', '2011-06-26 05:06:45', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/klasifikasi_inventory', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (18, 'MDOB', 'Master Dosis', '-', '', '2011-06-26 05:07:56', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/dosis', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (19, 'MSTN', 'Master Satuan', '-', '', '2011-06-26 05:09:05', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/satuan', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (20, 'MUSR', 'Master User ', '-', '', '2011-06-26 05:11:11', '', '2011-06-28 14:58:18', '', 3, '1', '53', '8', '0', 'setup/user_access_level', 0, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (21, 'MPBF', 'Master PBF', '-', '', '2011-06-26 05:21:16', '', '0000-00-00 00:00:00', '', 3, '1', '53', '7', '0', 'content/pbf', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (22, 'MUAC', 'Master Type Access Level', '-', '', '2011-06-26 05:46:13', '', '2011-06-28 14:57:22', '', 3, '1', '53', '8', '0', 'setup/leveling_akses', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (23, 'MGRD', 'Master Group Dept', '-', '', '2011-06-26 05:50:02', '', '2011-06-26 05:18:20', '', 3, '1', '53', '8', '0', 'setup/user_group', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (25, 'MLSP', 'List Permintaan', '-', '', '2011-06-26 06:27:04', '', '2011-06-26 10:27:40', '', 2, '1', '5', '0', '0', 'content/list_spb_grid', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (27, 'MNPO', 'Manual PO', '-', '', '2011-06-26 06:29:39', '', '2011-06-27 03:10:52', '', 2, '1', '5', '0', '0', 'content/po_processing', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (28, 'MRCO', 'Penerimaan Order', '-', '', '2011-06-26 06:30:55', '', '2011-06-29 03:38:15', '', 2, '1', '5', '0', '0', 'content/list_po', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (29, 'MNRT', 'Retur Pembelian', '-', '', '2011-06-26 06:31:50', '', '2011-06-29 03:39:01', '', 2, '1', '5', '0', '0', 'content/list_po', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (30, 'MACC', 'Keuangan', '-', '', '2011-06-26 06:36:14', '', '2011-07-05 14:17:17', '', 1, '0', '0', '0', '0', 'content/#', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (31, 'MRQO', 'Permintaan Pembelian', '-', '', '2011-06-26 06:43:06', '', '2011-06-30 23:42:39', '', 2, '1', '1', '0', '0', 'content/mr', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (32, 'MLPO', 'List Purchase Order', '-', '', '2011-06-26 06:44:26', '', '2011-06-27 03:06:57', '', 2, '1', '5', '0', '0', 'content/list_po', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (34, 'MPNO', 'Bukti Penerimaan Barang/ Obat', '-', '', '2011-06-26 06:47:39', '', '2011-06-26 11:09:24', '', 2, '1', '1', '0', '0', 'content/#', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (35, 'MRNT', 'Margin Tunai', '-', '', '2011-06-26 06:49:06', '', '2011-06-26 05:53:10', '', 2, '1', '30', '0', '0', 'content/margin_tunai', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (36, 'MPLO', 'Bukti Pengeluaran Barang/ Obat', '-', '', '2011-06-26 06:49:20', '', '2011-06-26 11:10:28', '', 2, '1', '1', '0', '0', 'content/#', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (38, 'MRNT', 'Margin', '-', '', '2011-06-26 06:52:11', '', '2011-06-28 14:30:13', '', 2, '1', '30', '0', '0', 'content/margin', 0, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (49, 'MGRU', 'Master Group Unit', '-', '', '2011-06-26 04:43:24', '', '2011-06-27 21:09:33', '', 3, '1', '53', '7', '0', 'content/group_unit', 0, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (41, 'MRSTO', 'Bukti Penerimaan Stok', '-', '', '2011-06-26 06:56:30', '', '2011-06-30 21:59:47', '', 2, '1', '2', '0', '0', 'content/list_BTB', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (48, 'MSGU', 'Stock Gudang Rawat Jalan', '-', '', '2011-06-26 01:33:47', '', '2011-06-28 00:13:44', '', 2, '1', '4', '0', '0', 'content/daftar_barang_unit', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (44, 'MSTGA', 'Stok Gudang Apotek', '-', '', '2011-06-26 07:14:38', '', '2011-06-27 16:37:16', '', 2, '1', '2', '0', '0', 'content/daftar_barang_unit', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (47, 'MBPU', 'Bukti Penerimaan Stok', '-', '', '2011-06-26 01:21:45', '', '2011-06-30 22:40:13', '', 2, '1', '4', '0', '0', 'content/list_BTB', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (46, 'MTYI', 'Master Type Accsess', '-', '', '2011-06-26 11:36:49', '', '0000-00-00 00:00:00', '', 3, '1', '53', '8', '0', 'setup/user_type', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (50, 'MRTI', 'Rawat Inap', '-', '', '2011-06-26 11:50:40', '', '2011-06-29 00:07:26', '', 1, '0', '0', '0', '0', 'content/list_spp', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (51, 'MIGD', 'IGD', '-', '', '2011-06-26 11:51:00', '', '2011-07-06 07:16:47', '', 1, '0', '0', '0', '0', 'content/list_spp_igd', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (52, 'MOCA', 'OCA (Ruang Tindakan)', '-', '', '2011-06-26 11:51:51', '', '2011-07-06 07:17:19', '', 1, '0', '0', '0', '0', 'content/list_spp_oca', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (53, 'MADM', 'Administrator', '-', '', '2011-06-26 02:29:27', '', '2011-07-06 06:05:16', '', 1, '0', '0', '0', '0', 'content/Admin', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (54, 'MRSP', 'Input Resep', '-', '', '2011-06-26 03:41:25', '', '0000-00-00 00:00:00', '', 2, '1', '2', '39', '0', 'content/pasien', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (62, 'MLPS', 'List Permintaan Stock Unit', '-', '', '2011-06-27 04:53:00', '', '2011-06-29 03:30:32', '', 2, '1', '1', '0', '0', 'content/distribusi_obat', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (66, 'MSIG', 'Stock Gudang IGD', '-', '', '2011-06-28 12:56:59', '', '2011-07-06 07:05:39', '', 2, '1', '51', '0', '0', 'content/daftar_barang_igd', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (65, 'MSRI', 'Stock Gudang Rawat Inap', '-', '', '2011-06-28 12:55:27', '', '0000-00-00 00:00:00', '', 2, '1', '50', '0', '0', 'content/daftar_barang_unit', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (67, 'MSOC', 'Stock Gudang OCA', '-', '', '2011-06-28 12:58:56', '', '2011-07-06 07:19:17', '', 2, '1', '52', '0', '0', 'content/daftar_barang_oca', 0, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (68, 'MTOM', 'Master Otoritas Menu', '-', '', '2011-06-28 04:21:45', '', '2011-06-28 15:28:43', '', 3, '1', '53', '8', '0', 'setup/Otoritas_Menu', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (69, 'MRLB', 'List Retur Barang', '-', '', '2011-07-01 01:26:41', '', '0000-00-00 00:00:00', '', 2, '1', '4', '0', '0', 'content/list_retur', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (72, 'MSOP', 'Stok Opname', '-', '', '2011-07-04 05:24:29', '', '2011-07-04 22:51:52', '', 2, '1', '1', '0', '0', 'content/stok_opname', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (71, 'MLRA', 'List Retur Barang', '-', '', '2011-07-02 02:47:01', '', '0000-00-00 00:00:00', '', 2, '1', '2', '0', '0', 'content/list_retur', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (73, 'MLBF', 'List Barang', '-', '', '2011-07-04 09:43:09', '', '0000-00-00 00:00:00', '', 2, '1', '1', '0', '0', 'content/daftar_barang', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (74, 'MLPS', 'List Permintaan Stock Unit', '-', '', '2011-07-04 11:06:28', '', '2011-07-04 22:15:17', '', 2, '1', '2', '0', '0', 'content/distribusi_obat&ket_status=1', 2, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (75, 'MIRI', 'Input Resep', '-', '', '2011-07-06 07:51:46', '', '0000-00-00 00:00:00', '', 2, '1', '51', '0', '0', 'content/resep_reg_igd', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (76, 'MIGB', 'Bukti Penerimaan Stok', '-', '', '2011-07-06 07:57:13', '', '0000-00-00 00:00:00', '', 2, '1', '51', '0', '0', 'content/list_btb_igd', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (77, 'MOCI', 'Input Resep', '-', '', '2011-07-06 08:11:24', '', '0000-00-00 00:00:00', '', 2, '1', '52', '0', '0', 'content/resep_reg_oca', 1, NULL, NULL, NULL, 1);
INSERT INTO `tbl_menu` VALUES (78, 'MOCB', 'Bukti Penerimaan Stok', '-', '', '2011-07-06 08:14:17', '', '0000-00-00 00:00:00', '', 2, '1', '52', '0', '0', 'content/list_btb_oca', 1, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `tipe_obat`
-- 

CREATE TABLE `tipe_obat` (
  `id` int(11) NOT NULL auto_increment,
  `kd_tipe_obat` varchar(15) NOT NULL,
  `nama_tipe_obat` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`,`kd_tipe_obat`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `tipe_obat`
-- 

INSERT INTO `tipe_obat` VALUES (1, 'STD', 'DOSP');
INSERT INTO `tipe_obat` VALUES (3, 'NSTD', 'Non - DOSP');

-- --------------------------------------------------------

-- 
-- Table structure for table `unit`
-- 

CREATE TABLE `unit` (
  `id` int(11) NOT NULL auto_increment,
  `kd_unit` varchar(20) NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `status` varchar(40) default NULL,
  `flags` tinyint(1) NOT NULL default '1',
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  PRIMARY KEY  (`id`,`kd_unit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- 
-- Dumping data for table `unit`
-- 

INSERT INTO `unit` VALUES (1, '01', 'UNIT 01', 'AKTIF', 1, '2011-06-26 03:57:02', 'JL', '2011-06-26 03:57:02', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (2, '02', 'UNIT 02', 'AKTIF', 1, '2011-06-26 03:57:09', 'JL', '2011-06-26 03:57:09', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (3, '03', 'UNIT 03', 'AKTIF', 1, '2011-06-26 03:57:16', 'JL', '2011-06-26 03:57:16', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (4, '04', 'UNIT 04', 'AKTIF', 1, '2011-06-26 03:57:20', 'JL', '2011-06-26 03:57:20', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (5, '05', 'UNIT 05', 'AKTIF', 1, '2011-06-26 03:57:25', 'JL', '2011-06-26 03:57:25', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (6, '06', 'UNIT 06', 'AKTIF', 1, '2011-06-26 03:57:32', 'JL', '2011-06-26 03:57:32', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (7, '07', 'UNIT 07', 'AKTIF', 1, '2011-06-26 03:57:37', 'JL', '2011-06-26 03:57:37', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (8, '08', 'UNIT 08', 'AKTIF', 1, '2011-06-26 03:57:42', 'JL', '2011-06-26 03:57:42', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (9, '09', 'UNIT 09', 'AKTIF', 1, '2011-06-26 03:57:46', 'JL', '2011-06-26 03:57:46', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (10, '10', 'UNIT 10', 'AKTIF', 1, '2011-06-26 03:57:52', 'JL', '2011-06-26 03:57:52', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (11, '11', 'UNIT 11', 'AKTIF', 1, '2011-06-26 03:57:56', 'JL', '2011-06-26 03:57:56', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (12, '12', 'UNIT 12', 'AKTIF', 1, '2011-06-26 03:58:00', 'JL', '2011-06-26 03:58:00', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (13, '13', 'UNIT 13', 'AKTIF', 1, '2011-06-26 03:58:04', 'JL', '2011-06-26 03:58:04', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (14, '14', 'UNIT 14', 'AKTIF', 1, '2011-06-26 03:58:08', 'JL', '2011-06-26 03:58:08', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (15, '15', 'UNIT 15', 'AKTIF', 1, '2011-06-26 03:58:12', 'JL', '2011-06-26 03:58:12', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (16, '16', 'UNIT 16', 'AKTIF', 1, '2011-06-26 03:58:16', 'JL', '2011-06-26 03:58:16', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (17, '17', 'UNIT 17', 'AKTIF', 1, '2011-06-26 03:58:20', 'JL', '2011-06-26 03:58:20', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (18, '18', 'UNIT 18', 'AKTIF', 1, '2011-06-26 03:58:24', 'JL', '2011-06-26 03:58:24', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (19, '19', 'UNIT 19', 'AKTIF', 1, '2011-06-26 03:58:28', 'JL', '2011-06-26 03:58:28', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `unit` VALUES (20, '20', 'UNIT 20', 'AKTIF', 1, '2011-06-26 03:58:33', 'JL', '2011-06-26 03:58:33', 'JL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `type_id` int(20) NOT NULL,
  `group_id` varchar(20) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `nm_user` varchar(100) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `jns_kel` varchar(255) NOT NULL,
  `Ket` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `status_aktifasi` int(11) NOT NULL,
  `unit_id` varchar(255) NOT NULL,
  `param_no` int(11) NOT NULL,
  `sub_unit` int(11) NOT NULL,
  `f_login` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- 
-- Dumping data for table `user`
-- 

INSERT INTO `user` VALUES (4, 3, '3', '2011-06-26 16:57:38', 'angga', '2011-06-26 19:38:52', 'Hardiasnyah', 'USR0001', 'Hardi', '25d55ad283aa400af464c76d713c07ad', 'L', 'Administrator', 'angga', 1, '', 1, 0, 1);
INSERT INTO `user` VALUES (5, 3, '', '2011-06-26 19:33:39', 'angga', '2011-07-01 04:04:34', 'Jalu', 'USR0002', 'Jalu', '25d55ad283aa400af464c76d713c07ad', 'L', 'Administrator', 'J.a Pambudi', 1, '', 2, 0, 1);
INSERT INTO `user` VALUES (11, 2, '2', '2011-06-26 10:02:15', 'Hardi', '2011-06-28 04:45:44', 'Hardi', 'USR0003', 'Richard', '25d55ad283aa400af464c76d713c07ad', 'L', 'Operator', 'Richard SAM', 1, '4', 3, 0, 0);
INSERT INTO `user` VALUES (28, 2, '2', '2011-06-28 23:25:46', 'Hardi', '0000-00-00 00:00:00', '', 'USR0005', 'UFRM', '25d55ad283aa400af464c76d713c07ad', 'P', 'Operator', 'User Farmasi', 1, '1', 5, 95, 0);
INSERT INTO `user` VALUES (27, 2, '2', '2011-06-28 22:29:20', 'Hardi', '2011-06-29 05:05:54', 'Hardi', 'USR0004', 'UAPT', '25d55ad283aa400af464c76d713c07ad', 'L', 'Operator', 'User Apotik', 1, '2', 4, 93, 0);
INSERT INTO `user` VALUES (29, 2, '1', '2011-06-29 00:09:35', 'Hardi', '0000-00-00 00:00:00', '', 'USR0006', 'angga', '25d55ad283aa400af464c76d713c07ad', 'L', 'Operator', 'angga gitu dech', 1, '4', 6, 9, 0);
INSERT INTO `user` VALUES (30, 2, '1', '2011-06-30 21:06:05', 'Hardi', '0000-00-00 00:00:00', '', 'USR0007', 'URWJ', '25d55ad283aa400af464c76d713c07ad', 'P', 'Operator', 'User Rawat Jalan', 1, '4', 7, 3, 0);
INSERT INTO `user` VALUES (31, 2, '2', '2011-07-01 01:30:54', 'Jalu', '0000-00-00 00:00:00', '', 'USR0008', 'po01', '25d55ad283aa400af464c76d713c07ad', 'L', 'Operator', 'Purchasing 01', 1, '5', 8, 97, 0);
INSERT INTO `user` VALUES (33, 2, '1', '2011-07-05 01:47:14', 'Hardi', '0000-00-00 00:00:00', '', 'USR0010', 'UIGD', '25d55ad283aa400af464c76d713c07ad', 'L', 'Operator', 'UIGD', 1, '51', 10, 1, 0);
INSERT INTO `user` VALUES (32, 4, '2', '2011-07-01 03:58:56', 'Jalu', '0000-00-00 00:00:00', '', 'USR0009', 'pospv', '25d55ad283aa400af464c76d713c07ad', 'P', 'Supervisor', 'Purchasing Supervisor', 1, '5', 9, 1, 0);
INSERT INTO `user` VALUES (34, 2, '1', '2011-07-06 04:25:32', 'Hardi', '0000-00-00 00:00:00', '', 'USR0011', 'UOCA', '25d55ad283aa400af464c76d713c07ad', 'L', 'Operator', 'UOCA', 1, '52', 11, 80, 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `user_group`
-- 

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL auto_increment,
  `group_code` varchar(20) NOT NULL,
  `name_group` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `flags` bit(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `type_id` varchar(20) NOT NULL,
  `lv_id` varchar(20) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `user_group`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `user_type`
-- 

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL auto_increment,
  `type_code` varchar(100) NOT NULL,
  `name_access` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `flags` bit(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` varchar(255) default NULL,
  `fld02` varchar(255) default NULL,
  `fld03` varchar(255) default NULL,
  `fld04` varchar(255) default NULL,
  `fld05` varchar(255) default NULL,
  `fld06` varchar(255) default NULL,
  `fld07` varchar(255) default NULL,
  `fld08` varchar(255) default NULL,
  `fld09` varchar(255) default NULL,
  `fld10` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `user_type`
-- 

INSERT INTO `user_type` VALUES (2, 'OPR', 'Operator', '-', '', '2011-06-26 10:38:54', 'angga', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user_type` VALUES (3, 'ADM', 'Administrator', '-', '', '2011-06-26 10:39:09', 'angga', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user_type` VALUES (4, 'SPV', 'Supervisor', '-', '', '2011-06-26 10:39:20', 'angga', '0000-00-00 00:00:00', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

-- 
-- Stand-in structure for view `v_spb_list`
-- 
CREATE TABLE `v_spb_list` (
`id` int(11)
,`spb_no` varchar(50)
,`tgl_req` varchar(10)
,`request_by` varchar(50)
,`status` char(3)
,`po_created` int(1)
);
-- --------------------------------------------------------

-- 
-- Structure for view `v_spb_list`
-- 
DROP TABLE IF EXISTS `v_spb_list`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `db_apotek`.`v_spb_list` AS select distinct `a`.`id` AS `id`,`a`.`spb_no` AS `spb_no`,`a`.`tgl_req` AS `tgl_req`,`a`.`created_user` AS `request_by`,`b`.`status_approval` AS `status`,`b`.`is_po` AS `po_created` from (`db_apotek`.`head_spb` `a` join `db_apotek`.`detail_spb` `b` on((`a`.`spb_no` = `b`.`spb_no`)));
