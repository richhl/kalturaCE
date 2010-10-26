CREATE TABLE kalturadw.`dwh_aggr_partner_daily_usage` (
  `partner_id` INT DEFAULT NULL,
  `date_id` INT DEFAULT NULL,
  `sum_bandwidth_mb`  BIGINT DEFAULT NULL,
  `sum_storage_mb`  BIGINT DEFAULT NULL,
  `sum_usage_mb`  BIGINT DEFAULT NULL,
  `sum_monthly_bandwidth_mb`  BIGINT DEFAULT NULL,
  `calculated_storage_mb`  BIGINT DEFAULT NULL,
  `calculated_monthly_storage_mb`  BIGINT DEFAULT NULL,
  `sum_streaming_mb` bigint(20) DEFAULT '0',
  PRIMARY KEY `partner_id` (`partner_id`,`date_id`),
  KEY `date_id` (`date_id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8
	PARTITION BY RANGE (date_id)
		(PARTITION p_201001 VALUES LESS THAN (20100201));