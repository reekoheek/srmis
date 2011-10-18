use db_apotek;

DROP TABLE IF EXISTS `coa`;
CREATE TABLE `coa` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `coa_code` char(11)unsigned zerofill NOT NULL Default '00-00-00000',
  `coa_shortname` varchar (70) NOT NULL,
  `coa_name` varchar(255) NOT NULL,
  `coa_hd` Enum('H','D') NOT NULL,
  `coa_parent` varchar(1) NOT NULL,
  `coa_level` varchar(1) NOT NULL,
  `coa_type` ENUM('Assets', 'liability', 'Equity','Revenue', 'COGS', 'Expense', 'Other Revenue', 'Other Expense' ) NOT NULL,
  `coa_dk` ENUM('D','K') NOT NULL,
  `coa_nl` Enum('Nr','LR') not null,
  `coa_flags` bit(1) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` double default NULL,
  `fld02` double default NULL,
  `fld03` varchar(50) default NULL,
  `fld04` varchar(100) default NULL,
  `fld05` varchar(255) default NULL,

  PRIMARY KEY  (`id`, `coa_code`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `saldo_awal`;
CREATE TABLE `saldo_awal` (
  `id` int(11) unsigned not null auto_increment,
  `sa_year` char(4) not null default '2005',
  `sa_coa_id` int(11) not null,
  `sa_ammount` double not null default 0,
  `sa_flags` bit(1) not null default 1,
  `created_datetime` datetime NOT NULL,
  `created_user` varchar(20) NOT NULL,
  `update_datetime` datetime NOT NULL,
  `update_user` varchar(20) NOT NULL,
  `fld01` double default NULL,
  `fld02` double default NULL,
  `fld03` varchar(50) default NULL,
  `fld04` varchar(100) default NULL,
  `fld05` varchar(255) default NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

