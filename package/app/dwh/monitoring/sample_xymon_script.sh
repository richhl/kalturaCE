#!/bin/bash

MONDIR=/home/michael/Projects/kaltura/dwh/monitoring

COLOR=green

#BBTMP=/home/xymon/client/tmp

OUTFILE=$MONDIR/outfile.$$

#BB=/home/xymon/client/bin/bb

#BBDISP="208.122.58.141"

MACHINE=`localhost`

for mycheck in `ls $MONDIR | grep ^find`

    do

      #echo "$mycheck running :"

      outcheck=`sed -e "/<<STMT>>/r $MONDIR/$mycheck" -e "s/<<STMT>>//" -e "s/<<filename>>/$mycheck/" $MONDIR/monitor_stmt.sql | mysql -uetl -petl`

      if [ "X$outcheck" != "X" ]

         then

            echo "Error in $mycheck query : "  >> $OUTFILE

            echo "$outcheck" >> $OUTFILE

            echo -e "\n" >> $OUTFILE

            if [ $COLOR == "green" ] ; then

                 COLOR=red

            fi

            if [ $mycheck == "find_ri_new_rows.sql" ] ; then

                COLOR=yellow

            fi

         fi

    done

#COLOR=green

if [ $COLOR == "green" ]; then

     echo "All checks are ok " >> $OUTFILE

fi

#$BB $BBDISP "status $MACHINE.etlmon $COLOR `date`

cat $OUTFILE

rm -f $OUTFILE
