<?php
/**
 * Will handle a kConversionCommand and make sure the best kConversionEngine does the conversion successfully.
 * The result will be a kConversionResult object that reflect the whole conversion process for the multiple results from the command
 * depending on the number of the kConversionParam objects. 
 */
class kConversionEngineMgr 
{
	public static function simulate ( kConversionCommand $conv_cmd , $commercial = false )
	{
		$simulation_results = array ();
		for ( $i=1; $i<=3 ; $i++ )
		{
			$converter = kConversionEngine::getInstance( $i );
			$simulation_results[$i] =$converter->simulate ($conv_cmd );
		}  
		return $simulation_results;
	}
	
	/**
	 * Will create the best kConversionEngine it can to handle the cmd
	 *
	 * @param kConversionCommand $conv_cmd
	 * @return kConversionResult
	 */
	public static function convert ( kConversionCommand $conv_cmd , $commercial )
	{
		$conv_result = new kConversionResult( $conv_cmd );
		if ( $commercial )
		{
			// try flix  
			$converter = kConversionEngine::getInstance( kConversionEngine::ENGINE_TYPE_FLIX );
			list ( $ok , $first_failed_index ) = $converter->convert ( $conv_cmd , $conv_result  );
			if ( !$ok )
			{
				self::failed ( $converter , $conv_cmd,  $first_failed_index );
				// try ffmpeg 
				$converter = kConversionEngine::getInstance( kConversionEngine::ENGINE_TYPE_FFMPEG );
				list ( $ok , $first_failed_index ) = $converter->convert ( $conv_cmd , $conv_result , $first_failed_index );
				if ( ! $ok )
				{
					self::failed ( $converter , $conv_cmd, $first_failed_index );
					// try mencoder
					$converter = kConversionEngine::getInstance( kConversionEngine::ENGINE_TYPE_MENCODER );
					list ( $ok , $first_failed_index ) = $converter->convert ( $conv_cmd , $conv_result , $first_failed_index ); 
				}
			}			 
		}
		else
		{
			// try ffmpeg - if failed, try mencoder
			$converter = kConversionEngine::getInstance( kConversionEngine::ENGINE_TYPE_FFMPEG ); 
			list ( $ok , $first_failed_index ) = $converter->convert ( $conv_cmd , $conv_result );
			if ( !$ok )
			{
				self::failed ( $converter , $conv_cmd, $first_failed_index );
				// try mencoder 
				$converter = kConversionEngine::getInstance( kConversionEngine::ENGINE_TYPE_MENCODER );
				list ( $ok , $first_failed_index ) = $converter->convert ( $conv_cmd , $conv_result , $first_failed_index );
				if ( ! $ok )
				{
					self::failed ( $converter , $conv_cmd, $first_failed_index );
					// try flix ?? 
					$converter = kConversionEngine::getInstance( kConversionEngine::ENGINE_TYPE_FLIX );
					list ( $ok , $first_failed_index ) = $converter->convert ( $conv_cmd , $conv_result , $first_failed_index ); 
				}
			}
		}

		// set the status_ok of the result
		$conv_result->status_ok = $ok;
		
		return $conv_result;
	}
	
	private static function failed ( kConversionEngine $converter , kConversionCommand $conv_cmd, $first_failed_index )
	{
		TRACE ( "Error: Engine [" . $converter->getName() . "] failed to convert [$first_failed_index]" );
	}
}
?>