 CREATE TABLE kaltura_op_mon.`aggr_managment` (             
	  `aggr_name` VARCHAR(100) DEFAULT NULL,   
	  `aggr_day` DATE DEFAULT NULL,             
	  `is_calculated` TINYINT DEFAULT NULL,  
	  `start_time` DATETIME DEFAULT NULL,
	  `end_time` DATETIME DEFAULT NULL,
	  PRIMARY KEY (aggr_name,aggr_day)
	) ENGINE=MYISAM DEFAULT CHARSET=utf8