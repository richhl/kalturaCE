#!/bin/bash
cd $(dirname $0)
chmod 777 ../content/uploads;
chmod 777 ../logs;
chmod 777 ../kaltura/alpha/cache;
chmod 777 ../indicators;
chmod -R 777 ../batchwatch;
chmod -R 777 ../content;
chmod 777 ../kaltura/alpha/apps/kaltura/config;
chmod 777 ../kaltura/alpha/config;
chmod 777 ../kaltura/api_v3/config;
chmod 777 ../kaltura/alpha/batch;
chmod 777 ../kaltura/api_v3/cache;
chmod -R 777 ../conversions
chmod -R 777 ../archive
