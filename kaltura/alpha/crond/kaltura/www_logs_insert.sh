#!/bin/bash

cd /opt/kaltura/logs

echo -n "Working dir: "
pwd

if [ $# -eq 0 ]; then
	echo "No specific date requested, taking today"
	WHEN=$(date +%Y-%m-%d)
	WHEN2=$(date -d "yesterday" +%Y-%m-%d)

#elif [ $# -eq 1 ]; then
#	echo "You requested $1"
#	WHEN=$1
else
	echo "Invalid user input"
	exit 1;
fi

zcat /web/logs/investigate/APACHE?-access_log-$WHEN.gz |php /web/kaltura/alpha/scripts/billing_summary_www.php  >www_res
php /web/kaltura/alpha/scripts/billing_summary_insert.php www $WHEN www_res >www_res.sql
mysql -hdb kaltura -uroot -proot < www_res.sql

rm -f www_res
rm -f www_res.sql


cd /opt/kaltura/logs

# extract unique ips

zcat /web/logs/investigate/APACHE?-access_log-$WHEN.gz |awk '{print $1}'|grep '^[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}'|sort -u >uvip_$WHEN

php /web/kaltura/alpha/scripts/uv_summary_insert.php ip $WHEN uvip_$WHEN > ip_res.sql
mysql -hdb kaltura -uroot -proot < ip_res.sql

rm -f ip_res.sql

# extract unique cookies

zcat /web/logs/investigate/APACHE?-access_log-$WHEN.gz |php /web/kaltura/alpha/scripts/find_unique_visitors.php >uv_$WHEN

php /web/kaltura/alpha/scripts/uv_summary_insert.php cookie $WHEN uv_$WHEN > cookie_res.sql
mysql -hdb kaltura -uroot -proot < cookie_res.sql

rm -f cookie_res.sql

# extract collect stats

zcat /web/logs/investigate/APACHE?-access_log-$WHEN.gz |php /web/kaltura/alpha/scripts/analyze_collect_stats.php >collect_res.sql

mysql -hdb kaltura -uroot -proot < collect_res.sql

rm -f collect_res.sql

# update partner_activity
/web/kaltura/alpha/scripts/update_partner_activity.sh $WHEN2

# update entry views and plays
SQLDATE=`mysql -hdb -uroot kaltura -proot -s -N -e "select max(created_at) from entry where views>0"`
echo $SQLDATE

LOGDATE=${SQLDATE// /-}
LOGDATE=${LOGDATE//:/-}

echo $LOGDATE

mysql -hdb -uroot -proot kaltura -e "select id,views,plays from entry" >all_entries-$LOGDATE

mysql -hdb -uroot -proot kaltura -ss -e "select entry_id,sum(command='view'),sum(command='play') from collect_stats where date>'$SQLDATE' and entry_id<>'' group by entry_id;" > inc_entry-$LOGDATE

cat inc_entry-$LOGDATE| awk '{print "update entry set views=views+"$2",plays=plays+"$3" where id=\""$1"\";"}'>inc-$LOGDATE.sql

mysql -hdb -uroot -proot kaltura < inc-$LOGDATE.sql
