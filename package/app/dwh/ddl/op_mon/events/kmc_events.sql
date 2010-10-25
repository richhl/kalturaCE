CREATE TABLE kaltura_op_mon.dwh_fact_kmc_events
     (
	  file_id INT NOT NULL
	,kmc_event_id	INT  NOT NULL 
	,kmc_client_version varchar(50)
	,kmc_event_type_id	smallint  NOT NULL
	,kmc_event_time datetime
	,kmc_event_date_id	INT
	,kmc_event_hour_id	TINYINT
	,kmc_event_session_id  varchar(50)
	,kmc_event_action_path varchar(255)
	,kmc_event_client_timestamp bigint(20)
	,kmc_event_ks varchar(200)
	,partner_id int
	,uid varchar(50)
	,entry_id varchar(20)
	,ui_conf_id int
	,widget_id varchar(20)
	,flavor_id varchar(20)
	,user_ip varchar(20)
	,ip_long bigint(20)
	,error_code smallint
	,error varchar(1024)	
	, PRIMARY KEY (file_id,kmc_event_id,kmc_event_date_id)
     ) ENGINE=MYISAM  DEFAULT CHARSET=utf8  
     PARTITION BY RANGE (kmc_event_date_id)
( PARTITION p_200910 VALUES LESS THAN (20091100), 
 PARTITION p_200911 VALUES LESS THAN (20091200), 
 PARTITION p_200912 VALUES LESS THAN (20100100), 
 PARTITION p_201001 VALUES LESS THAN (20100200),
 PARTITION p_201002 VALUES LESS THAN (20100300),
 PARTITION p_201003 VALUES LESS THAN (20100400)
) ;