CREATE TABLE kaltura_op_mon.`dwh_aggr_kmc_events_first_funnel` (
  `partner_id` INT DEFAULT NULL,
  `kmc_event_id` INT DEFAULT NULL,
  `kmc_event_type_id`	smallint  NOT NULL,
  `kmc_event_time` datetime DEFAULT NULL,
  `kmc_event_date_id` int DEFAULT NULL,
  `kmc_prev_event_id` INT DEFAULT NULL,
  `kmc_prev_event_type_id`	smallint DEFAULT NULL,
  `kmc_prev_event_time` datetime DEFAULT NULL,
  `kmc_prev_event_date_id` int DEFAULT NULL,
  PRIMARY KEY `partner_id` (`partner_id`,`kmc_event_type_id`,`kmc_event_date_id`),
  KEY `kmc_event_type_id` (`kmc_event_type_id`,`kmc_prev_event_type_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8
	PARTITION BY RANGE (kmc_event_date_id)
	(PARTITION p_200910 VALUES LESS THAN (20091101),
	 PARTITION p_200911 VALUES LESS THAN (20091201),
	 PARTITION p_200912 VALUES LESS THAN (20100101),
	 PARTITION p_201001 VALUES LESS THAN (20100201),
	 PARTITION p_201002 VALUES LESS THAN (20100301),
	 PARTITION p_201003 VALUES LESS THAN (20100401)) ;