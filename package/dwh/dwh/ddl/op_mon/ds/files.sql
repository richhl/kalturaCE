CREATE TABLE kaltura_op_mon.`files` (                                   
          `file_id` DOUBLE NOT NULL AUTO_INCREMENT,              
          `file_name` VARCHAR(750) DEFAULT NULL,
		  `file_type` VARCHAR(10),
          `file_status` VARCHAR(60) DEFAULT NULL,                
          `prev_status` VARCHAR(60) DEFAULT NULL,                
          `insert_time` DATETIME DEFAULT NULL,                   
          `run_time` DATETIME DEFAULT NULL,                      
          `transfer_time` DATETIME DEFAULT NULL,   
		  `lines` INT DEFAULT NULL,
		  `err_lines` INT DEFAULT NULL,
		  `file_size` INT DEFAULT NULL,
          PRIMARY KEY (`file_id`)                                
        ) ENGINE=MYISAM DEFAULT CHARSET=latin1
