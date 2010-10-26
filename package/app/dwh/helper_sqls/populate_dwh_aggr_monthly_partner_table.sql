
INSERT IGNORE INTO kalturadw.dwh_aggr_monthly_partner 
	(partner_id, 
	month_id, 
	last_calculated_date_id,
	sum_time_viewed, 
	count_time_viewed, 
	count_plays, 
	count_loads, 
	count_plays_25, 
	count_plays_50, 
	count_plays_75, 
	count_plays_100, 
	count_edit, 
	count_viral, 
	count_download, 
	count_report, 
	count_media, 
	count_video, 
	count_image, 
	count_audio, 
	count_mix, 
#	count_mix_non_empty, 
	count_playlist, 
	count_bandwidth, 
	count_storage, 
	count_users, 
	count_widgets, 
	flag_active_site, 
	flag_active_publisher
#	,count_buf_start, 
#	count_buf_end, 
#	sum_bandwidth_mb, 
#	sum_storage_mb, 
#	sum_monthly_bandwidth_mb, 
#	calculated_storage_mb, 
#	calculated_monthly_storage_mb
	)
SELECT 	temp_agg_partner.partner_id, 
	temp_agg_partner.month_id,
	temp_agg_partner.date_id,
	IFNULL(temp_agg_partner.sum_sum_time_viewed,0),
	IFNULL(temp_agg_partner.sum_time_viewed,0),
	IFNULL(temp_agg_partner.sum_plays,0),
	IFNULL(temp_agg_partner.sum_loads,0),
	IFNULL(temp_agg_partner.sum_plays_25,0),
	IFNULL(temp_agg_partner.sum_plays_50,0),
	IFNULL(temp_agg_partner.sum_plays_75,0),
	IFNULL(temp_agg_partner.sum_plays_100,0),
	IFNULL(temp_agg_partner.sum_edit,0),
	IFNULL(temp_agg_partner.sum_viral,0),
	IFNULL(temp_agg_partner.sum_download,0),
	IFNULL(temp_agg_partner.sum_report,0),
	IFNULL(temp_agg_partner.sum_video,0) + IFNULL(temp_agg_partner.sum_image,0) + IFNULL(temp_agg_partner.sum_audio,0) sum_media,
	IFNULL(temp_agg_partner.sum_video,0),
	IFNULL(temp_agg_partner.sum_image,0),
	IFNULL(temp_agg_partner.sum_audio,0),
	IFNULL(temp_agg_partner.sum_mix,0),
	#	SUM(aggr_partner.count_mix_non_empty) 
	IFNULL(temp_agg_partner.sum_playlist,0),
	IFNULL(temp_agg_partner.sum_bandwidth,0),
	IFNULL(temp_agg_partner.sum_storage,0),
	IFNULL(temp_agg_partner.sum_users,0),
	IFNULL(temp_agg_partner.sum_widgets,0)	,
	IF(temp_agg_partner.sum_loads>=10 OR temp_agg_partner.sum_plays>=1,1,0),
	IF(temp_agg_partner.temp_agg_partner.sum_video + temp_agg_partner.sum_image + temp_agg_partner.sum_audio >=1 OR temp_agg_partner.sum_widgets>=1,1,0)    		
FROM
(
	SELECT 
		partner_id, 
		kalturadw.calc_month_id(aggr_partner.date_id) month_id,
		aggr_partner.date_id,
		SUM(aggr_partner.sum_time_viewed) sum_sum_time_viewed,
		SUM(aggr_partner.count_time_viewed) sum_time_viewed,
		SUM(aggr_partner.count_plays) sum_plays,
		SUM(aggr_partner.count_loads) sum_loads,
		SUM(aggr_partner.count_plays_25) sum_plays_25,
		SUM(aggr_partner.count_plays_50) sum_plays_50,
		SUM(aggr_partner.count_plays_75) sum_plays_75,
		SUM(aggr_partner.count_plays_100) sum_plays_100,
		SUM(aggr_partner.count_edit) sum_edit,
		SUM(aggr_partner.count_viral) sum_viral,
		SUM(aggr_partner.count_download) sum_download,
		SUM(aggr_partner.count_report) sum_report,
	#	SUM(aggr_partner.count_media) sum_media,
		SUM(aggr_partner.count_video) sum_video,
		SUM(aggr_partner.count_image) sum_image,
		SUM(aggr_partner.count_audio) sum_audio,
		SUM(aggr_partner.count_mix) sum_mix,
	#	SUM(aggr_partner.count_mix_non_empty) 
		SUM(aggr_partner.count_playlist) sum_playlist,
		SUM(aggr_partner.count_bandwidth) sum_bandwidth,
		SUM(aggr_partner.count_storage) sum_storage,
		SUM(aggr_partner.count_users) sum_users,
		SUM(aggr_partner.count_widgets) sum_widgets
	FROM 
		kalturadw.dwh_aggr_partner aggr_partner,dwh_dim_time all_times
	WHERE 
		aggr_partner.date_id=IF(NOW()<LAST_DAY(aggr_partner.date_id),NOW(),LAST_DAY(aggr_partner.date_id))
		AND aggr_partner.date_id=all_times.day_id
		AND all_times.day_id>=20090701 AND all_times.day_id<=20090831
	GROUP BY 
		aggr_partner.partner_id,kalturadw.calc_month_id(aggr_partner.date_id)
) temp_agg_partner;

