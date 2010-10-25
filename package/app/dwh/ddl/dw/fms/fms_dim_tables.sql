USE `kalturadw`;

/*Table structure for table `dwh_dim_fms_adaptor` */

CREATE TABLE `dwh_dim_fms_adaptor` (
  `adaptor_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adaptor` varchar(45) NOT NULL,
  PRIMARY KEY (`adaptor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_app` */

CREATE TABLE `dwh_dim_fms_app` (
  `app_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app` varchar(45) NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_app_instance` */

CREATE TABLE `dwh_dim_fms_app_instance` (
  `app_instance_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_instance` varchar(500) NOT NULL,
  PRIMARY KEY (`app_instance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_client_protocol` */

CREATE TABLE `dwh_dim_fms_client_protocol` (
  `client_protocol_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_protocol` varchar(45) NOT NULL,
  PRIMARY KEY (`client_protocol_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_event_category` */

CREATE TABLE `dwh_dim_fms_event_category` (
  `event_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_category` varchar(45) NOT NULL,
  PRIMARY KEY (`event_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_event_type` */

CREATE TABLE `dwh_dim_fms_event_type` (
  `event_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_type` varchar(45) NOT NULL,
  PRIMARY KEY (`event_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_status_description` */

CREATE TABLE `dwh_dim_fms_status_description` (
  `status_description_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_description` varchar(300) DEFAULT '<unset status>',
  `status_number` smallint(3) unsigned DEFAULT NULL,
  `event_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`status_description_id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_stream_type` */

CREATE TABLE `dwh_dim_fms_stream_type` (
  `stream_type_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stream_type` varchar(45) NOT NULL,
  PRIMARY KEY (`stream_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_virtual_host` */

CREATE TABLE `dwh_dim_fms_virtual_host` (
  `virtual_host_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `virtual_host` varchar(45) NOT NULL,
  PRIMARY KEY (`virtual_host_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
