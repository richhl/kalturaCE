#!/bin/bash

cd /opt/kaltura/logs

WHEN=$(date -d "yesterday" +%Y-%m-%d)

php /web/kaltura/support_prod/test/dummy/findEntriesSizes.php $WHEN
php /web/kaltura/support_prod/test/dummy/findMediaStats.php $WHEN
#not ready yet
#php /web/kaltura/alpha/test/dummy/findUserStats.php $WHEN
php /web/kaltura/alpha/batch/batchPartnerUsage.php >> /web/logs/BATCH1-batchPartnerUsage.log

