CREATE TABLE kalturadw.dwh_dim_bandwidth_source
(`bandwidth_source_id` INT,
`bandwidth_source_name` VARCHAR(50),
dwh_creation_date DATETIME ,
dwh_update_date DATETIME ,
ri_ind TINYINT DEFAULT 0,
PRIMARY KEY(`bandwidth_source_id`));
