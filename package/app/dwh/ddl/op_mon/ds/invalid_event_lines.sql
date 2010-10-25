CREATE TABLE kaltura_op_mon.`invalid_event_lines` (    
  		  `line_id` INT NOT NULL AUTO_INCREMENT, 
		  `line_number` INT NOT NULL,
          `file_id` INT NOT NULL,
		  `file_type` VARCHAR(10),
		  `error_reason_code` SMALLINT,
		  `error_reason` VARCHAR(255),
          `event_line` VARCHAR(1023),
		  `insert_time` DATETIME DEFAULT NULL,
          `date_id` INT NOT NULL,
          PRIMARY KEY (`line_id`)                                
        ) ENGINE=MYISAM DEFAULT CHARSET=utf8
