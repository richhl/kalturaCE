#!/bin/bash
function mysqlexec {
        echo "now executing $1"
        mysql -u etl -petl < $1 >>  $SQL_LOG

		ret_val=$?
        if [ $ret_val -ne 0 ];then
			echo $ret_val
			echo "Error - bailing out!"
			exit
        fi
}


KITCHEN=/usr/local/pentaho/pdi/kitchen.sh

ETL_ROOT_DIR=/home/etl/etlsource/

SQL_ROOT_DIR=/home/etl/ddl/
BISOURCE_ROOT_DIR=$SQL_ROOT_DIR/bi_sources/
DS_ROOT_DIR=$SQL_ROOT_DIR/ds/
DW_ROOT_DIR=$SQL_ROOT_DIR/dw/
SETUP_ROOT_DIR=$SQL_ROOT_DIR/setup/

SQL_LOG=$SQL_ROOT_DIR/installation_log

#general
mysqlexec $SQL_ROOT_DIR/db_drop.sql
