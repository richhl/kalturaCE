# aggregate all plays,loads,bandwidth & storage from the old days (2007,2008) into the last day of 2008 
INSERT INTO kalturadw.dwh_aggr_partner
	(partner_id,date_id,count_plays,count_loads,count_bandwidth,count_storage) 	
SELECT 
	partner_id,
	"20081231",
	SUM(IF(partner_activity_id=2 AND partner_sub_activity_id=201,amount,NULL)) count_plays,
	SUM(IF(partner_activity_id=2 AND partner_sub_activity_id=202,amount,NULL)) count_loads,
	SUM(IF(partner_activity_id=1 ,amount,NULL)) count_bandwidth,
	SUM(IF(partner_activity_id=3 AND partner_sub_activity_id=301,amount,NULL)) count_storage
FROM 
	dwh_fact_partner_activities 
WHERE
	activity_date_id <= 20081231 
	AND partner_activity_id IN(1,2,3) 
GROUP BY
	partner_id
ON DUPLICATE KEY UPDATE	
	count_plays=VALUES(count_plays),
	count_loads=VALUES(count_loads),
	count_bandwidth=VALUES(count_bandwidth),
	count_storage=VALUES(count_storage);

# aggregate all videos,imges,audio& mixes from the old days (2007,2008) into the last day of 2008
insert into  kalturadw.dwh_aggr_partner 
 (partner_id,date_id,count_video,count_image,count_audio,count_mix)
 SELECT 
 en.partner_id,"20081231",
 COUNT(IF(en.entry_media_type_id=1,1,NULL)) count_video,
 COUNT(IF(en.entry_media_type_id=2,1,NULL))count_image,
 COUNT(IF(en.entry_media_type_id=5,1,NULL)) count_audio,
 COUNT(IF(en.entry_media_type_id=6,1,NULL)) count_mix
 FROM dwh_dim_entries en
 WHERE en.created_at<"2009-01-01" and en.entry_media_type_id in (1,2,5,6)
 GROUP BY en.partner_id
ON DUPLICATE KEY UPDATE	
	count_video=VALUES(count_video),
	count_image=VALUES(count_image),
	count_audio=VALUES(count_audio),
	count_mix=VALUES(count_mix);


# aggregate all widgets from the old days (2007,2008) into the last day of 2008
INSERT INTO kalturadw.dwh_aggr_partner 
	(partner_id, 
	date_id, 
	count_widgets)
SELECT  
	partner_id,"20081231",
	COUNT(1)
FROM kalturadw.dwh_dim_widget  wd
WHERE 
    wd.created_date_id<= 20081231 
GROUP BY partner_id
ON DUPLICATE KEY UPDATE
	count_widgets=VALUES(count_widgets) ;


#---------------- for the begining of 2009 - insert per partner per month ------------------ 

# aggregate all plays,loads,bandwidth & storage from beginning of 2009  into the 31 day every month (even if logically doesnt exist in the calendar) 
INSERT INTO kalturadw.dwh_aggr_partner
	(partner_id,date_id,count_plays,count_loads,count_bandwidth,count_storage) 	
SELECT 
	partner_id,
	100*FLOOR(activity_date_id/100)+31 ,
	SUM(IF(partner_activity_id=2 AND partner_sub_activity_id=201,amount,NULL)) count_plays,
	SUM(IF(partner_activity_id=2 AND partner_sub_activity_id=202,amount,NULL)) count_loads,
	SUM(IF(partner_activity_id=1 ,amount,NULL)) count_bandwidth,
	SUM(IF(partner_activity_id=3 AND partner_sub_activity_id=301,amount,NULL)) count_storage
FROM 
	dwh_fact_partner_activities 
WHERE
	activity_date_id between 20090101 and 20090631 
	AND partner_activity_id IN(1,2,3) 
GROUP BY
	FLOOR(activity_date_id/100),partner_id
ON DUPLICATE KEY UPDATE	
	count_plays=VALUES(count_plays),
	count_loads=VALUES(count_loads),
	count_bandwidth=VALUES(count_bandwidth),
	count_storage=VALUES(count_storage);

# aggregate all videos,imges,audio& mixes from beginning of 2009  into the 31 day every month (even if logically doesnt exist in the calendar) 
insert into  kalturadw.dwh_aggr_partner 
 (partner_id,date_id,count_video,count_image,count_audio,count_mix)
 SELECT 
 en.partner_id,
