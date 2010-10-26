#!/bin/bash
function mysqlexec {
        echo "now executing $1"
        mysql -u $2 -p$3 < $1 >>  $SQL_LOG

		ret_val=$?
        if [ $ret_val -ne 0 ];then
			echo $ret_val
			echo "Error - bailing out!"
			exit
        fi
}

user="etl"
pw="etl"
KITCHEN=/usr/local/pentaho/pdi/kitchen.sh
ROOT_DIR=/home/etl

while getopts "u:p:k:d:" o
do	case "$o" in
	u)	user="$OPTARG";;
	p)	pw="$OPTARG";;
    k)	KITCHEN="$OPTARG";;
    d)	ROOT_DIR="$OPTARG";;
	[?])	echo >&2 "Usage: $0 [-u username] [-p password] [-k  pdi-path] [-d dwh-path]"
		exit 1;;
	esac
done

ETL_ROOT_DIR=$ROOT_DIR/etlsource/

SQL_ROOT_DIR=$ROOT_DIR/ddl/
BISOURCE_ROOT_DIR=$SQL_ROOT_DIR/bi_sources/
DS_ROOT_DIR=$SQL_ROOT_DIR/ds/
DW_ROOT_DIR=$SQL_ROOT_DIR/dw/
SETUP_ROOT_DIR=$SQL_ROOT_DIR/setup/

SQL_LOG=$SQL_ROOT_DIR/installation_log

#general
mysqlexec $SQL_ROOT_DIR/db_drop.sql $user $pw
