<?php
/**
 * 
 * @package Scheduler
 * @subpackage Conversion
 */
class KConversionEngineExpressionEncoder3 extends KCollectionConversionEngine
{
	const EXPRESSION_ENCODER_3 = "Expression Encoder 3";
	
	public function getName()
	{
		return self::EXPRESSION_ENCODER_3;
	}
	
	public function getType()
	{
		return KalturaConversionEngineType::EXPRESSION_ENCODER3;
	}
	
	public function getCmd ()
	{
		return $this->engine_config->params->expEncoderCmd;
	}
	
	protected function convertCollection ( KalturaConvertCollectionJobData &$data )
	{
		$error_message = "";
		KalturaLog::debug(__METHOD__ . " Src File Path: " . $data->actualSrcFileSyncLocalPath);
		
		if ( ! file_exists ( $data->actualSrcFileSyncLocalPath ) )
		{
			$error_message = "File [{$data->actualSrcFileSyncLocalPath}] does not exist";
			KalturaLog::err(  $error_message );
			return array ( false , $error_message );
		}

		$log_file = $data->destDirLocalPath . DIRECTORY_SEPARATOR . $data->destFileName . '.log';
		KalturaLog::debug(__METHOD__ . " Log File Path: $log_file");
	
		// will hold a list of commands
		// there is a list (most probably holding a single command)
		// just incase there are multiple commands such as in FFMPEG's 2 pass
		$conversion_engine_result_list = $this->getExecutionCommandAndConversionString ( $data );
		
		self::addToLogFile ( $log_file , "Executed by [" . $this->getName() . "]" ) ;
		
		// add media info of source 
		self::logMediaInfo ( $log_file , $data->actualSrcFileSyncLocalPath );
		
		$duration = 0;
		foreach ( $conversion_engine_result_list as $conversion_engine_result )
		{
			$execution_command_str = $conversion_engine_result->exec_cmd;
			$conversion_str = $conversion_engine_result->conversion_string; 
			
			self::addToLogFile ( $log_file , $execution_command_str ) ;
			self::addToLogFile ( $log_file , $conversion_str ) ;
				
			KalturaLog::info ( $execution_command_str );
	
			$start = microtime(true);
			// TODO add BatchEvent - before conversion + conversion engine 
			$output = system( $execution_command_str , $return_value );
			
			// TODO add BatchEvent - after conversion + conversion engine		
			$end = microtime(true);
	
			// 	TODO - find some place in the DB for the duration
			$duration += ( $end - $start );
						 
			KalturaLog::info ( $this->getName() . ": [$return_value] took [$duration] seconds" );
			
			self::addToLogFile ( $log_file , $output ) ;
			
			if ( $return_value != 0 ) 
				return array ( false , "return value: [$return_value]"  );
		}
		
		$this->parseCreatedFiles($data);
		foreach($data->flavors as $flavor)
		{
			$filePath = $data->destFileSyncLocalPath;
			self::addToLogFile ( $log_file , "media info [$filePath]" ) ;
			self::logMediaInfo ( $log_file , $filePath );
		}
		
		return array ( true , $error_message );// indicate all was converted properly
	}
	
	protected function parseCreatedFiles(KalturaConvertCollectionJobData &$data)
	{
		$xmlPath = $data->destDirLocalPath . DIRECTORY_SEPARATOR . $data->destFileName . '.ism';
		
		// in case of wma
		if(!file_exists($xmlPath))
		{
			$wmaPath = $data->destDirLocalPath . DIRECTORY_SEPARATOR . $data->destFileName . '.wma';
			if(file_exists($wmaPath) && count($data->flavors) == 1) // only one audio flavor
			{
				foreach($data->flavors as $index => $flavor)
					$data->flavors[$index]->destFileSyncLocalPath = $wmaPath;
			}
			
			return;
		}
		
		$xml = file_get_contents($xmlPath);
		$xml = mb_convert_encoding($xml, 'ASCII', 'UTF-16');
		$arr = null;
		if(preg_match('/(<smil[\s\w\W]+<\/smil>)/', $xml, $arr))
			$xml = $arr[1];
		file_put_contents($xmlPath, $xml);
		
		//echo $xml;
		$doc = new DOMDocument();
		$doc->loadXML($xml);
		$videoEntities = $doc->getElementsByTagName('video');
		foreach($videoEntities as $videoEntity)
		{
			$src = $videoEntity->getAttribute("src");
			$bitrate = $videoEntity->getAttribute("systemBitrate") / 1000;
			
			foreach($data->flavors as $index => $flavor)
				if($flavor->videoBitrate == $bitrate)
					$data->flavors[$index]->destFileSyncLocalPath = $data->destDirLocalPath . DIRECTORY_SEPARATOR . $src;
		}
	}
}