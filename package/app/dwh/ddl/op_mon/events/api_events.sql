CREATE TABLE kaltura_op_mon.dwh_fact_api_events
     (
	  file_id INT NOT NULL
	,api_event_id	INT  NOT NULL 
	,api_client_version varchar(20)	
	,api_event_time datetime
	,api_event_date_id	INT
	,api_event_hour_id	TINYINT
	,api_event_session_id  varchar(50)
	,api_event_service varchar(50)
	,api_event_action varchar(50)
	,api_event_ps_version varchar(20)
	,api_event_is_multi_request tinyint
	,api_event_ks varchar(200)
	,api_event_ks_type smallint
	,partner_id int
	,uid varchar(50)
	,entry_id varchar(20)
	,ui_conf_id int
	,widget_id varchar(20)
	,flavor_id varchar(20)
	,api_event_invoke_duration int
	,api_event_dispatch_duration int
	,api_event_serialize_duration int
	,api_event_total_duration int
	,api_event_result varchar(20)	
	,api_evnt_all_params varchar(2047)
	,api_event_exception varchar(1024)	
	,error_code smallint
	,error varchar(1024)	
	, PRIMARY KEY (file_id,api_event_id,api_event_date_id)
     ) ENGINE=MYISAM  DEFAULT CHARSET=utf8  
     PARTITION BY RANGE (api_event_date_id)
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