DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw`.`calc_partner_billing_data`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE kalturadw.`calc_partner_billing_data`(date_val DATE,partner_id VARCHAR(100))
BEGIN

SET @current_date_id=DATE(date_val)*1;
SET @current_partner_id=partner_id;

SELECT
	kalturadw.calc_month_id(continuous_partner_storage.date_id) month_id,
	continuous_partner_storage.partner_id,
	DAY(LAST_DAY(continuous_partner_storage.date_id)) last_day_of_month,
	SUM(IF(DAY(continuous_partner_storage.date_id)=1,continuous_partner_storage.aggr_storage,NULL)) aggr_storage_first_day_of_month_mb,
	SUM(continuous_aggr_storage) sum_continuous_aggr_storage_mb,
	SUM(continuous_aggr_storage/DAY(LAST_DAY(continuous_partner_storage.date_id))) avg_continuous_aggr_storage_mb,
	SUM(continuous_partner_storage.count_bandwidth) sum_partner_bandwidth_kb
FROM
(	
		SELECT 
			all_times.day_id date_id,
	#		aggr_p.partner_id,
			@current_partner_id partner_id,
			aggr_p.aggr_storage aggr_storage,
			aggr_p.count_bandwidth count_bandwidth,
			IF(aggr_p.aggr_storage IS NOT NULL, aggr_p.aggr_storage,
				(SELECT aggr_storage FROM dwh_aggr_partner inner_a_p 
				 WHERE 
					inner_a_p.partner_id=@current_partner_id AND 
					inner_a_p.date_id<all_times.day_id AND 
					inner_a_p.aggr_storage IS NOT NULL ORDER BY inner_a_p.date_id DESC LIMIT 1)) continuous_aggr_storage
		FROM 
			dwh_aggr_partner aggr_p RIGHT JOIN
			dwh_dim_time all_times
			ON (all_times.day_id=aggr_p.date_id 
				AND all_times.day_id>=20081230
				AND all_times.day_id <= @current_date_id 
				AND aggr_p.partner_id=@current_partner_id)
		WHERE 	
			all_times.day_id>=20081230 AND all_times.day_id <= @current_date_id 
		GROUP BY
			all_times.day_id,
			aggr_p.partner_id
	) continuous_partner_storage
	GROUP BY
		continuous_partner_storage.partner_id,
		kalturadw.calc_month_id(continuous_partner_storage.date_id)
	WITH ROLLUP;	
	

    END$$

DELIMITER ;



#--------------------- calc_partner_billing_data_last_month - last month only -------------------
# slightly different interface 

DELIMITER $$

DROP FUNCTION IF EXISTS `kalturadw`.`calc_partner_storage_data_last_month`$$

CREATE DEFINER=`root`@`localhost` FUNCTION kalturadw.`calc_partner_storage_data_last_month`(month_id INT ,partner_id INT )
	RETURNS INT DETERMINISTIC
BEGIN

DECLARE pid INT;
DECLARE avg_cont_aggr_storage INT;

SET @current_month_id=month_id;
SET @current_partner_id=partner_id;

SELECT
	continuous_partner_storage.partner_id,
	SUM(continuous_aggr_storage/DAY(LAST_DAY(continuous_partner_storage.date_id))) avg_continuous_aggr_storage_mb
INTO 
	pid,avg_cont_aggr_storage
FROM
(	
		SELECT 
			all_times.day_id date_id,
			@current_partner_id partner_id,
			aggr_p.aggr_storage aggr_storage,
			aggr_p.count_bandwidth count_bandwidth,
			IF(aggr_p.aggr_storage IS NOT NULL, aggr_p.aggr_storage,
				(SELECT aggr_storage FROM dwh_aggr_partner inner_a_p 
				 WHERE 
					inner_a_p.partner_id=@current_partner_id AND 
					inner_a_p.date_id<all_times.day_id AND 
					inner_a_p.aggr_storage IS NOT NULL ORDER BY inner_a_p.date_id DESC LIMIT 1)) continuous_aggr_storage
		FROM 
			dwh_aggr_partner aggr_p RIGHT JOIN
			dwh_dim_time all_times
			ON (all_times.day_id=aggr_p.date_id 
				AND all_times.day_id>=20081230
				AND kalturadw.calc_month_id(all_times.day_id) <= @current_month_id 
				AND aggr_p.partner_id=@current_partner_id)
		WHERE 	
			all_times.day_id>=20081230 AND kalturadw.calc_month_id(all_times.day_id) <= @current_month_id 
		GROUP BY
			all_times.day_id,
			aggr_p.partner_id
	) continuous_partner_storage
WHERE 
	kalturadw.calc_month_id(continuous_partner_storage.date_id)=@current_month_id
GROUP BY
		continuous_partner_storage.partner_id,
		kalturadw.calc_month_id(continuous_partner_storage.date_id);

RETURN avg_cont_aggr_storage;

END$$

DELIMITER ;