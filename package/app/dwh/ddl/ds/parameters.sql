CREATE TABLE  `kalturadw_ds`.`parameters` (
`id` int(11) unsigned NOT NULL,
`process_id` int(11) unsigned NOT NULL,
`parameter_name` varchar(100) NOT NULL,
`int_value` int(11) NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=MyISAM;