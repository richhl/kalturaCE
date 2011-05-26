CREATE TABLE kalturadw_ds.`files` (
          `file_id` DOUBLE NOT NULL AUTO_INCREMENT,              
          `file_name` VARCHAR(750) DEFAULT NULL,                 
          `file_status` VARCHAR(60) DEFAULT NULL,                
          `prev_status` VARCHAR(60) DEFAULT NULL,                
          `insert_time` DATETIME DEFAULT NULL,                   
          `run_time` DATETIME DEFAULT NULL,                      
          `transfer_time` DATETIME DEFAULT NULL,   
		      `lines` INT DEFAULT NULL,
    		  `err_lines` INT DEFAULT NULL,
    		  `file_size` INT DEFAULT NULL,
          `process_id` INT DEFAULT 1,
		  cycle_id INT(11) DEFAULT NULL,
          PRIMARY KEY (`file_id`),
		  UNIQUE KEY `file_name_process_id` (`file_name`, `process_id`)
        ) ENGINE=MYISAM DEFAULT CHARSET=latin1
