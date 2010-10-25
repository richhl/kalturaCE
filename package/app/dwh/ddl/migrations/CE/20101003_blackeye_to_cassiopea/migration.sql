USE `kalturadw`;

ALTER TABLE `aggr_managment` ADD COLUMN `aggr_day_int` INT(11) UNSIGNED NOT NULL DEFAULT '0';
ALTER TABLE `aggr_managment` DROP PRIMARY KEY;
UPDATE `aggr_managment` SET `aggr_day_int` = DATE_FORMAT(DATE(aggr_day), '%Y%m%d');
ALTER TABLE `aggr_managment` ADD PRIMARY KEY (`aggr_name`,`aggr_day_int`);

SET @from_date='2010-01-01';
SET @to_date='2014-12-31';

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'fms_sessions' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'plays_views' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

INSERT INTO kalturadw.aggr_managment (aggr_name,aggr_day_int,aggr_day,is_calculated,start_time,end_time)
SELECT 'uid' tn,DATE_FORMAT(DATE(date_field), '%Y%m%d'),DATE(date_field) d,0 i,NULL ts,NULL  te
FROM kalturadw.dwh_dim_time
WHERE date_field BETWEEN @from_date AND @to_date;

/* add columns to aggregations */
ALTER TABLE kalturadw.dwh_aggr_events_country
ADD COLUMN `count_open_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_close_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_replay` INT DEFAULT NULL,
ADD COLUMN `count_seek` INT DEFAULT NULL,
ADD COLUMN `count_open_upload` INT DEFAULT NULL,
ADD COLUMN `count_save_publish` INT DEFAULT NULL,
ADD COLUMN `count_close_editor` INT DEFAULT NULL,  
ADD COLUMN `count_pre_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_post_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_bumper_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_started` INT DEFAULT NULL,
ADD COLUMN `count_midroll_started` INT DEFAULT NULL,
ADD COLUMN `count_postroll_started` INT DEFAULT NULL,
ADD COLUMN `count_overlay_started` INT DEFAULT NULL,
ADD COLUMN `count_preroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_midroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_postroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_overlay_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_25` INT DEFAULT NULL,
ADD COLUMN `count_preroll_50` INT DEFAULT NULL,
ADD COLUMN `count_preroll_75` INT DEFAULT NULL,
ADD COLUMN `count_midroll_25` INT DEFAULT NULL,
ADD COLUMN `count_midroll_50` INT DEFAULT NULL,
ADD COLUMN `count_midroll_75` INT DEFAULT NULL,
ADD COLUMN `count_postroll_25` INT DEFAULT NULL,
ADD COLUMN `count_postroll_50` INT DEFAULT NULL,
ADD COLUMN `count_postroll_75` INT DEFAULT NULL;
  
ALTER TABLE kalturadw.dwh_aggr_events_domain
ADD COLUMN `count_open_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_close_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_replay` INT DEFAULT NULL,
ADD COLUMN `count_seek` INT DEFAULT NULL,
ADD COLUMN `count_open_upload` INT DEFAULT NULL,
ADD COLUMN `count_save_publish` INT DEFAULT NULL,
ADD COLUMN `count_close_editor` INT DEFAULT NULL,  
ADD COLUMN `count_pre_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_post_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_bumper_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_started` INT DEFAULT NULL,
ADD COLUMN `count_midroll_started` INT DEFAULT NULL,
ADD COLUMN `count_postroll_started` INT DEFAULT NULL,
ADD COLUMN `count_overlay_started` INT DEFAULT NULL,
ADD COLUMN `count_preroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_midroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_postroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_overlay_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_25` INT DEFAULT NULL,
ADD COLUMN `count_preroll_50` INT DEFAULT NULL,
ADD COLUMN `count_preroll_75` INT DEFAULT NULL,
ADD COLUMN `count_midroll_25` INT DEFAULT NULL,
ADD COLUMN `count_midroll_50` INT DEFAULT NULL,
ADD COLUMN `count_midroll_75` INT DEFAULT NULL,
ADD COLUMN `count_postroll_25` INT DEFAULT NULL,
ADD COLUMN `count_postroll_50` INT DEFAULT NULL,
ADD COLUMN `count_postroll_75` INT DEFAULT NULL;

