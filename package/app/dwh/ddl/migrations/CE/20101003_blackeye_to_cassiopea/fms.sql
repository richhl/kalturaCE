USE `kalturadw`;

ALTER TABLE `dwh_aggr_partner`
ADD COLUMN `count_streaming` BIGINT(20) DEFAULT '0',
ADD COLUMN `aggr_streaming` BIGINT(20) DEFAULT '0';

ALTER TABLE `dwh_aggr_partner_daily_usage`
ADD COLUMN  `sum_streaming_mb` BIGINT(20) DEFAULT '0';

ALTER TABLE `dwh_dim_editor_type`
ADD KEY `editor_type_name_index` (`editor_type_name`);

ALTER TABLE `dwh_dim_entries`
ADD FULLTEXT KEY `search_text_index` (`search_text`);

CREATE TABLE `dwh_dim_fms_adaptor` (
  `adaptor_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `adaptor` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`adaptor_id`)
) ENGINE=MYISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_app` */

CREATE TABLE `dwh_dim_fms_app` (
  `app_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `app` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`app_id`)
) ENGINE=MYISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_app_instance` */

CREATE TABLE `dwh_dim_fms_app_instance` (
  `app_instance_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_instance` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`app_instance_id`)
) ENGINE=MYISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_client_protocol` */

CREATE TABLE `dwh_dim_fms_client_protocol` (
  `client_protocol_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_protocol` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`client_protocol_id`)
) ENGINE=MYISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_event_category` */

CREATE TABLE `dwh_dim_fms_event_category` (
  `event_category_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_category` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`event_category_id`)
) ENGINE=MYISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_event_type` */

CREATE TABLE `dwh_dim_fms_event_type` (
  `event_type_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`event_type_id`)
) ENGINE=MYISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_status_description` */

CREATE TABLE `dwh_dim_fms_status_description` (
  `status_description_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_description` VARCHAR(300) DEFAULT '<unset status>',
  `status_number` SMALLINT(3) UNSIGNED DEFAULT NULL,
  `event_type` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`status_description_id`)
) ENGINE=MYISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_stream_type` */

CREATE TABLE `dwh_dim_fms_stream_type` (
  `stream_type_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `stream_type` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`stream_type_id`)
) ENGINE=MYISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Table structure for table `dwh_dim_fms_virtual_host` */

CREATE TABLE `dwh_dim_fms_virtual_host` (
  `virtual_host_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `virtual_host` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`virtual_host_id`)
) ENGINE=MYISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

ALTER TABLE `dwh_dim_ip_ranges`
ADD UNIQUE KEY `ip_ranges_from_country` (`IP_FROM`,`country_id`,`location_id`);

CREATE TABLE `dwh_dim_partner_aliases` (
  `partner_aliases_id` INT(11) NOT NULL AUTO_INCREMENT,
  `partner_alias` INT(11) NOT NULL,
  `primary_partner` INT(11) NOT NULL,
  `dwh_creation_date` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dwh_update_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`partner_aliases_id`),
  UNIQUE KEY `partner_alias_indx` (`partner_alias`),
  KEY `primary_partner_indx` (`primary_partner`)
) ENGINE=MYISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

ALTER TABLE `dwh_dim_partners`
ADD KEY `partner_package_indx` (`partner_package`,`partner_id`,`partner_name`);

