#!/bin/bash
rm -rf ../content/uiconf
cp -r ../content/uiconf.template ../content/uiconf
find ../content/uiconf -name "*.xml" -exec $1 replace_root.php {} $2 \;
