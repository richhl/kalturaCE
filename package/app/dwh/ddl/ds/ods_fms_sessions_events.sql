﻿DROP TABLE IF EXISTS `kalturadw_ds`.`ods_fms_session_events`;
CREATE TABLE `kalturadw_ds`.`ods_fms_session_events` (
  `file_id` int(11) unsigned NOT NULL,
  `event_type_id` tinyint(3) unsigned NOT NULL,
  `event_category_id` tinyint(3) unsigned NOT NULL,
  `event_time` datetime NOT NULL,
  `event_time_tz` varchar(3) NOT NULL,
  `event_date_id` int(11) NOT NULL,
  `event_hour_id` tinyint(3) NOT NULL,
  `context` varchar(100) DEFAULT NULL,
  `entry_id` varchar(20) DEFAULT NULL,
  `partner_id` int(10) DEFAULT NULL,
  `external_id` varchar(50) DEFAULT NULL,
  `server_ip` int(10) unsigned DEFAULT NULL,
  `server_process_id` int(10) unsigned NOT NULL,
  `server_cpu_load` smallint(5) unsigned NOT NULL,
  `server_memory_load` smallint(5) unsigned NOT NULL,
  `adaptor_id` smallint(5) unsigned NOT NULL,
  `virtual_host_id` smallint(5) unsigned NOT NULL,
  `app_id` tinyint(3) unsigned NOT NULL,
  `app_instance_id` tinyint(3) unsigned NOT NULL,
  `duration_secs` int(10) unsigned NOT NULL,
  `status_id` smallint(3) unsigned DEFAULT NULL,
  `status_desc_id` tinyint(3) unsigned NOT NULL,
  `client_ip_str` varchar(15) NOT NULL,
  `client_ip` int(10) unsigned NOT NULL,
  `client_country_id` int(10) unsigned DEFAULT '0',
  `client_location_id` int(10) unsigned DEFAULT '0',
  `client_protocol_id` tinyint(3) unsigned NOT NULL,
  `uri` varchar(4000) NOT NULL,
  `uri_stem` varchar(2000) DEFAULT NULL,
  `uri_query` varchar(2000) DEFAULT NULL,
  `referrer` varchar(4000) DEFAULT NULL,
  `user_agent` varchar(2000) DEFAULT NULL,
  `session_id` varchar(20) NOT NULL,
  `client_to_server_bytes` bigint(20) unsigned NOT NULL,
  `server_to_client_bytes` bigint(20) unsigned NOT NULL,
  `stream_name` varchar(50) DEFAULT NULL,
  `stream_query` varchar(50) DEFAULT NULL,
  `stream_file_name` varchar(4000) DEFAULT NULL,
  `stream_type_id` tinyint(3) unsigned DEFAULT NULL,
  `stream_size_bytes` int(11) DEFAULT NULL,
  `stream_length_secs` int(11) DEFAULT NULL,
  `stream_position` int(11) DEFAULT NULL,
  `client_to_server_stream_bytes` int(10) unsigned DEFAULT NULL,
  `server_to_client_stream_bytes` int(10) unsigned DEFAULT NULL,
  `server_to_client_qos_bytes` int(10) unsigned DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8
/*!50100 PARTITION BY LIST (file_id)
(PARTITION p_0 VALUES IN (0) ENGINE = MyISAM) */;