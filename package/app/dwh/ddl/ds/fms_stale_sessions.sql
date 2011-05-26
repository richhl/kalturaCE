DROP TABLE IF EXISTS `kalturadw_ds`.`fms_stale_sessions`;

CREATE TABLE `kalturadw_ds`.`fms_stale_sessions` (
  `session_id` varchar(20) DEFAULT NULL,
  `session_time` datetime DEFAULT NULL,
  `last_update_time` datetime DEFAULT NULL,
  `purge_time` datetime DEFAULT NULL,
  `session_date_id` int(11) unsigned DEFAULT NULL,
  `con_cs_bytes` bigint(20) unsigned DEFAULT NULL,
  `con_sc_bytes` bigint(20) unsigned DEFAULT NULL,
  `dis_cs_bytes` bigint(20) unsigned DEFAULT NULL,
  `dis_sc_bytes` bigint(20) unsigned DEFAULT NULL,
  `partner_id` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;