<?php
$action = $argv[1]; // start/stop 
$batch_name = @$argv[2];

// assume the rules.cfg is in this current directory
$rules_file_name = "ce_rules.cfg";
$service_batch_single = "./serviceBatchSingle.sh";
$content = file_get_contents( $rules_file_name );
$lines = explode ( PHP_EOL , $content );

if ( $batch_name )
{
	// work on single batch
	$cmd_line = "$service_batch_single $action " . $batch_name;
	echo "$cmd_line\n";
//	ob_start();
	echo passthru( $cmd_line , $res );
	die();
}

// run on all batchs
foreach ( $lines as $line ) 
{
	$args = explode (" " , $line );
	$cmd_line = "$service_batch_single $action " . $args[0];
	echo "$cmd_line\n";
//	ob_start();
	echo passthru( $cmd_line , $res );
//	echo ob_get_contents();
//	ob_clean();
}
?>