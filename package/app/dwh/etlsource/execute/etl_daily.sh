#!/bin/bash
KITCHEN=/usr/local/pentaho/pdi/kitchen.sh
ROOT_DIR=/opt/kaltura/dwh
WHEN=$(date +%Y%m%d)

while getopts "k:p:" o
do	case "$o" in
    k)	KITCHEN="$OPTARG";;
    p)	ROOT_DIR="$OPTARG";;
	[?])	echo >&2 "Usage: $0 [-k  pdi-path] [-p dwh-path]"
		exit 1;;
	esac
done

LOGFILE=$ROOT_DIR/logs/etl_daily-${WHEN}.log

sh $ROOT_DIR/etlsource/execute/daily.sh -k $KITCHEN -p $ROOT_DIR >> $LOGFILE 2>&1

if [ $? == "0" ]; then
        notify_mail_subject="Dev Daily succeeded"
else
        notify_mail_subject="Dev Daily failed"
        rm -f $LOGFILE.gz
        gzip -c $LOGFILE > $LOGFILE.gz
        attachment=$LOGFILE.gz
fi
 
recipients=dor.porat@kaltura.com
 
/usr/bin/php $ROOT_DIR/etlsource/scripts/reporting/sendMail.php dwh@kaltura.com $recipients "$notify_mail_subject" $attachment < /dev/null
 
