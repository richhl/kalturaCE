CREATE TABLE kaltura_op_mon.dwh_ds_batch_events
     (
	  file_id INT NOT NULL
	,batch_event_id	INT  NOT NULL AUTO_INCREMENT
	,batch_client_version	varchar(20)
	,batch_event_type_id	smallint
	,batch_name	varchar(50)
	,batch_event_time	datetime
	,batch_event_date_id	int
	,batch_event_hour_id	tinyint
	,batch_session_id	varchar(50)
	,batch_type smallint
	,host_name	varchar(20)
	,location_id	int
	,section_id	int
	,batch_id	int
	,partner_id	int
	,entry_id varchar(20)
	,bulk_upload_id int
	,batch_paranet_id int
	,batch_root_id int
	,batch_status smallint
	,batch_progress int
	,value_1 int
	,value_2 varchar(64)
	, PRIMARY KEY (file_id,batch_event_id)
     ) ENGINE=MYISAM  DEFAULT CHARSET=utf8  
     PARTITION BY 	LIST(file_id) (
	PARTITION p_0 VALUES IN (0)
	);