100*FLOOR(en.created_date_id/100)+31,
 COUNT(IF(en.entry_media_type_id=1,1,NULL)) count_video,
 COUNT(IF(en.entry_media_type_id=2,1,NULL))count_image,
 COUNT(IF(en.entry_media_type_id=5,1,NULL)) count_audio,
 COUNT(IF(en.entry_media_type_id=6,1,NULL)) count_mix
 FROM dwh_dim_entries en
 WHERE en.created_date_id between 20090101 and 20090631
	AND en.entry_media_type_id in (1,2,5,6)
 GROUP BY FLOOR(en.created_date_id/100),en.partner_id
ON DUPLICATE KEY UPDATE	
	count_video=VALUES(count_video),
	count_image=VALUES(count_image),
	count_audio=VALUES(count_audio),
	count_mix=VALUES(count_mix);


# aggregate all widgets from beginning of 2009  into the 31 day every month (even if logically doesnt exist in the calendar) 
INSERT INTO kalturadw.dwh_aggr_partner 
	(partner_id, 
	date_id, 
	count_widgets)
SELECT  
	partner_id,
	100*FLOOR(wd.created_date_id/100)+31,
	COUNT(1)
FROM kalturadw.dwh_dim_widget  wd
WHERE 
    wd.created_date_id between 20090101 and 20090631
GROUP BY 
	FLOOR(wd.created_date_id/100),partner_id
ON DUPLICATE KEY UPDATE
	count_widgets=VALUES(count_widgets) ;



# run a quick fix for Feb 2009 - setting the aggr_date to 20090231 is problematic
UPDATE dwh_aggr_partner SET date_id=20090228 WHERE date_id>=20090201 AND date_id<20090301;


#---------------- for July 2009 - insert per partner per day - only for missing values ------------------ 

# aggregate all plays,loads,bandwidth & storage for July 2009  update NULL values only 
INSERT INTO kalturadw.dwh_aggr_partner
	(partner_id,date_id,count_plays,count_loads,count_bandwidth,count_storage) 	
SELECT 
	partner_id,
	activity_date_id ,
	SUM(IF(partner_activity_id=2 AND partner_sub_activity_id=201,amount,NULL)) count_plays,
	SUM(IF(partner_activity_id=2 AND partner_sub_activity_id=202,amount,NULL)) count_loads,
	SUM(IF(partner_activity_id=1 ,amount,NULL)) count_bandwidth,
	SUM(IF(partner_activity_id=3 AND partner_sub_activity_id=301,amount,NULL)) count_storage
FROM 
	dwh_fact_partner_activities 
WHERE
	activity_date_id between 20090701 and 20090731 
	AND partner_activity_id IN(1,2,3) 
GROUP BY
	activity_date_id,partner_id
ON DUPLICATE KEY UPDATE	
	count_plays=IF(ISNULL(count_plays),VALUES(count_plays),count_plays),
	count_loads=IF(ISNULL(count_loads),VALUES(count_loads),count_loads),
	count_bandwidth=IF(ISNULL(count_bandwidth),VALUES(count_bandwidth),count_bandwidth),
	count_storage=IF(ISNULL(count_storage),VALUES(count_storage),count_storage);

# aggregate all videos,imges,audio& mixes for July 2009  update NULL values only
insert into  kalturadw.dwh_aggr_partner 
 (partner_id,date_id,count_video,count_image,count_audio,count_mix)
 SELECT 
 en.partner_id,
en.created_date_id,
 COUNT(IF(en.entry_media_type_id=1,1,NULL)) count_video,
 COUNT(IF(en.entry_media_type_id=2,1,NULL))count_image,
 COUNT(IF(en.entry_media_type_id=5,1,NULL)) count_audio,
 COUNT(IF(en.entry_media_type_id=6,1,NULL)) count_mix
 FROM dwh_dim_entries en
 WHERE en.created_date_id between 20090701 and 20090731
	AND en.entry_media_type_id in (1,2,5,6)
 GROUP BY 
	en.created_date_id,en.partner_id
ON DUPLICATE KEY UPDATE	
	count_video=IF(ISNULL(count_video),VALUES(count_video),count_video),
	count_image=IF(ISNULL(count_image),VALUES(count_image),count_image),
	count_audio=IF(ISNULL(count_audio),VALUES(count_audio),count_audio),
	count_mix=IF(ISNULL(count_mix),VALUES(count_mix),count_mix);


# aggregate all widgets for July 2009  update NULL values only
INSERT INTO kalturadw.dwh_aggr_partner 
	(partner_id, 
	date_id, 
	count_widgets)
SELECT  
	partner_id,
	wd.created_date_id,
	COUNT(1)
FROM kalturadw.dwh_dim_widget  wd
WHERE 
    wd.created_date_id between 20090701 and 20090731
GROUP BY 
	wd.created_date_id,partner_id
ON DUPLICATE KEY UPDATE
	count_widgets=IF(ISNULL(count_widgets),VALUES(count_widgets),count_widgets) ;
