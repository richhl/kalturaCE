DELIMITER $$

USE `kalturadw`$$

DROP PROCEDURE IF EXISTS `top_activities`$$

CREATE DEFINER=`etl`@`localhost` PROCEDURE `top_activities`(  month_id INT , _limit INT , _order_by VARCHAR(40) )
BEGIN
	IF INSTR("storage,bandwidth,plays,loads",_order_by)=0 THEN
		SELECT "ERROR:" , "3rd parameter can be one of the following" , "[storage,bandwidth,plays,loads]";
	ELSE
		SET @s = CONCAT('
			SELECT 
				FLOOR(ap.date_id/100) month_id,
				ap.partner_id partner_id,
				pr.partner_name "name",
				pr.partner_package package,
				SUM(ap.count_storage) storage,
				SUM(ap.count_bandwidth) bandwidth,
                calc_partner_storage_data_last_month(',month_id,',ap.partner_id) "usage",
				SUM(ap.count_plays) plays,
				SUM(ap.count_loads) loads
			FROM dwh_aggr_partner ap, dwh_dim_partners pr
			WHERE 
				ap.partner_id=pr.partner_id AND
				FLOOR(date_id/100)=',month_id,'
			GROUP BY 
				ap.partner_id
			ORDER BY 
				', _order_by ,' DESC
			LIMIT ',_limit,';
		');
	  
		PREPARE stmt FROM  @s;
		EXECUTE stmt;
		DEALLOCATE PREPARE stmt;
	END IF;

END$$

DELIMITER ;