ALTER TABLE kalturadw.dwh_aggr_events_entry
ADD COLUMN `count_open_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_close_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_replay` INT DEFAULT NULL,
ADD COLUMN `count_seek` INT DEFAULT NULL,
ADD COLUMN `count_open_upload` INT DEFAULT NULL,
ADD COLUMN `count_save_publish` INT DEFAULT NULL,
ADD COLUMN `count_close_editor` INT DEFAULT NULL,  
ADD COLUMN `count_pre_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_post_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_bumper_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_started` INT DEFAULT NULL,
ADD COLUMN `count_midroll_started` INT DEFAULT NULL,
ADD COLUMN `count_postroll_started` INT DEFAULT NULL,
ADD COLUMN `count_overlay_started` INT DEFAULT NULL,
ADD COLUMN `count_preroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_midroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_postroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_overlay_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_25` INT DEFAULT NULL,
ADD COLUMN `count_preroll_50` INT DEFAULT NULL,
ADD COLUMN `count_preroll_75` INT DEFAULT NULL,
ADD COLUMN `count_midroll_25` INT DEFAULT NULL,
ADD COLUMN `count_midroll_50` INT DEFAULT NULL,
ADD COLUMN `count_midroll_75` INT DEFAULT NULL,
ADD COLUMN `count_postroll_25` INT DEFAULT NULL,
ADD COLUMN `count_postroll_50` INT DEFAULT NULL,
ADD COLUMN `count_postroll_75` INT DEFAULT NULL;

ALTER TABLE kalturadw.dwh_aggr_events_widget
ADD COLUMN `count_open_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_close_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_replay` INT DEFAULT NULL,
ADD COLUMN `count_seek` INT DEFAULT NULL,
ADD COLUMN `count_open_upload` INT DEFAULT NULL,
ADD COLUMN `count_save_publish` INT DEFAULT NULL,
ADD COLUMN `count_close_editor` INT DEFAULT NULL,  
ADD COLUMN `count_pre_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_post_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_bumper_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_started` INT DEFAULT NULL,
ADD COLUMN `count_midroll_started` INT DEFAULT NULL,
ADD COLUMN `count_postroll_started` INT DEFAULT NULL,
ADD COLUMN `count_overlay_started` INT DEFAULT NULL,
ADD COLUMN `count_preroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_midroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_postroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_overlay_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_25` INT DEFAULT NULL,
ADD COLUMN `count_preroll_50` INT DEFAULT NULL,
ADD COLUMN `count_preroll_75` INT DEFAULT NULL,
ADD COLUMN `count_midroll_25` INT DEFAULT NULL,
ADD COLUMN `count_midroll_50` INT DEFAULT NULL,
ADD COLUMN `count_midroll_75` INT DEFAULT NULL,
ADD COLUMN `count_postroll_25` INT DEFAULT NULL,
ADD COLUMN `count_postroll_50` INT DEFAULT NULL,
ADD COLUMN `count_postroll_75` INT DEFAULT NULL;

ALTER TABLE kalturadw.dwh_aggr_monthly_partner
ADD COLUMN `count_open_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_close_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_replay` INT DEFAULT NULL,
ADD COLUMN `count_seek` INT DEFAULT NULL,
ADD COLUMN `count_open_upload` INT DEFAULT NULL,
ADD COLUMN `count_save_publish` INT DEFAULT NULL,
ADD COLUMN `count_close_editor` INT DEFAULT NULL,  
ADD COLUMN `count_pre_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_post_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_bumper_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_started` INT DEFAULT NULL,
ADD COLUMN `count_midroll_started` INT DEFAULT NULL,
ADD COLUMN `count_postroll_started` INT DEFAULT NULL,
ADD COLUMN `count_overlay_started` INT DEFAULT NULL,
ADD COLUMN `count_preroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_midroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_postroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_overlay_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_25` INT DEFAULT NULL,
ADD COLUMN `count_preroll_50` INT DEFAULT NULL,
ADD COLUMN `count_preroll_75` INT DEFAULT NULL,
ADD COLUMN `count_midroll_25` INT DEFAULT NULL,
ADD COLUMN `count_midroll_50` INT DEFAULT NULL,
ADD COLUMN `count_midroll_75` INT DEFAULT NULL,
ADD COLUMN `count_postroll_25` INT DEFAULT NULL,
ADD COLUMN `count_postroll_50` INT DEFAULT NULL,
ADD COLUMN `count_postroll_75` INT DEFAULT NULL;