CREATE TABLE `dwh_fact_fms_session_events` (
  `file_id` INT(11) UNSIGNED NOT NULL,
  `event_type_id` TINYINT(3) UNSIGNED NOT NULL,
  `event_category_id` TINYINT(3) UNSIGNED NOT NULL,
  `event_time` DATETIME NOT NULL,
  `event_time_tz` VARCHAR(3) NOT NULL,
  `event_date_id` INT(11) NOT NULL,
  `event_hour_id` TINYINT(3) NOT NULL,
  `context` VARCHAR(100) DEFAULT NULL,
  `entry_id` VARCHAR(20) DEFAULT NULL,
  `partner_id` INT(10) DEFAULT NULL,
  `external_id` VARCHAR(50) DEFAULT NULL,
  `server_ip` INT(10) UNSIGNED DEFAULT NULL,
  `server_process_id` INT(10) UNSIGNED NOT NULL,
  `server_cpu_load` SMALLINT(5) UNSIGNED NOT NULL,
  `server_memory_load` SMALLINT(5) UNSIGNED NOT NULL,
  `adaptor_id` SMALLINT(5) UNSIGNED NOT NULL,
  `virtual_host_id` SMALLINT(5) UNSIGNED NOT NULL,
  `app_id` TINYINT(3) UNSIGNED NOT NULL,
  `app_instance_id` TINYINT(3) UNSIGNED NOT NULL,
  `duration_secs` INT(10) UNSIGNED NOT NULL,
  `status_id` SMALLINT(3) UNSIGNED DEFAULT NULL,
  `status_desc_id` TINYINT(3) UNSIGNED NOT NULL,
  `client_ip_str` VARCHAR(15) NOT NULL,
  `client_ip` INT(10) UNSIGNED NOT NULL,
  `client_country_id` INT(10) UNSIGNED DEFAULT '0',
  `client_location_id` INT(10) UNSIGNED DEFAULT '0',
  `client_protocol_id` TINYINT(3) UNSIGNED NOT NULL,
  `uri` VARCHAR(4000) NOT NULL,
  `uri_stem` VARCHAR(2000) DEFAULT NULL,
  `uri_query` VARCHAR(2000) DEFAULT NULL,
  `referrer` VARCHAR(4000) DEFAULT NULL,
  `user_agent` VARCHAR(2000) DEFAULT NULL,
  `session_id` VARCHAR(20) NOT NULL,
  `client_to_server_bytes` BIGINT(20) UNSIGNED NOT NULL,
  `server_to_client_bytes` BIGINT(20) UNSIGNED NOT NULL,
  `stream_name` VARCHAR(50) DEFAULT NULL,
  `stream_query` VARCHAR(50) DEFAULT NULL,
  `stream_file_name` VARCHAR(4000) DEFAULT NULL,
  `stream_type_id` TINYINT(3) UNSIGNED DEFAULT NULL,
  `stream_size_bytes` INT(11) DEFAULT NULL,
  `stream_length_secs` INT(11) DEFAULT NULL,
  `stream_position` INT(11) DEFAULT NULL,
  `client_to_server_stream_bytes` INT(10) UNSIGNED DEFAULT NULL,
  `server_to_client_stream_bytes` INT(10) UNSIGNED DEFAULT NULL,
  `server_to_client_qos_bytes` INT(10) UNSIGNED DEFAULT NULL,
  KEY `partner_id_event_type_id_time` (`partner_id`,`event_type_id`,`event_time`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY RANGE (TO_DAYS(event_time))
(PARTITION p_201001 VALUES LESS THAN (734169) ENGINE = MyISAM,
 PARTITION p_201002 VALUES LESS THAN (734197) ENGINE = MyISAM,
 PARTITION p_201003 VALUES LESS THAN (734228) ENGINE = MyISAM,
 PARTITION p_201004 VALUES LESS THAN (734258) ENGINE = MyISAM,
 PARTITION p_201005 VALUES LESS THAN (734289) ENGINE = MyISAM,
 PARTITION p_201006 VALUES LESS THAN (734319) ENGINE = MyISAM,
 PARTITION p_201007 VALUES LESS THAN (734350) ENGINE = MyISAM,
 PARTITION p_201008 VALUES LESS THAN (734381) ENGINE = MyISAM,
 PARTITION p_201009 VALUES LESS THAN (734411) ENGINE = MyISAM,
 PARTITION p_201010 VALUES LESS THAN (734442) ENGINE = MyISAM,
 PARTITION p_201011 VALUES LESS THAN (734472) ENGINE = MyISAM) */;

 CREATE TABLE `dwh_fact_fms_sessions` (
  `session_id` VARCHAR(20) NOT NULL,
  `session_time` DATETIME NOT NULL,
  `session_date_id` INT(11) UNSIGNED DEFAULT NULL,
  `session_partner_id` INT(10) UNSIGNED DEFAULT NULL,
  `total_bytes` BIGINT(20) UNSIGNED DEFAULT NULL
) ENGINE=MYISAM DEFAULT CHARSET=latin1
/*!50100 PARTITION BY RANGE (TO_DAYS(session_time))
(PARTITION p_201001 VALUES LESS THAN (734169) ENGINE = MyISAM,
 PARTITION p_201002 VALUES LESS THAN (734197) ENGINE = MyISAM,
 PARTITION p_201003 VALUES LESS THAN (734228) ENGINE = MyISAM,
 PARTITION p_201004 VALUES LESS THAN (734258) ENGINE = MyISAM,
 PARTITION p_201005 VALUES LESS THAN (734289) ENGINE = MyISAM,
 PARTITION p_201006 VALUES LESS THAN (734319) ENGINE = MyISAM,
 PARTITION p_201007 VALUES LESS THAN (734350) ENGINE = MyISAM,
 PARTITION p_201008 VALUES LESS THAN (734381) ENGINE = MyISAM,
 PARTITION p_201009 VALUES LESS THAN (734411) ENGINE = MyISAM,
 PARTITION p_201010 VALUES LESS THAN (734442) ENGINE = MyISAM,
 PARTITION p_201011 VALUES LESS THAN (734472) ENGINE = MyISAM) */;

 CREATE TABLE `dwh_report_subject` (
  `report_subject` VARCHAR(20) NOT NULL,
  `report_subject_id` INT(2) NOT NULL
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/* Trigger structure for table `dwh_dim_control` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_control_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_control_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_control` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_domain` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_domain_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_domain_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_domain` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_editor_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_editor_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_editor_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_editor_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entries_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_entries_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entries` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_media_source` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_media_source_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_entry_media_source_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_media_source` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_media_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_media_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_entry_media_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_media_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_entry_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_entry_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_gender` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_gender_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_gender_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_gender` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_kusers` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_kusers_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_kusers_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_kusers` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_locations` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_locations_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_locations_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_locations` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_moderation_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_moderation_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_moderation_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_moderation_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_activity` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_activity_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_partner_activity_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_activity` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_aliases` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_aliases_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_partner_aliases_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_aliases` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_group_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_group_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_partner_group_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_group_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_partner_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_sub_activity` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_sub_activity_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_partner_sub_activity_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_sub_activity` FOR EACH ROW set new.dwh_creation_date = now() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_partner_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partners` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partners_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_partners_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partners` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_ui_conf` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_ui_conf_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_ui_conf_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_ui_conf` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_ui_conf_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_ui_conf_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_ui_conf_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_ui_conf_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_ui_conf_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_ui_conf_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_ui_conf_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_ui_conf_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_user_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_user_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_user_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_user_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_widget` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Dwh_Dim_Widget_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `Dwh_Dim_Widget_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_widget` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_widget_security_policy` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_widget_security_policy_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_widget_security_policy_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_widget_security_policy` FOR EACH ROW set new.dwh_creation_date = now() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_widget_security_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_widget_security_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_dim_widget_security_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_widget_security_type` FOR EACH ROW set new.dwh_creation_date = now() */$$


DELIMITER ;

/* Trigger structure for table `dwh_fact_partner_activities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_fact_partner_activities_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'%' */ /*!50003 TRIGGER `dwh_fact_partner_activities_setcreationtime_oninsert` BEFORE INSERT ON `dwh_fact_partner_activities` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Function  structure for function  `calc_month_id` */

/*!50003 DROP FUNCTION IF EXISTS `calc_month_id` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `calc_month_id`(date_id INT(11)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	RETURN FLOOR(date_id/100);
    END */$$
DELIMITER ;

/* Function  structure for function  `calc_partner_storage_data_last_month` */

/*!50003 DROP FUNCTION IF EXISTS `calc_partner_storage_data_last_month` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `calc_partner_storage_data_last_month`(month_id INT ,partner_id INT ) RETURNS int(11)
    DETERMINISTIC
BEGIN
#DECLARE m_id INT;
DECLARE pid INT;
#DECLARE aggr_storage INT;
#DECLARE cont_aggr_storage INT;
DECLARE avg_cont_aggr_storage INT;
#DECLARE bandwidth INT;
SET @current_month_id=month_id;
SET @current_partner_id=partner_id;
SELECT
#	calc_month_id(continuous_partner_storage.date_id) month_id,
	continuous_partner_storage.partner_id,
#	SUM(IF(DAY(continuous_partner_storage.date_id)=1,continuous_partner_storage.aggr_storage,NULL)) aggr_storage_first_day_of_month_mb,
#	SUM(continuous_aggr_storage) sum_continuous_aggr_storage_mb,
	SUM(continuous_aggr_storage/DAY(LAST_DAY(continuous_partner_storage.date_id))) avg_continuous_aggr_storage_mb
#	SUM(continuous_partner_storage.count_bandwidth) sum_partner_bandwidth_kb
INTO 
	#m_id,pid,aggr_storage,cont_aggr_storage,avg_cont_aggr_storage,bandwidth 
	pid,avg_cont_aggr_storage
FROM
(	
		SELECT 
			all_times.day_id date_id,
	#		aggr_p.partner_id,
			@current_partner_id partner_id,
			aggr_p.aggr_storage aggr_storage,
			aggr_p.count_bandwidth count_bandwidth,
			IF(aggr_p.aggr_storage IS NOT NULL, aggr_p.aggr_storage,
				(SELECT aggr_storage FROM dwh_aggr_partner inner_a_p 
				 WHERE 
					inner_a_p.partner_id=@current_partner_id AND 
					inner_a_p.date_id<all_times.day_id AND 
					inner_a_p.aggr_storage IS NOT NULL ORDER BY inner_a_p.date_id DESC LIMIT 1)) continuous_aggr_storage
		FROM 
			dwh_aggr_partner aggr_p RIGHT JOIN
			dwh_dim_time all_times
			ON (all_times.day_id=aggr_p.date_id 
				AND all_times.day_id>=20081230
				AND calc_month_id(all_times.day_id) <= @current_month_id 
				AND aggr_p.partner_id=@current_partner_id)
		WHERE 	
			all_times.day_id>=20081230 AND calc_month_id(all_times.day_id) <= @current_month_id 
		GROUP BY
			all_times.day_id,
			aggr_p.partner_id
	) continuous_partner_storage
WHERE 
	calc_month_id(continuous_partner_storage.date_id)=@current_month_id
GROUP BY
		continuous_partner_storage.partner_id,
		calc_month_id(continuous_partner_storage.date_id);
RETURN avg_cont_aggr_storage;
END */$$
DELIMITER ;

/* Function  structure for function  `calc_prev_date_id` */

/*!50003 DROP FUNCTION IF EXISTS `calc_prev_date_id` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `calc_prev_date_id`(date_id INT(11)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	set @d=STR_TO_DATE(CONCAT("",date_id),"%Y%m%d");
	RETURN DATE(ADDDATE(@d, INTERVAL -1 DAY))*1;
    END */$$
DELIMITER ;

/* Function  structure for function  `calc_primary_partner` */

/*!50003 DROP FUNCTION IF EXISTS `calc_primary_partner` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `calc_primary_partner`(partner_id INT(11),method_type VARCHAR(11)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	DECLARE _partner_alias INT(11);
	DECLARE _primary_partner INT(11);
	DECLARE _is_primary_partner TINYINT;
	SELECT 
		primary_partner,
		partner_alias pid
	INTO _primary_partner,_partner_alias
	FROM 
		dwh_dim_partner_aliases
	WHERE
		partner_alias=partner_id;
		
	IF  _primary_partner IS NULL THEN
		SET _primary_partner=partner_id;
		SET _is_primary_partner=1;
	ELSEIF _primary_partner=partner_id THEN
		SET _primary_partner=partner_id;
		SET _is_primary_partner=1;
	ELSE
		SET _is_primary_partner=0;
	END IF;
	
	IF method_type='is_primary'	THEN RETURN _is_primary_partner;
	ELSEIF method_type='get_primary' THEN RETURN _primary_partner;
	RETURN NULL;
	END IF;
    END */$$
DELIMITER ;

/* Function  structure for function  `get_primary_partner` */

/*!50003 DROP FUNCTION IF EXISTS `get_primary_partner` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `get_primary_partner`(partner_id INT(11)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	RETURN calc_primary_partner(partner_id,'get_primary');
END */$$
DELIMITER ;

/* Function  structure for function  `get_secondary_partners_as_string` */

/*!50003 DROP FUNCTION IF EXISTS `get_secondary_partners_as_string` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `get_secondary_partners_as_string`(partner_id INT(11)) RETURNS varchar(1024) CHARSET latin1
    DETERMINISTIC
BEGIN
	DECLARE secondary_partners VARCHAR(1024);
	 
	SELECT GROUP_CONCAT(partner_alias  SEPARATOR " , " )
	INTO  secondary_partners
	FROM dwh_dim_partner_aliases 
	WHERE primary_partner =partner_id
	GROUP BY primary_partner;
		
	IF secondary_partners IS NULL THEN
		SET secondary_partners = "";
	END IF;
	RETURN secondary_partners;
END */$$
DELIMITER ;

/* Function  structure for function  `is_primary_partner` */

/*!50003 DROP FUNCTION IF EXISTS `is_primary_partner` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `is_primary_partner`(partner_id INT(11)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	RETURN calc_primary_partner(partner_id,'is_primary');
END */$$
DELIMITER ;

/* Function  structure for function  `resolve_aggr_name` */

/*!50003 DROP FUNCTION IF EXISTS `resolve_aggr_name` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `resolve_aggr_name`(p_aggr_name VARCHAR(100),p_field_name VARCHAR(100)) RETURNS varchar(100) CHARSET latin1
    DETERMINISTIC
BEGIN
DECLARE v_aggr_table VARCHAR(100);
DECLARE v_aggr_id_field VARCHAR(100);

SELECT aggr_table, aggr_id_field
INTO  v_aggr_table, v_aggr_id_field
FROM kalturadw_ds.aggr_name_resolver
WHERE aggr_name = p_aggr_name;

IF p_field_name = 'aggr_table' THEN RETURN v_aggr_table;
ELSEIF p_field_name = 'aggr_id_field' THEN RETURN v_aggr_id_field;
END IF;
RETURN '';
    END */$$
DELIMITER ;

/* Procedure structure for procedure `add_events_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_events_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `add_events_partition`()
BEGIN
	DECLARE p_name,p_value VARCHAR(100);
	SELECT EXTRACT( YEAR_MONTH FROM FROM_DAYS(MAX(partition_description))) n,
	       TO_DAYS(FROM_DAYS(MAX(partition_description)) + INTERVAL 1 MONTH ) v
	INTO p_name,p_value
	FROM `information_schema`.`partitions` 
	WHERE `partitions`.`TABLE_NAME` = 'dwh_fact_events';
	SET @s = CONCAT('alter table dwh_fact_events ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	
	SELECT EXTRACT( YEAR_MONTH FROM MAX(partition_description)) n,
	       (MAX(partition_description) + INTERVAL 1 MONTH)*1  v
	INTO p_name,p_value
	FROM `information_schema`.`partitions` 
	WHERE `partitions`.`TABLE_NAME` = 'dwh_aggr_events_entry';
	SET @s = CONCAT('alter table dwh_aggr_events_entry ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	SELECT EXTRACT( YEAR_MONTH FROM MAX(partition_description)) n,
	       (MAX(partition_description) + INTERVAL 1 MONTH)*1  v
	INTO p_name,p_value
	FROM `information_schema`.`partitions` 
	WHERE `partitions`.`TABLE_NAME` = 'dwh_aggr_events_country';
	SET @s = CONCAT('alter table dwh_aggr_events_country ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	SELECT EXTRACT( YEAR_MONTH FROM MAX(partition_description)) n,
	       (MAX(partition_description) + INTERVAL 1 MONTH)*1  v
	INTO p_name,p_value
	FROM `information_schema`.`partitions` 
	WHERE `partitions`.`TABLE_NAME` = 'dwh_aggr_events_domain';
	SET @s = CONCAT('alter table dwh_aggr_events_domain ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	SELECT EXTRACT( YEAR_MONTH FROM MAX(partition_description)) n,
	       (MAX(partition_description) + INTERVAL 1 MONTH)*1  v
	INTO p_name,p_value
	FROM `information_schema`.`partitions` 
	WHERE `partitions`.`TABLE_NAME` = 'dwh_aggr_partner';
	SET @s = CONCAT('alter table dwh_aggr_partner ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END */$$
DELIMITER ;

/* Procedure structure for procedure `add_events_partition_for_fact_event` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_events_partition_for_fact_event` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `add_events_partition_for_fact_event`()
BEGIN
	DECLARE p_name,p_value VARCHAR(100);
	DECLARE p_date,_current_date DATETIME;
	DECLARE p_continue BOOL;
	
	SELECT NOW()
		INTO _current_date;
	SET p_continue = TRUE;
	WHILE (p_continue) DO
		SELECT EXTRACT( YEAR_MONTH FROM FROM_DAYS(MAX(partition_description))) n,
		       TO_DAYS(FROM_DAYS(MAX(partition_description)) + INTERVAL 1 MONTH ) v,
				FROM_DAYS(MAX(partition_description))
		INTO p_name,p_value, p_date
		FROM `information_schema`.`partitions` 
		WHERE `partitions`.`TABLE_NAME` = 'dwh_fact_events';
		IF (_current_date > p_date - INTERVAL 1 MONTH AND p_name is not null) THEN
			SET @s = CONCAT('alter table dwh_fact_events ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
			PREPARE stmt FROM  @s;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;
		ELSE
			SET p_continue = FALSE;
		END IF;
	END WHILE;
END */$$
DELIMITER ;

/* Procedure structure for procedure `add_partitions` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_partitions` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `add_partitions`()
BEGIN
  CALL add_partition_for_fact_table('dwh_fact_events');
  CALL add_partition_for_fact_table('dwh_fact_fms_session_events');
  CALL add_partition_for_fact_table('dwh_fact_fms_sessions');

	CALL add_partition_for_table('dwh_aggr_events_entry');
	CALL add_partition_for_table('dwh_aggr_events_domain');
	CALL add_partition_for_table('dwh_aggr_events_country');
	CALL add_partition_for_table('dwh_aggr_events_widget');
        CALL add_partition_for_table('dwh_aggr_events_uid');		
	CALL add_partition_for_table('dwh_aggr_partner');		

	CALL add_partition_for_table('dwh_aggr_partner_daily_usage');
END */$$
DELIMITER ;

/* Procedure structure for procedure `add_partition_for_fact_table` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_partition_for_fact_table` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `add_partition_for_fact_table`(table_name varchar(100))
BEGIN
	DECLARE p_name,p_value VARCHAR(100);
	DECLARE p_date,_current_date DATETIME;
	DECLARE p_continue BOOL;

	SELECT NOW()
		INTO _current_date;

	SET p_continue = TRUE;

	WHILE (p_continue) DO
		SELECT EXTRACT( YEAR_MONTH FROM FROM_DAYS(MAX(partition_description))) n,
		       TO_DAYS(FROM_DAYS(MAX(partition_description)) + INTERVAL 1 MONTH ) v,
				FROM_DAYS(MAX(partition_description))
		INTO p_name,p_value, p_date
		FROM `information_schema`.`partitions`
		WHERE `partitions`.`TABLE_NAME` = table_name;
		IF (_current_date > p_date - INTERVAL 1 MONTH AND p_name is not null) THEN
			SET @s = CONCAT('alter table ',table_name,' ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
			PREPARE stmt FROM  @s;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;
		ELSE
			SET p_continue = FALSE;
		END IF;
	END WHILE;
END */$$
DELIMITER ;

/* Procedure structure for procedure `add_partition_for_table` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_partition_for_table` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `add_partition_for_table`(table_name VARCHAR(40))
BEGIN
	DECLARE p_name,p_value VARCHAR(100);
	DECLARE p_date,_current_date DATETIME;
	DECLARE p_continue BOOL;
	
	SELECT NOW()
		INTO _current_date;
	SET p_continue = TRUE;
	WHILE (p_continue) DO
		SELECT EXTRACT( YEAR_MONTH FROM MAX(partition_description)) n,
			   (MAX(partition_description) + INTERVAL 1 MONTH)*1  v,
			   STR_TO_DATE(MAX(partition_description),'%Y%m%d')
		INTO p_name,p_value, p_date
		FROM `information_schema`.`partitions` 
		WHERE `partitions`.`TABLE_NAME` = table_name;
		IF (_current_date > p_date - INTERVAL 1 MONTH AND p_name is not null) THEN
			SET @s = CONCAT('alter table ' , table_name , ' ADD PARTITION (partition p_' ,p_name ,' values less than (', p_value ,'))');
			PREPARE stmt FROM  @s;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;
		ELSE
			SET p_continue = FALSE;
		END IF;
	END WHILE;
END */$$
DELIMITER ;

/* Procedure structure for procedure `calc_aggr_day` */

/*!50003 DROP PROCEDURE IF EXISTS  `calc_aggr_day` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `calc_aggr_day`(p_date_val DATE,p_aggr_name VARCHAR(100))
BEGIN
	DECLARE v_aggr_table VARCHAR(100);
	DECLARE v_aggr_id_field VARCHAR(100);
	DECLARE v_aggr_id_field_str VARCHAR(100);
	DECLARE v_aggr_join_stmt VARCHAR(200);
	DECLARE extra VARCHAR(100);
	
	SELECT aggr_table, aggr_id_field, aggr_join_stmt
	INTO  v_aggr_table, v_aggr_id_field, v_aggr_join_stmt
	FROM kalturadw_ds.aggr_name_resolver
	WHERE aggr_name = p_aggr_name;
	
	
	
	IF ( v_aggr_id_field <> "" ) THEN
		SET v_aggr_id_field_str = CONCAT (',',v_aggr_id_field);
	ELSE
		SET v_aggr_id_field_str = "";
	END IF;
	
	SET @s = CONCAT('UPDATE aggr_managment SET start_time = NOW()
	WHERE aggr_name = ''',p_aggr_name,''' AND aggr_day = ''',p_date_val,'''');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	
	SET @s = CONCAT('INSERT INTO ',v_aggr_table,'
		(partner_id
		,date_id 
		',v_aggr_id_field_str,' 
		,sum_time_viewed 
		,count_time_viewed 
		,count_plays 
		,count_loads 
		,count_plays_25 
		,count_plays_50 
		,count_plays_75 
		,count_plays_100 
		,count_edit
		,count_viral 
		,count_download 
		,count_report
  		,count_buf_start
  		,count_buf_end
        ,count_open_full_screen
        ,count_close_full_screen
        ,count_replay
        ,count_seek
        ,count_open_upload
        ,count_save_publish 
        ,count_close_editor
		,count_pre_bumper_played
        ,count_post_bumper_played
        ,count_bumper_clicked
        ,count_preroll_started
        ,count_midroll_started
        ,count_postroll_started
        ,count_overlay_started
        ,count_preroll_clicked
        ,count_midroll_clicked
        ,count_postroll_clicked
        ,count_overlay_clicked
        ,count_preroll_25
        ,count_preroll_50
        ,count_preroll_75
        ,count_midroll_25
        ,count_midroll_50
        ,count_midroll_75
        ,count_postroll_25
        ,count_postroll_50
        ,count_postroll_75
  		) 
	SELECT  partner_id,date_id',v_aggr_id_field_str,',
	SUM(time_viewed) sum_time_viewed,
	COUNT(time_viewed) count_time_viewed,
	SUM(count_plays) count_plays,
	SUM(count_loads) count_loads,
	SUM(count_plays_25) count_plays_25,
	SUM(count_plays_50) count_plays_50,
	SUM(count_plays_75) count_plays_75,
	SUM(count_plays_100) count_plays_100,
	SUM(count_edit) count_edit,
	SUM(count_viral) count_viral,
	SUM(count_download) count_download,
	SUM(count_report) count_report,
	SUM(count_buf_start) count_buf_start,
	SUM(count_buf_end) count_buf_end,
    SUM(count_open_full_screen) count_open_full_screen,
    SUM(count_close_full_screen) count_close_full_screen,
    SUM(count_replay) count_replay,
    SUM(count_seek) count_seek,
    SUM(count_open_upload) count_open_upload,
    SUM(count_save_publish) count_save_publish,
    SUM(count_close_editor) count_close_editor,
    SUM(count_pre_bumper_played) count_pre_bumper_played,
    SUM(count_post_bumper_played) count_post_bumper_played,
    SUM(count_bumper_clicked) count_bumper_clicked,
    SUM(count_preroll_started) count_preroll_started,
    SUM(count_midroll_started) count_midroll_started,
    SUM(count_postroll_started) count_postroll_started,
    SUM(count_overlay_started) count_overlay_started,
    SUM(count_preroll_clicked) count_preroll_clicked,
    SUM(count_midroll_clicked) count_midroll_clicked,
    SUM(count_postroll_clicked) count_postroll_clicked,
    SUM(count_overlay_clicked) count_overlay_clicked,
    SUM(count_preroll_25) count_preroll_25,
    SUM(count_preroll_50) count_preroll_50,
    SUM(count_preroll_75) count_preroll_75,
    SUM(count_midroll_25) count_midroll_25,
    SUM(count_midroll_50) count_midroll_50,
    SUM(count_midroll_75) count_midroll_75,
    SUM(count_postroll_25) count_postroll_25,
    SUM(count_postroll_50) count_postroll_50,
    SUM(count_postroll_75) count_postroll_75
	FROM (
		SELECT ev.partner_id,DATE(ev.event_time)*1 date_id',v_aggr_id_field_str,',ev.session_id,
			MAX(IF(ev.event_type_id IN(4,5,6,7),current_point,NULL))/60000  time_viewed,
			COUNT(IF(ev.event_type_id = 2, 1,NULL)) count_loads,
			COUNT(IF(ev.event_type_id = 3, 1,NULL)) count_plays,
			COUNT(IF(ev.event_type_id = 4, 1,NULL)) count_plays_25,
			COUNT(IF(ev.event_type_id = 5, 1,NULL)) count_plays_50,
			COUNT(IF(ev.event_type_id = 6, 1,NULL)) count_plays_75,
			COUNT(IF(ev.event_type_id = 7, 1,NULL)) count_plays_100,
			COUNT(IF(ev.event_type_id = 8, 1,NULL)) count_edit ,
			COUNT(IF(ev.event_type_id = 9, 1,NULL)) count_viral ,
			COUNT(IF(ev.event_type_id = 10, 1,NULL)) count_download ,
			COUNT(IF(ev.event_type_id = 11, 1,NULL)) count_report,
			COUNT(IF(ev.event_type_id = 12, 1,NULL)) count_buf_start ,
			COUNT(IF(ev.event_type_id = 13, 1,NULL)) count_buf_end	,            
            COUNT(IF(ev.event_type_id = 14, 1,NULL)) count_open_full_screen	,            
            COUNT(IF(ev.event_type_id = 15, 1,NULL)) count_close_full_screen,            
            COUNT(IF(ev.event_type_id = 16, 1,NULL)) count_replay	,            
            COUNT(IF(ev.event_type_id = 17, 1,NULL)) count_seek	,            
            COUNT(IF(ev.event_type_id = 18, 1,NULL)) count_open_upload	,            
            COUNT(IF(ev.event_type_id = 19, 1,NULL)) count_save_publish	,            
            COUNT(IF(ev.event_type_id = 20, 1,NULL)) count_close_editor	,            
			COUNT(IF(ev.event_type_id = 21, 1,NULL)) count_pre_bumper_played , 
			COUNT(IF(ev.event_type_id = 22, 1,NULL)) count_post_bumper_played	, 
			COUNT(IF(ev.event_type_id = 23, 1,NULL)) count_bumper_clicked 	, 
			COUNT(IF(ev.event_type_id = 24, 1,NULL)) count_preroll_started 	, 
			COUNT(IF(ev.event_type_id = 25, 1,NULL)) count_midroll_started 	, 
			COUNT(IF(ev.event_type_id = 26, 1,NULL)) count_postroll_started, 
			COUNT(IF(ev.event_type_id = 27, 1,NULL)) count_overlay_started, 
			COUNT(IF(ev.event_type_id = 28, 1,NULL)) count_preroll_clicked,
            COUNT(IF(ev.event_type_id = 29, 1,NULL)) count_midroll_clicked , 
			COUNT(IF(ev.event_type_id = 30, 1,NULL)) count_postroll_clicked	, 
			COUNT(IF(ev.event_type_id = 31, 1,NULL)) count_overlay_clicked 	, 
			COUNT(IF(ev.event_type_id = 32, 1,NULL)) count_preroll_25 	, 
			COUNT(IF(ev.event_type_id = 33, 1,NULL)) count_preroll_50 	, 
			COUNT(IF(ev.event_type_id = 34, 1,NULL)) count_preroll_75, 
			COUNT(IF(ev.event_type_id = 35, 1,NULL)) count_midroll_25, 
			COUNT(IF(ev.event_type_id = 36, 1,NULL)) count_midroll_50	,
			COUNT(IF(ev.event_type_id = 37, 1,NULL)) count_midroll_75	, 
			COUNT(IF(ev.event_type_id = 38, 1,NULL)) count_postroll_25 	, 
			COUNT(IF(ev.event_type_id = 39, 1,NULL)) count_postroll_50 	, 
			COUNT(IF(ev.event_type_id = 40, 1,NULL)) count_postroll_75 	
		FROM dwh_fact_events as ev ',v_aggr_join_stmt,' 
		WHERE ev.event_type_id BETWEEN 2 AND 40 
			AND ev.event_date_id = DATE(''',p_date_val,''')*1
			AND ev.entry_media_type_id IN (1,5,6)  
		GROUP BY ev.partner_id,DATE(ev.event_time)*1',v_aggr_id_field_str,',ev.session_id
	) AS a
	GROUP BY partner_id,date_id',v_aggr_id_field_str,';');
	
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	SET extra = CONCAT('daily_procedure_',v_aggr_table);
	IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.ROUTINES WHERE ROUTINE_NAME=extra) THEN
		
		SET @ss = CONCAT('CALL ',extra,'(''', p_date_val,''',''',p_aggr_name,''');'); 
		PREPARE stmt1 FROM  @ss;
		EXECUTE stmt1;
		DEALLOCATE PREPARE stmt1;
	END IF ;
	SET @s = CONCAT('UPDATE aggr_managment SET is_calculated = 1,end_time = NOW()
	WHERE aggr_name = ''',p_aggr_name,''' AND aggr_day = ''',p_date_val,'''');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `calc_partner_billing_data` */

/*!50003 DROP PROCEDURE IF EXISTS  `calc_partner_billing_data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `calc_partner_billing_data`(date_val DATE,partner_id VARCHAR(100))
BEGIN
SET @current_date_id=DATE(date_val)*1;
SET @current_partner_id=partner_id;
SELECT
	FLOOR(continuous_partner_storage.date_id/100) month_id,
	continuous_partner_storage.partner_id,
	DAY(LAST_DAY(continuous_partner_storage.date_id)) last_day_of_month,
	SUM(IF(DAY(continuous_partner_storage.date_id)=1,continuous_partner_storage.aggr_storage,NULL)) aggr_storage_first_day_of_month_mb,
	SUM(continuous_aggr_storage) sum_continuous_aggr_storage_mb,
	SUM(continuous_aggr_storage/DAY(LAST_DAY(continuous_partner_storage.date_id))) avg_continuous_aggr_storage_mb,
	SUM(continuous_partner_storage.count_bandwidth) sum_partner_bandwidth_kb
FROM
(	
		SELECT 
			all_times.day_id date_id,
	#		aggr_p.partner_id,
			@current_partner_id partner_id,
			aggr_p.aggr_storage aggr_storage,
			aggr_p.count_bandwidth count_bandwidth,
			IF(aggr_p.aggr_storage IS NOT NULL, aggr_p.aggr_storage,
				(SELECT aggr_storage FROM dwh_aggr_partner inner_a_p 
				 WHERE 
					inner_a_p.partner_id=@current_partner_id AND 
					inner_a_p.date_id<all_times.day_id AND 
					inner_a_p.aggr_storage IS NOT NULL ORDER BY inner_a_p.date_id DESC LIMIT 1)) continuous_aggr_storage
		FROM 
			dwh_aggr_partner aggr_p RIGHT JOIN
			dwh_dim_time all_times
			ON (all_times.day_id=aggr_p.date_id 
				AND all_times.day_id>=20081230
				AND all_times.day_id <= @current_date_id 
				AND aggr_p.partner_id=@current_partner_id)
		WHERE 	
			all_times.day_id>=20081230 AND all_times.day_id <= @current_date_id 
		GROUP BY
			all_times.day_id,
			aggr_p.partner_id
	) continuous_partner_storage
	GROUP BY
		continuous_partner_storage.partner_id,
		FLOOR(continuous_partner_storage.date_id/100)
	WITH ROLLUP;	
	
    END */$$
DELIMITER ;

/* Procedure structure for procedure `daily_procedure_dwh_aggr_events_widget` */

/*!50003 DROP PROCEDURE IF EXISTS  `daily_procedure_dwh_aggr_events_widget` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `daily_procedure_dwh_aggr_events_widget`(date_val DATE,aggr_name VARCHAR(100))
BEGIN
	DECLARE aggr_table VARCHAR(100);
	DECLARE aggr_id_field VARCHAR(100);
	DECLARE aggr_id_field_str VARCHAR(100);
	SET aggr_table = resolve_aggr_name(aggr_name,'aggr_table');
	SET aggr_id_field = resolve_aggr_name(aggr_name,'aggr_id_field');
	
	IF ( aggr_id_field <> "" ) THEN
		SET aggr_id_field_str = CONCAT (',',aggr_id_field);
	ELSE
		SET aggr_id_field_str = "";
	END IF;

	SET @s = CONCAT('
    	INSERT INTO ',aggr_table,'
    		(partner_id, 
    		date_id, 
			widget_id,
     		count_widget_loads)
    	SELECT  
    		partner_id,event_date_id,widget_id,
    		SUM(IF(event_type_id=1,1,NULL)) count_widget_loads
		FROM dwh_fact_events  ev
		WHERE event_type_id IN (1) 
			AND event_date_id = DATE(''',date_val,''')*1
		GROUP BY partner_id,DATE(event_time)*1',aggr_id_field_str,'
    	ON DUPLICATE KEY UPDATE
    		count_widget_loads=VALUES(count_widget_loads);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END */$$
DELIMITER ;

/* Procedure structure for procedure `daily_procedure_dwh_aggr_partner` */

/*!50003 DROP PROCEDURE IF EXISTS  `daily_procedure_dwh_aggr_partner` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `daily_procedure_dwh_aggr_partner`(date_val DATE,aggr_name VARCHAR(100))
BEGIN

	DECLARE aggr_table VARCHAR(100);
	DECLARE aggr_id_field VARCHAR(100);

	SET aggr_table = resolve_aggr_name(aggr_name,'aggr_table');
	SET aggr_id_field = resolve_aggr_name(aggr_name,'aggr_id_field');

	SET @s = CONCAT('
    	INSERT INTO ',aggr_table,'
    		(partner_id, 
    		date_id, 
    		count_video, 
    		count_image, 
    		count_audio, 
    		count_mix,
    		count_playlist)
    	SELECT  
    		partner_id,date_id,
    		SUM(count_video) sum_count_video,
    		SUM(count_image) sum_count_image,
    		SUM(count_audio) sum_count_audio,
    		SUM(count_mix) sum_count_mix,
    		SUM(count_playlist) sum_playlist
    	FROM (
    		SELECT partner_id,en.created_date_id date_id,
    			COUNT(IF(entry_media_type_id = 1, 1,NULL)) count_video,
    			COUNT(IF(entry_media_type_id = 2, 1,NULL)) count_image,
    			COUNT(IF(entry_media_type_id = 5, 1,NULL)) count_audio,
    			COUNT(IF(entry_media_type_id = 6, 1,NULL)) count_mix,
    			COUNT(IF(entry_type_id = 5, 1,NULL)) count_playlist
    		FROM dwh_dim_entries  en 
    		WHERE (en.entry_media_type_id IN (1,2,5,6) OR en.entry_type_id IN (5) ) 
    			AND en.created_date_id=DATE(''',date_val,''')*1
    		GROUP BY partner_id,en.created_date_id
    	) AS a
    	GROUP BY partner_id,date_id
    	ON DUPLICATE KEY UPDATE
    		count_video=VALUES(count_video), 
    		count_image=VALUES(count_image),
    		count_audio=VALUES(count_audio),
    		count_mix=VALUES(count_mix),
    		count_playlist=VALUES(count_playlist);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	
	SET @s = CONCAT('
    	INSERT INTO ',aggr_table,'
    		(partner_id, 
    		date_id, 
    		count_bandwidth, 
    		count_storage,  
		count_streaming )
   		SELECT partner_id,pa.activity_date_id date_id,
			SUM(IF(partner_activity_id = 1, amount ,NULL)) count_bandwidth, 
			SUM(IF(partner_activity_id = 3 AND partner_sub_activity_id=301, amount,NULL)) count_storage, 
			SUM(IF(partner_activity_id = 7, amount, NULL)) count_streaming 
		FROM dwh_fact_partner_activities  pa 
		WHERE 
			pa.activity_date_id=DATE(''',date_val,''')*1
		GROUP BY partner_id,pa.activity_date_id
    	ON DUPLICATE KEY UPDATE
    		count_bandwidth=VALUES(count_bandwidth), 
    		count_storage=VALUES(count_storage),
		count_streaming=VALUES(count_streaming);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

    SET @s = CONCAT('
    	INSERT INTO ',aggr_table,'
    		(partner_id, 
    		date_id, 
    		aggr_storage ,   
		aggr_bandwidth,  
		aggr_streaming   )
		SELECT 
			a.partner_id,
			a.date_id,
			SUM(b.count_storage) aggr_storage,
			SUM(b.count_bandwidth) aggr_bandwidth,
			SUM(b.count_streaming) aggr_streaming
		FROM dwh_aggr_partner a , dwh_aggr_partner b 
		WHERE 
			a.partner_id=b.partner_id
			AND a.date_id=DATE(''',date_val,''')*1
			AND a.date_id>=b.date_id
		GROUP BY
			a.date_id,
			a.partner_id
		ON DUPLICATE KEY UPDATE
			aggr_storage=VALUES(aggr_storage),
			aggr_bandwidth=VALUES(aggr_bandwidth),
			aggr_streaming=VALUES(aggr_streaming);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

    SET @s = CONCAT('
    	INSERT INTO ',aggr_table,'
    		(partner_id, 
    		date_id, 
    		count_users)
    	SELECT  
    		partner_id,ku.created_date_id,
    		COUNT(1)
    	FROM dwh_dim_kusers  ku
    	WHERE 
    		ku.created_date_id=DATE(''',date_val,''')*1
   		GROUP BY partner_id,ku.created_date_id
    	ON DUPLICATE KEY UPDATE
    		count_users=VALUES(count_users) ;
        ');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	 
	SET @s = CONCAT('
    	INSERT INTO ',aggr_table,'
   		(partner_id, 
    		date_id, 
    		count_widgets)
    	SELECT  
    		partner_id,wd.created_date_id,
    		COUNT(1)
        FROM dwh_dim_widget  wd
    	WHERE 
    		wd.created_date_id=DATE(''',date_val,''')*1
   		GROUP BY partner_id,wd.created_date_id
    	ON DUPLICATE KEY UPDATE
    		count_widgets=VALUES(count_widgets) ;
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	
	CALL daily_procedure_dwh_aggr_partner_daily_usage(date_val) ;
END */$$
DELIMITER ;

/* Procedure structure for procedure `daily_procedure_dwh_aggr_partner_daily_usage` */

/*!50003 DROP PROCEDURE IF EXISTS  `daily_procedure_dwh_aggr_partner_daily_usage` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `daily_procedure_dwh_aggr_partner_daily_usage`(date_val DATE)
BEGIN

	SET @s = CONCAT('
    	INSERT INTO dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		sum_storage_mb   ,
    		sum_bandwidth_mb , 
		sum_streaming_mb   
    		)
		SELECT 
			a.partner_id,
			a.date_id,
			a.aggr_storage,
			floor(a.aggr_bandwidth/1024),
			floor(a.count_streaming/1024)
		FROM dwh_aggr_partner a 
		WHERE 
			a.date_id=DATE(''',date_val,''')*1
		ON DUPLICATE KEY UPDATE
			sum_storage_mb=VALUES(sum_storage_mb),
			sum_bandwidth_mb=VALUES(sum_bandwidth_mb),
			sum_streaming_mb=VALUES(sum_streaming_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	
#	set @rc_1= select row_count();

	SET @prev_date_id=calc_prev_date_id(DATE(date_val)*1);

	SET @s = CONCAT('
        INSERT IGNORE INTO dwh_aggr_partner_daily_usage
        (partner_id,date_id,sum_storage_mb)
        SELECT 
        	l_aggr_p_d.partner_id,
        	DATE(''',date_val,''')*1,
        	l_aggr_p_d.sum_storage_mb
        FROM 
        	dwh_aggr_partner_daily_usage l_aggr_p_d  
        WHERE
        	l_aggr_p_d.sum_storage_mb IS NOT NULL AND 
        	l_aggr_p_d.date_id=',@prev_date_id,' AND 
        	l_aggr_p_d.partner_id NOT IN 
        	(
        		SELECT r_aggr_p_d.partner_id
        		FROM dwh_aggr_partner_daily_usage r_aggr_p_d 
        		WHERE r_aggr_p_d.date_id=DATE(''',date_val,''')*1
        	);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	
	
#	set @rc_2= select row_count();
	SET @s = CONCAT('
    	INSERT INTO dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		sum_monthly_bandwidth_mb   
    		)
		SELECT 
			a.partner_id,
			a.date_id,
			FLOOR(SUM(b.count_bandwidth)/1024) sum_monthly_bandwidth_mb
		FROM dwh_aggr_partner a ,dwh_aggr_partner b
		WHERE 
			a.partner_id=b.partner_id AND
			a.date_id=DATE(''',date_val,''')*1 AND
			a.date_id>=b.date_id AND
			calc_month_id(b.date_id)=calc_month_id(a.date_id)
		GROUP BY 
			b.partner_id	
	UNION  SELECT -1,DATE(''',date_val,''')*1,-1
        ON DUPLICATE KEY UPDATE
			sum_monthly_bandwidth_mb=VALUES(sum_monthly_bandwidth_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	

	SET @s = CONCAT('
   		INSERT INTO dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		calculated_monthly_storage_mb   
    		)
		SELECT 
			du.partner_id partner_id,
			DATE(''',date_val,''')*1,
			SUM(du.sum_storage_mb)/DAY(LAST_DAY(DATE(du.date_id))) calc_monthly_storage_mb
		FROM 
			dwh_aggr_partner_daily_usage du
		WHERE
			calc_month_id(du.date_id) = calc_month_id(DATE(''',date_val,''')*1)
			AND du.date_id<=DATE(''',date_val,''')*1
		GROUP BY 
			du.partner_id
		UNION  SELECT -1,DATE(''',date_val,''')*1,-1
		ON DUPLICATE KEY UPDATE
			calculated_monthly_storage_mb=VALUES(calculated_monthly_storage_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	
	SET @s = CONCAT('
   		INSERT INTO dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		calculated_storage_mb   
    		)
		SELECT 
			du.partner_id partner_id,
			DATE(''',date_val,''')*1,
			SUM(du.sum_storage_mb)/DAY(LAST_DAY(DATE(du.date_id))) calc_storage_mb
		FROM 
			dwh_aggr_partner_daily_usage du
		WHERE
			du.date_id<=DATE(''',date_val,''')*1
		GROUP BY 
			du.partner_id
		UNION  SELECT -1,DATE(''',date_val,''')*1,-1
		ON DUPLICATE KEY UPDATE
			calculated_storage_mb=VALUES(calculated_storage_mb);
    	');

	PREPARE stmt FROM  @s;

	EXECUTE stmt;

	DEALLOCATE PREPARE stmt;	

#	select @rc_1,@rc_2;	

END */$$
DELIMITER ;

/* Procedure structure for procedure `daily_procedure_dwh_aggr_partner_daily_usage_loop` */

/*!50003 DROP PROCEDURE IF EXISTS  `daily_procedure_dwh_aggr_partner_daily_usage_loop` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `daily_procedure_dwh_aggr_partner_daily_usage_loop`(from_date DATE,to_date DATE)
BEGIN
DECLARE _count INT DEFAULT 0;
DECLARE _current_date DATE;
    increment: LOOP
		SET _current_date = ADDDATE(from_date, INTERVAL _count DAY); 
		IF _current_date > to_date THEN
			LEAVE increment;
		END IF;
		SET _count = _count + 1;
		CALL daily_procedure_dwh_aggr_partner_daily_usage(_current_date);
    END LOOP increment;
    SELECT _count;
END */$$
DELIMITER ;

/* Procedure structure for procedure `drop_events_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `drop_events_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `drop_events_partition`(month_interval INT)
BEGIN
	DECLARE p_name VARCHAR(100);
	main:LOOP
		SELECT MIN(partition_name) n
		INTO p_name
		FROM `information_schema`.`partitions` 
		WHERE `partitions`.`TABLE_NAME` = 'dwh_fact_events'
			AND FROM_DAYS(partition_description) < NOW() - INTERVAL month_interval MONTH;
		IF p_name IS NULL THEN LEAVE main; END IF;
		SET @s = CONCAT('alter table dwh_fact_events drop PARTITION ',p_name);
		PREPARE stmt FROM  @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END LOOP main;	
	main2:LOOP
		SELECT MIN(partition_name) n
		INTO p_name
		FROM `information_schema`.`partitions` 
		WHERE `partitions`.`TABLE_NAME` = 'dwh_aggr_events_entry'
			AND partition_description < DATE(NOW() - INTERVAL month_interval MONTH)*1;
		IF p_name IS NULL THEN LEAVE main2; END IF;
		SET @s = CONCAT('alter table dwh_aggr_events_entry drop PARTITION ',p_name);
		PREPARE stmt FROM  @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END LOOP main2;	
    END */$$
DELIMITER ;

/* Procedure structure for procedure `monthly_non_paying_billing_report` */

/*!50003 DROP PROCEDURE IF EXISTS  `monthly_non_paying_billing_report` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `monthly_non_paying_billing_report`( month_id INT )
BEGIN
SET @current_month = month_id;
	SELECT 
		calculated_stats.month_id,
		calculated_stats.partner_id "partner_id",
#		get_secondary_partners_as_string(calculated_stats.partner_id) "partners in group",
		dim_partner.partner_name,
		dim_partner.partner_type_id,
		dim_partner_type.partner_type_name,
		dim_partner.admin_name,
		dim_partner.admin_email,
		dim_partner.partner_package pkg,
		IF(calculated_stats.sum_billing_storage_mb IS NOT NULL,calculated_stats.sum_billing_storage_mb,0)
		 + IF(calculated_stats.sum_bandwith_for_month_mb IS NOT NULL,calculated_stats.sum_bandwith_for_month_mb,0) sum_billing_for_month_mb,
		calculated_stats.sum_bandwith_for_month_mb,
		calculated_stats.sum_billing_storage_mb,
		calculated_stats.sum_storage_for_month_mb,
		calculated_stats.sum_storage_all_time_mb ,
		calculated_stats.sum_bandwidth_all_time_mb
	FROM
	(
		SELECT 
			@current_month month_id,
			get_primary_partner(aggr_single_partner.partner_id) "partner_id",
			FLOOR(SUM(aggr_single_partner.sum_bandwith_for_month_aggr_kb)/1024) sum_bandwith_for_month_mb,
			SUM(aggr_single_partner.billing_storage_mb) sum_billing_storage_mb,
			SUM(aggr_single_partner.sum_count_storage_for_month_aggr_mb) sum_storage_for_month_mb,
			SUM(aggr_single_partner.sum_storage_all_time_mb) sum_storage_all_time_mb,
			FLOOR(SUM(aggr_single_partner.sum_bandwidth_all_time_kb)/1024) sum_bandwidth_all_time_mb
		FROM	
		(
			SELECT
				calc_month_id(aggr_partner.date_id) month_id, 
				aggr_partner.partner_id,
				SUM(aggr_partner.count_bandwidth) sum_bandwidth_all_time_kb,
				SUM(aggr_partner.count_storage) sum_storage_all_time_mb,
				calc_partner_storage_data_last_month(@current_month , aggr_partner.partner_id) billing_storage_mb , 
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_bandwidth,NULL)) sum_bandwith_for_month_aggr_kb,
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_storage,NULL)) sum_count_storage_for_month_aggr_mb 
			FROM 
				dwh_aggr_partner aggr_partner, 
			(
				SELECT 
					inner_aggr_partner.partner_id,
					SUM(inner_aggr_partner.count_storage) sum_storage_all_time_mb
				FROM
					dwh_aggr_partner inner_aggr_partner ,
					dwh_dim_partners inner_dim_partner
				WHERE 
					 inner_aggr_partner.partner_id=inner_dim_partner.partner_id
					AND inner_dim_partner.partner_package=1 
				GROUP BY 	
					inner_aggr_partner.partner_id	
				ORDER BY 
					SUM(inner_aggr_partner.count_storage+inner_aggr_partner.count_bandwidth*1024) DESC
				LIMIT 400	
			) pp
			WHERE 
				calc_month_id(aggr_partner.date_id)<=@current_month 
				AND aggr_partner.partner_id=pp.partner_id
			GROUP BY 
				aggr_partner.partner_id
		) aggr_single_partner
		GROUP BY 
		
			get_primary_partner(aggr_single_partner.partner_id)
		ORDER BY 
			get_primary_partner(aggr_single_partner.partner_id) ASC
	) calculated_stats , 
			dwh_dim_partners dim_partner ,
			dwh_dim_partner_type dim_partner_type
	WHERE
		calculated_stats.partner_id=dim_partner.partner_id
		AND dim_partner.partner_type_id=dim_partner_type.partner_type_id
		AND dim_partner.partner_package=1
	ORDER BY sum_billing_for_month_mb DESC 	;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `monthly_partner_billing_report` */

/*!50003 DROP PROCEDURE IF EXISTS  `monthly_partner_billing_report` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `monthly_partner_billing_report`( month_id int )
BEGIN

SET @current_month = month_id;
	SELECT 
		calculated_stats.month_id,
		calculated_stats.partner_id "partner_id",
		get_secondary_partners_as_string(calculated_stats.partner_id) "partners in group",
		dim_partner.partner_name,
		dim_partner.partner_package pkg,
		if(calculated_stats.sum_billing_storage_mb IS NOT NULL,calculated_stats.sum_billing_storage_mb,0)
		 + if(calculated_stats.sum_bandwith_for_month_mb IS NOt NULL,calculated_stats.sum_bandwith_for_month_mb,0) sum_billing_for_month_mb,
		calculated_stats.sum_bandwith_for_month_mb,
		calculated_stats.sum_streaming_for_month_mb,
		calculated_stats.sum_billing_storage_mb,
		calculated_stats.sum_storage_for_month_mb,
		calculated_stats.sum_storage_all_time_mb ,
		calculated_stats.sum_bandwidth_all_time_mb ,
		calculated_stats.sum_streaming_all_time_mb 
	FROM
	(
		SELECT
			@current_month month_id,
			get_primary_partner(aggr_single_partner.partner_id) "partner_id",
			FLOOR(SUM(aggr_single_partner.sum_bandwith_for_month_aggr_kb)/1024) sum_bandwith_for_month_mb,
			FLOOR(SUM(aggr_single_partner.sum_streaming_for_month_aggr_kb)/1024) sum_streaming_for_month_mb,
			SUM(aggr_single_partner.billing_storage_mb) sum_billing_storage_mb,
			SUM(aggr_single_partner.sum_count_storage_for_month_aggr_mb) sum_storage_for_month_mb,
			SUM(aggr_single_partner.sum_storage_all_time_mb) sum_storage_all_time_mb ,
			FLOOR(SUM(aggr_single_partner.sum_bandwidth_all_time_kb)/1024) sum_bandwidth_all_time_mb,
			FLOOR(SUM(aggr_single_partner.sum_streaming_all_time_kb)/1024) sum_streaming_all_time_mb
		FROM	
		(
			SELECT
				calc_month_id(aggr_partner.date_id) month_id, 
				aggr_partner.partner_id,
				SUM(aggr_partner.count_bandwidth) sum_bandwidth_all_time_kb,
				SUM(aggr_partner.count_storage) sum_storage_all_time_mb,
				SUM(aggr_partner.count_streaming) sum_streaming_all_time_kb,
				calc_partner_storage_data_last_month(@current_month , aggr_partner.partner_id) billing_storage_mb , 
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_bandwidth,NULL)) sum_bandwith_for_month_aggr_kb ,
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_storage,NULL)) sum_count_storage_for_month_aggr_mb ,
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_streaming,NULL)) sum_streaming_for_month_aggr_kb  
			FROM 
				dwh_aggr_partner aggr_partner, 
				dwh_dim_partners inner_dim_partner USE INDEX (partner_package_indx)
			WHERE 
				calc_month_id(aggr_partner.date_id)<=@current_month 
				AND aggr_partner.partner_id=inner_dim_partner.partner_id
				AND inner_dim_partner.partner_package>1 
			GROUP BY 
                aggr_partner.partner_id
		) aggr_single_partner
		GROUP BY 
			get_primary_partner(aggr_single_partner.partner_id)
		ORDER BY 
			get_primary_partner(aggr_single_partner.partner_id) ASC
	) calculated_stats , 
			dwh_dim_partners dim_partner 
	WHERE
		calculated_stats.partner_id=dim_partner.partner_id
		AND dim_partner.partner_package>1;
	END */$$
DELIMITER ;

/* Procedure structure for procedure `proc_fix_events_current_point` */

/*!50003 DROP PROCEDURE IF EXISTS  `proc_fix_events_current_point` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `proc_fix_events_current_point`(from_date_val DATE, to_date_val date)
BEGIN
	
	SET @s = CONCAT('
		update 
			dwh_fact_events ev
		set
			ev.current_point=ev.current_point*1000 
		WHERE 
			event_date_id between ', from_date_val ,' and ', to_date_val ,'
			AND event_type_id BETWEEN 4 AND 7
			AND current_point<700 					
			AND SUBSTR(client_version,1,2)<>"JW" 	
			AND  SUBSTR(client_version,5,10)>="3.0"	
			AND SUBSTR(client_version,5,10)<>"v3.1.6"
			;'
		);
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `recalc_aggr_day` */

/*!50003 DROP PROCEDURE IF EXISTS  `recalc_aggr_day` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `recalc_aggr_day`(date_val DATE,aggr_name VARCHAR(100))
BEGIN
	DECLARE aggr_table VARCHAR(100);
	DECLARE aggr_id_field VARCHAR(100);
	SET aggr_table = resolve_aggr_name(aggr_name,'aggr_table');
	SET aggr_id_field = resolve_aggr_name(aggr_name,'aggr_id_field');
	
	SET @s = CONCAT('delete from ',aggr_table,'
		where date_id = DATE(''',date_val,''')*1');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	SET @s = CONCAT('UPDATE aggr_managment SET is_calculated = 0 
	WHERE aggr_name = ''',aggr_name,''' AND aggr_day = ''',date_val,'''');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
	CALL calc_aggr_day(date_val,aggr_name);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `top_10_partners` */

/*!50003 DROP PROCEDURE IF EXISTS  `top_10_partners` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `top_10_partners`(  month_id INT)
BEGIN
	SELECT
		a.month_id,
		a.partner_id,
		a.name,
		a.package,
		a.sum_storage
	FROM
	(
		SELECT 
			FLOOR(ap.date_id/100) month_id,
			ap.partner_id partner_id,
			pr.partner_name "name",
			pr.partner_package package,
			SUM(ap.count_storage) sum_storage
		FROM dwh_aggr_partner ap, dwh_dim_partners pr
		WHERE 
			ap.partner_id=pr.partner_id AND
			FLOOR(date_id/100)=month_id
		GROUP BY 
			ap.partner_id
		ORDER BY 
			sum_storage DESC
		LIMIT 10
	) a;

END */$$
DELIMITER ;

/* Procedure structure for procedure `top_activities` */

/*!50003 DROP PROCEDURE IF EXISTS  `top_activities` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `top_activities`(  month_id INT , _limit INT , _order_by VARCHAR(40) )
BEGIN
	if INSTR("storage,bandwidth,plays,loads",_order_by)=0 THEN
		SELECT "ERROR:" , "3rd parameter can be one of the following" , "[storage,bandwidth,plays,loads]";
	ELSE
		SET @s = CONCAT('
			SELECT 
				FLOOR(ap.date_id/100) month_id,
				ap.partner_id partner_id,
				pr.partner_name "name",
				pr.partner_package package,
				SUM(ap.count_storage) storage,
				SUM(ap.count_bandwidth) bandwidth,
#				calc_partner_storage_data_last_month(',month_id,',ap.partner_id) "usage",
				SUM(ap.count_plays) plays,
				SUM(ap.count_loads) loads
			FROM dwh_aggr_partner ap, dwh_dim_partners pr
			WHERE 
				ap.partner_id=pr.partner_id AND
				FLOOR(date_id/100)=',month_id,'
			GROUP BY 
				ap.partner_id
			ORDER BY 
				', _order_by ,' DESC
			LIMIT ',_limit,';
		');
#	select @s;  
		PREPARE stmt FROM  @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END IF;
END */$$
DELIMITER ;

/* Procedure structure for procedure `top_partners` */

/*!50003 DROP PROCEDURE IF EXISTS  `top_partners` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `top_partners`(  month_id INT  )
BEGIN
	SELECT
		a.month_id,
		a.partner_id,
		a.name,
		a.package,
		a.sum_storage
	FROM
	(
		SELECT 
			FLOOR(ap.date_id/100) month_id,
			ap.partner_id partner_id,
			pr.partner_name "name",
			pr.partner_package package,
			SUM(ap.count_storage) sum_storage
		FROM dwh_aggr_partner ap, dwh_dim_partners pr
		WHERE 
			ap.partner_id=pr.partner_id AND
			FLOOR(date_id/100)=month_id
		GROUP BY 
			ap.partner_id
		ORDER BY 
			sum_storage DESC
		LIMIT 20
	) a;

END */$$
DELIMITER ;

/*Table structure for table `dwh_aggr_active_partners_v` */

DROP TABLE IF EXISTS `dwh_aggr_active_partners_v`;

/*!50001 DROP VIEW IF EXISTS `dwh_aggr_active_partners_v` */;
/*!50001 DROP TABLE IF EXISTS `dwh_aggr_active_partners_v` */;

/*!50001 CREATE TABLE `dwh_aggr_active_partners_v` (
  `partner_id` int(11) NOT NULL DEFAULT '0',
  `month_id` int(11) NOT NULL DEFAULT '0',
  `date_id` int(11) DEFAULT NULL,
  `active_site` tinyint(4) DEFAULT '0',
  `active_partner` tinyint(4) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_aggr_events_entry_partitions` */

DROP TABLE IF EXISTS `dwh_aggr_events_entry_partitions`;

/*!50001 DROP VIEW IF EXISTS `dwh_aggr_events_entry_partitions` */;
/*!50001 DROP TABLE IF EXISTS `dwh_aggr_events_entry_partitions` */;

/*!50001 CREATE TABLE `dwh_aggr_events_entry_partitions` (
  `table_name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `partition_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `partition_description` longtext CHARACTER SET utf8,
  `table_rows` bigint(21) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_dim_countries` */

DROP TABLE IF EXISTS `dwh_dim_countries`;

/*!50001 DROP VIEW IF EXISTS `dwh_dim_countries` */;
/*!50001 DROP TABLE IF EXISTS `dwh_dim_countries` */;

/*!50001 CREATE TABLE `dwh_dim_countries` (
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_dim_countries_states` */

DROP TABLE IF EXISTS `dwh_dim_countries_states`;

/*!50001 DROP VIEW IF EXISTS `dwh_dim_countries_states` */;
/*!50001 DROP TABLE IF EXISTS `dwh_dim_countries_states` */;

/*!50001 CREATE TABLE `dwh_dim_countries_states` (
  `country` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_dim_entries_v` */

DROP TABLE IF EXISTS `dwh_dim_entries_v`;

/*!50001 DROP VIEW IF EXISTS `dwh_dim_entries_v` */;
/*!50001 DROP TABLE IF EXISTS `dwh_dim_entries_v` */;

/*!50001 CREATE TABLE `dwh_dim_entries_v` (
  `entry_id` varchar(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `entry_name` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `entry_source_id` varchar(48) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_date_id` int(11) DEFAULT NULL,
  `created_hour_id` tinyint(4) DEFAULT NULL,
  `updated_date_id` int(11) DEFAULT NULL,
  `updated_hour_id` tinyint(4) DEFAULT NULL,
  `entry_type_id` smallint(6) DEFAULT NULL,
  `entry_type_Name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `entry_status_id` smallint(6),
  `entry_status_Name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `entry_media_type_id` smallint(6),
  `partner_name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `entry_media_type_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_dim_partners_v` */

DROP TABLE IF EXISTS `dwh_dim_partners_v`;

/*!50001 DROP VIEW IF EXISTS `dwh_dim_partners_v` */;
/*!50001 DROP TABLE IF EXISTS `dwh_dim_partners_v` */;

/*!50001 CREATE TABLE `dwh_dim_partners_v` (
  `partner_id` int(11) NOT NULL,
  `partner_name` varchar(256) CHARACTER SET utf8 DEFAULT NULL,
  `url1` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `url2` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `secret` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `admin_secret` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `max_number_of_hits_per_day` int(11) DEFAULT NULL,
  `appear_in_search` tinyint(4) DEFAULT NULL,
  `debug_level` tinyint(4) DEFAULT NULL,
  `invalid_login_count` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_date_id` int(11) DEFAULT NULL,
  `created_hour_id` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_date_id` int(11) DEFAULT NULL,
  `updated_hour_id` tinyint(4) DEFAULT NULL,
  `partner_alias` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `anonymous_kuser_id` int(11) DEFAULT NULL,
  `ks_max_expiry_in_seconds` int(11) DEFAULT NULL,
  `create_user_on_demand` tinyint(4) DEFAULT NULL,
  `prefix` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `admin_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `admin_email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `commercial_use` tinyint(4) DEFAULT NULL,
  `moderate_content` tinyint(4) DEFAULT NULL,
  `notify` tinyint(4) DEFAULT NULL,
  `custom_data` text CHARACTER SET utf8,
  `service_config_id` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `partner_status_id` smallint(6) DEFAULT NULL,
  `partner_status_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `content_categories` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `partner_type_id` smallint(6) DEFAULT NULL,
  `partner_type_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `phone` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `describe_yourself` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `adult_content` tinyint(4) DEFAULT NULL,
  `partner_package` tinyint(4) DEFAULT NULL,
  `usage_percent` int(11) DEFAULT NULL,
  `storage_usage` int(11) DEFAULT NULL,
  `eighty_percent_warning` int(11) DEFAULT NULL,
  `usage_limit_warning` int(11) DEFAULT NULL,
  `dwh_creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dwh_update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ri_ind` tinyint(4) NOT NULL DEFAULT '0',
  `priority_group_id` int(11) DEFAULT NULL,
  `work_group_id` int(11) DEFAULT NULL,
  `partner_group_type_id` smallint(6) DEFAULT NULL,
  `partner_group_type_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `partner_parent_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_dim_ui_conf_v` */

DROP TABLE IF EXISTS `dwh_dim_ui_conf_v`;

/*!50001 DROP VIEW IF EXISTS `dwh_dim_ui_conf_v` */;
/*!50001 DROP TABLE IF EXISTS `dwh_dim_ui_conf_v` */;

/*!50001 CREATE TABLE `dwh_dim_ui_conf_v` (
  `ui_conf_id` int(11) NOT NULL,
  `ui_conf_type_id` smallint(6) DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `subp_id` int(11) DEFAULT NULL,
  `conf_file_path` varchar(128) DEFAULT NULL,
  `ui_conf_name` varchar(128) DEFAULT NULL,
  `width` varchar(10) DEFAULT NULL,
  `height` varchar(10) DEFAULT NULL,
  `html_params` varchar(256) DEFAULT NULL,
  `swf_url` varchar(256) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_date_id` int(11) DEFAULT NULL,
  `created_hour_id` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_date_id` int(11) DEFAULT NULL,
  `updated_hour_id` tinyint(4) DEFAULT NULL,
  `conf_vars` varchar(4096) DEFAULT NULL,
  `use_cdn` tinyint(4) DEFAULT NULL,
  `tags` text,
  `custom_data` text,
  `UI_Conf_Status_ID` int(11) DEFAULT NULL,
  `description` varchar(4096) DEFAULT NULL,
  `display_in_search` tinyint(4) DEFAULT NULL,
  `dwh_creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dwh_update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ri_ind` tinyint(4) NOT NULL DEFAULT '0',
  `ui_conf_status_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `ui_conf_type_name` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_fact_events_partitions` */

DROP TABLE IF EXISTS `dwh_fact_events_partitions`;

/*!50001 DROP VIEW IF EXISTS `dwh_fact_events_partitions` */;
/*!50001 DROP TABLE IF EXISTS `dwh_fact_events_partitions` */;

/*!50001 CREATE TABLE `dwh_fact_events_partitions` (
  `table_name` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `partition_name` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `partition_description` longtext CHARACTER SET utf8,
  `table_rows` bigint(21) unsigned NOT NULL DEFAULT '0',
  `create_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_fact_events_v` */

DROP TABLE IF EXISTS `dwh_fact_events_v`;

/*!50001 DROP VIEW IF EXISTS `dwh_fact_events_v` */;
/*!50001 DROP TABLE IF EXISTS `dwh_fact_events_v` */;

/*!50001 CREATE TABLE `dwh_fact_events_v` (
  `file_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_type_id` smallint(6) NOT NULL,
  `client_version` varchar(31) CHARACTER SET utf8 DEFAULT NULL,
  `event_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_date_id` int(11) DEFAULT NULL,
  `event_hour_id` tinyint(4) DEFAULT NULL,
  `session_id` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `partner_id` int(11) DEFAULT NULL,
  `entry_id` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `unique_viewer` varchar(40) CHARACTER SET utf8 DEFAULT NULL,
  `widget_id` varchar(31) CHARACTER SET utf8 DEFAULT NULL,
  `ui_conf_id` int(11) DEFAULT NULL,
  `uid` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `current_point` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `user_ip` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `user_ip_number` int(10) unsigned DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `process_duration` int(11) DEFAULT NULL,
  `control_id` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `seek` int(11) DEFAULT NULL,
  `new_point` int(11) DEFAULT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `referrer` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `dwh_fact_partner_activities_v` */

DROP TABLE IF EXISTS `dwh_fact_partner_activities_v`;

/*!50001 DROP VIEW IF EXISTS `dwh_fact_partner_activities_v` */;
/*!50001 DROP TABLE IF EXISTS `dwh_fact_partner_activities_v` */;

/*!50001 CREATE TABLE `dwh_fact_partner_activities_v` (
  `activity_id` int(11) NOT NULL,
  `partner_id` int(11) DEFAULT '-1',
  `activity_date` date DEFAULT NULL,
  `activity_date_id` int(11) DEFAULT '-1',
  `activity_hour_id` tinyint(4) DEFAULT '-1',
  `partner_activity_id` smallint(6) DEFAULT '-1',
  `partner_sub_activity_id` smallint(6) DEFAULT '-1',
  `amount` bigint(20) DEFAULT NULL,
  `amount1` bigint(20) DEFAULT '0',
  `amount2` bigint(20) DEFAULT '0',
  `amount3` int(11) DEFAULT '0',
  `amount4` int(11) DEFAULT '0',
  `amount5` int(11) DEFAULT '0',
  `amount6` int(11) DEFAULT '0',
  `amount7` int(11) DEFAULT '0',
  `amount8` int(11) DEFAULT '0',
  `amount9` int(11) DEFAULT '0',
  `dwh_creation_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dwh_update_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ri_ind` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `ri_defaults_grouped` */

DROP TABLE IF EXISTS `ri_defaults_grouped`;

/*!50001 DROP VIEW IF EXISTS `ri_defaults_grouped` */;
/*!50001 DROP TABLE IF EXISTS `ri_defaults_grouped` */;

/*!50001 CREATE TABLE `ri_defaults_grouped` (
  `table_name` varchar(300) DEFAULT NULL,
  `default_fields` longtext,
  `default_values` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*Table structure for table `ri_mapping_and_defaults` */

DROP TABLE IF EXISTS `ri_mapping_and_defaults`;

/*!50001 DROP VIEW IF EXISTS `ri_mapping_and_defaults` */;
/*!50001 DROP TABLE IF EXISTS `ri_mapping_and_defaults` */;

/*!50001 CREATE TABLE `ri_mapping_and_defaults` (
  `table_name` varchar(300) DEFAULT NULL,
  `column_name` varchar(300) DEFAULT NULL,
  `date_id_column_name` varchar(300) DEFAULT NULL,
  `reference_table` varchar(300) DEFAULT NULL,
  `reference_column` varchar(300) DEFAULT NULL,
  `perform_check` tinyint(1) DEFAULT NULL,
  `default_fields` longtext,
  `default_values` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*View structure for view dwh_aggr_active_partners_v */

/*!50001 DROP TABLE IF EXISTS `dwh_aggr_active_partners_v` */;
/*!50001 DROP VIEW IF EXISTS `dwh_aggr_active_partners_v` */;

/*!50001 CREATE ALGORITHM=TEMPTABLE DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_aggr_active_partners_v` AS (select `a`.`partner_id` AS `partner_id`,`a`.`month_id` AS `month_id`,`a`.`last_calculated_date_id` AS `date_id`,`a`.`flag_active_site` AS `active_site`,`a`.`flag_active_publisher` AS `active_partner` from `dwh_aggr_monthly_partner` `a`) */;

/*View structure for view dwh_aggr_events_entry_partitions */

/*!50001 DROP TABLE IF EXISTS `dwh_aggr_events_entry_partitions` */;
/*!50001 DROP VIEW IF EXISTS `dwh_aggr_events_entry_partitions` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_aggr_events_entry_partitions` AS select `partitions`.`TABLE_NAME` AS `table_name`,`partitions`.`PARTITION_NAME` AS `partition_name`,`partitions`.`PARTITION_DESCRIPTION` AS `partition_description`,`partitions`.`TABLE_ROWS` AS `table_rows`,`partitions`.`CREATE_TIME` AS `create_time` from `information_schema`.`partitions` where (`partitions`.`TABLE_NAME` in ('dwh_aggr_events_entry','dwh_aggr_events_country','dwh_aggr_events_domain','dwh_aggr_partner')) */;

/*View structure for view dwh_dim_countries */

/*!50001 DROP TABLE IF EXISTS `dwh_dim_countries` */;
/*!50001 DROP VIEW IF EXISTS `dwh_dim_countries` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_dim_countries` AS (select `dwh_dim_locations`.`country` AS `country`,`dwh_dim_locations`.`country_id` AS `country_id` from `dwh_dim_locations` where (`dwh_dim_locations`.`location_type_name` = 'country')) */;

/*View structure for view dwh_dim_countries_states */

/*!50001 DROP TABLE IF EXISTS `dwh_dim_countries_states` */;
/*!50001 DROP VIEW IF EXISTS `dwh_dim_countries_states` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_dim_countries_states` AS (select `dwh_dim_locations`.`country` AS `country`,`dwh_dim_locations`.`country_id` AS `country_id`,`dwh_dim_locations`.`state` AS `state`,`dwh_dim_locations`.`state_id` AS `state_id` from `dwh_dim_locations` where (`dwh_dim_locations`.`location_type_name` = 'state')) */;

/*View structure for view dwh_dim_entries_v */

/*!50001 DROP TABLE IF EXISTS `dwh_dim_entries_v` */;
/*!50001 DROP VIEW IF EXISTS `dwh_dim_entries_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_dim_entries_v` AS select `a`.`entry_id` AS `entry_id`,`a`.`entry_name` AS `entry_name`,`a`.`partner_id` AS `partner_id`,`a`.`entry_source_id` AS `entry_source_id`,`a`.`created_at` AS `created_at`,`a`.`created_date_id` AS `created_date_id`,`a`.`created_hour_id` AS `created_hour_id`,`a`.`updated_date_id` AS `updated_date_id`,`a`.`updated_hour_id` AS `updated_hour_id`,`a`.`entry_type_id` AS `entry_type_id`,`c`.`entry_type_name` AS `entry_type_Name`,`b`.`entry_status_id` AS `entry_status_id`,`b`.`entry_status_name` AS `entry_status_Name`,`d`.`entry_media_type_id` AS `entry_media_type_id`,`e`.`partner_name` AS `partner_name`,`d`.`entry_media_type_name` AS `entry_media_type_name` from ((((`dwh_dim_entries` `a` left join `dwh_dim_entry_status` `b` on((`a`.`entry_status_id` = `b`.`entry_status_id`))) left join `dwh_dim_entry_type` `c` on((`a`.`entry_type_id` = `c`.`entry_type_id`))) left join `dwh_dim_entry_media_type` `d` on((`a`.`entry_media_type_id` = `d`.`entry_media_type_id`))) left join `dwh_dim_partners` `e` on((`a`.`partner_id` = `e`.`partner_id`))) */;

/*View structure for view dwh_dim_partners_v */

/*!50001 DROP TABLE IF EXISTS `dwh_dim_partners_v` */;
/*!50001 DROP VIEW IF EXISTS `dwh_dim_partners_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_dim_partners_v` AS (select `a`.`partner_id` AS `partner_id`,`a`.`partner_name` AS `partner_name`,`a`.`url1` AS `url1`,`a`.`url2` AS `url2`,`a`.`secret` AS `secret`,`a`.`admin_secret` AS `admin_secret`,`a`.`max_number_of_hits_per_day` AS `max_number_of_hits_per_day`,`a`.`appear_in_search` AS `appear_in_search`,`a`.`debug_level` AS `debug_level`,`a`.`invalid_login_count` AS `invalid_login_count`,`a`.`created_at` AS `created_at`,`a`.`created_date_id` AS `created_date_id`,`a`.`created_hour_id` AS `created_hour_id`,`a`.`updated_at` AS `updated_at`,`a`.`updated_date_id` AS `updated_date_id`,`a`.`updated_hour_id` AS `updated_hour_id`,`a`.`partner_alias` AS `partner_alias`,`a`.`anonymous_kuser_id` AS `anonymous_kuser_id`,`a`.`ks_max_expiry_in_seconds` AS `ks_max_expiry_in_seconds`,`a`.`create_user_on_demand` AS `create_user_on_demand`,`a`.`prefix` AS `prefix`,`a`.`admin_name` AS `admin_name`,`a`.`admin_email` AS `admin_email`,`a`.`description` AS `description`,`a`.`commercial_use` AS `commercial_use`,`a`.`moderate_content` AS `moderate_content`,`a`.`notify` AS `notify`,`a`.`custom_data` AS `custom_data`,`a`.`service_config_id` AS `service_config_id`,`a`.`partner_status_id` AS `partner_status_id`,`b`.`partner_status_name` AS `partner_status_name`,`a`.`content_categories` AS `content_categories`,`a`.`partner_type_id` AS `partner_type_id`,`c`.`partner_type_name` AS `partner_type_name`,`a`.`phone` AS `phone`,`a`.`describe_yourself` AS `describe_yourself`,`a`.`adult_content` AS `adult_content`,`a`.`partner_package` AS `partner_package`,`a`.`usage_percent` AS `usage_percent`,`a`.`storage_usage` AS `storage_usage`,`a`.`eighty_percent_warning` AS `eighty_percent_warning`,`a`.`usage_limit_warning` AS `usage_limit_warning`,`a`.`dwh_creation_date` AS `dwh_creation_date`,`a`.`dwh_update_date` AS `dwh_update_date`,`a`.`ri_ind` AS `ri_ind`,`a`.`priority_group_id` AS `priority_group_id`,`a`.`work_group_id` AS `work_group_id`,`a`.`partner_group_type_id` AS `partner_group_type_id`,`d`.`partner_group_type_name` AS `partner_group_type_name`,`a`.`partner_parent_id` AS `partner_parent_id` from (((`dwh_dim_partners` `a` left join `dwh_dim_partner_status` `b` on((`a`.`partner_status_id` = `b`.`partner_status_id`))) left join `dwh_dim_partner_type` `c` on((`a`.`partner_type_id` = `c`.`partner_type_id`))) left join `dwh_dim_partner_group_type` `d` on((`a`.`partner_group_type_id` = `d`.`partner_group_type_id`)))) */;

/*View structure for view dwh_dim_ui_conf_v */

/*!50001 DROP TABLE IF EXISTS `dwh_dim_ui_conf_v` */;
/*!50001 DROP VIEW IF EXISTS `dwh_dim_ui_conf_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_dim_ui_conf_v` AS (select `a`.`ui_conf_id` AS `ui_conf_id`,`a`.`ui_conf_type_id` AS `ui_conf_type_id`,`a`.`partner_id` AS `partner_id`,`a`.`subp_id` AS `subp_id`,`a`.`conf_file_path` AS `conf_file_path`,`a`.`ui_conf_name` AS `ui_conf_name`,`a`.`width` AS `width`,`a`.`height` AS `height`,`a`.`html_params` AS `html_params`,`a`.`swf_url` AS `swf_url`,`a`.`created_at` AS `created_at`,`a`.`created_date_id` AS `created_date_id`,`a`.`created_hour_id` AS `created_hour_id`,`a`.`updated_at` AS `updated_at`,`a`.`updated_date_id` AS `updated_date_id`,`a`.`updated_hour_id` AS `updated_hour_id`,`a`.`conf_vars` AS `conf_vars`,`a`.`use_cdn` AS `use_cdn`,`a`.`tags` AS `tags`,`a`.`custom_data` AS `custom_data`,`a`.`UI_Conf_Status_ID` AS `UI_Conf_Status_ID`,`a`.`description` AS `description`,`a`.`display_in_search` AS `display_in_search`,`a`.`dwh_creation_date` AS `dwh_creation_date`,`a`.`dwh_update_date` AS `dwh_update_date`,`a`.`ri_ind` AS `ri_ind`,`b`.`ui_conf_status_name` AS `ui_conf_status_name`,`c`.`ui_conf_type_name` AS `ui_conf_type_name` from ((`dwh_dim_ui_conf` `a` left join `dwh_dim_ui_conf_status` `b` on((`a`.`UI_Conf_Status_ID` = `b`.`ui_conf_status_id`))) left join `dwh_dim_ui_conf_type` `c` on((`a`.`ui_conf_type_id` = `c`.`ui_conf_type_id`)))) */;

/*View structure for view dwh_fact_events_partitions */

/*!50001 DROP TABLE IF EXISTS `dwh_fact_events_partitions` */;
/*!50001 DROP VIEW IF EXISTS `dwh_fact_events_partitions` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_fact_events_partitions` AS select `partitions`.`TABLE_NAME` AS `table_name`,`partitions`.`PARTITION_NAME` AS `partition_name`,`partitions`.`PARTITION_DESCRIPTION` AS `partition_description`,`partitions`.`TABLE_ROWS` AS `table_rows`,`partitions`.`CREATE_TIME` AS `create_time` from `information_schema`.`partitions` where (`partitions`.`TABLE_NAME` = 'dwh_fact_events') */;

/*View structure for view dwh_fact_events_v */

/*!50001 DROP TABLE IF EXISTS `dwh_fact_events_v` */;
/*!50001 DROP VIEW IF EXISTS `dwh_fact_events_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_fact_events_v` AS (select `dwh_fact_events`.`file_id` AS `file_id`,`dwh_fact_events`.`event_id` AS `event_id`,`dwh_fact_events`.`event_type_id` AS `event_type_id`,`dwh_fact_events`.`client_version` AS `client_version`,`dwh_fact_events`.`event_time` AS `event_time`,`dwh_fact_events`.`event_date_id` AS `event_date_id`,`dwh_fact_events`.`event_hour_id` AS `event_hour_id`,`dwh_fact_events`.`session_id` AS `session_id`,`dwh_fact_events`.`partner_id` AS `partner_id`,`dwh_fact_events`.`entry_id` AS `entry_id`,`dwh_fact_events`.`unique_viewer` AS `unique_viewer`,`dwh_fact_events`.`widget_id` AS `widget_id`,`dwh_fact_events`.`ui_conf_id` AS `ui_conf_id`,`dwh_fact_events`.`uid` AS `uid`,`dwh_fact_events`.`current_point` AS `current_point`,`dwh_fact_events`.`duration` AS `duration`,`dwh_fact_events`.`user_ip` AS `user_ip`,`dwh_fact_events`.`user_ip_number` AS `user_ip_number`,`dwh_fact_events`.`country_id` AS `country_id`,`dwh_fact_events`.`location_id` AS `location_id`,`dwh_fact_events`.`process_duration` AS `process_duration`,`dwh_fact_events`.`control_id` AS `control_id`,`dwh_fact_events`.`seek` AS `seek`,`dwh_fact_events`.`new_point` AS `new_point`,`dwh_fact_events`.`domain_id` AS `domain_id`,`dwh_fact_events`.`referrer` AS `referrer` from `dwh_fact_events` where (`dwh_fact_events`.`event_date_id` between cast((curdate() + interval -(1) day) as unsigned) and cast((curdate() + interval -(0) day) as unsigned))) */;

/*View structure for view dwh_fact_partner_activities_v */

/*!50001 DROP TABLE IF EXISTS `dwh_fact_partner_activities_v` */;
/*!50001 DROP VIEW IF EXISTS `dwh_fact_partner_activities_v` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `dwh_fact_partner_activities_v` AS (select `dwh_fact_partner_activities`.`activity_id` AS `activity_id`,`dwh_fact_partner_activities`.`partner_id` AS `partner_id`,`dwh_fact_partner_activities`.`activity_date` AS `activity_date`,`dwh_fact_partner_activities`.`activity_date_id` AS `activity_date_id`,`dwh_fact_partner_activities`.`activity_hour_id` AS `activity_hour_id`,`dwh_fact_partner_activities`.`partner_activity_id` AS `partner_activity_id`,`dwh_fact_partner_activities`.`partner_sub_activity_id` AS `partner_sub_activity_id`,`dwh_fact_partner_activities`.`amount` AS `amount`,`dwh_fact_partner_activities`.`amount1` AS `amount1`,`dwh_fact_partner_activities`.`amount2` AS `amount2`,`dwh_fact_partner_activities`.`amount3` AS `amount3`,`dwh_fact_partner_activities`.`amount4` AS `amount4`,`dwh_fact_partner_activities`.`amount5` AS `amount5`,`dwh_fact_partner_activities`.`amount6` AS `amount6`,`dwh_fact_partner_activities`.`amount7` AS `amount7`,`dwh_fact_partner_activities`.`amount8` AS `amount8`,`dwh_fact_partner_activities`.`amount9` AS `amount9`,`dwh_fact_partner_activities`.`dwh_creation_date` AS `dwh_creation_date`,`dwh_fact_partner_activities`.`dwh_update_date` AS `dwh_update_date`,`dwh_fact_partner_activities`.`ri_ind` AS `ri_ind` from `dwh_fact_partner_activities` limit 1000) */;

/*View structure for view ri_defaults_grouped */

/*!50001 DROP TABLE IF EXISTS `ri_defaults_grouped` */;
/*!50001 DROP VIEW IF EXISTS `ri_defaults_grouped` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `ri_defaults_grouped` AS (select `ri_defaults`.`table_name` AS `table_name`,group_concat(`ri_defaults`.`default_field` order by `ri_defaults`.`default_field` ASC separator ',') AS `default_fields`,concat('"',group_concat(`ri_defaults`.`default_value` order by `ri_defaults`.`default_field` ASC separator '","'),'"') AS `default_values` from `ri_defaults` group by `ri_defaults`.`table_name`) */;

/*View structure for view ri_mapping_and_defaults */

/*!50001 DROP TABLE IF EXISTS `ri_mapping_and_defaults` */;
/*!50001 DROP VIEW IF EXISTS `ri_mapping_and_defaults` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `ri_mapping_and_defaults` AS (select `m`.`table_name` AS `table_name`,`m`.`column_name` AS `column_name`,`m`.`date_id_column_name` AS `date_id_column_name`,`m`.`reference_table` AS `reference_table`,`m`.`reference_column` AS `reference_column`,`m`.`perform_check` AS `perform_check`,`dg`.`default_fields` AS `default_fields`,`dg`.`default_values` AS `default_values` from (`ri_mapping` `m` join `ri_defaults_grouped` `dg`) where (`m`.`reference_table` = `dg`.`table_name`)) */;

USE `kalturadw_ds`;

CREATE TABLE `fms_incomplete_sessions` (
  `session_id` VARCHAR(20) DEFAULT NULL,
  `session_time` DATETIME DEFAULT NULL,
  `updated_time` DATETIME DEFAULT NULL,
  `session_date_id` INT(11) UNSIGNED DEFAULT NULL,
  `con_cs_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `con_sc_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `dis_cs_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `dis_sc_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `partner_id` INT(10) UNSIGNED DEFAULT NULL
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Table structure for table `fms_stale_sessions` */

CREATE TABLE `fms_stale_sessions` (
  `session_id` VARCHAR(20) DEFAULT NULL,
  `session_time` DATETIME DEFAULT NULL,
  `last_update_time` DATETIME DEFAULT NULL,
  `purge_time` DATETIME DEFAULT NULL,
  `session_date_id` INT(11) UNSIGNED DEFAULT NULL,
  `con_cs_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `con_sc_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `dis_cs_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `dis_sc_bytes` BIGINT(20) UNSIGNED DEFAULT NULL,
  `partner_id` INT(10) UNSIGNED DEFAULT NULL
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

ALTER TABLE `invalid_event_lines`
ADD  KEY `date_id_partner_id` (`date_id`,`partner_id`);

CREATE TABLE `invalid_fms_event_lines` (
  `line_id` INT(11) NOT NULL AUTO_INCREMENT,
  `line_number` INT(11) DEFAULT NULL,
  `file_id` INT(11) NOT NULL,
  `error_reason_code` SMALLINT(6) DEFAULT NULL,
  `error_reason` VARCHAR(255) DEFAULT NULL,
  `event_line` VARCHAR(1023) DEFAULT NULL,
  `insert_time` DATETIME DEFAULT NULL,
  `date_id` INT(11) DEFAULT NULL,
  `entry_id` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`line_id`),
  KEY `date_id_partner_id` (`date_id`,`entry_id`),
  KEY `file_reason_code` (`file_id`,`error_reason_code`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ods_fms_session_events` (
  `file_id` INT(11) UNSIGNED NOT NULL,
  `event_type_id` TINYINT(3) UNSIGNED NOT NULL,
  `event_category_id` TINYINT(3) UNSIGNED NOT NULL,
  `event_time` DATETIME NOT NULL,
  `event_time_tz` VARCHAR(3) NOT NULL,
  `event_date_id` INT(11) NOT NULL,
  `event_hour_id` TINYINT(3) NOT NULL,
  `context` VARCHAR(100) DEFAULT NULL,
  `entry_id` VARCHAR(20) DEFAULT NULL,
  `partner_id` INT(10) DEFAULT NULL,
  `external_id` VARCHAR(50) DEFAULT NULL,
  `server_ip` INT(10) UNSIGNED DEFAULT NULL,
  `server_process_id` INT(10) UNSIGNED NOT NULL,
  `server_cpu_load` SMALLINT(5) UNSIGNED NOT NULL,
  `server_memory_load` SMALLINT(5) UNSIGNED NOT NULL,
  `adaptor_id` SMALLINT(5) UNSIGNED NOT NULL,
  `virtual_host_id` SMALLINT(5) UNSIGNED NOT NULL,
  `app_id` TINYINT(3) UNSIGNED NOT NULL,
  `app_instance_id` TINYINT(3) UNSIGNED NOT NULL,
  `duration_secs` INT(10) UNSIGNED NOT NULL,
  `status_id` SMALLINT(3) UNSIGNED DEFAULT NULL,
  `status_desc_id` TINYINT(3) UNSIGNED NOT NULL,
  `client_ip_str` VARCHAR(15) NOT NULL,
  `client_ip` INT(10) UNSIGNED NOT NULL,
  `client_country_id` INT(10) UNSIGNED DEFAULT '0',
  `client_location_id` INT(10) UNSIGNED DEFAULT '0',
  `client_protocol_id` TINYINT(3) UNSIGNED NOT NULL,
  `uri` VARCHAR(4000) NOT NULL,
  `uri_stem` VARCHAR(2000) DEFAULT NULL,
  `uri_query` VARCHAR(2000) DEFAULT NULL,
  `referrer` VARCHAR(4000) DEFAULT NULL,
  `user_agent` VARCHAR(2000) DEFAULT NULL,
  `session_id` VARCHAR(20) NOT NULL,
  `client_to_server_bytes` BIGINT(20) UNSIGNED NOT NULL,
  `server_to_client_bytes` BIGINT(20) UNSIGNED NOT NULL,
  `stream_name` VARCHAR(50) DEFAULT NULL,
  `stream_query` VARCHAR(50) DEFAULT NULL,
  `stream_file_name` VARCHAR(4000) DEFAULT NULL,
  `stream_type_id` TINYINT(3) UNSIGNED DEFAULT NULL,
  `stream_size_bytes` INT(11) DEFAULT NULL,
  `stream_length_secs` INT(11) DEFAULT NULL,
  `stream_position` INT(11) DEFAULT NULL,
  `client_to_server_stream_bytes` INT(10) UNSIGNED DEFAULT NULL,
  `server_to_client_stream_bytes` INT(10) UNSIGNED DEFAULT NULL,
  `server_to_client_qos_bytes` INT(10) UNSIGNED DEFAULT NULL
) ENGINE=MYISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY LIST (file_id)
(PARTITION p_0 VALUES IN (0) ENGINE = MyISAM,
 PARTITION p_12851 VALUES IN (12851) ENGINE = MyISAM,
 PARTITION p_12852 VALUES IN (12852) ENGINE = MyISAM,
 PARTITION p_12854 VALUES IN (12854) ENGINE = MyISAM,
 PARTITION p_12855 VALUES IN (12855) ENGINE = MyISAM,
 PARTITION p_12856 VALUES IN (12856) ENGINE = MyISAM,
 PARTITION p_12857 VALUES IN (12857) ENGINE = MyISAM,
 PARTITION p_12858 VALUES IN (12858) ENGINE = MyISAM,
 PARTITION p_12859 VALUES IN (12859) ENGINE = MyISAM,
 PARTITION p_12860 VALUES IN (12860) ENGINE = MyISAM,
 PARTITION p_12861 VALUES IN (12861) ENGINE = MyISAM,
 PARTITION p_12862 VALUES IN (12862) ENGINE = MyISAM,
 PARTITION p_12863 VALUES IN (12863) ENGINE = MyISAM,
 PARTITION p_12864 VALUES IN (12864) ENGINE = MyISAM,
 PARTITION p_12865 VALUES IN (12865) ENGINE = MyISAM,
 PARTITION p_12866 VALUES IN (12866) ENGINE = MyISAM,
 PARTITION p_12870 VALUES IN (12870) ENGINE = MyISAM,
 PARTITION p_12872 VALUES IN (12872) ENGINE = MyISAM,
 PARTITION p_12873 VALUES IN (12873) ENGINE = MyISAM,
 PARTITION p_12874 VALUES IN (12874) ENGINE = MyISAM,
 PARTITION p_12875 VALUES IN (12875) ENGINE = MyISAM,
 PARTITION p_12876 VALUES IN (12876) ENGINE = MyISAM,
 PARTITION p_12877 VALUES IN (12877) ENGINE = MyISAM,
 PARTITION p_12878 VALUES IN (12878) ENGINE = MyISAM,
 PARTITION p_12879 VALUES IN (12879) ENGINE = MyISAM,
 PARTITION p_12880 VALUES IN (12880) ENGINE = MyISAM,
 PARTITION p_12881 VALUES IN (12881) ENGINE = MyISAM,
 PARTITION p_12882 VALUES IN (12882) ENGINE = MyISAM,
 PARTITION p_12883 VALUES IN (12883) ENGINE = MyISAM,
 PARTITION p_12884 VALUES IN (12884) ENGINE = MyISAM,
 PARTITION p_12885 VALUES IN (12885) ENGINE = MyISAM,
 PARTITION p_12886 VALUES IN (12886) ENGINE = MyISAM,
 PARTITION p_12887 VALUES IN (12887) ENGINE = MyISAM,
 PARTITION p_12888 VALUES IN (12888) ENGINE = MyISAM,
 PARTITION p_12894 VALUES IN (12894) ENGINE = MyISAM,
 PARTITION p_12897 VALUES IN (12897) ENGINE = MyISAM,
 PARTITION p_12899 VALUES IN (12899) ENGINE = MyISAM,
 PARTITION p_12901 VALUES IN (12901) ENGINE = MyISAM,
 PARTITION p_12902 VALUES IN (12902) ENGINE = MyISAM,
 PARTITION p_12903 VALUES IN (12903) ENGINE = MyISAM,
 PARTITION p_12905 VALUES IN (12905) ENGINE = MyISAM,
 PARTITION p_12906 VALUES IN (12906) ENGINE = MyISAM,
 PARTITION p_12907 VALUES IN (12907) ENGINE = MyISAM,
 PARTITION p_12908 VALUES IN (12908) ENGINE = MyISAM,
 PARTITION p_12913 VALUES IN (12913) ENGINE = MyISAM,
 PARTITION p_12915 VALUES IN (12915) ENGINE = MyISAM,
 PARTITION p_12922 VALUES IN (12922) ENGINE = MyISAM,
 PARTITION p_12925 VALUES IN (12925) ENGINE = MyISAM,
 PARTITION p_12926 VALUES IN (12926) ENGINE = MyISAM,
 PARTITION p_12928 VALUES IN (12928) ENGINE = MyISAM,
 PARTITION p_12929 VALUES IN (12929) ENGINE = MyISAM,
 PARTITION p_12932 VALUES IN (12932) ENGINE = MyISAM,
 PARTITION p_12933 VALUES IN (12933) ENGINE = MyISAM,
 PARTITION p_12936 VALUES IN (12936) ENGINE = MyISAM,
 PARTITION p_13036 VALUES IN (13036) ENGINE = MyISAM) */;
 
 /* Function  structure for function  `get_ip_country_location` */

/*!50003 DROP FUNCTION IF EXISTS `get_ip_country_location` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` FUNCTION `get_ip_country_location`(ip BIGINT) RETURNS varchar(30) CHARSET latin1
BEGIN
	DECLARE res VARCHAR(30);
	SELECT CONCAT(country_id,",",location_id)
	INTO res
	FROM kalturadw.dwh_dim_ip_ranges
	WHERE ip_from = (
	SELECT MAX(ip_from) 
	FROM kalturadw.dwh_dim_ip_ranges
	WHERE ip >= ip_from
	) ;
	RETURN res;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `add_file_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_file_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `add_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
CALL add_ods_partition(partition_number,'ds_events');
END */$$
DELIMITER ;

/* Procedure structure for procedure `add_ods_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_ods_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `add_ods_partition`(
	partition_number VARCHAR(10),
table_name VARCHAR(32)
)
BEGIN
	SET @s = CONCAT('alter table ',table_name,' ADD PARTITION (partition p_' ,
			partition_number ,' values in (', partition_number ,'))');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END */$$
DELIMITER ;

/* Procedure structure for procedure `agg_new_fms_to_partner_activity` */

/*!50003 DROP PROCEDURE IF EXISTS  `agg_new_fms_to_partner_activity` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `agg_new_fms_to_partner_activity`()
BEGIN

  DECLARE DEFAULT_ACTIVITY_ID integer;

  DECLARE STREAMING_ACTIVITY_ID integer;

  DECLARE STREAMING_SUB_ACTIVITY integer;

  SET DEFAULT_ACTIVITY_ID = 1;

  SET STREAMING_ACTIVITY_ID = 7;

  SET STREAMING_SUB_ACTIVITY = 700;



  insert into kalturadw.dwh_fact_partner_activities

  (activity_id,partner_id,activity_date,activity_date_id,activity_hour_id,partner_activity_id,partner_sub_activity_id,amount)

  select DEFAULT_ACTIVITY_ID,session_partner_id,date(session_time),session_date_id,0 hour_id,STREAMING_ACTIVITY_ID,STREAMING_SUB_ACTIVITY,sum(total_bytes)

  from kalturadw.dwh_fact_fms_sessions

  where session_date_id in (

    select distinct aggr_day_int

    from kalturadw.aggr_managment

    where aggr_name = 'fms_sessions' and is_calculated = 0 and aggr_day <= now())

  group by session_partner_id,date(session_time),session_date_id

  on duplicate key update

    amount=values(amount);



  update kalturadw.aggr_managment

  set is_calculated = 1

  where aggr_name = 'fms_sessions' and aggr_day <= now();

END */$$
DELIMITER ;

/* Procedure structure for procedure `create_updated_entries` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_updated_entries` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `create_updated_entries`(max_date date)
BEGIN
	truncate table updated_entries;
	
	update kalturadw.aggr_managment set start_time = now() where is_calculated = 0 and aggr_day < max_date and aggr_name = 'plays_views';
	
	insert into updated_entries SELECT entries.entry_id, SUM(count_loads)+ifnull(old_entries.views,0) views, SUM(count_plays)+ifnull(old_entries.plays,0) plays FROM 
	(SELECT entry_id 
		FROM kalturadw.dwh_aggr_events_entry e
		INNER JOIN kalturadw.aggr_managment m ON (e.date_id = m.aggr_day_int)
		WHERE is_calculated = 0 
		  and m.aggr_day < max_date
		  AND m.aggr_name = 'plays_views') entries
	INNER JOIN
	kalturadw.dwh_aggr_events_entry
	ON (dwh_aggr_events_entry.entry_id = entries.entry_id)
	left outer join
	kalturadw.entry_plays_views_before_08_2009 as old_entries
	on (entries.entry_id = old_entries.entry_id)
	GROUP BY entries.entry_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `create_updated_entries_by_partner_id` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_updated_entries_by_partner_id` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `create_updated_entries_by_partner_id`(p_partner_id INT(11))
BEGIN
	TRUNCATE TABLE updated_entries;
	
	INSERT INTO updated_entries 
		SELECT entries.entry_id, SUM(count_loads)+IFNULL(old_entries.views,0) views, SUM(count_plays)+IFNULL(old_entries.plays,0) plays FROM 
		kalturadw.dwh_aggr_events_entry entries
		LEFT OUTER JOIN
		kalturadw.entry_plays_views_before_08_2009 AS old_entries
		ON (entries.entry_id = old_entries.entry_id)
		WHERE entries.partner_id = p_partner_id
		GROUP BY entries.entry_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `drop_file_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `drop_file_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `drop_file_partition`(
	partition_number VARCHAR(10)
	)
BEGIN
CALL drop_ods_partition(partition_number,'ds_events');
END */$$
DELIMITER ;

/* Procedure structure for procedure `drop_ods_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `drop_ods_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `drop_ods_partition`(
	partition_number VARCHAR(10),
table_name VARCHAR(32)
	)
BEGIN
	SET @s = CONCAT('alter table ',table_name,' drop PARTITION  p_' ,
			partition_number );
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END */$$
DELIMITER ;

/* Procedure structure for procedure `empty_file_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `empty_file_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `empty_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
	CALL drop_file_partition(partition_number);
	CALL add_file_partition(partition_number);
END */$$
DELIMITER ;

/* Procedure structure for procedure `empty_ods_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `empty_ods_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `empty_ods_partition`(
	partition_number VARCHAR(10),
table_name VARCHAR(32)
)
BEGIN
	CALL drop_ods_partition(partition_number,table_name);
	CALL add_ods_partition(partition_number,table_name);
END */$$
DELIMITER ;

/* Procedure structure for procedure `fms_sessionize` */

/*!50003 DROP PROCEDURE IF EXISTS  `fms_sessionize` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `fms_sessionize`(

  partition_id INTEGER)
BEGIN
  DECLARE SESSION_DATE_IDS VARCHAR(4000);
  DECLARE FMS_STALE_SESSION_PURGE datetime;

  select subdate(now(),INTERVAL 3 DAY) into FMS_STALE_SESSION_PURGE;
  # FMS_STALE_SESSION_PURGE decides when incomplete session are purged
  # because mysql doesn't support multi-table insert (as opposed to oracle)
  # ods_temp_fms_session_aggr is used as a helper table
  # for storing an intermediate aggregate of sessions in ods_fms_session_events
  # *its basically just an optimization to prevent the same query from running twice on
  # ods_fms_session_events which has an order of magnitude or two less data after aggregation
  # table creations are in the stored procedure because they're temporary tables (get destroyed
  # when the connection is disconnected) and results in self-documenting/less code to manage since
  # the temp tables only serve internal data processing optimizations
  DROP TABLE IF EXISTS ods_temp_fms_session_aggr;
  DROP TABLE IF EXISTS ods_temp_fms_sessions;

  CREATE TEMPORARY TABLE ods_temp_fms_session_aggr (
    agg_session_id       varchar(20) not null,
    agg_session_time     datetime    not null,
    agg_session_date_id  int(11)     unsigned,
    agg_con_cs_bytes     bigint      unsigned,
    agg_con_sc_bytes     bigint      unsigned,
    agg_dis_cs_bytes     bigint      unsigned,
    agg_dis_sc_bytes     bigint      unsigned,
    agg_partner_id       int(10)     unsigned
  ) engine = memory;

  CREATE TEMPORARY TABLE ods_temp_fms_sessions (
    session_id         varchar(20) not null,
    session_time       datetime    not null,
    session_date_id    int(11)     unsigned,
    session_partner_id int(10)     unsigned,
    total_bytes        bigint      unsigned
   ) engine = memory;

    # 1. aggregate data per session from ods
  insert into ods_temp_fms_session_aggr (agg_session_id,agg_session_time,agg_session_date_id,
              agg_con_cs_bytes,agg_con_sc_bytes,agg_dis_cs_bytes,agg_dis_sc_bytes,agg_partner_id)
  select session_id,max(event_time),max(event_date_id),  #regarding the "max" aggregate, see comment below in "on duplicate key"
    sum(if(t.event_type='connect',client_to_server_bytes,0)) con_cs_bytes,
    sum(if(t.event_type='connect',server_to_client_bytes,0)) con_sc_bytes,
    sum(if(t.event_type='disconnect',client_to_server_bytes,0)) dis_cs_bytes,
    sum(if(t.event_type='disconnect',server_to_client_bytes,0)) dis_sc_bytes,
    max(partner_id) partner_id # assuming there a max of 1 partnerid per session (i.e. no switching between partner in an fms session)
  from ods_fms_session_events e
 inner join kalturadw.dwh_dim_fms_event_type t on e.event_type_id = t.event_type_id
  where file_id = partition_id
  group by session_id;

  # 2. complete sessions that are "self contained" (have connect, disconnect and partner_id data within the current partition)
  # are considered complete and can be immediately aggregated for the partner
  insert into ods_temp_fms_sessions (session_id,session_time,session_date_id,session_partner_id,total_bytes)
  select agg_session_id,agg_session_time,agg_session_date_id,agg_partner_id,
  cast(cast(agg_dis_sc_bytes as signed)-cast(agg_con_sc_bytes as signed)+cast(agg_dis_cs_bytes as signed)-cast(agg_con_cs_bytes as signed) as unsigned)
  from ods_temp_fms_session_aggr
  where agg_partner_id is not null and agg_dis_cs_bytes >0 and agg_con_cs_bytes > 0;

  # 3. incomplete sessions which are missing either a partner id or connect/disconnect data counters are merged into a persistent table
  # the "agg_" column alias prefix is due to a mysql bug regarding same column names in "on duplicate key update"
  insert into fms_incomplete_sessions (session_id,session_time,updated_time,session_date_id,con_cs_bytes,con_sc_bytes,dis_cs_bytes,dis_sc_bytes,partner_id)
  select agg_session_id,agg_session_time,now() as agg_update_time,agg_session_date_id,
         agg_con_cs_bytes,agg_con_sc_bytes,agg_dis_cs_bytes,agg_dis_sc_bytes,agg_partner_id
  from ods_temp_fms_session_aggr
  where agg_con_cs_bytes = 0 or agg_dis_cs_bytes = 0 or agg_partner_id is null
  on duplicate key update
    # sessions are chronologically classified based on their end date
    # they are also billed based on their end date
    # this is a conscious decision - we don't want sessions to "update" billed days retroactively because it would
    # complicate the billing process
    session_time=greatest(session_time,values(session_time)),
    session_date_id=greatest(session_date_id,values(session_date_id)),
    # add up bytes
    con_cs_bytes=con_cs_bytes+values(con_cs_bytes),
    con_sc_bytes=con_sc_bytes+values(con_sc_bytes),
    dis_cs_bytes=dis_cs_bytes+values(dis_cs_bytes),
    dis_sc_bytes=dis_sc_bytes+values(dis_sc_bytes),
    # once a partner_id is found, stick to it
    partner_id=if(partner_id is null,values(partner_id),partner_id),
    # record the last received event
    updated_time=greatest(updated_time,values(updated_time));

    # 4. gather newly completed sessions
  insert into ods_temp_fms_sessions (session_id,session_time,session_date_id,session_partner_id,total_bytes)
  select session_id,session_time,session_date_id,partner_id,
  cast(cast(dis_sc_bytes as signed)-cast(con_sc_bytes as signed)+cast(dis_cs_bytes as signed)-cast(con_cs_bytes as signed) as unsigned)
  from fms_incomplete_sessions
  where partner_id is not null and dis_cs_bytes >0 and con_cs_bytes > 0;

    # 5. store stale sessions
  insert into fms_stale_sessions (partner_id,session_id,session_time,session_date_id,con_cs_bytes,con_sc_bytes,dis_cs_bytes,dis_sc_bytes,last_update_time,purge_time)
  select partner_id,session_id,session_time,session_date_id,con_cs_bytes,con_sc_bytes,dis_cs_bytes,dis_sc_bytes,updated_time,now()
  from fms_incomplete_sessions
  where greatest(session_time,updated_time) < FMS_STALE_SESSION_PURGE and (partner_id is null or dis_cs_bytes =0 or con_cs_bytes = 0);

  # 6. purge completed and stale sessions
  delete from fms_incomplete_sessions
  where (partner_id is not null and dis_cs_bytes >0 and con_cs_bytes > 0) or
       # we choose the last of session and updated time, so that old files being processed have some time before they're pushed out
        greatest(session_time,updated_time) < FMS_STALE_SESSION_PURGE;

  # 7. add all new partner activities to dwh fact table
  insert into kalturadw.dwh_fact_fms_sessions (session_id,session_time,session_date_id,session_partner_id,total_bytes)
  select session_id,session_time,session_date_id,session_partner_id,total_bytes
  from ods_temp_fms_sessions;

  # 8. mark changed dates
  select cast(group_concat(distinct session_date_id) as char)
  into SESSION_DATE_IDS
  from ods_temp_Fms_sessions;

  if length(SESSION_DATE_IDS) > 0 then
    call mark_for_reaggregation(SESSION_DATE_IDS,'fms_sessions');
  end if;
END */$$
DELIMITER ;

/* Procedure structure for procedure `mark_as_aggregated` */

/*!50003 DROP PROCEDURE IF EXISTS  `mark_as_aggregated` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `mark_as_aggregated`( max_date VARCHAR(4000), aggr_name VARCHAR(50))
BEGIN
	SET @s = CONCAT('update kalturadw.aggr_managment set is_calculated=1, end_time=now() ',
			'where aggr_day < ''',max_date,''' ',
            'and is_calculated = 0 ',
			'and (aggr_name = ''',aggr_name,''' or ''all''=''',aggr_name,''');');
	PREPARE stmt FROM @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `mark_for_reaggregation` */

/*!50003 DROP PROCEDURE IF EXISTS  `mark_for_reaggregation` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `mark_for_reaggregation`( date_id_list varchar(4000), aggr_name varchar(50))
BEGIN
	SET @smark4reagg = CONCAT('update kalturadw.aggr_managment set is_calculated=0,start_time=null,end_time=null ',
			'where aggr_day_int in (',date_id_list,') ',
			'and (aggr_name = ''',aggr_name,''' or ''all''=''',aggr_name,''');');
	PREPARE stmtmark FROM @smark4reagg;
	EXECUTE stmtmark;
	DEALLOCATE PREPARE stmtmark;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `restore_file_status` */

/*!50003 DROP PROCEDURE IF EXISTS  `restore_file_status` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `restore_file_status`(
	pfile_id INT(20)
    )
BEGIN
	UPDATE files f
	SET f.file_status = f.prev_status,
	    f.prev_status = f.file_status
	WHERE f.file_id = pfile_id;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `set_file_status` */

/*!50003 DROP PROCEDURE IF EXISTS  `set_file_status` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `set_file_status`(
	pfile_id INT(20),
	new_file_status VARCHAR(20)
    )
BEGIN
	CALL set_file_status_full(pfile_id,new_file_status,1);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `set_file_status_full` */

/*!50003 DROP PROCEDURE IF EXISTS  `set_file_status_full` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `set_file_status_full`(
	pfile_id INT(20),
	new_file_status VARCHAR(20),
	override_safety_check INT
    )
BEGIN
	DECLARE cur_status VARCHAR(20);
	IF override_safety_check = 1 THEN
		SELECT f.file_status
		INTO cur_status
		FROM files f
		WHERE f.file_id = pfile_id;
		IF  new_file_status NOT IN ('WAITING','RUNNING','PROCESSED','TRANSFERING','DONE','FAILED')
		 OR new_file_status = 'RUNNING' AND cur_status <> 'WAITING'
		 OR new_file_status = 'PROCESSED' AND cur_status <> 'RUNNING'
		 OR new_file_status = 'TRANSFERING' AND cur_status <> 'PROCESSED'
		 OR new_file_status = 'DONE' AND cur_status <> 'TRANSFERING'
		THEN
			SET @s = CONCAT('call Illegal_state_trying_to_set_',
					new_file_status,'_to_', cur_status,'_file_',pfile_id);
			PREPARE stmt FROM  @s;
			EXECUTE stmt;
			DEALLOCATE PREPARE stmt;		
		END IF;
	END IF;
	
	UPDATE files f
	SET f.prev_status = f.file_status
	    ,f.file_status = new_file_status
	WHERE f.file_id = pfile_id;
	IF new_file_status = 'RUNNING'
	THEN 
		UPDATE files f
		SET f.run_time = NOW()
		WHERE f.file_id = pfile_id;
	ELSEIF new_file_status = 'TRANSFERING'
	THEN 
		UPDATE files f
		SET f.transfer_time = NOW()
		WHERE f.file_id = pfile_id;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `transfer_file_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `transfer_file_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `transfer_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
	CALL transfer_ods_partition(1,partition_number);
END */$$
DELIMITER ;

/* Procedure structure for procedure `transfer_ods_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `transfer_ods_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`%` PROCEDURE `transfer_ods_partition`(

	staging_area_id INTEGER, partition_number VARCHAR(10)

)
BEGIN
DECLARE src_table VARCHAR(45);
DECLARE tgt_table VARCHAR(45);
DECLARE dup_clause VARCHAR(4000);
DECLARE partition_field VARCHAR(45);
DECLARE select_fields VARCHAR(4000);
DECLARE post_transfer_sp_val VARCHAR(4000);
DECLARE s VARCHAR(4000);

SELECT source_table,target_table,IFNULL(on_duplicate_clause,''),staging_partition_field,post_transfer_sp
INTO src_table,tgt_table,dup_clause,partition_field,post_transfer_sp_val
FROM staging_areas
WHERE id=staging_area_id;

SELECT GROUP_CONCAT(column_name ORDER BY ordinal_position)
INTO select_fields
FROM information_schema.columns
WHERE CONCAT(table_schema,'.',table_name) = tgt_table;
	select CONCAT('insert into ',tgt_table,
 ' select ',select_fields,
			 ' from ',src_table,
			 ' where ',partition_field,'  = ',partition_number,
			 ' ',dup_clause ) into s;
SET @s = s;
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;

  IF LENGTH(post_transfer_sp_val)>0 THEN
    SET @s = CONCAT('call ',post_transfer_sp_val,'(',partition_number,')');
  	PREPARE stmt FROM  @s;
  	EXECUTE stmt;
  	DEALLOCATE PREPARE stmt;
  END IF;

END */$$
DELIMITER ;

/*Table structure for table `ds_events_partitions` */

DROP TABLE IF EXISTS `ds_events_partitions`;

/*!50001 DROP VIEW IF EXISTS `ds_events_partitions` */;
/*!50001 DROP TABLE IF EXISTS `ds_events_partitions` */;

/*!50001 CREATE TABLE `ds_events_partitions` (
  `TABLE_SCHEMA` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `TABLE_NAME` varchar(64) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `PARTITION_NAME` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `partition_number` varchar(190) CHARACTER SET utf8 DEFAULT NULL,
  `table_rows` bigint(21) unsigned NOT NULL DEFAULT '0',
  `CREATE_TIME` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 */;

/*View structure for view ds_events_partitions */

/*!50001 DROP TABLE IF EXISTS `ds_events_partitions` */;
/*!50001 DROP VIEW IF EXISTS `ds_events_partitions` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`etl`@`%` SQL SECURITY DEFINER VIEW `ds_events_partitions` AS (select `partitions`.`TABLE_SCHEMA` AS `TABLE_SCHEMA`,`partitions`.`TABLE_NAME` AS `TABLE_NAME`,`partitions`.`PARTITION_NAME` AS `PARTITION_NAME`,substr(`partitions`.`PARTITION_NAME`,3) AS `partition_number`,`partitions`.`TABLE_ROWS` AS `table_rows`,`partitions`.`CREATE_TIME` AS `CREATE_TIME` from `information_schema`.`partitions` where ((`partitions`.`TABLE_NAME` = 'ds_events') and (`partitions`.`PARTITION_NAME` <> 'p_0'))) */;
