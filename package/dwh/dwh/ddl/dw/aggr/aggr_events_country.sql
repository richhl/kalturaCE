CREATE TABLE kalturadw.`dwh_aggr_events_country` (
  `partner_id` INT DEFAULT NULL,
  `date_id` INT DEFAULT NULL,
  `country_id` INT DEFAULT NULL,
  `location_id` INT DEFAULT NULL,
  `sum_time_viewed` DECIMAL(20,3) DEFAULT NULL,
  `count_time_viewed` INT DEFAULT NULL,
  `count_plays` INT DEFAULT NULL,
  `count_loads` INT DEFAULT NULL,
  `count_plays_25` INT DEFAULT NULL,
  `count_plays_50` INT DEFAULT NULL,
  `count_plays_75` INT DEFAULT NULL,
  `count_plays_100` INT DEFAULT NULL,
  `count_edit` INT DEFAULT NULL,
  `count_viral` INT DEFAULT NULL,
  `count_download` INT DEFAULT NULL,
  `count_report` INT DEFAULT NULL,
  `count_buf_start` INT DEFAULT NULL,
  `count_buf_end` INT DEFAULT NULL,
  PRIMARY KEY `partner_id` (`partner_id`,`date_id`,`country_id`,location_id),
  KEY `country_id` (`country_id`,`partner_id`,`date_id`,location_id),
  KEY `date_id` (`date_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8
	PARTITION BY RANGE (date_id)
		(PARTITION p_201001 VALUES LESS THAN (20100201));