ALTER TABLE kalturadw.dwh_aggr_partner
ADD COLUMN `count_open_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_close_full_screen` INT DEFAULT NULL,
ADD COLUMN `count_replay` INT DEFAULT NULL,
ADD COLUMN `count_seek` INT DEFAULT NULL,
ADD COLUMN `count_open_upload` INT DEFAULT NULL,
ADD COLUMN `count_save_publish` INT DEFAULT NULL,
ADD COLUMN `count_close_editor` INT DEFAULT NULL,  
ADD COLUMN `count_pre_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_post_bumper_played` INT DEFAULT NULL,
ADD COLUMN `count_bumper_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_started` INT DEFAULT NULL,
ADD COLUMN `count_midroll_started` INT DEFAULT NULL,
ADD COLUMN `count_postroll_started` INT DEFAULT NULL,
ADD COLUMN `count_overlay_started` INT DEFAULT NULL,
ADD COLUMN `count_preroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_midroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_postroll_clicked` INT DEFAULT NULL,
ADD COLUMN `count_overlay_clicked` INT DEFAULT NULL,
ADD COLUMN `count_preroll_25` INT DEFAULT NULL,
ADD COLUMN `count_preroll_50` INT DEFAULT NULL,
ADD COLUMN `count_preroll_75` INT DEFAULT NULL,
ADD COLUMN `count_midroll_25` INT DEFAULT NULL,
ADD COLUMN `count_midroll_50` INT DEFAULT NULL,
ADD COLUMN `count_midroll_75` INT DEFAULT NULL,
ADD COLUMN `count_postroll_25` INT DEFAULT NULL,
ADD COLUMN `count_postroll_50` INT DEFAULT NULL,
ADD COLUMN `count_postroll_75` INT DEFAULT NULL;

