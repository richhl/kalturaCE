#!/bin/bash
mkdir `date +%b%y`
cd `date +%b%y`
perl ../download.pl -package DB7 -login alex.bandel@kaltura.com -password S47CW89L

unzip IP-COUNTRY-REGION-CITY-ISP-DOMAIN-FULL.ZIP

mv IP-COUNTRY-REGION-CITY-ISP-DOMAIN.CSV /tmp/IP-COUNTRY-REGION-CITY-ISP-DOMAIN.CSV

/usr/local/pentaho/pdi/kitchen.sh -file /home/etl/etlsource/ip2location/load_ip2location.kjb
