/* Find different or missing rows*/
SELECT partner_activity_id,IFNULL(amount9,''),IFNULL(amount8,''),IFNULL(amount7,''),IFNULL(amount6,''),IFNULL(amount5,''),IFNULL(amount4,''),IFNULL(amount3,''),IFNULL(amount2,''),IFNULL(amount1,''),IFNULL(amount,''),IFNULL(partner_sub_activity_id,''),IFNULL(activity_date,''),IFNULL(partner_id,''),IFNULL(activity_id,'') 
FROM kalturadw.dwh_fact_partner_activities
 WHERE (partner_activity_id,IFNULL(amount9,''),IFNULL(amount8,''),IFNULL(amount7,''),IFNULL(amount6,''),IFNULL(amount5,''),IFNULL(amount4,''),IFNULL(amount3,''),IFNULL(amount2,''),IFNULL(amount1,''),IFNULL(amount,''),IFNULL(partner_sub_activity_id,''),IFNULL(activity_date,''),IFNULL(partner_id,''),IFNULL(activity_id,'')) 
NOT IN (SELECT IFNULL(activity,''),IFNULL(amount9,''),IFNULL(amount8,''),IFNULL(amount7,''),IFNULL(amount6,''),IFNULL(amount5,''),IFNULL(amount4,''),IFNULL(amount3,''),IFNULL(amount2,''),IFNULL(amount1,''),IFNULL(amount,''),IFNULL(sub_activity,''),IFNULL(activity_date,''),IFNULL(partner_id,''),id
		FROM kaltura.partner_activity)
UNION ALL 
 SELECT IFNULL(activity,''),IFNULL(amount9,''),IFNULL(amount8,''),IFNULL(amount7,''),IFNULL(amount6,''),IFNULL(amount5,''),IFNULL(amount4,''),IFNULL(amount3,''),IFNULL(amount2,''),IFNULL(amount1,''),IFNULL(amount,''),IFNULL(sub_activity,''),IFNULL(activity_date,''),IFNULL(partner_id,''),id 
FROM kaltura.partner_activity
 WHERE (IFNULL(activity,''),IFNULL(amount9,''),IFNULL(amount8,''),IFNULL(amount7,''),IFNULL(amount6,''),IFNULL(amount5,''),IFNULL(amount4,''),IFNULL(amount3,''),IFNULL(amount2,''),IFNULL(amount1,''),IFNULL(amount,''),IFNULL(sub_activity,''),IFNULL(activity_date,''),IFNULL(partner_id,''),id)
 NOT IN (SELECT partner_activity_id,IFNULL(amount9,''),IFNULL(amount8,''),IFNULL(amount7,''),IFNULL(amount6,''),IFNULL(amount5,''),IFNULL(amount4,''),IFNULL(amount3,''),IFNULL(amount2,''),IFNULL(amount1,''),IFNULL(amount,''),IFNULL(partner_sub_activity_id,''),IFNULL(activity_date,''),IFNULL(partner_id,''),IFNULL(activity_id,'')
		FROM kalturadw.dwh_fact_partner_activities)
ORDER BY partner_activity_id;
