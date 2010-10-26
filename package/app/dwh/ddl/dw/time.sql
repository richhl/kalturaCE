CREATE TABLE `kalturadw`.dwh_dim_time (                        
	`day_id` INT NOT NULL DEFAULT '0',             
	`date_field` DATETIME DEFAULT NULL,                
	`year` INT DEFAULT NULL,                       
	`month` INT DEFAULT NULL,                      
	`day_of_year` INT DEFAULT NULL,                
	`day_of_month` INT DEFAULT NULL,               
	`day_of_week` INT DEFAULT NULL,                
	`week_of_year` INT DEFAULT NULL,               
	`day_of_week_desc` VARCHAR(30) DEFAULT NULL,       
	`day_of_week_short_desc` VARCHAR(3) DEFAULT NULL,  
	`month_desc` VARCHAR(30) DEFAULT NULL,             
	`month_short_desc` VARCHAR(3) DEFAULT NULL,        
	`quarter` CHAR(1) DEFAULT NULL,                    
	PRIMARY KEY (`day_id`)                             
      ) ENGINE=MYISAM DEFAULT CHARSET=latin1