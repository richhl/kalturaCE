#!/bin/bash

MAILUSERS="@DWH_SEND_REPORT_MAIL@"

if [ $# -eq 0 ]; then

        echo "No specific date requested, taking today"

        WHEN=$(date +%Y%m%d)

elif [ $# -eq 1 ]; then

        echo "You requested $1"

        WHEN=$1

else

        echo "Invalid user input"

        exit 1;

fi

 
ETLHOME="@ETL_HOME_DIR@"

ETLOGS="${ETLHOME}/logs"

JOBLOG="${ETLOGS}/etl_job-$WHEN.log"




    if [ -s @LOG_DIR@/kaltura_apache_access.log-$WHEN.gz ] ; then

        echo -e "\n"

        echo "-----------------------------" >>$JOBLOG

        echo "kaltura access log is processed" >>$JOBLOG

        echo "-----------------------------" >>$JOBLOG

        zcat @LOG_DIR@/kaltura_apache_access.log-$WHEN.gz |php @APP_DIR@/alpha/scripts/create_event_log_from_apache_access_log.php  2>>$JOBLOG > ${ETLHOME}/events/_events_log_combined_kaltura-${WHEN}

        mv ${ETLHOME}/events/_events_log_combined_kaltura-${WHEN} ${ETLHOME}/events/events_log_combined_kaltura-${WHEN}

   else

        echo -e "\n"

        echo "-----------------------------" >>$JOBLOG

        echo "kaltura access log couldnt be  processed" >>$JOBLOG

        echo "-----------------------------" >>$JOBLOG

        echo "kaltura access log couldnt be  processed" | mail -s "etljob file failed : `date`" ${MAILUSERS}

   fi
