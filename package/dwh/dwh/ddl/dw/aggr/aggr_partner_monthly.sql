CREATE TABLE `kalturadw`.`dwh_aggr_monthly_partner` (
  `partner_id` int(11) NOT NULL DEFAULT '0',
  `month_id` int(11) NOT NULL DEFAULT '0',
  `last_calculated_date_id` int(11) DEFAULT NULL,
  `sum_time_viewed` decimal(20,3) DEFAULT NULL,
  `count_time_viewed` int(11) DEFAULT NULL,
  `count_plays` int(11) DEFAULT NULL,
  `count_loads` int(11) DEFAULT NULL,
  `count_plays_25` int(11) DEFAULT NULL,
  `count_plays_50` int(11) DEFAULT NULL,
  `count_plays_75` int(11) DEFAULT NULL,
  `count_plays_100` int(11) DEFAULT NULL,
  `count_edit` int(11) DEFAULT NULL,
  `count_viral` int(11) DEFAULT NULL,
  `count_download` int(11) DEFAULT NULL,
  `count_report` int(11) DEFAULT NULL,
  `count_media` int(11) DEFAULT NULL,
  `count_video` int(11) DEFAULT NULL,
  `count_image` int(11) DEFAULT NULL,
  `count_audio` int(11) DEFAULT NULL,
  `count_mix` int(11) DEFAULT NULL,
  `count_mix_non_empty` int(11) DEFAULT NULL,
  `count_playlist` int(11) DEFAULT NULL,
  `count_bandwidth` bigint(20) DEFAULT NULL,
  `count_storage` bigint(20) DEFAULT NULL,
  `count_users` int(11) DEFAULT NULL,
  `count_widgets` int(11) DEFAULT NULL,
  `flag_active_site` tinyint(4) DEFAULT '0',
  `flag_active_publisher` tinyint(4) DEFAULT '0',
  `aggr_storage` bigint(20) DEFAULT NULL,
  `aggr_bandwidth` bigint(20) DEFAULT NULL,
  `count_buf_start` int(11) DEFAULT NULL,
  `count_buf_end` int(11) DEFAULT NULL,
  `sum_bandwidth_mb` bigint(20) DEFAULT NULL,
  `sum_storage_mb` bigint(20) DEFAULT NULL,
  `sum_monthly_bandwidth_mb` bigint(20) DEFAULT NULL,
  `calculated_storage_mb` bigint(20) DEFAULT NULL,
  `calculated_monthly_storage_mb` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`partner_id`,`month_id`),
  KEY `month_id` (`month_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY RANGE (month_id)
(PARTITION p_2009 VALUES LESS THAN (201001) ENGINE = MyISAM,
 PARTITION p_2010 VALUES LESS THAN (201101) ENGINE = MyISAM,
 PARTITION p_2011 VALUES LESS THAN (201201) ENGINE = MyISAM,
 PARTITION p_2012 VALUES LESS THAN (201301) ENGINE = MyISAM) */