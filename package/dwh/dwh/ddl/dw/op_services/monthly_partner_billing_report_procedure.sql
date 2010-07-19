DELIMITER $$

DROP PROCEDURE IF EXISTS `kalturadw`.`monthly_partner_billing_report`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE kalturadw.`monthly_partner_billing_report`( month_id int )
BEGIN

SET @current_month = month_id;
	SELECT 
		calculated_stats.month_id,
		calculated_stats.partner_id "partner_id",
		kalturadw.get_secondary_partners_as_string(calculated_stats.partner_id) "partners in group",
		dim_partner.partner_name,
		dim_partner.partner_package pkg,
		if(calculated_stats.sum_billing_storage_mb IS NOT NULL,calculated_stats.sum_billing_storage_mb,0)
		 + if(calculated_stats.sum_bandwith_for_month_mb IS NOt NULL,calculated_stats.sum_bandwith_for_month_mb,0) sum_billing_for_month_mb,
		calculated_stats.sum_bandwith_for_month_mb,
		calculated_stats.sum_billing_storage_mb,
		calculated_stats.sum_storage_for_month_mb,
		calculated_stats.sum_storage_all_time_mb/* in MB */,
		calculated_stats.sum_bandwidth_all_time_mb/* in KB */
	FROM
	(
		SELECT 
			@current_month month_id,
			kalturadw.get_primary_partner(aggr_single_partner.partner_id) "partner_id",
			FLOOR(SUM(aggr_single_partner.sum_bandwith_for_month_aggr_kb)/1024) sum_bandwith_for_month_mb,
			SUM(aggr_single_partner.billing_storage_mb) sum_billing_storage_mb,
			SUM(aggr_single_partner.sum_count_storage_for_month_aggr_mb) sum_storage_for_month_mb,
			SUM(aggr_single_partner.sum_storage_all_time_mb) sum_storage_all_time_mb/* in MB */,
			FLOOR(SUM(aggr_single_partner.sum_bandwidth_all_time_kb)/1024) sum_bandwidth_all_time_mb/* in KB */
		FROM	
		(
			SELECT
				kalturadw.calc_month_id(aggr_partner.date_id) month_id, 
				aggr_partner.partner_id,
				SUM(aggr_partner.count_bandwidth) sum_bandwidth_all_time_kb,
				SUM(aggr_partner.count_storage) sum_storage_all_time_mb,
				kalturadw.calc_partner_storage_data_last_month(@current_month , aggr_partner.partner_id) billing_storage_mb , 
				SUM(IF(kalturadw.calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_bandwidth,NULL)) sum_bandwith_for_month_aggr_kb /* in KB */,
				SUM(IF(kalturadw.calc_month_id(aggr_partner.date_id)=@current_month,aggr_partner.count_storage,NULL)) sum_count_storage_for_month_aggr_mb /* in mB */
			FROM 
				kalturadw.dwh_aggr_partner aggr_partner, 
				kalturadw.dwh_dim_partners inner_dim_partner USE INDEX (partner_package_indx)
			WHERE 
				kalturadw.calc_month_id(aggr_partner.date_id)<=@current_month 
				AND aggr_partner.partner_id=inner_dim_partner.partner_id
				AND inner_dim_partner.partner_package>1 
	
			GROUP BY 
				aggr_partner.partner_id
		) aggr_single_partner
		GROUP BY 
			kalturadw.get_primary_partner(aggr_single_partner.partner_id)
		ORDER BY 
			kalturadw.get_primary_partner(aggr_single_partner.partner_id) ASC
	) calculated_stats , 
			kalturadw.dwh_dim_partners dim_partner 
	WHERE
		calculated_stats.partner_id=dim_partner.partner_id
		AND dim_partner.partner_package>1;
	END$$

DELIMITER ;