<?php

if ($total_length < 1000) // (actually $total_length is probably 13 or 143 - header + empty metadata tag) probably a bad flv maybe only the header - dont cache
	requestUtils::sendCdnHeaders("flv", $total_length, 0);
else
	requestUtils::sendCdnHeaders("flv", $total_length);

if ( $flv_wrapper == null )
	die;
	
$chunk_size =  1*1024*1024;
	
$flv_wrapper->dump($chunk_size, $from_byte, $to_byte, $audio_only);

die; // prevent symfony from sending its headers and filling our logs with warnings
?>