<?php

/**
 * Subclass for representing a row from the 'conversion_params' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ConversionParams extends BaseConversionParams
{
	public function save ( $con = null )
	{
		$this->setCustomDataObj();
		return parent::save ( $con ) ;		
	}
/*
 * 	public $video = true; 		// should attempt to convert with video
	public $audio = true; 		// should attempt to convert with audio
	public $ffmpeg_params = "";		// general params to append to the ffmpeg command in case the ffmpegEngine is used
	public $mencoder_params = "";	// general params to append to the mencoder command in case the mencoderEngine is used
	public $flix_params = "";	// general params to append to the flix command in case the flixEngine is used
 * 
 */	
	public function getVideo() { return $this->getFromCustomData( "video" , null , null ) ;} 
	public function setVideo( $v ) { return $this->putInCustomData( "video" , $v  , null ); }

	public function getAudio() { return $this->getFromCustomData( "audio" , null , null ) ;} 
	public function setAudio( $v ) { return $this->putInCustomData( "audio" , $v  , null ); }
	
	public function getFfmpegParams() { return $this->getFromCustomData( "ffmpegParams" , null , null ) ;} 
	public function setFfmpegParams( $v ) { return $this->putInCustomData( "ffmpegParams" , $v  , null ); }
	
	public function getMencoderParams() { return $this->getFromCustomData( "mencoderParams" , null , null ) ;} 
	public function setMencoderParams( $v ) { return $this->putInCustomData( "mencoderParams" , $v  , null ); }
		
	public function getFlixParams() { return $this->getFromCustomData( "flixParams" , null , null ) ;} 
	public function setFlixParams( $v ) { return $this->putInCustomData( "flixParams" , $v  , null ); }
	
	public function getCommercialTranscoder() { return $this->getFromCustomData( "commercialTranscoder" , null , null ) ;} 
	public function setCommercialTranscoder( $v ) { return $this->putInCustomData( "commercialTranscoder" , $v  , null ); }
	
	
/* ---------------------- CustomData functions ------------------------- */
	private $m_custom_data = null;

	public function putInCustomData ( $name , $value , $namespace = null )
	{
//		sfLogger::getInstance()->warning ( __METHOD__ . " " . ( $namespace ? $namespace. ":" : "" ) . "[$name]=[$value]");
		$custom_data = $this->getCustomDataObj( );
		$custom_data->put ( $name , $value , $namespace );
	}

	public function getFromCustomData ( $name , $namespace = null , $def_value = null )
	{
		$custom_data = $this->getCustomDataObj( );
		$res = $custom_data->get ( $name , $namespace );
		if ( $res === null ) return $def_value;
		return $res;
	}

	public function removeFromCustomData ( $name , $namespace = null)
	{

		$custom_data = $this->getCustomDataObj( );
		return $custom_data->remove ( $name , $namespace );
	}

	public function incInCustomData ( $name , $delta = 1, $namespace = null)
	{
		$custom_data = $this->getCustomDataObj( );
		return $custom_data->inc ( $name , $delta , $namespace  );
	}

	public function decInCustomData ( $name , $delta = 1, $namespace = null)
	{
		$custom_data = $this->getCustomDataObj(  );
		return $custom_data->dec ( $name , $delta , $namespace );
	}

	private function getCustomDataObj( )
	{
		if ( ! $this->m_custom_data )
		{
			$this->m_custom_data = myCustomData::fromString ( $this->getCustomData() );
		}
		return $this->m_custom_data;
	}
	
	private function setCustomDataObj()
	{
		if ( $this->m_custom_data != null )
		{
			$this->setCustomData( $this->m_custom_data->toString() );
		}
	}
/* ---------------------- CustomData functions ------------------------- */	
}
