#!/bin/bash

find /web/content/uploads -ctime +7 -delete
find /web/content/webcam -ctime +7 -delete
find /web/conversions/preconvert -ctime +7 -delete

