#!/bin/bash
set -e
set -u
export SRC_DIR=$1
export DST_DIR=$2
export PREFIX=$3
export SUFFIX=$4
for FILE in `find ${SRC_DIR}/*.gz`
do
export FILE_NAME=`echo $FILE | sed 's/.*\/\([^\/]*\)$/\1/'`
export DESTINATION="${DST_DIR}/${PREFIX}_${FILE_NAME/%gz}${SUFFIX}"
echo "Begin: Unzipping log files"
touch $DESTINATION
gunzip -cv $FILE | sed '/^#/d' > $DESTINATION
echo "End: Unzipping log files"
done
