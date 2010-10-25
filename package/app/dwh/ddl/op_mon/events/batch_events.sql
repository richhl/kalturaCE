CREATE TABLE kaltura_op_mon.dwh_fact_batch_events
     (
	  file_id INT NOT NULL
	,batch_event_id	INT 
	,batch_client_version	VARCHAR(20)
	,batch_event_type_id	SMALLINT
	,batch_name	VARCHAR(50)
	,batch_event_time	DATETIME
	,batch_event_date_id	INT
	,batch_event_hour_id	TINYINT
	,batch_session_id	VARCHAR(50)
	,batch_type SMALLINT
	,host_name	VARCHAR(20)
	,location_id	INT
	,section_id	INT
	,batch_id	INT
	,partner_id	INT
	,entry_id VARCHAR(20)
	,bulk_upload_id INT
	,batch_paranet_id INT
	,batch_root_id INT
	,batch_status SMALLINT
	,batch_progress INT
	,value_1 INT
	,value_2 varchar(64)
	, PRIMARY KEY (file_id,batch_event_id,batch_event_date_id)
     ) ENGINE=MYISAM  DEFAULT CHARSET=utf8  
     PARTITION BY RANGE (batch_event_date_id)
(PARTITION p_200905 VALUES LESS THAN (20090600),
 PARTITION p_200906 VALUES LESS THAN (20090700),
 PARTITION p_200907 VALUES LESS THAN (20090800),
 PARTITION p_200908 VALUES LESS THAN (20090900),
 PARTITION p_200909 VALUES LESS THAN (20091000), 
 PARTITION p_200910 VALUES LESS THAN (20091100), 
 PARTITION p_200911 VALUES LESS THAN (20091200), 
 PARTITION p_200912 VALUES LESS THAN (20100100), 
 PARTITION p_201001 VALUES LESS THAN (20100200),
 PARTITION p_201002 VALUES LESS THAN (20100300),
 PARTITION p_201003 VALUES LESS THAN (20100400)
) ;