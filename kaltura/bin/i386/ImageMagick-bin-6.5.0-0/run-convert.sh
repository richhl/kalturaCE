#!/bin/bash
KALTURA_BIN=/web/kaltura/bin/i386
LD_LIBRARY_PATH=$KALTURA_BIN/ImageMagick-bin-6.5.0-0 $KALTURA_BIN/ImageMagick-bin-6.5.0-0/convert $@