CREATE TABLE `dwh_aggr_events_uid` (
  `partner_id` INT(11) NOT NULL DEFAULT '0',
  `date_id` INT(11) NOT NULL DEFAULT '0',
  `kuser_id` VARCHAR(64) NOT NULL DEFAULT '0',
  `sum_time_viewed` DECIMAL(20,3) DEFAULT NULL,
  `count_time_viewed` INT(11) DEFAULT NULL,
  `count_plays` INT(11) DEFAULT NULL,
  `count_loads` INT(11) DEFAULT NULL,
  `count_plays_25` INT(11) DEFAULT NULL,
  `count_plays_50` INT(11) DEFAULT NULL,
  `count_plays_75` INT(11) DEFAULT NULL,
  `count_plays_100` INT(11) DEFAULT NULL,
  `count_edit` INT(11) DEFAULT NULL,
  `count_viral` INT(11) DEFAULT NULL,
  `count_download` INT(11) DEFAULT NULL,
  `count_report` INT(11) DEFAULT NULL,
  `count_buf_start` INT(11) DEFAULT NULL,
  `count_buf_end` INT(11) DEFAULT NULL,
  `count_open_full_screen` INT(11) DEFAULT NULL,
  `count_close_full_screen` INT(11) DEFAULT NULL,
  `count_replay` INT(11) DEFAULT NULL,
  `count_seek` INT(11) DEFAULT NULL,
  `count_open_upload` INT(11) DEFAULT NULL,
  `count_save_publish` INT(11) DEFAULT NULL,
  `count_close_editor` INT(11) DEFAULT NULL,
  `count_pre_bumper_played` INT(11) DEFAULT NULL,
  `count_post_bumper_played` INT(11) DEFAULT NULL,
  `count_bumper_clicked` INT(11) DEFAULT NULL,
  `count_preroll_started` INT(11) DEFAULT NULL,
  `count_midroll_started` INT(11) DEFAULT NULL,
  `count_postroll_started` INT(11) DEFAULT NULL,
  `count_overlay_started` INT(11) DEFAULT NULL,
  `count_preroll_clicked` INT(11) DEFAULT NULL,
  `count_midroll_clicked` INT(11) DEFAULT NULL,
  `count_postroll_clicked` INT(11) DEFAULT NULL,
  `count_overlay_clicked` INT(11) DEFAULT NULL,
  `count_preroll_25` INT(11) DEFAULT NULL,
  `count_preroll_50` INT(11) DEFAULT NULL,
  `count_preroll_75` INT(11) DEFAULT NULL,
  `count_midroll_25` INT(11) DEFAULT NULL,
  `count_midroll_50` INT(11) DEFAULT NULL,
  `count_midroll_75` INT(11) DEFAULT NULL,
  `count_postroll_25` INT(11) DEFAULT NULL,
  `count_postroll_50` INT(11) DEFAULT NULL,
  `count_postroll_75` INT(11) DEFAULT NULL,
  PRIMARY KEY (`partner_id`,`date_id`,`kuser_id`),
  KEY `uid` (`kuser_id`,`partner_id`,`date_id`),
  KEY `date_id` (`date_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY RANGE (date_id)
(PARTITION p_201001 VALUES LESS THAN (20100201) ENGINE = MyISAM,
 PARTITION p_201002 VALUES LESS THAN (20100301) ENGINE = MyISAM,
 PARTITION p_201003 VALUES LESS THAN (20100401) ENGINE = MyISAM,
 PARTITION p_201004 VALUES LESS THAN (20100501) ENGINE = MyISAM,
 PARTITION p_201005 VALUES LESS THAN (20100601) ENGINE = MyISAM,
 PARTITION p_201006 VALUES LESS THAN (20100701) ENGINE = MyISAM,
 PARTITION p_201007 VALUES LESS THAN (20100801) ENGINE = MyISAM,
 PARTITION p_201008 VALUES LESS THAN (20100901) ENGINE = MyISAM,
 PARTITION p_201009 VALUES LESS THAN (20101001) ENGINE = MyISAM) */;

ALTER TABLE `dwh_dim_entries`
ADD COLUMN  `access_control_id` INT(11) DEFAULT NULL,
ADD COLUMN  `conversion_profile_id` INT(11) DEFAULT NULL,
ADD COLUMN  `categories` VARCHAR(4096) DEFAULT NULL,
ADD COLUMN  `categories_ids` VARCHAR(1024) DEFAULT NULL,
ADD COLUMN  `search_text_discrete` VARCHAR(4096) DEFAULT NULL,
ADD COLUMN  `flavor_params_ids` VARCHAR(512) DEFAULT NULL,
ADD COLUMN  `start_date` DATETIME DEFAULT NULL,
ADD COLUMN  `start_date_id` INT(11) DEFAULT NULL,
ADD COLUMN  `start_hour_id` TINYINT(4) DEFAULT NULL,
ADD COLUMN  `end_date` DATETIME DEFAULT NULL,
ADD COLUMN  `end_date_id` INT(11) DEFAULT NULL,
ADD COLUMN  `end_hour_id` TINYINT(4) DEFAULT NULL,
ADD KEY `entry_FI_3` (`access_control_id`),
ADD KEY `entry_FI_5` (`conversion_profile_id`),
ADD FULLTEXT KEY `search_text_discrete_index` (`search_text_discrete`);

ALTER TABLE `dwh_fact_partner_activities`
DROP PRIMARY KEY;

CREATE TABLE `entry_plays_views_before_08_2009` (
  `entry_id` VARCHAR(20) CHARACTER SET utf8 NOT NULL,
  `views` DECIMAL(41,0) DEFAULT NULL,
  `plays` DECIMAL(41,0) DEFAULT NULL,
  PRIMARY KEY (`entry_id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;


DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_control_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_control_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_control` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_domain` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_domain_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_domain_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_domain` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_editor_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_editor_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_editor_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_editor_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entries` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entries_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `dwh_dim_entries_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entries` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_media_source` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_media_source_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_entry_media_source_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_media_source` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_media_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_media_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_entry_media_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_media_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_entry_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_entry_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_entry_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_entry_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_entry_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_event_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_event_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_event_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_event_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_gender` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_gender_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_gender_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_gender` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_kusers` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_kusers_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_kusers_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_kusers` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_locations` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_locations_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_locations_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_locations` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_moderation_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_moderation_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_moderation_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_moderation_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_activity` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_activity_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_partner_activity_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_activity` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_group_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_group_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_partner_group_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_group_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_partner_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_sub_activity` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_sub_activity_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_partner_sub_activity_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_sub_activity` FOR EACH ROW set new.dwh_creation_date = now() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partner_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partner_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_partner_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partner_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_partners` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_partners_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_partners_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_partners` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_ui_conf` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_ui_conf_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_ui_conf_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_ui_conf` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_ui_conf_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_ui_conf_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_ui_conf_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_ui_conf_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_ui_conf_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_ui_conf_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_ui_conf_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_ui_conf_type` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_user_status` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_user_status_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_user_status_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_user_status` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_widget` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `Dwh_Dim_Widget_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `Dwh_Dim_Widget_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_widget` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_widget_security_policy` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_widget_security_policy_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_widget_security_policy_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_widget_security_policy` FOR EACH ROW set new.dwh_creation_date = now() */$$


DELIMITER ;

/* Trigger structure for table `dwh_dim_widget_security_type` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_dim_widget_security_type_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_dim_widget_security_type_setcreationtime_oninsert` BEFORE INSERT ON `dwh_dim_widget_security_type` FOR EACH ROW set new.dwh_creation_date = now() */$$


DELIMITER ;

/* Trigger structure for table `dwh_fact_partner_activities` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `dwh_fact_partner_activities_setcreationtime_oninsert` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'etl'@'localhost' */ /*!50003 TRIGGER `dwh_fact_partner_activities_setcreationtime_oninsert` BEFORE INSERT ON `dwh_fact_partner_activities` FOR EACH ROW SET new.dwh_creation_date = NOW() */$$


DELIMITER ;

/* Function  structure for function  `calc_month_id` */

/*!50003 DROP FUNCTION IF EXISTS `calc_month_id` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` FUNCTION `calc_month_id`(date_id INT(11)) RETURNS int(11)
    DETERMINISTIC
BEGIN
	RETURN FLOOR(date_id/100);
    END */$$
DELIMITER ;

/* Function  structure for function  `calc_partner_storage_data_last_month` */

/*!50003 DROP FUNCTION IF EXISTS `calc_partner_storage_data_last_month` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `calc_partner_storage_data_last_month`(month_id INT ,partner_id INT ) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE pid INT;
DECLARE avg_cont_aggr_storage INT;

SET @current_month_id=month_id;
SET @current_partner_id=partner_id;

SELECT
	continuous_partner_storage.partner_id,
	SUM(continuous_aggr_storage/DAY(LAST_DAY(continuous_partner_storage.date_id))) avg_continuous_aggr_storage_mb
INTO 
	pid,avg_cont_aggr_storage
FROM
(	
		SELECT 
			all_times.day_id date_id,
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

/*!50003 CREATE DEFINER=`etl`@`localhost` FUNCTION `calc_prev_date_id`(date_id INT(11)) RETURNS int(11)
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

/*!50003 CREATE DEFINER=`etl`@`localhost` FUNCTION `resolve_aggr_name`(p_aggr_name VARCHAR(100),p_field_name VARCHAR(100)) RETURNS varchar(100) CHARSET latin1
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

/* Procedure structure for procedure `add_partitions` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_partitions` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `add_partitions`()
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `add_partition_for_fact_table`(table_name varchar(100))
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `add_partition_for_table`(table_name VARCHAR(40))
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `calc_aggr_day`(p_date_val DATE,p_aggr_name VARCHAR(100))
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `calc_partner_billing_data`(date_val DATE,partner_id VARCHAR(100))
BEGIN

SET @current_date_id=DATE(date_val)*1;
SET @current_partner_id=partner_id;

SELECT
	calc_month_id(continuous_partner_storage.date_id) month_id,
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
		calc_month_id(continuous_partner_storage.date_id)
	WITH ROLLUP;	
	

    END */$$
DELIMITER ;

/* Procedure structure for procedure `daily_procedure_dwh_aggr_events_widget` */

/*!50003 DROP PROCEDURE IF EXISTS  `daily_procedure_dwh_aggr_events_widget` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_events_widget`(date_val DATE,aggr_name VARCHAR(100))
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_partner`(date_val DATE,aggr_name VARCHAR(100))
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
    		count_storage )  
   		SELECT partner_id,pa.activity_date_id date_id,
			SUM(IF(partner_activity_id = 1, amount ,NULL)) count_bandwidth, 
			SUM(IF(partner_activity_id = 3 AND partner_sub_activity_id=301, amount,NULL)) count_storage 
		FROM dwh_fact_partner_activities  pa 
		WHERE 
			pa.activity_date_id=DATE(''',date_val,''')*1
		GROUP BY partner_id,pa.activity_date_id
    	ON DUPLICATE KEY UPDATE
    		count_bandwidth=VALUES(count_bandwidth), 
    		count_storage=VALUES(count_storage);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	


	
	SET @s = CONCAT('
    	INSERT INTO ',aggr_table,'
    		(partner_id, 
    		date_id, 
    		aggr_storage ,   
			aggr_bandwidth ) 
		SELECT 
			a.partner_id,
			a.date_id,
			SUM(b.count_storage) aggr_storage,
			SUM(b.count_bandwidth) aggr_bandwidth
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
			aggr_bandwidth=VALUES(aggr_bandwidth);
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_partner_daily_usage`(date_val DATE)
BEGIN
	
	SET @s = CONCAT('
    	INSERT INTO dwh_aggr_partner_daily_usage
    		(partner_id, 
    		date_id, 
    		sum_storage_mb   , 
    		sum_bandwidth_mb   
    		)
		SELECT 
			a.partner_id,
			a.date_id,
			a.aggr_storage,
			floor(a.aggr_bandwidth/1024)
		FROM dwh_aggr_partner a 
		WHERE 
			a.date_id=DATE(''',date_val,''')*1
		ON DUPLICATE KEY UPDATE
			sum_storage_mb=VALUES(sum_storage_mb),
			sum_bandwidth_mb=VALUES(sum_bandwidth_mb);
    	');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;	


	
	
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


END */$$
DELIMITER ;

/* Procedure structure for procedure `daily_procedure_dwh_aggr_partner_daily_usage_loop` */

/*!50003 DROP PROCEDURE IF EXISTS  `daily_procedure_dwh_aggr_partner_daily_usage_loop` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `daily_procedure_dwh_aggr_partner_daily_usage_loop`(from_date DATE,to_date DATE)
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `drop_events_partition`(month_interval INT)
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `monthly_non_paying_billing_report`( month_id INT )
BEGIN
SET @current_month = month_id;
	SELECT 
		calculated_stats.month_id,
		calculated_stats.partner_id "partner_id",

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
			SUM(aggr_single_partner.sum_storage_all_time_mb) sum_storage_all_time_mb ,
			FLOOR(SUM(aggr_single_partner.sum_bandwidth_all_time_kb)/1024) sum_bandwidth_all_time_mb
		FROM	
		(
			SELECT
				calc_month_id(aggr_partner.date_id) month_id, 
				aggr_partner.partner_id,
				SUM(aggr_partner.count_bandwidth) sum_bandwidth_all_time_kb,
				SUM(aggr_partner.count_storage) sum_storage_all_time_mb,
				calc_partner_storage_data_last_month(@current_month , aggr_partner.partner_id) billing_storage_mb , 
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_bandwidth,NULL)) sum_bandwith_for_month_aggr_kb  ,
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `monthly_partner_billing_report`( month_id int )
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
			SUM(aggr_single_partner.sum_storage_all_time_mb) sum_storage_all_time_mb ,
			FLOOR(SUM(aggr_single_partner.sum_bandwidth_all_time_kb)/1024) sum_bandwidth_all_time_mb
		FROM	
		(
			SELECT
				calc_month_id(aggr_partner.date_id) month_id, 
				aggr_partner.partner_id,
				SUM(aggr_partner.count_bandwidth) sum_bandwidth_all_time_kb,
				SUM(aggr_partner.count_storage) sum_storage_all_time_mb,
				calc_partner_storage_data_last_month(@current_month , aggr_partner.partner_id) billing_storage_mb , 
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_bandwidth,NULL)) sum_bandwith_for_month_aggr_kb  ,
				SUM(IF(calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_storage,NULL)) sum_count_storage_for_month_aggr_mb 
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

/* Procedure structure for procedure `recalc_aggr_day` */

/*!50003 DROP PROCEDURE IF EXISTS  `recalc_aggr_day` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `recalc_aggr_day`(date_val DATE,aggr_name VARCHAR(100))
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

/* Procedure structure for procedure `top_activities` */

/*!50003 DROP PROCEDURE IF EXISTS  `top_activities` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `top_activities`(  month_id INT , _limit INT , _order_by VARCHAR(40) )
BEGIN
	IF INSTR("storage,bandwidth,plays,loads",_order_by)=0 THEN
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
	  
		PREPARE stmt FROM  @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END IF;

END */$$
DELIMITER ;

USE `kalturadw_bisources`;
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(24,'Preroll Started'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(25,'Midroll Started'); 
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(26,'Postroll Started');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(27,'Overlay Started');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(28,'Preroll Clicked');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(29,'Midroll Clicked');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(30,'Postroll Clicked');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(31,'Overlay Clicked');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(32,'Preroll 25');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(33,'Preroll 50');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(34,'Preroll 75');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(35,'Midroll 25');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(36,'Midroll 50');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(37,'Midroll 75');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(38,'Postroll 25');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(39,'Postroll 50');
INSERT INTO kalturadw_bisources.bisources_event_type (event_type_id,event_type_name) VALUES(40,'Postroll 75');

USE `kalturadw_ds`;

/*Table structure for table `aggr_name_resolver` */

CREATE TABLE `aggr_name_resolver` (
  `aggr_name` VARCHAR(100) NOT NULL DEFAULT '',
  `aggr_table` VARCHAR(100) DEFAULT NULL,
  `aggr_id_field` VARCHAR(100) DEFAULT NULL,
  `aggr_join_stmt` VARCHAR(200) DEFAULT '',
  PRIMARY KEY (`aggr_name`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Data for the table `aggr_name_resolver` */

INSERT  INTO `aggr_name_resolver`(`aggr_name`,`aggr_table`,`aggr_id_field`,`aggr_join_stmt`) VALUES ('entry','dwh_aggr_events_entry','entry_id',''),('domain','dwh_aggr_events_domain','domain_id',''),('country','dwh_aggr_events_country','country_id,location_id',''),('partner','dwh_aggr_partner','',''),('widget','dwh_aggr_events_widget','widget_id',''),('uid','dwh_aggr_events_uid','kuser_id','inner join kalturadw.dwh_dim_entries as entry on(ev.entry_id = entry.entry_id)');

ALTER TABLE `files`
ADD COLUMN  `process_id` INT(11) DEFAULT '1';

/*Table structure for table `parameters` */

CREATE TABLE `parameters` (
  `id` INT(11) UNSIGNED NOT NULL,
  `process_id` INT(11) UNSIGNED NOT NULL,
  `parameter_name` VARCHAR(100) NOT NULL,
  `int_value` INT(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Data for the table `parameters` */

INSERT  INTO `parameters`(`id`,`process_id`,`parameter_name`,`int_value`) VALUES (1,3,'max_operational_partner_activity',-1);

/*Table structure for table `processes` */

CREATE TABLE `processes` (
  `id` INT(10) UNSIGNED NOT NULL,
  `process_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Data for the table `processes` */

INSERT  INTO `processes`(`id`,`process_name`) VALUES (1,'events'),(2,'fms_streaming'),(3,'partner_activity');

/*Table structure for table `staging_areas` */

CREATE TABLE `staging_areas` (
  `id` INT(10) UNSIGNED NOT NULL,
  `process_id` INT(10) UNSIGNED NOT NULL,
  `source_table` VARCHAR(45) NOT NULL,
  `target_table` VARCHAR(45) NOT NULL,
  `on_duplicate_clause` VARCHAR(4000) DEFAULT NULL,
  `staging_partition_field` VARCHAR(45) DEFAULT NULL,
  `post_transfer_sp` VARCHAR(500) DEFAULT NULL,
  `aggr_date_field` VARCHAR(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Data for the table `staging_areas` */

INSERT  INTO `staging_areas`(`id`,`process_id`,`source_table`,`target_table`,`on_duplicate_clause`,`staging_partition_field`,`post_transfer_sp`,`aggr_date_field`) VALUES (1,1,'ds_events','kalturadw.dwh_fact_events','ON DUPLICATE KEY UPDATE kalturadw.dwh_fact_events.file_id = kalturadw.dwh_fact_events.file_id','file_id',NULL,'event_date_id'),(2,2,'ods_fms_session_events','kalturadw.dwh_fact_fms_session_events','ON DUPLICATE KEY UPDATE kalturadw.dwh_fact_fms_session_events.file_id = kalturadw.dwh_fact_fms_session_events.file_id','file_id',NULL,NULL);

/*Table structure for table `updated_entries` */

CREATE TABLE `updated_entries` (
  `entry_id` VARCHAR(20) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `views` DECIMAL(32,0) DEFAULT NULL,
  `plays` DECIMAL(32,0) DEFAULT NULL
) ENGINE=MYISAM DEFAULT CHARSET=latin1;

/*Data for the table `updated_entries` */

/* Function  structure for function  `get_ip_country_location` */

/*!50003 DROP FUNCTION IF EXISTS `get_ip_country_location` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` FUNCTION `get_ip_country_location`(ip BIGINT) RETURNS varchar(30) CHARSET latin1
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `add_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
CALL add_ods_partition(partition_number,'ds_events');
END */$$
DELIMITER ;

/* Procedure structure for procedure `add_ods_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `add_ods_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `add_ods_partition`(
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

/* Procedure structure for procedure `create_updated_entries` */

/*!50003 DROP PROCEDURE IF EXISTS  `create_updated_entries` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `create_updated_entries`(max_date date)
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

/* Procedure structure for procedure `drop_file_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `drop_file_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `drop_file_partition`(
	partition_number VARCHAR(10)
	)
BEGIN
CALL drop_ods_partition(partition_number,'ds_events');
END */$$
DELIMITER ;

/* Procedure structure for procedure `drop_ods_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `drop_ods_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `drop_ods_partition`(
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `empty_file_partition`(
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `empty_ods_partition`(
	partition_number VARCHAR(10),
table_name VARCHAR(32)
)
BEGIN
	CALL drop_ods_partition(partition_number,table_name);
	CALL add_ods_partition(partition_number,table_name);
END */$$
DELIMITER ;

/* Procedure structure for procedure `mark_as_aggregated` */

/*!50003 DROP PROCEDURE IF EXISTS  `mark_as_aggregated` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `mark_as_aggregated`( max_date VARCHAR(4000), aggr_name VARCHAR(50))
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `mark_for_reaggregation`( date_id_list varchar(4000), aggr_name varchar(50))
BEGIN
	SET @smark4reagg  = CONCAT('update kalturadw.aggr_managment set is_calculated=0,start_time=null,end_time=null ',
			'where aggr_day_int in (',date_id_list,') ',
			'and (aggr_name = ''',aggr_name,''' or ''all''=''',aggr_name,''');');
	PREPARE stmtmark FROM @smark4reagg ;
	EXECUTE stmtmark;
	DEALLOCATE PREPARE stmtmark;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `restore_file_status` */

/*!50003 DROP PROCEDURE IF EXISTS  `restore_file_status` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `restore_file_status`(
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `set_file_status`(
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `set_file_status_full`(
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

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `transfer_file_partition`(
	partition_number VARCHAR(10)
)
BEGIN
	CALL transfer_ods_partition(1,partition_number);
END */$$
DELIMITER ;

/* Procedure structure for procedure `transfer_ods_partition` */

/*!50003 DROP PROCEDURE IF EXISTS  `transfer_ods_partition` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`etl`@`localhost` PROCEDURE `transfer_ods_partition`(
	staging_area_id INTEGER, partition_number VARCHAR(10)
)
BEGIN
DECLARE src_table VARCHAR(45);
DECLARE tgt_table VARCHAR(45);
DECLARE dup_clause VARCHAR(4000);
DECLARE partition_field VARCHAR(45);
DECLARE select_fields VARCHAR(4000);
DECLARE post_transfer_sp_val VARCHAR(4000);
DECLARE aggr_date VARCHAR(4000);
DECLARE s VARCHAR(4000);
SELECT source_table,target_table,IFNULL(on_duplicate_clause,''),staging_partition_field,post_transfer_sp,aggr_date_field
INTO src_table,tgt_table,dup_clause,partition_field,post_transfer_sp_val,aggr_date
FROM staging_areas
WHERE id=staging_area_id;

IF LENGTH(AGGR_DATE) > 0 THEN
SELECT CONCAT('update kalturadw.aggr_managment set is_calculated=0 where aggr_day_int in ',
	      '(select distinct ',aggr_date,
	        ' from ',src_table,
	        ' where ',partition_field,' = ',partition_number,')') INTO s;
SET @s = s;
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END IF;

SELECT GROUP_CONCAT(column_name ORDER BY ordinal_position)
INTO select_fields
FROM information_schema.columns
WHERE CONCAT(table_schema,'.',table_name) = tgt_table;

	SELECT CONCAT('insert into ',tgt_table,
 ' select ',select_fields,
			 ' from ',src_table,
			 ' where ',partition_field,'  = ',partition_number,
			 ' ',dup_clause ) INTO s;
SET @s = s;
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;

IF LENGTH(POST_TRANSFER_SP_VAL)>0 THEN
SET @s = CONCAT('call ',post_transfer_sp_val,'(',partition_number,')');
	PREPARE stmt FROM  @s;
	EXECUTE stmt;
	DEALLOCATE PREPARE stmt;
END IF;

END */$$
DELIMITER ;